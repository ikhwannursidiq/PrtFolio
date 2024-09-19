<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Kedatangan Compound</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Compound</li>
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
            <h3 class="box-title">Add Kedatangan Compound</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('barangmasuk/create') ?>" method="post" class="form-horizontal">
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
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Select Supplier</label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="customer_1" name="customer[]" style="width:100%;" onchange="getSupplierData(1)" required>
                    <option value=""></option>
                            <?php foreach ($datasupplier as $b => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                            </select>
                     </div>
                  </div>
 <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Supplier name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name_1" name="supplier_name" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Supplier Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address_1" name="supplier_address" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Supplier Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone_1" name="supplier_phone" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div>
                 
                  
                </div>
                <div class="col-md-4 col-xs-12 pull pull-left">
<div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">No. Surat Jalan</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="sj" name="sj" placeholder="Enter Surat Jalan" autocomplete="off" required>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">PO No.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="pono" name="pono" placeholder="Enter PO No." autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deliverydate" class="col-sm-5 control-label" style="text-align:RIGHT;">Received Date</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="receiveddate" name="receiveddate" placeholder="Enter Date" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deliverydate" class="col-sm-5 control-label" style="text-align:RIGHT;">Time</label>
                    <div class="col-sm-7">
                      <input type="time" class="form-control" id="waktu" name="waktu" placeholder="Enter Date" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:right;">Receiver name</label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="operatorname" name="operatorname" style="width:100%;" required>
                      <option value=""></option>
                            <?php foreach ($operator as $k => $v): ?>
                              <option value="<?php echo $v['name'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                            </select>
                    </div>
                  </div>

                </div>
                
                            </div> 
                <br /> <br/>
                <table class="table table-border" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:10%">Select Material</th>
					            <th style="width:12%">Material</th>   
                      <th style="width:10%">Qty Mix </th>
                      <th style="width:13%">No.Lot</th>
                      <th style="width:5%">HS</th>
                      <th style="width:5%">TB</th>
                      <th style="width:5%">EB</th>
                      <th style="width:5%">SG</th>
                      <th style="width:8%">KPS WEIGHT</th>
                      <th style="width:8%">SKI WEIGHT</th>
                      <th style="width:8%">DIFF WEIGHT</th>
                      

                  </thead>


                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($datacompound as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['matname'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
						 <td>
                          <input type="text" name="name[]" id="name_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="name_value[]" id="name_value_1" class="form-control" autocomplete="off">
                        </td>
						
						
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="nolot[]" id="nolot_1" class="form-control" autocomplete="off">
                              </td>
                        <td>
                          <input type="text" name="hs[]" id="hs_1" class="form-control" autocomplete="off">
                          <input type="hidden" name="hs_value[]" id="hs_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="tb[]" id="tb_1" class="form-control"  autocomplete="off">
                          <input type="hidden" name="tb_value[]" id="tb_value_1" class="form-control" autocomplete="off">
                        </td>

                        <td>
                          <input type="text" name="eb[]" id="eb_1" class="form-control"  autocomplete="off">
                          <input type="hidden" name="eb_value[]" id="eb_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="sg[]" id="sg_1" class="form-control"  autocomplete="off">
                          <input type="hidden" name="sg_value[]" id="sg_value_1" class="form-control" autocomplete="off">
                        </td>

                        <td><input type="text" name="kpsw[]" id="kpsw_1" class="form-control" ></td>
                        <td><input type="text" name="skiw[]" id="skiw_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><input type="text" name="gap[]" id="gap_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                   <tfooter>
                   <thead>
                    <tr>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th style="width:10%" class="pull-right"><button type="button" id="add_row" class="btn btn-danger"><i class="fa fa-plus"></i> ADD COLUMN</button></th>
                    </tr>
                  </thead>
                   </tfooter>
                  
             
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Total Qty MIX</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>
              
                  
                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" formnovalidate class="btn btn-success" >SAVE</button>
                <a href="<?php echo base_url('barangmasuk/') ?>" class="btn btn-warning">Back</a>
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

   // disabled enter keyboard
$('input').on('keydown', function(event) {
   var x = event.which;
   if (x === 13) {
       event.preventDefault();
   }
});


  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainBarangmasukNav").addClass('active');
    $("#addBarangmasukNav").addClass('active');
    
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
          url: base_url + '/barangmasuk/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.matname+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
					          '<td><input type="text" name="name[]" id="name_'+row_id+'" class="form-control" disabled><input type="hidden" name="name_value[]" id="name_value_'+row_id+'" class="form-control"></td>'+                    
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'"  class="form-control" onkeyup="getTotal('+row_id+')"><input type="hidden" value="1" name="qty_value[]" id="qty_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="nolot[]" id="nolot_'+row_id+'" class="form-control" ><input type="hidden" name="nolot_value[]" id="nolot_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="hs[]" id="hs_'+row_id+'" class="form-control" ><input type="hidden" name="hs_value[]" id="hs_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="tb[]" id="tb_'+row_id+'" class="form-control" ><input type="hidden" name="tb_value[]" id="tb_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="eb[]" id="eb_'+row_id+'" class="form-control" ><input type="hidden" name="eb_value[]" id="eb_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="sg[]" id="sg_'+row_id+'" class="form-control" ><input type="hidden" name="sg_value[]" id="sg_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="kpsw[]" id="kpsw_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" required></td>'+
                    '<td><input type="text" name="skiw[]" id="skiw_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" required></td>'+
                    '<td><input type="text" name="gap[]" id="gap_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" required></td>'+
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
      var qty = Number($("#qty_"+row).val());
      var a = Number($("#kpsw_"+row).val()) - Number($("#skiw_"+row).val());
      var total = Number($("#rate_value_"+row).val()) *a;
      total = total.toFixed(2);
      qty = qty.toFixed(1);
      a = a.toFixed(2);
     // $("#total_qty_"+row).val(a);
     // $("#total_qty_value_"+row).val(a);
      $("#gap_"+row).val(a);
     // $("#total_qty_value_"+row).val(a);
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
      $("#hs_"+row_id).val("");
      $("#hs_value_"+row_id).val("");
      $("#tb_"+row_id).val("");
      $("#tb_value_"+row_id).val("");
      $("#qty_"+row_id).val("");  
      $("#eb_"+row_id).val("");
      $("#eb_value_"+row_id).val(""); 
      $("#sg_"+row_id).val("");
      $("#sg_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'barangmasuk/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#name_"+row_id).val(response.matname);
          $("#name_value_"+row_id).val(response.matname);
		      $("#hs_"+row_id).val(response.hs);
          $("#hs_value_"+row_id).val(response.hs);
          $("#tb_"+row_id).val(response.tb);
          $("#tb_value_"+row_id).val(response.tb);
          $("#eb_"+row_id).val(response.eb);
          $("#eb_value_"+row_id).val(response.eb);
          $("#sg_"+row_id).val(response.sg);
          $("#sg_value_"+row_id).val(response.sg);
          $("#qty_"+row_id).val(response.qty);
          $("#qty_value_"+row_id).val(response.qty); 
          var total = Number(response.price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  function getSupplierData(rw_id)
  {
    var id = $("#customer_"+rw_id).val();    
    if(id == "") {
 
	    $("#customer_name_"+rw_id).val("");
		  $("#customer_address_"+rw_id).val("");
		  $("#customer_telp_"+rw_id).val("");
	
  } else {
      $.ajax({
        url: base_url + 'barangmasuk/getSupplierValueById',
        type: 'post',
        data: {id : id},
        dataType: 'json',
        success:function(response) { 
         
		      $("#customer_name_"+rw_id).val(response.name);
	        $("#customer_address_"+rw_id).val(response.alamat);
		      $("#customer_phone_"+rw_id).val(response.telp);
	
		    }  
      }); 
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
   //   totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    totalSubAmount =Number(totalSubAmount) + Number($("#qty_"+count).val());
    } // /for
    totalSubAmount = totalSubAmount.toFixed(0);
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