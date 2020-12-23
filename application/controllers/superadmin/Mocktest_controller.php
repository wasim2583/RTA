<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mocktest_controller extends CI_Controller {
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
		error_reporting(0);

		$this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
    }
    public function add_mocktest(){
		$this->load->view('superadmin_view/mocktest/mocktest_create_view', $this->data);
	}
	public function common_upload($up,$at,$ms,$mw,$mh){
		$config=array(
		'upload_path'=>$up,
		'allowed_types'=>$at,
		'max_size'=>$ms,
        'max_width' => $mw,
		'max_height' =>$mh,

		);
		return $config;
	}
	
   public function insert_mocktest()
   {
		extract($_POST);//echo "<pre>";print_r($_FILES);die;//echo $registered_date = date('Y-m-d H:i:s');die;
		
		if(isset($managemocktest)){
			redirect('admin/mocktest/mocktest_information');
		}
		$config = array(
		array(
                'field' => 'question',
                'label' => 'Question',
                'rules' => 'required',
               
        ),
		array(
                'field' => 'language',
                'label' => 'language',
                'rules' => 'required',
               
        ),
		array(
                'field' => 'opt1',
                'label' => 'Option1',
                'rules' => 'required',
               
        ),
		array(
                'field' => 'opt2',
                'label' => 'Option2',
                'rules' => 'required',
               
        ),
		array(
                'field' => 'opt3',
                'label' => 'Option3',
                'rules' => 'required',
               
        ),
		array(
                'field' => 'opt4',
                'label' => 'Option4',
                'rules' => 'required',
               
        ),		
		array(
                'field' => 'answer',
                'label' => 'Answer',
                'rules' => 'required',
        ),
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        { 
			$this->load->library('form_validation');
			$this->load->view('superadmin_view/mocktest/mocktest_create_view');
		}
		else
		{
			$image="";
			$file_name =  $_FILES['img1']['tmp_name'];
			if(!empty($file_name))
			{
				$config['upload_path'] = 'uploads/mocktest/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = 'mocktest-'.rand(1000,9999);
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
				if($this->upload->do_upload('img1'))
				{ 		 
						$uploadData = $this->upload->data();
						$image = $uploadData['file_name'];
				}
				else
				{
				   $image = "";
				}		
			}
	
			$written_on = date('Y-m-d H:i:s');
			$arr=array('question'=>$question,'answer'=>$answer,'related_img'=>$url,'question_type'=>$language,'written_on'=>$written_on,'status'=>1);
			$question_id=$this->crud_model->add_mocktest($arr);
			
			if($question_id)
			{
				$options_data=array(
				'question_id'=>$question_id,
				'option1'=> $opt1,
				'option2'=>$opt2,
				'option3'=>$opt3,
				'option4'=>$opt4,
				);
				$flag=$this->crud_model->common_insert('da_mocktest_options_tbl',$options_data); 
				if($flag)
				{ 
					$this->session->set_flashdata('success','Data inserted Successfully');
					redirect('admin/mocktest/mocktest_information');
				}
				else
				{	
					$this->session->set_flashdata("failure","Data not inserted.");
					redirect('admin/mocktest/mocktest_information');
				}
			}
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
	public function mocktest_information()
	{
	 extract($_POST);
	// if(isset($language)){ 

	 if(empty($language)){
		 $language=1;
		  $this->session->set_userdata('language',$language);
		$language=$this->session->userdata('language');

	 }else{
		 $this->session->set_userdata('language',$language);
	 $language=$this->session->userdata('language');

	 }
	 
	// }
	 
	 $si=$this->uri->segment(4,0);
	$base_url= HTTP_BASE_PATH."admin/mocktest/mocktest_information";
	 $tr=$this->crud_model->fetch_mocktest_count($language);//die;
	$pp=25;
	$config = $this->pagination1($base_url,$tr, $pp);
	 $this->load->library('pagination');
	 $this->pagination->initialize($config);
	 $this->data['links']=$this->pagination->create_links($config);
	 $res=$this->crud_model->fetch_mocktest($config['per_page'],$si,$language);
	$this->data['row']=$res;//echo "<pre>";print_r($data);die;
	$this->data['language']=$language;
	$this->load->view('superadmin_view/mocktest/mocktest_information_view',$this->data);
	}
	public function language(){
	extract($_POST);

	}
	public function search(){ 
	
		$si=$this->uri->segment(4); //die;
		extract($_POST);//print_r($_POST);die;
		if(isset($export)){
			redirect('superadmin/mocktest_export_controller/exportCSV');
			//force_download('uploads/care_team/cha.jpeg', NULL);
		}
		/*if(isset($import)){
			//$this->load->view('superadmin_view/users_import_view');
			redirect('admin/mocktest/import_mocktest_data');
		}*/
		if(isset($import)){
			redirect('superadmin/imp_mocktest_controller');
		}
		if(isset($search_str) && !empty($search_str)){
		$this->data['row']=$this->crud_model->search_testimonials($search_str,'ins_testimonials_tbl');
		$this->data['links']="";
		$this->load->view('superadmin_view/testimonials_information_view',$this->data);
	}	
		if(isset($create)){
		 redirect('admin/mocktest/add_mocktest');
		}
	$data=array();
	if(isset($refresh))
	{ redirect("admin/mocktest/mocktest_information");	
	}
   
	if(empty($cnames) && empty($search_str)){
		$this->session->set_flashdata('failure','Please Select Atleast One Record!');
		redirect("admin/mocktest/mocktest_information/$si");	
	}

	if(isset($active))
	{//extract($_POST);print_r($_POST);die;
			$arr1 = array();				
		foreach($cnames as $name)
		{
			$arr=array("question_id"=>$name);
			$data=array("status"=>1);
			$v=$this->crud_model->common_update_count($arr,"da_mocktest_tbl",$data);echo $v;
			if($v==1)
			{
				$arr1[] = 1;
			}			
		}			
		if(count($arr1)>0)
                        {
                        	$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
		        			redirect("admin/mocktest/mocktest_information/$si");
		}  
                        else
                        {
                        	$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
		 					redirect("admin/mocktest/mocktest_information/$si");
						}
}
	if(isset($inactive)){
		$arr1 = array();	
	foreach($cnames as $name)
		{		
			$arr=array("question_id"=>$name);
			$data=array("status"=>2);
		
		$v2= $this->crud_model->common_update_count($arr,"da_mocktest_tbl",$data);
		if($v2==1)
			{
				$arr1[] = 1;
			}
		}
			if(count($arr1))
                        {//$data['links']="";
					//echo "hi";die;
                        	$this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
		        			redirect("admin/mocktest/mocktest_information/$si");
                        }  
                        else
                        {
							echo "hi";
                        	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
		 					redirect("admin/mocktest/mocktest_information/$si");
						}
	}	
	if(isset($delete)){
	$arr1 = array();	
	foreach($cnames as $name)
		{
		$arr=array("question_id"=>$name);
		$v=$this->crud_model->common_del($arr,"da_mocktest_tbl");
		if($v==1)
			{
				$arr1[] = 1;
			}
		}
			if(count($arr1))
                        {
                        	$this->session->set_flashdata('success','The Records Deleted Successfully');
		        			redirect("admin/mocktest/mocktest_information$si");
                        }  
                        else
                        {
                        	$this->session->set_flashdata('failure','Try Again!');
		 					redirect("admin/mocktest/mocktest_information/$si");
						}		
	}
	}
	public function delete_mocktest()
	{   $s=$this->uri->segment(4);
		$si=$this->uri->segment(5);//die;
	$where=array('question_id'=>$s);
		$rec=$this->crud_model->common_del($where,'da_mocktest_tbl');
		if($rec)
                        {
                        	$this->session->set_flashdata('success','The Record deleted Successfully');
		        			redirect("admin/mocktest/mocktest_information/$si");	
                        }
                        else
                        {
                        	$this->session->set_flashdata('failure','The Record Not deleted!');
		 					redirect("admin/mocktest/mocktest_information/$si");	
		
	}
	}
	public function update_status(){
	
	 $id = $this->uri->segment(4);
	 $status= $this->uri->segment(5);
	  $si= $this->uri->segment(6);
	 $id=array('question_id'=>$id);//die;
	 if($status==2){
	 $arr=array('status'=>1);}
 else{
 $arr=array('status'=>2);}
	$update = $this->crud_model->common_update($id,'da_mocktest_tbl',$arr);
	if($update)
	{
		if($status==1){
	    redirect("admin/mocktest/mocktest_information/$si");	
		}
else{
	    redirect("admin/mocktest/mocktest_information/$si");
}				
	}
	else
	{
	    redirect("admin/mocktest/mocktest_information/$si");	
	}
	}
public function display_mocktest()
	{
		$question_id=$this->uri->segment(4);
		$data=array('question_id'=>$question_id);
		$this->data['row']=$this->crud_model->update_mocktest($question_id);
		$this->load->view('superadmin_view/mocktest/mocktest_update_view',$this->data);
	}
public function update_mocktests()
	{ 
		 $id = $this->uri->segment(4);
		$s = $this->uri->segment(5);
		extract($_POST);
		if(isset($manage_mocktest)){
			redirect('admin/mocktest/mocktest_information');
		}
		$config = array(
		array(
                'field' => 'question',
                'label' => 'Question',
                'rules' => 'required',
               
        ),
				
				array(
                'field' => 'answer',
                'label' => 'Answer',
                'rules' => 'required',
                ),
              );
				$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
                {  
					redirect('admin/mocktest/mocktest_information');	
				
	}
	else{
		$where=array('question_id'=>$id);
		$data=array('question'=>$question,'answer'=>$answer);
		$res=$this->crud_model->common_update_count($where,'da_mocktest_tbl',$data);//echo $res;die;
			$value = 0;
		if($res==1){
			$value = 1;
			}
			$where=array('question_id'=>$id);
			$data=array('option1'=>$opt1,'option2'=>$opt2,'option3'=>$opt3,'option4'=>$opt4);
			$res=$this->crud_model->common_update_count($where,'da_mocktest_options_tbl',$data);
				if($res==1){
					$value = 1;
				}
		if($value == 1)
		{
				$this->session->set_flashdata('success','The Data Is Updated Successfully');
		        redirect("admin/mocktest/mocktest_information/$s");
		}else{
			$this->session->set_flashdata('failure','Here You Have Not Done Any Changes To Update The Data');
		        redirect("admin/mocktest/mocktest_information/$s");
		}	
	}}	
}