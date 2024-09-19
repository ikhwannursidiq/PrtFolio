<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Submaterial extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'submaterial';

		$this->load->model('model_submaterial');
		$this->load->model('model_suppliers');
		$this->load->model('model_material');
	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewSubmaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_submaterial->getSubmaterialData();

		$this->data['results'] = $result;
		$this->data['user'] = $this->model_submaterial->tampil_data()->result();
		
		$this->render_template('submaterial/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchSubmaterialData()
	{
		$result = array('data' => array());

		$data = $this->model_submaterial->getSubmaterialData();
		foreach ($data as $key => $value) {
			$supplier = $this->model_suppliers->getSupplierData($value['supplier_id']);

			$kompon = $this->model_material->getMaterialData($value['namematerial']);
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

		if(in_array('viewSubmaterial', $this->permission)) {
		$buttons = '<a target="__blank" href="'.base_url('submaterial/printsm/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';//jika ok disini tampilnya
		}
		
		if(in_array('viewSubmaterial', $this->permission)) {
			$buttons .= '<a target="__blank" href="'.base_url('submaterial/view/'.$value['id']).'" class="btn btn-default"><i class="fa fa-eye"></i></a>';
		}	

			if(in_array('deleteSubmaterial', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeSubmaterial('.$value['id'].')" data-toggle="modal" data-target="#removeSubmaterialModal"><i class="fa fa-trash"></i></button>
				';
			}
			
			

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$img = '<img src="'.base_url($value['qrcode']).'" alt="" class="img-circle" width="50" height="50" />';

			if($value['hasil'] < 3) {
				$hasil = '<a target="__blank" href="'.base_url('submaterial/ncr/'.$value['id']).'" class="btn btn-danger"><span class="label label-danger"></span>NCR</a>';
			}
			else { 
				$hasil = '<span class="label label-success">OK</span>'; //jika ok disini tampilnya
			}
			$print='';
			if($value['hasil'] < 3) {
				$print = '<span class="label label-warning">Silahkan Isi Form NCR </span>';
			}
			else { 
				
				$print = '<a target="__blank" href="'.base_url('submaterial/printsm/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';//jika ok disini tampilnya

			}

			$ncrsatus='';
			if($value['hasil'] < 5) {
				$ncrsatus = '<span class="label label-success"> Input Completed </span>';
			}
			else { 
				
				$ncrsatus = '<span class="label label-warning"> Waiting Input Data </span>';
			}



			$result['data'][$key] = array(
                $img,
				$value['codematerial'],				
				$value['name'],
				$supplier['name'],
				$value['qtymaterial'],
				$value['incomingdate'],
                $value['expireddate'],
				$hasil,
				$print,
				$buttons,
				$ncrsatus

			);
		} // /foreach

		echo json_encode($result);
	}

	public function cetak_pdf()
	{
	  // Mendapatkan kategori yang dipilih dari form
	  $kategori = $this->input->post('kategori');
	
	  // Menyiapkan data yang akan dikirim ke view
	  $data['produk'] = $this->model_compound->getCompoundData($kategori);
	
	  // Memanggil view untuk menampilkan PDF
	  $this->load->view('pdf', $data);
	}





	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchSubmaterialDataById($id)
	{
		if($id) {
			$data = $this->model_submaterial->getSubmaterialData($id);
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
		if(!in_array('createSubmaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('codecompound', 'codecompound', 'trim|required');
		$this->form_validation->set_rules('namecompound', 'namecompound', 'trim|required');
		$this->form_validation->set_rules('incomingdate', 'incomingdate', 'trim|required');
		$this->form_validation->set_rules('expireddate', 'expireddate', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
		$cek = $this->db->query("SELECT * FROM submaterial where qrcode='".$all."' ")->num_rows();
		
        if ($cek<=0) {
           
			$no=$this->input->post('nourut');
        	$sp=$this->input->post('codecompound');
			$sq=$this->input->post('incomingdate');
			$ep=$this->input->post('expireddate');
			//$newFormat = date_format($sq,"Ymd");
			$newFormat = date("Ymd",strtotime($sq));
			$bs = '/';
			$all=$sp.''.$newFormat.''.$no;

			
			$hsst = $this->input->post('wst_value');
			$tbst =$this->input->post('dst_value');
			
			$sgst= $this->input->post('appst_value');
			$result= $hsst + $sgst + $tbst ;
        	$data = array(

        		'codematerial' => $this->input->post('codecompound'),
				'namematerial' => $this->input->post('namecompound'),
				'nourut' => $this->input->post('nourut'),
				'incomingdate' => $this->input->post('incomingdate'),
				'expireddate' => $this->input->post('expireddate'),
                'qrcode'=> $all,
				'barcode'=> $all,
				'supplier_id' => $this->input->post('supplier'),
				'wstd' => $this->input->post('wstd'),
				'wact' => $this->input->post('wact'),
				'name' => $this->input->post('namecomp'),
				'qtymaterial' => $this->input->post('qtymaterial'),
				'dstd' => $this->input->post('dstd'),
			    'dact' => $this->input->post('dact'),
				'dst' => $this->input->post('dst_value'),
				'appstd' => $this->input->post('appstd'),
				'appact' => $this->input->post('appact'),
				'wst' => $this->input->post('wst_value'),
				'appst' => $this->input->post('appst_value'),
				'received' => $this->input->post('received'),
				'hasil' => $result,
				'nolot' => $this->input->post('nolot'),
				'nosj' => $this->input->post('nosj'),
        		'active' => $this->input->post('active'),	
        	);
        }

		//ok create barcode
	//		$this->load->library('zend');
	//		$this->zend->load('Zend/Barcode');
			//generate barcode
			// $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$all), array())->draw();
	//		$imageResource = Zend_Barcode::factory('code39', 'image', array('text'=>$all), array())->render();
	//		imagepng($imageResource, 'assets/images/barcode/'.$all.'.png');
    
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

	        $create = $this->model_submaterial->create($data);
            
         if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('submaterial/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('submaterial/create', 'refresh');
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
			$this->data['material'] = $this->model_material->getSubMaterialData();
			$this->data['supplier'] = $this->model_suppliers->getActiveSuppliers();  
		//	$this->data['tgl_pinjam'] = $this->model_material->getPinjam();        
		//	$this->data['tgl_kembali'] = $this->model_material->getPinjam();   
			$this->data['nourut'] = $this->model_submaterial->buat_kode();   	     	
            $this->render_template('submaterial/create', $this->data);
        }
    	
	}
	public function createok()
	{

		if(!in_array('createSubmaterial', $this->permission)) {
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

			$cek = $this->db->query("SELECT * FROM submaterial where codecompound='".$this->input->post('codecompound')."' and incomingdate ='".$this->input->post('incomingdate')."' ")->num_rows();
		
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

	public function createncr()
	{
		if(!in_array('createCompound', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('nosj', 'nosj', 'trim|required');
		$this->form_validation->set_rules('nolot', 'nolot', 'trim|required');
		

        if ($this->form_validation->run() == TRUE) {
		$cek = $this->db->query("SELECT * FROM ncr where nosj='".$this->input->post('nosj')."' and nolot ='".$this->input->post('nolot')."' ")->num_rows();
		
        if ($cek<=0) {
           
		//	$no=$this->input->post('nourut');
        //	$sp=$this->input->post('codecompound');
		//	$sq=$this->input->post('incomingdate');
		//	$ep=$this->input->post('expireddate');
			//$newFormat = date_format($sq,"Ymd");
		//	$newFormat = date("Ymd",strtotime($sq));
		//	$bs = '/';
		//	$all=$sp.''.$newFormat.''.$no;

		//	$hsst = $this->input->post('hsst');
		//	$tbst = $this->input->post('tbst');
		//	$ebst = $this->input->post('ebst');
		//	$sgst= $this->input->post('sgst');
		//	$bmst = $this->input->post('bmst_value');
		//	$hsst = $this->input->post('hsst_value');
		//	$tbst = $this->input->post('tbst_value');
		//	$ebst = $this->input->post('ebst_value');
		//	$sgst= $this->input->post('sgst_value');
		//	$result= $hsst + $ebst + $sgst + $tbst + $bmst;
        	$data = array(



				'dept' => $this->input->post('dept'),
				'sup' => $this->input->post('sup'),
				'cus' => $this->input->post('cus'),
				'partno' => $this->input->post('partno'),
				'partname' => $this->input->post('partname'),
				'compound_id' => $id,
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
				'sketch' => $this->input->post('sketch'),
				'fpbi' => $this->input->post('fpbi'),
				'fpai' => $this->input->post('fpai'),
				'pawhy' => $this->input->post('pawhy'),
				'whaman' => $this->input->post('whaman'),
				'whamachine' => $this->input->post('whamachine'),
				'whamethode' => $this->input->post('whamethode'),
				'whamaterial' => $this->input->post('whamaterial'),
				'putama' => $this->input->post('putama'),
				'tkoreksi' => $this->input->post('tkoreksi'),
				'koreksitgl' => $this->input->post('koreksitgl'),
				'tinsem' => $this->input->post('tinsem'),
				'semtgl' => $this->input->post('semtgl'),
				'whbman' => $this->input->post('whbman'),
				'whbmachine' => $this->input->post('whbmachine'),
				'whbmethode' => $this->input->post('whbmethode'),
				'whbmaterial'=> $this->input->post('whbmaterial'),
				'whcman' => $this->input->post('whcman'),
				'whcmachine' => $this->input->post('whcmachine'),
				'whcmethode' => $this->input->post('whcmethode'),
				'whcmaterial' => $this->input->post('whcmaterial'),
				'note' => $this->input->post('note'),
        			
        	);
        }

		//ok create barcode
	//		$this->load->library('zend');
	//		$this->zend->load('Zend/Barcode');
			//generate barcode
			// $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$all), array())->draw();
	//		$imageResource = Zend_Barcode::factory('code39', 'image', array('text'=>$all), array())->render();
	//		imagepng($imageResource, 'assets/images/barcode/'.$all.'.png');
    
    //     	$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			//$this->load->library('zend');
	//		$config['cacheable']	= true; //boolean, the default is true
	//		$config['cachedir']		= './assets/'; //string, the default is application/cache/
	//		$config['errorlog']		= './assets/'; //string, the default is application/logs/
	//		$config['imagedir']		= './assets/images/qrcode/'; //direktori penyimpanan qr code
	//		$config['quality']		= true; //boolean, the default is true
	//		$config['size']			= '1024'; //interger, the default is 1024
	//		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
	//		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
	//		$this->ciqrcode->initialize($config);
	
		//	$image_name=$sp.'.png'; //buat name dari qr code sesuai dengan nim
	//	    $image_name= $all.'.png'; 
	//		$params['data'] = $all; //data yang akan di jadikan QR CODE
	//		$params['level'] = 'H'; //H=High
	//		$params['size'] = 10;
	//		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
	//		$this->ciqrcode->generate($params);

	        $createncr = $this->model_compound->createncr($data);
            
         if($createncr == true) {
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
			$this->data['tgl_pinjam'] = $this->model_material->getPinjam();        
			$this->data['tgl_kembali'] = $this->model_material->getPinjam();   
			$this->data['nourut'] = $this->model_material->buat_kode();   	     	
            $this->render_template('compound/ncr', $this->data);
        }
	}
	public function ncr($id)
	{
	//if(!in_array('viewCompound', $this->permission)) {
	//	redirect('dashboard', 'refresh');
	//}

	//if($id) {
	//	redirect('dashboard', 'refresh');
	//}

	$this->form_validation->set_rules('nosj', 'nosj', 'trim|required');
	$this->form_validation->set_rules('nolot', 'nolot', 'trim|required');
	
	if ($this->form_validation->run() == TRUE) {	
		$data = array(
			'dept' => $this->input->post('dept'),
			'sup' => $this->input->post('sup'),
			'cus' => $this->input->post('cus'),
			'partno' => $this->input->post('partno'),
			'partname' => $this->input->post('partname'),
			'compound_id' => $id,
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
			'sketch' => $this->input->post('sketch'),
			'fpbi' => $this->input->post('fpbi'),
			'fpai' => $this->input->post('fpai'),
			'pawhy' => $this->input->post('pawhy'),
			'whaman' => $this->input->post('whaman'),
			'whamachine' => $this->input->post('whamachine'),
			'whamethode' => $this->input->post('whamethode'),
			'whamaterial' => $this->input->post('whamaterial'),
			'putama' => $this->input->post('putama'),
			'tkoreksi' => $this->input->post('tkoreksi'),
			'koreksitgl' => $this->input->post('koreksitgl'),
			'tinsem' => $this->input->post('tinsem'),
			'semtgl' => $this->input->post('semtgl'),
			'whbman' => $this->input->post('whbman'),
			'whbmachine' => $this->input->post('whbmachine'),
			'whbmethode' => $this->input->post('whbmethode'),
			'whbmaterial'=> $this->input->post('whbmaterial'),
			'whcman' => $this->input->post('whcman'),
			'whcmachine' => $this->input->post('whcmachine'),
			'whcmethode' => $this->input->post('whcmethode'),
			'whcmaterial' => $this->input->post('whcmaterial'),
		//	'note' => $this->input->post('note'),
		);

		
	//	if($_FILES['product_image']['size'] > 0) {
	//		$upload_image = $this->upload_image();
	//		$upload_image = array('image' => $upload_image);
			
	//		$this->model_compound->createncr($upload_image, $id);
	//	}

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
	//	$this->data['material'] = $this->model_submaterial->getSubMaterialData();          

	//	$compound_data = $this->model_compound->getCompoundData($id);
	//	$this->data['compound_data'] = $compound_data;
		$this->render_template('submaterial/ncr', $this->data); 
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
		if(!in_array('deleteSubmaterial', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$submaterial_id = $this->input->post('submaterial_id');
		$response = array();
		if($submaterial_id) {
			$delete = $this->model_submaterial->remove($submaterial_id);

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
		
		if(!in_array('viewSubmaterial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$submaterial_data = $this->model_submaterial->getSubmaterialData($id);
		//	$orders_items = $this->model_orders->getOrdersItemData($id);
			$supplier = $this->model_suppliers->getSupplierData($submaterial_data['supplier_id']);
			$material = $this->model_material->getMaterialData($submaterial_data['namematerial']);
			
	

			$wst = ($submaterial_data['wst'] == 1) ? "OK" : "NG";
			$dst = ($submaterial_data['dst'] == 1) ? "OK" : "NG";
			$appst = ($submaterial_data['appst'] == 1) ? "OK" : "NG";
			$hasil = ($submaterial_data['hasil'] == 3) ? "OK" : "NG";
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
		 <td COLSPAN="9" align="right" style="font-size:5px" width="" class="warna">FR QAS 01 02<br> ED/REV 01/02</td>
	 
		
		 </tr>  

         	<tr >
               <td COLSPAN="7" style="font-size:10px" width="" class="warna"><b>PT. SHIMADA KARYA INDONESIA</b>
			   <br><br> <b>QC INCOMING CARD </b>    </td>
               <td ROWSPAN="1" COLSPAN="2"  align="center" style="font-size:10px; font-family:verdana;" width="" class="warna">&nbsp;<br><img width="50" height="50" class="cekpoint" src="assets/images/qrcode/'.$submaterial_data['qrcode'].'.png" />&nbsp;</td>
              
            </tr>

			<tr >
			<td COLSPAN="7"  style="font-size:9px" width="" class="warna"></td>
		
		   
		    </tr>  


           <tr>
               <td COLSPAN="4" style="font-size:8px" width="">Coding   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$submaterial_data['codematerial'].' </td>
              
            </tr>

			<tr>
			   <td COLSPAN="4" style="font-size:8px" width="">No. Surat Jalan   </td>
               <td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$submaterial_data['nosj'].' </td>
		   
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
				<td COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$submaterial_data['nolot'].' </td>
  		</tr>
		 <tr>
		 		<td  COLSPAN="4" style="font-size:8px" width="">Incoming Date   </td>
		 		<td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($submaterial_data['incomingdate'])). '</td>
	     </tr>

		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Expired Date   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($submaterial_data['expireddate'])).' </td>
		
	     </tr>

		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Quantity   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$submaterial_data['qtymaterial'].' </td>
		
	     </tr>

		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Urutan FIFO   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.$submaterial_data['nourut'].' </td>
		
	     </tr>
		 

		 

		


		 <tr>
		 <td COLSPAN="4" class="a" style="font-size:8px" width="" align="left">Notes : </td>
		 <td COLSPAN="3" style="font-size:8px"  align="center">Received By</td>
		 <td COLSPAN="3" style="font-size:8px"  align="center">Result</td>
		 
		 </tr>

		 <tr>
		 <td rowspan="" class ="b" colspan="4" style="font-size:8px" width=10%" align="center"><br><br>  </td>
		 <td rowspan="" COLSPAN="3" style="font-size:8px"  align="center"><br>'.$submaterial_data['received'].'<br></td>
		 <td rowspan="" COLSPAN="3" style="font-size:14px"  align="center"><br>'.$hasil.'<br></td>
		 
		 </tr>

		 

		 

	</table>
    </table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
	  



	 	</thead>  

       ';
  $output .= '</table>';
			$submaterial_data = $this->model_material->getMaterialData($id);
			//$compound_items = $this->model_orders->getOrdersItemData($id);
			//$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			//$dompdf ->setpaper('A5','landscape');
	
		//	$dompdf ->setPaper( array(0, 0, 419.53, 595.28),'portrait');
			$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'portrait'); //ukuran A6
		
		//	$dompdf ->setPaper( array(0, 0, 209.76, 297.64),'landscape');
			$dompdf ->render();
			$dompdf ->stream('submaterial.php',array("Attachment" => false));
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
		 		<td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['incomingdate'])).' </td>
	     </tr>
		 <tr>
		 <td  COLSPAN="4" style="font-size:8px" width="">Expired Date   </td>
		 <td  COLSPAN="6"  style="font-size:8px" width="">&nbsp;&nbsp;'.date('d M Y', strtotime($compound_data['expireddate'])).' </td>
		
	     </tr>
		 

		 <tr>
		 <td COLSPAN="4" style="font-size:8px" class="" align="center">Check Point  </td>
		 <td COLSPAN="2" style="font-size:8px" width=20%" align="center">Standard</td>
		 <td COLSPAN="2" style="font-size:8px" width=20%" align="center">Actual</td>
		 <td COLSPAN="2" style="font-size:8px" width=20%" align="center">Status</td>
		 
		 </tr>

		 <tr>
		 <td COLSPAN="4" style="font-size:8px" width="" align="LEFT">Qty</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsstd'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$compound_data['hsact'].'</td>
		 <td COLSPAN="2"  style="font-size:8px" width=20%" align="center">&nbsp;&nbsp;'.$hsst.'</td>
		 
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


	


}