<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Items';

		$this->load->model('model_items');
		$this->load->model('model_operators');
        $this->load->model('model_inputs');
        $this->load->model('model_konsumens');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewItem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('items/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchItemData()
	{
		$result = array('data' => array());

		$data = $this->model_items->getItemData();

		foreach ($data as $key => $value) {
            $konsumen_data = $this->model_konsumens->getKonsumenData($value['customer_id']);
            $operator_data = $this->model_operators->getOperatorsData($value['operator_id']);
			// button
            $buttons = '';
            if(in_array('updateItem', $this->permission)) {
    			$buttons .= '<a href="'.base_url('items/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteItem', $this->permission)) { 
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
				$img,
				$value['name'],
				$value['partname'],
                $value['description'],
				$konsumen_data['name'],
                $value['price'],
                $value['unit'],
                $value['stokin'],
                $value['stokout'],
				$availability,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    public function records()
    {
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
            // $rows = $this->model_items->fetch();
            $rows = $this->model_items->date_range($start_date, $end_date);
        } else {
            //   $rows = $this->model_exports->fetch();
          $rows = $this->model_items->date_range($start_date, $end_date);
        }
        echo json_encode($rows);
        
    }   

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createItem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
		$this->form_validation->set_rules('sku', 'SKU', 'trim|required');
  //      $this->form_validation->set_rules('mix', 'mix', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required');
        $this->form_validation->set_rules('operator', 'Operator', 'trim|required');
		//$this->form_validation->set_rules('availability', 'Availability', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
             $cek = $this->db->query("SELECT * FROM items where name='".$this->input->post('product_name')."' and partname ='".$this->input->post('sku')."' ")->num_rows();
            
            if ($cek<=0) {
        

            // true case
        	$upload_image = $this->upload_image();

        	$data = array(
        		'name' => $this->input->post('product_name'),
        		'partname' => $this->input->post('sku'),
        		'price' => $this->input->post('price'),
                'unit' => $this->input->post('unit'),
        		'qty' => $this->input->post('qty'),
                'customer_id' => $this->input->post('customer_id'),
        		'image' => $upload_image,
        		'description' => $this->input->post('description'),
        //		'attribute_value_id' => json_encode($this->input->post('attributes_value_id')),
      //  		'brand_id' => json_encode($this->input->post('brands')),
        		//'category_id' => json_encode($this->input->post('category')),
              //  'operator_id' => $this->input->post('operator'),
        		'availability' => $this->input->post('availability'),
        	);
        }
        	$create = $this->model_items->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('items/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('items/create', 'refresh');
        	}
        }
        else {
            // false case

        	// attributes 
        //	$attribute_data = $this->model_attributes->getActiveAttributeData();

       // 	$attributes_final_data = array();
        //	foreach ($attribute_data as $k => $v) {
        	//	$attributes_final_data[$k]['attribute_data'] = $v;

        //		$value = $this->model_attributes->getAttributeValueData($v['id']);

        	//	$attributes_final_data[$k]['attribute_value'] = $value;
        //	}

      //  	$this->data['attributes'] = $attributes_final_data;
	//		$this->data['brands'] = $this->model_brands->getActiveBrands();        	
		//	$this->data['category'] = $this->model_category->getActiveCategroy();        	
			$this->data['operators'] = $this->model_operators->getActiveOperator();        	
            $this->data['customer'] = $this->model_konsumens->getActiveKonsumenData();    
            $this->render_template('items/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($item_id)
	{      
        if(!in_array('updateItem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$item_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
     //   $this->form_validation->set_rules('mix', 'mix', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('unit', 'Unit', 'trim|required');
        $this->form_validation->set_rules('qty', 'Qty', 'trim|required');
       // $this->form_validation->set_rules('store', 'Store', 'trim|required');
        $this->form_validation->set_rules('availability', 'Availability', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'name' => $this->input->post('product_name'),
                'partname' => $this->input->post('sku'),
               'stokin' => $this->input->post('stokin'),
                'price' => $this->input->post('price'),
                'qty' => $this->input->post('qty'),
                'unit' => $this->input->post('unit'),
                'customer_id' => $this->input->post('customer_id'),
                'description' => $this->input->post('description'),
         //       'attribute_value_id' => json_encode($this->input->post('attributes_value_id')),
           //     'brand_id' => json_encode($this->input->post('brands')),
            //    'category_id' => json_encode($this->input->post('category')),
                 'stokout' => $this->input->post('stokout'),
                'availability' => $this->input->post('availability'),
            );

            
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_items->update($upload_image, $item_id);
            }

            $update = $this->model_items->update($data, $item_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('items/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('items/update/'.$item_id, 'refresh');
            }
        }
        else {
            // attributes 
           // $attribute_data = $this->model_attributes->getActiveAttributeData();

            //$attributes_final_data = array();
           // foreach ($attribute_data as $k => $v) {
             //   $attributes_final_data[$k]['attribute_data'] = $v;

              //  $value = $this->model_attributes->getAttributeValueData($v['id']);

               // $attributes_final_data[$k]['attribute_value'] = $value;
            //}
            
            // false case
            //$this->data['attributes'] = $attributes_final_data;
            //$this->data['brands'] = $this->model_brands->getActiveBrands();         
            //$this->data['category'] = $this->model_category->getActiveCategroy();           
            $this->data['operators'] = $this->model_operators->getActiveOperator();          
            $this->data['customer'] = $this->model_konsumens->getActiveKonsumenData();    
      
            $item_data = $this->model_items->getItemData($item_id);
            $this->data['item_data'] = $item_data;
            $this->render_template('items/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteItem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $item_id = $this->input->post('item_id');

        $response = array();
        if($item_id) {
            $delete = $this->model_items->remove($item_id);
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