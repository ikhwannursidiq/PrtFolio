<?php 

class Model_wip extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getWipData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM wip WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM wip ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getSpiItemData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sip_item WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sip_item ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getSpiData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sip WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sip ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getDataWipItem($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM wip_item where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM wip_item ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	// get the orders item data
	public function getWipItemData($wip_id = null)
	{
		if(!$wip_id) {
			return false;
		}

		$sql = "SELECT * FROM wip_item WHERE wip_id = ?";
		$query = $this->db->query($sql, array($wip_id));
		return $query->result_array();
	}

	public function getWipItem()
	{
		$sql = "SELECT * FROM wip_item WHERE qty > 0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getAmbilDataSpi()
	{
	//	$sql = "SELECT * FROM wip_item  WHERE qty > 0";
	//	$sql ="SELECT wip_item.id, wip_item.wip_id, wip_item.product_id, wip_item.partno, wip_item.qty, wip_item.nolot, wip_item.qtyawal, wip.dateinput, wip.datecreated
	//	FROM wip_item
	//	RIGHT JOIN wip
	//	ON wip_item.wip_id = wip.id 
	//	where wip_item.qty > 0 and wip.dateinput BETWEEN '2023-04-29' and '2029-12-30'";
		
		$sql ="SELECT wip_item.id, wip_item.wip_id, wip_item.product_id, wip_item.partno, wip_item.qty, wip_item.nolot, wip_item.qtyawal, wip.dateinput, wip.datecreated
		FROM wip_item
		RIGHT JOIN wip
		ON wip_item.wip_id = wip.id 
		where wip_item.qty  and wip.dateinput BETWEEN '2023-04-29' and '2029-12-30'";
		
		
		//$sql= "SELECT id,partno,nolot, SUM(qty) as qty FROM wip_item GROUP BY partno,nolot HAVING qty > 0";
		//$sql= "SELECT id,partno,nolot, SUM(qty) as qty FROM wip_item GROUP BY partno,nolot HAVING qty > 0 ";
	
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getLot($id = null)
	{
		if(!$id) {
			return false;
		}

		$sql = "SELECT * FROM wip_item WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'operatorname' => $this->input->post('operatorname'),
    		'leader' => $this->input->post('leader'),
    		'shift' => $this->input->post('shift'),
			'dateinput' => $this->input->post('dateinput'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('total_qty_value'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('wip', $data);
		$wip_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'wip_id' => $wip_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
				'qtyawal' => $this->input->post('qty')[$x],
    			'partno' => $this->input->post('partno_value')[$x],
				'nolot' => $this->input->post('nolot')[$x],
    			'note' => $this->input->post('note')[$x],
    		);

    		$this->db->insert('wip_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_items->getItemData($this->input->post('product')[$x]);
    	//	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];
		    $qty = (int) $product_data['stokin'] + (int) $this->input->post('qty')[$x];

    		$update_product = array('stokin' => $qty);


    		$this->model_items->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($wip_id) ? $wip_id : false;
	}

	public function countItem($wip_id)
	{
		if($wip_id) {
			$sql = "SELECT * FROM wip_item WHERE wip_id = ?";
			$query = $this->db->query($sql, array($wip_id));
			return $query->num_rows();
		}
	}
	public function createspi()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'operatorname' => $this->input->post('operatorname'),
    	//	'leader' => $this->input->post('leader'),
    		'shift' => $this->input->post('shift'),
			'dateinput' => $this->input->post('dateinput'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
			'net_amount' => $this->input->post('net_amount_value'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('sip', $data);
		$sip_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'sip_id' => $sip_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'partno' => $this->input->post('partno_value')[$x],
				'nolot' => $this->input->post('nolot_value')[$x],
				'rate' => $this->input->post('rate')[$x],
    			'amount' => $this->input->post('amount_value')[$x],
				'totaljamkerja' => $this->input->post('totaljamkerja_value')[$x],
				'customer' => $this->input->post('customer')[$x],
    		);

    		$this->db->insert('sip_item', $items);

    		// now decrease the stock from the product
    	//	$product_data = $this->model_items->getItemData($this->input->post('product')[$x]);
    	    //	$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];
		//    $qty = (int) $product_data['stokin'] + (int) $this->input->post('qty')[$x];

    	//	$update_product = array('stokin' => $qty);


    		$this->model_items->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($sip_id) ? $sip_id : false;
	}

	public function getSipData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sip WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sip ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSipItemData($sip_id = null)
	{
		if(!$sip_id) {
			return false;
		}

		$sql = "SELECT * FROM sip_item WHERE sip_id = ?";
		$query = $this->db->query($sql, array($sip_id));
		return $query->result_array();
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
			'operatorname' => $this->input->post('operatorname'),
    		'leader' => $this->input->post('leader'),
    		'shift' => $this->input->post('shift'),
			'dateinput' => $this->input->post('dateinput'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('total_qty_value'),
    		'paid_status' => 2,
    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('wip', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_items');
			$get_item_item = $this->getWipItemData($id);
			foreach ($get_item_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_items->getItemData($product_id);
				$update_qty = $qty + $product_data['stokin'];
				$update_product_data = array('stokin' => $update_qty);
				
				// update the product qty
				$this->model_items->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('wip_id', $id);
			$this->db->delete('wip_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'wip_id' => $id,
    			    'product_id' => $this->input->post('product')[$x],
    			    'qty' => $this->input->post('qty')[$x],
					'qtyawal' => $this->input->post('qty')[$x],
    			    'partno' => $this->input->post('partno_value')[$x],
				    'nolot' => $this->input->post('nolot')[$x],
    			    'note' => $this->input->post('note')[$x],
	    		);
	    		$this->db->insert('wip_item', $items);

	    		// now decrease the stock from the product
	    		$product_data = $this->model_items->getItemData($this->input->post('product')[$x]);
	    		$qty = (int) $product_data['stokin'] - (int) $this->input->post('qty')[$x];

	    		$update_product = array('stokin' => $qty);
	    		$this->model_items->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	}


	public function removespiitem($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('sip_item');

			return ($delete == true ) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('wip');

			$this->db->where('wip_id', $id);
			$delete_item = $this->db->delete('wip_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}


	public function date_range($start_date, $end_date)
	{
		
			$data = [];
	
			if (isset($start_date) && isset($end_date)) {
		//	$query = $this->db->query("SELECT * FROM incoming  WHERE datecreated BETWEEN '$start_date' and '$end_date' order by datecreated asc");
		    
		//	$query = $this->db->query(" SELECT incoming.customer_name as customer, incoming.customer_address as alamat, incoming.dtw as dtw, incoming.gross_amount as totalqty, incoming.datecreated as datecreated, 
		//	                             incoming_item.incoming_id as incoming, incoming_item.partno as part, incoming_item.nolot as lot, incoming_item.totalcheck as totalcheck, incoming_item.qty as qty, incoming_item.operatorname as operatorname
		//	                            FROM incoming left JOIN incoming_item 
		//	                            ON incoming.id=incoming_item.incoming_id 
		//	                            WHERE datecreated BETWEEN '$start_date' and '$end_date' ORDER BY incoming.datecreated asc");
		//    $query=$this->db->query(" SELECT wip.operatorname as operatorname, wip.leader as leader, wip.dateinput as dateinput, wip.datecreated as datecreated,wip_item.id as iditem, wip_item.nolot as nolot, wip_item.qty as qty,wip_item.qtyawal as qtyawal, wip_item.partno as partno FROM wip left JOIN wip_item ON wip.id=wip_item.wip_id WHERE dateinput BETWEEN '$start_date' and '$end_date' ORDER BY wip.datecreated asc");
	//join 4 table
	$query=$this->db->query("SELECT a.nolot as nolot, a.qty as qtyafter ,a.qtyawal as qtybefore, a.partno as partno, b.leader as leader,b.operatorname as operatorname, b.dateinput as dateinput, b.datecreated as datecreated, c.*, d.name as customer_name FROM wip_item a left join wip b on a.wip_id=b.id join items c on a.product_id = c.id join konsumens d on d.id = c.customer_id WHERE dateinput BETWEEN '$start_date' and '$end_date' ORDER BY b.datecreated asc");
	
		  return $query->result();
		
		}
	  }


	  public function getWipStockLot($id = null)
	  {
	   if($id) {
	   $sql = "SELECT * FROM wip WHERE id = ?";
	   $query = $this->db->query($sql, array($id));
		   return $query->row_array();
	   }
	   //$sql=" SELECT partno,nolot,SUM(qty) as total, leader, operatorname, datecreated, shift FROM wip_item join wip where wip.id = wip_item.wip_id Group BY partno";
	//$sql ="SELECT partno,nolot,qty ,qtyawal, leader, operatorname, datecreated,dateinput, shift FROM wip_item join wip where wip.id = wip_item.wip_id";
	$sql="SELECT a.partno as partno, a.nolot as nolot,a.qty as qty ,a.qtyawal as qtyawal, b.leader as leader, b.operatorname as operatorname, b.datecreated as datecreated,b.dateinput as dateinput, b.shift as shift , c.name as customer_name , d.partname as partname
	      FROM wip_item a join wip b on b.id = a.wip_id join items d on d.partname=a.partno join konsumens c on c.id = d.customer_id";  //     $sql ="SELECT ts.id,ts.name,group_concat(ti.nolot order by ti.id limit 5 ) lots, sum(ts.stokin) qty, tgl, operatorname, customer_id, stokout
	  //             from items ts 
	   //	        join wip_item ti on ti.nama = ts.name where ts.stokin >'0' group by ts.id,ts.name  ";
	   //$sql =" SELECT ts.id,ts.name,group_concat(ti.nolot order by ti.id limit 5 ) lots, sum(ts.stokin) qty, datecreated, operatorname, stokin, leader 
	   //	                   from items ts 
	   //	                   join wip_item ti on ti.partno = ts.name 
	   //	                   join wip tk on tk.id = ti.wip_id 
		 //                  where ts.stokin >'0' group by ts.id,ts.name;";
	   // $sql ="SELECT leader, nolot, datecreated, operatorname, partno, shift,qty FROM wip join wip_item where wip_item.wip_id =wip.id GROUP BY nolot;";
	  // $sql ="with cte as( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join inputs ti on ti.nama = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* , ts.stokout from cte1 join items ts on ts.id = cte1.id";
		  $query = $this->db->query($sql);
		 return $query->result_array();
   }

	public function getWipStock($id = null)
   {
	if($id) {
	$sql = "SELECT * FROM wip WHERE id = ?";
	$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

   //     $sql ="SELECT ts.id,ts.name,group_concat(ti.nolot order by ti.id limit 5 ) lots, sum(ts.stokin) qty, tgl, operatorname, customer_id, stokout
   //             from items ts 
	//	        join wip_item ti on ti.nama = ts.name where ts.stokin >'0' group by ts.id,ts.name  ";
	$sql =" SELECT ts.id,ts.name,group_concat(ti.nolot order by ti.id limit 55 ) lots, sum(ts.stokin) qty, tk.datecreated, tk.operatorname, ts.stokin, tk.leader 
		                   from items ts 
		                   join wip_item ti on ti.partno = ts.name 
		                   join wip tk on tk.id = ti.wip_id 
                        where ts.stokin >'0' group by ts.id,ts.name";
   // $sql ="with cte as( SELECT ts.id,ts.name,row_number() over(partition by ts.id order by ti.id) rn, ti.nolot from items ts join inputs ti on ti.nama = ts.name ), cte1 as (select cte.id,cte.name, max(case when rn = 1 then cte.nolot else 0 end) lot1, max(case when rn = 2 then cte.nolot else 0 end) lot2, max(case when rn = 3 then cte.nolot else 0 end) lot3, max(case when rn = 4 then cte.nolot else 0 end) lot4 from cte group by cte.id,cte.name ) select cte1.* , ts.stokout from cte1 join items ts on ts.id = cte1.id";
       $query = $this->db->query($sql);
	  return $query->result_array();
}



public function exportstok($start_date, $end_date)
   {
	$data = [];
	
			if (isset($start_date) && isset($end_date)) {
	 $query =$this->db->query(" SELECT ts.id,ts.name,group_concat(ti.nolot order by ti.id limit 5 ) lots, sum(ts.stokin) qty, datecreated, operatorname, stokin, leader 
		                   from items ts 
		                   join wip_item ti on ti.partno = ts.name 
		                   join wip tk on tk.id = ti.wip_id 
                         where datecreated BETWEEN '$start_date' and '$end_date'  group by ts.id,ts.name ORDER by datecreated");
   return $query->result();
			}
}


public function getWipJoinData($id = null)
{

	if($id) {
		$sql = "SELECT * FROM wip WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	$sql = "SELECT * FROM wip_item INNER JOIN wip ON wip.id=wip_item.wip_id order by wip_item.id desc ";
	$query = $this->db->query($sql);
	return $query->result_array();

}



public function wipdaterange($start_date, $end_date)
{
	
		$data = [];

		if (isset($start_date) && isset($end_date)) {
		
	//	$query=$this->db->query("SELECT wip.operatorname as operatorname, wip.leader as leader, wip.datecreated as datecreated, wip_item.nolot as nolot, wip_item.qty as qty, wip_item.qtyawal as qtyawal, wip_item.partno as partno FROM wip left JOIN wip_item ON wip.id=wip_item.wip_id WHERE datecreated BETWEEN '$start_date' and '$end_date' ORDER BY wip.datecreated asc");
	 //join 4 table
	$query=$this->db->query("SELECT a.nolot as nolot, a.qty as qty ,a.qtyawal as qtyawal, a.partno as partno, b.leader as leader,b.operatorname as operatorname, b.dateinput as dateinput, b.datecreated as datecreated, c.*, d.name as customer_name FROM wip_item a left join wip b on a.wip_id=b.id join items c on a.product_id = c.id join konsumens d on d.id = c.customer_id WHERE dateinput BETWEEN '$start_date' and '$end_date' ORDER BY b.datecreated asc");
	
		return $query->result();
	
	}
  }

  public function getwipspi($id = null)
  {
	  if($id) {
		  $sql = "SELECT a.partno, SUM(a.qtyawal) as qtywip, b.*,c.partno, SUM(c.qty) as qtysip,d.* FROM wip_item a join wip b on a.wip_id=b.id join sip_item c on a.partno = c.partno join sip d on d.id = c.sip_id where d.id= ? group by a.partno ";
  
		  $query = $this->db->query($sql, array($id));
		  return $query->row_array();
	  }
  
  $sql ="SELECT * FROM items 
  INNER JOIN (SELECT partno as partnowip, SUM(qtyawal) AS qtywip FROM wip_item GROUP BY partno) 
  wip_item ON items.name = wip_item.partnowip 
  INNER JOIN (SELECT partno as partnosip, SUM(qty) AS qtysip FROM sip_item GROUP BY partno) 
  sip_item ON items.name = sip_item.partnosip";
	  $query = $this->db->query($sql);
	  return $query->result_array();
  
  }
  

  
  public function JoinSpiItem()
  {
  
	  // $sql = "SELECT a.partno, SUM(a.qty) as qty, b.leader, b.dateinput FROM sip_item a INNER JOIN sip b ON b.id=a.sip_id group by a.partno";
	  $sql="SELECT a.partno, SUM(a.qty) as qty,group_concat(a.nolot order by a.id limit 5 ) nolot, b.leader, b.dateinput, b.operatorname FROM sip_item a INNER JOIN sip b ON b.id=a.sip_id group by a.partno order by dateinput DESC";
  
	  $query = $this->db->query($sql);
	  return $query->result_array();
  
  }

  public function JoinWipItem()
  {
  
  //	$sql = "SELECT a.partno, SUM(a.qtyawal) as qtyawal,group_concat(a.nolot order by a.id limit 5 ) nolot, b.leader, b.dateinput, b.operatorname FROM wip_item a INNER JOIN wip b ON b.id=a.wip_id group by a.partno ";
	  
	  $sql="SELECT a.partno, SUM(a.qtyawal) as qtyawal,group_concat(a.nolot order by a.id limit 5 ) nolot, b.leader, b.dateinput, b.operatorname FROM wip_item a INNER JOIN wip b ON b.id=a.wip_id group by a.partno order by dateinput DESC";
	  $query = $this->db->query($sql);
	  return $query->result_array();
  
  }

  public function konfirmasispi($id)
  {
	  
	  $user_id = $this->session->userdata('id');
  //	$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
	  $data = array(
		  'bill_no' => $this->input->post('bill_no'),
		  'operatorname' => $this->input->post('operatorname'),
	  //	'leader' => $this->input->post('leader'),
		  'shift' => $this->input->post('shift'),
		  'dateinput' => $this->input->post('dateinput'),
		  'date_time' => strtotime(date('Y-m-d h:i:s a')),
		  'gross_amount' => $this->input->post('gross_amount_value'),
		  'net_amount' => $this->input->post('net_amount_value'),
		  'paid_status' => 1,
		  'user_id' => $user_id
	  );

	  $insert = $this->db->insert('spi', $data);
	  $spi_id = $this->db->insert_id();
	  $this->load->model('model_products');

  //	$count_product = count($this->input->post('product'));
	 $count_product = count($this->input->post('partno_value'));
	  for($x = 0; $x < $count_product; $x++) {
		  $items = array(
			  'spi_id' => $spi_id,
		  //	'product_id' => $this->input->post('product')[$x],
			  'qty' => $this->input->post('qty_value')[$x],
			  'partno' => $this->input->post('partno_value')[$x],
			  'nolot' => $this->input->post('nolot_value')[$x],
			  'rate' => $this->input->post('rate')[$x],
			  'amount' => $this->input->post('amount_value')[$x],
			  'totaljamkerja' => $this->input->post('totaljamkerja_value')[$x],
			  'customer' => $this->input->post('customer')[$x],
			  'tercapai' => $this->input->post('tercapai_value')[$x],
			  'tdktercapai' => $this->input->post('tdktercapai_value')[$x],
			  'idwipitem' => $this->input->post('idwipitem')[$x],
		  );

		  $this->db->insert('spi_item', $items);

	  // now decrease the stock from the product
  //	$product_data = $this->model_items->getItemData($this->input->post('product')[$x]);
	  // $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];
  //	 $qty = (int) $product_data['stokin'] + (int) $this->input->post('qty')[$x];

  //	 $update_product = array('stokin' => $qty);
  //	 $this->model_items->update($update_product, $this->input->post('product')[$x]);
   }
   return ($pi_id) ? $spi_id : false;
  
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

	
	var $table = 'wip';
	var $tabledua = 'wip_item';
    var $column_order = array(null,'e.operatorname','e.leader','e.dateinput', 'wip_item.partno','wip_item.qty','wip_item.qtyawal','wip_item.nolot');
	var $column_search = array(null,'e.operatorname','e.leader');
 //   var $column_search = array('e.tgl','e.waktu','e.shift','e.operatorname','e.nama','e.nolot');
    var $order = array('id' => 'DESC');

    private function getQuery()
    {

        //add custom filter here
        if(!empty($this->input->post('operatorname')))
        {
         $this->db->like('e.operatorname', $this->input->post('operatorname'), 'both');
		}
		if(!empty($this->input->post('leader')))
        {
            $this->db->like('e.leader', $this->input->post('leader'), 'both');
        }
        if(!empty($this->input->post('partno')))
        {
            $this->db->like('wip_item.partno', $this->input->post('partno'), 'both');
        }
        if(!empty($this->input->post('operatorname')))
        {
            $this->db->like('e.operatorname', $this->input->post('operatorname'), 'both');
        }

		if(!empty($this->input->post('dateinput')))
        {
            $this->db->like('e.dateinput', $this->input->post('dateinput'), 'both');
        }
    
		if(!empty($this->input->post('nolot')))
        {
            $this->db->like('wip_item.nolot', $this->input->post('nolot'), 'both');
        }

        $this->db->select(array('e.id','e.operatorname','e.leader','e.shift','e.dtw', 'e.dateinput','e.datecreated','wip_item.note', 'wip_item.wip_id', 'wip_item.partno', 'wip_item.nolot', 'wip_item.qty','wip_item.qtyawal'));
        $this->db->from('wip as e');
	
		$this->db->join('wip_item', 'wip_item.wip_id = e.id');
	//	$this->db->where('wip_item.wip_id=wip.id');

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
    //    if(!empty($_POST['length']) && $_POST['length'] < 1) {
     //       $_POST['length']= '10';
      //  } else {
       //     $_POST['length']= $_POST['length'];
       // }
        
       // if(!empty($_POST['start']) && $_POST['start'] > 1) {
       // $_POST['start']= $_POST['start'];
       // }
       // $this->db->limit($_POST['length'], $_POST['start']);
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
		$this->db->from($this->tabledua);
        return $this->db->count_all_results();
    }




}