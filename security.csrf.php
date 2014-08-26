<?php
namespace security {

 class CSRF {
  
  private $_token;
  private $_tokens = [];
  private $_time = 3600;

  
  public function set_time($time) {
    
	/*
    * @variables: Time is in seconds;
    * @by: Olivier Beg
    * @Desc: Set the time until the CSRF token expires.
    */
	
    if(is_int($time) || is_numeric($time)) {
		
		$this->_time = $time;
		
		return true;
    }

   return false;
  }
  
  public function delete($token) {
	
   if($this->verify($token)) {
	
    array_diff($this->_tokens, [ $token ]);
	
	$clean = [];
	
	foreach($this->_tokens AS $token => $time) {
		
		if($time >= time()) {
			$clean[] = $token;
		}
	}
	
	array_diff($this->_tokens, [ $clean ]);
	
	return true;
   } else {
    return false;
   }
  }
  
  public function create($time = true) {
  
   /*
   * @By: Olivier Beg
   * @Desc: Generates a token to verify that the POST/GET request is legit and returns the last created token.
   */
   $this->_token = sha1(mt_rand() . rand() . md5($_SERVER['REMOTE_ADDR']));
   $this->_tokens[$this->_token] = (time() + ($time ? $this->_time : (int) $time));
   
   return $this->_tokens[$this->_token];
  }
  
  public function verify($token) {
	
   return isset($this->_tokens[$token]);
  }
 }
}