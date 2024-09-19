

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Prod Inspection Standard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">P.I.S</li>
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
            <h3 class="box-title">Add Production Inspection Standard</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
              <div class="col-md-4 col-xs-12 pull pull-left">
                <div class="form-group">
                  <label for="sku">Part No</label>
                  <input type="text" class="form-control" id="nopart" name="nopart" placeholder="Enter No Part" autocomplete="off" />
                </div>
              
                <div class="form-group">
                  <label for="product_name">Part Name</label>
                  <input type="text" class="form-control" id="namepart" name="namepart" placeholder="Enter product name" autocomplete="off"/>
                </div>
             
                <div class="form-group">
                  <label for="price">Material</label>
                  <input type="text" class="form-control" id="material" name="material" placeholder="Enter mix" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">TIPE</label>
                  <input type="text" class="form-control" id="material" name="tipe" placeholder="tipe" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">Customer Name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter price" autocomplete="off" />
                </div>
              
              </div>
              <div class="col-md-4 col-xs-12 ">
              <div class="form-group">
                  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

        </div>

              </div>


              <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">ITEM PERIKSA </th>
                      <th style="width:20%">STANDARD</th>
                      <th style="width:10%">FREKUENSI</th>
                      <th style="width:10%">METODE</th>
                     
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                        <td>
                        <!--  <input type="text" name="product[]" id="product_1" class="form-control"> 
                        
                          <select class="form-control select_group product" data-row-id="row_1" id="product[]" name="product_1" style="width:100%;">
                            <option value="Inner Diameter 1">Inner Diameter 1</option>
                            <option value="Outher Diameter 1">Outher Diameter 1</option>
							              <option value="Thickness 1">Thickness 1</option>
							              <option value="Inner Diameter 2">Inner Diameter 2</option>
                            <option value="Outher Diameter 2">Outher Diameter 2</option>
                            <option value="Thickness 2">Thickness 2</option>
                            <option value="Lenght">Lenght</option>
                            <option value="Marking Part Number">Marking Part Number</option>   
                            <option value="Marking No Lot">Marking No Lot</option>   
                            <option value="Hardness">Hardness</option>   
                            <option value="Apperance hose">Apperance hose</option>   
                          </select>
                       
                        </td>
                        <td><input type="text" name="standard[]" id="standard_1" class="form-control"></td>
                        <td><input type="text" name="metode[]" id="metode_1" class="form-control" ></td>
                        <td><input type="text" name="frekuensi[]" id="frekuensi_1" class="form-control" ></td>
                        
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td> -->
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>

                <table class="table table-bordered" id="titel_info_table">

                  <thead>
                <tr>
                      <th style="font-size:20px" align="center"  clospan="5" >Physical properties of Rubber EPDM </th>
                  
        </tr> 
        </thead>

                  
        </table>
        <br /> <br/>

<table class="table table-bordered" id="inc_info_table">
  <thead>
    <tr>
      <th style="width:20%">Judul Phisycal properties</th>
      <th style="width:20%">Standard</th>
      <th style="width:10%">Frekuensi</th>
      <th style="width:8%">Metode</th>
  
      <th style="width:10%"><button type="button" id="inc_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
    </tr>
  </thead>

   <tbody>
     <tr id="row_1">
      
        <td>
          <input type="text" name="incitem[]" id="incitem_1" class="form-control" >
         </td>
        <td><input type="hidden" name="incstandard[]" id="incstandard_1" class="form-control"  ></td>
        <td>
          <input type="hidden" name="incfrekuensi[]" id="incfrekuensi_1" class="form-control" >
        </td>
        <td>
          <input type="hidden" name="incmetode[]" id="incmetode_1" class="form-control" >
        </td>
        <td><button type="button" class="btn btn-default" onclick="removeInc('1')"><i class="fa fa-close"></i></button></td>
     </tr>
   </tbody>
</table>

                <br /> <br/>

                <table class="table table-bordered" id="cs_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">Judul Phisycal properties</th>
                      <th style="width:20%">Standard</th>
                      <th style="width:10%">Frekuensi</th>
                      <th style="width:8%">Metode</th>
                  
                      <th style="width:10%"><button type="button" id="cs_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                      
                        <td>
                          <input type="text" name="csitem[]" id="csitem_1" class="form-control" >
                         </td>
                        <td><input type="hidden" name="csstandard[]" id="csstandard_1" class="form-control"  ></td>
                        <td>
                          <input type="hidden" name="csfrekuensi[]" id="csfrekuensi_1" class="form-control" >
                        </td>
                        <td>
                          <input type="hidden" name="csmetode[]" id="csmetode_1" class="form-control" >
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeCs('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>














<!--




        <table class="table table-bordered" id="cs_info_table">
                    <tr>
                      <th>Commpresion Seet</th>
                      <th>add</th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_0">
                     <td style="width:20%">Comppresion Sheet (Comppresion Sheet)<input type="text" name="csitem" id="csitem_0" class="form-control"> </td>
                     <td style="width:20%">Comppresion Sheet (Comppresion Sheet)<input type="text" name="csstandard" id="csstandard_0" class="form-control"> </td>
                     <td style="width:20%">Comppresion Sheet (Comppresion Sheet)<input type="text" name="csfrekuensi" id="csfrekuensi_0" class="form-control"> </td>
                     <td style="width:20%">Comppresion Sheet (Comppresion Sheet)<input type="text" name="csmetode" id="csmetode_0" class="form-control"> </td>
                     <td style="width:20%"><button type="button" id="cs_row" class="btn btn-default"><i class="fa fa-plus"></i></button></td>

                     </tr>
                   </tbody>
        </table>
        -->
                <br /> <br/>




             
                <table class="table table-bordered" id="qc_info_table">
                  <thead>
                  <tr>
                      <th style="width:20%">Quality Hose / Test Product </th>
                 
                   
                    </tr>
                    <tr>
                      <td style="width:20%">ITEM PERIKSA </td>
                      <td style="width:20%">STANDARD</td>
                      <td style="width:10%">FREKUENSI</td>
                      <td style="width:10%">METODE</td>
                     
                      <th style="width:10%"><button type="button" id="qc_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                        <td>
                        <!--  <input type="text" name="product[]" id="product_1" class="form-control"> 
                        
                          <select class="form-control select_group product" data-row-id="row_1" id="product[]" name="product_1" style="width:100%;">
                            <option value="Inner Diameter 1">Inner Diameter 1</option>
                            <option value="Outher Diameter 1">Outher Diameter 1</option>
							              <option value="Thickness 1">Thickness 1</option>
							              <option value="Inner Diameter 2">Inner Diameter 2</option>
                            <option value="Outher Diameter 2">Outher Diameter 2</option>
                            <option value="Thickness 2">Thickness 2</option>
                            <option value="Lenght">Lenght</option>
                            <option value="Marking Part Number">Marking Part Number</option>   
                            <option value="Marking No Lot">Marking No Lot</option>   
                            <option value="Hardness">Hardness</option>   
                            <option value="Apperance hose">Apperance hose</option>   
                          </select>
                       
                        </td>
                        <td><input type="text" name="standard[]" id="standard_1" class="form-control"></td>
                        <td><input type="text" name="metode[]" id="metode_1" class="form-control" ></td>
                        <td><input type="text" name="frekuensi[]" id="frekuensi_1" class="form-control" ></td>
                        
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td> -->
                     </tr>
                   </tbody>
                </table>











                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
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

    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
      // Add new row in the table 
     
  

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


    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   
                //    '<td>'+ 
                //    '<select class="form-control select_group product" data-row-id="row_'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+                       
                //        '<option value="Inner Diameter 1">Inner Diameter 1</option>'+
                //        '<option value="Outher Diameter 1">Outher Diameter 1</option>'+
                //        '<option value="Thickness 1">Thickness 1</option>'+
                //        '<option value="Inner Diameter 2">Inner Diameter 2</option>'+
                //        ' <option value="Outher Diameter 2">Outher Diameter 2</option>'+
                //        '<option value="Thickness 2">Thickness 2</option>'+
                //        '<option value="Lenght">Lenght</option>'+
                //        '<option value="Marking Part Number">Marking Part Number</option>'+
                //        '<option value="Marking No Lot">Marking No Lot</option>'+
                //        '<option value="Hardness">Hardness</option>'+
                //        '<option value="Apperance hose">Apperance hose</option>'
                        
                //      html += '</select>'+
                 //   '</td>'+    
                 '<td><input type="text" name="product[]" id="product_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="standard[]" id="standard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="frekuensi[]" id="frekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="metode[]" id="metode_'+row_id+'" class="form-control" ></td>'+
                   
                  
                    '<td> <button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });


    $("#inc_row").unbind('click').bind('click', function() {
      var table = $("#inc_info_table");
      var count_table_tbody_tr = $("#inc_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                  '<td><input type="text" name="incitem[]" id="incitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="incstandard[]" id="incstandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="incfrekuensi[]" id="incfrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="incmetode[]" id="incmetode_'+row_id+'" class="form-control" ></td>'+
                   
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowInc(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#inc_info_table tbody tr:last").after(html);  
              }
              else {
                $("#inc_info_table tbody").html(html);
              }

              $(".incsatu").select2();

          }
        });

      return false;
    });





    $("#cs_row").unbind('click').bind('click', function() {
      var table = $("#cs_info_table");
      var count_table_tbody_tr = $("#cs_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                    '<td><input type="text" name="csitem[]" id="csitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="csstandard[]" id="csstandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="csfrekuensi[]" id="csfrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="csmetode[]" id="csmetode_'+row_id+'" class="form-control" ></td>'+
                            
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowCs(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#cs_info_table tbody tr:last").after(html);  
              }
              else {
                $("#cs_info_table tbody").html(html);
              }

              $(".csitem").select2();

          }
        });

      return false;
    });



















 // end physical add   

    $("#qc_row").unbind('click').bind('click', function() {
      var table = $("#qc_info_table");
      var count_table_tbody_tr = $("#qc_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                  '<td><input type="text" name="qcitem[]" id="qcitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="qcstandard[]" id="qcstandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="qcfrekuensi[]" id="qcfrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="qcmetode[]" id="qcmetode_'+row_id+'" class="form-control" ></td>'+
                   
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowQc(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#qc_info_table tbody tr:last").after(html);  
              }
              else {
                $("#qc_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });


  });

 
  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function removeRowInc(tr_id)
  {
    $("#phy_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function removeRowCs(tr_id)
  {
    $("#cs_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }



  function removeRowQc(tr_id)
  {
    $("#qc_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

 



</script>