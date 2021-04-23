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
require_once __DIR__ . '/SubscribeForm.php';

global $subscribeFormValuesBag;
global $session;

$subscribeForm = new SubscribeForm($session, $subscribeFormValuesBag);

handleForm($subscribeForm, '/contact.php');
