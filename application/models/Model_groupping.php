<?php 

class Model_groupping extends CI_Model
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

	


	public function getPemasukanPerRange()
    {
      //  $this->db       = db_connect();

        $mulai_tanggal  = @$_GET['mulai_tanggal'];
        $sampai_tanggal = @$_GET['sampai_tanggal'];

        $sql            = "SELECT * FROM inputs WHERE date_time BETWEEN '" . $mulai_tanggal . "' AND '" . $sampai_tanggal . "'";
        $query          = $this->db->query($sql);
       // $results        = $query->getResultArray();
		
		return $query->result_array();
       // return $results;
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
	
	public function filterbytanggal($tanggalawal, $tanggalakhir)
	{

		$query = $this->db->query("select*from 
		inputs where waktu BETWEN '$tanggalawal' 
		and '$tanggalakhir' order by waktu ASC");
		
		return $query->result();
		
	}

	public function filterbybulan($tahun1, $bulanawal, $bulanakhir)
	{

		$query = $this->db->query("select*from 
		inputs where YEAR(waktu)='$tahun1' and MONTH(waktu) 
		BETWEN '$bulanawal' and '$bulanakhir' order by waktu ASC");
		
		return $query->result();
		
	}

	public function filterbytahun($tahun2)
	{

		$query = $this->db->query("select*from 
		inputs where YEAR(waktu)='$tahun1' order by waktu ASC");
		
		return $query->result();
		
	}

public function gettahun()
{

	$query = $this->db->query("select YEAR(waktu) as tahun FROM
	inputs where waktu GROUP BY YEAR(waktu) order by YEAR (waktu) DESC");
	
	return $query->result();

}


	


// cara baru 

public function date_range($start_date, $end_date)
{
	
		$data = [];

        if (isset($start_date) && isset($end_date)) {
		$query = $this->db->query("SELECT * FROM inputs WHERE waktu BETWEEN '$start_date' and '$end_date' order by waktu asc");
       return $query->result();
	
	}
  }




public function date_rangedua($start_date, $end_date)
{

    $data = [];
    if (isset($start_date) && isset($end_date)){
    $query = $this->db->query("SELECT  nama, nolot, waktu, tgl, operatorname, shift, 
                               SUM(ok) as hasilok, SUM(ng) as hasilng, SUM(total) as hasiltotal
                               FROM inputs
                               WHERE waktu BETWEEN '$start_date' AND '$end_date' GROUP BY nolot"); 
    return $query->result();
}

}


}