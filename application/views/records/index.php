<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laporan PDF Plus Filter Periode Tanggal</title>

    <!-- Include file CSS Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet"> 

    <!-- Include library Bootstrap Datepicker -->
    <link href="<?php echo base_url('assets/libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>" rel="stylesheet">

    <!-- Include library Font Awesome (Dibutuhkan Datepicker) -->
    <link href="<?php echo base_url('assets/libraries/fontawesome/css/all.min.css') ?>" rel="stylesheet">

    <!-- Include File jQuery -->
    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Brands</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Brands</li>
    </ol>
  </section>

	
  <div class="col-md-12 ">   
  <div class="box">
          <div class="box-header">
   <div class="form-group">            
   <div class="table-responsive">
   <form method="get" action="<?php echo base_url('records') ?>">
      
            <div class="col-sm-5">
                    <label for="deliverydate">Dari tanggal</label>
                    <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal datetimepicker-input" placeholder="Tanggal Awal" data-toggle="datetimepicker" data-target=".tgl_awal" autocomplete="off">
             </div>
            <div class="col-sm-5">
                    <label for="deliverydate">Sampai tanggal</label>
                    <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir datetimepicker-input" placeholder="Tanggal Akhir" data-toggle="datetimepicker" data-target=".tgl_akhir" autocomplete="off">
             </div>
  
      <div class="col-sm-5">
                   <br>    
      <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>
    
      <?php
      if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
          echo '<a href="'.base_url('records/index').'" class="btn btn-default">RESET</a>';
      ?>
 </br>
     
 <h4 style="margin-bottom: 5px;"><b>Data Input Defect QC</b></h4>
        <?php echo $label ?><br />

        <div style="margin-top: 5px;">
            <a href="<?php echo $url_cetak ?>">CETAK PDF</a>
			 <a href="<?php echo $url_cetak ?>">Download EXCELL</a>
			
</form>		
     
    <!-- isi part name -->  
    <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Tanggal</th>
                        <th>PARTNAME</th>
                        <th>Nomer LOT</th>
                        <th width="20%">GORESAN</th>
                        <th>TIDAKNEMPEL</th>
                        <th>KEBENTUR</th>
                        <th>SARINGANJEBOL</th>
                        <th>GELEMBUNG</th>
                        <th>BINTIK</th>
                        <th>UKADALAM</th>
                        <th>LUKALUAR</th>
                        <th>RETAK</th>
                        <th>BERGARIS</th>
                        <th>HOSEPENDEK</th>
                        <th> OVER</th>
                        <th>WRAPPINGAN</th>
                        <th>BRAIDINGAN</th>
                        <th>BOLONG</th>
                        <th>TIPIS</th>
                        <th>KARETNEMPEL</th>
                        <th>TEBAL</th>
                        <th>PORISITI</th>
                        <th>BEKASTANGAN</th>
                        <th>SOBEK</th>
                        <th>OVAL</th>
                        <th>BENANGRUSAK</th>
                        <th>SIWAK</th>
                        <th>KEROPOS</th>
                        <th>HOLETUBE</th>
                        <th>SPRINGPENDEK</th>
                        <th>DIAMETERKECIL</th>
                        <th>OTHERS</th>
                        <th>OK</th>
                        <th>NG</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(empty($transaksi)){ // Jika data tidak ada
                        echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                    }else{ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        foreach($transaksi as $data){ // Looping hasil data transaksi
                            $date_time = date('d-m-Y', strtotime($data->date_time)); // Ubah format tanggal jadi dd-mm-yyyy
                            echo "<tr>";
                            echo "<td>".$data->tgl."</td>";
                            echo "<td>".$data->nama."</td>";
                            echo "<td>".$data->nolot."</td>";                             
                            echo "<td>".$data->goresan."</td>";
                            echo "<td>".$data->tidaknempel."</td>";
                            echo "<td>".$data->kebentur."</td>"; 
                            echo "<td>".$data->saringanjebol."</td>";
                            echo "<td>".$data->gelembung."</td>";
                            echo "<td>".$data->bintik."</td>"; 
                            echo "<td>".$data->lukadalam."</td>";
                            echo "<td>".$data->lukaluar."</td>";
                            echo "<td>".$data->retak."</td>"; 
                            echo "<td>".$data->bergaris."</td>";
                            echo "<td>".$data->hosependek."</td>";
                            echo "<td>".$data->oper."</td>"; 
                            echo "<td>".$data->wrappingan."</td>";
                            echo "<td>".$data->braidingan."</td>";
                            echo "<td>".$data->bolong."</td>"; 
                            echo "<td>".$data->tipis."</td>";
                            echo "<td>".$data->karetnempel."</td>";
                            echo "<td>".$data->tebal."</td>"; 
                            echo "<td>".$data->porisiti."</td>";
                            echo "<td>".$data->bekastangan."</td>";
                            echo "<td>".$data->sobek."</td>"; 
                              echo "<td>".$data->oval."</td>";
                            echo "<td>".$data->benangrusak."</td>";
                            echo "<td>".$data->siwak."</td>"; 
                            echo "<td>".$data->keropos."</td>";
                            echo "<td>".$data->holetube."</td>";
                            echo "<td>".$data->springpendek."</td>"; 
                            echo "<td>".$data->diameterkecil."</td>";
                            echo "<td>".$data->others."</td>";
                            echo "<td>".$data->ok."</td>";
                            echo "<td>".$data->ng."</td>";
							echo "<td>".$data->total."</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
</div>
</div>
</div>
</div>  
</div>  
</section>
   <!-- Include File JS Bootstrap -->
   <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Include library Moment (Dibutuhkan untuk Datepicker) -->
<script src="<?php echo base_url('assets/libraries/moment/moment.min.js') ?>"></script>

<!-- Include library Bootstrap Datepicker -->
<script src="<?php echo base_url('assets/libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>

<!-- Include File JS Custom (untuk fungsi Datepicker) -->
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>

<script>
$(document).ready(function(){
    setDateRangePicker(".tgl_awal", ".tgl_akhir")
})


</script>