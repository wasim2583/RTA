<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['crud_model', 'Base_model', 'User_model']);
		$this->load->library('form_validation');
		$this->data['states'] = $this->Base_model->get_states();
	}

	public function index()
	{
		$this->load->view('front_view/index', $this->data);
	}

	public function home()
	{
		if ($this->uri->segment(3))
		{
			$state_id = $this->uri->segment(3);
			$this->session->set_userdata('state_id', $state_id);
		}
		elseif ( ! empty($this->session->userdata('state_id')))
		{
			$state_id = $this->session->userdata('state_id');
		}
		else
		{
			redirect(base_url());
		}
		
		$this->data['state'] = $this->Base_model->get_state_by_id($state_id);
		$this->data['slides'] = $this->Base_model->get_slides_by_state($state_id);
		$this->template->load('site', 'front_view/home', $this->data);
	}

	public function coming_soon()
	{
		$state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($state_id);
		$this->data['slides'] = $this->Base_model->get_slides_by_state($state_id);
		$this->template->load('site', 'coming_soon', $this->data);
	}
/*
	public function gallery(){
		$this->data['photos']=$this->crud_model->common_get2('id','files');
		$this->data['videos']=$this->crud_model->common_get2('id','da_videos_tbl');
		$this->load->view('header',$this->data);
		$this->load->view('gallery/gallery_view',$this->data);
		$this->load->view('footer',$this->data);
	}
*/
	public function gallery_photos()
	{
		if(empty($this->session->userdata('state_id')))
		{
			redirect(base_url());
		}
		// $this->data['photos']=$this->Base_model->get_photos_by_state();
		$this->data['state'] = $this->Base_model->get_state_by_id($this->session->userdata('state_id'));
		$this->data['photos']=$this->Base_model->get_all_photos()->result();
		$this->template->load('site', 'front_view/gallery/gallery_photos', $this->data);
	}

	public function gallery_videos()
	{
		if(empty($this->session->userdata('state_id')))
		{
			redirect(base_url());
		}
		// $this->data['videos']=$this->Base_model->get_videos_by_state();
		$this->data['state'] = $this->Base_model->get_state_by_id($this->session->userdata('state_id'));
		$this->data['videos']=$this->Base_model->get_all_videos();
		$this->template->load('site', 'front_view/gallery/gallery_videos', $this->data);
	}

	public function contact_us()
	{
		if(empty($this->session->userdata('state_id')))
		{
			redirect(base_url());
		}
		$this->template->load('site', 'front_view/contactus',$this->data);
	}
}
