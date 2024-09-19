<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Mypdf extends CI_Controller {
  
    public function index()
    {
        $mpdf = new \mpdf\mpdf();
        $html = $this->load->view('html_convert_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        //$mpdf->Output('test.pdf','D'); // it downloads the file into the user system.
    }
  
}