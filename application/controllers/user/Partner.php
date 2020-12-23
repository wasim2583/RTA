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
		$this->form_validation->set_rules('email', 'E-mail ID', 'required|valid_email|is_unique[irsc_partners.email]',
			array(
				'required'      => 'Please provide your valid %s',
                'is_unique'     => 'This %s already exists.'
			)
        );
		$this->form_validation->set_rules('mobile', 'Mobile Phone Number', 'required|exact_length[10]|is_unique[irsc_partners.mobile]',
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
			$partner['address'] = $this->input->post('full_name');
			$partner['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$partner['status'] = 1;
			/*
			$config['upload_path'] = './assets/profile_pics/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 4096;
            $this->load->library('upload', $config);
        	if($this->upload->do_upload('profile_pic'))
            {
                $fdata = $this->upload->data();
                $partner['profile_pic'] = $fdata['file_name'];
            }
            else
            {
                $partner['profile_pic'] = 'parrot.jpg';
                $this->upload->display_errors();
            }
			*/
            $partner_id = $this->User_model->insert_partner($partner);

			if($partner_id)
			{
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
            redirect(base_url().'user/Member/dashboard');
        }
        $this->data['title'] = 'Partner Login';
        
        $this->form_validation->set_rules('loginId', 'Login ID','required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE)
        {
            $loginId = $this->input->post('loginId');
            $password = $this->input->post('password');
            $partner = $this->User_model->get_partner_by_loginId($loginId);
            
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
        $partner_id = $this->session->userdata('partner_id');
        $this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);
        $this->load->view('user/partner', $this->data);
    }

    public function dashboard()
    {
        $partner_id = $this->session->userdata('partner_id');
        $this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);
        $this->load->view('user/partner_header', $this->data);
        $this->load->view('user/partner_dashboard', $this->data);
        $this->load->view('user/partner_footer', $this->data);
    }

    public function logout()
    {
        $this->session->unset_userdata('partner_id');
        redirect(base_url().'Home/home');
    }
}

?>