<div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah IRD
      </h3>
    </section>

	<style>
div.drw {
  margin: 15px;
  border: 0px solid #ccc;
  float: center;
  width: 100px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 10px;
  text-align: center;
}
</style>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						<span>Silahkan melengkapi form berikut</span>
					</h3>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("irds/po_aksi_tambah"); ?>
				  <div class="col-md-4">
					 <div class="form-group">
					 <label>IRD</label>

    <select name="id_rfq" class="form-control" data-tags="true" data-placeholder="Select an option" data-allow-clear="true" onchange="location = '<?php echo base_url();?>irds/create/'+this.value;" required >
	<!--	  <?php if($this->uri->segment(3)!=''){
			  echo "<option value='$tbl_rfq_by->id'>namepart</option>";
		  }else{
			  echo "<option>Pilih RFQ</option>";
		  } ?> -->
		  <?php foreach($pfqs as $rfq){?>
			  <option value="<?php echo $rfq->id;?>"> <?php echo $rfq->namepart;?></option>
		  <?php } ?> 
	  </select>
	  </div>
				</div>
				<div class="col-md-4">
					 <div class="form-group">
					 <label></label>
	  
					  </div>
				</div>

		
		</div>

		<table class="table table-bordered" >
                    <tr>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                    </tr>
              <tr>
              <td style="background-color:#F4A460; width:50%"> 
 
                 <div class="form-group">
                    <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Customer </label>
                		<div class="col-sm-8">
						<input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer" value="<?php if ($this->uri->segment(3)!=''){ echo $tbl_rfq_by->customer_name; }else { echo"";}?>">
                		</div>
				<br><br>
                <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Part Name </label>
                    	<div class="col-sm-8">
						<input type="text" class="form-control"  id="partname"  name="partname" placeholder="Partname" value="<?php if ($this->uri->segment(3)!=''){ echo $tbl_rfq_by->namepart; }else { echo"";}?>">
                    	</div>
				<br><br>
                <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Part Number </label>
                    	<div class="col-sm-8">
						<input type="text" class="form-control" name="partno" placeholder="Partno" value="<?php if ($this->uri->segment(3)!=''){ echo $tbl_rfq_by->nopart; }else { echo"";}?>">
                    	</div>	
<br><br>						
							<label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Nama Inspection </label>
                    	<div class="col-sm-8">
						<input type="text" class="form-control" required name="operator" id="operator" placeholder="Partno" >
                    	</div>	
<br><br>
	<label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Shift </label>
                    	<div class="col-sm-8">
						<select data-placeholder="Shift ?" class='form-control' id='shift' name="shift" style='width: 100%;' >
														<option value='Shift 1'> Shift 1</option>
														<option value='Shift 2'> Shift 2</option>
														<option value='Shift 3'> Shift 3</option>
													</select>
                </div>    
			</td>
			<td>
				</td>
				<td style="background-color:#F4A460; width:50%"> 
 
				<div class="form-group">
                    <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Date Inspection  </label>
                		<div class="col-sm-8">
						<input type="date" class="form-control" name="tanggal_po" value=" <?php echo "Today is " . date("Y-m-d") ?>" required>
                		</div>
				<br><br>
                <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Material </label>
                    	<div class="col-sm-8">
						<input type="text" class="form-control" name="material" placeholder="Material" value="<?php if ($this->uri->segment(3)!=''){ echo $tbl_rfq_by->material; }else { echo"";}?>">
                    	</div>
				<br><br>
                <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Lot Number </label>
                    	<div class="col-sm-8">
						<input type="text" class="form-control" name="nolot" placeholder="No Lot" required>
                    	</div>	
				<br><br>						
				<label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Quantity Cek </label>
                    	<div class="col-sm-8">
						<input type="text" class="form-control" name="qtycek" placeholder="Qty Cek" required>
                    	</div>		


                </div>    
			</td>


</tr>
<tr>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                    </tr>

</table>
<table class="table table-bordered" >
	

<td style="background-color:#DCDCDC; width:50% font-size:24px;">
<label for="gross_amount"  class="col-sm-2 control-label" style="text-align:left;">Drawing Skecth : </label>			
		<!-- image -->    
		<input type="hidden" name="drw" value="<?php if ($this->uri->segment(3)!=''){  echo $tbl_rfq_by->drw; }else { echo"";}?>">
	<!-- <img  class ="drw"  align="left"  alt="" name="drw"  id="drw" src="<?php echo base_url();?>assets/images/<?php if ($this->uri->segment(3)!=''){ echo $tbl_rfq_by->drw; }else { echo"";}?>"> -->
	<img  class ="drw"  align="left"  alt="" name="drw"  id="drw" src="<?php echo base_url();?><?php if ($this->uri->segment(3)!=''){ echo $tbl_rfq_by->drw; }else { echo"";}?>">

</td>
</table>
				




				  <div class="row">
					<div class="col-md-12">
								<hr/>
								<table id="tambahproduklainnya" width="100%" class="table-condensed" style="background-color:#DCDCDC; width:50% font-size:24px;">
									<thead>
										<tr id='tambahproduklainnyadiv0'>
									

<td style="background-color:#F4A460; font-size:20px; width:20%;" align="center" rowspan ="2"><b> Inspection Item</b></td>
<td style="background-color:#F4A460; font-size:20px; width:10%;" align="center"rowspan ="2"><b>  Tools</b></td>
<td style="background-color:#F4A460; font-size:20px; width:15%;" align="center"rowspan ="2"><b>  Standart</b></td>
<td style="background-color:#F4A460; font-size:20px; width:5%;" align="center"colspan ="5"><b>  Sample</b></td>
<td style="background-color:#F4A460; font-size:20px; width:5%;" align="center"rowspan ="2"><b>  X</b></td>
<td style="background-color:#F4A460; font-size:20px; width:5%;" align="center"rowspan ="2"><b>  R</b></td>
</tr>

<tr>
<td  style="background-color:#a9a9a9; font-size:20px; width:5%;" align="center"><b>1</b></td>
<td style="background-color:#a9a9a9; font-size:20px; width:5%;" align="center"><b>2</b></td>
<td style="background-color:#a9a9a9; font-size:20px; width:5%;" align="center"><b>3</b></td>
<td style="background-color:#a9a9a9; font-size:20px; width:5%;" align="center"><b>4</b></td>
<td style="background-color:#a9a9a9; font-size:20px; width:5%;" align="center"><b>5</b></td>
</tr>
										
									</thead>
									<tbody>
										<?php 
										if($this->uri->segment(3)!=''){
											$x=1;
											foreach($pfqs_item as $detail){ ?>
												<tr id='tambahproduklainnyadiv<?php echo $x;?>' >
													<td>
														<input disabled type="text" class="form-control" id="product<?php echo $x;?>" name="product[]" placeholder="met" value="<?php echo $detail->product;?>">
													</td>
													<td>
														<input disabled type="text" class="form-control" id="metode<?php echo $x;?>" name="metode[]" placeholder="met" value="<?php echo $detail->metode;?>">
													</td>
													<td>
														<input disabled type="text" class="form-control" id="standard<?php echo $x;?>" name="standard[]" placeholder="std" value="<?php echo $detail->standard;?>">
													</td> 				
													<td>
														<input  type="text" class="form-control" id="satu<?php echo $x;?>" name="satu[]" required onkeyup="getTotal(<?php echo $x; ?>)"  placeholder="" >
													</td>
													<td>
														<input  type="text" class="form-control" id="dua<?php echo $x;?>" name="dua[]" required onkeyup="getTotal(<?php echo $x; ?>)"  placeholder="" >
													</td>
													<td>
														<input type="text" class="form-control" id="tiga<?php echo $x;?>" name="tiga[]" required onkeyup="getTotal(<?php echo $x; ?>)" placeholder="" >
													</td>
													<td>
														<input type="text" class="form-control" id="empat<?php echo $x;?>" name="empat[]" required onkeyup="getTotal(<?php echo $x; ?>)"  placeholder="" >
													</td>
													<td>
														<input type="text" class="form-control" id="lima<?php echo $x;?>" name="lima[]"  required onkeyup="getTotal(<?php echo $x; ?>)"  placeholder="" >
													</td>
													<td>
														<input type="number" step="0.00001" class="form-control" id="rata<?php echo $x;?>" name="rata[]"  onkeyup="getTotal(<?php echo $x; ?>)"  placeholder="" >
													</td>
													<td>
														<input type="number" step="0.000001" class="form-control" id="selisih<?php echo $x;?>" name="selisih[]" placeholder="" value="0">
													</td>
												</tr>
											<?php $x++; }
											
											for($y=0; $y<(30+$x); $y++){
												echo "
												<tr id='tambahproduklainnyadiv$y' style='display:none'>
													<td>
													<div class='form-group'><select data-placeholder='Nama Produk' class='form-control' id='id_produk$y' name='id_produk[]' style='width: 100%;' >
														<option value=''> Nama Produk</option>
													</select></div>
													</td>
													<td><div class='form-group'><input type='text' id='standard$y' name='standard[]' class='form-control' placeholder='Standard'></div></td>
													<td><div class='form-group'><input type='text' id='frekuensi$y' name='frekuensi[]' class='form-control' placeholder='frekuensi'></div></td>
													<td><div class='form-group'><input type='text' id='metode$y' name='metode[]' class='form-control' placeholder='metode'></div></td>
						
													<td><div class='form-group'><input type='number' id='harga_po_detail$y' name='harga_po_detail[]' class='form-control' placeholder='Harga'></div></td>
													<td><div class='form-group'><input type='number' id='qty_po_detail$y' name='qty_po_detail[]' class='form-control' placeholder='Qty'></div></td>
													<td><div class='form-group'><input type='number' id='disc_po_detail$y' name='disc_po_detail[]' class='form-control' placeholder='Discount'></div></td>
												
						
												
												</tr>
												";
											}
										}
									?>
									</tbody>
<tfooter>
<tr>
<td style="background-color:#F4A460;" rowspan="3" colspan="4"><b> Note : </b>
<textarea class="form-control" rows="4" name="note" id="note" placeholder="tulis apa saja, asal sopan"></textarea>

</td>
<td style="background-color:#F4A460;"  align="center" colspan="6"><b> RESULT </b></td>
</tr>

<tr>

<td style="background-color:#778899;"  align="center" rowspan="1"  colspan="3" > 
<label> PILIH OK  NG </label>
</td>
<td style="background-color:#778899;"  align="center" rowspan="1"  colspan="3" > 
<select name="ok" class="form-control select2" data-placeholder="Pilih Result"  >
							<option value="okx.jpg">OK</option>
							<option value="ngx.jpg">NG </option>
							
						</select>

</td>

</tr>


</tfooter>




								</table>
								<?php if($this->uri->segment(3)!=''){ ?>
								<div class="form-group">
									<label><button id="tambahproduk"  type="button" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Tambah Produk</button></label>
									<label><button id="hapusproduk"  type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus Produk</button></label> 
									<input id="idhapusnilai" type="hidden" value="<?php echo $x-1;?>">
								</div>
								<?php } ?>
					</div>
					<?php if($this->uri->segment(3)!=''){ ?>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<?php } ?>
				  </div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
      </div>
    </section>
  </div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/path/to/cdn/jquery.slim.min.js"></script>
<script type="text/javascript">
    $("select").select2({
  tags: "true",
  placeholder: "Select an option",
  allowClear: true
});
	$("#tambahproduk").click(function(){
	var numb = $("#idhapusnilai").val();
	$("#hapusproduk").show();
	numb++;	
	
	
	$.getJSON("<?php echo base_url('produk/tbl_produk');?>", function(data) {
			$("#id_produk"+numb).empty();
			$.each(data, function(key, value) {
				$("#id_produk"+numb).append('<option value="' + value.id_produk + '">' + value.nama_produk + '</option>');
			});
	}); 
	


	
	document.getElementById( 'idhapusnilai' ).value = numb;
	$("#tambahproduklainnyadiv"+numb).show();
		document.getElementById( 'idhapusnilai' ).value = numb;
		return false;
	});
	
	$("#hapusproduk").click(function() {
	   var nomore = $("#idhapusnilai").val();
	   document.getElementById("harga_po_detail"+nomore).value = "";
	   document.getElementById("qty_po_detail"+nomore).value = "";
	   document.getElementById("disc_po_detail"+nomore).value = "";
	   $("#id_produk"+nomore).empty();
       $("#tambahproduklainnyadiv"+nomore).hide();
	   nomore--;	
	   document.getElementById( 'idhapusnilai' ).value = nomore;
	   if(nomore<1){
			$("#hapusproduk").hide();
	   }
    });

function getTotal(tambahproduklainnyadiv = null) {
    if(tambahproduklainnyadiv) {
		var total = 0;
      var a = Number($("#satu"+tambahproduklainnyadiv).val());
	var b = Number($("#dua"+tambahproduklainnyadiv).val());
	var c =Number($("#tiga"+tambahproduklainnyadiv).val());
	var d =Number($("#empat"+tambahproduklainnyadiv).val());
	var e= Number($("#lima"+tambahproduklainnyadiv).val());
    var jumlah = Number($("#satu"+tambahproduklainnyadiv).val()) +Number($("#dua"+tambahproduklainnyadiv).val())+Number($("#tiga"+tambahproduklainnyadiv).val())+Number($("#empat"+tambahproduklainnyadiv).val())+Number($("#lima"+tambahproduklainnyadiv).val());  
//	var jumlah1 = Number($("#satu"+tambahproduklainnyadiv).val()) +Number($("#dua"+tambahproduklainnyadiv).val())+Number($("#tiga"+tambahproduklainnyadiv).val());  
//	var jumlah2 = Number($("#empat"+tambahproduklainnyadiv).val())+Number($("#lima"+tambahproduklainnyadiv).val());  

	var min = Math.min(a, b, c, d, e);
	var max = Math.max(a, b, c, d, e);
	var gab = max - min ;



	var total = jumlah / 5;
   //   total = total.toFixed(2);
	 
      $("#rata"+tambahproduklainnyadiv).val(total);
	  $("#selisih"+tambahproduklainnyadiv).val(gab);

	//  total();
    } 
    

    
    else {
      alert('no row !! please refresh the page');
    }

  }



</script>