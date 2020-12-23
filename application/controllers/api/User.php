<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
    }
	   public function get_user(){
		$response = array(); 
		$params['table']="da_users_tbl";
		$params['cols']="user_id,name,mobile,disignation,location,user_status";
		$params['order_by_cols']='name';
		$result=$this->u->commonget($params);
		//echo $result;exit;
		print_r($result);
	}
	

	public function get_contact_details(){
	$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
                if(!empty($user_id))
                {
				$data=$this->u->get_user_contact_details($user_id);
				if(!empty($data))
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting contact details by id data';
                            $response['user_details'] =$data;
                            
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter user_id';
				}
		}else{
	
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
	}
	}else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='UserID is required';
            $response['description']='Data is required';    
        }
		 echo json_encode($response);
	}
	public function searchData(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $search_str=(isset($reqdata->search_str))?$reqdata->search_str:'';
				$error=0;
                $error_msg='';
                if(!empty($search_str))
                {
				$data=$this->u->searchData($search_str);
				if(!empty($data['user_search_data']))
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Searching data by name,location,designation';
                            $response['user_search_data'] =$data['user_search_data'];
                            
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter search_str';
				}
		}else{
	
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
	}
	}else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
		 echo json_encode($response);	
	}
	   
	public function searchData1(){
			$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $name=(isset($reqdata->name))?$reqdata->name:'';
		$result=$this->u->searchData($name);
		//echo $result;exit;
		print_r($result);
		}else{
	
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
	}
	}else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
		 echo json_encode($response);
	}
	 public function checkUserExistance($userid)
   {
      return $this->Crud->commonCheck('user_id','da_users_tbl',array('user_id'=>$userid));
   }
   
   	
	  public function duplicate_mobile($mobile,$id)
   {
   		$count=$this->u->checkmobileforupdate($mobile,$id);
		// if(($count)<=0){
			// return true;
		// }else{
			// return false;
		// }
		return $count;
   }
   public function verifyOTP(){
    			$response=array();
                $inputData =  file_get_contents('php://input');
                if (isJson($inputData))
                {
                    $req_data= json_decode($inputData);
                    // print_r($req_data);exit;
                    $error=0;
                    $error_msg ='';
                    $mobile=(isset($req_data->mobile))?trim($req_data->mobile):'';
                    $otp=(isset($req_data->otp))?$req_data->otp:'';
                    if(($mobile=='')){ $error=1; $error_msg.='Mobile is missing,';}
                    if(($otp=='')){ $error=1; $error_msg.='OTP is missing';}
                    if(!empty($mobile) && !mobile_check($mobile)){$error=1; $error_msg.='Invalid mobile number,';}
                    if((!empty($otp) && !is_numeric($otp)) || (is_numeric($otp) && $otp==0 )){$error=1; $error_msg.='Invalid OTP';}
                    if($error==1)
                    {
                    	$response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Validation error';
                        $response[DESCRIPTION]=rtrim($error_msg,',');
                    }
                    else
                    {  
                    	$where=array('mobile'=>$mobile,'mobile_otp !='=>0);
                    	$check_user=$this->u->get_data('da_users_tbl',$where);
						$login_data=array('mobile'=>$mobile);
						$resp=$this->u->login_check('da_users_tbl',$login_data);
                    	if($check_user!=null){
                    		$user_otp=$check_user->mobile_otp;
                    		$mobile_verified_status=$check_user->mobile_verified_status;
                    		if($user_otp == $otp){
                    			if($mobile_verified_status==1){
                    				$response['code']=EXISTS_CODE;
				                    $response['message']='Already verified';
				                    $response['description']='OTP already verified';
						     $response['verified_status']=$resp->mobile_verified_status;
                    			}else{
			                    	$table = 'da_users_tbl';
			                        $update_data = array('mobile_verified_status'=>1);
			                        $update_condition = array('mobile'=>$mobile);
			                        $successMessage = 'OTP has been verified successfully!';
			                        $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
			                        $response[CODE]=$update->code;
					                $response[MESSAGE]=$update->message;
					                $response[DESCRIPTION]=$update->description;
					               // $response['mobile']=$mobile;
									$response['user_id'] = $resp->user_id;
									$response['name'] = $resp->name;
									$response['mobile'] = $resp->mobile;
									$response['verified_status']=1;
				                }
				            }
				            else{
				            	$response['code']=FAIL_CODE;
			                    $response['message']='Failed';
			                    $response['description']='OTP is not verified';
			                    $response['mobile']=$mobile;
								$response['verified_status']=$resp->mobile_verified_status;
								
				            }
	                    
                    	}else{
                    		$response['code']=FAIL_CODE;
		                    $response['message']='Failed';
		                    $response['description']='OTP is not found';
		                    $response['mobile']=$mobile;
                    	}   
                    }
                }
                else
                {
                	$response[CODE]=VALIDATION_CODE;
                	$response[MESSAGE]='Validation error';
                	$response[DESCRIPTION]='Input data should be in JSON format only';
                }
        echo json_encode($response); 
    }
   public function mobile_check(){
		 $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
               $mobile=(isset($reqdata->mobile))?$reqdata->mobile:'';
                $error=0;
                $error_msg='';
               
                if(empty($mobile))
                {
                    $error=1;
                    $error_msg.='mobile is required,';
                }
                if($mobile!='' && !mobile_check($mobile))
                {
                    $error=1;
                    $error_msg.='invalid Mobile,';
                }
                
                    $where2=array('mobile'=>$mobile,'mobile_verified_status'=>1);
                    $mobile_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where2);
                    if($mobile_check)
                    {
                        $error=1;
                        $error_msg.='mobile already exists,';
                    }
					  $where3=array('mobile'=>$mobile,'mobile_verified_status'=>0);
                    $mobile_check_status=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where3);
                    if($mobile_check_status)
                    {
                       $delete_profile = json_decode($this->Crud->commonDelete('da_users_tbl', array('mobile'=>$mobile),''));
                  	if($delete_profile->code==SUCCESS_CODE){
						$error=0;
                    }
					}
					$login_data=array('mobile'=>$mobile);
					$user=$this->u->login_check('da_users_tbl',$login_data);
                if($error==0)
                {
                    $table='da_users_tbl';
					$login_data=array('mobile'=>$mobile);
					$user=$this->u->login_check('da_users_tbl',$login_data);
					//print_r($user);exit;
				//echo	$user->mobile_verified_status;exit;
                   $already_tried=$this->u->register_check($table,$mobile);
                    //$user=$this->u->login_check('da_users_tbl',$login_data);
                   if($already_tried==0)
                   {	
						$user=$this->u->login_check('da_users_tbl',$login_data);
                    $add_data=array('name'=>'GUEST',
									'mobile'=>$mobile,
                                    'disignation'=>'GUEST',
                                    'registered_on'=> date('Y-m-d H:i:s'),
									'user_status'=>1,
                                );
                        $resp=$this->u->register_user($table,$add_data);
                    } 
					$otp= rand(1000,9999);
                        $msg="Dear User, $otp is your OTP";
						   $senderid="APTDTO";
                            $res_sms =send_user_sms($mobile,$msg,$senderid);
                            if($res_sms){
								$login_data=array('mobile'=>$mobile);
					$user=$this->u->login_check('da_users_tbl',$login_data);
                                $update_data = array('mobile_otp'=>$otp,'mobile_verified_status'=>0);
                                $update_condition = array('mobile'=>$mobile);
                                $successMessage = 'Registration successfully done & OTP sent to your mobile number';
                                $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
                                 $response['code']=$update->code;
                                 $response['message']=$update->message;
                                 $response['description']=$update->description;
                                 $response['mobile']=$mobile;
								 $response['otp']=$otp;
								 $response['verified_status']=$user->mobile_verified_status;
                                 }
                             else{
								 $login_data=array('mobile'=>$mobile);
					$user=$this->u->login_check('da_users_tbl',$login_data);
                                $response['code']=FAIL_CODE;
                                $response['message']='Failed';
                                $response['description']='You have registered but, unable to send OTP';
                               $response['verified_status']=$user->mobile_verified_status;
							 }
                     if($already_tried==0)
                     {

                        if($resp==2)
                        {
                            $response['code']=FAIL_CODE;
                            $response['message']='Failed';
                            $response['description']='Registration failed';
                        }
                    }
                }
                else
                {
                    $response['code']=SUCCESS_CODE;
                    $response['message']="Validation error";
					$response['moble']=$mobile;
					//$response['verified_status']=$res->mobile_verified_status;
					$response['verified_status']=$user->mobile_verified_status;
                    $response['description']=rtrim($error_msg,',');
				
                }
            }
            else
            {
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
            }
        }
        else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
        echo json_encode($response);
	}
    public function register()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
               
                $name=(isset($reqdata->name))?$reqdata->name:'';
                $mobile=(isset($reqdata->mobile))?$reqdata->mobile:'';
                $password=(isset($reqdata->password))?$reqdata->password:'';
                $disignation=(isset($reqdata->disignation))?$reqdata->disignation:'';
				 $location=(isset($reqdata->location))?$reqdata->location:'';
                $error=0;
                $error_msg='';
                if(empty($name))
                {
                    $error=1;
                    $error_msg.='Name is required,';
                }
                if($name!='' && !alphaspace_check($name))
                {
                    $error=1;
                    $error_msg.='allows only alphabets and space,';
                }
                if(empty($mobile))
                {
                    $error=1;
                    $error_msg.='mobile is required,';
                }
                if($mobile!='' && !mobile_check($mobile))
                {
                    $error=1;
                    $error_msg.='invalid Mobile,';
                }
                if(empty($password))
                {
                    $error=1;
                    $error_msg.='password is required,';
                }
                if(!empty($password) && strlen($password) < 6)
                {
                    $error=1;
                    $error_msg.='password should be contains at least 6 characters,'; 
                }
				 if(empty($disignation))
                {
                    $error=1;
                    $error_msg.='disignation is required,';
                }
                if($disignation!='' && !alphaspace_check($disignation))
                {
                    $error=1;
                    $error_msg.='allows only alphabets and space,'; 
                }
				 if(empty($location))
                {
                    $error=1;
                    $error_msg.='location is required,';
                }
               
                    $where2=array('mobile'=>$mobile,'mobile_verified_status'=>1);
                    $mobile_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where2);
                    if($mobile_check)
                    {
                        $error=1;
                        $error_msg.='mobile already exists,';
                    }
					    $where3=array('mobile'=>$mobile,'mobile_verified_status'=>0);
                    $mobile_check_status=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where3);
                    if($mobile_check_status)
                    {
                       $delete_profile = json_decode($this->Crud->commonDelete('da_users_tbl', array('mobile'=>$mobile),''));
                  	if($delete_profile->code==SUCCESS_CODE){
						$error=0;
                    }
					}
                    
                if($error==0)
                {
                    $table='da_users_tbl';
                   $already_tried=$this->u->register_check($table,$mobile);
                    
                   if($already_tried==0)
                   {
                    $add_data=array('name'=>$name,
                                    'mobile'=>$mobile,
                                    'password'=>md5($password),
                                    'disignation'=>$disignation,
									'location'=>$location,
                                    'registered_on'=> date('Y-m-d H:i:s'),
									'user_status'=>1,
									
                                );
                        $resp=$this->u->register_user($table,$add_data);
                    } 
					$otp= rand(1000,9999);
                        $msg="Dear User, $otp is your OTP";
                           // $verification_code=rand(1000,9999);
                           // $msg="Dear User, ";
						   $senderid="APTDTO";
						    
                            $res_sms =send_user_sms($mobile,$msg,$senderid);
                            if($res_sms){
                                $update_data = array('mobile_otp'=>$otp,'mobile_verified_status'=>0);
                                $update_condition = array('mobile'=>$mobile);
                                $successMessage = 'Registration successfully done & OTP sent to your mobile number';
                                $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
                                 $response['code']=$update->code;
                                 $response['message']=$update->message;
                                 $response['description']=$update->description;
                                 $response['mobile']=$mobile;
								 $response['otp']=$otp;

                                 }
                             else{
                                $response['code']=FAIL_CODE;
                                $response['message']='Failed';
                                $response['description']='You have registered but, unable to send OTP';
                             }
                     if($already_tried==0)
                     {

                        if($resp==2)
                        {
                            $response['code']=FAIL_CODE;
                            $response['message']='Failed';
                            $response['description']='Registration failed';
                        }
                    }
                }
                else
                {
                    $response['code']=VALIDATION_CODE;
                    $response['message']="Validation error";
                    $response['description']=rtrim($error_msg,',');
                }
            }
            else
            {
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
            }
        }
        else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
        echo json_encode($response);
    }
	public function forgotPassword()
	{
		$response=array();
		$inputData=file_get_contents('php://input');
		if(!empty($inputData))
		{
			if(isJson($inputData))
			{
				$reqData=json_decode($inputData);
				$error=0;
				$error_msg='';
			 	$mobile=(isset($reqData->mobile))?$reqData->mobile:'';
				if(empty($mobile)){$error=1; $error_msg.='Mobile number is missing';}
				if($mobile!='' && !mobile_check($mobile))
				{
					$error=1;
					$error_msg.='Invalid Mobile';
				}
				if($error==0)
				{	
					$where=array('mobile'=>$mobile);
					$check_user=$this->u->get_data('da_users_tbl',$where);
					if($check_user!=null)
					{
						$mobile=$check_user->mobile;
		            	$table = 'da_users_tbl';
		            	$otp= rand(1000,9999);
						 $msg="Dear User, $otp is your OTP";
                           // $verification_code=rand(1000,9999);
                           // $msg="Dear User, ";
						   $senderid="APTDTO";
		                // $msg="Dear User, $otp is your One Time Password for verifying mobile number";
		            	// $senderid="HSCITY";
		            	$sendSMS = send_user_sms($mobile,$msg,$senderid);
		            	if($sendSMS)
		            	{
		                    $update_data = array('mobile_otp'=>$otp,'mobile_verified_status'=>2);
		                    $update_condition = array('mobile'=>$mobile);
		                    $successMessage = 'OTP sent to your mobile';
		                    $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
		                    $response[CODE]=$update->code;
		                    $response[MESSAGE]=$update->message;
		                    $response[DESCRIPTION]=$update->description;
		                    $response['mobile']=$mobile;
		                    $response['otp']=$otp;
		            	}
			            else
			            {
			    
			             	$response[CODE]=FAIL_CODE;
			                $response[MESSAGE]='Failed';
			                $response[DESCRIPTION]='Unable to send OTP';
			                $response['mobile']=$mobile;
			            }
					}
					else
					{
		            	$response[CODE]=FAIL_CODE;
		                $response[MESSAGE]='Failed';
		                $response[DESCRIPTION]='Mobile number is not registered';
		                $response['mobile']=$mobile;
		        	}
	        	}
		        else
		        {
		        	$response[CODE]=VALIDATION_CODE;
		           	$response[MESSAGE]='Validation error';
		           	$response[DESCRIPTION]=trim($error_msg,' ');
		        }  
			}
			else
	        {
	           $response[CODE]=VALIDATION_CODE;
	           $response[MESSAGE]='Validation error';
	           $response[DESCRIPTION]='Input data should be in JSON format only';
	        }
	    }
	    else
	    {
	    	$response['code']=VALIDATION_CODE;
			$response['message']='Data is required';
			$response ['description'] = "Data is required";
	    }
        	echo json_encode($response);
 	}
    
    public function resend_forgot_otp()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        {
            if(isJson($inputData))
            {
                $reqData=json_decode($inputData);
                $mobile=(isset($reqData->mobile))?$reqData->mobile:'';
                $error=0;
                $error_msg='';
                if(empty($mobile))
                {
                    $error=1;
                    $error_msg.='Mobile is missing,';
                }
                if($mobile!='' && !mobile_check($mobile))
                {
                    $error=1;
                    $error_msg.='Invalid Mobile,';
                }
                if($error==0)
                {
                    $where=array('mobile'=>$mobile);
                    $check_user=$this->db->select('user_id,mobile')->from('da_users_tbl')->where($where)->get()->row();
                    if($check_user!=null)
                    {
                        $mobile=$check_user->mobile;
                        $table = 'da_users_tbl';
                        $otp= rand(1000,9999);
                        $msg="Dear User, $otp is your OTP";
                           // $verification_code=rand(1000,9999);
                           // $msg="Dear User, ";
						   $senderid="APTDTO";
                    $res_sms =send_user_sms($mobile,$msg,$senderid);
                        if($res_sms)
                        {
                            $update_data = array('mobile_otp'=>$otp,'mobile_verified_status'=>2);
                            $update_condition = array('mobile'=>$mobile);
                            $successMessage = "OTP sent to your $mobile";
                            $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
                            $response['code']=$update->code;
                            $response['message']=$update->message;
                            $response['description']=$update->description;
							 $response['otp']=$otp;
                        }
                         else
                         {
                            $response['code']=FAIL_CODE;
                            $response['message']='Failed';
                            $response['description']='Unable to send OTP';
                         }
                    }
                    else
                    {
                        $response['code']=FAIL_CODE;
                        $response['message']='failed';
                        $response['description']='Mobile number is not registered';
                    }
                }
                else
                {
                    $response['code']=VALIDATION_CODE;
                    $response['message']='Validation error';
                    $response['description']=trim($error_msg,',');
                }
            }
            else
            {
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
            }
        }
        else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
        echo json_encode($response);
    }

public function login()
	{
		$response=array();
		$inputData=file_get_contents('php://input');
		if(!empty($inputData))
		{
			if(isJson($inputData))
			{
				$reqdata=json_decode($inputData);
				$mobile=(isset($reqdata->mobile))?$reqdata->mobile:'';
                $password=(isset($reqdata->password))?$reqdata->password:'';
				$error=0;
				$error_msg='';
				if(empty($mobile)){$error=1;$error_msg.='Please enter mobile number';}
				if(empty($password)){$error=1;$error_msg.='Please enter password';}
				if($mobile!='' && !mobile_check($mobile)){$error=1;$error_msg.='Invalid mobile number';}
				if($error==0)
				{
					$login_data=array('mobile'=>$mobile,'password'=>md5($password));
					$resp=$this->u->login_check('da_users_tbl',$login_data);
					if($resp !=null)
					{		$userid=$resp->user_id;
							$update_data=array('last_login'=>$this->date);
                            $msg='You are logged in successfully';
							 $update_condition=array('user_id'=>$userid);
                            $update = json_decode($this->Crud->commonUpdate('da_users_tbl', $update_data, $update_condition,$msg));
						if($update->code==SUCCESS_CODE){
								  if($resp->profile_pic!="")
								$url= base_url().'uploads/users/';
								else
								$url="";
								$response[CODE]=SUCCESS_CODE;
								$response[MESSAGE]='Login success';
								$response[DESCRIPTION]='You have successfully logged in';
								$response['user_id'] = $resp->user_id;
								$response['name'] = $resp->name;
								$response['designation'] = $resp->disignation;
								$response['location'] = $resp->location;
								$response['profile_pic'] = $url.$resp->profile_pic;
								$response['mobile'] = $mobile;
							}else{
								$response[CODE]=FAIL_CODE;
								$response[MESSAGE]='Login failed';
								$response[DESCRIPTION]='Your account is temporary blocked';
							}
	    			}
					else
	   				{
	    				$response['code']=FAIL_CODE;
	    				$response['message']='Login failed';
	    				$response['description'] = 'Invalid login credentials';
	   				}
				}
				else
				{
					$response ['code'] = VALIDATION_CODE;
            		$response ['description'] = "Validation Error";
            		$response ['message'] = rtrim($error_msg,',');
				}
			}
			else
			{
				$response['code']=VALIDATION_CODE;
   				$response['message']='Json validation error';
   				$response ['description'] = "Json validation Error";
			}
		}
		else
		{
			$response['code']=VALIDATION_CODE;
			$response['message']='Data is required';
			$response ['description'] = "Data is required";	
		}
		echo json_encode($response);
	}
		public function edit_user()
  	{
        $response = array();
        $error_message = array();
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
                  $userid = (isset($req_response->user_id)) ? input_data($req_response->user_id) : '';
                  $name = (isset($req_response->name)) ? input_data($req_response->name) : '';
                  $mobile = (isset($req_response->mobile)) ? $req_response->mobile : '';
				  $designation=(isset($req_response->designation))?$req_response->designation:'';
				 $location=(isset($req_response->location))?$req_response->location:'';
                  $error = 0;
                  if ($userid == ""){
                      $error_message[]='User Id is missing,';
                      $error = 1;
                   }
                   if ($name == '') {
                      $error_message[]='Name is missing, ';
                      $error = 1;
                  }  
					if ($designation == '') {
                      $error_message[]='designation is missing, ';
                      $error = 1;
                  }  				  
                   if ($mobile == "") {
                      $error_message[]='Mobile  is missing, ';
                      $error = 1;
                  }
                  if(($userid!="") && (!num_check($userid))) {
                      $error_message[]='Invalid userid, ';
                      $error = 1;
                  }
                 
                  if ( ($this->duplicate_mobile($mobile,$userid)== false)){
                      $error_message[]='Mobile Already exists';
                      $error = 1;
                  }

                 if ((num_check($userid)) && ($this->checkUserExistance($userid) == 0)) {
                      $error_message[]='User does not exists, ';
                      $error = 1;
                  }
                 if($mobile!="" && (!preg_match("/^[6-9]{1}[0-9]{9}$/",$mobile))){
	   					$error=1;
	   					$error_message[]='Mobile is Invalid ,';
	   				}
					
					// if($mobile!="" && (preg_match("/^[6-9]{1}[0-9]{9}$/",$mobile))){
	   					// $count=$this->u->checkmobileforupdate($mobile,$userid);
						// if(($count)!=0){
							// $error_message[]=$count;
                      // $error = 1;
						// }
	   				// }
	   				if($name!="" && (!preg_match("/^[a-zA-Z. ]+$/",$name))){
	   					$error=1;
	   					$error_message[]='Name is Invalid, ';
	   				}
				
                if($designation!='' && !alphaspace_check($designation))
                {
                    $error=1;
                    $error_message[]='allows only alphabets and space,'; 
                }
                if ($error == 0) 
                    {
                        $update_array = array(
                            'name'=> $name,
                            'mobile'=> $mobile,
							'disignation'=>$designation,
							'location'=>$location,
                           
                        );
                        $update_where = array('user_id' => $userid);
                        $table_name = "da_users_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Profile updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Profile updated successfully';
							//echo json_encode($response);exit;
                       }else{
							$response[CODE]=VALIDATION_CODE;
							$response[MESSAGE]='Invalid';
							$response[DESCRIPTION]='You have not updated anything!';
							echo json_encode($response);exit;
                       }
                       
                    }
                else
                    {
                        $response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Invalid';
                        $response[DESCRIPTION]=implode(", ",$error_message);
                        echo json_encode($response);exit;
                     }
          }
        else
           {
              $response[CODE]=VALIDATION_CODE;
              $response[MESSAGE]='Invalid';
              $response[DESCRIPTION]='Input Data should be in JSON format only';
          }
    echo json_encode($response);
}
	public function device_token()
  	{
        $response = array();
        $error_message = array();
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
                  $mobile = (isset($req_response->mobile)) ? $req_response->mobile : '';
				  $device_token=(isset($req_response->device_token))?$req_response->device_token:'';
				  $error = 0;
                  
				  if($device_token == '') {
                      $error_message[]='device_token is missing, ';
                      $error = 1;
                  }  				  
                   if ($mobile == "") {
                      $error_message[]='Mobile  is missing, ';
                      $error = 1;
                  }
                   $where2=array('mobile'=>$mobile,'mobile_verified_status'=>1);
                    $mobile_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where2);
                    if(!$mobile_check)
                    {
                        $error=1;
                        $error_message[]='mobile not exists,';
                    }
                  // if ( ($this->duplicate_mobile($mobile,$userid)== false)){
                      // $error_message[]='Mobile Already exists';
                      // $error = 1;
                  // }

                 if($mobile!="" && (!preg_match("/^[6-9]{1}[0-9]{9}$/",$mobile))){
	   					$error=1;
	   					$error_message[]='Mobile is Invalid ,';
	   				}
					
                if ($error == 0) 
                    {
                        $update_array = array(
                            'device_token'=> $device_token
                        );
                        $update_where = array('mobile' => $mobile);
                        $table_name = "da_users_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Profile updated successfully'));
                       if($update_profile){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Devicetoken updated successfully';
							//echo json_encode($response);exit;
                       }else{
							$response[CODE]=VALIDATION_CODE;
							$response[MESSAGE]='Invalid';
							$response[DESCRIPTION]='You have not updated anything!';
							echo json_encode($response);exit;
                       }
                       
                    }
                else
                    {
                        $response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Invalid';
                        $response[DESCRIPTION]=implode(", ",$error_message);
                        echo json_encode($response);exit;
                     }
          }
        else
           {
              $response[CODE]=VALIDATION_CODE;
              $response[MESSAGE]='Invalid';
              $response[DESCRIPTION]='Input Data should be in JSON format only';
          }
    echo json_encode($response);
}
public function update_profile()
  	{
        $response = array();
        $error_message = array();
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
                  $userid = (isset($req_response->user_id)) ? input_data($req_response->user_id) : '';
                  $name = (isset($req_response->name)) ? input_data($req_response->name) : '';
                  $mobile = (isset($req_response->mobile)) ? $req_response->mobile : '';
                  $designation = (isset($req_response->designation)) ? $req_response->designation : '';
				  //$disignation=(isset($req_response->designation))?$req_response->designation:'';
				  $location=(isset($req_response->location))?$req_response->location:'';
                  $picture=(isset($req_response->photo_name))?$req_response->photo_name:'';
				  $picture_data=(isset($req_response->photo_data))?$req_response->photo_data:'';
				  if ($userid == ""){
                      $error_message[]='User Id is missing';
                      $error = 1;
                   }
                   if ($name == '') {
                      $error_message[]='Name is missing';
                      $error = 1;
                  }   
				   // if(empty($disignation)){
                    // $error=1;
                    // $error_message[]='disignation is required';
                // }
				 if(empty($location))
                {
                    $error=1;
                    $error_message[]='location is required';
                }
                   if ($mobile == "") {
                      $error_message[]='Mobile  is missing';
                      $error = 1;
                  }
                  if(($userid!="") && (!num_check($userid))) {
                      $error_message[]='Invalid userid';
                      $error = 1;
                  }
                  if ( ($this->duplicate_mobile($mobile,$userid)!= 0)){
                      $error_message[]='Mobile Already exists';
                      $error = 1;
                  }
                 if ((num_check($userid)) && ($this->checkUserExistance($userid) == 0)) {
                      $error_message[]='User does not exists ';
                      $error = 1;
                  }
                  if($mobile!='' && !mobile_check($mobile))
                {
                    $error=1;
                    $error_message[]='invalid Mobile';
                }
	   				if($name!='' && !alphaspace_check($name))
                {
                    $error=1;
                    $error_message[]='allows only alphabets and space';
                }
				
                // if($disignation!='' && !alphaspace_check($disignation))
                // {
                    // $error=1;
                    // $error_message[]='allows only alphabets and space'; 
                // }
				if(!empty($picture))
                {
					if(empty($picture_data))
                {
                    $error=1;
                    $error_message[]='Picture source is required';
                }
                }
					
                if ($error == 0) 
                    {	
					$login_data=array('user_id'=>$userid);
					$resp=$this->u->login_check('da_users_tbl',$login_data);
						if(!empty($picture)){
						$path="uploads/users/";
						$fname1='';
						$picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
						$picture1=(isset($picture))?$picture:'';
						$file_name= $picture1;
						}else{
							  $file_name= $resp->profile_pic;
						 }
                        $update_array = array(
                            'name'=> $name,
                            'mobile'=> $mobile,
                            'disignation'=> $designation,
							//'disignation'=>$disignation,
							'location'=>$location,
                           'profile_pic'=>$file_name,
                        );
                        $update_where = array('user_id' => $userid);
                        $table_name = "da_users_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Profile updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Profile updated successfully';
							$resp=$this->u->login_check('da_users_tbl',$login_data);
							//echo json_encode($response);exit;
							
							$url= base_url().'uploads/users/';
				 if(!empty($resp->profile_pic)){
					 $resp->profile_pic=$url.$resp->profile_pic;
				 }
								$response['user_id'] = $resp->user_id;
								$response['name'] = $resp->name;
								$response['designation'] = $resp->disignation;
								$response['location'] = $resp->location;
								$response['mobile'] = $resp->mobile;
								$response['profile_pic'] = $resp->profile_pic;
								echo json_encode($response);
                       }else{
							$response[CODE]=VALIDATION_CODE;
							$response[MESSAGE]='Invalid';
							$response[DESCRIPTION]='You have not updated anything!';
							echo json_encode($response);exit;
                       }
                       
                    }
                else
                    {
                        $response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Invalid';
                        $response[DESCRIPTION]=implode(", ",$error_message);
                        echo json_encode($response);exit;
                     }
          }
        else
           {
              $response[CODE]=VALIDATION_CODE;
              $response[MESSAGE]='Invalid';
              $response[DESCRIPTION]='Input Data should be in JSON format only';
          }
   // echo json_encode($response);
}
public function updateProfilePhoto(){
	 	$response=array();
	 	$input_req =  file_get_contents('php://input');
        if (isJson($input_req)){
            $input_res= json_decode($input_req);
            $studentID=(isset($input_res->student_id))?$input_res->student_id:'';
            $file_name=(isset($input_res->file_name))?$input_res->file_name:'';
            $file_data=(isset($input_res->file_data))?$input_res->file_data:'';
	 		$error=0;$error_msg='';
	 		if($studentID==''){$error=1;$error_msg.='Student ID is missing,';}
	 		if($studentID !='' && !is_numeric($studentID)){$error=1;$error_msg.='Invalid student ID,';}
	 		if($file_name==''){$error=1;$error_msg.='file name is missing,';}
	 		if($file_data==''){$error=1;$error_msg.='file data is missing,';}
	 		if($error==0){
	 			$where=array('student_id'=>$studentID,'student_status'=>1);
	 			$student=$this->api_student_model->get_student('student_id,student_photo',$where);
	 			if($student!=null){
	 				$student_photo=$student->student_photo;
	 				$path="uploads/students/";
					$fname='';
	 				if($student_photo!=''){
	 					unlink($path.$student_photo);
	 				}
					$image=$this->fileUpload($path,$file_name,$file_data,$fname);
					$image=(isset($image))?$image:'';
					if($image!=''){
						$update_data=array('student_photo'=>$image);
						$update=$this->Crud->commonUpdate('rl_student_tbl',$update_data,$where);
						$response[CODE]=200;
		            	$response[MESSAGE]='Success';
						$response[DESCRIPTION]='Profile photo updated successfully';
						 echo json_encode($response);
					}else{
						$response[CODE]=301;
		            	$response[MESSAGE]='Validation';
						$response[DESCRIPTION]='Image required, allows only jpg|jpeg|png|gif file';
						 echo json_encode($response);
					}
	 			}else{
	 				$response[CODE]=301;
		            $response[MESSAGE]='Validation';
		            $response[DESCRIPTION]="Student ID not found";
		            echo json_encode($response);
	 			}
	 			
	 		}else{
	 			$response[CODE]=301;
	            $response[MESSAGE]='Validation';
	            $response[DESCRIPTION]=rtrim($error_msg,',');
	            echo json_encode($response);
	 		}
       }else{
		   $response[CODE]=301;
           $response[MESSAGE]='Validation';
           $response[DESCRIPTION]='Input data should be in JSON format only';
           echo json_encode($response);
		}

	 }
	public function delete_user()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $userid = (isset($requested_data->user_id)) ? input_data($requested_data->user_id) : '';
			 if ($userid == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   }                  
                 
                  if(($userid!="") && ($this->checkUserExistance($userid) == 0)){
                  	 $error_message[]='User does not exists,';
                      $error = 1;
                  } 
                  if(($userid!="") && (num_check($userid)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('da_users_tbl', array('user_id'=>$userid),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='User deleted successfully';
                  	}else{
                  		$response[CODE]=FAIL_CODE;
                        $response[MESSAGE]='Failed';
                        $response[DESCRIPTION]='Fail to delete';
                  	}
                  }else{
                  		$response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Invalid';
                        $response[DESCRIPTION]=implode(", ",$error_message);
                  }
		}else{
			  $response[CODE]=VALIDATION_CODE;
              $response[MESSAGE]='Invalid';
              $response[DESCRIPTION]='Input Data should be in JSON format only';
		}
		echo json_encode($response);
	}
	public function cc(){
		$user_id=1;
		$users_groups_where=array('created_by',$user_id);
				
		$user_groups_created=$this->u->common_count('user_groups_tbl','created_by',1);
				echo $user_groups_created;
	}
	
public function get_user_by_id(){
		/*$response = array(); 
		$params['table']="da_users_tbl";
		$params['cols']="user_id,name,mobile,location";
		$array=array('user_id',$user_id);
		$params['where']="user_id,name,mobile,location";
		
		//$params['wherecondition']=array('id'=>4);
		$result=$this->u->commonget($params);
		//echo $result;exit;
		print_r($result);*/
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
                if(!empty($user_id))
                {
				$resp=$this->u->get_user_data1($user_id);
				$users_groups_where=array('created_by',$user_id);
				$user_groups_created=$this->u->common_count('user_groups_tbl','created_by',$user_id);
				$user_groups_participating=$this->u->common_count('groups_members_tbl','user_id',$user_id);
				$user_posts=$this->u->common_count('posts_tbl','posted_by',$user_id);
				//$data['user_details']=$res;
				if(!empty($resp))
			 {		
				 if(!empty($resp->profile_pic)){
					 $url= base_url().'uploads/users/';
					 $resp->profile_pic=$url.$resp->profile_pic;
				 }
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user details by sending id data';
                            $response['user_id'] = $resp->user_id;
							$response['name'] = $resp->name;
							$response['mobile'] = $resp->mobile;
							$response['designation'] = $resp->disignation;
							$response['location'] = $resp->location;
							$response['profile_pic'] = $resp->profile_pic;
							$response['user_status'] = $resp->user_status;
                            $response['user_groups_created'] =$user_groups_created;
                            $response['user_groups_participating'] =$user_groups_participating;
                            $response['user_posts']=$user_posts;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter user_id';
				}
		}else{
	
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
	}
	}else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
		 echo json_encode($response);
	}
	

	public function user_account_activate(){
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        {
            if(isJson($inputData))
            {
                $reqData=json_decode($inputData);
                $mobile=(isset($reqData->mobile))?$reqData->mobile:'';
                $otp=(isset($reqData->otp))?$reqData->otp:'';
                $error=0;
                $error_msg='';
                if(empty($mobile)){$error=1;$error_msg.='Mobile is missing,';}
                if($mobile!='' && !mobile_check($mobile)){$error=1;$error_msg.='Invalid Mobile,';}
                if(empty($otp)){$error=1;$error_msg.='OTP is missing,';}
                if($error==0){
                    $where=array('mobile'=>$mobile);
					//$login_data=array('mobile'=>$mobile,'password'=>md5($password));
					$resp=$this->u->login_check('da_users_tbl',$where);
                    $check_user=$this->db->select('user_id,mobile,mobile_otp')->from('da_users_tbl')->where($where)->get()->row();
                        if($check_user!=null){
                            $checked_mobile=$check_user->mobile;
                            $checked_otp=$check_user->mobile_otp;
                        }else{
                            $checked_otp=0;
                        }
                        if($checked_otp==$otp){
                            $table = 'da_users_tbl';
                            $update_data = array('mobile_verified_status'=>1);
                            $update_condition = array('mobile'=>$mobile,'mobile_otp'=>$otp,'user_status'=>1);
                            $successMessage = 'Your Account activated successfully';
                            $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
                            $response['code']=$update->code;
                            $response['message']=$update->message;
                            $response['description']=$update->description;
							$response['user_id'] = $resp->user_id;
							$response['name'] = $resp->name;
							$response['mobile'] = $resp->mobile;
							$response['designation'] = $resp->disignation;
							$response['location'] = $resp->location;
                        }
                        else{
                            $response['code']=FAIL_CODE;
                            $response['message']='Failed';
                            $response['description']='OTP not matched';
                        }
                }else{
                    $response['code']=VALIDATION_CODE;
                    $response['message']='Validation error';
                    $response['description']=trim($error_msg,',');
                }
            }
            else
            {
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
            }
        }
        else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
        echo json_encode($response);
    }
	
    public function change_password(){
             $response=array();
                $inputData =  file_get_contents('php://input');
                if (isJson($inputData))
                {
                    $req_data= json_decode($inputData);
                    // print_r($req_data);exit;
                    $error=0;
                    $error_msg ='';
                    $userid=(isset($req_data->user_id))?$req_data->user_id:'';
                    $old_password=(isset($req_data->old_password))?$req_data->old_password:'';
                    $new_password=(isset($req_data->new_password))?$req_data->new_password:'';
                    $confirm_password=(isset($req_data->confirm_password))?$req_data->confirm_password:'';

                    if($userid==''){ $error=1; $error_msg.='User ID is missing,';}
                    if(empty($old_password)){ $error=1; $error_msg.='old Password is missing,';}
                    if(empty($new_password)){ $error=1; $error_msg.='new Password is missing,';}
                    if(empty($confirm_password)){ $error=1; $error_msg.='confirm Password is missing,';}
                    if($old_password == $new_password){$error=1; $error_msg.='new password should not be same as old password,';}
                    if($new_password != $confirm_password){$error=1; $error_msg.='new password and confirm password should be same,';}
                    if(strlen($new_password) < 6 || strlen($new_password) > 18){$error=1; $error_msg.=' password should be contains [6-18] characters,'; } 
                    if($error==1)
                    {
                        $response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Validation error';
                        $response[DESCRIPTION]=rtrim($error_msg,',');
                    }
                    else{
                 $where=array('user_id'=>$userid);
                        $check_user=$this->db->select('user_id,password')->from('da_users_tbl')->where($where)->get()->row();
                        if($check_user == null){
                            $response[CODE]=FAIL_CODE;
                            $response[MESSAGE]='Failed';
                            $response[DESCRIPTION]= 'User ID not found';
                        }
                        else{
                            $password=$check_user->password;
                            if($password==md5($old_password)){
                                $table = 'da_users_tbl';
                                $update_data = array('password'=>md5($new_password));
                                $update_condition = array('user_id'=>$userid,'user_status'=>1);
                                $successMessage = 'Password has been changed successfully';
                                $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
                                $response[CODE]=$update->code;
                                $response[MESSAGE]=$update->message;
                                $response[DESCRIPTION]=$update->description;
                            }
                            else{
                                $response[CODE]=FAIL_CODE;
                                $response[MESSAGE]='Failed';
                                $response[DESCRIPTION]= 'Wrong Old Password';
                            }
                        }
                    }
                }
                else
                {
                    $response[CODE]=VALIDATION_CODE;
                   $response[MESSAGE]='Validation error';
                   $response[DESCRIPTION]='Input data should be in JSON format only';
                }
        echo json_encode($response); 
    }

	/* public function verifyOTP(){
    			$response=array();
                $inputData =  file_get_contents('php://input');
                if (isJson($inputData))
                {
                    $req_data= json_decode($inputData);
                    // print_r($req_data);exit;
                    $error=0;
                    $error_msg ='';
                    $visit_id=(isset($req_data->visit_id))?$req_data->visit_id:'';
                    $mobile=(isset($req_data->mobile))?trim($req_data->mobile):'';
                    $otp=(isset($req_data->otp))?$req_data->otp:'';
                    if(($visit_id=='')){ $error=1; $error_msg.='Visit ID is missing';}
                    if(($mobile=='')){ $error=1; $error_msg.='Mobile is missing,';}
                    if(($otp=='')){ $error=1; $error_msg.='OTP is missing';}
                    if($visit_id!='' && !is_numeric($visit_id)){
						$error=1;
						$error_msg.=' Invalid Visit ID';
					}
                    if(!empty($mobile) && !mobile_check($mobile)){$error=1; $error_msg.='Invalid mobile number,';}
                    if((!empty($otp) && !is_numeric($otp)) || (is_numeric($otp) && $otp==0 )){$error=1; $error_msg.='Invalid OTP';}
                    if($error==1)
                    {
                    	$response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Validation error';
                        $response[DESCRIPTION]=rtrim($error_msg,',');
                    }
                    else
                    {  
                    	$where=array('user_id'=>$visit_id,'mobile_otp !='=>0);
                    	$check_user=$this->u->get_data('da_users_tbl',$where);
                    	if($check_user!=null){
                    		$user_otp=$check_user->mobile_otp;
                    		$otp_status=$check_user->mobile_verified_status;
                    		if($user_otp == $otp){
                    			if($otp_status==1){
                    				$response['code']=EXISTS_CODE;
				                    $response['message']='Already verified';
				                    $response['description']='OTP already verified';
                    			}else{
			                    	$table = 'da_users_tbl';
			                        $update_data = array('mobile_verified_status'=>1);
			                        $update_condition = array('user_id'=>$visit_id);
			                        $successMessage = 'OTP has been verified successfully!';
			                        $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
			                        $response[CODE]=$update->code;
					                $response[MESSAGE]=$update->message;
					                $response[DESCRIPTION]=$update->description;
					                $response['mobile']=$mobile;
					                $response['visit_id'] = $visit_id;

				                }
				            }
				            else{
				            	$response['code']=FAIL_CODE;
			                    $response['message']='Failed';
			                    $response['description']='OTP is not verified';
			                    $response['mobile']=$mobile;
			                    $response['visit_id'] = $visit_id;
				            }
	                    
                    	}else{
                    		$response['code']=FAIL_CODE;
		                    $response['message']='Failed';
		                    $response['description']='OTP is not found';
		                    $response['mobile']=$mobile;
		                    $response['visit_id'] = $visit_id;
                    	}   
                    }
                }
                else
                {
                	$response[CODE]=VALIDATION_CODE;
                	$response[MESSAGE]='Validation error';
                	$response[DESCRIPTION]='Input data should be in JSON format only';
                }
        echo json_encode($response); 
    }*/
        public function resetPassword()
    {
    	$response=array();
                $inputData =  file_get_contents('php://input');
                if (isJson($inputData))
                {
                    $req_data= json_decode($inputData);
                    // print_r($req_data);exit;
                    $error=0;
                    $error_msg ='';
                    $mobile=(isset($req_data->mobile))?trim($req_data->mobile):'';
                    $password=(isset($req_data->password))?$req_data->password:'';
                    $confirm_password=(isset($req_data->confirm_password))?$req_data->confirm_password:'';

                    if(empty($mobile)){ $error=1; $error_msg.='Mobile is missing,';}
                    if(empty($password)){ $error=1; $error_msg.='Password is missing,';}
                    if(empty($confirm_password)){ $error=1; $error_msg.='Confirm Password is missing,';}
                    if(!empty($mobile) && !mobile_check($mobile)){$error=1; $error_msg.='Invalid mobile number';}
                    if(strlen($password) < 6 || strlen($password) > 18){$error=1; $error_msg.='Password should be contains [6-18] characters,'; } 
                    if($password != $confirm_password){$error=1; $error_msg.='Password is not confirmed';}
                    if($error==1)
                    {
                    	$response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Validation error';
                        $response[DESCRIPTION]=rtrim($error_msg,',');
                    }
                    else
                    {  
                    	$where=array('mobile'=>$mobile);
                    	$check_user=$this->u->get_data('da_users_tbl',$where);
                    	if($check_user!=null){
                    		$otp_status=$check_user->mobile_verified_status;
                    			if($otp_status==0){
                    				$response['code']=FAIL_CODE;
				                    $response['message']='Failed';
				                    $response['description']='OTP is not verified, unable to reset password';
				                    $response['mobile']=$mobile;
                    			}else{
			                    	$table = 'da_users_tbl';
			                        $update_data = array('password'=>md5($password),'mobile_otp'=>0);
			                        $update_condition = array('mobile'=>$mobile);
			                        $successMessage = 'Password has been reset successfully!';
			                        $update = json_decode($this->Crud->commonUpdate($table, $update_data, $update_condition, $successMessage));
			                        $response[CODE]=$update->code;
					                $response[MESSAGE]=$update->message;
					                $response[DESCRIPTION]=$update->description;
				                }
                    	}else{
                    		$response['code']=FAIL_CODE;
		                    $response['message']='Failed';
		                    $response['description']='Mobile is not registered';
		                    $response['mobile']=$mobile;
                    	}   
                    }
                }
                else
                {
                	$response[CODE]=VALIDATION_CODE;
                	$response[MESSAGE]='Validation error';
                	$response[DESCRIPTION]='Input data should be in JSON format only';
                }
        echo json_encode($response); 
    }
	 
    public function fileUpload123(){
      $errors=array();
      $response=array();
    $tmp_name=$_FILES['picture']['tmp_name'];
    $file_name=$_FILES['picture']['name'];
    $file_size=$_FILES['picture']['size'];
    // echo  $file_name.''.$_POST['name'];exit;
    $ex=explode('.',$file_name);
    $x=strtolower(end($ex));
    $extension=array('png','jpg','jpeg');
    if(in_array($x,$extension)==false)
    {
         $response['code']=FAIL_CODE;
         $response['message']='Failed';
         $response['description']='Only png,jpg allowed';
    }
    if($file_size>1048576)
    {
        $errors['b']="file size must be less than 1 mb or equal to 1 mb";
        $response['code']=FAIL_CODE;
         $response['message']='Failed';
         $response['description']='file size must be less than 1 mb or equal to 1 mb';
    }

    if(empty($errors))
    {

    $res=move_uploaded_file($tmp_name,"uploads/.$file_name");
    if($res)
    {
          $response[CODE]=SUCCESS_CODE;
          $response[MESSAGE]="success";
          $response[DESCRIPTION]="Image uploaded";
    }
    else
      {
         $response['code']=FAIL_CODE;
         $response['message']='Failed';
         $response['description']='Image not uploaded';
      }
}
    echo json_encode($response);            
}


     public function resumeUpload($destination,$file_name,$file_path,$chosenname=NULL)
       {
            $return_data='';
            $decoded_string=  base64_decode($file_path);
            $extension=  fileExtension($file_name); //Getting the file extension
            $extension=  trim(strtolower($extension));
            $allow_extensions=array('doc','docx','pdf');
            if(in_array($extension,$allow_extensions))  
            {
                $f_name=date('Y-m-d').'_'.$chosenname.'_'.sha1(rand(100000,999999).time()).'.'.$extension; /*Generating random image name*/
                $path=$destination.$f_name;
                $file=fopen($path,'wb');
                $is_written=  fwrite($file,$decoded_string);
                fclose($file);
                if($is_written > 0){$return_data=$f_name; }else{ $return_data='';}
            }
            return  $return_data;
    }
     public function pictureUpload($destination,$file_name,$file_path,$chosenname=NULL)
       {
            $return_data='';
            $decoded_string=  base64_decode($file_path);
            $extension=  fileExtension($file_name); //Getting the file extension
            $extension=  trim(strtolower($extension));
            $allow_extensions=array('jpg','jpeg','png');
            if(in_array($extension,$allow_extensions))  
            {
                $f_name=date('Y-m-d').'_'.$chosenname.'_'.sha1(rand(100000,999999).time()).'.'.$extension; /*Generating random image name*/
                $path=$destination.$f_name;
                $file=fopen($path,'wb');
                $is_written=  fwrite($file,$decoded_string);
                fclose($file);
                if($is_written > 0){$return_data=$f_name; }else{ $return_data='';}
            }
            return  $return_data;
    }


public function check_img(){
    $url="E:\jk2.jpg";
     $url1=base64_encode($url);
 $a= json_encode($url1);
 $b=json_decode($a);
echo base64_decode($b);
}
}
?>