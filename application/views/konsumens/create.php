

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Customer</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customer</li>
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
            <h3 class="box-title">Add Customer</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('konsumens/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">

                  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sku"> Customer Code</label>
                  <input type="text" class="form-control" id="kode" name="kode"  value="<?= $kodeunik; ?>" readonly autocomplete="off" />
                </div>


                <div class="form-group">
                  <label for="product_name">Customer Name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer" autocomplete="off"/>
                </div>
               
                <div class="form-group">
                  <label for="qty">PIC</label>
                
                  <select class="form-control select_group" id="pic" name="pic">
                    <?php foreach ($pic as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?>,<?php echo $v['bagian'] ?></option>
                    <?php endforeach ?>
                  </select>
               
                </div>
                <div class="form-group">
                  <label for="sku"> Address</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"   autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">Telp</label>
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telp" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="sku"> Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="email"  autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="price">FAX</label>
                  <input type="text" class="form-control" id="fax" name="fax" placeholder="FAX" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="qty">Currency</label>
                  <select class="form-control select_group" id="currency" name="currency">
                    <?php foreach ($currency as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="qty">NPWP</label>
                  <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP " autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Pay Term</label>
                  <input type="text" class="form-control" id="payterm" name="payterm" placeholder="Pay term " autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Bank </label>
           
                  <select class="form-control select_group" id="bank" name="bank">
                    <?php foreach ($bank as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="qty">Account number</label>
                  <input type="text" class="form-control" id="accountno" name="accountno" placeholder="account number " autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Website</label>
                  <input type="text" class="form-control" id="website" name="website" placeholder=" website" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('konsumens/') ?>" class="btn btn-warning">Back</a>
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
  //  $("#description").wysihtml5();

    $("#mainKonsumenNav").addClass('active');
    $("#addKonsumenNav").addClass('active');
    
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