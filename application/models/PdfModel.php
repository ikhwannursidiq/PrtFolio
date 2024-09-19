
<?php
class PdfModel extends CI_Model
{
	function showRecord()
	{
		parent::__construct();

		$this->data['page_title'] = 'Orders';
		$this->load->model('model_pocompound');
		$this->load->model('model_products');
		$this->load->model('model_company');



	}
	function show_single_details($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('products');
		$output = '<table width="100%" cellspacing="5" cellpadding="5">';
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>
				<td width="25%"><img src="'.base_url().'images/'.$row->images.'" /></td>
				<td width="75%">
					<p><b>Name : </b>'.$row->name.'</p>
					<p><b>Address : </b>'.$row->sku.'</p>
					<p><b>City : </b>'.$row->price.'</p>
					<p><b>City : </b>'.$row->qty.'</p>
					<p><b>City : </b>'.$row->description.'</p>
					<p><b>City : </b>'.$row->description.'</p><p>
					<b>City : </b>'.$row->description.'</p>


				</td>
			</tr>
			';
		}
		$output .= '</table>';
		return $output;
	}
}
?>