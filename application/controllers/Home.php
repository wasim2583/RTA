<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model']);
		$this->load->library('form_validation');
		
		$this->data['states'] = $this->Base_model->get_states();
	}

	public function index()
	{
		$this->form_validation->set_rules('state', 'State', 'required');
		if($this->form_validation->run() == TRUE)
		{
			$state_id = $this->input->post('state');
			$this->session->set_userdata('state_id', $state_id);
			redirect('Home/home');
		}
		else
		{
			$this->load->view('index', $this->data);
		}
	}

	public function home()
	{
		if($this->session->userdata('state_id'))
		{
			$state_id = $this->session->userdata('state_id');
		}
		else
		{
			redirect(base_url());
		}
		
		$this->data['state'] = $this->Base_model->get_state_by_id($state_id);
		$this->data['slides'] = $this->Base_model->get_slides_by_state($state_id);
		$this->load->view('header');
		$this->load->view('home', $this->data);
		$this->load->view('footer');
	}	
}
