<?php
class Partner extends CI_Controller{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model', 'User_model']);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');

		$this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
		$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
	}
	public function index()
	{
		redirect(base_url().'user/Partner/registration');
	}
	public function registration()
	{
		$this->form_validation->set_rules('full_name', 'Full Name', 'required', array(
			'required' => 'Please provide your %s.'
		));
		$this->form_validation->set_rules('organization_name', 'Organization Name', 'required', array(
			'required' => 'Please provide your %s.'
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
		// $this->form_validation->set_rules('profile_pic', 'Profile Pic', 'required');
		if($this->form_validation->run() == TRUE)
		{
			$partner = $this->input->post();
			$partner['state'] = $this->state_id;
			$config['upload_path'] = './assets/profile_pics/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 100;
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
            $result = $this->User_model->insert_partner($partner);

			if($result)
			{
				$this->session->set_flashdata('partner_register_success','Member registration successful!');
				redirect(base_url().'Home/home');
			}
			else
			{
				$this->session->set_flashdata('partner_register_error','Member registration failed!');
				redirect(base_url().'Home/home');
			}
		}
		else
		{
			$this->load->view('user/partnership', $this->data);
		}
	}	
}

?>