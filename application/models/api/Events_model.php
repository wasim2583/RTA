<?php
class Events_model extends CI_model
{
	 public function commonget($params)
    {   
        if(is_array($params))
        {
            $wherecondition=(isset($params['wherecondition']))?$params['wherecondition']:array(); 
            $select=(isset($params['cols']))?$params['cols']:array();
			$join_col=(isset($params['search']))?$params['search']:array();
			$where=(isset($params['where']))?$params['where']:array();
			$condition=(isset($params['condition']))?$params['condition']:array();
			$this->db->from($params['table']);
            $this->db->select($select);
            $this->db->order_by((isset($params['order_by_cols']))?$params['order_by_cols']:'',(isset($params['order_by']))?$params['order_by']:'DESC');
			$this->db->where($wherecondition);
            if(!empty($condition) || !empty($where))
		    $this->db->group_start()->where($condition)->or_where($where)->group_end();		
			if(!empty($join_col)){
				extract($params['search']);
			$this->db->like($join_col,$input,'after');
			}
        }// print_r($res);
        else 
            $this->db->from($params);
        $res=$this->db->get();
     // echo $this->db->last_query(); exit;
        $error = $this->db->error();
        $error_message = $error['message'];
        if ($error['code'] == 0) {
            $count=$res->num_rows();  
            if ($count>0) {
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'Success';
                $response[DESCRIPTION] = $count.' records found';
				 $response['result']=$res->result();
                $response['num_rows']=$count;
            } else 
            {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] = 'No records found';
            }
        } else {
            $response[CODE] = DB_ERROR_CODE;
            $response[MESSAGE] = 'Databse Error';
            $response[DESCRIPTION] = $error_message;
        }
        // $res=$res->result();
        return json_encode($response);
    }
	public function getEvents($wherecondition){
		$response = array();
		$this->db->select('event_id,title,DATE(event_date) as event_date');
		$this->db->from('rl_events_title_tbl');
		$this->db->where($wherecondition);
		$rs=$this->db->get();
		$count=$rs->num_rows();
		if($count>0)
		{
			$response[CODE]=200;
			$response[MESSAGE]='Success';
			$response[DESCRIPTION]=$count. ' Events found';
			$response['events']=array();
			$event_array=array();
			   foreach($rs->result() as $events_res){
			    $event_id = $events_res->event_id;
			     foreach($events_res as $event_key=>$event_val){
				     $event_array[$event_key]=$event_val;
			     }
			     $event_array['photo']='';
				$where = array('event_id'=> $event_id);
				$this->db->select('photo_path as photo');
				$this->db->from('rl_events_photos_tbl');
				$this->db->where($where);
				$this->db->limit(1,0);
				$res = $this->db->get();
				if($res->num_rows() > 0){
					$photo=$res->row()->photo;
					$url= base_url().'uploads/events/photos/';
					$event_array['photo'] = $url.$photo;
				}
				array_push($response['events'], $event_array);
			}
		}
		else
		{
			$response[CODE]=204;
			$response[MESSAGE]='Fail';
			$response[DESCRIPTION]='Events not found';
		}
		return json_encode($response);
	}
	public function eventDetails($wherecondition){
		$response = array();
		$this->db->select('event_id,title,description,DATE(event_date) as event_date');
		$this->db->from('rl_events_title_tbl');
		$this->db->where($wherecondition);
		$rs=$this->db->get();
		$count=$rs->num_rows();
		if($count>0)
		{
			$response[CODE]=200;
			$response[MESSAGE]='Success';
			$response[DESCRIPTION]='Event details found successfully';
			$response['eventDetails']=$rs->row();
			     $response['photos']='';
				$url= base_url().'uploads/events/photos/';
				$this->db->select('photo_id,CONCAT("'.$url.'",photo_path) as photo');
				$this->db->from('rl_events_photos_tbl');
				$this->db->where($wherecondition);
				$res = $this->db->get();
				if($res->num_rows() > 0){
					$response['photos'] = $res->result();
				}
				 $response['videos']='';
				$this->db->select('youtube_id,youtube_url');
				$this->db->from('rl_events_youtube_tbl');
				$this->db->where($wherecondition);
				$resp = $this->db->get();
				if($resp->num_rows() > 0){
					$response['videos']=$resp->result();
				}
		}
		else
		{
			$response[CODE]=204;
			$response[MESSAGE]='Fail';
			$response[DESCRIPTION]='Event not found';
		}
		return json_encode($response);
	}
	public function photosDetails1(){
		$response = array();
		$this->db->select('id,file_name,DATE(uploaded_on) as photos_date');
		$this->db->from('files');
		$rs=$this->db->get();
		$count=$rs->num_rows();
		if($count>0)
		{
			$response[CODE]=200;
			$response[MESSAGE]='Success';
			$response[DESCRIPTION]='Event details found successfully';
			$response['eventDetails']=$rs->row();
			     $response['photos']='';
				$url= base_url().'uploads/files/';
				$this->db->select('id,CONCAT("'.$url.'",file_name) as photo');
				$this->db->from('files');
				$res = $this->db->get();
				if($res->num_rows() > 0){
					$response['photos'] = $res->result();
				}
				 $response['videos']='';
				$this->db->select('id,url');
				$this->db->from('jp_videos_tbl');
				//$this->db->where($wherecondition);
				$resp = $this->db->get();
				if($resp->num_rows() > 0){
					$response['videos']=$resp->result();
				}
		}
		else
		{
			$response[CODE]=204;
			$response[MESSAGE]='Fail';
			$response[DESCRIPTION]='Event not found';
		}
		return json_encode($response);
	}
		public function photosDetails2(){
		$response = array();
		$this->db->select('id as photo_id,file_name as photo,DATE(uploaded_on) as photos_date');
		$this->db->from('files');
		$rs=$this->db->get();
		$count=$rs->num_rows();
		if($count>0)
		{
			$response[CODE]=200;
			$response[MESSAGE]='Success';
			$response[DESCRIPTION]='Event details found successfully';
			//$response['eventDetails']=$rs->row();
			     $response['photos']='';
				$url= base_url().'uploads/files/';
				$this->db->select('id as photo_id,CONCAT("'.$url.'",file_name) as photo');
				$this->db->from('files');
				$res = $this->db->get();
				if($res->num_rows() > 0){
					$response['photos'] = $res->result();
				}
				 $response['videos']='';
				$this->db->select('id as youtube_id,url as youtube_url');
				$this->db->from('da_videos_tbl');
				//$this->db->where($wherecondition);
				$resp = $this->db->get();
				if($resp->num_rows() > 0){
					$response['videos']=$resp->result();
				}
		}
		else
		{
			$response[CODE]=204;
			$response[MESSAGE]='Fail';
			$response[DESCRIPTION]='Event not found';
		}
		return json_encode($response);
	}
	public function photosDetails($userid=""){
		$response = array();
		$this->db->select('id as photo_id,file_name as photo,DATE(uploaded_on) as photos_date,description');
		$this->db->from('files');
		$rs=$this->db->get();
		$count=$rs->num_rows();
		if($count>0)
		{
			$response[CODE]=200;
			$response[MESSAGE]='Success';
			$response[DESCRIPTION]='Event details found successfully';
			//$response['eventDetails']=$rs->row();
			     $response['photos']='';
				$url= base_url().'uploads/files/';
				$this->db->select('id as photo_id,CONCAT("'.$url.'",file_name) as photo,DATE_FORMAT(uploaded_on,"%d-%m-%y") as uploaded_on,description');
				$this->db->from('files');
				if(!empty($userid)){
				$this->db->where('uploaded_by',$userid);
				}
				$res = $this->db->get();
				//$count=$res->num_rows();  
				if($res->num_rows() > 0){
					$response['photos'] = $res->result();
				}else{
					$response['photos'] = array();
					$response[CODE]=204;
					$response[MESSAGE]='Fail';
					$response[DESCRIPTION]='Photos not found';
				}
				 $response['videos']='';
				$this->db->select('id as youtube_id,url as youtube_url');
				$this->db->from('da_videos_tbl');
				if(!empty($userid)){
				$this->db->where('user_id',$userid);
				}
				//$this->db->where($wherecondition);
				$resp = $this->db->get();
				if($resp->num_rows() > 0){
					$response['videos']=$resp->result();
				}else{
					$response['videos']=array();
					$response[CODE]=204;
					$response[MESSAGE]='Fail';
					$response[DESCRIPTION]='Video not found';
				}
		}
		else
		{
			$response[CODE]=204;
			$response[MESSAGE]='Fail';
			$response[DESCRIPTION]='Event not found';
		}
		return json_encode($response);
	}
}