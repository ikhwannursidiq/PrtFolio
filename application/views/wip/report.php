<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>WIP CUTTING & QC</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">WIP CUTTING & QC</li>
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

        <?php if(in_array('createItem', $user_permission)): ?>
       
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Export Data WIP / CUTTING</h3>
          </div>
	 <div class="row">
            
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">                       
                            <input type="text" class="small form-control global_filter" id="global_filter" placeholder="Others Keyword..">                                       
                        </div>
                    </div>
                </div>
				
				<div class="row">
                    <div class="col-lg-3 col-sm-3">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="leader" data-custom_column="1" placeholder="Operatorname">
                        </div>

                    </div>
                    <div class="col-lg-1 col-sm-1">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="operatorname" data-custom_column="2" placeholder="Leader">
                        </div>

                    </div>
				
                  
					<div class="col-lg-2 col-sm-2">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="partno" data-custom_column="3" placeholder="Part name / no">
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-2">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="nolot" data-custom_column="3" placeholder="Nolot">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="dateinput" data-custom_column="1" placeholder="Tanggal">
                        </div>

                    </div>
                   






		   </div>                
            </div>
        </div>	
		<div class="table-responsive">
            <table id="render-datatable" class="table table-bordered table-hover small"> 
                <thead>
                    <tr>
                    <th>NO</th>  
                    <th>Date Input</th> 
                    <th>Operator Name</th>
                    <th>Leader Name</th>
                    <th>PART NO</th>
                    <th>NO LOT</th>
                    <th>STOK AWAL</th>  
                    <th>STOK IN PROSES</th>
                    <th>NOTE</th>        
                    </tr>
                </thead> 
                <tbody> 
                </tbody> 
                <tfoot>

     <tr>

      <th colspan="3">Total</th>

      <th id="#total_order"></th>

     </tr>

    </tfoot>
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

<?php if(in_array('deleteItem', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Item</h4>
      </div>

      <form role="form" action="<?php echo base_url('items/remove') ?>" method="post" id="removeForm">
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
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<?php
$this->load->view('qcreports/popup/display');
?>
<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

    jQuery(document).ready(function () {
        jQuery('#render-datatable').dataTable({
            "paging": true,
            "processing": false,
            "serverSide": true,
            "order": [],
            // Load data for the table's content from an Ajax source
            "ajax": {
               "url": base_url+'wip/getAllWip',
                "type": "POST",
                "data": function ( data ) {
                    data.id = $('').val();
                    data.dateinput = $('#dateinput').val();
                    data.operatorname = $('#operatorname').val();
                    data.leader = $('#leader').val();
					          data.partno = $('#partno').val();
                    data.nolot = $('#nolot').val();
                    data.qtyawal = $('').val();			
                    data.qty = $('').val();
                    data.note = $('').val();					
				   								
				}
            },
            dom: 'lBfrtip',
			//dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: '<i class="far fa-file-excel" aria-hidden="true"></i> Excel Export',
                    filename: 'Data input qc',
                    title: '',
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied',
                            page: 'current'
                        },
                        columns: [1,2,3,4,5,6,7,8]
					}
                },
                {
                    extend: 'csv',
                    text: '<i class="far fa-csv"></i> Export CSV',
                    filename: 'Data input qc',
                    title: '',
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied',
                            page: 'current'
                        },
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="far fa-file-pdf" aria-hidden="true"></i> PDF',
                    filename: 'Data input qc',
                    title: '',
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied',
                            page: 'current'
                        },
                        columns: [1, 2, 3, 4, 5]
                    }
                },
            ],
            "lengthMenu": [[25, 50, 100,150,250,300,500,1000,2000,10000 -1], [25, 50, 100,150,250,300, 500, 1000, 2000,10000 ]],
            "columns": [
               {
                    "bVisible": false, "aTargets": [0]
               },
               //data yang di tampilan di tabel yang di export ke excell harus sama jumlahnya total = 8
                null,
                null,
                null,
				        null,
				        null,
				        null,
                null,
                 null,
				  //    null,
          //    null,
			         
            ],
            "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                $(nRow).attr('id', aData[0]);
            }
        });

        // define method global search
        function filterGlobal(v) {
            jQuery('#render-datatable').DataTable().search(
                    v,
                    false,
                    false
                    ).draw();
        }
        
        // filter keyword
        jQuery('input.global_filter').on('keyup click', function () {
            var v = jQuery(this).val();    
            filterGlobal(v);
        });
        jQuery('input.column_filter').on('keyup click', function () {
            jQuery('#render-datatable').DataTable().ajax.reload();
        });
    });

</script>

