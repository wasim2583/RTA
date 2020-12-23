<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mocktest_export_controller extends CI_Controller {
  public function __construct(){
   parent::__construct();
  
   // Load Model 
   $this->load->model('Main_model'); 
  } 

 
  // Export data in CSV format 
  public function exportCSV(){ 
   // file name 
   $filename = 'mocktest_'.date('Ymd').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // get data 
   $usersData = $this->Main_model->mocktest_export();

   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("question_id","Question","Answer","Written_on","Status","Option 1","Option 2","Option 3","Option 4","Option 5"); 
   fputcsv($file, $header);
   foreach ($usersData as $key=>$line){ 
     fputcsv($file,$line); 
   }
   fclose($file); 
   exit; 
  }
  
}