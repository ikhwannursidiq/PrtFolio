<?php

defined('BASEPATH') OR exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	

class Filter extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'FILTER';	
		$this->load->model('model_filter');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewFilter', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

       // will create and save the file in the root of the project
      
        $this->data['tahun'] = $this->model_filter->gettahun();


		$this->render_template('filter/laporan_input', $this->data);	



	}

   public function filter(){
       $tanggalawal = $this->input->post('tanggalawal');
       $tanggalakhir = $this->input->post('tanggalakhir');
       $bulanawal = $this->input->post('bulanawal');
       $bulanakhir = $this->input->post('bulanakhir');
       $tahun1 = $this->input->post('tahun1');
       $tahun2 = $this->input->post('tahun2');
       $nilaifilter = $this->input->post('nilaifilter');


    //   if ($nilaifilter = 1){
           $this->data['title'] = "laporan penjualan $tanggalawal s/d $tanggalakhir ";
           $this->data['subtitle'] = "laporan penjualan ".$tanggalawal.'s/d'.$tanggalakhir;
           $this->data['datafilter'] = $this->model_filter->filterbytanggal($tanggalawal, $tanggalakhir);
        // $this->data['datafilter'] = $this->db->query("SELECT * FROM inputs WHERE date_time BETWEEN '$tanggalawal' and '$tanggalakhir' order by date_time asc")->result();
         

     

         $this->render_template('filter/laporan_input', $this->data);	
       }


public function excel()
		{
		//	if(isset($_GET['tanggalawal']) && ! empty($_GET['tanggalakhir'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
		//		$tanggalawal = $_GET('tanggalawal');
		//		$tanggalakhir = $_GET('tanggalakhir');
			$datafilter = $this->model_filter->filterbytanggal($tanggalawal, $tanggalakhir);
	//	}
			$spreadsheet = new Spreadsheet();
	
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'No')
				->setCellValue('B1', 'Tanggal')
				->setCellValue('C1', 'Jam')
				->setCellValue('D1', 'Shift')
				->setCellValue('E1', 'Nama Karyawan')
				->setCellValue('F1', 'Part no')
				->setCellValue('G1', 'Nolot')
				->setCellValue('H1', 'OK')
				->setCellValue('I1', 'NG')
				->setCellValue('J1', 'Total')
				->setCellValue('K1', 'Goresan')
				->setCellValue('L1', 'Tidak Nempel')
				->setCellValue('M1', 'Kebentur')
				->setCellValue('N1', 'Saringan jebol')
				->setCellValue('O1', 'Gelembung')
				->setCellValue('P1', 'Bintik')
				->setCellValue('Q1', 'Luka dalam')
				->setCellValue('R1', 'Luka luar')
				->setCellValue('S1', 'Retak')
				->setCellValue('T1', 'Bergaris')
				->setCellValue('U1', 'Hose Pendek')
				->setCellValue('V1', 'Over')
				->setCellValue('W1', 'Wrappingan')
				->setCellValue('X1', 'Braidingan')
				->setCellValue('Y1', 'Bolong')
				->setCellValue('Z1', 'Tipis')
				->setCellValue('AA1', 'Karet Nempel')
				->setCellValue('AB1', 'Tebal')
				->setCellValue('AC1', 'Porisiti')
				->setCellValue('AD1', 'Bekas Tangan')
				->setCellValue('AE1', 'Sobek')
				->setCellValue('AF1', 'Oval')
				->setCellValue('AG1', 'Benang Rusak')
				->setCellValue('AH1', 'Siwak')
				->setCellValue('AI1', 'Keropos')
				->setCellValue('AJ1', 'Hole Tube')
				->setCellValue('AK1', 'Spring Pendek')
				->setCellValue('AL1', 'Seret')
				->setCellValue('AM1', 'Sempit')
				->setCellValue('AN1', 'Diameter Kecil')
				->setCellValue('AO1', 'Others');	
			$column = 2;
	
			foreach ($datafilter as $sisdata) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $sisdata['ok'])
					->setCellValue('B' . $column, $sisdata['ng'])
					->setCellValue('C' . $column, $sisdata['total']);
	
				$column++;
			}
	
			$writer = new Xlsx($spreadsheet);
		
			$filename =  'Data-QC-';
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}
}