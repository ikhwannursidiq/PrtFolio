<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporanfpdf extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
    }
	function index()
	{
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'DAFTAR PEGAWAI AYONGODING.COM',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(90,6,'Nama Pegawai',1,0,'C');
        $pdf->Cell(120,6,'Alamat',1,0,'C');
        $pdf->Cell(40,6,'Telp',1,1,'C');
        $pdf->SetFont('Arial','',10);
        $product = $this->db->get('product')->result();
        $no=0;
        foreach ($product as $data){
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(90,6,$data->name,1,0);
            $pdf->Cell(120,6,$data->sku,1,0);
            $pdf->Cell(40,6,$data->id,1,1);
        }
        $pdf->Output();
	}
}