<head>
    <!-- Required meta tags -->
   <!-- <meta charset="utf-8"> -->
   <!--  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
-->
    <!-- Bootstrap CSS -->
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        -->
    <!-- Datepicker -->
  <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
-->
    <!-- Datatables -->
 <!--   <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
-->
    <title></title>
</head>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Data Repair</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Repair</li>
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

        <?php if(in_array('createItem', $user_permission)): ?>
          <a href="<?php echo base_url('repair/create') ?>" class="btn btn-primary">Add Repair</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Items</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date Input</th>
                <th>Tanggal terjadi NG</th>
                <th>Part Name</th>
                <th>Part No</th>
                <th>Data NG </th>
                <th>No Lot</th>
                <th>Total Repair NG</th>
                <th>Total Repair OK</th>
                <th>Total</th>
                <th>NOTE</th>
                 <?php if(in_array('updateRepair', $user_permission) || in_array('deleteRepair', $user_permission)): ?>
                  <th>Action</th>
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
                        <div class="input-group mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fa fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" value="" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fa fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="end_date" placeholder="End Date" value=""  readonly>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <br>
                <div>
                    <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                </div>
        </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="records" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Date Input</th>
                <th>Tanggal terjadi NG</th>
                <th>Part No</th>
                <th>Data NG </th>
                <th>No Lot</th>
                <th>Total Repair NG</th>
                <th>Total Repair OK</th>
                <th>Total</th>
                <th>NOTE</th>
                <th>Goresan</th>
                <th>Tidak nempel</th>
                <th>Kebentur</th>
                <th>Saringanjebol</th>
                <th>Gelembung</th>
                <th>Bintik</th>
                <th>Lukadalam</th>
                <th>Lukaluar</th>
                <th>Retak</th>
                <th>Bergaris</th>
				<th>Hose pendek</th>
                <th>Over</th>
                <th>Wrappingan</th>
                <th>Braidingan</th>
                <th>Bolong</th>
                <th>Tipis</th>
                <th>Karetnempel</th>
                <th>Tebal</th>
				        <th>Porisiti</th>
                <th>Bekastangan</th>
                <th>Sobek</th>
                <th>Oval</th>
                <th>Benengrusak</th>
                <th>Siwak</th>
                <th>Keropos</th>
                <th>Holetube</th>
				        <th>Seret</th>
                <th>Sempit</th>
                <th>Saringan pendek</th>
                <th>Diameter kecil</th>
                <th>Others</th>
                <th>RP</th>
                <th>Shape</th>
                <th>Gap</th>
				        <th>Gelombang</th>
                <th>Diameterbesar</th>
                <th>Ring longgar</th>
                <th>NG Marking</th>
                <th>NG Assy</th>
                <th>Watermark</th>
                <th>Bertelur</th>
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
</div>
<!-- /.content-wrapper -->

<?php if(in_array('deleteRepair', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Item</h4>
      </div>

      <form role="form" action="<?php echo base_url('repair/remove') ?>" method="post" id="removeForm">
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript"
      src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
  </script>
  <!-- Momentjs -->
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
-->

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

  $("#mainRepairNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'Repair/fetchData',
    'repair': []
  });

});



function fetch(start_date, end_date) {
        $.ajax({
        
            url: '<?php echo site_url('repair/records') ?>',

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
                            "data": "1",
                            "render": function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            "data": "date",
                            "render": function(data, type, row, meta) {
                                return `${row.date}`;
                            }
                        },
                        {
                            "data": "dateng",
                            "render": function(data, type, row, meta) {
                                return `${row.dateng}`;
                            }
                        },
                        {
                            "data": "partno",
                            "render": function(data, type, row, meta) {
                                return `${row.partno}`;
                            }
                        },
                        {
                            "data": "ng",
                            "render": function(data, type, row, meta) {
                                return `${row.ng}`;
                            }
                        },
                        {
                            "data": "nolot",
                            "render": function(data, type, row, meta) {
                                return `${row.nolot}`;
                            }
                        },
                       
                        {
                            "data": "qtyng",
                            "render": function(data, type, row, meta) {
                                return `${row.qtyng}`;
                            }
                        },
                        {
                            "data": "qtyok",
                            "render": function(data, type, row, meta) {
                                return `${row.qtyok}`;
                            }
                        },
                        {
                            "data": "inputok",
                            "render": function(data, type, row, meta) {
                                return `${row.inputok}`;
                            }
                        },
                        {
                            "data": "note",
                            "render": function(data, type, row, meta) {
                                return `${row.note}`;
                            }
                        }	,
                        {
                            "data": "goresan",
                            "render": function(data, type, row, meta) {
                                return `${row.goresan}`;
                            }
                        },
                        {
                            "data": "tidaknempel",
                            "render": function(data, type, row, meta) {
                                return `${row.tidaknempel}`;
                            }
                        },
                        {
                            "data": "kebentur",
                            "render": function(data, type, row, meta) {
                                return `${row.kebentur}`;
                            }
                        },
                        {
                            "data": "saringanjebol",
                            "render": function(data, type, row, meta) {
                                return `${row.saringanjebol}`;
                            }
                        },
                        {
                            "data": "gelembung",
                            "render": function(data, type, row, meta) {
                                return `${row.gelembung}`;
                            }
                        },
                        {
                            "data": "bintik",
                            "render": function(data, type, row, meta) {
                                return `${row.bintik}`;
                            }
                        },
                        {
                            "data": "lukadalam",
                            "render": function(data, type, row, meta) {
                                return `${row.lukadalam}`;
                            }
                        },
                        {
                            "data": "lukaluar",
                            "render": function(data, type, row, meta) {
                                return `${row.lukaluar}`;
                            }
                        },
                        {
                            "data": "retak",
                            "render": function(data, type, row, meta) {
                                return `${row.retak}`;
                            }
                        },
                        {
                            "data": "bergaris",
                            "render": function(data, type, row, meta) {
                                return `${row.bergaris}`;
                            }
                        },
                        {
                            "data": "hosependek",
                            "render": function(data, type, row, meta) {
                                return `${row.hosependek}`;
                            }
                        },
                        {
                            "data": "oper",
                            "render": function(data, type, row, meta) {
                                return `${row.oper}`;
                            }
                        },
                        {
                            "data": "wrappingan",
                            "render": function(data, type, row, meta) {
                                return `${row.wrappingan}`;
                            }
                        },
                        {
                            "data": "braidingan",
                            "render": function(data, type, row, meta) {
                                return `${row.braidingan}`;
                            }
                        },
                        {
                            "data": "bolong",
                            "render": function(data, type, row, meta) {
                                return `${row.bolong}`;
                            }
                        },
                        {
                            "data": "tipis",
                            "render": function(data, type, row, meta) {
                                return `${row.tipis}`;
                            }
                        },
                        {
                            "data": "karetnempel",
                            "render": function(data, type, row, meta) {
                                return `${row.karetnempel}`;
                            }
                        },
                        {
                            "data": "tebal",
                            "render": function(data, type, row, meta) {
                                return `${row.tebal}`;
                            }
                        },
                        {
                            "data": "porisiti",
                            "render": function(data, type, row, meta) {
                                return `${row.porisiti}`;
                            }
                        },
                        {
                            "data": "bekastangan",
                            "render": function(data, type, row, meta) {
                                return `${row.bekastangan}`;
                            }
                        },
                        {
                            "data": "sobek",
                            "render": function(data, type, row, meta) {
                                return `${row.sobek}`;
                            }
                        },
                        {
                            "data": "oval",
                            "render": function(data, type, row, meta) {
                                return `${row.oval}`;
                            }
                        },
                        {
                            "data": "benangrusak",
                            "render": function(data, type, row, meta) {
                                return `${row.benangrusak}`;
                            }
                        },
                        {
                            "data": "siwak",
                            "render": function(data, type, row, meta) {
                                return `${row.siwak}`;
                            }
                        },
                        {
                            "data": "keropos",
                            "render": function(data, type, row, meta) {
                                return `${row.keropos}`;
                            }
                        },
                        {
                            "data": "holetube",
                            "render": function(data, type, row, meta) {
                                return `${row.holetube}`;
                            }
                        },
                        {
                            "data": "seret",
                            "render": function(data, type, row, meta) {
                                return `${row.seret}`;
                            }
                        },
                        {
                            "data": "sempit",
                            "render": function(data, type, row, meta) {
                                return `${row.sempit}`;
                            }
                        },
                        {
                            "data": "springpendek",
                            "render": function(data, type, row, meta) {
                                return `${row.springpendek}`;
                            }
                        },
                        {
                            "data": "diameterkecil",
                            "render": function(data, type, row, meta) {
                                return `${row.diameterkecil}`;
                            }
                        },
                        {
                            "data": "others",
                            "render": function(data, type, row, meta) {
                                return `${row.others}`;
                            }
                        },
                        {
                            "data": "rp",
                            "render": function(data, type, row, meta) {
                                return `${row.rp}`;
                            }
                        },
                        {
                            "data": "shape",
                            "render": function(data, type, row, meta) {
                                return `${row.shape}`;
                            }
                        },
                        {
                            "data": "gap",
                            "render": function(data, type, row, meta) {
                                return `${row.gap}`;
                            }
                        },
                        {
                            "data": "gelombang",
                            "render": function(data, type, row, meta) {
                                return `${row.gelombang}`;
                            }
                        },
                        {
                            "data": "diameterbesar",
                            "render": function(data, type, row, meta) {
                                return `${row.diameterbesar}`;
                            }
                        },
                        {
                            "data": "ringlonggar",
                            "render": function(data, type, row, meta) {
                                return `${row.ringlonggar}`;
                            }
                        },
                        {
                            "data": "ngmarking",
                            "render": function(data, type, row, meta) {
                                return `${row.ngmarking}`;
                            }
                        },
                        {
                            "data": "ngassy",
                            "render": function(data, type, row, meta) {
                                return `${row.ngassy}`;
                            }
                        },
                        {
                            "data": "watermark",
                            "render": function(data, type, row, meta) {
                                return `${row.watermark}`;
                            }
                        },
                        {
                            "data": "bertelur",
                            "render": function(data, type, row, meta) {
                                return `${row.bertelur}`;
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
        data: { repair_id:id }, 
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
