

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <h3 class="box-title">Edit Form Incoming</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('fincoming/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date Edit: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="<?php echo $incoming_data['incoming']['customer_name'] ?>" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" value="<?php echo $incoming_data['incoming']['customer_address'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="dtw" name="dtw" placeholder="Enter Customer Phone" value="<?php echo $incoming_data['incoming']['dtw'] ?>" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-right">
                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">PIC Outgoing</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="pic" name="pic" placeholder="Enter Pic" autocomplete="off" require>
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
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php if(isset($incoming_data['incoming_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($incoming_data['incoming_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                         <td>      
                        <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($inputs as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"<?php if($val['partno'] == $v['nama']) { echo "selected='selected'"; } ?>><?php echo $v['nama'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td><input type="text" name="partno[]" id="partno_<?php echo $x; ?>" class="form-control" value="<?php echo $val['partno'] ?>" required onkeyup="getTotal(1)"></td>
                        <input type="hidden" name="partno_value[]" id="partno_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['partno'] ?>" autocomplete="off">
                        <td>
                          <input type="text" name="nolot[]" id="nolot_<?php echo $x; ?>" class="form-control" value="<?php echo $val['nolot'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="nolot_value[]" id="nolot_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['nolot'] ?>" autocomplete="off">
                        </td>
                       
                        <td>
                          <input type="text" name="totalcheck[]" id="totalcheck_<?php echo $x; ?>" class="form-control" value="<?php echo $val['totalcheck'] ?>" disabled autocomplete="off">
                          <input type="hidden" name="totalcheck_value[]" id="totalcheck_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['totalcheck'] ?>" autocomplete="off">
                        </td>
                        <td><input type="number" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" value="<?php echo $val['qty'] ?>" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="operatorname[]" id="operatorname_<?php echo $x; ?>" class="form-control" value="<?php echo $val['operatorname'] ?>" disabled required >
                          <input type="hidden" name="operatorname_value[]" id="operatorname_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['operatorname'] ?>" autocomplete="off">
                      </td>

                          <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                       </tr>




                       <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Total Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="total_qty" name="total_qty" value="<?php echo $incoming_data['incoming']['gross_amount'] ?>"  disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="total_qty_value" name="total_qty_value" value="<?php echo $incoming_data['incoming']['gross_amount'] ?>" autocomplete="off">
                    </div>
              </div>
 

                
                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Status Report</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                        <option value="1">EDIT</option>
                        <option value="2">CANCEL</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <a target="__blank" href="<?php echo base_url() . 'orders/printDiv/'.$incoming_data['incoming']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
                  '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                      '<option value=""></option>';
                      $.each(response, function(index, value) {
                        html += '<option value="'+value.id+'">'+value.nama+'Lot '+value.nolot+' Date '+value.date_time+'</option>';                         
                      });
                      
                    html += '</select>'+
                  '</td>'+ 
                  '<td><input type="text" name="partno[]" id="partno_'+row_id+'" class="form-control" disabled><input type="hidden" name="partno_value[]" id="partno_value_'+row_id+'" class="form-control"></td>'+
                  '<td><input type="text" name="nolot[]" id="nolot_'+row_id+'" class="form-control" disabled><input type="hidden" name="nolot_value[]" id="nolot_value_'+row_id+'" class="form-control"></td>'+
                  '<td><input type="text" name="totalcheck[]" id="totalcheck_'+row_id+'" class="form-control" disabled><input type="hidden" name="totalcheck_value[]" id="totalcheck_value_'+row_id+'" class="form-control"></td>'+
                  '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"><input type="hidden" name="qty_value[]" id="qty_value_'+row_id+'" class="form-control"></td>'+
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



  function subAmount() {
    var tableProductLength = $("#product_info_table tbody tr").length;
   
    var totalQty = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

   
      totalQty = Number(totalQty) + Number($("#qty_"+count).val());
    } 
   
    totalQty = totalQty.toFixed(0);

     // total qty
     $("#total_qty").val(totalQty);
    $("#total_qty_value").val(totalQty);

  } 


  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>