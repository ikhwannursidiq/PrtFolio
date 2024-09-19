<?php 

class Model_joken extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getJokenData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM trial where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM trial ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveJokenData()
	{
		$sql = "SELECT * FROM trial WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getTrialCheckMandrel($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM cekmandrel WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

  public function getJokenItemData($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM cekmandrel WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

  public function getTrialItemDataDua($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM cekmaterial WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

	public function getJokenCheckProdukjadi($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM cekprodukjadi WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

	public function getJokenCheckMaterial($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM cekmaterial WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

	public function getJokenCheckPerformance($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM cekperformance WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

  public function getBra($trial_id = null){
    if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM braiding WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}

  public function getJokenBra($trial_id = null)
	{
		if(!$trial_id) {
			return false;
		}

		$sql = "SELECT * FROM braiding WHERE trial_id = ?";
		$query = $this->db->query($sql, array($trial_id));
		return $query->result_array();
	}


	public function create()
	{
		$user_id = $this->session->userdata('id');
	//	$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		
            'date_created'  => $this->input->post('date_created'),
            'trialno'  => $this->input->post('trialno'),
             //start eng   
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
            //finish engginering
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
  'ectsatu' => $this->input->post('ectsatu'),
  'ectdua' => $this->input->post('ectdua'),
  'ecttiga' => $this->input->post('ecttiga'),
  'ectempat' => $this->input->post('ectempat'),
  'ectlima' => $this->input->post('ectlima'),
  'ectenam' => $this->input->post('ectenam'),
  'ectsatux' => $this->input->post('ectsatux'),
  'ectduax' => $this->input->post('ectduax'),
  'ecttigax' => $this->input->post('ecttigax'),
  'ectempatx' => $this->input->post('ectempatx'),
  'ectlimax' => $this->input->post('ectlimax'),
  'ectenamx' => $this->input->post('ectenamx'),
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

'bmsatu' => $this->input->post('bmsatu'),
'bmdua' => $this->input->post('bmdua'),
'bmtiga' => $this->input->post('bmtiga'),
'bmempat' => $this->input->post('bmempat'),
'bmlima' => $this->input->post('bmlima'),
'bmenam' => $this->input->post('bmenam'),






'approved' => $this->input->post('approved'),
'checked' => $this->input->post('checked'),
'prepared' => $this->input->post('prepared'),
'trialresult' => $this->input->post('trialresult'),
'matadd' => $this->input->post('matadd'),
'trialnotes' => $this->input->post('trialnotes'),
'trialdw' => $this->input->post('trialdw'),
'temuanmasalah' => $this->input->post('temuanmasalah'),
'penyebab' => $this->input->post('penyebab'),
'tindakan' => $this->input->post('tindakan'),

'possatu' => $this->input->post('possatu'),
'posdua' => $this->input->post('posdua'),
'postiga' => $this->input->post('postiga'),

'autosatu' => $this->input->post('autosatu'),
  'autodua' => $this->input->post('autodua'),
  'autotiga' => $this->input->post('autotiga'),
  'autoempat' => $this->input->post('autoempat'),
  'autolima' => $this->input->post('autolima'),
  'autoenam' => $this->input->post('autoenam'),
  'autotujuh' => $this->input->post('autotujuh'),
  'autodelapan' => $this->input->post('autodelapan'),
  'autosembilan' => $this->input->post('autosembilan'),
  'autosepuluh' => $this->input->post('autosepuluh'),
  'autosebelas' => $this->input->post('autosebelas'),
 'autoduabelas' => $this->input->post('autoduabelas'),
 'mesinsatu' => $this->input->post('mesinsatu'),
 'conessatu' => $this->input->post('conessatu'),
 'gearsatu' => $this->input->post('gearsatu'),
 'rpmbsatu' => $this->input->post('rpmbsatu'),
 'rpmcsatu' => $this->input->post('rpmcsatu'),

 'mesinsatu' => $this->input->post('mesinsatu'),
 'conessatu' => $this->input->post('conessatu'),
 'gearsatu' => $this->input->post('gearsatu'),
 'rpmbsatu' => $this->input->post('rpmbsatu'),
 'rpmcsatu' => $this->input->post('rpmcsatu'),

 'mesindua' => $this->input->post('mesindua'),
 'conesdua' => $this->input->post('conesdua'),
 'geardua' => $this->input->post('geardua'),
 'rpmbdua' => $this->input->post('rpmbdua'),
 'rpmcdua' => $this->input->post('rpmcdua'),


 'mesintiga' => $this->input->post('mesintiga'),
 'conestiga' => $this->input->post('conestiga'),
 'geartiga' => $this->input->post('geartiga'),
 'rpmbtiga' => $this->input->post('rpmbtiga'),
 'rpmctiga' => $this->input->post('rpmctiga'),


 'mesinempat' => $this->input->post('mesinempat'),
 'conesempat' => $this->input->post('conesempat'),
 'gearempat' => $this->input->post('gearempat'),
 'rpmbempat' => $this->input->post('rpmbempat'),
 'rpmcempat' => $this->input->post('rpmcempat'),

 'mesinlima' => $this->input->post('mesinlima'),
 'coneslima' => $this->input->post('coneslima'),
 'gearlima' => $this->input->post('gearlima'),
 'rpmblima' => $this->input->post('rpmblima'),
 'rpmclima' => $this->input->post('rpmclima'),
 'ppc' => $this->input->post('ppc'),
 'pa' => $this->input->post('pa'),
'user_id' => $user_id

    	);

		$insert = $this->db->insert('trial', $data);
		$trial_id = $this->db->insert_id();
		$count_cman = count($this->input->post('cmic'));
    	for($x = 0; $x < $count_cman; $x++) {
    		$cman = array(
    			'trial_id' => $trial_id,
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

	
		$count_cmat = count($this->input->post('cmatic'));
    	for($x = 0; $x < $count_cmat; $x++) {
    		$cmat = array(
    			'trial_id' => $trial_id,
				'cmatic' => $this->input->post('cmatic')[$x],
    			'cmats' => $this->input->post('cmats')[$x],
    			'cmatsatu' => $this->input->post('cmatsatu')[$x],
    			'cmatdua' => $this->input->post('cmatdua')[$x],
    			'cmattiga' => $this->input->post('cmattiga')[$x],
				'cmatempat' => $this->input->post('cmatempat')[$x],
				'cmatlima' => $this->input->post('cmatlima')[$x],
				'ppic' => $this->input->post('ppic')[$x],
    			'pps' => $this->input->post('pps')[$x],
    			'ppsatu' => $this->input->post('ppsatu')[$x],
    			'ppdua' => $this->input->post('ppdua')[$x],
    			'pptiga' => $this->input->post('pptiga')[$x],
				'ppempat' => $this->input->post('ppempat')[$x],
				'pplima' => $this->input->post('pplima')[$x],	
			);

    		$this->db->insert('cekmaterial', $cmat);
    	}

	

		return ($trial_id) ? $trial_id : false;
	}

	public function updateoldd($data, $id)
	{
		if($data && $id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
			
			'date_created'  => $this->input->post('date_created'),
            'trialno'  => $this->input->post('trialno'),
 
             //start eng   
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
            //finish engginering
          
  //awal extrussion   
  'ectsatux' => $this->input->post('ectsatux'),
  'ectduax' => $this->input->post('ectduax'),
  'ecttigax' => $this->input->post('ecttigax'),
  'ectempatx' => $this->input->post('ectempatx'),
  'ectlimax' => $this->input->post('ectlimax'),
  'ectenamx' => $this->input->post('ectenamx'),
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
 // 'brmc'=>$this->input->post('brmc'),
 // 'exmcsatu'=>$this->input->post('exmcsatu'),
 // 'exmcdua'=>$this->input->post('exmcdua'),
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
  'extgear' => $this->input->post('extgear'),
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
//'pmposcuring' => $this->input->post('pmposcuring'),
//'pmautoclave'=> $this->input->post('pmautoclave'),
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

'bmsatu' => $this->input->post('bmsatu'),
'bmdua' => $this->input->post('bmdua'),
'bmtiga' => $this->input->post('bmtiga'),
'bmempat' => $this->input->post('bmempat'),
'bmlima' => $this->input->post('bmlima'),
'bmenam' => $this->input->post('bmenam'),
'approved' => $this->input->post('approved'),
'checked' => $this->input->post('checked'),
'prepared' => $this->input->post('prepared'),
'trialresult' => $this->input->post('trialresult'),
'matadd' => $this->input->post('matadd'),
'trialnotes' => $this->input->post('trialnotes'),
'trialdw' => $this->input->post('trialdw'),
'temuanmasalah' => $this->input->post('temuanmasalah'),
'penyebab' => $this->input->post('penyebab'),
'tindakan' => $this->input->post('tindakan'),
'possatu' => $this->input->post('possatu'),
'posdua' => $this->input->post('posdua'),
'postiga' => $this->input->post('postiga'),
'autosatu' => $this->input->post('autosatu'),
  'autodua' => $this->input->post('autodua'),
  'autotiga' => $this->input->post('autotiga'),
  'autoempat' => $this->input->post('autoempat'),
  'autolima' => $this->input->post('autolima'),
  'autoenam' => $this->input->post('autoenam'),
  'autotujuh' => $this->input->post('autotujuh'),
  'autodelapan' => $this->input->post('autodelapan'),
  'autosembilan' => $this->input->post('autosembilan'),
  'autosepuluh' => $this->input->post('autosepuluh'),
  'autosebelas' => $this->input->post('autosebelas'),
 'autoduabelas' => $this->input->post('autoduabelas'),

'user_id' => $user_id



	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('trial', $data);

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
	
			return true;
		}
	}


  public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
        'date_created'  => $this->input->post('date_created'),
        'trialno'  => $this->input->post('trialno'),

         //start eng   
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
'extgear' => $this->input->post('extgear'),
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
'bmsatu' => $this->input->post('bmsatu'),
'bmdua' => $this->input->post('bmdua'),
'bmtiga' => $this->input->post('bmtiga'),
'bmempat' => $this->input->post('bmempat'),
'bmlima' => $this->input->post('bmlima'),
'bmenam' => $this->input->post('bmenam'),
'approved' => $this->input->post('approved'),
'checked' => $this->input->post('checked'),
'prepared' => $this->input->post('prepared'),
'trialresult' => $this->input->post('trialresult'),
'matadd' => $this->input->post('matadd'),
'trialnotes' => $this->input->post('trialnotes'),
'trialdw' => $this->input->post('trialdw'),
'temuanmasalah' => $this->input->post('temuanmasalah'),
'penyebab' => $this->input->post('penyebab'),
'tindakan' => $this->input->post('tindakan'),
'possatu' => $this->input->post('possatu'),
'posdua' => $this->input->post('posdua'),
'postiga' => $this->input->post('postiga'),
'autosatu' => $this->input->post('autosatu'),
'autodua' => $this->input->post('autodua'),
'autotiga' => $this->input->post('autotiga'),
'autoempat' => $this->input->post('autoempat'),
'autolima' => $this->input->post('autolima'),
'autoenam' => $this->input->post('autoenam'),
'autotujuh' => $this->input->post('autotujuh'),
'autodelapan' => $this->input->post('autodelapan'),
'autosembilan' => $this->input->post('autosembilan'),
'autosepuluh' => $this->input->post('autosepuluh'),
'autosebelas' => $this->input->post('autosebelas'),
'autoduabelas' => $this->input->post('autoduabelas'),
'mesinsatu' => $this->input->post('mesinsatu'),
'conessatu' => $this->input->post('conessatu'),
'gearsatu' => $this->input->post('gearsatu'),
'rpmbsatu' => $this->input->post('rpmbsatu'),
'rpmcsatu' => $this->input->post('rpmcsatu'),
'mesinsatu' => $this->input->post('mesinsatu'),
'conessatu' => $this->input->post('conessatu'),
'gearsatu' => $this->input->post('gearsatu'),
'rpmbsatu' => $this->input->post('rpmbsatu'),
'rpmcsatu' => $this->input->post('rpmcsatu'),
'mesindua' => $this->input->post('mesindua'),
'conesdua' => $this->input->post('conesdua'),
'geardua' => $this->input->post('geardua'),
'rpmbdua' => $this->input->post('rpmbdua'),
'rpmcdua' => $this->input->post('rpmcdua'),
'mesintiga' => $this->input->post('mesintiga'),
'conestiga' => $this->input->post('conestiga'),
'geartiga' => $this->input->post('geartiga'),
'rpmbtiga' => $this->input->post('rpmbtiga'),
'rpmctiga' => $this->input->post('rpmctiga'),
'mesinempat' => $this->input->post('mesinempat'),
'conesempat' => $this->input->post('conesempat'),
'gearempat' => $this->input->post('gearempat'),
'rpmbempat' => $this->input->post('rpmbempat'),
'rpmcempat' => $this->input->post('rpmcempat'),
'mesinlima' => $this->input->post('mesinlima'),
'coneslima' => $this->input->post('coneslima'),
'gearlima' => $this->input->post('gearlima'),
'rpmblima' => $this->input->post('rpmblima'),
'rpmclima' => $this->input->post('rpmclima'),
'ppc' => $this->input->post('ppc'),
'pa' => $this->input->post('pa'),
'ectsatux' => $this->input->post('ectsatux'),
'ectduax' => $this->input->post('ectduax'),
'ecttigax' => $this->input->post('ecttigax'),
'ectempatx' => $this->input->post('ectempatx'),
'ectlimax' => $this->input->post('ectlimax'),
'ectenamx' => $this->input->post('ectenamx'),

'user_id' => $user_id
	    	
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('trial', $data);


			// now remove the order item data 
			$this->db->where('trial_id', $id);
			$this->db->delete('cekmandrel');

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


      $this->db->where('trial_id', $id);
			$this->db->delete('cekmaterial');
    
      $count_cmat = count($this->input->post('cmatic'));
    	for($x = 0; $x < $count_cmat; $x++) {
    		$cmat = array(
    			'trial_id' => $id,
				'cmatic' => $this->input->post('cmatic')[$x],
    			'cmats' => $this->input->post('cmats')[$x],
    			'cmatsatu' => $this->input->post('cmatsatu')[$x],
    			'cmatdua' => $this->input->post('cmatdua')[$x],
    			'cmattiga' => $this->input->post('cmattiga')[$x],
				'cmatempat' => $this->input->post('cmatempat')[$x],
				'cmatlima' => $this->input->post('cmatlima')[$x],
				'ppic' => $this->input->post('ppic')[$x],
    			'pps' => $this->input->post('pps')[$x],
    			'ppsatu' => $this->input->post('ppsatu')[$x],
    			'ppdua' => $this->input->post('ppdua')[$x],
    			'pptiga' => $this->input->post('pptiga')[$x],
				'ppempat' => $this->input->post('ppempat')[$x],
				'pplima' => $this->input->post('pplima')[$x],	
			);

    		$this->db->insert('cekmaterial', $cmat);
    	}

      return true;
	    }

		
		}
	
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('trial');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalTrial()
	{
		$sql = "SELECT * FROM trial";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}