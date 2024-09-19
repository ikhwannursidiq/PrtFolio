<?php 

class Model_sopirs extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getSopirData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sopirs where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sopirs ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveSopirData()
	{
		$sql = "SELECT * FROM sopirs WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('sopirs', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('sopirs', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('sopirs');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalSopirs()
	{
		$sql = "SELECT * FROM sopirs";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}