<?php
header('Content-type: application/json');

error_reporting(E_ALL);
session_start();

require_once '../security.csrf.php';

$security = new \security\CSRF;
$security->set(3, /* multiplier */, 3600);

if(isset($_GET['token'])) {
  if($security->delete($_GET['token'])) {  
    echo 'removed.';
  } else {
    echo 'not removed.';
  }
}

$security->debug();