<?php 

class Model_fincoming extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function getLot()

	{
		
		$sql = "select datecreated, partno,qty,nolot, SUBSTRING_INDEX(nolot, ',', 1) AS 'kodea', 
				CASE WHEN LOCATE(',', nolot, 1) = 0 THEN 0 ELSE SUBSTRING_INDEX(SUBSTRING_INDEX(nolot, ',', 2), ',', -1) END AS 'kodeb', 
				CASE WHEN LOCATE(',', nolot, (LOCATE(',', nolot, 1) + 1)) = 0 THEN 0 ELSE SUBSTRING_INDEX(nolot, ',', -1) END AS 'kodec', 
				qty as 'qty' from ( SELECT b.datecreated, a.partno, group_concat(a.nolot) as nolot, sum(a.qty) as qty 
				from incoming_item a inner join incoming b on b.id = a.incoming_id group by a.partno ) as s;";
		$query = $this->db->query($sql);
		return $query->result_array();
	
	
	}

    // get the stok item data detail data
    public function getFincomingStock($id = null)
    {
        if($id) {
        $sql = "SELECT * FROM inputs WHERE id = ?";
        //$sql ="SELECT nama, nolot, waktu, tgl, operatorname, shift, SUM(ok) as hasilok, SUM(ng) as hasilng, SUM(total) as hasiltotal FROM inputs INNER JOIN items ON items.id=inputs.partname GROUP BY nolot ";
        $query = $this->db->query($sql, array($id));
	    return $query->row_array();
     }

        //	$sql = "SELECT *,SUM(ok) as okall, SUM(total) as totalall FROM inputs INNER JOIN items ON items.id=inputs.partname GROUP BY nolot ";
        //	$sql = "SELECT nama, nolot, waktu, tgl, operatorname, shift, SUM(ok) as hasilok, SUM(ng) as hasilng, SUM(total) as hasiltotal FROM inputs INNER JOIN items ON items.id=inputs.partname GROUP BY nolot ";
        // sql menampilkan stok lebih dari 0
        // $sql ="SELECT * from items Inner join inputs on items.id=inputs.partname where items.stokout > '0'  ";
        // $sql ="SELECT * from items  where stokout > '0'  ";
	    $sql ="SELECT ts.id,ts.name,group_concat(ti.nolot order by ti.id limit 5 ) lots, sum(ts.stokout) qty, tgl, operatorname, customer_id, stokout
			 from items ts 
			 join inputs ti on ti.nama = ts.name where ts.stokout >'0' group by ts.id,ts.name  ";
        // $sql ="with cte as( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join inputs ti on ti.nama = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* , ts.stokout from cte1 join items ts on ts.id = cte1.id";
	    $query = $this->db->query($sql);
        return $query->result_array();
     }


	 public function dataexportppic($start_date, $end_date)
	 {
		 
			 $data = [];
	 
			 if (isset($start_date) && isset($end_date)) {
			 $query = $this->db->query("SELECT ts.customer_name,ts.datecreated,ts.dtw, ti.partno, ti.nolot, SUM(ti.qty) qty from incoming ts join incoming_item ti on ti.incoming_id = ts.id WHERE datecreated BETWEEN '$start_date' and '$end_date' group by ti.partno ORDER BY ts.datecreated asc;");
			// $query = $this->db->query("SELECT ts.customer_name,ts.datecreated,ts.dtw, ti.partno, ti.nolot, SUM(ti.qty) qty from incoming ts join incoming_item ti on ti.incoming_id = ts.id WHERE datecreated BETWEEN '$start_date' and '$end_date' group by ti.partno ORDER BY ts.datecreated asc;");
 
	 //	$query = $this->db->query("with cte as( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join inputs ti on ti.nama = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* , ts.stokout from cte1 join items ts on ts.id = cte1.id");
	   
	 //	$query = $this->db->query("with cte as ( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join incoming_item ti on ti.partno = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* from cte1 join items ts on ts.id = cte1.id;");
		 //	$query = $this->db->query(" SELECT incoming.customer_name as customer, incoming.customer_address as alamat, incoming.dtw as dtw, incoming.gross_amount as totalqty, incoming.datecreated as datecreated, 
		 //	                             incoming_item.incoming_id as incoming, incoming_item.partno as part, incoming_item.nolot as lot, incoming_item.totalcheck as totalcheck, incoming_item.qty as qty, incoming_item.operatorname as operatorname
		 //	                            FROM incoming left JOIN incoming_item 
		 //	                            ON incoming.id=incoming_item.incoming_id 
		 //	                            WHERE datecreated BETWEEN '$start_date' and '$end_date' ORDER BY incoming.datecreated asc");
			return $query->result();
		 
		 }
	   }

	/* get the orders data */
	public function getFincomingData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM incoming WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM incoming ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
    // get the orders item data detail data
    public function getFincomingDetailData($id = null)
   {
	if($id) {
		$sql = "SELECT * FROM incoming WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	$sql = "SELECT * FROM incoming_item INNER JOIN incoming ON incoming.id=incoming_item.incoming_id ORDER BY dtw DESC";
	$query = $this->db->query($sql);
	return $query->result_array();
   }




	// get the orders item data
	public function getFincomingItemData($incoming_id = null)
	{
		if(!$incoming_id) {
			return false;
		}

		$sql = "SELECT * FROM incoming_item WHERE incoming_id = ?";
		$query = $this->db->query($sql, array($incoming_id));
		return $query->result_array();
	}



	public function date_range($start_date, $end_date)
	{
		
			$data = [];
	
			if (isset($start_date) && isset($end_date)) {
		//	$query = $this->db->query("SELECT * FROM incoming  WHERE datecreated BETWEEN '$start_date' and '$end_date' order by datecreated asc");
		    
			//$query = $this->db->query(" SELECT incoming.customer_name as customer, incoming.customer_address as alamat, incoming.dtw as dtw, incoming.gross_amount as totalqty, incoming.datecreated as datecreated, 
			 //                            incoming_item.incoming_id as incoming, incoming_item.partno as part, incoming_item.nolot as lot, incoming_item.totalcheck as totalcheck, incoming_item.qty as qty, incoming_item.operatorname as operatorname
			  //                          FROM incoming left JOIN incoming_item 
			  //                          ON incoming.id=incoming_item.incoming_id 
			   //                         WHERE datecreated BETWEEN '$start_date' and '$end_date' ORDER BY incoming.datecreated asc");
		   
		   $query = $this->db->query("SELECT incoming.customer_name as customer, incoming.customer_address as alamat, incoming.dtw as dtw, incoming.gross_amount as totalqty, incoming.datecreated as datecreated, incoming_item.incoming_id as incoming, incoming_item.partno as part, incoming_item.nolot as lot, incoming_item.totalcheck as totalcheck, incoming_item.qty as qty, 	incoming_item.operatorname as operatorname, inputs.nolotnew as nolotnew, inputs.nolot as nolotold 
		   FROM incoming 
		   LEFT JOIN incoming_item 
		   ON incoming.id=incoming_item.incoming_id 
		   LEFT JOIN inputs ON incoming_item.product_id=inputs.id 
		   WHERE datecreated BETWEEN '$start_date' and '$end_date' 
		   ORDER BY incoming.datecreated asc");
		 
		 
		 
		 
		   return $query->result();
		
		}
	  }


	

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_name' => $this->input->post('customer_name'),
    	//	'customer_address' => $this->input->post('customer_address'),
    		'dtw' => $this->input->post('dtw'), //mau dikirim ke gudang kapan
			'pic' => $this->input->post('pic'),
			'nopol' => $this->input->post('nopol'), 
			'kenek' => $this->input->post('kenek'), 
			'sopir' => $this->input->post('sopir'), 
			'box' => $this->input->post('box'),
			'rit' => $this->input->post('rit'),   //mau dikirim ke gudang kapan
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		//'gross_amount' => $this->input->post('total_qty_value'),
			'gross_amount' => $this->input->post('total_qty'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('incoming', $data);
		$incoming_id = $this->db->insert_id();

		$this->load->model('model_inputs');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'incoming_id' => $incoming_id,
    			'product_id' => $this->input->post('product')[$x],
				'partno' => $this->input->post('partno_value')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'nolot' => $this->input->post('nolot_value')[$x],
				//'nolotnew' => $this->input->post('nolot')[$x],
    			'totalcheck' => $this->input->post('totalcheck_value')[$x],
				'operatorname' => $this->input->post('operatorname_value')[$x],
    		);

    		$this->db->insert('incoming_item', $items);

    		// now decrease the stock from the product
    	//	$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    	//	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    	//	$update_product = array('qty' => $qty);


    	//	$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($incoming_id) ? $incoming_id : false;
	}

	public function countOrderItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM orders_item WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
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
				'dtw' => $this->input->post('dtw'), //mau dikirim ke gudang kapan
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'gross_amount' => $this->input->post('total_qty_value'),
				'pic' => $this->input->post('pic'), //mau dikirim ke gudang kapan
    	
				'user_id' => $user_id,
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('incoming', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
		//	$this->load->model('model_inputs');
		//	$get_incoming_item = $this->getFincomingItemData($id);
		//	foreach ($get_incoming_item as $k => $v) {
		//		$product_id = $v['product_id'];
		//		$qty = $v['qty'];
		//		// get the product 
		//		$product_data = $this->model_products->getProductData($product_id);
		//		$update_qty = $qty + $product_data['qty'];
		//		$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
		//		$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('incoming_id', $id);
			$this->db->delete('incoming_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
				'incoming_id' => $id,
    			'product_id' => $this->input->post('product')[$x],
				'partno' => $this->input->post('partno_value')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'nolot' => $this->input->post('nolot_value')[$x],
    			'totalcheck' => $this->input->post('totalcheck_value')[$x],
				'operatorname' => $this->input->post('operatorname_value')[$x],
	    			
	    		);
	    		$this->db->insert('incoming_item', $items);

	    		// now decrease the stock from the product
	    	//	$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    	//	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];
//
	    	//	$update_product = array('qty' => $qty);
	    	//	$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	



		public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('incoming');

			$this->db->where('incoming_id', $id);
			$delete_item = $this->db->delete('incoming_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}