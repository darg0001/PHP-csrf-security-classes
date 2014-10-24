<?php

namespace security {

 class CSRF {
  
  private $_token;
  private $_time =  3;

  public function __construct() {
    
    if(!isset($_SESSION['security_csrf'])) {
     
     $_SESSION['security_csrf'] = [];
    }
  }
  
  public function debug() {
	
    echo json_encode($_SESSION['security_csrf'], JSON_PRETTY_PRINT);
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
    
     unset($_SESSION['security_csrf'][$token]);

    return true;
   }
   
   return false;
   
  }
  
  public function deleteExpiredTokens() {
  
   foreach($_SESSION['security_csrf'] AS $token => $time) {  
    if(time() >= $time) {
      unset($_SESSION['security_csrf'][$token]);
    }
   }
  }
  
  public function set($time = true, $multiplier = 3600) {
   $key = sha1(mt_rand() . rand());
   $value = (time() + (($time ? $this->_time : $time) * $multiplier));
   
   $_SESSION['security_csrf'][$key] = $value;
   return $key;
   
  }
  
  public function get($token) {
	
   return isset($_SESSION['security_csrf'][$token]);
  }
  
  public function last() {
    
    return key(array_slice($_SESSION['security_csrf'], -1, 1, true));
  }
 }
}