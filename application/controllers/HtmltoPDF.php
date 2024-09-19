<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HtmltoPDF extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('htmltopdf_model');
  $this->load->library('pdf');
 }

 public function index()
 {
  $data['customer_data'] = $this->htmltopdf_model->fetch();
  $this->load->view('htmltopdf', $data);
 }

 public function details()
 {
  if($this->uri->segment(3))
  {
   $id = $this->uri->segment(3);
   $data['customer_details'] = $this->htmltopdf_model->fetch_single_details($id);
   $this->load->view('htmltopdf', $data);
  }
 }

 public function pdfdetails()
 {
  if($this->uri->segment(3))
  {
   $id = $this->uri->segment(3);
   $html_content = '<h3 align="center">Convert hhhhHTML to PDF in CodeIgniter using Dompdf</h3>';
   $html_content .= $this->htmltopdf_model->fetch_single_details($id);
   $this->pdf->loadHtml($html_content);
   $this->pdf->render();
   $this->pdf->stream("".$id.".pdf", array("Attachment"=>0));
  }
 }

}

?>

