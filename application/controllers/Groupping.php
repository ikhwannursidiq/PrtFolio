<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Groupping extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Inputs';

		$this->load->model('model_inputs');
		$this->load->model('model_exports');
		$this->load->model('model_daterange');
        $this->load->model('model_groupping');
	

	}

public function indexold()

{

    $data['tahun']= $this->model_daterange->gettahun();
    $this->render_template('groupping/index', $this-> data);

}

public function index()
	{
		if(!in_array('viewGroupping', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_groupping->getInputData();

		$this->data['results'] = $result;


//menampilkan data Items
	//	$this->data['items'] = $this->model_items->getActiveItemData();      	

		$this->render_template('groupping/index', $this->data);
	}


    public function fetch()
    {
		//return $this->db->get('inputs')->result(); // Tampilkan semua data transaksi
		$query = "SELECT * FROM inputs";
        if ($sql = $this->db->query($query)){
		
			if ($sql->num_rows() > 0){
			foreach ($sql->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
      //  return $data;
    }
	}
       


    public function records()
	{
		if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
        
          //  $rows = $this->model_exports->date_range($start_date, $end_date);
         // $rows = $this->model_exports->fetch();
            $rows = $this->model_groupping->date_rangedua($start_date, $end_date);
        } else {
         //   $rows = $this->model_exports->fetch();
          $rows = $this->model_groupping->date_rangedua($start_date, $end_date);
        }
        echo json_encode($rows);
		
	}	

}