<?php
session_start();

require_once '../security.csrf.php';

$security = new \security\CSRF;

$token = $security->set(3, 3600);

if(isset($_POST['token'])) {
  if($security->get($_POST['token'])) {
    
    $security->delete($_POST['token']);
    
    echo 'removed.';
  } else {
    echo 'not removed, the token doesn\'t exist or is expired.';
  }
}
?>
<div style="width: 400px;margin:0 auto;">
 <form action="#" method="post">
  <input name="token" value="<?= $token; ?>">
  <input type="submit">
 </form>
</div>