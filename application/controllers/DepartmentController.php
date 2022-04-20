<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentController extends CI_Controller {

	private $table;

	public function __construct() {
       parent::__construct();
       $this->load->model('Common_model');
       $this->table = "departments";
    }

	public function index()
	{
		$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('departments/index',$data);
		$this->load->view('layouts/footer');
	}

	public function designations(){
		$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('departments/designations',$data);
		$this->load->view('layouts/footer');
	}

	public function add_department(){
		$dept_name = $this->input->post('department_name', TRUE);
		$table = $this->table;
		$table_field_name2 = "department_name";
		if ($this->Common_model->check_user($dept_name,$table,$table_field_name2)) {
			$data = array("department_name" => $dept_name);
			if($this->Common_model->insert_function($table,$data)){
				$this->session->set_flashdata('department_success', 'Department Added Successfully');
				redirect(base_url('departments'));
			}
			else{
				$this->session->set_flashdata('department_error', 'Something Went Wrong');
				redirect(base_url('departments'));
			}
		}
		else{
			$date = date('Y-m-d H:i:s');
			$data = array("is_active"=>1,"update_date"=>$date);
			$condition = array("department_name"=>$dept_name);
			if($this->Common_model->update_table($table,$data,$condition)){
				$this->session->set_flashdata('department_success', 'Department Added Successfully');
				redirect(base_url('departments'));
			}
			else{
				$this->session->set_flashdata('department_error', 'Something Went Wrong');
				redirect(base_url('departments'));
			}
		}
	}

	public function update_department(){
		$dept_id = base64_decode($this->input->post('dept_id'));
		$department_name = $this->input->post('department_name');
		$where = array("department_name"=>$department_name);
		$where2 = "dept_id<>".$dept_id;
		$checker = $this->Common_model->fetch_data_double_and($this->table,$where,$where2);
		if(count($checker)>0){
			die(json_encode(array('status'=>0,'msg'=>'Department with same name already exists')));
		}
		else{
			$date = date('Y-m-d H:i:s');
			$data = array('department_name'=>$department_name,'update_date'=>$date);
			$condition = array('dept_id'=>$dept_id);
			$update = $this->Common_model->update_table($this->table,$data,$condition);
			if($update){
				die(json_encode(array('status'=>'1')));
			}
			else{
				die(json_encode(array('status'=>0,'msg'=>'Something Went Wrong')));
			}
		}
	}

	public function delete_dept(){
		$date = date('Y-m-d H:i:s');
		$dept_id = base64_decode($this->input->post('dept_id'));
		$condition = array('dept_id'=>$dept_id);
		$data = array('is_active'=>0,'update_date'=>$date);
		$update = $this->Common_model->update_table($this->table,$data,$condition);
		if ($update) {
			die(json_encode(array('status'=>'1')));
		}
		else{
			die(json_encode(array('status'=>0,'msg'=>'Something Went Wrong')));
		}
	}

	public function add_designation(){
		$table = "designations";
		$dept_id = base64_decode(($this->input->post('dept_id')));
		$designation_name = $this->input->post('designation_name');
		$where = array('dept_id'=>$dept_id);
		$where2 = array('designation_name'=>$designation_name);
		if(count($this->Common_model->fetch_data_double_and($table,$where,$where2))>0){
			echo "1";
		}
		else{
			echo "0";
		}
	}
}