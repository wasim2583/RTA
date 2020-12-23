<?php
class Groups_controller extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->model('Base_model');
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


	public function group_information()
	{
		$si = $this->uri->segment(4,0);
		$base_url = HTTP_BASE_PATH."admin/groups/group_information";
		$tr = $this->crud_model->count_num_recs('user_groups_tbl');
		$pp = 5;
		$config = $this->pagination1($base_url,$tr,$pp);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links($config);
		$res = $this->crud_model->fetch_group_rec($config['per_page'],$si);
		$data['row'] = $res->result_array();
		$state_id = $this->session->userdata('state_id');
		$data['state'] = $this->Base_model->get_state_by_id($state_id);
		$this->load->view('superadmin_view/groups/group_information_view',$data);
	}

	public function update_group()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $group_id=array('group_id'=>$id);
	    if($status==2){
	       $arr=array('group_status'=>1);
		}
	    else{
		   $arr=array('group_status'=>2);
	    }
		$update = $this->crud_model->common_update($group_id,'user_groups_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/groups/group_information/$si");	
			}
			else{
				redirect("admin/groups/group_information/$si");
			}				
		}
		else
		{
			redirect("admin/groups/group_information/$si");	
		}
	}

	public function delete_group()
	{   
		$id=$this->uri->segment(4);
		$si=$this->uri->segment(5);
		$where=array('group_id'=>$id);
		$delete_group = $this->crud_model->common_del($where,'user_groups_tbl');
		if($delete_group === true){
			$where=array('member_id'=>$id);
		    $delete_group_member = $this->crud_model->common_del($where,'groups_members_tbl');
		}
		if($delete_group_member)
			{
				$this->session->set_flashdata('dmsg','The Record deleted Successfully');
				redirect("admin/groups/group_information/$si");	
			}
			else
			{
				$this->session->set_flashdata('dmsg','The Record Not deleted!');
				redirect("admin/groups/group_information/$si");	
			}
	}


	public function display_single()
	{
		$s=$this->uri->segment(4);
		$data=array('group_id'=>$s);
		$data['row']=$this->crud_model->get_single($data,'user_groups_tbl');
	    $this->load->view('superadmin_view/groups/group_update_view',$data);
	
	}
	
	public function search()
	{ 
		$si=$this->uri->segment(4);
		extract($_POST);
		if(isset($export)){
			redirect('superadmin/users_export_controller/exportCSV');
		}
		if(isset($import)){
			redirect('admin/users/import_users_data');
		}
		$data=array();
		if(isset($refresh)){
			redirect("admin/groups/group_information");
	    }
		if(isset($search_str) && !empty($search_str)){
			$data['row']=$this->crud_model->search_group($search_str);
			$data['links']="";
			$this->load->view('superadmin_view/groups/group_information_view',$data);
		}	 
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/groups/group_information/$si");
		}	
		if(isset($active)){
			$arr1 = array();
			foreach($cnames as $name)
			{
				$arr=array("group_id"=>$name);
				$data=array("group_status"=>1);
				$v=$this->crud_model->common_update_count($arr,"user_groups_tbl",$data);echo $v;
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
			{
				$this->session->set_flashdata('ac','The Records You Selected Activated Successfully');
				redirect("admin/groups/group_information/$si");
			}  
			else
			{
				$this->session->set_flashdata('no_ac','The Records You Selected Already Activated ');
				redirect("admin/groups/group_information/$si");
			}
		}
	    if(isset($inactive)){
	    	$arr1 = array();	
	        foreach($cnames as $name)
	        {		
	        	$arr=array("group_id"=>$name);
			    $data=array("group_status"=>2);
		
		        $v2= $this->crud_model->common_update_count($arr,"user_groups_tbl",$data);
		        if($v2==1)
			    {
			    	$arr1[] = 1;
			    }
			}
			if(count($arr1))
			{
		       $this->session->set_flashdata('inc','The Records You Selected InActivated Successfully');
		       redirect("admin/groups/group_information/$si");
		    }  
            else
            {
				echo "hi";
            	$this->session->set_flashdata('no_inc','The Records You Selected Already Inactivated!');
					redirect("admin/groups/group_information/$si");
			}
		}	
	    if(isset($delete)){
	    	$arr1 = array();
	    	foreach($cnames as $name)
	    		{
	    			$arr=array("group_id"=>$name);
		            $v=$this->crud_model->common_del($arr,"user_groups_tbl");
		            if($v==1)
					{
						$arr1[] = 1;
					}
				}
			    if(count($arr1))
			    	{
			    		$this->session->set_flashdata('dc','The Records Deleted Successfully');
		        		redirect("admin/groups/group_information/$si");
		        	}  
                    else
                    {
                    	$this->session->set_flashdata('dc','Try Again!');
	 					redirect("admin/groups/group_information/$si");
					}
		}
	}
}
?>