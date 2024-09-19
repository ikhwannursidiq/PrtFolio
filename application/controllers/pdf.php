<?php
class pdf extends CI_Controller {
   
 public function index()
 {
     $mpdf = new \Mpdf\Mpdf();
     $html = $this->load->view('invoice.php',[],true);
     $mpdf->WriteHTML($html);
     $mpdf->Output(); // opens in browser
     //$mpdf->Output('invoice.pdf','Dt will work as normal download
 }

}