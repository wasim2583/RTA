<?php
class Import_mocktest_controller extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('csv_mocktest_model');
		$this->load->library('session');
    }
    function index()
    {  // echo "hi";die;
        //$this->load->view('uploadCsvView',$data);
		$this->load->view('superadmin_view/mocktest_import_view');
    }
    function uploadData()
    {
		print_r($_FILES);
		$userfile=$_FILES['userfile'];//die;
		$tmp = $userfile['tmp_name'];
      $imp=  $this->csv_mocktest_model->uploadData();
	  if($imp){
		  $this->session->set_flashdata('import','File Uploaded Successfully!');
        redirect('admin/mocktest/mocktest_uploadData');
    }
	}
}
?>