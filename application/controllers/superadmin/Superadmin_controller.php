<?php
class Superadmin_controller extends CI_Controller
{
	public function __construct()
	{    
		parent::__construct();
		$this->load->model('crud_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('pagination');
	}
	
	public function login(){
		$this->load->view('superadmin_view/login_view');
	}

	public function validate_login_data()
	{
		extract($_POST);
		$config = array(
			array(
	                'field' => 'email',
	                'label' => 'Email',
	                'rules' => 'required',
	                'errors' => array(
	                        'required' => 'Please Enter Username Here.',
	                ),
	        ),
	        array(
	                'field' => 'pwd',
	                'label' => 'Password',
	                'rules' => 'required',
	                'errors' => array(
	                        'required' => 'Please Enter Password Here.',
	                ),));
				$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('superadmin_view/login_view');
		}
		else{
			$arr=array('admin_email'=>$email,'admin_password'=>md5($pwd));
		    $data=$this->crud_model->where_count($arr,'da_admin_tbl');
		    if($data==1){
		    	$res=$this->crud_model->where_get1($arr,'da_admin_tbl');
				//print_r($res);exit;
				//$this->session->set_userdata('admin_id',$res['admin_id']);
			    $this->session->set_userdata('admin_name',$res['admin_name']);
				$this->session->set_userdata('admin_email',$res['admin_email']);
				$ip_addr = $_SERVER['REMOTE_ADDR'];
				$login_date = date('Y-m-d H:i:s');
				$arr=array('admin_last_login_date'=>$login_date,'admin_last_login_ip'=>$ip_addr);
				$cc=array('admin_id'=>$res['admin_id']);
				$up = $this->crud_model->common_update($cc,'da_admin_tbl',$arr);
			    if($up==1)
			    {
			    	$this->session->set_userdata('state_id', $res['admin_state']);
			    	$this->session->set_userdata('admin_id', $res['admin_id']);
			    	redirect('admin/users/user_information');
			    }
			}
			else{
				$this->session->set_flashdata('message','INVALID CREDENTIALS');
				redirect('admin');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('admin_name');
		redirect(base_url().'Home/home');
	}

	public function change_password()
	{
		$this->load->view('superadmin_view/change_password_view');	
	}

	public function admin_change_password()
	{
		extract($_POST);//print_r($_POST);die;
		if(isset($reset)){
			//echo "hi";die;
			//$this->load->view('superadmin_view/change_password_view');
		}
		$config = array(
		array(
                'field' => 'oldp',
                'label' => 'old password',
                'rules' => 'required',
                
        ),
		array(
                'field' => 'newp',
                'label' => 'new password',
                'rules' => 'required',
                
        ),
        array(
                'field' => 'confirmp',
                'label' => 'Confirm password',
                'rules' => 'required|matches[newp]',
                ));
				$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('superadmin_view/change_password_view');
		}
		else{
			$data=array('admin_password'=>md5($confirmp));
		    $swhere=array('admin_password'=>md5($oldp));
		    $uwhere=array('admin_id'=>1);
	        $change=$this->crud_model->admin_change_password($swhere,$uwhere,'da_admin_tbl',$data);//echo $change;die;
	        if($change==1){
	        	$this->session->set_flashdata('change_password','The password has been changed!');
	        	redirect("admin/change_password");
	        }
	        if($change==2){
	        	$this->session->set_flashdata('not_change_password','The password not has been changed!');
	        	redirect("admin/change_password");
	        }
	        if($change==3){
	        /*$this->session->set_flashdata('wrong_password','You Entered Wrong Password for Old Password Field!');
		    redirect("admin/change_password");*/
		    $data['wrong_pwd']='Entered Old Password is Wrong!';
		    $this->load->view('superadmin_view/change_password_view',$data);
		    }
		}
	}

}
?>