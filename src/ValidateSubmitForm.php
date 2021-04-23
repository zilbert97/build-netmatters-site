<?php
/**
 * Form submitter abstract class
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/SubmitForm.php
 */

require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @category Class
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/SubmitForm.php
 * @abstract
 */
abstract class ValidateSubmitForm extends Request
{
    private $_request;

    /**
     * Gets posted data upon class construction
     *
     * @return void
     */
    public function __construct()
    {
        $this->_request = Request::createFromGlobals();
    }

    /**
     * Gets and filters the value on a field
     *
     * @param string  $fieldName Name of the form input field to get value from
     * @param integer $filter    Integer for the PHP filter type
     *
     * @return string
     */
    public function getValueOnField(string $fieldName, int $filter)
    {
        return filter_var(
            $this->_request->get($fieldName),
            $filter
        );
    }

    /**
     * Validates the value from a required field is not empty
     *
     * @param string $value The value obtained from a form input field
     *
     * @return FormErrorMessage|string Message object if unsuccesful, else the value
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
     * Validates a name value passed is a valid name
     *
     * @param string $name The name value obtained from a form input field
     *
     * @return FormErrorMessage|string Message object if unsuccesful, else the value
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
     * Validates an email value passed is a valid email
     *
     * @param string $email The email value obtained from a form input field
     *
     * @return FormErrorMessage|string Message object if unsuccesful, else the value
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
     * Validates the phone number value is a valid phone number
     *
     * @param string $phone The phone number value obtained from a form input field
     *
     * @return FormErrorMessage|string Message object if unsuccesful, else the value
     */
    public function validatePhone(string $phone)
    {
        // Strip any whitespace, brackets, or dashes from phone number
        $formattedPhone = preg_replace('/[\s\(\)\-]/', '', $phone);

        // Match 0 or 1 +'s followed by 10-12 digits
        if (!preg_match('/^\+?\d{10,12}$/', $formattedPhone)) {
            $warning = new FormErrorMessage(
                "The contact number you've entered is invalid"
            );
            return $warning;
        }

        return $formattedPhone;
    }

    /**
     * Validates the message value is a valid message of suitable length
     *
     * @param string $msg The message string value obtained from a form input field
     *
     * @return FormErrorMessage|string Message object if unsuccesful, else the value
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
     * Validates the checkbox value submitted in a post request is checked
     *
     * @return FormErrorMessage|bool Message object if unsuccesful, else true
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

    /**
     * Performs input field validation
     *
     * @abstract
     * @return   array|void Values from the form if passed validation
     */
    abstract public function validateFields();

    /**
     * Submit the form values to the database
     *
     * @abstract
     * @return   bool True if form submits, else false
     */
    abstract public function submitForm() : bool;
}
