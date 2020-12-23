<?php
class Members_controller extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('pagination');
		$this->load->helper('download');
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


	/* public function members_information()
	{
		$si = $this->uri->segment(4,0);
		$base_url = HTTP_BASE_PATH."admin/members/members_information";
		$tr = $this->crud_model->count_members_rec();
		$pp = 5;
		$config = $this->pagination1($base_url,$tr,$pp);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links($config);
		$res = $this->crud_model->fetch_members_rec($config['per_page'],$si,'member_id');
		$data['row'] = $res->result_array();
		$this->load->view('superadmin_view/members/member_information_view',$data);
	} */

	public function update_member()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $member_id=array('member_id'=>$id);
	    if($status==2){
	       $arr=array('member_status'=>1);
		}
	    else{
		   $arr=array('member_status'=>2);
	    }
		$update = $this->crud_model->common_update($member_id,'groups_members_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/members/member_information/$si");	
			}
			else{
				redirect("admin/members/member_information/$si");
			}				
		}
		else
		{
			redirect("admin/members/member_information/$si");	
		}
	}

	public function delete_member()
	{   
		$id=$this->uri->segment(4);
		$si=$this->uri->segment(5);
		$where=array('member_id'=>$id);
		$rec=$this->crud_model->common_del($where,'groups_members_tbl');
		if($rec)
		{
			$this->session->set_flashdata('dmsg','The Record deleted Successfully');
			redirect("admin/members/member_information/$si");	
		}
		else
		{
			$this->session->set_flashdata('dmsg','The Record Not deleted!');
			redirect("admin/members/member_information/$si");	
		}
	}

	public function delete_specific_member()
	{   
		$id=$this->uri->segment(4);
		$si=$this->uri->segment(5);
		$where=array('member_id'=>$id);
		$rec=$this->crud_model->common_del($where,'groups_members_tbl');
		if($rec)
			{
				$this->session->set_flashdata('dmsg','The Record deleted Successfully');
				redirect("admin/members/members_record/$si");	
			}
			else
			{
				$this->session->set_flashdata('dmsg','The Record Not deleted!');
				redirect("admin/members/members_record/$si");	
			}
	}
	
	public function members_record()
	{
		$id = $this->uri->segment(4);
		$arr = array('group_id' => $id);
		$data['row'] = $this->crud_model->display_members($arr);
		$data['group_id']=$id;
		$this->load->view('superadmin_view/members/group_members_view',$data);
	}

	public function update_specific_member()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $group_id=array('member_id'=>$id);
	    if($status==2){
	       $arr=array('member_status'=>1);
		}
	    else{
		   $arr=array('member_status'=>2);
	    }
		$update = $this->crud_model->common_update($group_id,'groups_members_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/members/members_record/$si");	
			}
			else{
				redirect("admin/members/members_record/$si");
			}				
		}
		else
		{
			redirect("admin/members/members_record/$si");	
		}
	}
	
	public function search_members()
	{
		$si=$this->uri->segment(4);
		$group_id= $this->uri->segment(5);
		extract($_POST);
		$data=array();
		if(isset($refresh)){
			redirect("admin/groups/group_information");
	    }
		if(isset($search_str) && !empty($search_str)){
			$data['row']=$this->crud_model->search_group_members($search_str,$group_id);//echo "<pre>";print_r($data);die;
			$data['links']="";
			$data['group_id'] = $group_id;
			$this->load->view('superadmin_view/members/group_members_view',$data);
		}	
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/members/members_record/$si");
		}	
		if(isset($active)){
			$arr1 = array();
			foreach($cnames as $name)
			{
				$arr=array("member_id"=>$name);
				$data=array("member_status"=>1);
				$v=$this->crud_model->common_update_count($arr,"groups_members_tbl",$data);echo $v;
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
			{
				$this->session->set_flashdata('ac','The Records You Selected Activated Successfully');
				redirect("admin/members/members_record/$si");
			}  
			else
			{
				$this->session->set_flashdata('no_ac','The Records You Selected Already Activated ');
				redirect("admin/members/members_record/$si");
			}
		}
	    if(isset($inactive)){
	    	$arr1 = array();	
	        foreach($cnames as $name)
	        {		
	        	$arr=array("member_id"=>$name);
			    $data=array("member_status"=>2);
		
		        $v2= $this->crud_model->common_update_count($arr,"groups_members_tbl",$data);
		        if($v2==1)
			    {
			    	$arr1[] = 1;
			    }
			}
			if(count($arr1))
			{
		       $this->session->set_flashdata('inc','The Records You Selected InActivated Successfully');
		       redirect("admin/members/members_record/$si");
		    }  
            else
            {
				echo "hi";
            	$this->session->set_flashdata('no_inc','The Records You Selected Already Inactivated!');
					redirect("admin/members/members_record/$si");
			}
		}	
	    if(isset($delete)){
	    	$arr1 = array();
	    	foreach($cnames as $name)
	    		{
	    			$arr=array("member_id"=>$name);
		            $v=$this->crud_model->common_del($arr,"groups_members_tbl");
		            if($v==1)
					{
						$arr1[] = 1;
					}
				}
			    if(count($arr1))
			    	{
			    		$this->session->set_flashdata('dc','The Records Deleted Successfully');
		        		redirect("admin/members/members_record/$si");
		        	}  
                    else
                    {
                    	$this->session->set_flashdata('dc','Try Again!');
	 					redirect("admin/members/members_record/$si");
					}
		}
	}

	public function search()
	{ 
		$si=$this->uri->segment(4);
		extract($_POST);
		if(isset($export)){ 
			//force_download('uploads/care_team/cha.jpeg', NULL);
		}
		if(isset($import)){
			//$this->load->view('superadmin_view/users_import_view');
			redirect('admin/members/import_users_data');
		}
		$data=array();
		if(isset($refresh)){
			redirect("admin/members/member_information");
	    }
		if(isset($search_str) && !empty($search_str)){
			$data['row']=$this->crud_model->search_members($search_str,'groups_members_tbl');
			$data['links']="";
			$this->load->view('admin/members/member_information/$si',$data);
		}	
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("C");
		}	
		if(isset($active)){
			$arr1 = array();
			foreach($cnames as $name)
			{
				$arr=array("member_id"=>$name);
				$data=array("member_status"=>1);
				$v=$this->crud_model->common_update_count($arr,"groups_members_tbl",$data);echo $v;
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
			{
				$this->session->set_flashdata('ac','The Records You Selected Activated Successfully');
				redirect("admin/members/member_information/$si");
			}  
			else
			{
				$this->session->set_flashdata('no_ac','The Records You Selected Already Activated ');
				redirect("admin/members/member_information/$si");
			}
		}
	    if(isset($inactive)){
	    	$arr1 = array();	
	        foreach($cnames as $name)
	        {		
	        	$arr=array("member_id"=>$name);
			    $data=array("member_status"=>2);
		
		        $v2= $this->crud_model->common_update_count($arr,"groups_members_tbl",$data);
		        if($v2==1)
			    {
			    	$arr1[] = 1;
			    }
			}
			if(count($arr1))
			{
			//$data['links']="";
					//echo "hi";die;
		       $this->session->set_flashdata('inc','The Records You Selected InActivated Successfully');
		       redirect("admin/members/member_information/$si");
		    }  
            else
            {
				echo "hi";
            	$this->session->set_flashdata('no_inc','The Records You Selected Already Inactivated!');
					redirect("admin/members/member_information/$si");
			}
		}	
	    if(isset($delete)){
	    	$arr1 = array();
	    	foreach($cnames as $name)
	    		{
	    			$arr=array("member_id"=>$name);
		            $v=$this->crud_model->common_del($arr,"groups_members_tbl");
		            if($v==1)
					{
						$arr1[] = 1;
					}
				}
			    if(count($arr1))
			    	{
			    		$this->session->set_flashdata('dc','The Records Deleted Successfully');
		        		redirect("admin/members/member_information/$si");
		        	}  
                    else
                    {
                    	$this->session->set_flashdata('dc','Try Again!');
	 					redirect("admin/members/member_information/$si");
					}
		}
	}
	

}
?>