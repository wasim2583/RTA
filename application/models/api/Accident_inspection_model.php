<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Accident_inspection_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->db->query("SET time_zone = '+05:30'");
 }
 public function get_pdf_details($id,$table){
	if($table==1){
		//echo $table;die;
		$table="da_accident_pdf_tbl";
		$table1="da_accident_inspection_report_tbl";
		$case_id="accident_id";
		$array=array('p.pdf_id,p.user_id,p.pdf_number as pdf_name,p.file_name as pdf_url,DATE_FORMAT(p.date,"%d-%m-%Y") AS date,t.location,t.crno');
		// $order_col = 'pdf_id';
	
	}elseif($table==2){
		$table="da_drunk_pdf_tbl";
		$table1="da_drnuk_tbl";
		$case_id="drunk_case_id";
		$array=array('p.pdf_id,p.user_id,p.pdf_number as pdf_name,p.file_name as pdf_url,DATE_FORMAT(p.date,"%d-%m-%Y") AS date,t.location');
	}else{
		$table="da_license_pdf_tbl";
		$table1="da_with_out_license_tbl";
		$case_id="license_case_id";
		$array=array('p.pdf_id,p.user_id,p.pdf_number as pdf_name,p.file_name as pdf_url,DATE_FORMAT(p.date,"%d-%m-%Y") AS date,t.location');
	}
	$url= base_url().'uploads/forms/';
	$data=$this->db->select($array)
			->from("$table as p")
			->join("$table1 as t","p.case_id=t.$case_id",'inner')
			->where('p.user_id',$id)->group_by('p.pdf_id',$id)->order_by('p.pdf_id','desc')->get();
	$count= $data->num_rows();
	$data = $data->result();
	//echo $this->db->last_query();
	$i=1;
	$pdf="";
		foreach($data as $row){
			if($table == "da_accident_pdf_tbl"){
				$row->pdf_name=$row->crno;
			}else{
			$row->pdf_name= "pdf".$i;
			}
							if(!empty($row->pdf_url))
							 { 
								 $row->pdf_url = $url.$row->pdf_url;
							 }else{
								 $row->pdf_url="";
							}
							$row->pdf = $count;
							$i++;
							}
							
		// foreach($data as $row){
							// if(!empty($row->pdf_name))
							 // { 
								 // $row->pdf_name = "pdf".;
							 // }else{
								 // $row->pdf_name="";
							// }
							// $row->pdf = $count;
							// }
		
	return $data;
}
public function get_pdf_details1($id,$table){
	if($table==1){
		$table="da_accident_pdf_tbl";
	}elseif($table==2){
		$table="da_drunk_pdf_tbl";
	}else{
		$table="da_license_pdf_tbl";
	}
	$url= base_url().'uploads/forms/';
	$data=$this->db->select('pdf_id,pdf_number as pdf_name,file_name as pdf_url,DATE_FORMAT(date,"%d-%m-%Y") AS date')->where('user_id',$id)->get($table);
	$count= $data->num_rows();
	$data = $data->result();
		foreach($data as $row){
							if(!empty($row->pdf_url))
							 {
								 
								 $row->pdf_url = $url.$row->pdf_url;
							 }else{
								 $row->pdf_url="";
							}
							$row->pdf = $count;
							}
	return $data;
}
 public function insert_accident($table,$data){
		//echo 'hi';print_r($data);
    $res=$this->db->insert($table,$data);
	if($res){
		 return $this->db->insert_id();
	}
	else{
		return null;
	}
	}
	 public function insert_damages($table,$data){
    $res=$this->db->insert_batch($table,$data);
	//echo $this->db->last_query();
    if($res){
		return true;
	}else{
		return false;
	}
	}
 public function get_status($table,$wer)
	{
		$this->db->where($wer);
		$rs=$this->db->get($table);
		$count=$rs->num_rows();
		if($count>0)
		{
			return $rs->row();
		}
		else
		{
			return null;
		}
	}
		public function checkmobileforupdate($mobile,$id)
	{
		$this->db->select('user_id');
		 $this->db->from('da_users_tbl');
		 $this->db->where('mobile',$mobile);
		 $this->db->where('user_id!=',$id);
		 $query = $this->db->get();
		 $count = $query->num_rows();
		//echo $this->db->last_query();echo $count;
		  return $count;	
	}
	
public function register_user($table,$data){
	$res=$this->db->insert($table,$data);
	if($res)
	{
		return 1;
	}
	else
	{
		return 2;
	}

}
//$url= base_url().'uploads/files/';
public function user_login_check($table,$data)
    {
		$url= base_url().'uploads/users/';
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($data);
    	$res=$this->db->get();
    	$count=$res->num_rows();
		if($count>0)
		{
			return $res->row();
		}
		else
		{
			return false;
		}
    }
  public function login_check($table,$data)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($data);
    	$res=$this->db->get();
    	$count=$res->num_rows();
		if($count>0)
		{
			return $res->row();
		}
		else
		{
			return false;
		}
    }
	    public function commonget($params)
    {   
        if(is_array($params))
        {
            $where=(isset($params['wherecondition']))?$params['wherecondition']:array();
            $select=(isset($params['cols']))?$params['cols']:array();
			$this->db->from($params['table']);
            $this->db->select($select);
            $this->db->order_by((isset($params['order_by_cols']))?$params['order_by_cols']:'',(isset($params['order_by']))?$params['order_by']:'DESC');
			$this->db->where($where); 
        }// print_r($res);
        else 
            $this->db->from($params);
        $res=$this->db->get();

        $error = $this->db->error();
        $error_message = $error['message'];
        if ($error['code'] == 0) {
            $count=$res->num_rows();  
            if ($count>0) {
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'Success';
                $response[DESCRIPTION] = $count.'records found';
                $response['result']=$res->result();
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
	
	   public function searchData1($str=NULL)
    {
        $response=array();
        
        $this->db->select('user_id,name,mobile,disignation,location,user_status');
	$this->db->like('name',$str,'both');
	$this->db->or_like('disignation', $str,'both');
	$this->db->or_like('location', $str,'both');
	$query=$this->db->get('da_users_tbl');
        //echo $this->db->last_query();exit;
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the '.' data':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
        }
        return json_encode($response);
    }
	public function get_data($table,$where)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($where);
    	$res=$this->db->get();
    	$count=$res->num_rows();
		if($count>0)
		{
			return $res->row();
		}
		else
		{
			return null;
		}
    }
	public function search_user($str,$table){
	$this->db->select('*');
	$this->db->like('name',$str,'both');
	$this->db->or_like('disignation', $str,'both');
	$this->db->or_like('location', $str,'both');
	$res=$this->db->get('da_users_tbl');
	$count=$res->num_rows();
		if($count>0)
		{
			return $res->result();
		}
		else
		{
			return null;
		}
}
public function register_check($table,$mobile){
	$this->db->group_start();
//$this->db->where('email',$email);
$this->db->or_where('mobile',$mobile);
$this->db->group_end();
//$this->db->where('user_status',0);
$count=$this->db->get($table)->num_rows();

	return $count;
}
public function common_get($table,$where){
	$res=$this->db->where($where)->get($table)->row();
	 // echo $this->db->last_query();exit;
	return $res;
}
public function common_check($table,$where){
	$count=$this->db->where($where)->get($table)->num_rows();
	// echo $this->db->last_query();exit;
	   return $count;

}
public function searchData($str){
	    $data['user_search_data']=$this->db->select('user_id,name,mobile,disignation,location,user_status')->
	like('name',$str,'both')->
	or_like('disignation', $str,'both')->
	or_like('location', $str,'both')->
	get('da_users_tbl')->result();
	// $data['user_search_data']=$this->db->select('user_id,name,mobile,location')->
								// get('da_users_tbl')->result();
        return $data;

}
public function get_user_data1($id){
	$url= base_url().'uploads/users/';
	$this->db->select('user_id,name,mobile,location,disignation,CONCAT("'.$url.'",profile_pic) as profile_pic,user_status');
    	$this->db->from('da_users_tbl');
		$this->db->where('user_id',$id);
    	$res=$this->db->get();
    	$count=$res->num_rows();
		if($count>0)
		{
			return $res->row();
		}
		else
		{
			return null;
		}
		
}

public function common_count($table,$where,$value){
	$count=$this->db->where($where,$value)->get($table)->num_rows();
	//echo $this->db->last_query();
	   return $count;

}
public function get_user_data($id){
	$data['user_details']=$this->db->select('user_id,name,mobile,location,disignation,profile_pic,user_status')->where('user_id',$id)->get('da_users_tbl')->result();
	$data['user_groups_created']=$this->db->select('created_by')->where('created_by',$id)->get('user_groups_tbl')->num_rows();
	$data['user_groups_participating']=$this->db->select('user_id')->where('user_id',$id)->get('groups_members_tbl')->num_rows();
	$data['user_posts']=$this->db->select('posted_by')->where('posted_by',$id)->get('posts_tbl')->num_rows();
	 return $data;
}
public function get_user_contact_details($id){
	$url= base_url().'uploads/users/';
	$data['user_details']=$this->db->select('user_id,name,mobile,disignation,location,user_status,profile_pic')->where('user_id!=',$id)->order_by('name','ASC')->get('da_users_tbl')->result();
		foreach($data as $row){
								if(!empty($row->profile_pic))
							 {
								 $row->profile_pic = $url.$row->profile_pic;
							 }else{
								 $row->profile_pic="";
							}}
	return $data;
}


}
?>