<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 
{
  public function __construct()
  {
    parent::__construct();
  }
  public function count_record($table, $where = NULL, $join = NULL, $group_by = NULL, $last_query = FALSE)
  {
    $this->db->select('*')->from($table);
    if ($where !== NULL)
    {
      (is_array($where)) ? $this->db->where($where, FALSE) : $this->db->where($where, NULL, FALSE);
    }
    if ( ! empty($join))
    {
      foreach($join as $val) { $this->db->join($val['table'], $val['on'], $val['type']); }
    }
    
    if ($group_by !== NULL) $this->db->group_by($group_by);
    
    $query = $this->db->get();

    if($last_query) echo $this->db->last_query();
    
    return ($query->num_rows() === 0) ? 0 : $query->num_rows();
  }
  // End of count_record function

  public function get_record($table, $columns = '*', $where = NULL, $join = NULL, $sort_column = NULL, $sort_direction = 'ASC', $group_by = NULL,  $result_type = 'object', $last_query = FALSE)
  {  
    $this->db->select($columns, FALSE);
    
    $this->db->from($table);
    
    if ($where !== NULL)
    {
      (is_array($where)) ? $this->db->where($where, FALSE) : $this->db->where($where, NULL, FALSE);
    }
    
    if ($join !== NULL)
    {
      foreach($join as $val) { $this->db->join($val['table'], $val['on'], $val['type']); }
    }
    
    if ($group_by !== NULL) $this->db->group_by($group_by);
    
    if ($sort_column !== NULL) $this->db->order_by($sort_column, $sort_direction, FALSE);
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    //if($last_query) echo $this->db->last_query();  
    return (strtolower($result_type) === 'array') ? $query->row_array() : $query->row();
  }
  // End of get_record function
  public function get_records($table, $columns = '*', $where = NULL, $join = NULL, $sort_column = NULL, $sort_direction = 'ASC', $offset = NULL, $limit = NULL, $group_by = NULL, $result_type = 'object', $last_query = FALSE, $in_col=NULL ,$where_in = NULL)
  {  
    $this->db->select($columns, FALSE);
    
    $this->db->from($table);
    
    if ($where !== NULL)
    {
      (is_array($where)) ? $this->db->where($where, FALSE) : $this->db->where($where, NULL, FALSE);
    }
    
    if ($join !== NULL) 
    {
      foreach($join as $val) { $this->db->join($val['table'], $val['on'], $val['type']); }
    }
    
    if ($where_in !== NULL && $in_col !==NULL) $this->db->where_in($in_col, $where_in);
    
    if ($group_by !== NULL) $this->db->group_by($group_by);
    
    if ($sort_column !== NULL) $this->db->order_by($sort_column, $sort_direction, FALSE);
    
    if ( ! empty($limit)) $this->db->limit($limit, $offset);
    $query = $this->db->get();
     $str = $this->db->last_query();
    if($last_query) echo $this->db->last_query();
    
    return (strtolower($result_type) === 'array') ? $query->result_array() : $query->result();
  }
  // End of get_records function

  public function save_record($table, $data, $return_id = TRUE)
  {
    if( ! empty($data))
    {
      if ($this->db->insert($table, $data)) {
         // if {$return_id} is true, return last insert id, otherwise return true
        return ($return_id) ? $this->db->insert_id() : TRUE;
      }
      return FALSE;
    }
    return FALSE;
  }
  // End of save_record function
  public function update_batch($table, $data, $where_col)
  {
    if( !empty($data) && !empty($data) && !empty($data))
    {
      
      if ($query = $this->db->update_batch($table,$data,$where_col)) {
        return TRUE;
      }
      return FALSE;
    }
    return FALSE;
  }
  // End of update_record function
  public function update_record($table, $data, $where = NULL)
  {
    if( ! empty($data))
    {
      if ($where != NULL)
        $this->db->where($where);
      
      if ($this->db->update($table, $data)) {
        return TRUE;
      }
      return FALSE;
    }
    return FALSE;
  }
  // End of update_record function

  public function soft_delete($table, $pkey, $varray)
  {
    $this->db->where_in($pkey, $varray);
    
    if ($this->db->update($table, array('is_deleted' => 1))) {
      return TRUE;
    }
    return FALSE;
  }
  // End of delete_records function
  public function force_delete($table, $condn='')
  {
  	// $condn must be an associative array
  	$this->db->where($condn);		
  	$this->db->delete($table);	
  	return true;
  }
  public function get_select_list($table, $value, $label, $where, $join, $sort_column, $sort_direction = 'ASC')
  {
    $select_list = array();
    $result = $this->common_model->get_records($table, "{$value}, {$label}", $where, $join, $sort_column, $sort_direction);
    if( ! empty($result)) {
      foreach($result as $row) {
       $select_list[$row->$value] = $row->$label;
      }
    }
    return $select_list;
  } // End of get_select_list function
  public function get_select_list_sort($table, $value, $label, $where, $join, $sort_column, $sort_direction = 'ASC')
  {
    $select_list = array();
    $result = $this->common_model->get_records($table, "{$value}, {$label}", $where, $join, $sort_column, $sort_direction);
    if( ! empty($result)) {
      foreach($result as $row) {
       //$select_list[$row->$value] = $row->$label;
        $select_list[$row->$label] = $row->$value;
      }
    }
    return $select_list;
  } // End of get_select_list function
  
  public function validate_login($table, $where, $password)
  { 
    $this->db->select('*')->from($table)->where($where);
    
    $query  = $this->db->get();
    //echo $this->db->last_query();die;
    $result = $query->row();
    
    if ( empty($result))
    {
      return FALSE;
    }
    
    $rs = $this->hash->check_password($password, $result->password);
    return ($rs) ? $result : $rs;
  }
  // End of validate_login function
  public function save_record_multiple($table, $data)
  {
    if( ! empty($data))
    {
      if ($this->db->insert_batch($table, $data)) {
         
        return TRUE;
      }
      return FALSE;
    }
    return FALSE;
  }
  
}




// End of Common Model Class

/* End of file Common_model.php */
/* Location: ./application/models/Common_model.php */
