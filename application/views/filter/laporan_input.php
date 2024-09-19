

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Laporan Inputs QC</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan Input QC</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Laporan QC</h3>
          </div>
          <!-- /.box-header -->

        <form action="<?php echo base_url(); ?>filter/filter" method="POST" target="_blank">
     <!--    <input type="hidden" value="1" name="nilaifilter"> -->
     <div class="container align-items-center">
                <form action="">
                    <div class="row">
                        <div class="col form-group">
                            <label for="inputMulaiTanggal" class="font-weight-bold">Mulai Tanggal :</label>
                            <input type="date" id="inputMulaiTanggal" class="form-control" name="tanggalawal"  required>
                        </div>
                        <div class="col form-group">
                            <label for="inputSampaiTanggal" class="font-weight-bold">Sampai Tanggal :</label>
                            <input type="date" id="inputSampaiTanggal" class="form-control" name="tanggalakhir"  required>
                        </div>
                        <button type=" submit" class="col btn btn-success mt-3">Tampilkan</button>
                        
                       
                        <a href="<?php echo base_url('filter/excel'); ?>" class="btn btn-primary">Export Excell</a>
                    </div>
                </form>
            </div>
    
     <div class="box-body">   
    
       
    </form>
<br>

<br>

<div class="table-responsive">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Shift</th>
                <th>Nama Karyawan</th>
                <th>Part No</th>
                <th>No Lot</th>
                <th>OK</th>
                <th>NG </th>
                <th>Total</th>
                <th>Goresan</th>
                <th>Tidak nempel</th>
                <th>Kebentur</th>
                <th>Saringan jebol</th>
                <th>Gelembung</th>
                <th>Bintik</th>
                <th>Luka dalam</th>
                <th>Luka luar</th>
                <th>Retak</th>
                <th>Bergaris</th>
                <th>Hose Pendek </th>
                <th>Over</th>
                <th>Wrappingan</th>
                <th>Braidingan</th>
                <th>Bolong</th>
                <th>Tipis</th>
                <th>Karet nempel </th>
                <th>Tebal</th>
                <th>Porisiti</th>
                <th>Bekas Tangan</th>
                <th>Sobek </th>
                <th>Oval</th>
                <th>Benang Rusak </th>
                <th>Siwak</th>
                <th>Keropos</th>
                <th>Hole Tube</th>
                <th>Spring Pendek</th>
                <th>Seret</th>
                <th>Sempit </th>
                <th>Diameter kecil</th>
                <th>Other</th>
              </tr>
              </thead>
<tbody>
  <tr> 
  <?php
		    if( ! empty($datafilter)){
		    	$no = 1;
		    	foreach($datafilter as $row){
		       //     $tgl = date('d-m-Y', strtotime($row->tgl));
           echo "<tr>";
		    		echo "<td>".$no."</td>";
		    		echo "<td>".$row->tgl."</td>";
		    		echo "<td>".$row->waktu."</td>";
		    		echo "<td>".$row->shift."</td>";
		    		echo "<td>".$row->operatorname."</td>";
		    		echo "<td>".$row->nama."</td>";

            echo "<td>". $row->nolot."</td>";

echo "<td>". $row->ok."</td>";
echo "<td>". $row->ng."</td>";
echo "<td>". $row->total."</td>";
echo "<td>".$row->goresan."</td>";
echo "<td>". $row->tidaknempel."</td>";
echo "<td>". $row->kebentur."</td>";
      
echo "<td>". $row->saringanjebol."</td>";
echo "<td>".$row->gelembung."</td>";
echo "<td>".$row->bintik."</td>";
echo "<td>".$row->lukadalam."</td>";
echo "<td>". $row->lukaluar."</td>";
echo "<td>".$row->retak."</td>";
      
      
echo "<td>".$row->bergaris."</td>";
echo "<td>".$row->hosependek."</td>";
echo "<td>".$row->oper."</td>";
echo "<td>". $row->wrappingan."</td>";
echo "<td>".$row->braidingan."</td>";
echo "<td>".$row->bolong."</td>";
echo "<td>".$row->tipis."</td>";
echo "<td>".$row->karetnempel."</td>";
echo "<td>".$row->tebal."</td>";
echo "<td>".$row->porisiti."</td>";
echo "<td>".$row->bekastangan."</td>";
echo "<td>".$row->sobek."</td>";
echo "<td>". $row->oval."</td>";
echo "<td>".$row->benangrusak."</td>";
echo "<td>".$row->siwak."</td>";
echo "<td>".$row->keropos."</td>";
echo "<td>".$row->holetube."</td>";
echo "<td>".$row->springpendek."</td>";
      
echo "<td>".$row->seret."</td>";
echo "<td>".$row->sempit."</td>";
echo "<td>".$row->diameterkecil."</td>";
echo "<td>". $row->others."</td>";

		    		echo "</tr>";
		    		$no++;
		    	}
		    }
		    ?>

</tbody>
            </table>


<!-- <p>PILIH BY Bulan<p>
<br>
<form action="<?php echo base_url(); ?>filter/filter" method="POST" target="_blank">
<input type="hidden" value="2" name="nilaifilter">
Pilih Tahun <br>
<select name="tahun1" required="">
    <?php foreach ($tahun as $row): ?>

        <option value="<?php echo $row->tahun ?>"><?php echo $row->tahun?></option>
<?php endforeach ?>

</select>




<p>Bulan Awal </p>

<select name="bulanawal" required="">

        <option value="1">JANUARI</option>
        <option value="2">FEB</option>    
        <option value="3">MART</option>
        <option value="4">APR</option>
        <option value="5">MEI</option>
        <option value="6">JUN</option>
<option value="7">JULI</option>    
<option value="8">AGUSTUS</option>
<option value="9">SEP</option>
<option value="10">OKT</option>
<option value="11">NOVEMBER</option>
<option value="12">DESEMBER</option>

</select>


<p>Bulan Akhir </p><select name="bulanakhir" required="">

<option value="1">JANUARI</option>
<option value="2">FEB</option>    
<option value="3">MART</option>
<option value="4">APR</option>
<option value="5">MEI</option>
<option value="6">JUN</option>
<option value="7">JULI</option>    
<option value="8">AGUSTUS</option>
<option value="9">SEP</option>
<option value="10">OKT</option>
<option value="11">NOVEMBER</option>
<option value="12">DESEMBER</option>

</select>

<br>
<input type="submit" value="print">
</form>

<br>
<p>PILIH BY Bulan<p>
<br>
<form action="<?php echo base_url(); ?>filter/filter" method="POST" target="_blank">
<input type="hidden" value="3" name="nilaifilter">
Pilih Tahun <br>
<select name="tahun2" required="">
    <?php foreach ($tahun as $row): ?>

        <option value="<?php echo $row->tahun ?>"><?php echo $row->tahun?></option>
<?php endforeach ?>

</select>

<br>
<input type="submit" value="print">
    </form>






          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Part No</th>
                <th>No Lot</th>
                <th>OK</th>
                <th>NG </th>
                <th>Total</th>
                <?php if(in_array('updateFilter', $user_permission) || in_array('deleteFilter', $user_permission)): ?>
                <th>Action</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div> --> 
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('deleteItem', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Item</h4>
      </div>

      <form role="form" action="<?php echo base_url('items/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainFilterNav").addClass('active');

  // initialize the datatable 
 // manageTable = $('#manageTable').DataTable({
 //   'ajax': base_url + 'items/fetchItemData',
 //   'item': []
 // });

});

// remove functions 

</script>
