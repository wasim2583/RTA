<?php
class Member extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model', 'User_model']);	

		if(empty($this->session->userdata('state_id')))
		{
			redirect(base_url());
		}
		else
		{
			$this->state_id = $this->session->userdata('state_id');
			$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
			$this->data['states'] = $this->Base_model->get_states();
			$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
		}
	}
	public function index()
	{
		redirect(base_url().'user/Member/login');
	}
	public function registration()
	{
		$this->form_validation->set_rules('full_name', 'Full Name', 'required', array(
			'required' => 'Please provide your %s.'
		));
		$this->form_validation->set_rules('location', 'Location', 'required', array(
			'required' => 'Please select your %s.'
		));
		$this->form_validation->set_rules('email', 'E-mail ID', 'required|valid_email|is_unique[irsc_members.email]',
			array(
				'required'      => 'Please provide your valid %s',
                'is_unique'     => 'This %s already exists.'
			)
        );
		$this->form_validation->set_rules('mobile', 'Mobile Phone Number', 'required|exact_length[10]|is_unique[irsc_members.mobile]',
			array(
				'required'      => 'Please provide your valid %s',
                'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[12]', array(
			'required' => 'Please provide your %s.'
		));
		$this->form_validation->set_rules('cnfpwd', 'Confirm Password', 'required|matches[password]', array(
			'required' => 'Please provide your %s.'
		));
		if($this->form_validation->run() == TRUE)
		{
			$member = [];
			$member['full_name'] = $this->input->post('full_name');
			$member['email'] = $this->input->post('email');
			$member['mobile'] = $this->input->post('mobile');
			$member['state'] = $this->input->post('state');
			$member['location'] = $this->input->post('location');
			$member['address'] = $this->input->post('full_name');
			$member['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$member['status'] = 1;
			/*
			$config['upload_path'] = './assets/profile_pics/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 4096;
            $this->load->library('upload', $config);
        	if($this->upload->do_upload('profile_pic'))
            {
                $fdata = $this->upload->data();
                
                $member['profile_pic'] = $fdata['file_name'];
            }
            else
            {
                $member['profile_pic'] = 'parrot.jpg';
                
                $this->upload->display_errors();
            }
            */
			$member_id = $this->User_model->insert_member($member);
			if($member_id)
			{
				$this->session->set_userdata('member_id', $member_id);
				$this->session->set_flashdata('member_register_success','Member registration successful!');
				redirect(base_url().'user/Member/dashboard');
			}
			else
			{
				$this->session->set_flashdata('member_register_error','Member registration failed!');
				redirect(base_url().'Home/home');
			}
		}
		else
		{
			$this->load->view('user/member_registration', $this->data);
		}
	}
	public function login()
	{
		if($this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/dashboard');
		}
		$this->data['title'] = 'Member Login';
		
		$this->form_validation->set_rules('loginId', 'Login ID','required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$loginId = $this->input->post('loginId');
			$password = $this->input->post('password');
			$member = $this->User_model->get_member_by_loginId($loginId);
			
			if($member)
			{
				if(password_verify($password, $member->password))
				{
					$this->session->set_userdata('member_id', $member->id);
					
					redirect(base_url().'user/Member/dashboard');
				}
				else
				{
					$this->session->set_flashdata('login_error', 'Wrong Password');
					redirect(current_url());
				}
			}
			else
			{
				$this->session->set_flashdata('login_error', 'Invalid Credentials');
				redirect(current_url());
			}
		}
		else
		{
			$this->load->view('user/member_login');
		}
	}

	public function profile()
	{
		$member_id = $this->session->userdata('member_id');
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		$this->load->view('user/member', $this->data);
	}

	public function dashboard()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		$this->load->view('user/member_header', $this->data);
		$this->load->view('user/member_dashboard', $this->data);
		$this->load->view('user/member_footer', $this->data);
	}

	public function logout()
	{
		$this->session->unset_userdata('member_id');
		redirect(base_url().'Home/home');
	}
}

?>