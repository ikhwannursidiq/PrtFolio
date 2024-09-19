<style>

.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Sub Material</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Sub Material</li>
    </ol>



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

        <?php if(in_array('createCompound', $user_permission)): ?>
        <!--  <button class="btn btn-primary" data-toggle="modal" data-target="#addCompoundModal">Add Supplier</button> -->
          <a href="<?php echo base_url('submaterial/create') ?>" class="btn btn-primary">Add Data Sub Material</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Input Sub Material</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Qrcode</th>
                <th>Code Sub Material</th>
                <th>Name Sub Material</th>
                <th>Supplier</th>
                <th>Qty (kg)</th>
                <th>Incoming date</th>
                <th>Expired date</th>
                <th>Result</th>
                <th>Print</th>
                <?php if(in_array('updateSubmaterial', $user_permission) || in_array('deleteSubmaterial', $user_permission)): ?>
                <th>Action</th>
                <th>NCR STATUS</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div>

          


 
	</table>
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

<?php if(in_array('createSupmaterial', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addSubmaterialModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Sub Material</h4>
      </div>

      <form role="form" action="<?php echo base_url('submaterial/create') ?>" method="post" id="createSubmaterialForm">

<div class="modal-body " >

<!--Tambah menu input di die -->
<div class="col-md-6 col-xs-12 pull pull-left">
      <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Enter supplier" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="supplier_name">Code Compound</label>
            <input type="text" class="form-control" id="codecompound" name="codecompound" placeholder="Enter code" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="telp">Name Compound</label>
            <input type="text" class="form-control" id="namecompound" name="namecompound" placeholder="Enter Compound" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="fax">Qty Compound</label>
            <input type="number" class="form-control" id="qtycompound" name="qtycompound" placeholder="Enter No Fax" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="alamat">Incoming Date</label>
            <input type="date" class="form-control" id="incomingdate" name="incomingdate"  autocomplete="off">
          </div>
          <div class="form-group">
            <label for="telp">Expired date</label>
            <input type="date" class="form-control" id="expireddate" name="expireddate"  autocomplete="off">
          </div>


          <div class="form-group">
            <label for="active">Action</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>
        </div>




      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateCompound', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editCompoundModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Compound</h4>
      </div>

      <form role="form" action="<?php echo base_url('compound/update') ?>" method="post" id="updateSupplierForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_supplier_name">Supplier Name</label>
            <input type="text" class="form-control" id="edit_supplier_name" name="edit_supplier_name" placeholder="Enter supplier name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_telp">Telephone</label>
            <input type="number" class="form-control" id="edit_telp" name="edit_telp" placeholder="Enter No Telp" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_fax">FAX</label>
            <input type="number" class="form-control" id="edit_fax" name="edit_fax" placeholder="Enter No Fax" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_alamat">Alamat</label>
            <input type="text" class="form-control" id="edit_alamat" name="edit_alamat" placeholder="Enter Alamat" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_attn">Atas Nama</label>
            <input type="text" class="form-control" id="edit_attn" name="edit_attn" placeholder="Enter No atas nama" autocomplete="off">
          </div>



          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('viewCompound', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailCompoundModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Compound</h4>
      </div>

      <form role="form" action="<?php echo base_url('compound/update') ?>" method="post" id="updateSupplierForm">

        <div class="modal-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" >Active</a>
                <h3>Test </h3>
                
            </li>
         
       </ul>
       <ul class="nav nav-tabs">
            
            <li class="nav-item">
                <a class="nav-link" >Link</a>
                <h3>Test 1</h3>
                
            </li>
           
       </ul>
        




        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteSubmaterial', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeSubmaterialModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Compound</h4>
      </div>

      <form role="form" action="<?php echo base_url('submaterial/remove') ?>" method="post" id="removeSubmaterialForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;

$(document).ready(function() {

  $("#submaterialNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchSubmaterialData',
    'order': []
  });

  // submit the create from 
  $("#createCompoundForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addSupplierModal").modal('hide');

          // reset the form
          $("#createCompoundForm")[0].reset();
          $("#createCompoundForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });


});

function editSupplier(id)
{ 
  $.ajax({
    url: 'fetchSupplierDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_supplier_name").val(response.name);
      $("#edit_telp").val(response.telp);
      $("#edit_fax").val(response.fax);
      $("#edit_alamat").val(response.alamat);
      $("#edit_attn").val(response.attn);
      $("#edit_active").val(response.active);

      // submit the edit from 
      $("#updateSupplierForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
             // $("#editSupplierModal").modal('hide');
             $("#editCompoundModal").modal('hide');
              // reset the form 
              $("#updateSupplierForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

function detailSubmaterial(id)
{ 
  $.ajax({
    url: 'fetchSubmaterialDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#nolot").val(response.nolot);
      $("#comp_active").val(response.active);

      // submit the edit from 
      $("#updateSubmaterialForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
             // $("#editSupplierModal").modal('hide');
             $("#detailSubmaterialModal").modal('hide');
              // reset the form 
              $("#updateSubmaterialForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

function removeSubmaterial(id)
{
  if(id) {
    $("#removeSubmaterialForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { submaterial_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeSubmaterialModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>
