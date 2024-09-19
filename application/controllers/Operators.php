<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operators extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Operators';

		$this->load->model('model_operators');
	}

	/* 
    * It only redirects to the manage stores page
    */
	public function index()
	{
		if(!in_array('viewOperator', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('operators/index', $this->data);	
	}

	/*
	* It retrieve the specific store information via a store id
	* and returns the data in json format.
	*/
	public function fetchOperatorsDataById($id) 
	{
		if($id) {
			$data = $this->model_operators->getOperatorsData($id);
			echo json_encode($data);
		}
	}



	/*
	* It retrieves all the store data from the database 
	* This function is called from the datatable ajax function
	* The data is return based on the json format.
	*/
	public function fetchOperatorsData()
	{
		$result = array('data' => array());

		$data = $this->model_operators->getOperatorsData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateOperator', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteOperator', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			//$jabatan = ($value['jabatan'] == 1) ? '<span class="label label-success">PM</span>' : '<span class="label label-warning">Inactive</span>';
			if($value['jabatan'] == 1) {
				$jabatan = '<span class="label label-default">PM</span>';	
			}
			if($value['jabatan'] == 2) {
				$jabatan = '<span class="label label-warning">MGR</span>';	
			}
			if($value['jabatan'] == 3) {
				$jabatan = '<span class="label label-info">KEPALA BAGIAN</span>';	
			}
			if($value['jabatan'] == 4) {
				$jabatan = '<span class="label label-primary">STAFF</span>';	
			}
			if($value['jabatan'] == 5) {
				$jabatan = '<span class="label label-danger">LEADER</span>';	
			}
			else {
				$jabatan = '<span class="label label-warning">OPERATOR</span>';	
			}

			if($value['bagian'] == 1 ) {
				$bagian = '<span class="label label-warning">QC</span>';	
			}
			else if($value['bagian']  == 2) {
				$bagian = '<span class="label label-info">CUTTING</span>';	
			}
			else if($value['bagian']  == 3) {
				$bagian = '<span class="label label-info">WAYA</span>';	
			}
			else if($value['bagian']  == 4) {
				$bagian = '<span class="label label-primary">ENGINEERING</span>';	
			}
			else if($value['bagian']  == 5) {
				$bagian = '<span class="label label-primary">PPIC</span>';	
			}
			else {
				$bagian = '<span class="label label-danger">PRODUKSI</span>';	
			}

			$result['data'][$key] = array(
				$value['name'],
				$jabatan,
				$bagian,
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	/*
	* It retrieves all the store data from the database 
	* This function is called from the datatable ajax function
	* The data is return based on the json format.
	*/
	public function fetchOperatorsDataold()
	{
		$result = array('data' => array());

		$data = $this->model_operators->getOperatorsData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateOperator', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteOperator', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it inserts the data into the database and 
    returns the appropriate message in the json format.
    */
	public function create()
	{
		if(!in_array('createOperator', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('operator_name', 'Operator name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('operator_name'),
				'jabatan' => $this->input->post('jabatan'),
				'bagian' => $this->input->post('bagian'),
        		'active' => $this->input->post('active'),		
        	);

        	$create = $this->model_operators->create($data);
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
        	}
        }

        echo json_encode($response);
	}	

	/*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it updates the data into the database and 
    returns a n appropriate message in the json format.
    */
	public function update($id)
	{
		if(!in_array('updateOperator', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_operator_name', 'Operator name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_operator_name'),
	        		'active' => $this->input->post('edit_active'),
					
				'jabatan' => $this->input->post('edit_jabatan'),
				'bagian' => $this->input->post('edit_bagian'),
        	
	        	);

	        	$update = $this->model_operators->update($data, $id);
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

	/*
	* If checks if the store id is provided on the function, if not then an appropriate message 
	is return on the json format
    * If the validation is valid then it removes the data into the database and returns an appropriate 
    message in the json format.
    */
	public function remove()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$operator_id = $this->input->post('operator_id');

		$response = array();
		if($operator_id) {
			$delete = $this->model_operators->remove($operator_id);
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