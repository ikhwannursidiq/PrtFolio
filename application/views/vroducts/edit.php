

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
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
            <h3 class="box-title">Edit Supplier</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

               
                <div class="form-group">
                  <label for="product_name">Supplier name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter supplier name" value="<?php echo $vroduct_data['name']; ?>"  autocomplete="off"/>
                </div>
              
               <div class="form-group">
                  <label for="sku">alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $vroduct_data['alamat']; ?>"  placeholder="Ente alamat" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">telp</label>
                  <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $vroduct_data['telp']; ?>"  placeholder="Enter telp" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">fax</label>
                  <input type="text" class="form-control" id="fax" name="fax" value="<?php echo $vroduct_data['fax']; ?>"  placeholder="Enter price" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">attn</label>
                  <input type="text" class="form-control" id="attn" name="attn" value="<?php echo $vroduct_data['attn']; ?>"  placeholder="Enter Qty" autocomplete="off" />
                </div>
                
             

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($vroduct_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($vroduct_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
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
  
  $(document).ready(function() {
    $(".select_group").select2();
   // $("#description").wysihtml5();

    $("#mainVroductNav").addClass('active');
    $("#manageVroductNav").addClass('active');
    
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
</script>