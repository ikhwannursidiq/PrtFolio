<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Repair extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Data Repair';

		$this->load->model('model_inputs');
		$this->load->model('model_items');
		$this->load->model('model_company');
        $this->load->model('model_fincoming');
		$this->load->model('model_konsumens');
		$this->load->model('model_repair');
		
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewRepair', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage repair';
		$this->render_template('repair/index', $this->data);		
	}

	/*
	* Fetches the Polokal data from the Polokal table 
	* this function is called from the datatable ajax function
	*/
	public function fetchData()
	{
		$result = array('data' => array());

		$data = $this->model_repair->getData();

		foreach ($data as $key => $value) {

	
			$buttons = '';

			if(in_array('deleteRepair', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
    	
			$result['data'][$key] = array(
				$value['date'],
				$value['dateng'],
				$value['partname'],
				$value['partno'],
				$value['ng'],
				$value['nolot'],
				$value['qtyng'],
				$value['qtyok'],
				$value['inputqty'],
				$value['note'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}




//ambil data polokal penting !!!!!!!!!!!!!!!!!!!!!


public function getRepairValueById()
	{
		$repair_id = $this->input->post('repair_id');
		if($repair_id){
			$repair_data = $this->model_repair->getRepairData($repair_id);
			echo json_encode($repair_data);
		}
		
	}


//ambil data polokal
public function getTablePolokalRow()
{
	// $polokal = $this->model_polokal->getActivePolokalData();
	$polokal = $this->model_polokal->getActivePolokal();
	echo json_encode($polokal);
}

//ambil data polokal


public function getPoItemRow()
{
	$pono = $this->model_polokal->getActivePoData();
	echo json_encode($pono);
}




	public function createok()
	{
		if(!in_array('createRepair', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Repair';

		$this->form_validation->set_rules('part_id[]', 'part_id', 'trim|required');
		$this->form_validation->set_rules('partname[]', 'partname', 'trim|required');
		
		//if ($this->form_validation->run() == TRUE) {
            // true case
        //	$upload_image = $this->upload_image();
		if ($this->form_validation->run() == TRUE) {
			$cek = $this->db->query("SELECT * FROM repair where part_id='".$this->input->post('part_id')."' and date ='".$this->input->post('date')."' and nolot ='".$this->input->post('nolot')."'
			and ng ='".$this->input->post('qtyng')."' and inputqty ='".$this->input->post('inputqty')."'")->num_rows();
		 if ($cek<=0) {
        	$data = array(
        		'part_id' => $this->input->post('part_id'),
    			'partname' => $this->input->post('partname'),
    			'partno' => $this->input->post('partno'),
				'nolot' => $this->input->post('nolot'),
				'dateng' => $this->input->post('dateng'),
    			'ng' => $this->input->post('qtyng'),
    			'date_time' => strtotime(date('Y-m-d h:i:s a')),
    			'inputqty' => $this->input->post('qtyrepair'),
				'inputok' => $this->input->post('qtyrepair'),
				'goresan' => $this->input->post('goresan'),
				'gelembung' => $this->input->post('gelembung'),
				'tidaknempel' => $this->input->post('tidaknempel'),
				'bintik' => $this->input->post('bintik'),
				'bolong' => $this->input->post('bolong'),
				'lukadalam' => $this->input->post('lukadalam'),
				'lukaluar' => $this->input->post('lukaluar'),
				'wrappingan' => $this->input->post('wrappingan'),
				'karetnempel' => $this->input->post('karetnempel'),
				'retak' => $this->input->post('retak'),
				'benangrusak' => $this->input->post('benangrusak'),
				'oper' => $this->input->post('oper'),
				'kebentur' => $this->input->post('kebentur'),
				'others' => $this->input->post('others'),
				'note' => $this->input->post('note'),
				'qtyok' => $this->input->post('qtyok'),
			//	'qtyng' => $this->input->post('qtyng'),
        	);
		}
			$product_data = $this->model_inputs->getInputData($this->input->post('part_id'));
	
	 		$qty = (int) $product_data['bfok'] + (int) $this->input->post('qtyrepair');
			$update_product = array('bfok' => $qty);
	 		$this->model_inputs->update($update_product, $this->input->post('part_id'));
		//tambahan ok repair 
		//	$qtyok = (int) $product_data['ok'] + (int) $this->input->post('qtyrepair');
		//	$update_product_ok = array('ok' => $qtyok);
		//	$this->model_inputs->update($update_product_ok, $this->input->post('part_id'));
 


        	$create = $this->model_repair->create($data);
		
			if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('repair/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('repair/create', 'refresh');
        	}
        }
        else {
        
        	$this->data['inputsng'] = $this->model_repair->getDataInputsng();      	
            $this->data['repair'] = $this->model_repair->getActiveRepairData();        
            $this->render_template('repair/create', $this->data);
			
        }	
	}


	public function create()
	{
		if(!in_array('createRepair', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Repair';

		$this->form_validation->set_rules('part_id[]', 'part_id', 'trim|required');
		$this->form_validation->set_rules('partname[]', 'partname', 'trim|required');
		
		//if ($this->form_validation->run() == TRUE) {
            // true case
        //	$upload_image = $this->upload_image();
		if ($this->form_validation->run() == TRUE) {
			$cek = $this->db->query("SELECT * FROM repair where part_id='".$this->input->post('part_id')."' and date ='".$this->input->post('date')."' and nolot ='".$this->input->post('nolot')."'
			and ng ='".$this->input->post('qtyng')."' and inputqty ='".$this->input->post('inputqty')."'")->num_rows();
		 if ($cek<=0) {
        	$data = array(
        		'part_id' => $this->input->post('part_id'),
    			'partname' => $this->input->post('partname'),
    			'partno' => $this->input->post('partno'),
				'nolot' => $this->input->post('nolot'),
				'dateng' => $this->input->post('dateng'),
    			'ng' => $this->input->post('ng'),
    			'date_time' => strtotime(date('Y-m-d h:i:s a')),
    			
				'note' => $this->input->post('note'),
				
			 //	'history' => $this->input->post('history'),
        		'goresan' => $this->input->post('goresan'),
				'tidaknempel' => $this->input->post('tidaknempel'),
				'kebentur' => $this->input->post('kebentur'),
				'saringanjebol' => $this->input->post('saringanjebol'),
				'gelembung' => $this->input->post('gelembung'),
				'bintik' => $this->input->post('bintik'),
				'lukadalam' => $this->input->post('lukadalam'),
				'lukaluar' => $this->input->post('lukaluar'),
				'retak' => $this->input->post('retak'),
				'bergaris' => $this->input->post('bergaris'),
				'hosependek' => $this->input->post('hosependek'),
				'oper' => $this->input->post('oper'),
				'wrappingan' => $this->input->post('wrappingan'),
				'braidingan' => $this->input->post('braidingan'),
				'bolong' => $this->input->post('bolong'),
				'tipis' => $this->input->post('tipis'),
				'karetnempel' => $this->input->post('karetnempel'),
				'tebal' => $this->input->post('tebal'),
				'porisiti' => $this->input->post('porisiti'),
				'bekastangan' => $this->input->post('bekastangan'),
				'sobek' => $this->input->post('sobek'),
				'oval' => $this->input->post('oval'),
				'benangrusak' => $this->input->post('benangrusak'),
				'siwak' => $this->input->post('siwak'),
				'keropos' => $this->input->post('keropos'),
				'holetube' => $this->input->post('holetube'),		
				'seret' => $this->input->post('seret'),
				'sempit' => $this->input->post('sempit'),		
				'springpendek' => $this->input->post('springpendek'),
				'diameterkecil' => $this->input->post('diameterkecil'),
				'others' => $this->input->post('others'),
				'rp' => $this->input->post('rp'),
				'shape' => $this->input->post('shape'),
				'gap' => $this->input->post('gap'),
				'gelombang' => $this->input->post('gelombang'),
				'diameterbesar' => $this->input->post('diameterbesar'),
				'ringlonggar' => $this->input->post('ringlonggar'),
				'ngmarking' => $this->input->post('ngmarking'),
				'ngassy' => $this->input->post('ngassy'),
				'watermark' => $this->input->post('watermark'),
				'bertelur' => $this->input->post('bertelur'),
				'qtyng' => $this->input->post('qtyng'),
				'inputqty' => $this->input->post('qtyrepair'),
				'inputok' => $this->input->post('qtyrepair'),
				'note' => $this->input->post('note'),
				'qtyok' => $this->input->post('qtyok'),
				'ok' => $this->input->post('qtyok'),
        	);
		}
			$product_data = $this->model_inputs->getInputData($this->input->post('part_id'));
	
	 		$qty = (int) $product_data['bfok'] + (int) $this->input->post('qtyok');
			$update_product = array('bfok' => $qty);
	 		$this->model_inputs->update($update_product, $this->input->post('part_id'));
		//coba kurangi BF NG
		//	$ngqty = (int) $product_data['bfng']-(int) $this->input->post('qtyng');
		//	$ngupdate_product = array('bfng'=>$ngqty);
		//	$this->model_inputs->update($ngupdate_product, $this->input->post('part_id'));
		
			//tambahan ok repair 
		//	$qtyok = (int) $product_data['ok'] + (int) $this->input->post('qtyrepair');
		//	$update_product_ok = array('ok' => $qtyok);
		//	$this->model_inputs->update($update_product_ok, $this->input->post('part_id'));
 


        	$create = $this->model_repair->create($data);
		
			if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('repair/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('repair/create', 'refresh');
        	}
        }
        else {
        
        	$this->data['inputsng'] = $this->model_repair->getDataInputsng();      	
            $this->data['repair'] = $this->model_repair->getActiveRepairData();        
            $this->render_template('repair/create', $this->data);
			
        }	
	}


	public function records()
    {
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
            // $rows = $this->model_items->fetch();
            $rows = $this->model_repair->exportexcell($start_date, $end_date);
        } else {
            //   $rows = $this->model_exports->fetch();
          $rows = $this->model_repair->exportexcell($start_date, $end_date);
        }
        echo json_encode($rows);
        
    }  

	
	public function urgent()
	{
		if(!in_array('createSolokal', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Solokal';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$solokal_id = $this->model_solokal->create();
        	
        	if($solokal_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('solokal', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('solokal/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['items'] = $this->model_items->getActiveItemData();      	
          //  $this->data['ducts'] = $this->model_ducts->getActiveDuctData();  
           
            $this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();        	
          //  $this->data['items'] = $this->model_items->getActiveItemData();      	
		//	$this->data['polokal'] = $this->model_polokal->getActivePoData();  
			$this->data['sopirs'] = $this->model_sopirs->getActiveSopirData();        	
			$this->data['kodeunik'] = $this->model_solokal->buat_kode();   	
			$this->data['items'] = $this->model_items->getActiveItemData();      	
          
			
			$this->render_template('solokal/v_urgent', $this->data);
			//$this->render_template('solokal/parsial', $this->data);
        }	
	}

	

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
    public function getKonsumenValueById()
	{
		$id = $this->input->post('id');
		if($id) {
			$konsumen_data = $this->model_konsumens->getKonsumenData($id);
			echo json_encode($konsumen_data);
		}
	}
	  public function getPoValueById()
	{
		$id = $this->input->post('id');
		if($id) {
			$polokal_data = $this->model_polokal->getPolokalData($id);
			echo json_encode($polokal_data);
		}
	}
	
	  public function getSopirValueById()
	{
		$id = $this->input->post('id');
		if($id) {
			$sopir_data = $this->model_sopirs->getSopirData($id);
			echo json_encode($sopir_data);
		}
	}
	//ambil data po start
	public function getPolokalValueByIdold()
	{
		$polokal_id = $this->input->post('polokal_id');
		if($polokal_id) {
			$polokal_data = $this->model_polokal->getPolokalData($polokal_id);
			echo json_encode($polokal_data);
		}
	}
	

	//end
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

    public function getDuctValueById()
	{
		$duct_id = $this->input->post('duct_id');
		if($duct_id) {
			$duct_data = $this->model_ducts->getDuctData($duct_id);
			echo json_encode($duct_data);
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

    public function getTableDuctRow()
	{
		$ducts = $this->model_ducts->getActivePuctData();
		echo json_encode($ducts);
	}

	/*
	* If the validation is not valid, then it redirects to the edit Polokal page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateSolokal', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Polokal';

		$this->form_validation->set_rules('name_value[]', 'name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_solokal->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('solokal/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('solokal/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$solokal_data = $this->model_solokal->getSolokalData($id);

    		$result['solokal'] = $solokal_data;
    		$solokal_item = $this->model_solokal->getSolokalItemData($solokal_data['id']);

    		foreach($solokal_item as $k => $v) {
    			$result['solokal_item'][] = $v;
    		}

    		$this->data['solokal_data'] = $result;
			$this->data['polokal'] = $this->model_polokal->getActivePoData();  
        	$this->data['items'] = $this->model_items->getActiveItemData();      	
            $this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();          	
     	    $this->data['sopirs'] = $this->model_sopirs->getActiveSopirData();       
		
            $this->render_template('solokal/edit', $this->data);
        }
	}


	public function urgentupdate($id)
	{
		if(!in_array('updateSolokal', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Polokal';

		$this->form_validation->set_rules('name_value[]', 'name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_solokal->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('solokal/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('solokal/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$solokal_data = $this->model_solokal->getSolokalData($id);

    		$result['solokal'] = $solokal_data;
    		$solokal_item = $this->model_solokal->getSolokalItemData($solokal_data['id']);

    		foreach($solokal_item as $k => $v) {
    			$result['solokal_item'][] = $v;
    		}

    		$this->data['solokal_data'] = $result;
			$this->data['polokal'] = $this->model_polokal->getActivePoData();  
        	$this->data['items'] = $this->model_items->getActiveItemData();      
				
            $this->data['konsumens'] = $this->model_konsumens->getActiveKonsumenData();          	
     	    $this->data['sopirs'] = $this->model_sopirs->getActiveSopirData();       
		
            $this->render_template('solokal/editurgent', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteRepair', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$repair_id = $this->input->post('repair_id');

        $response = array();
        if($repair_id) {
            $delete = $this->model_repair->remove($repair_id);
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
	


	
//ambil data provinsi
public function getdatacust()
{
	$searchTerm = $this->input->post('searchTerm');
	$response   = $this->model_polokal->getcust($searchTerm);
	echo json_encode($response);
}

// Kabupaten
public function getdatacustomeritem($id)
{
 $searchTerm = $this->input->post('searchTerm');
 $response   = $this->model_polokal->getcustomeritem($id, $searchTerm);
 echo json_encode($response);
}

//get data po

public function getdatapocustomeritem($id)
{
 $searchTerm = $this->input->post('searchTerm');
 $response   = $this->model_solokal->jointable($id, $searchTerm);
 echo json_encode($response);
}

public function getItemDataPoCustomer($id)
{
$searchTerm = $this->input->post('searchTerm');
$response   = $this->model_solokal->getActiveItemDataPo($id, $searchTerm);
echo json_encode($response);
}
	



	
//ambil data provinsi
public function getdataurgentcust()
{
	$searchTerm = $this->input->post('searchTerm');
	$response   = $this->model_polokal->getcust($searchTerm);
	echo json_encode($response);
}

// Kabupaten
public function getdataurgentcustomeritem($id)
{
 $searchTerm = $this->input->post('searchTerm');
 $response   = $this->model_polokal->getcustomeritem($id, $searchTerm);
 echo json_encode($response);
}

public function getItemDataCustomer($id)
{
$searchTerm = $this->input->post('searchTerm');
$response   = $this->model_polokal->getActiveItemData($id, $searchTerm);
echo json_encode($response);
}


	
//ambil data NG
public function getdatang()
{
	$searchTerm = $this->input->post('searchTerm');
	$response   = $this->model_polokal->getcust($searchTerm);
	echo json_encode($response);
}
	






























}
