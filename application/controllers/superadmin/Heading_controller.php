<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Heading_controller extends CI_Controller {
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
        //$this->load->model('file');
        $this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
    }
    public function add_heading(){
		$this->load->view('superadmin_view/headings/department_create_view', $this->data);
	}
	public function insert_heading(){
		extract($_POST);//echo "<pre>";print_r($_POST);print_r($_FILES);die;//echo $registered_date = date('Y-m-d H:i:s');die;
		
		if(isset($managetestimonials)){
			redirect('admin/testimonials/testimonials_information');
		}
		$config = array(
		array(
                'field' => 'headings',
                'label' => 'Headings',
                'rules' => 'required|regex_match[/^[a-zA-Z.\s]+$/]',
               
			),
				array(
                'field' => 'status',
                'label' => 'status',
                'rules' => 'required',
                ),
              );
       // print_r($_POST);die;
				$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
                { 
$this->load->library('form_validation');
			//echo validation_errors();
					
					$this->load->view('superadmin_view/headings/department_create_view');
	}
	else{
		$image="";$pdf="";
		if(is_uploaded_file($_FILES['image']['tmp_name'])){
			
				$config['upload_path'] = 'uploads/headings/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = 'headings-'.rand(1000,9999);
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
				   if($this->upload->do_upload('image'))
				   { 		 $uploadData = $this->upload->data();
							$image = $uploadData['file_name'];
							
				   }
				   else{
					 //print_r($this->upload->display_errors());die;
					   $data = array('error' => $this->upload->display_errors());//print_r($data);die;
						$this->load->view('superadmin_view/headings/department_create_view',$data);
				   }
			}	   	
		if(is_uploaded_file($_FILES['pdf']['tmp_name'])){
					$userfile_name = $_FILES['pdf']['name'];
					$userfile_extn = explode(".", strtolower($_FILES['pdf']['name']));
					//echo $userfile_extn;
					$path = $_FILES['pdf']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);//echo "$ext";die;
						$config['upload_path'] = 'uploads/headings/';
						$config['allowed_types'] = '*';
						//$config['file_type']= 'pdf';
						$config['file_name'] = 'headings-'.rand(1000,9999);
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						   if($this->upload->do_upload('pdf'))
						   { 		 $uploadData = $this->upload->data();
									$pdf = $uploadData['file_name'];
									
						   }
						   else{
							$data = array('error' => $this->upload->display_errors());//print_r($data);die;
						$this->load->view('superadmin_view/headings/department_create_view',$data);
						   }
					}
		$registered_date = date('Y-m-d H:i:s');
		$arr=array('heading_title'=>$headings,'heading_description'=>$description,'image'=>$image,
		'pdf'=>$pdf,'added_on'=>$registered_date,'status'=>$status);
		$ins=$this->crud_model->common_insert('da_headings_tbl',$arr);
		if($ins){
				$this->session->set_flashdata('success','Data inserted Successfully');
		         redirect('admin/headings/manage_headings');
	}
	}	
}
	public function insert_headings(){
		extract($_POST);
		if(isset($manageheadings)){
			redirect('admin/headings/manage_headings');
		}
		$name_count=count($name);
		$insert_headings_array=array();
			for($l=0;$l<$name_count;$l++)
			{
				$insert_headings_array[]=array(
				'heading_title'=>$name[$l],
				'heading_description'=>$description[$l],
				'status'=>1,
				 'added_on'=> date('Y-m-d H:i:s'),
				);
			}
				if (count($insert_headings_array) > 0) {
                 $insert=  $this->crud_model->insert_batch('da_headings_tbl', $insert_headings_array);
				if($insert){
				$this->session->set_flashdata('success','Data inserted successfully!');
				redirect("admin/headings/manage_headings");	
            }else{
				$this->session->set_flashdata('failure','Some problem occurred, please try again!');
				redirect("admin/headings/manage_headings");	
			}
                }
		}
		public function display_title()
	{
	//echo	$id=$this->uri->segment(4);
		$s=$this->uri->segment(4);//die;
		//echo $s;die;
		$data=array('heading_id'=>$s);
		$data['row']=$this->crud_model->get_single($data,'da_headings_tbl');//print_r($data);die;
	$this->load->view('superadmin_view/headings/title_update_view',$data);
	
	}	
	public function update_title()
	{ 
		 $id = $this->uri->segment(4);
		 $s = $this->uri->segment(5);//die;
		extract($_POST);
		if(isset($manage_titles)){
			redirect('admin/headings/manage_headings');
		}
		$config = array(
				array(
                'field' => 'question',
                'label' => 'Title',
                'rules' => 'required',
                ),array(
                'field' => 'answer',
                'label' => 'Description',
                'rules' => 'required',
                ),
				array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                ),);
				$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
                {  
					redirect('admin/headings/manage_headings');	
				
	}
	else{
		$where=array('heading_id'=>$id);
		$cc=array('heading_title'=>$question,'heading_description'=>$answer,'status'=>$status);
	
		$res=$this->crud_model->common_update_count($where,'da_headings_tbl',$cc);//echo $res;die;
		if($res==1){
			
				$this->session->set_flashdata('success','The Data Is Updated Successfully');
		        redirect("admin/headings/manage_headings/$s");
		}
		else
		{
				$this->session->set_flashdata('failure','Here You Have Not Done Any Changes To Update The Data');
		        redirect("admin/headings/manage_headings/$s");
		}	
	}}
	public function update_title_data()
	{
		$id=$this->uri->segment(4);
		$si=$this->uri->segment(5);
	 	$table='da_headings_tbl';
	 	$where_data=array('heading_id'=>$id);
	 	$data['res']=$this->crud_model->get_single($where_data,$table);
	 	extract($_POST);
	 	if(isset($submit))
	 	{
	 		$this->form_validation->set_rules('name','Title','required');
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
	 			$this->load->view('superadmin_view/update_gallery',$data);
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
 public function manage_headings()
 { 
	 $si=$this->uri->segment(4,0);
	$base_url= HTTP_BASE_PATH."admin/headings/manage_headings";
	$tr=$this->crud_model->count_num_recs('da_headings_tbl');
	$pp=25;
	$config = $this->pagination1($base_url,$tr, $pp);
	 $this->load->library('pagination');
	 $this->pagination->initialize($config);
	 $this->data['links']=$this->pagination->create_links($config);
	 $res=$this->crud_model->common_fetch('da_headings_tbl',$config['per_page'],$si,'heading_id');
	$this->data['row']=$res->result_array	();//echo "<pre>";print_r($data);die;
	$this->load->view('superadmin_view/headings/headings_information_view',$this->data);
 }
 public function search(){ 
	
		$si=$this->uri->segment(4); //die;
		extract($_POST);
		if(isset($search_str) && !empty($search_str)){
		$data['row']=$this->crud_model->search_title($search_str);
		$data['links']="";
		$this->load->view('superadmin_view/headings/headings_information_view',$data);
	}	
		if(isset($create)){
		 redirect('admin/headings/add_heading');
		}
	$data=array();
	if(isset($refresh))
	{ redirect("admin/headings/manage_headings");	
	}
   
	if(empty($cnames) && empty($search_str)){
		$this->session->set_flashdata('failure','Please Select Atleast One Record!');
		redirect("admin/headings/manage_headings/$si");	
	}

	if(isset($active))
	{//extract($_POST);print_r($_POST);die;
			$arr1 = array();				
		foreach($cnames as $name)
		{
			$arr=array("heading_id"=>$name);
			$data=array("status"=>1);
			$v=$this->crud_model->common_update_count($arr,"da_headings_tbl",$data);echo $v;
			if($v==1)
			{
				$arr1[] = 1;
			}			
		}			
		if(count($arr1)>0)
                        {
                        	$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
		        			redirect("admin/headings/manage_headings/$si");
		}  
                        else
                        {
                        	$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
		 					redirect("admin/headings/manage_headings/$si");
						}
}
	if(isset($inactive)){
		$arr1 = array();	
	foreach($cnames as $name)
		{		
			$arr=array("heading_id"=>$name);
			$data=array("status"=>2);
		
		$v2= $this->crud_model->common_update_count($arr,"da_headings_tbl",$data);
		if($v2==1)
			{
				$arr1[] = 1;
			}
		}
			if(count($arr1))
                        {//$data['links']="";
					//echo "hi";die;
                        	$this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
		        			redirect("admin/headings/manage_headings/$si");
                        }  
                        else
                        {
							echo "hi";
                        	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
		 					redirect("admin/headings/manage_headings/$si");
						}
	}	
	if(isset($delete)){
	$arr1 = array();	
	foreach($cnames as $name)
		{
		$arr=array("heading_id"=>$name);
		$v=$this->crud_model->common_del($arr,"da_headings_tbl");
		if($v==1)
			{
				$arr1[] = 1;
			}
		}
			if(count($arr1))
                        {
			
                        	$this->session->set_flashdata('success','The Records Deleted Successfully');
		        			redirect("admin/headings/manage_headings/$si");
                        }  
                        else
                        {
                        	$this->session->set_flashdata('failure','Try Again!');
		 					redirect("admin/headings/manage_headings/$si");
						}		
	}
	}
	public function update_status(){
	
	 $id = $this->uri->segment(4);
	 $status= $this->uri->segment(5);
	  $si= $this->uri->segment(6);
	 $id=array('heading_id'=>$id);//die;
	 if($status==2){
	 $arr=array('status'=>1);}
 else{
 $arr=array('status'=>2);}
	$update = $this->crud_model->common_update($id,'da_headings_tbl',$arr);
	if($update)
	{
		if($status==1){
	    redirect("admin/headings/manage_headings/$si");	
		}
else{
	    redirect("admin/headings/manage_headings/$si");
}				
	}
	else
	{
	    redirect("admin/headings/manage_headings/$si");	
	}
}
public function delete_title()
	{   $s=$this->uri->segment(4);
	$si=$this->uri->segment(5);//die;
	
	$where=array('heading_id'=>$s);
		$rec=$this->crud_model->common_del($where,'da_headings_tbl');
		if($rec)
                        {
                        	$this->session->set_flashdata('success','The Record deleted Successfully');
		        			redirect("admin/headings/manage_headings/$si");	
                        }
                        else
                        {
                        	$this->session->set_flashdata('failure','The Record Not deleted!');
		 					redirect("admin/headings/manage_headings/$si");	
		
	}
	}

}