<?php 

class Model_irds extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getIrdsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ird WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ird ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getIrdsItemData($rfq_id = null)
	{
		if(!$rfq_id) {
			return false;
		}

		$sql = "SELECT * FROM ird_item WHERE rfq_id = ?";
		$query = $this->db->query($sql, array($rfq_id));
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
			'deliverydate' => $this->input->post('deliverydate'),
			'pono' => $this->input->post('pono'),
			'fax' => $this->input->post('fax'),
			'attn' => $this->input->post('attn'),
			'duedate' => $this->input->post('duedate'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('rfqs', $data);
		$rfq_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'rfq_id' => $rfq_id,
    			'product' => $this->input->post('product')[$x],
				'partname' => $this->input->post('partname')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'unit' => $this->input->post('unit')[$x],
    			'note' => $this->input->post('note')[$x],
    		);

    		$this->db->insert('rfqs_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($rfq_id) ? $rfq_id : false;
	}

	public function countIrdsItem($rfq_id)
	{
		if($rfq_id) {
			$sql = "SELECT * FROM ird_item WHERE rfq_id = ?";
			$query = $this->db->query($sql, array($rfq_id));
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
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'deliverydate' => $this->input->post('deliverydate'),
				'pono' => $this->input->post('pono'),
				'fax' => $this->input->post('fax'),
				'attn' => $this->input->post('attn'),
				'duedate' => $this->input->post('duedate'),
	    		'gross_amount' => $this->input->post('gross_amount_value'),
	    		'service_charge_rate' => $this->input->post('service_charge_rate'),
	    		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    		'net_amount' => $this->input->post('net_amount_value'),
	    		'discount' => $this->input->post('discount'),
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('rfqs', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_rfq_item = $this->getRfqsItemData($id);
			foreach ($get_rfq_item as $k => $v) {
				$product = $v['product'];
				$partname = $v['partname'];
				$qty = $v['qty'];
				$unit = $v['unit'];
				$note = $v['note'];
				// get the product 
				//$product_data = $this->model_products->getProductData($product_id);
			//	$update_qty = $qty + $product_data['qty'];
			//	$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
				//$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('rfq_id', $id);
			$this->db->delete('rfqs_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'rfq_id' => $id,
	    			'product' => $this->input->post('product')[$x],
					'partname' => $this->input->post('partname')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'unit' => $this->input->post('unit')[$x],
	    			'note' => $this->input->post('note')[$x],
	    		);
	    		$this->db->insert('ird_item', $items);

	    		// now decrease the stock from the product
	    	//	$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    		// $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

	    	//	$update_product = array('qty' => $qty);
	    	//	$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	}



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('ird');

			$this->db->where('ird_id', $id);
			$delete_item = $this->db->delete('ird_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidIrds()
	{
		$sql = "SELECT * FROM ird WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}