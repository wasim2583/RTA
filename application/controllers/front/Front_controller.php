<?php
class Front_controller extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->model('Base_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
		if($this->session->userdata('state_id') == null)
		{
			redirect(base_url());
		}
		else
		{
			$this->state_id = $this->session->userdata('state_id') ?? $this->config->item('default_state_id');
			$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
			$this->data['states'] = $this->Base_model->get_states();
			$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
		}
		
	}
	public function Contact_us()
	{
		$this->load->view('front_view/Contact_us',$this->data);
	}

	public function Events()
	{
		$this->load->view('front_view/Events',$this->data);
	}

	public function about_us()
	{
		$this->load->view('front_view/about_us',$this->data);
	}
	public function gallery(){
		$this->data['row']=$this->crud_model->common_get2('id','files');
		$this->data['videos']=$this->crud_model->common_get2('id','da_videos_tbl');
		$this->load->view('front_view/gallery_view',$this->data);
	}
	public function gallery_photos()
	{
		// $this->data['row']=$this->crud_model->common_get2('id','files');
		$this->data['row']=$this->Base_model->get_photos_by_state();
		// $this->data['videos']=$this->crud_model->common_get2('id','da_videos_tbl');
		$this->load->view('front_view/gallery_photos',$this->data);
	}
	public function gallery_videos()
	{
		// $this->data['row']=$this->crud_model->common_get2('id','files');
		$this->data['row']=$this->Base_model->get_videos_by_state();
		// $this->data['videos']=$this->crud_model->common_get2('id','da_videos_tbl');
		$this->load->view('front_view/gallery_videos',$this->data);
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