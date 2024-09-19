<?php 

class Model_spss extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the spss data */
	public function getSpssData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM spss WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM spss ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the spss item data
	public function getSpssItemData($sps_id = null)
	{
		if(!$sps_id) {
			return false;
		}

		$sql = "SELECT * FROM spss_item WHERE sps_id = ?";
		$query = $this->db->query($sql, array($sps_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'supplier_name' => $this->input->post('supplier_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'customer_phone' => $this->input->post('customer_phone'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    	
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('spss', $data);
		$sps_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'sps_id' => $sps_id,
    			'product_id' => $this->input->post('product')[$x],
                'jumlahbarang' => $this->input->post('jumlahbarang')[$x],//input product id
                'diskripsi' => $this->input->post('diskripsi')[$x],//input product id


    		
    		);

    		$this->db->insert('spss_item', $items);

    		// now decrease the stock from the product
    		//$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    	//	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    	//	$update_product = array('qty' => $qty);


    	//	$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($sps_id) ? $sps_id : false;
	}

	public function countSpsItem($sps_id)
	{
		if($sps_id) {
			$sql = "SELECT * FROM spss_item WHERE sps_id = ?";
			$query = $this->db->query($sql, array($sps_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
				'supplier_name' => $this->input->post('supplier_name'),
	    		'customer_address' => $this->input->post('customer_address'),
	    		'customer_phone' => $this->input->post('customer_phone'),
	    		
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('spss', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_sps_item = $this->getSpssItemData($id);
			foreach ($get_sps_item as $k => $v) {
				$product_id = $v['product_id'];
			//	$qty = $v['qty'];
				// get the product 
			//	$product_data = $this->model_products->getProductData($product_id);
			//	$update_qty = $qty + $product_data['qty'];
			//	$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
				//$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('sps_id', $id);
			$this->db->delete('spss_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'sps_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],//input product id
                    'jumlahbarang' => $this->input->post('jumlahbarang')[$x],//input product id
                    'diskripsi' => $this->input->post('diskripsi')[$x],//input product id





	    		
	    		);
	    		$this->db->insert('spss_item', $items);

	    		// now decrease the stock from the product
	    	//	$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    	//	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

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
			$delete = $this->db->delete('spss');

			$this->db->where('sps_id', $id);
			$delete_item = $this->db->delete('spss_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidSpss()
	{
		$sql = "SELECT * FROM spss WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}