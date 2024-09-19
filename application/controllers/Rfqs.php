<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Rfqs extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Rfqs';

		$this->load->model('model_rfqs');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}
	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewRfqs', $this->permission)) { //menampilkan tabel rfq manage
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Rfqs';
		$this->render_template('rfqs/index', $this->data);		
	}
	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchRfqsData()
	{
		$result = array('data' => array());

		$data = $this->model_rfqs->getRfqsData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_rfqs->countRfqsItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewRfqs', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('rfqs/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateRfqs', $this->permission)) {
				$buttons .= ' <a href="'.base_url('rfqs/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteRfqs', $this->permission)) {
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
		if(!in_array('createRfqs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Rfqs';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$rfq_id = $this->model_rfqs->create();
        	
        	if($rfq_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('rfqs/update/'.$rfq_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('rfqs/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
        	$this->data['products'] = $this->model_products->getActiveProductData();      	
            $this->render_template('rfqs/create', $this->data);
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
		if(!in_array('updateRfqs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		if(!$id) {
			redirect('dashboard', 'refresh');
		}
		$this->data['page_title'] = 'Update Rfqs';
		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_rfqs->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('rfqs/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('rfqs/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$rfqs_data = $this->model_rfqs->getRfqsData($id);

    		$result['rfq'] = $rfqs_data;
    		$rfqs_item = $this->model_rfqs->getRfqsItemData($rfqs_data['id']);

    		foreach($rfqs_item as $k => $v) {
    			$result['rfq_item'][] = $v;
    		}

    		$this->data['rfq_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('rfqs/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteRfq', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$Rfq_id = $this->input->post('Rfq_id');

        $response = array();
        if($Rfq_id) {
            $delete = $this->model_rfqs->remove($rfq_id);
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
	public function printDiv($id)
	{
		if(!in_array('viewRfq', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$rfq_data = $this->model_rfqs->getRfqsData($id);
			$rfqs_items = $this->model_rfqs->getRfqsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$rfq_date = date('d/m/Y', $rfq_data['date_time']);
			$paid_status = ($rfq_data['paid_status'] == 1) ? "Paid" : "Unpaid";

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
			          <small class="pull-right">Date: '.$rfq_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$rfq_data['bill_no'].'<br>
			        <b>Name:</b> '.$rfq_data['customer_name'].'<br>
			        <b>Address:</b> '.$rfq_data['customer_address'].' <br />
			        <b>Phone:</b> '.$rfq_data['customer_phone'].'
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

			          foreach ($rfqs_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
				            <td>'.$product_data['name'].'</td>
				            <td>'.$v['unit'].'</td>
				            <td>'.$v['qty'].'</td>
				            <td>'.$v['note'].'</td>
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
			              <td>'.$rfq_data['gross_amount'].'</td>
			            </tr>';

			            if($rfq_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$rfq_data['service_charge_rate'].'%)</th>
				              <td>'.$rfq_data['service_charge'].'</td>
				            </tr>';
			            }
			            if($rfq_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$rfq_data['vat_charge_rate'].'%)</th>
				              <td>'.$rfq_data['vat_charge'].'</td>
				            </tr>';
			            }
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$rfq_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$rfq_data['net_amount'].'</td>
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

	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewRfqs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$rfq_data = $this->model_rfqs->getRfqsData($id);
			$rfqs_items = $this->model_rfqs->getRfqsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$rfq_date = date('M d-Y', $rfq_data['date_time']);
			$deliveryDate = date("M d Y ", strtotime($rfq_data['duedate']));
			$paid_status = ($rfq_data['paid_status'] == 1) ? "Paid" : "Unpaid";

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
		  border: 0px solid black;
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
	   
	   
	   <table width="100%" border="0" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:14px"><b> REQUEST FOR QUOTATION </b></td>
		   
		   </tr>
		   <tr>
		   <td colspan="2" align="center" style="font-size:12px"><b> No. '.$rfq_data['pono'].'   </b></td>
		   
		   </tr>
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      
       <td colspan="2">
           <table width="100%" border ="0" cellpadding="0">
           
           <tr>
               <td  style="font-size:12px" width=10%"> To   </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="65%"></b> '.$rfq_data['customer_name'].' </td>
               <td align="left" style="font-size:12px" width="15%"> </td>
               <td  style="font-size:12px" width="45%"> </td>
			   <td  style="font-size:12px" width="45%">Sumedang, '.$rfq_date.' </td>
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="10%">Address  </td>
               <td rowspan="2" style="font-size:12px" width="2%"> : </td>
               <td rowspan="2" align="left" style="font-size:12px" width="65%"></b> '.$rfq_data['customer_address'].' <br /></td>
               <td align="left" style="font-size:12px" width="15%"></td>
               
               <td  style="font-size:12px" width="45%">  </td> 
               </td>
            </tr>


            <tr>
            
               <td  style="font-size:12px" width="0%"></td>
               <td  style="font-size:12px" width="12%">  </td>
              
            </tr>
            <tr>
               <td  style="font-size:12px" width="10%"> Telp  </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="65%">'.$rfq_data['customer_phone'].'</td>
               <td  style="font-size:12px" width="12%"> </td>
               <td  style="font-size:12px" width="45%"> </td> 
               </td>
            </tr>

            <tr>
               <td  style="font-size:12px" width=10%"> Fax   </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="65%">  '.$rfq_data['fax'].'</td>
               <td  style="font-size:12px" width="12%">  </td>
               <td  style="font-size:12px" width="45%"> </td>
            </tr>
            
            
            <tr>
            <td  style="font-size:12px" width=10%"> Attn   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="65%"> '.$rfq_data['attn'].'</td>
            <td  style="font-size:12px" width="12%">  </td>
            <td  style="font-size:12px" width="45%"> </td>
         </tr>
        
		 </table>
	<p  style="font-size:12px" > Dear Sirs/Madams,</p>
	<p  style="font-size:12px"> First of all we would like to thank you for your support in our PT.Shimada Karya Indonesia activities. regarding to 
	project in our company, please submit your Quatation ( part preparation follow sheet ) for following part :</p>
    </table>
           
       <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
       <thead>
       <tr>
       <th width ="4%" align="center" style="font-size:12px">No.</th>
       <th width="20%"align="center" style="font-size:12px">Part No</th>
       <th width="20%"align="center" style="font-size:12px">Part Name</th>
       <th width="8%" align="center" style="font-size:12px">Unit</th>
       <th width="20%" align="center"style="font-size:12px">Note</th> 
       </tr>
		</thead>';
        $no =0;
	foreach ($rfqs_items as $k => $v) {
	//$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;
  
       $output .= '
       <tr>
       <td align="center" style="font-size:11px">'.$no.'</td>
       <td align="center" style="font-size:11px">'.$v['product'].'</td>
       <td align="center" style="font-size:11px">'.$v['partname'].'</td>
       <td width="8%"align="center" style="font-size:11px">'.$v['unit'].'</td>
       <td align="center" style="font-size:11px">'.$v['note'].'</td>   
       
       </tr>';
    }
   $output .= '
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
   
       <tr >
       <td align="left" colspan="3" style="font-size:12px"></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td width="15%" align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="left" style="font-size:12px"><b></b></td>
       <td width="20%" align="left" style="font-size:12px"><b></b></td>
       </tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="left" style="font-size:12px"><b></b></td>
       <td width="20%" align="left" style="font-size:12px"><b></b></td>
       </tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="left" style="font-size:12px"><b></b></td>
       <td width="20%"align="left" style="font-size:12px"><b></b></td>
       </tr>
       



	<table width="100%" border="0" cellpadding="4" cellspacing="0">
   
    <tr >
       <td align="left" colspan="4" style="font-size:12px"></td>
       <td align="right" style="font-size:12px"> </td>
       <td align="right" style="font-size:12px"><b></b></td>
       
       </tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px">Due date for Quatation submission in -  '.$deliveryDate.' </td>
	   <td align="left" style="font-size:12px"><b></b></td>
      
       <td width= "2%"align="left" style="font-size:12px"><b></b></td>

       
    </tr>

    <tr>
       <td align="left"colspan="4" style="font-size:12px">Any further quatation, please do not hesitate to contact us.</td>
       <td align="left" style="font-size:12px"><b></b></td>
       <td width= "2%" align="left" style="font-size:12px"><b></b></td>
    </tr>
	<tr>
	<td align="left"colspan="4" style="font-size:12px">Thank you for your attention and cooperation</td>
	<td align="left" style="font-size:12px"><b></b></td>
	<td width= "2%" align="left" style="font-size:12px"><b></b></td>
 	</tr>



    
       ';
   $output .= '
   
       
   
   
   
   
   
   <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		 <u> Dede tomy</u>
           </td>
           <td style="font-size:12px" width="35%" align="center">         
               
           
           </td>
   
           <td style="font-size:12px"  width="12%" align="center">         
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
           
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
		   <u> Aries Nugraha</u>               
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
               
           
           </td>
       </tr>
   </table>
   
   
   
   <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   Prepared by,<br />
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
                  <br />
               <b align="center" ></b> <br /> 
               <b align="center" ></b> <br /> 
               <b align="center" ></b> <br /> 
               <b align="center" ></b> <br /> 
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
                   know by,<br />
                   <b align="center" ></b> <br /> 
                   <b align="center" ></b> <br /> 
                   <b align="center" ></b> <br /> 
                   <b align="center" ></b> <br /> 
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
                   <br />
               <b align="center" ></b> <br /> 
               <b align="center" ></b> <br /> 
               <b align="center" ></b> <br /> 
               <b align="center" ></b> <br /> 
           
           </td>
       </tr>
   </table>
   
   <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="1">	
       <tr>
           <td style="font-size:11px" width="35%" align="center">
               <bstyle="font-size:12px"></b>
           </td>
           <td style="font-size:11px" width="35%" align="center" >         
               <br />
           </td>
           <td style="font-size:12px"  width="36%" align="center" >         
              <b> </b>
           </td>
       </tr>
   </table>
   
   
   
   
   <table width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td style="font-size:11px"  width="65%">
           <b style="font-size:12px"></b>
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
           
           <b style="font-size:12px"></b>
           <br>
          
           </td>
           <td style="font-size:10px"  width="36%">
           
           <br>
           
               
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

			$rfq_data = $this->model_rfqs->getRfqsData($id);
			$rfqs_items = $this->model_rfqs->getRfqsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}































}