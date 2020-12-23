<?php
Class Slider extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Crud_model');
		$this->load->model('Base_model');

		$this->admin_id = $this->session->userdata('admin_id');
		$this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
	}
	public function add_slider()
	{
		extract($_POST);
		if(isset($submit))
		{
			
				if(($_FILES['photo']['name'])!=null)
                {
	                $config['upload_path']          = './uploads/slider/';
	                $config['allowed_types']        = 'jpg|png|jpeg';
	                $config['max_size']             = 0;
	                $config['max_width']            = 0;
	                $config['max_height']           = 0;
	                $config['file_name']='slider_'.rand(1000,9999);
                    $this->load->library('upload',$config);
                    if($this->upload->do_upload('photo'))
                    { 
                        $uploaded=$this->upload->data();
                        $photo=$uploaded['file_name'];
	                   // $location=base_url().'su_user/register';
	                $table='da_slider_tbl';
	                $add_data=array('slider_title'=>$name,
	            					'slider_img'=>$photo,
	            					'slider_caption'=>$caption,
	            					'slider_location'=>$url,
	            					'added_by'=>$this->admin_id,
	            					'added_on'=>date('Y-m-d'),
	            					'state_id'=>$this->app_state,
	            					'slider_status'=>1);
	                $res=$this->Crud_model->common_insert($table,$add_data);
						if($res)
						{
							$this->session->set_flashdata('msg','Slider added Successfully');
							redirect('superadmin/slider/slider_information');
						}
						else
						{
							$this->session->set_flashdata('msgs','Something went wrong, try again');
							redirect('superadmin/slider/add_slider');
						}
                    }
                    else
                    { 
                    	$this->session->set_flashdata('msgs','Invalid file format');
						redirect('superadmin/slider/add_slider');
                        // $errors=$this->upload->display_errors();
                        // $data['img_upload_err']=$errors;
                        // $photo="--";
                    }
                }
                else
                {
                     $photo="--";
                }
		}
		else
		{
			$this->load->view('superadmin_view/slider/add_slider_view', $this->data);
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
        public function slider_information()
 		{
			$si=$this->uri->segment(4,0);
			/*$config['base_url']=HTTP_BASE_PATH."superadmin/Superadmin_controller/aaa";
			$config['total_rows']=$this->crud_model->count_num_recs('su_users_tbl');
			$config['per_page']=2; */
			$base_url= HTTP_BASE_PATH."superadmin/slider/slider_information";
			$tr=$this->Crud_model->count_num_recs('da_slider_tbl');
			$pp=20;
			$config = $this->pagination1($base_url,$tr, $pp);
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$this->data['links']=$this->pagination->create_links($config);
			// $res=$this->Crud_model->get_slider('da_slider_tbl',$config['per_page'],$si);
			$this->data['row'] = $this->Base_model->get_sliders_by_admin($this->admin_id);
			// $this->data['row']=$res->result_array	();//echo "<pre>";print_r($data);die;
			$this->load->view('superadmin_view/slider/manage_slider_view',$this->data);
 		}
 	public function search()
 	{ 
		$si=$this->uri->segment(4); //die;
		extract($_POST);
  		$data=array();
	  	if(isset($search_str) && !empty($search_str))
	  	{
			$this->data['row']=$this->Crud_model->search_slider($search_str,'da_slider_tbl');
			$this->data['links']="";
			$this->load->view('superadmin_view/slider/manage_slider_view',$this->data);
			}	 
			if(empty($cnames) && empty($search_str))
			{
				$this->session->set_flashdata('msgs','Please Select Atleast One Record!');
				redirect("superadmin/slider/slider_information/$si");	
			}	
		if(isset($active))
		{
			$arr1 = array();				
			foreach($cnames as $name)
			{
				$arr=array("slider_id"=>$name);
				$data=array("slider_status"=>1);
				$v=$this->Crud_model->common_update_count($arr,"da_slider_tbl",$data);echo $v;
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
            {
            	$this->session->set_flashdata('msg','The Records You Selected Activated Successfully');
    			redirect("superadmin/slider/slider_information/$si");
			}  
            else
            {
            	$this->session->set_flashdata('msgs','The Records You Selected Already Activated ');
					redirect("superadmin/slider/slider_information/$si");
			}
		}
		if(isset($inactive))
		{
			$arr1 = array();	
			foreach($cnames as $name)
			{		
				$arr=array("slider_id"=>$name);
				$data=array("slider_status"=>2);
				$v2= $this->Crud_model->common_update_count($arr,"da_slider_tbl",$data);
				if($v2==1)
				{
					$arr1[] = 1;
				}
			}
			if(count($arr1))
            {
            	$this->session->set_flashdata('msg','The Records You Selected InActivated Successfully');
    			redirect("superadmin/slider/slider_information/$si");
            }  
            else
            {
            	$this->session->set_flashdata('msgs','The Records You Selected Already Inactivated!');
					redirect("superadmin/slider/slider_information/$si");
			}
		}	
		if(isset($delete))
		{
			$arr1 = array();	
			foreach($cnames as $name)
			{
				$arr=array("slider_id"=>$name);
				$v=$this->Crud_model->common_del($arr,"da_slider_tbl");
				if($v==1)
				{
					$arr1[] = 1;
				}
			}
				if(count($arr1))
                {
                	$this->session->set_flashdata('msg','The Records Deleted Successfully');
        			redirect("superadmin/slider/slider_information/$si");
                }  
                else
                {
                	$this->session->set_flashdata('msgs','Try Again!');
 					redirect("superadmin/slider/slider_information/$si");
				}		
		}
	}
	public function update_slider()
	{
	 	$id = $this->uri->segment(4);
	 	$status= $this->uri->segment(5);
	  	$si= $this->uri->segment(6);
	 	$slider_id=array('slider_id'=>$id);
	 	if($status==2)
	 	{
	 		$arr=array('slider_status'=>1);
	 	}
 		else
 		{
 			$arr=array('slider_status'=>2);
 		}
		$update = $this->Crud_model->common_update($slider_id,'da_slider_tbl',$arr);
		if($update)
		{
			if($status==1)
			{
		    redirect("superadmin/slider/slider_information/$si");	
			}
			else
			{
				redirect("superadmin/slider/slider_information/$si");
			}				
		}
		else
		{
		    redirect("superadmin/slider/slider_information/$si");	
		}
	}
	public function delete_slider()
	{   
		$s=$this->uri->segment(4);
		$si=$this->uri->segment(5);//die;
		$where=array('slider_id'=>$s);
		$rec=$this->Crud_model->common_del($where,'da_slider_tbl');
		if($rec)
        {
        	$this->session->set_flashdata('msg','The Record deleted Successfully');
			redirect("superadmin/slider/slider_information/$si");	
        }
        else
        {
        	$this->session->set_flashdata('msgs','The Record Not deleted!');
				redirect("superadmin/slider/slider_information/$si");
		}
	}
	public function update_slider_image()
	{
		$slider_id=$this->uri->segment(4);
		$si=$this->uri->segment(5);
	 	$table='da_slider_tbl';
	 	$where_data=array('slider_id'=>$slider_id);
	 	$this->data['res']=$this->Crud_model->get_single($where_data,$table);
	 	$this->load->view('superadmin_view/slider/update_view',$this->data);
	 	extract($_POST);
	 	if(isset($submit))
	 	{
 			if(($_FILES['photo']['name'])!='')
            {
                $config['upload_path']          = './uploads/slider/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['file_name']='slider_'.rand(1000,9999);
                $this->load->library('upload',$config);
                if($this->upload->do_upload('photo'))
                { 
                    $uploaded=$this->upload->data();
                    $photo=$uploaded['file_name'];
                }
                else
                { 
                	//$this->session->set_flashdata('msg','Invalid file format');
			       // redirect("superadmin/slider/slider_information/$si");
                     $errors=$this->upload->display_errors();
                     $data['img_upload_err']=$errors;
                     $photo=$old_image;
                }
            }
            else
            {
                 $photo=$old_image;
            }
            $table='da_slider_tbl';
		               
			$update_data=array('slider_title'=>$name,
								'slider_img'=>$photo,
								'slider_location'=>$url,
								'slider_caption'=>$caption,
								'slider_status'=>1);
			$update_where=array('slider_id'=>$slider_id);
			$update_response=json_decode($this->Crud_model->commonUpdate($table,$update_data,$update_where));
			if($update_response->code==200)
			{
				$this->session->set_flashdata('msg','Updated Successfully');
	        	redirect("superadmin/slider/slider_information/$si");
			}
			else
			{
				$this->session->set_flashdata('msgs','Not Updated,Try again');
	        	redirect("superadmin/slider/slider_information/$si");
			}
	 	}
	 	else
	 	{
	 		$this->load->view('superadmin_view/slider/update_view');
	 	}
	}

}
?>