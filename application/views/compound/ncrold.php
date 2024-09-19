<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

span.sl {
  font-weight: bold !important;
  color: #fff !important;
  background: #bc0000 !important;
  text-transform: uppercase;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>NCR</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">ncr</li>
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
            <h3 class="box-title">Form Data NCR</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                   <table class="styled-table">
                <thead>
                <tr>
                    <th width="35%"  colspan="4">Data Compound</th>
                    <th></th>
                    
                </tr>
                </thead>
                <tbody>
                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">No Surat Jalan</label></td>
                    <td colspan="4">
                    <input type="text" class="form-control" id="nosj" name="nosj" placeholder="Enter Surat Jalan" value="<?php echo $compound_data['nosj']; ?>" autocomplete="off" disabled>
                    </td>
                </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">Supplier</label></td>
                   <td colspan="4">
                   <select class="form-control select_group" id="supplier" name="supplier">
                    <?php foreach ($supplier as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if( $compound_data['supplier_id'] == $v['id']) { echo "selected='selected'"; } ?> disabled ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                </tr>

                <tr class="active-row">
                    <td  class="active-row"><label for="telp">Name Compound</label></td>
                    <td colspan="4">
                    <select class="form-control select_group" id="namecomp" name="namecomp">
                    <?php foreach ($namecompound as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if( $compound_data['namecompound'] == $v['id']) { echo "selected='selected'"; } ?> disabled ><?php echo $v['matname'] ?></option>
                    <?php endforeach ?>
                  </select>

                   </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">Code Compound</label></td>
                    <td colspan="4">
                    <input type="text" class="form-control" id="codecompound" name="codecompound" placeholder="Enter code" value="<?php echo $compound_data['codecompound']; ?>"  autocomplete="off" disabled>
                    </td>
                </tr>

               

                <tr class="active-row">
                    <td  class="active-row">    <label for="telp">No LOT</label></td>
                    <td colspan="4"> <input type="text" class="form-control" id="nolot" name="nolot" value="<?php echo $compound_data['nolot']; ?>"  autocomplete="off" disabled>
                    </td>
                </tr>

               
                <tr class="active-row">
                   <td  class="active-row"> <label for="alamat">Incoming Date</label></td>
                    <td colspan="4"> <input type="text" class="form-control"id="incomingdate" name="incomingdate" value="<?php echo $compound_data['incomingdate']; ?>"  autocomplete="off" disabled>
                </tr>

                <tr class="active-row">
                   <td  class="active-row">  <label for="telp">Expired date</label></td>
                    <td colspan="4"> <input type="text" class="form-control" id="expireddate" name="expireddate" value="<?php echo $compound_data['expireddate']; ?>"  autocomplete="off" disabled>
                </tr>

                <thead>
                <tr>
                    <th width="25%" >Check Point</th>
                    <th>Standard</th>
                    <th>Actual</th>
                    <th width="18%x">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="active-row">
                <td  class="active-row"> <label for="telp">Qty </label></td>
                    <td><input type="text" class="form-control" id="bmstd" name="bmstd"  value="<?php echo $compound_data['bmstd']; ?>"  autocomplete="off" disabled></td>
                    <td><input type="text" class="form-control" id="bmact" name="bmact" value="<?php echo $compound_data['bmact']; ?>"  autocomplete="off" disabled></td>
                    <td><select class="form-control" id="bmst" name="bmst" disabled>
                        <option value="1" <?php if($compound_data['bmst'] == 1) { echo "selected='selected'"; } ?>><span class="label label-success">OK </span></option>
                        <option value="0" <?php if( $compound_data['bmst'] != 1) { echo "selected='selected'"; } ?>><span class="label label-danger">NG </span></option>
                         </select>
                    </td> 
                </tr>


                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">HS</label></td>
                    <td><input type="text" class="form-control" id="hsstd" name="hsstd"  value="<?php echo $compound_data['hsstd']; ?>"  autocomplete="off" disabled></td>
                    <td><input type="text" class="form-control" id="hsact" name="hsact" value="<?php echo $compound_data['hsact']; ?>"  autocomplete="off" disabled></td>
                    <td><select class="form-control" id="hsst" name="hsst" disabled>
                         <option value="1" <?php if($compound_data['hsst'] == 1) { echo "selected='selected'"; } ?>><span class="label label-success">OK </span></option>
                        <option value="0" <?php if( $compound_data['hsst'] != 1) { echo "selected='selected'"; } ?>><span class="label label-danger">NG </span></option>
                    </select>
 
                    </td>         <tr class="active-row">
                   <td  class="active-row"> <label for="telp">TENSILE BREAK (TB)</label></td>
                    <td><input type="text" class="form-control" id="tbstd" name="tbstd" value="<?php echo $compound_data['tbstd']; ?>"  autocomplete="off" disabled></td>
                    <td><input type="text" class="form-control" id="tbact" name="tbact" value="<?php echo $compound_data['tbact']; ?>"  autocomplete="off" disabled></td>
                    <td><select class="form-control sl" id="tbst" name="tbst" disabled>
                         <option value="1" <?php if($compound_data['tbst'] == 1) { echo "selected='selected'"; } ?>>OK</option>
                        <option value="0" <?php if( $compound_data['tbst'] != 1) { echo "selected='selected'"; } ?>><span class="label label-danger">NG </span></option>
                    </select>
 
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">ELONGATION BREAK (EB)</label></td>
                    <td><input type="text" class="form-control" id="ebstd" name="ebstd" value="<?php echo $compound_data['ebstd']; ?>"  autocomplete="off" disabled></td>
                    <td><input type="text" class="form-control" id="ebact" name="ebact"  value="<?php echo $compound_data['ebact']; ?>"  autocomplete="off" disabled></td>
                    <td><select class="form-control" id="ebst" name="ebst" disabled>
                    <option value="1" <?php if($compound_data['ebst'] == 1) { echo "selected='selected'"; } ?>>OK</option>
                    <option  style="background: #5cb85c; color: #000000;" value="0" <?php if( $compound_data['ebst'] != 1) { echo "selected='selected'"; } ?>><span class="sl">NG</span></option>
                    </select>
 
                    </td>
                </tr>

                <tr class="active-row">
                   <td  class="active-row"> <label for="telp">SPESIFIC GRAFITY</label></td>
                    <td><input type="text" class="form-control" id="sgstd" name="sgstd" value="<?php echo $compound_data['sgstd']; ?>"  autocomplete="off" disabled></td>
                    <td><input type="text" class="form-control" id="sgact" name="sgact" value="<?php echo $compound_data['sgact']; ?>"  autocomplete="off" disabled></td>
                    <td>
                    <select class="form-control " id="sgst" name="sgst" disabled>
                    <option class="sl" value="1" <?php if($compound_data['sgst'] == 1) { echo "selected='selected'"; } ?>>OK</option>
                    <option class="sl" value="0" <?php if( $compound_data['sgst'] != 1) { echo "selected='selected'"; } ?>><span class="label label-danger">NG</span></option>
                    </select>
 
                    </td>
                </tr>
        <!-- and so on... -->
               
                </table>
              <section>
                <tr>
                <td class="active-row">
                    <th> ISI NCR FORM </th>
                    

                </td>
                </tr>
                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">test</label></td>
                    <td>
                    <input type="text" class="form-control" id="namecomp" name="namecomp" placeholder="Enter code" autocomplete="off" required>
                    </td>
                </tr> 
                <tr class="active-row">
                   <td  class="active-row"> <label for="supplier_name">test</label></td>
                    <td>
                    <input type="text" class="form-control" id="codecompound" name="codecompound" placeholder="Enter code" autocomplete="off" required>
                    </td>
                </tr>

               

                <tr class="active-row">
                    <td  class="active-row">    <label for="telp">test</label></td>
                    <td> <input type="text" class="form-control" id="nolot" name="nolot" placeholder="Enter No lot" autocomplete="off" required>
                    </td>
                </tr>
                
              </section>       



<!--
                <?php $attribute_id = json_decode( $item_data['attribute_value_id']); ?>
                <?php if($attributes): ?>
                  <?php foreach ($attributes as $k => $v): ?>
                    <div class="form-group">
                      <label for="groups"><?php echo $v['attribute_data']['name'] ?></label>
                      <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" multiple="multiple">
                        <?php foreach ($v['attribute_value'] as $k2 => $v2): ?>
                          <option value="<?php echo $v2['id'] ?>" <?php if(in_array($v2['id'], $attribute_id)) { echo "selected"; } ?>><?php echo $v2['value'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>    
                  <?php endforeach ?>
                <?php endif; ?>

                <div class="form-group">
                  <label for="brands">Brands</label>
                  <?php $brand_data = json_decode( $item_data['brand_id']); ?>
                  <select class="form-control select_group" id="brands" name="brands[]" multiple="multiple">
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $brand_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="category">Category</label>
                  <?php $category_data = json_decode( $item_data['category_id']); ?>
                  <select class="form-control select_group" id="category" name="category[]" multiple="multiple">
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="store">Store</label>
                  <select class="form-control select_group" id="store" name="store">
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if( $item_data['store_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
-->
            


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
    </div> 

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
  
  $(document).ready(function() {
    $(".select_group").select2();
   // $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
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