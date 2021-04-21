<?php
/**
 *
 */

require_once __DIR__ . '/bootstrap.php';

/**
 *
 */
class FormErrorMessage
{
    private $_messageBody;
    private $_messageCopy;

    /**
     *
     */
    public function __construct($message)
    {
        $_messageCopy = $message;
        $this->setMessageCopy($message);
    }

    /**
     *
     */
    public function getMessageCopy()
    {
        return $this->_messageCopy;
    }
    
    /**
     *
     */
    public function setMessageCopy(string $copy)
    {
        $this->_messageCopy = $copy;
    }
}
