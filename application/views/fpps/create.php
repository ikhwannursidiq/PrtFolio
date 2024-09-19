

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Fpps</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">FPP</li>
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
            <h3 class="box-title">Add FPP</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('fpps/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>
<!-- /.header invoice -->
                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                    <div class="col-sm-7">
                   

                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" autocomplete="off" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fax" class="col-sm-5 control-label" style="text-align:left;">FAX</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="fax" name="fax" placeholder="Enter Customerfax" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="attn" class="col-sm-5 control-label" style="text-align:left;">Atas Nama</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="attn" name="attn" placeholder="Enter attn" autocomplete="off">
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-4 col-xs-12 pull pull-left">

                <div class="form-group">
                    <label for="pono" class="col-sm-5 control-label" style="text-align:RIGHT;">PO No.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="pono" name="pono" placeholder="Enter PO No." autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="deliverydate" class="col-sm-5 control-label" style="text-align:RIGHT;">Delivery Date</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="deliverydate" name="deliverydate" placeholder="Enter Date" autocomplete="off">
                    </div>
                  </div>
          </div>
          <!-- /footer invoice -->      
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">Job Order</th>
                      <th style="width:20%">Qty</th>
                      <th style="width:10%">Satuan</th>
                      <th style="width:10%">Masalah</th>
                      <th style="width:20%">Area</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                      
                        <td><input type="text" name="jo[]" id="jo_1" class="form-control"></td>
                       
                    
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" ></td>
                        <td>
                          <input type="text" name="satuan[]" id="satuan_1" class="form-control" >
                        </td>
                        <td>
                          <input type="text" name="masalah[]" id="masalah_1" class="form-control">
                         
                        </td>
                        <td>
                          <input type="text" name="area[]" id="area_1" class="form-control">
                         
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>

               

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Create Save</button>
                <a href="<?php echo base_url('fpps/') ?>" class="btn btn-warning">Back</a>
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

    $("#mainFppsNav").addClass('active');
    $("#addFppNav").addClass('active');
    
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
          url: base_url + '/fpps/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   
                    '<td><input type="text" name="product[]" id="product_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="[]" id="partname_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" ></td>'+
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
      var rate = $("#rate_"+row_id).val();  
var qty = $("#qty_"+row_id).val();  


      var amount = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());
      document.getElementById("#amount_"+row).innerHTML = amount;
      
      
      amount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
 

  // calculate the total amount of the order
  //function subAmount() {
   // var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
   // var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

   // var tableProductLength = $("#product_info_table tbody tr").length;
    //var totalSubAmount = 0;
   // for(x = 0; x < tableProductLength; x++) {
   //   var tr = $("#product_info_table tbody tr")[x];
   //   var count = $(tr).attr('id');
    //  count = count.substring(4);

   //   totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
   // } // /for

   // totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
   // $("#gross_amount").val(totalSubAmount);
    //$("#gross_amount_value").val(totalSubAmount);

    // vat
   // var vat = (Number($("#gross_amount").val())/100) * vat_charge;
   // vat = vat.toFixed(2);
  //  $("#vat_charge").val(vat);
  //  $("#vat_charge_value").val(vat);

    // service
   // var service = (Number($("#gross_amount").val())/100) * service_charge;
   // service = service.toFixed(2);
  //  $("#service_charge").val(service);
    //$("#service_charge_value").val(service);
    
    // total amount
  //  var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
  //  totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    //var discount = $("#discount").val();
   // if(discount) {
    //  var grandTotal = Number(totalAmount) - Number(discount);
    //  grandTotal = grandTotal.toFixed(2);
    //  $("#net_amount").val(grandTotal);
     // $("#net_amount_value").val(grandTotal);
   // } else {
    //  $("#net_amount").val(totalAmount);
     // $("#net_amount_value").val(totalAmount);
      
   // } // /else discount 

 // } // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>