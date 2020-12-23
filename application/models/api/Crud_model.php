<?php
Class Crud_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //Multiple status update
    public function commonStatusUpdate($table, $update_data, $update_condition, $input_status, $debug = NULL) {
        $response = array();
        if (is_array($update_data)) {
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
                            $status_message='';
                            switch($input_status){
                                case 0:$status_message='De-Activated';break;
                                case 1:$status_message='Activated';break;
                                case 5:$status_message='Deleted';break;
                            }
                            $activation_message = $status_message;
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $count . " results $activation_message successfully";
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] = 'Data not modified';
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
//Close multiple status update
    public function commonCheck($cols, $table, $wherecondition) {
        $count = $this->db->select($cols)->from($table)->where($wherecondition)->get()->num_rows();
        return ($count > 0) ? 1 : 0;
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
        {
            $this->db->from($params);
        }
        $res=$this->db->get();
        // echo $this->db->last_query(); exit;

        $error = $this->db->error();
        $error_message = $error['message'];
        if ($error['code'] == 0) 
        {
            $count=$res->num_rows();  
            if ($count>0) 
            {
                
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'Success';
                $response[DESCRIPTION] = $count.' Records found';
                $response['row'] = $res->row();
                $response['result']=$res->result();
                $response['num_rows']=$count;
            } 
            else 
            {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] = 'No records found';
            }
        } 
        else 
        {
            $response[CODE] = DB_ERROR_CODE;
            $response[MESSAGE] = 'Databse Error';
            $response[DESCRIPTION] = $error_message;
        }
        // $res=$res->result();
        return json_encode($response);
    }
    public function get_latest_disabled_tank($params)
    {   
        if(is_array($params))
        {
            $where=(isset($params['wherecondition']))?$params['wherecondition']:array();
            $select=(isset($params['cols']))?$params['cols']:array();
            $this->db->from($params['table']);
            $this->db->select($select);
            $this->db->order_by($params['order_by'],'DESC');
            $this->db->where($where); 
            $this->db->limit(1,0); 
            
        }// print_r($res);
        else 
        {
            $this->db->from($params);
        }
        $res=$this->db->get();
        // echo $this->db->last_query(); exit;
        $error = $this->db->error();
        $error_message = $error['message'];
        if ($error['code'] == 0) 
        {
            $count=$res->num_rows();  
            if ($count>0) 
            {
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'Success';
                $response[DESCRIPTION] = $count.' Records found';
                $response['row'] = $res->row();
                $response['result']=$res->result();
                $response['num_rows']=$count;
            } 
            else 
            {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] = 'No records found';
            }
        } 
        else 
        {
            $response[CODE] = DB_ERROR_CODE;
            $response[MESSAGE] = 'Databse Error';
            $response[DESCRIPTION] = $error_message;
        }
        // $res=$res->result();
        return json_encode($response);
    }

    public function commonInsert($table, $insertdata, $displaymessage = NULL, $failmessage=NULL, $debug = NULL) 
    {
        $response = array();
        //$sql_show= $this->db->set($insertdata)->get_compiled_insert($table);
        if (is_array($insertdata)) 
        {
            $sql = $this->db->insert_string($table, $insertdata);
            if (isset($debug) && $debug == 'debug') 
            {
                $response[QUERY_MESSAGE] = $sql;
            } 
            else 
            {
                $insert = $this->db->query($sql);
                //echo $this->db->last_query();exit;
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) 
                {
                    try 
                    {
                        if ($insert) 
                        {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                            $response[INSERTED_ID] = $this->db->insert_id();
                            //$sql.="\n [ Inserted Success: Inserted Id :".$this->db->insert_id().']';//==>For log
                        } 
                        else 
                        {
                            throw new Exception('Error occured while inserting data');
                        }
                    } 
                    catch (Exception $ex) 
                    {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = $failmessage;
                        //$sql.="\n Some thing error occured";     //==>For log
                    }
                } 
                else 
                {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Databse Error';
                    $response[DESCRIPTION] = $error_message;
                    //$sql.="\n Database Error".$error_message;    //==>For log
                }
                if (QUERY_DEBUG == 1) 
                {
                    $response[QUERY_DEBUG_MESSAGE] = 'Failed to Add';
                    $response[QUERY_MESSAGE] = $sql;
                    //$sql.="\n Debug  : Yes";     //==>For log
                }
            }
        } 
        else 
        {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
            //$sql.="\n Input data is in invalid format";     //==>For log
        }
        return json_encode($response);
    }

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

    public function commonStatusActivity($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $updateStatus=($updatevalue==1)?'Activation Status':'De-activation Status';
        $sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($sql);
        $update=$this->db->affected_rows();
        $response[CODE]=($update > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($update > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($update > 0)?"<b>$update</b> records updated successfully":'Unable to update';
        return json_encode($response);
    }

    public function commonDelete($table,$condition,$relationname)
    {
        $response=array();
        $sql=$this->db->delete($table,$condition);
        $delete=$this->db->affected_rows();
        $response[CODE]=($delete > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($delete > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($delete > 0)?"<b>$relationname</b> Deleted successfully":'Unable to delete';
        return json_encode($response);
    }

    /*
|============================================================================================|===
|  Use batchInsert()  for multiple records insert at a time                                  |
|============================================================================================|===
*/
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
|============================================================================================|===
|  Use common_record_count_like() only for pagination count using like condition for search  |
|============================================================================================|===
*/

    public function common_record_count_like($params)
    {       
        if(is_array($params))
        {
            $like=(isset($params['likecondition']))?$params['likecondition']:array();
            $where=(isset($params['wherecondition']))?$params['wherecondition']:array();
            
            $this->db->like($like);
            $this->db->where($where);
            $this->db->from($params['table']);
        }
        else
        {
            $this->db->from($params);
        }
        // $this->db->like($wer);
        $rs=$this->db->get();
        // echo $this->db->last_query();exit;
        $count=$rs->num_rows();//exit;
        return $count;
    }
    public function common_record_count($params)
    {       
        if(is_array($params))
        {
            $where=(isset($params['wherecondition']))?$params['wherecondition']:array();
            $this->db->where($where);
            $like=(isset($params['likecondition']))?$params['likecondition']:array();
            $this->db->like($like);
            $this->db->from($params['table']);
        }
        else
        {
            $this->db->from($params);
        }
        // $this->db->like($wer);
        $rs=$this->db->get();
        //print_r($rs);exit;
        // echo $this->db->last_query();exit;
        $count=$rs->num_rows();//exit;
        return $count;
    }

    public function get_limit($table,$nr,$si,$order_by,$wer,$search_key)
    {
        $response=array();
       // $id=$this->session->userdata('id');
        // if(!empty($id))
        // {
        //     $wer=array('activation_status!='=>5,'added_by'=>$id);
        // }
        // else
        // {
        //     $wer=array('activation_status'=>1);
        // }
        if($search_key)
        {
            $this->db->like($search_key);
        }
        $this->db->where($wer);
        $this->db->order_by($order_by, 'DESC');
        $this->db->limit($nr,$si);
        $query=$this->db->get($table);
        //echo "<pre>";print_r($query->result());exit;
        // return $query;
        $db_error=$this->db->error();
        if($db_error['code']!=0)
        {
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
            // $response['search_category'] = $search;
         }
        return json_encode($response); 
    }

    public function search_query($table,$query_data,$nr,$si,$order_by)
    {
        $wer=array('activation_status!='=>5);
        $this->db->where($wer);
        $this->db->order_by($order_by, 'DESC');
        $this->db->like($query_data);
        $this->db->limit($nr,$si);
        $query=$this->db->get($table);
        // echo $this->db->last_query();exit;
            // echo $res->num_rows();exit;
        // return $res;
        $db_error=$this->db->error();
        if($db_error['code']!=0)
        {
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
            $response['search_category'] = $query_data;
         }
        return json_encode($response);
    }

    public function pagination_data_common($total_rows,$base_url,$per_page)
    {
        $config=array(
                'base_url'       =>$base_url,
                'total_rows'     =>$total_rows,
                'per_page'       =>$per_page,               
                'full_tag_open'  =>'<ul class="pagination">',
                'full_tag_close' =>'</ul>',
                'first_tag_open' =>'<li>',
                'first_tag_close'=>'</li>',
                'last_tag_open'  =>'<li>',
                'last_tag_close' =>'</li>',
                'first_link'     =>'First',
                'last_link'      =>'Last',
                'next_link'      =>'Next',
                'prev_link'      =>'Prev',
                'next_tag_open'  =>'<li>',
                'next_tag_close' =>'</li>',
                'prev_tag_open'  =>'<li>',
                'prev_tag_close' =>'</li>',
                'num_tag_open'   =>'<li>',
                'num_tag_close'  =>'</li>',
                'cur_tag_open'   =>'<li class="active"><a>',
                'cur_tag_close'  =>'</a></li>'
                );
        return $config;
    }

    /*seshu code here*/
    // public function check_email($email,$activation_code)
    // {
    //     $this->db->where('email',$email);
    //     $res=$this->db->get('cpro_company_tbl');
    //     $count=$res->num_rows($res);
    //     if($count>0)
    //     {
    //         /*update code now*/
    //         $data=array('forgotpassword_verification_code'=>$activation_code);
    //         $this->db->where('email',$email);
    //         $res=$this->db->update('cpro_company_tbl',$data);
    //         if($res)
    //             return 1;
    //         else
    //             return 2;
    //         /*end*/
    //     }
    //     return 3;
    // }
    /*end */
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
}

?>