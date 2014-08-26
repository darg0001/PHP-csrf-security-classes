<?php
session_start();

require_once '../security.csrf.php';

$security = new \security\CSRF;
$security->set(2600);

print_r($security->debug());