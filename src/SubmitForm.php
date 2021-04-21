<?php
/**
 * Form submitter abstract class
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     https://www.github.com/zilbert97/build-netmatters-site/blob/add-php/src/SubmitForm.php
 */

require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;

/**
 * SubmitForm Class
 *
 * @category Class
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/SubmitForm.php
 * @abstract
 */
abstract class SubmitForm extends Request
{
    public $request;
    public $db;

    /**
     * Constructor for SubmitForm abstract class
     *
     * @return void
     */
    public function __construct()
    {
        // Get posted data
        $this->request = Request::createFromGlobals();
    }

    /**
     * Gets and filters the value on a field
     *
     * @param string  $fieldName Name of the form input field to get value from
     * @param integer $filter    Integer for the PHP filter type
     *
     * @return string
     */
    public function getValueOnField(string $fieldName, int $filter)
    {
        return filter_var(
            $this->request->get($fieldName),
            $filter
        );
    }

    /**
     * Perform input field validation
     *
     * @abstract
     * @return   void
     */
    abstract public function validateFields();
}
