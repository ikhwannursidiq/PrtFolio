

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Repair</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Repair</li>
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
            <h3 class="box-title">Add Data Repair</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('repair/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="store">Select Data</label>
                  <select class="form-control select_group" id="part_id" name="part_id" onchange="ambilData()" required >
                    <?php foreach ($inputsng as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['tgl'] ?> (PARTNO: <?php echo $v['nama'] ?> ) Jumlah NG : <?php echo $v['bfng'] ?> Total Pengecekan :<?php echo $v['total'] ?> No Lot : <?php echo $v['nolotnew'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>


                <div class="form-group">
                  <label for="partname">Part name</label>
                  <input type="text" class="form-control" id="partname" name="partname" placeholder="automatic" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="partno">Part No</label>
                  <input type="text" class="form-control" id="partno" name="partno" placeholder="automatic" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="nolot">No Lot</label>
                  <input type="text" class="form-control" id="nolot" name="nolot" placeholder="automatic" autocomplete="off" />
             
                </div>

                <div class="form-group">
                  <label for="nolot">Tanggal NG</label>
                  <input type="text" class="form-control" id="dateng" name="dateng" placeholder="automatic" autocomplete="off" />
             
                </div>

                <div class="form-group">
                  <label for="qtyng">Data NG</label>
                  <input type="text" class="form-control" id="ng" name="ng" placeholder=" automatic" autocomplete="off" />
                </div>


                
             

              <div class="col-sm-12">              
<div class="form-group">  
<h3 >Input Defect Hasil Pengeceken Data NG</h3>
<div class="col-sm-2">
<td><label >GORESAN</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="goresan" name="goresan" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >TIDAK NEMPEL</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="tidaknempel" name="tidaknempel" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >KEBENTUR</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="kebentur" name="kebentur" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SARINGAN JEBOL</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="saringanjebol" name="saringanjebol" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >RETAK</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="retak" name="retak" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >Jarak RING PENDEK</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="rp" name="rp" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >Potongan</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="ngmarking" name="ngmarking" placeholder="Enter Goresan" autocomplete="off">
    </td>
 
  

	
   
</div>
<div class="col-sm-2">
    
    
<td><label >GELEMBUNG</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="gelembung" name="gelembung" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BINTIK</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="bintik" name="bintik" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >LUKA DALAM</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="lukadalam" name="lukadalam" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >LUKA LUAR</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="lukaluar" name="lukaluar" placeholder="Enter Goresan" autocomplete="off">
    </td>
	  <td><label >HOLE TUBE</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="holetube" name="holetube" placeholder="Enter Goresan" autocomplete="off">
    </td>

    <td><label >SHAPE</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="shape" name="shape" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >HAGARE</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="ngassy" name="ngassy" placeholder="Enter Goresan" autocomplete="off">
    </td>

    

</div>

<div class="col-sm-2">


<td><label >BERGARIS</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="bergaris" name="bergaris" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >Hose Pendek</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="hosependek" name="hosependek" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >OVER CUT</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="oper" name="oper" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >WRAPPINGAN</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="wrappingan" name="wrappingan" placeholder="Enter Goresan" autocomplete="off">
    </td>
	<td><label >SPRING PENDEK</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="springpendek" name="springpendek" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >GAP</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="gap" name="gap" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >WATERMARK</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="watermark" name="watermark" placeholder="Enter Goresan" autocomplete="off">
    </td>
	

</div>


<div class="col-sm-2">
<td><label >BRAIDINGAN</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="braidingan" name="braidingan" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BOLONG</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="bolong" name="bolong" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >TIPIS</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="tipis" name="tipis" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >KARET NEMPEL</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="karetnempel" name="karetnempel" placeholder="Enter Goresan" autocomplete="off">
    </td>
	<td><label >DIAMETER KECIL</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="diameterkecil" name="diameterkecil" placeholder="Enter Goresan" autocomplete="off">
    </td>

    <td><label >DIAMETER BESAR</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="diameterbesar" name="diameterbesar" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BERTELUR</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="bertelur" name="bertelur" placeholder="Enter Goresan" autocomplete="off">
    </td>
  
</div>

<div class="col-sm-2">
     <td><label >TEBAL</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="tebal" name="tebal" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >PORISITI</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="porisiti" name="porisiti" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BEKAS TANGAN </label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="bekastangan" name="bekastangan" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SOBEK</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="sobek" name="sobek" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SEMPIT</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="sempit" name="sempit" placeholder="Enter " autocomplete="off">
    </td>
    <td><label >GELOMBANG</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="gelombang" name="gelombang" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >LAIN-LAIN</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="others" name="others" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>

<div class="col-sm-2">
     <td><label >OVAL</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="oval" name="oval" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BENANG RUSAK</label></td>        
    <td>
      <input type="number" class="form-control" value="0"  id="benangrusak" name="benangrusak" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SIWAK</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="siwak" name="siwak" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >KEROPOS</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="keropos" name="keropos" placeholder="Enter Goresan" autocomplete="off">
    </td>
	 
    <td><label >RING Miring</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="seret" name="seret" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >Jarak RING Panjang</label></td>        
    <td>
      <input type="number"  class="form-control" value="0"  id="ringlonggar" name="ringlonggar" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >Input Defect Others : </label></td>       
    <td>
    <input type="text"  class="form-control"   id="note" name="note" placeholder="type defect others " autocomplete="off">
      </td>
</div>


<div class="col-sm-8">
   
<br>
<div class="form-group">
                  <label for="qtyng">NOTE :</label>
                  <input type="text" class="form-control" id="note" name="note" placeholder="Enter Notes" autocomplete="off" />
                </div>
<br>


<br>

<div class="col-md-4 pull pull-right">

<div class="form-group">
<label for="ok" class="col-sm-3 control-label">Part OK</label>                  
<label class="btn btn-success active">
    <input type="number" class="form-control" required id="qtyok" name="qtyok" placeholder="Enter ok" autocomplete="off">
  </label>    


</div>

<div class="form-group">
<label for="ok" class="col-sm-3 control-label">Part NG</label>         
<label class="btn btn-danger active">
    <input type="number"  class="form-control"  id="qtyng" required name="qtyng" placeholder="Enter ng" autocomplete="off">
  </label>    
  </div>



<div class="form-group">
<label for="ok" class="col-sm-3 control-label">Total</label>         
<label class="btn btn-warning active">
    <input type="number"  class="form-control"  required id="qtyrepair" name="qtyrepair" placeholder="Enter total" autocomplete="off">
  </label>    
  </div>


</div>



</div>
</div>

<br>
<br>

<div class="form-group">
              <label for="qtyrepair">.</label>
           
              
            </div>

            </div>

              <!-- /.box-body -->
              <br>
<br>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('repair/') ?>" class="btn btn-warning">Back</a>
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
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $(".select_group").select2();
  //  $("#description").wysihtml5();

    $("#mainRepairNav").addClass('active');
    $("#addRepairNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });



  
 $(document).ready(function() {
        $("#rp, #shape, #gap, #gelombang, #diameterbesar, #ringlonggar, #ngmarking, #ngassy, #watermark, #bertelur, #sempit, #seret,#qtyrepair, #qtyok, #qtyng, #ok, #ng, #goresan, #tidaknempel, #kebentur, #saringanjebol, #gelembung, #bintik, #lukadalam, #lukaluar, #retak, #bergaris, #hosependek, #oper, #wrappingan, #braidingan, #bolong, #tipis, #karetnempel, #tebal, #porisiti, #bekastangan, #sobek, #oval, #benangrusak, #siwak, #keropos, #holetube, #springpendek, #diameterkecil, #others ").keyup(function() { 
    var gores = $("#goresan").val();
    var a = $("#tidaknempel").val();
    var b = $("#kebentur").val();
    var c = $("#saringanjebol").val();
    var d = $("#gelembung").val();
    var e = $("#bintik").val();
    var f = $("#lukadalam").val();
    var g = $("#lukaluar").val();
    var h = $("#retak").val();
    var i = $("#bergaris").val();
   var j =  $("#hosependek").val();
   var k =  $("#oper").val();
   var l = $("#wrappingan").val();
    var m = $("#braidingan").val();
    var n = $("#bolong").val();
   var o = $("#tipis").val();
   var p = $("#karetnempel").val();
   var q = $("#tebal").val();
   var r = $("#porisiti").val();
   var s = $("#bekastangan").val();
   var t = $("#sobek").val();
    var u = $("#oval").val();
   var v =$("#benangrusak").val();
   var w = $("#siwak").val();
   var x = $("#keropos").val();
  var y =  $("#holetube").val();
   var z = $("#springpendek").val();
    var ab = $("#sempit").val();
	 var ac = $("#seret").val();
   var kecil = $("#diameterkecil").val();
   var others = $("#others").val();
   var rp = $("#rp").val();
   var shape =$("#shape").val();
   var gap = $("#gap").val();
   var gelombang = $("#gelombang").val();
  var diameterbesar =  $("#diameterbesar").val();
   var ringlonggar = $("#ringlonggar").val();
    var ngmarking = $("#ngmarking").val();
	 var ngassy = $("#ngassy").val();
   var watermark = $("#watermark").val();
   var bertelur = $("#bertelur").val();
   var tidakok = parseInt(rp) + parseInt(shape) + parseInt(gap) + parseInt (gelombang) + parseInt(diameterbesar) + parseInt(ringlonggar) + parseInt(ngmarking) + parseInt(ngassy) + parseInt(watermark) + parseInt(bertelur)+ parseInt(gores) + parseInt (a)   + parseInt (others)  + parseInt (kecil) + parseInt (b) + parseInt (c) + parseInt (d) + parseInt (e) + parseInt (f) + parseInt (g) + parseInt (h) + parseInt (i) + parseInt (j) + parseInt (k) + parseInt (l) + parseInt (m) + parseInt (n) + parseInt (o) + parseInt (p) + parseInt (q) + parseInt (r) + parseInt (s) + parseInt (t) + parseInt (u) + parseInt (v) + parseInt (w) + parseInt (x) + parseInt (y) + parseInt (z)+ parseInt (ab) + parseInt (ac) ;    
      $("#qtyng").val(tidakok);  

        var partok  = $("#qtyok").val(); 
        //var partng = $("#ng").val(); 
        var total = parseInt(partok) + parseInt(tidakok);
            $("#qtyrepair").val(total);
        });
    });



  function ambilData()
  {
    var repair_id = $("#part_id").val();    
    if(repair_id == "") {
      $("#partname").val("");
      $("#partno").val("");
      $("#nolot").val("");
      $("#ng").val("");
      $("#dateng").val("");
    } else {
      $.ajax({
        url: base_url + 'Repair/getRepairValueById',
        type: 'post',
        data: {repair_id : repair_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#partname").val(response.nama);
          $("#partno").val(response.nama);
          $("#nolot").val(response.nolotnew);
          $("#ng").val(response.bfng);
          $("#dateng").val(response.waktu);
          
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }
</script>