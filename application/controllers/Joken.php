<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Joken extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Joken';

        $this->load->model('model_trial');
		$this->load->model('model_gi');
		$this->load->model('model_joken');

	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewJoken', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('Joken/index', $this->data);	
	}

    /*
    * It Fetches the ssbs data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchJokenData()
	{
		$result = array('data' => array());

		$data = $this->model_joken->getJokenData();

		foreach ($data as $key => $value) {

           // $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
            
            if(in_array('viewJoken', $this->permission)) {
    			$buttons .= '<a href="'.base_url('joken/printjoken/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }

           
            if(in_array('updateJoken', $this->permission)) {
    			$buttons .= '<a href="'.base_url('joken/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

           
            if(in_array('deleteJoken', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
           
            $status = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-success">Data joken</span>';

	
            $result['data'][$key] = array(
                $value['trialno'],
                $value['date_created'],
				$value['partno'],
				$value['partname'],
                $value['type'],
                $value['cmlayersatu'],
                $value['cmlayerdua'],
                $status,
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
		if(!in_array('createJoken', $this->permission)) {
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
 
        	);


        	$create = $this->model_joken->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('joken/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('joken/create', 'refresh');
        	}
        }
            $this->render_template('joken/create', $this->data);
      
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
	
	public function updatesss($trial_id)
	{      
        if(!in_array('updateJoken', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$trial_id) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('partno', 'partno', 'trim|required');
        $this->form_validation->set_rules('partname', 'partname', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');	
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	//$upload_image = $this->upload_image();

        	$data = array(
                'partno' => $this->input->post('partno'),
                'partname' => $this->input->post('partname'),
                'type' => $this->input->post('type'),
                'dimid' => $this->input->post('dimid'),
                'dimod' => $this->input->post('dimod'),
                'dimthickness' => $this->input->post('dimthickness'),
                'dimlenght' => $this->input->post('dimlenght'),
                'webasichose' => $this->input->post('webasichose'),
                'wecover' => $this->input->post('wecover'),
                'wetotal' => $this->input->post('wetotal'),
                'wemr' => $this->input->post('wemr'),
                'mqty' => $this->input->post('mqty'),
                'glueing' => $this->input->post('glueing'),
                'gluecomp' => $this->input->post('gluecomp'),
                'wiringsize' => $this->input->post('wiringsize'),
                'wrappingply' => $this->input->post('wrappingply'),
                'siliconeply' => $this->input->post('siliconeply'),
                'safetypart' => $this->input->post('safetypart'),
                'wsfabric' => $this->input->post('wsfabric'),
                'mfabric' => $this->input->post('mfabric'),
                'cavity' => $this->input->post('cavity'),
                'cmlayersatu' => $this->input->post('cmlayersatu'),
                'cmlayerdua'  => $this->input->post('cmlayerdua'),
                'csfabrictype' => $this->input->post('csfabrictype'),
                'nw' => $this->input->post('nw'),
                'wrapping' => $this->input->post('wrapping'),
//finish proses eng

 //awal extrussion   
 'emccsatu'=> $this->input->post('emccsatu'),
 'emccdua' => $this->input->post('emccdua'),
 'emlotsatu' => $this->input->post('emlotsatu'),
 'emlotdua'=> $this->input->post('emlotdua'),
    
 'emcontinous'=> $this->input->post('emcontinous'),
 'embasichose'=> $this->input->post('embasichose'),
 'emsinglelayer' => $this->input->post('emsinglelayer'),
 'emlyrsatu' => $this->input->post('emlyrsatu'),
 'emlyrdua'=> $this->input->post('emlyrdua'),
 'edimtotal' => $this->input->post('edimtotal'),
 'edimid'=> $this->input->post('edimid'),
 'edimod' => $this->input->post('edimod'),
 'edimlenght' => $this->input->post('edimlenght'),

 'mesh' => $this->input->post('mesh'),     
 'sdsingle' => $this->input->post('sdsingle'),
 'sddouble' => $this->input->post('sddouble'),
 'tscrewsatu' => $this->input->post('tscrewsatu'),
 'tscrewdua' => $this->input->post('tscrewdua'),
 'rpmextsatu' => $this->input->post('rpmextsatu'),
 'rpmextdua' => $this->input->post('rpmextdua'),
 'rpmconveyor' => $this->input->post('rpmconveyor'),
 'wipbh' => $this->input->post('wipbh'),
 'wipcover' => $this->input->post('wipcover'),
 'wipthread'=> $this->input->post('wipthread'),
 'wiptotal'=> $this->input->post('wiptotal'),

 'brtype' =>$this->input->post('brtype'),
 'brmc'=>$this->input->post('brmc'),
 //'exmcsatu'=>$this->input->post('exmcsatu'),
 //'exmcdua'=>$this->input->post('exmcdua'),
 'ectsatu' => $this->input->post('ectsatu'),
 'ectdua' => $this->input->post('ectdua'),
 'ecttiga' => $this->input->post('ecttiga'),
 'ectempat' => $this->input->post('ectempat'),
 'ectlima' => $this->input->post('ectlima'),
 'ectenam' => $this->input->post('ectenam'),
 'ecttotal'=> $this->input->post('ecttotal'),
 'ectrata' => $this->input->post('ectrata'),
 'ectnotes' => $this->input->post('ectnotes'),
 'extmat' => $this->input->post('extmat'),
 'exttt' => $this->input->post('exttt'),
 'extcones' => $this->input->post('extcones'),
 'rpmsetconv'=> $this->input->post('rmpsetconv'),
 'rpmsetbra' => $this->input->post('rpmsetbra'),
 'rpmsetconv' => $this->input->post('rpmsetconv'),

 'msatu' => $this->input->post('msatu'),
 'mdua' => $this->input->post('mdua'),
 'mtiga' => $this->input->post('mtiga'),
 'mempat' => $this->input->post('mempat'),
 'mlima' => $this->input->post('mlima'),
 'menam' => $this->input->post('menam'),
 'mtujuh' => $this->input->post('mtujuh'),
 'mdelapan' => $this->input->post('mdelapan'),
 'msembilan' => $this->input->post('msembilan'),
 'msepuluh' => $this->input->post('msepuluh'),
 'msebelas' => $this->input->post('msebelas'),
 'mduabelas' => $this->input->post('mduabelas'),
 'mtigabelas' => $this->input->post('mtigabelas'),
 'mempatbelas' => $this->input->post('mempatbelas'),
 


// awal input produksi manual waya
'pmnotes' => $this->input->post('pmnotes'),
'beratwip' => $this->input->post('beratwip'),
'beratwabari' => $this->input->post('beratwabari'),
'pmwlot' => $this->input->post('pmwlot'),
'pmwcode' => $this->input->post('pmwcode'),
'pmpw' => $this->input->post('pmpw'),
'postime'=> $this->input->post('postime'),
'postemp' => $this->input->post('postemp'),
'autotime' => $this->input->post('autotime'),
'autopress' => $this->input->post('autopress'),
'autotemp' => $this->input->post('autotemp'),
'pmposcuring' => $this->input->post('pmposcuring'),
'pmautoclave'=> $this->input->post('pmautoclave'),
'mctsatu'=> $this->input->post('mctsatu'),
'mctdua' => $this->input->post('mctdua'),
'mcttiga' => $this->input->post('mcttiga'),
'mctempat'=> $this->input->post('mctempat'),
'mctlima'=> $this->input->post('mctlima'),
'mctenam' => $this->input->post('mctenam'),
'mcttujuh' => $this->input->post('mcttujuh'),
'mctdelapan'=> $this->input->post('mctdelapan'),
'mctsembilan'=> $this->input->post('mctsembilan'),
'mctsepuluh' => $this->input->post('mctsepuluh'),
'mcttotal' => $this->input->post('mcttotal'),
'mctrata'=> $this->input->post('mctrata'),
//finish production waya        
            );
			
		$count_cman = count($this->input->post('cmic'));
    	for($x = 0; $x < $count_cman; $x++) {
    		$cman = array(
    			'trial_id' => $id,
				'cmic' => $this->input->post('cmic')[$x],
    			'cms' => $this->input->post('cms')[$x],
    			'cmsatu' => $this->input->post('cmsatu')[$x],
    			'cmdua' => $this->input->post('cmdua')[$x],
    			'cmtiga' => $this->input->post('cmtiga')[$x],
				'cmempat' => $this->input->post('cmempat')[$x],
				'cmlima' => $this->input->post('cmlima')[$x],
				'cpic' => $this->input->post('cpic')[$x],
    			'cps' => $this->input->post('cps')[$x],
    			'cpsatu' => $this->input->post('cpsatu')[$x],
    			'cpdua' => $this->input->post('cpdua')[$x],
    			'cptiga' => $this->input->post('cptiga')[$x],
				'cpempat' => $this->input->post('cpempat')[$x],
				'cplima' => $this->input->post('cplima')[$x],

    		);

    		$this->db->insert('cekmandrel', $cman);
		
			}	
	
            $update = $this->model_trial->update($data, $trial_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('joken/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('joken/update/'.$gi_id, 'refresh');
            }
        }
        else {
          
            // false case
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

            $this->render_template('joken/edit', $this->data); 
        }   
	}

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
        		redirect('joken');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('joken/update/'.$id, 'refresh');
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
          
            $this->render_template('joken/edit', $this->data);
        }
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
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
      
       <td class="warna" colspan="4" align="left" width="0%" style="font-size:11PX;  background-color:#ffffff;">&nbsp;MESIN EXTRUDER : </td>      
       <td class="warna" colspan="8" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;"><br>
           &nbsp;<img width="18" height="13" src="assets/images/1pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/2pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/3pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/4pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/5pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/6pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/7pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/8pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/9pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/10pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/11pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/12pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/13pn.jpg" />
           &nbsp;<img width="18" height="13" src="assets/images/14pn.jpg" />
           <br><br></td>
          
      
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
     <td colspan="6" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b> '.$trial_data['csfabrictype'].'<b>&nbsp; '.$trial_data['exttt'].'&nbsp;</td>      
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
    <td  colspan="6"  align="CENTER" width="2%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;'.$trial_data['gluecomp'].' </td>
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
<td  colspan="3" ROWSPAN="2" align="CENTER"  style="font-size:10PX;   width="8%" background-color:#ffffff;">&nbsp;<b>'.$trial_data['thickness'].' <b></td>
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
<td colspan="9" align="CENTER" width="0%" style="font-size:10PX;  background-color:#ffffff;">&nbsp;<b> '.$trial_data['csfabrictype'].'<b>&nbsp; '.$trial_data['exttt'].'&nbsp;</td>      
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
