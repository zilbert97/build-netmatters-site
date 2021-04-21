<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ .'/functions.php';

$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();
