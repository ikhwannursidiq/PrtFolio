<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Material';

		$this->load->model('model_material');
		$this->load->model('model_operators');
        $this->load->model('model_inputs');
        $this->load->model('model_suppliers');
        $this->load->model('model_category');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewMaterial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('material/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchMaterialData()
	{
		$result = array('data' => array());

		$data = $this->model_material->getMaterialData();

		foreach ($data as $key => $value) {

         //   $category_data = $this->model_category->getCategoryData($value['category_id']);
            $supplier_data = $this->model_suppliers->getSupplierData($value['supplier_id']);
			// button
            $buttons = '';
        //    if(in_array('updateMaterial', $this->permission)) {
    	//		$buttons .= '<a href="'.base_url('material/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
         //   }

            if(in_array('deleteMaterial', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['matname'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
            $cat='';
            if($value['category_id'] == 6 )
                {
                    $cat= '<a href="'.base_url('material/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
                }
            else if ($value['category_id'] == 7)
                {
                 	
				$cat = '<a target="__blank" href="'.base_url('material/submaterial/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';//jika ok disini tampilnya
            }
            else
                {
                    $cat ='<a target="__blank" href="'.base_url('material/factorysupplies/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';//jika ok disini tampilnya
                }

           


			$result['data'][$key] = array(
				$img,
				$value['matno'],
				$value['matname'],
                $supplier_data['name'],
              //  $category_data['name'],
                $value['category'],
                $value['bm'],
                $value['hs'],
                $value['tb'],
                $value['eb'],
                $value['sg'],
				$availability,
              //  $edit,
                $cat,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    public function getCategoryValueById()
	{
		$category_id = $this->input->post('category_id');
		if($category_id) {
			$category_data = $this->model_category->getCategoryData($category_id);
			echo json_encode($category_data);
		}
	}

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createMaterial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
				
	
        if ($this->form_validation->run() == TRUE) {
            $cek = $this->db->query("SELECT * FROM material where matname='".$this->input->post('product_name')."' and matno ='".$this->input->post('product_no')."' ")->num_rows();
           
           if ($cek<=0) {     // true case
        	$upload_image = $this->upload_image();

        	$data = array(
                'codematerial' => $this->input->post('codematerial'),
        		'matname' => $this->input->post('product_name'),
                'matno' => $this->input->post('product_no'),
        		'tb' => $this->input->post('tb'),
                'tbmax' => $this->input->post('tbmax'),
                'tbmin' => $this->input->post('tbmin'),
         		'eb' => $this->input->post('eb'),
                'ebmax' => $this->input->post('ebmax'),
                'ebmin' => $this->input->post('ebmin'),
                'hs' => $this->input->post('hs'),
                'hsmax' => $this->input->post('hsmax'),
                'hsmin' => $this->input->post('hsmin'),
                'sg' => $this->input->post('sg'),
                'sgmax' => $this->input->post('sgmax'),
                'sgmin' => $this->input->post('sgmin'),
                'bm' => $this->input->post('bm'),
                'bmmax' => $this->input->post('bmmax'),
                'bmmin' => $this->input->post('bmmin'),
                'diameter' => $this->input->post('diameter'),
                'dmax' => $this->input->post('dmax'),
                'dmin' => $this->input->post('dmin'),
                'weight' => $this->input->post('weight'),
                'wmax' => $this->input->post('wmax'),
                'wmin' => $this->input->post('wmin'),
                'apperance' => $this->input->post('apperance'),
                'satuan' => $this->input->post('satuan'),
        		'category_id' => $this->input->post('category'),
                'category' => $this->input->post('namacategory'),
        		'image' => $upload_image,
        		'supplier_id' => $this->input->post('supplier'),
             	'availability' => $this->input->post('availability'),
        	);
        }
        	$create = $this->model_material->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('material/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('material/create', 'refresh');
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

			$this->data['category'] = $this->model_category->getActiveCategory();        			 	
			$this->data['operators'] = $this->model_operators->getActiveOperator();        	
            $this->data['datasupplier'] = $this->model_suppliers->getActiveSuppliers(); 
	
            $this->render_template('material/create', $this->data);
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
	public function update($material_id)
	{      
        if(!in_array('updateMaterial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$material_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
            $this->form_validation->set_rules('availability', 'Availability', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'matname' => $this->input->post('product_name'),
                'matno' => $this->input->post('product_no'),
        		'tb' => $this->input->post('tb'),
                'tbmax' => $this->input->post('tbmax'),
                'tbmin' => $this->input->post('tbmin'),
         		'eb' => $this->input->post('eb'),
                'ebmax' => $this->input->post('ebmax'),
                'ebmin' => $this->input->post('ebmin'),
                'hs' => $this->input->post('hs'),
                'hsmax' => $this->input->post('hsmax'),
                'hsmin' => $this->input->post('hsmin'),
                'sg' => $this->input->post('sg'),
                'sgmax' => $this->input->post('sgmax'),
                'sgmin' => $this->input->post('sgmin'),
                'bm' => $this->input->post('bm'),
                'bmmax' => $this->input->post('bmmax'),
                'bmmin' => $this->input->post('bmmin'),
        	    'category_id' => $this->input->post('category'),
                'category' => $this->input->post('namacategory'),
        		'image' => $upload_image,
        		'supplier_id' => $this->input->post('supplier'),
             	'availability' => $this->input->post('availability'),
            );

            
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_material->update($upload_image, $material_id);
            }

            $update = $this->model_material->update($data, $material_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('material/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('material/update/'.$material_id, 'refresh');
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
            $this->data['category'] = $this->model_category->getActiveCategory();           
            $this->data['operators'] = $this->model_operators->getActiveOperator();          
            $this->data['datasupplier'] = $this->model_suppliers->getActiveSuppliers(); 
            $material_data = $this->model_material->getMaterialData($material_id);
            $this->data['material_data'] = $material_data;
            $this->render_template('material/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteMaterial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $material_id = $this->input->post('material_id');

        $response = array();
        if($material_id) {
            $delete = $this->model_material->remove($material_id);
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