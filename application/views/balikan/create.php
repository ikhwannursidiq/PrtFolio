<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ComboBox Bertingkat dengan Select 2 dan JQuery</title>
 
   
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

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
            <h3 class="box-title">Add Return Part</h3>
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
                    <select class="form-control select_group customer" id="customer_1" name="customer[]" style="width:100%;" onchange="getVroductData(1)" required>
                    <option value=""></option>
                            <?php foreach ($vroducts as $b => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                            </select>
                     </div>
                  </div>
 <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name_1" name="customer_name" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address_1" name="customer_address" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone_1" name="customer_phone" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fax" class="col-sm-5 control-label" style="text-align:left;">FAX</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="fax_1" name="fax" placeholder="Enter Customerfax" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="attn" class="col-sm-5 control-label" style="text-align:left;">Atas Nama</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="attn_1" name="attn" placeholder="Enter attn" autocomplete="off">
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-4 col-xs-12 pull pull-left">

                <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">PO Number.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="pono" name="pono" placeholder="Enter PO No." autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">Delivery Number.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="sj" name="sj" placeholder="Enter Delivery No." autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deliverydate" class="col-sm-5 control-label" style="text-align:RIGHT;">Date Received</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="datereceived" name="datereceived" placeholder="Enter Date" autocomplete="off">
                    </div>
                  </div>


</div>
<div class="col-md-4 col-xs-12 pull pull-left">

<div class="form-group">
    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">Provinsi</label>
    <div class="col-sm-7">
 
                    <select id="provinsi" name="provinsi" class="form-control select2">
                        <option value="" selected>Pilih Provinsi</option>
                    </select>
    </div>
  </div>
  


</div>
<!-- /footer invoice -->  
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">Product</th>
                      <th style="width:10%">Part Name</th>
                      <th style="width:10%">Qty</th>           
                      <th style="width:20%">Defect Name</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

             <!--      <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($items as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="name[]" id="name_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="name_value[]" id="name_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><input type="text" name="note[]" id="note_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody> -->
                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                          
                      <!--  <select id="kabupaten" name="kabupaten" class="form-control select2"> -->
                              <option value="" selected></option>
                
                          </select>
                        </td>
                       
                        <td>
                          <input type="text" name="name[]" id="name_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="name_value[]" id="name_value_1" class="form-control" autocomplete="off">
                        </td>
                    
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><input type="text" name="note[]" id="note_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
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
              
                 
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Create Return</button>
                <a href="<?php echo base_url('return/') ?>" class="btn btn-warning">Back</a>
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
            $("#provinsi").select2({
                ajax: {
                    url: '<?= base_url() ?>balikan/getdataprov',
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
 $("#provinsi").change(function() {
            var id_prov = $("#provinsi").val();
            $("#product").select2({
                ajax: {
                    url: '<?= base_url() ?>balikan/getdatakab/' + id_prov,
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

    $("#mainPoimportNav").addClass('active');
    $("#addPoimportNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
      var id_prov = $("#provinsi").val();

      $.ajax({
       //   url: base_url + '/balikan/getTableItemRow/',
       url: '<?= base_url() ?>balikan/getItemdatakab/' + id_prov,
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product"  data-row-id="'+row_id+'" id="kabupaten_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.nama+'">'+value.nama+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="name[]" id="name_'+row_id+'" class="form-control" disabled><input type="hidden" name="name_value[]" id="name_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                       '<td><input type="text" name="note[]" id="note_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
              
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $("#product").select2();

          }
         
                  
          




          
        });

return false;

    //    });
     //   return {
           //                 results: response
            //            };

    //  return false;
    });

  }); // /document




  function getTotal(row = null) {
    if(row) {
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
    var item_id = $("#product_"+row_id).val();    
    if(item_id == "") {
    //  $("#rate_"+row_id).val("");
    //  $("#rate_value_"+row_id).val("");
      $("#name_"+row_id).val("");
      $("#name_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           

  //    $("#amount_"+row_id).val("");
   //   $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'balikan/getItemValueById',
        type: 'post',
        data: {item_id : item_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          
        //  $("#rate_"+row_id).val(response.price);
        //  $("#rate_value_"+row_id).val(response.price);
         $("#name_"+row_id).val(response.name);
         $("#name_value_"+row_id).val(response.name);

          $("#qty_"+row_id).val(0);
          $("#qty_value_"+row_id).val(0);

         // var total = Number(response.price) * 1;
          total = total.toFixed(0);
          $("#qty_"+row_id).val(total);
          $("#qty_value_"+row_id).val(total);
          
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

      totalSubAmount = Number(totalSubAmount) + Number($("#qty_"+count).val());
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
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount

  function getVroductData(rw_id)
  {
    var vroduct_id = $("#customer_"+rw_id).val();    
    if(vroduct_id == "") {
	$("#customer_name_"+rw_id).val("");
      $("#customer_address_"+rw_id).val("");
      $("#customer_telp_"+rw_id).val("");
	   $("#fax_"+rw_id).val("");
	    $("#attn_"+rw_id).val("");
    

    } else {
      $.ajax({
        url: base_url + 'Pocompound/getVroductValueById',
        type: 'post',
        data: {vroduct_id : vroduct_id},
        dataType: 'json',
        success:function(response) { 
		$("#customer_name_"+rw_id).val(response.name);
		$("#customer_address_"+rw_id).val(response.alamat);
		$("#customer_phone_"+rw_id).val(response.telp);
		$("#fax_"+rw_id).val(response.fax);
		$("#attn_"+rw_id).val(response.attn);
			
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