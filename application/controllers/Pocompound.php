<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Pocompound extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Pocompound';

		$this->load->model('model_pocompound');
		$this->load->model('model_products');
		$this->load->model('model_vroducts');
		$this->load->model('model_company');
		$this->load->model('model_customers');
	}
	

	/* 
	* It only redirects to the manage Pocompound page
	*/
	public function index()
	{
		if(!in_array('viewPocompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Pocompound';
		$this->render_template('pocompound/index', $this->data);		
	}

	


	/*
	* Fetches the pocompound data from the pocompound table 
	* this function is called from the datatable ajax function
	*/

	public function fetchPocompoundData()
	{
		$result = array('data' => array());

		$data = $this->model_pocompound->getPocompoundData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_pocompound->countPocompoundItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewPocompound', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('pocompound/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updatePocompound', $this->permission)) {
				$buttons .= ' <a href="'.base_url('pocompound/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deletePocompound', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Closed</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Open</span>';
			}

			$result['data'][$key] = array(
				//$value['bill_no'],
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
		if(!in_array('createPocompound', $this->permission)) {
            redirect('dashboard', 'refresh');

        }

		$this->data['page_title'] = 'Add Pocompound';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$Pocompound_id = $this->model_pocompound->create();
        	
        	if($Pocompound_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('pocompound/update/'.$Pocompound_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('pocompound/create/', 'refresh');
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

            $this->render_template('pocompound/create', $this->data);
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



	public function getCustomerValueById()
	{
		$cus = $this->input->post('cus');
		if($cus) {
			$customer_data = $this->model_customers->getCustomerData($cus);
			echo json_encode($cus_data);
		}
	}

	public function getTableCustomerRow()
	{
		$cus = $this->model_customers->getActiveCustomerData();
		echo json_encode($cus);
	}
	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the Pocompound page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}
	public function getTableVroductRow()
	{
		$vroducts = $this->model_vroducts->getActiveVroductData();
		echo json_encode($vroducts);
	}

	/*
	* If the validation is not valid, then it redirects to the edit pocompound page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updatePocompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Pocompound';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_pocompound->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('pocompound/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('pocompound/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$pocompound_data = $this->model_pocompound->getPocompoundData($id);

    		$result['pocompound'] = $pocompound_data;
    		$pocompound_item = $this->model_pocompound->getPocompoundItemData($pocompound_data['id']);

    		foreach($pocompound_item as $k => $v) {
    			$result['pocompound_item'][] = $v;
    		}

    		$this->data['pocompound_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
        //	$this->data['customer'] = $this->model_customers->getActiveCustomerData(); 
		$this->data['vroducts'] = $this->model_vroducts->getActiveVroductData();      	
     	
            $this->render_template('pocompound/edit', $this->data);
        }
	}
	
	


	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deletePocompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$pocompound_id = $this->input->post('pocompound_id');

        $response = array();
        if($pocompound_id) {
            $delete = $this->model_pocompound->remove($pocompound_id);
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
            $response['messages'] = "Refersh the page againnnnnnnnnnnn!!";
        }

        echo json_encode($response); 
	}
public function get_angkatan()
	{
	$id	= $this->input->post('id');
        $data 	= $this->model_customers->get_angkatan($id);
        
        echo json_encode($data);
	}
	
	public function get_barang(){
        $id=$this->input->post('id');
        $data=$this->model_vroducts->get_data_barang_byid($id);
        echo json_encode($data);
    }
	

	
//test ci print dompdf
public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewPocompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$pocompound_data = $this->model_pocompound->getPocompoundData($id);
			$pocompound_items = $this->model_pocompound->getPocompoundItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$pocompound_date = date('d/m/Y', $pocompound_data['date_time']);
			$paid_status = ($pocompound_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
               <td  style="font-size:12px" width="85%"></b> '.$pocompound_data['customer_name'].' </td>
               <td align="left" style="font-size:12px" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PO No. </td>
               <td  style="font-size:12px" width="40%">: '.$pocompound_data['pono'].'  </td>
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="10%">  </td>
               <td rowspan="2" style="font-size:12px" width="2%">  </td>
               <td rowspan="2" align="left" style="font-size:12px" width="75%"></b> '.$pocompound_data['customer_address'].' <br /></td>
               <td align="left" style="font-size:12px" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PO Date. </td>
               
               <td  style="font-size:12px" width="40%">: '.$pocompound_data['deliverydate'].' </td> 
               </td>
            </tr>


            <tr>
            
               <td  style="font-size:12px" width="0%"></td>
               <td  style="font-size:12px" width="12%">  </td>
              
            </tr>
            <tr>
               <td  style="font-size:12px" width="10%"> Telp  </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="85%">'.$pocompound_data['customer_phone'].'</td>
               <td  style="font-size:12px" width="12%"> </td>
               <td  style="font-size:12px" width="45%"> </td> 
               </td>
            </tr>

            <tr>
               <td  style="font-size:12px" width=10%"> Fax   </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="85%">  '.$pocompound_data['fax'].'</td>
               <td  style="font-size:12px" width="12%">  </td>
               <td  style="font-size:12px" width="45%"> </td>
            </tr>
            
            
            <tr>
            <td  style="font-size:12px" width=10%"> Attn   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="85%"> '.$pocompound_data['attn'].'</td>
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
       <th colspan ="1" width="40%"align="center" style="font-size:12px">Description</th>
       <th width="10%"align="center" style="font-size:12px">Qty</th>
       <th width="8%" align="center" style="font-size:12px">Unit</th>
       <th colspan ="2" width="20%" align="center" style="font-size:12px">Unit Price</th>
       <th width="20%" align="center" style="font-size:12px">Amount</th>
       <th width="20%" align="center"style="font-size:12px">Note</th> 
       </tr>
		</thead>';
        $no =0;
	foreach ($pocompound_items as $k => $v) {

	$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;
  
       $output .= '
       <tr>
       <td align="left" style="font-size:11px">'.$no.'</td>
       <td align="left" width="20%" style="font-size:11px">&nbsp;'.$product_data['name'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$product_data['description'].' </td>
       <td align="left" style="font-size:11px">'.$v['total_qty'].'</td>
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
       <td align="left" colspan="3" style="font-size:12px"></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td width="15%" align="left" style="font-size:12px"><b>SUB TOTAL</b></td>
	   <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
       <td width="20%" align="right" style="font-size:12px"><b>'.$pocompound_data['gross_amount'].'</b></td>
     
    
	</tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b>PPN (10 %)</b></td>
	   <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
       <td width="20%" align="right" style="font-size:12px"><b>'.$pocompound_data['vat_charge'].'</b></td>
       </tr>

       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="right" style="font-size:12px"><b></b></td>
       <td align="left" style="font-size:12px"><b>TOTAL</b></td>
	   <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
       <td width="20%"align="right" style="font-size:12px"><b>'.$pocompound_data['net_amount'].'</b></td>
       </tr>
       <tr>
       <td align="left" colspan="3" style="font-size:12px"><b>Delivery Date :</b></td>
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
	 
	</table> ';
	
	$no =0;
	foreach ($pocompound_items as $k => $b) {

	$product_data = $this->model_products->getProductData($b['product_id']); 
		$no++;

		
	$output .= '
		
	<table width="100%" border="0" cellpadding="0" cellspacing="1">
       <tr>
	  
       <td align="right" style="font-size:12px"><b>'.$b['tgl'].'</b></td>
       <td align="right" style="font-size:12px"><b>'.$product_data['name'].'</b></td>
       <td width= "2%"align="right" style="font-size:12px"><b>=</b></td>

       <td align="center" style="font-size:12px"><b>'.$b['total_qty'].'</b></td>
	   <td width="5%"align="right" style="font-size:12px"><b>KG</b></td>
       <td width="10%" align="left" style="font-size:12px"><b>/ delivery</b></td>

	   <td width="7%"align="left" style="font-size:12px"><b>'.$b['kiriman'].'</b></td>
	   <td width="2%"align="left" style="font-size:12px"><b>-</b></td>
       <td width="20%"align="left" style="font-size:12px"><b>'.$b['kiriman'].'/delivery</b></td>
    

    </tr>';
       


	}
    
      // ';
   $output .= '
   
       
   
   
   
   
   
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
               <bstyle="font-size:12px"> <b>'.$pocompound_data['customer_name'].' </b>
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
       </tr>';
       
   

  
  
  $output .= '</table>';
			
			
			
			
			
			
			
			
			
			
			
			
			

			$pocompound_data = $this->model_pocompound->getPocompoundData($id);
			$pocompound_items = $this->model_pocompound->getPocompoundItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}






	//print asli

    public function printDiv($id)
	{
		if(!in_array('viewPocompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$pocompound_data = $this->model_pocompound->getPocompoundData($id);
			$pocompound_items = $this->model_pocompound->getPocompoundItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$pocompound_date = date('d/m/Y', $pocompound_data['date_time']);
			$paid_status = ($pocompound_data['paid_status'] == 1) ? "Paid" : "Unpaid";

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
			          <small class="pull-right">Date: '.$pocompound_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$pocompound_data['bill_no'].'<br>
			        <b>Name:</b> '.$pocompound_data['customer_name'].'<br>
			        <b>Address:</b> '.$pocompound_data['customer_address'].' <br />
			        <b>Phone:</b> '.$pocompound_data['customer_phone'].'
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

			          foreach ($pocompound_items as $k => $v) {

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
			              <td>'.$pocompound_data['gross_amount'].'</td>
			            </tr>';

			            if($pocompound_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$pocompound_data['service_charge_rate'].'%)</th>
				              <td>'.$pocompound_data['service_charge'].'</td>
				            </tr>';
			            }

			            if($pocompound_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$pocompound_data['vat_charge_rate'].'%)</th>
				              <td>'.$pocompound_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$pocompound_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$pocompound_data['net_amount'].'</td>
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
