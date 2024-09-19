<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Data Summary QC';

		$this->load->model('model_inputs');
		$this->load->model('model_exports');
		$this->load->model('model_daterange');
	

	}

public function index()

{

    $data['tahun']= $this->model_daterange->gettahun();
    $this->render_template('summary/index', $this-> data);

}


public function before()

{

    $data['tahun']= $this->model_daterange->gettahun();
    $this->render_template('summary/before', $this-> data);

}


  public function fetch()
    {
		//return $this->db->get('inputs')->result(); // Tampilkan semua data transaksi
		$query = "SELECT * FROM inputs";
        if ($sql = $this->db->query($query)){
		
			if ($sql->num_rows() > 0){
			foreach ($sql->result_array() as $row){
				$query[] = $row;
			}
		}
		return $query;
      //  return $data;
    }
}
       


   	

	public function yearmonth()
	  {
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
	   $rows = $this->model_daterange->yearmonth($start_date, $end_date);
       } else {
       $rows = $this->model_daterange->yearmonth($start_date, $end_date);
        }
       echo json_encode($rows);
       }
	   
	     
	public function bfyearmonth()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
	   $rows = $this->model_daterange->bfyearmonth($start_date, $end_date);
       } else {
       $rows = $this->model_daterange->bfyearmonth($start_date, $end_date);
        }
       echo json_encode($rows);
  }	 





	}