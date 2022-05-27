<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function __construct() {
       parent::__construct();
       $this->load->model('Common_model');
       $this->load->model('Leads_model');
       $this->table = "leads";
    }

	public function index()
	{
		if($this->session->userdata('user_data')){
			if ($_SESSION['user_data'][0]['perm_3']==1) {
				$data['new_leads'] = count($this->Common_model->fetch_data($this->table));
				$data['closed_leads'] = count($this->Common_model->fetch_data($this->table,array('lead_status'=>4)));
				$data['on_hold'] = count($this->Common_model->fetch_data($this->table,array('lead_status'=>2)));
				$data['rejected'] = count($this->Common_model->fetch_data($this->table,array('lead_status'=>5)));
			}
			else{
				$user_id = $_SESSION['user_data'][0]['emp_id'];
				$data['new_leads'] = count($this->Common_model->fetch_data($this->table,array('assigned_user'=>$user_id)));
				$data['closed_leads'] = count($this->Common_model->fetch_data_double_and($this->table,array('lead_status'=>4),array('assigned_user'=>$user_id)));
				$data['on_hold'] = count($this->Common_model->fetch_data_double_and($this->table,array('lead_status'=>2),array('assigned_user'=>$user_id)));
				$data['rejected'] = count($this->Common_model->fetch_data_double_and($this->table,array('lead_status'=>5),array('assigned_user'=>$user_id)));
			}
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('index',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url('login'));
		}
	}
}
