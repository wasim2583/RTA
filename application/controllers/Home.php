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

	public function gallery(){
		$this->data['photos']=$this->crud_model->common_get2('id','files');
		$this->data['videos']=$this->crud_model->common_get2('id','da_videos_tbl');
		$this->load->view('header',$this->data);
		$this->load->view('gallery/gallery_view',$this->data);
		$this->load->view('footer',$this->data);
	}
	public function gallery_photos()
	{
		// $this->data['photos']=$this->Base_model->get_photos_by_state();
		$this->data['photos']=$this->Base_model->get_all_photos();
		$this->load->view('header',$this->data);
		$this->load->view('gallery/gallery_photos',$this->data);
		$this->load->view('footer',$this->data);
	}
	public function gallery_videos()
	{
		// $this->data['videos']=$this->Base_model->get_videos_by_state();
		$this->data['videos']=$this->Base_model->get_all_videos();
		$this->load->view('header',$this->data);
		$this->load->view('gallery/gallery_videos',$this->data);
		$this->load->view('footer',$this->data);
	}
}
