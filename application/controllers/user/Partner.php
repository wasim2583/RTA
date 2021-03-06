<?php
class Partner extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model', 'User_model']);

		$this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
		$this->data['states'] = $this->Base_model->get_states();
		$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
	}
	public function index()
	{
		redirect(base_url().'user/Partner/login');
	}
	public function registration()
	{
		$irsc_user_role = $this->Base_model->get_irsc_user_role_by_name('Partner');
		$this->data['organization_types'] = $this->Base_model->get_organization_types();

		$this->form_validation->set_rules('full_name', 'Full Name', 'required', array(
			'required' => 'Please provide your %s.'
		));
		$this->form_validation->set_rules('organization_name', 'Organization Name', 'required', array(
			'required' => 'Please provide your %s.'
		));
		$this->form_validation->set_rules('organization_type', 'Organization Type', 'required', array(
			'required' => 'Please select your %s.'
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
			$partner = [];
			$partner['full_name'] = $this->input->post('full_name');
			$partner['organization_name'] = $this->input->post('organization_name');
			$partner['organization_type'] = $this->input->post('organization_type');
			$partner['email'] = $this->input->post('email');
			$partner['mobile'] = $this->input->post('mobile');
			$partner['state'] = $this->input->post('state');
			$partner['location'] = $this->input->post('location');
			$partner['role'] = $irsc_user_role->id;
			$partner['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$partner['status'] = 1;
			
            $partner_id = $this->User_model->insert_user($partner);

			if($partner_id)
			{
				$partner_data['partner_id'] = $partner_id;
				$this->User_model->insert_partner($partner_data);
				$this->session->set_userdata('partner_id', $partner_id);
				$this->session->set_flashdata('partner_register_success','Partner registration successful!');
				redirect(base_url().'user/Partner/dashboard');
			}
			else
			{
				$this->session->set_flashdata('partner_register_error','Partner registration failed!');
				redirect(base_url().'Home/home');
			}
		}
		else
		{
			$this->load->view('user/partner_registration', $this->data);
		}
	}

	public function login()
    {
        if($this->session->userdata('partner_id'))
        {
            redirect(base_url().'user/Partner/dashboard');
        }
        $this->data['title'] = 'Partner Login';
        
        $this->form_validation->set_rules('loginId', 'Login ID','required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE)
        {
            $loginId = $this->input->post('loginId');
            $password = $this->input->post('password');
            $role = $this->Base_model->get_irsc_user_role_by_name('Partner');
            $partner = $this->User_model->get_user_by_loginId($loginId, $role->id);
            
            if($partner)
            {
                if(password_verify($password, $partner->password))
                {
                    $this->session->set_userdata('partner_id', $partner->id);
                    
                    redirect(base_url().'user/Partner/dashboard');
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
            $this->load->view('user/partner_login');
        }
    }

    public function profile()
    {
        if( ! $this->session->userdata('partner_id'))
        {
            redirect(base_url().'user/Partner/login');
        }
        $partner_id = $this->session->userdata('partner_id');
        $this->data['title'] = 'Partner - Profile';
        $this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);

        $this->template->load('partner', 'user/partner_profile', $this->data);
    }

    public function profile_edit()
    {
        if( ! $this->session->userdata('partner_id'))
        {
            redirect(base_url().'user/Partner/login');
        }
        $partner_id = $this->session->userdata('partner_id');
        $this->data['title'] = 'Partner - Edit Profile';
        $this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);
        $this->data['organization_types'] = $this->Base_model->get_organization_types();
        // echo "<pre>";
        // print_r($this->data['partner']);
        // die;
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('organization_name', 'Organization Name', 'required');
        $this->form_validation->set_rules('organization_type', 'Organization Type', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if($this->form_validation->run() == TRUE)
        {
            $user['full_name'] = $this->input->post('full_name');
            $user['organization_name'] = $this->input->post('organization_name');
            $user['organization_type'] = $this->input->post('organization_type');
            $partner['address'] = $this->input->post('address');

            $config['upload_path'] = $this->config->item('logo_path');
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 4096;
            $this->load->library("upload", $config);
            if($this->upload->do_upload('logo'))
            {
                $fdata = $this->upload->data();
                // print_r($fdata);
                // die;
                $partner['logo'] = $fdata['file_name'];
            }
            else
            {
                $partner['logo'] = $this->data['partner']->logo;
                $this->upload->display_errors();
            }

            $partner_update_result = $this->User_model->update_partner($partner, $partner_id);
            $user_update_result = $this->User_model->update_user($user, $partner_id);
            if($partner_update_result || $user_update_result)
            {
                $this->session->set_flashdata('partner_update_success', 'Details updated..');
                redirect(base_url().'user/Partner/profile');
            }
            else
            {
                $this->session->set_flashdata('partner_update_error', 'Details NOT updated..');
                redirect(base_url().'user/Partner/profile');
                // redirect(current_url());
            }
        }
        else
        {
            $this->template->load('partner', 'user/partner_profile_edit', $this->data);
        }
    }

    public function dashboard()
    {
        redirect(base_url().'user/Partner/profile');
        /*
        if( ! $this->session->userdata('partner_id'))
		{
			redirect(base_url().'user/Partner/login');
		}
		$partner_id = $this->session->userdata('partner_id');
		$this->data['title'] = 'Partner - Dashboard';
		$this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);

        $this->template->load('partner', 'user/partner_profile', $this->data);
        */
    }

    public function events()
    {
        $this->data['title'] = 'Partner - Events';
        $this->template->load('partner', 'user/events', $this->data);
    }

    public function create_event()
    {
        $this->data['title'] = 'Partner - Create Event';
        $this->template->load('partner', 'user/create_event', $this->data);
    }

    public function offers()
    {
        $this->data['title'] = 'Partner - Offers';
        $this->template->load('partner', 'user/offers', $this->data);
    }

    public function create_offer()
    {
        $this->data['title'] = 'Partner - Create Offer';
        $this->template->load('partner', 'user/create_offer', $this->data);
    }

    public function logout()
    {
        $this->session->unset_userdata('partner_id');
        redirect(base_url().'Home/home');
    }
}

?>