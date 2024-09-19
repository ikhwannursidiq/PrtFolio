<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Fpps extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Fpps';

		$this->load->model('model_fpps');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewFpps', $this->permission)) { //menampilkan tabel rfq manage
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Fpps';
		$this->render_template('fpps/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchFppsData()
	{
		$result = array('data' => array());

		$data = $this->model_fpps->getFppsData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_fpps->countFppsItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewFpps', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('fpps/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('viewFpps', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('fpps/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateFpps', $this->permission)) {
				$buttons .= ' <a href="'.base_url('fpps/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteFpps', $this->permission)) {
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
		if(!in_array('createFpps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Fpps';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$fpp_id = $this->model_fpps->create();
        	
        	if($fpp_id) {
        	//	$this->session->set_flashdata('success', 'Successfully created');
        	//	redirect('fpps/update/'.$fpp_id, 'refresh');
        	//}
        	//else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('fpps/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('fpps/create', $this->data);
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
		if(!in_array('updateFpps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Fpps';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_fpps->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('fpps/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('fpps/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$fpps_data = $this->model_fpps->getFppsData($id);

    		$result['fpp'] = $fpps_data;
    		$fpps_item = $this->model_fpps->getFppsItemData($fpps_data['id']);

    		foreach($fpps_item as $k => $v) {
    			$result['fpp_item'][] = $v;
    		}

    		$this->data['fpp_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('fpps/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteFpp', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$Fpp_id = $this->input->post('Fpp_id');

        $response = array();
        if($Fpp_id) {
            $delete = $this->model_fpps->remove($fpp_id);
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
		if(!in_array('viewFpp', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$fpp_data = $this->model_fpps->getFppsData($id);
			$fpps_items = $this->model_fpps->getFppsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$fpp_date = date('d/m/Y', $fpp_data['date_time']);
			$paid_status = ($fpp_data['paid_status'] == 1) ? "Paid" : "Unpaid";

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
			          <small class="pull-right">Date: '.$fpp_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$fpp_data['bill_no'].'<br>
			        <b>Name:</b> '.$fpp_data['customer_name'].'<br>
			        <b>Address:</b> '.$fpp_data['customer_address'].' <br />
			        <b>Phone:</b> '.$fpp_data['customer_phone'].'
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

			          foreach ($fpps_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['jo']); 
			          	
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
			              <td>'.$fpp_data['gross_amount'].'</td>
			            </tr>';

			            if($fpp_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$fpp_data['service_charge_rate'].'%)</th>
				              <td>'.$fpp_data['service_charge'].'</td>
				            </tr>';
			            }

			            if($fpp_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$fpp_data['vat_charge_rate'].'%)</th>
				              <td>'.$fpp_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$fpp_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$fpp_data['net_amount'].'</td>
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
		if(!in_array('viewFpps', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$fpps_data = $this->model_fpps->getFppsData($id);
			$fpps_items = $this->model_fpps->getFppsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$fpps_date = date('d/m/Y', $fpps_data['date_time']);
			$paid_status = ($fpps_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
	   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	   <tr>
	   <td  align="Left" style="font-size:11px"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>BAG.PRODUKSI</u> </b></td>
	   </tr>
	  
   </table>	  
   </div>
   <br>
	   <table width="100%" border="1" cellpadding="3" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:14px"><b> FORM PERMINTAAN PENGERJAAN </b></td>
		   </tr>
		   
	   </table>	  
		 
		  	   

	<table style="font-size:12px" width="100%" border="1" cellpadding="0" cellspacing="0">	
    <tr>
           <td rowspan ="4" colspan="3" align ="left" style="font-size:12px" width="30%">&nbsp; Hari / Tanggal :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$fpps_data['customer_name'].'<br><br>
		   
		   &nbsp; No. Surat Permintaan Pengerjaan :&nbsp;&nbsp;&nbsp;'.$fpps_data['customer_name'].'<br></td>
           <td style="font-size:12px" colspan="2" width="13%" align="center">Dokumen<br/></td>
           
    </tr>
	<tr>
	   
	   <td style="font-size:12px"  width="12%" align="center">Original</td>
	   <td style="font-size:12px"  width="12%" align="center">Revisi</td>
	   
	</tr>
	<tr>
	  <td style="font-size:12px"  width="12%" align="center"><br><br></td>
	  <td style="font-size:12px"  width="12%" align="center"><br><br></td>
	  
	<tr>
	<td style="font-size:12px"  width="12%" align="center"><br/></td>
	<td style="font-size:12px"  width="12%" align="center"><br/></td>
	
   </table>

           <br /> <b style="font-size:12px" ></b>
       <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
       <thead>
       <tr>
       <th width ="4%" align="CENTER" style="font-size:12px">No.</th>
       <th width="30%"align="center" style="font-size:12px">Keterangan Pengerjaan</th>
       <th width="8%"align="center" style="font-size:12px">QTY</th>
       <th width="8%" align="center" style="font-size:12px">Satuan</th>
       <th width="25%" align="center" style="font-size:12px">Masalah</th>
       <th width="25%" align="center"style="font-size:12px">Area</th> 
       </tr>
		</thead>';
        $no =0;
	foreach ($fpps_items as $k => $v) {

	
		$no++;
  
       $output .= '
       <tr>
       <td align="center" style="font-size:11px">'.$no.'</td>
       <td align="center" style="font-size:11px">'.$v['jo'].'</td>
       <td align="center" style="font-size:11px">'.$v['qty'].'</td>
       <td  align="center" style="font-size:11px">'.$v['satuan'].'</td>
       <td align="center" style="font-size:11px">'.$v['masalah'].'</td>
       <td align="center" style="font-size:11px">'.$v['area'].'</td>   
      
       </tr>
	  



    
</table>';}
   $output .= '
   

  
   <br>
   
   <table style="font-size:12px" width="100%" border="1" cellpadding="0" cellspacing="0">	
    <tr>
           <td rowspan ="3" colspan="3" align ="left" style="font-size:12px" width="35%">&nbsp;Note :<br><br><br><br></td>
           <td style="font-size:11px"  width="12%" align="center">Dibuat<br/></td>
           <td style="font-size:11px"  width="12%" align="center">Diketahui<br/></td>
           <td style="font-size:11px"  width="12%" align="center">Diterima<br/></td>
    </tr>
	<tr>
	   
	   <td style="font-size:11px"  width="12%" align="center"><br><br><br></td>
	   <td style="font-size:11px"  width="12%" align="center"><br><br><br></td>
	   <td style="font-size:11px"  width="12%" align="center"><br><br><br></td>
	</tr>
	<tr>
	  <td style="font-size:11px"  width="12%" align="center"><br/></td>
	  <td style="font-size:11px"  width="12%" align="center"><br/></td>
	  <td style="font-size:11px"  width="12%" align="center"><br/></td>
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
			
			
			
			
			
			
			
			
			
			
			
			
			

			$fpps_data = $this->model_fpps->getFppsData($id);
			$fpps_items = $this->model_fpps->getFppsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}


















































}