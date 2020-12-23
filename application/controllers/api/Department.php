<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
		   $this->load->model('api/department_model','d');
    }
	  
	
	public function get_all_user_posts(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			 //$days['comment_days']=$this->days($post_id);
					$post_data=$this->p->get_all_posts_data();
					
				if(count($post_data)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user details by sending id data';
                            $response['post_details'] =$post_data;
						
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}
		 echo json_encode($response);
	}
	public function get_all_department_data(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
					$post_data=$this->d->department();
				if(count($post_data)>0)
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'To display all department data';
                            $response['results'] =$post_data;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}
		  echo json_encode($response);
	}
	public function get_specific_diary_data(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $diary_id=(isset($reqdata->diary_id))?$reqdata->diary_id:'';
				$error=0;
                $error_msg='';
                if(!empty($diary_id))
                {
					$post_data=$this->d->get_single_diary_data($diary_id);
					
				if(count($post_data)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user details by sending id data';
                            $response['title'] =$post_data->title;
							 $response['diary_description'] =$post_data->description;
							  $response['dayname'] =$post_data->dayname;
							   $response['written_on'] =$post_data->written_on;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter diary_id';
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
	
   	    public function add_diary()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
                 $title=(isset($reqdata->title))?$reqdata->title:'';
                $description=(isset($reqdata->description))?$reqdata->description:'';
				$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
                $error=0;
                $error_msg='';
				if(empty($title))
                {
                    $error=1;
                    $error_msg.='Post title is required,';
                }
                if(empty($description))
                {
                    $error=1;
                    $error_msg.='Post description is required,';
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
					// $insert_data=array('post_description'=>$description,'posted_by'=>$user_id,'posted_on'=>$this->date);
       
                if($error==0)
                {
        $insert_data=array('title'=>ucfirst($title),'description'=>$description,'written_by'=>$user_id,'written_on'=>$this->date);
        $res=$this->Crud->commonInsert("da_diary_tbl",$insert_data,'Data inserted successfully');
        if($res)
        {
            $response[CODE] = SUCCESS_CODE;
            $response[MESSAGE] = 'Success';               
            $response['description'] ="Your data is inserted successfully";
        }
        else
        {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'failed';               
            $response['description']="Data not submited";
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
   	
   	public function edit_diary()
  	{
        $response = array();
        $error_msg='';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
                  $title=(isset($req_response->title))?$req_response->title:'';
				$description=(isset($req_response->description))?$req_response->description:'';
				$diary_id=(isset($req_response->diary_id))?$req_response->diary_id:'';
				//$status=(isset($req_response->status))?$req_response->status:'';
                  $error = 0;
                 if(empty($title))
                {
                    $error=1;
                    $error_msg.='Post title is required,';
                }
                if(empty($description))
                {
                    $error=1;
                    $error_msg.='Post description is required,';
                }
				if(empty($diary_id))
                {
                    $error=1;
                    $error_msg.='diary_id is required,';
                }
                if($diary_id!='' && !num_check($diary_id))
                {
                    $error=1;
                    $error_msg.='Invalid diary_id,';
                }
				if(!empty($diary_id)){
					$where1=array('diary_id'=>$diary_id);
                    $user_check=$this->Crud->commonCheck('diary_id', 'da_diary_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Diary ID is not exists,';
                    }
				}
					  // if(empty($status))
                // {
                    // $error=1;
                    // $error_msg.='status is required,';
                // }
				// if(!empty($status)){
				// if(!($status) == 1 || !($status) == 2)
                // {
                    // $error=1;
                    // $error_msg.='Invalid status,status should be 1 or 2,';
                // }}
                if ($error == 0) 
                    {
                        $update_array = array(
                            'title'=> $title,
                            'description'=> $description
                        );
                        $update_where = array('diary_id' => $diary_id);
                        $table_name = "da_diary_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Diary data updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Diary data updated successfully';
							echo json_encode($response);exit;
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
                        $response[DESCRIPTION]=rtrim($error_msg,',');
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

	 public function checkUserExistance($diary_id)
   {
      return $this->Crud->commonCheck('diary_id','da_diary_tbl',array('diary_id'=>$diary_id));
   }
	public function delete_diary()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $diary_id = (isset($requested_data->diary_id)) ? input_data($requested_data->diary_id) : '';
					if ($diary_id == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   } 
                  if(($diary_id!="") && ($this->checkUserExistance($diary_id) == 0)){
                  	 $error_message[]='DiaryId does not exists,';
                      $error = 1;
                  } 
                  if(($diary_id!="") && (num_check($diary_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('da_diary_tbl', array('diary_id'=>$diary_id),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Diary deleted successfully';
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