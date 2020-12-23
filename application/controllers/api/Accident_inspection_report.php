<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accident_inspection_report extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/accident_inspection_model','a');
    }
	
	public function get_pdf_forms(){
	$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$form_id=(isset($reqdata->form_id))?$reqdata->form_id:'';
				$error=0;
                $error_msg='';
                if(!empty($user_id))
                {
				$data=$this->a->get_pdf_details($user_id,$form_id);
				if(!empty($data))
				{
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting pdf details by id data';
                            $response['results'] =$data;
                            
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
   public function test()
   {
	   $this->load->view('superadmin_view/accident/accident_view');
   }
   public function pdf_create($id,$user_id,$crn_number,$ps){
	
		$this->load->model('Crud_model');
		//echo $id;die;
		$accident_info = json_decode($this->Crud_model->accidentInspectionFetch($id));
		$html="";
		if($accident_info->code == SUCCESS_CODE)
		{
		  $accident_info = $accident_info->data;
		  $location = $accident_info[0]->location;
		  $this->load->library('m_pdf');
		  $url=base_url()."uploads/forms/".$filename;
		  $data = array();$data['data'] = $accident_info;
// 		print_r($accident_info);exit;
		  $html.=$this->load->view('superadmin_view/accident/accident_view',$data,true);
					
					$this->m_pdf->pdf->WriteHTML($html);
					
					//download it.
$filename = str_replace(" ","_",str_replace("/","_",$ps))."_".str_replace(" ","_",str_replace("/","_",$crn_number))."_".date('YmdHis').'.pdf'; 
					$pdfFilePath = "uploads/forms/".$filename;
					$res = $this->m_pdf->pdf->Output($pdfFilePath, "F");
					$data=array('user_id'=>$user_id,'pdf_number'=>"pdf1","case_id"=>$id,'file_name'=>$filename,'date'=>$this->date);
					 $accident_id=$this->a->insert_accident("da_accident_pdf_tbl",$data);
					if($res){
					echo 'hi';exit;
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
  

    public function register_accident_report_sangeetha_backup()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
                $date=(isset($reqdata->date))?$reqdata->date:'';
				$registration_number=(isset($reqdata->registration_number))?$reqdata->registration_number:'';
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$crn_number=(isset($reqdata->crn_number))?$reqdata->crn_number:'';
				$ps=(isset($reqdata->ps))?$reqdata->ps:'';
                $date1=(isset($reqdata->date1))?$reqdata->date1:'';
				$time1=(isset($reqdata->time1))?$reqdata->time1:'';
				$location=(isset($reqdata->location))?$reqdata->location:'';
				$damages=(isset($reqdata->damages))?$reqdata->damages:'';
				$picture=(isset($reqdata->picture))?$reqdata->picture:'';
				$picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
            	$road_test=(isset($reqdata->road_test))?$reqdata->road_test:'';
				$opinion=(isset($reqdata->opinion))?$reqdata->opinion:'';
                $error=0;
                $error_msg='';
                if(empty($date))
                {
                    $error=1;
                    $error_msg.='date is required,';
                }
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
                if(empty($registration_number))
                {
                    $error=1;
                    $error_msg.='registration_number is required,';
                }
				if(empty($crn_number))
                {
                    $error=1;
                    $error_msg.='crn_number is required,';
                }
				 if(empty($ps))
                {
                    $error=1;
                    $error_msg.='policestation is required,';
                }
				if(empty($date1))
                {
                    $error=1;
                    $error_msg.='date1 is required,';
                }
				if(empty($time1))
                {
                    $error=1;
                    $error_msg.='time1 is required,';
                }
                // if($date1!='' && !date_check($date1))
                // {
                    // $error=1;
                    // $error_msg.='invalid date1,';
                // }
                if(empty($location))
                {
                    $error=1;
                    $error_msg.='location is required,';
                }
				 if(empty($damages))
                {
                    $error=1;
                    $error_msg.='damages is required,';
                }
				 if(empty($road_test))
                {
                    $error=1;
                    $error_msg.='road_test is required,';
                } 
				if(empty($opinion))
                {
                    $error=1;
                    $error_msg.='opinion is required,';
                }
                if($error==0)
                {
                 	$data=array(
							'user_id'=>$user_id,
                            'requisation_date'=>$date,
                            'registration_number'=>$registration_number,
                            'crn_number'=>$crn_number,
							'ps'=>$ps,
							'offence_date'=>$date1,
                            'offence_time'=>$time1,
							'location'=>$location,
							'road_test'=>$road_test,
							'opinion'=>$opinion,
                            'added_on'=>$this->date
                        );
			
                $accident_id=$this->a->insert_accident("da_accident_inspection_report_tbl",$data);
				
                 if(!empty($accident_id)){ 
					 // $members = explode(",",$members);
				// if(!empty($images)){
					// $path="uploads/images/";
                    // $fname1='';
                    // $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    // $picture1=(isset($picture))?$picture:'';
                    // $data['group_pic']= $picture1;
                 // }
					 // if(!empty($picture)){
					  // $count=count($picture);
                      // $picture=array(); $picture_data=array(); $images_data=array();
                   // for($i=0;$i<$count;$i++)
                       // {
					// $path="uploads/images/";
					 // $fname1=''; 
					 // $picture=$this->pictureUpload($path,$picture[$i],$picture_data[$i],$fname1);
					 // $images_data[]=array(
                    // 'accident_id'=>$accident_id,
                    // 'file_name'=>$picture,//'added_on'=>$this->date,group_id
                    // 'added_on'=>date('Y-m-d')
                         // ); 
						   // }
					// $res=$this->a->insert_damages('da_accident_images_tbl',$images_data);
					 // }
					  if(!empty($picture)){
					   $count=count($picture);//exit;
                      $images_data=array();
                   for($i=0;$i<$count;$i++)
                       {
						   
							$path="uploads/images/";
							$fname1=''; 
							$picture_name=$this->pictureUpload($path,$picture[$i],$picture_data[$i],$fname1);
							$images_data[]=array(
							'accident_id'=>$accident_id,
							'file_name'=>$picture_name,//'added_on'=>$this->date,group_id
							'added_on'=>$this->date
									// 'uploaded_by'=>$user_id,
									// 'file_name' => $picture_name,
									// 'status'=>1,
									// 'uploaded_on'=>$this->date
								 ); 
						   }
					$res=$this->a->insert_damages('da_accident_images_tbl',$images_data);
					 }
				if(!empty($damages)){
                      $count=count($damages);
                      $damages_data=array();//print_r($damages);exit;
                   for($i=0;$i<$count;$i++)
                       {
                   $damages_data[]=array(
                    'accident_id'=>$accident_id,
                    'damage'=>$damages[$i],//'added_on'=>$this->date,group_id
                    'added_on'=>$this->date
                         ); 
						   }
			  $res=$this->a->insert_damages('da_accident_damages_tbl',$damages_data);//exit;
				}
				if($res)
						{
						   $pdf=$this->pdf_create($accident_id,$user_id,$crn_number);
						     if($pdf==0){
						   $response[CODE]=SUCCESS_CODE;
						   $response[MESSAGE]='success';
						   $response[DESCRIPTION]="Your data has been inserted successfully";  
						}
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
 public function register_accident_report()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
				$crno=(isset($reqdata->crno))?$reqdata->crno:'';
				$ps_name=(isset($reqdata->ps_name))?$reqdata->ps_name:'';
                $location=(isset($reqdata->location))?$reqdata->location:'';
				$accident_date_time=(isset($reqdata->accident_date_time))?$reqdata->accident_date_time:'';
				$date_of_receipt=(isset($reqdata->date_of_receipt))?$reqdata->date_of_receipt:'';
                $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$accident_place=(isset($reqdata->accident_place))?$reqdata->accident_place:'';
                $width_nature=(isset($reqdata->width_nature))?$reqdata->width_nature:'';
				$registration_numbers=(isset($reqdata->registration_numbers))?$reqdata->registration_numbers:'';
				$inspection_date_time=(isset($reqdata->inspection_date_time))?$reqdata->inspection_date_time:'';
				$inspection_place=(isset($reqdata->inspection_place))?$reqdata->inspection_place:'';
				$fitness_expiry_date=(isset($reqdata->fitness_expiry_date))?$reqdata->fitness_expiry_date:'';
				$veh_damage_details=(isset($reqdata->veh_damage_details))?$reqdata->veh_damage_details:'';
            	$conditions_of_breaks=(isset($reqdata->conditions_of_breaks))?$reqdata->conditions_of_breaks:'';
				$conditions_of_tyres=(isset($reqdata->conditions_of_tyres))?$reqdata->conditions_of_tyres:'';
				
				$permit_validity=(isset($reqdata->permit_validity))?$reqdata->permit_validity:'';
				$insurance_details=(isset($reqdata->insurance_details))?$reqdata->insurance_details:'';
				$owner_name=(isset($reqdata->owner_name))?$reqdata->owner_name:'';
				$driver_name=(isset($reqdata->driver_name))?$reqdata->driver_name:'';
				$dl_particulars=(isset($reqdata->dl_particulars))?$reqdata->dl_particulars:'';
            	$opinion=(isset($reqdata->opinion))?$reqdata->opinion:'';
                $error=0;
                $error_msg='';
                if(empty($crno))
                {
                    $error=1;
                    $error_msg.='crno is required,';
                }
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
                if(empty($ps_name))
                {
                    $error=1;
                    $error_msg.='ps name is required,';
                }
				if(empty($date_of_receipt))
                {
                    $error=1;
                    $error_msg.='Date of receipt is required,';
                }
				 if(empty($accident_date_time))
                {
                    $error=1;
                    $error_msg.='accident date and time is required,';
                }
				if(empty($registration_numbers))
                {
                    $error=1;
                    $error_msg.='Accident Vehicle details is required,';
                }
                if(empty($inspection_date_time))
                {
                    $error=1;
                    $error_msg.='Inspection details required,';
                }
				 if(empty($conditions_of_breaks))
                {
                    $error=1;
                    $error_msg.='Vehicle break condition details required,';
                }
				 if(empty($conditions_of_tyres))
                {
                    $error=1;
                    $error_msg.='Vehicle tyres condition details required,';
                } 
				if(empty($owner_name))
                {
                    $error=1;
                    $error_msg.='Owner name is required,';
                }
				if(empty($driver_name))
                {
                    $error=1;
                    $error_msg.='Driver name is required,';
                }
				if(empty($dl_particulars))
                {
                    $error=1;
                    $error_msg.='Dl details required,';
                }
				if(empty($opinion))
                {
                    $error=1;
                    $error_msg.='Opinion details required';
                }
                if($error==0)
                {
                 	$data=array(
							'user_id'=>$user_id,
                            'crno'=>$crno,
                            'ps_name'=>$ps_name,
                            'location'=>$location,
							'date_of_receipt'=>date('Y-m-d',strtotime($date_of_receipt)),
							'accident_date_time'=>date('Y-m-d H:i:s',strtotime($accident_date_time)),
                            'accident_place'=>$accident_place,
							'width_nature'=>$width_nature,
							'registration_numbers'=>$registration_numbers,
							'inspection_date_time'=>date('Y-m-d H:i:s',strtotime($inspection_date_time)),
							'inspection_place'=>$inspection_place,
							'fitness_expiry_date'=>$fitness_expiry_date,
                            'veh_damage_details'=>$veh_damage_details,
							'conditions_of_breaks'=>$conditions_of_breaks,
							'conditions_of_tyres'=>$conditions_of_tyres,
							'permit_validity'=>$permit_validity,
							'insurance_details'=>$insurance_details,
                            'owner_name'=>$owner_name,
							'driver_name'=>$driver_name,
							'dl_particulars'=>$dl_particulars,
							'opinion'=>$opinion,
                            'added_on'=>$this->date
                        );
			
                $accident_id=$this->a->insert_accident("da_accident_inspection_report_tbl",$data); 
				if(!empty($accident_id))
					{
					   $pdf=$this->pdf_create($accident_id,$user_id,$crno,$ps_name);
					   $response[CODE]=SUCCESS_CODE;
					   $response[MESSAGE]='success';
					   $response[DESCRIPTION]="Your data has been inserted successfully";  
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
        {   //echo 12;die;
            $response['code']=VALIDATION_CODE;
            $response['message']='Data is required';
            $response['description']='Data is required';    
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
				  $disignation=(isset($req_response->designation))?$req_response->designation:'';
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
				   if(empty($disignation)){
                    $error=1;
                    $error_message[]='disignation is required';
                }
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
				
                if($disignation!='' && !alphaspace_check($disignation))
                {
                    $error=1;
                    $error_message[]='allows only alphabets and space'; 
                }
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
							'disignation'=>$disignation,
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
							//echo json_encode($response);exit;
							$url= base_url().'uploads/users/';
								$response['user_id'] = $resp->user_id;
								$response['name'] = $resp->name;
								$response['designation'] = $resp->disignation;
								$response['location'] = $resp->location;
								$response['mobile'] = $resp->mobile;
								$response['profile_pic'] = $url.$resp->profile_pic;
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
    echo json_encode($response);
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
				                }
				            }
				            else{
				            	$response['code']=FAIL_CODE;
			                    $response['message']='Failed';
			                    $response['description']='OTP is not verified';
			                    $response['mobile']=$mobile;
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
		                $msg="Dear User, $otp is your One Time Password for verifying mobile number";
		            	$senderid="HSCITY";
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
                        $msg="Dear User, ";
                    $res_sms =otp_send($otp,$mobile,$msg);
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
			                        $update_data = array('password'=>md5($password),'mobile_otp'=>0,'mobile_verified_status'=>0);
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