

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Konsumens</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Konsumen</li>
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
            <h3 class="box-title">Edit Customer</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('konsumens/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $konsumen_data['image'] ?>" width="150" height="150" class="img-circle">
                </div>

                <div class="form-group">
                  <label for="product_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sku">Customer Code</label>
                  <input type="text" class="form-control" id="kode" name="kode" placeholder="add" value="<?php echo $konsumen_data['kode']; ?>" readonly autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="product_name">Customer Name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nama Customer" value="<?php echo $konsumen_data['name']; ?>"  autocomplete="off"/>
                </div>
                <div class="form-group">
                  <label for="qty">PIC</label>
                  <select class="form-control select_group" id="pic" name="pic">
                    <?php foreach ($pic as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if($konsumen_data['pic_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?>,<?php echo $v['bagian'] ?></option>
                    <?php endforeach ?>
                  </select>
                  
                  
                </div>

                <div class="form-group">
                  <label for="sku">Address</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="add" value="<?php echo $konsumen_data['alamat']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">Telp</label>
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="Telp" value="<?php echo $konsumen_data['telp']; ?>" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="sku"> Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $konsumen_data['email']; ?>"  autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">FAX</label>
                  <input type="text" class="form-control" id="fax" name="fax" placeholder="FAX" value="<?php echo $konsumen_data['fax']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Currency</label>
                  <select class="form-control select_group" id="currency" name="currency">
                    <?php foreach ($currency as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if($konsumen_data['currency_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                 
               
                </div>
                
                <div class="form-group">
                  <label for="qty">NPWP</label>
                  <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP " value="<?php echo $konsumen_data['npwp']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Pay Term</label>
                  <input type="text" class="form-control" id="payterm" name="payterm" placeholder="Pay term " value="<?php echo $konsumen_data['payterm']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Bank </label>
               
                  <select class="form-control select_group" id="bank" name="bank">
                    <?php foreach ($bank as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if($konsumen_data['bank_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                
                </div>

                <div class="form-group">
                  <label for="qty">Account number</label>
                  <input type="text" class="form-control" id="accountno" name="accountno" placeholder="account number " value="<?php echo $konsumen_data['accountno']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Website</label>
                  <input type="text" class="form-control" id="website" name="website" placeholder=" website" value="<?php echo $konsumen_data['website']; ?>" autocomplete="off" />
                </div>
              

              
                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($konsumen_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($konsumen_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
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
   // $("#description").wysihtml5();

    $("#mainKonsumenNav").addClass('active');
    $("#manageKonsumenNav").addClass('active');
    
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