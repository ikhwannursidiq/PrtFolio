

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Return Part</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Return Part</li>
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
            <h3 class="box-title">Edit Return Part</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('balikan/create') ?>" method="post" class="form-horizontal">
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
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">From Customer</label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="customer" name="customer[]" style="width:100%;" onchange="getKonsumenData()" required>
                    <option value=""></option>
                            <?php foreach ($konsumens as $b => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                            </select>
                     </div>
                  </div>
            <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $balikan_data['balikan']['customer_name'] ?>" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" value="<?php echo $balikan_data['balikan']['customer_address'] ?>" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="<?php echo $balikan_data['balikan']['customer_phone'] ?>" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div>
                  </div>
                <div class="col-md-4 col-xs-12 pull pull-left">
                <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">PO Number.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="pono" name="pono" placeholder="Enter PO No." value="<?php echo $balikan_data['balikan']['pono'] ?>" autocomplete="off">
                    </div>
                  </div>

                <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">Delivery Number.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="sj" name="sj" placeholder="Enter PO No." value="<?php echo $balikan_data['balikan']['sj'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deliverydate" class="col-sm-5 control-label" style="text-align:RIGHT;">Delivery Date</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="datereceived" name="datereceived" placeholder="Enter Date" value="<?php echo $balikan_data['balikan']['datereceived'] ?>" autocomplete="off">
                    </div>
                  </div>



                
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product</th>
                      <th style="width:10%">Part No</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:20%">Defect</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php if(isset($balikan_data['balikan_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($balikan_data['balikan_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                         <td>
                          <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;"  onchange="getItemData(<?php echo $x; ?>)" required>
                              <option value=""></option>
                              <?php foreach ($products as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </td>
                         
                          
                        
                          <td>
                          <input type="text" name="name[]" id="name_<?php echo $x; ?>"  value="<?php echo $val['name'] ?>"  class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="name_value[]" id="name_value_<?php echo $x; ?>" value="<?php echo $val['name'] ?>"  class="form-control" autocomplete="off">
                        </td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
                         
                        <td><input type="text" name="note[]" id="note_<?php echo $x; ?>" value="<?php echo $val['note'] ?>"  class="form-control" ></td>



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
                    <label for="gross_amount" class="col-sm-5 control-label">Total Qty</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="total_qty" name="total_qty" value="<?php echo $balikan_data['balikan']['total_qty'] ?>"  disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="total_qty_value" name="total_qty_value" value="<?php echo $balikan_data['balikan']['total_qty'] ?>"  autocomplete="off">
                    </div>
                  </div>
                  

           

                 

                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Status</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                      <option value=" ">--</option>
                        <option value="1">CLOSED</option>
                        <option value="2">ON PROSES</option>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <a target="__blank" href="<?php echo base_url() . 'balikan/printDiv/'.$balikan_data['balikan']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('balikan/') ?>" class="btn btn-warning">Back</a>
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
// Provinsi
$(document).ready(function() {
            $("#customer").select2({
                ajax: {
                    url: '<?= base_url() ?>balikan/getdatacust',
                    type: "post",
                    dataType: 'json',
                    delay: 200,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
 // Kabupaten
 $("#customer").change(function() {
            var id = $("#customer").val();
            $("#product_1").select2({
                ajax: {
                    url: '<?= base_url() ?>balikan/getdatacustomeritem/' + id,
                    type: "post",
                    dataType: 'json',
                    delay: 200,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainPolokalNav").addClass('active');
    $("#addPolokalNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
      var id = $("#customer").val();

      $.ajax({
          url: base_url +'/balikan/getItemDataCustomer/' + id,
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getItemData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                      '</td>'+
                    '<td><input type="text" name="name[]" id="name_'+row_id+'" class="form-control" disabled><input type="hidden" name="name_value[]" id="name_value_'+row_id+'" class="form-control"></td>'+           
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
              //       '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="note[]" id="note_'+row_id+'" class="form-control" ></td>'+
                    
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
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(0);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getItemData(row_id)
  {
    var item_id = $("#product_"+row_id).val();    
    if(item_id == "") {
      $("#name_"+row_id).val("");
      $("#name_value_"+row_id).val("");
      $("#unit_"+row_id).val("");
      $("#unit_value_"+row_id).val("");
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");
      $("#qty_"+row_id).val("");           
      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'balikan/getItemValueById',
        type: 'post',
        data: {item_id : item_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#name_"+row_id).val(response.name);
          $("#name_value_"+row_id).val(response.name);
          $("#unit_"+row_id).val(response.unit);
          $("#unit_value_"+row_id).val(response.unit);
          $("#rate_"+row_id).val(response.price);
          $("#rate_value_"+row_id).val(response.price);
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);
          var total = Number(response.price) * 1;
          total = total.toFixed(0);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          
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
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(0);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(0);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);
//   total qty

     var totalSubAmount1 = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount1 = Number(totalSubAmount1) + Number($("#qty_"+count).val());
    } // /for

    totalSubAmount1 = totalSubAmount1.toFixed();

    // sub total
    $("#total_qty").val(totalSubAmount1);
    $("#total_qty_value").val(totalSubAmount1);




    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(0);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(0);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(0);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount
  
  
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
        url: base_url + 'balikan/getKonsumenValueById',
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



  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>