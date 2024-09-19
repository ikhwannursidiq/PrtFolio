<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class barangmasuk extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Barang Masuk';

		$this->load->model('model_barangmasuk');
		$this->load->model('model_material');
		$this->load->model('model_inputs');
		$this->load->model('model_konsumens');
		$this->load->model('model_operators');
		$this->load->model('model_company');
		$this->load->model('model_sopirs');
		$this->load->model('model_suppliers');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Data Barang Masuk';
		$this->render_template('barangmasuk/index', $this->data);	
	
	}

	public function stok()
	{
		if(!in_array('createBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Barang Masuk';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$barangmasuk_id = $this->model_barangmasuk->create();
        	
        	if($barangmasuk_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        	//	redirect('fincoming/update/'.$incoming_id, 'refresh');
				redirect('barangmasuk','refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('barangmasuk/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['inputs'] = $this->model_inputs->getActiveInputsData();      	
			$this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();   

            $this->render_template('barangmasuk/stok', $this->data);
        }	
    }	

	public function exportppicok()
	{
		if(!in_array('viewBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Wip';
		$this->render_template('barangmasuk/exportppic', $this->data);	
	}

	public function exportppic()
	{
		if(!in_array('viewBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Wip';
		$this->render_template('barangmasuk/exportppictiga', $this->data);	
	}
	

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	
    public function getKonsumenValueById()
	{
		$id = $this->input->post('id');
		if($id) {
			$konsumen_data = $this->model_konsumens->getKonsumenData($id);
			echo json_encode($konsumen_data);
		}
	}

	public function fetchBarangmasukData()
	{
		$result = array('data' => array());

		$data = $this->model_barangmasuk->getBarangmasukDetailData();

		foreach ($data as $key => $value) {

		//	$supplier = $this->model_suppliers->getSupplierData($value['supplier_id']);

		//	$dat = time('d-m-Y', $value['receiveddate']);
		//	$time = date('h:i a', $value['date_time']);

		   
			//$date_time = $dat;

			// button
			$buttons = '';
			if(in_array('viewBarangmasuk', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('barangmasuk/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
		


			if(in_array('updateBarangmasuk', $this->permission)) {
				$buttons .= ' <a href="'.base_url('barangmasuk/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteBarangmasuk', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$result['data'][$key] = array(
				$value['receiveddate'],
			    $value['waktu'],
				$value['operatorname'],
				$value['supplier_name'],
				$value['pono'],
				$value['name'],
				$value['qty'],
				$value['nolot'],
				$value['hs'],
				$value['tb'],
				$value['eb'],
				$value['sg'],
				$value['kpsw'],
			    $value['skiw'],
				$value['gap'],
			//	$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchLot()
	{
		$result = array('data' => array());

		$data = $this->model_barangmasuk->getLot();

		foreach ($data as $key => $value) {

		//	$count_total_item = $this->model_barangmasuk->countFincomingItem($value['id']);
		//	$date = date('d-m-Y', $value['date_time']);
		//	$time = date('h:i a', $value['date_time']);

		//	$date_time = $date . ' ' . $time;

			// button
		//	$buttons = '';
			if(in_array('viewBarangmasuk', $this->permission)) {
		//		$buttons .= '<a target="__blank" href="'.base_url('fincoming/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
		


			if(in_array('updateBarangmasuk', $this->permission)) {
		//		$buttons .= ' <a href="'.base_url('fincoming/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteBarangmasuk', $this->permission)) {
		//		$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$result['data'][$key] = array(
				$value['datecreated'],
				$value['partno'],
				$value['kodea'],
				$value['kodeb'],
				$value['kodec'],
				$value['qty'],
			//	$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	public function fetchFincomingDetailData()
	{
		$result = array('data' => array());

		$data = $this->model_barangmasuk->getFincomingDetailData();

		foreach ($data as $key => $value) {

		//	$count_total_item = $this->model_barangmasuk->countFincomingItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewBarangmasuk', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('barangmasuk/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			if(in_array('viewBarangmasuk', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('barangmasuk/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-download"></i></a>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(

			    $date_time,
				$value['operatorname'],
				$value['customer_name'],
				$value['partno'],
				$value['nolot'],
				$value['totalcheck'],
				$value['qty'],
				$value['gross_amount'],
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
		if(!in_array('createBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Barang Masuk';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$barangmasuk_id = $this->model_barangmasuk->create();
        	
        	if($barangmasuk_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('barangmasuk','refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('barangmasuk/create/', 'refresh');
        	}
        }
        else {
   
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['inputs'] = $this->model_inputs->getActiveInputsData();      	
	    	$this->data['sopirs'] = $this->model_sopirs->getActiveSopirData(); 
			$this->data['datasupplier'] = $this->model_suppliers->getActiveSuppliers(); 
			$this->data['datacompound'] = $this->model_material->getActiveMaterialCompound();
			$this->data['operator'] = $this->model_operators->getActiveOperatorData();     

            $this->render_template('barangmasuk/create', $this->data);
        }	
	}

	public function umum()
	{
		if(!in_array('createBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Barang Masuk';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$incoming_id = $this->model_barangmasuk->create();
        	
        	if($incoming_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		//redirect('fincoming/update/'.$incoming_id, 'refresh');
				redirect('barangmasuk','refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('barangmasuk/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
        	$this->data['inputs'] = $this->model_inputs->getActiveInputsData();      	
		    $this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();   
		    $this->data['sopirs'] = $this->model_sopirs->getActiveSopirData();         
            $this->render_template('barangmasuk/umum', $this->data);
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
			$material_data = $this->model_material->getMaterialData($product_id);
			echo json_encode($material_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$material = $this->model_material->getActiveMaterialCompound();
		echo json_encode($material);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Incoming';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_barangmasuk->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('barangmasuk/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('barangmasuk/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$incoming_data = $this->model_barangmasuk->getFincomingData($id);

    		$result['incoming'] = $incoming_data;
    		$incoming_item = $this->model_barangmasuk->getFincomingItemData($incoming_data['id']);

    		foreach($incoming_item as $k => $v) {
    			$result['incoming_item'][] = $v;
    		}

    		$this->data['incoming_data'] = $result;

			$this->data['inputs'] = $this->model_inputs->getActiveInputsData();      
        
            $this->render_template('barangmasuk/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$barangmasuk_id = $this->input->post('barangmasuk_id');

        $response = array();
        if($barangmasuk_id) {
            $delete = $this->model_barangmasuk->remove($barangmasuk_id);
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

	public function records()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
    
            $rows = $this->model_barangmasuk->date_range($start_date, $end_date);
        } else {

          $rows = $this->model_barangmasuk->date_range($start_date, $end_date);
        }
        echo json_encode($rows);
		
	}	

	public function dataexportppic()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
       
            $rows = $this->model_barangmasuk->dataexportppic($start_date, $end_date);
        } else {
   
          $rows = $this->model_barangmasuk->dataexportppic($start_date, $end_date);
        }
        echo json_encode($rows);
		
	}

	public function dataexportppicdua()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
       
            $rows = $this->model_barangmasuk->dataexportppicdua($start_date, $end_date);
        } else {
   
          $rows = $this->model_barangmasuk->dataexportppicdua($start_date, $end_date);
        }
        echo json_encode($rows);
		
	}

	public function dataexportppictiga()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
       
            $rows = $this->model_barangmasuk->dataexportppictiga($start_date, $end_date);
        } else {
   
          $rows = $this->model_barangmasuk->dataexportppictiga($start_date, $end_date);
        }
        echo json_encode($rows);
		
	}

	public function getSupplierValueById()
	{
		$id = $this->input->post('id');
		if($id) {
			$supplier_data = $this->model_suppliers->getSupplierData($id);
			echo json_encode($supplier_data);
		}
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/

	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewBarangmasuk', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$fincoming_data = $this->model_barangmasuk->getFincomingData($id);
			$fincoming_items = $this->model_barangmasuk->getFincomingItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

		//	$fincoming_date = date('d/m/Y', $fincoming_data['dtw']);
			$paid_status = ($fincoming_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
			<style >

			@font-face { font-family: Calibri Light; font-weight: normal; src: url(\'fonts/Roboto-Regular.ttf\') format(\'truetype\'); } 
		
			@font-face { font-family: Calibri Light; font-weight: bold; src: url(\'fonts/Roboto-Bold.ttf\') format(\'truetype\'); } 
			body { 
				font-family: calibri, sans-serif; 
				src: url(http://skikom-01/sales/application/third_party/dompdf/fonts/Calibri font/Calibri light/Calibri Light.ttf) format(\'truetype\');
						 
				font-weight: normal; 
				line-height:0.5em; 
				font-size:14pt; 
				border: 0px solid black;
				background-color: ;
				padding-top: 100px;
				padding-right: 10px;
				padding-bottom: 0px;
				padding-left: 10px;
			
			
			}
			h1,h2{ font-family: Roboto Bold, sans-serif; font-weight: bold; line-height:1em; }
			
	
			
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
			 #footer { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
			
			
			@page { 
					margin-top: 10px;
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
					border: 0 mm solid #000000;
					font-variant: small-caps;
				}
			
			
		   </style>
	

	   <table width="100%" border="0" cellpadding="0" cellspacing="0">
		   <tr>
		   <td width ="15%" colspan="" rowspan="3" align="left" style="font-size:12px"><img width="100" height="50" src="assets/images/logo.jpg" /></td>
		   <td width ="70%" colspan="" align="center" style="font-size:18px"><b> PT SHIMADA KARYA INDONESIA</b></td>
		   <td width ="10%" colspan="" align="left" style="font-size:18px"></td>
		   </tr>
		   
		   <tr>
		   <td width ="4%" colspan="" align="center" style="font-size:12px"> JL.Raya Cipacing KM.20, Rancaekek, Sumedang 45363, West Java </td>
		  </tr>
		  <tr>
		   <td width ="4%" colspan="" align="center" style="font-size:12px"> Telp. +62 22 7790015  FAX. +62 22 7792633</td>
		  </tr>
		  <tr>
		   <td width ="4%" colspan="3" align="center" style="font-size:12px">_________________________________________________________________________________________________________________  </td>
		  </tr>
		 
		   
	   </table>	
	   <br><br>


	   
	   <table width="100%" border="0" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:16px"><b> QUALITY CONTROL DEPARTMENT</b></td>
		   </tr>
		   <tr>
		   <td colspan="2" align="center" style="font-size:12px"><b> CHECK BARANG AFTER CHECKING</b></td>
		   </tr>
		   <tr>
		   <td colspan="2" align="center" style="font-size:12px"><b> </b></td>
		   </tr>
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="0" cellpadding="5" cellspacing="3">
      
       <td colspan="2">
           <table width="100%" border ="0" cellpadding="3">
           
          


           
            <tr>
               <td  style="font-size:12px" width="25%"> Delivery Date  </td>
                <td style="font-size:12px" width="35%"> : '.date('d M Y', strtotime($fincoming_data['dtw'])). ' </td>
               <td  style="font-size:12px" width="35%"> </td>
               <td  style="font-size:12px" width="12%"> </td>
              
             
            </tr>

			<tr>
               <td  style="font-size:12px" width="25%"> Customer Name </td>
                <td style="font-size:12px" width="35%"> : '.$fincoming_data['customer_name'].' </td>
               <td  style="font-size:12px" width="35%"> </td>
               <td  style="font-size:12px" width="12%"> </td>
              
             
            </tr>

            <tr>
            <td  style="font-size:12px" width=25%"> PIC Outgoing  </td>
           
            <td  style="font-size:12px" width="35%">: '.$fincoming_data['pic'].'</td>
            <td  style="font-size:12px" width="32%">  </td>
            <td  style="font-size:12px" width="15%"> </td>
         </tr>
        
		 </table>
    </table>
           <br /> <b style="font-size:12px" ></b>
       <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <thead>
       <tr>
       <th width ="4%" align="left" style="font-size:12px">NO.</th>
       <th width="25%"align="center" style="font-size:12px">PART NO</th>
       <th width="20%"align="center" style="font-size:12px">LOT NO</th>
       <th width="10%" align="center" style="font-size:12px">QUANTITY</th>
       <th width="20%" align="center" style="font-size:12px">PIC CHECK</th>
       </tr>
	 	</thead>  
	   ';
	$no =0;
	foreach ($fincoming_items as $k => $v) {

//	$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;
       $output .= '
       <tr>
       <td align="CENTER" style="font-size:12px">'.$no.'</td>
   
       <td  align="CENTER" style="font-size:12px">'.$v['partno'].'</td>
       <td width="10%" align="CENTER" style="font-size:12px">'.$v['nolot'].'</td>
       <td  align="CENTER" style="font-size:12px">'.$v['qty'].'</td>
       <td align="CENTER" style="font-size:12px">'.$v['operatorname'].'</td>   
      
       </tr>';
	}
   $output .= '
   
       <tr >
       <td  align="right" colspan="3" style="font-size:12px"><b>TOTAL QUANTITY </b></td>
       
       <td  align="CENTER" style="font-size:12px"><b>'.$fincoming_data['gross_amount'].'</td>
	   <td  colspan="" style="font-size:12px"><b></b></td>
       </tr>

       
       
    
       ';
   $output .= '
   
   <table style="font-size:12px" width="100%" border="0" cellpadding="5" cellspacing="5">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) 
           </td>
           <td style="font-size:12px" width="35%" align="center">         
               
           
           </td>
   
           <td style="font-size:12px"  width="12%" align="center">         
                   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
           
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
               
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
		   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
               
           
           </td>
       </tr>
   </table>
   
   
   
   <table style="font-size:12px" width="100%" border="0" cellpadding="4" cellspacing="4">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   Received <br />
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
                  PIC QC,<br />
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
                   Approved <br />
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
               <bstyle="font-size:12px"> <b> PIC Gudang</b>
           </td>
           <td style="font-size:11px" width="35%" align="center" >         
               <br />
           </td>
           <td style="font-size:12px"  width="36%" align="center" >         
              <b> BAG. QC OUTGOING  </b>
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
			
			$fincoming_data = $this->model_barangmasuk->getFincomingData($id);
			$fincoming_items = $this->model_barangmasuk->getFincomingItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('data outgoing',array("Attachment" => false));
		}
	


	}



}