<head>
 </head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Surat Perintah Produksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Perintah Produksi</li>
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
            <h3 class="box-title">Print Surat Perintah Produksi </h3>
          </div>
          <div class="box-body">
            <table id="manageTableSpi" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date Created</th>
                <th>Date Inspection</th>
                <th>Operator Name</th>
                <th>Shift</th>
                <th>Status</th>
                <th>Confirmation</th>
                <?php if(in_array('updateWip', $user_permission) || in_array('viewWip', $user_permission) || in_array('deleteWip', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>           
              </tr>
              </thead>
              
            </table>
          </div>
          <h4 align="center">Jika Pengecekan Part NO sesuai SPI Tidak tercapai silahkan Delete Partno tersebut, agar di limpahkan ke SPI berikutnya . </h4>
          <!-- /.box-header -->
          <div class="box-body">
          <table id="manageTableSpiItem" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date </th>
                <th>Operator Name</th>
                <th>Shift</th>
                <th>Customer</th>
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>Qty SPI</th>
                <?php if(in_array('updateWip', $user_permission) || in_array('viewWip', $user_permission) || in_array('deleteWip', $user_permission)): ?>
                  <th>Action delete</th>
                <?php endif; ?>   
              </tr>
              </thead>
             
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

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
            <h3 class="box-title">STOK-WIP QC </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date </th>
                <th>Leader Name</th>
                <th>Operator Name</th>
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>STOK WIP</th>
             
                
              </tr>
              </thead>
              <tfoot>
              <tr id="hasil">
                <td>TOTAL :</td>
                <td></td>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->

  <section class="content">
  
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 ">

        <div id="messages"></div>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Filter Berdasarkan Tanggal </h3>
          </div>
          <div class="box-header">
           
         
        <div class="row">
          <div class="col-md-12">
                <div class="row">
                <div class="col-md-5">
                <div class="md-form md-outline input-with-post-icon datepicker">
                 <label for="example">Dari</label>
                 <input placeholder="Select date" type="date" id="start_date" class="form-control"> 
                     
                 
                </div>
                </div>

                <div class="col-md-5">
                <div class="md-form md-outline input-with-post-icon datepicker">
                <label for="example">SAMPAI </label>
                       <input placeholder="Select date" type="date" id="end_date" class="form-control"> 
                     
               </div>
               </div>

           </div>
              
           <div>
                    <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                </div>
                </div>

        </div>    
        <br>      

        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="records" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Date </th>
                <th>Leader Name</th>
                <th>Operator Name</th>
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>Total Qty</th>
                <th></th>
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
</div>
<!-- /.content-wrapper -->

<?php if(in_array('deleteWip', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('wip/removespi') ?>" method="post" id="removeForm">
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


<?php if(in_array('deleteWip', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModalSpi">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('wip/removespiitem') ?>" method="post" id="removeFormSpi">
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


  <!-- Datepicker -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
   


  <script>


    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
    </script>

<script type="text/javascript">
var manageTable;
var manageTableLot;
var records;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $("#mainSpiNav").addClass('active');
  $("#manageSpiNav").addClass('active');
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'wip/fetchDataStockWip',
    'order': [],
  });
  manageTable = $('#manageTableSpi').DataTable({
    'ajax': base_url + 'wip/fetchSpiData',
    'order': [],
  });
  manageTableSpiItem = $('#manageTableSpiItem').DataTable({
    'ajax': base_url + 'wip/fetchSpiItemData',
    'order': [],
  });
  manageTableLot = $('#manageTableLot').DataTable({
    'ajax': base_url + 'wip/fetchDataStockWipLot',
     'order': [],
  });

  manageTableData = $('#manageTableData').DataTable({
        'ajax': base_url + 'fincoming/fetchFincomingData',
       'order': [],
  });
  records = $('#records').DataTable({
   // 'ajax': base_url + 'fincoming/fetchFincomingData',
   // 'ajax': base_url + 'fincoming/records',
    'order': [],
  });
});


function fetch(start_date, end_date) {
        $.ajax({
        
            url: '<?php echo site_url('wip/records') ?>',

          // url:'http://localhost/qc/daterange/records',
            type: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(data) {
                // Datatables
                var i = "1";

                $('#records').DataTable({
                    "data": data,
                    // buttons
                    "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    // responsive
                    //data yang di terima adalah nama alias query
                    "responsive": true,
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            "data": "datecreated",
                            "render": function(data, type, row, meta) {
                                return `${row.datecreated}`;
                            }
                        },
                        {
                            "data": "leader",
                            "render": function(data, type, row, meta) {
                                return `${row.leader}`;
                            }
                        },
                        {
                            "data": "operatorname",
                            "render": function(data, type, row, meta) {
                                return `${row.operatorname}`;
                            }
                        },
                       
                        {
                            "data": "partno",
                            "render": function(data, type, row, meta) {
                                return `${row.partno}`;
                            }
                        },
                        {
                            "data": "nolot",
                            "render": function(data, type, row, meta) {
                              return `${row.nolot}`;
                            }
                        },
                        
                    
                        {
                            "data": "qty",
                            "render": function(data, type, row, meta) {
                              return `${row.qty}`;
                            }
                        }
                    ]
                });
            }
        });
    }
  
    fetch();

    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date == "" || end_date == "") {
            alert("both date required");
        } else {
            $('#records').DataTable().destroy();
            fetch(start_date, end_date);
        }
    });
    // Reset
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#records').DataTable().destroy();
        fetch();
    });
// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { sip_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

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

function removeSpiFunc(id)
{
  if(id) {
    $("#removeFormSpi").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { sip_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
          //  $("#removeModal").modal('hide');
            $("#removeModalSpi").modal('hide');

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