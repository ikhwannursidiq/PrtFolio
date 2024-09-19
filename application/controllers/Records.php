<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class Records extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'records';

		$this->load->model('model_records');
	}



    public function index()

	{
		if(!in_array('viewRecord', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
	
        $data = $this->model_records->view_all();
        $data = $this->model_records->hitungData();
      

        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->model_records->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $url_cetak = 'records/cetak';
            $label = 'Semua Data Transaksi';
        }else{ // Jika terisi
            $transaksi = $this->model_records->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $url_cetak = 'records/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }

        $this->data['transaksi'] = $transaksi;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['label'] = $label;

       // $data = $this->model_records->group_nama();
        $this->data['group_nama'] = $this->model_records->group_nama();
          
		$this->render_template('records/index', $this->data);
    }

	public function cetak(){

        $dompdf = new Dompdf();
	
		$tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
           $transaksi = $this->model_records->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Data Transaksi';
        }else{ // Jika terisi
            $transaksi = $this->model_records->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
           $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
           $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }

        //$data['label'] = $label;
        //$data['transaksi'] = $transaksi;

        $output = '
          
        <table width="100%" border="0.5" cellpadding="4" cellspacing="0">
        <thead>
        <tr>
        <th width ="4%" align="left" style="font-size:12px">No.</th>
        <th width="40%"align="center" style="font-size:12px">Description</th>
        <th width="10%"align="center" style="font-size:12px">Qty</th>
        <th width="8%" align="center" style="font-size:12px">Unit</th>
        <th colspan ="2" width="20%" align="center" style="font-size:12px">Unit Price</th>
        <th width="20%" align="center" style="font-size:12px">Amount</th>
        <th width="20%" align="center"style="font-size:12px">Note</th> 
        </tr>
         </thead>';
         $no =0;
         foreach ($label as $k => $v) {
         $no++;
       
            $output .= '
            <tr>
            <td align="left" style="font-size:11px">'.$no.'</td>
          <td class="empty" width="30%"align="left" style="font-size:11px"><span align="center" style="color:black;font-weight:bold">'.$product_data['description'].' </span></td>  
          <td width="10%" align="center" style="font-size:11px">'.$v['nama'].'</td> 
          <td width="10%" align="center" style="font-size:11px">'.$v['nama'].'</td>
            <td width="15%"align="center" style="font-size:11px">'.$v['nama'].'</td>
            <td width="7%"align="left" style="font-size:11px">/KG</td>  
            <td align="center" style="font-size:11px">'.$v['nama'].'</td>   
            <td align="center" style="font-size:11px">'.$v['nama'].'</td>
     
            </tr>';
         }
        $output .= '
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
        
         <tr >
            <td align="left" colspan="3" style="font-size:12px"><b>Delivery Date :</b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td width="15%" align="left" style="font-size:12px"><b>SUB TOTAL</b></td>
            <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
            <td width="12%" align="right" style="font-size:12px"><b></b></td>
          
         
         </tr>
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px"><b>Tgl.</b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b>PPN (10 %)</b></td>
            <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
            <td width="12%" align="right" style="font-size:12px"><u><b></b></u></td>
            </tr>
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b>TOTAL</b></td>
            <td width="3%"align="right" style="font-size:12px"><b>Rp.</b></td>
            <td width="12%"align="right" style="font-size:12px"><b></b></td>
            </tr>
            <tr>
            <td align="left" colspan="3" style="font-size:12px"></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="12%"align="right" style="font-size:12px"><b></b></td>
            </tr> 
         
     
     
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr >
            
            <td align="right" style="font-size:12px"> </td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td  align="left" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
         </tr>
          
         </table> ';
         $output .= '
         
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
        
         <tr >
            <td align="left" colspan="3" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td width="15%" align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%" align="right" style="font-size:12px"><b></b></td>
          
         
         </tr>
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px"><b>Payment term :</b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%" align="right" style="font-size:12px"></td>
            </tr>
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px"><b>Note :</b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%"align="right" style="font-size:12px"><b></b></td>
            </tr>
            <tr>
            <td align="left" colspan="3" style="font-size:12px">Delivery time :</td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%"align="right" style="font-size:12px"><b></b></td>
            </tr> 
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px">: Pagi ( pkl. 08.00 - 10.00 wib )</td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%"align="right" style="font-size:12px"><b></b></td>
            </tr> 
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px"></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%"align="right" style="font-size:12px"><b></b></td>
            </tr> 
     
            <tr>
            <td align="left" colspan="3" style="font-size:12px"></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td width="3%"align="right" style="font-size:12px"><b></b></td>
            <td width="20%"align="right" style="font-size:12px"><b></b></td>
            </tr> 
         
     
     
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr >
            
            <td align="right" style="font-size:12px"> </td>
            <td align="right" style="font-size:12px"><b></b></td>
            <td  align="left" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
            <td align="left" style="font-size:12px"><b></b></td>
         </tr>
          
         </table>
     
     
     
     
         <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
            <tr>
                <td align ="center" style="font-size:12px" width="35%">
                (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) 
                </td>
                <td style="font-size:12px" width="35%" align="center">         
                    
                
                </td>
        
                <td style="font-size:12px"  width="12%" align="center">         
                        (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
                
                
                </td>
                <td style="font-size:12px"  width="12%" align="center">         
                (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
                    
                
                </td>
                <td style="font-size:12px"  width="12%" align="center">         
                (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
                    
                
                </td>
            </tr>
        </table>
        
        
        
        <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="0">	
            <tr>
                <td align ="center" style="font-size:12px" width="35%">
                Accepted by,<br />
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                </td>
                <td style="font-size:12px" width="35%" align="center"> 
                <b style="font-size:11px"></b>
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                </td>
        
                <td style="font-size:12px"  width="12%" align="center">         
                       Ordered by,<br />
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                </td>
                <td style="font-size:12px"  width="12%" align="center">         
                        know by,<br />
                        <b align="center" ></b> <br /> 
                        <b align="center" ></b> <br /> 
                        <b align="center" ></b> <br /> 
                        <b align="center" ></b> <br /> 
                
                </td>
                <td style="font-size:12px"  width="12%" align="center">         
                        Approved by,<br />
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                    <b align="center" ></b> <br /> 
                
                </td>
            </tr>
        </table>
        
        <table style="font-size:12px" width="100%" border="0" cellpadding="0" cellspacing="1">	
            <tr>
                <td style="font-size:11px" width="35%" align="center">
                    <bstyle="font-size:12px"></b>
                </td>
                <td style="font-size:11px" width="35%" align="center" >         
                    <br />
                </td>
                <td style="font-size:12px"  width="36%" align="center" >         
                   <b> PT Shimada Karya Indonesia </b>
                </td>
            </tr>
        </table>
        
        
        
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0">	
            <tr>
                <td style="font-size:11px"  width="65%">
                <b style="font-size:12px"></b>
                </td>
            </tr>			
        </table>
            
        <table width="100%" border="0" cellpadding="0" cellspacing="0">	
            <tr>
                <td style="font-size:10px"  width="70%">
                <br>
                </td>
                <td style="font-size:10px"  width="36%">
                <br>
                </td>
            </tr>			
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">	
            <tr>
                <td style="font-size:10px"  width="70%">
                <b style="font-size:12px"></b>
                <br>
                </td>
                <td style="font-size:10px"  width="36%">
                <br>    
                </td>
            </tr>			
        </table>
            <table style="font-size:12px"  width="100%" border="0" cellpadding="0" cellspacing="0">	
            <tr>
            <td style="font-size:12px"  width="25%">
            <td style="font-size:12px" width="25%">         
            </td> 
            <td style="font-size:12px" width="25%">    <br />     
            </td>
            </tr>
            </table>
            </tr> ';
            
        
     
       
       
       $output .= '</table>';
                 
              
     
                 
                 $dompdf ->loadHtml($output);
                 $dompdf ->setpaper('A4','portrait');
                 $dompdf ->render();
                 $dompdf ->stream('datapel.php',array("Attachment" => false));
             }



	

    public function export(){
        // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
                     ->setLastModifiedBy('My Notes Code')
                     ->setTitle("Data Transaksi")
                     ->setSubject("Transaksi")
                     ->setDescription("Laporan Semua Data Transaksi")
                     ->setKeywords("Data Transaksi");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                $transaksi = $this->TransaksiModel->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->TransaksiModel->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $label = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->TransaksiModel->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $transaksi = $this->TransaksiModel->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setCellValue('A1', "DATA TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->setCellValue('A2', $label); // Set kolom A2 sesuai dengan yang pada variabel $label
        $excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A2 sampai E2
        // Buat header tabel nya pada baris ke 4
        $excel->getActiveSheet()->setCellValue('A4', "Tanggal"); // Set kolom A4 dengan tulisan "Tanggal"
        $excel->getActiveSheet()->setCellValue('B4', "Kode Transaksi"); // Set kolom B4 dengan tulisan "Kode Transaksi"
        $excel->getActiveSheet()->setCellValue('C4', "Barang"); // Set kolom C4 dengan tulisan "Barang"
        $excel->getActiveSheet()->setCellValue('D4', "Jumlah"); // Set kolom D4 dengan tulisan "Jumlah"
        $excel->getActiveSheet()->setCellValue('E4', "Total Harga"); // Set kolom E4 dengan tulisan "Total Harga"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        // Set height baris ke 1, 2, 3 dan 4
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 5
    foreach($transaksi as $data){ // Lakukan looping pada variabel transaksi
          $tgl = date('d-m-Y', strtotime($data->tgl)); // Ubah format tanggal jadi dd-mm-yyyy
          $excel->getActiveSheet()->setCellValue('A'.$numrow, $tgl);
          $excel->getActiveSheet()->setCellValue('B'.$numrow, $data->kode);
          $excel->getActiveSheet()->setCellValue('C'.$numrow, $data->barang);
          $excel->getActiveSheet()->setCellValue('D'.$numrow, $data->jumlah);
          $excel->getActiveSheet()->setCellValue('E'.$numrow, $data->total_harga);
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
          $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(18); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet()->setTitle("Laporan Data Transaksi");
        $excel->getActiveSheet();
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
