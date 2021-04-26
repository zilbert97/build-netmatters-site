<?php
/**
 * Defines an error message class
 *
 * PHP version 8
 *
 * @category Class
 * @package  BuildNetmattersSite
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/FormErrorMessage.php
 */

require_once __DIR__ . '/bootstrap.php';

/**
 * Error message object
 *
 * @category Class
 * @package  BuildNetmattersSite
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/FormErrorMessage.php
 */
class FormErrorMessage
{
    private $_messageCopy;

    /**
     * At instantiation sets the message copy
     *
     * @param string $message Error message to display
     *
     * @return void
     */
    public function __construct($message)
    {
        $_messageCopy = $message;
        $this->setMessageCopy($message);
    }

    /**
     * Gets the message copy
     *
     * @return void
     */
    public function getMessageCopy() : string
    {
        return $this->_messageCopy;
    }

    /**
     * Sets the message copy
     *
     * @param string $copy The error message string
     *
     * @return void
     */
    public function setMessageCopy(string $copy) : void
    {
        $this->_messageCopy = $copy;
    }
}
