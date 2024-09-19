<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Spss extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Spss';

		$this->load->model('model_spss');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage sps page
	*/
	public function index()
	{
		if(!in_array('viewSps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Spss';
		$this->render_template('spss/index', $this->data);		
	}

	/*
	* Fetches the spss data from the spss table 
	* this function is called from the datatable ajax function
	*/
	public function fetchSpssData()
	{
		$result = array('data' => array());

		$data = $this->model_spss->getSpssData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_spss->countSpsItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewSps', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('spss/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			

			if(in_array('updateSps', $this->permission)) {
				$buttons .= ' <a href="'.base_url('spss/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteSps', $this->permission)) {
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
		if(!in_array('createSps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Sps';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$sps_id = $this->model_spss->create();
        	
        	if($sps_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('spss/update/'.$sps_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('spss/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
        	$this->data['products'] = $this->model_products->getActiveProductData();      	
            $this->render_template('spss/create', $this->data);
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
	* This function is used in the sps page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit spss page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateSps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Sps';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_spss->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('spss/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('spss/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$spss_data = $this->model_spss->getSpssData($id);

    		$result['sps'] = $spss_data;
    		$spss_item = $this->model_spss->getSpssItemData($spss_data['id']);

    		foreach($spss_item as $k => $v) {
    			$result['sps_item'][] = $v;
    		}

    		$this->data['sps_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('spss/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteSps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$sps_id = $this->input->post('sps_id');

        $response = array();
        if($sps_id) {
            $delete = $this->model_spss->remove($sps_id);
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
	* It gets the product id and fetch the sps data. 
	* The sps print logic is done here 
	*/

	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewSps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$sps_data = $this->model_spss->getSpssData($id);
			$spss_items = $this->model_spss->getSpssItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$sps_date = date('d/m/Y', $sps_data['date_time']);
			$paid_status = ($sps_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
			<style >
			table .warna {
				border-width: 1px;
				padding:8px;
				border-style: solid;
				border-color: #000000;
				background-color: #ffffff;
			}


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
	   
	   
	   <table width="100%" border="0" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:14px"><b> STANDAR PENANGANAN SAMPLE </b></td>
		   </tr>
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      
       <td colspan="2">
           <table width="100%" border ="0" cellpadding="0">
           
           <tr>
               <td  style="font-size:12px" width=15%"> Nama Supplier  </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="65%"></b> '.$sps_data['supplier_name'].' </td>
               <td align="left" style="font-size:12px" width="15%">  </td>
               <td  style="font-size:12px" width="45%"> SPS No. :</td>
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="10%">  </td>
               <td rowspan="2" style="font-size:12px" width="2%">  </td>
               <td rowspan="2" align="left" style="font-size:12px" width="65%"></b> '.$sps_data['customer_address'].' <br /></td>
               <td align="left" style="font-size:12px" width="15%">  </td>
               
               <td  style="font-size:12px" width="45%">Date. : Customer </td> 
               </td>
            </tr>


            <tr>
            
               <td  style="font-size:12px" width="0%"></td>
               <td  style="font-size:12px" width="12%">  </td>
              
            </tr>
            
        
		 </table>
    </table>
           <br /> <b style="font-size:12px" ></b>
       <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
       <thead>
       <tr>
       <th width ="4%" align="center" style="font-size:12px">No.</th>
       <th width="25%"align="center" style="font-size:12px">Nama Barang</th>
       <th width="10%"align="center" style="font-size:12px">Jumlah Barang</th>
       <th width="30%" align="center" style="font-size:12px">Deskripsi Pengetesan</th>
     
       </tr>
	 	</thead>  
	   ';
	$no =0;
	foreach ($spss_items as $k => $v) {

//	$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;
       $output .= '
       <tr>
       <td align="center" style="font-size:11px">'.$no.'</td>
       <td align="center" style="font-size:11px">'.$v['product_id'].'</td>
       <td align="center" style="font-size:11px">'.$v['jumlahbarang'].'</td>
       <td align="left" style="font-size:11px">'.$v['diskripsi'].'</td>
       
       </tr>';
	}
   $output .= '
   
       
       
       
    
       ';
   $output .= '
<table style="font-size:12px" width="100%" border="0" cellpadding="3" cellspacing="0">	
   <tr>
   			<td align ="left" style="font-size:12px" width="35%"></td>
		   <td align ="left" style="font-size:12px" width="35%"></td>
		   <td style="font-size:12px" width="35%" align="center">Dicek</td>
	   		<td align ="center" style="font-size:12px" width="35%">Dicek</td>
	   		<td style="font-size:12px" width="15%" align="center">Diketahui</td>
	   		<td colspan ="2 "style="font-size:16px"  width="30%" align="center">         
			 <b> </b> </td>  
			 <td align ="left" style="font-size:12px" width="35%"></td>
   </tr>

<tr>
	<td align ="left" style="font-size:12px" width="35%"></td>
   	<td align ="left" style="font-size:12px" width="35%"></td>
   	<td rowspan="3" style="font-size:12px" width="35%" align="center"></td>
	<td rowspan="3" align ="left" style="font-size:12px" width="35%"></td>
	<td rowspan="3" style="font-size:12px" width="35%" align="center"></td>       
	</td>
</tr>

<tr>
	
   	
	<td align ="left" style="font-size:12px" width="35%"></td>
   	<td align ="left" style="font-size:12px" width="35%"></td> 
	   <td align ="left" style="font-size:12px" width="35%"></td> 
</tr>

<tr>
		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td align ="left" style="font-size:12px" width="35%"></td>
		   <td align ="left" style="font-size:12px" width="35%"></td>
   		
	   
</tr>
<tr>
		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td style="font-size:12px" width="35%" align="center">(______________)</td>
	   <td align ="center" style="font-size:12px" width="35%">(______________)</td>
	   <td style="font-size:12px" width="35%" align="center">(_______________)</td>
	   <td align ="left" style="font-size:12px" width="35%"></td>
	   
</tr>
<tr>
		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td style="font-size:12px" width="35%" align="center">Produksi</td>
	   <td align ="center" style="font-size:12px" width="35%">Quality Control</td>
	   <td style="font-size:12px" width="35%" align="center">Purchasing</td>
	   <td align ="left" style="font-size:12px" width="35%"></td>
	   
</tr>

</table>




   

<table  style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
    <tr>
	   		<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td style="font-size:12px" width="35%" align="center"></td>
           	<td align ="left" style="font-size:12px" width="35%"></td>
           	<td style="font-size:12px" width="15%" align="center"></td>
           	<td class="warna" colspan ="2 "style="font-size:16px"  width="30%" align="center">         
                 <b> STATUS </b> </td>  
    </tr>

	<tr>
	<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td style="font-size:12px" width="35%" align="center"></td>
   			<td align ="left" style="font-size:12px" width="35%"></td>
   			<td style="font-size:12px" width="35%" align="center"></td>
   			<td class="warna" rowspan="2"style="font-size:24px" border="1" width="20%" align="center">         
		 	<b> OK  </b> </td>
		  	<td class="warna" rowspan="2"style="font-size:24px"  width="20%" align="center">         
			<b>  NG </b> </td>
	</tr>
	<tr>
			<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td style="font-size:12px" width="35%" align="center"></td>
   			<td align ="left" style="font-size:12px" width="35%"></td>
   			<td style="font-size:12px" width="35%" align="center"></td>
   		
	</tr>
</table>
   
   




<table style="font-size:12px" width="100%" border="0" cellpadding="5" cellspacing="0">	
       <tr>
	   <td align ="left" style="font-size:12px" width="35%"></td>
	   		<td align ="left" style="font-size:12px" width="35%"></td>
	   		<td style="font-size:12px" width="35%" align="center"></td>

           <td align ="left" style="font-size:12px" width="35%"></td>
           <td style="font-size:12px" width="15%" align="center"></td>
           <td colspan ="2 "style="font-size:16px"  width="30%" align="center">         
            <b>  </b> </td>  
       </tr>

<tr>
	   <td align ="left" style="font-size:12px" width="35%"></td>
			  <td align ="left" style="font-size:12px" width="35%"></td>
			  <td style="font-size:12px" width="35%" align="center"></td>
				  <td align ="left" style="font-size:12px" width="35%"></td>
				  <td style="font-size:12px" width="35%" align="center"></td>
				  <td rowspan="2"style="font-size:24px"  width="20%" align="center">         
				<b> </b> </td>
			   <td rowspan="2"style="font-size:24px"  width="20%" align="center">         
			   <b>   </b> </td>
</tr>
<tr>
<td align ="left" style="font-size:12px" width="35%"></td>
	   <td align ="left" style="font-size:12px" width="35%"></td>
	   <td style="font-size:12px" width="35%" align="center"></td>
   		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td style="font-size:12px" width="35%" align="center"></td>
   		<td rowspan="2"style="font-size:24px"  width="20%" align="center">         
		 <b> </b> </td>
		<td rowspan="2"style="font-size:24px"  width="20%" align="center">         
		<b>   </b> </td>
</tr>
<tr>
	   <td align ="left" style="font-size:12px" width="35%"></td>
			  <td align ="left" style="font-size:12px" width="35%"></td>
			  <td style="font-size:12px" width="35%" align="center"></td>
				  <td align ="left" style="font-size:12px" width="35%"></td>
				  <td style="font-size:12px" width="35%" align="center"></td>
				  <td rowspan="2"style="font-size:24px"  width="20%" align="center">         
				<b> </b> </td>
			   <td rowspan="2"style="font-size:24px"  width="20%" align="center">         
			   <b>   </b> </td>
</tr>
<tr>
<td align ="left" style="font-size:12px" width="35%"></td>
	   <td align ="left" style="font-size:12px" width="35%"></td>
	   <td style="font-size:12px" width="35%" align="center"></td>
   		<td align ="left" style="font-size:12px" width="35%"></td>
   		<td style="font-size:12px" width="35%" align="center"></td>
   		
</tr>




   </table>
   
   ';

  $output .= '</table>';

			$sps_data = $this->model_spss->getSpssData($id);
			$spss_items = $this->model_spss->getSpssItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}

	}

	public function printDiv($id)
	{
		if(!in_array('viewSps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$sps_data = $this->model_spss->getSpssData($id);
			$spss_items = $this->model_spss->getSpssItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$sps_date = date('d/m/Y', $sps_data['date_time']);
			$paid_status = ($sps_data['paid_status'] == 1) ? "Paid" : "Unpaid";

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
			          <small class="pull-right">Date: '.$sps_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			       
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

			          foreach ($spss_items as $k => $v) {
	
			          	$html .= '<tr>
				            <td>'.$v['product_id'].'</td>
				            
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
			              <td>'.$sps_data['gross_amount'].'</td>
			            </tr>';

			            if($sps_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$sps_data['service_charge_rate'].'%)</th>
				              <td>'.$sps_data['service_charge'].'</td>
				            </tr>';
			            }

			            if($sps_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$sps_data['vat_charge_rate'].'%)</th>
				              <td>'.$sps_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$sps_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$sps_data['net_amount'].'</td>
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