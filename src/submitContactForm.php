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

global $contactFormValuesBag;
global $session;

$contactForm = new ContactForm($session, $contactFormValuesBag);

handleForm($contactForm, $_SERVER['HTTP_REFERER']);
