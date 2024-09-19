<?php 

class Model_pocompound extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the Pocompound data */
	public function getPocompoundData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM pocompound WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM pocompound ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the Pocompound item data
	public function getPocompoundItemData($pocompound_id = null)
	{
		if(!$pocompound_id) {
			return false;
		}

		$sql = "SELECT * FROM pocompound_item WHERE pocompound_id = ?";
		$query = $this->db->query($sql, array($pocompound_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'SKI-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
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

		$insert = $this->db->insert('pocompound', $data);
		$pocompound_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'pocompound_id' => $pocompound_id,
    			'product_id' => $this->input->post('product')[$x],
				'name' => $this->input->post('name_value')[$x],
				
    			'qty' => $this->input->post('qty')[$x],
				'mix' => $this->input->post('mix_value')[$x],
				'total_qty' => $this->input->post('total_qty_value')[$x],
				'unit' => $this->input->post('unit_value')[$x],
    			'rate' => $this->input->post('rate_value')[$x],
    			'amount' => $this->input->post('amount_value')[$x],
				'kiriman' => $this->input->post('kiriman')[$x],
				'tgl' => $this->input->post('tgl')[$x],
				'note' => $this->input->post('note')[$x],
    		);

    		$this->db->insert('Pocompound_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($pocompound_id) ? $pocompound_id : false;
	}

	public function countPocompoundItem($pocompound_id)
	{
		if($pocompound_id) {
			$sql = "SELECT * FROM pocompound_item WHERE $pocompound_id = ?";
			$query = $this->db->query($sql, array($pocompound_id));
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
				'deliverydate' => $this->input->post('deliverydate'),
				'pono' => $this->input->post('pono'),
				'fax' => $this->input->post('fax'),
				'attn' => $this->input->post('attn'),
				'date_closed' => date('D-M-Y H:i:s'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('pocompound', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_pocompound_item = $this->getPocompoundItemData($id);
			foreach ($get_pocompound_item as $k => $v) {
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
			$this->db->where('pocompound_id', $id);
			$this->db->delete('Pocompound_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
					'pocompound_id' => $id,
					'product_id' => $this->input->post('product')[$x],
					'name' => $this->input->post('name_value')[$x],
					'qty' => $this->input->post('qty')[$x],
					'mix' => $this->input->post('mix_value')[$x],
					'total_qty' => $this->input->post('total_qty_value')[$x],
					'unit' => $this->input->post('unit_value')[$x],
					'rate' => $this->input->post('rate_value')[$x],
					'amount' => $this->input->post('amount_value')[$x],
					'kiriman' => $this->input->post('kiriman')[$x],
					'tgl' => $this->input->post('tgl')[$x],
					'note' => $this->input->post('note')[$x],
	    		);
	    		$this->db->insert('Pocompound_item', $items);

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
			$delete = $this->db->delete('pocompound');

			$this->db->where('pocompound_id', $id);
			$delete_item = $this->db->delete('pocompound_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidPocompound()
	{
		$sql = "SELECT * FROM pocompound WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}


	function fetch_single_details($id)
	{
	 $this->db->where('id', $id);
	 $data = $this->db->get('customer');
	 $output = '<table width="100%" cellspacing="5" cellpadding="5">';
	 foreach($data->result() as $row)
	 {
	  $output .= '
	  <img src="<?php echo base_url(); ?> /application/21.jpg">
	  <title><img width="680" height="80" src="21.jpg" alt="etics-insurance-000.png" /></title>
	  <p><strong>&nbsp;</strong></p>
	  <br>
	  <br>
	  <br>
   
	  <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr>
		  <td colspan="2" align="center" style="font-family:verdana font-size:18px"  ><b> DELIVERY ORDER </b></td>
		  </tr>
		  <tr>
		  <td colspan="2" align="center" style="font-family:verdana font-size:8 px"  ><b> </b></td>
		  </tr>
		  <tr>
		  <td colspan="2" align="center" style="font-family:verdana font-size:8 px"  ><b> </b></td>
		  </tr>
		  <br>
		   <br>
		  <tr>
		  <td colspan="2">
			  <table width="100%" border ="0" cellpadding="0">
			  
			  <tr>
				  <td  style="font-size:12px" width=10%"> To   </td>
				  <td  style="font-size:12px" width="65%">: Customer </td>
				  <td  style="font-size:12px" width="15%"> PO No. </td>
				  <td  style="font-size:12px" width="45%">: Nomer PO </td>
			   </tr>
			   <tr>
				  <td rowspan="2" style="font-size:12px" width="10%">  </td>
				  <td rowspan="2" style="font-size:12px" width="65%">&nbsp; alamat lengkap</td>
				  <td  style="font-size:12px" width="15%">PO Date. </td>
				  <td  style="font-size:12px" width="45%">: Customer </td> 
				  </td>
			   </tr>
   
   
			   <tr>
				  
				  <td  style="font-size:12px" width="0%"></td>
				  <td  style="font-size:12px" width="12%">  </td>
				 
			   </tr>
			   <tr>
				  <td  style="font-size:12px" width="10%"> Telp  </td>
				  <td  style="font-size:12px" width="65%">: 098888</td>
				  <td  style="font-size:12px" width="12%"> </td>
				  <td  style="font-size:12px" width="45%"> </td> 
				  </td>
			   </tr>
   
			   <tr>
				  <td  style="font-size:12px" width=10%"> Fax   </td>
				  <td  style="font-size:12px" width="65%">: 0899 </td>
				  <td  style="font-size:12px" width="12%">  </td>
				  <td  style="font-size:12px" width="45%"> </td>
			   </tr>
			   <tr>
				  <td  style="font-size:12px" width="10%"> </td>
				  <td  style="font-size:12px" width="65%"></td>
				  <td  style="font-size:12px" width="12%"></td>
				  <td  style="font-size:12px" width="45%"> </td> 
				  </td>
			   </tr>
			   
			   <tr>
			   <td  style="font-size:12px" width=10%"> Attn   </td>
			   <td  style="font-size:12px" width="65%">: Bpk budi </td>
			   <td  style="font-size:12px" width="12%">  </td>
			   <td  style="font-size:12px" width="45%"> </td>
			</tr>
			<tr>
			   <td  style="font-size:12px" width="10%"> </td>
			   <td  style="font-size:12px" width="65%"></td>
			   <td  style="font-size:12px" width="12%"></td>
			   <td  style="font-size:12px" width="45%"> </td> 
			   </td>
			</tr>
   
   
   
   
   
			  </table>
			  <br /> <b style="font-size:12px" >Based on order we sent below items:</b>
		  <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
		  
		  <tr>
		  <th width ="4%" align="left" style="font-size:12px">No.</th>
		  <th width="25%"align="center" style="font-size:12px">Description</th>
		  <th width="10%"align="center" style="font-size:12px">Qty</th>
		  <th width="8%" align="center" style="font-size:12px">Unit</th>
		  <th width="20%" align="center" style="font-size:12px">Unit Price</th>
		  <th width="20%" align="center" style="font-size:12px">Amount</th>
		  <th width="20%" align="center"style="font-size:12px">Note</th> 
		  </tr>';
	 
		  $output .= '
		  <tr>
		  <td align="left" style="font-size:11px"></td>
		  <td align="left" style="font-size:11px"></td>
		  <td align="left" style="font-size:11px"></td>
		  <td width="10%" align="right" style="font-size:11px"></td>
		  <td align="right" style="font-size:11px"></td>
		  <td align="left" style="font-size:11px"></td>   
		  <td align="left" style="font-size:11px"></td>   
		  </tr>';
	  }
	  $output .= '
	  
		  <tr >
		  <td align="left" colspan="3" style="font-size:12px"><b>Delivery Date :</b></td>
		  <td align="right" style="font-size:12px"><b></b></td>
		  <td align="right" style="font-size:12px"><b></b></td>
		  <td align="left" style="font-size:12px"><b>SUB TOTAL</b></td>
		  <td align="left" style="font-size:12px"><b>Rp.</b></td>
		  </tr>
   
		  <tr>
		  <td align="left" colspan="3" style="font-size:12px"><b></b></td>
		  <td align="right" style="font-size:12px"><b></b></td>
		  <td align="right" style="font-size:12px"><b></b></td>
		  <td align="left" style="font-size:12px"><b>PPN (10 %)</b></td>
		  <td align="left" style="font-size:12px"><b>Rp.</b></td>
		  </tr>
   
		  <tr>
		  <td align="left" colspan="3" style="font-size:12px"><b></b></td>
		  <td align="right" style="font-size:12px"><b></b></td>
		  <td align="right" style="font-size:12px"><b></b></td>
		  <td align="left" style="font-size:12px"><b>TOTAL</b></td>
		  <td align="left" style="font-size:12px"><b>Rp.</b></td>
		  </tr>
		  
	   
		  ';
	  $output .= '
	  
	  
		  <table width="100%" border="1" cellpadding="0" cellspacing="0">	
		  <tr>
			  <td style="font-size:10px"  width="65%">
		  
				  Note : <br/>
					  &nbsp;<i  style="font-size:8px">Putih&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Fakturing</i><br/> 
					  &nbsp;<i  style="font-size:8px">Merah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Dept. FGA</i><br/> 
					  &nbsp;<i  style="font-size:8px">Kuning&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: PPIC</i><br/> 
					  &nbsp;<i  style="font-size:8px">Hijau&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Konsumen</i><br/> 
					  &nbsp;<i  style="font-size:8px">Biru&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Konsumen</i><br/> 	
			  </td>
		  </tr>			
		  </table>
		  
	  
	  
	  
	  
	  
	  <table style="font-size:12px" width="100%" border="1" cellpadding="0" cellspacing="0">	
		  <tr>
			  <td align ="left" style="font-size:12px" width="35%">
				  Driver : 
			  </td>
			  <td style="font-size:12px" width="35%" align="center">         
				  Divisi.-----------------<br />
			  
			  </td>
	  
			  <td style="font-size:12px"  width="12%" align="center">         
					  Sales<br />
			  
			  
			  </td>
			  <td style="font-size:12px"  width="12%" align="center">         
					  PPIC<br />
				  
			  
			  </td>
			  <td style="font-size:12px"  width="12%" align="center">         
					  FGA<br />
				  
			  
			  </td>
		  </tr>
	  </table>
	  
	  
	  
	  <table style="font-size:12px" width="100%" border="1" cellpadding="0" cellspacing="0">	
		  <tr>
			  <td align ="left" style="font-size:12px" width="35%">
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
			  </td>
			  <td style="font-size:12px" width="35%" align="center"> 
			  <b style="font-size:11px"></b>
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
			  </td>
	  
			  <td style="font-size:12px"  width="12%" align="center">         
					 Prepared<br />
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
			  </td>
			  <td style="font-size:12px"  width="12%" align="center">         
					  Checked,<br />
					  <b align="center" ></b> <br /> 
					  <b align="center" ></b> <br /> 
					  <b align="center" ></b> <br /> 
					  <b align="center" ></b> <br /> 
			  
			  </td>
			  <td style="font-size:12px"  width="12%" align="center">         
					  Approved<br />
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
				  <b align="center" ></b> <br /> 
			  
			  </td>
		  </tr>
	  </table>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <table style="font-size:12px" width="100%" border="1" cellpadding="1" cellspacing="1">	
		  <tr>
			  <td style="font-size:11px" width="35%" align="left">
				  <bstyle="font-size:12px">Submit by,</b>
			  </td>
			  <td style="font-size:11px" width="35%" align="center" >         
				  Accepted by,<br />
			  </td>
			  <td style="font-size:11px"  width="36%" align="center" >         
				  PT Shimada Karya Indonesia
			  </td>
		  </tr>
	  </table>
	  
	  
	  
	  
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">	
		  <tr>
			  <td style="font-size:11px"  width="65%">
			  <b style="font-size:12px">Please accept with care,</b>
			  
				  
			  </td>
		  </tr>			
	  </table>
		  
	  
	  
	  
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">	
		  <tr>
			  <td style="font-size:10px"  width="70%">
			  
			  
			  <br>
			  
			  </td>
			  <td style="font-size:10px"  width="36%">
			  
			  <br>
			  
				  
			  </td>
		  </tr>			
	  </table>
		  
	  
	  
	  
	  
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">	
		  <tr>
			  <td style="font-size:10px"  width="70%">
			  
			  <b style="font-size:12px">Sent by,</b>
			  <br>
			  <u>Vehicle  &nbsp;&nbsp;&nbsp; : </u>
			  </td>
			  <td style="font-size:10px"  width="36%">
			  
			  <br>
			  &nbsp;&nbsp; <u>No. Police : </u>
				  
			  </td>
		  </tr>			
	  </table>
		  
	  
	  
	  
	  
	  
	  
	  
	  
	  
		  <table style="font-size:12px"  width="100%" border="0" cellpadding="0" cellspacing="0">	
		  <tr>
		  <td style="font-size:12px"  width="25%">
		  
		  <td style="font-size:12px" width="25%">         
		   
		  </td>
		  
		  <td style="font-size:12px" width="25%">    <br />     
		   
		  </td>
		  </tr>
		  </table>
	  
	  
		  </tr>';
		  
	  
   
	 
	 
	 $output .= '</table>';
	 return $output;
	}
   
















































	function showRecord()
	{
		return $this->db->get('products');
	}
	function show_single_details($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('products');
		$output = '<table width="100%" cellspacing="5" cellpadding="5">';
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>
				<td width="25%"><img src="'.base_url().'images/'.$row->images.'" /></td>
				<td width="75%">
					<p><b>Name : </b>'.$row->name.'</p>
					<p><b>Address : </b>'.$row->sku.'</p>
					<p><b>City : </b>'.$row->price.'</p>
					<p><b>City : </b>'.$row->qty.'</p>
					<p><b>City : </b>'.$row->description.'</p>
					<p><b>City : </b>'.$row->description.'</p><p>
					<b>City : </b>'.$row->description.'</p>


				</td>
			</tr>
			';
		}
		$output .= '</table>';
		return $output;
	}



}




