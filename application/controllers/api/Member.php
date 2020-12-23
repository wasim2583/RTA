<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
		 $this->load->model('frontend_model','f');
		 $this->load->model('crud_model','c');
		 $this->load->model('api/Members_model','m');
    }


	public function getMemberData(){
    $response=array();
	$inputData=file_get_contents('php://input');
	 if(!empty($inputData)){
		 if(isJson($inputData)){
			 	$reqdata=json_decode($inputData);
				$group_id=(isset($reqdata->group_id))?$reqdata->group_id:'';
     $data=$this->m->get_members_data($group_id);
	 //$count=$this->c->count_num_recs('groups_members_tbl');
     if(!empty($data['result']))
     {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting members related data based on specific group';
                            $response['result'] =$data['result'];
                            //$response['category']=$data['category'];'
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
                        }
		 }else{
	
                $response['code']=VALIDATION_CODE;
                $response['message']='Invalid json format';
                $response['description']='Invalid json format';
	}	
						
						}else{
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';  
			}  
        
                echo json_encode($response);        

}

	 public function checkUserExistance($userid)
   {
      return $this->Crud->commonCheck('member_id','groups_members_tbl',array('member_id'=>$userid));
   }
	public function delete_member()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $userid = (isset($requested_data->member_id)) ? input_data($requested_data->member_id) : '';
			 if ($userid == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   }                  
                 
                  if(($userid!="") && ($this->checkUserExistance($userid) == 0)){
                  	 $error_message[]='Member does not exists,';
                      $error = 1;
                  } 
                  if(($userid!="") && (num_check($userid)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('groups_members_tbl', array('member_id'=>$userid),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Member deleted successfully';
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
	public function searchData(){
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
   
public function groupMembers(){
        $response=array();
        $inputData=file_get_contents('php://input');
    if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $group_id=(isset($reqdata->group_id))?$reqdata->group_id:'';
			$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
			$added_on=$this->date;
                $error=0;
                $error_msg='';
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
                if(empty($user_id))
                {
                    $error=1;
                    $error_msg.='User ID is required,';
                }
                if($user_id!='' && !num_check($user_id))
                {
                    $error=1;
                    $error_msg.='Invalid User ID,';
                }
				
					$where1=array('user_id'=>$user_id);
                    $user_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='User ID is not exists,';
                    }
					
					$where2=array('group_id'=>$group_id);
                    $user_check2=$this->Crud->commonCheck('group_id', 'user_groups_tbl', $where2);
                    if(!$user_check2)
                    {
                        $error=1;
                        $error_msg.='Group ID is not exists,';
                    }
                if($error==0)
                {
                 $data=array(
                            'group_id'=>$group_id,
                            'user_id'=>$user_id,
                            'added_on'=>$this->date,
                            'member_status'=>1,
                        );
              
                $members_add=$this->f->common_insert("groups_members_tbl",$data);

                    if($members_add)
                    {
                       $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]="success";
                       $response[DESCRIPTION]="Your profile has been inserted successfully";  
                    }
              
                
               }
                else
                {
                     $response[CODE]=VALIDATION_CODE;
                     $response[MESSAGE]='Validation error';
                     $response[DESCRIPTION]=rtrim($error_msg,',');  
                }
            }
            else
            {
                    $response[CODE]=VALIDATION_CODE;
                    $response[MESSAGE]='Validation';
                    $response[DESCRIPTION]='Input data should be in JSON format only';
            }
        }
        else{
                    $response['code']=VALIDATION_CODE;
                    $response['message']='Data is required';
                    $response['description']='Data is required';  
            }
            echo json_encode($response);
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