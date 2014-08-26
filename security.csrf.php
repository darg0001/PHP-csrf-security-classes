<?php

namespace security {

 class CSRF {
  
  private $_token;
  private $_tokens;
  private $_time =  3600;

  public function __construct() {
	
    if(!isset($_SESSION['security_csrf'])) {
     
     $_SESSION['security_csrf'] = [];
    }
  }
  
  public function debug() {
	
    print_r($this->_tokens);
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
	
   if($this->verify($token)) {
    
    array_diff($_SESSION['security_csrf'], [ $token ]);
    
    $clean = [];
      
     foreach($_SESSION['security_csrf'] AS $token => $time) {
        
      if($time >= time()) {
        $clean[] = $token;
      }
    }
    
    array_diff($_SESSION['security_csrf'], [ $clean ]);
    
    return true;
   } else {
    return false;
   }
  }
  
  public function set($time = true) {

   $this->_token = sha1(mt_rand() . rand());
   $_SESSION['security_csrf'][$this->_token] = (time() + ($time ? $this->_time : (int) $time));
   
   return $_SESSION['security_csrf'][$this->_token];
  }
  
  public function verify($token) {
	
   return isset($_SESSION['security_csrf'][$token]);
  }
 }
}