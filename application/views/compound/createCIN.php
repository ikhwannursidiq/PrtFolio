<style>

.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Items</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Items</li>
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
            <h3 class="box-title"></h3>
          </div>
        
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('compound/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

               
       
        <div class="col-md-4 col-xs-12 pull pull-left">


        <table class="styled-table">
                <thead>
                <tr>
                    <th width="35%" >Create Compound</th>
                    <th></th>
                    
                </tr>
                </thead>
                <?php 
    $tgl = date("Y-m-d");
    $ganti_status=$this->db->query("UPDATE pinjambuku SET keterangan='dipinjam' WHERE tgl_kembali>'$tgl'");
    $ganti_status=$this->db->query("UPDATE pinjambuku SET keterangan='Belum dikembalikan' WHERE tgl_kembali<'$tgl'");
?>


<td><input type="text" class="form-control" name="tgl_hari_ini" style="width: 200px" id="tgl_hari_ini" placeholder="Nama Buku" value="<?php echo date("Y-m-d") ?>"  /></td>
</tr>

<tr><td width='200'> Tgl Pinjam</td><td><input type="date" class="form-control" name="tgl_pinjam" onchange="status_buku()" id="tgl_pinjam" placeholder="Tgl Pinjam" style="width: 200px"  /></td></tr>

<tr><td width='200'>Tgl Kembali </td><td><input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" placeholder="Tgl Kembali" style="width: 200px"   /></td></tr>


<tr><td width='200'>Keterangan</td><td>
<select name="keterangan" id="keterangan" style="width: 200px" class="form-control">
                <option value="">--KETERANGAN--</option>
                <option value="dipinjam">DIPINJAM</option>
                <option value="Belum dikembalikan">BELUM DIKEMBALIKAN</option>
                <option value="dikembalikan">DIKEMBALIKAN</option>
                <option value="Tidak Lengkap">TIDAK LENGKAP</option>
                <option value="akan dipinjam">AKAN DIPINJAM</option>
                <option value="0">TANGGAL TIDAK COCOK</option>
                </select></td></tr>

                </tbody>
                </table>

        </div>
        <div class="col-md-5 col-xs-12 pull pull-left">
         
        <table class="styled-table">
                <thead>
                <tr>
                    <th width="25%" >Check Point</th>
                    <th>Standard</th>
                    <th>Actual</th>
                    <th width="18%x">Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $nilai = '100';
                  ?>
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">HS</label></td>
                    <td><input type="number" class="form-control" id="hsstd" name="hsstd"  onchange="statusCompound()"   autocomplete="off" ></td>
                    <td><input type="number" class="form-control" id="hsact" name="hsact" onchange="statusCompound()" autocomplete="off" ></td>
                    <td><input type="text" class="form-control" id="hsst" name="hsst" onchange="statusCompound()" autocomplete="off" ></td>
                </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">TENSILE BREAK (TB)</label></td>
                    <td><input type="number" class="form-control" id="tbstd" name="tbstd" autocomplete="off"></td>
                    <td><input type="number" class="form-control" id="tbact" name="tbact" autocomplete="off"></td>
                    <td><select class="form-control" id="tbst" name="tbst">
                        <option value="1">OK</option>
                        <option value="2">NG</option>
                        </select>
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">ELONGATION BREAK (EB)</label></td>
                    <td><input type="number" class="form-control" id="ebstd" name="ebstd"  autocomplete="off"></td>
                    <td><input type="number" class="form-control" id="ebact" name="ebact"  autocomplete="off"></td>
                    <td><select class="form-control" id="ebst" name="ebst">
                        <option value="1">OK</option>
                        <option value="2">NG</option>
                        </select>
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">SPESIFIC GRAFITY</label></td>
                    <td><input type="number" class="form-control" id="sgstd" name="sgstd"  autocomplete="off"></td>
                    <td><input type="number" class="form-control" id="sgact" name="sgact"  autocomplete="off"></td>
                    <td><select class="form-control" id="sgst" name="sgst">
                        <option value="1">OK</option>
                        <option value="2">NG</option>
                        </select>
                    </td>
                </tr>
        <!-- and so on... -->
                </tbody>
                </table>
        </div>
                
        <div class="col-md-3 col-xs-12 pull pull-left">


<table class="styled-table">
        <thead>
        <tr>
            <th width="35%" >Result Action</th>
            <th></th>
            
        </tr>
        </thead>
        <tbody>
     
     
        <tr class="active-row">
           <td  class="active-row">  <label for="telp">Received</label></td>
            <td> <select class="form-control" id="received" name="received">
                <option value="1">Aang</option>
                <option value="2">Nani</option>
         </select></td>
        </tr>
        <tr class="active-row">
           <td  class="active-row">  <label for="telp">Result</label></td>
            <td> <select class="form-control" id="result" name="result">
                <option value="1">OK</option>
                <option value="2">NG</option>
                <option value="3">HOLD</option>
         </select></td>
        </tr>
<!-- and so on... -->
        </tbody>
        </table>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('compound/') ?>" class="btn btn-warning">Back</a>
              </div>
              
            </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
      </div>
    <!-- /.row -->
    </div>    


  </section>



  <!-- /.content -->
</div>

<section>



                    </section>
<!-- /.content-wrapper -->
<script type="text/javascript">
	function status_buku(){
        var tgl_pinjam = $("#tgl_pinjam").val();
        var tgl_kembali = $("#tgl_kembali").val();
        var tgl_hari_ini =  $("#tgl_hari_ini").val();
        var dikembalikan = 'dikembalikan';
        var dipinjam = 'dipinjam';
        var akan_dipinjam = 'akan dipinjam';
        var tidak_Lengkap = 'Tidak Lengkap';
        var belum_dikembalikan = 'Belum dikembalikan';
        var unknown = '0';
        

       if (tgl_pinjam<tgl_hari_ini) {
          var hasil = unknown;
        } else if (tgl_pinjam>tgl_hari_ini) {
          var hasil = akan_dipinjam;
        } else if (tgl_pinjam=tgl_hari_ini) {
          var hasil = dipinjam;
        }
        
        
       $.ajax({
                success: function(data)
                {
                 
                    $("#keterangan").val(hasil);
                
          
                }
            });    

    }



    function statusCompound(){
        var tgl_pinjam = $("#tgl_pinjam").val();
        var tgl_kembali = $("#tgl_kembali").val();
        var hsstd = $("#hsstd").val();
        var hsact = $("#hsact").val();
        var tgl_hari_ini =  $("#tgl_hari_ini").val();
        var dikembalikan = 'dikembalikan';
        var dipinjam = 'dipinjam';
        var akan_dipinjam = 'akan dipinjam';
        var tidak_Lengkap = 'Tidak Lengkap';
        var belum_dikembalikan = 'Belum dikembalikan';
        var unknown = '0';
        

       if (hsact<hsstd) {
          var hasil = unknown;
        } else if (hsact>hsstd) {
          var hasil = akan_dipinjam;
        } else if (hsact=hsstd) {
          var hasil = dipinjam;
        }
        
        
       $.ajax({
                success: function(data)
                {
                 
                    $("#hsst").val(hasil);
                
          
                }
            });    

    }
</script>