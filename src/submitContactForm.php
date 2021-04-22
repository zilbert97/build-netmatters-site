<?php
/**
 *
 *
 * PHP version 8
 *
 * @category
 * @package
 * @author   Z Gilbert <zach.gilbert@netmatters-scs.co.uk>
 * @license  github.com/zilbert97/build-netmatters-site/blob/add-php/LICENSE LICENSE
 * @link     github.com/zilbert97/build-netmatters-site/blob/add-php/src/submitContactForm.php
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/ContactForm.php';

global $session;
global $contactFormValuesBag;

$contactForm = new ContactForm($session, $contactFormValuesBag);

// Returns values if validation passes, else will refresh page
$formValues = $contactForm->validateFields();

if ($formValues) {
    $contactForm->submitForm($formValues);
}
