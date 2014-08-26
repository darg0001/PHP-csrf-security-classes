<?php
namespace security {
	
 class CSRF {
   
   private $_tokens = [];
   
   public function create() {
    /*
	* @By: Olivier Beg
	* @Desc: Generate a token to verificate that the POST/GET request is legit.
	*/
	
	$this->_tokens[] = sha1(mt_rand() . rand() . md5($_SERVER['REMOTE_ADDR']));
   }
   
   public function verificate($token) {
	
	return (isset($this->_tokens[$token]) ? true : false);
   }
 }
}