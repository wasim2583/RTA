<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
		 $this->load->model('api/message_model','m');
		  $this->load->model('frontend_model','f');
    }
	 
	public function get_message_details(){
	$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
				 $where2=array('user_id'=>$user_id);
                    $user_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where2);
                    if($user_check)
                    {
                if(!empty($user_id))
                {
				$data=$this->m->get_message_details($user_id);
				if(!empty($data))
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting contact details by id data';
                            $response['message_details'] =$data;
                            
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter user_id';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='user_id not exists';
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
	
	 public function checkUserExistance($message_id)
   {
      return $this->Crud->commonCheck('message_id','messages_tbl',array('message_id'=>$message_id));
   }
   
   	    public function messageRegister()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
               
                $message=(isset($reqdata->message))?$reqdata->message:'';
                $group_id=(isset($reqdata->group_id))?$reqdata->group_id:'';
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				 $picture=(isset($reqdata->picture))?$reqdata->picture:'';
				$picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
                $message_sent_to=(isset($reqdata->message_sent_to))?$reqdata->message_sent_to:'';
				//$message_status=(isset($reqdata->message_status))?$reqdata->message_status:'';
                $error=0;
                $error_msg='';
                if(empty($message))
                {
                    $error=1;
                    $error_msg.='Message is required,';
                }
               if(empty($group_id))
                {
                    $error=1;
                    $error_msg.='Group ID is required,';
                }
				if($group_id!='' && !num_check($group_id))
                {
                    $error=1;
                    $error_msg.='Invalid Group ID,';
                }
                if(empty($message_sent_to))
                {
                    $error=1;
                    $error_msg.='Message receiver User ID is required,';
                }
                if($message_sent_to!='' && !num_check($message_sent_to))
                {
                    $error=1;
                    $error_msg.='Invalid Message receiver User ID,';
                }
				
				if(empty($user_id))
                {
                    $error=1;
                    $error_msg.='Message sender User ID is required,';
                }
				if($user_id!='' && !num_check($user_id))
                {
                    $error=1;
                    $error_msg.='Invalid Message sender User ID,';
                }
					  if(empty($picture))
                {
                    $error=1;
                    $error_msg.='Picture is required,';
                }
					  if(empty($picture_data))
                {
                    $error=1;
                    $error_msg.='Picture source is required,';
                }
				
				if($user_id == $message_sent_to){$error=1; $error_msg.='user_id should not be same as message_sent_to_id,';}
                   
				$where1=array('user_id'=>$user_id);
                    $user_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where1);
                    if(!empty($user_id)){
					if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Sender User ID is not exists,';
				}}
					$where2=array('group_id'=>$group_id);
                    $user_check2=$this->Crud->commonCheck('group_id', 'user_groups_tbl', $where2);
                      if(!empty($group_id)){
					if(!$user_check2)
                    {
                        $error=1;
                        $error_msg.='Group ID is not exists,';
					  }}
					$where3=array('user_id'=>$message_sent_to);
                    $user_check3=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where3);
                    if(!empty($message_sent_to)){
					if(!$user_check3)
                    {
                        $error=1;
                        $error_msg.='Message Receiver User ID is not exists,';
                    }}
					   if(!empty($picture))
                {
                  $path="uploads/message/";
                    $fname1='';
                    $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    $picture1=(isset($picture))?$picture:'';
                     $data['photos']= $picture1;
                 }
                if($error==0)
                {
                    $data=array(
							'message'=>$message,
                            'group_id'=>$group_id,
                            'user_id'=>$user_id,
                            'messaged_on'=>$this->date,
							'message_sent_to'=>$message_sent_to,
                            'message_status'=>1,
                        );
                $message_add=$this->f->common_insert("messages_tbl",$data);
                    if($message_add)
                    {
                       $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]="success";
                       $response[DESCRIPTION]="Your Message has been sent successfully";  
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
	  public function duplicate_mobile($mobile,$id)
   {
   		$count=$this->u->checkmobileforupdate($mobile,$id);
		if(($count)<=0){
			return true;
		}else{
			return false;
		}
   }
   

	public function delete_message()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $message_id = (isset($requested_data->message_id)) ? input_data($requested_data->message_id) : '';
			 if ($message_id == "") {
                      $error_message[]='message id is missing,';
                      $error = 1;
                   }                  
                 
                  if(($message_id!="") && ($this->checkUserExistance($message_id) == 0)){
                  	 $error_message[]='message id does not exists,';
                      $error = 1;
                  } 
                  if(($message_id!="") && (num_check($message_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('messages_tbl', array('message_id'=>$message_id),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Message deleted successfully';
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
            $allow_extensions=array('jpg','jpeg','png','gif');
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