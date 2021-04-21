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
 * @link     https://www.github.com/zilbert97/build-netmatters-site/blob/add-php/src/submitContactForm.php
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/ContactForm.php';

$contactForm = new ContactForm();
$contactForm->validateFields();
