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


    /* ====================
        REQUIRED FIELDS
    ==================== */

    public function checkRequiredFieldsEmpty()
    {
        // validateRequiredFields should return an error message if empty
        $emptyInput = '';
        $this->assertIsString(
            $this->form->validateRequiredFields($emptyInput)
        );

        $this->assertEquals(
            'Please fill in all required fields marked with *',
            $this->form->validateRequiredFields($emptyInput)
        );
    }


    public function checkRequiredFieldsNotEmpty()
    {
        // validateRequiredFields should return null if not empty
        $notEmptyInput = 'A valid string';
        $this->assertNull(
            $this->form->validateRequiredFields($notEmptyInput)
        );
    }


    /* ====================
        NAME VALIDATION
    ==================== */

    /** @test */
    public function performValidationInvalidName()
    {
        $invalidNames = [
            '123',
            '£$!crwWRCdq'
        ];
        foreach ($invalidNames as $name) {
            // Should return error message if name is invalid
            $this->assertIsString($this->form->validateName($name));
        }
        $this->assertEquals(
            "The name you've entered is invalid",
            $this->form->validateName($name)
        );
    }


    /** @test */
    public function performValidationValidName()
    {
        $validNames = [
            'Jo',
            "Josephine O'Englebert-McHumphryson"
        ];
        foreach ($validNames as $name) {
            // Should return null if name is valid
            $this->assertNull($this->form->validateName($name));
        }
    }


    /* =====================
        EMAIL VALIDATION
    ===================== */

    /** @test */
    public function performValidationInvalidEmail()
    {
        $invalidEmails = [
            'test@test',
            'test@test.c',
            'test',
            'test.co',
            'test@test.cwoijwecq'
        ];
        foreach ($invalidEmails as $email) {
            // Should return error message if email is invalid
            $this->assertIsString(
                $this->form->validateEmail($email)
            );
        }
        $this->assertEquals(
            "The email address you've entered is invalid",
            $this->form->validateEmail($email)
        );
    }


    /** @test */
    public function performValidationValidEmail()
    {
        $validEmails = [
            'test@test.co',
            'another.test_email@test.gov.uk'
        ];
        foreach ($validEmails as $email) {
            // Should return null if email is valid
            $this->assertNull($this->form->validateEmail($email));
        }
    }


    /* =====================
        PHONE VALIDATION
    ===================== */

    /** @test */
    public function performValidationInvalidPhone()
    {
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
            '14214134144+'
        ];
        foreach ($invalidPhones as $phone) {
            // Should return string if phone is invalid
            $this->assertIsString(
                $this->form->validatePhone(formatPhoneNumber($phone))
            );
        }
        $this->assertEquals(
            'The contact number you\'ve entered is invalid',
            $this->form->validatePhone($phone)
        );
    }


    /** @test */
    public function formatUserPhoneNumber()
    {
        $phones = [
            '+441234567890',
            '+0800123456',
            '0800123456',
            '123456789012',
            '01223 123 123',
            '(01223)123124',
            '+44 7513 872 821',
            '(+44)-134 1341 141',
            '134-12454-214'
        ];
        foreach ($phones as $phone) {
            $this->assertIsString($phone);
        }
    }


    /** @test */
    public function performValidationValidPhone()
    {
        $validPhones = [
            '+441234567890',
            '+0800123456',
            '0800123456',
            '123456789012',
            '01223 123 123',
            '(01223)123124',
            '+44 7513 872 821',
            '(+44)-134 1341 141',
            '134-12454-214'
        ];
        foreach ($validPhones as $phone) {
            // Should return null if phone is valid
            $this->assertMatchesRegularExpression(
                '/^\+?\d{10,12}$/',
                formatPhoneNumber($phone)
            );
            $this->assertNull($this->form->validatePhone($phone));
        }
    }


    /* =======================
        MESSAGE VALIDATION
    ======================= */

    /** @test */
    public function performValidationInvalidMessage()
    {
        $invalidMessages = [
            '0',
            'Not long enough',
            // Must contain abc chars
            '+_=42235^&523521423^3358873 21!@£$@£11 3513£@23_34'
        ];
        foreach ($invalidMessages as $msg) {
            // Should return string if message is invalid
            $this->assertIsString($this->form->validateMessage($msg));
        }
        $this->assertEquals(
            "The message you've entered is invalid",
            $this->form->validateMessage($msg)
        );
    }


    /** @test */
    public function performValidationValidMessage()
    {
        /*
        Must be stripped of whitespace
        Must be stripped of -, (, )
        Can start with + but not have more than one +
        Cannot have abc
        Must be 10-13 chars
        */

        $validMessages = [
            'This is a valid message that you may find in a contact form',
            'Mus2 have at least 6 words !ncluded'
        ];
        foreach ($validMessages as $msg) {
            // Should return null if phone is valid
            $this->assertNull($this->form->validateMessage($msg));
        }
    }


    /* =================
        GDPR CHECKED
    ================= */

}
