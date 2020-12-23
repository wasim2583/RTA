<?php
Class Without_license_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->db->query("SET time_zone = '+05:30'");
    }
	public function insert_license_case($table,$data){
		//echo 'hi';print_r($data);
    $res=$this->db->insert($table,$data);
	if($res){
		 return $this->db->insert_id();
	}
	else{
		return null;
	}
	}
	 public function insert_drivers($table,$data){
    $res=$this->db->insert_batch($table,$data);
    return $res;
	}
}

?>