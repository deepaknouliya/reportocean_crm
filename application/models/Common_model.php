<?php
class Common_model extends CI_Model{

  public function check_user($username,$table,$table_field_name){ //check if user exists
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($table_field_name,$username);
      $query = $this->db->get();
      if ( $query->num_rows() > 0 )
      {
        return false;
      }
      else{
        return true;
      }
  }

  public function delete_query($table,$condition){
    $this->db->delete($table,$condition);
    return true;
  }

  public function fetch_data_join($table1,$table2="",$condition=""){
    $this->db->select('*');
    $this->db->from($table1);
    $this->db->join($table2,$condition);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function fetch_data_join_double($table,$table1="",$condition1="",$table2="",$condition2){
    $this->db->select('*');
    $this->db->from($table);
    $this->db->join($table1,$condition1);
    $this->db->join($table2,$condition2);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function fetch_data_join_double_api($table,$table1="",$condition1="",$table2="",$condition2,$where){
    $this->db->select('*');
    $this->db->from($table);
    $this->db->join($table1,$condition1);
    $this->db->join($table2,$condition2);
    $this->db->where($where);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function insert_function($table,$data){ // insert into database
          if($this->db->insert($table, $data)){
            return true;
          }
          else{
            return false;
          }
  }

  public function insert_last_function($table,$data){ // insert into database
          if($this->db->insert($table, $data)){
            $insert_id = $this->db->insert_id();
        return  $insert_id;
          }
          else{
            return false;
          }
  }

  public function fetch_data($table,$where = ''){
    $this->db->select('*');
    $this->db->from($table);
    if($where!=""){
      $this->db->where($where);
    }
    $this->db->order_by("created_date", "desc");
      $query = $this->db->get()->result_array();
      return $query;
  }

  public function fetch_data_double_and($table,$where = '',$where2=''){
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where($where);
    $this->db->where($where2);
    $this->db->order_by("created_date", "desc");
      $query = $this->db->get()->result_array();
      return $query;
  }

  public function update_table($table,$data,$condition){
      $this->db->where($condition);
      $this->db->update($table,$data);
      return true;
  }

  public function update_table_single($table,$data){
      $this->db->update($table,$data);
      return true;
  }

}