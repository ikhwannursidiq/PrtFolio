<?php 

class Model_barangmasuk extends CI_Model
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
public function getBarangmasukDetailData($id = null)
   {
	if($id) {
		$sql = "SELECT * FROM barangmasuk WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	$sql = "SELECT * FROM barangmasuk_item INNER JOIN barangmasuk ON barangmasuk.id=barangmasuk_item.barangmasuk_id ";
	$query = $this->db->query($sql);
	return $query->result_array();
   }


   // get the orders item data detail data
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
		    
			$query = $this->db->query(" SELECT incoming.customer_name as customer, incoming.customer_address as alamat, incoming.dtw as dtw, incoming.gross_amount as totalqty, incoming.datecreated as datecreated, 
			                             incoming_item.incoming_id as incoming, incoming_item.partno as part, incoming_item.nolot as lot, incoming_item.totalcheck as totalcheck, incoming_item.qty as qty, incoming_item.operatorname as operatorname
			                            FROM incoming left JOIN incoming_item 
			                            ON incoming.id=incoming_item.incoming_id 
			                            WHERE datecreated BETWEEN '$start_date' and '$end_date' ORDER BY incoming.datecreated asc");
		   return $query->result();
		
		}
	  }

	  public function dataexportppic($start_date, $end_date)
	{
		
			$data = [];
	
			if (isset($start_date) && isset($end_date)) {
			$query = $this->db->query("SELECT ts.customer_name,ts.datecreated,ti.partno, ti.nolot, SUM(ti.qty) qty from incoming ts join incoming_item ti on ti.incoming_id = ts.id WHERE datecreated BETWEEN '$start_date' and '$end_date' group by ti.partno ORDER BY ts.datecreated asc;");

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

	  public function dataexportppicdua($start_date, $end_date)
	  {
		  
			  $data = [];
	  
			  if (isset($start_date) && isset($end_date)) {
		//	  $query = $this->db->query("SELECT ts.customer_name,ts.datecreated,ti.partno, ti.nolot, SUM(ti.qty) qty from incoming ts join incoming_item ti on ti.incoming_id = ts.id WHERE datecreated BETWEEN '$start_date' and '$end_date' group by ti.partno ORDER BY ts.datecreated asc;");
  
	  //	$query = $this->db->query("with cte as( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join inputs ti on ti.nama = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* , ts.stokout from cte1 join items ts on ts.id = cte1.id");
		
	  //	$query = $this->db->query("with cte as ( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join incoming_item ti on ti.partno = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* from cte1 join items ts on ts.id = cte1.id;");
		  //	$query = $this->db->query(" SELECT incoming.customer_name as customer, incoming.customer_address as alamat, incoming.dtw as dtw, incoming.gross_amount as totalqty, incoming.datecreated as datecreated, 
		  //	                             incoming_item.incoming_id as incoming, incoming_item.partno as part, incoming_item.nolot as lot, incoming_item.totalcheck as totalcheck, incoming_item.qty as qty, incoming_item.operatorname as operatorname
		  //	                            FROM incoming left JOIN incoming_item 
		  //	                            ON incoming.id=incoming_item.incoming_id 
		  //	                            WHERE datecreated BETWEEN '$start_date' and '$end_date' ORDER BY incoming.datecreated asc");

		  $query = $this->db->query("SELECT ts.id,ts.partno,group_concat(ts.nolot order by ts.id limit 5 ) kodemat, sum(ts.qty) qty, datecreated,customer_name from incoming_item ts join incoming ti on ti.id = ts.incoming_id WHERE datecreated BETWEEN '$start_date' and '$end_date' group by ts.partno ORDER BY ti.datecreated asc;");
			 return $query->result();
		  
		  }
		}


		public function dataexportppictiga($start_date, $end_date)
		{
			
				$data = [];
		
				if (isset($start_date) && isset($end_date)) {
			    $query = $this->db->query("select datecreated, partno, SUBSTRING_INDEX(nolot, ',', 1) AS 'kodea', CASE WHEN LOCATE(',', nolot, 1) = 0 THEN 0 ELSE SUBSTRING_INDEX(SUBSTRING_INDEX(nolot, ',', 2), ',', -1) END AS 'kodeb', CASE WHEN LOCATE(',', nolot, (LOCATE(',', nolot, 1) + 1)) = 0 THEN 0 ELSE SUBSTRING_INDEX(nolot, ',', -1) END AS 'kodec', qty as 'qty' from ( SELECT b.datecreated, a.partno, group_concat(a.nolot) as nolot, sum(a.qty) as qty from incoming_item a inner join incoming b on b.id = a.incoming_id WHERE datecreated BETWEEN '$start_date' and '$end_date' group by a.partno ) as s;");
			   return $query->result();
			
			}
		  }
  

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'supplier_name' => $this->input->post('supplier_name'),
    		'supplier_address' => $this->input->post('supplier_address'),
			'supplier_phone' => $this->input->post('supplier_phone'),
    		'pono' => $this->input->post('pono'), //mau dikirim ke gudang kapan
			'operatorname' => $this->input->post('operatorname'), //mau dikirim ke gudang kapan
    		'receiveddate' => $this->input->post('receiveddate'),
			'waktu' => $this->input->post('waktu'),
			'sj' => $this->input->post('sj'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('barangmasuk', $data);
		$barangmasuk_id = $this->db->insert_id();

		$this->load->model('model_material');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'barangmasuk_id' => $barangmasuk_id,
    			'product_id' => $this->input->post('product')[$x],
				'name' => $this->input->post('name_value')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'nolot' => $this->input->post('nolot')[$x],
    			'hs' => $this->input->post('hs_value')[$x],
				'tb' => $this->input->post('tb_value')[$x],
				'eb' => $this->input->post('eb_value')[$x],
				'sg' => $this->input->post('sg_value')[$x],
				'kpsw' => $this->input->post('kpsw')[$x],
				'skiw' => $this->input->post('skiw')[$x],
				'gap' => $this->input->post('gap')[$x],
    		);

    		$this->db->insert('barangmasuk_item', $items);

    		// now decrease the stock from the product
    	//	$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    	//	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    	//	$update_product = array('qty' => $qty);


    	//	$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($barangmasuk_id) ? $barangmasuk_id : false;
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
			
			'supplier_name' => $this->input->post('supplier_name'),
    		'supplier_address' => $this->input->post('supplier_address'),
			'supplier_phone' => $this->input->post('supplier_phone'),
    		'pono' => $this->input->post('pono'), //mau dikirim ke gudang kapan
			'operatorname' => $this->input->post('operatorname'), //mau dikirim ke gudang kapan
    		'receiveddate' => $this->input->post('receiveddate'),
			'waktu' => $this->input->post('waktu'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
			'sj' => $this->input->post('sj'),
    		'user_id' => $user_id,
	    	'paid_status' => $this->input->post('paid_status'),
	    	'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('barangmasuk', $data);

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
			$this->db->where('barangmasuk_id', $id);
			$this->db->delete('barangmasuk_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
					'barangmasuk_id' => $barangmasuk_id,
					'product_id' => $this->input->post('product')[$x],
					'name' => $this->input->post('name_value')[$x],
					'qty' => $this->input->post('qty')[$x],
					'nolot' => $this->input->post('nolot')[$x],
					'hs' => $this->input->post('hs_value')[$x],
					'tb' => $this->input->post('tb_value')[$x],
					'eb' => $this->input->post('eb_value')[$x],
					'sg' => $this->input->post('sg_value')[$x],
					'kpsw' => $this->input->post('kpsw')[$x],
					'skiw' => $this->input->post('skiw')[$x],
					'gap' => $this->input->post('gap')[$x],
	    			
	    		);
	    		$this->db->insert('barangmasuk_item', $items);

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
			$delete = $this->db->delete('barangmasuk');

			$this->db->where('barangmasuk_id', $id);
			$delete_item = $this->db->delete('barangmasuk_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function removeold($barangmasuk_id)
	{
		if($incoming_id) {
			//$this->db->where('id', $id);
			//$delete = $this->db->delete('orders');

			$this->db->where('barangmasuk_id', $barangmasuk_id);
			$delete_item = $this->db->delete('barangmasuk_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidBarangmasuk()
	{
		$sql = "SELECT * FROM barangmasuk WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}