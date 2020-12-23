<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Members_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
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
	public function search_by_area($params)
	{
		if(is_array($params)){
			$keyword=$params['keyword'];
			$category_id=$params['category_id'];
			$wherecondition=$params['wherecondition'];
			$wherecondition2=$params['wherecondition2'];
			$response = array('ads'=>array());
			$commonwhere = array('a.activation_status'=> 1,'category_id'=>$category_id);
			$wherevalidity=array('a.validity >='=>date('Y-m-d'));
			$this->db->select('a.id,a.ad_id,a.ad_title,t.ad_type,a.validity,a.description,a.contact_name,a.contact_mobile,a.area,a.offer,a.survey_required,a.pricing,a.posted_by,a.activation_status');
			$this->db->from('trp3_ads_tbl a');
			$this->db->join('trp3_ad_types_tbl t','a.ad_type_id=t.id');
			$this->db->where($commonwhere);
			$this->db->where($wherevalidity);
			$this->db->where($wherecondition);
			$this->db->where($wherecondition2);
			if(is_numeric($keyword)){$this->db->where('a.pincode',$keyword);}
			else{
				$this->db->group_start();
		        $this->db->like('a.area',$keyword);
		        $this->db->or_like('a.city',$keyword);
		        $this->db->group_end();
		    }
	        $this->db->order_by('a.ad_title','ASC');
			$rs=$this->db->get();
			$count=$rs->num_rows();
			if($count>0)
			{
				// return $rs->result();
				$ads_array=array();
				   foreach($rs->result() as $ads_res){
				    $ad_id = $ads_res->id;
				     foreach($ads_res as $ad_key=>$ad_val){
					     $ads_array[$ad_key]=$ad_val;
				     }
				     $ads_array['likes']=array();
					
					$where = array('ad_id'=> $ad_id);
					$this->db->select('*');
					$this->db->from('trp3_ad_likes_tbl');
					$this->db->where($where);
					$res = $this->db->get();
					if($res->num_rows() > 0){

						$likes['likes_count'] = $res->num_rows();
						array_push($ads_array['likes'],$likes);
					}
					array_push($response['ads'], $ads_array);
				}
				return $response;
			}
			else
			{
				return null;
			}
		}else{
			return null;
		}
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
	
	   public function searchData($str=NULL)
    {
        $response=array();
        
        $this->db->select('*');
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
	
	return $res;
}
public function common_check($table,$where){
	$count=$this->db->where($where)->get($table)->num_rows();
	   return $count;

}
public function get_members_data($id){
	  $get=$this->db->select('*')->from('user_groups_tbl')->
			join('groups_members_tbl','user_groups_tbl.group_id=groups_members_tbl.group_id')
			->where('groups_members_tbl.group_id', $id)->get();
				$data['result']= $get->result();
				//echo $this->db->last_query();
				return $data;
}
public function get_members_data1(){
	//$query=SELECT * FROM user_groups_tbl INNER join groups_members_tbl on user_groups_tbl.group_id=groups_members_tbl.group_id where user_groups_tbl.group_id=3;
	$data=$this->db->query($query);
	return $data;
	}
	public function get_members_data11($id){
	  $get=$this->db->select('*')->from('user_groups_tbl')->
			join('groups_members_tbl','user_groups_tbl.group_id=groups_members_tbl.group_id')
			->where('groups_members_tbl.group_id', $id)->get();
				$data['result']= $get->num_rows();
				echo $this->db->last_query();
				return $data;
}
}
?>