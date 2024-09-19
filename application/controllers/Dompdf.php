
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Dompdf extends CI_Controller {
  
    public function index()
    {
        $dompdf = new Dompdf\Dompdf();
 
        $html = $this->load->view('welcome_message',[],true);
 
        $dompdf->loadHtml($html);
 
        $dompdf->setPaper('A4', 'portrait');
 
        $dompdf->render();
 
        $pdf = $dompdf->output();
 
        $dompdf->stream($html, array("Attachment" => false));





       
    }
  
}