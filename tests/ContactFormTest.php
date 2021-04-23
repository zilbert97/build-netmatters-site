<?php
require_once __DIR__ . '/../src/ContactForm.php';

use \Symfony\Component\HttpFoundation\Session\Session;

class ContactFormTest extends PHPUnit\Framework\TestCase
{
    protected $form;
    protected function setUp(): void
    {
        $session = new Session();
        $valuesBag = null;
        $this->form = new ContactForm($session, $valuesBag);
    }

    /* ====================
        REQUIRED FIELDS
    ==================== */

    public function checkRequiredFieldsEmpty()
    {
        $emptyInput = '';

        $result = $this->form->validateRequiredFields($emptyInput);

        $this->assertInstanceOf(FormErrorMessage::class, $result);
        $this->assertIsString($result->getMessageCopy());

        $this->assertEquals(
            'Please fill in all required fields marked with *',
            $result->getMessageCopy()
        );
    }


    public function checkRequiredFieldsNotEmpty()
    {
        $notEmptyInput = 'A valid string';
        $result = $this->form->validateRequiredFields($notEmptyInput);

        $this->assertIsString($result);
        $this->assertEquals($notEmptyInput, $result);
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
            $result = $this->form->validateName($name);

            $this->assertInstanceOf(FormErrorMessage::class, $result);
            $this->assertIsString($result->getMessageCopy());
            $this->assertEquals(
                "The name you've entered is invalid",
                $result->getMessageCopy()
            );
        }
    }


    /** @test */
    public function performValidationValidName()
    {
        $validNames = [
            'Jo',
            "Josephine O'Englebert-McHumphryson"
        ];
        foreach ($validNames as $name) {
            $result = $this->form->validateName($name);
            $this->assertIsString($result);
            $this->assertEquals(strtolower($name), $result);
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
            $result = $this->form->validateEmail($email);

            $this->assertInstanceOf(FormErrorMessage::class, $result);
            $this->assertIsString($result->getMessageCopy());
            $this->assertEquals(
                "The email address you've entered is invalid",
                $result->getMessageCopy()
            );
        }
    }


    /** @test */
    public function performValidationValidEmail()
    {
        $validEmails = [
            'test@test.co',
            'another.test_email@test.gov.uk'
        ];
        foreach ($validEmails as $email) {
            $result = $this->form->validateEmail($email);
            $this->assertIsString($result);
            $this->assertEquals($email, $result);
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
            $result = $this->form->validatePhone($phone);

            $this->assertInstanceOf(FormErrorMessage::class, $result);
            $this->assertIsString($result->getMessageCopy());
            $this->assertEquals(
                "The contact number you've entered is invalid",
                $result->getMessageCopy()
            );
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
            $result = $this->form->validatePhone($phone);
            $this->assertIsString($result);
            //$this->assertEquals(formatPhoneNumber($phone), $result);
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
            $result = $this->form->validateMessage($msg);

            $this->assertInstanceOf(FormErrorMessage::class, $result);
            $this->assertIsString($result->getMessageCopy());
            $this->assertEquals(
                "The message you've entered is invalid",
                $result->getMessageCopy()
            );
        }
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
            $result = $this->form->validateMessage($msg);
            $this->assertIsString($result);
            $this->assertEquals($msg, $result);
        }
    }


    /* =================
        GDPR CHECKED
    ================= */

    /** @test */
    public function validateGPDRCheckboxIsNotChecked()
    {
        $result = $this->form->validateGDPRAccepted();
        $this->assertInstanceOf(FormErrorMessage::class, $result);
        $this->assertIsString($result->getMessageCopy());
        $this->assertEquals(
            "You must accept our GDPR statement to contact us",
            $result->getMessageCopy()
        );
    }

    /** @test */
    public function validateGPDRCheckboxIsChecked()
    {
        $_POST['agree_terms_contact'] = 'accepted';
        $result = $this->form->validateGDPRAccepted();
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }
}
