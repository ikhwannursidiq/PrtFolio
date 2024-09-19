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

.col1 {display: none; }
.col2 {display: none; }
.col3 {display: none; }


.block {
  display: block;
 
  border: none;
  background-color: #04AA6D;
  color: white;
 
  font-size: 46px;
  cursor: pointer;
  text-align: center;
	margin-left: auto;


  border-radius: 25px;

  background-position: left top;
  background-repeat: repeat;
  padding: 20px;
  width: 200px;
  height: 150px;
 
}

.block:hover {
  background-color: #ddd;
  color: black;
}




.custom-select {
  position: relative;
  font-family: calibri;
  background-color: orange;
  text-align: center;
  width: 80px;
  height: 50px;
  font-size: 16px;
  border-radius: 15px;
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
                <tbody>
                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">Number ID</label></td>
                    <td>
                    <input type="number" class="form-control" id="nourut" name="nourut" value="<?php echo $nourut ?>" placeholder="Enter numer id" autocomplete="off" required disabled>
                    <input type="hidden" class="form-control" id="nourut" name="nourut" value="<?php echo $nourut ?>" placeholder="Enter numer id" autocomplete="off" required >
                   
                  </td>
                </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">No Surat Jalan</label></td>
                    <td>
                    <input type="text" class="form-control" id="nosj" name="nosj" placeholder="Enter Surat Jalan" autocomplete="off" required>
                    </td>
                </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">Select Supplier</label></td>
                    <td> <select class="form-control select_group" id="supplier" name="supplier">
                    <?php foreach ($supplier as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select></td>
                </tr>

                <tr class="active-row">
                    <td  class="active-row"><label for="telp">Select Compound</label></td>
                    <td> 
                    <select class="form-control select_group"  id="namecompound" name="namecompound" onchange="getMaterial()" required>
                    <?php foreach ($material as $k => $m): ?>
                      <option value="<?php echo $m['id'] ?>"><?php echo $m['matname'] ?></option>
                    <?php endforeach ?>
                    </select>
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">Name Compound</label></td>
                    <td>
                    <input type="text" class="form-control" id="namecomp" name="namecomp" placeholder="Enter code" autocomplete="off" required>
                    </td>
                </tr> 
                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">Code Compound</label></td>
                    <td>
                    <input type="text" class="form-control" id="codecompound" name="codecompound" placeholder="Enter code" autocomplete="off" required>
                    </td>
                </tr>

               

                <tr class="active-row">
                    <td  class="active-row">    <label for="telp">No LOT</label></td>
                    <td> <input type="text" class="form-control" id="nolot" name="nolot" placeholder="Enter No lot" autocomplete="off" required>
                    </td>
                </tr>
<!--
                <tr class="active-row">
                   <td  class="active-row">  <label for="fax">Qty Compound (kg)</label></td>
                    <td> <input type="number" class="form-control" id="qtycompound" name="qtycompound" placeholder="Enter Qty (KG)" autocomplete="off" required> </td>
                </tr>
                    -->
                <tr class="active-row">
                   <td  class="active-row"> <label for="alamat">Incoming Date</label></td>
                    <td> <input type="date" class="form-control"id="incomingdate" name="incomingdate" placeholder="Enter Qty" autocomplete="off" required> </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row">  <label for="telp">Expired date</label></td>
                    <td> <input type="date" class="form-control" id="expireddate" name="expireddate" placeholder="Enter Qty" autocomplete="off" required></td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row">  <label for="telp">Active St</label></td>
                    <td> <select class="form-control" id="active" name="active">
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                 </select></td>
                </tr>

        <!-- and so on... -->
                </tbody>
                </table>

        </div>
        <div class="col-md-8 col-xs-12 pull pull-left">
         
        <table class="styled-table">
                <thead>
                <tr>
                    <th width="25%" >Check Point</th>
                    <th width="20%">Standard</th>
                    <th width=""></th>
                    <th width=""></th>
                    <th width="15%">Actual</th>
                    <th width="15%">Status</th>
                    <th width="15%">Trigger Result</th>
                   
                </tr>
                </thead>
                <tbody>
                <tr class="active-row">
                    <td  class="active-row"> <label for="telp">QTY</label></td>
                    <td width="10%"><input type="text" class="form-control" id="bmstd" name="bmstd"  onchange="statusQty()" autocomplete="off" ></td>
                    <td width="0%" ><input type="hidden" class="form-control" id="bmmin" name="bmmin"  onchange="statusQty()" autocomplete="off" ></td>
                    <td width="0%"><input type="hidden" class="form-control" id="bmmax" name="bmmax"  onchange="statusQty()" autocomplete="off" ></td>
                    <td width="15%"><input type="text" class="form-control" id="bmact" name="bmact" onchange="statusQty()" autocomplete="off" ></td>
                    <td width="18%"><select class="form-control" id="bmst" name="bmst" DISABLED>
                     
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>  
                 <!--     <td><input type="text" class="form-control" id="bmst_value" name="bmst_value" value="0" onBlur="statusres()" autocomplete="off"></td>  -->
                  <td  width="0%"><select  class="custom-select" id="bmst_value" name="bmst_value" onchange="statusres()" >
                     
                        <option value="1">ON </option>
                        <option value="0">OFF</option>
                        </select>
                    </td> 
                  </tr>




                <tr class="active-row">
                    <td  class="active-row"> <label for="telp">HS</label></td>
                    <td width="10%"><input type="text" class="form-control" id="hsstd" name="hsstd"  onchange="statusCompound()" autocomplete="off" ></td>
                    <td width="0%" ><input type="hidden" class="form-control" id="hsmin" name="hsmin"  onchange="statusCompound()" autocomplete="off" ></td>
                    <td width="0%"><input type="hidden" class="form-control" id="hsmax" name="hsmax"  onchange="statusCompound()" autocomplete="off" ></td>
                    <td width="15%"><input type="text" class="form-control" id="hsact" name="hsact" onchange="statusCompound()" autocomplete="off" ></td>
                    <td width="18%"><select class="form-control" id="hsst" name="hsst" DISABLED>
                     
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>  
                    <td  width="0%"><select  class="col1" id="hsst_value" name="hsst_value" >
                     
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>  
                   </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">TENSILE BREAK (TB)</label></td>
                    <td><input type="text" class="form-control" id="tbstd" name="tbstd" onchange="statustb()" autocomplete="off"></td>
                    <td><input type="hidden" class="form-control" id="tbmin" name="tbmin" onchange="statustb()" autocomplete="off"></td>
                    <td><input type="hidden" class="form-control" id="tbmax" name="tbmax" onchange="statustb()" autocomplete="off"></td>
                    <td><input type="text" class="form-control" id="tbact" name="tbact" onchange="statustb()" autocomplete="off"></td>
                    <td><select class="form-control" id="tbst" name="tbst" DISABLED>
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>

                    <td><select  class="col1" class="form-control" id="tbst_value" name="tbst_value" >
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td> 
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">ELONGATION BREAK (EB)</label></td>
                    <td><input type="text" class="form-control" id="ebstd" name="ebstd" onchange="statuseb()" autocomplete="off"></td>
                    <td><input type="hidden" class="form-control" id="ebmin" name="ebmin"  onchange="statuseb()" autocomplete="off"></td>
                    <td><input type="hidden" class="form-control" id="ebmax" name="ebmax"  onchange="statuseb()" autocomplete="off"></td>
                    <td><input type="text" class="form-control" id="ebact" name="ebact"  onchange="statuseb()" autocomplete="off"></td>
                    <td><select class="form-control" id="ebst" name="ebst" DISABLED>
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>

                    <td><select  class="col1" class="form-control" id="ebst_value" name="ebst_value" >
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td> 
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">SPESIFIC GRAFITY</label></td>
                    <td><input type="text" class="form-control" id="sgstd" name="sgstd" onchange="statussg()" autocomplete="off"></td>
                    <td><input type="hidden" class="form-control" id="sgmin" name="sgmin" onchange="statussg()" autocomplete="off"></td>
                    <td><input type="hidden" class="form-control" id="sgmax" name="sgmax" onchange="statussg()" autocomplete="off"></td>
                    <td><input type="text" class="form-control" id="sgact" name="sgact" onchange="statussg()" autocomplete="off"></td>
                    <td><select class="form-control" id="sgst" name="sgst" DISABLED>
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>

                   <td><select  class="col1" class="form-control" id="sgst_value" name="sgst_value" >
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td> 
                </tr>
        <!-- and so on... -->
                </tbody>
                </table>      
        </div>        
        <div class="col-md-6 col-xs-12 pull pull-left">
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
                <option value="Aang">Aang</option>
                <option value="Nani">Nani</option>
         </select></td>
        </tr>
        <input type="hidden" class="form-control" value=""  id="nilai"  name="nilai"  autocomplete="off"> 
        <input type="hidden" class="form-control" value=""  id="nilai_value"  name="nilai_value"  autocomplete="off">            
          
        <input type="hidden" class="block" id="res" name="res" onchange="statusres()" autocomplete="off"> </td>
        <input type="text" class="block" id="res_value" name="res_value"  onchange="statusres()" autocomplete="off" required> </td>  
       
        <!--
        <tr class="active-row">
           <td  class="active-row">  <label for="telp">Result</label></td>
            <td> <select class="form-control" id="resultold" name="resulmt">
            <td><input type="number" class="form-control" id="result" name="result"  onchange="result()" autocomplete="off"></td>
              
                <option value="1">OK</option>
                <option value="2">NG</option>
                <option value="3">HOLD</option>
         </select></td>
        </tr>
 and so on... -->

          <div class="col-md-8 col-xs-12 pull-right">
          </div>
 
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

    </div> 
  </section>



  <!-- /.content -->
</div>

<section>



                    </section>



<!-- /.content-wrapper -->


<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

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


function getMaterial()
{
  var material_id = $("#namecompound").val();
  if(material_id == "") {
      $("codecompound").val("");
      $("hsstd").val("");
      $("namecomp").val("");
      $("tbstd").val("");
      $("hsmin").val("");
      $("hsmax").val("");
      $("tbmin").val("");
      $("tbmax").val("");
      $("ebmin").val("");
      $("ebmax").val("");
      $("sgmin").val("");
      $("sgmax").val("");
      $("ebstd").val("");
      $("sgstd").val("");
      $("bmmin").val("");
      $("bmmax").val("");
      $("bmstd").val("");
  } else {
    $.ajax ({
      url: base_url + 'Compound/getMaterialById',
      type : 'post', 
      data :{ material_id:material_id}, 
     
      dataType :'json',
      success:function (response) {
        $("#codecompound").val(response.codematerial);
        $("#namecomp").val(response.matname);
        $("#hsstd").val(response.hs);
        $("#tbstd").val(response.tb);
        $("#hsmin").val(response.hsmin);
        $("#hsmax").val(response.hsmax);
        $("#ebstd").val(response.eb);
        $("#sgstd").val(response.sg);
        $("#tbmin").val(response.tbmin);
        $("#tbmax").val(response.tbmax);
        $("#ebmin").val(response.ebmin);
        $("#ebmax").val(response.ebmax);
        $("#sgmin").val(response.sgmin);
        $("#sgmax").val(response.sgmax);
        $("#bmmin").val(response.bmmin);
        $("#bmmax").val(response.bmmax);
        $("#bmstd").val(response.bm);
        
      }

    });

  }
   
}

function statusQty() {
 // var hsstd = $("#hsstd").val();
  var bmact = $("#bmact").val();
  var bmmax = $("#bmmax").val();
  var bmmin = $("#bmmin").val();
  var OK = '1';
  var NG = '0';
  var cobalge = '2';
    if(bmact === bmmin) {
      var hasil = OK;
    } else if (bmact === bmmax) {
    var hasil = OK; 
    } else if (bmact > bmmax) {
    var hasil = NG; 
    } else if (bmact < bmmin) {
    var hasil = NG; 
    } else if (bmact > bmmin) {
    var hasil = OK; 
    } else if (bmact < bmmax) {
    var hasil = OK; 
    } else {
      var hasil = cobalge; 
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusQty, 1);
        $("#bmst").val(hasil); 
        $("#bmst_value").val(hasil); 
      }
    });
  }

function statusCompound() {
 // var hsstd = $("#hsstd").val();
  var hsact = $("#hsact").val();
  var hsmax = $("#hsmax").val();
  var hsmin = $("#hsmin").val();
  var OK = '1';
  var NG = '0';
  var cobalge = '2';
    if(hsact === hsmin) {
      var hasil = OK;
    } else if (hsact === hsmax) {
    var hasil = OK; 
    } else if (hsact > hsmax) {
    var hasil = NG; 
    } else if (hsact < hsmin) {
    var hasil = NG; 
    } else if (hsact > hsmin) {
    var hasil = OK; 
    } else if (hsact < hsmax) {
    var hasil = OK; 
    } else {
      var hasil = cobalge; 
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#hsst").val(hasil); 
        $("#hsst_value").val(hasil); 
      }
    });
  }


  function statustb() {
  var tbmin = $("#tbmin").val();
  var tbmax = $("#tbmax").val();
  var tbact = $("#tbact").val();
  var OK = '1';
  var NG = '0';
  if(tbact === tbmin) {
      var hasil = OK;
    } else if (tbact === tbmax) {
    var hasil = OK; 
    } else if (tbact < tbmax) {
    var hasil = NG; 
    } else if (tbact < tbmin) {
    var hasil = NG; 
    } else if (tbact > tbmin) {
    var hasil = OK; 
    } else if (tbact > tbmax) {
    var hasil = OK; 
    } else {
      var hasil = cobalge; 
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#tbst").val(hasil); 
        $("#tbst_value").val(hasil); 
      }
    });
  }



  function statuseb() {
  var ebmin = $("#ebmin").val();
  var ebmax = $("#ebmax").val();
  var ebact = $("#ebact").val();
  var OK = '1';
  var NG = '0';
  if(ebact === ebmin) {
      var hasil = OK;
    } else if (ebact === ebmax) {
    var hasil = OK; 
    } else if (ebact < ebmax) {
    var hasil = NG; 
    } else if (ebact < ebmin) {
    var hasil = NG; 
    } else if (ebact > ebmin) {
    var hasil = OK; 
    } else if (ebact > ebmax) {
    var hasil = OK; 
    } else {
      var hasil = cobalge; 
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#ebst").val(hasil); 
        $("#ebst_value").val(hasil); 
      }
    });
  }


  function statussg() {
  var sgmin = $("#sgmin").val();
  var sgmax = $("#sgmax").val();
  var sgact = $("#sgact").val();
  var OK = '1';
  var NG = '0';
  if(sgact === sgmin) {
      var hasil = OK;
    } else if (sgact === sgmax) {
    var hasil = OK; 
    } else if (sgact > sgmax) {
    var hasil = NG; 
    } else if (sgact < sgmin) {
    var hasil = NG; 
    } else if (sgact > sgmin) {
    var hasil = OK; 
    } else if (sgact < sgmax) {
    var hasil = OK; 
    } else {
      var hasil = cobalge; 
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#sgst").val(hasil); 
        $("#sgst_value").val(hasil); 
      }
    });
  }


  function statusres() {
  var sgv = $("#sgst_value").val();
  var tbv = $("#tbst_value").val();
  var ebv = $("#ebst_value").val();
  var hsv = $("#hsst_value").val();
  var bmv = $("#bmst_value").val();
  var nilai = $("#nilai_value").val();
   var jumlah = (Number(sgv)+Number(tbv)+Number(ebv)+Number(hsv)+Number(bmv));
     jumlah = jumlah.toFixed(1);
    $("#nilai").val(jumlah);
    $("#nilai_value").val(jumlah);

  var OK = 'OK';
  var NG = 'NG';
  var cobalge = 'UNKNOW';
  if(nilai == 5) {
      var hasil = OK;
    } else if (nilai < 5) {
    var hasil = NG; 
    } else {
      var hasil = cobalge; 
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusres, 1);
        $("#res").val(hasil); 
        $("#res_value").val(hasil); 
      }
      
    });
  }

</script>