<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Poumum extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Poumum';

		$this->load->model('model_poumum');
		$this->load->model('model_products');
        $this->load->model('model_vroducts');
		$this->load->model('model_company');
       
	}

	/* 
	* It only redirects to the manage poumum page
	*/
	public function index()
	{
		if(!in_array('viewPoumum', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Poumum';
		$this->render_template('poumum/index', $this->data);		
	}

	/*
	* Fetches the poumum data from the poumum table 
	* this function is called from the datatable ajax function
	*/
	public function fetchPoumumData()
	{
		$result = array('data' => array());

		$data = $this->model_poumum->getPoumumData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_poumum->countPoumumItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewPoumum', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('poumum/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
		//	if(in_array('viewPoumum', $this->permission)) {
		//		$buttons .= '<a target="__blank" href="'.base_url('poumum/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
		//	}

			if(in_array('updatePoumum', $this->permission)) {
				$buttons .= ' <a href="'.base_url('poumum/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deletePoumum', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
                $value['customer_name'],
				$value['pono'],	
				$count_total_item,
				$value['attn'],
				$value['net_amount'],	
				$date_time,
				$value['deliverydate'],
				$paid_status,
				$value['date_closed'],
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
		if(!in_array('createPoumum', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Poumum';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		$this->form_validation->set_rules('customer[]', 'customer', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$poumum_id = $this->model_poumum->create();
        	
        	if($poumum_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('poumum/update/'.$poumum_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('poumum/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();    
//menampilkan data supplier  	
            $this->data['vroducts'] = $this->model_vroducts->getActiveVroductData(); 
            $this->render_template('poumum/create', $this->data);
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


    public function getVroductValueById()
	{
		$vroduct_id = $this->input->post('vroduct_id');
		if($vroduct_id) {
			$vroduct_data = $this->model_vroducts->getVroductData($vroduct_id);
			echo json_encode($vroduct_data);
		}
	}
	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the poumum page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

//ambil data supplier /customer
    public function getTableVroductRow()
	{
		$vroducts = $this->model_vroducts->getActiveVroductData();
		echo json_encode($vroducts);
	}

	/*
	* If the validation is not valid, then it redirects to the edit poumum page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updatePoumum', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Poumum';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_poumum->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('poumum/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('poumum/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$poumum_data = $this->model_poumum->getPoumumData($id);

    		$result['poumum'] = $poumum_data;
    		$poumum_item = $this->model_poumum->getPoumumItemData($poumum_data['id']);

    		foreach($poumum_item as $k => $v) {
    			$result['poumum_item'][] = $v;
    		}

    		$this->data['poumum_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
            $this->data['vroducts'] = $this->model_vroducts->getActiveVroductData(); 
          
            $this->render_template('poumum/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deletePoumum', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$poumum_id = $this->input->post('poumum_id');

        $response = array();
        if($poumum_id) {
            $delete = $this->model_poumum->remove($poumum_id);
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
	* It gets the product id and fetch the poumum data. 
	* The poumum print logic is done here 
	*/
	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$poumum_data = $this->model_poumum->getPoumumData($id);
			$poumum_items = $this->model_poumum->getPoumumItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $poumum_data['date_time']);
			$paid_status = ($poumum_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
       <td colspan="2" align="center" style="font-size:16px"><b> PURCHASE ORDER </b></td>
       </tr>
       
   </table>	  
     
             

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
   <td colspan="2">
       <table width="100%" border ="0" cellpadding="0">
       
       <tr>
           <td  style="font-size:12px" width=10%"> To   </td>
           <td  style="font-size:12px" width=2%"> :  </td>
           <td  style="font-size:12px" width="85%"></b> '.$poumum_data['customer_name'].' </td>
           <td align="left" style="font-size:12px" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PO No. </td>
           <td  style="font-size:12px" width="40%">: '.$poumum_data['pono'].'  </td>
        </tr>
        <tr>
           <td rowspan="2" style="font-size:12px" width="10%">  </td>
           <td rowspan="2" style="font-size:12px" width="2%">  </td>
           <td rowspan="2" align="left" style="font-size:12px" width="75%"></b> '.$poumum_data['customer_address'].' <br /></td>
           <td align="left" style="font-size:12px" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PO Date. </td>
           
           <td  style="font-size:12px" width="40%">: '.$poumum_data['deliverydate'].' </td> 
           </td>
        </tr>


        <tr>
        
           <td  style="font-size:12px" width="0%"></td>
           <td  style="font-size:12px" width="12%">  </td>
          
        </tr>
        <tr>
           <td  style="font-size:12px" width="10%"> Telp  </td>
           <td style="font-size:12px" width="2%"> : </td>
           <td  style="font-size:12px" width="85%">'.$poumum_data['customer_phone'].'</td>
           <td  style="font-size:12px" width="12%"> </td>
           <td  style="font-size:12px" width="45%"> </td> 
           </td>
        </tr>

        <tr>
           <td  style="font-size:12px" width=10%"> Fax   </td>
           <td style="font-size:12px" width="2%"> : </td>
           <td  style="font-size:12px" width="85%">'.$poumum_data['fax'].'</td>
           <td  style="font-size:12px" width="12%">  </td>
           <td  style="font-size:12px" width="45%"> </td>
        </tr>
        
        
        <tr>
        <td  style="font-size:12px" width=10%"> Attn   </td>
        <td  style="font-size:12px" width="2%"> : </td>
        <td  style="font-size:12px" width="85%">'.$poumum_data['attn'].'</td>
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
   <th width="40%"align="center" style="font-size:12px">Description</th>
   <th width="10%"align="center" style="font-size:12px">Qty</th>
   <th width="8%" align="center" style="font-size:12px">Unit</th>
   <th colspan ="2" width="20%" align="center" style="font-size:12px">Unit Price</th>
   <th width="20%" align="center" style="font-size:12px">Amount</th>
   <th width="20%" align="center"style="font-size:12px">Note</th> 
   </tr>
    </thead>';
    $no =0;
	foreach ($poumum_items as $k => $v) {

	$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;
  
       $output .= '
       <tr>
       <td align="left" style="font-size:11px">'.$no.'</td>
     <td class="empty" width="30%"align="left" style="font-size:11px"><span align="right" style="color:blue;font-weight:bold">'.$product_data['description'].' </span></td>  
     <td width="10%" align="right" style="font-size:11px">'.$v['qty'].'</td> 
     <td width="10%" align="right" style="font-size:11px">'.$v['unit'].'</td>
       <td width="15%"align="right" style="font-size:11px">'.$v['rate'].'</td>
	   <td width="7%"align="left" style="font-size:11px">/KG</td>  
       <td align="left" style="font-size:11px">'.$v['amount'].'</td>   
       <td align="left" style="font-size:11px">'.$v['note'].'</td>

       </tr>';
    }
   $output .= '
   
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
   
    <tr >
       <td align="left" colspan="3" style="font-size:12px"><b>Delivery Date :</b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td width="15%" align="left" style="font-size:12px"><b>SUB TOTAL</b></td>
	   <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
       <td width="12%" align="right" style="font-size:12px"><b>'.$poumum_data['gross_amount'].'</b></td>
     
    
	</tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b>Tgl.'.$poumum_data['deliverydate'].'</b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b>PPN (10 %)</b></td>
	   <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
       <td width="12%" align="right" style="font-size:12px"><u><b>'.$poumum_data['vat_charge'].'</b></u></td>
       </tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b>TOTAL</b></td>
	   <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
       <td width="12%"align="right" style="font-size:12px"><b>'.$poumum_data['net_amount'].'</b></td>
       </tr>
       <tr>
       <td align="left" colspan="3" style="font-size:12px"></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="12%"align="right" style="font-size:12px"><b></b></td>
       </tr> 
	


	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr >
       
       <td align="right" style="font-size:12px"> </td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td  align="left" style="font-size:12px"><b></b></td>
	   <td align="left" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
    </tr>
	 
	</table> ';
    $output .= '
    
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
   
    <tr >
       <td align="left" colspan="3" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td width="15%" align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%" align="right" style="font-size:12px"><b></b></td>
     
    
	</tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b>Payment term :</b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%" align="right" style="font-size:12px"></td>
       </tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b>Note :</b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%"align="right" style="font-size:12px"><b></b></td>
       </tr>
       <tr>
       <td align="left" colspan="3" style="font-size:12px">Delivery time :</td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%"align="right" style="font-size:12px"><b></b></td>
       </tr> 

       <tr>
       <td align="left" colspan="3" style="font-size:12px">: Pagi ( pkl. 08.00 - 10.00 wib )</td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%"align="right" style="font-size:12px"><b></b></td>
       </tr> 

       <tr>
       <td align="left" colspan="3" style="font-size:12px">: Siang ( pkl. 13.00 - 14.00 wib )</td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%"align="right" style="font-size:12px"><b></b></td>
       </tr> 

       <tr>
       <td align="left" colspan="3" style="font-size:12px">: Sore ( pkl. 15.00 - 16.00 wib )</td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
	   <td width="3%"align="right" style="font-size:12px"><b></b></td>
       <td width="20%"align="right" style="font-size:12px"><b></b></td>
       </tr> 
	


	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr >
       
       <td align="right" style="font-size:12px"> </td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td  align="left" style="font-size:12px"><b></b></td>
	   <td align="left" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b></b></td>
    </tr>
	 
	</table>




    <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) 
           </td>
           <td style="font-size:12px" width="35%" align="center">         
               
           
           </td>
   
           <td style="font-size:12px"  width="12%" align="center">         
                   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
           
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
		   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
               
           
           </td>
           <td style="font-size:12px"  width="12%" align="center">         
		   (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
               
           
           </td>
       </tr>
   </table>
   
   
   
   <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   Accepted by,<br />
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
                  Ordered by,<br />
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
                   Approved by,<br />
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
               <bstyle="font-size:12px">'.$poumum_data['customer_name'].'</b>
           </td>
           <td style="font-size:11px" width="35%" align="center" >         
               <br />
           </td>
           <td style="font-size:12px"  width="36%" align="center" >         
              <b> PT Shimada Karya Indonesia </b>
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
       </tr> ';
       
   

  
  
  $output .= '</table>';
			
			
			
			
			
			
			
			
			
			

			$poumum_data = $this->model_poumum->getPoumumData($id);
			$poumum_items = $this->model_poumum->getPoumumItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}
}
