<?php
class Mocktest_model  extends CI_model
{
	
		
	public function fetch_mocktest($nr,$si){
		$data=$this->db->select('*')->from('da_mocktest_tbl')
							  ->join('da_mocktest_options_tbl','da_mocktest_tbl.question_id=da_mocktest_options_tbl.question_id')
							  ->limit($nr,$si)
		                      ->order_by('da_mocktest_tbl.question_id','desc')
							  ->get()->result_array();
				return $data;
							 
	}
	public function english(){
		$url= base_url().'uploads/mocktest/';
	$this->db->select('m.question_id,m.question,m.answer,m.related_img,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							 ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id')
							 ->where('m.answer!=',0)
							 ->where('m.question_type',1);
							
	$data=$this->db->get();
	$count=$data->num_rows();
		if($count>0)
		{
		$data=$data->result();
			 // foreach($data as $row){
								// if(!empty($row->file_name))
							 // {
								 // $row->file_name = $url.$row->file_name;
							 // }else{
								 // $row->file_name="";
							// }}
			return $data;
		}
		else
		{
			return null;
		}
}
public function telugu(){
		$url= base_url().'uploads/mocktest/';
	$this->db->select('m.question_id,m.question,m.answer,m.related_img,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							 ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id')
							 ->where('m.answer!=',0)
							 ->where('m.question_type',2)
							 ->order_by('m.question_id','ASC');
								$data=$this->db->get();
								$count=$data->num_rows();
		if($count>0)
		{
		$data=$data->result();
			 // foreach($data as $row){
								// if(!empty($row->file_name))
							 // {
								 // $row->file_name = $url.$row->file_name;
							 // }else{
								 // $row->file_name="";
							// }}
			return $data;
		}
		else
		{
			return null;
		}
}
	public function mocktest1(){
		$url= base_url().'uploads/mocktest/';
		$data=$this->db->select('m.question_id,m.question,m.answer,m.related_img,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							 ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id')
							 ->where('m.answer!=',0)
							 ->order_by('m.question_id','RANDOM')
							 ->limit(20)
							 ->get()->result();
							return $data;
	}
	public function mocktest(){
		$response = array();
		$this->db->select('m.question_id,m.question,m.answer,m.related_img,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							 ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id');
							 
		$rs=$this->db->get();
		$count=$rs->num_rows();
		if($count>0)
		{
			$response[CODE]=200;
			$response[MESSAGE]='Success';
			$response[DESCRIPTION]='Event details found successfully';
			//$response['eventDetails']=$rs->row();
			     $response['english']='';
				$url= base_url().'uploads/files/';
				$this->db->select('m.question_id,m.question,m.answer,m.related_img,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							 ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id')
							 ->where('m.answer!=',0)
							 ->where('m.question_type',1)
							 ->order_by('m.question_id','RANDOM')
							 ->limit(20);
				$res = $this->db->get();
				if($res->num_rows() > 0){
					$response['english'] = $res->result();
				}
				 $response['telugu']='';
				$this->db->select('m.question_id,m.question,m.answer,m.related_img,mo.option1,mo.option2,mo.option3,mo.option4,mo.option5')->from('da_mocktest_tbl m')
							 ->join('da_mocktest_options_tbl mo','m.question_id=mo.question_id')
							 ->where('m.answer!=',0)
							 ->where('m.question_type',2)
							 ->order_by('m.question_id','RANDOM')
							 ->limit(20);
				//$this->db->where($wherecondition);
				$resp = $this->db->get();
				if($resp->num_rows() > 0){
					$response['telugu']=$resp->result();
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