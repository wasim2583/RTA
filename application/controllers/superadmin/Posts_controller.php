<?php
class Posts_controller extends CI_controller
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


	public function Posts_information()
	{
		$si = $this->uri->segment(4,0);
		$base_url = HTTP_BASE_PATH."admin/posts/posts_information";
		$tr = $this->crud_model->count_num_recs('posts_tbl');
		$pp = 20;
		$config = $this->pagination1($base_url,$tr,$pp);
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->data['links'] = $this->pagination->create_links($config);
		$this->data['row'] = $this->crud_model->fetch_posts($config['per_page'],$si);
		$this->load->view('superadmin_view/posts/post_information_view',$this->data);
	}
	
	public function comments()
	{
		$id = $this->uri->segment(4);
		$arr = array('post_id' => $id);	
		$count = $this->crud_model->count_comments($arr);
		if($count>0){
			$data['row'] = $this->crud_model->fetch_comments($arr);
			$this->load->view('superadmin_view/posts/comments_view',$data);
		}
	}
	
	public function comments_replies()
	{
		$comment_id = $this->uri->segment(4);
		$arr = array('comment_id' => $comment_id);	
		$count = $this->crud_model->count_replies($arr);
		if($count>0){
			$data['row'] = $this->crud_model->fetch_replies($arr);
			$this->load->view('superadmin_view/posts/replies_view',$data);
		}else{
			$data['row'] = "";
			$this->load->view('superadmin_view/posts/replies_view',$data);
		}
	}
	
	public function update_post()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $post_id=array('post_id'=>$id);
	    if($status==2){
	       $arr=array('status'=>1);
		}
	    else{
		   $arr=array('status'=>2);
	    }
		$update = $this->crud_model->common_update($post_id,'posts_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/posts/posts_information/$si");	
			}
			else{
				redirect("admin/posts/posts_information/$si");
			}				
		}
		else
		{
			redirect("admin/posts/posts_information/$si");	
		}
	}
	
	public function update_reply()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $post_id=array('reply_id'=>$id);
	    if($status==2){
	       $arr=array('replied_status'=>1);
		}
	    else{
		   $arr=array('replied_status'=>2);
	    }
		$update = $this->crud_model->common_update($post_id,'da_comments_replies_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/posts/comments_replies/$si");	
			}
			else{
				redirect("admin/posts/comments_replies/$si");
			}				
		}
		else
		{
			redirect("admin/posts/comments_replies/$si");	
		}
	}
	
	public function update_comment()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $post_id=array('comment_id'=>$id);
	    if($status==2){
	       $arr=array('comment_status'=>1);
		}
	    else{
		   $arr=array('comment_status'=>2);
	    }
		$update = $this->crud_model->common_update($post_id,'da_comments_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/posts/comments/$si");	
			}
			else{
				redirect("admin/posts/comments/$si");
			}				
		}
		else
		{
			redirect("admin/posts/comments/$si");	
		}
	}
	
	public function delete_post()
	{
		$id = $this->uri->segment(4);
		$si = $this->uri->segment(5);
		$where = array('post_id'=>$id);
		$delete_post = $this->crud_model->common_del($where,'posts_tbl');
		if($delete_post === true){
			$where = array('post_id' => $id);
		    $delete_cmnt = $this->crud_model->common_del($where,'da_comments_tbl');
			if($delete_cmnt === true){
				$where = array('post_id' => $id);
		        $delete_reply = $this->crud_model->common_del($where,'da_comments_replies_tbl');
				if($delete_reply === true){
			        $this->session->set_flashdata('success','The record is deleted successfully');
			        redirect('admin/posts/posts_information');
		        }
		        else{
			        $this->session->set_flashdata('failure','Replies Not Deleted!Please try again');
					redirect("admin/posts/posts_information");
		        }
			}
			else{
				 $this->session->set_flashdata('failure','Comments Not Deleted!Please try again');
			}
		}
		else{
			 $this->session->set_flashdata('failure','Not Deleted!Please try again');
		}
	}
	
	public function delete_comment()
	{
		$id = $this->uri->segment(4);
		$si = $this->uri->segment(5);
		$where = array('comment_id'=>$id);
		$result = $this->crud_model->common_del($where,'da_comments_tbl');
		if($result)
		{
			$this->session->set_flashdata('success','The Record deleted Successfully');
			redirect("admin/posts/comments/$si");
		}
		else{
			$this->session->set_flashdata('failure','The Record Not deleted!');
			redirect("admin/posts/comments/$si");	
		}
	}
	
	public function delete_reply()
	{
		$id = $this->uri->segment(4);
		$si = $this->uri->segment(5);
		$where = array('reply_id'=>$id);
		$result = $this->crud_model->common_del($where,'da_comments_replies_tbl');
		if($result)
		{
			$this->session->set_flashdata('success','The Record deleted Successfully');
			redirect("admin/posts/comments_replies/$si");
		}
		else{
			$this->session->set_flashdata('failure','The Record Not deleted!');
			redirect("admin/posts/comments_replies/$si");	
		}
	}

	public function search()
	{ 
		$si=$this->uri->segment(4);
		extract($_POST);
		$data=array();
		if(isset($refresh)){
			redirect("admin/posts/posts_information");
	    }
		if(isset($search_str) && !empty($search_str)){
			$data['row']=$this->crud_model->search_post($search_str);
			$data['links']="";
			$this->load->view('superadmin_view/posts/post_information_view',$data);
		}	
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/posts/posts_information/$si");
		}	
	    if(isset($delete)){
	    	$arr1 = array();
	    	foreach($cnames as $name)
			{
				$where=array("post_id"=>$name);
				$delete_post = $this->crud_model->common_del($where,"posts_tbl");
				if($delete_post === true){
						$where = array('post_id' => $id);
						$delete_cmnt = $this->crud_model->common_del($where,'da_comments_tbl');
					if($delete_cmnt === true){
						$where = array('post_id' => $id);
						$delete_reply = $this->crud_model->common_del($where,'da_comments_replies_tbl');
						if($delete_reply == 1)
						{
							$arr1[] = 1;
						}
					}
				}
			}
			if(count($arr1)){
				$this->session->set_flashdata('success','The Records Deleted Successfully');
				redirect("admin/posts/posts_information/$si");
			}  
			else{
				$this->session->set_flashdata('failure','Try Again!');
				redirect("admin/posts/posts_information/$si");
			}
		}
		if(isset($active)){
			$arr1 = array();
			foreach($cnames as $name)
			{
				$arr=array("post_id"=>$name);
				$data=array("status"=>1);
				$v=$this->crud_model->common_update_count($arr,"posts_tbl",$data);
				if($v==1){
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0){
				$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
				redirect("admin/posts/posts_information/$si");
			}  
			else{
				$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
				redirect("admin/posts/posts_information/$si");
			}
		}
	    if(isset($inactive)){
	    	$arr1 = array();	
	        foreach($cnames as $name)
	        {		
	        	$arr=array("post_id"=>$name);
			    $data=array("status"=>2);
		
		        $v2= $this->crud_model->common_update_count($arr,"posts_tbl",$data);
		        if($v2==1)
			    {
			    	$arr1[] = 1;
			    }
			}
			if(count($arr1))
			{
		       $this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
		       redirect("admin/posts/posts_information/$si");
		    }  
            else
            {
				echo "hi";
            	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
					redirect("admin/posts/posts_information/$si");
			}
		}
	}
	
	public function search_replies()
	{ 
		$si=$this->uri->segment(4);
		extract($_POST);
		$data=array();
		if(isset($refresh)){
			redirect("admin/posts/comments_replies");
	    }
		if(isset($search_str) && !empty($search_str)){
			$data['row']=$this->crud_model->search_replies($search_str,$si);
			$data['links']="";
			$this->load->view('superadmin_view/posts/replies_view',$data);
		}	
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/posts/comments_replies/$si");
		}	
	    if(isset($delete)){
	    	$arr1 = array();
	    	foreach($cnames as $name)
	    		{
	    			$arr=array("reply_id"=>$name);
		            $v=$this->crud_model->common_del($arr,"da_comments_replies_tbl");
		            if($v==1)
					{
						$arr1[] = 1;
					}
				}
			    if(count($arr1))
			    	{
			    		$this->session->set_flashdata('success','The Records Deleted Successfully');
		        		redirect("admin/posts/comments_replies/$si");
		        	}  
                    else
                    {
                    	$this->session->set_flashdata('failure','Try Again!');
	 					redirect("admin/posts/comments_replies/$si");
					}
		}
		if(isset($active)){
			$arr1 = array();
			foreach($cnames as $name)
			{
				$arr=array("reply_id"=>$name);
				$data=array("replied_status"=>1);
				$v=$this->crud_model->common_update_count($arr,"da_comments_replies_tbl",$data);
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
			{
				$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
				redirect("admin/posts/comments_replies/$si");
			}  
			else
			{
				$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
				redirect("admin/posts/comments_replies/$si");
			}
		}
	    if(isset($inactive)){
	    	$arr1 = array();	
	        foreach($cnames as $name)
	        {		
	        	$arr=array("reply_id"=>$name);
			    $data=array("replied_status"=>2);
		        $v2= $this->crud_model->common_update_count($arr,"da_comments_replies_tbl",$data);
		        if($v2==1){
			    	$arr1[] = 1;
			    }
			}
			if(count($arr1)){
		        $this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
		        redirect("admin/posts/comments_replies/$si");
		    }  
            else{
				echo "hi";
            	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
				redirect("admin/posts/comments_replies/$si");
			}
		}
	}
	
	
	public function search_comments()
	{ 
		$si=$this->uri->segment(4);
		extract($_POST);
		$data=array();
		if(isset($refresh)){
			redirect("admin/posts/comments/$si");
	    }
		if(isset($search_str) && !empty($search_str)){
			$data['row']=$this->crud_model->search_comments($search_str,$si);
			$data['links']="";
			$this->load->view('superadmin_view/posts/comments_view',$data);
		}		
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/posts/comments/$si");
		}	
	    if(isset($delete)){
	    	$arr1 = array();
	    	foreach($cnames as $name)
			{
				$arr=array("comment_id"=>$name);
				$v=$this->crud_model->common_del($arr,"da_comments_tbl");
				if($v==1)
				{
					$arr1[] = 1;
				}
			}
			if(count($arr1))
			{
				$this->session->set_flashdata('success','The Records Deleted Successfully');
				redirect("admin/posts/comments/$si");
			}  
			else
			{
				$this->session->set_flashdata('failure','Try Again!');
				redirect("admin/posts/comments/$si");
			}
		}
		if(isset($active)){
			$arr1 = array();
			foreach($cnames as $name)
			{
				$arr=array("comment_id"=>$name);
				$data=array("comment_status"=>1);
				$v=$this->crud_model->common_update_count($arr,"da_comments_tbl",$data);
				if($v==1)
				{
					$arr1[] = 1;
				}			
			}			
			if(count($arr1)>0)
			{
				$this->session->set_flashdata('success','The Records You Selected Activated Successfully');
				redirect("admin/posts/comments/$si");
			}  
			else
			{
				$this->session->set_flashdata('failure','The Records You Selected Already Activated ');
				redirect("admin/posts/comments/$si");
			}
		}
	    if(isset($inactive)){
	    	$arr1 = array();	
	        foreach($cnames as $name)
	        {		
	        	$arr=array("comment_id"=>$name);
			    $data=array("comment_status"=>2);
		
		        $v2= $this->crud_model->common_update_count($arr,"da_comments_tbl",$data);
		        if($v2==1)
			    {
			    	$arr1[] = 1;
			    }
			}
			if(count($arr1))
			{
		       $this->session->set_flashdata('success','The Records You Selected InActivated Successfully');
		       redirect("admin/posts/comments/$si");
		    }  
            else
            {
				echo "hi";
            	$this->session->set_flashdata('failure','The Records You Selected Already Inactivated!');
					redirect("admin/posts/comments/$si");
			}
		}
	}
	

}
?>