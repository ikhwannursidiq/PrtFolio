

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      SURAT
      <small>Perintah Inspeksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Perintah Inspeksi</li>
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
            <h3 class="box-title">Add Surat Perintah Insepksi</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('wip/spi') ?>" method="post" class="form-horizontal">
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
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">PIC Name</label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="operatorname" name="operatorname" style="width:100%;" required>
                      <option value=""></option>
                            <?php foreach ($operator as $k => $v): ?>
                              <option value="<?php echo $v['name'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                            </select>      
                    </div>
                  </div>

                 

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Date Inspection</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="dateinput" name="dateinput" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Shift</label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="shift" name="shift" style="width:100%;" required>
                    <option value=""></option>
                              <option value="NS">Non Shift</option>
                              <option value="1">Shift 1</option>
                              <option value="2">Shift 2</option>
                              <option value="3">Shift 3</option>
                            </select>
                    
                    
                    </div>
                </div>
                </div>
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                    <th style="width:10%">CUSTOMER</th>
                    <th style="width:15%">SELECT PART NO</th>
                      <th style="width:15%">PART NO</th>
                      <th style="width:15%">NO LOT</th>
                      <th style="width:10%">QTY</th>
                      <th style="width:10%">CT/PCS</th>
                      <th style="width:10%">TOTAL</th>
                      <th style="width:20%">WORK TIME</th>
                    
                        </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                     <td>
                          <input type="text" name="customer[]" id="customer_1" class="form-control" required autocomplete="off">
                      </td>
                       
                       
                        <td>

                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getSpiData(1)" required>
                            <option value=""></option>
                            <?php foreach ($wipitemgroup as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['partno'] ?> - <?php echo $v['nolot'] ?>  Qty: <?php echo $v['qty'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="partno[]" id="partno_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="partno_value[]" id="partno_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="nolot[]" id="nolot_1" class="form-control"  required onkeyup="getTotal(1)" autocomplete="off">
                          <input type="hidden" name="nolot_value[]" id="nolot_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control"  required onkeyup="getTotal(1)" autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="totaljamkerja[]" id="totaljamkerja_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="totaljamkerja_value[]" id="totaljamkerja_value_1" class="form-control" autocomplete="off">
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
                    <label for="net_amount" class="col-sm-5 control-label">Work Time</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Create S.P.I</button>
                <a href="<?php echo base_url('wip/') ?>" class="btn btn-warning">Back</a>
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
  // enter jadi tab

$(document).on('keydown', ':tabbable', function(e) {

if (e.key === "Enter") {
    e.preventDefault();

    var $canfocus = $(':tabbable:visible');
    var index = $canfocus.index(document.activeElement) + 1;

    if (index >= $canfocus.length) index = 0;
    $canfocus.eq(index).focus();
}

});
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');
    
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
      //   url: base_url + '/wip/getTableItemRow/',
      //    url: '<?= base_url() ?>wip/getdatacust',
      url: base_url + '/wip/getdataspi/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
             //  '<td>'+ 
             //       '<select class="form-control select_group product" data-row-id="'+row_id+'" id="customer_'+row_id+'" name="customer[]" style="width:100%;" >'+
             //           '<option value=""></option>';
             //           $.each(response, function(index, value) {
             //             html += '<option value="'+value.id+'">'+value.name+'</option>';             
             //           });
                        
             //         html += '</select>'+
             //       '</td>'+
             '<td><input type="text" name="customer[]" id="customer_'+row_id+'" class="form-control" ></td>'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getSpiData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.partno+' - '+value.nolot+'  Qty:'+value.qty+'  </option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="partno[]" id="partno_'+row_id+'" class="form-control" disabled><input type="hidden" name="partno_value[]" id="partno_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="nolot[]" id="nolot_'+row_id+'" class="form-control" ><input type="hidden" name="nolot_value[]" id="nolot_value_'+row_id+'" class="form-control"></td>'+
               
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" ><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'"  onkeyup="getTotal('+row_id+')" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="totaljamkerja[]" id="totaljamkerja_'+row_id+'" class="form-control" ><input type="hidden" name="totaljamkerja_value[]" id="totaljamkerja_value_'+row_id+'"  onkeyup="getTotal('+row_id+')" class="form-control"></td>'+
               
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
      var total = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());
    //  var total = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(0);

      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);

      var ttjk = Number(total)/3600;
              ttjk = ttjk.toFixed(2);
          $("#totaljamkerja_"+row).val(ttjk);
          $("#totaljamkerja_value_"+row).val(ttjk);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }



  function getSpiData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");
      $("#partno_"+row_id).val("");
      $("#partno_value_"+row_id).val("");
      $("#qty_"+row_id).val("");           
      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");
      $("#totaljamkerja_"+row_id).val("");
      $("#totaljamkerja_value_"+row_id).val("");
      $("#nolot_"+row_id).val("");
      $("#nolot_value_"+row_id).val("");

    } else {
      $.ajax({
       url: base_url + 'wip/getValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#partno_"+row_id).val(response.partno);
          $("#partno_value_"+row_id).val(response.partno);
          $("#nolot_"+row_id).val(response.nolot);
          $("#nolot_value_"+row_id).val(response.nolot);
          $("#rate_"+row_id).val();
          $("#rate_value_"+row_id).val();
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);
          var total =  Number($("#rate_value"+row).val()) * Number($("#qty_value"+row).val());
              total = total.toFixed(0);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          $("#totaljamkerja_"+row_id).val(ttjk);
          $("#totaljamkerja_value_"+row_id).val(ttjk);
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  function getLot(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");
      $("#partno_"+row_id).val("");
      $("#partno_value_"+row_id).val("");
      $("#qty_"+row_id).val("");           
      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");
      $("#totaljamkerja_"+row_id).val("");
      $("#totaljamkerja_value_"+row_id).val("");

    } else {
      $.ajax({
     //   url: base_url + 'wip/getProductValueById',
       url: base_url + 'wip/getValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#partno_"+row_id).val(response.partno);
          $("#partno_value_"+row_id).val(response.partno);
          $("#rate_"+row_id).val();
          $("#rate_value_"+row_id).val();
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);
          var total =  Number($("#rate_value"+row).val()) * Number($("#qty_value"+row).val());
              total = total.toFixed(0);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          $("#totaljamkerja_"+row_id).val(ttjk);
          $("#totaljamkerja_value_"+row_id).val(ttjk);
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the order
  function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalqty = 0;
    var totalwt = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
      totalqty = Number(totalqty) + Number($("#qty_"+count).val());
      totalwt = Number(totalwt) + Number($("#totaljamkerja_"+count).val());
   
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
  //  $("#gross_amount").val(totalSubAmount);
   // $("#gross_amount_value").val(totalSubAmount);
    $("#gross_amount").val(totalqty);
    $("#gross_amount_value").val(totalqty);
   
    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
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
     // $("#net_amount").val(totalAmount);
     // $("#net_amount_value").val(totalAmount);

      $("#net_amount").val(totalwt);
      $("#net_amount_value").val(totalwt);
      totalwt = totalwt.toFixed(2);
      
    } // /else discount 

  } // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>