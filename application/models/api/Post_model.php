<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Post_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
		 date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->db->query("SET time_zone = '+05:30'");
 }

  public function login_check($table,$data)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($data);
    	$res=$this->db->get();
		//echo $this->db->last_query();
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
    
    public function get_course_data(){
	
					     $data=$this->db->select('*')
							->from('da_course_number_tbl c')
							->get()->row();
							 return $data;
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
		//echo $this->db->last_query();exit;
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
public function get_user_data($id){
	$data=$this->db->select('c.post_id,p.post_id,count("da_comments_tbl.post_id") as count,p.title,p.posted_by,
	 TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,
	  TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->where('p.post_id',$id)->order_by('p.post_id','DESC')->get()->result();
	// $data['post_details']=$this->db->select('post_id,title,posted_by')->where('post_id',$id)->get('posts_tbl')->result();
	// $data['post_comments']=$this->db->select('created_by')->where('created_by',$id)->get('user_groups_tbl')->num_rows();
	// $data['user_groups_participating']=$this->db->select('user_id')->where('user_id',$id)->get('groups_members_tbl')->num_rows();
	// $data['user_posts']=$this->db->select('posted_by')->where('posted_by',$id)->get('posts_tbl')->num_rows();
	 return $data;
}
function dateDiff ($d1, $d2) {

    // Return the number of days between the two dates:    
    return round(abs(strtotime($d1) - strtotime($d2))/86400);

}
public function post_comments($id){
	$data=$this->db->select('posted_on')->where('post_id',$id)->get('posts_tbl')->row();
							 return $data;
}

public  function days($then){
//$then = '2018-11-10 09:02:23';
//$then = new DateTime($then);
 $now=	date('Y-m-d H:i:s');
//$now = new DateTime();
 
$sinceThen = $then->dateDiff($now);

if(($sinceThen->y)!=0){
	return $sinceThen->y.' years have passed.<br>';exit;
}elseif(($sinceThen->m)!=0){
	return $sinceThen->m.' months have passed.<br>';exit;
}elseif(($sinceThen->d)!=0){
	return $sinceThen->d.' days have passed.<br>';exit;
}elseif(($sinceThen->h)!=0){
	return $sinceThen->h.' hours have passed.<br>';exit;
}elseif(($sinceThen->i)!=0){
	return $sinceThen->i.' minutes have passed.<br>';exit;
}elseif(($sinceThen->s)!=0){
	return $sinceThen->s.' months have passed.<br>';exit;
}
 }
public function for_days($id){
$data=$this->db->select('count("da_comments_tbl.post_id") as totalComments,p.title,p.post_description,p.posted_by as userId,post_image,DATEDIFF(NOW(),p.posted_on) AS postedOn,u.name as postedBy,u.disignation as designation,u.location,u.user_status')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('u.user_id',$id)->group_by('p.post_id')->get()->result();	
							$days=array();
					foreach($data as $result){
						$date=$result->postedOn;
					$days[]=	$this->days($date);
					}
return $days;					
}
public function get_single_posts_datad($id){
	$url= base_url().'uploads/users/';
$data=$this->db->select('count("da_comments_tbl.post_id") as totalComments,p.title,p.post_description,p.posted_by as userId,post_image,
p.posted_on AS postedOn,
TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,
	    TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
		
u.name as postedBy,u.disignation as designation,u.location,u.user_status,CONCAT("'.$url.'",profile_pic) as profile_pic')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('p.post_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->row();
							 return $data;
}
	public function user_photos_by_id($id){
	$this->db->select('*');
	$this->db->from('files');
	$this->db->where('uploaded_by',$id);
	$res=$this->db->get();
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
public function get_single_posts_data($id){
	date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
$data=$this->db->select('count("da_comments_tbl.post_id") as totalComments,p.title,p.post_description,p.posted_by as userId,post_image,
		TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,
		TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,
	    TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
		u.name as postedBy,u.disignation as designation,u.location,u.user_status')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('p.post_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							 return $data;
}
public function get_comments_posts_data1($id){
	$url= base_url().'uploads/users/';
	$data=$this->db->select('c.comment_id,c.commented_by as user_id,u.name as name,c.comment,CONCAT("'.$url.'",u.profile_pic) as profile_pic,
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
public function get_comments_posts_data($id){
	$url= base_url().'uploads/users/';
$data=$this->db->select('c.comment_id,c.commented_by as user_id,u.name as name,c.comment,CONCAT("'.$url.'",u.profile_pic) as profile_pic,
	u.disignation as designation,u.location,
	TIMESTAMPDIFF(YEAR,c.commented_on,now()) as years,TIMESTAMPDIFF(MONTH,c.commented_on,now()) as months,DATEDIFF(NOW(),c.commented_on) AS days,TIMESTAMPDIFF(MINUTE,c.commented_on,now()) as minutes,
	TIMESTAMPDIFF(HOUR,c.commented_on,now()) as hours,TIMESTAMPDIFF(SECOND,c.commented_on,now()) as seconds,
	')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->join('da_users_tbl u','c.commented_by=u.user_id')
							->where('p.post_id',$id)->order_by('p.post_id','DESC')->get()->result();
							 return $data;
}
public function get_commented_user_data_by_post_id($id){
$data=$this->db->select('
		TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,
	    TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
		u.name as userName')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('p.post_id',$id)->group_by('p.post_id')->get()->row();
							 return $data;
}
public function get_posts_data($id){
	date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
		
$data=$this->db->select('count("da_comments_tbl.post_id") as totalComments,p.title,p.post_description,p.posted_by as userId,post_image,DATEDIFF(NOW(),p.posted_on) AS postedOn,u.name as postedBy,u.disignation as designation,u.location,u.user_status')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id')
							->join('da_users_tbl u','p.posted_by=u.user_id')
							->where('u.user_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							 return $data;
}
public function get_all_posts_data(){
	
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
		$data=array();
		$url= base_url().'uploads/group/';
		$url_user= base_url().'uploads/users/';
$data=$this->db->select('COUNT(c.post_id) as totalComments,p.post_id as post_id,p.title,p.post_description,post_image,
		TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,
	    TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
		u.name as userName,u.disignation as designation,u.location,profile_pic,u.user_status,u.user_id')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id','left')
							->join('da_users_tbl u','p.posted_by=u.user_id','inner')
							->where('p.group_id',0)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							foreach($data as $row){
								if(!empty($row->post_image))
							 {
								 $row->post_image = $url.$row->post_image;
							 }else{
								 $row->post_image="";
							}}
							foreach($data as $row){
							 	if(!empty($row->profile_pic))
							 {
								 $row->profile_pic = $url_user.$row->profile_pic;
							 }else{
								 $row->profile_pic="";
							}}
							 return $data;
							
}
public function get_posts_in_group($id){
	
		
		$data=array();
		$url= base_url().'uploads/group/';
		$url_user= base_url().'uploads/users/';
$data=$this->db->select('COUNT(c.post_id) as totalComments,p.post_id as post_id,p.title,p.post_description,p.post_image,
		TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,
	    TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
		u.name as userName,u.disignation as designation,u.location,profile_pic,u.user_status,u.user_id')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id','left')
							->join('da_users_tbl u','p.posted_by=u.user_id','left')
							->where('p.group_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							 foreach($data as $row){
								if(!empty($row->post_image))
							 {
								 $row->post_image = $url.$row->post_image;
							 }else{
								 $row->post_image="";
							}}
							foreach($data as $row){
							 	if(!empty($row->profile_pic))
							 {
								 $row->profile_pic = $url_user.$row->profile_pic;
							 }else{
								 $row->profile_pic="";
							}}
							 return $data;
}
public function get_user_posts_data($id){
		$data=array();
$data=$this->db->select('COUNT(c.post_id) as totalComments,p.title,p.post_description,post_image,
	  TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,
	  TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
	  u.name as userName,u.disignation as designation,u.location,u.user_status,u.user_id')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id','left')
							->join('da_users_tbl u','p.posted_by=u.user_id','left')
							->where('u.user_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							 return $data;
}
public function get_user_posts_data2($id){
	
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
		$data=array();
$data=$this->db->select('COUNT(c.post_id) as totalComments,p.title,p.post_description,post_image,
	TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,
	  TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds,
	  u.name as userName,u.disignation as designation,u.location,u.user_status,u.user_id')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id','left')
							->join('da_users_tbl u','p.posted_by=u.user_id','left')
							->where('u.user_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							 return $data;
}
public function get_specific_user_posts_data($id){
	$url= base_url().'uploads/group/';
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
		$data=array();
$data=$this->db->select('COUNT(c.post_id) as totalComments,p.post_id,p.title,p.post_description,post_image,
      TIMESTAMPDIFF(YEAR,p.posted_on,now()) as years,TIMESTAMPDIFF(MONTH,p.posted_on,now()) as months,DATEDIFF(NOW(),p.posted_on) AS days,
	  TIMESTAMPDIFF(HOUR,p.posted_on,now()) as hours,TIMESTAMPDIFF(MINUTE,p.posted_on,now()) as minutes,TIMESTAMPDIFF(SECOND,p.posted_on,now()) as seconds')
	  
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id','left')
							->join('da_users_tbl u','p.posted_by=u.user_id','left')
							->where('u.user_id',$id)->group_by('p.post_id')->order_by('p.post_id','DESC')->get()->result();
							foreach($data as $row){
								if(!empty($row->post_image))
							 {
								 $row->post_image = $url.$row->post_image;
							 }else{
								 $row->post_image="";
							}}

							return $data;
}
public function get_user_posts_data1($id){
	
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
		$data=array();
$data=$this->db->select('COUNT(c.post_id) as totalComments,p.title,p.post_description, DATEDIFF(NOW(),p.posted_on) AS postedOn,u.name as userName,u.disignation as designation,u.location,u.user_status')
							->from('posts_tbl p')
							->join('da_comments_tbl c','p.post_id=c.post_id','left')
							->join('da_users_tbl u','p.posted_by=u.user_id','left')
							->where('u.user_id',$id)->group_by('u.name')->order_by('p.post_id','DESC')->get()->result();
							 return $data;
}
public function get_user_contact_details($id){
	$data['user_details']=$this->db->select('user_id,name,mobile,disignation,location,user_status')->where('user_id!=',$id)->order_by('name','DESC')->get('da_users_tbl')->result();
	return $data;
}


}
?>