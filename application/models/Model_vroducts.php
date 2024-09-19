<?php 

class Model_vroducts extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	public function getVroductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM vroducts where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM vroducts ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveVroductData()
	{
		$sql = "SELECT * FROM vroducts WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('vroducts', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('vroducts', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('vroducts');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalvroducts()
	{
		$sql = "SELECT * FROM vroducts";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}