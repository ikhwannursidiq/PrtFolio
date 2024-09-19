<?php 

class Model_konsumens extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getKonsumenData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM konsumens where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM konsumens ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveKonsumenData()
	{
		$sql = "SELECT * FROM konsumens WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('konsumens', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('konsumens', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('konsumens');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalKonsumens()
	{
		$sql = "SELECT * FROM sopirs";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


	public function buat_kode()   {

		$this->db->select('RIGHT(konsumens.kode,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('konsumens');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		 //jika kode ternyata sudah ada.      
		 $data = $query->row();      
		 $kode = intval($data->kode) + 1;    
		}
		else {      
		 //jika kode belum ada      
		 $kode = 1;    
		}

		$kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "CL".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;  
  }


}