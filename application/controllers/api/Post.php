<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
         $this->ipaddress =$this->input->ip_address();
         date_default_timezone_set('asia/kolkata');
         $this->date = date('Y-m-d H:i:s');
         $this->load->model('superadmin/Crud');
         $this->load->model('api/user_model','u');
		   $this->load->model('api/post_model','p');
    }
	   public function get_posts(){
		$response = array(); 
		$params['table']="posts_tbl";
		//$params['wherecondition']=array('id'=>4);
		$result=$this->u->commonget($params);
		//echo $result;exit;
		print_r($result);
	}
	function dateDiff ($d1, $d2) {

    // Return the number of days between the two dates:    
    return round(abs(strtotime($d1) - strtotime($d2))/86400);

}
	public function days1(){
		$post_id=2;
	$date=	date('Y-m-d H:i:s');
		$comment_date=$this->p->post_comments($post_id);$comment_date=$comment_date->posted_on;
		return $this->dateDiff($date,$comment_date);
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
	
	
	public function course_update(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
      
		$input_res = json_decode($input_req);
		$user_id=(isset($input_res->user_id))?$input_res->user_id:'';
		$error=0;$error_msg='';
		 if($user_id==''){ $error=1; $error_msg.='Event ID is missing';}
		 if($user_id !='' && !is_numeric($user_id)){$error=1;$error_msg.='Invalid event ID';}
			 //$days['comment_days']=$this->days($post_id);
					$post_data = $this->p->get_course_data();
					$disignation="";
					if(!empty($user_id)){
					$login_data=array('user_id'=>$user_id);
					$resp=$this->u->login_check('da_users_tbl',$login_data);
					$disignation=$resp->disignation;
					}else{
						$disignation="";
					}
				if(count($post_data)>0){
			 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user details by sending id data';
                            $response['couse_number'] =$post_data->course_number;
							  $response['designation']=$disignation;
							
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] ='no data';
				}
		 echo json_encode($response); 
	 }
	
	public function get_post_data_by_group_id(){
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
					
					$post_data=$this->p->get_posts_in_group($group_id);
					
				if(count($post_data)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting posts in group by sending id data';
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
	public function get_specific_user_posts_data(){
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
					$post_data=$this->p->get_user_posts_data($user_id);
					//array_push($post_data,$days);
					//$data['post_details'] = (object) array('comment_days' => 'My name');
				if(count($post_data)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific user details by sending id data';
                            $response['post_details'] =$post_data;
							
							
						// $response['comment_days'] =$data['comment_days'];
                            // $response['user_groups_created'] =$data['user_groups_created'];
                            // $response['user_groups_participating'] =$data['user_groups_participating'];
                            // $response['user_posts']=$data['user_posts'];
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
	public function for_days(){
		$id=1;
		$r=$this->p->for_days($id);print_r($r);
	}
public	function days($then){
$then = '2018-11-10 09:02:23';
$then = new DateTime($then);
 
$now = new DateTime();
 
$sinceThen = $then->diff($now);

if(($sinceThen->y)!=0){
	return $sinceThen->y.' years have passed';exit;
}elseif(($sinceThen->m)!=0){
	return $sinceThen->m.' months have passed';exit;
}elseif(($sinceThen->d)!=0){
	return $sinceThen->d.' days have passed';exit;
}elseif(($sinceThen->h)!=0){
	return $sinceThen->h.' hours have passed';exit;
}elseif(($sinceThen->i)!=0){
	return $sinceThen->i.' minutes have passed';exit;
}elseif(($sinceThen->s)!=0){
	return $sinceThen->s.' months have passed';exit;
}
 }
	public function get_post_by_idd(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $post_id=(isset($reqdata->post_id))?$reqdata->post_id:'';
				$error=0;
                $error_msg='';
                if(!empty($post_id))
                {
					$post_data=$this->p->get_single_posts_datad($post_id);
					
				if(count($post_data)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific post details by sending id data';
                           $response['totalComments'] =$post_data->totalComments;
							$response['title'] =$post_data->title;
							$response['post_description'] =$post_data->post_description;
							$response['userId'] =$post_data->userId;
							$response['post_image'] =$post_data->post_image;
							$response['postedOn'] =$this->days($post_data->postedOn);
							$response['postedBy'] =$post_data->postedBy;
							$response['designation'] =$post_data->designation;
							$response['location'] =$post_data->location;
							$response['user_status'] =$post_data->user_status;
						
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
	 public function get_comment_by_post_id(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $post_id=(isset($reqdata->post_id))?$reqdata->post_id:'';
				$error=0;
                $error_msg='';
                if(!empty($post_id))
                {
					$post_data=$this->p->get_single_posts_datad($post_id);
					$post_data_comments=$this->p->get_comments_posts_data($post_id);
				if(count($post_data)>0)
			 {	$url= base_url().'uploads/group/';
				 if(!empty($post_data->post_image)){
					 $post_data->post_image=$url.$post_data->post_image;
				 }
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific post details by sending id data';
                            $response['totalComments'] =$post_data->totalComments;
							$response['title'] =$post_data->title;
							$response['post_description'] =$post_data->post_description;
							$response['user_id'] =$post_data->userId;
							$response['post_image'] =$post_data->post_image;
							//$response['postedOn'] =$this->days($post_data->postedOn);
							$response['postedBy'] =$post_data->postedBy;
							$response['years'] =$post_data->years;
							$response['months'] =$post_data->months;
							$response['days'] =$post_data->days;
							$response['hours'] =$post_data->hours;
							$response['minutes'] =$post_data->minutes;
							$response['seconds'] =$post_data->seconds;
							$response['designation'] =$post_data->designation;
							$response['location'] =$post_data->location;
							$response['user_status'] =$post_data->user_status;
							$response['profile_pic'] =$post_data->profile_pic;
							$response['post_details'] =$post_data_comments;
						
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
	 public function get_post_by_id(){
		$response = array(); 
			$inputData=file_get_contents('php://input');
			  if(!empty($inputData)){
				if(isJson($inputData)){
				$reqdata=json_decode($inputData);
                $post_id=(isset($reqdata->post_id))?$reqdata->post_id:'';
				$error=0;
                $error_msg='';
                if(!empty($post_id))
                {
					//$days['comment_days']=$this->days($post_id);
					$post_data=$this->p->get_single_posts_data($post_id);
					//array_push($post_data,$days);
					//$data['post_details'] = (object) array('comment_days' => 'My name');
				if(count($post_data)>0)
			 {
				 
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = 'Getting specific post details by sending id data';
                            $response['post_details'] =$post_data;
							
							
						// $response['comment_days'] =$data['comment_days'];
                            // $response['user_groups_created'] =$data['user_groups_created'];
                            // $response['user_groups_participating'] =$data['user_groups_participating'];
                            // $response['user_posts']=$data['user_posts'];
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
   	    public function add_post()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
				// $title=(isset($reqdata->title))?$reqdata->title:'';
                $description=(isset($reqdata->description))?$reqdata->description:'';
				$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
				$picture=(isset($reqdata->picture))?$reqdata->picture:'';
				$picture_data=(isset($reqdata->picture_data))?$reqdata->picture_data:'';
                $error=0;
                $error_msg='';
				// if(empty($title))
                // {
                    // $error=1;
                    // $error_msg.='Post title is required,';
                // }
                if(empty($description) && empty($picture))
                {
                    $error=1;
                    $error_msg.='Post description or image is required,';
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
				if(!empty($picture))
                {
                    $path="uploads/group/";
                    $fname1='';
                    $picture=$this->pictureUpload($path,$picture,$picture_data,$fname1);
                    //$picture1=(isset($picture))?$picture:'';
                     
                 }else{
					  $picture='';
				 }
         $data=array('post_description'=>$description,'posted_by'=>$user_id,'posted_on'=>$this->date,'post_image'=>$picture);
        $res=$this->Crud->commonInsert("posts_tbl",$data,'Post inserted successfully');
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

	public function get_specific_user_posts(){
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
				$user_exist=$this->u->common_count('da_users_tbl','user_id',$user_id);
				$post_data=$this->p->get_specific_user_posts_data($user_id);
				if(!empty($resp)){
					if(!empty($resp->profile_pic)){
						$url= base_url().'uploads/users/';
					$resp->profile_pic = $url.$resp->profile_pic ; 			 
					}else{
						$resp->profile_pic ="";
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
							//$response['user_status'] = $resp->user_status;
                            $response['user_posts']=$post_data;
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
   	    public function add_comment()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
				$post_id=(isset($reqdata->post_id))?$reqdata->post_id:'';
				$user_id=(isset($reqdata->user_id))?$reqdata->user_id:'';
                $comment=(isset($reqdata->comment))?$reqdata->comment:'';
              // $reply_for_comment_id=(isset($reqdata->reply_for_comment_id))?$reqdata->reply_for_comment_id:'';
			   $error=0;
                $error_msg='';
				if(empty($post_id))
                {
                    $error=1;
                    $error_msg.='Post ID is required,';
                }
                if($post_id!='' && !num_check($post_id))
                {
                    $error=1;
                    $error_msg.='Invalid Post ID,';
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
				// if($reply_for_comment_id!='' && !num_check($reply_for_comment_id))
                // {
                    // $error=1;
                    // $error_msg.='Invalid reply for comment ID,';
                // }
				if(empty($comment))
                {
                    $error=1;
                    $error_msg.='comment is required,';
                }
				if(!empty($post_id)){
					$where1=array('post_id'=>$post_id);
                    $user_check=$this->Crud->commonCheck('post_id', 'posts_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Post ID is not exists,';
                    }
				}
				if(!empty($user_id)){
					$where1=array('user_id'=>$user_id);
                    $user_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='User ID is not exists,';
                    }
				}
                if($error==0)
                {
        $insert_data=array('post_id'=>$post_id,'commented_by'=>$user_id,'comment'=>$comment,'commented_on'=>$this->date,'comment_status'=>1);
        $res=$this->Crud->commonInsert("da_comments_tbl",$insert_data,'comment inserted successfully');
        if($res)
        {
            $response[CODE] = SUCCESS_CODE;
            $response[MESSAGE] = 'Success';               
            $response['description'] ="Your comment data is inserted successfully";
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
	   	    public function add_reply_to_comment()
    {
        $response=array();
        $inputData=file_get_contents('php://input');
        if(!empty($inputData))
        { 
            if(isJson($inputData))
            {	$reqdata=json_decode($inputData);
				//$post_id=(isset($reqdata->post_id))?$reqdata->post_id:'';
				 $comment_id=(isset($reqdata->comment_id))?$reqdata->comment_id:'';
				$reply_by=(isset($reqdata->reply_by))?$reqdata->reply_by:'';
				$reply_for_comment=(isset($reqdata->reply_for_comment))?$reqdata->reply_for_comment:'';
              // $reply_for_comment_id=(isset($reqdata->reply_for_comment_id))?$reqdata->reply_for_comment_id:'';
			   $error=0;
                $error_msg='';
				// if(empty($post_id))
                // {
                    // $error=1;
                    // $error_msg.='Post ID is required,';
                // }
                // if($post_id!='' && !num_check($post_id))
                // {
                    // $error=1;
                    // $error_msg.='Invalid Post ID,';
                // }
					if(empty($reply_by))
                {
                    $error=1;
                    $error_msg.=' Reply User ID is required,';
                }
				
                if($reply_by!='' && !num_check($reply_by))
                {
                    $error=1;
                    $error_msg.='Invalid Reply User ID,';
                }
					if(empty($comment_id))
                {
                    $error=1;
                    $error_msg.='comment ID is required,';
                }
				if($comment_id!='' && !num_check($comment_id))
                {
                    $error=1;
                    $error_msg.='Invalid reply for comment ID,';
                }
				
				if(empty($reply_for_comment))
                {
                    $error=1;
                    $error_msg.='Reply for comment is required,';
                }
				if(!empty($reply_by)){
					$where2=array('user_id'=>$reply_by);
                    $user_check=$this->Crud->commonCheck('user_id', 'da_users_tbl', $where2);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Reply User ID is not exists,';
                    }
				}
				if(!empty($comment_id)){
					$where3=array('comment_id'=>$comment_id);
                    $user_check=$this->Crud->commonCheck('comment_id', 'da_comments_tbl', $where3);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Comment ID is not exists,';
                    }
					}
                if($error==0)
                {
        $insert_data=array('comment_id'=>$comment_id,'reply_to_comment'=>$reply_for_comment,'reply_by'=>$reply_by,'replied_on'=>$this->date,'replied_status'=>1);
        $res=$this->Crud->commonInsert("da_comments_replies_tbl",$insert_data,'Reply to this comment inserted successfully');
        if($res)
        {
            $response[CODE] = SUCCESS_CODE;
            $response[MESSAGE] = 'Success';               
            $response['description'] ="Your Reply data is inserted successfully";
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
   	public function edit_post()
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
				$post_id=(isset($req_response->post_id))?$req_response->post_id:'';
				$status=(isset($req_response->status))?$req_response->status:'';
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
				if(empty($post_id))
                {
                    $error=1;
                    $error_msg.='Post ID is required,';
                }
                if($post_id!='' && !num_check($post_id))
                {
                    $error=1;
                    $error_msg.='Invalid Post ID,';
                }
				if(!empty($post_id)){
					$where1=array('post_id'=>$post_id);
                    $user_check=$this->Crud->commonCheck('post_id', 'posts_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Post ID is not exists,';
                    }
				}
					  if(empty($status))
                {
                    $error=1;
                    $error_msg.='status is required,';
                }
				if(!empty($status)){
				if(!($status) == 1 || !($status) == 2)
                {
                    $error=1;
                    $error_msg.='Invalid status,status should be 1 or 2,';
                }}
                if ($error == 0) 
                    {
                        $update_array = array(
                            'title'=> $title,
                            'post_description'=> $description,
							'status'=>$status,
                        );
                        $update_where = array('post_id' => $post_id);
                        $table_name = "posts_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Posts updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Posts updated successfully';
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
public function edit_comment()
  	{
        $response = array();
        $error_msg='';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
				  $comment_id=(isset($req_response->comment_id))?$req_response->comment_id:'';
				$comment=(isset($req_response->comment))?$req_response->comment:'';
				$status=(isset($req_response->status))?$req_response->status:'';
                  $error = 0;
                
                if(empty($comment))
                {
                    $error=1;
                    $error_msg.='Comment is required,';
                }
				if(empty($comment_id))
                {
                    $error=1;
                    $error_msg.='Comment ID is required,';
                }
                if($comment_id!='' && !num_check($comment_id))
                {
                    $error=1;
                    $error_msg.='Invalid Comment ID,';
                }
					if(!empty($comment_id)){
					$where1=array('comment_id'=>$comment_id);
                    $user_check=$this->Crud->commonCheck('comment_id', 'da_comments_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Comment ID is not exists,';
                    }
					}
					  if(empty($status))
                {
                    $error=1;
                    $error_msg.='status is required,';
                }
				if(!empty($status)){
				if(!($status) == 1 || !($status) == 2)
                {
                    $error=1;
                    $error_msg.='Invalid status,status should be 1 or 2,';
                }}
                if ($error == 0) 
                    {
                        $update_array = array(
                            'comment'=> $comment,
							'comment_status'=>$status,
                        );
                        $update_where = array('comment_id' => $comment_id);
                        $table_name = "da_comments_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Posts updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Comments updated successfully';
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
public function edit_reply()
  	{
        $response = array();
        $error_msg='';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (isJson($req_input)) 
        {
                  $req_response = json_decode($req_input);
				  $reply_id=(isset($req_response->reply_id))?$req_response->reply_id:'';
				 $reply_for_comment=(isset($req_response->reply_for_comment))?$req_response->reply_for_comment:'';
				$status=(isset($req_response->status))?$req_response->status:'';
                  $error = 0;
				if(empty($reply_id))
                {
                    $error=1;
                    $error_msg.='Reply ID is required,';
                }
                if($reply_id!='' && !num_check($reply_id))
                {
                    $error=1;
                    $error_msg.='Invalid Reply ID,';
                }
					if(!empty($reply_id)){
					$where1=array('reply_id'=>$reply_id);
                    $user_check=$this->Crud->commonCheck('reply_id', 'da_comments_replies_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg.='Comment ID is not exists,';
                    }
					}
					  if(empty($status))
                {
                    $error=1;
                    $error_msg.='status is required,';
                }
				
				if(empty($reply_for_comment))
                {
                    $error=1;
                    $error_msg.='Reply for comment is required,';
                }
					if(!empty($status)){
				if(!($status) == 1 || !($status) == 2)
                {
                    $error=1;
                    $error_msg.='Invalid status,status should be 1 or 2,';
                }}
                if ($error == 0) 
                    {
                        $update_array = array(
                            'reply_to_comment'=> $reply_for_comment,
							'replied_status'=>$status,
                        );
                        $update_where = array('reply_id' => $reply_id);
                        $table_name = "da_comments_replies_tbl";
                        $update_profile = json_decode($this->Crud->commonUpdate($table_name, $update_array, $update_where, 'Reply for this comment updated successfully'));
                       if($update_profile->code==SUCCESS_CODE){
                       		$response[CODE]=SUCCESS_CODE;
							$response[MESSAGE]='Updated!';
							$response[DESCRIPTION]='Reply for this comment updated successfully';
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
	 public function checkUserExistance($post_id)
   {
      return $this->Crud->commonCheck('post_id','posts_tbl',array('post_id'=>$post_id));
   }
	public function delete_post()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $post_id = (isset($requested_data->post_id)) ? input_data($requested_data->post_id) : '';
			 if ($post_id == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   }                  
                 
                  if(($post_id!="") && ($this->checkUserExistance($post_id) == 0)){
                  	 $error_message[]='Post does not exists,';
                      $error = 1;
                  } 
                  if(($post_id!="") && (num_check($post_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('posts_tbl', array('post_id'=>$post_id),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Posts deleted successfully';
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
	public function delete_comment()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $comment_id = (isset($requested_data->comment_id)) ? input_data($requested_data->comment_id) : '';
			 if ($comment_id == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   }                  
                 
				 if(!empty($comment_id)){
					$where1=array('comment_id'=>$comment_id);
                    $user_check=$this->Crud->commonCheck('comment_id', 'da_comments_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg[]='Comment ID is not exists,';
                    }
					}
                  if(($comment_id!="") && (num_check($comment_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('da_comments_tbl', array('comment_id'=>$comment_id),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Comments deleted successfully';
                  	}else{
                  		$response[CODE]=FAIL_CODE;
                        $response[MESSAGE]='Failed';
                        $response[DESCRIPTION]='Fail to delete';
                  	}
                  }else{
                  		$response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Invalid';
                        $response[DESCRIPTION]=implode(", ",$error_msg);
                  }
		}else{
			  $response[CODE]=VALIDATION_CODE;
              $response[MESSAGE]='Invalid';
              $response[DESCRIPTION]='Input Data should be in JSON format only';
		}
		echo json_encode($response);
	}
public function delete_reply()
	{
		$response = array();
		$error=0;
		$error_message = array();
		$requested_data = file_get_contents('php://input');
		if(isJson($requested_data))
		{
			$requested_data = json_decode($requested_data);
			 $reply_id = (isset($requested_data->reply_id)) ? input_data($requested_data->reply_id) : '';
			 if ($reply_id == "") {
                      $error_message[]='Id is missing,';
                      $error = 1;
                   }                  
                 
				 if(!empty($reply_id)){
					$where1=array('reply_id'=>$reply_id);
                    $user_check=$this->Crud->commonCheck('reply_id', 'da_comments_replies_tbl', $where1);
                    if(!$user_check)
                    {
                        $error=1;
                        $error_msg[]='Comment ID is not exists,';
                    }
					}
                  if(($reply_id!="") && (num_check($reply_id)==0)){
                  	$error_message[]='Number is only allowed,';
                      $error = 1;
                  }
                  if ($error == 0){
                  	$delete_profile = json_decode($this->Crud->commonDelete('da_comments_replies_tbl', array('reply_id'=>$reply_id),''));
                  	if($delete_profile->code==SUCCESS_CODE){
                  		$response[CODE]=SUCCESS_CODE;
                        $response[MESSAGE]='success';
                        $response[DESCRIPTION]='Reply  for this comment deleted successfully';
                  	}else{
                  		$response[CODE]=FAIL_CODE;
                        $response[MESSAGE]='Failed';
                        $response[DESCRIPTION]='Fail to delete';
                  	}
                  }else{
                  		$response[CODE]=VALIDATION_CODE;
                        $response[MESSAGE]='Invalid';
                        $response[DESCRIPTION]=implode(", ",$error_msg);
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