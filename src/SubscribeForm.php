<?php
/**
 *
 *
 * PHP version 8
 *
 * @category Class
 * @package  BuildNetmattersSite
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/SubscribeForm.php
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/ValidateSubmitForm.php';
require_once __DIR__ . '/FormErrorMessage.php';

/**
 *
 *
 * @category Class
 * @package  BuildNetmattersSite
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/ContactForm.php
 */
class SubscribeForm extends ValidateSubmitForm
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
     * Validates values on a the subscribe form and reloads the page if fails
     *
     * @return array|void Returns form values if validation passes else reloads page
     */
    public function validateFields()
    {
        // Store values from form (sanitized)
        // 513 = FILTER_SANITIZE_STRING
        // 517 = FILTER_SANITIZE_EMAIL
        // 519 = FILTER_SANITIZE_NUMBER_INT
        $results = [
            'name'=>$this->getValueOnField('name_subscribe', 513),
            'email_address'=>$this->getValueOnField('email_subscribe', 517),
            'marketing'=>$this->getValueOnField('accept_terms_subscribe', 513),
        ];

        // Get the bag used to save values on fields in session, so failed
        // submit does not clear fields (all except marketing checkbox)

        foreach ($results as $fieldName => $value) {
            if ($fieldName !== 'marketing') {
                $this->_formValuesBag->set($fieldName, $value);
            }
        }

        // Validate required fields are not empty
        foreach ($results as $field => $result) {
            // Skip marketing input field (required but it is validated elsewhere)
            if ($field == 'marketing') continue;

            $validatedResult = $this->validateRequiredFields($result);

            if ($validatedResult instanceof FormErrorMessage) {
                // Only show required fields warning - otherwise other
                // validations will fail (empty fields are implicitly invalid)
                $this->_session->getFlashBag()->add(
                    'subscribe-error', $validatedResult->getMessageCopy()
                );

                return;
            }
        }

        // Get results and perform specific field validation on each
        $resultsValidated = [
            'name'=>$this->validateName($results['name']),
            'email_address'=>$this->validateEmail($results['email_address']),
            'marketing'=>$this->validateMarketingAccepted($results['marketing'], 'accept_marketing_subscribe'),
        ];

        // If any validation returns a FormErrorMessage object, set error status
        $hasErrors = false;

        foreach ($resultsValidated as $result) {
            if ($result instanceof FormErrorMessage) {
                $this->_session->getFlashBag()->add('subscribe-error', $result->getMessageCopy());
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
                CREATE TABLE newsletter_signup (
                    name TEXT NOT NULL,
                    email TEXT UNIQUE,
                    signed_up_at DATE NOT NULL
                );
            ================================ */

            $valuesToSubmit = array_merge(
                // Get values from validated results array that have keys
                array_intersect_key(
                    $this->_getValidatedFormValues(),
                    array_flip(array('name', 'email_address'))
                ),
                // Add current datetime to results to submit to database
                array('submitted_at'=>date('Y-m-d H:i:s'))
            );

            try {
                $query = 'INSERT INTO newsletter_signup VALUES (
                    :name, :email_address, :submitted_at
                )';

                $stmt = $db->prepare($query);

                foreach ($valuesToSubmit as $column=>$value) {
                    $stmt->bindValue(":$column", $value, PDO::PARAM_STR);
                }
                $stmt->execute();

                // Add success message to flash bag
                $this->_session->getFlashBag()->add(
                    'subscribe-success',
                    'You\'re now subscribed to our mailing list!'
                );

                // Empty stored values from $this->_formValuesBag
                $this->_formValuesBag->clear();

                return true;

            } catch (Exception $e) {
                // If unsucessful submit, add error to flashbag
                $this->_session->getFlashBag()->add(
                    'subscribe-error',
                    'Server error - failed to submit form'
                );
                return false;
            }
        } else {
            // If no connection to database, add error message to flash bag
            // Note do not empty stored values from form so user can try again
            $this->_session->getFlashBag()->add(
                'subscribe-error',
                'Server error - failed to submit form'
            );
            return false;
        }
    }
}
