<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Compound extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Compound';

		$this->load->model('model_compound');
		$this->load->model('model_suppliers');
		$this->load->model('model_material');
	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewCompound', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_compound->getCompoundData();

		$this->data['results'] = $result;
		
		$this->render_template('compound/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchCompoundData()
	{
		$result = array('data' => array());

		$data = $this->model_compound->getCompoundData();
		foreach ($data as $key => $value) {
			$supplier = $this->model_suppliers->getSupplierData($value['supplier_id']);

			$kompon = $this->model_material->getMaterialData($value['namecompound']);
			// button

		
			$buttons = '';
		//	if(in_array('viewCompound', $this->permission)) {
		//		$buttons .= '<a target="__blank" href="'.base_url('compound/print/'.$value['id']).'" class="btn btn-default"><i class="fa fa-qrcode"></i></a>';
		//	}
		//	if(in_array('viewCompound', $this->permission)) {
		//		$buttons .= '<a target="__blank" href="'.base_url('compound/printqrcode/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
		//	}
		//	if(in_array('viewCompound', $this->permission)) {
		//		$buttons .= '<a target="__blank" href="'.base_url('compound/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
		//	}

		//	if(in_array('viewCompound', $this->permission)) {
		//		$buttons .= '<button type="button" class="btn btn-default" onclick="detailSupplier('.$value['id'].')" data-toggle="modal" data-target="#detailCompoundModal"><i class="fa fa-eye"></i></button>';	
		//	}
		//	if(in_array('viewCompound', $this->permission)) {
		//		$buttons .= '<button type="button" class="btn btn-default" onclick="editSupplier('.$value['id'].')" data-toggle="modal" data-target="#editSupplierModal"><i class="fa fa-pencil"></i></button>';	
		//	}
		if(in_array('viewCompound', $this->permission)) {
			$buttons .= '<a target="__blank" href="'.base_url('compound/view/'.$value['id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
		}	

			if(in_array('deleteCompound', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeCompound('.$value['id'].')" data-toggle="modal" data-target="#removeCompoundModal"><i class="fa fa-trash"></i></button>
				';
			}
			
			

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$img = '<img src="'.base_url($value['qrcode']).'" alt="" class="img-circle" width="50" height="50" />';

			if($value['hasil'] < 5) {
				$hasil = '<a target="__blank" href="'.base_url('compound/ncr/'.$value['id']).'" class="btn btn-danger"><span class="label label-danger"></span>NCR</a>';
			}
			else { 
				$hasil = '<span class="label label-success">OK</span>'; //jika ok disini tampilnya
			}
			$print='';
			if($value['hasil'] < 5) {
				$print = '<span class="label label-warning">Silahkan Isi Form NCR </span>';
			}
			else { 
				$print = '<a target="__blank" href="'.base_url('compound/print/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';//jika ok disini tampilnya
			}

			$printncr = '';
            if(in_array('viewCompound', $this->permission)) {
    			$printncr .= '<a href="'.base_url('compound/printncr/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }
           


			$result['data'][$key] = array(
                $img,
				$value['codecompound'],				
				$value['name'],
				$supplier['name'],
				$value['bmact'],
				$value['incomingdate'],
                $value['expireddate'],
				$hasil,
				$printncr,
				$print,
				
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
	public function fetchCompoundDataById($id)
	{
		if($id) {
			$data = $this->model_compound->getCompoundData($id);
			echo json_encode($data);
		}

		return false;
	}

	public function getMaterialById()
	{
		$material_id = $this->input->post('material_id');
		if($material_id){
			$material_data = $this->model_material->getMaterialData($material_id);
			echo json_encode($material_data);
		}
		
	}


	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createCompound', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('codecompound', 'codecompound', 'trim|required');
		$this->form_validation->set_rules('namecompound', 'namecompound', 'trim|required');
		$this->form_validation->set_rules('incomingdate', 'incomingdate', 'trim|required');
		$this->form_validation->set_rules('expireddate', 'expireddate', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
		$cek = $this->db->query("SELECT * FROM compound where codecompound='".$this->input->post('codecompound')."' and nolot ='".$this->input->post('nolot')."' ")->num_rows();
		
        if ($cek<=0) {
           
			$no=$this->input->post('nourut');
        	$sp=$this->input->post('codecompound');
			$sq=$this->input->post('incomingdate');
			$ep=$this->input->post('expireddate');
			//$newFormat = date_format($sq,"Ymd");
			$newFormat = date("Ymd",strtotime($sq));
			$bs = '/';
			$all=$sp.''.$newFormat.''.$no;

		//	$hsst = $this->input->post('hsst');
		//	$tbst = $this->input->post('tbst');
		//	$ebst = $this->input->post('ebst');
		//	$sgst= $this->input->post('sgst');
			$bmst = $this->input->post('bmst_value');
			$hsst = $this->input->post('hsst_value');
			$tbst = $this->input->post('tbst_value');
			$ebst = $this->input->post('ebst_value');
			$sgst= $this->input->post('sgst_value');
			$result= $hsst + $ebst + $sgst + $tbst + $bmst;
        	$data = array(
        		'codecompound' => $this->input->post('codecompound'),
				'namecompound' => $this->input->post('namecompound'),
				'nourut' => $this->input->post('nourut'),
				'incomingdate' => $this->input->post('incomingdate'),
				'expireddate' => $this->input->post('expireddate'),
                'qrcode'=> $all,
				'barcode'=> $all,
				'supplier_id' => $this->input->post('supplier'),
				'hsstd' => $this->input->post('hsstd'),
				'hsact' => $this->input->post('hsact'),
				'name' => $this->input->post('namecomp'),
				'hsst' => $this->input->post('hsst_value'),
			    //'hsst' => $this->input->post('hsst'),
				'tbstd' => $this->input->post('tbstd'),
			    'tbact' => $this->input->post('tbact'),
				'tbst' => $this->input->post('tbst_value'),
			//	'tbst' => $this->input->post('tbst'),
				'ebstd' => $this->input->post('ebstd'),
				'ebact' => $this->input->post('ebact'),
				'ebst' => $this->input->post('ebst_value'),
			//'ebst' => $this->input->post('ebst'),
				'sgstd' => $this->input->post('sgstd'),
				'sgact' => $this->input->post('sgact'),
				'sgst' => $this->input->post('sgst_value'),
			//'sgst' => $this->input->post('sgst'),
				'received' => $this->input->post('received'),
			//	'result' => $this->input->post('result'),
			//	'result' => $result,
				'hasil' => $result,
				'nolot' => $this->input->post('nolot'),
				'nosj' => $this->input->post('nosj'),
        		'active' => $this->input->post('active'),
				'bmstd' => $this->input->post('bmstd'),
				'bmact' => $this->input->post('bmact'),
				'bmst' => $this->input->post('bmst_value'),
				
        	);
        }

		//ok create barcode
		//	$this->load->library('zend');
		//	$this->zend->load('Zend/Barcode');
			//generate barcode
		//	$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$all), array())->draw();
		//	imagepng($imageResource, 'assets/images/barcode/'.$all.'.png');
    
         	$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			//$this->load->library('zend');
			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './assets/images/qrcode/'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
	
		//	$image_name=$sp.'.png'; //buat name dari qr code sesuai dengan nim
		    $image_name= $all.'.png'; 
			$params['data'] = $all; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params);

	        $create = $this->model_compound->create($data);
            
         if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('compound/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('compound/create', 'refresh');
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

        //  $this->data['attributes'] = $attributes_final_data;
	    //	$this->data['brands'] = $this->model_brands->getActiveBrands();        	
		//	$this->data['category'] = $this->model_category->getActiveCategroy();  
			$this->data['material'] = $this->model_material->getActiveMaterialData();
			$this->data['supplier'] = $this->model_suppliers->getActiveSuppliers();  
			$this->data['nourut'] = $this->model_material->buat_kode();   
			//$this->data['tgl_pinjam'] = $this->model_material->getPinjam();        
			//$this->data['tgl_kembali'] = $this->model_material->getPinjam();        	
            $this->render_template('compound/create', $this->data);
        }
    	
	}
	public function createok()
	{

		if(!in_array('createCompound', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('codecompound', 'codecompound', 'trim|required');
		$this->form_validation->set_rules('namecompound', 'namecompound', 'trim|required');
		$this->form_validation->set_rules('incomingdate', 'incomingdate', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$sp=$this->input->post('codecompound');
		$sq=$this->input->post('incomingdate');

		//$newFormat = date_format($sq,"Ymd");
		//$newFormat = date("Ymd",strtotime($sq));
		$bs = '/';
		$all=$sp.''.$sq;
		//$all=$sp.''.$bs.''.$newFormat.''.$bs;
        if ($this->form_validation->run() == TRUE) {

			$cek = $this->db->query("SELECT * FROM compound where codecompound='".$this->input->post('codecompound')."' and incomingdate ='".$this->input->post('incomingdate')."' ")->num_rows();
		
        if ($cek<=0) {
		
        	$data = array(

        		'codecompound' => $this->input->post('codecompound'),
				'namecompound' => $this->input->post('namecompound'),
				'qtycompound' => $this->input->post('qtycompound'),
				'incomingdate' => $this->input->post('incomingdate'),
				'expireddate' => $this->input->post('expireddate'),
                'qrcode'=> $all,
        		'active' => $this->input->post('active'),	
        	);

		}
            //ok create barcode
		//	$this->load->library('zend');
		//	$this->zend->load('Zend/Barcode');
			//generate barcode
		//	$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$all), array())->draw();
		//	imagepng($imageResource, 'images/'.$all.'.png');
	

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			//$this->load->library('zend');
			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './assets/images/qrcode/'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
	
		//	$image_name=$sp.'.png'; //buat name dari qr code sesuai dengan nim
		    $image_name= $all.'.png'; 
			$params['data'] = $all; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params);

			
			//load in folder Zend
			
	
        	$create = $this->model_compound->create($data);
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
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/ncr';
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
	public function image_after()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/ncr';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('fpai'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['fpai']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }
	public function image_before()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/ncr';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('fpbi'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['fpbi']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

	public function ncr($id)
	{
	
	$this->form_validation->set_rules('nosj', 'nosj', 'trim|required');
	$this->form_validation->set_rules('nolot', 'nolot', 'trim|required');
	
	if ($this->form_validation->run() == TRUE) {	
		$upload_image = $this->upload_image();
		$image_after = $this->image_after();
		$image_before = $this->image_before();

		$data = array(
			'dept' => $this->input->post('dept'),
			'sup' => $this->input->post('sup'),
			'cus' => $this->input->post('cus'),
			'partno' => $this->input->post('partno'),
			'partname' => $this->input->post('partname'),
			'tipe' => $this->input->post('tipe'),
			'compound_id' => $id,
			'ncr_id' => $id,
			'nolot'=> $this->input->post('nolot'),
			'nosj' => $this->input->post('nosj'),
			'tglkirim' => $this->input->post('tglkirim'),
			'tglprod' => $this->input->post('tglprod'),
			'jmlreturn' => $this->input->post('jmlreturn'),
			'uraianmasalah' => $this->input->post('uraianmasalah'),
			'tglditemukanng' => $this->input->post('tglditemukanng'),
			'tglditerima'=> $this->input->post('tglditerima'),
			'tmptng' => $this->input->post('tmptng'),
			'jmlng' => $this->input->post('jmlng'),
			'prosentaseng' => $this->input->post('prosentaseng'),
			'whaman' => $this->input->post('whaman'),
			'whamachine' => $this->input->post('whamachine'),
			'whamethode' => $this->input->post('whamethode'),
			'whamaterial' => $this->input->post('whamaterial'),
			'whbman' => $this->input->post('whbman'),
			'whbmachine' => $this->input->post('whbmachine'),
			'whbmethode' => $this->input->post('whbmethode'),
			'whbmaterial'=> $this->input->post('whbmaterial'),
			'whcman' => $this->input->post('whcman'),
			'whcmachine' => $this->input->post('whcmachine'),
			'whcmethode' => $this->input->post('whcmethode'),
			'whcmaterial' => $this->input->post('whcmaterial'),
			'note' => $this->input->post('note'),
			'sketech' => $upload_image,
			'fpbi' => $image_before,
			'fpai' => $image_after,			
				'evasatu' => $this->input->post('evasatu'),
				'evadua' => $this->input->post('evadua'),
				'hasilevasatu' => $this->input->post('hasilevasatu'),
				'hasilevadua' => $this->input->post('hasilevadua'),
				'tglevasatu' => $this->input->post('tglevasatu'),
				'tglevadua' => $this->input->post('tglevadua'),
				'disiapkansatu' => $this->input->post('disiapkansatu'),
				'diperiksasatu' => $this->input->post('diperiksasatu'),
				'diketahuisatu' => $this->input->post('diketahuisatu'),
				'disiapkandua' => $this->input->post('disiapkandua'),
				'diperiksadua' => $this->input->post('diperiksadua'),
				'diketahuidua' => $this->input->post('diketahuidua'),
				'evadeptsatu' => $this->input->post('evadeptsatu'),
				'evadeptdua' => $this->input->post('evadeptdua'),
				'tglpsi' => $this->input->post('tglpsi'),
				'nolotpsi'=> $this->input->post('nolotpsi'),
				'penyebabutama' => $this->input->post('penyebabutama'),
				'tinsemsatu' => $this->input->post('tinsemsatu'),
				'tinsemsatutgl' => $this->input->post('tinsemsatutgl'),
				'tinsemdua' => $this->input->post('tinsemdua'),
				'tinsemduatgl' => $this->input->post('tinsemduatgl'),
				'tinsemtiga' => $this->input->post('tinsemtiga'),
				'tinsemtigatgl' => $this->input->post('tinsemtigatgl'),
				'tinkorsatu' => $this->input->post('tinkorsatu'),
				'tinkorsatutgl' => $this->input->post('tinkorsatutgl'),
				'tinkordua' => $this->input->post('tinkordua'),
				'tinkorduatgl' => $this->input->post('tinkorduatgl'),
				'tinkortiga' => $this->input->post('tinkortiga'),
				'tinkortigatgl' => $this->input->post('tinkortigatgl'),
		);

	
		$update = $this->model_compound->createncr($data, $id);
		if($update == true) {
			$this->session->set_flashdata('success', 'Successfully updated');
			redirect('compound/', 'refresh');
		}
		else {
			$this->session->set_flashdata('errors', 'Error occurred!!');
			redirect('compound/update/'.$id, 'refresh');
		}
	}
	else {
		$this->data['material'] = $this->model_material->getMaterialData();          

		$compound_data = $this->model_compound->getCompoundData($id);
		$this->data['compound_data'] = $compound_data;
		$this->render_template('compound/ncr', $this->data); 
	}   
}


	public function ncrold($id)
	{
		if(!in_array('viewCompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'NCR Compound';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_compound->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('compound/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('compound/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        //	$company = $this->model_company->getCompanyData(1);
        //	$this->data['company_data'] = $company;
        //	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        //	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$compound_data = $this->model_compound->getCompoundData($id);

    		$result['compound_data'] = $compound_data;
    //		$compound_item = $this->model_compound->getPocompoundItemData($pocompound_data['id']);

    //		foreach($pocompound_item as $k => $v) {
    //			$result['pocompound_item'][] = $v;
    //		}

    	//	$this->data['compound_data'] = $result;

        //	$this->data['products'] = $this->model_products->getActiveProductData();      	
        //	$this->data['customer'] = $this->model_customers->getActiveCustomerData(); 
		//   $this->data['vroducts'] = $this->model_vroducts->getActiveVroductData();      	
     	
            $this->render_template('compound/ncr', $this->data);
        }
	}
	public function view($id)
	{
		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
		$this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	 //   $this->form_validation->set_rules('mix', 'mix', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required');
	   // $this->form_validation->set_rules('store', 'Store', 'trim|required');
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');
	
		if ($this->form_validation->run() == TRUE) {	
			$data = array(
				'codecompound' => $this->input->post('codecompound'),
					'namecompound' => $this->input->post('namecompound'),
					'qtycompound' => $this->input->post('qtycompound'),
					'incomingdate' => $this->input->post('incomingdate'),
					'expireddate' => $this->input->post('expireddate'),
					'qrcode'=> $all,
					'barcode'=> $all,
					'supplier_id' => $this->input->post('supplier'),
					'hsstd' => $this->input->post('hsstd'),
					'hsact' => $this->input->post('hsact'),
					'hsst' => $this->input->post('hsst'),
					'tbstd' => $this->input->post('tbstd'),
					'tbact' => $this->input->post('tbact'),
					'tbst' => $this->input->post('tbst'),
					'ebstd' => $this->input->post('ebstd'),
					'ebact' => $this->input->post('ebact'),
					'ebst' => $this->input->post('ebst'),
					'sgstd' => $this->input->post('sgstd'),
					'sgact' => $this->input->post('sgact'),
					'sgst' => $this->input->post('sgst'),
					'received' => $this->input->post('received'),
				//	'result' => $this->input->post('result'),
					'result' => $result,
					'nolot' => $this->input->post('nolot'),
					'nosj' => $this->input->post('nosj'),
					'active' => $this->input->post('active'),	
			);
	
			
			if($_FILES['product_image']['size'] > 0) {
				$upload_image = $this->upload_image();
				$upload_image = array('image' => $upload_image);
				
				$this->model_compound->update($upload_image, $id);
			}
	
			$update = $this->model_compound->update($data, $id);
			if($update == true) {
				$this->session->set_flashdata('success', 'Successfully updated');
				redirect('compound/', 'refresh');
			}
			else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('compound/update/'.$id, 'refresh');
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
			$this->data['material'] = $this->model_material->getMaterialData();          
			$this->data['supplier'] = $this->model_suppliers->getSupplierData();  
			$this->data['namecompound'] = $this->model_material->getMaterialData();
			


			$compound_data = $this->model_compound->getCompoundData($id);
			$this->data['compound_data'] = $compound_data;
			$this->render_template('compound/view', $this->data); 
		}   
	}
	
	public function update($id)
	{
		if(!in_array('updateSupplier', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_supplier_name', 'Supplier name', 'trim|required');
			$this->form_validation->set_rules('edit_telp', 'telp', 'trim|required');
			$this->form_validation->set_rules('edit_fax', 'fax', 'trim|required');
			$this->form_validation->set_rules('edit_alamat', 'alamat', 'trim|required');
			$this->form_validation->set_rules('edit_attn', 'attn', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_supplier_name'),
					'telp' => $this->input->post('edit_telp'),
					'fax' => $this->input->post('edit_fax'),
					'alamat' => $this->input->post('edit_alamat'),
					'attn' => $this->input->post('edit_attn'),					
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_suppliers->update($data, $id);
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
		if(!in_array('deleteCompound', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$compound_id = $this->input->post('compound_id');
		$response = array();
		if($compound_id) {
			$delete = $this->model_compound->remove($compound_id);

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

	
	public function printsm($id)
	{
		$dompdf = new Dompdf();
		
		if(!in_array('viewCompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$compound_data = $this->model_compound->getCompoundData($id);
		//	$orders_items = $this->model_orders->getOrdersItemData($id);
			$supplier = $this->model_suppliers->getSupplierData($compound_data['supplier_id']);
			$material = $this->model_material->getMaterialData($compound_data['namecompound']);
			
	

			$hsst = ($compound_data['hsst'] == 1) ? "OK" : "NG";
			$ebst = ($compound_data['ebst'] == 1) ? "OK" : "NG";
			$tbst = ($compound_data['tbst'] == 1) ? "OK" : "NG";
			$sgst = ($compound_data['sgst'] == 1) ? "OK" : "NG";
			$hasil = ($compound_data['hasil'] == 4) ? "OK" : "NG";
			$output = '
			<style >
			@page { 
					margin-top: 10px;
					margin-bottom: 10px;
					margin-right: 10px;
					margin-left: 10px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			
			body {
		  		border: 1px solid black;
		  		background-color: ;
		  		padding-top: 10px;
		  		padding-right: 10px;
		  		padding-bottom: 10px;
		  		padding-left: 10px;	   
	   	  		font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 
		  }
		

		  table noBorder {
			border-top: none;
			border-bottom: none;
		
			}
				table asli td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
				
				}

				.cekpoint { background-color: #EEEEEE;
					text-align: left;
					border: 0px solid #000000;
					
					text-transform: uppercase;

				}

				table .warna {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #ffffff;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #ffffff;
					padding: 1px;
					
					
				}

				table .a {
					border-bottom: 1px solid  #ffffff;
				}

				table .b {
					border-top:    1px solid  #ffffff;
				
				}



				
			
		   </style>
		
	     <table width="100%" border="1" cellpadding="1" cellspacing="0">
         	<tr >
               <td COLSPAN="7" style="font-size:10px" width="" class="warna"><b>PT. SHIMADA KARYA INDONESIA</b>
			   <br><br> <b>QC INCOMING CARD </b>    </td>
               <td ROWSPAN="1" COLSPAN="2"  align="center" style="font-size:10px; font-family:verdana;" width="" class="warna">&nbsp;<br><img width="50" height="50" class="cekpoint" src="assets/images/qrcode/'.$compound_data['qrcode'].'.png" />&nbsp;</td>
              
            </tr>

			<tr >
			<td COLSPAN="7"  style="font-size:9px" width="" class="warna"></td>
		
		   
		    </tr>  


           <tr>
               <td COLSPAN="4" style="font-size:8px" width="">Coding   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['codecompound'].' </td>
              
            </tr>

			<tr>
			   <td COLSPAN="4" style="font-size:8px" width="">No. Surat Jalan   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['nosj'].' </td>
		   
		    </tr>

		 <tr>
		 	   <td COLSPAN="4" style="font-size:8px" width="">Nama Supplier   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$supplier['name'].' </td>
	     </tr>

		 <tr>
		 	   <td COLSPAN="4" style="font-size:8px" width="">Material Name   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$material['matname'].' </td>
	     </tr>
		 <tr>
		 		<td COLSPAN="4" style="font-size:8px" width="">No. Lot   </td>
				<td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['nolot'].' </td>
  		</tr>
		 <tr>
		 		<td  COLSPAN="4" style="font-size:8px" width="">Incoming Date   </td>
		 		<td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['incomingdate'])). '</td>
	     </tr>

		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Expired Date   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['expireddate'])).' </td>
		
	     </tr>

		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Quantity   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['qtysm'].' </td>
		
	     </tr>

		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Urutan FIFO   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['ufifo'].' </td>
		
	     </tr>
		 

		 

		


		 <tr>
		 <td COLSPAN="4" class="a" style="font-size:8px" width="" align="left">Notes : </td>
		 <td COLSPAN="3" style="font-size:8px"  align="center">Received By</td>
		 <td COLSPAN="3" style="font-size:8px"  align="center">Result</td>
		 
		 </tr>

		 <tr>
		 <td rowspan="" class ="b" colspan="4" style="font-size:8px" width=10%" align="center"><br><br>  </td>
		 <td rowspan="" COLSPAN="3" style="font-size:8px"  align="center"><br>'.$compound_data['received'].'<br></td>
		 <td rowspan="" COLSPAN="3" style="font-size:14px"  align="center"><br>'.$hasil.'<br></td>
		 
		 </tr>

		 

		 

	</table>
    </table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
	  



	 	</thead>  

       ';
  $output .= '</table>';
			$compound_data = $this->model_compound->getCompoundData($id);
			//$compound_items = $this->model_orders->getOrdersItemData($id);
			//$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			//$dompdf ->setpaper('A5','landscape');
	
		//	$dompdf ->setPaper( array(0, 0, 419.53, 595.28),'portrait');
			$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'portrait'); //ukuran A6
		
		//	$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'landscape');
			$dompdf ->render();
			$dompdf ->stream('qrcompound.php',array("Attachment" => false));
		}
	
	}


	public function print($id)
	{
		$dompdf = new Dompdf();
		
		if(!in_array('viewCompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$compound_data = $this->model_compound->getCompoundData($id);
			$supplier = $this->model_suppliers->getSupplierData($compound_data['supplier_id']);
			$material = $this->model_material->getMaterialData($compound_data['namecompound']);
			
		//	$orders_items = $this->model_orders->getOrdersItemData($id);
		//	$company_info = $this->model_company->getCompanyData(1);

		//	$order_date = date('d/m/Y', $order_data['date_time']);
			$hsst = ($compound_data['hsst'] == 1) ? "OK" : "NG";
			$ebst = ($compound_data['ebst'] == 1) ? "OK" : "NG";
			$tbst = ($compound_data['tbst'] == 1) ? "OK" : "NG";
			$sgst = ($compound_data['sgst'] == 1) ? "OK" : "NG";
			$hasil = ($compound_data['hasil'] == 4) ? "OK" : "NG";
			$output = '
			<style >
			@page { 
					margin-top: 30px;
					margin-bottom: 10px;
					margin-right: 10px;
					margin-left: 30px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			
			body {
		  		border: 1px solid black;
		  		background-color: ;
		  		padding-top: 0px;
		  		padding-right: 5px;
		  		padding-bottom: 5px;
		  		padding-left: 5px;	   
	   	  		font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 
		  }
		

		  table noBorder {
			border-top: none;
			border-bottom: none;
		
			}
				table asli td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
				
				}

				.cekpoint { background-color: #EEEEEE;
					text-align: left;
					border: 0px solid #000000;
					
					text-transform: uppercase;

				}

				table .warna {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #ffffff;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #ffffff;
					padding: 1px;
					
					
				}

				table .a {
					border-bottom: 1px solid  #ffffff;
				}

				table .b {
					border-top:    1px solid  #ffffff;
				
				}
			
		   </style>
		
	     <table width="100%" border="1" cellpadding="1" cellspacing="0">
		 <tr >
		 <td COLSPAN="13" align="right" style="font-size:5px" width="" class="warna">FR QAS 01 02<br> ED/REV 01/02</td>
		 </tr>
         	<tr >
               <td COLSPAN="9" style="font-size:10px" width="" class="warna"><b>PT. SHIMADA KARYA INDONESIA</b>
			   <br><br> <b>QC INCOMING CARD </b>    </td>
               <td ROWSPAN="1" COLSPAN="4"  align="center" style="font-size:10px; font-family:verdana;" width="" class="warna"> &nbsp;<br><img width="50" height="50" class="cekpoint" src="assets/images/qrcode/'.$compound_data['qrcode'].'.png" />&nbsp;</td>
            </tr>
			<tr >
			<td COLSPAN="13"  style="font-size:9px" width="" class="warna"></td>
		
		   
		    </tr>  


           <tr>
               <td COLSPAN="5" style="font-size:8px" width="">Coding   </td>
               <td COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['codecompound'].' </td>
              
            </tr>

			<tr>
			   <td COLSPAN="5" style="font-size:8px" width="">No. Surat Jalan   </td>
               <td COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['nosj'].' </td>
		   
		    </tr>

		 <tr>
		 	   <td COLSPAN="5" style="font-size:8px" width="">Nama Supplier   </td>
               <td COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.$supplier['name'].' </td>
	     </tr>

		 <tr>
		 	   <td COLSPAN="5" style="font-size:8px" width="">Material Name   </td>
               <td COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.$material['matname'].' </td>
	     </tr>
		 <tr>
		 		<td COLSPAN="5" style="font-size:8px" width="">No. Lot   </td>
				<td COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['nolot'].' </td>
  		</tr>
		 <tr>
		 		<td  COLSPAN="5" style="font-size:8px" width="">Incoming Date   </td>
		 		<td  COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['incomingdate'])).' </td>
	     </tr>
		 <tr>
		 <td  COLSPAN="5" style="font-size:8px" width="">Expired Date   </td>
		 <td  COLSPAN="8"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['expireddate'])).' </td>
		
	     </tr>
		 

		 <tr>
		 <td COLSPAN="5" style="font-size:8px" class="" align="center">Check Point  </td>
		 <td COLSPAN="3" style="font-size:8px" width=20%" align="center">Standard</td>
		 <td COLSPAN="2" style="font-size:8px" width=20%" align="center">Actual</td>
		 <td COLSPAN="3" style="font-size:8px" width=20%" align="center">Status</td>
		 
		 </tr>

		 <tr>
		 <td COLSPAN="5" style="font-size:8px" width="" align="LEFT">Qty</td>
		 <td COLSPAN="3"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsstd'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsact'].'</td>
		 <td COLSPAN="3"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$hsst.'</td>
		 
		 </tr>

		 <tr>
		 <td COLSPAN="5" style="font-size:8px" width="" align="LEFT">Hardness (HS)</td>
		 <td COLSPAN="3"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsstd'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsact'].'</td>
		 <td COLSPAN="3"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$hsst.'</td>
		 
		 </tr>


		 <tr>
		 <td COLSPAN="5" style="font-size:8px" width="" align="left">Tensile Strenght (TB)  </td>
		 <td COLSPAN="3" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['tbstd'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['tbact'].'</td>
		 <td  COLSPAN="3" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$tbst.'</td>
		 
		 </tr>


		 <tr>
		 <td COLSPAN="5" style="font-size:8px" width="" align="left">Elongation Break (EB)  </td>
		 <td COLSPAN="3"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['ebstd'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['ebact'].'</td>
		 <td  COLSPAN="3" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$ebst.'</td>
	 
		 </tr>


		 <tr>
		 <td COLSPAN="5" style="font-size:8px"  align="left">Specific Grafity (SG)  </td>
		 <td COLSPAN="3" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['sgstd'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['sgact'].'</td>
		 <td COLSPAN="3"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$sgst.'</td>
	 
		 </tr>

		


		 <tr>
		 <td COLSPAN="5" class="a" style="font-size:8px" width="" align="left">Notes : </td>
		 <td COLSPAN="4" style="font-size:8px"  align="center">Received By</td>
		 <td COLSPAN="4" style="font-size:8px"  align="center">Result</td>
		 
		 </tr>

		 <tr>
		 <td rowspan="" class ="b" colspan="5" style="font-size:8px" width=10%" align="center"><br><br>  </td>
		 <td rowspan="" COLSPAN="4" style="font-size:8px"  align="center"><br>'.$compound_data['received'].'<br></td>
		 <td rowspan="" COLSPAN="4" style="font-size:14px"  align="center"><br>'.$hasil.'<br></td>
		 
		 </tr>

		 

		 

	</table>
    </table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
	  



	 	</thead>  

       ';
  $output .= '</table>';
			$compound_data = $this->model_compound->getCompoundData($id);
			//$compound_items = $this->model_orders->getOrdersItemData($id);
			//$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			//$dompdf ->setpaper('A5','landscape');
	
		//	$dompdf ->setPaper( array(0, 0, 419.53, 595.28),'portrait');
			$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'portrait'); //ukuran A6
		
		//	$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'landscape');
			$dompdf ->render();
			$dompdf ->stream('qrcompound.php',array("Attachment" => false));
		}
	
	}


	public function printold($id)
	{
		$dompdf = new Dompdf();
		
		if(!in_array('viewCompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$compound_data = $this->model_compound->getCompoundData($id);
			$supplier = $this->model_suppliers->getSupplierData($compound_data['supplier_id']);
			$material = $this->model_material->getMaterialData($compound_data['namecompound']);
			
		//	$orders_items = $this->model_orders->getOrdersItemData($id);
		//	$company_info = $this->model_company->getCompanyData(1);

		//	$order_date = date('d/m/Y', $order_data['date_time']);
			$bmst = ($compound_data['bmst'] == 1) ? "OK" : "NG";
			$hsst = ($compound_data['hsst'] == 1) ? "OK" : "NG";
			$ebst = ($compound_data['ebst'] == 1) ? "OK" : "NG";
			$tbst = ($compound_data['tbst'] == 1) ? "OK" : "NG";
			$sgst = ($compound_data['sgst'] == 1) ? "OK" : "NG";
			$hasil = ($compound_data['hasil'] == 5) ? "OK" : "NG";
			$output = '
			<style >
			@page { 
					margin-top: 10px;
					margin-bottom: 10px;
					margin-right: 10px;
					margin-left: 25px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			
			body {
		  		border: 1px solid black;
		  		background-color: ;
		  		padding-top: 0px;
		  		padding-right: 10px;
		  		padding-bottom: 10px;
		  		padding-left: 10px;	   
	   	  		font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 
		  }
		

		  table noBorder {
			border-top: none;
			border-bottom: none;
		
			}
				table asli td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
				
				}

				.cekpoint { background-color: #EEEEEE;
					text-align: left;
					border: 0px solid #000000;
					
					text-transform: uppercase;

				}

				table .warna {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #ffffff;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #ffffff;
					padding: 1px;
					
					
				}

				table .a {
					border-bottom: 1px solid  #ffffff;
				}

				table .b {
					border-top:    1px solid  #ffffff;
				
				}



				
			
		   </style>
		
	     <table width="100%" border="1" cellpadding="1" cellspacing="0">
		 <tr >
		 <td COLSPAN="9" align="right" style="font-size:5px" width="" class="warna">FR QAS 01 02<br> ED/REV 01/02</td>
		 </tr>
         	<tr >
               <td COLSPAN="7" style="font-size:10px" width="" class="warna"><b>PT. SHIMADA KARYA INDONESIA</b>
			   <br><br> <b>QC INCOMING CARD </b>    </td>
               <td ROWSPAN="1" COLSPAN="2"  align="center" style="font-size:10px; font-family:verdana;" width="" class="warna">&nbsp;<br><img width="50" height="50" class="cekpoint" src="assets/images/qrcode/'.$compound_data['qrcode'].'.png" />&nbsp;</td>
              
            </tr>

			<tr >
			<td COLSPAN="7"  style="font-size:9px" width="" class="warna"></td>
		
		   
		    </tr>  


           <tr>
               <td COLSPAN="4" style="font-size:8px" width="">Coding   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['codecompound'].' </td>
              
            </tr>

			<tr>
			   <td COLSPAN="4" style="font-size:8px" width="">No. Surat Jalan   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['nosj'].' </td>
		   
		    </tr>

		 <tr>
		 	   <td COLSPAN="4" style="font-size:8px" width="">Nama Supplier   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$supplier['name'].' </td>
	     </tr>

		 <tr>
		 	   <td COLSPAN="4" style="font-size:8px" width="">Material Name   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$material['matname'].' </td>
	     </tr>
		 <tr>
		 		<td COLSPAN="4" style="font-size:8px" width="">No. Lot   </td>
				<td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$compound_data['nolot'].' </td>
  		</tr>
		 <tr>
		 		<td  COLSPAN="4" style="font-size:8px" width="">Incoming Date   </td>
		 		<td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['incomingdate'])).' </td>
	     </tr>
		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Expired Date   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['expireddate'])).' </td>
		
	     </tr>
		 

		 <tr>
		 <td COLSPAN="4" style="font-size:8px"  align="center">Check Point  </td>
		 <td COLSPAN="2" style="font-size:8px" width="20%" align="center">Standard</td>
		 <td COLSPAN="2" style="font-size:8px" width="20%" align="center">Actual</td>
		 <td COLSPAN="2" style="font-size:8px" width="20%" align="center">Status</td>
		 
		 </tr>

		 <tr>
		 <td COLSPAN="4" style="font-size:8px" width="" align="LEFT">Qty</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['bmstd'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['bmact'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$bmst.'</td>
		 
		 </tr>

		 <tr>
		 <td COLSPAN="4" style="font-size:8px" width="" align="LEFT">Hardness (HS)</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsstd'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsact'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$hsst.'</td>
		 
		 </tr>


		 <tr>
		 <td COLSPAN="4" style="font-size:8px" width="" align="left">Tensile Strenght (TB)  </td>
		 <td COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['tbstd'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['tbact'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$tbst.'</td>
		 
		 </tr>


		 <tr>
		 <td COLSPAN="4" style="font-size:8px" width="" align="left">Elongation Break (EB)  </td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['ebstd'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['ebact'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$ebst.'</td>
	 
		 </tr>


		 <tr>
		 <td COLSPAN="4" style="font-size:8px"  align="left">Specific Grafity (SG)  </td>
		 <td COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['sgstd'].'</td>
		 <td  COLSPAN="2" style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['sgact'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$sgst.'</td>
	 
		 </tr>

		


		 <tr>
		 <td COLSPAN="4" class="a" style="font-size:8px" width="" align="left">Notes : </td>
		 <td COLSPAN="3" style="font-size:8px"  align="center">Received By</td>
		 <td COLSPAN="3" style="font-size:8px"  align="center">Result</td>
		 
		 </tr>

		 <tr>
		 <td rowspan="" class ="b" colspan="4" style="font-size:8px" width=10%" align="center"><br><br>  </td>
		 <td rowspan="" COLSPAN="3" style="font-size:8px"  align="center"><br>'.$compound_data['received'].'<br></td>
		 <td rowspan="" COLSPAN="3" style="font-size:14px"  align="center"><br>'.$hasil.'<br></td>
		 
		 </tr>

		 

		 

	</table>
    </table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
	  



	 	</thead>  

       ';
  $output .= '</table>';
			$compound_data = $this->model_compound->getCompoundData($id);
			//$compound_items = $this->model_orders->getOrdersItemData($id);
			//$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			//$dompdf ->setpaper('A5','landscape');
	
		//	$dompdf ->setPaper( array(0, 0, 419.53, 595.28),'portrait');
			$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'portrait'); //ukuran A6
		
		//	$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'landscape');
			$dompdf ->render();
			$dompdf ->stream('qrcompound.php',array("Attachment" => false));
		}
	
	}



	public function printncr($id)
	{
		$dompdf = new Dompdf();
		
		if(!in_array('viewCompound', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
		
				$item_data = $this->model_compound->getCompoundData($id);
			//	$historypart = $this->model_gi->getHistorypartData($id);
				$ncr_data = $this->model_compound->getNcrData($item_data['id']);
	
	//		$ncr_data = $this->model_compound->getNcrData($id);
		//	$supplier = $this->model_suppliers->getSupplierData($compound_data['supplier_id']);
		//	$material = $this->model_material->getMaterialData($compound_data['namecompound']);
			
		//	$orders_items = $this->model_orders->getOrdersItemData($id);
		//	$company_info = $this->model_company->getCompanyData(1);

		//	$order_date = date('d/m/Y', $order_data['date_time']);
		//	$hsst = ($ncr_data['hsst'] == 1) ? "OK" : "NG";
		//	$ebst = ($ncr_data['ebst'] == 1) ? "OK" : "NG";
		//	$tbst = ($ncr_data['tbst'] == 1) ? "OK" : "NG";
		//	$sgst = ($ncr_data['sgst'] == 1) ? "OK" : "NG";
		//	$hasil = ($ncr_data['hasil'] == 4) ? "OK" : "NG";
			$output = '
			<style >
			@page { 
					margin-top: 30px;
					margin-bottom: 10px;
					margin-right: 10px;
					margin-left: 30px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			
			body {
		  		border: 1px solid black;
		  		background-color: ;
		  		padding-top: 0px;
		  		padding-right: 5px;
		  		padding-bottom: 5px;
		  		padding-left: 5px;	   
	   	  		font-family: "Cambria",Cambria, Calibri,Candara,Segoe,Segoe UI,Optima,Arial,Helvetica; 
		  }

		  table td {
			height: 13px;
			
		  }

		  table td {
			width: 10px;
			
		  }
		

		  table .noBorder {
			border-top: none;
			border-bottom: none;
		
			}
				table asli td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
				
				}

				.cekpoint { background-color: #EEEEEE;
					text-align: left;
					border: 0px solid #000000;
					
					text-transform: uppercase;

				}

				table .warna {
		
					border-top:    1px solid  #ffffff;
					border-right:  1px solid  #ffffff;
					border-bottom: 1px solid  #ffffff;
					border-left:   1px solid  #ffffff;
					
				}

				table .warnatb {	
					border-top:  1px solid  #ffffff;
					border-bottom: 1px solid  #ffffff;		
				}

				table .warnab {	
				
					border-bottom: 1px solid  #ffffff;		
				}

				table .warnat {	
					border-top:  1px solid  #ffffff;
				
				}

				table .a {
					border-bottom: 1px solid  #ffffff;
				}

				table .b {
					border-top:    1px solid  #ffffff;
				
				}

				table .gambar {
					border: 1px solid #ffffff;
					border-radius: 4px;
					padding: 5px;
					width: 120px;
					height: 150px;
				  }
			
		   </style>


		
	     <table  class="warna" width="100%" border="1" cellpadding="1" cellspacing="0">

		 <tr>
		 <td class="warna" COLSPAN="62"  style="font-size:8px" width="">.</td>
	   
  		</tr>
		
         
		<tr>
			<td class="warna" COLSPAN="9" class="warna" style="font-size:8px" width="" align="center">  </td>	
			<td class="warna" COLSPAN="29"  style="font-size:8px" width="" align="center" ></td>
			<td class="warna" COLSPAN="6"  style="font-size:8px" width="" align="center">FR QAS 02 01</td>
			<td class="warna" COLSPAN="2"  style="font-size:8px" width="" align="center"> </td>
			<td COLSPAN="6"  style="font-size:8px" width="" align="center">QC</td>
			
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width="" align="center"></td>
			<td COLSPAN="9"  style="font-size:8px" width="" align="center">PRODUKSI</td>
			
		 </tr>
		 <tr>
		 <td class="warna" COLSPAN="9" ROWSPAN="4" style="font-size:8px" width="" align="center"><img width="100" height="50" class="" src="assets/images/logo.png" /> <br><b>DEPT.QA</b>  </td>	
		 <td class="warna" COLSPAN="29"  style="font-size:8px" width="" align="center" ></td>
		 <td class="warna" COLSPAN="6"  style="font-size:8px" width="" align="center">Ed/Rev : 01/02</td>
		 <td class="warna" COLSPAN="2"  style="font-size:8px" width="" align="center"> </td>
		 <td COLSPAN="3"  style="font-size:8px" width="" align="center">DIPERIKSA</td>
		 <td COLSPAN="3"  style="font-size:8px" width="" align="center">DIKETAHUI</td>
		 <td class="warnatb" COLSPAN=""  style="font-size:8px" width="" align="center"></td>
		 <td COLSPAN="3"  style="font-size:8px" width="" align="center">DISIAPKAN</td>
		 <td COLSPAN="3"  style="font-size:8px" width="" align="center">DIPERIKSA</td>
		 <td COLSPAN="3"  style="font-size:8px" width="" align="center">DIKETAHUI</td>
	  </tr>

		<tr>
		
			<td class="warna" COLSPAN="37"  style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3" rowspan="3" style="font-size:8px" width="" align="center"></td>
			<td COLSPAN="3" rowspan="3" style="font-size:8px" width="" align="center"></td>
			<td class="warnatb" COLSPAN="" rowspan="3"  style="font-size:8px" width="" align="center"></td>
			<td COLSPAN="3" rowspan="3" style="font-size:8px" width="" align="center"></td>
			<td COLSPAN="3" rowspan="3" style="font-size:8px" width="" align="center"></td>
			<td COLSPAN="3" rowspan="3" style="font-size:8px" width="" align="center"></td>
		 </tr>

		<tr>
			
			<td class="warna" COLSPAN="37"  style="font-size:14px" width="" align="center" >LAPORAN KETIDAKSESUAIAN KUALITAS</td>
			
			
		 </tr>
		<tr>
		
			<td class="warna" COLSPAN="37" style="font-size:8px" width="" align="center" >NO: 001 / QA /I /2021</td>
			
			
			
		 </tr>


		<tr>
			<td class="warna" COLSPAN="13" style="font-size:12px" width="" align="center"><b>PT SHIMADA KARYA INDONESIA </b> </td>	
			<td class="warna" COLSPAN="33"  style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">IMAN</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">AGUS</td>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width="" align="center"></td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">SURYA</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">AZIS</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">POLTAK</td>
		 </tr>

		 <tr>
			   <td class="warna" COLSPAN="62"  style="font-size:8px" width="">.</td>
			 
        </tr>


           <tr>
               <td COLSPAN="4" style="font-size:8px" width="" align="center" >INTERNAL  </td>
               <td COLSPAN="4"  style="font-size:8px" width="" align="center" >SUPPLIER </td>
               <td COLSPAN="4"  style="font-size:8px" width="" align="center">CUSTOMER </td>
			   <td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			   <td COLSPAN="4"  style="font-size:8px" width="">SUPPLIER /</td>
			   <td COLSPAN="5"  style="font-size:8px" width="">NO. SURAT JALAN</td>
			   <td COLSPAN="15"  style="font-size:8px" width="">:'.$ncr_data['nosj'].'</td>
			   <td COLSPAN="6"  style="font-size:8px" width="">NO. LOT</td>
			   <td COLSPAN="10"  style="font-size:8px" width="">:'.$ncr_data['nolot'].'</td>
			   <td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			   <td class="warnab" COLSPAN="8"  style="font-size:8px" width="">JUMLAH RETUR :</td>
			   
            </tr>

			<tr>
               <td COLSPAN="4" style="font-size:8px" width="" align="center">'.$ncr_data['dept'].' </td>
               <td COLSPAN="4"  style="font-size:8px" width="" align="center">'.$ncr_data['sup'].' </td>
               <td COLSPAN="4"  style="font-size:8px" width="" align="center">'.$ncr_data['cus'].' </td>
			   <td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			   <td COLSPAN="4"  style="font-size:8px" width="">CUSTOMER</td>
			   <td COLSPAN="5"  style="font-size:8px" width="">TANGGAL KIRIM</td>
			   <td COLSPAN="15"  style="font-size:8px" width="">:'.$ncr_data['tglkirim'].'</td>
			   <td COLSPAN="6"  style="font-size:8px" width="">TANGGAL PRODUKSI</td>
			   <td COLSPAN="10"  style="font-size:8px" width="">:'.$ncr_data['tglprod'].'</td>
			   <td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			   <td class="warnat"COLSPAN="8"  style="font-size:8px" width="" align="right">'.$ncr_data['jmlreturn'].' Pcs</td>
			  
            </tr>

			<tr>
			   <td class="warna" COLSPAN="62"  style="font-size:8px" width="">.</td>
			 
            </tr>


			<tr>
               <td COLSPAN="4" style="font-size:8px" width="">PART NO. </td>
               <td COLSPAN="8"  style="font-size:8px" width="">:'.$ncr_data['partno'].'</td>
               <td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			   <td COLSPAN="22"  style="font-size:8px" width="">URAIAN MASALAH / NG :</td>
			   <td COLSPAN="8"  style="font-size:8px" width="">TANGGAL DITEMUKAN NG</td>
			   <td COLSPAN="8"  style="font-size:8px" width="">: '.$ncr_data['tglditemukanng'].'</td>
			   <td class="warnab"COLSPAN="5" style="font-size:8px" width="">JUMLAH NG</td>
			   <td class="warnab" COLSPAN="6"  style="font-size:8px" width="" >PROSENTASE NG</td>
			  
            </tr>

			<tr>
			<td COLSPAN="4" style="font-size:8px" width="">NAMA PRODUK </td>
			<td COLSPAN="8"  style="font-size:8px" width="">: '.$ncr_data['partname'].' </td>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="22" ROWSPAN="2" style="font-size:8px" width="" align="center">'.$ncr_data['uraianmasalah'].' </td>
			<td COLSPAN="8"  style="font-size:8px" width="">TANGGAL DITERIMA</td>
			<td COLSPAN="8"  style="font-size:8px" width="">: '.$ncr_data['tglditerima'].'</td>
			<td class="warnat" COLSPAN="5"  rowspan="2" style="font-size:8px" width="" align="center">'.$ncr_data['jmlng'].'  Pcs</td>
			<td class="warnat" COLSPAN="6"  rowspan="2" style="font-size:8px" width=""align="center">'.$ncr_data['prosentaseng'].'  %</td>
            </tr>

			<tr>
			<td COLSPAN="4" style="font-size:8px" width="">TIPE </td>
			<td COLSPAN="8"  style="font-size:8px" width="" align="">: '.$ncr_data['tipe'].' </td>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="8"  style="font-size:8px" width="">TANGGAL DITEMUKAN NG</td>
			<td COLSPAN="8"  style="font-size:8px" width="" align="">: '.$ncr_data['tglditemukanng'].'</td>
			
			
            </tr>

			<tr>
			<td class="warna" COLSPAN="62"  style="font-size:8px" width="">.</td>
            </tr>

			<tr>
			<td COLSPAN="8" style="font-size:8px" width="">1. DETAIL PROBLEM </td>
			<td COLSPAN="37"  style="font-size:8px" width="">2. PROBLEM ANALYSIS (5 WHY ANALYSIS)</td>
			<td COLSPAN="17"  style="font-size:8px" width="">6. FLOW PROSSES</td>
			
			
            </tr>
			<tr>
			<td  class="warnatb" COLSPAN="8" style="font-size:8px" width="">(SKETCH) </td>
			<td class="warna" COLSPAN="37"  style="font-size:8px" width=""></td>
			<td COLSPAN="8"  style="font-size:8px" width="" align="center">BEFORE IMPROVEMENT</td>
			<td COLSPAN="9"  style="font-size:8px" width="" align="center">AFTER IMPROVEMENT</td>
			
            </tr>
			<tr>
			<td  class="warnatb" COLSPAN="8" rowspan ="13" style="font-size:8px" width=""><img  class="gambar" src="'.$ncr_data['sketech'].'" />  </td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN="2" rowspan ="2" style="font-size:8px" align="center">WHY 1</td>
			<td   COLSPAN="32" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['uraianmasalah'].'</td>
			<td  class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td  class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="8"  rowspan ="13" style="font-size:8px" width=""><img  class="gambar" src="'.$ncr_data['fpbi'].'" /></td>
			<td COLSPAN="9"  rowspan ="13" style="font-size:8px" width=""><img  class="gambar" src="'.$ncr_data['fpai'].'" /></td>
			
            </tr>
			<tr>
			
			
			<td COLSPAN="" class="warna"  style="font-size:8px" width=""></td>
			<td COLSPAN="" class="warna"  style="font-size:8px" width=""></td>
			
            </tr>
			<tr>
			
			<td class="warna" COLSPAN="37"  style="font-size:8px" width=""></td>
			
            </tr>
			<tr>
			<td class="warnatb" class="warnatb" COLSPAN="3"  style="font-size:8px" width=""></td>
			<td COLSPAN="7"  style="font-size:8px" width="" align="center">MAN</td>
			<td COLSPAN="7"  style="font-size:8px" width="" align="center">MACHINE</td>
			<td COLSPAN="10"  style="font-size:8px" width="" align="center">METHODE</td>
			<td COLSPAN="8"  style="font-size:8px" width="" align="center">MATERIAL</td>
			
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
				
            </tr>
			
			<tr>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="2" rowspan ="2" style="font-size:8px" align="center">WHY 2</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whaman'].'</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whamachine'].'</td>
			<td COLSPAN="10" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whamethode'].'</td>
			<td COLSPAN="8" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whamaterial'].'</td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
				
            </tr>

			
			
			<tr>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
				
            </tr>

			<tr>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="2" rowspan ="2" style="font-size:8px" align="center">WHY 3</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whbman'].'</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whbmachine'].'</td>
			<td COLSPAN="10" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whbmethode'].'</td>
			<td COLSPAN="8" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whbmaterial'].'</td>
			<td class="warna"  COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
				
            </tr>

			<tr>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			
            </tr>

			<tr>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="2" rowspan ="2" style="font-size:8px" align="center">WHY 4</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whcman'].'</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whcmachine'].'</td>
			<td COLSPAN="10" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whcmethode'].'</td>
			<td COLSPAN="8" rowspan ="2" style="font-size:8px" width="" align="center">'.$ncr_data['whcmaterial'].'</td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			
            </tr>

			<tr>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			
            </tr>
			<tr>
			<td class="warnatb" COLSPAN=""  style="font-size:8px" width=""></td>
			<td COLSPAN="2" rowspan ="2" style="font-size:8px" align="center">WHY 5</td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width=""></td>
			<td COLSPAN="7" rowspan ="2" style="font-size:8px" width=""></td>
			<td COLSPAN="10" rowspan ="2" style="font-size:8px" width=""></td>
			<td COLSPAN="8" rowspan ="2" style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
				
            </tr>
			<tr>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			<td class="warna" COLSPAN=""  style="font-size:8px" width=""></td>
			
            </tr>

			<tr>
			
			<td class="warna" COLSPAN="37"  style="font-size:8px" width=""></td>
				
            </tr>


			<tr>
			
			<td COLSPAN="15"  style="font-size:8px" width="">3. PENYEBAB UTAMA</td>
			<td COLSPAN="23"  style="font-size:8px" width="">5. TINDAKAN KOREKSI</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">TANGGAL</td>
			<td COLSPAN="12"  style="font-size:8px" width="">NOTE :</td>
			<td COLSPAN="9"  style="font-size:8px" width="">PENGIRIMAN SETELAH IMPROVEMENT</td>

				
            </tr>
			<tr>
			
			<td COLSPAN="15" rowspan="3" style="font-size:8px" width="" align="center">'.$ncr_data['penyebabutama'].'</td>
			<td COLSPAN="23" rowspan="16" style="font-size:8px" width="">'.$ncr_data['tinkorsatu'].' </td>
			<td COLSPAN="3"  rowspan="16" style="font-size:8px" width="" align="center">'.$ncr_data['tinkorsatutgl'].'</td>
			<td COLSPAN="12" rowspan="2" style="font-size:8px" width="">NOTE :</td>
			<td COLSPAN="9"  style="font-size:8px" width="">TANGGAL : '.$ncr_data['tglpsi'].' </td>

				
            </tr>
			<tr>
			
				
			
			<td COLSPAN="9"  style="font-size:8px" width="">NOLOT : '.$ncr_data['nolotpsi'].' </td>

				
            </tr>
			<tr>
			
			
			<td COLSPAN="5"  style="font-size:8px" width="">EVALUASI 1</td>
			<td COLSPAN="4"  style="font-size:8px" width="" align="center" >DEPARTMENT</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >TANGGAL</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >DISIAPKAN</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >DIPERIKSA</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >DIKETAHUI</td>
				
            </tr>
			<tr>
			
			<td COLSPAN="12"  style="font-size:8px" width="">4. TINDAKAN SEMENTARA</td>
			
			<td COLSPAN="3"  style="font-size:8px" width="" align="center">TANGGAL</td>
			<td COLSPAN="5" rowspan="3" style="font-size:8px" width="">'.$ncr_data['evasatu'].' </td>
			<td COLSPAN="4" rowspan="3" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3" rowspan="3" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3" rowspan="2" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3" rowspan="2" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3" rowspan="2" style="font-size:8px" width="" align="center" ></td>
				
            </tr>

			<tr>
			
			<td COLSPAN="12" rowspan="12" style="font-size:8px" width="">'.$ncr_data['tinsemsatu'].'</td>
			<td COLSPAN="3"   rowspan="12" style="font-size:8px" width=""  align="center" >'.$ncr_data['tinsemsatutgl'].'</td>
				
					
            </tr>

			<tr>
			
			

			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >IMAN</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >NANI</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >AGUS</td>
				
            </tr>

			<tr>
			
					<td class="warnab" COLSPAN="21"  style="font-size:8px" width=""> HASIL EVALUASI 1 :</td>
			
				
            </tr>
			<tr>
			
			
			<td class="warnat" COLSPAN="21" rowspan="2"  style="font-size:8px" width="">'.$ncr_data['hasilevasatu'].' </td>
			
				
            </tr>
			<tr>
			
				
			
			
				
            </tr>

			<tr>
			
				
			<td COLSPAN="5"  style="font-size:8px" width="">EVALUASI 2</td>
			<td COLSPAN="4"  style="font-size:8px" width="" align="center" >DEPARTMENT</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >TANGGAL</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >DISIAPKAN</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >DIPERIKSA</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >DIKETAHUI</td>
				
            </tr>

			<tr>
			
				
			<td COLSPAN="5" rowspan="3" style="font-size:8px" width="">'.$ncr_data['evadua'].' </td>
			<td COLSPAN="4"  rowspan="3" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3"  rowspan="3"  style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3"  rowspan="2" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3"  rowspan="2" style="font-size:8px" width="" align="center" ></td>
			<td COLSPAN="3"  rowspan="2" style="font-size:8px" width="" align="center" ></td>
				
            </tr>

			<tr>
			
			
			
			
				
            </tr>

			<tr>
				
			
			
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >IMAN</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >NANI</td>
			<td COLSPAN="3"  style="font-size:8px" width="" align="center" >AGUS</td>
				
            </tr>

			<tr>
			
				
			<td class="warnab" COLSPAN="21"  style="font-size:8px" width="">HASIL EVALUASI 2 :</td>
			
				
            </tr>
			<tr>
			
			
			<td class="warnat" COLSPAN="21" rowspan="2"  style="font-size:8px" width=""> '.$ncr_data['hasilevadua'].'</td>
			
				
            </tr>
			<tr>
			
			
				
            </tr>

			

		 

		 

	</table>


    </table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
	 	</thead>  

       ';
  $output .= '</table>';

  
//  $historypart = $this->model_gi->getHistorypartData($id);
 // $gi_data = $this->model_gi->getGiData($id);

			$ncr_data = $this->model_compound->getNcrData($id);
			//$compound_items = $this->model_orders->getOrdersItemData($id);
			//$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			//$dompdf ->setpaper('A4','landscape');
	
			$dompdf ->setpaper('A4','landscape');
		//	$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'landscape'); //ukuran A6
		
		//	$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'landscape');
			$dompdf ->render();
			$dompdf ->stream('ncr.php',array("Attachment" => false));
		}
	
	}




}