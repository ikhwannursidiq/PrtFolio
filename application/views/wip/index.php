<head>

<style>

table,
td {
    border: 1px solid #FFDEAD;
    font-size:20 px;
     background-color: #DCDCDC;
     border-radius : 10px;
}

thead,
tfoot {
    background-color:#4682B4;
    color: #ffffff;
    border: 2px solid red;
     border-radius: 50px 20px;
}
</style>
 </head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>STOK WIP DI QC</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok WIP</li>
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

      
        <div class="box-body">
          <!--
            <table id="manageTableWip" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date</th>
                <th>Leader Group</th>
                <th>Operator Name</th>
                <th>Shift</th>
                <th>Total input Part No</th>
                <?php if(in_array('updateWip', $user_permission) || in_array('viewWip', $user_permission) || in_array('deleteWip', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>
              </tr>
              </thead>
              
            </table>
                -->
          </div>
              




          <div class="box-header">
            <h3 class="box-title">TOTAL STOK WIP QC </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTableLot" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date </th>
                <th>Customer Name</th>
                <th>Leader Name</th>
                <th>Operator Name</th>
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>STOK WIP Before</th> 
                <th>STOK WIP After</th> 
              </tr>
              </thead>
              <tfoot>
              <tr >
          
                <th  colspan="6" style="text-align:center"> Total STOK WIP QC</th>
               
                <th></th>
                <th></th>
            
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
            <h3 class="box-title">STOK UPDATE QC SETELAH SPI </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="8%">Date </th>
                <th>Customer Name</th>
                <th width="8%">Leader Name</th>
                <th width="10%">Operator Name</th>
                <th width="15%">PART NO</th>
                <th>NO LOT</th>
                <th width="10%">STOK WIP</th>
             
                
              </tr>
              </thead>
              <tfoot>
              <tr >
            
                <th  colspan="5" style="text-align:center"> Total STOK WIP QC</th>
               
                <th></th>
            
            
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
                <th>Customer Name</th>
                <th>Leader Name</th>
                <th>Operator Name</th>
                <th>PART NO</th>
                <th>NO LOT</th>
                <th>Total Qty Before</th>
                <th>Total Qty After</th>
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

      <form role="form" action="<?php echo base_url('wip/remove') ?>" method="post" id="removeForm">
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"> </script>
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
  var manageTableWip;
var manageTable;
var manageTableLot;
var records;
var base_url ="<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainWipNav").addClass('active');
  $("#manageWipNav").addClass('active');
  manageTableWip = $('#manageTableWip').DataTable({
    'ajax': base_url + 'wip/fetchWipData',
     'order': [],


  });
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'wip/fetchDataStockWip',
 //     'ajax': base_url + 'fincoming/fetchFincomingDetailData',
 'footerCallback' : function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotal = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);



            // total stok wip
            
            
           
          $(api.column(5).footer()).html( + pageTotal + ' ( All data : ' + total + ' pcs)');
       
        },
     });


  manageTableLot = $('#manageTableLot').DataTable({
    'ajax': base_url + 'wip/fetchDataStockWipLot',
    'footerCallback' : function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotal = api
                .column(6, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);



            // total stok wip
            
             totalwip = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotalwip = api
                .column(7, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
           
          $(api.column(6).footer()).html( + pageTotal + ' ( Total seluruh data : ' + total + ' pcs)');
          $(api.column(7).footer()).html( + pageTotalwip + ' ( Sisa stok WIP : ' + totalwip + ' pcs)');
        },
     });

 // records = $('#records').DataTable({
   //   'ajax': base_url + 'wip/records',
  //  'order': [],
 // });



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
                              return `${row.id}`;
                            }
                        },
                        {
                            "data": "dateinput",
                            "render": function(data, type, row, meta) {
                                return `${row.dateinput}`;
                            }
                        },
                        {
                            "data": "customer_name",
                            "render": function(data, type, row, meta) {
                                return `${row.customer_name}`;
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
                          "data": "qtybefore",
                            "render": function(data, type, row, meta) {
                              return `${row.qtybefore}`;
                            }
                           
                        },
                        {
                            "data": "qtyafter",
                            "render": function(data, type, row, meta) {
                              return `${row.qtyafter}`;
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