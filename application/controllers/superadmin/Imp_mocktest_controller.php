<?php
class Imp_mocktest_controller extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Csv_mock_model');
		$this->load->library('session');
		
    }
    function index()
    {  // echo "hi";die;
        //$this->load->view('uploadCsvView',$data);
		$this->load->view('superadmin_view/mock_import_view');
    }
    function uploadData()
    {
		extract($_POST);
		if(isset($managemock)){
			redirect('admin/mocktest/mocktest_information');
		}
      $import=  $this->Csv_mock_model->uploadData();//echo $import;die;
	  if($import==777){
		  $this->session->set_flashdata('hospital_file','Please choose mocktest related file only!');
        redirect('superadmin/imp_mocktest_controller');
    }
	  if($import==1){
		  $this->session->set_flashdata('import','File Uploaded Successfully!');
        redirect('superadmin/imp_mocktest_controller');
    }else{
	$this->session->set_flashdata('no_import','File Not Uploaded!');
        redirect('superadmin/imp_mocktest_controller');	
	}
	}
}
?>