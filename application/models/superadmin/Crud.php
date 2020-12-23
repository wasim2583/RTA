<?php
defined('BASEPATH') or die('Please set up the configuration');

Class crud extends CI_Model
{
    public function __construct() {
        parent::__construct();
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
    public function commonInsert($table, $insertdata, $displaymessage = NULL, $debug = NULL)
    {
        $response = array();
        //$sql_show= $this->db->set($insertdata)->get_compiled_insert($table);
        if (is_array($insertdata)) {
             $sql = $this->db->insert_string($table, $insertdata);
            
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $insert = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        if ($insert) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                            $response[INSERTED_ID] = $this->db->insert_id();
                        } else {
                            throw new Exception('Error occured while inserting data');
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Databse Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                  //  $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }

    public function common_insert($params)
    {
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Valiadtion';
                        $response['description']='Invalid input parameters';
                }
                else
                {
                        $table_name=  isset($params['table_name'])?$params['table_name']:'';
                        $table_insert_data=isset($params['insert_data'])?$params['insert_data']:'';
                        $success_message=isset($params['success_message'])?$params['success_message']:'';
                        $error_message=isset($params['error_message'])?$params['error_message']:'';
                        $debug=isset($params['debug'])?$params['debug']:0;
                        if(!empty($table_name) && is_array($table_insert_data) && (count($table_insert_data) > 0))
                        {
                                $table_name=  trim($table_name);
                                //Insert condition
                                $insert_sql=$this->db->insert_string($table_name,$table_insert_data);
                                if($debug==0)
                                {
                                    $success_message=($success_message!='')?$success_message:'Inserted successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to insert';
                                    $insert=  $this->db->query($insert_sql);
                                    //echo $this->db->last_query();exit;
                                    $db_error=  $this->db->error();
                                    if($db_error['code']==0)
                                    {
                                        $insert_row_count=  $this->db->affected_rows();
                                        $last_insert_id=  $this->db->insert_id();
                                        $response['code']=($insert_row_count > 0)?200:204;
                                        $response['message']=($insert_row_count > 0)?'success':'fail';
                                        $response['description']=($insert_row_count > 0)?$success_message:$error_message;
                                        $response['insert_id']=($insert_row_count > 0)?$last_insert_id:0;
                                    }
                                    else
                                    {
                                        $response['code']=575;
                                        $response['message']='Data base error';
                                        $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Please inform to support team';
                                    }
                                }
                                else
                                {
                                    $response['code']=575;
                                    $response['message']='Debug mode';
                                    $response['description']=$insert_sql;
                                }
                        }
                        else
                        {
                                $response['code']=301;
                                $response['message']='Valiadtion';
                                $response['description']='Table name or insert data is missing';
                        }
                }
                return json_encode($response);
    }
    
    public function common_update($params)
    {
        //echo "test";exit;
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Valiadtion';
                        $response['description']='Invalid input parameters';
                }
                else
                {
                        $table_name=  isset($params['table_name'])?$params['table_name']:'';
                        $table_update_data=isset($params['update_data'])?$params['update_data']:'';
                        $table_update_condition=isset($params['update_condition'])?$params['update_condition']:'';
                        $success_message=isset($params['success_message'])?$params['success_message']:'';
                        $error_message=isset($params['error_message'])?$params['error_message']:'';
                        $debug=isset($params['debug'])?$params['debug']:0;
                        if(!empty($table_name) && is_array($table_update_data) && (count($table_update_data) > 0) && is_array($table_update_condition) && (count($table_update_condition) > 0))
                        {
                                $table_name=  trim($table_name);
                                //Insert condition
                                $update_sql=$this->db->update_string($table_name,$table_update_data,$table_update_condition);
                                if($debug==0)
                                {
                                    $success_message=($success_message!='')?$success_message:'updates successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to update';
                                    $update=  $this->db->query($update_sql);
                                    //echo $this->db->last_query();exit;
                                    $db_error=  $this->db->error();
                                    if($db_error['code']==0)
                                    {
                                        $update_row_count=  $this->db->affected_rows();
                                        $response['code']=($update_row_count > 0)?200:204;
                                        $response['message']=($update_row_count > 0)?'success':'fail';
                                        $response['description']=($update_row_count > 0)?$success_message:$error_message;
                                    }
                                    else
                                    {
                                        $response['code']=575;
                                        $response['message']='Data base error';
                                        $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Please inform to support team';
                                    }
                                }
                                else
                                {
                                    $response['code']=575;
                                    $response['message']='Debug mode';
                                    $response['description']=$update_sql;
                                }
                        }
                        else
                        {
                                $response['code']=301;
                                $response['message']='Valiadtion';
                                $response['description']='Table name or insert data is missing';
                        }
                }
                return json_encode($response);
    }

    public function common_delete($table,$conditionarray)
    {
        $response=array();
        $sql=$this->db->delete($table,$conditionarray);
        $action=$this->db->affected_rows();
            $response['code']='200';
            $response['message']='Success';
            $response['description']=$action.' Deleted Succesfully !!!';
         return json_encode($response);
    }
    //Check existance Code Start*/
    public function checkExistance($colname,$table,$checkarray)
    {
        $check=$this->db->select($colname)->from($table)->where($checkarray)->get()->num_rows();
        //print_r($this->db);
        return ($check > 0)?1:0;/*If Existance it will retuen 1 else 0*/
    }
    //Multiple  Insert
    public function batchInsert($table,$insertdata,$displaymessage=NULL)
    {
        $response=array();
        $sql=$this->db->insert_batch($table,$insertdata);
        $affected_rows=$this->db->affected_rows();
        $response['code']=($affected_rows > 0)?200:204;
        $response['message']=($affected_rows > 0)?'Success':'Fail';
        $response['description']=($affected_rows > 0)?"$affected_rows  records added successfully":'Unable to insert';
        return json_encode($response);
    }
    
    /*
      |--------------------------------------------------------------------------
      | Function : check(column,tablename,wherecondition)
      |--------------------------------------------------------------------------
      |  column          :  Search ID (Single column name)
      |  tablename      :  table name
      |  wherecondition :  colmnname => inputdata (wherecondition should be in array format)
      |  Example        :  commonCheck('ID','table_name',array('colmn'=>'abcd','colmn2'=>'abcd'));
      |  Result         :   It will return 0 or 1.(If count exists it will return 1 other wise it will return as 0)
     */

    public function commonCheck($cols, $table, $wherecondition) {
        $count = $this->db->select($cols)->from($table)->where($wherecondition)->get()->num_rows();
        return ($count > 0) ? 1 : 0;
    }

    public function getEmail($cols,$table,$where_col,$id)
    {
        $response=array();
        $this->db->select($cols)->from($table);
        $sql_fetch=$this->db->where_in($where_col,$id)->get();
        //print_r($sql_fetch);exit;
        $db_error =  $this->db->error();
        if($db_error['code']!=0)
        {
                $response['code']='575';
                $response['message']='DB Error';
                $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {       //if()
                $count=$sql_fetch->num_rows();
                $response['code']=($count  > 0 )?200:204;
                $response['message']=($count  > 0 )?'Success':'Fail';
                $response['description']=($count  > 0 )?'Getting the user llist':'No results found';
                $response['result_count']=$count;
                $response['common_result']=($count  > 0 )?$sql_fetch->row():(object) null;
        }
        return json_encode($response);
    }

    public function getEmailMulti($cols,$table,$where_col,$id)
    {
        $response=array();
        $this->db->select($cols)->from($table);
        $sql_fetch=$this->db->where_in($where_col,$id)->get();
        //print_r($sql_fetch);exit;
        $db_error =  $this->db->error();
        if($db_error['code']!=0)
        {
                $response['code']='575';
                $response['message']='DB Error';
                $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {       //if()
                $count=$sql_fetch->num_rows();
                $response['code']=($count  > 0 )?200:204;
                $response['message']=($count  > 0 )?'Success':'Fail';
                $response['description']=($count  > 0 )?'Getting the user llist':'No results found';
                $response['result_count']=$count;
                $response['common_result']=($count  > 0 )?$sql_fetch->result():(object) null;
        }
        return json_encode($response);
    }

    public function common_record_count($cols,$table_name,$order_by_col)
    {       
        $sql=$this->db->select($cols)->from($table_name)
        ->order_by($order_by_col,'DESC')->get();
        $count=$sql->num_rows();
        return $count;
    }
    public function common_record_count2($cols,$table_name,$order_by_col,$where,$or_where=NULL)
    {       
        $sql=$this->db->select($cols);
        if(!empty($where))
        {
            $this->db->where($where);
        }
        $this->db->order_by($order_by_col,'DESC');
        $sql=$this->db->get($table_name);
        $count=$sql->num_rows();
        return $count;
    }
    
    public function common_list_paging($cols,$table_name,$like_col,$orderby=null,$limit=null,$start,$search,$where=null,$searchstr=null,$or_like_col=null,$join_tbl=NULL,$join_condition=NULL)
    {
        //print_r($like_col);
        $response=array();
        $this->db->select($cols)->from($table_name);
        if(!empty($join_tbl))
        {
            $this->db->join($join_tbl,$join_condition);
        }
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'both') : '';
        }
      if ($or_like_col != '') {
           $this->db->or_like($or_like_col,$search,'both');
        }
        if($searchstr!=''){
            $this->db->group_start();
             ($searchstr != '') ? $this->db->or_like($searchstr,'both') : '';
             $this->db->group_end();
        }
        if(!empty($where))
        {
            $this->db->where($where);
        }
        $query=$this->db->order_by($orderby,'desc')->get();
        //echo $this->db->last_query();
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
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['count']=$count;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }
    public function commonStatusActivity($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $updateStatus=($updatevalue==1)?'Activated':'De-activated';
        $sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($sql);
         $response['test']= $sql;
        $update=$this->db->affected_rows();
        $response[CODE]=($update > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($update > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($update > 0)?"<b>$update</b> record $updateStatus successfully":'Unable to update';
        return json_encode($response);
    }
    public function commonDelete($table,$condition,$relationname)
    {
        $response=array();
        $sql=$this->db->delete($table,$condition);
        $delete=$this->db->affected_rows();
        $response[CODE]=($delete > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($delete > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($delete > 0)?"<b>$delete</b> $relationname":'Unable to delete';
        return json_encode($response);
    }
    /*>>Getting data from table using single where condition code starts*/
    public function getDataWhere($cols,$table_name,$where_col,$where_col_val,$list_name)
    {
        $response=array();
        $this->db->select($cols)->from($table_name);
        $query=$this->db->where($where_col,$where_col_val)->get();
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
            $response['description']=($count  > 0 )?'Getting the '.$list_name.' data':'No results found';
            $response['result_count']=$count;
            $response[($list_name!='')?$list_name:'common_result']=($count  > 0 )?$query->row():(object) null;
        }
        return json_encode($response);
    }
    /*<<Getting data from table using single where condition code ends*/

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

    /*>>Getting data from table code starts*/
    public function getData($cols,$table_name,$list_name,$where=NULL)
    {
        $response=array();
        if($where)
        {
            $this->db->where($where);
        }
        $query=$this->db->select($cols)->from($table_name)->get();
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
            $response['description']=($count  > 0 )?'Getting the '.$list_name.' data':'No results found';
            $response['result_count']=$count;
            $response[($list_name!='')?$list_name:'common_result']=($count  > 0 )?$query->result():(object) null;
        }
        return json_encode($response);
    }
    /*<<Getting data from table code ends*/
    public function common_list_paging_join($cols,$table_name,$like_col,$orderby,$limit,$start,$search,$data)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name)->join($data['join_cond_one'],$data['join_cond_two'],$data['join_cond_three']);
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'both') : '';
        }
        $query=$sql->order_by($orderby,'ASC')->get();
        //echo $this->db->last_query();
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
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }


     public function tutorListing($cols,$table_name,$search_array,$orderby,$limit,$start,$search)
    {
        //print_r($search_array);
        
        $response=array();
        $sql=$this->db->select($cols)->from($table_name);
        /*>> Search code start */
        if(is_array($search_array) && (count($search_array) > 0))
        {
            foreach($search_array as $key=>$val)
            {
                if(!is_array($val))
                {
                    if(!empty($val) && is_numeric($val))
                    {
                        $this->db->where($key,$val);
                    }    
                }
                elseif(is_array($val))
                {  
                    foreach($val as $ke_v => $ke_re)
                    {
                            $seach_val =  $val['seach_val'];
                            if(!empty($seach_val))
                            {
                                $this->db->group_start();
                                foreach ($val['cols'] as $key_k => $key_val) {
                                 $this->db->or_where($key_val,$seach_val);
                                }    
                                $this->db->group_end();
                            }
                            
                    }
                    

                }

            }
        }   
        /*>> Search code end*/
        $sql=$this->db->limit($limit, $start);
        $query=$sql->order_by($orderby,'DESC')->get();
        //print_r($this->db->last_query());
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
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);         
    }

    //Class subjects with group concat
     public function classsubjectlisting($cols,$table_name,$like_col,$orderby,$limit,$start,$search)
    {
        //print_r($like_col);
        $response=array();
        $this->db->select("c.class_id as class_id,c.class_name as class_name,GROUP_CONCAT(subject_id) as subjects,c.added_on as added_on,c.updated_on as updated_on,c.class_status as status")->from("rl_class_subjects_tbl cs")
        ->join('rl_class_tbl c','c.class_id=cs.class_id','inner');
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'after') : '';
        }
        //$sql=$this->db->limit($limit, $start);
        $query=$this->db->group_by('cs.class_id')->order_by($orderby,'DESC')->get();
        //print_r($this->db->last_query());
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
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            if($count > 0)
            {
                $new_array=array();
                $output_array=array();
                foreach($query->result() as $new_result)
                {
                    foreach($new_result as $key=>$val)
                    {
                        $new_array[$key]=$val;
                    }
                    
                    $subject_sql = $this->db->select("GROUP_CONCAT(subject_name) as class_subjects")->from('rl_subjects_tbl')->where_in('subject_id',explode(',',$new_result->subjects))->get();
                    $subject_row =  $subject_sql->row();

                    $new_array['class_subject'] = $subject_row->class_subjects; 
                    array_push($output_array,$new_array);
                }
            }
            $response['common_result']=($count  > 0 )?$output_array:array();
            $response['search_category'] = array('search' => $search);
         }
        
        return json_encode($response);       
    }

    public function manageclasssubject_count()
    {       
       $count = $this->db->select("c.class_id as class_id,c.class_name as class_name,GROUP_CONCAT(subject_id) as subjects,c.added_on as added_on,c.updated_on as updated_on,c.class_status as status")->from("rl_class_subjects_tbl cs")
        ->join('rl_class_tbl c','c.class_id=cs.class_id','inner')->group_by('cs.class_id')->get()->num_rows();
        return $count;
    }
    public function common_get($table,$where,$select)
    {
        $res=$this->db->select($select)->where($where)->get($table)
                  ->result();
        return $res;
    }
    public function user_payment_info($nr=null,$si=null,$search=null,$where=null){
    $this->db->select("pay.*,user.email,user.mobile");
    $this->db->from("rl_user_payment_info_tbl pay");
$this->db->join('rl_users_tbl user','user.id=pay.user_id','inner');
$this->db->order_by("pay.payment_date",'desc');

       $this->db->limit($nr,$si);
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
         // echo $this->db->last_query();exit;
        $data['common_result']=$res->result();
        $data['count']=$res->num_rows();
        // print_r($data);exit;
        return $data;
    }

    
}
?>    
