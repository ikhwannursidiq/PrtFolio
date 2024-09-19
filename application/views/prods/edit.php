

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>P.I.S</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">P.I.S</li>
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
            <h3 class="box-title">Edit P.I.S</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $prod_data ['prod']['drw'] ?>" width="150" height="150" class="img-circle">
                </div>

                <div class="form-group">
                  <label for="product_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

   <div class="col-md-4 col-xs-12 pull pull-left">
                <div class="form-group">
                  <label for="sku">Part No</label>
                  <input type="text" class="form-control" id="nopart" name="nopart" value="<?php echo $prod_data ['prod']['nopart']; ?>"  placeholder="Enter No Part" autocomplete="off" />
                </div>
              
                <div class="form-group">
                  <label for="product_name">Part Name</label>
                  <input type="text" class="form-control" id="namepart" name="namepart"  value="<?php echo $prod_data ['prod'] ['namepart']; ?>"  placeholder="Enter product name" autocomplete="off"/>
                </div>
             
                <div class="form-group">
                  <label for="price">Material</label>
                  <input type="text" class="form-control" id="material" name="material" value="<?php echo $prod_data ['prod']['material']; ?>"  placeholder="Enter mix" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">TIPE</label>
                  <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo $prod_data ['prod']['tipe']; ?>"   placeholder="tipe" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">Customer Name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name"  value="<?php echo $prod_data['prod']['customer_name']; ?>"  placeholder="Enter price" autocomplete="off" />
                </div>
              
              </div>
              <div class="col-md-4 col-xs-12 ">
             

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($prod_data ['prod']['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($prod_data ['prod']['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>
                </div>
    </div>



      </div>
			  
			   <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:20%">ITEM PERIKSA</th>
                      <th style="width:20%">STANDARD</th>
                      <th style="width:20%">FREKUENSI</th>
                      <th style="width:20%">METODE</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                   <?php if(isset($prod_data['prod_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($prod_data['prod_item'] as $key => $detail): ?>
                        <?php //print_r($v); ?>
												<tr id='tambahproduklainnyadiv<?php echo $x;?>' >
													<td>
														<input type="text" class="form-control" id="product<?php echo $x;?>" name="product[]" placeholder="met" value="<?php echo $detail['product']; ?>" >
													</td>
                          <td>
														<input type="text" class="form-control" id="standard<?php echo $x;?>" name="standard[]" placeholder="std" value="<?php echo $detail['standard'];?>">
													</td> 	
                          <td>
														<input type="text" class="form-control" id="frekuensi<?php echo $x;?>" name="frekuensi[]" placeholder="std" value="<?php echo $detail['frekuensi'];?>">
													</td> 
													<td>
														<input type="text" class="form-control" id="metode<?php echo $x;?>" name="metode[]" placeholder="met" value="<?php echo $detail['metode'];?>">
													</td>
																
															</tr>
											  <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>

                           



                </table>
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

    $("#mainProdNav").addClass('active');
    $("#manageProdNav").addClass('active');
    
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