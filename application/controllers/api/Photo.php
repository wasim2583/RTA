<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Photo extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
		 $this->load->model('frontend_model','f');
		 $this->load->model('api/group_model','g');
		 $this->load->model('crud_model','c');
		  $this->load->model('api/accident_inspection_model','a');
    }
		  public function checkUserGroup($userid)
   {
      return $this->Crud->commonCheck('user_id','da_users_tbl',array('user_id'=>$userid));
   }
public function send_user_email($to,$from,$subject,$templat)
{ 
  $config=array(
                 'protocol' => 'smtp', 
                 'smtp_host' => 'ssl://smtp.googlemail.com', 
                 'smtp_port' => 465, 
				 'mailpath' => '/usr/sbin/sendmail',
                 'smtp_user' => '333sangeetha@gmail.com', 
                 'smtp_pass' => 'yashwanth*123',
                 'charset'=>'utf-8',
                 'newline'=> "\r\n",
                 'mailtype'=>'html',
                 'validation'=> true
      );
  $this->email->initialize($config);
  $this->email->to($to);
  $this->email->from($from);
  $this->email->subject($subject);
  $this->email->message($templat);
       if($this->email->send())
       {
        return true;
       }
       else
       {
        return false;
       }
}

	public function feedback(){
		$this->load->model('Crud');
		$response=array();
		 $inputData=file_get_contents('php://input');
		 if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
			$subject=(isset($reqdata->subject))?$reqdata->subject:'';
			$message=(isset($reqdata->message))?$reqdata->message:'';
			//$mail=(isset($reqdata->mail))?$reqdata->mail:'';
            $created_date=$this->date;
                $error=0;
                $error_msg='';
                if(empty($user_id))
                {
                     $error=1;
                    $error_msg.='User id is required,';
                }
                if($user_id!='' && !num_check($user_id))
                {
                    $error=1;
                    $error_msg.='Invalid user_id,';
                }
				if(($user_id!="") && ($this->checkUserGroup($user_id) == 0)){
                  	 $error_msg.='UserId does not exists,';
                      $error = 1;
                  }
               if(empty($subject))
                {
					$error=1;
                    $error_msg.='subject is required,';
                }
				
				 if(empty($message))
                {
					$error=1;
                    $error_msg.='message is required,';
                }
                if($error==0)
                {
					$data=array(
                            'user_id'=>$user_id,
                            'subject'=>$subject,
							'message'=>$message,
                            'date'=>$this->date
                        );
						$email_data=array(
                            'email'=>'333sangeetha@gmail.com',
                            'subject'=>$subject,
							'message'=>$message,
                            'date'=>$this->date
                        );
				 $res=$this->Crud->commonInsert("da_feedback_tbl",$data,'feedback inserted successfully');
           if($res){
		// $data = array('subject'=>$subject,'message'=>$message,'date'=>$this->date);
		// $template = $this->load->view('superadmin_view/photos/feedback_template',$data,TRUE);
		// $v=$this->send_user_email('sangeethak.richlabz@gmail.com','333sangeetha@gmail.com','sharu',$template);
			  $email_status=$this->Crud->sendmail($email_data);
                    if($email_status)
                    { 
					   $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]='success';
                       $response[DESCRIPTION]="Your feedback has been inserted successfully";  
                    }
				}}
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
	 public function get_photos_by_user_id1(){
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
					//$days['comment_days']=$this->days($post_id);
					$post_data=$this->u->user_photos_by_id($user_id);
					
				if(count($post_data)>0){
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user photos by sending id data';
                            $response['user_photos'] =$post_data;
							
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
	  public function get_photos_by_user_id(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
                
					//$days['comment_days']=$this->days($post_id);
					$post_data=$this->u->user_photos_by_id($user_id);
					
				if(count($post_data)>0){
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user photos by sending id data';
                            $response['user_photos'] =$post_data;
							
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
	}else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
		 echo json_encode($response);
	}
	 public function get_videos_by_user_id(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
                
					//$days['comment_days']=$this->days($post_id);
					$post_data=$this->u->user_videos_by_id($user_id);
					
				if(count($post_data)>0) {
			
							$response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user videos by sending id data';
                            $response['user_videos'] =$post_data;
							
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
	public function delete_photos(){
	$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(!empty($requested_data)){
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $user_id = (isset($requested_data->user_id)) ? ($requested_data->user_id) : '';
			 $photo_ids = (isset($requested_data->photo_ids)) ? ($requested_data->photo_ids) : '';
			 if ($photo_ids == "") {
                      $error_message[]='photo_ids are missing,';
                      $error = 1;
                   }                  
                  if ($user_id == "") {
                      $error_message[]='user_id is missing,';
                      $error = 1;
                   }
                  if(($user_id!="") && ($this->checkUserExistance($user_id) == 0)){
                  	 $error_message[]='User does not exists,';
                      $error = 1;
                  } 
                  if(($user_id!="") && (num_check($user_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
				  
                  if ($error == 0){
					if(count($photo_ids)>0){
						
                  	$delete_profile = $this->u->delete_batch($photo_ids,'files');
                  	if($delete_profile == true){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Photos deleted successfully';
                  	}else{
                  		$response[CODE]=FAIL_CODE;
                        $response[MESSAGE]='Failed';
                        $response[DESCRIPTION]='Fail to delete';
                  	}
					}else{
                  		$response[CODE]=FAIL_CODE;
                        $response[MESSAGE]='Failed';
                        $response[DESCRIPTION]='Photo ids are not entered';
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
		}}else
        {
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
        }
		echo json_encode($response);	
	}
		public function delete_videos(){
	$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $user_id = (isset($requested_data->user_id)) ? ($requested_data->user_id) : '';
			 $video_ids = (isset($requested_data->video_ids)) ? ($requested_data->video_ids) : '';
			 if ($video_ids == "") {
                      $error_message[]='video_ids are missing,';
                      $error = 1;
                   }                  
                  if ($user_id == "") {
                      $error_message[]='user_id is missing,';
                      $error = 1;
                   }
                  if(($user_id!="") && ($this->checkUserExistance($user_id) == 0)){
                  	 $error_message[]='User does not exists,';
                      $error = 1;
                  } 
                  if(($user_id!="") && (num_check($user_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
			
                  	$delete_profile = $this->u->delete_batch($video_ids,'da_videos_tbl');
                  	if($delete_profile == true){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Videos deleted successfully';
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
	public function addUserVideos(){
		 $response=array();
		 $inputData=file_get_contents('php://input');
		 if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
			$video_url=(isset($reqdata->video_url))?$reqdata->video_url:'';
            $created_date=$this->date;
                $error=0;
                $error_msg='';
                if(empty($user_id))
                {
                     $error=1;
                    $error_msg.='User id is required,';
                }
                if($user_id!='' && !num_check($user_id))
                {
                    $error=1;
                    $error_msg.='Invalid user_id,';
                }
				if(($user_id!="") && ($this->checkUserGroup($user_id) == 0)){
                  	 $error_msg.='UserId does not exists,';
                      $error = 1;
                  }
               if(empty($video_url))
                {
					$error=1;
                    $error_msg.='video_url is required,';
                }
				 if(!empty($video_url) && (!preg_match("/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/",$video_url)))
                {
					$error=1;
                    $error_msg.='video_url is invalid,';
                }
                if($error==0)
                {
					$data=array(
                            'user_id'=>$user_id,
                            'url'=>$video_url,
                            'date'=>$this->date
                        );
				 $res=$this->Crud->commonInsert("da_videos_tbl",$data,'videos inserted successfully');
           
                    if($res)
                    {
                       $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]='success';
                       $response[DESCRIPTION]="Your videos has been inserted successfully";  
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

	public function addUserPhotos(){
        $response=array();
        $inputData=file_get_contents('php://input');
    if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
			$picture=(isset($reqdata->picture))?$reqdata->picture:'';
            $picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
            $created_date=$this->date;
                $error=0;
                $error_msg='';
                if(empty($user_id))
                {
                     $error=1;
                    $error_msg.='User id is required,';
                }
                if($user_id!='' && !num_check($user_id))
                {
                    $error=1;
                    $error_msg.='Invalid user_id,';
                }
				if(($user_id!="") && ($this->checkUserGroup($user_id) == 0)){
                  	 $error_msg.='UserId does not exists,';
                      $error = 1;
                  }
               if(empty($picture))
                {
				$error=1;
                    $error_msg.='Picture is required,';
                }
			   if(!empty($picture))
                {
					if(empty($picture_data))
                {
                    $error=1;
                    $error_msg.='Picture source is required,';
                }
                }
                if($error==0)
                {
				// $wer=array('user_id'=>$user_id);
                // $row=$this->g->getUserData("da_users_tbl",$wer);date('Y-m-d')
					 if(!empty($picture)){
					  $count=count($picture);
                      $images_data=array();
                   for($i=0;$i<$count;$i++)
                       {
						   
							$path="uploads/files/";
							$fname1=''; 
							$picture_name=$this->pictureUpload($path,$picture[$i],$picture_data[$i],$fname1);
							$images_data[]=array(
									'uploaded_by'=>$user_id,
									'file_name' => $picture_name,
									'status'=>1,
									'uploaded_on'=>$this->date
								 ); 
						   }
					$res=$this->a->insert_damages('files',$images_data);
					 }
					// $data=array(
                            // 'user_id'=>$user_id,
                            // 'status'=>1,
                            // 'uploaded_on'=>$this->date
                        // );
						 // if(!empty($picture))
                // {
                  // $path="uploads/photos/";
                    // $fname1='';
                    // $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    // $picture1=(isset($picture))?$picture:'';
                     // $data['file_name']= $picture1;
                 // }else{
					  // $data['file_name']= "";
				 // }
				 // $res=$this->Crud->commonInsert("da_photos_tbl",$data,'photos inserted successfully');
           
                    if($res)
                    {
                       $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]='success';
                       $response[DESCRIPTION]="Your photos has been inserted successfully";  
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
 public function addUserPhotosNew(){
        $response = array();
        $error_message = array();$images = array();	$images_data=array();
        $error = 0;$res=0;
		$req_input=json_decode(json_encode($_POST['addImages']));
		if(isJson($req_input)){
			$req_input = json_decode($req_input);
			$user_id=(isset($req_input->user_id))?$req_input->user_id:'';
			$images_count=(isset($req_input->images_count))?$req_input->images_count:'';
			$description=(isset($req_input->description))?$req_input->description:'';
			$created_date=$this->date;	
			$error = 0;
// 			$images_count = ($images_count);
			if(empty($user_id))
                {
                     $error=1;
                    $error_message[]='User id is required,';
                }
                if($user_id!='' && !num_check($user_id))
                {
                    $error=1;
                    $error_message[]='Invalid user_id,';
                }
				if(($user_id!="") && ($this->checkUserGroup($user_id) == 0)){
                  	$error_message[]='UserId does not exists,';
                      $error = 1;
                  }
		if($error == 0){
		extract($_POST);extract($_FILES);//print_r($_FILES);//die;
		if($images_count>0){ 
		for($i=0;$i<$images_count;$i++){
		     $_FILES["picture".$i]["name"];
		if(!empty($_FILES["picture".$i]["name"]) && !empty($_FILES["picture".$i]["tmp_name"]))
		{
			$file_name=$_FILES["picture".$i]["name"];
			$new1=(explode('.',$file_name));
			$ext=end($new1);
			$file_name_new='rta'.rand(1000,9999).'.'.$ext;
			$file_path = "uploads/files/";
			$file_path = $file_path . basename($file_name_new);
			// end now
			$upload_res=move_uploaded_file($_FILES["picture".$i]["tmp_name"], $file_path);
			if($upload_res)
			{  
			$images[] = $file_name_new;
			}
			else
			{
				$images[] = '';
			}
		  }
		  
		}
					
		}
				// print_r($images);// die;
	
		for($j=0;$j<$images_count;$j++)
		{
			$images_data[]=array(
			'uploaded_by'=>$user_id,
			'file_name' => $images[$j],
			'description' => $description[$j],
			'status'=>1,
			'uploaded_on'=>$this->date
		 ); 
		}
//  		print_r($images_data);die;
		$res=$this->a->insert_damages('files',$images_data);
		if($res)
		{
		$response[CODE] = SUCCESS_CODE;
		$response[MESSAGE] = 'Success';
		$response[DESCRIPTION] ="Congratulations ..! Events added";                        
		}
		else
		{
		$response[CODE] = FAIL_CODE;
		$response[MESSAGE] = 'Failed';
		$response[DESCRIPTION] = 'Student not added';
		}
		}else{
		$response[CODE] = VALIDATION_CODE;
		$response[MESSAGE] = 'Validation';
		$response[DESCRIPTION] = implode(",",$error_message);
		}
		}else{

		$response[CODE] = VALIDATION_CODE;
		$response[MESSAGE] = 'Validation';
		$response[DESCRIPTION] = 'Input data should be in JSON format only';
		}
        echo json_encode($response);
    }
    public function addUserVideosNew(){
		$response=array();
		$inputData=file_get_contents('php://input');
		if(!empty($inputData))
		{
        if(isJson($inputData))
        {
		$reqdata=json_decode($inputData);
		$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
		$video_url=(isset($reqdata->video_url))?$reqdata->video_url:'';
		$description=(isset($reqdata->description))?$reqdata->description:'';
		$created_date=$this->date;
		$error=0;
		$error_msg='';
		if(empty($user_id))
		{
		$error=1;
		$error_msg.='User id is required,';
		}
		if($user_id!='' && !num_check($user_id))
		{
		$error=1;
		$error_msg.='Invalid user_id,';
		}
		if(($user_id!="") && ($this->checkUserGroup($user_id) == 0)){
		$error_msg.='UserId does not exists,';
		$error = 1;
		}
		if(empty($video_url))
		{
		$error=1;
		$error_msg.='video_url is required,';
		}
				 // if(!empty($video_url) && (!preg_match("/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/",$video_url)))
                // {
					// $error=1;
                    // $error_msg.='video_url is invalid,';
                // }
		if($error==0)
		{   $videos_data = array();
			for($j=0;$j<count($video_url);$j++)
			{
			if(!empty($video_url[$j]))
            {    $videos_data[]=array(
				'user_id'=>$user_id,
				'url'=>$video_url[$j],
				'title'=>$description[$j],
				'date'=>$this->date
			); 
			}
			}
		//	print_r($videos_data);die;
		if(!empty($videos_data)){
		$res=$this->a->insert_damages('da_videos_tbl',$videos_data);
		if($res){
		   $response[CODE]=SUCCESS_CODE;
		   $response[MESSAGE]='success';
		   $response[DESCRIPTION]="Your videos has been inserted successfully";  
		}else{
			$response[CODE]=FAIL_CODE;
			$response[MESSAGE]='Failed';
			$response[DESCRIPTION]="Videos data not inserted";  
		}
		}else{
			$response[CODE]=FAIL_CODE;
			$response[MESSAGE]='Failed';
			$response[DESCRIPTION]="Videos are not valid to insert";  
		}
		}else{
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
        }else{
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