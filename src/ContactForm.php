<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/SubmitForm.php';
require_once __DIR__ . '/WarningMessage.php';

class ContactForm extends SubmitForm
{
    /* ====================
        FORM VALIDATION
    ==================== */

    //===== REQUIRED FIELDS =====
    public function validateRequiredFields($value)
    {
        if (empty($value)) {
            $warning = new WarningMessage(
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
                $warning = new WarningMessage(
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
            $warning = new WarningMessage(
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
            $warning = new WarningMessage(
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
            $warning = new WarningMessage(
                "The message you've entered is invalid"
            );
            return $warning;
        }

        return $msg;
    }

    //===== GDPR =====
    public function validateGDPRAccepted($checked)
    {
        if (!$checked) {
            $warning = new WarningMessage(
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
        $this->setResults([
            'name'=>$this->getValueOnField('name_contact'),
            'email'=>$this->getValueOnField('email_contact'),
            'phone'=>$this->getValueOnField('phone_contact'),
            'message'=>$this->getValueOnField('message_contact'),
            'gdpr'=>$this->getValueOnField('accept_terms_contact'),
        ]);

        global $session;

        // Validate required fields not empty
        foreach ($this->getResults() as $result) {
            $value = $this->validateRequiredFields($result);

            if ($value instanceof WarningMessage) {
                // Add to flashbag
                // Trigger page reload
                // Early return to prevent multiple identical messages added
                echo 'EMPTY FIELD';
            }
        }

        $resultsValidated = [
            $this->validateName($this->getResults()['name']),
            $this->validateEmail($this->getResults()['email']),
            $this->validatePhone($this->getResults()['phone']),
            $this->validateMessage($this->getResults()['message']),
            $this->validateGDPRAccepted($this->getResults()['gdpr']),
        ];

        foreach ($resultsValidated as $value) {
            if ($value instanceof WarningMessage) {
                $session->getFlashBag()->add('error', $value->getMessageCopy());
            }
        }

        redirect('/contact.php');
    }
}
