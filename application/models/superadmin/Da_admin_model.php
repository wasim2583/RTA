<?php
Class Da_admin_model extends CI_Controller
{
	
    public function login_check($table,$data)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($data);
    	$res=$this->db->get();
    	$count=$res->num_rows();
		if($count>0)
		{
			return $res->row();
		}
		else
		{
			return false;
		}
    }
    public function get_data($table,$where)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($where);
    	$res=$this->db->get();
    	$count=$res->num_rows();
		if($count>0)
		{
			return $res->result();
		}
		else
		{
			return null;
		}
    }
   
}

?>