<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Gi extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Gi';

		$this->load->model('model_gi');
		$this->load->model('model_trial');
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
        if(!in_array('viewGi', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('gi/index', $this->data);	
	}

    /*
    * It Fetches the ssbs data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchGiData()
	{
		$result = array('data' => array());

		$data = $this->model_gi->getGiData();

		foreach ($data as $key => $value) {

           // $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
			if(in_array('viewGi', $this->permission)) {
    			$buttons .= '<a href="'.base_url('gi/printrecord/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }
            if(in_array('viewGi', $this->permission)) {
    			$buttons .= '<a href="'.base_url('gi/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }
            if(in_array('updateGi', $this->permission)) {
    			$buttons .= '<a href="'.base_url('gi/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteGi', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<a href="'.base_url('gi/printpdf/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';

            //$availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            //$qty_status = '';
           // if($value['qty'] <= 10) {
             //   $qty_status = '<span class="label label-warning">Low !</span>';
            //} else if($value['qty'] <= 0) {
              //  $qty_status = '<span class="label label-danger">Out of stock !</span>';
           // }


			$result['data'][$key] = array(
                $img,
				$value['partno'],
				$value['partname'],
                $value['type'],
                $value['customer'],
                $value['packstd'],
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
		if(!in_array('createGi', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Gi';

		$this->form_validation->set_rules('partno', 'partno', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$gi_id = $this->model_gi->create();
        	
        	if($gi_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('gi/update/'.$gi_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('gi/create/', 'refresh');
        	}
        }
        else {
          
        	      	
            $this->render_template('gi/create', $this->data);
        }	
	}

	
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
    public function update($id)
	{
		if(!in_array('updateGi', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Poumum';

		$this->form_validation->set_rules('partno', 'partno', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_gi->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('gi/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('gi/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	
        	$result = array();
        	$gi_data = $this->model_gi->getGiData($id);

    		$result['gi'] = $gi_data;
    		$historypart = $this->model_gi->getHistorypartData($gi_data['id']);

    		foreach($historypart as $k => $v) {
    			$result['historypart'][] = $v;
    		}

    		$this->data['gi_data'] = $result;

           
            $this->render_template('gi/edit', $this->data);
        }
	}


	public function update1($gi_id)
	{      
        if(!in_array('updateGi', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$gi_id) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('partno', 'partno', 'trim|required');
        $this->form_validation->set_rules('partname', 'partname', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('customer', 'customer', 'trim|required');
        $this->form_validation->set_rules('model', 'model', 'trim|required');
        $this->form_validation->set_rules('yeardev', 'yeardev', 'trim|required');
        $this->form_validation->set_rules('hosestd', 'hosestd', 'trim|required');
        $this->form_validation->set_rules('prodqty', 'prodqty', 'trim|required');

        $this->form_validation->set_rules('packstd', 'packstd', 'trim|required');
        $this->form_validation->set_rules('note', 'note', 'trim|required');
        $this->form_validation->set_rules('dimid', 'dimid', 'trim|required');
       $this->form_validation->set_rules('dimod', 'dimod', 'trim|required');
       $this->form_validation->set_rules('dimthickness', 'dimthickness', 'trim|required');
       $this->form_validation->set_rules('dimlenght', 'dimlenght', 'trim|required');
        $this->form_validation->set_rules('wgross', 'wgross', 'trim|required');
        $this->form_validation->set_rules('wactual', 'wactual', 'trim|required');

        $this->form_validation->set_rules('ctextrude', 'ctextrude', 'trim|required');
        $this->form_validation->set_rules('ctwaya', 'ctwaya', 'trim|required');
        $this->form_validation->set_rules('ctcutting', 'ctcutting', 'trim|required');
        $this->form_validation->set_rules('ctfinishing', 'ctfinishing', 'trim|required');
        $this->form_validation->set_rules('cttotal', 'cttotal', 'trim|required');
       $this->form_validation->set_rules('cmlayersatu', 'cmlayersatu', 'trim|required');
       $this->form_validation->set_rules('layersatuw', 'layersatuw', 'trim|required');
       $this->form_validation->set_rules('cmlayerdua', 'cmlayerdua', 'trim|required');
       $this->form_validation->set_rules('layerduaw', 'layerduaw', 'trim|required');
      $this->form_validation->set_rules('cslayersatu', 'cslayersatu', 'trim|required');
       $this->form_validation->set_rules('cslayerdua', 'cslayerdua', 'trim|required');        
       $this->form_validation->set_rules('csfabrictype', 'csfabrictype', 'trim|required');

		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	//$upload_image = $this->upload_image();

        	$data = array(
             'partno' => $this->input->post('partno'),
             'partname' => $this->input->post('partname'),
             'type' => $this->input->post('type'),
             'customer' => $this->input->post('customer'),
             'model' => $this->input->post('model'),
             'yeardev' => $this->input->post('yeardev'),
             'hosestd' => $this->input->post('hosestd'),
             'prodqty' => $this->input->post('prodqty'),
             'packstd' => $this->input->post('packstd'),
             'note' => $this->input->post('note'),
             'dimid' => $this->input->post('dimid'),
             'dimod' => $this->input->post('dimod'),
             'dimthickness' => $this->input->post('dimthickness'),
             'dimlenght' => $this->input->post('dimlenght'),	
             'wgross'  => $this->input->post('wgross'),
             'wactual'  => $this->input->post('wactual'),
             'ctextrude'  => $this->input->post('ctextrude'),
             'ctwaya' => $this->input->post('ctwaya'),
             'ctcutting' => $this->input->post('ctcutting'),
             'ctfinishing'  => $this->input->post('ctfinishing'),
             'cttotal'  => $this->input->post('cttotal'),
             'cmlayersatu' => $this->input->post('cmlayersatu'),
             'layersatuw'  => $this->input->post('layersatuw'),
             'cmlayerdua'  => $this->input->post('cmlayerdua'),
             'layerduaw' => $this->input->post('layerduaw'),
             'cslayersatu' => $this->input->post('cslayersatu'),
             'cslayerdua' => $this->input->post('cslayerdua'),
             'csfabrictype' => $this->input->post('csfabrictype'),
             'csw'  => $this->input->post('csw'),
             'springname'  => $this->input->post('springname'),
             'springtype' => $this->input->post('springtype'),
             'springqty' => $this->input->post('springqty'),  
             'ringname'  => $this->input->post('ringname'),
             'ringtype' => $this->input->post('ringtype'),
             'ringqty' => $this->input->post('ringqty'), 
             'tapename'  => $this->input->post('tapename'),
             'tapetype' => $this->input->post('tapetype'),
             'tapeqty'  => $this->input->post('tapeqty'),  
             'covername' => $this->input->post('covername'),
             'covertype' => $this->input->post('covertype'),
             'coverqty' => $this->input->post('coverqty'),  
             'epmethod'  => $this->input->post('epmethod'),
             'braidingtype' => $this->input->post('braidingtype'),
             'dies'  => $this->input->post('dies'),
             'rpmbrai'  => $this->input->post('rpmbrai'),
             'rpmbraiii'  => $this->input->post('rpmbraiii'),
             'rpmbraiv' => $this->input->post('rpmbraiv'),
             'rpmbrav' => $this->input->post('rpmbrav'),
             'rpmconi'  => $this->input->post('rpmconi'),  
             'rpmconiii' => $this->input->post('rpmconiii'),
             'rpmconiv'  => $this->input->post('rpmconiv'),
             'rpmconv'  => $this->input->post('rpmconv'),
             'gear' => $this->input->post('gear'),
             'cavity' => $this->input->post('cavity'),
             'mesh' => $this->input->post('mesh'),
             'glue' => $this->input->post('glue'),
             'postcure' => $this->input->post('postcure'),
             'toping'  => $this->input->post('toping'),
             'wsl'  => $this->input->post('wsl'),
             'wsp'  => $this->input->post('wsp'),
             'fsl'  => $this->input->post('fsl'),
             'fsp' => $this->input->post('fsp'),
             'mandrelwood'  => $this->input->post('mandrelwood'),
             'mandrelstainless' => $this->input->post('mandrelstainless'),
             'mandrelalmunium' => $this->input->post('mandrelalmunium'),
             'mandrelqty'  => $this->input->post('mandrelqty'),
             'tollsgeji'  => $this->input->post('tollsgeji'),
             'tollsjig'  => $this->input->post('tollsjig'),
             'tollscek'  => $this->input->post('tollscek'),
         //	'datecreated'  => $this->input->post('datecreated'),
         //	'gip_status' => 2,
         //    'user_id' => $user_id
        
            );

            $update = $this->model_gi->update($data, $gi_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('gi/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('gi/update/'.$gi_id, 'refresh');
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

            $gi_data = $this->model_gi->getGiData($gi_id);
            $this->data['gi_data'] = $gi_data;
            $this->render_template('gi/edit', $this->data); 
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
		if(!in_array('viewGi', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$gi_data = $this->model_gi->getGiData($id);
            $historypart = $this->model_gi->getHistorypartData($id);
			//$ssb_date = date('d/m/Y', $ssb_data['tgl']);
		//	$paid_status = ($ssb_data['paid_status'] == 1) ? "Paid" : "Unpaid";
			$output = '

            <style >
            @font-face { font-family: Roboto Regular; font-weight: normal; src: url(\'fonts/Roboto-Regular.ttf\') format(\'truetype\'); } 
            @font-face { font-family: Roboto Bold; font-weight: bold; src: url(\'fonts/Roboto-Bold.ttf\') format(\'truetype\'); } 
            body{ font-family: Roboto Regular, sans-serif; font-weight: normal; line-height:1.02em; font-size:14pt; }
            h1,h2{ font-family: Roboto Bold, sans-serif; font-weight: bold; line-height:1.2em; }
            
    
			@page { 
					margin-top: 5px;
					margin-bottom: 30px;
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
         
		}
		
        table .warna {
            border-width: 0px;
            border-color: #ffffff;    
        }
          
		
	</style>
           

	   <table width="100%" border="0" cellpadding="5" cellspacing="5">
		   <tr>
		     <td  align="left" style="font-size:20px; width=10%"><img width="90" height="50" src="assets/images/logo.jpg" /></td>
             <td  align="left" style=" font-size:20px; width=70%"><u><b>GENERAL INFORMATION PART</b></u> <br><br></td>
           </tr>
		   
	   </table>	  	  	   
           
         
   
       <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
       <tr>
       
       <th colspan="3"  width="5%"align="left" style="font-size:12px; background-color:#ffed00;">&nbsp;Part No</th>
       <th colspan="3"width=15%" align="center" style="font-size:11px">'.$gi_data['partno'].'</th>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
      
       <th colspan="4" width="20%"align="center" style="font-size:12px;  background-color:#ffed00;">Compound Material</th>
       </tr>
		</thead>';
       
       $output .= '
       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;"><b>&nbsp;Part Name</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['partname'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
     
       <td rowspan="2" align="center" width="8%" style="font-size:11px;  background-color:#ffed00;"><b>Layer 1</b></td>   
       <td rowspan="2" align="center" width="8%" style="font-size:11px;  background-color:#ffed00;"><b>Weight (gr)</b></td>   
       <td rowspan="2" align="center" width="8%" style="font-size:11px;  background-color:#ffed00;"><b>Layer 2</b></td>   
       <td rowspan="2" align="center" width="8%" style="font-size:11px;  background-color:#ffed00;"><b>Weight (gr)</b></td>   
       </tr>

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px ;  background-color:#ffed00;"><b>&nbsp;Type</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['type'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Customer</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['customer'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
      
       <td rowspan="2" align="center" width="10%" style="font-size:11px;  background-color:#ffffff;">'.$gi_data['cmlayersatu'].'</td>   
       <td rowspan="2" align="center" width="10%" style="font-size:11px;  background-color:#ffffff;">'.$gi_data['layersatuw'].'</td>   
       <td rowspan="2" align="center" width="10%" style="font-size:11px;  background-color:#ffffff;">'.$gi_data['cmlayerdua'].'</td>   
       <td rowspan="2" align="center" width="10%" style="font-size:11px;  background-color:#ffffff;">'.$gi_data['layerduaw'].'</td>   
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Model / Project</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['model'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
      
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Year Development</b></td>      
       <td colspan="3" width="10%" align="center" style="font-size:11px">'.$gi_data['yeardev'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
       
       <td   colspan="4" width="2%" align="center" style="font-size:11px; background-color:#ffed00;"><b>Compound Specification</td>
       
        
       </tr>
      
       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Hose Standart</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['hosestd'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
     
       <td colspan="2" align="center" width="10%" style="font-size:11px;  background-color:#ffed00;"><b>Layer 1</td>   
       <td colspan="2" align="center" width="10%" style="font-size:11px;  background-color:#ffed00;"><b>Layer 2</td>   
       </tr>
      
      
      

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Production (Qty / Month)</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['prodqty'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
      
       <td colspan="2" rowspan="4" align="center" width="10%" style="font-size:11px;  background-color:#ffffff;">'.$gi_data['cslayersatu'].'</td>   
       <td colspan="2" rowspan="4"  align="center" width="10%" style="font-size:11px;  background-color:#ffffff;">'.$gi_data['cslayerdua'].'</td>   
       </tr>

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Packing Standart</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['packstd'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="5%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Note / Q Point</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:11px">'.$gi_data['note'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
     
       </tr>
       

       <tr>
       <td rowspan="4" colspan="2"align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Dimension</b></td> 
       <td colspan="2" align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>ID (mm)</b></td>        
       <td colspan="2" width="10%" align="center" style="font-size:11px">'.$gi_data['dimid'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
     
       
       </tr>
       <tr>
      
       <td colspan="2" align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>OD (mm)</b></td>        
      <td colspan="2" width="10%" align="center" style="font-size:11px">'.$gi_data['dimod'].'</td>
      <th class="warna" width="2%" align="center" style="font-size:11px"></th>
       
       <td colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Thread / Fabric Type</td>   
       <td align="center" width="8%" style="font-size:11px; background-color:#ffed00;">&nbsp;<b>Weight (gr)</td>   
       </tr>
       <tr>
       
       <td colspan="2" align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Thickness (mm)</b></td>        
       <td colspan="2" width="10%" align="center" style="font-size:11px">'.$gi_data['dimthickness'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
      
       <td rowspan="2" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['csfabrictype'].'</td>   
       <td  rowspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['csw'].'</td>   
       </tr>

       <tr>
       
       <td colspan="2" align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Lenght(mm)</b></td>        
       <td colspan="2"width="10%" align="center" style="font-size:11px"> '.$gi_data['dimlenght'].' </td>
       <th class="warna" width="2%" align="center" style="font-size:11px"></th>
      
      
       </tr>

       <tr>
       <td colspan="2"align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Weight Gross </b></td> 
       <td  align="center" width="10%" style="font-size:12px;  background-color:#ffffff;">&nbsp;<b> '.$gi_data['wgross'].' </b></td>        
       <td colspan="2" width="10%" align="center" style="font-size:11px;  background-color:#ffed00;"> <b>Actual Weight</b></td>
       <td width="10%" align="center" style="font-size:11px"> '.$gi_data['wactual'].'</td>
       <td class="warna" colspan="5" align="center" width="2%" style="font-size:11px; background-color:#ffffff;"></td>   
      
       </tr>
      




<tr>
       <td rowspan="5" align="left" width="8%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Cycle Time (s)</b></td> 
       <td align="left" width="8%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Extrude</b></td>        
       <td  width="10%" align="center" style="font-size:11px">'.$gi_data['ctextrude'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
       <td colspan="7" width="10%" align="center" style="font-size:12px;   background-color:#ffed00;"><b>Sub Material</td>

       </tr>

       <tr>
      
       <td align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b> Waya</b></td>        
      <td  width="10%" align="center" style="font-size:11px">'.$gi_data['ctwaya'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
      
       <td  align="center" width="8%" style="font-size:11px; background-color:#acacac;"></td>   
       <td colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Nama</td>   
       <td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Type / Dimension</td>   
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;">&nbsp;<b>Qty</td>   


       </tr>
       <tr>
       
       <td align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Cutting</b></td>        
       <td  width="10%" align="center" style="font-size:11px">'.$gi_data['ctcutting'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
     
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;">&nbsp;<b>Spring</td>   
       <td colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['springname'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['springtype'].'</td>   
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['springqty'].'</td>   
       </tr>

       <tr>
       
       <td  align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Finishing</b></td>        
       <td width="10%" align="center" style="font-size:11px">'.$gi_data['ctfinishing'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;">&nbsp;<b>Ring</td>   
       <td colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['ringname'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['ringtype'].'</td>   
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['ringqty'].'</td>   
      
       </tr>
       <tr>
       
       <td  align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Total</b></td>        
       <td width="10%" align="center" style="font-size:11px">'.$gi_data['cttotal'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:11px"></td>
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;">&nbsp;<b>Tape</td>   
       <td colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['tapename'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['tapetype'].'</td>   
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['tapeqty'].'</td>   
      
      
       </tr>

       <tr>
       
       <td class="warna" colspan="4" align="left" width="10%" style="font-size:12px;  background-color:#ffffff;"><b></b></td>        
       <td width="10%" align="center" style="font-size:11px; background-color:#ffed00;">&nbsp;<b>Cover</td>
         
       <td colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['covername'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['covertype'].'</td>   
       <td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['coverqty'].'</td>   
      
      
       </tr>


    <tr>
       
       <td colspan="11" rowspan="2" align="center" width="10%" style="font-size:14px;  background-color:#ffed00;"><b>Extrussion Process</b>
       <br><br></td>        
       
    </tr>
    <tr><br><br>
    </tr>

<tr>     
    <td colspan="2" rowspan="2" align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Method</b></td>        
    <td colspan="5" rowspan="2" align="center" width="10%" style="font-size:12px;  background-color:#ffffff;">'.$gi_data['epmethod'].'</td>        
    <td colspan="4" rowspan="2" align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>DIES</b></td>  
</tr>

<tr>      
</tr>

 <tr>     
 <td colspan="2" rowspan="2" align="left" width="10%" style="font-size:12px;  background-color:#ffed00;">&nbsp;<b>Braiding Type</b></td>        
 <td colspan="5" rowspan="2" align="center" width="10%" style="font-size:12px;  background-color:#ffffff;">'.$gi_data['braidingtype'].'</td>        
 <td colspan="4" rowspan="2" align="center" width="10%" style="font-size:12px;  background-color:#ffffff;">'.$gi_data['dies'].'</td>  
</tr>

<tr>      
</tr>




<tr>
       
 <td colspan="4" align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>RPM Braiding</b></td>        
 <td colspan="5" width="10%" align="center" style="font-size:11px; background-color:#ffed00;"><b>RPM Conveyor</b></td>
 <td colspan="2" rowspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Gear</b></td>   
 
</tr>

<tr>
       
 <td  align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>MC 1</b></td>        
 <td  width="10%" align="center" style="font-size:11px; background-color:#ffed00;"><b>MC 3</b></td>
 <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>MC 4</b></td>   
 <td align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>MC 5</b></td>   
 <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>MC 1</b></td>   
 <td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>MC 3</b></td>
 <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>MC 4</b></td>   
 <td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>MC 5</b></td>
 
 

</tr>
<tr>
       
<td  align="center" width="10%" style="font-size:12px;  background-color:#ffffff;">'.$gi_data['rpmbrai'].'</td>        
<td  width="10%" align="center" style="font-size:11px">'.$gi_data['rpmbraiii'].'</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['rpmbraiv'].'</td>   
<td align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['rpmbrav'].'</td>   
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['rpmconi'].'</td>   
<td colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['rpmconiii'].'</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['rpmconiv'].'</td>   
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['rpmconv'].'</td>
<td  colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['gear'].'</td>


</tr>








<tr>
       
 <td  align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>Cavity</b></td>        
 <td colspan="2"  width="10%" align="center" style="font-size:11px"><b>'.$gi_data['cavity'].'</b></td>
 
 <td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></b></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></b></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></b></td>

</tr>

<tr>
       
<td   align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>Mesh</b></td>        
<td  colspan="2"  width="10%" align="center" style="font-size:11px"><b>'.$gi_data['mesh'].'</b></td>
<td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></b></td>   
<td class="" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Wabari Size (mm)</b></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td class="" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Fabric Size (mm)</b></td>
</tr>


<tr>
       
<td  align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>Glue</b></td>        
<td colspan="2"  width="10%" align="center" style="font-size:11px"><b>'.$gi_data['glue'].'</b></td>
 

<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b>P =  '.$gi_data['wsp'].'</b></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b>P = '.$gi_data['fsp'].'</b></td>



</tr>


<tr>
       
<td  align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>Postcure</b></td>        
<td colspan="2"  width="10%" align="center" style="font-size:11px"><b>'.$gi_data['postcure'].'</b></td>
 
   
<td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></b></td>   
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:grey;"><b></b></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:11px; background-color:grey;"></td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b></b></td>   
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"><b></b></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"></td>
<td  class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"></td> 

</tr>

<tr>
       
<td  align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>Toping</b></td>        
<td colspan="2"  width="10%" align="center" style="font-size:11px"><b>'.$gi_data['toping'].'</b></td>
 

<td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b><b>L = </b>'.$gi_data['wsl'].' </b></b></td>   
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:grey;"><b></b></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:11px; background-color:grey;"><b></b></td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"><b> L = </b>'.$gi_data['fsl'].'  </b></td>   
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"><b></b></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"></td>
<td  class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"></td> 

</tr>

<tr>
       
<td class="warna" align="center" width="10%" style="font-size:12px;  background-color:#ffffff;"></td>        
<td class="warna" colspan="2"  width="10%" align="center" style="font-size:11px"></td>
 

<td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:grey;"></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:11px; background-color:grey;"></td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;">.</td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;"></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffb1b9;">.</td> 

</tr>

<tr>
       
<td class="warna" align="center" width="10%" style="font-size:12px;  background-color:#ffffff;"></td>        
<td class="warna" colspan="2"  width="10%" align="center" style="font-size:11px"></td>
 

<td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">.</td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">.</td> 

</tr>





















<tr>
<td colspan="11"  width="10%" align="center" style="font-size:14px;  background-color:#ffed00;"><b>Tooling</td>
</tr>

<tr>       
<td colspan="5"  width="10%" align="center" style="font-size:11px;  background-color:#ffed00;"><b>Master Mandrel</td>
<td colspan="2" rowspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Mandrel Qty</td>
<td  align="center" rowspan="2" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Geji</td>   
<td  align="center" rowspan="2" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Jig Cutting</td>
<td colspan="2" rowspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Check and Fixture</td>

</tr>

<tr>      
<td  align="center" width="10%" style="font-size:12px;  background-color:#ffed00;"><b>Wood</td>        
<td colspan="2"  width="10%" align="center" style="font-size:11px;  background-color:#ffed00;"><b>Stainless</td>
<td colspan="2"  width="10%" align="center" style="font-size:11px;  background-color:#ffed00;"><b>Almunium</td>
</tr>

<tr>
       
<td  align="center" width="10%" style="font-size:12px;  background-color:#ffffff;">'.$gi_data['mandrelwood'].'</td>        
<td colspan="2"  width="10%" align="center" style="font-size:11px; background-color:#ffffff;">'.$gi_data['mandrelstainless'].'</td>
<td  colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['mandrelalmunium'].'</td>   
<td  colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['mandrelqty'].'</td>   
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['tollsgeji'].'</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['tollsjig'].'</td>

<td  colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$gi_data['tollscek'].'</td> 

</tr>


<tr>
       
<td class="warna" align="center" width="10%" style="font-size:12px;  background-color:#ffffff;"></td>        
<td class="warna" colspan="2"  width="10%" align="center" style="font-size:11px"></td>
<td class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">.</td>
<td  class="warna" align="center" width="8%" style="font-size:11px; background-color:#ffffff;"></td>
<td class="warna"  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">.</td> 

</tr>


<tr>      
<td colspan="11"  width="10%" align="center" style="font-size:14px;  background-color:#ffed00;"><b>History Part</td>
</tr>



<tr>      
<td   width="10%" align="center" style="font-size:11px;  background-color:#ffed00;"><b>No</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>Revision</td>
<td colspan="7" align="center"  width="8%" style="font-size:11px; background-color:#ffed00;"><b>Description</td>   
<td  align="center"  width="8%" style="font-size:11px; background-color:#ffed00;"><b>Date</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffed00;"><b>PIC</td>

</tr>';
$no =0;
	foreach ($historypart as $k => $v) {

			$no++;
  
       $output .= '

<tr>      
<td   width="10%" align="center" style="font-size:11px;  background-color:#ffffff;">'.$no.'</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$v['revisi'].'</td>
<td colspan="7" align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$v['des'].'</td>   
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$v['date'].'</td>
<td  align="center" width="8%" style="font-size:11px; background-color:#ffffff;">'.$v['pic'].'</td>

</tr>';
    }
   $output .= '</table>';
  

	



   $historypart = $this->model_gi->getHistorypartData($id);
		
			$gi_data = $this->model_gi->getGiData($id);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	



	}
}
