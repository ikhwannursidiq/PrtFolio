<?php 

class Model_items extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function date_range($start_date, $end_date)
	{
		
			$data = [];
	
			if (isset($start_date) && isset($end_date)) {
			//$query = $this->db->query("SELECT name as name, partname as partname, description as description, harga as harga, stokin as stokin , stokout as stokout, unit FROM items  WHERE dateitems BETWEEN '$start_date' and '$end_date' order by dateitems asc");
		    $query=$this->db->query("SELECT items.name as name, items.partname as partname, items.description as description, items.price as harga, items.stokin as stokin , items.stokout as stokout, items.unit as unit, konsumens.name as customer FROM items join konsumens on konsumens.id=items.customer_id WHERE items.dateitems BETWEEN '$start_date' and '$end_date' order by items.dateitems asc");
		    return $query->result();
		
		}
	  }


	public function getItemData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM items where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM items ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getActiveItemData()
	{
		$sql = "SELECT * FROM items WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('items', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('items', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('items');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalItems()
	{
		$sql = "SELECT * FROM items";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}