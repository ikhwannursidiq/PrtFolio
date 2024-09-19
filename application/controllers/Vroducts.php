<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vroducts extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Vroducts';

		$this->load->model('model_vroducts');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewVroduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('vroducts/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
    public function fetchVroductData()
	{
		$result = array('data' => array());

		$data = $this->model_vroducts->getVroductData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';
            if(in_array('updateVroduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('vroducts/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteVroduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

				
//menampilkan data berdasarkan status
			$status = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

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

	public function fetchVroducttData()
	{
		$result = array('data' => array());

		$data = $this->model_vroducts->getVroductData();

		foreach ($data as $key => $value) {

            $store_data = $this->model_stores->getStoresData($value['store_id']);
			//button
            $buttons = '';
            if(in_array('updateVroduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('vroducts/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteVroduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $qty_status = '';
            if($value['qty'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            } else if($value['qty'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


			$result['data'][$key] = array(
				
				$value['name'],
                $value['alamat'],
				$value['tlp'],
                $value['alamat'],
                $value['attn'],           
				$availability,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createVroduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('customer_name', 'customer_name', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('telp', 'telp', 'trim|required');
		$this->form_validation->set_rules('fax', 'fax', 'trim|required');
        $this->form_validation->set_rules('attn', 'attn', 'trim|required');
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        //	$upload_image = $this->upload_image();

        	$data = array(
        		'name' => $this->input->post('customer_name'),
        		'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
        		'fax' => $this->input->post('fax'),
                'attn' => $this->input->post('attn'),
        	
        		'availability' => $this->input->post('availability'),
        	);

        	$create = $this->model_vroducts->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('vroducts/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('vroducts/create', 'refresh');
        	}
        }
        else {
            // false case

        	// attributes 
        	$attribute_data = $this->model_attributes->getActiveAttributeData();

        	$attributes_final_data = array();
        	foreach ($attribute_data as $k => $v) {
        		$attributes_final_data[$k]['attribute_data'] = $v;

        		$value = $this->model_attributes->getAttributeValueData($v['id']);

        		$attributes_final_data[$k]['attribute_value'] = $value;
        	}

        	$this->data['attributes'] = $attributes_final_data;
			$this->data['brands'] = $this->model_brands->getActiveBrands();        	
			$this->data['category'] = $this->model_category->getActiveCategroy();        	
			$this->data['stores'] = $this->model_stores->getActiveStore();        	

            $this->render_template('vroducts/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($vroduct_id)
	{      
        if(!in_array('updateVroduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$vroduct_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('telp', 'telp', 'trim|required');
        $this->form_validation->set_rules('fax', 'fax', 'trim|required');
        $this->form_validation->set_rules('attn', 'attn', 'trim|required');
        $this->form_validation->set_rules('availability', 'availability', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'name' => $this->input->post('name'),
                'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
                'fax' => $this->input->post('fax'),
                'attn' => $this->input->post('attn'),
                'availability' => $this->input->post('availability'),
            );
        
    
            
         //   if($_FILES['product_image']['size'] > 0) {
       //         $upload_image = $this->upload_image();
       //         $upload_image = array('image' => $upload_image);
                
              //  $this->model_vroducts->update($upload_image, $vroduct_id);
        //    }

           $update = $this->model_vroducts->update($data, $vroduct_id);
       if($update == true) {
              $this->session->set_flashdata('success', 'Successfully updated');
              redirect('vroducts/', 'refresh');
            }
           else {
               $this->session->set_flashdata('errors', 'Error occurred!!');
              redirect('vroducts/update/'.$vroduct_id, 'refresh');
           }
        }
        else {
            // attributes 
         //   $attribute_data = $this->model_attributes->getActiveAttributeData();

         //   $attributes_final_data = array();
        //    foreach ($attribute_data as $k => $v) {
          //      $attributes_final_data[$k]['attribute_data'] = $v;

           //     $value = $this->model_attributes->getAttributeValueData($v['id']);

            //    $attributes_final_data[$k]['attribute_value'] = $value;
           // }
            
            // false case
          //  $this->data['attributes'] = $attributes_final_data;
          //  $this->data['brands'] = $this->model_brands->getActiveBrands();         
          //  $this->data['category'] = $this->model_category->getActiveCategroy();           
          //  $this->data['stores'] = $this->model_stores->getActiveStore();          

           $vroduct_data = $this->model_vroducts->getVroductData($vroduct_id);
        $this->data['vroduct_data'] = $vroduct_data;
          $this->render_template('vroducts/edit', $this->data); 
       }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteVroduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $vroduct_id = $this->input->post('vroduct_id');

        $response = array();
        if($vroduct_id) {
            $delete = $this->model_vroducts->remove($vroduct_id);
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

}