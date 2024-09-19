<?php 

class Model_poumum extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getPoumumData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM poumum WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM poumum ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getPoumumItemData($poumum_id = null)
	{
		if(!$poumum_id) {
			return false;
		}

		$sql = "SELECT * FROM Poumum_item WHERE poumum_id = ?";
		$query = $this->db->query($sql, array($poumum_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_name' => $this->input->post('customer_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'customer_phone' => $this->input->post('customer_phone'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'service_charge_rate' => $this->input->post('service_charge_rate'),
    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
    		'net_amount' => $this->input->post('net_amount_value'),
    		'discount' => $this->input->post('discount'),
			'deliverydate' => $this->input->post('deliverydate'),
			'pono' => $this->input->post('pono'),
			'fax' => $this->input->post('fax'),
			'attn' => $this->input->post('attn'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('poumum', $data);
		$poumum_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'poumum_id' => $poumum_id,
    			'product_id' => $this->input->post('product')[$x],
				'name' => $this->input->post('name_value')[$x],
    			'qty' => $this->input->post('qty')[$x],
				'unit' => $this->input->post('unit_value')[$x],
    			'rate' => $this->input->post('rate_value')[$x],
    			'amount' => $this->input->post('amount_value')[$x],
				'note' => $this->input->post('note')[$x],
    		);

    		$this->db->insert('poumum_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($poumum_id) ? $poumum_id : false;
	}

	public function countPoumumItem($poumum_id)
	{
		if($poumum_id) {
			$sql = "SELECT * FROM poumum_item WHERE poumum_id = ?";
			$query = $this->db->query($sql, array($poumum_id));
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
	    		'gross_amount' => $this->input->post('gross_amount_value'),
	    		'service_charge_rate' => $this->input->post('service_charge_rate'),
	    		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    		'net_amount' => $this->input->post('net_amount_value'),
	    		'discount' => $this->input->post('discount'),
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id,
				'deliverydate' => $this->input->post('deliverydate'),
				'pono' => $this->input->post('pono'),
				'fax' => $this->input->post('fax'),
				'attn' => $this->input->post('attn'),
				'date_closed' => date('D-M-Y H:i:s'),
	    	
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('poumum', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_poumum_item = $this->getPoumumItemData($id);
			foreach ($get_poumum_item as $k => $v) {
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
			$this->db->where('poumum_id', $id);
			$this->db->delete('poumum_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'poumum_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
					'name' => $this->input->post('name_value')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'rate' => $this->input->post('rate_value')[$x],
					'unit' => $this->input->post('unit_value')[$x],
	    			'amount' => $this->input->post('amount_value')[$x],
					'note' => $this->input->post('note')[$x],
	    		);
	    		$this->db->insert('poumum_item', $items);

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
			$delete = $this->db->delete('poumum');

			$this->db->where('poumum_id', $id);
			$delete_item = $this->db->delete('poumum_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidPoumum()
	{
		$sql = "SELECT * FROM poumum WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}