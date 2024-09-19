<?php 

class Model_ssbs extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getSsbData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ssbs where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ssbs ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveSsbData()
	{
		$sql = "SELECT * FROM ssbs WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('ssbs', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('ssbs', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ssbs');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalSsbs()
	{
		$sql = "SELECT * FROM ssbs";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}