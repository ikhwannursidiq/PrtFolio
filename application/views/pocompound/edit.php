

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Pocompound</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pocompound</li>
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
            <h3 class="box-title">Edit Pocompound</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('pocompound/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="<?php echo $pocompound_data['pocompound']['customer_name'] ?>" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" value="<?php echo $pocompound_data['pocompound']['customer_address'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone" value="<?php echo $pocompound_data['pocompound']['customer_phone'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fax" class="col-sm-5 control-label" style="text-align:left;">FAX</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="fax" name="fax" placeholder="Enter Customerfax" value="<?php echo $pocompound_data['pocompound']['fax'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="attn" class="col-sm-5 control-label" style="text-align:left;">Atas Nama</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="attn" name="attn" placeholder="Enter attn" value="<?php echo $pocompound_data['pocompound']['attn'] ?>" autocomplete="off">
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-4 col-xs-12 pull pull-left">

                <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">PO No.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="pono" name="pono" placeholder="Enter PO No." value="<?php echo $pocompound_data['pocompound']['pono'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deliverydate" class="col-sm-5 control-label" style="text-align:RIGHT;">Delivery Date</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="deliverydate" name="deliverydate" placeholder="Enter Date" value="<?php echo $pocompound_data['pocompound']['deliverydate'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label"> Status Pengiriman</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                        <option value="1">Closed</option>
                        <option value="2">Open</option>
                      </select>
                    </div>
                  </div>
                 

                </div>

                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:10%">Product</th>
					   <th style="width:10%">Part Name</th>
                      <th style="width:5%">Qty</th>
                      <th style="width:5%">Mix</th>
                      <th style="width:8%">Total Qty</th>
                      <th style="width:8%">Unit</th>
                      <th style="width:10%">Unit Price</th>
                      <th style="width:10%">Amount</th>
                      <th style="width:8%">Berapa X</th>
                      <th style="width:10%">Tgl Berapa</th>
                      <th style="width:10%">Note</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <?php if(isset($pocompound_data['pocompound_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($pocompound_data['pocompound_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($products as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
						<td>
                          <input type="text" name="name[]" id="name_<?php echo $x; ?>" class="form-control" value="<?php echo $val['name'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="name_value[]" id="name_value_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['name'] ?>" autocomplete="off">
                        </td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getTotal(<?php echo $x; ?>)"  value="<?php echo $val['qty'] ?>"></td>

                        <td>
                          <input type="text" name="mix[]" id="mix_<?php echo $x; ?>" class="form-control" value="<?php echo $val['mix'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="mix_value[]" id="mix_value_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['mix'] ?>" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="total_qty[]" id="total_qty_<?php echo $x; ?>" class="form-control" value="<?php echo $val['total_qty'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="total_qty_value[]" id="total_qty_value_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['total_qty'] ?>" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="unit[]" id="unit_<?php echo $x; ?>" class="form-control" value="<?php echo $val['unit'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="unit_value[]" id="unit_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['unit'] ?>" autocomplete="off">
                        </td>

                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" value="<?php echo $val['rate'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control"value="<?php echo $val['rate'] ?>"  autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control" disabled autocomplete="off" value="<?php echo $val['amount'] ?>">
                          <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" autocomplete="off" value="<?php echo $val['amount'] ?>">
                        </td>
                        <td><input type="text" name="kiriman[]" id="kiriman_<?php echo $x; ?>" class="form-control" value="<?php echo $val['kiriman'] ?>" required onkeyup="getTotal(1)"></td>
                        <td><input type="text" name="tgl[]" id="tgl_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['tgl'] ?>" required onkeyup="getTotal(1)"></td>
                        <td><input type="text" name="note[]" id="note_<?php echo $x; ?>" class="form-control" value="<?php echo $val['note'] ?>" required onkeyup="getTotal(1)"></td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                       <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $pocompound_data['pocompound']['gross_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $pocompound_data['pocompound']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo $pocompound_data['pocompound']['service_charge'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $pocompound_data['pocompound']['service_charge'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo $pocompound_data['pocompound']['vat_charge'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $pocompound_data['pocompound']['vat_charge'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" value="<?php echo $pocompound_data['pocompound']['discount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo $pocompound_data['pocompound']['net_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $pocompound_data['pocompound']['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>

                  

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <a target="__blank" href="<?php echo base_url() . 'pocompound/printpdf/'.$pocompound_data['pocompound']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('pocompound/') ?>" class="btn btn-warning">Back</a>
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

    $("#mainPocompoundNav").addClass('active');
    $("#addPocompoundNav").addClass('active');
    
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
          url: base_url + '/Pocompound/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
					 '<td><input type="text" name="name[]" id="name_'+row_id+'" class="form-control" disabled><input type="hidden" name="name_value[]" id="name_value_'+row_id+'" class="form-control"></td>'+
                   
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="mix[]" id="mix_'+row_id+'" class="form-control" disabled><input type="hidden" name="mix_value[]" id="mix_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="total_qty[]" id="total_qty_'+row_id+'" class="form-control" disabled><input type="hidden" name="total_qty_value[]" id="total_qty_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="unit[]" id="unit_'+row_id+'" class="form-control" disabled><input type="hidden" name="unit_value[]" id="unit_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="kiriman[]" id="kiriman_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="tgl[]" id="tgl_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="note[]" id="note_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                   
                   
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
      var a = Number($("#mix_value_"+row).val()) * Number($("#qty_"+row).val());
      var total = Number($("#rate_value_"+row).val()) *a;
      total = total.toFixed(2);
      a = a.toFixed(2);
      $("#total_qty_"+row).val(a);
      $("#total_qty_value_"+row).val(a);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
    

      subAmount();

    } 
    
    
    else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
		$("#name_"+row_id).val("");
      $("#name_value_"+row_id).val("");
      
      $("#mix_"+row_id).val("");
      $("#mix_value_"+row_id).val("");
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");
      $("#qty_"+row_id).val("");  
      $("#unit_"+row_id).val("");
      $("#unit_value_"+row_id).val(""); 
      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'Pocompound/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
		   $("#name_"+row_id).val(response.name);
          $("#name_value_"+row_id).val(response.name);
         
          $("#mix_"+row_id).val(response.mix);
          $("#mix_value_"+row_id).val(response.mix);
          $("#rate_"+row_id).val(response.price);
          $("#rate_value_"+row_id).val(response.price);
          $("#unit_"+row_id).val(response.unit);
          $("#unit_value_"+row_id).val(response.unit);
          $("#qty_"+row_id).val();
          $("#qty_value_"+row_id).val();
          $("#total_qty_"+row_id).val(1);
          $("#total_qty_value_"+row_id).val(1);
          var total = Number(response.price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  function getCustomerData(customer_name)
  {
    var customer_id = $("#customer_"+row_id).val();    
    if(customer_id == "") {
      $("#alamat").val("");
      $("#fax").val("");
      $("#telp").val("");
      $("#attn").val("");

    } else {
      $.ajax({
        url: base_url + 'Pocompound/getProductValueById',
        type: 'post',
        data: {customer_id : customer_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#alamat").val(response.alamat);
          $("#fax").val(response.fax);
          $("#telp").val(response.telp);
          $("#attn").val(response.attn);
          
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the Pocompound
  function subAmount() {
   // var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for
    totalSubAmount = totalSubAmount.toFixed(2);
    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);
    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);
    // service
    //var service = (Number($("#gross_amount").val())/100) * service_charge;
   // service = service.toFixed(2);
    //$("#service_charge").val(service);
   // $("#service_charge_value").val(service); 
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>