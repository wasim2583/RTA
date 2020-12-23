<?php
class Messages_controller extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('download');
		$this->load->model('crud_model');
		$this->load->model('Base_model');
		$this->load->library('pagination');
		$this->load->library('session');

		$this->state_id = $this->session->userdata('state_id');
		$this->data['state'] = $this->Base_model->get_state_by_id($this->state_id);
	}
	
	public function pagination1($base_url,$total_rows,$per_page)
	{
		$config = array(
			      'base_url'          => $base_url,
			      'total_rows'        => $total_rows,
			      'per_page'          => $per_page,
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

	public function messages_information()
	{
		$si = $this->uri->segment(4,0);
		$base_url = HTTP_BASE_PATH."admin/messages/messages_information";
		$total_rows = $this->crud_model->count_fetch_messages('messages_tbl');
		$per_page = 20;
		$config = $this->pagination1($base_url,$total_rows,$per_page);
		$this->pagination->initialize($config);
		$this->data['links'] = $this->pagination->create_links();
		$this->data['row'] = $this->crud_model->fetch_messages($config['per_page'],$si,'messages_tbl');
		$this->data['sent_to']=$this->crud_model->common_get_result('da_users_tbl');
		$this->load->view('superadmin_view/messages/messages_view',$this->data);
	}
	
	public function delete_message()
	{
		$id = $this->uri->segment(4);
		$si = $this->uri->segment(5);
		$where = array('message_id' => $id);
		$delete_msg = $this->crud_model->delete_msg($where,'messages_tbl');
		if($delete_msg === true){
			$this->session->set_flashdata('success','The record is deleted successfully');
			redirect('admin/messages/messages_information/$si');
		}
		else{
			$this->session->set_flashdata('failure','Replies Not Deleted!Please try again');
			redirect('admin/messages/messages_information/$si');
		}
	}
	
	public function update_message()
	{
	    $id = $this->uri->segment(4);
	    $status= $this->uri->segment(5);
	    $si= $this->uri->segment(6);
	    $group_id=array('message_id'=>$id);
	    if($status==2){
	       $arr=array('message_status'=>1);
		}
	    else{
		   $arr=array('message_status'=>2);
	    }
		$update = $this->crud_model->common_update($group_id,'messages_tbl',$arr);
		if($update)
		{
			if($status==1){
				redirect("admin/messages/messages_information/$si");	
			}
			else{
				redirect("admin/messages/messages_information/$si");
			}				
		}
		else
		{
			redirect("admin/messages/messages_information/$si");	
		}
	}

	public function search()
	{
		$si = base64_decode($this->uri->segment(4));
		$refresh = $this->input->post('refresh');
		$delete_message = $this->input->post('delete_message');
		$cnames = $this->input->post('cnames');
		$search_str = $this->input->post('search_str');
		$groups = $this->input->post('groups');
		if(isset($refresh)){
			redirect('admin/messages/messages_information');
		}
		if(isset($delete_message)){
			$arr1 = array();
			foreach($cnames as $message_id){
				$arr = array('message_id' => $message_id);
				$delete_msg = $this->crud_model->common_del($arr,'messages_tbl');
				if($delete_msg === true){
					$arr1[] = 1;
				}
			}
			if(count($arr1)){
				$this->session->set_flashdata('success','The record is deleted successfully');
				redirect('admin/messages/messages_information/$si');
			}
			else{
				$this->session->set_flashdata('failed','Not Deleted!Please try again');
				redirect('admin/messages/messages_information/$si');
			}
		}
		if(empty($cnames) && empty($search_str)){
			$this->session->set_flashdata('select','Please Select Atleast One Record!');
			redirect("admin/messages/messages_information/$si");
		}
		if(isset($search_str) && !empty($search_str)){
			$this->data['row'] = $this->crud_model->search_msg($search_str);
			$this->data['links'] = "";
			$this->data['sent_to']=$this->crud_model->common_get_result('da_users_tbl');
		
			$this->load->view('superadmin_view/messages/messages_view',$this->data);
		}	
	}

}
?>