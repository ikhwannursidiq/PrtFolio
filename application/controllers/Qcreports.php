<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Qcreports extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Inputs';

		$this->load->model('model_inputs');
		//$this->load->model('model_items');
	

	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewQcreport', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_inputs->getInputData();

		$this->data['results'] = $result;


//menampilkan data Items
	//	$this->data['items'] = $this->model_items->getActiveItemData();      	

		$this->render_template('qcreports/report', $this->data);
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
	
	 public function getAllEmployees()
    {
        $json = array();    
        $list = $this->model_inputs->getEmpData();
        $data = array();
        foreach ($list as $element) {
			
			
            $row = array();
            $row[] = $element['id'];
            $row[] = $element['tgl'];
			$row[] = $element['category'];
			$row[] = $element['waktu'];
            $row[] = $element['shift'];
            $row[] = $element['operatorname'];
            $row[] = $element['nama'];
            $row[] = $element['kode_material'];
			$row[] = $element['nolotnew'];
			$row[] = $element['ok'];
            $row[] = $element['ng'];
			$row[] = $element['total'];
			$row[] = $element['goresan'];
            $row[] = $element['tidaknempel'];
			$row[] = $element['kebentur'];			 
		    $row[] = $element['saringanjebol'];
            $row[] = $element['gelembung'];
			$row[] = $element['bintik'];
            $row[] = $element['lukadalam'];
            $row[] = $element['lukaluar'];
            $row[] = $element['retak'];
            $row[] = $element['bergaris'];
			$row[] = $element['hosependek'];
            $row[] = $element['oper'];
			$row[] = $element['wrappingan'];           
			$row[] = $element['braidingan'];
            $row[] = $element['bolong'];
			$row[] = $element['tipis'];			 
			$row[] = $element['karetnempel'];
            $row[] = $element['tebal'];
			$row[] = $element['porisiti'];
            $row[] = $element['bekastangan'];
            $row[] = $element['sobek'];
            $row[] = $element['oval'];
            $row[] = $element['benangrusak'];
			$row[] = $element['siwak'];
            $row[] = $element['keropos'];
			$row[] = $element['holetube'];           
			$row[] = $element['springpendek'];
			$row[] = $element['seret'];           
			$row[] = $element['sempit'];
            $row[] = $element['diameterkecil'];
			$row[] = $element['diameterbesar'];
            $row[] = $element['rp'];
            $row[] = $element['shape'];
			$row[] = $element['gap'];
            $row[] = $element['gelombang'];
			$row[] = $element['ringlonggar'];           
			$row[] = $element['ngmarking'];
			$row[] = $element['ngassy'];           
			$row[] = $element['watermark'];
            $row[] = $element['bertelur'];
			$row[] = $element['others'];	
            $row[] = $element['note'];
			$row[] = $element['history'];
			
			
            $data[] = $row;
        }

        $json['data'] = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_inputs->countAll(),
            "recordsFiltered" => $this->model_inputs->countFiltered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json['data']);
    }
	
	public function display() {
        $json = array();
        $id = $this->input->post('id');
        $this->model_inputs->setId($id);
        $json['idInfo'] = $this->model_inputs->getEmp();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('qcreports/popup/renderDisplay', $json);
    }
	
	
	
	
	
	
	
	
	
	
	

}