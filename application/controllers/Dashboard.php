<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		$this->load->model('m_grafik');
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_stores');
		$this->load->model('model_qcreports');
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_stores'] = $this->model_stores->countTotalStores();
		$this->data['data']=$this->m_grafik->get_data_stok();
		$this->data['datang']=$this->m_grafik->get_data_stokng();
		$user_id = $this->session->userdata('id');
	//	$is_admin = ($user_id == 1) ? true :false;

		$is_admin = ($user_id > 0) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}


	public function fetchJoinData()
	{
		$result = array('data' => array());

		$data = $this->model_qcreports->getJoinItemWipSpi();
		$no = 1;
		foreach ($data as $key => $value) {
          //  $operator_data = $this->model_operators->getOperatorsData($value['operator_id']);
			// button
          //  $buttons = '';
          //  if(in_array('updateItem', $this->permission)) {
    	//		$buttons .= '<a href="'.base_url('items/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
        //    }

          //  if(in_array('deleteItem', $this->permission)) { 
    	//		$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
          //  }
			

		//	$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

        //    $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

         //   $qty_status = '';
          //  if($value['qty'] <= 10) {
         //       $qty_status = '<span class="label label-warning">Low !</span>';
         //   } else if($value['qty'] <= 0) {
        //        $qty_status = '<span class="label label-danger">Out of stock !</span>';
        //    }


			$result['data'][$key] = array(
				$no++,
				$value['name'],
				$value['stokin'],
                $value['qtywip'],
				$value['qtyspi'],
            
				
			//	$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	







}