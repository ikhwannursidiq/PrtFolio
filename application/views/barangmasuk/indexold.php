

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Material Masuk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Material Masuk</li>
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

        <?php if(in_array('createBarangmasuk', $user_permission)): ?>
          <a href="<?php echo base_url('barangmasuk/create') ?>" class="btn btn-primary">Add Material Compound</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Data Material Masuk</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">








<table>
    <tr>
                <th style="background-color:#1c87c9;" width="5%" rowspan="2">No</th>
                <th style="background-color:#1c87c9;" width="8%" rowspan="2">Received Date</th>
                <th style="background-color:#1c87c9;"  width="8%" rowspan="2">Time</th>
                <th style="background-color:#1c87c9;" width="8%" rowspan="2">Receiver</th>
                <th style="background-color:#1c87c9;" width="10%"rowspan="2">Supplier Name</th>
                <th style="background-color:#1c87c9;"   width="10%"rowspan="2">PO Number</th>
                <th style="background-color:#1c87c9;" width="10%"rowspan="2">Material</th>  
                <th style="background-color:#1c87c9;" width="5%"rowspan="2">Qty</th>            
                <th style="background-color:#1c87c9;" width="10%"rowspan="2">No.Lot</th>
                <th style="background-color:#1c87c9;" width="10%" colspan="4">Spesifikasi</th>
                <th style="background-color:#1c87c9;" width="10%" colspan="2">Weight</th>
                <th style="background-color:#1c87c9;" width="5%" rowspan="2">Diff</th>  
     <!--           <th style="background-color:#1c87c9;"  width="20%" rowspan="2">Action</th>
        -->  </tr>
              <tr>
            
                <th style="background-color:#1c87c9;"  width="5%">HS</th>
                <th style="background-color:#1c87c9;" width="5%">TB</th>
                <th style="background-color:#1c87c9;"  width="5%">EB</th> 
                <th style="background-color:#1c87c9;"  width="5%">SG</th>
                <th style="background-color:#1c87c9;" width="5%">KPS</th>
                <th style="background-color:#1c87c9;"  width="5%">SKI</th> 
      
              </tr>
    </tr>
    <?php
    $source1 = $this->db->query("SELECT * FROM barangmasuk_item INNER JOIN barangmasuk ON barangmasuk.id=barangmasuk_item.barangmasuk_id")->result_array();
    $no = 1;
    foreach ($source1 as $source1) {
        ?>
        <tr>
            <?php
            $source2 = $this->db->query('SELECT * FROM barangmasuk_item INNER JOIN barangmasuk ON barangmasuk.id=barangmasuk_item.barangmasuk_id where barangmasuk_id ='. $source1['id']);
            $source4 = $this->db->query('select * from barangmasuk_item order by id');
            $total_source2 = $source2->num_rows();
            $source3 = $source2->result_array();
            $rowspan = true;
            ?>
            <td rowspan="<?php echo $total_source2 ?>"><?php echo $no; ?></td>
            <td rowspan="<?php echo $total_source2 ?>"><?php echo $source1['receiveddate']; ?></td>
            <td rowspan="<?php echo $total_source2 ?>"><?php echo $source1['waktu']; ?></td>
            <td rowspan="<?php echo $total_source2 ?>"><?php echo $source1['operatorname']; ?></td>
            <td rowspan="<?php echo $total_source2 ?>"><?php echo $source1['supplier_name']; ?></td> 
         
            <?php foreach ($source3 as $source3) { ?>
                <td><?php echo $source3['nolot'] ?></td>
                <td><?php echo $source3['hs'] ?></td>
                <td><?php echo $source3['tb'] ?></td>
                <td><?php echo $source3['eb'] ?></td>
                <td><?php echo $source3['sg'] ?></td>
                <td><?php echo $source3['kpsw'] ?></td>
                <td><?php echo $source3['skiw'] ?></td>
                <td><?php echo $source3['gap'] ?></td>
            </tr>
        <?php } ?>
        <?php
        $no++;
            }
    ?>
</table>

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

<?php if(in_array('deleteBarangmasuk', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Barang Masuk</h4>
      </div>

      <form role="form" action="<?php echo base_url('barangmasuk/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainBarangmasukNav").addClass('active');
  $("#manageBarangmasukNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'Barangmasuk/fetchBarangmasukData',
    'Pocompound': []
  });

});

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { barangmasuk_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>
