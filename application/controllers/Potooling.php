<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Potooling extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Potooling';

		$this->load->model('model_potooling');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage potooling page
	*/
	public function index()
	{
		if(!in_array('viewPotooling', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Potooling';
		$this->render_template('potooling/index', $this->data);		
	}

	/*
	* Fetches the potooling data from the potooling table 
	* this function is called from the datatable ajax function
	*/
	public function fetchPotoolingData()
	{
		$result = array('data' => array());

		$data = $this->model_potooling->getPotoolingData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_potooling->countPotoolingItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewPotooling', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('potooling/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('viewPotooling', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('potooling/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('potooling/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deletePotooling', $this->permission)) {
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

		$this->data['page_title'] = 'Add Potooling';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$potooling_id = $this->model_potooling->create();
        	
        	if($potooling_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('potooling/update/'.$potooling_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('potooling/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('potooling/create', $this->data);
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
	* This function is used in the potooling page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit potooling page 
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

		$this->data['page_title'] = 'Update Potooling';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_potooling->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('potooling/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('potooling/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_potooling->getPotoolingData($id);

    		$result['potooling'] = $orders_data;
    		$potooling_item = $this->model_potooling->getPotoolingItemData($orders_data['id']);

    		foreach($potooling_item as $k => $v) {
    			$result['potooling_item'][] = $v;
    		}

    		$this->data['potooling_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('potooling/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deletePotooling', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$potooling_id = $this->input->post('potooling_id');

        $response = array();
        if($potooling_id) {
            $delete = $this->model_potooling->remove($potooling_id);
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
	* It gets the product id and fetch the potooling data. 
	* The potooling print logic is done here 
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

	<img src="<?php echo base_url(); ?> /application/21.jpg">
   <title><img width="680" height="80" src="21.jpg" alt="etics-insurance-000.png" /></title>
   <p><strong>&nbsp;</strong></p>
   
   <br>

   <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <tr>
       <td colspan="2" align="center" style="font-family:verdana font-size:18px"  ><b> PURCHASE ORDER </b></td>
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
           <table width="100%" border ="1" cellpadding="3">
           
           <tr>
               <td  style="font-size:12px" width=10%"> To   </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="65%">a;lamatttt </td>
               <td align="center" style="font-size:12px" width="15%"> PO No. </td>
               <td  style="font-size:12px" width="45%">: Nomer PO </td>
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="10%">  </td>
               <td rowspan="2" style="font-size:12px" width="2%">  </td>
               <td rowspan="2" align="left" style="font-size:12px" width="65%">alamatttt</td>
               <td  style="font-size:12px" width="15%"> PO Date. </td>
               
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
               <td  style="font-size:12px" width="65%">faxxxxx</td>
               <td  style="font-size:12px" width="12%"> </td>
               <td  style="font-size:12px" width="45%"> </td> 
               </td>
            </tr>

            <tr>
               <td  style="font-size:12px" width=10%"> Fax   </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="65%">  faxxxx</td>
               <td  style="font-size:12px" width="12%">  </td>
               <td  style="font-size:12px" width="45%"> </td>
            </tr>
            
            
            <tr>
            <td  style="font-size:12px" width=10%"> Attn   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="65%"> nama budi</td>
            <td  style="font-size:12px" width="12%">  </td>
            <td  style="font-size:12px" width="45%"> </td>
         </tr>
        

           </table>
           <br /> <b style="font-size:12px" ></b>
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
			
			
			
			
			
			
			
			
			
			
			
			
			

			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}
}
