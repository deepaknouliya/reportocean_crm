<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadsController extends CI_Controller {

	private $table;
	private $main_table;

	public function __construct() {
       parent::__construct();
       $this->load->model('Common_model');
       $this->load->model('Leads_model');
       $this->table = "departments";
    }

    public function create_lead_manual(){
    	$table = "leads";
    	$_POST['assigned_user'] = $_SESSION['user_data'][0]['emp_id'];
    	$_POST['assigned_by'] = $_SESSION['user_data'][0]['emp_id'];
    	$_POST['updated_by_emp_id'] = $_SESSION['user_data'][0]['emp_id'];
    	$_POST['updated_by_emp_name'] = $_SESSION['user_data'][0]['employee_name'];
    	$_POST['lead_status'] = 1;
    	$_POST['source_id'] = 4;
    	$lead = $this->Common_model->insert_function($table,$_POST);
    	if($lead){
    		die(json_encode(array('status'=>1)));
    	}
    	else{
    		die(json_encode(array('status'=>0)));
    	}
    }

    public function assign_lead_manually(){
    	if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
    	$table = "leads";
    	$emp_id = $this->input->post('emp_id');
    	$lead_id = base64_decode($this->input->post('lead_id'));
    	$lead_data = array('assigned_user'=>$emp_id,'lead_status'=>1,'assigned_by'=>$_SESSION['user_data'][0]['emp_id']);
		$condition = array('lead_id'=>$lead_id);
    	$assign_lead = $this->Common_model->update_table($table,$lead_data,$condition);
    	echo "1";
    }

    public function delete_lead(){
    	$lead_id = base64_decode($this->input->post('lead_id'));
    	$table = "leads";
    	$condition = array('lead_id'=>$lead_id);
    	if($this->Common_model->delete_query($table,$condition)){
    		die(json_encode(array('status'=>1)));
    	}
    	else{
    		die(json_encode(array('status'=>0)));
    	}
    }

    public function fetch_lead(){
    	$lead_id = base64_decode($this->input->post('lead_id'));
    	$data = $this->Leads_model->fetch_lead($lead_id);
    	if (count($data)>0) {
    		die(json_encode(array('status'=>1,'data'=>$data)));
    	}
    	else{
    		die(json_encode(array('status'=>0)));
    	}
    }

    public function update_lead(){
    	$table = "leads";
    	$update_date = date('Y-m-d H:i:s');
    	if (isset($_SESSION['user_data'])) {
    		if (!isset($_POST['follow_up_date'])) {
    			$_POST['follow_up_date'] = "";
    		}
    		$lead_id = base64_decode($this->input->post('lead_id'));
    		unset($_POST['lead_id']);
    		$_POST['update_date'] = $update_date;
    		$emp_name = $_SESSION['user_data'][0]['employee_name'];
    		$emp_id = $_SESSION['user_data'][0]['emp_id'];
    		$_POST['updated_by_emp_id'] = $emp_id;
    		$_POST['updated_by_emp_name'] = $emp_name;
    		$condition = array('lead_id'=>$lead_id);
    		$update = $this->Common_model->update_table($table,$_POST,$condition);
    		if ($update) {
    			die(json_encode(array('status'=>1)));
    		}
    		else{
    			die(json_encode(array('status'=>0)));
    		}
    	}
    	else{
    		die(json_encode(array('status'=>0)));
    	}
    }

	public function new_lead()
	{
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		if (isset($_SESSION['user_data'])) {
			$user_id = $_SESSION['user_data'][0]['emp_id'];
			$where = array('lead_status'=>1);
			$where2 = array('assigned_user'=>$user_id);
			$data['leads'] = $this->Common_model->fetch_data_double_and($table,$where,$where2);
			$data['title'] = "New Leads";
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function all_leads(){
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		if (isset($_SESSION['user_data'])) {
			$user_id = $_SESSION['user_data'][0]['emp_id'];
			$data['leads'] = $this->Common_model->fetch_data("leads");
			$data['title'] = "All Leads";
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function on_hold()
	{
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		if (isset($_SESSION['user_data'])) {
			$user_id = $_SESSION['user_data'][0]['emp_id'];
			$where = array('lead_status'=>2);
			$where2 = array('assigned_user'=>$user_id);
			$data['leads'] = $this->Common_model->fetch_data_double_and($table,$where,$where2);
			$data['title'] = "On Hold";
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function closed()
	{
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		if (isset($_SESSION['user_data'])) {
			$user_id = $_SESSION['user_data'][0]['emp_id'];
			$where = array('lead_status'=>4);
			$where2 = array('assigned_user'=>$user_id);
			$data['leads'] = $this->Common_model->fetch_data_double_and($table,$where,$where2);
			$data['title'] = "Closed";
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function rejected()
	{
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		if (isset($_SESSION['user_data'])) {
			$user_id = $_SESSION['user_data'][0]['emp_id'];
			$where = array('lead_status'=>5);
			$where2 = array('assigned_user'=>$user_id);
			$data['leads'] = $this->Common_model->fetch_data_double_and($table,$where,$where2);
			$data['title'] = "Rejected";
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function follow_ups()
	{
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		if (isset($_SESSION['user_data'])) {
			$user_id = $_SESSION['user_data'][0]['emp_id'];
			$where = array('lead_status'=>3);
			$where2 = array('assigned_user'=>$user_id);
			$data['leads'] = $this->Common_model->fetch_data_double_and($table,$where,$where2);
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$data['title'] = "Follow Ups";
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function unassigned_leads(){
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table = "leads";
		$where = array('lead_status'=>0);
		if ($_SESSION['user_data'][0]['perm_3']==1) {
			$data['leads'] = $this->Common_model->fetch_data($table,$where);
			$data['title'] = "Unassigned Leads";
			$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
			$this->load->view('layouts/header');
			$this->load->view('layouts/sidebar');
			$this->load->view('leads/main',$data);
			$this->load->view('layouts/footer');
		}
		else{
			redirect(base_url());
		}
	}

	public function create_lead_api(){
		$table = "leads";
		$source_id = $this->input->post('source_id');
		$lead_automator = $this->Common_model->fetch_data("lead_automator");
		$automate = $lead_automator[0]['automate'];
		if ($automate==1) {
			$increment_field = "";
			$lead_id = $this->Common_model->insert_last_function($table,$_POST);
			$fetch_employees = $this->Leads_model->fetch_priority_emp();
			foreach ($fetch_employees as $list_data) {
				$list_id = $list_data['list_id'];
				$emp_id = $list_data['emp_id'];
				if ($source_id==1) {
					$increment_field = "report_ocean_quota";
					if($list_data['report_ocean']>$list_data['report_ocean_quota']){
						break;
					}
				}
				elseif ($source_id==2) {
					$increment_field = "astute_quota";
					if($list_data['astute']>$list_data['astute_quota']){
						break;
					}
				}
				elseif ($source_id==3) {
					$increment_field = "panorama_quota";
					if($list_data['panorama']>$list_data['panorama_quota']){
						break;
					}
				}
			}
			$lead_data = array('assigned_user'=>$emp_id,'lead_status'=>1);
			$condition = array('lead_id'=>$lead_id);
			$assign_lead = $this->Common_model->update_table($table,$lead_data,$condition);
			$update_list = $this->Leads_model->update_list($list_id,$increment_field);
			if ($update_list) {
				die(json_encode(array('status'=>1,'msg'=>'Lead Added Successfully')));
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Something Went Wrong')));
			}
		}
		else{
			$lead_id = $this->Common_model->insert_function($table,$_POST);
			if ($lead_id) {
				die(json_encode(array('status'=>1,'msg'=>'Lead Added Successfully')));
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Something Went Wrong')));
			}
		}
	}

	public function view_employees(){
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/view_employees');
		$this->load->view('layouts/footer');
	}

	public function settings(){
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
		$data['leads_employees'] = $this->Leads_model->fetch_automate_employees();
		$data['lead_automator'] = $this->Common_model->fetch_data("lead_automator");
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('leads/settings',$data);
		$this->load->view('layouts/footer');
	}

	public function add_emp_automate(){
		if (!isset($_SESSION['user_data'])) {
			redirect(base_url('login'));       
		}
		$table="lead_automate_list";
		foreach ($_POST['emp_id'] as $data) {
			$insert_data = array('emp_id'=>$data);
			$insert_id = $this->Common_model->insert_last_function($table,$insert_data);
			$condition = array('list_id'=>$insert_id);
			if($insert_id){
			$new_data = array('priority'=>$insert_id);
			$updater = $this->Common_model->update_table($table,$new_data,$condition);
			}
		}
		die(json_encode(array('status'=>'1')));
	}

	public function update_automate(){
		$table = "lead_automator";
		$automate = $this->input->post('automate');
		$new_data = array('automate'=>$automate);
		$updater = $this->Common_model->update_table_single($table,$new_data);
	}

	public function update_quota(){
		$table = "lead_automate_list";
		$condition = array('list_id'=>$_POST['list_id']);
		unset($_POST['list_id']);
		$updater = $this->Common_model->update_table($table,$_POST,$condition);
		if($updater){
			die(json_encode(array('status'=>'1')));
		}
		else{
			die(json_encode(array('status'=>'0')));
		}
	}

	public function swap_employee(){
		$table = "lead_automate_list";
		$own_id = $this->input->post('own_id');
		$swap_id = $this->input->post('swap_id');

		$a_own = $this->Common_model->fetch_data($table,array('list_id'=>$own_id));

		$own_sort = $a_own[0]["priority"];

		$a_swap = $this->Common_model->fetch_data($table,array('list_id'=>$swap_id));

		$swap_sort = $a_swap[0]["priority"];

		$updater = $this->Common_model->update_table($table,array('priority'=>$swap_sort),array('list_id'=>$own_id));

		$updater = $this->Common_model->update_table($table,array('priority'=>$own_sort),array('list_id'=>$swap_id));
		echo "success";
	}
}