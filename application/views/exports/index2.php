<?php

$connect = new PDO("mysql:host=localhost;dbname=purchase", "root", "");

$start_date_error = '';
$end_date_error = '';

if(isset($_POST["export"]))
{
 if(empty($_POST["start_date"]))
 {
  $start_date_error = '<label class="text-danger">Start Date is required</label>';
 }
 else if(empty($_POST["end_date"]))
 {
  $end_date_error = '<label class="text-danger">End Date is required</label>';
 }
 else
 {
  $file_name = 'Order Data.xlsx';
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$file_name");
 //header("Content-Type: application/csv;");
header("Content-Type: application/vnd.ms-excell;");

  $file = fopen('php://output', 'w');

  $header = array("Order ID", "Customer Name", "Item Name", "Order Value", "Order Date");

  fputcsv($file, $header);

  $query = "
  SELECT * FROM inputs 
  WHERE date_time >= '".$_POST["start_date"]."' 
  AND date_time <= '".$_POST["end_date"]."' 
  ORDER BY date_time DESC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $data = array();
   $data[] = $row["id"];
   $data[] = $row["ok"];
   $data[] = $row["nolot"];
   $data[] = $row["nama"];
   $data[] = $row["date_time"];
   fputcsv($file, $data);
  }
  fclose($file);
  exit;
 }
}

$query = "
SELECT * FROM inputs 
ORDER BY date_time DESC;
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Items</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Items</li>
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
		  
		  <div class="box-header">
            <form method="post">
					<div class="input-daterange">
					<div class="col-md-4">
					<input type="text" name="start_date" class="form-control" readonly />
					<?php echo $start_date_error; ?>
					</div>
					<div class="col-md-4">
					<input type="text" name="end_date" class="form-control" readonly />
					<?php echo $end_date_error; ?>
					</div>
					</div>
					<div class="col-md-2">
					<input type="submit" name="export" value="Export" class="btn btn-info" />
					</div>
			</form>						
			</div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="table-responsive" class="table table-bordered table-striped">
			
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Nama</th>
                <th>Part No</th>
                <th>No Lot</th>
                <th>OK</th>
                <th>NG</th>
				<th>Total</th>
              </tr>
              </thead>
			  <tbody>
      <?php
      foreach($result as $row)
      {
       echo '
       <tr>
        <td>'.$row["id"].'</td>          
        <td>'.$row["date_time"].'</td>
		 <td>'.$row["shift"].'</td>
		  <td>'.$row["operatorname"].'</td> 
		  <td>'.$row["nama"].'</td>
		   <td>'.$row["nolot"].'</td>
		    <td>'.$row["ok"].'</td>
			 <td>'.$row["ng"].'</td>
 <td>'.$row["total"].'</td> 
 </tr>
       ';
      }
      ?>
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



<script type="text/javascript">
$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });
});


</script>

