<?php
class Categorymodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->tabel = "category";
    }
	
	
	function getData(){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->order_by('categoryid','asc');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
    }
    
    function getDataById($data){
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->where('categoryid', $data);
		$query = $this->db->get();
		$row = $query->result_array();
		//echo $this->db->last_query();
		return $row;
	}
}
?>
