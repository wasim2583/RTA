<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Message_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
 }
 	  public function get_message_mobile($uid) {
		$this->db->select('mobile');
        $this->db->where('user_id', $uid);
        $query = $this->db->get('da_users_tbl');
        $count = $query->num_rows();
        if ($count > 0) {

            $result = $query->row();
        }else{
			$result = null;
		}
          $result= json_encode($result);
        return $result;
        //print_r($result);
       }
public function register_message($table,$data){
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
public function get_message_details($id){
	//$data=$this->db->select('user_id,name')->where('user_id',$id)->get('da_users_tbl')->result();
	$data=$this->db->select('u.user_id,u.name,gm.member_id,gm.group_id,gm.user_id,ug.group_name,ug.group_pic,ug.created_by,m.message_id,m.message,m.group_id,m.user_id,m.message_sent_to')
  ->from('da_users_tbl u')
 ->join('groups_members_tbl gm','gm.user_id=u.user_id')
 ->join('user_groups_tbl ug','ug.group_id=gm.group_id')
 ->join('messages_tbl m','m.user_id=u.user_id')->get()->result();
	return $data;
}

}
?>