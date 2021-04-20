<?php
require_once __DIR__ . '/bootstrap.php';

class WarningMessage
{
    private $messageBody;
    private $messageCopy;

    public function __construct($message)
    {
        $messageCopy = $message;
        $this->setMessageCopy($message);
        //$this->setMessageBody($message);
    }

    /*
    public function getMessageBody()
    {
        return $this->messageBody;
    }
    private function setMessageBody(string $copy)
    {
        $this->messageBody = '
            <div class="error--wrapper">
                <div class="error--message-body">
                    <p class="error--copy">' . $copy . '</p>
                </div>
            </div>';
    }    */



    public function getMessageCopy()
    {
        return $this->messageCopy;
    }
    public function setMessageCopy(string $copy)
    {
        $this->messageCopy = $copy;
    }
}
