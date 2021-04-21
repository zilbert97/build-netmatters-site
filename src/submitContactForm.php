<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/ContactForm.php';

$contactForm = new ContactForm();
$contactForm->validateFields();
