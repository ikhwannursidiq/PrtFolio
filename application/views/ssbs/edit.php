

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
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
            <h3 class="box-title">Edit Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('ssbs/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                <div class="col-md-5 col-xs-12 ">
                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Tgl Penilaian</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $ssb_data['tgl']; ?>"placeholder="Enter nama perusahaan" autocomplete="off" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Nama perusahaan</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="namaperusahaan" name="namaperusahaan" value="<?php echo $ssb_data['namaperusahaan']; ?>" placeholder="Enter namaperusahaan" autocomplete="off" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamatkantorpusat" class="col-sm-5 control-label" style="text-align:left;">alamat kantor pusat</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="alamatkantorpusat" name="alamatkantorpusat" value="<?php echo $ssb_data['alamatkantorpusat']; ?>" placeholder="Enter alamat kantor pusat" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Alamat kantor cabang</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="alamatkantorcabang" name="alamatkantorcabang" value="<?php echo $ssb_data['alamatkantorcabang']; ?>" placeholder="Enter alamat kantor cabang" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Telephone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="telp" name="telp"  placeholder="Enter Telp" value="<?php echo $ssb_data['telp']; ?>" autocomplete="off">
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-5 col-xs-12  ">
                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Date Created</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="datecreated" name="datecreated" value="<?php echo $ssb_data['datecreated']; ?>" placeholder="Enter " autocomplete="off">
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Fax</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="fax" name="fax" placeholder="Enter FAX" value="<?php echo $ssb_data['fax']; ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Contact Person</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="attn" name="attn" value="<?php echo $ssb_data['attn']; ?>" placeholder="Enter contak person" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Nama Barang</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="namabarang" name="namabarang" value="<?php echo $ssb_data['namabarang']; ?>" placeholder="Enter nama barang" autocomplete="off" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Kriteria seleksi</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="kriteriaseleksi" name="kriteriaseleksi" value="<?php echo $ssb_data['kriteriaseleksi']; ?>" placeholder="Enter Seleksi" autocomplete="off" />
                    </div>
                  </div>

          </div>
             
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                    <th align="center" bgcolor="#EE6868" style="width:1%">No</th>
                      <th align="center" bgcolor="#EE6868"style="width:15%">Uraian Penilaian</th>
                      <th align="center" bgcolor="#EE6868"style="width:5%">Nilai</th>
                      <th align="center" bgcolor="#EE6868"style="width:5%">Penilaian</th>
                    </tr>
                  </thead>

      <tbody>
          <tr id="row_1">
              <td  align="center"  style="width:1%"  bgcolor="#FFDAB9" >1</td>
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;" bgcolor="#FFDAB9">NPWP</label></td>
              <td  align="center"  bgcolor="#FFDAB9"><label >2</td>
              <td  align="center"  bgcolor="#FFDAB9"><input type="text" name="npwp" id="npwp" class="form-control-sm text-right item" value="<?php echo $ssb_data['npwp']; ?>"></td>
          </tr>
          <tr id="row_1">
              <td  align="center" bgcolor="#FFDAB9" style="width:1%" >2</td>
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">SIUP</label></td>
              <td  align="center"  bgcolor="#FFDAB9"><label align="center"  >2</td>
              <td   align="center" bgcolor="#FFDAB9"><input type="text" name="siup" id="siup" class="form-control-sm text-right item" value="<?php echo $ssb_data['siup']; ?>"></td>
          </tr> <tr id="row_1">
              <td align="center" bgcolor="#FFDAB9" style="width:1%" >3</td>
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Brosur</label></td>
              <td  align="center"  bgcolor="#FFDAB9"><label align="center"  >2</td>
              <td  align="center"  bgcolor="#FFDAB9"><input type="text" name="brosur" id="brosur" class="form-control-sm text-right item" value="<?php echo $ssb_data['brosur']; ?>"></td>
          </tr> <tr id="row_1">
              <td  align="center"  bgcolor="#FFDAB9" style="width:1%">4</td>
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Data Produk</label></td>
              <td  align="center"  bgcolor="#FFDAB9" align ="center"><label align="center" >5</td>
              <td  align="center"  bgcolor="#FFDAB9"  align="center" ><input type="text" name="dataproduk" id="dataproduk" class="form-control-sm text-right item" value="<?php echo $ssb_data['dataproduk']; ?>"></td>
          </tr>   

      <tr id="row_1">
              <td  align="center"  bgcolor="#FFDAB9" style="width:1%" rowspan="4">5</td>
              <td colspan="1" bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Status Perusahaan: MAX 20 %</label></td>
              <td bgcolor="#FFDAB9" style="width:1%" colspan="2"></td>
          </tr>
          <tr id="row_1">
             
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">a. Produsen / Distributor </label></td>
              <td align="center" bgcolor="#FFDAB9"><label >15</td>
              <td align="center" bgcolor="#FFDAB9"><input type="produsen" name="produsen" id="produsen" class="form-control-sm text-right item" value="<?php echo $ssb_data['produsen']; ?>"></td>
          </tr>
          <tr id="row_1">
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">b. Agen / Toko</label></td>
              <td bgcolor="#FFDAB9" align="center"><label >7</td>
              <td align="center" bgcolor="#FFDAB9"><input type="text" name="agen" id="agen" class="form-control-sm text-right item" value="<?php echo $ssb_data['agen']; ?>"></td>
          </tr>
          <tr id="row_1">
              
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">c. Perorangan </label></td>
              <td align="center" bgcolor="#FFDAB9"><label >1</td>
              <td align="center"bgcolor="#FFDAB9"><input type="text" name="perorangan" id="perorangan" class="form-control-sm text-right item" value="<?php echo $ssb_data['perorangan']; ?>"></td>
      </tr>

      <tr id="row_1">
              <td align="center" bgcolor="#FFDAB9" style="width:1%" rowspan="3">6</td>
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Penetapan Harga: </label></td>
              <td colspan="2" bgcolor="#FFDAB9"><label ></td>
              
          </tr>
          <tr id="row_1">
             
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">a. Harga Bersaing </label></td>
              <td align="center" bgcolor="#FFDAB9"><label >15</td>
              <td align="center" bgcolor="#FFDAB9"><input type="text" name="hargasaing" id="hargasaing" class="form-control-sm text-right item" value="<?php echo $ssb_data['hargasaing']; ?>"></td>
          </tr>
          <tr id="row_1">
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">b. Harga diatas Harga pasar</label></td>
              <td align="center" bgcolor="#FFDAB9"><label >5</td>
              <td align="center" bgcolor="#FFDAB9"><input type="text" name="hargapasar" id="hargapasar" class="form-control-sm text-right item" value="<?php echo $ssb_data['hargapasar']; ?>"></td>
          </tr>
         

      <tr id="row_1">
              <td align="center" bgcolor="#FFDAB9" style="width:1%" rowspan="3">7</td>
              <td align="center" bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Hasil Pemeriksaan Sample Bahan : </label></td>
              <td align="center" bgcolor="#FFDAB9" colspan="2"><label ></td>
              
          </tr>
          <tr id="row_1">
             
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">a. Baik </label></td>
              <td align="center" bgcolor="#FFDAB9"><label >2</td>
              <td align="center" bgcolor="#FFDAB9"><input type="text" name="baik" id="baik" class="form-control-sm text-right item" value="<?php echo $ssb_data['baik']; ?>"></td>
          </tr>
          <tr id="row_1">
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">b. Cukup</label></td>
              <td align="center" bgcolor="#FFDAB9"><label >2</td>
              <td align="center" bgcolor="#FFDAB9"><input type="text" name="cukup" id="cukup" class="form-control-sm text-right item" value="<?php echo $ssb_data['cukup']; ?>"></td>
          </tr>
         
        
        
      <tr id="row_1">
              <td align="center" bgcolor="#FFDAB9" style="width:1%"  rowspan="4">8</td>
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Lokasi Supplier: </label></td>
              <td bgcolor="#FFDAB9" colspan="2"><label ></td>
              
          </tr>
          <tr id="row_1">
             
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">a. Dalam Kota </label></td>
              <td align="center"  bgcolor="#FFDAB9"><label >12</td>
              <td align="center"  bgcolor="#FFDAB9"><input type="text" name="dalamkota" id="dalamkota" class="form-control-sm text-right item" value="<?php echo $ssb_data['dalamkota']; ?>"></td>
          </tr>
          <tr id="row_1">
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">b. Luar Kota</label></td>
              <td align="center"  bgcolor="#FFDAB9"><label >6</td>
              <td align="center"  bgcolor="#FFDAB9"><input type="text" name="luarkota" id="luarkota" class="form-control-sm text-right item" value="<?php echo $ssb_data['luarkota']; ?>"></td>
          </tr>
          <tr id="row_1">
              
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">c. Luar Negri </label></td>
              <td align="center"  bgcolor="#FFDAB9"><label >2</td>
              <td align="center"  bgcolor="#FFDAB9"><input type="text" name="luarnegri" id="luarnegri" class="form-control-sm text-right item" value="<?php echo $ssb_data['luarnegri']; ?>"></td>
      </tr>
        
      <tr id="row_1">
              <td align="center" bgcolor="#FFDAB9" rowspan="4">9</td>
              <td  bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Sarana Komunikasi: </label></td>
              <td  colspan="2" bgcolor="#FFDAB9"><label ></td>
              
          </tr>
          <tr id="row_1">
             
              <td bgcolor="#FFDAB9"><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">a. Lengkap </label></td>
              <td align="center"  bgcolor="#FFDAB9"><label >8</td>
              <td align="center"  bgcolor="#FFDAB9"><input type="text" name="lengkap" id="lengkap" class="form-control-sm text-right item" value="<?php echo $ssb_data['lengkap']; ?>"></td>
          </tr>
          <tr id="row_1">
              <td bgcolor="#FFDAB9" ><label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">b. Kurang Lengkap</label></td>
              <td align="center"  bgcolor="#FFDAB9"><label >2</td>
              <td align="center"  bgcolor="#FFDAB9"><input type="text" name="kl" id="kl" class="form-control-sm text-right item" value="<?php echo $ssb_data['kl']; ?>"></td>
          </tr>
      <tr id="row_1">
              <td bgcolor="#FFDAB9" rowspan="5" Align ="right"></td>
              <td bgcolor="#FFDAB9"><label >Total Nilai</td>
              <td bgcolor="#FFDAB9"><input readonly  type="text" name="hasil"  id="hasil"  class="form-control-sm text-right item" value="<?php echo $ssb_data['hasil']; ?>"></td>
          </tr>  
         
        </tbody>
        </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Hasil Seleksi</label>
                    <div class="col-sm-7">
                    <label for="gross_amount" class="col-s-5 control-label">N ≤ 40&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       : Tidak dimasukan ke dalam DST</label>
                    <label for="gross_amount" class="col-s-5 control-label">N > 40 < 55&nbsp;&nbsp;  : Dipertimbangkan   </label>
                    <label for="gross_amount" class="col-s-5 control-label">N ≥ 55&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       : Dimasukan ke dalam DST</label>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Kesimpulan</label>
                    <div class="col-sm-7">
                    <input type="textarea" class="form-control" id="kesimpulan" name="kesimpulan" value="<?php echo $ssb_data['kesimpulan']; ?>" placeholder="kesimpulan" class="form-control-sm text-right item" value="">
                   
                    </div>
                  </div>
              
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Catatan</label>
                    <div class="col-sm-7">
                    <textarea class="form-control txt" rows="5" name="note" id="note" value="<?php echo $ssb_data['note']; ?>" onkeyup="this.value = this.value.toUpperCase()" placeholder="Your Notes"></textarea>
					
                      </div>
                  </div>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                
                <button type="submit" class="btn btn-primary">SAVE</button>
                <a href="<?php echo base_url('ssbs/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
<script type="text/javascript">
   $(document).ready(function() {
           
    $("#npwp").val();
    $("#siup").val();
    $("#brosur").val();
    $("#dataproduk").val();
    $("#produsen").val();
    $("#agen").val();
    $("#perorangan").val();
    $("#hargasaing").val();
    $("#hargapasar").val();
    $("#baik").val();
    $("#cukup").val();
    $("#dalamkota").val();
    $("#luarkota").val();
    $("#luarnegri").val();
    $("#lengkap").val();
    $("#kl").val();
    $("#hasil").val();

          });

    $(document).on("change", ".item", function() {
    var a = $("#npwp").val();
    var b = $("#siup").val();
    var c = $("#brosur").val();
    var d = $("#dataproduk").val();
    var e = $("#produsen").val();
    var f = $("#agen").val();
    var g = $("#perorangan").val();
    var h = $("#hargasaing").val();
    var i = $("#hargapasar").val();
    var j = $("#baik").val();
    var k = $("#cukup").val();
    var l = $("#dalamkota").val();
    var m = $("#luarkota").val();
    var n = $("#luarnegri").val();
    var o = $("#lengkap").val();
    var p = $("#kl").val();
    var hasil = $("#hasil").val();
    var jumlah =(Number(a) + Number(b) + Number(c) + Number(d) + Number(e) + Number(f) + Number(g) + Number(h) + Number(i) + Number(j) + Number(k) + Number(l) + Number(m) + Number(n) + Number(o) + Number(p));
    $("#hasil").val(jumlah);

    //input hasil penjumlahan otomatis 
        if (jumlah<=40)
                        kesimpulan="Tidak dimasukkan ke dalam DST";
            else if (jumlah <=55)
                        kesimpulan="Dipertimbangkan";
            else if (jumlah >55)
                        kesimpulan="Dimasukkan ke dalam DST";
            document.forms[0].kesimpulan.value=kesimpulan;
    });

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>



         