<?php 

class Model_balikan extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getBalikanData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM balikan WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM balikan ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getBalikanItemData($balikan_id = null)
	{
		if(!$balikan_id) {
			return false;
		}

		$sql = "SELECT * FROM balikan_item WHERE balikan_id = ?";
		$query = $this->db->query($sql, array($balikan_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'RETURN-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_name' => $this->input->post('customer_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'customer_phone' => $this->input->post('customer_phone'),
			'datereceived' => $this->input->post('datereceived'),
			'sj' => $this->input->post('sj'),
			'pono' => $this->input->post('pono'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'total_qty' => $this->input->post('total_qty_value'),
    	//	'service_charge_rate' => $this->input->post('service_charge_rate'),
    	//	'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    	//	'vat_charge_rate' => $this->input->post('vat_charge_rate'),
    	//	'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
    	//	'net_amount' => $this->input->post('net_amount_value'),
    		'operatorname' => $this->input->post('operatorname'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('balikan', $data);
		$balikan_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'balikan_id' => $balikan_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'name' => $this->input->post('name_value')[$x],
    		//	'amount' => $this->input->post('amount_value')[$x],
				'note' => $this->input->post('note')[$x],
    		);

    		$this->db->insert('balikan_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($balikan_id) ? $balikan_id : false;
	}

	public function countBalikanItem($balikan_id)
	{
		if($balikan_id) {
			$sql = "SELECT * FROM balikan_item WHERE balikan_id = ?";
			$query = $this->db->query($sql, array($balikan_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
				'customer_name' => $this->input->post('customer_name'),
	    		'customer_address' => $this->input->post('customer_address'),
	    		'customer_phone' => $this->input->post('customer_phone'),
	    		'total_qty' => $this->input->post('total_qty_value'),
	    	//	'service_charge_rate' => $this->input->post('service_charge_rate'),
	    	//	'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    	//	'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    	//	'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    	//	'net_amount' => $this->input->post('net_amount_value'),
	    	//	'discount' => $this->input->post('discount'),
				'sj' => $this->input->post('sj'),
				'pono' => $this->input->post('pono'),
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('balikan', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_balikan_item = $this->getBalikanItemData($id);
			foreach ($get_balikan_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['qty'];
				$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('balikan_id', $id);
			$this->db->delete('balikan_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'balikan_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
    			    'qty' => $this->input->post('qty')[$x],
    			    'name' => $this->input->post('name_value')[$x],
				    'note' => $this->input->post('note')[$x],
	    		);
	    		$this->db->insert('balikan_item', $items);

	    		// now decrease the stock from the product
	    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

	    		$update_product = array('qty' => $qty);
	    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	}



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('balikan');

			$this->db->where('balikan_id', $id);
			$delete_item = $this->db->delete('balikan_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidPoimport()
	{
		$sql = "SELECT * FROM balikan WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function getprov($searchTerm = "")
    {        
        $this->db->select('id_prov, nama');
        $this->db->where("nama like '%" . $searchTerm . "%' ");
        $this->db->order_by('id_prov', 'asc');
        $fetched_records = $this->db->get('provinsi');
        $dataprov = $fetched_records->result_array();
 
        $data = array();
        foreach ($dataprov as $prov) {
            $data[] = array("id" => $prov['id_prov'], "text" => $prov['nama']);
        }
        return $data;
    }

	function getkab($id_prov, $searchTerm = "")
    {        
        $this->db->select('id_kab, nama');
        $this->db->where('id_prov', $id_prov);
        $this->db->where("nama like '%" . $searchTerm . "%' ");    
        $this->db->order_by('id_kab', 'asc');
        $fetched_records = $this->db->get('kabupaten');
        $datakab = $fetched_records->result_array();
 
        $data = array();
        foreach ($datakab as $kab) {
            $data[] = array("id" => $kab['id_kab'], "text" => $kab['nama']);
        }
        return $data;
    }

	public function getActivekab($id_prov, $searchTerm = "")
	{
		$sql = "SELECT * FROM kabupaten WHERE id_prov = ? ORDER BY id_kab DESC";
		$query = $this->db->query($sql, array($id_prov));
		return $query->result_array();
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

function getcustomeritem($id, $searchTerm = "")
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

public function getActiveItemData($id, $searchTerm = "")
{
	$sql = "SELECT * FROM items WHERE customer_id = ? ORDER BY partname DESC";
	$query = $this->db->query($sql, array($id));
	return $query->result_array();
}














}