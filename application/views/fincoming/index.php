<head>
 </head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Data Transaksi </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Ke</a></li>
      <li class="active">Gudang</li>
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

        <?php if(in_array('createOrder', $user_permission)): ?>
          <a href="<?php echo base_url('fincoming/create') ?>" class="btn btn-primary">Add Kiriman</a>
          <br /> <br />
        <?php endif; ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Data Transaksi Outgoing</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTableData" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th width="10%">Date Created</th> 
              <th width="10%">Date Delivery</th>
                <th width="10%">Customer Name</th>
                <th width="10%">PIC</th> 
                <th width="10%">Jumlah Box</th> 
                <th width="10%">Total Delivery</th>
                <?php if(in_array('updateFincoming', $user_permission) || in_array('viewFincoming', $user_permission) || in_array('deleteFincoming', $user_permission)): ?> 
                
                <th width="20%">Action</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>



        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detail Part No yang di kirim ke Gudang</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date Create</th>
                <th>Inspection Name</th>
                <th>Customer Name</th>
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>DATA OK (QC)</th>
                <th>Qty Part </th> 
                <th>Total Pengiriman</th>     
                <?php if(in_array('updateFincoming', $user_permission) || in_array('viewFincoming', $user_permission) || in_array('deleteFincoming', $user_permission)): ?>
               
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
  <!-- /.content -->

  <section class="content">
  
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 ">

        <div id="messages"></div>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Export Ke Excell Filter Berdasarkan Tanggal </h3>
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
                <th>Date Created</th>
                <th>Inspection Name</th>
                <th>Customer Name</th>
                <th>PART NO</th>
                <th>NO LOT</th>  
                <th>Date to Warehouse</th>    
                <th>Total Qty</th>
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

<?php if(in_array('deleteFincoming', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('fincoming/remove') ?>" method="post" id="removeForm">
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
var records;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainFincomingNav").addClass('active');
  $("#manageFincomingNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
 //   'ajax': base_url + 'fincoming/fetchFincomingData',
      'ajax': base_url + 'fincoming/fetchFincomingDetailData',
    'order': [],
  });

  manageTableData = $('#manageTableData').DataTable({
         'ajax': base_url + 'fincoming/fetchFincomingData',
   //   'ajax': base_url + 'fincoming/fetchFincomingDetailData',
    'order': [],
  });

  records = $('#records').DataTable({
   // 'ajax': base_url + 'fincoming/fetchFincomingData',
  //    'ajax': base_url + 'fincoming/records',
    'order': [],
  });



});


function fetch(start_date, end_date) {
        $.ajax({
        
            url: '<?php echo site_url('fincoming/records') ?>',

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
                            "data": "operatorname",
                            "render": function(data, type, row, meta) {
                                return `${row.operatorname}`;
                            }
                        },
                       
                        {
                            "data": "customer",
                            "render": function(data, type, row, meta) {
                                return `${row.customer}`;
                            }
                        },
                        {
                            "data": "part",
                            "render": function(data, type, row, meta) {
                                return `${row.part}`;
                            }
                        },
                        {
                            "data": "nolotnew",
                            "render": function(data, type, row, meta) {
                              return `${row.nolotnew}`;
                            }
                        },
                        
                        {
                            "data": "dtw",
                            "render": function(data, type, row, meta) {
                                return `${row.dtw}`;
                            }
                        }
                        ,
                        {
                            "data": "qty",
                           
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
        data: { incoming_id:id }, 
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


  
  


</script>