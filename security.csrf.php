<?php

namespace security {

 class CSRF {
  
  private $_token;
  private $_time =  3600;

  public function __construct() {
    
    print_r($_SESSION['security_csrf']);
    
    if(!isset($_SESSION['security_csrf'])) {
     
     $_SESSION['security_csrf'] = [];
    }
  }
  
  public function debug() {
	
    print_r($_SESSION['security_csrf']);
    print_r($this->_time);
  }
  
  public function set_time($time) {

	
    if(is_int($time) || is_numeric($time)) {
		
      $this->_time = $time;
      
      return true;
    }

   return false;
  }
  
  public function delete($token) {
	
   if($this->get($token)) {
    
    unset($_SESSION['security_csrf'][$token]);
    
    $clean = [];
      
     foreach($_SESSION['security_csrf'] AS $token => $time) {
        
      if($time >= time()) {
        unset($_SESSION['security_csrf'][$token]);
      }
    }

    return true;
   } else {
    return false;
   }
  }
  
  public function set($time = true) {

   $_SESSION['security_csrf'][sha1(mt_rand() . rand())] = (time() + ($time ? $this->_time : $time));
   
  }
  
  public function get($token) {
	
   return isset($_SESSION['security_csrf'][$token]);
  }
 }
}