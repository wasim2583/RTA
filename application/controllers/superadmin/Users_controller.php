<?php
class Users_controller extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->model('Base_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('pagination');
		$this->load->helper('download');
		if( ! $this->session->has_userdata('admin_email'))
		{
			redirect(base_url());
		}

		$this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
	}
	
	
	public function search()
	{ 
		$si=$this->uri->segment(4); //die;
		extract($_POST);
		if(isset($create)){
		 redirect('admin/users/add');
		}
		$data=array();
		if(isset($refresh)){
			redirect("admin/users/user_information");
		}
		if(isset($search_str) && !empty($search_str)){
			// $this->data['row']=$this->crud_model->search($search_str);
			$this->data['row']=$this->Base_model->search_users($search_str);
			$this->data['links']="";
			$this->load->view('superadmin_view/users/user_information_view',$this->data);
		}	 
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/users/user_information/$si");	
		}	
		if(isset($active))
		{
			$arr1 = array();				
			foreach($cnames as $name)
			{
				$arr=array("user_id"=>$name);
				$rec=array("user_status"=>1);
				$status=$this->crud_model->common_update_count($arr,"da_users_tbl",$rec);echo $v;
				if($status==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
			{
				$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
				redirect("admin/users/user_information/$si");
			}  
			else
			{
				$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
				redirect("admin/users/user_information/$si");
			}
		}
	    if(isset($inactive)){
			$arr1 = array();
			foreach($cnames as $name)
		    {
				$arr=array("user_id"=>$name);
			    $rec=array("user_status"=>2);
				$status= $this->crud_model->common_update_count($arr,"da_users_tbl",$rec);
				if($status==1){
					$arr1[] = 1;
				}
			}
			if(count($arr1)){
				$this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
				redirect("admin/users/user_information/$si");
			}  
			else{
				echo "hi";
				$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
				redirect("admin/users/user_information/$si");
			}
		}	
	    if(isset($delete)){
	        $arr1 = array();	
	        foreach($cnames as $name)
		    {
		        $arr=array("user_id"=>$name);
		        $delete_user = $this->crud_model->common_del($arr,"da_users_tbl");
		        if($delete_user === true){
			        $arr = array('created_by' => $name);
			        $delete_group = $this->crud_model->common_del($arr,"user_groups_tbl");
			        if($delete_group === true){
				        $arr = array('member_id' => $name);
			            $delete_group_member = $this->crud_model->common_del($arr,"groups_members_tbl");
					}
				}
		        if($delete_group_member==1){
					$arr1[] = 1;
				}
			}
			if(count($arr1)){
				$this->session->set_flashdata('success','The Records Deleted Successfully');
				redirect("admin/users/user_information/$si");
			} 
			else{
				$this->session->set_flashdata('failure','Try Again!');
				redirect("admin/users/user_information/$si");
			}
		}
	}

	public function update_user()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $user_id=array('user_id'=>$id);
	    if($status==2){
	       $arr=array('user_status'=>1);
		}
	    else{
		   $arr=array('user_status'=>2);
	    }
		$update = $this->crud_model->common_update($user_id,'da_users_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/users/user_information/$si");	
			}
			else{
				redirect("admin/users/user_information/$si");
			}				
		}
		else
		{
			redirect("admin/users/user_information/$si");	
		}
	}

    public function delete_user()
	{   
		$user_id = base64_decode($this->uri->segment(4));
		$si=$this->uri->segment(5);
		$where=array('user_id'=>$user_id);
		$delete_user = $this->crud_model->common_del($where,"da_users_tbl");
		if($delete_user === true){
			$where = array('created_by' => $user_id);
			$delete_group = $this->crud_model->common_del($where,"user_groups_tbl");
			if($delete_group === true){
				$where = array('member_id' => $user_id);
			    $delete_group_member = $this->crud_model->common_del($where,"groups_members_tbl");
			}
		}
		if($delete_group_member)
			{
				$this->session->set_flashdata('success','The Record deleted Successfully');
				redirect("admin/users/user_information/$si");	
			}
			else
			{
				$this->session->set_flashdata('failure','The Record Not deleted!');
				redirect("admin/users/user_information/$si");	
			}
	}
	
	public function display_single()
	{
		$this->data['roles'] = $this->Base_model->get_roles();
		$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
		$user_id = base64_decode($this->uri->segment(4));
		// $data=array('user_id'=>$user_id);
		$rec=array('user_id'=>$user_id);
		// $this->data['row']=$this->crud_model->get_single($data,'da_users_tbl');
		$this->data['row']=$this->crud_model->get_single($rec,'da_users_tbl');
	    $this->load->view('superadmin_view/users/user_update_view',$this->data);
	}

	public function update_single_user()
	{
		$id = $this->uri->segment(4);
		$s = $this->uri->segment(5);
		extract($_POST);
		if(isset($manageusers)){
			redirect('admin/users/user_information');
		}
		$config = array(
		array(
                'field' => 'name',
                'label' => 'User Name',
                'rules' => 'required|min_length[2]|regex_match[/^[a-zA-Z.\s]+$/]'
                
        ),
	
       array(
                'field' => 'mobile',
                'label' => 'Mobile',
                'rules' => 'required|numeric',
                
        ),
		
		array(
                'field' => 'status',
                'label' => 'status',
                'rules' => 'required',
                
        ),);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			redirect("admin/users/user_information/$s");
		}
	    else
	    {
			$up_where=array('user_id'=>$id);
			//$check_where1=array('mobile'=>$mobile);
			//$where=array('mobile'=>$mobile);
			$cc=array(
				'name'=>$name,
				'mobile'=>$mobile,
				'user_status'=>$status,
				'disignation'=>$disignation,
				'role'=>$role,
				'loc'=>$location
			);
			$idwhere=array(
				'user_id'=>$id,
				'name'=>$name,
				'mobile'=>$mobile,
				'user_status'=>$status
			);
			$update_response=json_decode($this->crud_model->commonUpdate('da_users_tbl',$cc,$up_where));
			if($update_response->code==200)
			{
				$this->session->set_flashdata('success','Updated Successfully');
				redirect("admin/users/user_information/$si");
			}
			else
			{
				$this->session->set_flashdata('failure','Not Updated,Try again');
				redirect("admin/users/user_information/$si");
			}
	    }
	}
	
	public function pagination1($base_url, $total_rows, $per_page)
	{
		$config=array(
                            'base_url'          => $base_url,
                            'per_page'          => $per_page,
                            'total_rows'        => $total_rows,
                            'full_tag_open'     => "<ul class='pagination'>",
                            'full_tag_close'    => '</ul>',
                            'first_link'        => 'First',
                            'last_link'         => 'Last',
                            'num_links'         => 3,
                            'next_link'         => 'Next',
                            'prev_link'         => 'Prev',
                            'first_tag_open'    => '<li>',
                            'first_tag_close'   => '</li>',
                            'last_tag_open'     => '<li>',
                            'last_tag_close'    => '</li>',
                            'next_tag_open'     => '<li>',
                            'next_tag_close'    => '</li>',
                            'prev_tag_open'     => '<li>',
                            'prev_tag_close'    => '</li>',
                            'num_tag_open'      => '<li>',
                            'num_tag_close'     => '</li>',
                            'cur_tag_open'      => "<li class='active'><a>",
                            'cur_tag_close'     => '</a></li>'
                        );
		return $config;
    }
	
	public function user_information()
	{
		$si=$this->uri->segment(4,0);
		$base_url= HTTP_BASE_PATH."admin/users/user_information";
		$tr=$this->crud_model->count_num_recs('da_users_tbl');
		$pp=20;
		$config = $this->pagination1($base_url,$tr, $pp);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->data['links']=$this->pagination->create_links();
		
		$res=$this->crud_model->get('da_users_tbl',$config['per_page'],$si);
		$res=$this->crud_model->get('da_users_tbl',$config['per_page'],$si);
		$this->data['row']=$res->result_array();
		// $this->data['row'] = $this->Base_model->get_users($this->state_id);
		$this->load->view('superadmin_view/users/user_information_view',$this->data);
	}
	
	public function add()
	{
		$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
		$this->data['roles'] = $this->Base_model->get_roles();
		$this->load->view('superadmin_view/users/user_create_view', $this->data);
	}
	
	public function insert_user()
	{
		extract($_POST);
		
		if(isset($manageusers))
		{
			redirect('admin/users/user_information');
		}
		
		$config = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required|regex_match[/^[a-zA-Z.\s]+$/]',
				'errors' => array('required' => 'Please Enter Username Here.'),
			),
			array(
				'field' => 'mobile',
				'label' => 'Mobile',
				'rules' => 'required|numeric|is_unique[da_users_tbl.mobile]',
				'errors' => array('is_unique' => 'Entered mobile already exists.'),
			),
			array(
                'field' => 'location',
                'label' => 'location',
                'rules' => 'required',
            ),
			array(
                'field' => 'designation',
                'label' => 'designation',
                'rules' => 'required',
            ),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{ 
			$this->load->view('superadmin_view/users/user_create_view');
		}
		else
		{
			$registered_date = date('Y-m-d H:i:s');
			$arr = array(
				'name' => ucfirst($name),
				'mobile' => $mobile,
				'registered_on' => $registered_date,
				'password' => md5($password),
				// 'disignation'=>ucfirst($designation),
				// 'location'=>ucfirst($location),
				'loc' => $location,
				'role' => $designation,
				'state' => $this->state_id,
				'user_status' => 1
			);
			$ins = $this->crud_model->common_insert('da_users_tbl',$arr);
			if($ins)
			{
				$this->session->set_flashdata('success','Data inserted Successfully');
			    redirect('admin/users/user_information');
			}
		}
    }
	
	public function emailCheck()
	{
		$id = $this->uri->segment(4);
		$response=array();
		$email = $this->input->post('email');
		$count=$this->crud_model->check_ajax_exist_email($email,$id);
		if($count >= 1)
		{
			$response['code']=200;
			$response['description']='Email already exists';
		}
		else
		{
			$response['code']=204;
			$response['description']='Email not exists';
		}
		echo json_encode($response);
	}
	
	public function mobileCheck()
	{
		$id = $this->uri->segment(4);
		$response=array();
		$mobile = $this->input->post('mobile');
		$count=$this->crud_model->check_ajax_exist_mobile($mobile,$id);//die;
		if($count >= 1)
		{
			$response['code']=200;
			$response['description']='Mobile already exists';
		}
		else
		{
			$response['code']=204;
			$response['description']='Mobile not exists';
		}
		echo json_encode($response);
	}
	
	public function email_mobile_check()
	{
		$id = $this->uri->segment(4);
		$response=array();
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$count=$this->crud_model->check_ajax_exist_mobile($email,$mobile,$id);//die;
		if($count >= 1)
		{
			$response['code']=200;
			$response['description']='Mobile already exists';
		}
		else
		{
			$response['code']=204;
			$response['description']='Mobile not exists';
		}
		echo json_encode($response);
		}
	public function get_exist_tutor_email()
	{	
		$response = array();	
		$email = $this->input->post('email');	
		$where= array('email'=>$email,'user_type'=>1);	
		$ownexist = $this->Common_model->commonCheck('id','rl_users_tbl',$where);	
		if($ownexist==1){		
		$response[CODE]=SUCCESS_CODE;		
		$response[MESSAGE]='Exist as Tutor';		
		$response[DESCRIPTION]='Your Not allowed to post Requirement.';	
		}
		echo json_encode($response);die;
	}

}

?>