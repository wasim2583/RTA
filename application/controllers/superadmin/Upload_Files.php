<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_Files extends CI_Controller {
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
    }
    public function gallery()
    {
    	$this->data['locations'] = $this->Base_model->get_locations_by_state($this->state_id);
		$this->load->view('superadmin_view/photos/gallery_upload', $this->data);
	}
	public function index()
	{
		extract($_POST);
		if(isset($managegallery))
		{
			redirect('admin/gallery/gallery_information');
		}
		$i=0;
		$res=0;
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
        	echo validation_errors();die;
			redirect("admin/gallery/add");
		}
		else
		{
			if(count($_FILES['files']['name'])>0)
			{   
	 			$multiple_image_count = count($_FILES['files']['name']);
   				if ($multiple_image_count > 0)
   				{
                	$insert_image_array = array();
                	for ($k = 0; $k < $multiple_image_count; $k++)
                	{
                    	if (!empty($_FILES['files']['name'][$k]))
                    	{
	                        $file_name = $_FILES['files']['name'][$k];
	                        $im_name = 'mul_product_';
	                        // $extension = fileExtension($file_name);
	                        $filepath = $_FILES['files']['tmp_name'][$k];
	                        $mul_extension = fileExtension($file_name);
	                        $filename = 'RTA'.rand(1000,9999) . '.' . $mul_extension;
	                       // $e = $filepath . "/uploads/products/original/$filename";
	                        //  echo  $moved = move_uploaded_file($e); / Original image /exit
	                        $target_path = "uploads/files/";
	                        $target_path = $target_path . $filename;
	                        $res=move_uploaded_file($_FILES['files']['tmp_name'][$k], $target_path);
	                        if($res)
	                        {
							 // $fileData = $this->upload->data();
					// $uploadData[$i]['name'] = $name[$i];//die;'jupiter'.rand(1000,9999);
                    // $uploadData[$i]['file_name'] = $filename;
                    // $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
					//$uploaded_on=date("Y-m-d H:i:s");
					//$data=array('name'=>$name,'file_name'=>$file_name,'uploaded_on'=>$uploaded_on);
				  //$insert = $this->file->insert($uploadData);
				  				$insert_image_array[] = array(
	                            'name' =>  $name[$k],
	                            'file_name' => $filename,
								'description' => $description,
								'location' => $location,
								'state' => $this->state_id,
								'uploaded_on'=>date("Y-m-d H:i:s")
								);
                        	}
				 		}
            		}
					if (count($insert_image_array) > 0)
					{
                 		$insert=  $this->crud_model->insert_batch('files', $insert_image_array);
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
			}
		}
	}
	public function update_gallery_data()
	{
		$id=$this->uri->segment(4);
		$si=$this->uri->segment(5);
	 	$table='files';
	 	$where_data=array('id'=>$id);
	 	$data['res']=$this->crud_model->get_single($where_data,$table);
	 	//$this->load->view('superadmin_view/update_gallery',$data);
	 	$state_id = $this->session->userdata('state_id');
	 	$data['state'] = $this->Base_model->get_state_by_id($state_id);
	 	extract($_POST);
	 	if(isset($submit))
	 	{
	 		$arr = array(
	 			array(
	 				'field' => 'name',
					'label' => '',
					'rules' => 'required|regex_match[/^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/]',
					'errors' => array(
						'required' => 'Slider title is required',
						'regex_match' => 'Slide title allows only alphabets'
					)
				)
			);
	 		$this->form_validation->set_rules('name','Name','required');
	 		 if(!empty($_FILES['photo']['name'])){ 
			 // $filename = $_FILES['photo']['name'];
			  // $mul_extension = fileExtension($file_name);echo $mul_extension;
			  // $filename = 'jupiter'.rand(1000,9999) . '.' . $mul_extension;
			   
                $config['upload_path'] = 'uploads/files/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = 'jupiter'.rand(1000,9999);
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('photo')){
                    $uploadData = $this->upload->data();
                   $photo = $uploadData['file_name'];
                }else{
                    $photo = $old_image;
                }
            }else{
				
                $photo = $old_image;
            }
			$up_where=array('id'=>$id);
		$data=array('name'=>$name,'file_name'=>$photo,'status'=>$status);
		//$data=array('emp_code'=>$code,'emp_name'=>$name,'emp_email'=>$email,'emp_mobile'=>$mobile);
		$res=$this->crud_model->common_update_count($up_where,'files',$data);//echo $res;die;
			if($res==1){
					$this->session->set_flashdata('success','Data updated successfully');
					redirect("admin/gallery/gallery_information/$si");
			}
			else{
					$this->session->set_flashdata('failure','Data not updated !');
					redirect("admin/gallery/gallery_information/$si");
			}
		}
	 		else
	 		{
	 			$this->load->view('superadmin_view/photos/update_gallery',$data);
	 		}
	 	}
	 	
    function index1(){
        $data = array();
		extract($_POST);//echo count($_FILES['files']['tmp_name']);//echo "<pre>";print_r($_POST);print_r($_FILES);die;
        // If file upload form submitted
		if(isset($managegallery)){
			redirect('admin/gallery/gallery_information');
		}
        if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
			
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
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
            
            if(!empty($uploadData)){
                // Insert files data into the database
                $insert = $this->file->insert($uploadData);
                
                // Upload status message
               if($insert){
				$this->session->set_flashdata('success','Files uploaded successfully!');
				redirect("admin/gallery/gallery_information");	
            }else{
				$this->session->set_flashdata('failure','Some problem occurred, please try again!');
				redirect("admin/gallery/add");	
			}
        }
        
        // Get files data from the database
        //$data['files'] = $this->file->getRows();
        
        // Pass the files data to view
        //$this->load->view('upload_files/index', $data);
		}else{
			$this->session->set_flashdata('failure','Please choose files!');
				redirect("admin/gallery/add");	
	}
}
public function pagination1($base_url, $total_rows, $per_page){
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
	public function gallery_information()
	{
		$si=$this->uri->segment(4,0);
		$base_url= HTTP_BASE_PATH."admin/gallery/gallery_information";
		// $this->data['row'] = $this->Base_model->get_photos_by_state();
		$this->data['row'] = $this->Base_model->get_all_photos();
		// $tr=$this->crud_model->count_num_recs('files');
		$tr = count($this->data['row']);
		$pp=10;
		$config = $this->pagination1($base_url, $tr, $pp);
	 	$this->load->library('pagination');
	 	$this->pagination->initialize($config);
	 	$this->data['links']=$this->pagination->create_links($config);
	 	$this->data['row'] = $this->crud_model->common_fetch('files',$config['per_page'],$si,'id');		
		$this->load->view('superadmin_view/photos/gallery_information_view',$this->data);
	}

	public function search()
	{
		$si=$this->uri->segment(4); //die;
		extract($_POST);
		if(isset($search_str) && !empty($search_str))
		{
			$data['row']=$this->crud_model->search_gallery($search_str,'files');
			$data['links']="";
			$this->load->view('superadmin_view/photos/gallery_information_view',$data);
		}
		if(isset($create))
		{
			redirect('admin/gallery/add');
		}
		$data=array();
		if(isset($refresh))
		{
			redirect("admin/gallery/gallery_information");	
		}
   
		if(empty($cnames) && empty($search_str))
		{
			$this->session->set_flashdata('failure','Please Select Atleast One Record!');
			redirect("admin/gallery/gallery_information/$si");	
		}

		if(isset($active))
		{//extract($_POST);print_r($_POST);die;
			$arr1 = array();				
			foreach($cnames as $name)
			{
				$arr=array("id"=>$name);
				$data=array("status"=>1);
				$v=$this->crud_model->common_update_count($arr,"files",$data);echo $v;
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}
			if(count($arr1)>0)
	        {
	        	$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
				redirect("admin/gallery/gallery_information/$si");
			}  
	        else
	        {
	        	$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
					redirect("admin/gallery/gallery_information/$si");
			}
		}
		if(isset($inactive))
		{
			$arr1 = array();	
			foreach($cnames as $name)
			{		
				$arr=array("id"=>$name);
				$data=array("status"=>2);
			
				$v2= $this->crud_model->common_update_count($arr,"files",$data);
				if($v2==1)
				{
					$arr1[] = 1;
				}
			}
			if(count($arr1))
	        {
	        	$this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
				redirect("admin/gallery/gallery_information/$si");
	        }
	        else
	        {
				echo "hi";
	        	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
					redirect("admin/gallery/gallery_information/$si");
			}
		}	
		if(isset($delete))
		{
			$arr1 = array();	
			foreach($cnames as $name)
			{
				$arr=array("id"=>$name);
				$v=$this->crud_model->common_del($arr,"files");
				if($v==1)
				{
					$arr1[] = 1;
				}
			}
			if(count($arr1))
	        {
	        	$this->session->set_flashdata('success','The Records Deleted Successfully');
				redirect("admin/gallery/gallery_information/$si");
	        }  
	        else
	        {
	        	$this->session->set_flashdata('failure','Try Again!');
					redirect("admin/gallery/gallery_information/$si");
			}
		}
	}
	public function update_status()
	{
		$id = $this->uri->segment(4);
		$status= $this->uri->segment(5);
		$si= $this->uri->segment(6);
		$id=array('id'=>$id);//die;
		if($status==2){
		$arr=array('status'=>1);}
		else{
		$arr=array('status'=>2);}
		$update = $this->crud_model->common_update($id,'files',$arr);
		if($update)
		{
			if($status==1)
			{
				redirect("admin/gallery/gallery_information/$si");	
			}
			else
			{
				redirect("admin/gallery/gallery_information/$si");
			}
		}
		else
		{
			redirect("admin/gallery/gallery_information/$si");	
		}
	}
	public function delete_gallery()
	{
		$s=$this->uri->segment(4);
		$si=$this->uri->segment(5);//die;
	
		$where=array('id'=>$s);
		$rec=$this->crud_model->common_del($where,'files');
		if($rec)
        {
        	$this->session->set_flashdata('success','The Record deleted Successfully');
			redirect("admin/gallery/gallery_information/$si");	
        }
        else
        {
        	$this->session->set_flashdata('failure','The Record Not deleted!');
			redirect("admin/gallery/gallery_information/$si");
		}
	}
}