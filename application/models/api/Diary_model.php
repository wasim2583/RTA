<?php
defined('BASEPATH') or die('Please set up the configuration');

Class Diary_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
		date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
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
        // $res=$res->result();FORMATDATE(date,'%m-%d-%y') AS dateM
        return json_encode($response);
    }
public function get_user_diary_data($id){
		$data=array();
$data=$this->db->select('diary_id,title,description,DAY(diary_date) AS day,date_format(diary_date,"%b") AS month,YEAR(diary_date) AS year,DATE_FORMAT(diary_date,"%d %b %Y") AS written_on')
							->from('da_diary_tbl')
							->where('written_by',$id)->where("DATE(diary_date)",DATE("y-m-d"))->order_by('diary_date','DESC')->get()->result();
							foreach($data as $row){
							 $descript=substr($row->description,0,120);
							 if(strlen($row->description)>120)
							 {
								 $row->description = $descript.'...';
							 }
							}
							return $data;

}
//where('sh_employee_visits_tbl.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"')
public function get_user_diary_data_between1($id,$from,$to){
		$data=array();
$data=$this->db->select('diary_id,title,description,DAY(diary_date) AS day,date_format(diary_date,"%b") AS month,YEAR(diary_date) AS year,DATE_FORMAT(diary_date,"%d %b %Y") AS written_on')
							->from('da_diary_tbl')
							->where('written_by',$id)->where('diary_date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"')->order_by('diary_date','ASC')->get()->result();
							foreach($data as $row){
							 $descript=substr($row->description,0,120);
							 if(strlen($row->description)>120)
							 {
								 $row->description = $descript.'...';
							 }
							}
							return $data;

}
public function get_user_diary_data_between($id,$from="",$to=""){
		$data=array();
							$this->db->select('diary_id,title,description,DAY(diary_date) AS day,date_format(diary_date,"%b") AS month,YEAR(diary_date) AS year,DATE_FORMAT(diary_date,"%d %b %Y") AS written_on')
							->from('da_diary_tbl')
							->where('written_by',$id);
							if(!empty($from) && !empty($to)){
							$this->db->where('diary_date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
							}							
						$data=$this->db->order_by('diary_date','ASC')->get()->result();
							
							foreach($data as $row){
							 $descript=substr($row->description,0,120);
							 if(strlen($row->description)>120)
							 {
								 $row->description = $descript.'...';
							 }
							}
							return $data;

}
public function get_user_diary_data1($id){
		$data=array();
$data=$this->db->select('diary_id,title,description,DAY(written_on) AS day,date_format(written_on,"%b") AS month,YEAR(written_on) AS year,DATE_FORMAT(written_on,"%d %b %Y") AS written_on')
							->from('da_diary_tbl')
							->where('written_by',$id)->get()->result();
							foreach($data as $row){
							 $descript=substr($row->description,0,120);
							 if(strlen($row->description)>120)
							 {
								 $row->description = $descript.'...';
							 }
							}
							return $data;

}
public function get_single_diary_data($id){
		$data=array();
$data=$this->db->select('title,description ,date_format(written_on,"%W") AS dayname,DATE_FORMAT(written_on,"%d %b %Y") AS written_on')
							->from('da_diary_tbl')
							->where('diary_id',$id)->get()->row();
							return $data;

}
}
?>