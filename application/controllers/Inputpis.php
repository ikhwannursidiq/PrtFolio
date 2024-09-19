<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inputpis extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Pis';

		$this->load->model('model_inputpis');
		$this->load->model('model_items');
	

	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewInputpi', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_inputpis->getInputData();

		$this->data['results'] = $result;


//menampilkan data Items
		$this->data['items'] = $this->model_items->getActiveItemData();      	
            $item_data = $this->model_items->getItemData();
            $this->data['item_data'] = $item_data;
		$this->render_template('inputpis/index', $this->data);
	}

	
	public function fetchInputDataById($id)
	{
		if($id) {
			$data = $this->model_inputs->getInputData($id);
			echo json_encode($data);
		}

		return false;
	}

	public function create()
	{

		if(!in_array('createInput', $this->permission)) {
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
				'ng' => $this->input->post('ng'),
				'total' => $this->input->post('total'),
			//	'defect' => $this->input->post('defect'),
			//	'note' => $this->input->post('note'),
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
			'springpendek' => $this->input->post('springpendek'),
			'diameterkecil' => $this->input->post('diameterkecil'),
			'others' => $this->input->post('others'),
			 	);
				

        	$create = $this->model_inputs->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
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
		
        	}
        }

		$this->data['items'] = $this->model_items->getActiveItemData();      	
		
        echo json_encode($response);

	}


	
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
				'ng' => $this->input->post('ng'),
				'total' => $this->input->post('total'),
			//	'defect' => $this->input->post('defect'),
			//	'note' => $this->input->post('note'),
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
			'springpendek' => $this->input->post('springpendek'),
			'diameterkecil' => $this->input->post('diameterkecil'),
			'others' => $this->input->post('others'),
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