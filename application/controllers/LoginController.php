<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('LoginModel');
    }

	public function index(){
		if (isset($_SESSION['user_data'])) {
       		redirect(base_url());
       	}
       	else{
			$this->load->view('login/index');
		}
	}

	public function login_ajax(){
		$username = $this->input->post('email');
		$password = $this->input->post('password');
		$check_user = $this->LoginModel->signin($username,$password);
		if ($check_user) {
    		$this->session->set_userdata('user_data',$check_user);
    		die(json_encode(array('status'=>1)));
    	}
    	else{
    		die(json_encode(array('status'=>'0','msg'=>'Credentials are Invalid Or Account is Inactive')));
    	}
	}

	public function logout(){
    	$this->session->unset_userdata('user_data');
        //$this->session->unset_userdata('location_user');
		$this->session->sess_destroy();
		redirect(base_url());
    }
}