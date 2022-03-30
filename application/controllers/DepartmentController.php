<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentController extends CI_Controller {

	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('departments/index');
		$this->load->view('layouts/footer');
	}

	public function designations(){
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('departments/designations');
		$this->load->view('layouts/footer');
	}
}