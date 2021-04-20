<?php

class ContactForm
{
    public function filterUserInput($fieldName)
    {
        $input = trim(                             // Remove whitespace
            filter_input(                          // Function to filter input
                INPUT_POST,                        // Type of input to filter
                $fieldName,                        // Name attribute of input field
                FILTER_SANITIZE_STRING             // Filter to apply
            )
        );

        return $input;
    }

    /* ====================
        FORM VALIDATION
    ==================== */

    //===== REQUIRED FIELDS =====
    public function validateRequiredFields($value)
    {
        if (empty($value)) {
            return 'Please fill in all required fields marked with *';
        }

        return null;
    }


    //===== NAME =====
    public function validateName($name)
    {
        $nameParts = explode(' ', strtolower($name));
        foreach ($nameParts as $namePart) {
            // If does not match string with either alpha chars, ', or -
            if (!preg_match('/^([a-z]+\'?-?)+/', $namePart)) {
                return 'The name you\'ve entered is invalid';
            }
        }

        return null;
    }


    //===== EMAIL =====
    public function validateEmail($email)
    {
        if (!preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $email)) {
            return "The email address you've entered is invalid";
        }

        return null;
    }


    //===== PHONE =====
    public function validatePhone($phone)
    {
        /*
        1. Strip any whitespace and special chars except +
        2. Must match 0 or 1 +'s followed by 10-12 digits
        */

        if (!preg_match('/^\+?\d{10,12}$/', formatPhoneNumber($phone))) {
            return "The contact number you've entered is invalid";
        }

        return null;
    }


    //===== MESSAGE =====
    public function validateMessage($msg)
    {
        // Message must have at least 5 words
        if (str_word_count($msg) <= 5) {
            return "The message you've entered is invalid";
        }

        return null;
    }

    //===== GDPR =====


}
