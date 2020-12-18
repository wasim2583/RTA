<?php
class Member extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model', 'User_model']);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
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
		redirect(base_url().'user/Member/registration');
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
		// $this->form_validation->set_rules('profile_pic', 'Profile Pic', 'required');
		if($this->form_validation->run() == TRUE)
		{
			$member = $this->input->post();
			$member['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

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
			$result = $this->User_model->insert_member($member);
			if($result == TRUE)
			{
				$this->session->set_flashdata('member_register_success','Member registration successful!');
				redirect(base_url().'user/Member/profile/'.$result);
			}
			else
			{
				$this->session->set_flashdata('member_register_error','Member registration failed!');
				redirect(base_url().'Home/home');
			}
		}
		else
		{
			$this->load->view('user/membership', $this->data);
		}
	}
	public function login()
	{
		if($this->session->userdata('member_login')){
				redirect('dashboard');
		}
		$this->data['title'] = 'Member Login';
			
		// validate form input
		$this->form_validation->set_rules('loginId', 'Login ID','required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$loginId = $this->input->post('loginId');
			$password = $this->input->post('password');//password_hash($this->input->post('password'),PASSWORD_DEFAULT);
			$user = $this->User_model->get_member_by_loginId($loginId);
			
			if($user)
			{
				if(password_verify($password, $user->password))
				{
					$this->session->set_userdata('member_id', $user->id);
					$member = $this->User_model->get_member_by_id($user->id);
					if( ! $user->status)
					{
						$message = 'It seems your account is inactive please <a href="'.$this->config->item('base_url').'/auth/resend_activation_code">Click Here</a> to activate';
						$this->session->set_flashdata('login_status', $message);
					}
					redirect('dashboard');
				}
				else
				{
					$this->session->set_flashdata('login_error', 'Wrong Password');
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

	public function profile($id)
	{
		$this->data['member'] = $this->User_model->get_member_by_id($id);
		$this->load->view('user/member', $this->data);
	}

	public function dashboard()
	{
		$this->load->view('user/member_header');
		$this->load->view('user/member_dashboard');
		$this->load->view('user/member_footer');
	}
}

?>