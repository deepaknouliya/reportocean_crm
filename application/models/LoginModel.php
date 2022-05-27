<?php
class LoginModel extends CI_Model{

	public function signin($username,$password){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('email',$username);
		$this->db->where('password', $password);
		$this->db->where('active', 1);
	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	    	$result=$query->result_array();
	    	return $result;
	    }
	    else{
	    	return false;
	    }
	}

}