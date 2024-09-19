<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');
class Welcome extends CI_Controller {
	function GeneratePdf(){
		$this->load->view('welcome_message');
		$html = $this->output->get_output();
        		// Load pdf library
		$this->load->library('pdf');
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->render();
		// Output the generated PDF (1 = download and 0 = preview)
		$this->pdf->stream("html_contents.pdf", array("Attachment"=> 0));		
	}
}