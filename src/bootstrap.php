<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .'/functions.php';

use \Symfony\Component\HttpFoundation\Session\Session;
use \Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;

$session = new Session();

try {
    $contactFormValuesBag = $session->getBag('field_values');
} catch (InvalidArgumentException $e) {
    $contactFormValuesBag = new NamespacedAttributeBag('field_values');
    $contactFormValuesBag->setName('field_values');
    $session->registerBag($contactFormValuesBag);
}

$session->start();
