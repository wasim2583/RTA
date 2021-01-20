<?php
class Member extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model', 'User_model']);
		$this->load->helper(['date']);

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
		// $this->form_validation->set_rules('email', 'E-mail ID', 'required|valid_email|is_unique[irsc_users.email]', array('required' => 'Please provide your valid %s', 'is_unique' => 'This %s already exists.'));
		$this->form_validation->set_rules('mobile', 'Mobile Phone Number', 'required|numeric|exact_length[10]|is_unique[irsc_users.mobile]',
			array(
				'required' => 'Please provide your valid %s',
				'numeric' => 'Mobile number should be numeric',
				'is_unique' => 'This %s already exists.'));
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
			// $member['email'] = $this->input->post('email');
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
				$activation_method = 'send_mobile_activation';
				$activation_method(MEMBER, $this->input->post('mobile'));
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
		// $this->load->view('user/member', $this->data);
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Profile';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		$this->template->load('member', 'user/member_profile', $this->data);
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
		
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('dob', 'DoB', 'required');
		// $this->form_validation->set_rules('gender', 'Gender', 'required');
		// $this->form_validation->set_rules('blood_group', 'Blood Group', 'required');
		// $this->form_validation->set_rules('emergency_contact', 'Emergency Contact Number', 'required|numeric|exact_length[10]');
		// $this->form_validation->set_rules('aadhaar', 'Aadhaar Number', 'numeric|exact_length[12]');
		// $this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run() == TRUE)
		{
			$user['full_name'] = $this->input->post('full_name');
			$member['dob'] = $this->input->post('dob');
			$member['gender'] = $this->input->post('gender');
			$member['blood_group'] = $this->input->post('blood_group');
			$member['emergency_contact'] = $this->input->post('emergency_contact');
			$member['aadhaar'] = $this->input->post('aadhaar');
			$member['address'] = $this->input->post('address');
			$member['dob'] = $this->input->post('dob') ?? null;

			$config['upload_path'] = './rta_assets/member/profile_pics/';
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
				redirect(base_url().'user/Member/profile');
			}
			else
			{
				$this->session->set_flashdata('member_update_error', 'Details NOT updated..');
				// redirect(current_url());
				redirect(base_url().'user/Member/profile');
			}
		}
		else
		{
			$this->template->load('member', 'user/member_profile_edit', $this->data);
		}
	}

	public function events()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Events';
		$this->template->load('member', 'coming_soon', $this->data);
	}
	
	public function offers()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Offers';
		$this->template->load('member', 'coming_soon', $this->data);
	}

	public function dashboard()
	{
		redirect(base_url().'user/Member/profile');
		/*
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Dashboard';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);
		
		$this->template->load('member', 'user/member_dashboard', $this->data);
		*/
	}

	public function member_dl()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Driving Licence';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);

		$this->template->load('member', 'user/member_driving_licence', $this->data);
	}

	public function update_dl()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Driving Licence';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);

		$this->form_validation->set_rules('dl_no', 'Driving Licence Number', 'required|alpha_numeric');
		// 
		if($this->input->post('submit') && ($this->form_validation->run() == true))
		{
			
			$member['dl_no'] = $this->input->post('dl_no');
			$config['upload_path'] = './rta_assets/member/driving_licence/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|doc|pdf';
	        $config['max_size'] = 4096;
	        $this->load->library('upload', $config);
	    	if($this->upload->do_upload('dl_doc'))
	        {
	            $fdata = $this->upload->data();                
	            $member['dl_doc'] = $fdata['file_name'];
	        }
	        else
	        {
	        	$member['dl_doc'] = $this->data['member']->dl_doc;
	            $this->upload->display_errors();
	        }

	        $member_update_result = $this->User_model->update_member($member, $member_id);
	        // $user_update_result = $this->User_model->update_user($user, $member_id);
			if($member_update_result)
			{
				$this->session->set_flashdata('member_update_success', 'Driving Licence uploaded..');
				redirect(base_url().'user/Member/member_dl');
			}
			else
			{
				$this->session->set_flashdata('member_update_error', 'Driving Licence NOT uploaded..');
				redirect(base_url().'user/Member/member_dl');
			}
		}
		else
		{
			$this->template->load('member', 'user/member_driving_licence_edit', $this->data);
		}
	}

	public function member_insurance()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Insurance';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);

		$this->template->load('member', 'user/member_insurance', $this->data);
	}

	public function update_insurance()
	{
		if( ! $this->session->userdata('member_id'))
		{
			redirect(base_url().'user/Member/login');
		}
		$member_id = $this->session->userdata('member_id');
		$this->data['title'] = 'Member - Insurance';
		$this->data['member'] = $this->User_model->get_member_by_id($member_id);

		$this->form_validation->set_rules('policy_no', 'Policy Number', 'required');
		$this->form_validation->set_rules('insurance_exp_date', 'Policy Valid Upto', 'required');
		// 
		if($this->input->post('submit') && ($this->form_validation->run() == true))
		{
			
			$member['policy_no'] = $this->input->post('policy_no');
			$member['insurance_exp_date'] = $this->input->post('insurance_exp_date');
			$config['upload_path'] = './rta_assets/member/insurance/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|doc|pdf';
	        $config['max_size'] = 4096;
	        $this->load->library('upload', $config);
	    	if($this->upload->do_upload('insurance_doc'))
	        {
	            $fdata = $this->upload->data();                
	            $member['insurance_doc'] = $fdata['file_name'];
	        }
	        else
	        {
	        	$member['insurance_doc'] = $this->data['member']->insurance_doc;
	            $this->upload->display_errors();
	        }

	        $member_update_result = $this->User_model->update_member($member, $member_id);
	        // $user_update_result = $this->User_model->update_user($user, $member_id);
			if($member_update_result)
			{
				$this->session->set_flashdata('member_update_success', 'Insurance updated..');
				redirect(base_url().'user/Member/member_insurance');
			}
			else
			{
				$this->session->set_flashdata('member_update_error', 'Insurance details NOT updated..');
				redirect(base_url().'user/Member/member_insurance');
			}
		}
		else
		{
			$this->template->load('member', 'user/member_insurance_edit', $this->data);
		}
	}

	public function member_puc()
    {
        if( ! $this->session->userdata('member_id'))
        {
            redirect(base_url().'user/Member/login');
        }
        $member_id = $this->session->userdata('member_id');
        $this->data['title'] = 'Member - Insurance';
        $this->data['member'] = $this->User_model->get_member_by_id($member_id);

        $this->template->load('member', 'user/member_puc', $this->data);
    }

    public function update_puc()
    {
        if( ! $this->session->userdata('member_id'))
        {
            redirect(base_url().'user/Member/login');
        }
        $member_id = $this->session->userdata('member_id');
        $this->data['title'] = 'Member - Insurance';
        $this->data['member'] = $this->User_model->get_member_by_id($member_id);

        $this->form_validation->set_rules('puc_exp_date', 'PUC Valid Upto', 'required');
        // 
        if($this->input->post('submit') && ($this->form_validation->run() == true))
        {
            $member['puc_exp_date'] = $this->input->post('puc_exp_date');
            $config['upload_path'] = './rta_assets/member/puc/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|doc|pdf';
            $config['max_size'] = 4096;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('puc_doc'))
            {
                $fdata = $this->upload->data();                
                $member['puc_doc'] = $fdata['file_name'];
            }
            else
            {
                $member['puc_doc'] = $this->data['member']->puc_doc;
                $this->upload->display_errors();
            }

            $member_update_result = $this->User_model->update_member($member, $member_id);
            // $user_update_result = $this->User_model->update_user($user, $member_id);
            if($member_update_result)
            {
                $this->session->set_flashdata('member_update_success', 'PUC Details updated..');
                redirect(base_url().'user/Member/member_puc');
            }
            else
            {
                $this->session->set_flashdata('member_update_error', 'PUC details NOT updated..');
                redirect(base_url().'user/Member/member_puc');
            }
        }
        else
        {
            $this->template->load('member', 'user/member_puc_edit', $this->data);
        }
    }

	public function logout()
	{
		$this->session->unset_userdata('member_id');
		redirect(base_url().'Home/home');
	}
}

?>