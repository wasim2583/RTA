<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['crud_model', 'Base_model']);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->helper('download');

        if( ! $this->session->has_userdata('admin_email'))
        {
            redirect(base_url());
        }

        $this->state_id = $this->session->userdata('state_id');
        $this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
    }

    public function irsc_members_information()
    {
        $si = $this->uri->segment(4,0);
        // echo $si;
        // die;
        $base_url = base_url()."admin/irsc_members/irsc_members_information";
        $tr = $this->crud_model->count_num_recs('posts_tbl');
        $pp = 5;
        $config = $this->pagination1($base_url,$tr,$pp);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links($config);
        // $this->data['row'] = $this->crud_model->fetch_posts($config['per_page'],$si);
        $this->data['members'] = $this->crud_model->fetch_irsc_members($config['per_page'],$si);

        $this->load->view('superadmin_view/irsc_members/irsc_members_information_view', $this->data);
    }

    public function pagination1($base_url, $total_rows, $per_page)
    {
        $config=array(
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