<?php 

class Model_qcreports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active brands information*/
	public function getItemsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM items WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM items ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}



	public function getActiveInputs()
	{
		$sql = "SELECT * FROM inputs WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getInputData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM inputs WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM inputs";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('inputs', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('inputs', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('inputs');
			return ($delete == true) ? true : false;
		}
	}



	public function getJoinItemWipSpi()
	{
		$sql ="SELECT P.name, P.stokin, Inv.InvProdSum as qtywip, Pur.PurProdSum as qtyspi FROM items P   LEFT JOIN (SELECT partno, SUM(Qty) AS InvProdSum
				  													   FROM wip_item  GROUP BY partno) AS Inv ON P.name = Inv.partno 
																	                  LEFT JOIN (SELECT partno, SUM(Qty) AS PurProdSum
																	   FROM spi_item  GROUP BY partno) AS Pur ON P.name = Pur.partno ORDER BY `qtywip` DESC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	
	
	

}