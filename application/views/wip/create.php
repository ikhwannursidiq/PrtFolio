

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      PT SHIMADA KARYA INDONESIA
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a> rev.02.08.23</li>
      <li class="active">LAPORAN HASIL CUTTING</li>
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
            <h3 class="box-title">INPUT WIP HASIL CUTTING </h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
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
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Date / Day (document)</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="dateinput" name="dateinput" placeholder="Enter Customer Name" autocomplete="off" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Group Leader</label>
                    <div class="col-sm-7">
                    <select class="form-control select_group customer" id="leader" name="leader" style="width:100%;" required>
                      <option value=""></option>
                            <?php foreach ($leader as $k => $v): ?>
                              <option value="<?php echo $v['name'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                      </select>   </div>
                  </div>

                  
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">

                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:right;">Operator Name</label>
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
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:right;">Shift</label>
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

                  <div class="form-group">
                  </div>

                  <div class="form-group">
                   
                  </div>
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:10%">Select Part No</th>
                      <th style="width:10%">Part NO</th>
                      <th style="width:10%">LOT NO</th>
                      <th style="width:10%">Qty</th>
                    
                      <th style="width:20%">Note</th>
                      <th style="width:10%"></th>
                    </tr>
                  </thead>

                   <tbody>
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
                          <input type="text" name="partno[]" id="partno_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="partno_value[]" id="partno_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="text" name="nolot[]" id="nolot_1" class="form-control" required ></td>
                       
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                       
                        <td>
                          <input type="text" name="note[]" id="note_1" class="form-control"  autocomplete="off">
                         
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
                    <label for="gross_amount" class="col-sm-5 control-label">Total QTY</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="total_qty" name="total_qty" required autocomplete="off">
                      <input type="hidden" class="form-control" id="total_qty_value" name="total_qty_value" autocomplete="off">
                  </div>
                  </div>
                  
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Create WIP </button>
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
          url: base_url + '/wip/getTableItemRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')" required>'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="partno[]" id="partno_'+row_id+'" class="form-control" ><input type="hidden" name="partno_value[]" id="partno_value_'+row_id+'" class="form-control"></td>'+
                
                    '<td><input type="text" name="nolot[]" id="nolot_'+row_id+'" class="form-control" required ></td>'+
                 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="note[]" id="note_'+row_id+'" class="form-control" ><input type="hidden" name="note_value[]" id="note_value_'+row_id+'" class="form-control"></td>'+
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

    } else {
      $.ajax({
        url: base_url + 'wip/getItemValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          
          $("#partno_"+row_id).val(response.name);
          $("#partno_value_"+row_id).val(response.name);

          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the order
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
</script>