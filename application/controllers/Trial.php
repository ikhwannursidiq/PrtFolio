<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Trial extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Gi';
        $this->load->model('model_trial');
		$this->load->model('model_gi');
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
        if(!in_array('viewTrial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('Trial/index', $this->data);	
	}

    /*
    * It Fetches the ssbs data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchTrialData()
	{
		$result = array('data' => array());

		$data = $this->model_trial->getTrialData();

		foreach ($data as $key => $value) {

           // $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
            
            if(in_array('viewTrial', $this->permission)) {
    			$buttons .= '<a href="'.base_url('trial/printtrial/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }

             if(in_array('updateTrial', $this->permission)) {
    			$buttons .= '<a href="'.base_url('trial/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteTrial', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$joken = '<a href="'.base_url('trial/printjoken/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            $joken2 = '<a href="'.base_url('trial/printGi/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';

			$result['data'][$key] = array(
                $joken,
                $joken2,
             $value['trialno'],
             $value['date_created'],
				$value['partno'],
				$value['partname'],
                $value['type'],
                $value['cmlayersatu'],
                $value['cmlayerdua'],
             
                $buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}
    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createTrial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('partno', 'partno', 'trim|required');
        $this->form_validation->set_rules('partname', 'partname', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
  
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	//$upload_image = $this->upload_image();

        	$data = array(
            'date_created'  => $this->input->post('date_created'),
            'trialno'  => $this->input->post('trialno'),
 
             //start eng   
            //finish engginering
          
  //awal extrussion   

        	);


        	$create = $this->model_trial->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('trial/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('trial/create', 'refresh');
        	}
        }
            $this->render_template('trial/create', $this->data);
      
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
		if(!in_array('updateTrial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Trial';

		$this->form_validation->set_rules('partno', 'partno', 'trim|required');
        $this->form_validation->set_rules('partname', 'partname', 'trim|required');
       
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_trial->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('trial');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('trial/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	// $company = $this->model_company->getCompanyData(1);
        //	$this->data['company_data'] = $company;
        //	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        //	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$trial_data = $this->model_trial->getTrialData($id);

    		$result['trial'] = $trial_data;
    		
            $trial_item = $this->model_trial->getTrialItemData($trial_data['id']);
    		foreach($trial_item as $k => $v) {
    			$result['trial_item'][] = $v;
    		}

            $trial_itemdua = $this->model_trial->getTrialItemDataDua($trial_data['id']);
    		foreach($trial_itemdua as $k => $v) {
    			$result['trial_itemdua'][] = $v;
    		}



    		$this->data['trial_data'] = $result;

        //	$this->data['products'] = $this->model_products->getActiveProductData();      	
         //   $this->data['vroducts'] = $this->model_vroducts->getActiveVroductData(); 
          
            $this->render_template('trial/edit', $this->data);
        }
	}

	
	public function remove()
	{
        if(!in_array('deleteTrial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $trial_id = $this->input->post('trial_id');

        $response = array();
        if($trial_id) {
            $delete = $this->model_trial->remove($trial_id);
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

   

   public function printGi($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewTrial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$trial_data = $this->model_trial->getTrialData($id);
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
       
       <th colspan="3"  width="0%"align="left" style="font-size:10PX; background-color:#ffed00;">&nbsp;Part No</th>
       <th colspan="3"width=15%" align="center" style="font-size:10PX">'.$trial_data['partno'].'</th>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
      
       <th colspan="4" width="20%"align="center" style="font-size:10PX;  background-color:#ffed00;">Compound Material</th>
       </tr>
		</thead>';
       
       $output .= '
       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;"><b>&nbsp;Part Name</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['partname'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
     
       <td rowspan="2" align="center" width="8%" style="font-size:10PX;  background-color:#ffed00;"><b>Layer 1</b></td>   
       <td rowspan="2" align="center" width="8%" style="font-size:10PX;  background-color:#ffed00;"><b>Weight (gr)</b></td>   
       <td rowspan="2" align="center" width="8%" style="font-size:10PX;  background-color:#ffed00;"><b>Layer 2</b></td>   
       <td rowspan="2" align="center" width="8%" style="font-size:10PX;  background-color:#ffed00;"><b>Weight (gr)</b></td>   
       </tr>

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX ;  background-color:#ffed00;"><b>&nbsp;Type</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['type'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Customer</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['customer'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
      
       <td rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['cmlayersatu'].'</td>   
       <td rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['wipbh'].'</td>   
       <td rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['cmlayerdua'].'</td>   
       <td rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['wipcover'].'</td>   
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Model / Project</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['model'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
      
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Year Development</b></td>      
       <td colspan="3" width="10%" align="center" style="font-size:10PX">'.$trial_data['yeardev'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
       
       <td   colspan="4" width="2%" align="center" style="font-size:10PX; background-color:#ffed00;"><b>Compound Specification</td>
       
        
       </tr>
      
       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Hose Standart</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['hosestd'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
     
       <td colspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Layer 1</td>   
       <td colspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Layer 2</td>   
       </tr>
      
      
      

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Production (Qty / Month)</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['prodqty'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
      
       <td colspan="2" rowspan="4" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['cslayersatu'].'</td>   
       <td colspan="2" rowspan="4"  align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['cslayerdua'].'</td>   
       </tr>

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Packing Standart</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['packstd'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
       
       </tr>

       <tr>
       <td colspan="3" align="left" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Note / Q Point</b></td>      
       <td colspan="3" width="15%" align="center" style="font-size:10PX">'.$trial_data['note'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
     
       </tr>
       

       <tr>
       <td rowspan="4" colspan="2"align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Dimension</b></td> 
       <td colspan="2" align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>ID (mm)</b></td>        
       <td colspan="2" width="10%" align="center" style="font-size:10PX">'.$trial_data['dimid'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
     
       
       </tr>
       <tr>
      
       <td colspan="2" align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>OD (mm)</b></td>        
      <td colspan="2" width="10%" align="center" style="font-size:10PX">'.$trial_data['dimod'].'</td>
      <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
       
       <td colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Thread / Fabric Type</td>   
       <td align="center" width="8%" style="font-size:10PX; background-color:#ffed00;">&nbsp;<b>Weight (gr)</td>   
       </tr>
       <tr>
       
       <td colspan="2" align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Thickness (mm)</b></td>        
       <td colspan="2" width="10%" align="center" style="font-size:10PX">'.$trial_data['dimthickness'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
      
       <td rowspan="2" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['extmat'].'&nbsp; '.$trial_data ['exttt'].' </td>   
       <td  rowspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['csw'].'</td>   
       </tr>

       <tr>
       
       <td colspan="2" align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Lenght(mm)</b></td>        
       <td colspan="2"width="10%" align="center" style="font-size:10PX"> '.$trial_data['dimlenght'].' </td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
      
      
       </tr>

       <tr>
       <td colspan="2"align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Weight Gross </b></td> 
       <td  align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b> '.$trial_data['wiptotal'].' </b></td>        
       <td colspan="2" width="10%" align="center" style="font-size:10PX;  background-color:#ffed00;"> <b>Actual Weight</b></td>
       <td width="10%" align="center" style="font-size:10PX"> '.$trial_data['wactual'].'</td>
       <td class="warna" colspan="5" align="center" width="2%" style="font-size:10PX; background-color:#ffffff;"></td>   
      
       </tr>
      




<tr>
       <td rowspan="5" align="left" width="8%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Cycle Time (s)</b></td> 
       <td align="left" width="8%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Extrude</b></td>        
       <td  width="10%" align="center" style="font-size:10PX">'.$trial_data['ctextrude'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
       <td colspan="7" width="10%" align="center" style="font-size:10PX;   background-color:#ffed00;"><b>Sub Material</td>

       </tr>

       <tr>
      
       <td align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b> Waya</b></td>        
      <td  width="10%" align="center" style="font-size:10PX">'.$trial_data['ctwaya'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
      
       <td  align="center" width="8%" style="font-size:10PX; background-color:#acacac;"></td>   
       <td colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Nama</td>   
       <td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Type / Dimension</td>   
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;">&nbsp;<b>Qty</td>   


       </tr>
       <tr>
       
       <td align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Cutting</b></td>        
       <td  width="10%" align="center" style="font-size:10PX">'.$trial_data['ctcutting'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
     
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;">&nbsp;<b>Spring</td>   
       <td colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['springname'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['springtype'].'</td>   
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['springqty'].'</td>   
       </tr>

       <tr>
       
       <td  align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Finishing</b></td>        
       <td width="10%" align="center" style="font-size:10PX">'.$trial_data['ctfinishing'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;">&nbsp;<b>Ring</td>   
       <td colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['ringname'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['ringtype'].'</td>   
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['ringqty'].'</td>   
      
       </tr>
       <tr>
       
       <td  align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Total</b></td>        
       <td width="10%" align="center" style="font-size:10PX">'.$trial_data['cttotal'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;">&nbsp;<b>Tape</td>   
       <td colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tapename'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tapetype'].'</td>   
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tapeqty'].'</td>   
      
      
       </tr>

       <tr>
       
       <td class="warna" colspan="4" align="left" width="10%" style="font-size:10PX;  background-color:#ffffff;"><b></b></td>        
       <td width="10%" align="center" style="font-size:10PX; background-color:#ffed00;">&nbsp;<b>Cover</td>
         
       <td colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['covername'].'</td>   
       <td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['covertype'].'</td>   
       <td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['coverqty'].'</td>   
      
      
       </tr>


    <tr>
       
       <td colspan="11" rowspan="2" align="center" width="10%" style="font-size:14px;  background-color:#ffed00;"><b>Extrussion Process</b>
       <br><br></td>        
       
    </tr>
    <tr><br><br>
    </tr>

<tr>     
    <td colspan="2" rowspan="2" align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Method</b></td>        
    <td colspan="5" rowspan="2" align="center" width="10%" style="font-size:12PX;  background-color:#ffffff;">'.$trial_data['epmethod'].'&nbsp;'.$trial_data['emsinglelayer'].'&nbsp;'.$trial_data['emcontinous'].'&nbsp;'.$trial_data['embasichose'].'</td>        
    <td colspan="4" rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>DIES</b></td>  
</tr>

<tr>      
</tr>

 <tr>     
 <td colspan="2" rowspan="2" align="left" width="10%" style="font-size:10PX;  background-color:#ffed00;">&nbsp;<b>Braiding Type</b></td>        
 <td colspan="5" rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['extcones'].'&nbsp;BOBIN &nbsp;'.$trial_data['brtype'].'</td>        
 <td colspan="4" rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['sdsingle'].',&nbsp;'.$trial_data['sddouble'].'</td>  
</tr>

<tr>      
</tr>




<tr>
       
 <td colspan="4" align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>RPM Braiding</b></td>        
 <td colspan="5" width="10%" align="center" style="font-size:10PX; background-color:#ffed00;"><b>RPM Conveyor</b></td>
 <td colspan="2" rowspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Gear</b></td>   
 
</tr>

<tr>
       
 <td  align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>MC 1</b></td>        
 <td  width="10%" align="center" style="font-size:10PX; background-color:#ffed00;"><b>MC 3</b></td>
 <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>MC 4</b></td>   
 <td align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>MC 5</b></td>   
 <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>MC 1</b></td>   
 <td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>MC 3</b></td>
 <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>MC 4</b></td>   
 <td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>MC 5</b></td>
 
 

</tr>
<tr>
       
<td  align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['rpmbrai'].'</td>        
<td  width="10%" align="center" style="font-size:10PX">'.$trial_data['rpmbraiii'].'</td>
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmbraiv'].'</td>   
<td align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmbrav'].'</td>   
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmconi'].'</td>   
<td colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmconiii'].'</td>
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmconiv'].'</td>   
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmconv'].'</td>
<td  colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['extgear'].'</td>


</tr>








<tr>
       
 <td  align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Cavity</b></td>        
 <td colspan="2"  width="10%" align="center" style="font-size:10PX"><b>'.$trial_data['cavity'].'</b></td>
 
 <td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></b></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></b></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></b></td>

</tr>

<tr>
       
<td   align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Mesh</b></td>        
<td  colspan="2"  width="10%" align="center" style="font-size:10PX"><b>'.$trial_data['mesh'].'</b></td>
<td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></b></td>   
<td class="" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Wabari Size (mm)</b></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td class="" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Fabric Size (mm)</b></td>
</tr>


<tr>
       
<td  align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Glue</b></td>        
<td colspan="2"  width="10%" align="center" style="font-size:10PX"><b>'.$trial_data['gluecomp'].'</b></td>
 

<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b>P =  '.$trial_data['wsp'].'</b></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td class="warna" colspan="3" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b>P = '.$trial_data['fsp'].'</b></td>



</tr>


<tr>
       
<td  align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Postcure</b></td>        
<td colspan="2"  width="10%" align="center" style="font-size:10PX"><b>'.$trial_data['postcure'].'</b></td>
 
   
<td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></b></td>   
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:grey;"><b></b></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:10PX; background-color:grey;"></td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b></b></td>   
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"><b></b></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"></td>
<td  class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"></td> 

</tr>

<tr>
       
<td  align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Toping</b></td>        
<td colspan="2"  width="10%" align="center" style="font-size:10PX"><b>'.$trial_data['toping'].'</b></td>
 

<td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b><b>L = </b>'.$trial_data['wsl'].' </b></b></td>   
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:grey;"><b></b></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:10PX; background-color:grey;"><b></b></td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"><b> L = </b>'.$trial_data['fsl'].'  </b></td>   
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"><b></b></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"></td>
<td  class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"></td> 

</tr>

<tr>
       
<td class="warna" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;"></td>        
<td class="warna" colspan="2"  width="10%" align="center" style="font-size:10PX"></td>
 

<td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:grey;"></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:10PX; background-color:grey;"></td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;">.</td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;"></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffb1b9;">.</td> 

</tr>

<tr>
       
<td class="warna" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;"></td>        
<td class="warna" colspan="2"  width="10%" align="center" style="font-size:10PX"></td>
 

<td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">.</td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">.</td> 

</tr>





















<tr>
<td colspan="11"  width="10%" align="center" style="font-size:14px;  background-color:#ffed00;"><b>Tooling</td>
</tr>

<tr>       
<td colspan="5"  width="10%" align="center" style="font-size:10PX;  background-color:#ffed00;"><b>Master Mandrel</td>
<td colspan="2" rowspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Mandrel Qty</td>
<td  align="center" rowspan="2" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Geji</td>   
<td  align="center" rowspan="2" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Jig Cutting</td>
<td colspan="2" rowspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Check and Fixture</td>

</tr>

<tr>      
<td  align="center" width="10%" style="font-size:10PX;  background-color:#ffed00;"><b>Wood</td>        
<td colspan="2"  width="10%" align="center" style="font-size:10PX;  background-color:#ffed00;"><b>Stainless</td>
<td colspan="2"  width="10%" align="center" style="font-size:10PX;  background-color:#ffed00;"><b>Almunium</td>
</tr>

<tr>
       
<td  align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['mandrelwood'].'</td>        
<td colspan="2"  width="10%" align="center" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['mandrelstainless'].'</td>
<td  colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['mandrelalmunium'].'</td>   
<td  colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['mqty'].'</td>   
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tollsgeji'].'</td>
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tollsjig'].'</td>

<td  colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tollscek'].'</td> 

</tr>


<tr>
       
<td class="warna" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;"></td>        
<td class="warna" colspan="2"  width="10%" align="center" style="font-size:10PX"></td>
<td class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td class="warna" colspan="2" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>   
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">.</td>
<td  class="warna" align="center" width="8%" style="font-size:10PX; background-color:#ffffff;"></td>
<td class="warna"  align="center" width="8%" style="font-size:10PX; background-color:#ffffff;">.</td> 

</tr>


<tr>      
<td colspan="11"  width="10%" align="center" style="font-size:14px;  background-color:#ffed00;"><b>History Part</td>
</tr>

<tr>      
<td   width="10%" align="center" style="font-size:10PX;  background-color:#ffed00;"><b>No</td>
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Revision</td>
<td colspan="7" align="center"  width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Description</td>   
<td  align="center"  width="8%" style="font-size:10PX; background-color:#ffed00;"><b>Date</td>
<td  align="center" width="8%" style="font-size:10PX; background-color:#ffed00;"><b>PIC</td>

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


   $output .= '</table> ';
  

	



			$historypart = $this->model_gi->getHistorypartData($id);
			$trial_data = $this->model_trial->getTrialData($id);
			$dompdf ->loadHtml($output);
			$dompdf ->setpaper('A4','portrait');
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	}





 public function printtrial($id)
	{
		$dompdf = new Dompdf();
		if(!in_array('viewTrial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$trial_data = $this->model_trial->getTrialData($id);
            $mandrel_data = $this->model_trial->getTrialCheckMandrel($id);
            $material_data = $this->model_trial->getTrialCheckMaterial($id);
			

            
			$autosatu = ($trial_data['autosatu'] == null) ? "1ap.jpg" : "1ab.jpg";
            $autodua = ($trial_data['autodua'] == null) ? "2ap.jpg" : "2ab.jpg";
            $autotiga = ($trial_data['autotiga'] == null) ? "3ap.jpg" : "3ab.jpg";
            $autoempat = ($trial_data['autoempat'] == null) ? "4ap.jpg" : "4ab.jpg";
            $autolima = ($trial_data['autolima'] == null) ? "5ap.jpg" : "5ab.jpg";
            $autoenam = ($trial_data['autoenam'] == null) ? "6ap.jpg" : "6ab.jpg";
            $autotujuh = ($trial_data['autotujuh'] == null) ? "7ap.jpg" : "7ab.jpg";
            $autodelapan = ($trial_data['autodelapan'] == null) ? "8ap.jpg" : "8ab.jpg";
            $autosembilan = ($trial_data['autosembilan'] == null) ? "9ap.jpg" : "9ab.jpg";
            $autosepuluh = ($trial_data['autosepuluh'] == null) ? "10ap.jpg" : "10ab.jpg";
            $autosebelas = ($trial_data['autosebelas'] == null) ? "11ap.jpg" : "11ab.jpg";
            $autoduabelas = ($trial_data['autoduabelas'] == null) ? "12ap.jpg" : "12ab.jpg";

            $possatu = ($trial_data['possatu'] == null) ? "1pp.jpg" : "1pb.jpg";
            $posdua = ($trial_data['posdua'] == null) ? "2pp.jpg" : "2pb.jpg";
            $postiga = ($trial_data['postiga'] == null) ? "3pp.jpg" : "3pb.jpg";

            $approved = ($trial_data['approved'] == 1) ? "Waiting" : "Oke";
            $checked = ($trial_data['checked'] == 1) ? "Zalil" : "Jajang S";
            $prepared = ($trial_data['prepared'] == 1) ? "Eki" : "Dzulqifly";

            $cns = ($trial_data['emcontinous'] == null) ? "-" : "&#10003;";
            $bh = ($trial_data['embasichose'] == null) ? "-" : "&#10003;";
            $sl = ($trial_data['emsinglelayer'] == null) ? "-" : "&#10003;";
		
		
			$trialresult = ($trial_data['trialresult'] == 1) ? "ro.jpg" : "rn.jpg";
		
			//$ssb_date = date('d/m/Y', $ssb_data['tgl']);
		//	$paid_status = ($ssb_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
			 #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 1px; background-color: ; text-align: center; }
			
			
		body {
		  border: 0px solid black;
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
		
	</style>
           

	   <table width="100%" border="1" cellpadding="0" cellspacing="0">
		   <tr>
		     <td colspan="3" rowspan="2" align="center" style="font-size:12px; width=10%"><img width="90" height="50" src="assets/images/logo.jpg" /> </td>
			 <td colspan="3" rowspan="2" align="left" style="font-size:12px; width=10%">&nbsp;<b>PT SHIMADA KARYA INDONESIA </b>
			 <br>&nbsp;Engineering
			 <br  >&nbsp;Jl.Raya Cipacing KM.20 Rancaekek, Sumedang 
			 </td>
			 <td colspan="3" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;TRIAL RECORD</td>
			 <td colspan="2"  align="center" style=" font-size:16px; width=20%"><b>'.$trial_data['trialno'].'</b> </td>
          
           </tr>
		   
		     <tr> 
			    <td align="left" colspan="2"  style=" font-size:10PX; width=10%">&nbsp;Trial date: '.date('d-m-Y ', strtotime($trial_data['date_created'])).' </td>
				
           </tr>
		   
	 </table>	  	  	   
           
   
<table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
       <tr>
       
       <th colspan="15" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffed00;">ENGINEERING</th>
      
		</thead>';
       
       $output .= '
       <tr>
       <td colspan="2" align="CENTER" width="10%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Part Number</td>      
          <td colspan="4" width="10%" align="center" style="font-size:10PX">'.$trial_data['partno'].'</td>
          <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
          <td rowspan="2" colspan="2" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">Production Manual Section</td>   
          <td rowspan="2" colspan="2"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;"> Wrapping</td>   
          <td rowspan="2" colspan="4" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">&#9745; &nbsp; '.$trial_data['wrapping'].'</td>   
       </tr>






       <tr>
       <td colspan="2" align="center" width="10%" style="font-size:10PX ;  background-color:#ffffff;">&nbsp;Part Name</td>      
          <td colspan="4" width="0%" align="center" style="font-size:10PX">'.$trial_data['partname'].'</td>
          <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
       </tr>

       <tr>
       <td colspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Type</td>      
            <td colspan="4" width="0%" align="center" style="font-size:10PX">'.$trial_data['type'].'</td>
            <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
            <td rowspan="4" colspan="2" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">Wire Section</td>   
            <td colspan="2" rowspan="" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">Fabric</td>   
            <td rowspan="" colspan="4" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['wsfabric'].'</td>   
       </tr>


       <tr>
       <td colspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Safety Part &nbsp;&nbsp; <img width="20" height="13" src="assets/images/s.jpg" /></b></td>      
            <td colspan="4" width="0%" align="center" style="font-size:10PX"> &#9745; &nbsp;'.$trial_data['safetypart'].'</td>
            <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
            <td colspan="2" rowspan="" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">Nakabi Wrapping</td>   
            <td rowspan=""  colspan="4" align="center" style="font-size:10PX;  background-color:#ffffff;">&#9745; &nbsp;'.$trial_data['nw'].'</td>   
       </tr>

       <tr>
       <td colspan="2" rowspan="4" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Material</b></td>      
            <td colspan="4" width="0%" align="center" style="font-size:10PX">Compound Code</td>
            <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
            <td  colspan="2" width="0%" align="center" style="font-size:10PX; background-color:#ffffff;">Wiring </td>  
            <td  colspan="2" width="0%" align="center" style="font-size:10PX; background-color:#ffffff;">Wrap</td>  
            <td  colspan="2" width="0%" align="center" style="font-size:10PX; background-color:#ffffff;">Silicone</td>  
       </tr>
      
       <tr>
       <td colspan="2" width="2%" align="center" style="font-size:10PX">'.$trial_data['cmlayersatu'].'</td>
            <td colspan="2" width="2%" align="center" style="font-size:10PX">'.$trial_data['cmlayerdua'].'</td>
            <td class="warna" width="2%" align="center" style="font-size:10PX"></td>
            <td colspan="2" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;size :'.$trial_data['wiringsize'].'</td>   
            <td colspan="2" align="right" width="0%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['wrappingply'].' Ply&nbsp;</td>   
            <td colspan="2" align="right" width="0%" style="font-size:10PX;  background-color:#ffffff;"> '.$trial_data['siliconeply'].'Ply&nbsp;</td> 
       </tr>
      
      
      

       <tr>   
       <td colspan="2" width="10%" align="center" style="font-size:10PX">Thread</td>
            <td colspan="2" width="0%" align="center" style="font-size:10PX">Fabric</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td> 
       <td colspan="2"  align="center" style="background-color:#fffffF; font-size:10PX;" >Glueing</td>                  
       <td colspan="2"  align="center" style="background-color:#ffffff; font-size:10PX;" >&nbsp;'.$trial_data['glueing'].'</td>
       <td colspan="2"  width="0%" align="center" style="background-color:#ffffff; font-size:10PX;" >Glue Compound</td>   
       <td colspan="2"  align="center" style="background-color:#ffffff; font-size:10PX;" >&nbsp;'.$trial_data['gluecomp'].'</td>
    
       </tr>

       <tr>
     
       <td colspan="2" width="0%" align="center" style="font-size:10PX">'.$trial_data['csfabrictype'].'</td>
       <td colspan="2"  width="2%" align="center" style="font-size:10PX">'.$trial_data['mfabric'].'</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>

       <td colspan="4" align="center" style="background-color:#ffffff; font-size:10PX;" >Weight Estimation (GRAM)</td>
       <td colspan="2" rowspan="2"   width="0%" align="center" style="background-color:#ffffff; font-size:10PX;" >Mandrell /
       Roll</b></td>    
       <td colspan="2" colspan="" align="center" style="background-color:#ffffff; font-size:10PX;" >Mandrell (pcs)</b></td>
        
     

       </tr>

       <tr>
       <td colspan="2" rowspan="2" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Dimension Estimation (mm)</b></td>      
       <td colspan="" width="8%" align="center" style="font-size:10PX">&nbsp;Thickness</b></td>
       <td class="" width="8%" align="center" style="font-size:10PX">ID</td>
       <td colspan="" width="8%" align="center" style="font-size:10PX">OD</td>
       <td class="" width="8%" align="center" style="font-size:10PX">Lenght</td>
       <td class="warna" width="2%" align="center" style="font-size:10PX"></td>

       <td colspan="2" align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;">Basic Hose</td>                    
       <td  align="center"  width="6%" style="background-color:#ffffff; font-size:10PX;">Cover</td> 
       <td colspan=""  align="center" width="6%" style="background-color:#ffffff ;  font-size:10PX;" >Total</td>
       <td  align="center"  colspan=""  width="7%" style="background-color:#ffffff;  font-size:10PX;">Quantity</td> 
       <td colspan=""  align="center" width="6%" style="background-color:#ffffff;  font-size:10PX;" >Cavity</td>
      
     
       </tr>
       

       <tr>
       <td rowspan="" colspan=""align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['dimthickness'].'</td> 
       <td colspan="" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['dimid'].'</td>        
       <td colspan="" width="0%" align="center" style="font-size:10PX">'.$trial_data['dimod'].'</td>
       <td class="" width="2%" align="center" style="font-size:10PX">'.$trial_data['dimlenght'].'</td>
       <th class="warna" width="2%" align="center" style="font-size:10PX"></th>
       <td colspan="2"  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;">'.$trial_data['webasichose'].'</td>                    
       <td  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;">'.$trial_data['wecover'].'</td> 
       <td colspan=""  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;" >'.$trial_data['wetotal'].'</td>
       <td  align="center" colspan="2"  style="background-color:#ffffff; width:0% ; font-size:10PX;">'.$trial_data['wemr'].'</td> 
      
       <td  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;" >'.$trial_data['mqty'].'</td>
       <td  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;" >'.$trial_data['cavity'].'</td>
       </tr>

</table> ';









    }

   $output .= ' 
   
   <table width="100%" border="1" cellpadding="0" cellspacing="0">
       <thead>
       <tr>
       
       <th colspan="22" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffed00;">EXTRUSION</th>
      
		</thead>
       
       <tr>
       <td colspan="2" rowspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#87ceeb;">&nbsp;Material</td>      
          <td colspan="2" width="10%" align="center" style="font-size:10PX">&nbsp; Compound Code</td>

          <td colspan="2"  class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['emccsatu'].'</th>
          <td colspan="2" colspan="" align="center" width="0%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['emccdua'].'</td>   
          <td rowspan="" colspan="14"  align="center" width="0%" style="font-size:10PX;  background-color:#87CEEB">Machine No.</td>       
       </tr>


    <tr>
       <td colspan="2" align="center" width="10%" style="font-size:10PX ;  background-color:#ffffff;">&nbsp;No Lot</td>      
          <td colspan="2" width="10%" align="center" style="font-size:10PX">'.$trial_data['emlotsatu'].'</td>
          <td colspan="2" width="10%" align="center" style="font-size:10PX">'.$trial_data['emlotdua'].'</td>

          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['msatu'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mdua'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mtiga'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mempat'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mlima'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['menam'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mtujuh'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mdelapan'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['msembilan'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['msepuluh'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['msebelas'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mduabelas'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mtigabelas'].'" /></td>
          <td colspan="" class="" width="3%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/'.$trial_data['mempatbelas'].'" /></td>
        
          
       </tr>



    <tr>
       
       <td colspan="6" align="center" width="0%"align="left" style="font-size:10PX; background-color:#87ceeb;">Extrusion Method</th>
      
 
       <td colspan="16" align="center" width="0%"align="left" style="font-size:10PX; background-color:#87ceeb;">Dimension</th>
      
       
    </tr>
       <tr>
          <td colspan="2" align="center" width="10%" style="font-size:10PX;  background-color:#ffffff;">Continous</td>      
          <td colspan="2" width="10%" align="center" style="font-size:10PX">Basic Hose</td>
          <td colspan="2"  class="" width="0%" align="center" style="font-size:10PX">Single Layer</th>
          <td colspan="" colspan="" align="center" width="8%" style="font-size:10PX;  background-color:#ffffff;">Layer 1</td>   
          <td rowspan="" colspan=""  align="center" width="8%" style="font-size:10PX;  background-color:#ffffff">Layer 2</td>       
          <td rowspan="" colspan="5"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">Total Thickness</td>   
          <td rowspan="" colspan="3"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">ID</td>   
          <td rowspan="" colspan="3"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">OD</td>
          <td rowspan="" colspan="3"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">Lenght</td>      

       </tr>

    <tr>
       <td colspan="2" align="center" width="10%" style="font-size:20PX;  background-color:#ffffff;">'.$cns.'</td>      
       <td colspan="2" width="10%" align="center" style="font-size:20PX">'.$bh.'</td>
       <td colspan="2"  class="" width="0%" align="center" style="font-size:20PX">'.$sl.'</td>
       <td colspan="" colspan="" align="center" width="8%" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['emlyrsatu'].'</td>   
       <td rowspan="" colspan=""  align="center" width="8%" style="font-size:10PX;  background-color:#ffffff">'.$trial_data['emlyrdua'].'</td>       
       <td rowspan="" colspan="5"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">'.$trial_data['edimtotal'].'</td>   
       <td rowspan="" colspan="3"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">'.$trial_data['edimid'].'</td>   
       <td rowspan="" colspan="3"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">'.$trial_data['edimod'].'</td>
       <td rowspan="" colspan="3"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">'.$trial_data['edimlenght'].'</td>       
    </tr>
</table> ';



$output .= ' 
   
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
    <td colspan="3" rowspan="2" align="center" width=15%" style="font-size:10PX;  background-color:#87ceeb;">&nbsp;Mesh Size</td>      
       <td colspan="2" width="10%" align="center" style="font-size:10PX;  background-color:#87ceeb;">&nbsp; Setting Dies</td>
       <td colspan="2"  class="" width="0%" align="center" style="font-size:10PX;  background-color:#87ceeb;">Temperature </th>
       <td colspan="5" colspan="" align="center" width="0%" style="font-size:10PX;  background-color: #87ceeb;">RPM Set</td>   
       <td rowspan="" colspan="12"  align="center" width="0%" style="font-size:10PX;  background-color:#87CEEB">WIP WEIGHT (gram)</td>       
    </tr>

 <tr>
    <td colspan="" align="center" width="8%" style="font-size:10PX ;  background-color:#ffffff;"> Single </td>      
       <td colspan="" width="8%" align="center" style="font-size:10PX">Double</td>
       <td colspan="" width="8%" align="center" style="font-size:10PX">Screw 1</td>
       <td colspan="" width="8%" align="center" style="font-size:10PX">Screw 2</td>
       <td colspan="" class="" width="8%" align="center" style="font-size:10PX">EXT 1</td>
       <td colspan="" class="" width="8%" align="center" style="font-size:10PX">EXT 2</td>

       <td colspan="3" class="" width="3%" align="center" style="font-size:10PX">Conveyor</td>
       <td colspan="3" class="" width="3%" align="center" style="font-size:10PX">Basic Hose</td>
       <td colspan="3" class="" width="3%" align="center" style="font-size:10PX">Cover</td>
       <td colspan="3" class="" width="3%" align="center" style="font-size:10PX">Thread</td>
       <td colspan="3" class="" width="3%" align="center" style="font-size:10PX">Total</td>     
    </tr>



 <tr>
    
    <td colspan="3" align="center" width="10%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['mesh'].'</th>
    <td colspan="" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['sdsingle'].'</th>
    <td colspan="" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['sddouble'].'</th>
   
    <td colspan="" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tscrewsatu'].'</th>
   
    <td colspan="" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['tscrewdua'].'</th>
   
    <td colspan="" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmextsatu'].'</th>
   
    <td colspan="" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmextdua'].'</th>
    <td colspan="3" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['rpmconveyor'].'</th>
    <td colspan="3" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['wipbh'].'</th>
   
    <td colspan="3" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['wipcover'].'</th>
    <td colspan="3" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['wipthread'].'</th>
    <td colspan="3" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffffff;">'.$trial_data['wiptotal'].'</th>
   
 </tr>

 
</table> ';



$output .= ' 
   
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    
    <tr>
       
    <td colspan="9" align="center" width="0%"align="left" style="font-size:10PX; background-color:#87ceeb;">BRAIDING</th>
   

    <td colspan="10" align="center" width="0%"align="left" style="font-size:10PX; background-color:#87ceeb;">EXTRUSION CYCLE TIME/PCS (second)</th>
   
    
 </tr>

    <tr>
    <td colspan="3" rowspan="" align="center" width=10%" style="font-size:10PX;  background-color:#ffffff;">Type</td>      
       <td colspan="6" width="0%" align="center" style="font-size:10PX;  background-color:#ffffff;">Machine No.</td>
       <td colspan=""  class="" width="0%" align="center" style="font-size:10PX;  background-color:#ffffff;">1 </th>
       <td colspan="" colspan="" align="center" width="0%" style="font-size:10PX;  background-color: #ffffff;">2</td>   
       <td rowspan="" colspan=""  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">3</td>  
       <td colspan=""  class="" width="0%" align="center" style="font-size:10PX;  background-color:#ffffff;">4 </th>
       <td colspan="" colspan="" align="center" width="0%" style="font-size:10PX;  background-color: #ffffff;">5</td>   
       <td rowspan="" colspan=""  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">6</td>  
       <td  colspan="2" align="center" width="0%" style="font-size:10PX;  background-color: #ffffff;">Total</td>   
       <td rowspan="" colspan="2"  align="center" width="0%" style="font-size:10PX;  background-color:#ffffff">Average</td>  
     
     
       
    </tr>

 <tr>
    <td colspan="3" align="center" width="10%" style="font-size:10PX ;  background-color:#ffffff;">&#9745; &nbsp; '.$trial_data['brtype'].' </td>      
       <td colspan="" width="0%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/bra/'.$trial_data['bmsatu'].'" /></td>
       <td colspan="" width="0%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/bra/'.$trial_data['bmdua'].'" /></td>
       <td colspan="" width="0%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/bra/'.$trial_data['bmtiga'].'" /></td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/bra/'.$trial_data['bmempat'].'" /></td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/bra/'.$trial_data['bmlima'].'" /></td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX"><img width="18" height="13" src="assets/images/bra/'.$trial_data['bmenam'].'" /></td>

       <td colspan="" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ectsatu'].'/'.$trial_data['ectsatux'].'</td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ectdua'].'/'.$trial_data['ectduax'].'</td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ecttiga'].'/'.$trial_data['ecttigax'].'</td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ectempat'].'/'.$trial_data['ectempatx'].'</td>
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ectlima'].'/'.$trial_data['ectlimax'].'</td>   
       <td colspan="" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ectenam'].'/'.$trial_data['ectenamx'].'</td>
       
       <td colspan="2" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ecttotal'].'</td>   
       <td colspan="2" class="" width="0%" align="center" style="font-size:10PX">'.$trial_data['ectrata'].'</td>     
    </tr>


<tr>
    <td rowspan="2" colspan="2" align="center" style="background-color:#fffFFF; font-size:10PX;" >Material</td>
    <td rowspan="2" colspan="" align="center" style="background-color:#fffFFF; font-size:10PX;" >Thread Type</td>
    <td rowspan="2" colspan="" align="center" style="background-color:#fffFFF; font-size:10PX;" >Cones</td>
    <td rowspan="2" colspan="" align="center" style="background-color:#fffFFF; font-size:10PX;" >Gear</td>
    <td colspan="4" align="center" style="background-color:#ffffff; font-size:10PX;" >RPM Set</td>
    <td rowspan="3" colspan="10" class="wr" align="Left" style="background-color:#ffffff; font-size:10PX;" >&nbsp; Notes: &nbsp;'.$trial_data['ectnotes'].' <br>
    <br>
    <br>
    </td>
    
</tr>
<tr>
    <td colspan="2" align="center" style="background-color:#ffffff; font-size:10PX;" >Conveyor</td>
    <td colspan="2" align="center" style="background-color:#fffFFF; font-size:10PX;" >Braiding</td>
   

</tr>
<tr>
<td colspan="2"  align="center" style="background-color:#fffffF; width:0% ; font-size:10PX;">'.$trial_data['extmat'].'</td>
<td  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;">'.$trial_data['exttt'].'</td>    
<td  align="center" style="background-color:#fffffF; width:0% ; font-size:10PX;">'.$trial_data['extcones'].'</td>
<td  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;">'.$trial_data['extgear'].'</td>
<td colspan="2"  align="center" style="background-color:#fffffF; width:0% ; font-size:10PX;">'.$trial_data['rpmsetconv'].'</td>
<td colspan="2"  align="center" style="background-color:#ffffff; width:0% ; font-size:10PX;">'.$trial_data['rpmsetbra'].'</td>

</tr>

 
</table> ';













$output .= ' 
   
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    
<tr>
       
<td colspan="26" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffed00;">PRODUKSI MANUAL / WAYA</th>


</tr>

<tr>
<td colspan="3" rowspan="2" align="center" width=0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Proses Wrapping</td>    
<td colspan="3" rowspan="2" align="center" width=0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['pmpw'].'</td>

<td colspan="2" rowspan="2" align="center" width=10%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Wabari</td>  
   <td colspan="2" width="10%" align="center" style="font-size:10PX;  background-color:#ffffff;">Code</td>
   <td colspan="4"  class="" width="10%" align="center" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['pmwcode'].'</th>
   <td colspan="3" rowspan="2" align="center" width="0%" style="font-size:10PX;  background-color: #ffffff;">Berat</td> 
   <td colspan="6" width="10%" align="center" style="font-size:10PX;  background-color:#ffffff;">Wabari</td>
   <td colspan="3"  class="" width="0%" align="right" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['beratwabari'].'  gr &nbsp;</th>  
 
</tr>

<tr>
    <td colspan="2" rowspan="" align="center" width=10%" style="font-size:10PX;  background-color:#ffffff;">No. Lot</td>      
       <td colspan="4" width="0%" align="center" style="font-size:10PX;  background-color:#ffffff;">'.$trial_data['pmwlot'].'</td>
       <td colspan="6"  class="" width="0%" align="center" style="font-size:10PX;  background-color:#ffffff;">Wabari (Setelah Wabari)</th>
       <td colspan="3" colspan="" align="right" width="0%" style="font-size:10PX;  background-color: #ffffff;">'.$trial_data['beratwip'].' gr  &nbsp;</td>     
</tr>

 <tr>
    <td colspan="16" align="center"  style="font-size:10PX ;  background-color:#87ceeb;"> MANDRELING CYCLE TIME / PCS (second)</td>      
    <td colspan="10" align="center"  style="font-size:10PX ;  background-color:#87ceeb;"> CURRING</td>        
</tr>


<tr>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >1</td>
<td  colspan="" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >2</td>
<td  colspan="" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >3</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >4</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >5</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >6</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >7</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >8</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >9</td>
<td  colspan="" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >10</td>
<td  colspan="3" rowspan=""  width="3%" align="center" style="background-color:#ffffff; font-size:10PX;" >Total </td>
<td colspan="3" rowspan=""   width="3%" align="center" style="background-color:#ffffff; font-size:10PX;" >Rata - Rata</td>
<td  colspan="6" rowspan="" width="3%"  align="center" style="background-color:#ffffff; font-size:10PX;" >Autoclave No. </td>
<td colspan="4" rowspan=""  width="3%"  align="center" style="background-color:#ffffff; font-size:10PX;" >Posh Curring No.</td>
</tr>



<tr>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctsatu'].'</td>
<td  colspan="" rowspan="2"  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctdua'].'</td>
<td  colspan="" rowspan="2"  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mcttiga'].'</td>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctempat'].'</td>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctlima'].'</td>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctenam'].'</td>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mcttujuh'].'</td>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctdelapan'].'</td>
<td colspan="" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctsembilan'].'</td>
<td  colspan="" rowspan="2"  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctsepuluh'].'</td>
<td  colspan="3" rowspan="2"  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mcttotal'].'</td>
<td colspan="3" rowspan="2"   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['mctrata'].'</td>

<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autosatu.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autodua.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autotiga.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autoempat.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autolima.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autoenam.'" /></td>
<td  colspan="" rowspan="2" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/poscuring/'.$possatu.'" /></td>
<td colspan="" rowspan="2"  width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/poscuring/'.$posdua.'" /></td> 
<td  colspan="" rowspan="2" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/poscuring/'.$postiga.'" /></td>
<td colspan="" rowspan="2"  width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ></td> 
</tr>

<tr>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autotujuh.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autodelapan.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autosembilan.'" /> </td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autosepuluh.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autosebelas.'" /></td>
<td  colspan="" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" ><img width="18" height="13" src="assets/images/autoclave/'.$autoduabelas.'" /></td>
</tr>

<tr>
<td  colspan="16" rowspan="2" align="left" style="background-color:#ffffff; font-size:10PX;" >Notes :&nbsp;'.$trial_data['pmnotes'].'
<br>
<br><br>
</td>
<td  colspan="2" rowspan="1"  align="center" style="background-color:#ffffff; font-size:9PX;" >Temperature (c)</td>
<td  colspan="2" rowspan="1"  align="center" style="background-color:#ffffff; font-size:10PX;" >Pressure (kgf/cm2)</td>
<td  colspan="2" rowspan="1"  align="center" style="background-color:#ffffff; font-size:10PX;" >Time  &nbsp; (Minutes)</td>
<td  colspan="2" rowspan="1" align="center" style="background-color:#ffffff; font-size:9PX;" >Temperature (c)</td>
<td  colspan="2" rowspan="1"  align="center" style="background-color:#ffffff; font-size:10PX;" >Time   &nbsp;(Minutes)</td>
</tr>

<tr>
<td  colspan="2" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['autotemp'].'</td>
<td  colspan="2" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['autopress'].'</td>
<td  colspan="2" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['autotime'].'</td>
<td  colspan="2" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['postemp'].' </td>
<td  colspan="2" rowspan="" width="4%"  align="center" style="background-color:#ffffff; font-size:10PX;" >'.$trial_data['postime'].' </td>


</tr>
 
</table> ';

$output .= ' 

   
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    
<tr>
       
<td colspan="26" align="center" width="0%"align="left" style="font-size:10PX; background-color:#ffed00;">QUALITY CONTROL</th>


</tr>


 <tr>
    <td colspan="13" align="center"  style="font-size:10PX ;  background-color:#87ceeb;"> CHECK MANDRELL</td>      
    <td colspan="13" align="center"  style="font-size:10PX ;  background-color:#87ceeb;"> CHECK PRODUK JADI</td>        
</tr>


<tr>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >NO</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Item Check</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Standard</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >1</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >2</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >3</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >4</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >5</td>

<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >NO</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Item Check</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Standard</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >1</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >2</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >3</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >4</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >5</td>


</tr>';

$no =0;
foreach ($mandrel_data as $k => $v) {

    $no++;

$output .= '

<tr>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$no.'</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cmic'].'</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cms'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cmsatu'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cmdua'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cmtiga'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cmempat'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cmlima'].'</td>

<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$no.'</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cpic'].'</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cps'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cpsatu'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cpdua'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cptiga'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cpempat'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$v['cplima'].'</td>

</tr> ';

}

$output .= '


<tr>
<td colspan="13" align="center"  style="font-size:10PX ;  background-color:#87ceeb;"> CHECK MATERIAL</td>      
<td colspan="13" align="center"  style="font-size:10PX ;  background-color:#87ceeb;"> PERFORMANCE PRODUK</td>        
</tr>


<tr>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >NO</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Item Check</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Standard</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >1</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >2</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >3</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >4</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >5</td>

<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >NO</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Item Check</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >Standard</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >1</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >2</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >3</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >4</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >5</td>


</tr> ';

$no =0;
foreach ($material_data as $a => $b) {

    $no++;

$output .= '



<tr>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$no.'</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmatic'].'</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmats'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmatsatu'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmatdua'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmattiga'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmatempat'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['cmatlima'].'</td>

<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$no.'</td>
<td  colspan="4" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['ppic'].'</td>
<td  colspan="3" rowspan=""  width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['pps'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['ppsatu'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['ppdua'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['pptiga'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['ppempat'].'</td>
<td colspan="" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" >'.$b['pplima'].'</td>

</tr> ';

}

$output .= '


<tr>
<td colspan="13" rowspan=""   class="note"   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;Material Additional :

</td>
<td colspan="13" rowspan=""   class="note"   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;Temuan Masalah :

</td>

</tr>
<tr>
<td colspan="13" rowspan="" class="atas"   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp; '.$trial_data['matadd'].' 

</td>
<td colspan="13" rowspan=""  class="atas"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;'.$trial_data['temuanmasalah'].' 

</td>

</tr>






<tr>
<td colspan="13" rowspan=""  class="note"    width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;Notes :</td>
<td colspan="13" rowspan=""   class="note"   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;Penyebab :</td>

</tr>
<tr>
<td colspan="13" rowspan="" class="atas"   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;'.$trial_data['trialnotes'].' 

</td>
<td colspan="13" rowspan=""  class="atas"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;'.$trial_data['penyebab'].' 
</td>
</tr>



<tr>
<td colspan="13" rowspan=""  class="abc"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;Drawing Sketch :<br><br></td>
<td colspan="13" rowspan=""   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;Tindakan : <br>&nbsp;'.$trial_data['tindakan'].'<br></td>

</tr>



<tr>
<td colspan="13" rowspan=""  class="abc"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp;'.$trial_data['trialdw'].' </td>
<td colspan="7" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:12PX;" ><b>TRIAL RESULT</td>
<td colspan="6" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:12PX;" ><img width="180" height="30" src="assets/images/'.$trialresult.'" /></td>

</tr>

<tr>
<td colspan="13" rowspan="" class="abc"   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" >&nbsp; </td>
<td colspan="13" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" ><b>PT SHIMADA KARYA INDONESIA</td>

</tr>

<tr>
<td colspan="13" rowspan="" class="abc"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" ></td>
<td colspan="5" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" ><b>APPROVED</td>
<td colspan="4" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" ><b>CHECKED</td>
<td colspan="4" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:10PX;" ><b>PREPARED</td>
</tr>

<tr>
<td colspan="13" rowspan="" class="abc"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" ></td>
<td colspan="5" rowspan=""   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" ><br><br>
<br><br>
</td>
<td colspan="4" rowspan=""   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" ><br><br>
<br><br>
</td>
<td colspan="4" rowspan=""   width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" ><br><br>
<br>
<br>
</td>

</tr>

<tr>
<td colspan="13" rowspan="" class="bawah"  width="4%" align="left" style="background-color:#ffffff; font-size:10PX;" ></td>
<td colspan="5" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:12PX;" >'.$approved.'</td>
<td colspan="4" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:12PX;" >'.$checked.'</td>
<td colspan="4" rowspan=""   width="4%" align="center" style="background-color:#ffffff; font-size:12PX;" >'.$prepared.'</td>

</tr>

 
</table> ';

            $material_data = $this->model_trial->getTrialCheckMaterial($id);
            $mandrel_data = $this->model_trial->getTrialCheckMandrel($id);
			$trial_data = $this->model_trial->getTrialData($id);
			$dompdf ->loadHtml($output);
			$dompdf ->setPaper(array(0,0, 612.00, 1008.0), 'portrait'); //ukuran F4
			$dompdf ->render();
			$dompdf ->stream('datapel.php',array("Attachment" => false));
		}
	












        public function printjoken($id)
        {
            $dompdf = new Dompdf();
            if(!in_array('viewTrial', $this->permission)) {
                redirect('dashboard', 'refresh');
            }
     

            if($id) {
              $trial_data = $this->model_trial->getTrialData($id);
               $mandrel_data = $this->model_trial->getTrialCheckMandrel($id);
               $material_data = $this->model_trial->getTrialCheckMaterial($id);
                  
                //$ssb_date = date('d/m/Y', $ssb_data['tgl']);
            //	$paid_status = ($ssb_data['paid_status'] == 1) ? "Paid" : "Unpaid";
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
               
    
           <table width="100%" border="0" cellpadding="0" cellspacing="0">
               <tr>
               <td  align="left" style="font-size:12px;"><b>&nbsp;PT SHIMADA KARYA INDONESIA</td> 
                 <td colspan="2" rowspan="2" align="left" style="font-size:24px; width=10%"><b>&nbsp;JOKEN</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="2" rowspan="2" align="center" style="font-size:24px; width=10%"><b>&nbsp;</td>
                 <td colspan="" rowspan=" " align="right"  style="font-size:8px; width=8%">&nbsp;&nbsp;FR PROD 01 01</td>
                 <td colspan="" rowspan=" " align="right"  style="font-size:8px; width=18%">&nbsp;&nbsp;</td>
               </tr>


                <tr> 
                <td  align="left" style="font-size:12px;"><b>&nbsp;</td> 
                    <td  align="right" colspan="" rowspan=" " align="left" style="font-size:8px; width=10%">&nbsp;Ed/Rev : 01 / 07 </td>
                    <td  align="right" colspan="" rowspan=" " align="left" style="font-size:18px; width=10%">&nbsp;</td>

               </tr>  
         </table>	  	  	   
               
       
    <table class="section1" width="100%" border="1" cellpadding="0" cellspacing="0">
          ';
           
           $output .= '
           <tr>
          
           <td colspan="10" align="left" width="0%" style="font-size:14PX;  background-color:#C0C0C0;"><b>&nbsp;A. PRODUKSI EXTRUDER<b></td>      
           <td class="warna" colspan="" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
           <td  class="warna" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
           <td  class="warna" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
          
          
           
           <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
           <td  colspan="4" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;DIPERIKSA</td>
           <td  colspan="10" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;DIBUAT / OPERATOR</td>
          
            </tr>

        <tr>
          
           <td class="warna" colspan="3" align="left" width="0%" style="font-size:12PX;  background-color:#ffffff;">&nbsp;MESIN EXTRUDER </td>      
           <td class="warna" colspan="9" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;"><br> : 
             &nbsp;<img width="18" height="15" src="assets/images/1pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/2pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/3pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/4pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/5pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/6pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/7pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/8pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/9pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/10pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/11pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/12pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/13pn.jpg" />
           &nbsp;<img width="20" height="15" src="assets/images/14pn.jpg" />      <br><br></td>
           <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
           <td class="warna"  align="CENTER"  style="font-size:10PX;   width="0%" background-color:#ffffff;">&nbsp;</td>
           <td class=""  colspan="4" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>
           <td  colspan="3" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>
           <td  colspan="3" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>
           <td  colspan="4" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>

        </tr>

        <tr>
          
            <td class="" colspan="12" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;MATERIAL </td>      
           
            <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
            <td class="warna"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
            
        </tr>
        <tr>
          
        <td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;COMPOUND  </td>      
        <td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['cmlayersatu'].' <b></td>
       
         <td  colspan="3"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['cmlayerdua'].' <b></td>
         <td class="warna" align="CENTER" width="1%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
         <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
         <td class="warna"  colspan="14" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
        </tr>
        <tr>
          
        <td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;NO LOT  </td>      
        <td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"> &nbsp;<b> <b></td>
       
         <td  colspan="3"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;&nbsp;<b><b></td>
         <td class="warna"  align="CENTER" width="1%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
         <td colspan="9" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;PRODUKSI EXTRUDER</td>
         <td colspan="6" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;PENGAMBILAN WIP</td>
         
        

        </tr>

        <tr>
         <td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;EXPIRED MATERIAL </td>      
         <td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"> &nbsp;<b> <b></td>
         <td  colspan="3"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"> &nbsp;<b> <b></td>
         <td class="warna" colspan="" align="CENTER" width="1%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
         <td  colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Tanggal</td>
           <td colspan="6" align="CENTER"  style="font-size:10PX;   width="1%" background-color:#ffffff;">&nbsp;Jam</td>
           <td colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Tanggal</td>
           <td colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Jam</td>
        </tr>

        <tr>        
         <td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;THREAD / SPRING  </td>      
         <td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"> &nbsp;<b> <b></td>      
         <td  colspan="3"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"> &nbsp;<b> <b></td>
         <td class="warna"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
         <td colspan="3"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp; Start</td>
         <td colspan="3"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Finish </td>
           
        </tr>

        <tr>        
            <td class="warna" colspan="12" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>      
            <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td> 
            
            <td colspan="3" rowspan="2" align="CENTER" width="1%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
            <td  colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
            <td colspan="3" rowspan="2" align="CENTER" width="1%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
            <td  colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
            <td  colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>

        </tr>';

      
            $output .='
        <tr>        
            <td colspan="12" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; BRAIDING</td>      
            <td class="warna" colspan="" align="CENTER" width="1%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>   
            
          
        </tr>

        <tr>        
        <td colspan="5" rowspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; TYPE</td>  
      
        <td colspan="2" rowspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; PARAMETER </td>   
       
        <td colspan="5" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; NO . MESIN</td>  
        
        <td class="warna" colspan="16"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
      
       
    </tr>
    <tr>        
       
       
       
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 1</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 2</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 3</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 4</td>      
        <td  colspan=""  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;5</td>
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
       
        <td  colspan="4" rowspan=2 align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;JENIS LEM</td>
        <td  colspan="3"  align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Std</td>
        <td  colspan="6"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['gluecomp'].'</td>
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
    </tr>
    



    <tr>        
        <td colspan="5" rowspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; HORIZONTAL</td>  
      
        <td colspan="" rowspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; RPM BRAIDING </td>   
        <td colspan="" align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; STD</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmbsatu'].' </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmbdua'].' </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmbtiga'].' </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmbempat'].'</td>      
        <td class="" colspan=""  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmblima'].'</td>
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
      
        <td  colspan="3"  align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;Act</td>
        <td  colspan="6"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td class="warna" colspan=""  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td class="warna" colspan=""  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
    </tr>
    <tr>        
       
       
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; ACT</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>      
        <td  colspan=""  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td class="warna" colspan="15"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
    </tr>

        <tr>        
        <td colspan="5" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; JUMLAH BOBIN MESIN NO.</td>      
        <td colspan="" ROWSPAN="2" align="CENTER" width="10%" style="font-size:8PX;  background-color:#ffffff;">&nbsp; RPM CONVEYOR</td>   
        <td colspan="" align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; STD</td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmcsatu'].' </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmcdua'].' </td>  
        <td colspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmctiga'].' </td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmcempat'].' </td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['rpmclima'].' </td>   
        
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td  colspan="3" rowspan="4" align="left" width="0%" style="font-size:9PX;  background-color:#ffed00;">&nbsp; WARNING !</td>
        <td  colspan="12"  align="left" width="0%" style="font-size:8PX;  background-color:#ffed00;">&nbsp;1. Thickness hose mentah harus sesuai standard</td>
       
    </tr>


    <tr>        
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 1</td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 2</td>   
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 3</td>   
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 4</td>   
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; 5</td>   
        <td colspan="" align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; ACT</td>   
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
        <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>      
        <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
        <td  colspan="12" rowspan="3" align="left"  width="0%" style="font-size:8PX;    background-color:#ffed00;">&nbsp;2. Ukur produk hose mentah minimal 2 kali per lot (awal - tengah -akhir)</td>
       
    </tr>
   


    <tr>        
    <td colspan="" rowspan="2" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['conessatu'].' </td>  
    <td colspan=""  rowspan="2" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['conesdua'].'</td>   
    <td colspan="" rowspan="2" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['conestiga'].'</td>   
    <td colspan="" rowspan="2" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['conesempat'].'</td>   
    <td colspan="" rowspan="2" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['coneslima'].' </td>   
    <td colspan="" rowspan="2" align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; GEAR </td>   
    <td colspan="" align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; STD</td>  
    <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['gearsatu'].'</td>  
    <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['geardua'].'</td>  
    <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['geartiga'].'</td>  
    <td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['gearempat'].'</td>      
    <td  colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['gearlima'].'</td>
    <td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
    
</tr>';

$output .='     
  
<tr>        
  
<td colspan="" align="CENTER" width="5%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; ACT</td>  
<td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>  
<td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
<td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>  
<td colspan="" align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>      
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan=""  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
         

</tr>';





$output .='        
<tr>
<td class="warna" colspan="28"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>


</tr>

<tr>
           
<th colspan="8" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PART NUMBER</th>
<th colspan="4" ROWSPAN="2"align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PRODUCT TYPE</th>
<th colspan="4" ROWSPAN="2"align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">SAFETY PART</th>
<th colspan="6" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">DISERAHKAN </th>
<th colspan="6" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">DITERIMA</th>

</tr>

<tr>
<td colspan="3" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;QTY.(PCS)</td>
<td colspan="3" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;PARAF</td>
<td colspan="3" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;QTY.(PCS)</td>
<td colspan="3" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;PARAF</td>

</tr>

<tr>
<td colspan="8" ROWSPAN="3" width="5%" align="CENTER" style="font-size:14PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['partno'].' <b></td>
<td colspan="4" ROWSPAN="3" width="5%" align="CENTER" style="font-size:14PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['type'].' <b></td>
<td colspan="4" ROWSPAN="3" width="5%" align="CENTER" style="font-size:12PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['safetypart'].' <b></td>
<td colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; <br><br></td>
<td colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>


</tr>
<tr>

</tr>
<tr>
<td colspan="6" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; Bagian Extruder </td>
<td colspan="6" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; Bagian Prod. Manual </td>

</tr>

<tr>

<th colspan=4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">SPESIFIKASI</th>
<th colspan=4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">DIES</th>

<th colspan="2" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">Mesh</th>
<th colspan="2" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">ID (mm)</th>
<th colspan="3" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">OD (mm)</th>
<th colspan="5" align="left" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">&nbsp;Thickness (mm)&nbsp;&nbsp;&nbsp;&nbsp; <img width="15" height="10" src="assets/images/s.jpg" /></th>
<th colspan="4" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">lenght (mm)</th>
<th colspan="4" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffFFFF;">Weight (mm)</th>

</tr>
<tr>

<th colspan=4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:9PX; background-color:#ffFFFF;">STANDARD</th>
<th colspan=4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:9PX; background-color:#ffFFFF;">&nbsp;<b>'.$trial_data['sdsingle'].' ,<b> &nbsp;<b>'.$trial_data['sddouble'].' <b> </th>

<th colspan="2" ROWSPAN=""align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;">&nbsp;<b>'.$trial_data['mesh'].' <b> </th>
<th colspan="2" ROWSPAN=""align="left" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;">&nbsp; <img width="15" height="10" src="assets/images/s.jpg" />&nbsp; &nbsp;<b>'.$trial_data['dimid'].' <b> </th>
<th colspan="3" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;">&nbsp;<b>'.$trial_data['dimod'].' <b> </th>
<th colspan="5" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;">&nbsp;<b>'.$trial_data['dimthickness'].' <b> </th>
<th colspan="4" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;">&nbsp;<b>'.$trial_data['dimlenght'].' <b> </th>
<th colspan="4" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;">&nbsp;<b>'.$trial_data['wiptotal'].' <b> </th>

</tr>
<tr>

<th colspan=4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:9PX; background-color:#ffFFFF;">ACTUAL</th>
<th colspan=4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:9PX; background-color:#ffFFFF;"></th>

<th colspan="2" ROWSPAN=""align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;"></th>
<th colspan="2" ROWSPAN=""align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;"></th>
<th colspan="3" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;"></th>
<th colspan="5" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;"></th>
<th colspan="4" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;"></th>
<th colspan="4" align="center" width="5%" align="left" style="font-size:8PX; background-color:#ffFFFF;"></th>

</tr>
<tr>
<td class="warna" colspan="28"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>


</tr>';
 
 $output .= '
</table> 

<table border="1" cellpadding="0" width="100%"  cellspacing="0">


 <tr>
          
 <td colspan="13" align="CENTER" width="0%" style="font-size:14PX;  background-color:#C0C0C0;"><b>&nbsp;B. PRODUKSI MANUAL / WAYA<b></td>      

 <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
 <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
 <td  class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
 <td  class="" colspan="3" align="CENTER"  style="font-size:9PX;   width="8%" background-color:#ffffff;">&nbsp;THICKNESS (mm)</td>

 <td  class="warna" colspan="" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp; </td>
 <td  colspan="4" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;DIPERIKSA </td>

 <td  colspan="4" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;DIBUAT</td>

  </tr>

<tr>

 <td colspan="15" align="CENTER" width="0%" style="font-size:11PX;  background-color:#ffffff;">&nbsp;WIP  </td>      
 

 <td class="warna"  align="CENTER"  style="font-size:10PX;   width="0%" background-color:#ffffff;">&nbsp;</td>
 <td  colspan="3" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;&nbsp;'.$trial_data['thickness'].' </td>
 <td  class="warna" colspan="" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>
 <td  colspan="4" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>
 <td  colspan="4" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;</td>

</tr>

<tr>

  <td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;QTY. WIP HM (pcs) </td>      
  <td colspan="9" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
  <td class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>


  
</tr>
<tr>

<td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;COMPOUND  </td>      
<td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; <b>'.$trial_data['cmlayersatu'].'<b></td>

<td  colspan="6"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['cmlayerdua'].'<b></td>

<td class="warna"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan="12" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
</tr>
<tr>

<td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;NO LOT  </td>      
<td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td  colspan="6"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="12" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;PRODUKSI MANUAL</td>




</tr>

<tr>
<td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;EXPIRED WIP </td>      
<td colspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td  colspan="6"  align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan="" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

 <td colspan="3" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Tanggal</td>
 <td colspan="5" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Jam</td>
 <td colspan="4" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Storange Time (jam)</td>
</tr>

<tr>        
<td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;THREAD / SPRING  </td>      
<td colspan="9" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b> '.$trial_data['csfabrictype'].'<b>&nbsp;&nbsp;</td>      
<td class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>

<td colspan="3"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp; Start</td>
<td colspan="2"  align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;Finish </td>
 
</tr>

<tr>        
  <td colspan="6" align="left" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;WEIGHT / PCS (gram) </td>     
         
 <td colspan="9" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['wiptotal'].' <b> </td>      
 
  <td class="warna" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td> 


  <td  colspan="3" rowspan="" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
  <td colspan="3" rowspan="" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
  <td  colspan="2" rowspan="" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>
  <td  colspan="4" rowspan="2" align="CENTER"  style="font-size:10PX;   width="2%" background-color:#ffffff;">&nbsp;</td>

</tr>
<tr>        
  <td class="warna" colspan="15" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>     
  <td class="warna" colspan="" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>    
  <td colspan="3" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>   
  <td colspan="3" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>   
  <td colspan="2" align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>   
</tr>
<tr>        
  <td colspan="28" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffed00;">&nbsp; WARNING !   UNTUK PART TIPE NAKABI, WAKTU PENYIMPANAN WIP HOSE MENTAH MINIMAL 12 JAM</td>      
   

</tr>


<tr>
 
<th colspan="8" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PART NUMBER</th>
<th colspan="8" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PRODUCT TYPE</th>
<th colspan="3" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">SAFETY PART</th>
<th colspan="2" ROWSPAN="2"  align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">QTY. WIP (PCS) </th>
<th colspan="7" align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">TOTAL PRODUKSI (PCS)</th>

</tr>

<tr>

<td colspan="3" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;OK</td>
<td colspan="4" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;NG HOSE MENTAH</td>

</tr>

<tr>
<td colspan="8" ROWSPAN="3" width="5%"  align="CENTER" style="font-size:14PX;  background-color:#ffffff;"><br>&nbsp;<b>'.$trial_data['partno'].'<b><br><br></td>
<td colspan="8" ROWSPAN="3" width="5%"  align="CENTER" style="font-size:14PX;  background-color:#ffffff;"><br>&nbsp; <b>'.$trial_data['type'].' <b><br><br></td>
<td colspan="3" ROWSPAN="3" width="5%"  align="CENTER" style="font-size:12PX;  background-color:#ffffff;"><br>&nbsp;<b> '.$trial_data['safetypart'].'<b> <br><br></td>
<td colspan="2" ROWSPAN="3" width="5%"  align="CENTER" style="font-size:12PX;  background-color:#ffffff;"><br>&nbsp; <br><br></td>
<td colspan="3" ROWSPAN="3" width="5%"  align="CENTER" style="font-size:12PX;  background-color:#ffffff;"><br>&nbsp; <br><br></td>
<td colspan="4" ROWSPAN="3" width="5%"  align="CENTER" style="font-size:12PX;  background-color:#ffffff;"><br>&nbsp; - <br><br> </td>


</tr>

<tr>

</tr>
<tr>

</tr>


<tr>
<td colspan="28" ROWSPAN="" width="5%"  align="CENTER" style="font-size:12PX;  background-color:#ffffff;">&nbsp; </td>
</tr>
<tr>        
<td class="test2" colspan="2" rowspan="8" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<BR><img width="60" height="130" src="assets/images/OVEN1.jpg" /></td>  

<td colspan="3" rowspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; AUTOCLAVE </td>   
<td colspan="4" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; MANDREL</td>  

<td colspan="19" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; QUANTITY (PCS)</td>  



</tr>
<tr> 
    
<td colspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; QTY</td>  
<td colspan="2" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; CAV</td>  



<td colspan="4" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; TGL. PRODUKSI</td>  


<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>


</tr>

</tr>



<tr>   
<td colspan="3" rowspan="3" align="CENTER" width="0%" style="font-size:20PX;  background-color:#ffffff;">&nbsp;<B> YES <B></td>           
<td colspan="2" rowspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['mqty'].' </td>  
<td colspan="2" rowspan="3" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; '.$trial_data['cavity'].'</td>  



<td colspan="4" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; OK</td>  


<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>

</tr>
<tr>   



<td colspan="4" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; NG HM</td>  


<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>


<tr>   



<td colspan="4" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; SISA STOK WIP</td>  


<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>

<tr>
<td  colspan="26"  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>

</tr>
<tr>   
<td colspan="4" rowspan="" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"><B>&nbsp; POSH CURRING <B></td>           

<td colspan="7" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; TGL. POSH CURRING</td>  





<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>


</tr>
<tr>   
<td colspan="4" rowspan="" align="CENTER" width="0%" style="font-size:20PX;  background-color:#F08080;"><BR>&nbsp; NO </td>           

<td colspan="7" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp; QUANTITY (PCS)</td>  





<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td  colspan=""  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>

<tr>
 
<th colspan="28" ROWSPAN="" align="left" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;<i>Notes :</i></th>

</tr>

<tr>
<td class="warna" colspan="28"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>


</tr>
<tr>
 
<th colspan="13" ROWSPAN="" align="left" width="5%" align="left" style="font-size:14PX;  background-color:#C0C0C0;">&nbsp;C. CUTTING</th>
<th class="warna2"  colspan="15" ROWSPAN="" align="left" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;</th>

</tr>

<tr>
 
<td colspan="6" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">WIP CUTTING</td>
<td colspan="5" ROWSPAN="" align="LEFT" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;COMPOUND</td>
<td colspan="4" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;'.$trial_data['cmlayersatu'].'</td>
<td colspan="4" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;'.$trial_data['cmlayerdua'].'</td>
<td class="warna" colspan="2"  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">DIPERIKSA </td>
<td colspan="4" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">DIBUAT</td>

</tr>


<tr>
 

<tD colspan="5" ROWSPAN="" align="LEFT" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;NO. LOT</td>
<tD colspan="4" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></tD>
<tD colspan="4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></tD>
<td class="warna"  colspan="2"  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<tD colspan="3" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></tD>
<tD colspan="4" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></tD>

</tr>






<tr>
 
<td colspan="19" ROWSPAN="" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">-</td>

</tr>
<tr>
 
<th colspan="8" ROWSPAN="" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PART NUMBER</th>
<th colspan="8" ROWSPAN=""align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PRODUCT TYPE</th>
<th colspan="3" ROWSPAN=""align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">SAFETY PART</th>
<th class="warna" colspan="9" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></th>

</tr>



<tr>
<td colspan="8" ROWSPAN="3" width="5%" align="CENTER" style="font-size:14PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['partno'].'<b></td>
<td colspan="8" ROWSPAN="3" width="5%" align="CENTER" style="font-size:14PX;  background-color:#ffffff;">&nbsp;<b> '.$trial_data['type'].'<b></td>
<td colspan="3" ROWSPAN="3" width="5%" align="CENTER" style="font-size:12PX;  background-color:#ffffff;">&nbsp;<b>'.$trial_data['safetypart'].'<b></td>
<td class="warna"  colspan="2" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; QTY WIP </td>
<td colspan="4" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; TOTAL CUTTING </td>


</tr>
<tr>

<td class="warna"  colspan="2" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="4" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>


</tr>

<tr>

<td class="warna"  colspan="2" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>


</tr>



<tr>
<td class="warna3"  colspan="28" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>





</tr>
<tr>
<td colspan="12" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;INCOMING WIP HOSE</td>
<td colspan="2" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td colspan="14" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; CUTTING PROCESS</td>


</tr>

<tr>
<td colspan="4" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;TGL </td>

<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td colspan="4" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;TGL  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>




</tr>


<tr>
<td colspan="4" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;QTY (PCS) </td>

<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td colspan="4" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;QTY (PCS)  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>




</tr>

<tr>
<td class="warna" colspan="28"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>


</tr>
<tr>
 
<th colspan="13" ROWSPAN="" align="left" width="5%" align="left" style="font-size:14PX;  background-color:#C0C0C0;">&nbsp;D. QUALITY CONTROL</th>

<td class="warna2" colspan="8"  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3"  align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">DIPERIKSA </td>
<td colspan="4"  align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">DIBUAT</td>
</tr>


<tr>
 
<td colspan="6" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">FINISH GOOD</td>
<td colspan="5" ROWSPAN="" align="LEFT" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;COMPOUND</td>
<td colspan="4" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;'.$trial_data['cmlayersatu'].'</td>
<td colspan="4" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;'.$trial_data['cmlayerdua'].'</td>
<td class="warna" colspan="2"  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></td>
<td colspan="4" ROWSPAN="2" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></td>

</tr>


<tr>
 

<tD colspan="5" ROWSPAN="" align="LEFT" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">&nbsp;NO. LOT</td>
<tD colspan="4" ROWSPAN=""align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></tD>
<tD colspan="4" ROWSPAN="" align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;"></tD>
<td class="warna"  colspan="2"  align="CENTER" width="4%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

</tr>






<tr>
 
<td CLASS="warna3" colspan="28" ROWSPAN="" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">-</td>

</tr>
<tr>
 
<th colspan="8" ROWSPAN="" align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PART NUMBER</th>
<th colspan="8" ROWSPAN=""align="center" width="5%" align="left" style="font-size:14PX; background-color:#ffffff;">PRODUCT TYPE</th>
<th colspan="3" ROWSPAN=""align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">SAFETY PART</th>
<th class="warna" colspan="" ROWSPAN=""align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;"></th>
<th colspan="3" ROWSPAN="2"align="center" width="5%" align="left" style="font-size:10PX; background-color:#ffffff;">QTY WIP (PCS)</th>

<th colspan="5" ROWSPAN=""align="center" width="5%" align="left" style="font-size:12PX; background-color:#ffffff;">FINISH GOODS</th>

</tr>



<tr>
<td colspan="8" ROWSPAN="3" width="5%" align="CENTER" style="font-size:14PX;  background-color:#ffffff;">&nbsp;<B>'.$trial_data['partno'].'<B></td>
<td colspan="8" ROWSPAN="3" width="5%" align="CENTER" style="font-size:14PX;  background-color:#ffffff;">&nbsp;<B>'.$trial_data['type'].'<B></td>
<td colspan="3" ROWSPAN="3" width="5%" align="CENTER" style="font-size:12PX;  background-color:#ffffff;">&nbsp; <B>'.$trial_data['safetypart'].'<B></td>
<td class="warna"  colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; OK </td>
<td colspan="2" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; NG </td>


</tr>
<tr>
<td class="warna"  colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td  colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>

<td colspan="3" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="2" ROWSPAN="2" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>


</tr>

<tr>

<td class="warna"  colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>


</tr>






<tr>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>

<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna"  colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>




</tr>
<tr>
<td colspan="19" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;QUANTITY (PCS)</td>
<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td class="warna2" colspan="8" ROWSPAN="" width="5%" align="LEFT" style="font-size:10PX;  background-color:#ffffff;">&nbsp; REMAKS :</td>


</tr>

<tr>
<td colspan="6" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;TGL.PERIKSA </td>

<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td class="atas" colspan="8" ROWSPAN="3" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>




</tr>


<tr>
<td colspan="6" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;OK </td>

<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>



</tr>
<tr>
<td colspan="6" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;NG </td>

<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;</td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>
<td colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp; </td>

<td class="warna" colspan="" ROWSPAN="" width="5%" align="CENTER" style="font-size:10PX;  background-color:#ffffff;">&nbsp;  </td>

</tr>
<TR>
<td class="notedasar" colspan="28" ROWSPAN="" width="5%" align="left" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<I>Note : Untuk part double layer (waya), no.lot yang dicantumkan pada checksheet delivery adalah no.lot compound hose dasar (layer 1) </I></td>
</TR>
</table>  ';
    }
    
    $output .= '
    
     ';
                  $material_data = $this->model_trial->getTrialCheckMaterial($id);
                $mandrel_data = $this->model_trial->getTrialCheckMandrel($id);
                $trial_data = $this->model_trial->getTrialData($id);
                $dompdf ->loadHtml($output);
               // $dompdf ->setPaper(array(0,0, 612.00, 1008.0), 'portrait'); //ukuran F4
              // $dompdf-> setPaper(array(0,0,609.4488,935.433), 'portrait');
                $dompdf ->setPaper( array(0, 0, 792.00, 1224.00),'portrait');
                $dompdf ->render();
                $dompdf ->stream('datapel.php',array("Attachment" => false));
            }
        
 

	}
