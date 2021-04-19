<?php

require(__DIR__ . '/../src/ContactForm.php');

class ContactFormTest extends PHPUnit\Framework\TestCase
{
    protected $form;
    protected function setUp(): void
    {
        $this->form = new ContactForm();
    }

    /* =================
        FILTER INPUT
    ================= */

    /** @test */
    public function userRequiredInputIsFiltered() {
        $fieldName = 'email';
        $returnedInput = $this->form->filterUserInput($fieldName);
        // Returned input should be a string
        $this->assertIsString($returnedInput);
    }

    /** @test */
    public function userNotRequiredInputIsFiltered() {
        $fieldName = 'phone';
        $this->form->filterUserInput($fieldName);
    }

    /* ====================
        NAME VALIDATION
    ==================== */

    /** @test */
    public function performValidationInvalidName() {
        $invalidNames = [
            '',
            '123',
            '£$!crwWRCdq'
        ];
        foreach ($invalidNames as $name) {
            // Should return false if name is invalid
            $this->assertFalse($this->form->validateName($name));
        }
    }

    /** @test */
    public function performValidationValidName() {
        $validNames = [
            'Jo',
            'Josephine O\'Englebert-McHumphryson'
        ];
        foreach ($validNames as $name) {
            // Should return true if name is valid
            $this->assertTrue($this->form->validateName($name));
        }
    }

    /* =====================
        EMAIL VALIDATION
    ===================== */

    /** @test */
    public function performValidationInvalidEmail() {
        $invalidEmails = [
            '',
            'test@test',
            'test@test.c',
            'test',
            'test.co',
            'test@test.cwoijwecq'
        ];
        foreach ($invalidEmails as $email) {
            // Should return false if email is invalid
            $this->assertFalse($this->form->validateEmail($email));
        }
    }

    /** @test */
    public function performValidatioValidEmail() {
        $validEmails = [
            'test@test.co',
            'another.test_email@test.gov.uk'
        ];
        foreach ($validEmails as $email) {
            // Should return true if email is valid
            $this->assertTrue($this->form->validateEmail($email));
        }
    }

    /* =====================
        PHONE VALIDATION
    ===================== */

    /** @test */
    public function performValidationInvalidPhone() {
        /*
        Must be stripped of whitespace
        Must be stripped of -, (, )
        Can start with + but not have more than one +
        Cannot have abc
        Must be 10-12 chars
        */

        $invalidPhones = [
            '0',
            '++1234567890987654321',
            '+123',
            '012hasabc23',
            '1 123 2432',
            '4-2431-45443'
        ];
        foreach ($invalidPhones as $phone) {
            // Should return false if phone is invalid
            $this->assertFalse($this->form->validateEmail($phone));
        }
    }

    /** @test */
    public function performValidationValidPhone() {
        /*
        Must be stripped of whitespace
        Must be stripped of -, (, )
        Can start with + but not have more than one +
        Cannot have abc
        Must be 10-13 chars
        */

        $validPhones = [
            '',
            '+441234567890',
            '+0800123456',
            '0800123456',
            '123456789012'
        ];
        foreach ($validPhones as $phone) {
            // Should return true if phone is valid
            $this->assertTrue($this->form->validateEmail($phone));
        }
    }

    /* =======================
        MESSAGE VALIDATION
    ======================= */

    /** @test */
    public function performValidationInvalidMessage() {

        $invalidMessages = [
            '',
            '0',
            'Not long enough',
            // Must contain abc chars
            '+_=42235^&523521423^3358873 21!@£$@£11 3513£@23_34'
        ];
        foreach ($invalidMessages as $msg) {
            // Should return false if message is invalid
            $this->assertFalse($this->form->validateMessage($msg));
        }
    }

    /** @test */
    public function performValidationValidMessage() {
        /*
        Must be stripped of whitespace
        Must be stripped of -, (, )
        Can start with + but not have more than one +
        Cannot have abc
        Must be 10-13 chars
        */

        $validMessages = [
            '',
            '+441234567890',
            '+0800123456',
            '0800123456',
            '123456789012'
        ];
        foreach ($validMessages as $msg) {
            // Should return true if phone is valid
            $this->assertTrue($this->form->validateMessage($msg));
        }
    }

    /* =================
        GDPR CHECKED
    ================= */

}
