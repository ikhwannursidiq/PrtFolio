<?php 

class Model_material extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	/*public function getPinjam($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM pinjambuku where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM pinjambuku ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	} */

	public function getSubMaterialData()
	{
		$sql = "SELECT * FROM material WHERE category_id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(6));
		return $query->result_array();
	}


	public function getMaterialData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM material where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM material ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function buat_kode()   {

		$this->db->select('RIGHT(compound.nourut,2) as nourut', FALSE);
		$this->db->order_by('nourut','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('compound');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		 //jika kode ternyata sudah ada.      
		 $data = $query->row();      
		 $nourut = intval($data->nourut) + 1;    
		}
		else {      
		 //jika kode belum ada      
		 $nourut = 1;    
		}

		$kodemax = str_pad($nourut, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;  
  }

	public function getActiveMaterialData()
	{
		$sql = "SELECT * FROM material WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getActiveMaterialCompound()
	{
		$sql = "SELECT * FROM material WHERE category_id ='6' ORDER BY id DESC";
		$query = $this->db->query($sql );
		return $query->result_array();
	}
	
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('material', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('material', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('material');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalMaterial()
	{
		$sql = "SELECT * FROM material";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getMaterialDataSpi($product_id = null)
	{
		if($product_id) {
			$sql = "SELECT * FROM material where id = ?";
			$query = $this->db->query($sql, array($product_id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM material ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}