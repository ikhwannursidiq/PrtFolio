

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Material</small>
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
        <div class="col-md-6 col-xs-12 pull pull-left">
          <div class="box-header">
            <h3 class="box-title">Edit Data Compound</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('material/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $material_data['image'] ?>" width="100%" height="100%" class="img-jumbotron">
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
                 
                 <label for="product_name">Material no</label>
                 <input type="text" class="form-control" id="product_no" name="product_no" value="<?php echo $material_data['matno']; ?>" placeholder="Enter product no" autocomplete="off"/>
          
                
               </div> 
               <div class="form-group">
                 <label for="product_name">Material name</label>
                 <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name"  value="<?php echo $material_data['matname']; ?>"autocomplete="off"/>
               </div>
               
               <div class="form-group ">
                 <label for="store">Supplier</label>
                 <select class="form-control select_group" id="supplier" value="<?php echo $material_data['supplier_id']; ?>" name="supplier">
                   <?php foreach ($datasupplier as $k => $v): ?>
                    <option value="<?php echo $v['id'] ?>"<?php if($material_data['supplier_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>      
                    <?php endforeach ?>
                 </select>
               </div>

               <div class="form-group">
                 <label for="price">Category</label>
                
                  <select class="form-control select_group" id="category" name="category" onChange="getCategoryData()" >
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"<?php if($material_data['category_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
               </div>

               <div class="form-group">
                  <label for="product_name">Category name</label>
                  <input type="text" class="form-control" id="namacategory" name="namacategory" placeholder="Enter category name" autocomplete="off" require/>
                </div>
           

               <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control select_group" id="availability" name="availability">
                    <option value="1" <?php if($material_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if( $material_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>


            <div class="form-group">
                 <label for="qty"><h3><u>Spesifikasi Material :</u></h3></label>
             </div>
             <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="unit">Berat</label> 
                        <input type="text" class="form-control" id="bm" name="bm" value="<?php echo $material_data['bm']; ?>" placeholder="Enter bm" autocomplete="off" /> 
                        <label for="unit">BRT MIN</label>
                        <input type="text" class="form-control" id="bmmin" name="bmmin" value="<?php echo $material_data['bmmin']; ?>" placeholder="Enter bmmax" autocomplete="off" />
                        <label for="unit">BRT MAX</label>
                        <input type="text" class="form-control" id="bmmax" name="bmmax" value="<?php echo $material_data['bmmax']; ?>" placeholder="Enter bmmax" autocomplete="off" />
                    </div>
                  <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="unit">HS</label> 
                        <input type="text" class="form-control" id="hs" name="hs" value="<?php echo $material_data['hs']; ?>" placeholder="Enter hs" autocomplete="off" /> 
                        <label for="unit">HS MIN</label>
                        <input type="text" class="form-control" id="hsmin" name="hsmin" value="<?php echo $material_data['hsmin']; ?>" placeholder="Enter hsmax" autocomplete="off" />
                        <label for="unit">HS MAX</label>
                        <input type="text" class="form-control" id="hsmax" name="hsmax" value="<?php echo $material_data['hsmax']; ?>" placeholder="Enter hsmax" autocomplete="off" />
                    </div>

                    <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="description">TB</label>
                        <input type="text" class="form-control" id="tb" name="tb" value="<?php echo $material_data['tb']; ?>" placeholder="Enter tb" autocomplete="off"/>
                        <label for="unit">TB MIN</label>
                        <input type="text" class="form-control" id="tbmin" name="tbmin" value="<?php echo $material_data['tbmin']; ?>" placeholder="Enter tbmax" autocomplete="off" />
                        <label for="unit">TB MAX</label>
                        <input type="text" class="form-control" id="tbmax" name="tbmax" value="<?php echo $material_data['tbmax']; ?>" placeholder="Enter tbmin" autocomplete="off" />
                    </div>

                    <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="qty">EB</label>
                        <input type="text" class="form-control" id="eb" name="eb" value="<?php echo $material_data['eb']; ?>" placeholder="Enter EB" autocomplete="off" />
                        <label for="unit">EB MIN</label>
                        <input type="text" class="form-control" id="ebmin" name="ebmin" value="<?php echo $material_data['ebmin']; ?>" placeholder="Enter ebmin" autocomplete="off" />
                        <label for="unit">EB MAX</label>
                        <input type="text" class="form-control" id="ebmax" name="ebmax" value="<?php echo $material_data['ebmax']; ?>" placeholder="Enter ebmax" autocomplete="off" />
                    </div>
                    <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="unit">SG</label>
                        <input type="text" class="form-control" id="sg" name="sg" value="<?php echo $material_data['sg']; ?>" placeholder="Enter SG" autocomplete="off" />
                        <label for="unit">SG MIN</label>
                        <input type="text" class="form-control" id="sgmin" name="sgmin" value="<?php echo $material_data['sgmin']; ?>" placeholder="Enter sgmin" autocomplete="off" />
                        <label for="unit">SG MAX</label>
                        <input type="text" class="form-control" id="sgmax" name="sgmax" value="<?php echo $material_data['sgmax']; ?>" placeholder="Enter sgmax" autocomplete="off" />
                    </div>


           
                


              </div>
              </div>
              </div>
                
              
              <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('material/') ?>" class="btn btn-warning">Back</a>
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
var base_url ="<?php echo base_url(); ?>";
  
  $(document).ready(function() {
    $(".select_group").select2();
   // $("#description").wysihtml5();

    $("#mainMaterialNav").addClass('active');
    $("#manageMaterialNav").addClass('active');
    
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

  
function getCategoryData()
  {
    var category_id = $("#category").val();    
    if(category_id == "") {
	    $("#namacategory").val("");
   
    } else {
      $.ajax({
        url: base_url + 'Material/getCategoryValueById',
        type: 'post',
        data: {category_id : category_id},
        dataType: 'json',
        success:function(response) { 
		    $("#namacategory").val(response.name);
		}  
      }); 
    }
  }
</script>