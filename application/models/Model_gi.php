<?php 

class Model_gi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getGiData($id = null)
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

	public function getActiveGiData()
	{
		$sql = "SELECT * FROM trial WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function createold($data)
	{
		if($data) {
			$insert = $this->db->insert('trial', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function getHistorypartData($gi_id = null)
	{
		if(!$gi_id) {
			return false;
		}

		$sql = "SELECT * FROM historypart WHERE gi_id = ?";
		$query = $this->db->query($sql, array($gi_id));
		return $query->result_array();
	}
	public function create()
	{
		$user_id = $this->session->userdata('id');
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
		
    		);

		$insert = $this->db->insert('trial', $data);
		$gi_id = $this->db->insert_id();

		$count_revisi = count($this->input->post('revisi'));
    	for($x = 0; $x < $count_revisi; $x++) {
    		$items = array(
    			'gi_id' => $gi_id,
    			'revisi' => $this->input->post('revisi')[$x],
				'des' => $this->input->post('des')[$x],
    			'date' => $this->input->post('date')[$x],
				'pic' => $this->input->post('pic')[$x],
    		
    		);

    		$this->db->insert('historypart', $items);
    	}

		return ($gi_id) ? $gi_id : false;
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

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
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('trial', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			

			// now remove the order item data 
			$this->db->where('gi_id', $id);
			$this->db->delete('historypart');

			// now decrease the product qty
			$count_revisi = count($this->input->post('revisi'));
    		for($x = 0; $x < $count_revisi; $x++) {
    		$items = array(
    			'gi_id' => $id,
    			'revisi' => $this->input->post('revisi')[$x],
				'des' => $this->input->post('des')[$x],
    			'date' => $this->input->post('date')[$x],
				'pic' => $this->input->post('pic')[$x],
    		
    		);
	    		$this->db->insert('historypart', $items);		
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

	public function countTotalGi()
	{
		$sql = "SELECT * FROM trial";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}