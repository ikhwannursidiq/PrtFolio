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

	public function getRowspanData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM pfqs_satu where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM pfqs_satu ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getRowspan2Data($id = null)
	{
		if(!$id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_inc WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function getProdItemData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_item WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdSatuData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_satu WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}


	public function getProdDuaData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_dua WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdTigaData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_tiga WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}
	public function getProdEmpatData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_empat WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}
	public function getProdLimaData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_lima WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}
	public function getProdEnamData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_enam WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}



	public function getProdIncData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_inc WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdCsData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_cs WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdHreData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_hre WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdAreData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_are WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdLtbeData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_ltbe WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdWtData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_wt WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}
	public function getProdOzirData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_ozir WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}

	public function getProdOirData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_oir WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
		return $query->result_array();
	}


	public function getProdQcData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM pfqs_qc WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
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

// start phisical add	


public function createsatu($satu)
	{
		if ($satu) {
			$insert = $this->db->insert('pfqs_satu', $satu);
			return ($insert == true) ? true : false;
		}
	}
	public function createdua($dua)
	{
		if ($dua) {
			$insert = $this->db->insert('pfqs_dua', $dua);
			return ($insert == true) ? true : false;
		}
	}

	
public function createtiga($tiga)
{
	if ($tiga) {
		$insert = $this->db->insert('pfqs_tiga', $tiga);
		return ($insert == true) ? true : false;
	}
}
public function createempat($empat)
{
	if ($empat) {
		$insert = $this->db->insert('pfqs_empat', $empat);
		return ($insert == true) ? true : false;
	}
}


public function createlima($lima)
	{
		if ($lima) {
			$insert = $this->db->insert('pfqs_lima', $lima);
			return ($insert == true) ? true : false;
		}
	}
	public function createenam($enam)
	{
		if ($enam) {
			$insert = $this->db->insert('pfqs_enam', $enam);
			return ($insert == true) ? true : false;
		}
	}

	public function createtujuh($tujuh)
	{
		if ($tujuh) {
			$insert = $this->db->insert('pfqs_tujuh', $tujuh);
			return ($insert == true) ? true : false;
		}
	}

	public function createdelapan($delapan)
	{
		if ($delapan) {
			$insert = $this->db->insert('pfqs_delapan', $delapan);
			return ($insert == true) ? true : false;
		}
	}

	public function createsembilan($sembilan)
	{
		if ($sembilan) {
			$insert = $this->db->insert('pfqs_sembilan', $sembilan);
			return ($insert == true) ? true : false;
		}
	}

	public function createsepuluh($sepuluh)
	{
		if ($sepuluh) {
			$insert = $this->db->insert('pfqs_sepuluh', $sepuluh);
			return ($insert == true) ? true : false;
		}
	}


















	public function create3($inc)
	{
		if ($inc) {
			$insert = $this->db->insert('pfqs_inc', $inc);
			return ($insert == true) ? true : false;
		}
	}


    public function createcs($cs)
	{
		if ($cs) {
			$insert = $this->db->insert('pfqs_cs', $cs);
			return ($insert == true) ? true : false;
		}
	}
	public function createhre($hre)
	{
		if ($hre) {
			$insert = $this->db->insert('pfqs_hre', $hre);
			return ($insert == true) ? true : false;
		}
	}

	public function createare($are)
	{
		if ($are) {
			$insert = $this->db->insert('pfqs_are', $are);
			return ($insert == true) ? true : false;
		}
	}

	public function createltbe($ltbe)
	{
		if ($ltbe) {
			$insert = $this->db->insert('pfqs_ltbe', $ltbe);
			return ($insert == true) ? true : false;
		}
	}
	public function createwt($wt)
	{
		if ($wt) {
			$insert = $this->db->insert('pfqs_wt', $wt);
			return ($insert == true) ? true : false;
		}
	}
	public function createozir($ozir)
	{
		if ($ozir) {
			$insert = $this->db->insert('pfqs_ozir', $ozir);
			return ($insert == true) ? true : false;
		}
	}
	public function createoir($oir)
	{
		if ($oir) {
			$insert = $this->db->insert('pfqs_oir', $oir);
			return ($insert == true) ? true : false;
		}
	}

// end physical

	public function createqc($qc)
	{
		if ($qc) {
			$insert = $this->db->insert('pfqs_qc', $qc);
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
	
	public function update2($items, $id)
	{
		if ($items && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('pfqs_item', $items);
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