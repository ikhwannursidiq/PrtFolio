

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Transaksi Outgoing
      <small>to warehouse</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Form</a></li>
      <li class="active">Incoming</li>
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
            <h3 class="box-title">Add form</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date Created: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Time: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">
                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Select </label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="customer" name="customer" style="width:100%;" onchange="getSopirData()" required>
                 
                 <option value=""></option>
                         <?php foreach ($sopirs as $b => $v): ?>
                           <option value="<?php echo $v['id'] ?>"><?php echo $v['kendaraan'] ?>     <?php echo $v['name'] ?> </option>
                         <?php endforeach ?>
                         </select>
                    
                  </div>
               </div>

               <div class="form-group">
                 <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;"> Nama Kendaraan</label>
                 <div class="col-sm-7">
                   <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" autocomplete="off" />
                 </div>
               </div>

               <div class="form-group">
                 <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Nomor Polisi</label>
                 <div class="col-sm-7">
                   <input type="text" class="form-control" id="nopol" name="nopol" placeholder="Enter Customer Address" autocomplete="off">
                 </div>
               </div>

               <div class="form-group">
                 <label for="pono" class="col-sm-5 control-label" style="text-align:left;">Sopir</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="sopir" name="sopir" placeholder="Tulis Sopir" autocomplete="off">
                </div>
               </div>
               <div class="form-group">
                 <label for="deliverydate" class="col-sm-5 control-label" style="text-align:left;">Pendamping</label>
                  <div class="col-sm-7">
                   <input type="text" class="form-control" id="kenek" name="kenek" placeholder="Tulis Kernet" autocomplete="off">
                </div>
               </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Delivery to Warehouse</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="dtw" name="dtw" placeholder="Enter Customer Phone" autocomplete="off" required>
                    </div>
                  </div>

                </div>

                <div class="col-md-4 col-xs-12 pull pull-right">
                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">PIC Outgoing</label>
                    <div class="col-sm-7">
                    <select class="select_group" id="pic" name="pic" style="width:100%;"  required>
                           <option value=""></option>
                           <option value="AANG">AANG</option>
                           <option value="DEDE">DEDE</option>  
                           <option value="RIZAL">RIZAL</option>
                           <option value="RAMDAN">RAMDAN</option>   
                           <option value="NANI">NANI</option>
                           
                      </select>
                       </div>
                  </div>


                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">RIT </label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="rit" name="rit" style="width:100%;"  required>
                 
                    <option value=""></option>
                          
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              
                            </select>
                       
                     </div>
                     </div>
                     <div class="form-group">
                 <label for="deliverydate" class="col-sm-5 control-label" style="text-align:left;">Jumlah Box</label>
                  <div class="col-sm-7">
                   <input type="number" class="form-control" id="box" name="box" placeholder="box yg diangkut" autocomplete="off">
                </div>
               </div>

                </div>
             
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">Part Name</th>
                      <th style="width:20%">Part No</th>      
                      <th style="width:20%">No Lot</th>
                      <th style="width:10%">Total Check</th>
                      <th style="width:10%">Qty Kirim</th>
                      <th style="width:10%">Inspection Name</th>
                      <th style="width:10%"></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($inputs as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['nama'] ?>  Lot <?php echo $v['nolotnew'] ?>  Dateinput <?php echo $v['date_time'] ?> OK<?php echo $v['ok'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td><input type="text" name="partno[]" id="partno_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <input type="hidden" name="partno_value[]" id="partno_value_1" class="form-control" autocomplete="off">
                        <td>
                          <input type="text" name="nolot[]" id="nolot_1" class="form-control"  autocomplete="off" required>
                          <input type="hidden" name="nolot_value[]" id="nolot_value_1" class="form-control" autocomplete="off" required>
                        </td>
                       
                        <td>
                          <input type="text" name="totalcheck[]" id="totalcheck_1" class="form-control"  disabled autocomplete="off">
                          <input type="hidden" name="totalcheck_value[]" id="totalcheck_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="number" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="operatorname[]" id="operatorname_1" class="form-control" disabled required>
                          <input type="hidden" name="operatorname_value[]" id="operatorname_value_1" class="form-control" autocomplete="off">
                      </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                   <tfooter>
                   <thead>
                    <tr>
                      <th style="width:10%"></th>
                      <th style="width:10%"></th>
                      <th style="width:10%"></th>
                      <th style="width:10%"></th>
                      <th align="right" style="width:20%"></th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i>  ADD COLUMN</button></th>
                    </tr>
                  </thead>
                   </tfooter> 
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Total Qty</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="total_qty" name="total_qty" autocomplete="off">
                      <input type="hidden" class="form-control" id="total_qty_value" name="total_qty_value" autocomplete="off">
                  </div>
                  </div>
                 
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">SAVE</button>
                <a href="<?php echo base_url('fincoming/') ?>" class="btn btn-warning">Back</a>
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
    // $("#description").wysihtml5();
    $("#mainFincomingNav").addClass('active');
    $("#addFincomingNav").addClass('active'); 
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
      $.ajax({
          url: base_url + '/fincoming/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')" required>'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.nama+' Lot '+value.nolotnew+' Date '+value.date_time+'   OK : '+value.ok+'</option>';             
                        });     
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="partno[]" id="partno_'+row_id+'" class="form-control" disabled><input type="hidden" name="partno_value[]" id="partno_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="nolot[]" id="nolot_'+row_id+'" class="form-control" ><input type="hidden" name="nolot_value[]" id="nolot_value_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="totalcheck[]" id="totalcheck_'+row_id+'" class="form-control" ><input type="hidden" name="totalcheck_value[]" id="totalcheck_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="operatorname[]" id="operatorname_'+row_id+'" class="form-control" disabled ><input type="hidden" name="operatorname_value[]" id="operatorname_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
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
  }); // /document
  function getTotal(row = null) {
    if(row) {
      var tableProductLength = $("#product_info_table tbody tr").length;
      var totalSubAmount = 0;
      $("#qtykirim_"+row).val();
      for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#qtykirim_"+count).val());
    } // /for
    totalSubAmount = totalSubAmount.toFixed(2);
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }


 


  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#partno_"+row_id).val("");
      $("#partno_value_"+row_id).val("");
      $("#nolot_"+row_id).val("");
      $("#nolot_value_"+row_id).val("");
      $("#qty_"+row_id).val("");           
      $("#totalcheck_"+row_id).val("");
      $("#totalcheck_value_"+row_id).val("");
      $("#operator_"+row_id).val("");
      $("#operator_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'fincoming/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#partno_"+row_id).val(response.nama);
          $("#partno_value_"+row_id).val(response.nama);
          $("#nolot_"+row_id).val(response.nolotnew);
          $("#nolot_value_"+row_id).val(response.nolotnew);
          $("#qty_"+row_id).val(0);           
          $("#totalcheck_"+row_id).val(response.ok);
          $("#totalcheck_value_"+row_id).val(response.ok);
          $("#operatorname_"+row_id).val(response.operatorname);
          $("#operatorname_value_"+row_id).val(response.operatorname);

          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }




  // calculate the total amount of the order
  function subAmount() {
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalQty = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalQty = Number(totalQty) + Number($("#qty_"+count).val());
    } // /for


    totalQty = totalQty.toFixed(0);
// total qty
    $("#total_qty").val(totalQty);
    $("#total_qty_value").val(totalQty);

  } // /sub total amount


  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }


  function getSopirData()
  {
    var id = $("#customer").val();    
    if(id == "") {
		 $("#customer_name").val("");
		 $("#nopol").val("");  
     $("#sopir").val(""); 
     $("#kenek").val(""); 
  } else {
      $.ajax({
        url: base_url + 'fincoming/getSopirValueById',
       // url: base_url + 'fincoming/getKonsumenValueById',
        type: 'post',
        data: {id : id},
        dataType: 'json',
        success:function(response) { 
       $("#customer_name").val(response.kendaraan);
		   $("#nopol").val(response.nopol);
       $("#sopir").val(response.name);
       $("#kenek").val(response.kenek);
		    }  
      }); 
    }
  }











  function getKonsumenData()
  {
    var id = $("#customer").val();    
    if(id == "") {
	    $("#customer_name").val("");
		$("#customer_address").val("");
		$("#customer_telp").val("");
	    $("#fax").val("");
	    $("#attn").val("");
  } else {
      $.ajax({
        url: base_url + 'fincoming/getKonsumenValueById',
        type: 'post',
        data: {id : id},
        dataType: 'json',
        success:function(response) { 
		$("#customer_name").val(response.name);
		$("#customer_address").val(response.alamat);
		$("#customer_phone").val(response.telp);
		$("#fax").val(response.fax);
		$("#attn").val(response.keterangan);		
		    }  
      }); 
    }
  }

</script>