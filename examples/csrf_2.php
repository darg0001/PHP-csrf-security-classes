<?php
session_start();

require_once '../security.csrf.php';

$security = new \security\CSRF;

$token = $security->set(3, 3600);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
 if(isset($_POST['token'])) {
  if($security->get($_POST['token'])) {
      
   $security->delete($_POST['token']); 
   echo 'removed.';
  }
 }
}
?>
<form action="#" method="post">
 <input name="token" value="<?= $token; ?>">
 <input type="submit">
</form>