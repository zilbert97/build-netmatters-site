<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/ContactForm.php';

/*
$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();*/



$contactForm = new ContactForm();
$contactForm->validateFields();
