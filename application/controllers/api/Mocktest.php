<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mocktest extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
		   $this->load->model('api/mocktest_model','m');
    }
		public function get_all_mocktest_data(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
      
		$input_res = json_decode($input_req);
		$event_id=(isset($input_res->event_id))?$input_res->event_id:'';
		$error=0;$error_msg='';
		 if($event_id==''){ $error=1; $error_msg.='Event ID is missing';}
		 if($event_id !='' && !is_numeric($event_id)){$error=1;$error_msg.='Invalid event ID';}
		
			$whereCondition=array('event_id'=>$event_id);
			$event=$this->m->mocktest($whereCondition);
			echo $event;
	}
	public function get_all_mocktest_data1(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
					$post_data=$this->m->mocktest();
				if(count($post_data)>0)
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'To display all mocktest data';
                            $response['results'] =$post_data;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}
		  echo json_encode($response);
	}
	public function english_bank(){
		$response = array(); 
					$english_data=$this->m->english();
				if(count($english_data)>0)
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'To display all mocktest data';
                            $response['english'] =$english_data;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}
		  echo json_encode($response);
	}
	public function telugu_bank(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$error=0;
                $error_msg='';
					$telugu_data=$this->m->telugu();
				if(count($telugu_data)>0)
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'To display all mocktest data';
                            $response['results'] =$telugu_data;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}
		  echo json_encode($response);
	}
	 public function checkUserExistance($diary_id)
   {
      return $this->Crud->commonCheck('diary_id','da_diary_tbl',array('diary_id'=>$diary_id));
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