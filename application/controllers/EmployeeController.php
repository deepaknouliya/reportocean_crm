<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller {

	private $table;
	private $main_table;

	public function __construct() {
       parent::__construct();
       $this->load->model('Common_model');
       $this->table = "departments";
       $this->main_table = "employee";
       if (isset($_SESSION['user_data'])) {
       	# code...
       }
       else{
       	redirect(base_url('login'));
       }
    }

    public function edit_employee($id){
    	$emp_id = base64_decode($id);
    	$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
    	$condition1 = "departments.dept_id=employee.dept_id";
		$condition2 = "designations.desig_id=employee.desig_id";
		$table2 = "designations";
		$where = array('emp_id'=>$emp_id);
    	$data['emp_data'] = $this->Common_model->fetch_data_join_double_api($this->main_table,$this->table,$condition1,$table2,$condition2,$where);
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/edit_employee',$data);
		$this->load->view('layouts/footer');
    }

	public function add_employee()
	{
		$data['departments'] = $this->Common_model->fetch_data($this->table,array('is_active'=>'1'));
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/add_employee',$data);
		$this->load->view('layouts/footer');
	}

	public function view_employees(){
		$condition1 = "departments.dept_id=employee.dept_id";
		$condition2 = "designations.desig_id=employee.desig_id";
		$table2 = "designations";
		$data['employee_data'] = $this->Common_model->fetch_data_join_double($this->main_table,$this->table,$condition1,$table2,$condition2);
		$this->load->view('layouts/header');
		$this->load->view('layouts/sidebar');
		$this->load->view('employee/view_employees',$data);
		$this->load->view('layouts/footer');
	}

	public function activate_employee(){
		$emp_id = $this->input->post('emp_id');
		$data = array('active'=>1);
		if (isset($_POST['act_status'])) {
			$data = array('active'=>$_POST['act_status']);
		}
		$condition = array('emp_id'=>$emp_id);
		if($this->Common_model->update_table($this->main_table,$data,$condition)){
			die(json_encode(array('status'=>'1')));
		}
		else{
			die(json_encode(array('status'=>'0')));
		}
	}

	public function edit_employee_ajax(){
		if (!isset($_POST['perm_1'])) {
			$_POST['perm_1'] = 0;
		}
		if (!isset($_POST['perm_2'])) {
			$_POST['perm_2'] = 0;
		}
		if (!isset($_POST['perm_3'])) {
			$_POST['perm_3'] = 0;
		}
		$emp_id = base64_decode($this->input->post('emp_id'));
		$condition = array('emp_id'=>$emp_id);
		unset($_POST['emp_id']);
		$path = "./upload/images/";
		$title = "title";
		if($_FILES['image_name']['name'][0]!=""){
			$uploader = $this->upload_files($path,$title, $_FILES['image_name']);
			if ($uploader) {
				$image_name = $uploader[0];
				$_POST['image_name'] = $image_name;
				if($this->Common_model->update_table($this->main_table,$_POST,$condition)){
					die(json_encode(array('status'=>'1','msg'=>'Success')));
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'Something Went Wrong')));
				}
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'The file you are trying to upload is not an image')));
			}
		}
		else{
			if($this->Common_model->update_table($this->main_table,$_POST,$condition)){
					die(json_encode(array('status'=>'1','msg'=>'Success')));
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'Something Went Wrong')));
			}
		}
	}

	public function add_employee_ajax(){
		$email = $this->input->post('email');
		$exists = $this->Common_model->fetch_data($this->main_table,array('email'=>$email));
		if (count($exists)>0) {
			$active_status = $exists[0]['active'];
			$emp_id = $exists[0]['emp_id'];
			if ($active_status==0) {
				die(json_encode(array('status'=>'2','emp_id'=>$emp_id)));
			}
			else{
				die(json_encode(array('status'=>'0','msg'=>'Employee with same email already exists!')));
			}
		}
		else{
			$path = "./upload/images/";
			$title = "title";
			if($_FILES['image_name']['name'][0]!=""){
				$uploader = $this->upload_files($path,$title, $_FILES['image_name']);
				if ($uploader) {
					$image_name = $uploader[0];
					$_POST['image_name'] = $image_name;
					if($this->Common_model->insert_function($this->main_table,$_POST)){
						die(json_encode(array('status'=>'1','msg'=>'Success')));
					}
					else{
						die(json_encode(array('status'=>'0','msg'=>'Something Went Wrong')));
					}
				}
				else{
					die(json_encode(array('status'=>'0','msg'=>'The file you are trying to upload is not an image')));
				}
			}
			else{
				if($this->Common_model->insert_function($this->main_table,$_POST)){
						die(json_encode(array('status'=>'1','msg'=>'Success')));
					}
					else{
						die(json_encode(array('status'=>'0','msg'=>'Something Went Wrong')));
				}
			}
		}
	}

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $path = $image;
            $newName = md5(time().mt_rand(000000,999999)).".".pathinfo($path, PATHINFO_EXTENSION); 

            //$fileName = $title .'_'. $image;
            $fileName = $newName;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
                $this->resizeImage($fileName);
            } else {
                return false;
            }
        }

        return $images;
    }

    public function resizeImage($filename)
   {
      $source_path = $_SERVER['DOCUMENT_ROOT'] . '/upload/images/' . $filename;
      $target_path = $_SERVER['DOCUMENT_ROOT'] . '/upload/images/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'width' => 500,
      );

      $this->load->library('image_lib');
// Set your config up
      $this->image_lib->initialize($config_manip);
        // Do your manipulation
      $this->image_lib->clear();
   
   }
}