<?php
class Customermodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->tabel = "customer";
    }
	
	
	function getData(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->order_by('name','asc');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
    }
    
    function getDataById($data){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->where('customerid', $data);
		$query = $this->db->get();
		$row = $query->result_array();
		//echo $this->db->last_query();
		return $row;
	}
}
?>