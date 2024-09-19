<?php 

class Model_repair extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getSolokalData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM solokal WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM solokal ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
// get the orders item data detail data
	public function getSolokaldetailData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM solokal WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM solokal_item INNER JOIN solokal ON solokal.id=solokal_item.solokal_id ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getRepairData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM inputs where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM inputs ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	

	public function getData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM repair where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM repair ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	

	// get the orders item data
	public function getSolokalItemData($solokal_id = null)
	{
		if(!$solokal_id) {
			return false;
		}

		$sql = "SELECT * FROM solokal_item WHERE solokal_id = ?";
		$query = $this->db->query($sql, array($solokal_id));
		return $query->result_array();
	}

	public function getSolokalItem($solokal_id = null)
	{
		if(!$solokal_id) {
			return false;
		}

		$sql = "SELECT * FROM solokal_item WHERE solokal_id = ?";
		$query = $this->db->query($sql, array($solokal_id));
		return $query->result_array();
	}

	public function buat_kode()   {

		$this->db->select('RIGHT(solokal.sj,2) as sj', FALSE);
		$this->db->order_by('sj','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('solokal');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		 //jika kode ternyata sudah ada.      
		 $data = $query->row();      
		 $sj = intval($data->sj) + 1;    
		}
		else {      
		 //jika kode belum ada      
		 $sj = 1;    
		}

		$kodemax = str_pad($sj, 4, "14", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;  
  }



	public function countSolokalItem($solokal_id)
	{
		if($solokal_id) {
			$sql = "SELECT * FROM solokal_item WHERE solokal_id = ?";
			$query = $this->db->query($sql, array($solokal_id));
			return $query->num_rows();
		}
	}

	public function exportexcell($start_date, $end_date)
	{
		
			$data = [];
	
			if (isset($start_date) && isset($end_date)) {
			//$query = $this->db->query("SELECT * FROM repair WHERE date BETWEEN '$start_date' and '$end_date' order by date asc");
		   
			$query = $this->db->query("SELECT  repair.date as date, repair.partno as partno, repair.nolot as nolot, repair.inputok as inputok, repair.ng as ng, 
				repair.dateng as dateng,
				repair.qtyng as qtyng,
				repair.qtyok as qtyok,
				repair.note as note,

				repair.goresan as goresan,
				repair.tidaknempel as tidaknempel,
				repair.kebentur as kebentur,
				repair.saringanjebol as saringanjebol,
				repair.gelembung as gelembung,
				repair.bintik as bintik,
				repair.lukadalam as lukadalam,
				repair.lukaluar as lukaluar,
				repair.retak as retak,
				 repair.bergaris  as bergaris,
				 repair.hosependek as hosependek,
				 repair.oper as oper, 
				 repair.wrappingan as wrappingan, 
				 repair.braidingan as braidingan, 
				 repair.bolong as bolong, 
				 repair.tipis as tipis, 
				 repair.karetnempel as karetnempel, 
				 repair.tebal as tebal, 
				 repair.porisiti as porisiti, 
				 repair.bekastangan as bekastangan, 
				 repair.sobek as sobek, 
				 repair.oval as oval, 
				 repair.benangrusak as benangrusak, 
				 repair.siwak as siwak, 
				 repair.keropos as keropos, 
				 repair.holetube as holetube, 
				 repair.seret as seret, 
				 repair.sempit as sempit, 
				 repair.springpendek as springpendek, 
				 repair.diameterkecil as diameterkecil, 
				 repair.others as others,
				 repair.rp as rp,
				 repair.shape as shape,
				 repair.gap as gap,
				 repair.gelombang as gelombang,
				 repair.diameterbesar as diameterbesar,
				 repair.ringlonggar as ringlonggar,
				 repair.ngmarking as ngmarking,
				 repair.ngassy as ngassy,
				 repair.watermark as watermark,
				 repair.bertelur as bertelur,
			 	inputs.waktu as waktu
			FROM repair 
			LEFT JOIN inputs 
			ON repair.part_id=inputs.id 
			WHERE repair.date BETWEEN '$start_date' and '$end_date' 
			ORDER BY repair.date asc");
			
			return $query->result();
		
		}
	  }
	

	public function create($data)
	{
		if($data){
		$insert = $this->db->insert('repair',$data);
		return ($insert == true ) ? true : false;
		}

	}


	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('repair');

		//	$this->db->where('solokal_id', $id);
		//	$delete_item = $this->db->delete('solokal_item');
			return ($delete == true ) ? true : false;
		}
	}

	public function countTotalPaidPolokal()
	{
		$sql = "SELECT * FROM polokal WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}


//select berantaiiiiiiiiiiiiii


public function getcust($searchTerm = "")
{        
	$this->db->select('id, name');
	$this->db->where("name like '%" . $searchTerm . "%' ");
	$this->db->order_by('id', 'asc');
	$fetched_records = $this->db->get('konsumens');
	$dataprov = $fetched_records->result_array();

	$data = array();
	foreach ($dataprov as $prov) {
		$data[] = array("id" => $prov['id'], "text" => $prov['name']);
	}
	return $data;
}

function getpocustomeritem($id, $searchTerm = "")
{        
	$this->db->select('id, name');
	$this->db->where('customer_id', $id);
	$this->db->where("name like '%" . $searchTerm . "%' ");    
	$this->db->order_by('id', 'asc');
	$fetched_records = $this->db->get('items');
	$datakab = $fetched_records->result_array();

	$data = array();
	foreach ($datakab as $kab) {
		$data[] = array("id" => $kab['id'], "text" => $kab['name']);
	}
	return $data;
}


function jointable($id, $searchTerm = ""){
	$this->db->select('*');
	$this->db->from('polokal');
	$this->db->join('polokal_item','polokal_item.polokal_id = polokal.id');   
	$this->db->where('customer_id', $id);
	$this->db->where("name like '%" . $searchTerm . "%' ");    
	$this->db->order_by('pono', 'asc');
	$fetched_records = $this->db->get();
	$datakab = $fetched_records->result_array();

	$data = array();
	foreach ($datakab as $kab) {
		$data[] = array("id" => $kab['id'], "text" => $kab['name']);
	}
	return $data;
 }


public function getActiveItemDataPO ($id, $searchTerm = "")
{
	//$sql = "SELECT * FROM items WHERE customer_id = ? ORDER BY partname DESC";
	// $sql= "SELECT * FROM `polokal` JOIN `polokal_item` where customer_id = ? order by pono desc";
	$sql="SELECT a.*, b.* FROM polokal a join polokal_item b on a.id=b.polokal_id where customer_id=? order by customer_name desc";
	$query = $this->db->query($sql, array($id));
	return $query->result_array();
}


public function getActiveRepairData ()
{
	
    $sql="SELECT nama, ng , tgl, waktu from inputs where waktu BETWEEN '2022-11-16' and '2022-12-14' and bfng > 0 ORDER BY waktu ASC";

	$query = $this->db->query($sql);
	return $query->result_array();
}


public function getDatainputsng()
{


//	 $sql = " SELECT * FROM inputs WHERE waktu BETWEEN '$from' AND '$to'  having NG > 0 ORDER BY waktu DESC";
	$sql="SELECT * FROM inputs WHERE waktu BETWEEN '2023-03-16' AND '2023-12-31' having bfng > 0 ORDER BY waktu ASC";
//    $sql = "SELECT * FROM `inputs` WHERE waktu BETWEEN DAY(waktu)=DAY(CURDATE())-15 and month(waktu)=month(CURDATE()) ORDER BY waktu ASC";
	
	$query = $this->db->query($sql);
	return $query->result_array();
}



}