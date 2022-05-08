<?php
class Leads_model extends CI_Model{

  public function fetch_employee_data($dept_id){ 

  	$sql="SELECT * FROM employee where dept_id='$dept_id' AND active='1' AND (emp_id) NOT IN (SELECT emp_id FROM lead_automate_list);";    
    $query = $this->db->query($sql);
    return $query->result_array();
  
  }

  public function fetch_automate_employees(){
  	$sql = "SELECT * FROM lead_automate_list JOIN employee ON employee.emp_id=lead_automate_list.emp_id JOIN departments ON departments.dept_id=employee.emp_id ORDER BY priority ASC";
  	$query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_priority_emp(){
    $sql = "SELECT * FROM lead_automate_list WHERE active='1' ORDER BY priority ASC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function update_list($list_id,$field){
    $sql = "UPDATE lead_automate_list SET ".$field." = ".$field." + 1 WHERE list_id = ".$list_id."";
    $query = $this->db->query($sql);
    if ($query) {
      return true;
    }
    else{
      return false;
    }
  }
}