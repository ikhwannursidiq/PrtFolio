<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Prods extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Prods';

		$this->load->model('model_prods');
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
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('prods/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchProdData()
	{
		$result = array('data' => array());

		$data = $this->model_prods->getProdData();

		foreach ($data as $key => $value) {

         //   $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
            if(in_array('viewProd', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('prods/printpdfok/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
            if(in_array('viewProd', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('prods/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-plane"></i></a>';
			}
            if(in_array('updateProd', $this->permission)) {
    			$buttons .= '<a href="'.base_url('prods/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProd', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

           

			$img = '<img src="'.base_url($value['drw']).'" alt="'.$value['namepart'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

      //      $qty_status = '';
        //    if($value['qty'] <= 10) {
         //       $qty_status = '<span class="label label-warning">Low !</span>';
         //   } else if($value['qty'] <= 0) {
         //       $qty_status = '<span class="label label-danger">Out of stock !</span>';
         //   }


			$result['data'][$key] = array(
				$img,
				$value['customer_name'],
				$value['nopart'],
                $value['namepart'],
				$value['material'],
                $value['tipe'],
              //  $value['unit'],
              //  $value['qty'] . ' ' . $qty_status,
              //  $store_data['name'],
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







 
     public function createnew()
     {
        if(!in_array('createProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('namepart', 'namepart', 'trim|required');
		$this->form_validation->set_rules('nopart', 'nopart', 'trim|required');
        $this->form_validation->set_rules('material', 'material', 'trim|required');
		$this->form_validation->set_rules('customer_name', 'customer_name', 'trim|required');
     
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();
            $user_id = $this->session->userdata('id');
        	$data = array(
        		'namepart' => $this->input->post('namepart'),
        		'nopart' => $this->input->post('nopart'),
        		'customer_name' => $this->input->post('customer_name'),
        		'tipe' => $this->input->post('tipe'),
        		'drw' => $upload_image,
                'user_id' => $user_id,
        		'material' => $this->input->post('material'),
                'jsatu' => $this->input->post('jsatu'),
                'jdua' => $this->input->post('jdua'),

                'jtiga' => $this->input->post('jtiga'),
                'jempat' => $this->input->post('jempat'),

                'jlima' => $this->input->post('jlima'),
                'jenam' => $this->input->post('jenam'),
           //     'titelsatu' => $this->input->post('titelsatu'),
        		'availability' => $this->input->post('availability'),
        	);
        
            $create = $this->model_prods->create($data);
		    $rfq_id = $this->db->insert_id();
    }
        $this->form_validation->set_rules('namepart', 'namepart', 'trim|required');
        $this->form_validation->set_rules('nopart', 'nopart', 'trim|required');

          
     
         if ($this->form_validation->run() == TRUE) {
             // true case
             //$upload_image = $this->upload_image();
 
             $data = array(
                 'namaperusahaan' => $this->input->post('namaperusahaan'),
                 'alamatkantorpusat' => $this->input->post('alamatkantorpusat'),
                 'alamatkantorcabang' => $this->input->post('alamatkantorcabang'),
                 'telp' => $this->input->post('telp'),
                 'fax' => $this->input->post('fax'),
                 'attn' => $this->input->post('attn'),
                 'namabarang' => $this->input->post('namabarang'),
                 'kriteriaseleksi'=>$this->input->post('kriteriaseleksi'),
                 'npwp'=>$this->input->post('npwp'),
                 'siup'=>$this->input->post('siup'),
                 'brosur'=>$this->input->post('brosur'),
                 'dataproduk'=>$this->input->post('dataproduk'),             
                 'produsen' => $this->input->post('produsen'),
                 'agen'=>$this->input->post('agen'),
                 'perorangan'=>$this->input->post('perorangan'),
                 'hargasaing'=>$this->input->post('hargasaing'),
                 'hargapasar'=>$this->input->post('hargapasar'),
                 'baik'=>$this->input->post('baik'),
                 'cukup'=>$this->input->post('cukup'),
                 'dalamkota'=>$this->input->post('dalamkota'),
                 'luarkota'=>$this->input->post('luarkota'),
                 'luarnegri'=>$this->input->post('luarnegri'),
                 'lengkap'=>$this->input->post('lengkap'),
                 'kl'=>$this->input->post('kl'),
                 'hasil'=>$this->input->post('hasil'),
                 'datecreated'=>$this->input->post('datecreated'),
                 'note'=>$this->input->post('note'),
                 'kesimpulan'=>$this->input->post('kesimpulan'),
                 'tgl'=>$this->input->post('tgl'),
 
 
             );
 
             $create = $this->model_ssbs->create($data);

            }


        }






	public function create()
	{
		if(!in_array('createProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('namepart', 'namepart', 'trim|required');
		$this->form_validation->set_rules('nopart', 'nopart', 'trim|required');
        $this->form_validation->set_rules('material', 'material', 'trim|required');
		$this->form_validation->set_rules('customer_name', 'customer_name', 'trim|required');
     
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();
            $user_id = $this->session->userdata('id');
        	$data = array(
        		'namepart' => $this->input->post('namepart'),
        		'nopart' => $this->input->post('nopart'),
        		'customer_name' => $this->input->post('customer_name'),
        		'tipe' => $this->input->post('tipe'),
        		'drw' => $upload_image,
                'user_id' => $user_id,
        		'material' => $this->input->post('material'),
                'jsatu' => $this->input->post('jsatu'),
                'jdua' => $this->input->post('jdua'),

                'jtiga' => $this->input->post('jtiga'),
                'jempat' => $this->input->post('jempat'),

                'jlima' => $this->input->post('jlima'),
                'jenam' => $this->input->post('jenam'),


                'jtujuh' => $this->input->post('jtujuh'),
                'jdelapan' => $this->input->post('jdelapan'),

                'jsembilan' => $this->input->post('jsembilan'),
                'jsepuluh' => $this->input->post('jsepuluh'),
           //     'titelsatu' => $this->input->post('titelsatu'),
        		'availability' => $this->input->post('availability'),
        	);

            $create = $this->model_prods->create($data);
		$rfq_id = $this->db->insert_id();

	
		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'rfq_id' => $rfq_id,
    			'product' => $this->input->post('product')[$x],
    			'standard' => $this->input->post('standard')[$x],
    			'metode' => $this->input->post('metode')[$x],
    			'frekuensi' => $this->input->post('frekuensi')[$x],

    		);
            $create2 = $this->model_prods->create2($items);
    	//	$this->db->insert('rfqs_item', $items);
        }


// start physical addresss
$count_satu = count($this->input->post('satuitem'));
for($x = 0; $x < $count_satu; $x++) {
    $satu = array(
        'rfq_id' => $rfq_id,
        'satuitem' => $this->input->post('satuitem')[$x],
        'satustandard' => $this->input->post('satustandard')[$x],
        'satufrekuensi' => $this->input->post('satufrekuensi')[$x],
        'satumetode' => $this->input->post('satumetode')[$x],

    );
    $createsatu = $this->model_prods->createsatu($satu);
//	$this->db->insert('rfqs_item', $items);
}

$count_dua = count($this->input->post('duaitem'));
for($x = 0; $x < $count_dua; $x++) {
    $dua = array(
        'rfq_id' => $rfq_id,
        'duaitem' => $this->input->post('duaitem')[$x],
        'duastandard' => $this->input->post('duastandard')[$x],
        'duafrekuensi' => $this->input->post('duafrekuensi')[$x],
        'duametode' => $this->input->post('duametode')[$x],

    );
    $createdua = $this->model_prods->createdua($dua);
//	$this->db->insert('rfqs_item', $items);
}

$count_tiga = count($this->input->post('tigaitem'));
for($x = 0; $x < $count_tiga; $x++) {
    $tiga = array(
        'rfq_id' => $rfq_id,
        'tigaitem' => $this->input->post('tigaitem')[$x],
        'tigastandard' => $this->input->post('tigastandard')[$x],
        'tigafrekuensi' => $this->input->post('tigafrekuensi')[$x],
        'tigametode' => $this->input->post('tigametode')[$x],

    );
    $createtiga = $this->model_prods->createtiga($tiga);
//	$this->db->insert('rfqs_item', $items);
}


$count_empat = count($this->input->post('empatitem'));
for($x = 0; $x < $count_empat; $x++) {
    $empat = array(
        'rfq_id' => $rfq_id,
        'empatitem' => $this->input->post('empatitem')[$x],
        'empatstandard' => $this->input->post('empatstandard')[$x],
        'empatfrekuensi' => $this->input->post('empatfrekuensi')[$x],
        'empatmetode' => $this->input->post('empatmetode')[$x],

    );
    $createempat = $this->model_prods->createempat($empat);
//	$this->db->insert('rfqs_item', $items);
}


$count_lima = count($this->input->post('limaitem'));
for($x = 0; $x < $count_lima; $x++) {
    $lima = array(
        'rfq_id' => $rfq_id,
        'limaitem' => $this->input->post('limaitem')[$x],
        'limastandard' => $this->input->post('limastandard')[$x],
        'limafrekuensi' => $this->input->post('limafrekuensi')[$x],
        'limametode' => $this->input->post('limametode')[$x],

    );
    $createlima = $this->model_prods->createlima($lima);
//	$this->db->insert('rfqs_item', $items);
}


$count_enam = count($this->input->post('enamitem'));
for($x = 0; $x < $count_enam; $x++) {
    $enam = array(
        'rfq_id' => $rfq_id,
        'enamitem' => $this->input->post('enamitem')[$x],
        'enamstandard' => $this->input->post('enamstandard')[$x],
        'enamfrekuensi' => $this->input->post('enamfrekuensi')[$x],
        'enammetode' => $this->input->post('enammetode')[$x],

    );
    $createenam = $this->model_prods->createenam($enam);
//	$this->db->insert('rfqs_item', $items);
}

$count_tujuh = count($this->input->post('tujuhitem'));
for($x = 0; $x < $count_tujuh; $x++) {
    $tujuh = array(
        'rfq_id' => $rfq_id,
        'tujuhitem' => $this->input->post('tujuhitem')[$x],
        'tujuhstandard' => $this->input->post('tujuhstandard')[$x],
        'tujuhfrekuensi' => $this->input->post('tujuhfrekuensi')[$x],
        'tujuhmetode' => $this->input->post('tujuhmetode')[$x],

    );
    $createtujuh = $this->model_prods->createtujuh($tujuh);
//	$this->db->insert('rfqs_item', $items);
}

$count_delapan = count($this->input->post('delapanitem'));
for($x = 0; $x < $count_delapan; $x++) {
    $delapan = array(
        'rfq_id' => $rfq_id,
        'delapanitem' => $this->input->post('delapanitem')[$x],
        'delapanstandard' => $this->input->post('delapanstandard')[$x],
        'delapanfrekuensi' => $this->input->post('delapanfrekuensi')[$x],
        'delapanmetode' => $this->input->post('delapanmetode')[$x],

    );
    $createdelapan = $this->model_prods->createdelapan($delapan);
//	$this->db->insert('rfqs_item', $items);
}

$count_sembilan = count($this->input->post('sembilanitem'));
for($x = 0; $x < $count_sembilan; $x++) {
    $sembilan = array(
        'rfq_id' => $rfq_id,
        'sembilanitem' => $this->input->post('sembilanitem')[$x],
        'sembilanstandard' => $this->input->post('sembilanstandard')[$x],
        'sembilanfrekuensi' => $this->input->post('sembilanfrekuensi')[$x],
        'sembilanmetode' => $this->input->post('sembilanmetode')[$x],

    );
    $createsembilan = $this->model_prods->createsembilan($sembilan);
//	$this->db->insert('rfqs_item', $items);
}

$count_sepuluh = count($this->input->post('sepuluhitem'));
for($x = 0; $x < $count_sepuluh; $x++) {
    $sepuluh = array(
        'rfq_id' => $rfq_id,
        'sepuluhitem' => $this->input->post('sepuluhitem')[$x],
        'sepuluhstandard' => $this->input->post('sepuluhstandard')[$x],
        'sepuluhfrekuensi' => $this->input->post('sepuluhfrekuensi')[$x],
        'sepuluhmetode' => $this->input->post('sepuluhmetode')[$x],

    );
    $createsepuluh = $this->model_prods->createsepuluh($sepuluh);
//	$this->db->insert('rfqs_item', $items);
}

// input quality p
        $count_qc = count($this->input->post('qcitem'));
    	for($x = 0; $x < $count_qc; $x++) {
    		$qc = array(
    			'rfq_id' => $rfq_id,
    			'qcitem' => $this->input->post('qcitem')[$x],
    			'qcstandard' => $this->input->post('qcstandard')[$x],
    			'qcmetode' => $this->input->post('qcmetode')[$x],
    			'qcfrekuensi' => $this->input->post('qcfrekuensi')[$x],

    		);
            $createqc = $this->model_prods->createqc($qc);
    	//	$this->db->insert('rfqs_item', $items);
        }



        //	$create = $this->model_products->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('prods/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('prods/create', 'refresh');
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

          //  $this->render_template('prods/create', $this->data);
          //$this->render_template('prods/createold', $this->data);
          $this->render_template('prods/buat', $this->data);



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


	//public function update($prod_id)
    public function update($id)
	{      
        if(!in_array('updateProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

      //  if(!$prod_id) {
        if(!$id) {
            redirect('dashboard', 'refresh');
        }

      
		$this->form_validation->set_rules('namepart', 'namepart', 'trim|required');
		$this->form_validation->set_rules('nopart', 'nopart', 'trim|required');
        $this->form_validation->set_rules('material', 'material', 'trim|required');
		$this->form_validation->set_rules('customer_name', 'customer_name', 'trim|required');
     
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $user_id = $this->session->userdata('id');
            $data = array(
			
			    'namepart' => $this->input->post('namepart'),
        		'nopart' => $this->input->post('nopart'),
        		'customer_name' => $this->input->post('customer_name'),
        		'tipe' => $this->input->post('tipe'),
        		//'drw' => $upload_image,
                'user_id' => $user_id,
        		'material' => $this->input->post('material'),
        		'availability' => $this->input->post('availability'),
               
            );

            
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
		//file di database drw /image
                $upload_image = array('drw' => $upload_image);
                $this->model_prods->update($upload_image, $id);
               // $this->model_prods->update($upload_image, $prod_id);
            }
            $update = $this->model_prods->update($data, $id);
          //  $update = $this->model_prods->update($data, $prod_id);
			
		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'rfq_id' => $rfq_id,
    			'product' => $this->input->post('product')[$x],
    			'standard' => $this->input->post('standard')[$x],
    			'metode' => $this->input->post('metode')[$x],
    			'frekuensi' => $this->input->post('frekuensi')[$x],

    		);
			
         //   $update2 = $this->model_prods->update2($items, $prod_id);
            $update2 = $this->model_prods->update2($items, $id);
			
			
			
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('prods/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                //redirect('prods/update/'.$prod_id, 'refresh');
                redirect('prods/update/'.$id, 'refresh');
            }
        }
   }
       else {
            // attributes 
          $attribute_data = $this->model_attributes->getActiveAttributeData();

        $attributes_final_data = array();
           foreach ($attribute_data as $k => $v) {
                $attributes_final_data[$k]['attribute_data'] = $v;

               $value = $this->model_attributes->getAttributeValueData($v['id']);

              $attributes_final_data[$k]['attribute_value'] = $value;
           }
            
            // false case
            //$this->data['attributes'] = $attributes_final_data;
            //$this->data['brands'] = $this->model_brands->getActiveBrands();         
            //$this->data['category'] = $this->model_category->getActiveCategroy();           
            //$this->data['stores'] = $this->model_stores->getActiveStore();          
           






            $result = array();
        	$prod_data = $this->model_prods->getProdData($id);
//  [ prod ] = tampilan di html viwer //
    		$result['prod'] = $prod_data;
    		$prods_item = $this->model_prods->getProdItemData($prod_data['id']);

    		foreach($prods_item as $k => $v) {
    			$result['prod_item'][] = $v;
    		}

    		$this->data['prod_data'] = $result;


           // $prod_data = $this->model_prods->getProdData($prod_id);
           
           // $this->data['prod_data'] = $prod_data;
            $this->render_template('prods/edit', $this->data); 
        }   
	}
	

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $prod_id = $this->input->post('prod_id');

        $response = array();
        if($prod_id) {
            $delete = $this->model_prods->remove($prod_id);
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

public function printpdfok($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$prod_data = $this->model_prods->getProdData($id);
			$prod_item = $this->model_prods->getProdItemData($id);
            $prod_satu = $this->model_prods->getProdSatuData($id);
            $prod_dua = $this->model_prods->getProdDuaData($id);
            $prod_tiga = $this->model_prods->getProdTigaData($id);
            $prod_empat = $this->model_prods->getProdEmpatData($id); 
            $prod_lima = $this->model_prods->getProdLimaData($id);
            $prod_enam = $this->model_prods->getProdEnamData($id);




            $prod_qc = $this->model_prods->getProdQcData($id);
		//	$company_info = $this->model_company->getCompanyData(1);

			 
		$output = '
            <style >
			@page { 
					margin-top: 8px;
					margin-bottom: 30px;
					margin-right: 8px;
					margin-left: 8px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			

			
			body {
		  border: 0px solid black;
		  background-color: ;
		  padding-top: 0px;
		  padding-right: 8px;
		  padding-bottom: 8px;
		  padding-left: 8px;
      
		  font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 

		}
		 table .warna {
          
            border-left: 0px;
			border-right: 0px;  			

        }
		
		table .warna1 {
          
         
			border-right: 0px;  			

        }
		
		table .warna2 {
          
            border-left: 0px;
					

        }
		
		table .warna3 {
          
            border-bottom: 0px;
		 			

        }
		
		table .warna4 {
          
            border-top: 0px;
		 			

        }
		
		table .warna5 {
          
            border-top: 0px;
		 	border-bottom: 0px;
		 			

        }

        table .warna6 {
          
            border-right: 0px;
		 	border-left: 0px;
		 			

        }
        table .warna7 {
          
            border-right: 0px;
		 	border-left: 0px;
             border-bottom: 0px;
		 			

        }
        table .warna8 {
          
            border-right: 0px;
            border-left: 0px;
            border-top: 0px;
		 			

        }
        table .warna9 {
          
            
            border-left: 0px;
            border-bottom: 0px;
		 			

        }
        table .warna10 {
          
            
            border-right: 0px;
            border-bottom: 0px;
		 			

        }	
        table .warna11 {
          
            
            border-right: 0px;
            border-bottom: 0px;
            border-top: 0px;	 			

        }
        
        table .warna12 {         
            
            border-left: 0px;
            border-bottom: 0px;
            border-top: 0px;
		 			

        }

        table .warna13 {         
            
            border-left: 0px;
           
            border-top: 0px;
		 			

        }

        table .warna14 {         
            
            border-right: 0px;
           
            border-top: 0px;
		 			

        }

        table .warna15 {
          
            border-right: 0px;
		 	border-left: 0px;
             border-bottom: 0px;
             border-top: 0px;
		 			

        }
			
		   </style>  
	   
	   <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="5%" ><b> FR QAS 00 00&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>
		
		  
		
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="5%" ><b> Ed/Rev : 00/00&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>

		    </table>
            
		    <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="" rowspan="4" align="center" style="font-size:8px" width="10%" ><b><img width="100" height="30" src="assets/images/logo.jpg" /></b></td>
		    <td colspan="" rowspan="4" align="center" style="font-size:14px" width="30%"><b> PT SKI <br>
            
            INSPECTION STANDARD
            </b></td>
		  
          
            <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; PART NO</b></td>
		   <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['nopart'].'</b></td>
		  
		  
		  </tr>
		  
		   <tr>
		   
                <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; PART NAME</b></td>
              <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['namepart'].'</b></td>
		  
		  </tr>
		  
		   <tr>
		 
		   <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; TIPE</b></td>
              <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['tipe'].'</b></td>
		  
		  </tr>

		  <tr>
		  
		  
           <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; MATERIAL</b></td>
           <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['material'].' </b></td>
		  
		  </tr>
		  
		  
		   
		   
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="1" cellpadding="0" cellspacing="0">
        
            <tr>
            <td class="warna3" colspan="6" style="font-size:8px" width=10%">&nbsp; Drawing Skecth :   </td>
            </tr>
			<tr>
            <td class="warna5" colspan="6" style="font-size:8px" width=10%">&nbsp;   </td>
            </tr>
			 <tr>
            <td class="warna5" align="center" colspan="6" style="font-size:8px" width=10%"> <img width="600" height="200" src="'.$prod_data['drw'].'" />   </td>
            </tr>
			
			<tr>
            <td class="warna4" colspan="6" style="font-size:8px" width=10%">&nbsp;   </td>
            </tr>
      </table>    
  <table width="100%" border="1" cellpadding="4" cellspacing="0">		
<tr>
<td style="background-color:#A9A9A9; font-size:8px; width:2%;" align="center" ><b> NO</b></td>
<td colspan="3"  style="background-color:#A9A9A9; font-size:8px; width:17%;" align="center" ><b> ITEM PERIKSA</b></td>
<td colspan="2" style="background-color:#A9A9A9;font-size:8px; width:15%;" align="center"><b>  STANDARD</b></td>
<td colspan="2" style="background-color:#A9A9A9; font-size:8px; width:13%;" align="center"><b>  FREKUENSI</b></td>
<td colspan="2"  style="background-color:#A9A9A9; font-size:8px; width:7%;" align="center"><b>  METODE</b></td>

</tr>';







$no =0;
foreach ($prod_item as $k => $v) {


    $no++;

   $output .= '
   <tr>
   <td  width="2%" align="center" style="font-size:8px">'.$no.'</td>
 <td  colspan="3" width="10%" align="center" style="font-size:8px">'.$v['product'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$v['standard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$v['frekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$v['metode'].'</td>

   </tr>';
}

$output .= '
   
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px" width="100%">. </td>
       
   </tr>
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px; background-color:#A9A9A9;" width="100%">Physical properties of Rubber EPDM </td>
       
   </tr>';

   $output .= '
   <tr>
   <td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jsatu'].' </td></tr> ';

   foreach ($prod_satu as $u => $a) {
      //  $rowspan = true;
      //  $total_source2 = $PAGE_COUNT ;    
    $no++;
 //   $prod_satu = $this->model_prods->getProdsatuData($b['satuitem']); 
	
   $output .= '
  
   <tr>
   <td  colspan="" width="2%" align="center"  style="font-size:8px">&nbsp;'.$no.'</td> 
    <td  colspan="3" width="10%" align="left" style="font-size:8px">&nbsp;'.$a['satuitem'].'</td> 
    <td colspan="2" width="10%" align="center" style="font-size:8px">&nbsp;'.$a['satustandard'].'</td>
    <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$a['satufrekuensi'].'</td>
    <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$a['satumetode'].'</td>

   </tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jdua'].' </td></tr> ';

foreach ($prod_dua as $a => $b) {


 $no++;

$output .= '
<tr>
 
<td  colspan="" width="2%" align="center" style="font-size:8px">&nbsp;'.$no.'</td> 
 <td  colspan="3" width="10%" align="left" style="font-size:8px">&nbsp;'.$b['duaitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">&nbsp;'.$b['duastandard'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$b['duafrekuensi'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$b['duametode'].'</td>

</tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jtiga'].' </td></tr> ';

foreach ($prod_tiga as $a => $c) {


 $no++;

$output .= '
<tr>
 
<td  colspan="" width="2%" align="center"  style="font-size:8px">&nbsp;'.$no.'</td> 
 <td  colspan="3" width="10%" align="left" style="font-size:8px">'.$c['tigaitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$c['tigastandard'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">'.$c['tigafrekuensi'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">'.$c['tigametode'].'</td>

</tr>';

}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jempat'].' </td></tr> ';

   foreach ($prod_empat as $k => $d) {


    $no++;

   $output .= '
   <tr>
   <td  colspan="" width="2%" align="center"  style="font-size:8px">&nbsp;'.$no.'</td> 
 <td  colspan="3" width="10%" align="left" style="font-size:8px">'.$d['empatitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$d['empatstandard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$d['empatfrekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$d['empatmetode'].'</td>

   </tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jlima'].' </td></tr> ';


foreach ($prod_lima as $c => $e) {


    $no++;

   $output .= '
   <tr>
   <td  colspan="" width="2%" align="center"  style="font-size:8px">&nbsp;'.$no.'</td> 
    <td  class="war" colspan="3" width="10%" align="left" style="font-size:8px">'.$e['limaitem'].'</td> 
    <td class="war" colspan="2" width="10%" align="center" style="font-size:8px">'.$e['limastandard'].'</td>
    <td class="warn"  colspan="2" width="15%" align="center" style="font-size:8px">'.$e['limafrekuensi'].'</td>
    <td class="war"  colspan="2" width="15%" align="center" style="font-size:8px">'.$e['limametode'].'</td>

   </tr>';
}

$output .= '
   
  
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px; background-color:#A9A9A9;" width="100%">Quality Hose / Test Product </td>
       
   </tr>';
 

foreach ($prod_qc as $k => $f) {


    $no++;

   $output .= '
   <tr>
   <td  width="2%" align="center" style="font-size:8px">'.$no.'</td>
 <td colspan="3" width="10%" align="center" style="font-size:8px">'.$f['qcitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$f['qcstandard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$f['qcfrekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$f['qcmetode'].'</td>

   </tr>';
}

$output .= '
   
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px" width="100%"><br></td>
       <br><br>

   </tr>
   <tr>
   <td  class="warna10" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
     <td  class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6"  colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna9" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
   

    </tr>

    <tr>
    <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
    <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td  class="" colspan ="3" align ="center" style="font-size:8px" width="5%">PT.KPS / PT.SKI</td>
    
    
     <td  class="" colspan ="3" align ="center" style="font-size:8px" width="5%">'.$prod_data['customer_name'].' </td>
     <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
 
     </tr>

    

      <tr>
      <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
      <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Approved </td>
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Checked </td>
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Prepared </td>
      <td  class="" colspan ="2" align ="center" style="font-size:8px" width="5%">Approved </td>
      <td  class="warna" colspan ="" align ="center" style="font-size:8px" width="5%">Checked </td>
      <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
      
   
       </tr>
   
       <tr>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="" colspan ="2" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna6" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      
       
       <tr>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
       
      
      
       
      
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      
     
    
      
    
        </tr>









        <tr>
        <td  class="warna14" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
        <td  class="warna8" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna8" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna13" class="warna4" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        
     
         </tr>
   
   
   
   
   ';

  
  $output .= '</table>';
			
			
			
			
			
  $source1 = $this->model_prods->getRowspanData($id); 
  $source2 = $this->model_prods->getRowspan2Data($id); 

			$prod_data = $this->model_prods->getProdData($id);
			$prod_item = $this->model_prods->getProdItemData($id);
            $prod_satu = $this->model_prods->getProdSatuData($id);
            $prod_dua = $this->model_prods->getProdDuaData($id);
            $prod_tiga = $this->model_prods->getProdTigaData($id);
            $prod_empat = $this->model_prods->getProdEmpatData($id); 
            $prod_lima = $this->model_prods->getProdLimaData($id);
            $prod_enam = $this->model_prods->getProdEnamData($id);


             $prod_qc = $this->model_prods->getProdQcData($id);
		//	$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
            $dompdf ->setPaper(array(0,0, 612.00, 1008.0), 'portrait'); //ukuran F4
			//$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


        }
    




    public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$prod_data = $this->model_prods->getProdData($id);
			$prod_item = $this->model_prods->getProdItemData($id);
            $prod_satu = $this->model_prods->getProdSatuData($id);
            $prod_dua = $this->model_prods->getProdDuaData($id);
            $prod_tiga = $this->model_prods->getProdTigaData($id);
            $prod_empat = $this->model_prods->getProdEmpatData($id); 
            $prod_lima = $this->model_prods->getProdLimaData($id);
            $prod_enam = $this->model_prods->getProdEnamData($id);


        //    $prod_inc = $this->model_prods->getProdIncData($id);
         //   $prod_cs = $this->model_prods->getProdCsData($id);
         //   $prod_hre = $this->model_prods->getProdHreData($id);
         //   $prod_are = $this->model_prods->getProdAreData($id);
            $source1 = $this->model_prods->getRowspanData($id); 
            $source2 = $this->model_prods->getRowspan2Data($id); 



            $prod_qc = $this->model_prods->getProdQcData($id);
		//	$company_info = $this->model_company->getCompanyData(1);

			 
		$output = '
            <style >
			@page { 
					margin-top: 8px;
					margin-bottom: 30px;
					margin-right: 8px;
					margin-left: 8px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			

			
			body {
		  border: 0px solid black;
		  background-color: ;
		  padding-top: 0px;
		  padding-right: 8px;
		  padding-bottom: 8px;
		  padding-left: 8px;
      
		  font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 

		}
		 table .warna {
          
            border-left: 0px;
			border-right: 0px;  			

        }
		
		table .warna1 {
          
         
			border-right: 0px;  			

        }
		
		table .warna2 {
          
            border-left: 0px;
					

        }
		
		table .warna3 {
          
            border-bottom: 0px;
		 			

        }
		
		table .warna4 {
          
            border-top: 0px;
		 			

        }
		
		table .warna5 {
          
            border-top: 0px;
		 	border-bottom: 0px;
		 			

        }

        table .warna6 {
          
            border-right: 0px;
		 	border-left: 0px;
		 			

        }
        table .warna7 {
          
            border-right: 0px;
		 	border-left: 0px;
             border-bottom: 0px;
		 			

        }
        table .warna8 {
          
            border-right: 0px;
            border-left: 0px;
            border-top: 0px;
		 			

        }
        table .warna9 {
          
            
            border-left: 0px;
            border-bottom: 0px;
		 			

        }
        table .warna10 {
          
            
            border-right: 0px;
            border-bottom: 0px;
		 			

        }	
        table .warna11 {
          
            
            border-right: 0px;
            border-bottom: 0px;
            border-top: 0px;	 			

        }
        
        table .warna12 {         
            
            border-left: 0px;
            border-bottom: 0px;
            border-top: 0px;
		 			

        }

        table .warna13 {         
            
            border-left: 0px;
           
            border-top: 0px;
		 			

        }

        table .warna14 {         
            
            border-right: 0px;
           
            border-top: 0px;
		 			

        }

        table .warna15 {
          
            border-right: 0px;
		 	border-left: 0px;
             border-bottom: 0px;
             border-top: 0px;
		 			

        }
			
		   </style>  
	   
	   <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="5%" ><b> FR QAS 00 00&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>
		
		  
		
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="5%" ><b> Ed/Rev : 00/00&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>

		    </table>
            
		    <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="" rowspan="4" align="center" style="font-size:8px" width="10%" ><b><img width="100" height="30" src="assets/images/logo.jpg" /></b></td>
		    <td colspan="" rowspan="4" align="center" style="font-size:14px" width="30%"><b> PT SKI <br>
            
            INSPECTION STANDARD
            </b></td>
		  
          
            <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; PART NO</b></td>
		   <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['nopart'].'</b></td>
		  
		  
		  </tr>
		  
		   <tr>
		   
                <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; PART NAME</b></td>
              <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['namepart'].'</b></td>
		  
		  </tr>
		  
		   <tr>
		 
		   <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; TIPE</b></td>
              <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['tipe'].'</b></td>
		  
		  </tr>

		  <tr>
		  
		  
           <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; MATERIAL</b></td>
           <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['material'].' </b></td>
		  
		  </tr>
		  
		  
		   
		   
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="1" cellpadding="0" cellspacing="0">
        
            <tr>
            <td class="warna3" colspan="6" style="font-size:8px" width=10%">&nbsp; Drawing Skecth :   </td>
            </tr>
			<tr>
            <td class="warna5" colspan="6" style="font-size:8px" width=10%">&nbsp;   </td>
            </tr>
			 <tr>
            <td class="warna5" align="center" colspan="6" style="font-size:8px" width=10%"> <img width="600" height="200" src="'.$prod_data['drw'].'" />   </td>
            </tr>
			
			<tr>
            <td class="warna4" colspan="6" style="font-size:8px" width=10%">&nbsp;   </td>
            </tr>
      </table>    
  <table width="100%" border="1" cellpadding="4" cellspacing="0">		
<tr>
<td style="background-color:#A9A9A9; font-size:8px; width:2%;" align="center" ><b> NO</b></td>
<td colspan="3"  style="background-color:#A9A9A9; font-size:8px; width:17%;" align="center" ><b> ITEM PERIKSA</b></td>
<td colspan="2" style="background-color:#A9A9A9;font-size:8px; width:15%;" align="center"><b>  STANDARD</b></td>
<td colspan="2" style="background-color:#A9A9A9; font-size:8px; width:13%;" align="center"><b>  FREKUENSI</b></td>
<td colspan="2"  style="background-color:#A9A9A9; font-size:8px; width:7%;" align="center"><b>  METODE</b></td>

</tr>';







$no =0;
foreach ($prod_item as $k => $v) {


    $no++;

   $output .= '
   <tr>
   <td  width="2%" align="center" style="font-size:8px">'.$no.'</td>
 <td  colspan="3" width="10%" align="center" style="font-size:8px">'.$v['product'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$v['standard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$v['frekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$v['metode'].'</td>

   </tr>';
}

$output .= '
   
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px" width="100%">. </td>
       
   </tr>
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px; background-color:#A9A9A9;" width="100%">Physical properties of Rubber EPDM </td>
       
   </tr>';

   $output .= '
   <tr>
   <td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jsatu'].' </td></tr> ';

   foreach ($prod_satu as $u => $a) {
      //  $rowspan = true;
      //  $total_source2 = $PAGE_COUNT ;    
   // $no++;
 //   $prod_satu = $this->model_prods->getProdsatuData($b['satuitem']); 
	
   $output .= '
  
   <tr>
    <td  colspan="4" width="10%" align="left" style="font-size:8px">&nbsp;'.$a['satuitem'].'</td> 
    <td colspan="2" width="10%" align="center" style="font-size:8px">&nbsp;'.$a['satustandard'].'</td>
    <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$a['satufrekuensi'].'</td>
    <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$a['satumetode'].'</td>

   </tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jdua'].' </td></tr> ';

foreach ($prod_dua as $a => $b) {


// $no++;

$output .= '
<tr>
 

 <td  colspan="4" width="10%" align="left" style="font-size:8px">&nbsp;'.$b['duaitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">&nbsp;'.$b['duastandard'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$b['duafrekuensi'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">&nbsp;'.$b['duametode'].'</td>

</tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jtiga'].' </td></tr> ';

foreach ($prod_tiga as $a => $c) {


// $no++;

$output .= '
<tr>
 

 <td  colspan="4" width="10%" align="left" style="font-size:8px">'.$c['tigaitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$c['tigastandard'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">'.$c['tigafrekuensi'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">'.$c['tigametode'].'</td>

</tr>';

}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jempat'].' </td></tr> ';

   foreach ($prod_empat as $k => $d) {


 //   $no++;

   $output .= '
   <tr>
 
 <td  colspan="4" width="10%" align="left" style="font-size:8px">'.$d['empatitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$d['empatstandard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$d['empatfrekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$d['empatmetode'].'</td>

   </tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jlima'].' </td></tr> ';


foreach ($prod_lima as $c => $e) {


 //   $no++;

   $output .= '
   <tr>
  
    <td  class="war" colspan="4" width="10%" align="left" style="font-size:8px">'.$e['limaitem'].'</td> 
    <td class="war" colspan="2" width="10%" align="center" style="font-size:8px">'.$e['limastandard'].'</td>
    <td class="warn"  colspan="2" width="15%" align="center" style="font-size:8px">'.$e['limafrekuensi'].'</td>
    <td class="war"  colspan="2" width="15%" align="center" style="font-size:8px">'.$e['limametode'].'</td>

   </tr>';
}

$output .= '
   
  
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px; background-color:#A9A9A9;" width="100%">Quality Hose / Test Product </td>
       
   </tr>';
 

foreach ($prod_qc as $k => $f) {


    $no++;

   $output .= '
   <tr>
   <td  width="2%" align="center" style="font-size:8px">'.$no.'</td>
 <td colspan="3" width="10%" align="center" style="font-size:8px">'.$f['qcitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$f['qcstandard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$f['qcfrekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$f['qcmetode'].'</td>

   </tr>';
}

$output .= '
   
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px" width="100%"><br></td>
       <br><br>

   </tr>
   <tr>
   <td  class="warna10" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
     <td  class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6"  colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna9" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
   

    </tr>

    <tr>
    <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
    <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td  class="" colspan ="3" align ="center" style="font-size:8px" width="5%">PT.KPS / PT.SKI</td>
    
    
     <td  class="" colspan ="3" align ="center" style="font-size:8px" width="5%">'.$prod_data['customer_name'].' </td>
     <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
 
     </tr>

    

      <tr>
      <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
      <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Approved </td>
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Checked </td>
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Prepared </td>
      <td  class="" colspan ="2" align ="center" style="font-size:8px" width="5%">Approved </td>
      <td  class="warna" colspan ="" align ="center" style="font-size:8px" width="5%">Checked </td>
      <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
      
   
       </tr>
   
       <tr>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="" colspan ="2" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna6" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      
       
       <tr>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
       
      
      
       
      
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      
     
    
      
    
        </tr>









        <tr>
        <td  class="warna14" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
        <td  class="warna8" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna8" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna13" class="warna4" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        
     
         </tr>
   
   
   
   
   ';

  
  $output .= '</table>';
			
			
			
			
			
  $source1 = $this->model_prods->getRowspanData($id); 
  $source2 = $this->model_prods->getRowspan2Data($id); 

			$prod_data = $this->model_prods->getProdData($id);
			$prod_item = $this->model_prods->getProdItemData($id);
            $prod_satu = $this->model_prods->getProdSatuData($id);
            $prod_dua = $this->model_prods->getProdDuaData($id);
            $prod_tiga = $this->model_prods->getProdTigaData($id);
            $prod_empat = $this->model_prods->getProdEmpatData($id); 
            $prod_lima = $this->model_prods->getProdLimaData($id);
            $prod_enam = $this->model_prods->getProdEnamData($id);


        //    $prod_inc = $this->model_prods->getProdIncData($id);
       //     $prod_cs = $this->model_prods->getProdCsData($id);
        //    $prod_hre = $this->model_prods->getProdHreData($id);
       //     $prod_are = $this->model_prods->getProdAreData($id);
            $prod_qc = $this->model_prods->getProdQcData($id);
		//	$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
            $dompdf ->setPaper(array(0,0, 612.00, 1008.0), 'portrait'); //ukuran F4
			//$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


        }
    




    public function printrowspan($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$prod_data = $this->model_prods->getProdData($id);
			$prod_item = $this->model_prods->getProdItemData($id);
            $prod_satu = $this->model_prods->getProdSatuData($id);
            $prod_dua = $this->model_prods->getProdDuaData($id);

            $prod_inc = $this->model_prods->getProdIncData($id);
           // $prod_cs = $this->model_prods->getProdCsData($id);
          //  $prod_hre = $this->model_prods->getProdHreData($id);
         //   $prod_are = $this->model_prods->getProdAreData($id);
         //



            $prod_qc = $this->model_prods->getProdQcData($id);
		//	$company_info = $this->model_company->getCompanyData(1);

			 
		$output = '
            <style >
			@page { 
					margin-top: 8px;
					margin-bottom: 30px;
					margin-right: 8px;
					margin-left: 8px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			

			
			body {
		  border: 0px solid black;
		  background-color: ;
		  padding-top: 0px;
		  padding-right: 8px;
		  padding-bottom: 8px;
		  padding-left: 8px;
      
		  font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 

		}
		 table .warna {
          
            border-left: 0px;
			border-right: 0px;  			

        }
		
		table .warna1 {
          
         
			border-right: 0px;  			

        }
		
		table .warna2 {
          
            border-left: 0px;
					

        }
		
		table .warna3 {
          
            border-bottom: 0px;
		 			

        }
		
		table .warna4 {
          
            border-top: 0px;
		 			

        }
		
		table .warna5 {
          
            border-top: 0px;
		 	border-bottom: 0px;
		 			

        }

        table .warna6 {
          
            border-right: 0px;
		 	border-left: 0px;
		 			

        }
        table .warna7 {
          
            border-right: 0px;
		 	border-left: 0px;
             border-bottom: 0px;
		 			

        }
        table .warna8 {
          
            border-right: 0px;
            border-left: 0px;
            border-top: 0px;
		 			

        }
        table .warna9 {
          
            
            border-left: 0px;
            border-bottom: 0px;
		 			

        }
        table .warna10 {
          
            
            border-right: 0px;
            border-bottom: 0px;
		 			

        }	
        table .warna11 {
          
            
            border-right: 0px;
            border-bottom: 0px;
            border-top: 0px;	 			

        }
        
        table .warna12 {         
            
            border-left: 0px;
            border-bottom: 0px;
            border-top: 0px;
		 			

        }

        table .warna13 {         
            
            border-left: 0px;
           
            border-top: 0px;
		 			

        }

        table .warna14 {         
            
            border-right: 0px;
           
            border-top: 0px;
		 			

        }

        table .warna15 {
          
            border-right: 0px;
		 	border-left: 0px;
             border-bottom: 0px;
             border-top: 0px;
		 			

        }
			
		   </style>  
	   
	   <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="5%" ><b> FR QAS 00 00&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>
		
		  
		
		  <tr>
		   <td colspan="6" align="right" style="font-size:8px" width="5%" ><b> Ed/Rev : 00/00&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		    
		  </tr>
		    </table>
		    <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr>
		   <td colspan="" align="center" style="font-size:8px" width="20%" ><b> PT SHIMADA KARYA INDONESIA</b></td>
		    <td colspan="" rowspan="4" align="center" style="font-size:20px" width="30%"><b> PT SKI <br>
            
            INSPECTION STANDARD
            </b></td>
		  
          
            <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; PART NO</b></td>
		   <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['nopart'].'</b></td>
		  
		  
		  </tr>
		  
		   <tr>
		    <td colspan="" rowspan="3" align="center" style="font-size:8px" width="20%" ><b><img width="140" height="50" src="assets/images/logo.jpg" /></b></td>
		
                <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; PART NAME</b></td>
              <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['namepart'].'</b></td>
		  
		  </tr>
		  
		   <tr>
		 
		   <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; TIPE</b></td>
              <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['tipe'].'</b></td>
		  
		  </tr>

		  <tr>
		  
		  
           <td colspan="" align="left" style="font-size:8px" width="10%"><b>&nbsp; MATERIAL</b></td>
           <td colspan="" align="left" style="font-size:8px" width="17%"><b>&nbsp;'.$prod_data['material'].' </b></td>
		  
		  </tr>
		  
		  
		   
		   
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="1" cellpadding="0" cellspacing="0">
        
            <tr>
            <td class="warna3" colspan="6" style="font-size:8px" width=10%">&nbsp; Drawing Skecth :   </td>
            </tr>
			<tr>
            <td class="warna5" colspan="6" style="font-size:8px" width=10%">&nbsp;   </td>
            </tr>
			 <tr>
            <td class="warna5" align="center" colspan="6" style="font-size:8px" width=10%"> <img width="700" height="250" src="'.$prod_data['drw'].'" />   </td>
            </tr>
			
			<tr>
            <td class="warna4" colspan="6" style="font-size:8px" width=10%">&nbsp;   </td>
            </tr>
      </table>    
  <table width="100%" border="1" cellpadding="4" cellspacing="0">		
<tr>
<td style="background-color:#A9A9A9; font-size:8px; width:2%;" align="center" ><b> NO</b></td>
<td colspan="3"  style="background-color:#A9A9A9; font-size:8px; width:17%;" align="center" ><b> ITEM PERIKSA</b></td>
<td colspan="2" style="background-color:#A9A9A9;font-size:8px; width:15%;" align="center"><b>  STANDARD</b></td>
<td colspan="2" style="background-color:#A9A9A9; font-size:8px; width:13%;" align="center"><b>  FREKUENSI</b></td>
<td colspan="2"  style="background-color:#A9A9A9; font-size:8px; width:7%;" align="center"><b>  METODE</b></td>

</tr>';







$no =0;
foreach ($prod_item as $k => $v) {


    $no++;

   $output .= '
   <tr>
   <td align="center" style="font-size:8px">'.$no.'</td>
 <td  colspan="3" width="10%" align="center" style="font-size:8px">'.$v['product'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$v['standard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$v['frekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$v['metode'].'</td>

   </tr>';
}
$output .= '
   
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px" width="100%">. </td>
       
   </tr>
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px; background-color:#A9A9A9;" width="100%">Physical properties of Rubber EPDM </td>
       
   </tr>';

   $output .= '
   <tr>
   <td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jsatu'].' </td></tr> ';

   foreach ($prod_satu as $a => $b) {


    $no++;
   
   $output .= '
   <tr>
    
  
    <td  colspan="4" width="10%" align="left" style="font-size:8px">'.$b['satuitem'].'</td> 
    <td colspan="2" width="10%" align="center" style="font-size:8px">'.$b['satustandard'].'</td>
    <td colspan="2" width="15%" align="center" style="font-size:8px">'.$b['satufrekuensi'].'</td>
    <td colspan="2" width="15%" align="center" style="font-size:8px">'.$b['satumetode'].'</td>

   </tr>';
}
$output .= '
<tr>
<td colspan ="10" align ="left" style="font-size:8px; background-color:#ffffff;" width="100%">&nbsp;'.$prod_data['jdua'].' </td></tr> ';

foreach ($prod_dua as $a => $b) {


 $no++;

$output .= '
<tr>
 

 <td  colspan="4" width="10%" align="left" style="font-size:8px">'.$b['duaitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$b['duastandard'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">'.$b['duafrekuensi'].'</td>
 <td colspan="2" width="15%" align="center" style="font-size:8px">'.$b['duametode'].'</td>

</tr>';
}


$output .= '
   
  
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px; background-color:#A9A9A9;" width="100%">Quality Hose / Test Product </td>
       
   </tr>';
 

foreach ($prod_qc as $k => $c) {


    $no++;

   $output .= '
   <tr>
   <td align="center" style="font-size:8px">'.$no.'</td>
 <td colspan="3" width="10%" align="center" style="font-size:8px">'.$c['qcitem'].'</td> 
 <td colspan="2" width="10%" align="center" style="font-size:8px">'.$c['qcstandard'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$c['qcfrekuensi'].'</td>
   <td colspan="2" width="15%" align="center" style="font-size:8px">'.$c['qcmetode'].'</td>

   </tr>';
}

$output .= '
   
   <tr>
       <td colspan ="10" align ="center" style="font-size:8px" width="100%"><br></td>
       <br><br>

   </tr>
   <tr>
   <td  class="warna10" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
     <td  class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6"  colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna7" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td class="warna9" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
   

    </tr>

    <tr>
    <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
    <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
     <td  class="" colspan ="3" align ="center" style="font-size:8px" width="5%">PT.KPS / PT.SKI</td>
    
    
     <td  class="" colspan ="3" align ="center" style="font-size:8px" width="5%">'.$prod_data['customer_name'].' </td>
     <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
     <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
 
     </tr>

    

      <tr>
      <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
      <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Approved </td>
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Checked </td>
      <td  class="" colspan ="" align ="center" style="font-size:8px" width="5%">Prepared </td>
      <td  class="" colspan ="2" align ="center" style="font-size:8px" width="5%">Approved </td>
      <td  class="warna" colspan ="" align ="center" style="font-size:8px" width="5%">Checked </td>
      <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
    
      
   
       </tr>
   
       <tr>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna5" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="" colspan ="2" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna6" colspan ="" rowspan="2" align ="center" style="font-size:8px" width="5%"> <br> </td>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      
       
       <tr>
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="2%"></td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"></td>
       
      
      
       
      
       <td  class="warna11" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
       <td  class="warna12" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
      
     
    
      
    
        </tr>









        <tr>
        <td  class="warna14" colspan ="" align ="center" style="font-size:8px" width="2%"> </td>
        <td  class="warna8" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna6" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna8" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        <td  class="warna13" class="warna4" colspan ="" align ="center" style="font-size:8px" width="5%"> </td>
        
     
         </tr>
   
   
   
   
   ';

  
  $output .= '</table>';
			
			
			
			
			
			

			$prod_data = $this->model_prods->getProdData($id);
			$prod_item = $this->model_prods->getProdItemData($id);
            $prod_satu = $this->model_prods->getProdSatuData($id);
            $prod_dua = $this->model_prods->getProdDuaData($id);


            $prod_inc = $this->model_prods->getProdIncData($id);
           // $prod_cs = $this->model_prods->getProdCsData($id);
           // $prod_hre = $this->model_prods->getProdHreData($id);
          //  $prod_are = $this->model_prods->getProdAreData($id);
            $prod_qc = $this->model_prods->getProdQcData($id);
		//	$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}






}