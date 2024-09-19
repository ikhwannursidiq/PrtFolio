<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inputs extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Inputs';

		$this->load->model('model_inputs');
		$this->load->model('model_items');
		$this->load->model('model_material');
	

	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewInput', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_inputs->getInputData();

		$this->data['results'] = $result;


		//menampilkan data Items
		$this->data['items'] = $this->model_items->getActiveItemData();     
		
		$this->data['mat'] = $this->model_material->getActiveMaterialData();     

		$this->render_template('inputs/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchInputData()
	{
		$result = array('data' => array());

		$data = $this->model_inputs->getInputData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateInput', $this->permission)) {
				$buttons .= '<a href="'.base_url('inputs/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}
			
			if(in_array('deleteInput', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeInput('.$value['id'].')" data-toggle="modal" data-target="#removeInputModal"><i class="fa fa-trash"></i></button>
				';
			}			

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['tgl'],
				$value['shift'],
				$value['operatorname'],
				$value['nama'],
				$value['nolotnew'],
				$value['ok'],
				$value['ng'],
				$value['total'],
			//	$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchInputDataById($id)
	{
		if($id) {
			$data = $this->model_inputs->getInputData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	/*

*/
	public function create()
	{

		if(!in_array('createInput', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('partname', 'partname', 'trim|required');
		$this->form_validation->set_rules('operatorname', 'operatorname', 'trim|required');
		$this->form_validation->set_rules('shift', 'shift', 'trim|required');
	
			
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

      //  if ($this->form_validation->run() == TRUE) {
	//		$cek = $this->db->query("SELECT * FROM inputs where nama='".$this->input->post('nama')."' and shift ='".$this->input->post('shift')."' and nolot ='".$this->input->post('nolot')."' 
	//		and operatorname ='".$this->input->post('operatorname')."' and ng ='".$this->input->post('ng')."' and tgl ='".$this->input->post('tgl')."' and total ='".$this->input->post('total')."'")->num_rows();
	//	 if ($cek<=0) {
	
	
		if ($this->form_validation->run() == TRUE) {
	//		$cek = $this->db->query("SELECT * FROM inputs where nama='".$this->input->post('nama')."' and shift ='".$this->input->post('shift')."' and nolotnew ='".$this->input->post('nolotnew')."'
	//		and date_time ='".$this->input->post('date_time')."' and operatorname ='".$this->input->post('operatorname')."' and ng ='".$this->input->post('ng')."' and ok ='".$this->input->post('ok')."'and total ='".$this->input->post('total')."'")->num_rows();
	//	 if ($cek<=0) {

	//	$cek = $this->db->query("SELECT * FROM inputs where nama='".$this->input->post('nama')."' and shift ='".$this->input->post('shift')."' and nolotnew ='".$this->input->post('nolotnew')."'
		// and date_time ='".$this->input->post('date_time')."' AND total ='".$this->input->post('total')."'")->num_rows();
		// if ($cek<=0) {
		
		$data = array(
        		'partname' => $this->input->post('partname'),
				'tgl' => $this->input->post('tgl'),
				'nama' => $this->input->post('nama'),
				//'operator_id' => $this->input->post('operator_id'),
				'operatorname' => $this->input->post('operatorname'),
				'ok' => $this->input->post('ok'),
				'bfok' => $this->input->post('ok'),
				'waktu' => $this->input->post('waktu'),
				'shift' => $this->input->post('shift'),
				'ng' => $this->input->post('ng'),
				'bfng' => $this->input->post('ng'),
				'total' => $this->input->post('total'),
				//'date_time' => $this->input->post('date_time'),
				'note' => $this->input->post('note'),
				//'nolot' => $this->input->post('nolot'),
			 	'history' => $this->input->post('history'),
        		'nolotnew' => $this->input->post('nolotnew'),	
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
				'category' => $this->input->post('category'),
				'material' => $this->input->post('material'),
			 	);
        	$create = $this->model_inputs->create($data);
		 //  }
		   
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
			//redirect('inputs', 'refresh');
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);

				$this->data['items'] = $this->model_items->getActiveItemData();  
				$this->data['mat'] = $this->model_material->getActiveMaterialData();          	
		
        	}
        }

		$this->data['items'] = $this->model_items->getActiveItemData(); 
		$this->data['mat'] = $this->model_material->getActiveMaterialData();      	
		
        echo json_encode($response);

	}


	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getItemValueById()
	{
		$item_id = $this->input->post('item_id');
		if($item_id) {
			$item_data = $this->model_items->getItemData($item_id);
			echo json_encode($item_data);
		}
	}



	public function getTableItemRow()
	{
		$items = $this->model_items->getActiveItemData();
		echo json_encode($items);
	}
	
	public function update($id)
	{

		if(!in_array('updateInput', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('partname', 'partname', 'trim|required');
	//	$this->form_validation->set_rules('active', 'Active', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
				'partname' => $this->input->post('partname'),
				'tgl' => $this->input->post('tgl'),
				'nama' => $this->input->post('nama'),
				//'operator_id' => $this->input->post('operator_id'),
				'operatorname' => $this->input->post('operatorname'),
				'ok' => $this->input->post('ok'),
				'waktu' => $this->input->post('waktu'),
				'shift' => $this->input->post('shift'),
				'ng' => $this->input->post('ng'),
				'total' => $this->input->post('total'),
			//	'date_time' => $this->input->post('date_time'),
				'note' => $this->input->post('note'),
				'history' => $this->input->post('history'),
				'nolot' => $this->input->post('nolot'),
			// 'partname' => $this->input->post('partname'),
        	//	'active' => $this->input->post('active'),	
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
				'category' => $this->input->post('category'),
			 	);
        	$update = $this->model_inputs->update($data, $id);
        	if($update == true) {
				$this->session->set_flashdata('success', 'Successfully updated');
                redirect('inputs/', 'refresh');
             	}
        	else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('inputs/update/'.$id, 'refresh');
     	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);

				$this->data['items'] = $this->model_items->getActiveItemData();      	
		
        	}
        }

		$this->data['items'] = $this->model_items->getActiveItemData();      
		$input_data = $this->model_inputs->getInputData($id);
		$this->data['input_data'] = $input_data;	
		$this->render_template('inputs/edit', $this->data); 
     
	}


	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	
	public function update($id)
	{
		if(!in_array('updateInput', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_partname', 'partname', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'partname' => $this->input->post('edit_part_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_parts->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	
	* It removes the brand information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteInput', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$input_id = $this->input->post('input_id');
		$response = array();
		if($input_id) {
			$delete = $this->model_inputs->remove($input_id);

			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}