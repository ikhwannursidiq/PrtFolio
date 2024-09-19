<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exports extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Inputs';

		$this->load->model('model_inputs');
		$this->load->model('model_exports');
		//$this->load->model('model_items');
	

	}
	
public function generateReserve()
	{
		 if(!empty($this->input->post('from'))){
            $from = $this->input->post('from');
        } else {
            $from = "null";
        }

        if(!empty($this->input->post('to'))){
            $to = $this->input->post('to');
        } else {
            $to = "null";
        }
	
            $this->render_template('exports/index', $this->data);
        
	}	
	
	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewExport', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_inputs->getInputData();

		$this->data['results'] = $result;


//menampilkan data Items
	//	$this->data['items'] = $this->model_items->getActiveItemData();      	

		$this->render_template('exports/index2', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchExportData()
	{
		$result = array('data' => array());

		$data = $this->model_inputs->getInputData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('viewInput', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editBrand('.$value['id'].')" data-toggle="modal" data-target="#editBrandModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteInput', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeBrand('.$value['id'].')" data-toggle="modal" data-target="#removeBrandModal"><i class="fa fa-trash"></i></button>
				';
			}				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['tgl'],
				$value['operatorname'],
				$value['nama'],
				$value['nolot'],
				$value['ok'],
				$value['ng'],
				$value['total'],
			//	$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

public function records1()

	{
	$result = array('data' => array());
	if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $data = $this->model_inputs->date_range($start_date, $end_date);
	
	} 
		
    $data = $this->model_inputs->fetch1();
	
	foreach ($data as $key => $value) {
	//$this->data['rows'][$key] = array;
	$result['data'][$key] = array(
				$value['tgl'],
				$value['operatorname'],
				$value['nama'],
				$value['nolot'],
				$value['ok'],
				$value['ng'],
				$value['total'],
			//	$status,
				//$buttons
			);
		
	
	
	}
		
		echo json_encode($result);
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