<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Group extends CI_Controller {

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
    }
	public function get_group_by_user_id(){
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
				$user_groups=$this->g->get_group_data_id($user_id);
				if(count($user_groups)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting all group list details by sending id of user';
                           
							// $response['designation'] =$post_data->designation;
							// $response['location'] =$post_data->location;
							// $response['user_status'] =$post_data->user_status;
							$response['group_list'] =$user_groups;
						
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter post_id';
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
	public function get_posts_by_group_id(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $group_id=(isset($reqdata->group_id))?$reqdata->group_id:'';
				$error=0;
                $error_msg='';
                if(!empty($group_id))
                {
				$user_groups=$this->g->get_group_data_id($group_id);
				if(count($user_groups)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting all group list details by sending id of user';
                           
							// $response['designation'] =$post_data->designation;
							// $response['location'] =$post_data->location;
							// $response['user_status'] =$post_data->user_status;
							$response['group_list'] =$user_groups;
						
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter post_id';
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
      return $this->Crud->commonCheck('group_id','user_groups_tbl',array('group_id'=>$userid));
   }
    public function checkUserGroup($userid)
   {
      return $this->Crud->commonCheck('user_id','da_users_tbl',array('user_id'=>$userid));
   }
	public function createGroup(){
        $response=array();
        $inputData=file_get_contents('php://input');
    if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
            $group_name=(isset($reqdata->group_name))?$reqdata->group_name:'';
			$picture=(isset($reqdata->picture))?$reqdata->picture:'';
            $picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
            $members=(isset($reqdata->members))?$reqdata->members:'';
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
                if(empty($group_name))
                {
                    $error=1;
                    $error_msg.='group_name is required,';
                } 
                if(empty($members))
                {
                    $error=1;
                    $error_msg.='Members is required,';
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
            $wer=array('user_id'=>$user_id);
              $row=$this->g->getUserData("da_users_tbl",$wer);
					$data=array(
                            'group_name'=>$group_name,
                            'created_by'=>$user_id,
                            'group_status'=>1,
                            'created_on'=>$this->date
                        );
						 if(!empty($picture))
                {
                  $path="uploads/group/";
                    $fname1='';
                    $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    $picture1=(isset($picture))?$picture:'';
                     $data['group_pic']= $picture1;
                 }else{
					  $data['group_pic']= "";
				 }
                $group_inserted_id=$this->g->insert_group("user_groups_tbl",$data);
				
                 if(!empty($group_inserted_id)){ 
					 // $members = explode(",",$members);
                      $count=count($members);
                      $group_data=array();
                   for($i=0;$i<$count;$i++)
                       {
                   $group_data[]=array(
                    'user_id'=>$user_id,
					'group_id'=>$group_inserted_id,
                    'member_id'=>$members[$i],//'added_on'=>$this->date,group_id
                    'added_on'=>date('Y-m-d')
                         ); 
						// $res=$this->g->insert_members('groups_members_tbl',$group_data);
               }
			  // print_r($group_data);exit;
            $res=$this->g->insert_members('groups_members_tbl',$group_data);
             }
                    if($res)
                    {
                       $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]='success';
                       $response[DESCRIPTION]="Your group has been inserted successfully";  
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
	public function add_posts_in_group(){
        $response=array();
        $inputData=file_get_contents('php://input');
    if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
            $group_id=(isset($reqdata->group_id))?$reqdata->group_id:'';
			$picture=(isset($reqdata->picture))?$reqdata->picture:'';
            $picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
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
                if(empty($group_id))
                {
                    $error=1;
                    $error_msg.='group_id is required,';
                }
				if($group_id!='' && !num_check($group_id))
                {
                    $error=1;
                    $error_msg.='Invalid group_id,';
                }
				if(($group_id!="") && ($this->checkUserExistance($group_id) == 0)){
                  	 $error_msg.='group_id does not exists,';
                      $error = 1;
                  }
                if(empty($description))
                {
                    $error=1;
                    $error_msg.='Description is required,';
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
            $wer=array('user_id'=>$user_id);
              $row=$this->g->getUserData("da_users_tbl",$wer);
			  
					$data=array(
                            'posted_by'=>$user_id,
                            'group_id'=>$group_id,
							'post_description'=>$description,
                            'status'=>1,
                            'posted_on'=>$this->date
                        );
						 if(!empty($picture))
                {
                  $path="uploads/group/";
                    $fname1='';
                    $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    $picture1=(isset($picture))?$picture:'';
                     $data['post_image']= $picture1;
                 }else{
					  $data['post_image']= "";
				 }
                $group_inserted_id=$this->g->insert_group("posts_tbl",$data);
				
                    if($group_inserted_id)
                    {
                       $response[CODE]=SUCCESS_CODE;
                       $response[MESSAGE]='success';
                       $response[DESCRIPTION]="Your data has been inserted successfully in group";  
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
	public function add_post_in_group()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
                $description=(isset($reqdata->description))?$reqdata->description:'';
				$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
                $error=0;
                $error_msg='';
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
        $insert_data=array('post_description'=>$description,'posted_by'=>$user_id,'posted_on'=>$this->date);
        $res=$this->Crud->commonInsert("posts_tbl",$insert_data,'Post inserted successfully');
        if($res)
        {
            $response[CODE] = SUCCESS_CODE;
            $response[MESSAGE] = 'Success';               
            $response['description'] ="Your post data is inserted successfully";
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
	public function get_specific_group_data(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $group_id=(isset($reqdata->group_id))?$reqdata->group_id:'';
				$error=0;
                $error_msg='';
                if(!empty($group_id))
                {
					$post_data=$this->g->get_single_group_data($group_id);
					
				if(count($post_data)>0)
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific group data by sending group_id';
                            $response['post_details'] =$post_data;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}}else{
							$response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='Please enter group_id';
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
	  public function getGroupData(){
    $response=array();
     $data=$this->g->get_data();
	 $count=$this->c->count_num_recs('user_groups_tbl');
     if(!empty($data))
     {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $count.'Records found from Groups';
                            $response['result'] =$data['result'];
                            //$response['category']=$data['category'];
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
                        }
                echo json_encode($response);        

}
	
	public function delete_group()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $userid = (isset($requested_data->id)) ? input_data($requested_data->id) : '';
			 if ($userid == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   }                  
                 
                  if(($userid!="") && ($this->checkUserExistance($userid) == 0)){
                  	 $error_message[]='Group does not exists,';
                      $error = 1;
                  } 
                  if(($userid!="") && (num_check($userid)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$group_data = json_decode($this->Crud->commonDelete('user_groups_tbl', array('group_id'=>$userid),''));
                  	if($group_data->code==SUCCESS_CODE){
						$group_members_data = json_decode($this->Crud->commonDelete('groups_members_tbl', array('group_id'=>$userid),''));
                  		if($group_members_data->code==SUCCESS_CODE){
						$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Group deleted successfully';
                  	}}else{
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
public function searchData1(){
			$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
					
				$reqdata=json_decode($inputData);
				
                $name=(isset($reqdata->name))?$reqdata->name:'';
		$result=$this->g->searchData($name);
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
				$data=$this->g->searchData($search_str);
				if(!empty($data['user_groups_data']))
			 {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Searching data by name,location,designation';
                            $response['user_groups_data'] =$data['user_groups_data'];
                            
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
	public function groupProfile(){
        $response=array();
        $inputData=file_get_contents('php://input');
    if(!empty($inputData))
     {
        if(isJson($inputData))
        {
            $reqdata=json_decode($inputData);
            $group_name=(isset($reqdata->group_name))?$reqdata->group_name:'';
			 $picture=(isset($reqdata->picture))?$reqdata->picture:'';
             $picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
            $created_user_id=(isset($reqdata->created_user_id))?$reqdata->created_user_id:'';
            $created_date=$this->date;
                $error=0;
                $error_msg='';
                if(empty($group_name))
                {
                    $error=1;
                    $error_msg.='Group Name is required,';
                }
                if(empty($created_user_id))
                {
                    $error=1;
                    $error_msg.='user_id is required,';
                }
                if($created_user_id!='' && !num_check($created_user_id))
                {
                    $error=1;
                    $error_msg.='Invalid user_id,';
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
					$where1=array('user_id'=>$created_user_id);
                    $user_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='User ID is not exists,';
                    }
                if($error==0)
                {
                 $data=array(
                            'group_name'=>$group_name,
                            'created_by'=>$created_user_id,
                            'created_on'=>$this->date,
                            'group_status'=>1,
                        );
                if(!empty($picture))
                {
                  $path="uploads/group/";
                    $fname1='';
                    $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    $picture1=(isset($picture))?$picture:'';
                     $data['group_pic']= $picture1;
                 }
                $profile_add=$this->f->common_insert("user_groups_tbl",$data);
                    if($profile_add)
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
	public function edit_group()
  	{
        $response = array();
        $error_message = array();
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
                  $userid = (isset($req_response->id)) ? input_data($req_response->id) : '';
                  $group_name=(isset($reqdata->group_name))?$reqdata->group_name:'';
					$picture=(isset($reqdata->picture))?$reqdata->picture:'';
					$picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
                  $error = 0;
                  if ($userid == ""){
                      $error_message[]='User Id is missing,';
                      $error = 1;
                   }
                    if(empty($group_name))
                {
                    $error=1;
                    $error_msg.='Group Name is required,';
                }
                  if(($userid!="") && (!num_check($userid))) {
                      $error_message[]='Invalid userid, ';
                      $error = 1;
                  }
                 
                 if ((num_check($userid)) && ($this->group_id($userid) == 0)) {
                      $error_message[]='User does not exists, ';
                      $error = 1;
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
	   				
                if ($error == 0) 
                    {
                        $update_array = array(
                            'group_name'=>$group_name,
                        );
								if(!empty($picture))
						{
						  $path="uploads/group/";
							$fname1='';
							$picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
							$picture1=(isset($picture))?$picture:'';
							 $update_array['group_pic']= $picture1;
						 }
                        $update_where = array('group_id' => $userid);
                        $table_name = "user_groups_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Profile updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Profile updated successfully';
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