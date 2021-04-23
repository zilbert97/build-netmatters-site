<?php
/**
 *
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/ContactForm.php
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/ValidateSubmitForm.php';
require_once __DIR__ . '/FormErrorMessage.php';

/**
 *
 * @category Class
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/ContactForm.php
 */
class ContactForm extends ValidateSubmitForm
{
    private $_formValuesBag;
    private $_session;
    private $_results;

    /**
     *
     */
    public function __construct($session, $formValuesBag)
    {
        parent::__construct();
        $this->_session = $session;
        $this->_formValuesBag = $formValuesBag;
    }

    /**
     * Gets the array of validated form values
     *
     * @return array
     */
    private function _getValidatedFormValues() : array
    {
        return $this->_results;
    }

    /**
     * Sets the array of validated form values
     *
     * @param array $values
     *
     * @return void
     */
    private function _setValidatedFormValues(array $values) : void
    {
        $this->_results = $values;
    }

    /**
     * Validates values on a the contact form and reloads the page if fails
     *
     * @return array|void Returns form values if validation passes else void
     */
    public function validateFields()
    {
        // Store values from form (sanitized)
        // 513 = FILTER_SANITIZE_STRING
        // 517 = FILTER_SANITIZE_EMAIL
        // 519 = FILTER_SANITIZE_NUMBER_INT
        $results = [
            'name'=>$this->getValueOnField('name_contact', 513),
            'email_address'=>$this->getValueOnField('email_contact', 517),
            'contact_number'=>$this->getValueOnField('phone_contact', 519),
            'message'=>$this->getValueOnField('message_contact', 513),
            'gdpr'=>$this->getValueOnField('accept_terms_contact', 513),
        ];

        $fieldsNotRequiredText = ['contact_number', 'gdpr'];

        // Get the bag used to save values on fields in session, so failed
        // submit does not clear fields (all except GDPR)

        foreach ($results as $fieldName => $value) {
            if ($fieldName !== 'gdpr') {
                $this->_formValuesBag->set($fieldName, $value);
            }
        }

        // Validate required fields are not empty
        foreach ($results as $field => $result) {
            // Skip input fields that do not have * required marker
            // Technically GDPR is required but it is validated elsewhere
            if (in_array($field, $fieldsNotRequiredText)) continue;

            $validatedResult = $this->validateRequiredFields($result);

            if ($validatedResult instanceof FormErrorMessage) {
                $this->_session->getFlashBag()->add(
                    'contact-error', $validatedResult->getMessageCopy()
                );

                // Only show required fields warning - otherwise other
                // validations will fail (empty fields are implicitly invalid)
                return;
            }
        }

        // Get results and perform specific field validation on each
        $resultsValidated = [
            'name'=>$this->validateName($results['name']),
            'email_address'=>$this->validateEmail($results['email_address']),
            'contact_number'=>$this->validatePhone($results['contact_number']),
            'message'=>$this->validateMessage($results['message']),
            'gdpr'=>$this->validateGDPRAccepted($results['gdpr'], 'accept_gdpr_contact'),
        ];

        // If any validation returns a FormErrorMessage object, set error status
        $hasErrors = false;

        foreach ($resultsValidated as $result) {
            if ($result instanceof FormErrorMessage) {
                $this->_session->getFlashBag()->add('contact-error', $result->getMessageCopy());
                $hasErrors = true;
            }
        }

        // If no validation errors, set and return the values
        if (!$hasErrors) {
            $this->_setValidatedFormValues($resultsValidated);
            return $resultsValidated;
        }

        return;
    }

    /**
     * Submits values to the database
     *
     * @return bool True if submits susccesfully, else false
     */
    public function submitForm() : bool
    {
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

            $valuesToSubmit = array_merge(
                // Get values from validated results array that have keys
                array_intersect_key(
                    $this->_getValidatedFormValues(),
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

                foreach ($valuesToSubmit as $column=>$value) {
                    $stmt->bindValue(":$column", $value, PDO::PARAM_STR);
                }
                $stmt->execute();

                // Add success message to flash bag
                $this->_session->getFlashBag()->add(
                    'contact-success',
                    'Your message was sent successfully!'
                );

                // Empty stored values from $this->_formValuesBag
                $this->_formValuesBag->clear();

                return true;

            } catch (Exception $e) {
                // If unsucessful submit, add error to flashbag
                $this->_session->getFlashBag()->add(
                    'contact-error',
                    'Server error - failed to submit message'
                );
                return false;
            }
        } else {
            // If no connection to database, add error message to flash bag
            // Note do not empty stored values from form so user can try again
            $this->_session->getFlashBag()->add(
                'contact-error',
                'Server error - failed to submit message'
            );
            return false;
        }
    }
}
