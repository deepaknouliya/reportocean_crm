<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller {

	public function add_employee()
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/add_employee');
		$this->load->view('layouts/footer');
	}

	public function view_employees(){
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/view_employees');
		$this->load->view('layouts/footer');
	}
}