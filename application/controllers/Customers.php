<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'customers';

		$this->load->model('model_customers');
	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_customers->getCustomerData();

		$this->data['results'] = $result;

		$this->render_template('customers/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	
	public function fetchCustomerData()
	{
		$result = array('data' => array());

		$data = $this->model_customers->getCustomerData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('viewCustomer', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editCustomer('.$value['id'].')" data-toggle="modal" data-target="#editCustomerModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteCustomer', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeCustomer('.$value['id'].')" data-toggle="modal" data-target="#removeCustomerModal"><i class="fa fa-trash"></i></button>
				';
			}				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['telp'],
				$value['fax'],
				$value['alamat'],
				$value['attn'],
				$status,
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
	

	public function fetchCustomerDataById($id)
	{
		if($id) {
			$data = $this->model_customers->getCustomerData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('attn', 'attn', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('customer_name'),
				'telp' => $this->input->post('telp'),
				'fax' => $this->input->post('fax'),
				'alamat' => $this->input->post('alamat'),
				'attn' => $this->input->post('attn'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_customers->create($data);
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
	* Its checks the brand form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_customer_name', 'Customer name', 'trim|required');
			$this->form_validation->set_rules('edit_telp', 'telp', 'trim|required');
			$this->form_validation->set_rules('edit_fax', 'fax', 'trim|required');
			$this->form_validation->set_rules('edit_alamat', 'alamat', 'trim|required');
			$this->form_validation->set_rules('edit_attn', 'attn', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_customer_name'),
					'telp' => $this->input->post('edit_telp'),
					'fax' => $this->input->post('edit_fax'),
					'alamat' => $this->input->post('edit_alamat'),
					'attn' => $this->input->post('edit_attn'),					
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_customers->update($data, $id);
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
	* It removes the brand information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$customer_id = $this->input->post('customer_id');
		$response = array();
		if($customer_id) {
			$delete = $this->model_customers->remove($customer_id);

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