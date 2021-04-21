<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .'/functions.php';

$session = new \Symfony\Component\HttpFoundation\Session\Session();

try {
    $contactFormValuesBag = $session->getBag('field_values');
} catch (InvalidArgumentException $e) {
    $contactFormValuesBag = new \Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag('field_values');
    $contactFormValuesBag->setName('field_values');
    $session->registerBag($contactFormValuesBag);
}

$session->start();
