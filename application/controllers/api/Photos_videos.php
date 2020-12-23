<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Photos_videos extends CI_Controller {

    public function __construct() 
	{
        parent::__construct();
        $this->load->model(array('api/events_model'));
    }
	public function getEvents(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
        if(isJson($input_req)){
		$input_res = json_decode($input_req);
		$adminID=(isset($input_res->admin_id))?$input_res->admin_id:'';
		$error=0;$error_msg='';
		 if($adminID==''){ $error=1; $error_msg.='School ID is missing';}
		 if($adminID !='' && !is_numeric($adminID)){$error=1;$error_msg.='Invalid school ID';}
		 if($error==0){
			$whereCondition=array('admin_id'=>$adminID,'status'=>1);
			$events=$this->events_model->getEvents($whereCondition);
			echo $events;
		
		}else{
	     	 $response[CODE]=301;
	         $response[MESSAGE]='Validation';
	         $response[DESCRIPTION]=$error_msg;
		     echo json_encode($response);
	     }
		 }else{
		   $response[CODE]=301;
           $response[MESSAGE]='Validation';
           $response[DESCRIPTION]='Input data should be in JSON format only';
           echo json_encode($response);
		}
	}
	public function eventDetails(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
        if(isJson($input_req)){
		$input_res = json_decode($input_req);
		$event_id=(isset($input_res->event_id))?$input_res->event_id:'';
		$error=0;$error_msg='';
		 if($event_id==''){ $error=1; $error_msg.='Event ID is missing';}
		 if($event_id !='' && !is_numeric($event_id)){$error=1;$error_msg.='Invalid event ID';}
		 if($error==0){
			$whereCondition=array('event_id'=>$event_id);
			$event=$this->events_model->eventDetails($whereCondition);
			echo $event;
		
		}else{
	     	 $response[CODE]=301;
	         $response[MESSAGE]='Validation';
	         $response[DESCRIPTION]=$error_msg;
		     echo json_encode($response);
	     }
		 }else{
		   $response[CODE]=301;
           $response[MESSAGE]='Validation';
           $response[DESCRIPTION]='Input data should be in JSON format only';
           echo json_encode($response);
		}
	}
	public function photoDetails1(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
      
		$input_res = json_decode($input_req);
		$event_id=(isset($input_res->event_id))?$input_res->event_id:'';
		$error=0;$error_msg='';
		 if($event_id==''){ $error=1; $error_msg.='Event ID is missing';}
		 if($event_id !='' && !is_numeric($event_id)){$error=1;$error_msg.='Invalid event ID';}
		 if($error==0){
			$whereCondition=array('event_id'=>$event_id);
			$event=$this->events_model->photosDetails($whereCondition);
			echo $event;
		
		}else{
	     	 $response[CODE]=301;
	         $response[MESSAGE]='Validation';
	         $response[DESCRIPTION]=$error_msg;
		     echo json_encode($response);
	     }
		
	}
	public function photoDetails2(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
      
		$input_res = json_decode($input_req);
		$event_id=(isset($input_res->event_id))?$input_res->event_id:'';
		$error=0;$error_msg='';
		 if($event_id==''){ $error=1; $error_msg.='Event ID is missing';}
		 if($event_id !='' && !is_numeric($event_id)){$error=1;$error_msg.='Invalid event ID';}
		
			$whereCondition=array('event_id'=>$event_id);
			$event=$this->events_model->photosDetails($whereCondition);
			echo $event;
		
	}
	public function photoDetails(){
		$response = array(); 
		$input_req = file_get_contents('php://input');
      
		$input_res = json_decode($input_req);
		$user_id=(isset($input_res->user_id))?$input_res->user_id:'';
		$error=0;$error_msg='';
		 if($user_id==''){ $error=1; $error_msg.='Event ID is missing';}
		 if($user_id !='' && !is_numeric($user_id)){$error=1;$error_msg.='Invalid event ID';}
		
			//$whereCondition=array('event_id'=>$event_id);
			$event=$this->events_model->photosDetails($user_id);
			echo $event;
	}
}
?>