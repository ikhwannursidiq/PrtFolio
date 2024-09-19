<?php 

class Model_inputs extends CI_Model
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
    
    public function getActiveInputsData()
	{

        $sql = "SELECT * FROM `inputs` WHERE `date_time` <= ( SELECT `date_time` FROM `inputs` ORDER BY `date_time` DESC LIMIT 1 ) AND `date_time` >= (( SELECT `date_time` FROM `inputs` ORDER BY `date_time` DESC LIMIT 1 ) - INTERVAL 7 DAY)";	
  
    //  $sql = "SELECT * FROM `inputs` WHERE `date_time` <= ( SELECT `date_time` FROM `inputs` ORDER BY `date_time` DESC LIMIT 1 ) AND `date_time` >= (( SELECT `date_time` FROM `inputs` ORDER BY `date_time` DESC LIMIT 1 ) - INTERVAL 1 MONTH)";	
    //    $sql = "SELECT * FROM `inputs` WHERE `date_time` <= ( SELECT `date_time` FROM `inputs` ORDER BY `date_time` DESC LIMIT 1 ) AND `date_time` >= (( SELECT `date_time` FROM `inputs` ORDER BY `date_time` DESC LIMIT 1 ) - INTERVAL 2 MONTH)";
	
        //$sql = "SELECT * FROM inputs WHERE active = ?";
		// $query = $this->db->query($sql, array(0));
        $query = $this->db->query($sql);
		return $query->result_array();
	}

    public function getActiveInputsDataold()
	{
		// $sql = "SELECT * FROM inputs WHERE active = ?";
        $sql = "SELECT * FROM inputs ORDER BY id desc";
//		$query = $this->db->query($sql, array(0));
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

		$sql = "SELECT * FROM inputs ORDER BY id DESC";
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

	public function countTotalInputs()
	{
		$sql = "SELECT nama, COUNT(*) AS number_of_sales, SUM(goresan) AS ab, SUM(tidaknempel) AS NilaiQuantity, SUM(kebentur) AS NilaiDelivery, SUM(bintik) AS NilaiPrice, SUM(lukadalam) AS NilaiService FROM inputs GROUP BY nama;";

		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	
	
	private $_id;
    private $_nama;
    private $_ok;
    private $_ng;
    private $_total;
    

    public function setId($id) {
        $this->_id = $id;
    }
    public function setNama($nama) {
        $this->_nama = $nama;
    }
    public function setOk($ok) {
        $this->_ok = $ok;
    }    
    public function setNg($ng) {
        $this->_ng = $ng;
    }
    public function setTotal($total) {
        $this->_total = $total;
    }
    
	
	
	
	
	//display ng

	
	var $table = 'inputs';
    var $column_order = array(null,'e.tgl','e.waktu','e.shift','e.operatorname','e.nama','e.nolot');
    var $column_search = array('e.tgl','e.waktu','e.shift','e.operatorname','e.nama','e.nolot');
    var $order = array('id' => 'DESC');

    private function getQuery()
    {

        //add custom filter here
        if(!empty($this->input->post('tgl')))
        {
         $this->db->like('e.tgl', $this->input->post('tgl'), 'both');
		}
		if(!empty($this->input->post('waktu')))
        {
            $this->db->like('e.waktu', $this->input->post('waktu'), 'both');
        }
        if(!empty($this->input->post('shift')))
        {
            $this->db->like('e.shift', $this->input->post('shift'), 'both');
        }
        if(!empty($this->input->post('operatorname')))
        {
            $this->db->like('e.operatorname', $this->input->post('operatorname'), 'both');
        }
        if(!empty($this->input->post('nama')))
        {
            $this->db->like('e.nama', $this->input->post('nama'), 'both');
        }
		if(!empty($this->input->post('kode_material')))
        {
            $this->db->like('materials.kode_material', $this->input->post('kode_material'), 'both');
        }

       // $this->db->select(array('e.id','e.tgl','e.waktu','e.shift','e.operatorname','e.nama','e.nolot','e.ok','e.ng','e.total'));
        $this->db->select(array('materials.kode_material','bom.cmp_layer_satu','e.id','e.tgl','e.category','e.waktu','e.shift','e.operatorname','e.nama','e.nolot','e.ok','e.ng','e.total','e.goresan','e.tidaknempel','e.kebentur','e.saringanjebol','e.gelembung',
		'e.bintik','e.lukadalam','e.lukaluar', 'e.retak', 'e.bergaris', 'e.hosependek', 'e.oper', 'e.wrappingan', 'e.braidingan', 'e.bolong', 
       'e.tipis', 'e.karetnempel', 'e.tebal', 'e.porisiti', 'e.bekastangan', 'e.sobek', 'e.oval', 'e.benangrusak', 'e.siwak', 'e.keropos', 'e.holetube', 'e.springpendek', 'e.diameterkecil','e.seret', 'e.sempit',
       'e.diameterbesar', 'e.rp', 'e.shape', 'e.gap', 'e.gelombang', 'e.ringlonggar','e.ngmarking', 'e.ngassy', 'e.watermark', 'e.bertelur', 
       'e.others','e.note', 'e.history','e.nolotnew'));
        $this->db->from('inputs as e');
        $this->db->join ('bom','bom.partno = e.nama');
        $this->db->join ('materials','materials.id = bom.cmp_layer_satu');
      
     

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if(!empty($_POST['search']['value'])) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(!empty($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(!empty($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }



    public function getEmpData()
    {
        $this->getQuery();

        if(!empty($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        } else {
            $_POST['length']= $_POST['length'];
        }
        
        if(!empty($_POST['start']) && $_POST['start'] > 1) {
        $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        //print_r($_POST);die;
        $query = $this->db->get();
        return $query->result_array();
    }



    
    private function getInputsQuery()
    {

        //add custom filter here
        if(!empty($this->input->post('tgl')))
        {
         $this->db->like('e.tgl', $this->input->post('tgl'), 'both');
		}
		if(!empty($this->input->post('waktu')))
        {
            $this->db->like('e.waktu', $this->input->post('waktu'), 'both');
        }
        if(!empty($this->input->post('shift')))
        {
            $this->db->like('e.shift', $this->input->post('shift'), 'both');
        }
        if(!empty($this->input->post('operatorname')))
        {
            $this->db->like('e.operatorname', $this->input->post('operatorname'), 'both');
        }
        if(!empty($this->input->post('nama')))
        {
            $this->db->like('e.nama', $this->input->post('nama'), 'both');
        }
		

       // $this->db->select(array('e.id','e.tgl','e.waktu','e.shift','e.operatorname','e.nama','e.nolot','e.ok','e.ng','e.total'));
        $this->db->select(array('e.id','e.tgl','e.category','e.waktu','e.shift','e.operatorname','e.nama','e.nolot','e.ok','e.ng','e.total','e.goresan','e.tidaknempel','e.kebentur','e.saringanjebol','e.gelembung',
		'e.bintik','e.lukadalam','e.lukaluar', 'e.retak', 'e.bergaris', 'e.hosependek', 'e.oper', 'e.wrappingan', 'e.braidingan', 'e.bolong', 
       'e.tipis', 'e.karetnempel', 'e.tebal', 'e.porisiti', 'e.bekastangan', 'e.sobek', 'e.oval', 'e.benangrusak', 'e.siwak', 'e.keropos', 'e.holetube', 'e.springpendek', 'e.diameterkecil','e.seret', 'e.sempit',
       'e.diameterbesar', 'e.rp', 'e.shape', 'e.gap', 'e.gelombang', 'e.ringlonggar','e.ngmarking', 'e.ngassy', 'e.watermark', 'e.bertelur', 
       'e.others','e.note', 'e.history','e.nolotnew'));
        $this->db->from('inputs as e');
    
      
     

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if(!empty($_POST['search']['value'])) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(!empty($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(!empty($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getQueryInputData()
    {
        $this->getInputsQuery();

        if(!empty($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        } else {
            $_POST['length']= $_POST['length'];
        }
        
        if(!empty($_POST['start']) && $_POST['start'] > 1) {
        $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        //print_r($_POST);die;
        $query = $this->db->get();
        return $query->result_array();
    }



    public function countFiltered()
    {
        $this->getQuery();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countAll()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    // create new Employee
    public function createEmp() { 
        $data = array(
            'name' => $this->_firstName,
            'last_name' => $this->_lastName,
            'email' => $this->_email,
            'address' => $this->_address,
            'contact_no' => $this->_contactNo,
            'salary' => $this->_salary,
        );
        $this->db->insert('employees', $data);
        return $this->db->insert_id();
    }
    // update Employee
    public function updateEmp() { 
        $data = array(
            'name' => $this->_firstName,
            'last_name' => $this->_lastName,
            'email' => $this->_email,
            'address' => $this->_address,
            'contact_no' => $this->_contactNo,
            'salary' => $this->_salary,
        );
        $this->db->where('id', $this->_empID);
        $this->db->update('employees', $data);
    }
    // for display Employee
    public function getEmp() {        
        $this->db->select(array('e.id', 'e.nama', 'e.ok', 'e.ng', 'e.total'));
        $this->db->from('inputs e');  
        $this->db->where('e.id', $this->_id);     
        $query = $this->db->get();
       return $query->row_array();
    }

	








	
	
	
	

}