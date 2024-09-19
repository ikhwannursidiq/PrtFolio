
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>QC </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">QC</li>
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

<div class="col-md-12 ">   
  <div class="box">
          <div class="box-header">
	<form role="form" action="" method="post" id="updateInputForm">
       <div class="form-group">            
       <?php echo validation_errors(); ?>
            <div class="col-sm-5">
                    <label for="deliverydate">Delivery Date</label>
                      <input type="text"  class="form-control"  value="<?php echo  date("j F Y, G:i");?>" id="tgl" name="tgl" placeholder="Enter Date" autocomplete="off">
            </div>
        </div>  
     
       
    <!-- isi part name -->  
    <div class="form-group">            
            <div class="col-sm-3">
                    <label for="deliverydate">Operator Name</label>
                    <select class="form-control select_group product" data-row-id="row_1"  value="<?php echo $input_data['operatorname']; ?>" id="operatorname" name="operatorname" style="width:100%;">
                            <option value=""></option>
                            <option value="Marina">Marina</option>
														<option value="Sahna">Sahna</option>
														<option value="Wafa">Wafa</option>
                            <option value="Nova">Nova</option>
                            <option value="Novi">Novi</option>
                            <option value="Ida">Ida</option>
                            <option value="Yuni">Yuni</option>   
                          </select></div>
    <div class="form-group">            
            <div class="col-sm-5">
                    <label for="deliverydate">Pilih Part Name</label>
                       <select class="form-control select_group customer" id="partname" name="partname" style="width:100%;" onchange="getItemData(1)" >
                       <option value=""></option>
                            <?php foreach ($items as $b => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
          <div class="col-sm-3">
                    <label for="deliverydate">Part Name</label>
                      <input type="text"  class="form-control"  id="nama" value="<?php echo $input_data['nama']; ?>" name="nama" placeholder="Enter nama" >
            </div>
          <div class="col-sm-3">
                    <label for="deliverydate">No Lot</label>
                      <input type="text"  class="form-control"   id="nolot" name="nolot" value="<?php echo $input_data['nolot']; ?>" placeholder="Enter LOT" autocomplete="off">
            </div>
        </div> 
 
<div class="col-sm-12">              
<div class="form-group">  
<h3 >Input Defect Jika Ada</h3>
<div class="col-sm-1">
     <td><label >GORESAN</label></td>        
    <td>
      <input type="text"  class="form-control"  id="goresan" value="<?php echo $input_data['goresan']; ?>" name="goresan" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >TIDAK NEMPEL</label></td>        
    <td>
      <input type="text"  class="form-control"   id="tidaknempel" value="<?php echo $input_data['tidaknempel']; ?>"  name="tidaknempel"  placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >KEBENTUR</label></td>        
    <td>
      <input type="text"  class="form-control"  id="kebentur" value="<?php echo $input_data['kebentur']; ?>"  name="kebentur" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SARINGAN JEBOL</label></td>        
    <td>
      <input type="text" class="form-control"   id="saringanjebol" value="<?php echo $input_data['saringanjebol']; ?>" name="saringanjebol" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >RETAK</label></td>        
    <td>
      <input type="text"  class="form-control"  id="retak" value="<?php echo $input_data['retak']; ?>" name="retak" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>
<div class="col-sm-1">
     <td><label >GELEMBUNG</label></td>        
    <td>
      <input type="text" class="form-control" id="gelembung" value="<?php echo $input_data['gelembung']; ?>" name="gelembung" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BINTIK</label></td>        
    <td>
      <input type="text"  class="form-control"  id="bintik"  value="<?php echo $input_data['bintik']; ?>" name="bintik" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >LUKA DALAM</label></td>        
    <td>
      <input type="text"  class="form-control"  id="lukadalam" value="<?php echo $input_data['lukadalam']; ?>" name="lukadalam" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >LUKA LUAR</label></td>        
    <td>
      <input type="text"  class="form-control"  id="lukaluar" value="<?php echo $input_data['lukaluar']; ?>" name="lukaluar" placeholder="Enter Goresan" autocomplete="off">
    </td>
    

</div>

<div class="col-sm-1">
     <td><label >BERGARIS</label></td>        
    <td>
      <input type="text"  class="form-control"   id="bergaris" value="<?php echo $input_data['bergaris']; ?>" name="bergaris" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >Hose Pendek</label></td>        
    <td>
      <input type="text"  class="form-control"  id="hosependek" value="<?php echo $input_data['hosependek']; ?>" name="hosependek" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >OVER</label></td>        
    <td>
      <input type="text" class="form-control"   id="oper" value="<?php echo $input_data['oper']; ?>" name="oper" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >WRAPPINGAN</label></td>        
    <td>
      <input type="text"  class="form-control"  id="wrappingan" value="<?php echo $input_data['wrappingan']; ?>" name="wrappingan" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>
<div class="col-sm-1">
     <td><label >BRAIDINGAN</label></td>        
    <td>
      <input type="text" class="form-control" id="braidingan" value="<?php echo $input_data['braidingan']; ?>" name="braidingan" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BOLONG</label></td>        
    <td>
      <input type="text"  class="form-control"  id="bolong" value="<?php echo $input_data['bolong']; ?>" name="bolong" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >TIPIS</label></td>        
    <td>
      <input type="text"  class="form-control"  id="tipis"  value="<?php echo $input_data['tipis']; ?>" name="tipis" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >KARET NEMPEL</label></td>        
    <td>
      <input type="text" class="form-control"   id="karetnempel" value="<?php echo $input_data['karetnempel']; ?>" name="karetnempel" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>

<div class="col-sm-1">
     <td><label >TEBAL</label></td>        
    <td>
      <input type="text"  class="form-control"  id="tebal" value="<?php echo $input_data['tebal']; ?>" name="tebal" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >PORISITI</label></td>        
    <td>
      <input type="text"  class="form-control"  id="porisiti" value="<?php echo $input_data['porisiti']; ?>" name="porisiti" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BEKAS TANGAN </label></td>        
    <td>
      <input type="text" class="form-control"   id="bekastangan"  value="<?php echo $input_data['bekastangan']; ?>" name="bekastangan" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SOBEK</label></td>        
    <td>
      <input type="text" class="form-control"   id="sobek" value="<?php echo $input_data['sobek']; ?>" name="sobek" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>

<div class="col-sm-1">
     <td><label >OVAL</label></td>        
    <td>
      <input type="text"  class="form-control"   id="oval" value="<?php echo $input_data['oval']; ?>" name="oval" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >BENANG RUSAK</label></td>        
    <td>
      <input type="text" class="form-control"  id="benangrusak" value="<?php echo $input_data['benangrusak']; ?>" name="benangrusak" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SIWAK</label></td>        
    <td>
      <input type="text"  class="form-control"  id="siwak" value="<?php echo $input_data['siwak']; ?>" name="siwak" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >KEROPOS</label></td>        
    <td>
      <input type="text"  class="form-control"   id="keropos"  value="<?php echo $input_data['keropos']; ?>"name="keropos" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>


<div class="col-sm-1">
     <td><label >HOLE TUBE</label></td>        
    <td>
      <input type="text"  class="form-control"  id="holetube" value="<?php echo $input_data['holetube']; ?>" name="holetube" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >SPRING PENDEK</label></td>        
    <td>
      <input type="text"  class="form-control"   id="springpendek" value="<?php echo $input_data['springpendek']; ?>" name="springpendek" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >DIAMETER KECIL</label></td>        
    <td>
      <input type="text"  class="form-control" id="diameterkecil" value="<?php echo $input_data['diameterkecil']; ?>" name="diameterkecil" placeholder="Enter Goresan" autocomplete="off">
    </td>
    <td><label >LAIN-LAIN</label></td>        
    <td>
      <input type="text"  class="form-control"   id="others" value="<?php echo $input_data['others']; ?>" name="others" placeholder="Enter Goresan" autocomplete="off">
    </td>

</div>


<div class="col-md-3 pull pull-right">

<div class="form-group">
<label for="ok" class="col-sm-3 control-label">Part OK</label>                  
<label class="btn btn-success active">
    <input type="text" class="form-control"  id="ok"  value="<?php echo $input_data['ok']; ?>"name="ok" placeholder="Enter ok" autocomplete="off">
  </label>    


</div>

<div class="form-group">
<label for="ok" class="col-sm-3 control-label">Part NG</label>         
<label class="btn btn-danger active">
    <input type="text"  class="form-control"  id="ng" value="<?php echo $input_data['ng']; ?>" name="ng" placeholder="Enter ng" autocomplete="off">
  </label>    
  </div>
<div class="form-group">
<label for="ok" class="col-sm-3 control-label">Total</label>         
<label class="btn btn-warning active">
    <input type="text"  class="form-control" id="total" name="total" value="<?php echo $input_data['total']; ?>" placeholder="Enter total" autocomplete="off">
  </label>    
  </div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
  
<a href="<?php echo base_url('inputs/') ?>" class="btn btn-warning">Back</a>
		       <button type="submit" class="btn btn-primary">Save changes</button>
           </div>
      </form> 
</div>
</div>




</section>
  </div><!-- /.modal-dialog -->



<script type="text/javascript">
$(document).ready(function() {
    $(".select_group").select2();
  //  $("#description").wysihtml5();
  $("#mainItemNav").addClass('active');
    $("#addItemNav").addClass('active');
    
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
        $("#ok, #ng, #goresan, #tidaknempel, #kebentur, #saringanjebol, #gelembung, #bintik, #lukadalam, #lukaluar, #retak, #bergaris, #hosependek, #over, #wrappingan, #braidingan, #bolong, #tipis, #karetnempel, #tebal, #porisiti, #bekastangan, #sobek, #oval, #benangrusak, #siwak, #keropos, #holetube, #springpendek, #diameterkecil, #others ").keyup(function() { 
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
   var k =  $("#over").val();
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
   var kecil = $("#diameterkecil").val();
   var others = $("#others").val();
   var tidakok = parseInt(gores) + parseInt (a)   + parseInt (others)  + parseInt (kecil) + parseInt (b) + parseInt (c) + parseInt (d) + parseInt (e) + parseInt (f) + parseInt (g) + parseInt (h) + parseInt (i) + parseInt (j) + parseInt (k) + parseInt (l) + parseInt (m) + parseInt (n) + parseInt (o) + parseInt (p) + parseInt (q) + parseInt (r) + parseInt (s) + parseInt (t) + parseInt (u) + parseInt (v) + parseInt (w) + parseInt (x) + parseInt (y) + parseInt (z) ;    
      $("#ng").val(tidakok);  

        var partok  = $("#ok").val(); 
        //var partng = $("#ng").val(); 
        var total = parseInt(partok) + parseInt(tidakok);
            $("#total").val(total);
        });
    });

  
//var manageTable;

//$(document).ready(function() {

//  $("#inputNav").addClass('active');

  // initialize the datatable 
 // manageTable = $('#manageTable').DataTable({
  //  'ajax': 'fetchInputData',
  //  'input': []
  //});

  // submit the create from 
  //$("#createInputForm").unbind('submit').on('submit', function() {
    //var form = $(this);

    // remove the text-danger
   // $(".text-danger").remove();

    //$.ajax({
    //  url: form.attr('action'),
     // type: form.attr('method'),
    //  data: form.serialize(), // /converting the form data into array and sending it to server
    //  dataType: 'json',
     // success:function(response) {

    //    manageTable.ajax.reload(null, false); 

    //    if(response.success === true) {
   //       $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
    //        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
    //        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
   //       '</div>');


          // hide the modal
    //      $("#addBrandModal").modal('hide');

          // reset the form
     //     $("#createInputForm")[0].reset();
   //       $("#createInputForm .form-group").removeClass('has-error').removeClass('has-success');

    //    } else {
//
      //    if(response.messages instanceof Object) {
       //     $.each(response.messages, function(index, value) {
     //         var id = $("#"+index);
//
      //        id.closest('.form-group')
     //         .removeClass('has-error')
      //        .removeClass('has-success')
      //        .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
        //      id.after(value);

       //     });
       //   } else {
          //     $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
         //      $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
      //        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
          //       '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
         //      '</div>');
       //    //     }
     //      }
      //   }
    //   }); 

    //   return false;
    //   // });


   //});

function getItemData()
  {
    var item_id = $("#partname").val();    
    if(item_id == "") {
  $("#nama").val("");
    } else {
     $.ajax({
      url: 'http://localhost/purchase/Inputs/getItemValueById',//'http://192.168.100.12/qc/Inputs/getItemValueById', //base_url+'Inputs/getItemValueById',
        type: 'post',
        data: {item_id : item_id},
      dataType: 'json',
        success:function(response) { 
    $("#nama").val(response.name);		
		}  
      }); 
  }
  }




function removeInput(id)
{
  if(id) {
    $("#removeInputForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { input_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeBrandModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}

</script>
