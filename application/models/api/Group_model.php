<?php
Class Group_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->db->query("SET time_zone = '+05:30'");
    }

    public function get_data()
    {
    	 $data['result']=$this->db->select('*')->get("user_groups_tbl")->result();
		return $data;
    }
	//$this->db->insert_batch($table,$data);
	public function insert_group($table,$data){
		//echo 'hi';print_r($data);
    $res=$this->db->insert($table,$data);
	if($res){
		 return $this->db->insert_id();
	}
	else{
		return null;
	}
	}
	 public function insert_members($table,$data){
    $res=$this->db->insert_batch($table,$data);
    return $res;
	}
	   public function searchData1($str=NULL)
    {
        $response=array();
        $this->db->select('*');
		$this->db->like('group_name',$str,'both');
		$query=$this->db->get('user_groups_tbl');
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
	
	 public function getUserData($table,$wer)
    {
        $this->db->where($wer);
      $tutordata=$this->db->get($table);
      return $tutordata->num_rows();

    }
	public function get_group_data_id($id){
	$url= base_url().'uploads/group/';
	$data=$this->db->select('g.group_id,g.group_name as group_name,group_pic')
							->from('user_groups_tbl g')
							->join('da_users_tbl u','u.user_id=g.created_by')
							//->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('g.created_by',$id)->get()->result();
							  foreach($data as $row){
								if(!empty($row->group_pic))
							 {
								 $row->group_pic = $url.$row->group_pic;
							 }else{
								 $row->group_pic="";
							}}
							 return $data;
}
	public function get_groups_data($id){
	$data=$this->db->select('c.comment_id,c.commented_by as user_id,u.name as name,c.comment,u.profile_pic,
	u.disignation as designation,u.location,
	TIMESTAMPDIFF(YEAR,c.commented_on,now()) as years,TIMESTAMPDIFF(MONTH,c.commented_on,now()) as months,DATEDIFF(NOW(),c.commented_on) AS days,TIMESTAMPDIFF(MINUTE,c.commented_on,now()) as minutes,
	TIMESTAMPDIFF(HOUR,c.commented_on,now()) as hours,TIMESTAMPDIFF(SECOND,c.commented_on,now()) as seconds,
	')
							->from('da_comments_tbl c')
							->join('da_users_tbl u','u.user_id=c.post_id')
							//->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('c.post_id',$id)->get()->result();
							 return $data;
}
	public function searchData($str){
	    $data['user_groups_data']=$this->db->select('*')
									->like('group_name',$str,'both')
									->get('user_groups_tbl')
									->result();
	// $data['user_search_data']=$this->db->select('user_id,name,mobile,location')->
								// get('da_users_tbl')->result();
        return $data;

}
public function get_single_group_data($id){
		$data=array();
$data=$this->db->select('title,description ,date_format(written_on,"%W") AS dayname,DATE_FORMAT(written_on,"%d %b %Y") AS written_on')
							->from('da_diary_tbl')
							->where('diary_id',$id)->get()->row();
							return $data;

}
}

?>