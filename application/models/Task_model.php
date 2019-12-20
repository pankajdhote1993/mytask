<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->load->helper('url');
    }
	
	public function custom_query($query)
	{
		$query = $this->db->query($query);
		return $query->result_array();		
	}
	
	public function insert_data($table_name='',$data=array())
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();			
	}
	
	function delete_data($table='',$where=''){	
		
		$this->db->where($where);        
		$query = $this->db->delete($table);	
		return true;
	}
	
	public function update_data($data='',$table='',$where='')
	{
		$this->db->where($where);
		$this->db->update($table,$data);
		return 1;
	}
}
?>