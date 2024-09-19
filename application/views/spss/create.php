

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Spss</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Spss</li>
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
            <h3 class="box-title">Add Sps</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('spss/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Supplier Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" autocomplete="off" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Tanggal</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">No. Standart Penanganan sample</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div>
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:30%">Nama Barang</th>
                      <th style="width:10%">Jumlah Barang</th>
                      <th style="width:10%">Deskripsi Pengetesan</th>
                      
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                     <td><input type="text" name="product[]" id="product_1" class="form-control" required onkeyup="getTotal(1)"></td>
                     <td><input type="text" name="jumlahbarang[]" id="jumlahbarang_1" class="form-control" required onkeyup="getTotal(1)"></td>
                     <td><input type="text" name="diskripsi[]" id="diskripsi_1" class="form-control" required onkeyup="getTotal(1)"></td>
                      
                     <!--
                     <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control" autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_1" class="form-control"  autocomplete="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>
        -->
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>
            <!--
                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>

                </div>
              </div> -->
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Create Sps</button>
                <a href="<?php echo base_url('spss/') ?>" class="btn btn-warning">Back</a>
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

    $("#mainSpssNav").addClass('active');
    $("#addSpsNav").addClass('active');
    
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
          url: base_url + '/spss/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                  '<td><input type="text" name="product[]" id="product_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                  '<td><input type="text" name="jumlahbarang[]" id="jumlahbarang_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                  '<td><input type="text" name="diskripsi[]" id="diskripsi_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                  
                   
                   // '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                   // '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" ><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    //'<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" ><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    //'<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
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

//-iwan  function getTotal(row = null) {
//-iwan    if(row) {
 //-iwan     var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
 //-iwan     total = total.toFixed(2);
  //-iwan    $("#amount_"+row).val(total);
  //-iwan    $("#amount_value_"+row).val(total);
      
  //-iwan    subAmount();

 //-iwan   } else {
 //-iwan     alert('no row !! please refresh the page');
//-iwan    }
 //-iwan }

  // get the product information from the server
 //-iwan function getProductData(row_id)
  //-iwan{
  //-iwan  var product_id = $("#product_"+row_id).val();    
  //-iwan  if(product_id == "") {
   //-iwan   $("#rate_"+row_id).val("");
   //-iwan   $("#rate_value_"+row_id).val("");
    //-iwan  $("#qty_"+row_id).val("");           
   //-iwan   $("#amount_"+row_id).val("");
  //-iwan    $("#amount_value_"+row_id).val("");

   //-iwan } else {
    //-iwan  $.ajax({
     //-iwan   url: base_url + 'spss/getProductValueById',
     //-iwan   type: 'post',
     //-iwan   data: {product_id : product_id},
      //-iwan  dataType: 'json',
      //-iwan  success:function(response) {
          // setting the rate value into the rate input field 
      //-iwan    $("#rate_"+row_id).val(response.price);
      //-iwan    $("#rate_value_"+row_id).val(response.price);
      //-iwan    $("#qty_"+row_id).val(1);
     //-iwan     $("#qty_value_"+row_id).val(1);
     //-iwan     var total = Number(response.price) * 1;
     //-iwan     total = total.toFixed(2);
       //-iwan   $("#amount_"+row_id).val(total);
       //-iwan   $("#amount_value_"+row_id).val(total);   
      //-iwan    subAmount();
      //-iwan  } // /success
   //-iwan   }); // /ajax function to fetch the product data 
  //-iwan  }
 //-iwan }

  // calculate the total amount of the order
  //-iwanfunction subAmount() {
  //-iwan  var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
   //-iwan var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

   //-iwan var tableProductLength = $("#product_info_table tbody tr").length;
   //-iwan var totalSubAmount = 0;
   //-iwan for(x = 0; x < tableProductLength; x++) {
   //-iwan   var tr = $("#product_info_table tbody tr")[x];
   //-iwan   var count = $(tr).attr('id');
    //-iwan  count = count.substring(4);
    //-iwan  totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    //-iwan} // /for
    //-iwantotalSubAmount = totalSubAmount.toFixed(2);
    // sub total
   //-iwan $("#gross_amount").val(totalSubAmount);
  //-iwan  $("#gross_amount_value").val(totalSubAmount);

    // vat
   //-iwan var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    //-iwanvat = vat.toFixed(2);
   //-iwan $("#vat_charge").val(vat);
    //-iwan$("#vat_charge_value").val(vat);

    // service
    //-iwanvar service = (Number($("#gross_amount").val())/100) * service_charge;
   //-iwan service = service.toFixed(2);
   //-iwan $("#service_charge").val(service);
   //-iwan $("#service_charge_value").val(service);
    
    // total amount
   //-iwan var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
   //-iwan totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

   //-iwan var discount = $("#discount").val();
   //-iwan if(discount) {
    //-iwan  var grandTotal = Number(totalAmount) - Number(discount);
    //-iwan  grandTotal = grandTotal.toFixed(2);
    //-iwan  $("#net_amount").val(grandTotal);
    //-iwan  $("#net_amount_value").val(grandTotal);
   //-iwan } else {
    //-iwan  $("#net_amount").val(totalAmount);
    //-iwan  $("#net_amount_value").val(totalAmount);
      
    //-iwan} // /else discount 

  //-iwan} // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>