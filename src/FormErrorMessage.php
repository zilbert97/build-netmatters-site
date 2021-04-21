<?php
require_once __DIR__ . '/bootstrap.php';

class FormErrorMessage
{
    private $messageBody;
    private $messageCopy;

    public function __construct($message)
    {
        $messageCopy = $message;
        $this->setMessageCopy($message);
    }

    public function getMessageCopy()
    {
        return $this->messageCopy;
    }
    public function setMessageCopy(string $copy)
    {
        $this->messageCopy = $copy;
    }
}
