<?php 

class Model_submaterial extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active brands information*/
	public function getActiveSubmaterial()
	{
		$sql = "SELECT * FROM submaterial WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

    function tampil_data(){
		return $this->db->get('submaterial');
	}

	/* get the brand data */
	public function getSubmaterialData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM submaterial WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM submaterial ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('submaterial', $data);
			return ($insert == true) ? true : false;
		}
	}

	
	public function buat_kode()   {

		$this->db->select('RIGHT(submaterial.nourut,2) as nourut', FALSE);
		$this->db->order_by('nourut','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('submaterial');      //cek dulu apakah ada sudah ada kode di tabel.    
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
    public function createncr($data)
	{
		if($data) {
			$insert = $this->db->insert('ncr', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('submaterial', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('submaterial');
			return ($delete == true) ? true : false;
		}
	}

	public function getSupData($searchTerm = "")
    {        
        $this->db->select('id, name');
        $this->db->where("name like '%" . $searchTerm . "%' ");
        $this->db->order_by('id', 'asc');
        $fetched_records = $this->db->get('supplier');
        $dataprov = $fetched_records->result_array();
 
        $data = array();
        foreach ($dataprov as $prov) {
            $data[] = array("id" => $prov['id'], "text" => $prov['name']);
        }
        return $data;
    }

	function getSupCategory($id, $searchTerm = "")
    {        
        $this->db->select('id, name');
        $this->db->where('supplier_id', $id);
        $this->db->where("name like '%" . $searchTerm . "%' ");    
        $this->db->order_by('id', 'asc');
        $fetched_records = $this->db->get('material');
        $datakab = $fetched_records->result_array();
 
        $data = array();
        foreach ($datakab as $kab) {
            $data[] = array("id" => $kab['id'], "text" => $kab['name']);
        }
        return $data;
    }

	function getCategory($id, $searchTerm = "")
    {  
		$this->db->select('*');
        $this->db->from('material');
        $this->db->join('categories', 'categories.id = material.category_id');
		$this->db->where('supplier_id', $id);
        $this->db->where("matname like '%" . $searchTerm . "%' ");    
        $this->db->order_by('matno', 'asc');
       //  $this->db->select('id, matname, category_id');
       //  $this->db->where('supplier_id', $id);
       //  $this->db->where("matname like '%" . $searchTerm . "%' ");    
       //   $this->db->order_by('id', 'asc');
       // $fetched_records = $this->db->get('material');
		$fetched_records = $this->db->get();
        $datakab = $fetched_records->result_array();
 
        $data = array();
        foreach ($datakab as $kab) {
            $data[] = array("id" => $kab['id'], "text" => $kab['name'] );
        }
        return $data;
    }

	function getMaterial($id, $searchTerm = "")
    {        
        $this->db->select('id, matname');
        $this->db->where('supplier_id', $id);
        $this->db->where("matname like '%" . $searchTerm . "%' ");    
        $this->db->order_by('id', 'asc');
        $fetched_records = $this->db->get('material');
        $datakab = $fetched_records->result_array();
 
        $data = array();
        foreach ($datakab as $kab) {
            $data[] = array("id" => $kab['id'], "text" => $kab['matname']);
        }
        return $data;
    }


}