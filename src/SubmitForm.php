<?php
require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;

abstract class SubmitForm extends Request
{
    public $request;
    public $db;

    public function __construct()
    {
        // Get posted data
        $this->request = Request::createFromGlobals();
    }

    /*
    public function setRequest()
    {
        $request = Request::createFromGlobals();
    }    */

    public function getValueOnField(string $fieldName)
    {
        return $this->request->get($fieldName);
    }

    abstract public function validateFields();
}
