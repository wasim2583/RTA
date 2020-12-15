<?php
class User_controller extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
	}
	public function registration(){
		$this->load->view('user_view/registration_view');
	}
	public function validate_login_data(){
		extract($_POST);
		$config = array(
		array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|regex_match[/^[a-zA-Z.\s]+$/]',
                'errors' => array(
                        'required' => 'Please Enter Username Here.',
                ),
        ),
        array(
                'field' => 'pwd',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Please Enter Password Here.',
                ),));
				$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
                { 
					$this->load->view('superadmin_view/login_view');
	}
	else{
		$arr=array('admin_name'=>$username,'admin_password'=>$pwd);
		$data=$this->crud_model->where_count($arr,'su_admin_tbl');
		if($data==1){
		$d=$this->crud_model->where_get1($arr,'su_admin_tbl');
	    $this->session->set_userdata('admin_name',$d['admin_name']);
		 $this->session->set_userdata('admin_email',$d['admin_email']);
		 $ip_addr = $_SERVER['REMOTE_ADDR'];
		 $login_date = date('Y-m-d H:i:s');
		 $arr=array('admin_last_login_date'=>$login_date,'admin_last_login_ip'=>$ip_addr);
		 $cc=array('admin_id'=>1);
		$up = $this->crud_model->common_update($cc,'su_admin_tbl',$arr);
		if($up==1)
		 echo "Dear Admin  now U R Login Successfully ";
	} 
		
	}}
	public function set(){
		$this->session->set_userdata('name',"sindu");
	}
	public function get(){
		 echo $this->session->userdata('name');
	}
}

?>