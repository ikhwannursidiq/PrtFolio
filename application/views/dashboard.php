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
    background-color:#409AFA;
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
 <!-- Main content -->
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if($is_admin == true): ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">STOK UPDATE </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Part No</th>
                <th>Stock</th>
                <th>Total WIP</th>
                <th>Total SPI</th>
              </tr>
              </thead>
              <tfoot>
              <tr >
          
                <th  colspan="2" style="text-align:center"> Total STOK WIP QC</th>
               
                <th></th>
                <th></th>
                <th></th>
               </tr>
        </tfoot>


            </table>
          </div>
          <!-- /.box-body -->

           

      <?php endif; ?>
    </section>





    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if($is_admin == true): ?>

        <div class="row">

          
      
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
              
                <p>Grafik Input QC OK</p>
              </div>
              <head>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <title>Grafik Barang OK</title>
            <?php
                                    foreach($data as $data){
                                    $nama[] = $data->nama;
                                    $ok[] = (float) $data->ok;
                                    }
              ?>

            <body>
            <canvas id="canvas" width="1850" height="380"></canvas>
            </body>
                
      </div>
      <?php endif; ?>
    </section>


    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if($is_admin == true): ?>

        <div class="row">

          
      
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
              
                <p>Grafik Input QC NG</p>
              </div>
              <head>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <title>Grafik Barang NG</title>
            <?php
                                    foreach($datang as $data){
                                    $namang[] = $data->namang;
                                    $ng[] = (float) $data->ng;
                                    }
              ?>

            <body>
            <canvas id="canvasng" width="1850" height="380"></canvas>
            </body>
                
      </div>
      <?php endif; ?>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript" src="<?php echo base_url().'assets/chartjs/chart.min.js'?>"></script>
    <script>
 
            var lineChartData = {
                labels : <?php echo json_encode($nama);?>,
                datasets : [
                     
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php echo json_encode($ok);?>
                    }
 
                ]
                 
            }
 
        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
         
    </script>


<script>
 
 var lineChartData = {
     labels : <?php echo json_encode($namang);?>,
     datasets : [
          
         {
             fillColor: "rgba(60,141,188,0.9)",
             strokeColor: "rgba(60,141,188,0.8)",
             pointColor: "#3b8bba",
             pointStrokeColor: "#fff",
             pointHighlightFill: "#fff",
             pointHighlightStroke: "rgba(152,235,239,1)",
             data : <?php echo json_encode($ng);?>
         }

     ]
      
 }

var myLine = new Chart(document.getElementById("canvasng").getContext("2d")).Line(lineChartData);

</script>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');
      manageTable  = $('#manageTable').DataTable({
        'ajax':base_url + 'dashboard/fetchJoinData', 
        'footerCallback' : function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            stok = api
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageStok = api
                .column(2, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over all pages
            total = api
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotal = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);



            // total stok wip
            
             totalwip = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotalwip = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
          $(api.column(2).footer()).html( + pageStok + ' ( All Data Stok : ' + stok + ' pcs)');
          $(api.column(3).footer()).html( + pageTotal + ' ( All Data WIP : ' + total + ' pcs)');
          $(api.column(4).footer()).html( + pageTotalwip + ' ( All Data SPI : ' + totalwip + ' pcs)');
        },

      });




    }); 
  </script>
