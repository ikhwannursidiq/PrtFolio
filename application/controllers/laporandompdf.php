<?php
db->get('pegawai')->result();{
	    $this->load->library('pdf');
	    $this->pdf->setPaper('A4', 'landscape');
	    $this->pdf->filename = "Laporan-Dompdf-Codeigniter.pdf";
	    $this->pdf->load_view('pdf_view', $data);

}
