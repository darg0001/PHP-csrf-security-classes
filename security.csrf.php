<?php

namespace security {

 class CSRF {
  
  private $_token;
  private $_time =  3;

  public function __construct() {
    
    $this->deleteExpiredTokens();
    
    if(!isset($_SESSION['security']['csrf'])) {
     
     $_SESSION['security']['csrf'] = [];
    }
  }
  
  public function debug() {
	
    echo json_encode($_SESSION['security']['csrf'], JSON_PRETTY_PRINT);
  }
  
  public function set_time($time) {

	
    if(is_int($time) || is_numeric($time)) {
		
      $this->_time = $time;
      
      return true;
    }

   return false;
  }
  
  public function delete($token) {
	
   $this->deleteExpiredTokens();
  
   if($this->get($token)) {
    
     unset($_SESSION['security']['csrf'][$token]);

    return true;
   }
   
   return false;
   
  }
  
  public function deleteExpiredTokens() {
  
   foreach($_SESSION['security']['csrf'] AS $token => $time) {  
    if(time() >= $time) {
      unset($_SESSION['security']['csrf'][$token]);
    }
   }
  }
  
  public function set($time = true, $multiplier = 3600) {
   $key = sha1(mt_rand() . rand());
   $value = (time() + (($time ? $this->_time : $time) * $multiplier));
   
   $_SESSION['security']['csrf'][$key] = $value;
   return $key;
   
  }
  
  public function get($token) {
   
   $this->deleteExpiredTokens();
   
   return isset($_SESSION['security']['csrf'][$token]);
  }
  
  public function last() {
    
    return end($_SESSION['security']['csrf']);
  }
 }
}