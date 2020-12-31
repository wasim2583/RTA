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
		$this->data['title'] = 'Member - Registration';
		$irsc_user_role = $this->Base_model->get_irsc_user_role_by_name('Member');
		
		$this->form_validation->set_rules('full_name', 'Full Name', 'required', array(
			'required' => 'Please provide your %s.'
		));
		$this->form_validation->set_rules('location', 'Location', 'required', array(
			'required' => 'Please select your %s.'
		));
		$this->form_validation->set_rules('email', 'E-mail ID', 'required|valid_email|is_unique[irsc_users.email]',
			array(
				'required'      => 'Please provide your valid %s',
                'is_unique'     => 'This %s already exists.'
			)
        );
		$this->form_validation->set_rules('mobile', 'Mobile Phone Number', 'required|exact_length[10]|is_unique[irsc_users.mobile]',
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
			$member['role'] = $irsc_user_role->id;
			$member['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$member['status'] = 1;
			
			$member_id = $this->User_model->insert_user($member);
			if($member_id)
			{
				$this->session->set_userdata('member_id', $member_id);
				$member_data['member_id'] = $member_id;
				$member_data['blood_group'] = 9;
				$this->User_model->insert_member($member_data);
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
		$this->data['title'] = 'IRSC Member Login';
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
			$role = $this->Base_model->get_irsc_user_role_by_name('Member');
			$member = $this->User_model->get_user_by_loginId($loginId, $role->id);
			// print_r($member);
			// die;
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
			$this->load->view('user/member_login', $this->data);
		}
	}

	public function profile()
	{
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Profile';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		$this->load->view('user/member', $this->data);
	}

	public function profile_edit()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Edit Profile';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		$this->data['blood_groups'] = $this->Base_model->get_blood_groups();
		// echo "<pre>";
		// print_r($this->data['member']);
		// // print_r($this->config->item('profile_pic_path'));
		// die;
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('dob', 'DoB', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('blood_group', 'Blood Group', 'required');
		$this->form_validation->set_rules('emergency_contact', 'Emergency Contact Number', 'required|numeric|exact_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run() == TRUE)
		{
			$user['full_name'] = $this->input->post('full_name');
			$member['dob'] = $this->input->post('dob');
			$member['gender'] = $this->input->post('gender');
			$member['blood_group'] = $this->input->post('blood_group');
			$member['emergency_contact'] = $this->input->post('emergency_contact');
			$member['address'] = $this->input->post('address');
			$member['dob'] = $this->input->post('dob');

			$config['upload_path'] = './rta_assets/profile_pics/';
			// $config['upload_path'] = $this->config->item('profile_pic_path');
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
            	$member['profile_pic'] = $this->data['member']->profile_pic;
                $this->upload->display_errors();
            }

            $member_update_result = $this->User_model->update_member($member, $member_id);
            $user_update_result = $this->User_model->update_user($user, $member_id);
			if($member_update_result || $user_update_result)
			{
				$this->session->set_flashdata('member_update_success', 'Details updated..');
				redirect(base_url().'user/Member/dashboard');
			}
			else
			{
				$this->session->set_flashdata('member_update_error', 'Details NOT updated..');
				redirect(current_url());
			}
		}
		else
		{
			$this->load->view('user/member_header', $this->data);
			$this->load->view('user/member_profile_edit', $this->data);
			$this->load->view('user/member_footer', $this->data);
		}
	}

	public function dashboard()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Dashboard';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		// echo "<pre>";
		// print_r($this->data['member']);
		// die;
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