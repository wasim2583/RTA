<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

  function getUserDetails(){
 
    $response = array();
 
    // Select record
    $this->db->select('username,name,gender,email');
    $q = $this->db->get('users');
    $response = $q->result_array();
 
    return $response;
  }
  function mocktest_export1(){
 
    $response = array();
 
    // Select record
   // $this->db->select('name,dob,mobile,email');
   $gend = "gender WHEN 1 THEN 'Male' WHEN 2 THEN 'FEMale' WHEN 3 THEN 'OTHERS'";
   $cols = 'name,dob,gender,mobile,email,address,ice_contact_1,ice_contact_2,medical_conditions,blood_group
   ,agree_terms,agree_support,agree_communication,password,verification_code,last_login_date,registered_on,membership_date,
   last_login_ip,user_status,mobile_verified_status,otp';
   $this->db->select($cols);
    $q = $this->db->get('su_users_tbl');
    $response = $q->result_array();
 
    return $response;
  }
  function faqs_export(){
 
    $response = array();
 
    // Select record
    $this->db->select('faq_title,faq_description,faq_date,faq_status');
    $q = $this->db->get('su_faq_tbl');
    $response = $q->result_array();
 
    return $response;
  }
   function mocktest_export(){
	   $response = array();
 $response=$this->db->select('m.question_id,m.question,m.answer,m.written_on,m.status,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							  ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id')
							 ->order_by('m.question_id','asc')
							  ->get()->result_array();
				return $response;
  }
   function hospitals_export(){
 
    $response = array();
 
    // Select record
    $this->db->select('hospital_name,address_one,adress_two,city,district,state,pincode,stdcode,phone_number,detailed_address,status');
    $q = $this->db->get('su_corporate_hospital_tbl');
    $response = $q->result_array();
 
    return $response;
  }
   function careteam_export(){
 
    $response = array();
 
    // Select record
    $this->db->select('name,email,mobile,id_proof,address,alternative_cont_num,city,designation,status');
    $q = $this->db->get('su_care_team_tbl');
    $response = $q->result_array();
 
    return $response;
  }
  function ambulance_export(){
 
    $response = array();
 
    // Select record
    $this->db->select('user_id,name,mobile,address,message,requested_on,req_status');
    $q = $this->db->get('su_ambulance_req_tbl');
    $response = $q->result_array();
 
    return $response;
  }
  public function export_csv_where($table_name,$filename,$order_by)
    {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $this->db->select('*')->from($table_name);
       // $this->db->where($data);
		//$this->db->limit('1');
        $query = $this->db->order_by($order_by,'desc')->get();
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);
    }
	public function dis(){
	
	return	$this->db->get('tbl_user')->result_array();;
	}

}