<?php
class Lapeventmodel extends CI_Model{
	 function __construct()
    {
        parent::__construct();
        $this->tabelevent = "events";
        $this->tabelcategory = "category";
		
    }
	function cekEvent($tglawal,$tglakhir)
	{
		$this->db->select('*');
		$this->db->from($this->tabelevent);
		$this->db->where('date >=',$tglawal);
		$this->db->where('date <=',$tglakhir);
        $query = $this->db->get();
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
	function getLaporan($tglawal,$tglakhir)
	{
        $this->db->select('eventid,date,category,price');
        $this->db->from($this->tabelevent);
        $this->db->join($this->tabelcategory, $this->tabelcategory . '.categoryid = ' . $this->tabelevent . '.categoryid');		
		$this->db->where('date >=',$tglawal);
		$this->db->where('date <=',$tglakhir);
		$this->db->order_by('date','asc');
        $query = $this->db->get();
        //die($this->db->last_query());
		// $this->db->last_query();
		return $query->result_array();
	}
	
}
?>