
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />

    <title> DATE RANGE</title>
</head>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Laporan QC</small>
   
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan QC</li>
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
           
          </div>
          <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                </div>
          <!-- /.box-header -->
          <div class="row mt-3">
                    <div class="col-md-12">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless display nowrap" id="records" style="width:100%">
                                <thead>
                                    <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Category Inspection</th>
                <th>Jam</th>
                <th>Shift</th>
                <th>Nama Karyawan</th>
                <th>Part No</th>
                <th>No Lot</th>
                <th>No Lot New</th>
                <th>OK</th>
                <th>NG </th>
                <th>Total</th>
                <th>Goresan</th>
                <th>Tidak nempel</th>
                <th>Kebentur</th>
                <th>Saringan jebol</th>
                <th>Gelembung</th>
                <th>Bintik</th>
                <th>Luka dalam</th>
                <th>Luka luar</th>
                <th>Retak</th>
                <th>Bergaris</th>
                <th>Hose Pendek </th>
                <th>Over</th>
                <th>Wrappingan</th>
                <th>Braidingan</th>
                <th>Bolong</th>
                <th>Tipis</th>
                <th>Karet nempel </th>
                <th>Tebal</th>
                <th>Porisiti</th>
                <th>Bekas Tangan</th>
                <th>Sobek </th>
                <th>Oval</th>
                <th>Benang Rusak </th>
                <th>Siwak</th>
                <th>Keropos</th>
                <th>Hole Tube</th>
                <th>Spring Pendek</th>
                <th>Ring Miring</th>
                <th>Sempit </th>
                <th>Diameter kecil</th>
                <th>Diameter Besar</th>
                <th>Jarak Ring Pendek</th>
				<th>Shape</th>
				<th>Gap</th>
                <th>Gelombang</th>
				<th>Jarak Ring Panjang</th>
				<th>POTONGAN</th>
				<th>HAGARE</th>
				<th>Watermark</th>
                <th>Bertelur</th>
                <th>Other</th>
                <th>Note</th>
                <th>History</th>
            </tr>
            </thead>
            </table>
                        </div>
                    </div>
                </div>
       
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

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

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

<script>
    // Fetch records

    function fetch(start_date, end_date) {
        $.ajax({
          //  url: "records.php",  
          //     url: base_url "exports/records",
             
          //  url: "http:localhost/qc/exports/records",
            url: '<?php echo site_url('daterange/records') ?>',

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
                    "responsive": true,
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            "data": "tgl"
                        },
                        {
                            "data": "category"
                        },
                        {
                            "data": "waktu",
                            "render": function(data, type, row, meta) {
                                return `${row.waktu}`;
                            }
                        },
                        {
                            "data": "shift",
                            "render": function(data, type, row, meta) {
                                return `${row.shift}`;
                            }
                        },
                        {
                            "data": "operatorname"
                        },
                        {
                            "data": "nama",
                            "render": function(data, type, row, meta) {
                              return `${row.nama}`;
                            }
                        }
                        ,
                        {
                            "data": "nolot"
                        },
                        {
                            "data": "nolotnew"
                        },
                        
                        {
                            "data": "ok"
                        },

                        
                        {
                            "data": "ng"
                        },

                        
                        {
                            "data": "total"
                        },

                        
                        {
                            "data": "goresan"
                        },

                        
                        {
                            "data": "tidaknempel"
                        },
                        
                        {
                            "data": "kebentur"
                        },
                        
                        {
                            "data": "saringanjebol"
                        },

                        
                        {
                            "data": "gelembung"
                        },

                        
                        {
                            "data": "bintik"
                        },

                        
                        {
                            "data": "lukadalam"
                        },

                        
                        {
                            "data": "lukaluar"
                        }
                        ,
                        {
                            "data": "retak"
                        },
                        
                        {
                            "data": "bergaris"
                        },

                      
                        {
                            "data": "hosependek"
                        },

                        
                        {
                            "data": "oper"
                        },

                        
                        {
                            "data": "wrappingan"
                        },

                        
                        {
                            "data": "braidingan"
                        },

                        
                        {
                            "data": "bolong"
                        },
                        
                        {
                            "data": "tipis"
                        },

                        
                        {
                            "data": "karetnempel"
                        },

                        
                        {
                            "data": "tebal"
                        },

                        
                        {
                            "data": "porisiti"
                        },

                        
                        {
                            "data": "bekastangan"
                        }, 
                        
                        {
                            "data": "sobek"
                        },

                        {
                            "data": "oval"
                        },
                        {
                            "data": "benangrusak"
                        },

                        {
                            "data": "siwak"
                        },

                        {
                            "data": "keropos"
                        },

                        {
                            "data": "holetube"
                        },

                        {
                            "data": "springpendek"
                        },

                        {
                            "data": "seret"
                        },
                        {
                            "data": "sempit"
                        },

                        {
                            "data": "diameterkecil"
                        },

                        {
                            "data": "diameterbesar"
                        },

                        {
                            "data": "rp"
                        },

                        {
                            "data": "shape"
                        },

                        {
                            "data": "gap"
                        },

                        {
                            "data": "gelombang"
                        },

                        {
                            "data": "ringlonggar"
                        },

                        {
                            "data": "ngmarking"
                        },

                        {
                            "data": "ngassy"
                        },

                        {
                            "data": "watermark"
                        },

                        {
                            "data": "bertelur"
                        },

                        {
                            "data": "others"
                        },
                        {
                            "data": "note"
                        },
                        {
                            "data":"history"
                        }
                     //   ,
                       // {
                         //   "data":"id"
                       // }
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
    </script>