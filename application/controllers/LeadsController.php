<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadsController extends CI_Controller {

	public function new_lead()
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('leads/main');
		$this->load->view('layouts/footer');
	}

	public function view_employees(){
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/view_employees');
		$this->load->view('layouts/footer');
	}

	public function settings(){
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('leads/settings');
		$this->load->view('layouts/footer');
	}
}