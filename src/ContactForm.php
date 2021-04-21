<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/SubmitForm.php';
require_once __DIR__ . '/FormErrorMessage.php';

class ContactForm extends SubmitForm
{
    /* ====================
        FORM VALIDATION
    ==================== */

    //===== REQUIRED FIELDS =====
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

    //===== NAME =====
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

    //===== EMAIL =====
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

    //===== PHONE =====
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

    //===== MESSAGE =====
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

    //===== GDPR =====
    public function validateGDPRAccepted($checked)
    {
        if ($_POST['agree_terms_contact'] != 'accepted') {
            $warning = new FormErrorMessage(
                "You must accept our GDPR statement to contact us"
            );
            return $warning;
        }
        return true;
    }


    //
    //
    //

    private $results;

    private function getResults()
    {
        return $this->results;
    }

    private function setResults(array $resultsArray)
    {
        $this->results = $resultsArray;
    }

    public function validateFields()
    {
        // Store values from form
        $this->setResults([
            'name'=>$this->getValueOnField('name_contact'),
            'email'=>$this->getValueOnField('email_contact'),
            'phone'=>$this->getValueOnField('phone_contact'),
            'message'=>$this->getValueOnField('message_contact'),
            'gdpr'=>$this->getValueOnField('accept_terms_contact'),
        ]);

        $fieldsNotRequiredText = ['phone', 'gdpr'];

        global $session;

        // Get the bag used to save values on fields in session, so failed
        // submit does not clear fields (all except GDPR)
        global $contactFormValuesBag;

        foreach ($this->getResults() as $fieldName => $value) {
            if ($fieldName === 'gdpr') continue;
            $contactFormValuesBag->set($fieldName, $value);
        }

        // Validate required fields not empty
        foreach ($this->getResults() as $field => $result) {
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

        $resultsValidated = [
            $this->validateName($this->getResults()['name']),
            $this->validateEmail($this->getResults()['email']),
            $this->validatePhone($this->getResults()['phone']),
            $this->validateMessage($this->getResults()['message']),
            $this->validateGDPRAccepted($this->getResults()['gdpr']),
        ];

        foreach ($resultsValidated as $result) {
            if ($result instanceof FormErrorMessage) {
                $session->getFlashBag()->add('error', $result->getMessageCopy());
            }
        }

        redirect('/contact.php');
    }
}
