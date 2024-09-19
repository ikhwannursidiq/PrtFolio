
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
      <li class="active">Material</li>
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
            <h3 class="box-title">Add Material</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('material/create') ?>" method="post" enctype="multipart/form-data">
   
            <div class="box-body">
              <div class="col-md-6 col-xs-12 pull pull-left">
                <?php echo validation_errors(); ?>

                <div class="form-group">

                  <label for="product_image">Image Material</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                 
                 <label for="product_name">Code Material</label>
                 <input type="text" class="form-control" id="codematerial" name="codematerial" placeholder="Enter Material Code" autocomplete="off"/>
          
                
               </div> 

                <div class="form-group">
                 
                  <label for="product_name">Material no</label>
                  <input type="text" class="form-control" id="product_no" name="product_no" placeholder="Enter product no" autocomplete="off"/>
           
                 
                </div> 
                <div class="form-group">
                  <label for="product_name">Material name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" autocomplete="off"/>
                </div>
                
                <div class="form-group ">
                  <label for="store">Supplier</label>
                  <select class="form-control select_group" id="supplier" name="supplier">
                    <?php foreach ($datasupplier as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="price">Category</label></br>
                  <select class="form-control" id="category" name="category" onclick='test()' onchange="getCategoryData()"  >
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="product_name">Category name</label>
                  <input type="text" class="form-control" id="namacategory" name="namacategory" placeholder="Enter category name" autocomplete="off" require/>
                </div>


                <div class="form-group">
                  <label for="product_name">Unit / Satuan</label>
                  <select class="form-control" id="satuan" name="satuan">
                    <option value="Pcs">Pcs</option>
                    <option value="Meter">Meter</option>
                    <option value="Kg">Kg</option>
                    <option value="Liter">Liter</option>
                    <option value="Roll">Roll</option>
                  </select>
               
                </div>
           
               

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

              

             <div id="extra" name="extra" style="display:none" >
                  <label for="qty"><h3><u>Spesifikasi material Compound:</u></h3></label>
                  <div>
                  <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="unit">Berat</label> 
                        <input type="text" class="form-control" id="bm" name="bm" placeholder="Enter bm" autocomplete="off" /> 
                        <label for="unit">BRT MIN</label>
                        <input type="text" class="form-control" id="bmmin" name="bmmin" placeholder="Enter bmmax" autocomplete="off" />
                        <label for="unit">BRT MAX</label>
                        <input type="text" class="form-control" id="bmmax" name="bmmax" placeholder="Enter bmmax" autocomplete="off" />
                    </div>
                  <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="unit">HS</label> 
                        <input type="text" class="form-control" id="hs" name="hs" placeholder="Enter hs" autocomplete="off" /> 
                        <label for="unit">HS MIN</label>
                        <input type="text" class="form-control" id="hsmin" name="hsmin" placeholder="Enter hsmax" autocomplete="off" />
                        <label for="unit">HS MAX</label>
                        <input type="text" class="form-control" id="hsmax" name="hsmax" placeholder="Enter hsmax" autocomplete="off" />
                    </div>

                    <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="description">TB</label>
                        <input type="text" class="form-control" id="tb" name="tb" placeholder="Enter tb" autocomplete="off"/>
                        <label for="unit">TB MIN</label>
                        <input type="text" class="form-control" id="tbmin" name="tbmin" placeholder="Enter tbmax" autocomplete="off" />
                        <label for="unit">TB MAX</label>
                        <input type="text" class="form-control" id="tbmax" name="tbmax" placeholder="Enter tbmin" autocomplete="off" />
                    </div>

                    <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="qty">EB</label>
                        <input type="text" class="form-control" id="eb" name="eb" placeholder="Enter EB" autocomplete="off" />
                        <label for="unit">EB MIN</label>
                        <input type="text" class="form-control" id="ebmin" name="ebmin" placeholder="Enter ebmin" autocomplete="off" />
                        <label for="unit">EB MAX</label>
                        <input type="text" class="form-control" id="ebmax" name="ebmax" placeholder="Enter ebmax" autocomplete="off" />
                    </div>
                    <div class="col-md-2 col-xs-12 pull pull-left">
                        <label for="unit">SG</label>
                        <input type="text" class="form-control" id="sg" name="sg" placeholder="Enter SG" autocomplete="off" />
                        <label for="unit">SG MIN</label>
                        <input type="text" class="form-control" id="sgmin" name="sgmin" placeholder="Enter sgmin" autocomplete="off" />
                        <label for="unit">SG MAX</label>
                        <input type="text" class="form-control" id="sgmax" name="sgmax" placeholder="Enter sgmax" autocomplete="off" />
                    </div>
              </div>
              </div>
              </div>   
              
              
              <div id="extray" name="extray" style="display:none" >
                  <label for="qty"><h3><u>Spesifikasi Sub Material:</u></h3></label>
                  <div>
  
                  <div class="col-md-2 col-xs-12 ">
                        <label for="unit">Wire Diameter</label> 
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter bm" autocomplete="off" /> 
                        <label for="unit">Wiredim min</label> 
                        <input type="text" class="form-control" id="wmin" name="wmin" placeholder="Enter min" autocomplete="off" /> 
                        <label for="unit">Wiredim  max</label> 
                        <input type="text" class="form-control" id="wmax" name="wmax" placeholder="Enter max" autocomplete="off" />
                  </div> 
                  <div class="col-md-2 col-xs-12 ">      
                        <label for="unit">Inside Diameter</label>
                        <input type="text" class="form-control" id="diameter" name="diameter" placeholder="Enter hsmax" autocomplete="off" />
                        <label for="unit">In Diameter min</label>
                        <input type="text" class="form-control" id="dmin" name="dmin" placeholder="Enter hsmax" autocomplete="off" />
                        <label for="unit">In Diameter max</label>
                        <input type="text" class="form-control" id="dmax" name="dmax" placeholder="Enter hsmax" autocomplete="off" />
                        
                      
                  </div>
                        <div class="col-md-2 col-xs-12">        
                        <label for="unit">Apperance</label> 
                    </div>
                         <select class="form-control select_group" id="apperance" name="apperance" weight="20px">
                  
                      <option value="No Rusty">No Rusty</option>
                      <option value="No Burry">No Burry</option>
                      <option value="No Deform">No Deform</option>
                      <option value="No Defect">No Defect</option>
                    
                  </select>
                    
                      </div>

                       </div>



         

              </div>

              





              <!-- /.box-body -->
                    </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('items/') ?>" class="btn btn-warning">Back</a>
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

function toggle() {
//alert(thing.options[thing.selectedIndex].innerHTML);
var w = document.getElementById("category").selectedIndex;
var selected_text = document.getElementById("category").options[w].text;
 if (selected_text == "5") {
    //alert(selected_text)
  document.getElementById("extra").innerHTML = '<input  name="sfrType[]" value="RES-Single Family"><input type="hidden" name="sfrType[]" value="RES-Farm-Ranch">'
  }   
 else if  (selected_text == "6") {
   // alert(selected_text)
  document.getElementById("extray").innerHTML = '<input  id="amin_acres" name="amin_acres" value="0.001">'
  }   
 else if (selected_text == "7") {
    //alert(selected_text)
  document.getElementById("extrax").innerHTML = '<input  name="amin_acres" value="2">'
 } else {
  document.getElementById("extrax").innerHTML ='';
 }
}



function test() {
    if (document.getElementById('category').value =='6') {
        document.getElementById('extra').style.display = 'block';

    } else if (document.getElementById('category').value =='5') {
        document.getElementById('extrax').style.display = 'block';
    }
    else if (document.getElementById('category').value =='7') {
        document.getElementById('extray').style.display = 'block';
    }

    window.setTimeout(category, 1);
}


//function test() {
 //   if (document.getElementById('category').value =='6') {
  //      document.getElementById('extra').style.display = 'block';
 //   } else {
  //      document.getElementById('extra').style.display = 'none';
  ///  }
//}

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



  $(document).ready(function() {
    $(".select_group").select2();
  //  $("#description").wysihtml5();

    $("#mainItemNav").addClass('active');
    $("#addItemNav").addClass('active');

    
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