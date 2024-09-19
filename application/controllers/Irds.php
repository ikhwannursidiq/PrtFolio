<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Irds extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Irds';
        $this->load->model('model_irds');
		$this->load->model('model_rfqs');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('m_general');
	}
	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewIrds', $this->permission)) { //menampilkan tabel rfq manage
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Irds';
		$this->render_template('irds/index', $this->data);		
	}
	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchIrdsData()
	{
		$result = array('data' => array());

		$data = $this->model_irds->getIrdsData();

		foreach ($data as $key => $value) {

		$count_total_item = $this->model_irds->countIrdsItem($value['id']);
		//	$date = date('d-m-Y', $value['date_time']);
		//	$time = date('h:i a', $value['date_time']);

			
			// button
			$buttons = '';
			if(in_array('viewIrds', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('irds/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateIrds', $this->permission)) {
				$buttons .= ' <a href="'.base_url('irds/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteIrds', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

		
	
			$result['data'][$key] = array(
				$value['customer_name'],
				$value['partname'],
				$value['partno'],
				$value['nolot'],
				$value['shift'],
				$value['operator'],
				$value['qtycek'],
			
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
	public function create($id="")
	{
		if(!in_array('createIrds', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Irds';
		$this->data['pfqs'] = $this->db->query("SELECT a.id, a.customer_name, a.namepart FROM pfqs a ")->result();
    //    $this->data['rfqs'] = $this->db->query("select a.id, a.customer_name, a.namepart from rfqs as a join rfqs_item b where a.id = b.rfq_id order by a.namepart ASC")->result();
	
	//	$this->data['tbl_rfq'] = $this->db->query("select a.id, CONCAT(a.namepart) from rfqs as a
	//	join rfqs_item b where a.id=b.rfq_id order by a.id ASC")->result();
       
	   $this->data['tbl_rfq_by'] = $this->db->query("SELECT a.*,b.*

      FROM
             pfqs a 
              join pfqs_item b on a.id=b.rfq_id
              where a.id='$id'")->row();

  //	$data['tbl_rfq_by'] =$this->db->select("*");
  //	$data['tbl_rfq_by'] =$this->db->from("rfqs");
  //	$data['tbl_rfq_by'] =$this->db->join("rfqs_item", "rfqs_item.rfq_id = rfqs.id");
  //	$data['tbl_rfq_by'] = $this->db->order_by("id");
      
   //  $data['tbl_rfq_by'] = $this->db->query("SELECT b.* FROM rfqs_item as b join rfqs as a where a.id=b.rfq_id order by id= '$id'")->row();
              
       //$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
      // $this->data['pfqs_item'] = $this->db->query("select a.*, b.* from pfqs_item a join pfqs b on a.rfq_id=b.id where a.rfq_id='$id' order by rfq_id ")->result();

       $this->data['pfqs_item'] = $this->db->query("select a.*, b.* from pfqs_item a join pfqs b on a.rfq_id=b.id where a.rfq_id='$id' ")->result();

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$rfq_id = $this->model_irds->create();
        	
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
            $this->render_template('irds/create', $this->data);
        }	
	}


    public function po_aksi_tambah()
    {
			$id_po = $this->m_general->bacaidterakhir("ird", "id_po", "id");
				$data_po = array(
					'id_po' => $id_po,
					'tanggal_po' => $_POST['tanggal_po'],
                    'partname' => $_POST['partname'],
					'partno' => $_POST['partno'],
					'nolot' => $_POST['nolot'],
					'material' => $_POST['material'],
					'customer_name' => $_POST['customer_name'],
					'note' => $_POST['note'],
					'ok' => $_POST['ok'],
					'operator' => $_POST['operator'],
					'drw' => $_POST['drw'],
					'status_po' => 0,
					'qtycek' => $_POST['qtycek'],
					'shift' => $_POST['shift'],
				//	'id_rfq' => $_POST['id_rfq']
				);
			
			$this->m_general->add("ird", $data_po);
			//$insert = $this->db->insert('ird', $data);
			$rfq_id = $this->db->insert_id();
		$jumlah_id_produk = count($this->input->post('product'), COUNT_RECURSIVE);
		//	$jumlah_id_produk = count($this->input->post('product'));
			for($x=0; $x<$jumlah_id_produk; $x++){
				if($_POST['product'][$x]!=""){
			//	//	$id_po_detail = $this->m_general->bacaidterakhir("ird_item", "id_po_detail");
					$data_detail = array(
						'rfq_id'=> $rfq_id,
						'product'=>$_POST['product'][$x],
						'standard'=>$_POST['standard'][$x],
					    'frekuensi'=>$_POST['frekuensi'][$x],
						'metode'=>$_POST['metode'][$x],
						'satu'=>$_POST['satu'][$x],
						'dua'=>$_POST['dua'][$x],
						'tiga'=>$_POST['tiga'][$x],
						'empat'=>$_POST['empat'][$x],
						'lima'=>$_POST['lima'][$x],
						'rata'=>$_POST['rata'][$x],
						'selisih'=>$_POST['selisih'][$x],	
					
				//		'product'=>$this->input->post('product')[$x],
				//		'standard'=>$this->input->post('standard')[$x],
				//		'frekuensi'=>$this->input->post('frekuensi')[$x],
				//		'metode'=>$this->input->post('metode')[$x],
				//		'satu'=>$this->input->post('satu')[$x],
				//		'dua'=>$this->input->post('dua')[$x],
				//		'tiga'=>$this->input->post('tiga')[$x],
				//		'empat'=>$this->input->post('empat')[$x],
				//		'lima'=>$this->input->post('lima')[$x],
				//	    'rata'=>$this->input->post('rata')[$x],
				//		'selisih'=>$this->input->post('selisih')[$x]	
					);
					$this->m_general->add("ird_item", $data_detail);	
				}
			}
			
			redirect('irds');
// return('irds');  
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
		if(!in_array('deleteIrds', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$ird_id = $this->input->post('ird_id');

        $response = array();
        if($ird_id) {
            $delete = $this->model_irds->remove($ird_id);
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
	
	
//		public function po_tambah($id="")
 //   {
		
//		$data['rfqs'] = $this->db->query("select a.id, a.customer_name, a.pono from rfqs a
 //         join rfqs_item b where a.id=b.rfq_id order by a.id ASC")->result();

//	$data['tbl_rfq_by'] = $this->db->query("SELECT a.*,b.*

//		FROM
 //              rfqs a 
//				join rfqs_item b on a.id=b.rfq_id
//				where a.id='$id'")->row();

	//	$data['tbl_rfq_by'] =$this->db->select("*");
	//	$data['tbl_rfq_by'] =$this->db->from("rfqs");
	//	$data['tbl_rfq_by'] =$this->db->join("rfqs_item", "rfqs_item.rfq_id = rfqs.id");
	//	$data['tbl_rfq_by'] = $this->db->order_by("id");
		
     //  $data['tbl_rfq_by'] = $this->db->query("SELECT b.* FROM rfqs_item as b join rfqs as a where a.id=b.rfq_id order by id= '$id'")->row();
				
		 //$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		
//	$data['rfqs_item'] = $this->db->query("select a.*, b.* from rfqs_item a 
//join rfqs b on a.rfq_id=b.id where a.rfq_id='$id' order by rfq_id ASC")->result();

	//  $this->render_template('rfqs/v_po_add',$data);
	  
//	 $this->render_template('rfqs/v_po_add', $data);
     
 //   }

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/


	public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewIrds', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$ird_data = $this->model_irds->getIrdsData($id);
			$ird_item = $this->model_irds->getIrdsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
		
			
			

		//	$ird_date = date('M d-Y', $ird_data['date_time']);
		//	$deliveryDate = date("M d Y ", strtotime($rfq_data['duedate']));
	
			$output = '
            <style >
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
		  padding-top: 0px;
		  padding-right: 10px;
		  padding-bottom: 10px;
		  padding-left: 10px;
		
		  font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 

		}
		 table .warna {
          
            border-left: 0px;
			border-right: 0px;  			

        }
		
		table .warna1 {
          
         
			border-right: 0px;  			

        }
		
		table .warna2 {
          
            border-left: 0px;
					

        }
		
		table .warna3 {
          
            border-bottom: 0px;
		 			

        }
		
		table .warna4 {
          
            border-top: 0px;
		 			

        }
		
		table .warna5 {
          
            border-top: 0px;
		 	border-bottom: 0px;
		 			

        }
		
			
		   </style>  
	   
	   <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="20%" ><b> FR QAS 01 05&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>
		
		  
		
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="20%" ><b> Ed/Rev : 01/00&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>
		    </table>
		    <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="" align="center" style="font-size:8px" width="20%" ><b> PT SHIMADA KARYA INDONESIA</b></td>
		    <td colspan="2" rowspan="4" align="center" style="font-size:24px" width="300%"><b> INSPECTION RESULT DATA </b></td>
		   <td colspan="" align="center" style="font-size:10px" width="10%"><b> Made by</b></td>
		   <td colspan="" align="center" style="font-size:10px" width="10%"><b> Checked</b></td>
		   <td colspan="" align="center" style="font-size:10px" width="10%"><b> Approved</b></td>
		  
		  </tr>
		  
		   <tr>
		    <td colspan="" rowspan="3" align="center" style="font-size:8px" width="20%" ><b><img width="140" height="50" src="assets/images/logo.jpg" /></b></td>
		
		      <td class="warna3" colspan=""  rowspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		   <td class="warna3" colspan=""  rowspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		   <td class="warna3" colspan=""  rowspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		  
		  </tr>
		  
		   <tr>
		   <td class="warna4" colspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		   <td class="warna4" colspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		   <td class="warna4" colspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		  
		  
		  </tr>

		  <tr>
		  
		   <td colspan="" align="center" style="font-size:10px" width="10%"><b>'.$ird_data['operator'].'</b></td>
		   <td  colspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		   <td  colspan="" align="center" style="font-size:10px" width="10%"><b> </b></td>
		  
		  </tr>
		  
		  
		   
		   
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="1" cellpadding="0" cellspacing="0">
      
       <tr >
		   <td class="warna1" align="left" style="font-size:14px" width="15%" >&nbsp; Customer</b></td>
		    <td class="warna" colspan="2" align="left" style="font-size:14px" width="15%">:&nbsp;'.$ird_data['customer_name'].'  </b></td>
		  <td  class="warna" align="left" style="font-size:14px" width="15%"> Date</b></td>
		   <td class="warna2" colspan="2" align="left" style="font-size:14px" width="15%"> :&nbsp;'.$ird_data['tanggal_po'].'</b></td>
		   
		    
		 </tr>
		 
		 <tr>
		   <td class="warna1" align="left" style="font-size:14px" width="15%" >&nbsp; Part Name</b></td>
		    <td class="warna" colspan="2" align="left" style="font-size:14px" width="15%">:&nbsp;'.$ird_data['partname'].'</b></td>
			   <td class="warna"  align="left" style="font-size:14px" width="15%"> Material</b></td>
		   <td class="warna2" colspan="2" align="left" style="font-size:14px" width="15%"> :&nbsp;'.$ird_data['material'].'</b></td>
		 
		    
		 </tr>
		 
		 <tr>
		   <td class="warna1" align="left" style="font-size:14px" width="15%" >&nbsp; Part Number</b></td>
		    <td  class="warna" colspan="2" align="left" style="font-size:14px" width="15%">:&nbsp;'.$ird_data['partno'].' </b></td>
			   <td  class="warna" align="left" style="font-size:14px" width="15%"> Lot Number</b></td>
		   <td class="warna2" colspan="2" align="left" style="font-size:14px" width="15%">:&nbsp;'.$ird_data['nolot'].'</b></td>
		 
		    
		 </tr>
		 
		 <tr>
		   <td class="warna1" align="left" style="font-size:14px" width="15%" >&nbsp; Shift </b></td>
		    <td  class="warna" colspan="2" align="left" style="font-size:14px" width="15%">:&nbsp;'.$ird_data['shift'].' </b></td>
			   <td  class="warna" align="left" style="font-size:14px" width="15%"> Quantity Cek</b></td>
		   <td class="warna2" colspan="2" align="left" style="font-size:14px" width="15%">:&nbsp;'.$ird_data['qtycek'].'</b></td>
		 
		    
		 </tr>
         

           
            
            
            <tr>
            <td class="warna3" colspan="6" style="font-size:14px" width=10%">&nbsp; Drawing Skecth :   </td>
            </tr>
			<tr>
            <td class="warna5" colspan="6" style="font-size:14px" width=10%">&nbsp;   </td>
            </tr>
			 <tr>
            <td class="warna5" align="center" colspan="6" style="font-size:12px" width=10%"> <img width="700" height="250" src="'.$ird_data['drw'].'" />   </td>
            </tr>
			
			<tr>
            <td class="warna4" colspan="6" style="font-size:14px" width=10%">&nbsp;   </td>
            </tr>
      </table>    
  <table width="100%" border="1" cellpadding="4" cellspacing="0">		
<tr>
	     <td style="background-color:#Ffffff; font-size:14px; width:3%;" align="center" rowspan ="2"><b> No</b></td>

       <td style="background-color:#Ffffff; font-size:14px; width:17%;" align="center" rowspan ="2"><b> Inspection Item</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:15%;" align="center"rowspan ="2"><b>  Tools</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:13%;" align="center"rowspan ="2"><b>  Standard</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:7%;" align="center"colspan ="5"><b>  Sample</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:7%;" align="center"rowspan ="2"><b>  X</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:7%;" align="center"rowspan ="2"><b>  R</b></td>
</tr>

<tr>
<td  style="background-color:#Ffffff; font-size:14px; width:5%;" align="center"><b>1</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:5%;" align="center"><b>2</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:5%;" align="center"><b>3</b></td>
<td style="background-color:#Ffffff;font-size:14px; width:5%;" align="center"><b>4</b></td>
<td style="background-color:#Ffffff; font-size:14px; width:5%;" align="center"><b>5</b></td>
</tr>';
	
        $no =0;
	foreach ($ird_item as $k => $v) {
	//$product_data = $this->model_products->getProductData($v['product_id']); 
		$no++;

		//$selisih = ($v['selisih'] == NAN) ? " " : ".$vselisih";
		//$rata = ($v['rata'] == NAN) ? " " : '.$v[rata].';
       $output .= '
       <tr>
       <td align="center" style="font-size:12px">'.$no.'<</td>
       <td align="center" style="font-size:12px">'.$v['product'].'</td>
       <td align="center" style="font-size:12px"><span style="font-family: DejaVu Sans, sans-serif;">'.$v['metode'].'</span></td>
       <td width="8%"align="center" style="font-size:12px">'.$v['standard'].'</td>
       <td align="center" style="font-size:12px">'.$v['satu'].'</td>   
	    <td align="center" style="font-size:12px">'.$v['dua'].'</td>
       <td align="center" style="font-size:12px">'.$v['tiga'].'</td>
       <td align="center" style="font-size:12px">'.$v['empat'].'</td>
       <td align="center" style="font-size:12px">'.$v['lima'].'</td>
       <td align="center" style="font-size:12px">'.$v['rata'].'</td>   
	   <td align="center" style="font-size:12px">'.$v['selisih'].'</td>   
       
       </tr>';
    }
	 $output .= '
  
       <tr>
           <td class="warna3" colspan="5"  align ="left" style="font-size:12px" width="5%">
		  Note :
		 
           </td>
          <td colspan="6" style="font-size:12px"  align="center"> 
          <b>RESULT </b>
		  <br>
		
           </td>
       </tr>
	   
	   <tr>
	    <td class="warna4" colspan="5" rowspan="4" align ="left" style="font-size:12px" width="5%">
		&nbsp;'.$ird_data['note'].'
		 
           </td>
       <td  colspan="6" align="center" rowspan="4" colspan="3" style="font-size:12px"><b> <img width="200" height="70" src="assets/images/'.$ird_data['ok'].'" /></b></td>
       
       </tr>
	   
	    <tr>
       
       </tr>
	    <tr>
       
       </tr>
	   <tr>
       
       </tr>

     ';
   $output .= '
  
   
       ';
   $output .= '

   <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		  
           </td>
           <td style="font-size:12px" width="35%" align="center"> 
          
           </td>
   
           <td style="font-size:12px"  width="12%" align="center">         
            
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

       </tr>';
       
   

  
  
  $output .= '</table>';

			$ird_data = $this->model_irds->getIrdsData($id);
			$ird_item = $this->model_irds->getIrdsItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}































}