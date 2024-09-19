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
                <tbody>
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
                    <td  class="active-row"><label for="telp">Name Compound</label></td>
                    <td> 
                    <select class="form-control select_group"  id="namecompound" name="namecompound" onchange="getMaterial()" required>
                    <?php foreach ($material as $k => $m): ?>
                      <option value="<?php echo $m['id'] ?>"><?php echo $m['matname'] ?></option>
                    <?php endforeach ?>
                    </select>
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

                <tr class="active-row">
                   <td  class="active-row">  <label for="fax">Qty Compound (kg)</label></td>
                    <td> <input type="number" class="form-control" id="qtycompound" name="qtycompound" placeholder="Enter Qty (KG)" autocomplete="off" required> </td>
                </tr>

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
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">HS</label></td>
                    <td><input type="text" class="form-control" id="hsstd" name="hsstd"  onchange="statusCompound()" autocomplete="off" ></td>
                    <td><input type="text" class="form-control" id="hsact" name="hsact" onchange="statusCompound()" autocomplete="off" ></td>
                    <td><select class="form-control" id="hsst" name="hsst">
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>       </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">TENSILE BREAK (TB)</label></td>
                    <td><input type="text" class="form-control" id="tbstd" name="tbstd" onchange="statustb()" autocomplete="off"></td>
                    <td><input type="text" class="form-control" id="tbact" name="tbact" onchange="statustb()" autocomplete="off"></td>
                    <td><select class="form-control" id="tbst" name="tbst">
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">ELONGATION BREAK (EB)</label></td>
                    <td><input type="text" class="form-control" id="ebstd" name="ebstd" onchange="statuseb()" autocomplete="off"></td>
                    <td><input type="text" class="form-control" id="ebact" name="ebact"  onchange="statuseb()" autocomplete="off"></td>
                    <td><select class="form-control" id="ebst" name="ebst">
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">SPESIFIC GRAFITY</label></td>
                    <td><input type="text" class="form-control" id="sgstd" name="sgstd" onchange="statussg()" autocomplete="off"></td>
                    <td><input type="text" class="form-control" id="sgact" name="sgact" onchange="statussg()" autocomplete="off"></td>
                    <td><select class="form-control" id="sgst" name="sgst">
                        <option value="1">OK</option>
                        <option value="0">NG</option>
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
      $("tbstd").val("");
      $("ebstd").val("");
      $("sgstd").val("");
  } else {
    $.ajax ({
      url: base_url + 'Compound/getMaterialById',
      type : 'post', 
      data :{ material_id:material_id}, 
     
      dataType :'json',
      success:function (response) {
        $("#codecompound").val(response.codematerial);
        $("#hsstd").val(response.hs);
        $("#tbstd").val(response.tb);
        $("#ebstd").val(response.eb);
        $("#sgstd").val(response.sg);
        
      }

    });

  }
   
}



function statusCompound() {
  var hsstd = $("#hsstd").val();
  var hsact = $("#hsact").val();
  var OK = '1';
  var NG = '0';
    if(hsact == hsstd) {
      var hasil = OK;
 
    } else if (hsact > hsstd) {
    var hasil = NG; 
    } else {
      alert('no row !! please refresh the page');
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#hsst").val(hasil); 
      }
    });
  }


  function statustb() {
  var tbstd = $("#tbstd").val();
  var tbact = $("#tbact").val();
  var OK = '1';
  var NG = '0';
    if(tbact == tbstd) {
      var hasil = OK;
   
    } else if (tbact > tbstd) {
    var hasil = NG; 
    } else {
      alert('no row !! please refresh the page');
    }

    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#tbst").val(hasil); 
      }
    });
  }


  function statuseb() {
  var ebstd = $("#ebstd").val();
  var ebact = $("#ebact").val();
  var OK = '1';
  var NG = '0';
    if(ebact == ebstd) {
      var hasil = OK;
    
    } else if (ebact > ebstd) {
    var hasil = NG; 
    } else {
      alert('no row !! please refresh the page');
    }
 
    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#ebst").val(hasil); 
      }
    });
  }


  function statussg() {
  var sgstd = $("#sgstd").val();
  var sgact = $("#sgact").val();
  var OK = '1';
  var NG = '0';
    if(sgact == sgstd) {
      var hasil = OK;
    
    } else if (sgact > sgstd) {
    var hasil = NG; 
    } else {
      alert('no row !! please refresh the page');
    }
  
    $.ajax ({
       success:function(data) {
        window.setTimeout(statusCompound, 1);
        $("#sgst").val(hasil); 
      }
    });
  }


  function result() {
 
   
    var total = 0;
    var total = $("#hsst").val(hasil) + $("#sgst").val(hasil) + $("#ebst").val(hasil) + $("#tbst").val(hasil);
  
        $("#result").val(total); 
      }
   
  































</script>