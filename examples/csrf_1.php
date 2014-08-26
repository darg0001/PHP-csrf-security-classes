<?php
session_start();

require_once 'security.class.php';

$security = new \security\CSRF;
$security->set(2600);

print_r($security->debug());