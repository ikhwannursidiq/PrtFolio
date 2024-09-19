<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Cutting extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';
		$this->load->model('model_konsumens');
		$this->load->model('model_operators');
		$this->load->model('model_wip');
		$this->load->model('model_items');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Wip';
		$this->render_template('wip/index', $this->data);		
	}


	public function editdelete()
	{
		if(!in_array('viewCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Wip';
		$this->render_template('wip/editdelete', $this->data);		
	}

	public function tampilanexportstok()
	{
		if(!in_array('viewCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Wip';
		$this->render_template('wip/exportstok', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchWipData()
	{
		$result = array('data' => array());

		$data = $this->model_wip->getWipData();

		foreach ($data as $key => $value) {

		//	$count_total_item = $this->model_wip->countItem($value['id']);
		//	$date = date('d-m-Y', $value['date_time']);
		//	$time = date('h:i a', $value['date_time']);

		//	$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewCutting', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('cutting/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			
	      	if(in_array('updateCutting', $this->permission)) {
				$buttons .= ' <a href="'.base_url('cutting/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteCutting', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

		//	if($value['paid_status'] == 1) {
		//		$paid_status = '<span class="label label-success">Paid</span>';	
		//	}
		//	else {
		//		$paid_status = '<span class="label label-warning">Not Paid</span>';
		//	}

			$result['data'][$key] = array(
				$value['datecreated'],
				$value['leader'],
				$value['operatorname'],
				$value['shift'],
			//	$count_total_item,
			//	$value['net_amount'],
			//	$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchSpiData()
	{
		$result = array('data' => array());

		$data = $this->model_wip->getSpiData();

		foreach ($data as $key => $value) {

		//	$count_total_item = $this->model_wip->countItem($value['id']);
		//	$date = date('d-m-Y', $value['date_time']);
		//	$time = date('h:i a', $value['date_time']);

		//	$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewWip', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('wip/printspi/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			
		//	if(in_array('updateWip', $this->permission)) {
		//		$buttons .= ' <a href="'.base_url('wip/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
		//	}

			if(in_array('deleteWip', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

		//	if($value['paid_status'] == 1) {
		//		$paid_status = '<span class="label label-success">Paid</span>';	
		//	}
		//	else {
		//		$paid_status = '<span class="label label-warning">Not Paid</span>';
		//	}

			$result['data'][$key] = array(
				$value['datecreated'],
				$value['leader'],
				$value['operatorname'],
				$value['shift'],
			//	$count_total_item,
			//	$value['net_amount'],
			//	$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchSpiItemData()
	{
		$result = array('data' => array());

	//	$data = $this->model_wip->getSpiData();
	$data = $this->model_wip->getSpiItemData();

		foreach ($data as $key => $value) {

			$customer = $this->model_wip->getSpiData($value['sip_id']);
		//	$date = date('d-m-Y', $value['date_time']);
		//	$time = date('h:i a', $value['date_time']);

		//	$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewWip', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('wip/printspi/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			
		//	if(in_array('updateWip', $this->permission)) {
		//		$buttons .= ' <a href="'.base_url('wip/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
		//	}

			if(in_array('deleteWip', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeSpiFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModalSpi"><i class="fa fa-trash"></i></button>';
				}

		//	if($value['paid_status'] == 1) {
		//		$paid_status = '<span class="label label-success">Paid</span>';	
		//	}
		//	else {
		//		$paid_status = '<span class="label label-warning">Not Paid</span>';
		//	}

			$result['data'][$key] = array(
				$customer['datecreated'],
				$customer['operatorname'],
				$customer['shift'],
			    $value['customer'],
				$value['partno'],
				$value['nolot'],
				$value['qty'],
				
			//	$count_total_item,
			//	$value['net_amount'],
			//	$paid_status,
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
		if(!in_array( 'createCutting' , $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Wip';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
    //    if ($this->form_validation->run() == TRUE) {        	
      
		if ($this->form_validation->run() == TRUE) {
	
			$cek = $this->db->query("SELECT * FROM wip where dateinput='".$this->input->post('dateinput')."' and leader ='".$this->input->post('leader')."' and operatorname ='".$this->input->post('operatorname')."' and gross_amount ='".$this->input->post('total_qty_value')."' and shift ='".$this->input->post('shift')."' ")->num_rows();
			
			if ($cek<=0) {
        	$wip_id = $this->model_wip->create();
			}
        	if($wip_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('cutting', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('cutting/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['items'] = $this->model_items->getActiveItemData();     
			
			$this->data['leader'] = $this->model_operators->getLeaderData(); 
			$this->data['operator'] = $this->model_operators->getOperatorData();   

            $this->render_template('wip/create', $this->data);
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
	public function getItemValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_items->getItemData($product_id);
			echo json_encode($product_data);
		}
	}

	public function getItemDataSpi()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_wip->getItemDataSpi($product_id);
			echo json_encode($product_data);
		}
	}

	public function getValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_wip->getDataWipItem($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableItemRow()
	{
		$items = $this->model_items->getActiveItemData();
		echo json_encode($items);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_wip->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('wip/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('wip/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$wip_data = $this->model_wip->getWipData($id);

    		$result['wip'] = $wip_data;
    		$wip_item = $this->model_wip->getWipItemData($wip_data['id']);

    		foreach($wip_item as $k => $v) {
    			$result['wip_item'][] = $v;
    		}

    		$this->data['wip_data'] = $result;

        	$this->data['items'] = $this->model_items->getActiveItemData();      	

            $this->render_template('wip/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$wip_id = $this->input->post('wip_id');

        $response = array();
        if($wip_id) {
            $delete = $this->model_wip->remove($wip_id);
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

	public function removespi()
	{
		if(!in_array('deleteCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$sip_id = $this->input->post('sip_id');

        $response = array();
        if($sip_id) {
            $delete = $this->model_wip->removespi($sip_id);
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

	public function removespiitem()
	{
		if(!in_array('deleteCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$sip_id = $this->input->post('sip_id');

        $response = array();
        if($sip_id) {
            $delete = $this->model_wip->removespiitem($sip_id);
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


//ambil data untuk spi
public function getdataspi()
{
	//	 $searchTerm = $this->input->post('searchTerm');
//		$response   = $this->model_wip->getcust($searchTerm);
//	   echo json_encode($response);


	$items = $this->model_wip->getAmbilDataSpi();
	echo json_encode($items);
}



	
//ambil data customer
     public function getdatacust()
     {
	      	$searchTerm = $this->input->post('searchTerm');
	     	$response   = $this->model_wip->getcust($searchTerm);
			echo json_encode($response);
	}

//item
	public function getdatacustomeritem($id)
	{
 			$searchTerm = $this->input->post('searchTerm');
 			$response   = $this->model_wip->getcustomeritem($id, $searchTerm);
 			echo json_encode($response);
	}

	public function getItemDataCustomer($id)
	{
			$searchTerm = $this->input->post('searchTerm');
			$response = $this->model_wip->getActiveItemData($id, $searchTerm);
			echo json_encode($response);
	}

	public function records()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
          //  $rows = $this->model_exports->date_range($start_date, $end_date);
         // $rows = $this->model_exports->fetch();
            $rows = $this->model_wip->date_range($start_date, $end_date);
        } 
		//else {
         //   $rows = $this->model_exports->fetch();
          //$rows = $this->model_wip->date_range($start_date, $end_date);
        //}
        echo json_encode($rows);
		
	}

	public function exportstok()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
                $rows = $this->model_wip->exportstok($start_date, $end_date);
        } 
		   echo json_encode($rows);
		
	}

	public function fetchDataStockWipLot()
	{
		$result = array('data' => array());
	
		$data = $this->model_wip->getWipStockLot();
       
		foreach ($data as $key => $value) {

	//	$count_total_item = $this->model_fincoming->countFincomingItem($value['id']);
	//	$customer = $this->model_konsumens->getKonsumenData($value['customer_id']);
	//	$lotsatu = $this->model_inputs->getInputPartnameData($value['id']);
	//	$lotdua = $this->model_inputs->getInputPartnameData($value['id']);
	//	$lottiga = $this->model_inputs->getInputPartnameData($value['id']);
	//	$date = date('d-m-Y', $value['date_time']);
	//	$time = date('h:i a', $value['date_time']);

	//	$date_time = $date . ' ' . $time;

			$buttons = '';
	//	if(in_array('viewFincoming', $this->permission)) {
	//		$buttons .= '<a target="__blank" href="'.base_url('fincoming/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
	//	}
	//	if(in_array('viewFincoming', $this->permission)) {
	//		$buttons .= '<a target="__blank" href="'.base_url('fincoming/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-download"></i></a>';
	//	}

	//	if(in_array('updateFincoming', $this->permission)) {
	//		$buttons .= ' <a href="'.base_url('fincoming/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
	//	}

	//	if(in_array('deleteFincoming', $this->permission)) {
	//		$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
	//	}

	//	if($value['paid_status'] == 1) {
	//		$paid_status = '<span class="label label-success">Paid</span>';	
	//	}
	//	else {
	//		$paid_status = '<span class="label label-warning">Not Paid</span>';
	//	}

			$result['data'][$key] = array(
				$value['datecreated'],
				$value['leader'], 
				$value['operatorname'],  
				
				$value['partno'],
				$value['nolot'],
				$value['qty'],
				$buttons
			);
		} // /foreach


		echo json_encode($result);
		

	}

    public function fetchDataStockWip()
	{
		$result = array('data' => array());
	
		$data = $this->model_wip->getWipStock();
       
		foreach ($data as $key => $value) {

	//	$count_total_item = $this->model_fincoming->countFincomingItem($value['id']);
	//	$customer = $this->model_konsumens->getKonsumenData($value['customer_id']);
	//	$lotsatu = $this->model_inputs->getInputPartnameData($value['id']);
	//	$lotdua = $this->model_inputs->getInputPartnameData($value['id']);
	//	$lottiga = $this->model_inputs->getInputPartnameData($value['id']);
	//	$date = date('d-m-Y', $value['date_time']);
	//	$time = date('h:i a', $value['date_time']);

	//	$date_time = $date . ' ' . $time;

			$buttons = '';
	//	if(in_array('viewFincoming', $this->permission)) {
	//		$buttons .= '<a target="__blank" href="'.base_url('fincoming/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
	//	}
	//	if(in_array('viewFincoming', $this->permission)) {
	//		$buttons .= '<a target="__blank" href="'.base_url('fincoming/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-download"></i></a>';
	//	}

	//	if(in_array('updateFincoming', $this->permission)) {
	//		$buttons .= ' <a href="'.base_url('fincoming/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
	//	}

	//	if(in_array('deleteFincoming', $this->permission)) {
	//		$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
	//	}

	//	if($value['paid_status'] == 1) {
	//		$paid_status = '<span class="label label-success">Paid</span>';	
	//	}
	//	else {
	//		$paid_status = '<span class="label label-warning">Not Paid</span>';
	//	}

			$result['data'][$key] = array(
				$value['datecreated'],
				$value['leader'], 
				$value['operatorname'],  
				
				$value['name'],
				$value['lots'],
				$value['stokin'],
				$buttons
			);
		} // /foreach


		echo json_encode($result);
		

	}



	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/

	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewCutting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$wip_data = $this->model_wip->getWipData($id);
			$wip_items = $this->model_wip->getWipItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			 $wip_dat = date(' d-m-Y', $wip_data['date_time']);
			// $paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
			<style >
			@page { 
					margin-top: 100px;
					margin-bottom: 10px;
					margin-right: 10px;
					margin-left: 10px;		
			}
			 #header { position: fixed; left: 10px; top: -100px; right: 0px; height: 10px; background-color: ; text-align: center; }
			
			 @font-face {
				font-family: "source_sans_proregular";           
				src: local("Source Sans Pro"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype");
				font-weight: normal;
				font-style: normal;
	
			}        
		

			
		body {
		  border: 0px solid black;
		  background-color: ;
		  padding-top: 10px;
		  padding-right: 10px;
		  padding-bottom: 10px;
		  padding-left: 10px;
		  font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;    
		}
		
		
		 th { 
			        background-color: #a9a9a9 ;
					text-align: center;
					border: 1px solid #000000;
					font-variant: small-caps;
				}


				table .warna {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #ffffff;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #ffffff;
					padding: 0px;
					
					
				}

				table .ab {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #000000;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #000000;
					padding: 0px;
					
					
				}

				table .b {
		
					border-top:    1px solid   #000000;
					border-right:  1px solid  #000000;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #000000;
					padding: 0px;
					
					
				}

				table .a {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #000000;
					border-bottom: 1px solid   #000000;
					border-left:   1px solid  #000000;
					padding: 0px;
					
					
				}

				
			
			
		   </style>
	 <div id="header">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		   <td colspan="" align="center" style="font-size:12px" ><b> </b></td>
		   <td colspan="" align="center" style="font-size:14px"  ><b></b></td>
		   <td colspan="" align="center" style="font-size:14px"  ><b></b></td>
		   <td colspan="" align="center" style="font-size:14px"  ><b></b></td>
		   <td colspan="" align="center" style="font-size:8px" width="15%" ><b>FR PROD 01</b></td>
		</tr>
		<tr>
		   <td colspan="" align="center" style="font-size:12px" ><b> </b></td>
		   <td colspan="" align="center" style="font-size:14px"  ><b></b></td>
		   <td colspan="" align="center" style="font-size:14px"  ><b></b></td>
		   <td colspan="" align="center" style="font-size:14px"  ><b></b></td>
		   <td colspan="" align="center" style="font-size:8px"  width="15%" ><b>Ed/Rev 01/00</b></td>
		</tr>
		<tr>
		    <td rowspan="2" align="left" style="font-size:14px" width="15%"><img width="80" height="50" src="assets/images/logo.jpg" /></td>
		    <td colspan="3" align="center" style="font-size:18px" width="35%"><b> PT SHIMADA KARYA INDONESIA</b></td>
		    <td colspan="" align="center" style="font-size:14px" width="10%"><b></b></td>
		</tr>
		<tr>
		   <td colspan="3" align="center" style="font-size:12px" width="35%"><b> LAPORAN HASIL CUTTING</b></td>
		   <td colspan="" align="center" style="font-size:14px" width="10%" ><b></b></td>
		</tr>
	
	   </table>	  
	</div>  	  	   

   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      
       <tr>
               <td  style="font-size:12px" width=15%"> Hari / Tanggal   </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="40%"></b>'.$wip_dat.' </td>
               <td align="left" style="font-size:12px" width="15%"> </td>
              
			   <td  style="font-size:12px" width="15%"></b> Operator </td>
			   <td  style="font-size:12px" width="2%">: </td>
			   <td  style="font-size:12px" width="25%"></b> '.$wip_data['operatorname'].' </td>
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="15%"> Ketua Group  </td>
               <td rowspan="2" style="font-size:12px" width="2%"> : </td>
               <td rowspan="2" align="left" style="font-size:12px" width="65%"></b>  '.$wip_data['leader'].' <br /></td>
               <td align="left" style="font-size:12px" width="15%">  </td>
			   <td  style="font-size:12px" width="15%">Shift</td>
               <td  style="font-size:12px" width="2%">: </td>
			   <td  style="font-size:12px" width="25%"></b> '.$wip_data['shift'].' </td>
               
            </tr>
    </table>
       <table width="100%" border="1" cellpadding="2" cellspacing="0">
       <thead>
       <tr>
            <th rowspan="2" width ="4%" align="center"  style="font-size:12px">NO.</th>
            <th rowspan="2" width="20%"align="center" style="font-size:12px">PART NO</th>
            <th rowspan="2" width="20%"align="center" style="font-size:12px">LOT NO.</th>
            <th colspan ="3" width="24%" align="center" style="font-size:12px">SUMMARY</th>
            <th rowspan="2"  colspan="2" width="15%" align="center"style="font-size:12px">KETERANGAN</th> 
       </tr>

	   <tr>
	        <th width ="5%" align="center"  style="font-size:12px">OK</th>
	        <th  width="5%"align="center" style="font-size:12px">NG</th>
	        <th width="5%"align="center" style="font-size:12px">TOTAL</th>
      </tr>
	  </thead>  
	   ';
	$no =0;
	foreach ($wip_items as $k => $v) {

	$product_data = $this->model_items->getItemData($v['product_id']); 
		$no++;
       $output .= '
       <tr>
       <td align="center" style="font-size:11px">'.$no.'</td>
       <td align="center"  style="font-size:11px">'.$product_data['name'].'</td>
       <td align="center"  style="font-size:11px">'.$v['nolot'].'</td>
	   <td align="center"  style="font-size:11px">'.$v['qtyawal'].'</td>
	   <td align="center"  style="font-size:11px"></td>
	   <td align="center"  style="font-size:11px"></td>
       <td align="center" colspan="2"  style="font-size:11px">'.$v['note'].'</td>   
      
       </tr>';
	}
   $output .= '
   
       <tr >
       <td align="center" colspan="3" style="font-size:12px"><b>TOTAL</b></td>
       <td align="center" style="font-size:12px"><b></b> '.$wip_data['gross_amount'].'</td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" colspan="2" style="font-size:12px"><b></b></td>
	   
       </tr>


	   <tr >
       <td align="center" colspan="8" style="font-size:10px"><b></b></td>
       </tr>

	   <tr >
       <td class="b"  align="Left" colspan="5" style="font-size:10px"><b>Note :</b></td>
       <td class="a" align="center" style="font-size:10px">Diketahui,</td>
	   <td class="a" align="center" style="font-size:10px">Diperiksa,</td>
	   <td class="a" align="center" style="font-size:10px">Dibuat,</td>
	  
       </tr>

	   <tr >
	   <td class="ab"  align="Left" colspan="5" style="font-size:10px"><b</b></td>
       <td class="ab" align="right" style="font-size:10px"><b><br></b></td>
	   <td class="ab" align="right" style="font-size:10px"><b><br></b></td>
	   <td class="ab" align="right" style="font-size:10px"><b><br></b></td>
       </tr>

	   <tr >
	   <td class="ab"  align="Left" colspan="5" style="font-size:10px"><b></b></td>
       <td class="ab" align="right" style="font-size:10px"><b><br></b></td>
	   <td class="ab" align="right" style="font-size:10px"><b><br></b></td>
	   <td class="ab" align="right" style="font-size:10px"><b><br></b></td>
       </tr>

	   <tr >
	   <td class="ab"  align="Left" colspan="5" style="font-size:10px"><b></b></td>
       <td class="a" align="center" style="font-size:10px"><b></b>Kabag</td>
	   <td class="a" align="center" style="font-size:10px"><b></b>Leader</td>
	   <td class="a" align="center" style="font-size:10px"><b></b>Operator</td>
       </tr>

	   <tr >
	   <td class="a"  align="Left" colspan="5" style="font-size:10px"><b></b></td>
       <td class=""align="right" style="font-size:10px" width="8%"><b><br></b></td>
	   <td align="right" style="font-size:10px" width="8%"><b><br></b></td>
	   <td align="right" style="font-size:10px" width="8%" ><b><br></b></td>
       </tr>
       
    
       ';
   $output .= '
     
   <div id="footer">
   
   </div>';
       
   

  
  
  $output .= '</table>';
			
		
			

			$wip_data = $this->model_wip->getWipData($id);
			$wip_items = $this->model_wip->getWipItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}

	public function printspi($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewWip', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$sip_data = $this->model_wip->getSpiData($id);
			$sip_items = $this->model_wip->getSipItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$sipdate = $sip_data['datecreated'];
		    $sip =  date('d F Y', strtotime($sipdate));
			
			// $paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
			<style >
			@font-face { font-family: Calibri Light; font-weight: normal; src: url(\'fonts/Roboto-Regular.ttf\') format(\'truetype\'); } 
		
		@font-face { font-family: Calibri Light; font-weight: bold; src: url(\'fonts/Roboto-Bold.ttf\') format(\'truetype\'); } 
		body { 
			font-family: calibri, sans-serif; 
			src: url(http://skikom-01/sales/application/third_party/dompdf/fonts/Calibri font/Calibri light/Calibri Light.ttf) format(\'truetype\');
			         
			font-weight: normal; 
			line-height:0.7em; 
			font-size:14pt; 
			border: 0px solid black;
			background-color: ;
			padding-top: 10px;
			padding-right: 10px;
			padding-bottom: 0px;
			padding-left: 10px;
		
		
		}
		h1,h2{ font-family: Roboto Bold, sans-serif; font-weight: bold; line-height:1em; }
		

		@page { 
				margin-top: 5px;
				margin-bottom: 0px;
				margin-right: 10px;
				margin-left: 10px;		
		}
		 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
		 #footer { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
		


	header {
		position: fixed;
		top: 0cm;
		left: 0cm;
		right: 0cm;
		height: 2cm;
		padding: 10px;
	}

	/** Define the footer rules **/
	footer {
		position: fixed; 
		bottom: 0cm; 
		left: 0cm; 
		right: 0cm;
		height: 1cm;
	}

	table.section1 {
	   
		border-spacing: 0px;
		border-style: solid;
		border-color: black;
		text-align: right;
		   
	   
		}
	table .warna {
		
		border-top:    1px solid  #ffffff;
	    border-right:  1px solid  #ffffff;
	    border-bottom: 1px solid  #ffffff;
	    border-left:   1px solid  #ffffff;
		padding: 0px;
		
		
	}
	table.ukuran{
		width: 100%;
	
	  } 

				table .note{
					border-top:    1px solid  #ffffff;
					border-right:  1px solid #000000;
					border-bottom: 1px solid #ffffff;
					border-left:   1px solid  #000000;
					}
					table .notedasar{
						border-top:    1px solid  #000000;
						border-right:  1px solid #ffffff;
						border-bottom: 1px solid #ffffff;
						border-left:   1px solid  #ffffff;
						}
					table .warna2{
						border-top:    1px solid  #000000;
						border-right:  1px solid #000000;
						border-bottom: 1px solid #ffffff;
						border-left:   1px solid  #000000;
						}

						table .warna3{
							border-top:    1px solid  #ffffff;
							border-right:  1px solid #000000;
							border-bottom: 1px solid #ffffff;
							border-left:   1px solid  #000000;
							}

							table .warna4{
								border-top:    1px solid  #ffffff;
								border-right:  1px solid #000000;
								border-bottom: 1px solid #000000;
								border-left:   1px solid  #000000;
								}

								table .warna5{
									border-top:    1px solid  #ffffff;
									border-right:  1px solid #000000;
									border-bottom: 1px solid #ffffff;
									border-left:   1px solid  #000000;
									}
									table .warna6 {
		
										border-top:    1px solid  #ffffff;
										border-right:  1px solid  #000000;
										border-bottom: 1px solid  #ffffff;
										border-left:   1px solid  #ffffff;
										padding: 0px;
										
										
									}

									table .warna7{
										border-top:    1px solid  #ffffff;
										border-right:  1px solid #000000;
										border-bottom: 1px solid #000000;
										border-left:   1px solid  #000000;
										}
							

							td.test2 {
								writing-mode: vertical-rl; 
							  }

							  
							p.test2 {
								writing-mode: vertical-rl; 
							  }
					
	
		
	</style>
	   
	   
	   <table width="100%" border="0" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:14px"><b> SURAT PERINTAH INSPEKSI (SPI) </b></td>
		   </tr>
		   <tr>
		   <td colspan="2" align="center" style="font-size:14px"><b></b></td>
		   </tr>
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      
           <tr>
               <td  style="font-size:12px" width=20%">Tanggal Inspeksi   </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="65%"></b> '.$sip.' </td>
            </tr>
            <tr>
               <td  style="font-size:12px" width="10%"> PIC </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td align="left" style="font-size:12px" width="65%"></b>  '.$sip_data['operatorname'].' <br /></td>
            </tr>
			<tr>
			<td  style="font-size:12px" width="10%"> Shift</td>
			<td style="font-size:12px" width="2%"> : </td>
			<td align="left" style="font-size:12px" width="65%"></b>  '.$sip_data['shift'].' <br /></td>
		 </tr>
    </table>
<br>
    <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
       <thead>
       <tr>
       <th rowspan="2"  width ="4%" align="center"  style="font-size:10px">NO.</th>
	   <th rowspan="2"   width="15%"align="center" style="font-size:10px">CUSTOMER</th>
       <th rowspan="2"  width="15%"align="center" style="font-size:10px">PART NO</th>
       <th rowspan="2"  width="6%"align="center" style="font-size:10px">QTY</th>
       <th rowspan="2"  width="6%" align="center" style="font-size:10px">CT/PC</th>
       <th rowspan="2"  width="8%" align="center" style="font-size:10px">TOTAL</th>
	   <th rowspan="2"  width="10%" align="center" style="font-size:10px">TOTAL JAM KERJA</th>
       <th colspan="2"width="15%" align="center"style="font-size:10px">Status</th> 
	   <th rowspan="2"  width="20%" align="center" style="font-size:10px">Alasan Tidak Tercapai</th>
       </tr>

	   <tr>
	   <th   width="7%" align="center" style="font-size:10px">Tercapai</th>
       <th   width="8%" align="center"style="font-size:10px">Tidak Tercapai</th> 
	   </tr>


	 	</thead>  
	   ';
	$no =0;
	foreach ($sip_items as $k => $v) {

	//$product_data = $this->model_items->getItemData($v['product_id']); 
		$no++;
       $output .= '
       <tr>
       <td align="center" style="font-size:10px">'.$no.'</td>
       <td align="center"  style="font-size:10px">'.$v['customer'].'</td>
       <td align="center"  style="font-size:10px">'.$v['partno'].'</td>
       <td width="5%" align="center"  style="font-size:10px">'.$v['qty'].'</td>
	   <td width="5%" align="center"  style="font-size:10px">'.$v['rate'].'</td>
	   <td width="8%" align="center"  style="font-size:10px">'.$v['amount'].'</td>
	   <td width="10%" align="center"  style="font-size:10px">'.$v['totaljamkerja'].'</td>
	   <td width="6%" align="center"  style="font-size:10px"></td>
	   <td width="6%" align="center"  style="font-size:10px"></td>
       <td  class="warna3" align="center"  style="font-size:10px"></td>   
       </tr>';
	}
   $output .= '
   
       <tr >
       <td align="center" colspan="3" style="font-size:12px"><b>TOTAL</b></td>
       <td align="center" style="font-size:12px"><b></b> '.$sip_data['gross_amount'].'</td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td  class="warna3" align="right" style="font-size:12px"><b></b></td>
       </tr>

	   <tr >
       <td align="center" colspan="6" style="font-size:12px"><b>TOTAL</b></td>
       <td align="center" style="font-size:12px"><b></b> '.$sip_data['net_amount'].'</td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td align="right" style="font-size:12px"><b></b></td>
	   <td  class="warna7" align="right" style="font-size:12px"><b></b></td>
	
       </tr>
       
    
       ';
   $output .= '
   
    
   <table style="font-size:12px" width="100%" border="1" cellpadding="0" cellspacing="0">	
   <tr>
   <td class="warna" align ="left" style="font-size:12px" width="35%">
	  
   </td>
   <td class="warna" style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td colspan="3" style="font-size:12px"  width="12%" align="left">         
   &nbsp;Cipacing, <br />
   
   
  
</tr>
       <tr>
           <td class="warna" align ="left" style="font-size:12px" width="35%">
              
           </td>
           <td class="warna" style="font-size:12px" width="35%" align="center">         
              <br />
           
           </td>
   
           <td style="font-size:12px"  width="12%" align="center">         
                   Dibuat<br />
           
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
                   Dicek<br />
               
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
                   Disetujui<br />
               
           
           </td>
       </tr>
	   
	 
	   <tr>
	   <td class="warna" align ="left" style="font-size:12px" width="35%">
		  
	   </td>
	   <td class="warna6" style="font-size:12px" width="35%" align="center">         
		  <br />
	   
	   </td>

	   <td  class="warna5"  style="font-size:12px"  width="12%" align="center">         
			   <br />
	   
	   
	   </td>
	   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
			   <br />
		   
	   
	   </td>
	   <td  class="warna3" style="font-size:12px"  width="12%" align="center">         
			   <br />
		   
	   
	   </td>
   </tr>
  
<tr>
   <td class="warna" align ="left" style="font-size:9px" width="35%">
	<b>  Note : </b>
   </td>

   <td class="warna6" style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td  class="warna3"  style="font-size:12px"  width="12%" align="center">         
		  <br />
   
   
   </td>
   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
		  <br />
	   
   
   </td>
   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
		  <br />
	   
   
   </td>
</tr>

<tr>
   <td  class="warna" align ="left" style="font-size:8px" width="35%">
   &nbsp;<b  style="font-size:8px">1. Pastikan lakukan pengecekan sesuai SPI</b> 
   </td>
   <td class="warna6"  style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td  class="warna3"  style="font-size:12px"  width="12%" align="center">         
		   <br />
   
   
   </td>
   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
</tr>

<tr>
   <td class="warna"  align ="left"  style="font-size:8px" width="35%">
   &nbsp;<b  style="font-size:8px">2. Patuhi SOP Pengecekan</b>  
   </td>
   <td class="warna6" style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td class="warna4" style="font-size:12px"  width="12%" align="center">         
		   <br />
   
   
   </td>
   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
   <td class="warna3" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
</tr>

<tr>
   <td  class="warna" align ="left" style="font-size:12px" width="45%">
   &nbsp;<b  style="font-size:8px">3. Buat laporan hasil pengecekan</b>
   </td>
   <td class="warna6" style="font-size:12px" width="25%" align="center">         
	  <br />
   
   </td>

   <td class="" style="font-size:12px"  width="12%" align="center">         
		   <br />
   
   
   </td>
   <td class="" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
   <td class="" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
</tr>

<tr>
   <td class="warna"  align ="left" style="font-size:12px" width="35%">
   &nbsp;<b  style="font-size:8px">4. Beri identitas jelas pada box untuk part OK dan NG</b>
   </td>
   <td class="warna" style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td style="font-size:12px"  width="12%" align="center">         
		   Admin<br />
   
   
   </td>
   <td style="font-size:12px"  width="12%" align="center">         
		   Leader<br />
	   
   
   </td>
   <td style="font-size:12px"  width="12%" align="center">         
		   Head QC<br />
	   
   
   </td>
</tr>


<tr>
   <td  class="warna"  align ="left" style="font-size:12px" width="35%">
   &nbsp;<b  style="font-size:8px">5. Informasi ke leader / atasan jika ada kendala saat bekerja</b>  </td>
   <td class="warna" style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td class="warna" style="font-size:12px"  width="12%" align="center">         
		   <br />
   
   
   </td>
   <td class="warna"  style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
   <td  class="warna" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
</tr>

<tr>
   <td  class="warna"  align ="left" style="font-size:12px" width="35%">
   &nbsp;<b  style="font-size:8px">6. Planing ini sewaktu-waktu berubah menunggu informasi dari leader</b>  </td>
   <td class="warna" style="font-size:12px" width="35%" align="center">         
	  <br />
   
   </td>

   <td class="warna" style="font-size:12px"  width="12%" align="center">         
		   <br />
   
   
   </td>
   <td class="warna" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
   <td  class="warna" style="font-size:12px"  width="12%" align="center">         
		   <br />
	   
   
   </td>
</tr>










	   
   </table>
   
   
   <br class="warna">
   </tr>';
       
	  

  
  
  $output .= '</table>';
			
		
			

			$sip_data = $this->model_wip->getSpiData($id);
			$sip_items = $this->model_wip->getSipItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}


	public function fetchWipItemData()
	{
		$result = array('data' => array());

		$data = $this->model_wip->getWipJoinData();

		foreach ($data as $key => $value) {

		//	$count_total_item = $this->model_wip->countItem($value['id']);
		//	$date = date('d-m-Y', $value['date_time']);
		//	$time = date('h:i a', $value['date_time']);

		//	$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
		//	if(in_array('viewCutting', $this->permission)) {
		//		$buttons .= '<a target="__blank" href="'.base_url('cutting/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
		//	}
			
	     // 	if(in_array('updateCutting', $this->permission)) {
		//		$buttons .= ' <a href="'.base_url('cutting/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
		//	}

		//	if(in_array('deleteCutting', $this->permission)) {
		//		$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
		//	}

		//	if($value['paid_status'] == 1) {
		//		$paid_status = '<span class="label label-success">Paid</span>';	
		//	}
		//	else {
		//		$paid_status = '<span class="label label-warning">Not Paid</span>';
		//	}

			$result['data'][$key] = array(
				
				$value['datecreated'],
				$value['leader'],
				$value['operatorname'],
				$value['shift'],
				$value['partno'],
				$value['qtyawal'],
			
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


}