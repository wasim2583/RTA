<?php
class Crud_model extends CI_Model
{
	public function commonUpdate($table, $update_data, $update_condition, $displaymessage = NULL, $debug = NULL,$failmessage=NULL) 
     {
        $response = array();
        if (is_array($update_data) && is_array($update_condition)) {
            $sql = $this->db->update_string($table, $update_data, $update_condition);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $update = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        $count = $this->db->affected_rows();
                        if ($count > 0) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] =!empty($failmessage)?$failmessage:'Data not updated';
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Database Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }
	
	public function where_count($where,$table)
	{
		$count=$this->db->where($where)->get($table)->num_rows();
		if($count == 0)
			return 0;
		else
			return 1;
	}
	
	public function where_get1($where,$table)
	{
	    $resultset = $this->db->where($where)->get($table)->row_array();
		return $resultset;
	}
	
	public function common_get($table)
	{
	    $resultset = $this->db->get($table)->result_array();
		return $resultset;
	}
		public function insert_batch($t,$d)
	{
		$insert= $this->db->insert_batch($t,$d);
		if($insert){
			return true;
		}else{
			return false;
		}
	}
	public function common_get1($id="",$t)
	{
	    $data = $this->db->order_by($id,'asc')->get($t)->result_array();
		return $data;
	}
		public function common_get2($id="",$t)
	{
	    $data = $this->db->order_by($id,'desc')->get($t)->result_array();
		return $data;
	}
	public function common_insert($t,$d)
	{
		$response = $this->db->insert($t,$d);
		return $response;
	}
	
	public function common_where_get($w,$t)
    {
	    $res = $this->db->where($w)->get($t)->result_array();
		return $res;
	}
	
	public function twojoin($tbl1,$tbl2,$aid,$lid,$w="")
	{
		$ins=$this->db->select("*")->from($tbl1)->
	    join($tbl2,"$tbl1.$aid=$tbl2.$lid")->where($w)->get();
	    return $v= $ins->result_array();
	}
	
	public function common_del($id,$table)
	{
	    $this->db->where($id);
	    $res=$this->db->delete($table);
	    return $res;
    }
	
	public function get_single($data,$tab)
	{
		$this->db->where($data);
		$res=$this->db->get($tab)->row_array();
		return $res;
	}
	
	public function common_update($where,$tab,$data)
	{
		$this->db->where($where);
		$this->db->update($tab,$data);
		$res=$this->db->affected_rows();
		return $res;
	}
	
	public function common_update_count($where,$tab,$up)
	{
		$this->db->where($where);
		$this->db->update($tab,$up);
		$res=$this->db->affected_rows();
		if($res>0)
			return 1;
		else
			return 2;	
	}
	
	public function common_update_exist($where,$tab,$up,$exist)
	{
		$this->db->select('*');
		$count=	$this->db->where($exist)->get($tab)->num_rows();//die;
		if($count>1){
		return 3;}
		else{
			$this->db->where($where);
		$this->db->update($tab,$up);
		$res=$this->db->affected_rows();
	    if($res>0)
			return 1;
		else 
		    return 2;
		}
	}

	public function count_num_recs($table)
	{
		$total_recs = $this->db->count_all($table);
		return $total_recs;
	}
	
	public function get($table,$nr,$i)
	{
		$this->db->limit($nr,$i);
		$this->db->order_by('user_id','desc');
		$r=$this->db->get($table);
		return $r;
	}

	public function common_fetch($table,$nr,$i,$id)
	{
		$this->db->limit($nr,$i);
		$this->db->order_by($id,'desc');
		$result=$this->db->get($table);
		return $result;
	}
	
	public function fetch_group_rec($nr,$si)
	{
		$this->db->select('u.name,g.group_id,g.group_name,g.created_on,g.group_status,g.group_pic,m.member_id, COUNT(member_id) as total')->from('da_users_tbl u');
		$this->db->join('user_groups_tbl g','u.user_id=g.created_by');
		$this->db->join('groups_members_tbl m','m.group_id=g.group_id','left');
		$this->db->limit($nr,$si);
		$this->db->order_by('group_id','desc');
		$this->db->group_by('g.group_id');
		$result=$this->db->get();
		return $result;
	}
	
	public function count_members_rec($id)
	{
		$this->db->where('group_id',$id);
		$result=$this->db->get('groups_members_tbl')->num_rows();
		return $result;
	}
	
	public function display_members($arr)
	{
		$this->db->select('u.user_id,u.name,m.*')->from('da_users_tbl u');
		$this->db->join('groups_members_tbl m','m.member_id=u.user_id');
		$this->db->where($arr);
		$this->db->order_by('m.added_on','desc');
		$resultset = $this->db->get();
		return $resultset->result_array();
	}
	
	public function count_comments($id)
	{
		$resultset = $this->db->get_where('da_comments_tbl',$id);
		$count = $resultset->num_rows();
		return $count;
	}
	
	public function count_replies($id)
	{
		$resultset = $this->db->get_where('da_comments_replies_tbl',$id);
		$count = $resultset->num_rows();
		return $count;
	}
	
	public function add_mocktest($add_mocktest)
	{
		$res=$this->db->insert('da_mocktest_tbl',$add_mocktest);
		$mocktest_id=$this->db->insert_id();
		if($res)
		{
			return $mocktest_id;
		}
		else
		{
			return false;
		}
	}
	public function fetch_posts($nr,$si)
	{
		$this->db->select('u.name,u.user_id,p.post_id as pid,p.post_description,p.posted_by,p.title,c.post_id as cpid,p.posted_on,p.status,c.comment,c.commented_by,COUNT(c.post_id) as comments')->from('da_users_tbl u','left')->join('posts_tbl p','p.posted_by=u.user_id');
		$this->db->join('da_comments_tbl c','c.post_id=p.post_id','left');
		$this->db->limit($nr,$si);
		$this->db->order_by('p.post_id','desc');
		$this->db->group_by('p.post_id');
		$posts = $this->db->get();
		return $posts->result();
	}
	
	public function fetch_comments($id)
	{
		$this->db->select('u.name,c.*');
		$this->db->from('da_comments_tbl c');
		$this->db->join('da_users_tbl u','u.user_id=c.commented_by');
		$this->db->where($id);
		$this->db->order_by('c.comment_id','DESC');
		$data = $this->db->get();
		return $data->result();
	}
	
	public function fetch_replies($id)
	{
		$this->db->select('u.name,r.*');
		$this->db->from('da_comments_replies_tbl r');
		$this->db->join('da_users_tbl u','u.user_id=r.reply_by');
		$this->db->where($id);
		$this->db->order_by('r.reply_id','ASC');
		$data = $this->db->get();
		return $data->result();
	}
	public function fetch_mocktest($nr,$si,$id){
		$data=$this->db->select('*')->from('da_mocktest_tbl')
							  ->join('da_mocktest_options_tbl','da_mocktest_tbl.question_id=da_mocktest_options_tbl.question_id')
							  ->limit($nr,$si)
							  ->where('da_mocktest_tbl.answer!=',0)
							  ->where('da_mocktest_tbl.question_type',$id)
		                      ->order_by('da_mocktest_tbl.question_id','asc')
							  ->group_by('da_mocktest_tbl.question_id')
							  ->get()->result_array();
							//echo $this->db->last_query();
				return $data;
							 
	}
		public function fetch_mocktest_count($id){
		$data=$this->db->select('*')->from('da_mocktest_tbl')
							  ->join('da_mocktest_options_tbl','da_mocktest_tbl.question_id=da_mocktest_options_tbl.question_id')
							  ->where('da_mocktest_tbl.answer!=',0)
							  ->where('da_mocktest_tbl.question_type',$id)
		                     ->group_by('da_mocktest_tbl.question_id')
							  ->get();
							//echo $this->db->last_query();
				return $data->num_rows();
							 
	}
	public function search_mocktest($nr,$si){
		$data=$this->db->select('*')->from('da_mocktest_tbl')
							  ->join('da_mocktest_options_tbl','da_mocktest_tbl.question_id=da_mocktest_options_tbl.question_id')
							  ->limit($nr,$si)
							  ->where('da_mocktest_tbl.answer!=',0)
		                      ->order_by('da_mocktest_tbl.question_id','asc')
							  ->group_by('da_mocktest_tbl.question_id')
							  ->get()->result_array();
				return $data;
							 
	}
	public function update_mocktest($question_id){
		$data=$this->db->select('*')->from('da_mocktest_tbl')
							  ->join('da_mocktest_options_tbl','da_mocktest_tbl.question_id=da_mocktest_options_tbl.question_id')
							  ->where('da_mocktest_tbl.question_id',$question_id)
							  ->get()->row_array();
				return $data;
							 
	}
	public function count_fetch_messages()
	{
		$this->db->select('u.user_id as uid,u.name,g.group_name,m.message_id,m.message,m.group_id,m.user_id as muid,m.message_sent_to as m_by');
		$this->db->from('messages_tbl m');
		$this->db->join('da_users_tbl u','m.user_id=u.user_id','left');
		$this->db->join('user_groups_tbl g','g.group_id=m.group_id','left');
		$messages_count = $this->db->get();
		return $messages_count->num_rows();
	}
	public function common_get_result($table)
	{
	    $resultset = $this->db->get($table)->result();
		return $resultset;
	}
	public function fetch_messages($nr,$si)
	{
		$this->db->select('u.user_id as uid,u.name,g.group_name,m.message_id,m.message,m.group_id,m.user_id as muid,m.message_sent_to as m_by,m.message_status');
		$this->db->from('messages_tbl m');
		$this->db->join('da_users_tbl u','m.user_id=u.user_id','left');
		$this->db->join('user_groups_tbl g','g.group_id=m.group_id','left');
		$this->db->limit($nr,$si);
		$this->db->order_by('m.message_id','DESC');
		$messages = $this->db->get();
		return $messages->result();
	}
	
	public function search($str)
	{
		$this->db->select('*');
		$this->db->like('name',$str,'both');
		$this->db->or_like('disignation',$str,'both');
		$this->db->or_like('location', $str,'both');
	    return	$this->db->get('da_users_tbl')->result_array();
	}
	public function search_title($str)
	{
		$this->db->select('*');
		$this->db->like('heading_title',$str,'both');
	    return	$this->db->get('da_headings_tbl')->result_array();
	}

	
	
	public function search_group($str)
	{
		$this->db->select('u.name,g.group_id,g.group_name,g.created_on,g.group_status,g.group_pic,m.member_id,COUNT(member_id) as total');
		$this->db->from('da_users_tbl u');
		$this->db->join('user_groups_tbl g','g.created_by=u.user_id');
		$this->db->join('groups_members_tbl m','m.member_id=u.user_id','left');
		$this->db->order_by('group_id','desc');
		$this->db->group_by('g.group_id');
		$this->db->like('group_name',$str,'after');
		$this->db->or_like('name',$str,'after');
		$result = $this->db->get()->result_array();
		return	$result;
	}
	
	
	public function search_members($str,$table)
	{
		$this->db->select('g.*,m.*,COUNT(member_id) as total')->from('user_groups_tbl g');
		$this->db->join('groups_members_tbl m','m.group_id=g.group_id');
		$this->db->like('group_name',$str,'after');
		$result = $this->db->get()->result_array();
		return	$result;
	}

	public function search_group_members($str,$group_id)
	{
		$this->db->select('u.user_id,u.name,m.*')->from('da_users_tbl u');
		$this->db->join('groups_members_tbl m','m.member_id=u.user_id');
		$this->db->where('m.group_id',$group_id);
		$this->db->like('name',$str,'both');
		$resultset = $this->db->get();
		return $resultset->result_array();
	}

	public function search_post($str)
	{
		$this->db->select('u.name,p.*')->from('da_users_tbl u');
		$this->db->join('posts_tbl p','p.posted_by=u.user_id');
		$this->db->like('title',$str,'after');
		$this->db->or_like('name',$str,'after');
		$records = $this->db->get();
		return $records->result_array();
	}
	
	public function search_comments($str,$si)
	{
		$this->db->select('u.name,c.*');
		$this->db->from('da_comments_tbl c');
		$this->db->join('da_users_tbl u','u.user_id=c.commented_by');
		$this->db->where('c.post_id',$si);
		$this->db->like('u.name',$str,'after');
		$this->db->order_by('c.comment_id','DESC');
		$data = $this->db->get();
		return $data->result();
	}
	
	public function search_replies($str,$si)
	{
		$this->db->select('u.name,r.*');
		$this->db->from('da_comments_replies_tbl r');
		$this->db->join('da_users_tbl u','u.user_id=r.reply_by');
		$this->db->where('r.comment_id',$si);
		$this->db->order_by('r.reply_id','DESC');
		$this->db->like('u.name',$str,'after');
		$data = $this->db->get();
		return $data->result();
	}

	public function search_msg($string)
	{
		$this->db->select('u.user_id as uid,u.name,g.group_name,m.message_id,m.message,m.group_id,m.user_id as muid,m.message_sent_to as m_by');
		$this->db->from('messages_tbl m');
		$this->db->join('da_users_tbl u','m.user_id=u.user_id','left');
		$this->db->join('user_groups_tbl g','g.group_id=m.group_id','left');
		$this->db->like('name',$string,'after');
		$this->db->or_like('group_name',$string,'after');
		$search = $this->db->get();
		return $search->result();
	}

	public function delete_msg($where,$table)
	{
		$delete = $this->db->delete($table,$where);
		return $delete;
	}

	public function common_search($str,$table)
	{
		$this->db->select('*');
		$this->db->where('email',$str);
		$this->db->or_where('mobile',$str);
		$this->db->or_like('name', $str,'after');
	    return	$this->db->get($table)->result_array();
	}

	public function admin_change_password($swhere,$uwhere,$table,$data)
	{
		$this->db->select('*');
		$count=$this->db->where($swhere)->get($table)->num_rows();
		if($count==1){
			$this->db->where($uwhere);
		    $up = $this->db->update($table,$data);
		    $res=$this->db->affected_rows();
		    if($res>0){
				return 1;
				}
				else{
					return 2;
				}
		}
		else{
		    return 3;
		}				
	}
	
	public function common_check_update($email,$mobile,$id)
	{
		$where=array('email'=>$email,'mobile'=>$mobile);
		return	$this->db->select('*')->where('user_id',$id)->where($where)->get('su_users_tbl')->num_rows();
	}
	public function drunkDriveFetch($id)
	{
		
		$this->db->select("*")->from('da_users_tbl u')->join('da_drnuk_tbl d','d.user_id=u.user_id')->join('da_drivers_drunk_tbl dd','d.drunk_case_id=dd.drunk_case_id')->where('dd.drunk_case_id',$id);
		$sql = $this->db->get();
		$count = $sql->num_rows();
		if($count > 0)
		{
			$response['code']=SUCCESS_CODE;
			$response['data']=$sql->result();
		}
		else
		{
			$response['code']=FAIL_CODE;
			$response['data']=array();
		}
		return json_encode($response);
	}	
	public function licenseWithoutFetch($id)
	{
		
		$this->db->select("*")->from('da_users_tbl u')->join('da_with_out_license_tbl d','d.user_id=u.user_id','right')->join('da_drivers_license_tbl dd','d.license_case_id=dd.license_id')->where('dd.license_id',$id);
		$sql = $this->db->get();
		$count = $sql->num_rows();
		if($count > 0)
		{
			$response['code']=SUCCESS_CODE;
			$response['data']=$sql->result();
		}
		else
		{
			$response['code']=FAIL_CODE;
			$response['data']=array();
		}
		return json_encode($response);
	}	
	public function get_slider($table,$nr,$i)
{
	$this->db->limit($nr,$i);
	$this->db->order_by('slider_id','desc');
	$r=$this->db->get($table);
	//echo $this->db->last_query();exit;
	//echo "<pre>";
	//print_r($r->result());exit;
	return $r;
}
public function search_slider($str,$table){
	$this->db->select('*');
	$this->db->like('slider_title', $str);
return	$this->db->get($table)->result_array();
}
public function accidentInspectionFetch($id)
	{	$this->db->select("*")->from('da_users_tbl u')->join('da_accident_inspection_report_tbl a','a.user_id=u.user_id')->where('a.accident_id',$id);
		$sql = $this->db->get();
		$count = $sql->num_rows();
		if($count > 0)
		{
			$response['code']=SUCCESS_CODE;
			$response['data']=$sql->result();
		}
		else
		{
			$response['code']=FAIL_CODE;
			$response['data']=array();
		}
		return json_encode($response);
	}	
	
}
?>