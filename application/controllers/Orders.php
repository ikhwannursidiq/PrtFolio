<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Orders extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';

		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Orders';
		$this->render_template('orders/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('orders/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$value['bill_no'],
				$value['customer_name'],
				$value['customer_phone'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_orders->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('orders/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/create', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_orders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_orders->getOrdersData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/

	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
			<style >
			@page { 
					margin-top: 100px;
					margin-bottom: 30px;
					margin-right: 10px;
					margin-left: 10px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			
			body {
		  border: 1px solid black;
		  background-color: ;
		  padding-top: 10px;
		  padding-right: 10px;
		  padding-bottom: 10px;
		  padding-left: 10px;
		}
		
		
		table thead td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
					font-variant: small-caps;
				}
			
			
		   </style>
		<div id="header">
		   <p align="center"><img width="700" height="70" src="assets/images/21.jpg" /></p>
	   </div>
	   
	   
	   <table width="100%" border="1" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:14px"><b> PURCHASE ORDER </b></td>
		   </tr>
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      
       <td colspan="2">
           <table width="100%" border ="0" cellpadding="0">
           
           <tr>
               <td  style="font-size:12px" width=10%"> To   </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="65%"></b> '.$order_data['customer_name'].' </td>
               <td align="left" style="font-size:12px" width="15%"> PO No. </td>
               <td  style="font-size:12px" width="45%">: Nomer PO </td>
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="10%">  </td>
               <td rowspan="2" style="font-size:12px" width="2%">  </td>
               <td rowspan="2" align="left" style="font-size:12px" width="65%"></b> '.$order_data['customer_address'].' <br /></td>
               <td align="left" style="font-size:12px" width="15%"> PO Date. </td>
               
               <td  style="font-size:12px" width="45%">: Customer </td> 
               </td>
            </tr>


            <tr>
            
               <td  style="font-size:12px" width="0%"></td>
               <td  style="font-size:12px" width="12%">  </td>
              
            </tr>
            <tr>
               <td  style="font-size:12px" width="10%"> Telp  </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="65%">'.$order_data['customer_phone'].'</td>
               <td  style="font-size:12px" width="12%"> </td>
               <td  style="font-size:12px" width="45%"> </td> 
               </td>
            </tr>

            <tr>
               <td  style="font-size:12px" width=10%"> Fax   </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="65%">  '.$order_data['customer_phone'].'</td>
               <td  style="font-size:12px" width="12%">  </td>
               <td  style="font-size:12px" width="45%"> </td>
            </tr>
            
            
            <tr>
            <td  style="font-size:12px" width=10%"> Attn   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="65%"> '.$order_data['customer_phone'].'</td>
            <td  style="font-size:12px" width="12%">  </td>
            <td  style="font-size:12px" width="45%"> </td>
         </tr>
        
		 </table>
    </table>
           <br /> <b style="font-size:12px" ></b>
       <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
       <thead>
       <tr>
       <th width ="4%" align="left" style="font-size:12px">No.</th>
       <th width="25%"align="center" style="font-size:12px">Description</th>
       <th width="10%"align="center" style="font-size:12px">Qty</th>
       <th width="8%" align="center" style="font-size:12px">Unit</th>
       <th width="20%" align="center" style="font-size:12px">Unit Price</th>
       <th width="20%" align="center" style="font-size:12px">Amount</th>
       <th width="20%" align="center"style="font-size:12px">Note</th> 
       </tr>
	 	</thead>  
	   ';
	$no =0;
	foreach ($orders_items as $k => $v) {

	$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;
       $output .= '
       <tr>
       <td align="left" style="font-size:11px">'.$no.'</td>
       <td align="left" style="font-size:11px">'.$product_data['name'].'</td>
       <td align="left" style="font-size:11px">'.$v['rate'].'</td>
       <td width="10%" align="right" style="font-size:11px">'.$v['rate'].'</td>
       <td align="right" style="font-size:11px">'.$v['rate'].'</td>
       <td align="left" style="font-size:11px">'.$v['rate'].'</td>   
       <td align="left" style="font-size:11px">'.$v['rate'].'</td>   
       </tr>';
	}
   $output .= '
   
       <tr >
       <td align="left" colspan="3" style="font-size:12px"><b>Delivery Date :</b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b>SUB TOTAL</b></td>
       <td align="left" style="font-size:12px"><b>Rp.</b> '.$order_data['gross_amount'].'</td>
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
			
			
			
			
			
			
			
			
			
			
			
			
			

			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}

	public function printDiv($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>AdminLTE 2 | Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			</head>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Date: '.$order_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$order_data['bill_no'].'<br>
			        <b>Name:</b> '.$order_data['customer_name'].'<br>
			        <b>Address:</b> '.$order_data['customer_address'].' <br />
			        <b>Phone:</b> '.$order_data['customer_phone'].'
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name</th>
			            <th>Price</th>
			            <th>Qty</th>
			            <th>Amount</th>
			          </tr>
			          </thead>
			          <tbody>'; 

			          foreach ($orders_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
				            <td>'.$product_data['name'].'</td>
				            <td>'.$v['rate'].'</td>
				            <td>'.$v['qty'].'</td>
				            <td>'.$v['amount'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:50%">Gross Amount:</th>
			              <td>'.$order_data['gross_amount'].'</td>
			            </tr>';

			            if($order_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$order_data['service_charge_rate'].'%)</th>
				              <td>'.$order_data['service_charge'].'</td>
				            </tr>';
			            }

			            if($order_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
				              <td>'.$order_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$order_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$order_data['net_amount'].'</td>
			            </tr>
			            <tr>
			              <th>Paid Status:</th>
			              <td>'.$paid_status.'</td>
			            </tr>
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;
		}
	}

}