<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfController extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PdfModel');
		$this->load->library('pdf');
	}

	public function index()
	{
		$data['customer_id'] = $this->PdfModel->showRecord();
		$this->load->view('htmltopdf', $data);
	}

	public function details()
	{
		if($this->uri->segment(3))
		{
			$id = $this->uri->segment(3);
			$data['customer_details'] = $this->PdfModel->show_single_details($id);
			$this->load->view('htmltopdf', $data);
		}
	}
	
	public function pdfdetails()
	{
		if($this->uri->segment(3))
		{
			$id = $this->uri->segment(3);
			$html_content = '<h3 align="center">Generatedddddd PDF using Dompdf</h3>';
			$html_content .= $this->PdfModel->show_single_details($id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("".$id.".pdf", array("Attachment"=>0));
		}
	}

}
?>