<?php
class Frontend_model extends CI_model
{
	   public function __construct() {
        parent::__construct();
        date_default_timezone_set('asia/kolkata');
        $this->date=date('Y-m-d');
    }

  public function tutor_get_rows($table){
	// $this->db->select("first_name");
    	$res=$this->db->get($table);
          $count=$res->num_rows();
          return $count;
}
public function common_check($table,$where){
	$count=$this->db->where($where)->get($table)->num_rows();
	//echo $this->db->last_query();exit;
	   return $count;
}


public function tutor_display_recs($nr,$si){
	// echo "model";exit;
	$this->db->select("user.name,user.unique_id,tutor.photo,tutor.user_id,tutor.experience,tutor.gender,tutor.dob,tutor.location_name,tutor.mobile,tutor.email,tutor.id,tutor.tutor_status,group_concat(distinct(sub.subject_name)) as subjects,q.qualification,group_concat(distinct(syl.syllabus_name)) as syls,group_concat(distinct(cat.category_name)) as cats,group_concat(distinct(rloc.location)) as location");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
$this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
$this->db->join('rl_users_tbl user','user.id=tutor.user_id','inner');
$this->db->join('rl_qualification_tbl q','q.qid=tutor.qualification','inner');
$this->db->join('rl_tutor_syllabus_tbl rsyl','rsyl.user_id=tutor.user_id','inner');
$this->db->join('rl_syllabus_tbl syl','syl.syllabus_id=rsyl.syllabus_id','inner');
$this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
$this->db->join('rl_category_tbl cat','cat.category_id=rcat.category_id','inner');
$this->db->join('rl_tutor_timing_tbl rtime','rtime.user_id=tutor.user_id','inner');
$this->db->join('rl_tutor_location_tbl rloc','rloc.user_id=tutor.user_id','inner');
$this->db->where("tutor.tutor_status",1);
$this->db->order_by("tutor.user_id",'ASC');
$this->db->group_by("tutor.user_id");
	   $this->db->limit($nr,$si);
		$res=$this->db->get();

		 // echo $this->db->last_query();exit;
		$result=$res->result();
		//$user_ids = array();
		foreach($result as $row){
			//print_r($row);exit;	
			$user_id = $row->user_id;
			$this->db->select('id')->from('rl_tutor_views_tbl v')->where('v.user_id',$user_id);
			$response = $this->db->get()->result();
			$num_views = count($response);
			$row->views = $num_views;
		}
		// print_r($result);exit;
		return $result;
	}
public function tutor_search_get($table){
 	$res=$this->db->get($table);
 	$result=$res->result();
 	return $result;
 }

public function tutor_search($searchstr=null,$where=null,$nr=null,$si=null){
	// print_r($searchstr);exit;
	// echo $nr.$si;exit;

		$this->db->select("tutor.user_id,user.unique_id,tutor.photo,tutor.gender,tutor.first_name,tutor.experience,tutor.dob,tutor.location_name,group_concat(distinct(sub.subject_name)) as subjects,user.name,q.qualification,group_concat(distinct(rloc.location)) as location");
	$this->db->from("rl_tutor_tbl tutor");
	//$this->db->join('rl_location_tbl loc','loc.location_id=tutor.location_id','inner');
	$this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
$this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');

$this->db->join('rl_qualification_tbl q','q.qid=tutor.qualification','inner');

if(!empty($where))
{
if(array_key_exists('rsyl.syllabus_id',$where))
        {
$this->db->join('rl_tutor_syllabus_tbl rsyl','rsyl.user_id=tutor.user_id','inner');
        }
}
$this->db->join('rl_users_tbl user','user.id=tutor.user_id','inner');
//$this->db->join('rl_syllabus_tbl syl','syl.syllabus_id=tutor.syllabus','inner');
$this->db->join('rl_tutor_location_tbl rloc','rloc.user_id=tutor.user_id','inner');
 if(!empty($where))
{
if(array_key_exists('rcat.category_id',$where))
        {
$this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
       }
   }
   if(!empty($where))
   {
$this->db->where($where);
}
// if(!empty($searchstr))
// {
// $this->db->like($searchstr);
// }
if(!empty($searchstr))
{
	$this->db->where($searchstr);
}
$this->db->order_by("tutor.user_id",'ASC');
$this->db->group_by("tutor.user_id");
	   $this->db->limit($nr,$si);
		$res=$this->db->get();
		// echo $this->db->last_query();exit;
		$count=$res->num_rows();
		$result=$res->result();
			foreach($result as $row){
			//print_r($row);exit;	
			$user_id = $row->user_id;
			$this->db->select('id')->from('rl_tutor_views_tbl v')->where('v.user_id',$user_id);
			$response = $this->db->get()->result();
			$num_views = count($response);
			$row->views = $num_views;
		}
		//print_r($result);exit;
		return array('query1'=>$count,'query2'=>$result);
}
public function common_update($table,$where,$data){
	$res=$this->db->where($where)->update($table,$data);
	// echo $this->db->last_query();exit;
	return $res;
}
public function common_insert($table,$data){
	$res=$this->db->insert($table,$data);
	return $res;
}
public function get_tutor_multiple_cats($where){
	$this->db->select("tutor.user_id,group_concat(cat.category_name) as cats,cat.category_id");
	$this->db->from("rl_tutor_tbl tutor");
// $this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
// $this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
$this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
$this->db->join('rl_category_tbl cat','cat.category_id=rcat.category_id','inner');
$this->db->group_by("tutor.user_id");
$this->db->where($where);
        $res=$this->db->get();
		 //echo $this->db->last_query();exit;
		$result=$res->result();
		return $result;
}
public function get_tutor_multiple_catsid($where){
	$this->db->select("group_concat(cat.category_id) as catsid");
	$this->db->from("rl_tutor_tbl tutor");
// $this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
// $this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
$this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
$this->db->join('rl_category_tbl cat','cat.category_id=rcat.category_id','inner');
$this->db->where($where);
        $res=$this->db->get();
		 // echo $this->db->last_query();exit;
		$result=$res->result();
		// print_r($result);exit;
		return $result;
}

public function get_tutor_multiple_sub($where){
	$this->db->select("tutor.user_id,group_concat(sub.subject_name) as subjects,group_concat(sub.subject_id) as subjectids");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
$this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
// $this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
// $this->db->join('rl_category_tbl cat','cat.category_id=rcat.category_id','inner');
$this->db->group_by("tutor.user_id");
$this->db->where($where);
        $res=$this->db->get();
        //echo $this->db->last_query();exit;
		$result=$res->row();
		return $result;
}
public function get_tutor_multiple_subid($where){
	$this->db->select("group_concat(sub.subject_id) as subid");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
$this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
$this->db->where($where);
        $res=$this->db->get();
        //echo $this->db->last_query();
		$result=$res->result();
		//print_r($result);
		return $result;
}
public function get_tutor_multiple_lang($where){
	$this->db->select("group_concat(lang.language) as langs");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_language_tbl rlang','rlang.user_id=tutor.user_id','inner');
$this->db->join('rl_language_tbl lang','lang.lid=rlang.language_id','inner');
$this->db->where($where);
$this->db->group_by('tutor.user_id');
        $res=$this->db->get();
        //echo $this->db->last_query();exit;
		$result=$res->result();
		return $result;
}
public function get_tutor_multiple_langid($where){
	$this->db->select("group_concat(lang.lid) as langid");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_language_tbl rlang','rlang.user_id=tutor.user_id','inner');
$this->db->join('rl_language_tbl lang','lang.lid=rlang.language_id','inner');
$this->db->where($where);
        $res=$this->db->get();
        //echo $this->db->last_query();exit;
		$result=$res->result();
		return $result;
}
public function get_tutor_multiple_syl($where){
	$this->db->select("tutor.user_id,group_concat(syl.syllabus_name) as syllabus");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_syllabus_tbl rsyl','rsyl.user_id=tutor.user_id','inner');
$this->db->join('rl_syllabus_tbl syl','syl.syllabus_id=rsyl.syllabus_id','inner');
$this->db->group_by("tutor.user_id");
$this->db->where($where);
        $res=$this->db->get();
        //echo $this->db->last_query();exit;
		$result=$res->result();
		return $result;
}
public function get_tutor_multiple_sylid($where){
	$this->db->select("group_concat(syl.syllabus_id) as sylid");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_syllabus_tbl rsyl','rsyl.user_id=tutor.user_id','inner');
$this->db->join('rl_syllabus_tbl syl','syl.syllabus_id=rsyl.syllabus_id','inner');
// $this->db->group_by("tutor.user_id");
$this->db->where($where);
        $res=$this->db->get();
        //echo $this->db->last_query();exit;
		$result=$res->result();
		return $result;
}
public function get_tutor_multiple_adhaar($where){
	$this->db->select("adhaar_proof_name as adhaar");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_adhaar_tbl adhaar','adhaar.user_id=tutor.user_id');
$this->db->where($where);
// $this->db->group_by('tutor.user_id');
        $res=$this->db->get();
        // echo $this->db->last_query();exit;
		$result=$res->result();
		return $result;
	}
public function common_get($table,$where){
	$res=$this->db->where($where)->get($table)->row();
	 // echo $this->db->last_query();exit;
	return $res;

}
public function common_delete($table,$where){
	$res=$this->db->where($where)->delete($table);
	return $res;
}
public function display_single_recs($where,$user_id=null){
$this->db->select("user.unique_id,user.name,tutor.photo,tutor.user_id,tutor.experience,tutor.gender,tutor.dob,tutor.location_name,tutor.mobile,tutor.email,tutor.id,tutor.tutor_status,tutor.about_tutor,group_concat(distinct(sub.subject_name)) as subjects,q.qualification,group_concat(distinct(syl.syllabus_name)) as syls,group_concat(distinct(cat.category_name)) as cats,group_concat(distinct(lang.language)) as langs,group_concat(distinct(rtime.timing)) as times,group_concat(distinct(rloc.location)) as location");
	$this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
$this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
$this->db->join('rl_users_tbl user','user.id=tutor.user_id','inner');
$this->db->join('rl_qualification_tbl q','q.qid=tutor.qualification','inner');
$this->db->join('rl_tutor_syllabus_tbl rsyl','rsyl.user_id=tutor.user_id','inner');
$this->db->join('rl_syllabus_tbl syl','syl.syllabus_id=rsyl.syllabus_id','inner');
$this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
$this->db->join('rl_category_tbl cat','cat.category_id=rcat.category_id','inner');
$this->db->join('rl_tutor_timing_tbl rtime','rtime.user_id=tutor.user_id','inner');
$this->db->join('rl_tutor_language_tbl rlang','rlang.user_id=tutor.user_id','inner');
$this->db->join('rl_language_tbl lang','lang.lid=rlang.language_id','inner');
$this->db->join('rl_tutor_location_tbl rloc','rloc.user_id=tutor.user_id','inner');
$this->db->where($where);
// $this->db->order_by("tutor.user_id",'ASC');
 $this->db->group_by("tutor.user_id");
	   //$this->db->limit($nr,$si);
		$res=$this->db->get();
		 //echo $this->db->last_query();exit;
		$data['tutor_recs']=$res->result();
		if(!empty($user_id))
		{
		$where2=array('user_id'=>$user_id);
		$data['views']=$this->db->where($where2)->get('rl_tutor_views_tbl')->num_rows();
	   }
		return $data;
	}
	public function common_get_all($table){
		$res=$this->db->where('reply_status',1)->get($table)->result();
		return $res;
	}
	public function common_get_total($table){
		$res=$this->db->get($table)->result();
		return $res;

	}

	public function get_subject_data($ids)
		{
			$response = array();
			$this->db->select("sub.subject_name,sub.subject_id");
			$this->db->from("rl_class_subjects_tbl rsub.class_id");
			$this->db->join("rl_subjects_tbl sub","sub.subject_id=rsub.subject_id");
			$this->db->where("rsub.class_id",$ids);
			$query = $this->db->get();
			$return=$query->result();
			if(count($return)>0){
				$response[CODE]=SUCCESS_CODE;
				$response[MESSAGE]='success';
				$response[DESCRIPTION]="Data avaliable";
				$response["subject_result"]=$return;
			}else{
				$response[CODE]=FAIL_CODE;
				$response[MESSAGE]='Fail';
				$response[DESCRIPTION]="Errorr in fetching data";
			}return json_encode($response);
		}
/* vivek code start her4e for maildata fetch*/

 public function get_email_data($id)
        {

            $this->db->select('lprt.*,cam.category_name,syll_mas.syllabus_name,group_concat(distinct(sub_mas.subject_name)) as subject_name,cl.class_name,post_time.tuition_time');
            $this->db->from('learning_post_requirement_tbl as lprt');
            $this->db->join('rl_category_tbl as cam','cam.category_id=lprt.category');
            $this->db->join('rl_syllabus_tbl as syll_mas','syll_mas.syllabus_id=lprt.syllabus');
            $this->db->join('rl_requirement_post_subject_tbl as post_sub','post_sub.requirement_id=lprt.id');
            $this->db->join('rl_subjects_tbl as sub_mas','sub_mas.subject_id=post_sub.subject_name_id');
             $this->db->join('rl_requirement_post_time_tbl as post_time','post_time.requirement_id=lprt.id');
             $this->db->join('rl_class_tbl  cl','cl.class_id=lprt.class');
            
            $this->db->where('lprt.id',$id);
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            //print_r($query->result());
            if(count($query->result())>0){
            return $query->result();
            }else{
            return false;
            }
        }
 public function notification_add($str)
       {
        $arr=explode(',',$str);
       	$count=count($arr);
       	for($i=0;$i<$count;$i++)
       	{
       		$where=array('feedback_id'=>$arr[$i]);
       	$this->db->or_where($where);
       	$this->db->where('status',1);
        }
       	$result=$this->db->get('rl_parent_feedback_tbl');
       	// echo $this->db->last_query();exit;
         $res=$result->result();
         if($result->num_rows()>0)
         {
          date_default_timezone_set('asia/kolkata');
         foreach($res as $row)
         {
            $data[]=array('user_id'=>$row->parent_user_id,'notification_msg'=>'you may view one more contact','relation'=>'feedback','added_on'=>date('Y-m-d H:i:s'),'feedback_id'=>$row->feedback_id);
         }
         $res=$this->db->insert_batch('rl_notification_tbl',$data);
     }
}
public function generate_csv_report_db()
	{
		date_default_timezone_set('asia/kolkata');
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$delimiter=",";
		$newline="\r\n";
		$filename='Tutor_List'.'('.date("d-m-Y H:i:s").')'.'.csv';
$this->db->select("payment.payment_status as payment satatus,user.name,tutor.experience,tutor.gender,tutor.dob,tutor.location_name as location,tutor.mobile,tutor.email,tutor.id,tutor.tutor_status as tutor status,group_concat(distinct(sub.subject_name)) as subjects,q.qualification,group_concat(distinct(syl.syllabus_name)) as syllabus,group_concat(distinct(cat.category_name)) as category,group_concat(distinct(rloc.location)) as location");
    $this->db->from("rl_tutor_tbl tutor");
$this->db->join('rl_tutor_subjects_tbl rsub','rsub.user_id=tutor.user_id','inner');
$this->db->join('rl_subjects_tbl sub','sub.subject_id=rsub.subject_id','inner');
$this->db->join('rl_users_tbl user','user.id=tutor.user_id','inner');
$this->db->join('rl_qualification_tbl q','q.qid=tutor.qualification','inner');
$this->db->join('rl_tutor_syllabus_tbl rsyl','rsyl.user_id=tutor.user_id','inner');
$this->db->join('rl_syllabus_tbl syl','syl.syllabus_id=rsyl.syllabus_id','inner');
$this->db->join('rl_tutor_category_tbl rcat','rcat.user_id=tutor.user_id','inner');
$this->db->join('rl_category_tbl cat','cat.category_id=rcat.category_id','inner');
$this->db->join('rl_tutor_timing_tbl rtime','rtime.user_id=tutor.user_id','inner');
$this->db->join('rl_user_payment_info_tbl payment','payment.user_id=tutor.user_id','left');
$this->db->join('rl_tutor_location_tbl rloc','rloc.user_id=tutor.user_id','inner');
$this->db->order_by("tutor.user_id",'ASC');
$this->db->group_by("tutor.user_id");
       // $this->db->limit($nr,$si);
     $res=$this->db->get();
     
     // print_r($query_resp);exit;
$resp=$this->dbutil->csv_from_result($res,$delimiter,$newline);
		force_download($filename,$resp);
	}
public function generate_csv_report_db2($table)
    {
        date_default_timezone_set('asia/kolkata');
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter=",";
        $newline="\r\n";
        $filename='Parent_List'.date("d-m-Y H:i:s").'.csv';
    $where=array('user_type'=>2,'user_status'=>1);
 $res=$this->db->select('name,email,mobile,registered_on')->where($where)->get($table);
     
     // print_r($query_resp);exit;
$resp=$this->dbutil->csv_from_result($res,$delimiter,$newline);
        force_download($filename,$resp);
    }
    public function payment_file_get($search=null,$where=null){
    	 date_default_timezone_set('asia/kolkata');
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter=",";
        $newline="\r\n";
        $filename='Payment_List'.date("d-m-Y H:i:s").'.csv';
    $this->db->select("pay.name,pay.amount,pay.transaction_id,pay.payment_mode as  payment mode,pay.status_desc as payment status,pay.payment_date as payment date,user.email,user.mobile");
    $this->db->from("rl_user_payment_info_tbl pay");
$this->db->join('rl_users_tbl user','user.id=pay.user_id','inner');
$this->db->order_by("pay.payment_date",'desc');
       if(!empty($search))
       {
        $this->db->group_start();
        $this->db->or_like($search);
        $this->db->group_end();
    }
    if(!empty($where))
    {
        // echo "hii";exit;
    // print_r($where);exit;
     $this->db->where($where);
    }
        $res=$this->db->get();
       $resp=$this->dbutil->csv_from_result($res,$delimiter,$newline);
        force_download($filename,$resp);
    } 
    public function weekly_check($table,$user_id){
	// $where=array('added_on'=>)
	$sql_query="select * from $table where  user_id=$user_id && added_on >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
	$res=$this->db->query($sql_query);
	$count=$res->num_rows();
	return $count;      		
}
public function tutor_access_count($table,$user_id){
	$res=$this->db->where(['user_id'=>$user_id,'payment_status'=>1])->get("rl_user_payment_info_tbl")->row();
	//print_r($res);exit;
	if(count($res)>0)
	{
         $paydate1=$res->payment_date;
        $year_start=date('Y-m-d',strtotime($paydate1));
        $date=date_create($year_start);
        date_add($date,date_interval_create_from_date_string("1 YEAR"));
        $expiry_date=date_format($date,"Y-m-d");
        $exp_seconds=strtotime($expiry_date);
        $date=strtotime($this->date);
         // echo $pay_date." ".$this->date;exit;
        if($date>=$exp_seconds)
        {
           $this->db->where(['user_id'=>$user_id,'payment_status'=>1])->update("rl_user_payment_info_tbl",['yearly_access_expiry_date'=>$expiry_date]);
           $res=$this->db->where(['user_id'=>$user_id,'payment_status'=>1])->get("rl_user_payment_info_tbl")->row();

        }
          // echo $paydate;exit;
          $expiry=$res->yearly_access_expiry_date;
           // echo $expiry;exit;
          if($expiry!='0000-00-00')
          {
          	$year_start=$expiry;
          }
           // echo $paydate;exit;
        $date=date_create($year_start);
        date_add($date,date_interval_create_from_date_string("1 YEAR"));
        $expiry_date=date_format($date,"Y-m-d");
        $exp_seconds=strtotime($expiry_date);
        $date=strtotime($this->date);
         // echo $pay_date." ".$this->date;exit;
        if($date>=$exp_seconds)
        {
           // echo "hii";exit;
           $this->db->where(['user_id'=>$user_id,'payment_status'=>1])->update("rl_user_payment_info_tbl",['yearly_access_expiry_date'=>$expiry_date]);

        }
     }
        
	else
	{
		$expiry_date=$this->date;
	}
$sql_query="select * from $table where  user_id=$user_id && added_on >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
	$res=$this->db->query($sql_query);
	$data['month_view']=$res->num_rows();
	$sql_query="select * from $table where  user_id=$user_id && added_on>='$year_start' and added_on<'$expiry_date'";
	$res=$this->db->query($sql_query);
	$data['year_view']=$res->num_rows();
	// echo $data['year_view'];exit;
	return $data;
}
public function get_tutor_multiple_times($where)
{
	$this->db->select("timing");
	$this->db->from("rl_tutor_timing_tbl tt");
	$this->db->join('rl_tutor_tbl tutor','tutor.user_id=tt.user_id');
	$this->db->where($where);
	$res=$this->db->get();
	$result=$res->result();
	return $result;	
}
public function get_tutor_multiple_locations($where)
{
	$this->db->select("tl.location,tl.latitude,tl.longitude");
	$this->db->from("rl_tutor_location_tbl tl");
	$this->db->join('rl_tutor_tbl tutor','tutor.user_id=tl.user_id');
	$this->db->where($where);
	$res=$this->db->get();
	$count = $res->num_rows();
	$response = array();
	$response[CODE] = ($count>0)?SUCCESS_CODE:FAIL_CODE;
	$response['res']= ($count>0)?$res->result():array();
	$response['count']=$count;
	return json_encode($response);
}
}
?>

	