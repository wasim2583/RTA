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
		$this->data['title'] = 'Gallery - Photos';
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
		$this->data['title'] = 'Gallery - Videos';
		// $this->data['videos']=$this->Base_model->get_videos_by_state();
		$this->data['state'] = $this->Base_model->get_state_by_id($this->session->userdata('state_id'));
		// $this->data['videos'] = $this->Base_model->get_all_videos();

		$si = $this->uri->segment(3,0);
		$base_url = base_url().'Home/gallery_videos';
		$tr = $this->crud_model->count_num_recs('da_videos_tbl');
		$pp = 4;
		$config = $this->pagination1($base_url, $tr, $pp);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->data['links'] = $this->pagination->create_links();
		$res = $this->crud_model->get('da_users_tbl',$config['per_page'],$si);
		$this->data['videos'] = $this->Base_model->get_gallery_videos($config['per_page'], $si);

		$this->template->load('site', 'front_view/gallery/gallery_videos', $this->data);
	}

	public function contact_us()
	{
		if(empty($this->session->userdata('state_id')))
		{
			redirect(base_url());
		}
		$this->data['state'] = $this->Base_model->get_state_by_id($this->session->userdata('state_id'));
		$this->template->load('site', 'front_view/contactus',$this->data);
	}

	public function pagination1($base_url, $total_rows, $per_page)
	{
		$config = array(
            'base_url'          => $base_url,
            'per_page'          => $per_page,
            'total_rows'        => $total_rows,
            'full_tag_open'     => "<ul class='pagination'>",
            'full_tag_close'    => '</ul>',
            'first_link'        => 'First',
            'last_link'         => 'Last',
            'num_links'         => 3,
            'next_link'         => 'Next',
            'prev_link'         => 'Prev',
            'first_tag_open'    => '<li>',
            'first_tag_close'   => '</li>',
            'last_tag_open'     => '<li>',
            'last_tag_close'    => '</li>',
            'next_tag_open'     => '<li>',
            'next_tag_close'    => '</li>',
            'prev_tag_open'     => '<li>',
            'prev_tag_close'    => '</li>',
            'num_tag_open'      => '<li>',
            'num_tag_close'     => '</li>',
            'cur_tag_open'      => "<li class='active'><a>",
            'cur_tag_close'     => '</a></li>'
        );
		return $config;
    }
}
