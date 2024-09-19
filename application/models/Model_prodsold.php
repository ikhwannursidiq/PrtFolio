<?php 

class Model_prods extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProdData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM pfqs where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM pfqs ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveProdData()
	{
		$sql = "SELECT * FROM pfqs WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('pfqs', $data);
			return ($insert == true) ? true : false;
		}
		
	}

	public function create2($items)
	{
		if ($items) {
			$insert = $this->db->insert('pfqs_item', $items);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('pfqs', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('pfqs');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalPfqs()
	{
		$sql = "SELECT * FROM pfqs";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}