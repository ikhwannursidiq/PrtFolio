<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Konsumens extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Konsumens';

		$this->load->model('model_konsumens');
        $this->load->model('model_pic');
		$this->load->model('model_attributes');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewKonsumen', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('konsumens/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
public function fetchKonsumenDataold()
	{
		$result = array('data' => array());

		$data = $this->model_konsumens->getKonsumenData();

		foreach ($data as $key => $value) {
		$buttons = '';
            if(in_array('updateKonsumen', $this->permission)) {
    			$buttons .= '<a href="'.base_url('konsumens/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteKonsumen', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

      

			$result['data'][$key] = array(
				$img,
                $value['kode'],
				$value['name'],
                $value['email'],
                $value['pic'],
				$value['alamat'],  
				$value['telp'],
                $value['fax'],
                $value['keterangan'],
				$availability,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    	
public function fetchKonsumenData()
{
    $result = array('data' => array());

    $data = $this->model_konsumens->getKonsumenData();

foreach ($data as $key => $value) {
    $pic_data = $this->model_pic->getPicData($value['pic_id']);
    $currency_data = $this->model_pic->getCurrencyData($value['currency_id']);
    $bank_data = $this->model_pic->getBankData($value['bank_id']);
    // button
    
    $buttons = '';

    if(in_array('viewKonsumen', $this->permission)) {
        $buttons .= '<a href="'.base_url('konsumens/print/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
    }
    if(in_array('updateKonsumen', $this->permission)) {
        $buttons .= '<a href="'.base_url('konsumens/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
    }

    if(in_array('deleteKonsumen', $this->permission)) { 
        $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
    }
    

    $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

    $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

    $qty_status = '';
    if($value['telp'] <= 10) {
        $qty_status = '<span class="label label-warning">Low !</span>';
    } else if($value['telp'] <= 0) {
        $qty_status = '<span class="label label-danger">Out of stock !</span>';
    }


        $result['data'][$key] = array(
            $value['kode'],
            $value['name'],
            $pic_data['name'],
            $value['alamat'],  
            $value['telp'],
            $value['fax'],
            $value['npwp'],
            $value['accountno'],  
            $bank_data['name'],
            $currency_data['name'],
            $value['payterm'],     
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
		if(!in_array('createKonsumen', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('customer_name', 'customer name', 'trim|required');
		$this->form_validation->set_rules('pic', 'pic', 'trim|required');
        $this->form_validation->set_rules('alamat', 'address', 'trim|required');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required');
		
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();

        	$data = array(
        		'name' => $this->input->post('customer_name'),
        		'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
        		'kode' => $this->input->post('kode'),
                'email' => $this->input->post('email'),
                'fax' => $this->input->post('fax'),
        		'image' => $upload_image,
                'pic_id' => $this->input->post('pic'),
                'currency_id' => $this->input->post('currency'),
                'npwp' => $this->input->post('npwp'),
        		'payterm' => $this->input->post('payterm'),
                'bank_id' => $this->input->post('bank'),
                'accountno' => $this->input->post('accountno'),
        		'website' => $this->input->post('website'),	
        		'availability' => $this->input->post('availability'),
        	);

        	$create = $this->model_konsumens->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('konsumens/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('konsumens/create', 'refresh');
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
            $this->data['pic'] = $this->model_pic->getActivePic();    
            $this->data['bank'] = $this->model_pic->getActiveBank();     
            $this->data['currency'] = $this->model_pic->getActiveCurrency();   
            $this->data['kodeunik'] = $this->model_konsumens->buat_kode();       

             $this->render_template('konsumens/create', $this->data);
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
	public function update($konsumen_id)
	{      
        if(!in_array('updateKonsumen', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$konsumen_id) {
            redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('customer_name', 'customer name', 'trim|required');
		$this->form_validation->set_rules('pic', 'pic', 'trim|required');
        $this->form_validation->set_rules('alamat', 'address', 'trim|required');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required');
        $this->form_validation->set_rules('availability', 'Availability', 'trim|required');       if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'name' => $this->input->post('customer_name'),
        		'alamat' => $this->input->post('alamat'),
                'kode' => $this->input->post('kode'),
                'telp' => $this->input->post('telp'),
                'email' => $this->input->post('email'),
        		'fax' => $this->input->post('fax'),
        		'image' => $upload_image,
        	    'pic_id' => $this->input->post('pic'),
                'currency_id' => $this->input->post('currency'),
                'npwp' => $this->input->post('npwp'),
        		'payterm' => $this->input->post('payterm'),
                'bank_id' => $this->input->post('bank'),
                'accountno' => $this->input->post('accountno'),
        		'website' => $this->input->post('website'),
             'availability' => $this->input->post('availability'),
            );

            
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_sopirs->update($upload_image, $konsumen_id);
            }

            $update = $this->model_konsumens->update($data, $konsumen_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('konsumens/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('konsumens/update/'.$konsumen_id, 'refresh');
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
            $this->data['bank'] = $this->model_pic->getActiveBank();         
            $this->data['currency'] = $this->model_pic->getActiveCurrency();           
            $this->data['pic'] = $this->model_pic->getActivePic();          

            // false case
        
            $konsumen_data = $this->model_konsumens->getKonsumenData($konsumen_id);
            $this->data['konsumen_data'] = $konsumen_data;
            $this->render_template('konsumens/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteKonsumen', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $konsumen_id = $this->input->post('konsumen_id');

        $response = array();
        if($konsumen_id) {
            $delete = $this->model_konsumens->remove($konsumen_id);
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

    public function print($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewKonsumen', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$konsumen_data = $this->model_konsumens->getKonsumenData($id);
		
            $bank_data = $this->model_pic->getBankData($konsumen_data['bank_id']);
		//	$company_info = $this->model_company->getCompanyData(1);

		//	$pocompound_date = date('d/m/Y', $pocompound_data['date_time']);
		//	$paid_status = ($pocompound_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '
            <style >
            @font-face { font-family: Roboto Regular; font-weight: normal; src: url(\'fonts/Roboto-Regular.ttf\') format(\'truetype\'); } 
        @font-face { font-family: Roboto Bold; font-weight: bold; src: url(\'fonts/Roboto-Bold.ttf\') format(\'truetype\'); } 
        body { font-family: Roboto Regular, DejaVu Sans, sans-serif; font-weight: normal; line-height:0.71em; font-size:14pt; }
        h1,h2{ font-family: Roboto Bold, sans-serif; font-weight: bold; line-height:1.2em; }
        

        @page { 
                margin-top: 5px;
                margin-bottom: 30px;
                margin-right: 10px;
                margin-left: 10px;		
        }
        #watermark { position: fixed; bottom: 0px; right: 0px; width: 200px; height: 200px; opacity: .1; }
         #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
        
        
    body {
      border: 0px solid black;
      background-color: ;
      padding-top: 10px;
      padding-right: 10px;
      padding-bottom: 10px;
      padding-left: 10px;
     
    }
    table.section1 {
       
        border-spacing: 0px;
        border-style: solid;
        border-color: black;
            text-align: right;
           
       
        }
    table .warna {
        border-width: 0px;
        border-color: #ffffff;   
        
        
    }
      

    table .abcd{
    border-top:    1px solid  #ffffff;
    border-right:  1px dashed #ffffff;
    border-bottom: 1px dotted #000000;
    border-left:   1px solid  #000000;
    }

    table .abc{
        border-top:    1px solid  #ffffff;
        border-right:  1px dashed #ffffff;
        border-bottom: 1px solid #ffffff;
        border-left:   1px solid  #000000;
        }

        table .bawah{
            border-top:    1px solid  #ffffff;
            border-right:  1px dashed #ffffff;
            border-bottom: 1px solid #000000;
            border-left:   1px solid  #000000;
            }

            table .atas{
                border-top:    1px solid  #ffffff;
                border-right:  1px solid #000000;
                border-bottom: 1px solid #000000;
                border-left:   1px solid  #000000;
                }
                table .note{
                    border-top:    1px solid  #ffffff;
                    border-right:  1px solid #000000;
                    border-bottom: 1px solid #ffffff;
                    border-left:   1px solid  #000000;
                    }
                    table .notedasar{
                        border-top:    1px solid  #000000;
                        border-right:  1px solid #ffffff;
                        border-bottom: 1px solid #ffffff;
                        border-left:   1px solid  #ffffff;
                        }
                    table .warna2{
                        border-top:    1px solid  #000000;
                        border-right:  1px solid #000000;
                        border-bottom: 1px solid #ffffff;
                        border-left:   1px solid  #000000;
                        }
                        table .warna3{
                            border-top:    1px solid  #ffffff;
                            border-right:  1px solid #000000;
                            border-bottom: 1px solid #ffffff;
                            border-left:   1px solid  #000000;
                            }

                            td.test2 {
                                writing-mode: vertical-rl; 
                              }

                              
                            p.test2 {
                                writing-mode: vertical-rl; 
                              }
    
                           
    </style>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
    <td colspan="2" align="center" style="font-size:16px " ><img width="750" height="100" src="assets/images/headera.jpg" /></td>
    </tr>
    
</table>	  

	   <table width="100%" border="1" cellpadding="5" cellspacing="0">
		   <tr>
		   <td colspan="2" align="center" style="font-size:16px;  background-color:#1E90FF; " ><b> Customer Detail Information </b></td>
		   </tr>
		   
	   </table>	  

   <table width="100%" border="1" cellpadding="5" cellspacing="0"> 
           <tr>
                <td  style="font-size:12px; background-color:#DCDCDC;" width="20%"> Customer Code  </td>
               <td style="font-size:12px; background-color:#DCDCDC;" width="40%">: '.$konsumen_data['kode'].'  </td>
           
               </td>
            </tr>
  
            <tr>
                <td  style="font-size:12px" width="20%"> Customer Name  </td>
               <td style="font-size:12px" width="40%">: '.$konsumen_data['name'].'  </td>
           
              
            </tr>
            <tr>
            <td  style="font-size:12px; background-color:#DCDCDC;" width=20%">Address   </td>
            <td  style="font-size:12px; background-color:#DCDCDC;" width="40%">: '.$konsumen_data['alamat'].' </td>
          
         </tr>
 
        <tr>
            <td  style="font-size:12px; background-color:" width=20%">Phone number  </td>
            <td  style="font-size:12px; background-color:" width="40%">: '.$konsumen_data['telp'].' </td>
        
         </tr>

      <tr>
      <td  style="font-size:12px; background-color:#DCDCDC;" width=20%">NPWP  </td>
      <td  style="font-size:12px; background-color:#DCDCDC;" width="40%">: '.$konsumen_data['npwp'].' </td>
   
   </tr>

<tr>
   <td  style="font-size:12px; background-color:" width=20%">Bank   </td>
   <td  style="font-size:12px; background-color:" width="40%">: '.$bank_data['name'].' </td>

</tr>

<tr>
   <td  style="font-size:12px; background-color:" width=20%">Account no   </td>
   <td  style="font-size:12px; background-color:" width="40%">: '.$konsumen_data['accountno'].' </td>

</tr>

<tr>
<td  style="font-size:12px; background-color:#DCDCDC;" width=20%">Payment Term  </td>
<td  style="font-size:12px; background-color:#DCDCDC;" width="40%">: '.$konsumen_data['payterm'].' </td>

</tr>

<tr>
<td  style="font-size:12px" width="20%"> Website  </td>
<td style="font-size:12px" width="40%">: '.$konsumen_data['website'].'  </td>


</tr>

</table>

         <table width="100%" border="1" cellpadding="5" cellspacing="0">
         <tr>
         <td colspan="2" align="center" style="font-size:16px;  background-color:#1E90FF;  " ><b> Contact Person </b></td>
         </tr>';


         $pic_data = $this->model_pic->getPicData($konsumen_data['pic_id']);
         $email_data = $this->model_pic->getPicData($konsumen_data['pic_id']);
         $telp_data = $this->model_pic->getPicData($konsumen_data['pic_id']);
         $bagian_data = $this->model_pic->getPicData($konsumen_data['pic_id']);
   $output .= '             
         <tr>
         <td  style="font-size:12px" width=20%">PIC Name  </td>
         <td  style="font-size:12px" width="40%">: '.$pic_data['name'].' </td>
        
         </tr>
     
         <tr>
         <td  style="font-size:12px; background-color:#DCDCDC;" width=20%">Email   </td>
         <td  style="font-size:12px; background-color:#DCDCDC;" width="40%">: '.$email_data['email'].' </td>
       
         </tr>

         <tr>
         <td  style="font-size:12px" width=20%">Phone Number  </td>
         <td  style="font-size:12px" width="40%">: '.$telp_data['telp'].' </td>
        
         </tr>

         <tr>
         <td  style="font-size:12px; background-color:#DCDCDC;" width=20%">Department  </td>
         <td  style="font-size:12px; background-color:#DCDCDC;" width="40%">: '.$bagian_data['bagian'].' </td>
       
         </tr>
      
     </table>	  
    </table>';

   $output .= '

       <table style="font-size:12px"  width="100%" border="0" cellpadding="0" cellspacing="0">	
       <tr>
       <td style="font-size:12px"  width="25%">
       <td style="font-size:12px" width="25%">         
       </td> 
       <td style="font-size:12px" width="25%">    <br />     
       </td>
       </tr>
       </table>
       </tr>';
       

  $output .= '</table>';

			$konsumen_data = $this->model_konsumens->getKonsumenData($id);
			
		//	$company_info = $this->model_company->getCompanyData(1);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	


	}

}