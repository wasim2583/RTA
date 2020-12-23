<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_videos extends CI_Controller {
    function  __construct() {
        parent::__construct();
        // Load session library
        $this->load->library('session');
         $this->load->model('crud_model');
         $this->load->model('Base_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('pagination');
        // Load file model
        $this->load->model('file');

        $this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
		$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
    }
    
    public function videos()
    {
		$this->load->view('superadmin_view/photos/upload_videos', $this->data);
	}
	
	public function index()
	{
		extract($_POST);
		if(isset($managevideos))
		{
			redirect('admin/videos/manage_videos');
		}
		$i=0;$res=0;
		$config = array(
			array(
	            'field' => 'name[]',
	            'label' => 'Title',
	            'rules' => 'required',               
	        ),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
        	echo validation_errors();
        	die;
			redirect("admin/gallery/videos");	
		}
		else
		{
			$name_count=count($name);
			for($l=0;$l<$name_count;$l++)
			{
				$videos_data[]=array(
				'title'=>$name[$l],
				'url'=>$files[$l],
				'date'=>date("Y-m-d H:i:s"),
				'location'=>$location,
				'state'=>$this->state_id,
				'status'=>1
				);
			}
			if (count($videos_data) > 0)
			{
                 $insert=  $this->crud_model->insert_batch('da_videos_tbl', $videos_data);
				if($insert)
				{
					$this->session->set_flashdata('success','Files uploaded successfully!');
					redirect("admin/videos/manage_videos");	
	            }
	            else
	            {
					$this->session->set_flashdata('failure','Some problem occurred, please try again!');
					redirect("admin/videos/manage_videos");	
				}
	        }
	    }
	}
	public function update()
	{
		$s=$this->uri->segment(4);
		$rec=array('id'=>$s);
		$this->data['row']=$this->crud_model->get_single($rec,'da_videos_tbl');
		$this->load->view('superadmin_view/photos/videos_update_view',$this->data);
	}
	public function update_videos()
	{ 
		$id = $this->uri->segment(4);
		$s = $this->uri->segment(5);
		extract($_POST);
		if(isset($managefaculty))
		{
			redirect('admin/faculty/manage_faculty');
		}
		$config = array(
				array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|regex_match[/^[a-zA-Z.\s]+$/]',
                'errors' => array(
                        'required' => 'Please Enter Username Here.',
                )
            ),
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$data=array('id'=>$s);
			$data['row']=$this->crud_model->get_single_course($s);//print_r($data);die;
			$this->load->view('superadmin_view/photos/videos_update_view',$data);
		}
		else
		{
			$up_where=array('id'=>$id);
			$videos_info = array(
				'title'=>$title,
				'url'=>$url,
				'location'=>$location,
				'state'=>$this->state_id,
				'status'=>$status
			);
			$res=$this->crud_model->common_update_count($up_where,'da_videos_tbl',$videos_info);
			if($res==1)
			{
				$this->session->set_flashdata('success','Data updated successfully');
		        redirect("admin/videos/manage_videos/$s");
			}
			else
			{
				$this->session->set_flashdata('failure','Data not updated !');
		        redirect("admin/videos/manage_videos/$s");
			}
		}
	}	
    function index1(){
        $data = array();
		extract($_POST);//echo count($_FILES['files']['tmp_name']);//echo "<pre>";print_r($_POST);print_r($_FILES);die;
        // If file upload form submitted
		if(isset($managegallery))
		{
			redirect('admin/gallery/gallery_information');
		}
        if($this->input->post('fileSubmit') && !empty($_FILES['files']['name']))
        {
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++)
            {
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = 'uploads/files/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
					$uploadData[$i]['name'] = $name[$i];//die;'jupiter'.rand(1000,9999);
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            
            if(!empty($uploadData))
            {
                $insert = $this->file->insert($uploadData);
               	if($insert)
               	{
					$this->session->set_flashdata('success','Files uploaded successfully!');
					redirect("admin/gallery/gallery_information");	
            	}
            	else
            	{
					$this->session->set_flashdata('failure','Some problem occurred, please try again!');
					redirect("admin/gallery/add");	
				}
        	}
		}
		else
		{
			$this->session->set_flashdata('failure','Please choose files!');
			redirect("admin/gallery/add");	
		}
	}
	public function pagination1($base_url, $total_rows, $per_page)
	{
		$config=array(
            'base_url'          => $base_url,
            //'uri_segment'     => 4,
            'per_page'          => $per_page,
            //'use_page_numbers'    =>true,
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
 	public function manage_videos()
 	{
		$this->data['row'] = $this->Base_model->get_videos_by_state();
		$si=$this->uri->segment(4,0);
		$base_url= HTTP_BASE_PATH."admin/videos/manage_videos";
		// $tr=$this->crud_model->count_num_recs('da_videos_tbl');
		$tr = count($this->data['row']);
		$pp=10;
		$config = $this->pagination1($base_url, $tr, $pp);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->data['links']=$this->pagination->create_links($config);
		// $res=$this->crud_model->common_fetch('da_videos_tbl',$config['per_page'],$si,'id');
		// $this->data['row']=$res->result_array	();
		$this->load->view('superadmin_view/photos/videos_information_view',$this->data);
	}
	public function search(){ 
	
		$si=$this->uri->segment(4);
		extract($_POST);
		if(isset($search_str) && !empty($search_str))
		{
			$data['row']=$this->crud_model->search_video($search_str,'da_videos_tbl');
			$data['links']="";
			$this->load->view('superadmin_view/photos/videos_information_view',$data);
		}	
		if(isset($create))
		{
			redirect('admin/gallery/videos');
		}
		$data=array();
		if(isset($refresh))
		{
			redirect("admin/videos/manage_videos");	
		}
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('failure','Please Select Atleast One Record!');
			redirect("admin/videos/manage_videos/$si");	
		}
		if(isset($active))
		{
			$arr1 = array();				
			foreach($cnames as $name)
			{
				$arr=array("id"=>$name);
				$data=array("status"=>1);
				$v=$this->crud_model->common_update_count($arr,"da_videos_tbl",$data);echo $v;
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
	        {
	        	$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
				redirect("admin/videos/manage_videos/$si");
			}
			else
	        {
	        	$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
					redirect("admin/videos/manage_videos/$si");
			}
		}
		if(isset($inactive))
		{
			$arr1 = array();	
			foreach($cnames as $name)
			{		
				$arr=array("id"=>$name);
				$data=array("status"=>2);
			
				$v2= $this->crud_model->common_update_count($arr,"da_videos_tbl",$data);
				if($v2==1)
				{
					$arr1[] = 1;
				}
			}
			if(count($arr1))
            {
            	$this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
    			redirect("admin/videos/manage_videos/$si");
            }  
            else
            {
				echo "hi";
            	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
					redirect("admin/videos/manage_videos/$si");
			}
		}	
		if(isset($delete))
		{
			$arr1 = array();	
			foreach($cnames as $name)
			{
				$arr=array("id"=>$name);
				$v=$this->crud_model->common_del($arr,"da_videos_tbl");
				if($v==1)
				{
					$arr1[] = 1;
				}
			}
			if(count($arr1))
	        {

	        	$this->session->set_flashdata('success','The Records Deleted Successfully');
				redirect("admin/videos/manage_videos/$si");
	        }  
	        else
	        {
	        	$this->session->set_flashdata('failure','Try Again!');
				redirect("admin/videos/manage_videos/$si");
			}
		}
	}

	public function update_status()
	{
		$id = $this->uri->segment(4);
		$status= $this->uri->segment(5);
		$si= $this->uri->segment(6);
		$id=array('id'=>$id);//die;
		if($status==2)
		{
			$arr=array('status'=>1);
		}
		else{
			$arr=array('status'=>2);
		}
		$update = $this->crud_model->common_update($id,'da_videos_tbl',$arr);
		if($update)
		{
			if($status==1)
			{
				redirect("admin/videos/manage_videos/$si");	
			}
			else
			{
				redirect("admin/videos/manage_videos/$si");
			}				
		}
		else
		{
			redirect("admin/videos/manage_videos/$si");	
		}
	}

	public function delete_videos()
	{
		$s=$this->uri->segment(4);
		$si=$this->uri->segment(5);	
		$where=array('id'=>$s);
		$rec=$this->crud_model->common_del($where,'da_videos_tbl');
		if($rec)
        {
        	$this->session->set_flashdata('success','The Record deleted Successfully');
			redirect("admin/videos/manage_videos/$si");	
        }
        else
        {
        	$this->session->set_flashdata('failure','The Record Not deleted!');
			redirect("admin/videos/manage_videos/$si");
		}
	}
}