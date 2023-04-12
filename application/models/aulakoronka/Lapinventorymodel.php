<?php
class Lapinventorymodel extends CI_Model{
	 function __construct()
    {
        parent::__construct();
		$this->tabelinventory = "inventory";
		
    }
	function cekInventory($tglawal,$tglakhir)
	{
		$this->db->select('*');
		$this->db->from($this->tabelinventory);
		$this->db->where('purchasedate >=',$tglawal);
		$this->db->where('purchasedate <=',$tglakhir);
		$query = $this->db->get();
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
	function getLaporan($tglawal,$tglakhir)
	{
        $this->db->select('*');
        $this->db->from($this->tabelinventory);		
		$this->db->where('purchasedate >=',$tglawal);
		$this->db->where('purchasedate <=',$tglakhir);
		$this->db->order_by('inventoryid','asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
}
?>