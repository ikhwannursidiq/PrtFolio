<?php 

class Model_compound extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active brands information*/
	public function getActiveCompound()
	{
		$sql = "SELECT * FROM compound WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getCompoundData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM compound WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM compound ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('compound', $data);
			return ($insert == true) ? true : false;
		}
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
			$update = $this->db->update('compound', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('compound');
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


	public function getNcrData($ncr_id = null)
	{
		if($ncr_id) {
			$sql = "SELECT * FROM ncr where ncr_id = ?";
			$query = $this->db->query($sql, array($ncr_id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ncr ORDER BY ncr_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
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