<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_logs.log');

mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');
mb_http_input('P');
mb_http_output('UTF-8');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .'/functions.php';

use \Symfony\Component\HttpFoundation\Session\Session;
use \Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;

$session = new Session();

try {
    $contactFormValuesBag = $session->getBag('contact_form_values');
} catch (InvalidArgumentException $e) {
    $contactFormValuesBag = new NamespacedAttributeBag('contact_form_values');
    $contactFormValuesBag->setName('contact_form_values');
    $session->registerBag($contactFormValuesBag);
}

try {
    $subscribeFormValuesBag = $session->getBag('subscribe_form_values');
} catch (InvalidArgumentException $e) {
    $subscribeFormValuesBag = new NamespacedAttributeBag('subscribe_form_values');
    $subscribeFormValuesBag->setName('subscribe_form_values');
    $session->registerBag($subscribeFormValuesBag);
}

$session->start();
