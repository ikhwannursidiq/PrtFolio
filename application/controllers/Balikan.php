<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Balikan extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Poimport';

        $this->load->model('model_items');
		$this->load->model('model_balikan');
		$this->load->model('model_products');
		$this->load->model('model_company');
        $this->load->model('model_vroducts');
        $this->load->model('model_konsumens');
		$this->load->model('model_operators');
	
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewBalikan', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Balikan';
		$this->render_template('balikan/index', $this->data);		
	}

	/*
	* Fetches the poimport data from the poimport table 
	* this function is called from the datatable ajax function
	*/
	public function fetchBalikanData()
	{
		$result = array('data' => array());

		$data = $this->model_balikan->getBalikanData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_balikan->countBalikanItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';
			if(in_array('viewBalikan', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('balikan/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			
			if(in_array('updateBalikan', $this->permission)) {
				$buttons .= ' <a href="'.base_url('balikan/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteBalikan', $this->permission)) {
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
//ambil data provinsi
    public function getdataprov()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->model_balikan->getprov($searchTerm);
        echo json_encode($response);
    }

 // Kabupaten
 public function getdatakab($id_prov)
 {
     $searchTerm = $this->input->post('searchTerm');
     $response   = $this->model_balikan->getkab($id_prov, $searchTerm);
     echo json_encode($response);
 }

 public function getItemdatakab($id_prov)
 {
    $searchTerm = $this->input->post('searchTerm');
    $response   = $this->model_balikan->getActivekab($id_prov, $searchTerm);
    echo json_encode($response);
 }




	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createBalikan', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Balikan';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$balikan_id = $this->model_balikan->create();
        	
        	if($balikan_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('balikan/update/'.$balikan_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('balikan/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;
			$this->data['operator'] = $this->model_operators->getOperatorDataQc();
        	$this->data['products'] = $this->model_products->getActiveProductData();      	
            $this->data['vroducts'] = $this->model_vroducts->getActiveVroductData();     
            $this->data['items'] = $this->model_items->getActiveItemData();      	 	
            $this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();      	
            $this->render_template('balikan/buat', $this->data);
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
		$item_id = $this->input->post('item_id');
		if($item_id) {
			$item_data = $this->model_items->getItemData($item_id);
			echo json_encode($item_data);
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

    public function getKonsumenValueById()
	{
		$id = $this->input->post('id');
		if($id) {
			$konsumen_data = $this->model_konsumens->getKonsumenData($id);
			echo json_encode($konsumen_data);
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

    public function getTableItemRow()
	{
		$items = $this->model_items->getActiveItemData();
		echo json_encode($items);
	}

    public function getTableItemCustomerRow()
	{
		$customer_id = $this->input->post('customer_id');
		if($customer_id) {
			$item_data = $this->model_items->getItemCustomerData($customer_id);
			echo json_encode($item_data);
		}
	}
	/*
	* If the validation is not valid, then it redirects to the edit poimport page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateBalikan', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Balikan';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_balikan->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('balikan/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('balikan/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$balikan_data = $this->model_balikan->getBalikanData($id);

    		$result['balikan'] = $balikan_data;
    		$balikan_item = $this->model_balikan->getBalikanItemData($balikan_data['id']);

    		foreach($balikan_item as $k => $v) {
    			$result['balikan_item'][] = $v;
    		}

    		$this->data['balikan_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
            $this->data['vroducts'] = $this->model_vroducts->getActiveVroductData();      	
            $this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();      	
            $this->render_template('balikan/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteBalikan', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$balikan_id = $this->input->post('balikan_id');

        $response = array();
        if($balikan_id) {
            $delete = $this->model_balikan->remove($balikan_id);
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
		if(!in_array('viewBalikan', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$balikan_data = $this->model_balikan->getBalikanData($id);
			$balikan_items = $this->model_balikan->getBalikanItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$balikan_date = date('d/m/Y', $balikan_data['date_time']);
			$paid_status = ($balikan_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
	

            @font-face { font-family: Roboto Regular; font-weight: normal; src: url(\'fonts/Roboto-Regular.ttf\') format(\'truetype\'); } 
            @font-face { font-family: Roboto Bold; font-weight: bold; src: url(\'fonts/Roboto-Bold.ttf\') format(\'truetype\'); } 
            body { font-family: Roboto Regular, DejaVu Sans, sans-serif; font-weight: normal; line-height:0.71em; font-size:14pt; }
            h1,h2{ font-family: Roboto Bold, sans-serif; font-weight: bold; line-height:1.2em; }
            
    
			@page { 
					margin-top: 5px;
					margin-bottom: 30px;
					margin-right: 10px;
					margin-left: 10px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
			
			
		body {
		  border: 0px solid black;
		  background-color: ;
		  padding-top: 10px;
		  padding-right: 10px;
		  padding-bottom: 10px;
		  padding-left: 10px;
         
		}
		
        table .warna {
            border-width: 0px;
            border-color: #ffffff;   
             
        }
          

        table .abcd{
        border-top:    1px solid  #ffffff;
        border-right:  1px dashed #ffffff;
        border-bottom: 1px dotted #000000;
        border-left:   1px solid  #000000;
        }

		table .kananputih{
            border-top:    1px solid  #000000;
            border-right:  1px solid #ffffff;
            border-bottom: 1px solid #000000;
            border-left:   1px solid  #000000;
            }
			table .kiriputih{
				border-top:    1px solid  #000000;
				border-right:  1px solid #000000;
				border-bottom: 1px solid #000000;
				border-left:   1px solid  #ffffff;
				}

        table .ataskanankiri{
            border-top:    1px solid  #000000;
            border-right:  1px solid #000000;
            border-bottom: 1px solid #ffffff;
            border-left:   1px solid  #000000;
            }

            table .kanankiri{
                border-top:    1px solid  #ffffff;
                border-bottom:  1px solid #ffffff;
                border-right: 1px solid #000000;
                border-left:   1px solid  #000000;
                }

                table .atas{
                    border-top:    1px solid  #ffffff;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    }
					table .atas1{
						border-top:    1px solid  #ffffff;
						border-right:  1px solid #ffffff;
						border-bottom: 1px solid #000000;
						border-left:   1px solid  #ffffff;
						}
						table .atas2{
							border-top:    1px solid  #ffffff;
							border-right:  1px solid #000000;
							border-bottom: 1px solid #000000;
							border-left:   1px solid  #ffffff;
							}
							table .atas3{
								border-top:    1px solid  #ffffff;
								border-right:  1px solid #000000;
								border-bottom: 1px solid #ffffff;
								border-left:   1px solid  #ffffff;
								}
								table .borderkiri{
									border-top:    1px solid  #ffffff;
									border-right:  1px solid #ffffff;
									border-bottom: 1px solid #ffffff;
									border-left:   1px solid  #000000;
									}
                    table .bawah{
                        border-top:    1px solid  #000000;
                        border-right:  1px solid #000000;
                        border-bottom: 1px solid #ffffff;
                        border-left:   1px solid  #000000;
                        }
						table .top{
							border-top:    1px solid  #000000;
							border-right:  1px solid #ffffff;
							border-bottom: 1px solid #ffffff;
							border-left:   1px solid  #ffffff;
							}
							table .top1{
								border-top:    1px solid  #000000;
								border-right:  1px solid #000000;
								border-bottom: 1px solid #ffffff;
								border-left:   1px solid  #ffffff;
								}

								table .top2{
									border-top:    1px solid  #ffffff;
									border-right:  1px solid #000000;
									border-bottom: 1px solid #ffffff;
									border-left:   1px solid  #ffffff;
									}
									
								table .top3{
									border-top:    1px solid  #000000;
									border-right:  1px solid #ffffff;
									border-bottom: 1px solid #ffffff;
									border-left:   1px solid  #ffffff;
									}
									table .top4{
									border-top:    1px solid  #000000;
									border-right:  1px solid #ffffff;
									border-bottom: 1px solid #000000;
									border-left:   1px solid  #ffffff;
									}
		

	
   </style>
<body>
<div id="header">
    <p align="left"><img width="1290" height="70" src="assets/images/27d.jpg"  /></p>
</div>  
 

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td class="warna" colspan="2" align="center" style="font-size:16px"><b> PT. SHIMADA KARYA INDONESIA</b></td>
	</tr>
	
	<tr>
	<td class="warna" colspan="2" align="center" style="font-size:14px"><b> RETURN PART</b></td>
	</tr>
	<tr>
	<td class="warna" colspan="2" align="center" style="font-size:17px"><b> </b></td>
	</tr>
	
	<td class="warna" style="font-size:12px" width="65%">
	
	
	Customer :  '.$balikan_data['customer_name'].'<br /> 
	Local/Export : Local
	
	</td>
	<td class="warna" style="font-size:12px"  width="35%">         
	Delivery Number. : '.$balikan_data['sj'].'<br />
	
    PO Number. : '.$balikan_data['pono'].'<br />
    Create Date :  '.date('d F Y', strtotime ($balikan_data['datereceived'])).'<br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th colspan ="10" align="center" style="font-size:12px">Detail Return Part</th>
	
	</tr>
	<tr>
	<th rowspan="" width="5%" align="center" style="font-size:12px">No</th>
	<th colspan="2" rowspan="" width="20%"align="center" style="font-size:12px">Part No</th>
	<th colspan="2" rowspan="" width="20%" align="center" style="font-size:12px">Part Name</th>
	<th colspan="2" rowspan="" width="10%"align="center" style="font-size:12px">Quantity</th>
	<th colspan="3" rowspan="" width="40%" align="center" style="font-size:12px">Defect</th>	
	</tr>
	
	
	';

  $no =0;
	foreach ($balikan_items as $k => $v) {

	$product_data = $this->model_items->getItemData($v['product_id']); 
		$no++;
		
	$output .= '
	<tr>
	<td style="font-size:11px"  align="center">'.$no.'</td>
	<td colspan="2" style="font-size:11px"  align="center">'.$v['name'].'</td>
	<td colspan="2" style="font-size:11px"  align="center">'.$v['name'].'</td>
	<td colspan="2" style="font-size:11px"  align="center">'.$v['qty'].'</td>
	<td colspan="3" style="font-size:11px"  align="center">'.$v['note'].'</td>
	
	 
	

	
	
	
	
	</tr>';
	
		
}
$output .= '
	<tr>
	<td align="center" colspan="5" style="font-size:12px; background-color:#D3D3D3;"><b>TOTAL </b></td>
	<td align="center" colspan="2" style="font-size:12px" ><b>'.$balikan_data['total_qty'].'</b></td>
	
	<td colspan="3" width="10%" align="left" style="font-size:12px" ></td>
	
	
	</tr>
	<tr>
	<th class="top" colspan ="10" align="center" style="font-size:12px"></th>
	
	
	
	</tr>
	
	
	<table width="100%" border="1" cellpadding="2" cellspacing="0">
	<tr>
	<td width ="35%" rowspan="3" align="left" style="font-size:12px">Notes :  
	<br>
	<br>
	<br>
	<br>
	
	
	</td>
	<td class="kanankiri" align="center" style="font-size:12px"></td>
	<td  align="center" style="font-size:12px">Known By</td>
	<td colspan="2" align="center" style="font-size:12px">Checked By</td>
	<td  align="center" style="font-size:12px">Prepared By</th>
	</tr>
	
	<tr>
	
	<td class="kanankiri" align="center" style="font-size:12px"></td>
	<td  align="center" style="font-size:12px"></td>
	<td colspan="2" align="left" style="font-size:12px"> <br><br><br><br> </td>
	<td align="left" style="font-size:12px">  </td>
	</tr>
	
	<tr>
	<td class="kanankiri" align="center" style="font-size:12px"></td>
	<td  align="center" style="font-size:12px">JAJANG S</td>
	
	<td colspan="2" align="center" style="font-size:12px"></td>
	<td  align="center" style="font-size:12px">'.$balikan_data['operatorname'].'</td>
	</tr>
	
	
	
	
</table>';
$output .= '</table>';
	
$balikan_data = $this->model_balikan->getBalikanData($id);
$balikan_items = $this->model_balikan->getBalikanItemData($id);
$company_info = $this->model_company->getCompanyData(1);
$dompdf ->loadHtml($output);
$dompdf ->setpaper('A4','portrait');
$dompdf ->render();
$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}
	
	public function printpdfold($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewBalikan', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$balikan_data = $this->model_balikan->getBalikanData($id);
			$balikan_items = $this->model_balikan->getBalikanItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$balikan_date = date('d/m/Y', $balikan_data['date_time']);
			$paid_status = ($balikan_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
		

			$balikan_data = $this->model_balikan->getBalikanData($id);
			$balikan_items = $this->model_balikan->getBalikanItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}

	
//ambil data provinsi
public function getdatacust()
{
	$searchTerm = $this->input->post('searchTerm');
	$response   = $this->model_balikan->getcust($searchTerm);
	echo json_encode($response);
}

// Kabupaten
public function getdatacustomeritem($id)
{
 $searchTerm = $this->input->post('searchTerm');
 $response   = $this->model_balikan->getcustomeritem($id, $searchTerm);
 echo json_encode($response);
}

public function getItemDataCustomer($id)
{
$searchTerm = $this->input->post('searchTerm');
$response   = $this->model_balikan->getActiveItemData($id, $searchTerm);
echo json_encode($response);
}
	


}
