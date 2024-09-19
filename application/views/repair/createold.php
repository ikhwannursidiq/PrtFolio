

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Repair</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Repair</li>
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
            <h3 class="box-title">Add Data Repair</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('repair/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="store">Select Data</label>
                  <select class="form-control select_group" id="part_id" name="part_id" onchange="ambilData()" required >
                    <?php foreach ($inputsng as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['tgl'] ?> (PARTNO: <?php echo $v['nama'] ?> ) Jumlah NG : <?php echo $v['bfng'] ?> Total Pengecekan :<?php echo $v['total'] ?> No Lot : <?php echo $v['nolotnew'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>


                <div class="form-group">
                  <label for="partname">Part name</label>
                  <input type="text" class="form-control" id="partname" name="partname" placeholder="automatic" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="partno">Part No</label>
                  <input type="text" class="form-control" id="partno" name="partno" placeholder="automatic" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="nolot">No Lot</label>
                  <input type="text" class="form-control" id="nolot" name="nolot" placeholder="automatic" autocomplete="off" />
             
                </div>

                <div class="form-group">
                  <label for="nolot">Tanggal NG</label>
                  <input type="text" class="form-control" id="dateng" name="dateng" placeholder="automatic" autocomplete="off" />
             
                </div>

                <div class="form-group">
                  <label for="qtyng">Jumlah NG</label>
                  <input type="text" class="form-control" id="qtyng" name="qtyng" placeholder=" automatic" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="qtyrepair">Input QTY </label>
                  <input type="text" class="form-control" id="qtyrepair" name="qtyrepair" placeholder="Enter qty repair" autocomplete="off" />
                </div>

               

                

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('repair/') ?>" class="btn btn-warning">Back</a>
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
  //  $("#description").wysihtml5();

    $("#mainRepairNav").addClass('active');
    $("#addRepairNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });

  function ambilData()
  {
    var repair_id = $("#part_id").val();    
    if(repair_id == "") {
      $("#partname").val("");
      $("#partno").val("");
      $("#dateng").val("");
      $("#nolot").val("");
      $("#qtyng").val("");

    } else {
      $.ajax({
        url: base_url + 'Repair/getRepairValueById',
        type: 'post',
        data: {repair_id : repair_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#partname").val(response.nama);
          $("#partno").val(response.nama);
          $("#nolot").val(response.nolotnew);
          $("#qtyng").val(response.bfng);
          $("#dateng").val(response.waktu);
          
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }
</script>