<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/SubmitForm.php';
require_once __DIR__ . '/FormErrorMessage.php';

class ContactForm extends SubmitForm
{
    /* ====================
        FORM VALIDATION
    ==================== */

    /**
     * REQUIRED FIELDS
     */
    public function validateRequiredFields($value)
    {
        if (empty($value)) {
            $warning = new FormErrorMessage(
                'Please fill in all required fields marked with *'
            );
            return $warning;
        }

        return $value;
    }


    /**
     * NAME
     */
    public function validateName(string $name)
    {
        $nameParts = explode(' ', strtolower($name));
        foreach ($nameParts as $namePart) {
            // If does not match string with either alpha chars, ', or -
            if (!preg_match('/^([a-z]+\'?-?)+/', $namePart)) {
                $warning = new FormErrorMessage(
                    "The name you've entered is invalid"
                );
                return $warning;
            }
        }

        return strtolower($name);
    }


    /**
     * EMAIL
     */
    public function validateEmail(string $email)
    {
        if (!preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $email)) {
            $warning = new FormErrorMessage(
                "The email address you've entered is invalid"
            );
            return $warning;
        }

        return $email;
    }


    /**
     * PHONE
     */
    public function validatePhone(string $phone)
    {
        /*
        1. Strip any whitespace and special chars except +
        2. Must match 0 or 1 +'s followed by 10-12 digits
        */
        $formattedPhone = formatPhoneNumber($phone);

        if (!preg_match('/^\+?\d{10,12}$/', $formattedPhone)) {
            $warning = new FormErrorMessage(
                "The contact number you've entered is invalid"
            );
            return $warning;
        }

        return $formattedPhone;
    }


    /**
     * MESSAGE
     */
    public function validateMessage(string $msg)
    {
        // Message must have at least 5 words
        if (str_word_count($msg) <= 5) {
            $warning = new FormErrorMessage(
                "The message you've entered is invalid"
            );
            return $warning;
        }

        return $msg;
    }


    /**
     * GDPR
     */
    public function validateGDPRAccepted()
    {
        if (!isset($_POST['agree_terms_contact'])) {
            $warning = new FormErrorMessage(
                "You must accept our GDPR statement to contact us"
            );
            return $warning;
        }
        return true;
    }


    /* ==================================
        EXECUTE VALIDATION AND SUBMIT
    ================================== */

    private $_results;

    /**
     *
     */
    private function _getResults()
    {
        return $this->_results;
    }

    /**
     *
     */
    private function _setResults(array $resultsArray)
    {
        $this->_results = $resultsArray;
    }

    /**
     *
     */
    public function validateFields()
    {
        // Store values from form (sanitized)
        // 513 = FILTER_SANITIZE_STRING
        // 517 = FILTER_SANITIZE_EMAIL
        // 519 = FILTER_SANITIZE_NUMBER_INT
        $this->_setResults(
            [
                'name'=>$this->getValueOnField('name_contact', 513),
                'email_address'=>$this->getValueOnField('email_contact', 517),
                'contact_number'=>$this->getValueOnField('phone_contact', 519),
                'message'=>$this->getValueOnField('message_contact', 513),
                'gdpr'=>$this->getValueOnField('accept_terms_contact', 513),
            ]
        );

        $fieldsNotRequiredText = ['contact_number', 'gdpr'];

        global $session;

        // Get the bag used to save values on fields in session, so failed
        // submit does not clear fields (all except GDPR)
        global $contactFormValuesBag;

        foreach ($this->_getResults() as $fieldName => $value) {
            if ($fieldName === 'gdpr') continue;
            $contactFormValuesBag->set($fieldName, $value);
        }

        // Validate required fields are not empty
        foreach ($this->_getResults() as $field => $result) {
            // Skip input fields that do not have * required marker
            // Technically GDPR is required but it is validated elsewhere
            if (in_array($field, $fieldsNotRequiredText)) continue;

            $validatedResult = $this->validateRequiredFields($result);

            if ($validatedResult instanceof FormErrorMessage) {
                $session->getFlashBag()->add(
                    'error', $validatedResult->getMessageCopy()
                );

                // Only show required fields warning - otherwise other
                // validations will fail (empty fields are implicitly invalid)
                redirect('/contact.php');
                return;
            }
        }

        // Get results and perform specific field validation on each
        $resultsValidated = [
            'name'=>$this->validateName($this->_getResults()['name']),
            'email_address'=>$this->validateEmail($this->_getResults()['email_address']),
            'contact_number'=>$this->validatePhone($this->_getResults()['contact_number']),
            'message'=>$this->validateMessage($this->_getResults()['message']),
            'gdpr'=>$this->validateGDPRAccepted($this->_getResults()['gdpr']),
        ];

        // If any validation returns a FormErrorMessage object, set error status
        $hasErrors = false;

        foreach ($resultsValidated as $result) {
            if ($result instanceof FormErrorMessage) {
                $session->getFlashBag()->add('error', $result->getMessageCopy());
                $hasErrors = true;
            }
        }

        // If no validation errors, attempt to submit (add to database)
        if (!$hasErrors) {

            $db = connectToDatabase();

            // If succesful connection to database, add row
            if ($db) {

                /* ============ SCHEMA ============
                    CREATE TABLE contact (
                        name TEXT NOT NULL,
                        email_address TEXT NOT NULL,
                        contact_number TEXT NOT NULL,
                        message TEXT NOT NULL,
                        submitted_at DATE NOT NULL
                    );
                ================================ */

                $resultsToSubmit = array_merge(
                    // Get values from validated results array that have keys
                    array_intersect_key(
                        $resultsValidated,
                        array_flip(array('name', 'email_address', 'contact_number', 'message'))
                    ),
                    // Add current datetime to results to submit to database
                    array('submitted_at'=>date('Y-m-d H:i:s'))
                );

                try {
                    $query = 'INSERT INTO contact VALUES (
                        :name, :email_address, :contact_number, :message, :submitted_at
                    )';

                    $stmt = $db->prepare($query);

                    foreach ($resultsToSubmit as $key=>$val) {
                        $stmt->bindValue(":$key", $val, PDO::PARAM_STR);
                    }
                    $stmt->execute();

                    // Add success message to flash bag
                    $session->getFlashBag()->add(
                        'success',
                        'Your message was sent successfully!'
                    );

                    // Empty stored values from $contactFormValuesBag
                    $contactFormValuesBag->clear();

                } catch (Exception $e) {
                    // If unsucessful submit, add error to flashbag
                    $session->getFlashBag()->add(
                        'error',
                        'Server error - failed to submit message'
                    );
                }

            } else {
                // If no connection to database, add error message to flash bag
                // Note do not empty stored values from form so user can try again
                $session->getFlashBag()->add(
                    'error',
                    'Server error - failed to submit message'
                );
            }
        }

        redirect('/contact.php');
    }
}
