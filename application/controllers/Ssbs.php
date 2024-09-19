<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Ssbs extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Ssbs';

		$this->load->model('model_ssbs');
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
        if(!in_array('viewSsb', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('ssbs/index', $this->data);	
	}

    /*
    * It Fetches the ssbs data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchSsbsData()
	{
		$result = array('data' => array());

		$data = $this->model_ssbs->getSsbData();

		foreach ($data as $key => $value) {

           // $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
            if(in_array('viewSsb', $this->permission)) {
    			$buttons .= '<a href="'.base_url('ssbs/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }
            if(in_array('updateSsb', $this->permission)) {
    			$buttons .= '<a href="'.base_url('ssbs/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			//$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            //$availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            //$qty_status = '';
           // if($value['qty'] <= 10) {
             //   $qty_status = '<span class="label label-warning">Low !</span>';
            //} else if($value['qty'] <= 0) {
              //  $qty_status = '<span class="label label-danger">Out of stock !</span>';
           // }


			$result['data'][$key] = array(
				$value['namaperusahaan'],
				$value['alamatkantorpusat'],
                $value['namabarang'],
				$value['hasil'],
                $value['kesimpulan'],
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
		if(!in_array('createSsb', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('namaperusahaan', 'namaperusahaan', 'trim|required');
        $this->form_validation->set_rules('alamatkantorpusat', 'alamatkantorpusat', 'trim|required');
        $this->form_validation->set_rules('alamatkantorcabang', 'alamatkantorcabang', 'trim|required');
        $this->form_validation->set_rules('telp', 'telp', 'trim|required');
        $this->form_validation->set_rules('fax', 'fax', 'trim|required');
        $this->form_validation->set_rules('attn', 'attn', 'trim|required');
        $this->form_validation->set_rules('namabarang', 'namabarang', 'trim|required');
        $this->form_validation->set_rules('kriteriaseleksi', 'kriteriaseleksi', 'trim|required');

        $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
        $this->form_validation->set_rules('siup', 'siup', 'trim|required');
        $this->form_validation->set_rules('brosur', 'brosur', 'trim|required');
        $this->form_validation->set_rules('dataproduk', 'dataproduk', 'trim|required');
        $this->form_validation->set_rules('produsen', 'produsen', 'trim|required');
        $this->form_validation->set_rules('agen', 'agen', 'trim|required');
        $this->form_validation->set_rules('perorangan', 'perorangan', 'trim|required');
        $this->form_validation->set_rules('hargasaing', 'hargasaing', 'trim|required');

        $this->form_validation->set_rules('hargapasar', 'hargapasar', 'trim|required');
        $this->form_validation->set_rules('baik', 'baik', 'trim|required');
        $this->form_validation->set_rules('cukup', 'cukup', 'trim|required');
        $this->form_validation->set_rules('dalamkota', 'dalamkota', 'trim|required');
        $this->form_validation->set_rules('luarkota', 'luarkota', 'trim|required');
        $this->form_validation->set_rules('luarnegri', 'luarnegri', 'trim|required');
        $this->form_validation->set_rules('lengkap', 'lengkap', 'trim|required');
        $this->form_validation->set_rules('datecreated', 'datecreated', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
      //  $this->form_validation->set_rules('kl', 'kl', 'trim|required');
        $this->form_validation->set_rules('hasil', 'hasil', 'trim|required');        
        $this->form_validation->set_rules('kesimpulan', 'kesimpulan', 'trim|required');

		
	
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
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('ssbs/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('ssbs/create', 'refresh');
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

            $this->render_template('ssbs/create', $this->data);
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
	public function update($ssb_id)
	{      
        if(!in_array('updateSsb', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$ssb_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('namaperusahaan', 'namaperusahaan', 'trim|required');
        $this->form_validation->set_rules('alamatkantorpusat', 'alamatkantorpusat', 'trim|required');
        $this->form_validation->set_rules('alamatkantorcabang', 'alamatkantorcabang', 'trim|required');
        $this->form_validation->set_rules('telp', 'telp', 'trim|required');
        $this->form_validation->set_rules('fax', 'fax', 'trim|required');
        $this->form_validation->set_rules('attn', 'attn', 'trim|required');
        $this->form_validation->set_rules('namabarang', 'namabarang', 'trim|required');
        $this->form_validation->set_rules('kriteriaseleksi', 'kriteriaseleksi', 'trim|required');

        $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
        $this->form_validation->set_rules('siup', 'siup', 'trim|required');
        $this->form_validation->set_rules('brosur', 'brosur', 'trim|required');
        $this->form_validation->set_rules('dataproduk', 'dataproduk', 'trim|required');
        $this->form_validation->set_rules('produsen', 'produsen', 'trim|required');
        $this->form_validation->set_rules('agen', 'agen', 'trim|required');
        $this->form_validation->set_rules('perorangan', 'perorangan', 'trim|required');
        $this->form_validation->set_rules('hargasaing', 'hargasaing', 'trim|required');

        $this->form_validation->set_rules('hargapasar', 'hargapasar', 'trim|required');
        $this->form_validation->set_rules('baik', 'baik', 'trim|required');
        $this->form_validation->set_rules('cukup', 'cukup', 'trim|required');
        $this->form_validation->set_rules('dalamkota', 'dalamkota', 'trim|required');
        $this->form_validation->set_rules('luarkota', 'luarkota', 'trim|required');
        $this->form_validation->set_rules('luarnegri', 'luarnegri', 'trim|required');
        $this->form_validation->set_rules('lengkap', 'lengkap', 'trim|required');
        $this->form_validation->set_rules('datecreated', 'datecreated', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
       // $this->form_validation->set_rules('kl', 'kl', 'trim|required');
        $this->form_validation->set_rules('hasil', 'hasil', 'trim|required');
     //   $this->form_validation->set_rules('note', 'note', 'trim|required');
        $this->form_validation->set_rules('kesimpulan', 'kesimpulan', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
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

            $update = $this->model_ssbs->update($data, $ssb_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('ssbs/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('ssbs/update/'.$ssb_id, 'refresh');
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
            $this->data['attributes'] = $attributes_final_data;
            $this->data['brands'] = $this->model_brands->getActiveBrands();         
            $this->data['category'] = $this->model_category->getActiveCategroy();           
            $this->data['stores'] = $this->model_stores->getActiveStore();          

            $ssb_data = $this->model_ssbs->getSsbData($ssb_id);
            $this->data['ssb_data'] = $ssb_data;
            $this->render_template('ssbs/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_ssbs->remove($product_id);
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

    public function printpdf($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewSsb', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$ssb_data = $this->model_ssbs->getSsbData($id);
			
			//$ssb_date = date('d/m/Y', $ssb_data['tgl']);
		//	$paid_status = ($ssb_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
            <style >
			@page { 
					margin-top: 100px;
					margin-bottom: 30px;
					margin-right: 10px;
					margin-left: 10px;		
			}
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 20px; background-color: ; text-align: center; }
			
			
			body {
		  border: 0px solid black;
		  background-color: ;
		  padding-top: 10px;
		  padding-right: 10px;
		  padding-bottom: 10px;
		  padding-left: 10px;
		}
		
		
		table thead td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
					font-variant: small-caps;
				}

		

			
			
		   </style>
		<div id="header">
		   <p align="center"><img width="700" height="70" src="assets/images/21.jpg" /></p>
	   </div>
	   
	   <table width="100%" border="0" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:16px"><b> SELEKSI SUPPLIER BARU </b></td>
		   </tr>
		   
	   </table>	  
	   <table width="100%" border="0" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:16px"></td>
		   </tr>
		   
	   </table>	  
		 
		  	   

   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      
       <td colspan="2">
           <table width="100%" border ="0" cellpadding="0">
           
           <tr>
               <td  style="font-size:12px" width=25%">Nama Perusahaan   </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="85%"> '.$ssb_data['namaperusahaan'].' </td>
               
            </tr>
            <tr>
               <td rowspan="2" style="font-size:12px" width="10%">Alamat Kantor Pusat </td>
               <td rowspan="2" style="font-size:12px" width="2%"> : </td>
               <td rowspan="2" align="left" style="font-size:12px" width="75%">'.$ssb_data['alamatkantorpusat'].'</td>
               
               </td>
            </tr>


            <tr>
            
               
              
            </tr>
            <tr>
               <td  style="font-size:12px" width=25%">Alamat Kantor Cabang  </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="85%">'.$ssb_data['alamatkantorcabang'].' </td>
               
               </td>
            </tr>

            <tr>
               <td  style="font-size:12px" width=10%"> Telp    </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="85%"> '.$ssb_data['telp'].'</td>
               
            </tr>
            <tr>
               <td  style="font-size:12px" width=10%"> Fax    </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  style="font-size:12px" width="85%">'.$ssb_data['fax'].' </td>
               
            </tr>
            
            <tr>
            <td  style="font-size:12px" width=10%"> Contact Person   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="85%">'.$ssb_data['attn'].' </td>
            
            </tr>
            </tr>
            
            <tr>
            <td  style="font-size:12px" width=10%"> Nama Barang   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="85%">'.$ssb_data['namabarang'].' </td>
            
            </tr>
            </tr>
            
            <tr>
            <td  style="font-size:12px" width=10%"> Kriteria Seleksi   </td>
            <td  style="font-size:12px" width="2%"> : </td>
            <td  style="font-size:12px" width="85%">'.$ssb_data['kriteriaseleksi'].' </td>
            
            </tr>
        
		 </table>
    </table>
           <br /> <b style="font-size:12px" ></b>
       <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <thead>
       <tr>
       <th width ="4%" align="center" style="font-size:12px">No.</th>
       <th  width="40%"align="center" style="font-size:12px">Uraian Penilaian</th>
       <th width="10%"align="center" style="font-size:12px">Nilai</th>
       <th width="8%" align="center" style="font-size:12px">Penilaian</th>
       
       </tr>
		</thead>';
       
       $output .= '
       <tr>
       <td align="center" style="font-size:11px">1.</td>
       <td align="left" width="20%" style="font-size:11px">NPWP</td>
       <td align="center" style="font-size:11px">2</td>
       <td width="10%" align="center" style="font-size:11px">'.$ssb_data['npwp'].'</td>
       </tr>
       <tr>
       <td align="center" style="font-size:11px">2.</td>
       <td align="left" width="20%" style="font-size:11px">SIUP</td>
       <td align="center" style="font-size:11px">2</td>
       <td width="10%" align="center" style="font-size:11px">'.$ssb_data['siup'].'</td>
       </tr>
       <tr>
       <td align="center" style="font-size:11px">3.</td>
       <td align="left" width="20%" style="font-size:11px">Brosur</td>
       <td align="center" style="font-size:11px">2</td>
       <td width="10%" align="center" style="font-size:11px">'.$ssb_data['brosur'].'</td>
       </tr>
       <tr>
       <td align="center" style="font-size:11px">4.</td>
       <td align="left" width="20%" style="font-size:11px">Data Produk</td>
       <td align="center" style="font-size:11px">2</td>
       <td width="10%" align="center" style="font-size:11px">'.$ssb_data['dataproduk'].'</td>
       </tr>
       <tr>
            <td align="center" style="font-size:11px">6.</td>
            <td align="Left"  style="font-size:11px">Status Perusahaan : 
       
            <br>a. Produsen / Distributor
            <br>b. Agen / Toko
            <br>c. Perorangan
       
       
            </td>
            <td align="center" style="font-size:11px">
    
            <br>12
            <br>7
            <br>1
            </td>
            <td align="center"  style="font-size:11px">
    
            <br>'.$ssb_data['produsen'].'
            <br>'.$ssb_data['agen'].'
            <br>'.$ssb_data['perorangan'].'
            </td>
       </tr>
      














       
       <tr>
            <td align="center" style="font-size:11px">7.</td>
            <td align="Left"  style="font-size:11px">Penetapan Harga : 
       
            <br>a. Harga Bersaing
            <br>b. Harga diatas harga pasar
           
       
       
            </td>
            <td align="center" style="font-size:11px">
    
            <br>15
            <br>5
            
            </td>
            <td align="center"  style="font-size:11px">
    
            <br>'.$ssb_data['hargasaing'].'
            <br>'.$ssb_data['hargapasar'].'
           
            </td>
       </tr>
       <tr>
            <td align="center" style="font-size:11px">8.</td>
            <td align="Left"  style="font-size:11px">Hasil Pemeriksaan Sample Bahan : 
       
            <br>a. Baik
            <br>b. Cukup
           
       
       
            </td>
            <td align="center" style="font-size:11px">
    
            <br>15
            <br>5
            
            </td>
            <td align="center"  style="font-size:11px">
    
            <br>'.$ssb_data['baik'].'
            <br>'.$ssb_data['cukup'].'
           
            </td>
       </tr>
       <tr>
            <td align="center" style="font-size:11px">9.</td>
            <td align="Left"  style="font-size:11px">Lokasi Supplier : 
       
            <br>a. Dalam Kota
            <br>b. Luar Kota
            <br>c. Luar Negri
       
       
            </td>
            <td align="center" style="font-size:11px">
    
            <br>12
            <br>6
            <br>2
            </td>
            <td align="center"  style="font-size:11px">
    
            <br>'.$ssb_data['dalamkota'].'
            <br>'.$ssb_data['luarkota'].'
            <br>'.$ssb_data['luarnegri'].'
            </td>
       </tr>
       <tr>
            <td align="center" style="font-size:11px">10.</td>
            <td align="Left"  style="font-size:11px">Sarana Komunikasi : 
       
            <br>a. Lengkap
            <br>b. Kurang Lengkap
            
       
       
            </td>
            <td align="center" style="font-size:11px">
    
            <br>8
            <br>2
            
            </td>
            <td align="center"  style="font-size:11px">
    
            <br>'.$ssb_data['lengkap'].'
            <br>'.$ssb_data['kl'].'
           
            </td>
       </tr>
    <tr>
       <td align="right" colspan="3" style="font-size:11px"><b>Total Nilai</b></td>
       <td align="center"  style="font-size:11px">'.$ssb_data['hasil'].'</td>
  </tr>
       ';
    }
   $output .= ' ';
  

	

   $output .= '

  
<table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
   <tr>
       <td align ="center" style="font-size:12px" width="35%">
       Disetujui,<br />
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
       </td>
       <td style="font-size:12px" width="35%" align="center"> 
       Diketahui,
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
       </td>

       <td style="font-size:12px"  width="35%" align="center">         
              Dibuat,<br />
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
           <b align="center" ></b> <br /> 
       </td>
       
   </tr>
   <tr>
       <td align ="center" style="font-size:12px" width="35%">
      <u> Billy Afrian </u>
           
       </td>
       <td style="font-size:12px" width="35%" align="center"> 
       <u> Aries Nugraha </u>
           
       </td>

       <td style="font-size:12px"  width="35%" align="center">         
       <u> Dede Tomy</u>
           
       </td>
       
   </tr>
   <tr>
       <td align ="center" style="font-size:12px" width="35%">
       President Director
           
       </td>
       <td style="font-size:12px" width="35%" align="center"> 
       Financial & General Affair
           
       </td>

       <td style="font-size:12px"  width="35%" align="center">         
         Purchasing Dept
           
       </td>
       
   </tr>
</table>


<table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           </td>
           <td style="font-size:12px" width="35%" align="center">         
               
           
           </td>
   
           <td style="font-size:12px"  width="35%" align="center">         
                  Cipacing, '.$ssb_data['tgl'].'
    
           </td>
       </tr>
   </table>
<table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
           <td align ="center" style="font-size:12px" width="35%">
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           </td>
           <td style="font-size:12px" width="35%" align="center">         
               
           
           </td>
   
           <td style="font-size:12px"  width="35%" align="center">         
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
    
           </td>
       </tr>
   </table>

   <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
   <tr>
       <td align ="center" style="font-size:12px" width="35%">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       </td>
       <td style="font-size:12px" width="35%" align="center">         
           
       
       </td>

       <td style="font-size:12px"  width="35%" align="center">         
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />

       </td>
   </tr>
</table>   
   
   ';




   $output .= '
  

   <table width="100%" border ="0" cellpadding="0">
   <tr> <td  style="font-size:12px" width=6%">   </td>
   <td  style="font-size:12px" width=15%"> </td>
   <td  style="font-size:12px" width=2%">   </td>
   <td  style="font-size:12px" width="15%">  </td>
   <td  style="font-size:12px" width=2%">   </td>
   <td  style="font-size:12px" width="55%">  </td>
</tr>
           <tr> <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%">Hasil Seleksi </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="15%"> N &lt; 40  </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="55%">  Tidak dimasukkan ke dalam DST </td>
            </tr>
            <tr> <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%"> </td>
               <td  style="font-size:12px" width=2%">  </td>
               <td  style="font-size:12px" width="15%">N &gt; 40 &lt; 55  </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="55%">Dipertimbangkan   </td>
            </tr>
            <tr> <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%"> </td>
               <td  style="font-size:12px" width=2%">   </td>
               <td  style="font-size:12px" width="15%"> N &gt; 55  </td>
               <td  style="font-size:12px" width=2%"> :  </td>
               <td  style="font-size:12px" width="55%"> Dimasukkan ke dalam DST  </td>
            </tr>
            <tr> <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%"> </td>
               <td  style="font-size:12px" width=2%">   </td>
               <td  style="font-size:12px" width="15%">  </td>
               <td  style="font-size:12px" width=2%">   </td>
               <td  style="font-size:12px" width="55%"> </td>
            </tr>



            <tr>
                <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width="15%">Kesimpulan </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td colspan="3" align="left" style="font-size:12px" width="15%"><b>'.$ssb_data['kesimpulan'].'</b></td>
               
               </td>
            </tr>
   
            <tr>
                <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%">Catatan  </td>
               <td style="font-size:12px" width="2%"> : </td>
               <td  colspan="3"  style="font-size:12px" >..................................................................................................................</td>
               
               </td>
            </tr>
            <tr>
                <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%">  </td>
               <td style="font-size:12px" width="2%">  </td>
               <td  colspan="3"  style="font-size:12px" >..................................................................................................................</td>
              
               </td>
            </tr>
            <tr>
                <td  style="font-size:12px" width=6%">   </td>
               <td  style="font-size:12px" width=15%"> </td>
               <td style="font-size:12px" width="2%">  </td>
               <td  colspan="3"  style="font-size:12px" >..................................................................................................................</td>
               
               </td>
            </tr>
   
            
         </table> ';
       
  
			$ssb_data = $this->model_ssbs->getSsbData($id);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}
















