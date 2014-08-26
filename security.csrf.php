<?php
namespace security {

 class CSRF {
   
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
  
  public function create() {
  
   /*
   * @By: Olivier Beg
   * @Desc: Generate a token to verify that the POST/GET request is legit.
   */
	
   $this->_tokens[sha1(mt_rand() . rand() . md5($_SERVER['REMOTE_ADDR']))] = (time() + $this->_time);
   
   return end($this->_tokens);
  }
  
  public function verify($token) {
	
   return isset($this->_tokens[$token]);
  }
 }
}