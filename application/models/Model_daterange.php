<?php 

class Model_daterange extends CI_Model
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

  public function yearmonth($start_date, $end_date)
  {
	  
		  $data = [];
  
		  if (isset($start_date) && isset($end_date)) {
		//	$query = $this->db->query("SELECT nama, year(waktu),month(waktu),day(waktu),sum(ok) as dataoke, sum(ng) as datang, sum(total) as total from inputs where waktu BETWEEN '$start_date' and '$end_date' group by nama ORDER BY `day(waktu)` ASC");
			$query = $this->db->query("SELECT nama, category, sum(bfok) as dataoke, sum(bfng) as datang, sum(total) as total, date_time FROM inputs WHERE date_time BETWEEN '$start_date' and '$end_date' GROUP BY nama HAVING category ='Newitem' or category ='Regular' or category ='Repair' or category = '4M Change' or category = 'Return' or category ='Ganti No Lot' or category ='Before Assy' ORDER BY date_time");
		//	$query = $this->db->query("SELECT nama, category, sum(bfok) as dataoke, sum(bfng) as datang, sum(total) as total, date_time FROM inputs WHERE date_time BETWEEN '$start_date' and '$end_date' GROUP BY nama HAVING category ='Newitem' or category ='Regular'  or category = '4M Change' or category = 'Return' or category ='Ganti No Lot' ORDER BY date_time");
			
			
			return $query->result();
       }
  }

  public function bfyearmonth($start_date, $end_date)
  {
	  	  $data = [];
  
		  if (isset($start_date) && isset($end_date)) {
			//$query = $this->db->query("SELECT nama, category, sum(ok) as dataoke, sum(ng) as datang, sum(total) as total, date_time FROM inputs WHERE date_time BETWEEN '$start_date' and '$end_date' GROUP BY nama HAVING category ='Newitem' or category ='Regular' or category ='Repair' or category = '4M Change' or category = 'Return' or category ='Ganti No Lot' or category ='Before Assy' ORDER BY date_time");
			$query = $this->db->query("SELECT nama, count(nama) as namaCount, category, sum(ok) as dataoke, sum(ng) as datang, sum(total) as total, waktu FROM inputs WHERE waktu BETWEEN '$start_date' and '$end_date' GROUP BY nama HAVING category ='Newitem' or category ='Regular' or category= 'Before Assy' or category = '4M Change' or category = 'Return' or category ='Ganti No Lot' ORDER by waktu;");
		
			//	$query = $this->db->query("SELECT nama, category, sum(ok) as dataoke, sum(ng) as datang, sum(total) as total, date_time FROM inputs WHERE date_time BETWEEN '$start_date' and '$end_date' GROUP BY nama HAVING category ='Newitem' or category ='Regular'  or category = '4M Change' or category = 'Return' or category ='Ganti No Lot' ORDER BY date_time");
			return $query->result();
       }
  }








}