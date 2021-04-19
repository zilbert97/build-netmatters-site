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

    //===== NAME =====
    public function validateName()
    {
    }

    //===== EMAIL =====
    public function validateEmail()
    {
    }

    //===== PHONE =====
    public function validatePhone()
    {
    }

    //===== MESSAGE =====
    public function validateMessage()
    {
    }

    //===== GDPR =====


}
