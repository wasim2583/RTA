<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Drunk_drive extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
		 $this->load->model('api/Without_license_model','w');
		  $this->load->model('api/accident_inspection_model','a');
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
                            $response['user_details'] =$data['user_details'];
                            
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
	public function pdf_create($id,$user_id){
		//echo 'hi';exit;
		$this->load->model('Crud_model');
		//echo $id;exit;
		$accident_info = json_decode($this->Crud_model->drunkDriveFetch($id));
		$html="";
		if($accident_info->code == SUCCESS_CODE)
		{
		  $accident_info = $accident_info->data;
		  $location = $accident_info[0]->location;
		  $this->load->library('m_pdf');
		  $filename = 'drunk_'.date('YmdHis').'.pdf'; 
					
		  $url=base_url()."uploads/forms/".$filename;
		  $data = array();$data['data'] = $accident_info;
		  $html.=$this->load->view('superadmin_view/drunk_drive/pdf_view',$data,true);
					
					$this->m_pdf->pdf->WriteHTML($html);
					
					//download it.
					$filename = 'drunk_'.date('YmdHis').'.pdf'; 
					$pdfFilePath = "uploads/forms/".$filename;
					$res = $this->m_pdf->pdf->Output($pdfFilePath, "F");
					$data=array('user_id'=>$user_id,'pdf_number'=>"pdf2",'case_id'=>$id,'file_name'=>$filename,'date'=>$this->date);
					 $accident_id=$this->a->insert_accident("da_drunk_pdf_tbl",$data);
					if($res){
						//echo 'hi';exit;
					return $res = 1;
		}else{
			return $res=0;
		}
		}
	else
	{
		return $res=0;
	}
  }
   public function checkUserExistance($userid)
   {
      return $this->Crud->commonCheck('user_id','da_users_tbl',array('user_id'=>$userid));
   }
    public function register_drunk_report()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
				$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$name=(isset($reqdata->submitted_to))?$reqdata->submitted_to:'';
                $location=(isset($reqdata->location))?$reqdata->location:'';
                $date=(isset($reqdata->date))?$reqdata->date:'';
                $from_hrs=(isset($reqdata->from_hrs))?$reqdata->from_hrs:'';
				$to_hrs=(isset($reqdata->to_hrs))?$reqdata->to_hrs:'';
                $city=(isset($reqdata->city))?$reqdata->city:'';
				$driver_details=(isset($reqdata->driver_details))?$reqdata->driver_details:'';
				$owner_details=(isset($reqdata->owner_details))?$reqdata->owner_details:'';
				$vehicle_number=(isset($reqdata->vehicle_number))?$reqdata->vehicle_number:'';
                $vcr_number=(isset($reqdata->vcr_number))?$reqdata->vcr_number:'';
                $picture=(isset($reqdata->picture))?$reqdata->picture:'';
				$picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
				$error=0;
                $error_msg='';
				if(empty($user_id))
                {
                    $error=1;
                    $error_msg.='user_id is required,';
                }
				 if(($user_id!="") && (!num_check($user_id))) {
                      $error_msg.='Invalid user_id, ';
                      $error = 1;
                  }
				  if ((num_check($user_id)) && ($this->checkUserExistance($user_id) == 0)) {
                      $error_msg.='User does not exists, ';
                      $error = 1;
                  }
				if(empty($name))
                {
                    $error=1;
                    $error_msg.='name is required,';
                }
                if(empty($location))
                {
                    $error=1;
                    $error_msg.='location is required,';
                }
                
                if(empty($date))
                {
                    $error=1;
                    $error_msg.='date is required,';
                }
            
				 if(empty($from_hrs))
                {
                    $error=1;
                    $error_msg.='from_hrs is required,';
                }
                // if($date!='' && !date_check($date))
                // {
                    // $error=1;
                    // $error_msg.='invalid date,';
                // }
                if(empty($to_hrs))
                {
                    $error=1;
                    $error_msg.='to_hrs is required,';
                }
				if(empty($city))
                {
                    $error=1;
                    $error_msg.='city is required,';
                }
				if(empty($driver_details))
                {
                    $error=1;
                    $error_msg.='driver_details is required,';
                }
				if(empty($owner_details))
                {
                    $error=1;
                    $error_msg.='owner_details is required,';
                }
                
				 if(empty($vehicle_number))
                {
                    $error=1;
                    $error_msg.='vehicle_number is required,';
                }
				 if(empty($vcr_number))
                {
                    $error=1;
                    $error_msg.='vcr_number is required,';
                }
                if($error==0)
                {
                 	$data=array(
							'user_id'=>$user_id,
                            'location'=>$location,
                            'date'=>date('Y-m-d',strtotime(str_replace("/","-",$date))),
                            'from_hrs'=>$from_hrs,
							'to_hrs'=>$to_hrs,
							'city'=>$city,
							'submitted_to'=>$name,
                            'added_on'=>$this->date
                        );
                $accident_id=$this->a->insert_accident("da_drnuk_tbl",$data);
				
                 if(!empty($accident_id)){ 
					 // $members = explode(",",$members);
					 /* if(!empty($picture)){
					  $count=count($picture);
                      $picture=array(); $picture_data=array(); $images_data=array();
                   for($i=0;$i<$count;$i++)
                       {
					$path="uploads/images/";
					 $fname1=''; 
					 $picture=$this->pictureUpload($path,$picture[$i],$picture_data[$i],$fname1);
					 $images_data[]=array(
                    'drunk_case_id'=>$accident_id,
                    'file_name'=>$picture,//'added_on'=>$this->date,group_id
                    'added_on'=>date('Y-m-d')
                         ); 
						   }
					$res=$this->a->insert_damages('da_drunk_images_tbl',$images_data);
					 }*/
					  if(!empty($picture)){
					  $count=count($picture);
                      $images_data=array();
                   for($i=0;$i<$count;$i++)
                       {
						   
							$path="uploads/images/";
							$fname1=''; 
							$picture_name=$this->pictureUpload($path,$picture[$i],$picture_data[$i],$fname1);
							$images_data[]=array(
							 'drunk_case_id'=>$accident_id,
							'file_name'=>$picture_name,//'added_on'=>$this->date,group_id
							'added_on'=>$this->date
									// 'uploaded_by'=>$user_id,
									// 'file_name' => $picture_name,
									// 'status'=>1,
									// 'uploaded_on'=>$this->date
								 ); 
						   }
					$res=$this->a->insert_damages('da_drunk_images_tbl',$images_data);
					 }
                      $count=count($driver_details);
                      $damages_data=array();
                   for($i=0;$i<$count;$i++)
                       {
                   $damages_data[]=array(
                    'drunk_case_id'=>$accident_id,
                    'driver_details'=>$driver_details[$i],
					'owner_details'=>$owner_details[$i],
					'vehicle_number'=>$vehicle_number[$i],
					'vcr_number'=>$vcr_number[$i],
                    'added_on'=>date('Y-m-d')
                         ); 
						   }
			  $res=$this->a->insert_damages('da_drivers_drunk_tbl',$damages_data);
				if($res){
					$pdf=$this->pdf_create($accident_id,$user_id);
						if($pdf==0){
						   $response[CODE]=SUCCESS_CODE;
						   $response[MESSAGE]='success';
						   $response[DESCRIPTION]="Your data has been inserted successfully";  
				}  }
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