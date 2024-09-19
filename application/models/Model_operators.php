<?php 

class Model_operators extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */
	public function getActiveOperator()
	{
		$sql = "SELECT * FROM operators WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getOperatorDataQc()
	{
		$sql = "SELECT * FROM operators WHERE bagian = '1' and jabatan = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(6));
		return $query->result_array();
	}
	public function getActiveOperatorData()
	{
		$sql = "SELECT * FROM operators WHERE active = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	public function getLeaderData()
	{
		$sql = "SELECT * FROM operators WHERE jabatan = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(5));
		return $query->result_array();
	}

	public function getOperatorData()
	{
		$sql = "SELECT * FROM operators WHERE jabatan = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(6));
		return $query->result_array();
	}

	/* get the brand data */
	public function getOperatorsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM operators where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM operators";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('operators', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('operators', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('operators');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalOperators()
	{
		$sql = "SELECT * FROM operators WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}