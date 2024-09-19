
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Items news</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Items Newss</li>
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
          <a href="<?php echo base_url('items/create') ?>" class="btn btn-primary">Add Item</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Export Data Input </h3>
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
                            <input type="text" class="form-control column_filter" id="name_filter" data-custom_column="1" placeholder="Tanggal">
                        </div>

                    </div>
                    <div class="col-lg-1 col-sm-1">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="email_filter" data-custom_column="2" placeholder="jam kerja">
                        </div>

                    </div>
					<div class="col-lg-1 col-sm-1">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="shift" data-custom_column="2" placeholder="shift ">
                        </div>

                    </div>
                    <div class="col-lg-2 col-sm-2">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="contact_filter" data-custom_column="3" placeholder="Nama Karyawan">
                        </div>
                    </div>
					<div class="col-lg-2 col-sm-2">
                        <div class="form-group">                        
                            <input type="text" class="form-control column_filter" id="partname" data-custom_column="3" placeholder="Part name / no">
                        </div>
                    </div>
                  
           






		   </div>                
            </div>
        </div>	
		<div class="table-responsive">
            <table id="render-datatable" class="table table-bordered table-hover small"> 
                <thead>
                    <tr>
                        <th scope="col">#</th>
                       
						<th scope="col">Tanggal</th>
                        <th scope="col">Category Inspection</th>
                        <th scope="col">JAM</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Nama karyawan</th>
						<th scope="col">Part Name</th>
                        <th scope="col">NO LOT </th>
						<th scope="col">OK</th>
						<th scope="col">NG</th>
                        <th scope="col">Total</th>
						<th scope="col">Goresan</th>
						<th scope="col">Tidak Nempel</th>
                        <th scope="col">Kebentur</th>						
						<th scope="col">Saringan Jebol</th>
						<th scope="col">Gelembung</th>
						<th scope="col">Bintik</th>
                        <th scope="col">Luka Dalam</th>
						<th scope="col">Luka Luar</th>
						<th scope="col">Retak</th>
                        <th scope="col">Bergaris</th>						
						<th scope="col">Hose Pendek</th>
						<th scope="col">Over</th>
						<th scope="col">Wrappingan</th>
                        <th scope="col">Braidingan</th>
						<th scope="col">Bolong</th>
						<th scope="col">Tipis</th>
                        <th scope="col">Karet Nempel</th>						
						<th scope="col">Tebal</th>
						<th scope="col">Porisiti</th>
						<th scope="col">Bekas Tangan</th>
                        <th scope="col">Sobek</th>
						<th scope="col">Oval</th>
						<th scope="col">Benang Rusak</th>
                        <th scope="col">siwak</th>
						<th scope="col">keropos</th>
						<th scope="col">Hole Tube</th>
						<th scope="col">Spring Pendek</th>
						<th scope="col">Ring Miring</th>
                        <th scope="col">Sempit</th>
                        <th scope="col">Diameter Kecil</th>
                        <th scope="col">Diameter Besar</th>
                        <th scope="col">Jarak Ring Pendek</th>
						<th scope="col">Shape</th>
						<th scope="col">Gap</th>
                        <th scope="col">Gelombang</th>
						<th scope="col">Jarak Ring Panjang</th>
						<th scope="col">POTONGAN</th>
						<th scope="col">HAGARE</th>
						<th scope="col">Watermark</th>
                        <th scope="col">Bertelur</th>
						<th scope="col">Others</th>
                        <th scope="col">Noted</th>
                        <th scope="col">History</th>
						
						
						
						
                       
                    </tr>
                </thead> 
                <tbody> 
                </tbody> 
               
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
               "url": base_url+'qcreportsgudang/getAllInputs',
                "type": "POST",
                "data": function ( data ) {
                 
                    data.tgl = $('#name_filter').val();
                    data.category = $('').val();
					data.waktu = $('#email_filter').val();
                    data.shift = $('#shift').val();
                    data.operatorname = $('#contact_filter').val();			
                    data.nama = $('#partname').val();
                    data.nolotnew = $('').val();					
					data.ok = $('').val();
                    data.ng = $('').val();
					data.total = $('').val();
					data.goresan = $('').val();
                    data.tidaknempel = $('').val();					
  	             	data.kebentur = $('').val();              
				    data.saringanjebol = $('').val();
                    data.gelembung = $('').val();
					data.bintik = $('').val();
					data.lukadalam = $('').val();
                    data.lukaluar = $('').val();					
				    data.retak = $('').val();
				    data.bergaris = $('').val();
                    data.hosependek = $('').val();
					data.oper  = $('').val();
					data.wrappingan = $('').val();
                    data.braidingan = $('').val();					
				    data.bolong = $('').val();
				    data.tipis = $('').val();					
 			        data.karetnempel = $('').val();	
			        data.tebal = $('').val();
                    data.porisiti = $('').val();
			        data.bekastangan = $('').val();
			        data.sobek = $('').val();
                    data.oval = $('').val();					
			        data.benangrusak = $('').val();	
			        data.siwak = $('').val();
                    data.keropos = $('').val();
			        data.holetube  = $('').val();
			        data.springpendek = $('').val();
                    data.diameterkecil = $('').val();
					data.sempit = $('').val();
                    data.seret = $('').val();	
                    data.diameterbesar = $('').val();
                    data.rp = $('').val();					
			        data.shape = $('').val();	
			        data.gap = $('').val();
                    data.gelombang = $('').val();
			        data.ringlonggar  = $('').val();
			        data.ngmarking = $('').val();
                    data.ngassy = $('').val();
					data.watermark = $('').val();
                    data.bertelur = $('').val();						
			        data.others = $('').val(); 
                    data.note = $('').val();
                    data.history = $('').val();         								
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
                        columns: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53]
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
                        columns: [1, 2, 3, 4, 5]
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
            "lengthMenu": [[1000,2000,10000 -1], [1000, 2000,10000 ]],
            "columns": [
               {
                    "bVisible": false, "aTargets": [0]
               },
               //data yang di tampilan di tabel
                null,
                null,
                null,
				null,
				null,
                null,
                null,
				null,
				null,
				null,
				null,
				null,				
				null,
				null,
				null,
				null,
				null,
				null,
                null,
                null,
				null,
				null,
				null,
				null,
				null,				
				null,
				null,
				null,
				null,
				null,
				null,
                null,
                null,
				null,
				null,
				null,
				null,
				null,				
				null,
				null,
				null,
				null,
                null,
				null,
				null,
				null,
				null,
				null,				
				null,
				null,
				null,
				null,
                null,
               // null,
                //null,
				//button detaill
               // {
                    // render action button
              //      mRender: function (data, type, row) {
              //          var bindHtml = '';
                    //   bindHtml += '<a data-toggle="modal" data-target="#dispaly-employee" href="javascript:void(0);" title="View Detail NG" class="display-emp ml-1 btn-ext-small btn btn-sm btn-info"  data-geteid="' + row[0] + '"><i class="fa fa-eye"></i></a>';
                    //    bindHtml += '<a data-toggle="modal" data-target="#update-employee" href="javascript:void(0);" title="Edit Employee" class="update-emp-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-getueid="' + row[0] + '"><i class="fas fa-edit"></i></a>';
                   //     bindHtml += '<a data-toggle="modal" data-target="#delete-employee" href="javascript:void(0);" title="Delete Employee" class="delete-em-details ml-1 btn-ext-small btn btn-sm btn-danger" data-getdeid="' + row[0] + '"><i class="fas fa-times"></i></a>';
               //         return bindHtml;
                 //   }
             //   },
                
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

