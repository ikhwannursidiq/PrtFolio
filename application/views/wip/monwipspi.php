<head>
 </head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Monitoring 
      <small>WIP Di Kurangi SPI</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">By Part No - Qty</li>
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
            <h3 align="center">Data WIP Update</h3>
          </div>
          <div class="box-body">
            <table id="manageTableWipItem" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date </th> 
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>Qty WIP</th>
              </tr>
              </thead>
              
            </table>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="box-header">
            <h3 align="center" >Data SPI Update</h3>
          </div>
       <!--     <table id="manageTableLot" class="table table-bordered table-striped"> -->
       <table id="manageTableSpiItem" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date </th> 
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>Qty SPI</th>
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
            <h3 class="box-title">PENGURANGAN CUTTING DAN SPI </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTablewipspi" class="table table-bordered table-striped">
              <thead>
              <tr>
                 <th>PART NO WIP</th>
                <th>PART NO SPI</th>
                <th>Qty WIP</th>
          
                <th>Qty SPI</th>
                <th>Jumlah Stok</th>
             
                
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
var manageTableWipItem;
var manageTable;
var manageTableSpiItem;
var records;
var manageTablewipspi;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $("#mainSpiNav").addClass('active');
  $("#manageSpiNav").addClass('active');

  

  manageTableWipItem = $('#manageTableWipItem').DataTable({
    'ajax': base_url + 'wip/fetchJoinWipItem',
    'order': [],
  });
  

  manageTableSpiItem = $('#manageTableSpiItem').DataTable({
    'ajax': base_url + 'wip/fetchJoinSpiItem',
    'order': [],
  });
  manageTableLot = $('#manageTableLot').DataTable({
    'ajax': base_url + 'wip/fetchDataStockWipLot',
     'order': [],
  });

  manageTable = $('#manageTable').DataTable({
        'ajax': base_url + 'wip/pwipspi',
       'order': [],
  });

  manageTablewipspi = $('#manageTablewipspi').DataTable({
   'ajax': base_url + 'wip/allwipspi',
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