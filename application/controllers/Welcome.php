<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model']);
		$this->load->library('form_validation');

		
	}
	
	public function index()
	{
		if($this->session->userdata('state_id') == null)
		{
			redirect('select_state');
		}
		else
		{
			$data['states'] = $this->Base_model->get_states();
			$state_id = $this->session->userdata('state_id');
			$data['state'] = $this->Base_model->get_state_by_id($state_id);
			$data['row'] = $this->Base_model->get_slides_by_state($state_id);
			$this->load->view('welcome_message', $data);
		}
	}

	public function select_state()
	{
		$data['states'] = $this->Base_model->get_states();
		$id = $this->session->userdata('state_id');
		$data['state'] = $this->Base_model->get_state_by_id($id);
		$this->form_validation->set_rules('selectedState', 'State', 'required');
		if( $this->form_validation->run() == TRUE)
		{
			$state_id = $this->input->post('selectedState');
			
			$data['state_id'] = $state_id;
			$this->session->set_userdata('state_id', $state_id);
			$this->session->unset_userdata('admin_id');
			$this->session->unset_userdata('admin_email');
			$this->session->unset_userdata('admin_name');
			redirect(base_url());
		}
		else
		{
			$this->load->view('home1',$data);
		}
	}
}
