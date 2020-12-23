<?php
class Auth{
  protected $CI;
  public function __construct() {
    $this->CI = & get_instance();
  }
  public function check_user_login(){
	  
      if(!$this->CI->session->userdata('admin_id'){
          redirect(base_url()."admin");    
      }
  }
}
?>