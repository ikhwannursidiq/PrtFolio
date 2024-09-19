
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      PT SHIMADA KARYA INDONESIA
      <small>Production Inspection Standart </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">QC</li>
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
<style>  
/* The following tag selector body use the font-family and background-color properties for body of a page*/  
  
body {  
font-family: Calibri, Helvetica, sans-serif;  
background-color: pink;  
}   
/* Following container class used padding for generate space around it, and also use a background-color for specify the color lightblue as a background */    
.container {  
padding: 50px;  
background-color: lightblue;  
}  
/* The following tag selector input use the different properties for the text filed. */  
input[type=text] {  
  width: 100%;  
  padding: 15px;  
margin: 5px 0 22px 0;  
display: inline-block;  
 border: none;  
 background: #f1f1f1;  
}  
input[type=text]:focus {  
background-color: orange;  
outline: none;  
}  
 div {  
            padding: 10px 0;  
}      
hr {  
  border: 1px solid #f1f1f1;  
  margin-bottom: 25px;  
}  
/* The following tag selector button uses the different properties for the Button. */  
button {  
  background-color: #4CAF50;  
  color: white;  
  margin: 8px 0;  
  border: none;  
  cursor: pointer;  
  padding: 16px 20px;  
  width: 100%;  
  opacity: 0.9;  
}  
/* The following tag selector hover uses the opacity property for the Button which select button when you mouse over it. */  
button:hover {  
opacity: 1;  
}  
</style>  


<div class="col-md-12 ">   
  <div class="box">
          <div class="box-header">
	<form role="form" action="<?php echo base_url('inputs/create') ?>" method="post" id="createInputForm">
  <!--     <div class="form-group">            
    
            <div class="col-sm-5">
                    <label for="deliverydate">Delivery Date</label>
                      <input type="text"  class="form-control"  value="<?php echo  date("j F Y, G:i");?>" id="tgl" name="tgl" placeholder="Enter Date" autocomplete="off">
            </div>
        </div>  
   -->
   <p><strong>&nbsp;</strong></p>

<table width="100%" border="2" cellpadding="2" cellspacing="2">
	<tr>
		<td rowspan="5" width="2%"  style="font-size:16px"><p align="center"><img src="<?php echo site_url('assets/images/logo.jpg'); ?>" /></p>
</td>
			<td rowspan="5" width="25%" align="cENTER" style="font-size:24px">
			<b> PT SHIMADA KARYA INDONESIA <BR> INSPECTION STANDART </BR> </td>
			

	</tr>
	<tr>
		<td  style="font-size:16px"  width="10%">&nbsp;<B>PART NO </B></td>
		<td colspan="2" style="font-size:20px" align="center" width="20%"> <b>
		 <select  class="form-control select_group customer" id="partname" name="partname" style="width:100%;" onchange="getItemData(1)" >
                       <option value=""></option>
                            <?php foreach ($items as $b => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                        </select>
						</b>
		</td>	
	</tr>
	<tr>
		<td  style="font-size:16px"  width="10%">&nbsp;<B>PART NAME </B> </td>
		<td colspan="2" style="font-size:16px" align="center" width="10%"><b><input style="font-size:20px"type="text" align="center" class="form-control"  id="nama" name="nama" placeholder="Part Name" disabled><b></td>	
	</tr>
	<tr>
		<td  style="font-size:16px"  width="10%">&nbsp;<B>TIPE</B></td>
		<td colspan="2" style="font-size:16px"  width="10%"><b><input type="text" style="font-size:20px"align="center" class="form-control"  id="tipe" name="tipe" placeholder="Tipe" disabled><b></td>	
	</tr>
	<tr>
		<td  style="font-size:16px"  width="1O%">&nbsp;<B>MATERIAL </B></td>
		<td colspan="2" style="font-size:16px"  width="10%"><b><input type="text" style="font-size:20px"align="center" class="form-control"  id="material" name="material" placeholder="Material" disabled><b></td>	
	</tr>
	
	<tr>	
	<td  colspan="5" width="100px" height="600px" style="font-size:10px"  width="25%"> 
	  
	 <img src="<?php echo base_url('assets/images/product_image')?>" id="foto" name="foto" width="100%" height="100%" class="img-jumbotron">
	</td>	
	</tr>
</table>

<table width="100%" border="2" cellpadding="2" cellspacing="2">
	<tr>
		<th bgcolor="aqua" width="3%"  style="font-size:16px"><p align="center">&nbsp;<B> NO</B></th>
		<th bgcolor="aqua" width="25%"  style="font-size:16px"><p align="center">&nbsp;<B> ITEM PERIKSA</B></th>
		<th bgcolor="aqua" width="20%"  style="font-size:16px"><p align="center">&nbsp;<B> STANDART</B></th>
		<th bgcolor="aqua" width="20%"  style="font-size:16px"><p align="center">&nbsp;<B> FREKUENSI</B></th>
		<th bgcolor="aqua" width="25%"  style="font-size:16px"><p align="center">&nbsp;<B> METODE</B></th>
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>a</B></td>
		<td style="font-size:16px" align="center" width="20%"><b> Inner Diameter 1</b></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_a" name="std_a" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_a" name="frek_a" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_a" name="met_a" disabled ></td>	
		
		
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="center"  width="2%">&nbsp;<B>b </B> </td>
		<td style="font-size:16px" align="center" width="10%"><b>Outer Diameter 1</b></td>
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_b" name="std_b" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_b" name="frek_b" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_b" name="met_b" disabled ></td>	
			
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>c</B></td>
		<td style="font-size:16px" align="center" width="10%"><b>Thickness 1<b></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_c" name="std_c" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_c" name="frek_c" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_c" name="met_c" disabled ></td>	
			
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>d </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>Inner Diameter 2<b></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_d" name="std_d" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_d" name="frek_d" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_d" name="met_d" disabled ></td>	
			
	</tr>
	
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>e </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>Outer Diameter 2<b></td>
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_e" name="std_e" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_e" name="frek_e" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_e" name="met_e" disabled ></td>	
					
	
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>f </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>Thickness 1<b></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_f" name="std_f" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_f" name="frek_f"disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_f" name="met_f" disabled ></td>	
			
	
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>g </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>Lenght<b></td>	
			<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_g" name="std_g" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_g" name="frek_g"disabled></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_g" name="met_g" disabled ></td>	
			
	
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>h </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>additional marking yellow paint check inner appearance hose<b></td>	
			<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_h" name="std_h"disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_h" name="frek_h" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_h" name="met_h" disabled ></td>	
			
	
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>i </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>additional marking Green paint after leak test<b></td>	
		<td style="font-size:20px" align="center" width="20%"><input bgcolor="green" style="font-size:20px" type="text" align="center" class="form-control"  id="std_i" name="std_i" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_i" name="frek_i" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_i" name="met_i" disabled ></td>	
			
	
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>j </B></td>
		<td style="font-size:16px" align="center" width="10%"><b>additional marking blue paintdouble check all appearance hose<b></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="std_j" name="std_j" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="frek_j" name="frek_j" disabled ></td>	
		<td style="font-size:20px" align="center" width="20%"><input style="font-size:20px" type="text" align="center" class="form-control"  id="met_j" name="met_j" disabled ></td>	
			
	
	</tr>
	

	
<td bgcolor="aqua" colspan="5" align="center" style="font-size:16px"><b> Physical properties of Rubber </td>
	
	<tr>
		<td rowspan="4" style="font-size:16px" align="center" width="2%">&nbsp;<B>k</B></td>
		<td colspan ="4" style="font-size:16px" align="left" width="20%"><b> In Normal Condition</b></td>	
		
		
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left"  width="2%">&nbsp;<B>a. Harness Hs </B> </td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="std_hs" name="std_hs" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="frek_hs" name="frek_hs" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="met_hs" name="met_hs" placeholder="" disabled></td>	
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>b. Tensile Strength Mpa</B></td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="std_tsm" name="std_tsm" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="frek_tsm" name="frek_tsm" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="met_tsm" name="met_tsm" placeholder="" disabled></td>	
			
	</tr>
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>c. Elongation   % </B></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="std_elg" name="std_elg" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="frek_elg" name="frek_elg" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="met_elg" name="met_elg" placeholder="" disabled></td>	
		
	</tr>
	
	
	
	<tr>
		<td rowspan="4" style="font-size:16px" align="center" width="2%">&nbsp;<B>l</B></td>
		<td colspan ="4" style="font-size:16px" align="left" width="20%"><b> In Normal Condition</b></td>	
		
		
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left"  width="2%">&nbsp;<B>a. Harness Change Hs </B> </td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px"  type="text" align="center" class="form-control"  id="std_hc" name="std_hc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="frek_hc" name="frek_hc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="met_hc" name="met_hc" placeholder="" disabled></td>	
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>b. Tensile Strength Change %</B></td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="std_tsc" name="std_tsc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="frek_tsc" name="frek_tsc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="met_tsc" name="met_tsc" placeholder="" disabled></td>	
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>c. Elongation Change % </B></td>	
			<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="std_elgc" name="material" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="frek_elgc" name="frek_elgc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="met_elgc" name="met_elgc" placeholder="" disabled></td>	
		
	</tr>
	
	
	
	<tr>
		<td rowspan="5" style="font-size:16px" align="center" width="2%">&nbsp;<B>m</B></td>
		<td colspan ="4" style="font-size:16px" align="left" width="20%"><b>Liquid-Proof Test</b></td>	
		
		
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left"  width="2%">&nbsp;<B>a. Harness Change Hs </B> </td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_std_hs" name="liquid_std_hs" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_frek_hs" name="liquid_frek_hs" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_met_hs" name="liquid_met_hs" placeholder="" disabled></td>	
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>b. Tensile Strength Change</B></td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_std_tsc" name="liquid_std_tsc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_frek_tsc" name="liquid_frek_tsc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_met_tsc" name="liquid_met_tsc" placeholder="" disabled></td>	
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>c. Elongation Change % </B></td>	
			<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_std_elgc" name="liquid_std_elgc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_frek_elgc" name="liquid_frek_elgc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_met_elgc" name="liquid_met_elgc" placeholder="" disabled></td>	
		
	</tr>
	
	<tr>
		<td  style="font-size:16px" align="left" width="2%">&nbsp;<B>d. Volume Change  % </B></td>	
			<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_std_vc" name="liquid_std_vc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_frek_vc" name="liquid_frek_vc" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="liquid_met_vc" name="liquid_met_vc" placeholder="" disabled></td>	
		
	</tr>

	
<td bgcolor="aqua" colspan="5" align="center" style="font-size:16px"><b> Properties of house</td>
	
<tr>
		<th bgcolor="aqua" width="3%"  style="font-size:16px"><p align="center">&nbsp;<B> NO</B></th>
		<th bgcolor="aqua" width="25%"  style="font-size:16px"><p align="center">&nbsp;<B> ITEM PERIKSA</B></th>
		<th bgcolor="aqua" width="20%"  style="font-size:16px"><p align="center">&nbsp;<B> STANDART</B></th>
		<th bgcolor="aqua" width="20%"  style="font-size:16px"><p align="center">&nbsp;<B> FREKUENSI</B></th>
		<th bgcolor="aqua" width="25%"  style="font-size:16px"><p align="center">&nbsp;<B> METODE</B></th>
	</tr>
	
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>n</B></td>
		<td style="font-size:16px"  align="left" width="20%"><b> Bursting Pressure (Kgf/cm)</b></td>	
		<td style="font-size:16px"  align="left" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="bp_std" name="bp_std" placeholder="" disabled></td>	
		<td style="font-size:16px"  align="left" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="bp_frek" name="bp_frek" placeholder="" disabled></td>	
		<td style="font-size:16px"  align="left" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="bp_met" name="bp_met" placeholder="" disabled></td>	
		
		
		
	</tr>
	<tr>
		<td  style="font-size:16px"  align="center"  width="2%">&nbsp;<B>o </B> </td>
		<td style="font-size:16px"  align="left" width="10%"><b>Change rate of Outer Diameter %</b></td>
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="crod_std" name="crod_std" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="crod_frek" name="crod_frek" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="crod_met" name="crod_met" placeholder="" disabled></td>	
		
	</tr>
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>p</B></td>
		<td style="font-size:16px" align="left" width="10%"><b>Negative Pressure Test<b></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="npt_std" name="npt_std" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px"type="text" align="center" class="form-control"  id="npt_frek" name="npt_frek" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="npt_met" name="npt_met" placeholder="" disabled></td>	
		
	</tr>
	
	<tr>
		<td  style="font-size:16px" align="center" width="2%">&nbsp;<B>q</B></td>
		<td style="font-size:16px" align="left" width="10%"><b>Resistance to Ozone<b></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="rto_std" name="rto_std" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="rto_frek" name="rto_frek" placeholder="" disabled></td>	
		<td style="font-size:16px" align="center" width="20%"><input  style="font-size:20px" type="text" align="center" class="form-control"  id="rto_met" name="rto_met" placeholder="" disabled></td>	
		
	</tr>
	


</table>
</table>
   
   
   
   
  


<!-- TABEL RECORD -->



<!-- /.content-wrapper -->


<script type="text/javascript">
$(document).ready(function() {
    $(".select_group").select2();
  //  $("#description").wysihtml5();
  $("#mainPisNav").addClass('active');
    $("#addPisNav").addClass('active');
    
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

function getItemData()
  {
    var item_id = $("#partname").val();    
    if(item_id == "") {
  $("#nama").val("");
  $("#tipe").val("");
  $("#material").val("");
  $("#foto").val("");
  $("#std_a").val("");
  $("#frek_a").val("");
  $("#met_a").val("");
  $("#std_b").val("");
  $("#frek_b").val("");
  $("#met_b").val("");
  $("#std_c").val("");
  $("#frek_c").val("");
  $("#met_c").val("");
  $("#std_d").val("");
  $("#frek_d").val("");
  $("#met_d").val("");
  $("#std_e").val("");
  $("#frek_e").val("");
  $("#met_e").val("");
  $("#std_f").val("");
  $("#frek_f").val("");
  $("#met_f").val("");
  $("#std_g").val("");
  $("#frek_g").val("");
  $("#met_g").val("");
  $("#std_h").val("");
  $("#frek_h").val("");
  $("#met_h").val("");
  $("#std_i").val("");
  $("#frek_i").val("");
  $("#met_i").val("");
  $("#std_j").val("");
  $("#frek_j").val("");
  $("#met_j").val("");
  $("#std_hs").val("");
  $("#frek_hs").val("");
  $("#met_hs").val("");
  $("#std_tsm").val("");
  $("#frek_tsm").val("");
  $("#met_tsm").val("");
  $("#std_elg").val("");
  $("#frek_elg").val("");
  $("#met_elg").val("");
  $("#std_hc").val("");
  $("#frek_hc").val("");
  $("#met_hc").val("");
  $("#std_tsc").val("");
  $("#frek_tsc").val("");
  $("#met_tsc").val("");
  $("#std_elgc").val("");
  $("#frek_elgc").val("");
  $("#met_elgc").val("");
  $("#liquid_std_hs").val("");
  $("#liquid_frek_hs").val("");
  $("#liquid_met_hs").val("");
  $("#liquid_std_tsc").val("");
  $("#liquid_frek_tsc").val("");
  $("#liquid_met_tsc").val("");
  $("#liquid_std_elgc").val("");
  $("#liquid_frek_elgc").val("");
  $("#liquid_met_elgc").val("");   
  $("#liquid_std_vc").val("");
  $("#liquid_frek_vc").val("");
  $("#liquid_met_vc").val("");
  $("#bp_std").val("");
   $("#crod_std").val(""); 
   $("#npt_std").val("");
    $("#rto_std").val("");
	 $("#bp_frek").val("");
	  $("#crod_frek").val("");
	   $("#npt_frek").val("");
	    $("#rto_frek").val("");
	$("#bp_met").val("");
	  $("#crod_met").val("");
	   $("#npt_met").val("");
	    $("#rto_met").val("");
		
    } else {
     $.ajax({
      url:'http://localhost/qc/Inputs/getItemValueById',
        type: 'post',
        data: {item_id : item_id},
      dataType: 'json',
        success:function(response) { 
    $("#nama").val(response.name);	
	$("#tipe").val(response.sku);	
	$("#material").val(response.price);	
	$("#foto").val(response.image);	
	$("#std_a").val(response.std_a);	
	$("#frek_a").val(response.frek_a);	
	$("#met_a").val(response.met_a);	
	$("#std_b").val(response.std_b);	
	$("#frek_b").val(response.frek_b);	
	$("#met_b").val(response.met_b);	
	$("#std_c").val(response.std_c);	
	$("#frek_c").val(response.frek_c);	
	$("#met_c").val(response.met_c);	
	$("#std_d").val(response.std_d);	
	$("#frek_d").val(response.frek_d);	
	$("#met_d").val(response.met_d);	
	$("#std_e").val(response.std_e);	
	$("#frek_e").val(response.frek_e);	
	$("#met_e").val(response.met_e);	
	$("#std_f").val(response.std_f);	
	$("#frek_f").val(response.frek_f);	
	$("#met_f").val(response.met_f);	
	$("#std_g").val(response.std_g);	
	$("#frek_g").val(response.frek_g);	
	$("#met_g").val(response.met_g);	
	$("#std_h").val(response.std_h);	
	$("#frek_h").val(response.frek_h);	
	$("#met_h").val(response.met_h);	
	$("#std_i").val(response.std_i);	
	$("#frek_i").val(response.frek_i);	
	$("#met_i").val(response.met_i);	
	$("#std_j").val(response.std_j);	
	$("#frek_j").val(response.frek_j);	
	$("#met_j").val(response.met_j);	
	$("#std_hs").val(response.std_hs);
  $("#frek_hs").val(response.frek_hs);
  $("#met_hs").val(response.met_hs);
  $("#std_tsm").val(response.std_tsm);
  $("#frek_tsm").val(response.frek_tsm);
  $("#met_tsm").val(response.met_tsm);
  $("#std_elg").val(response.std_elg);
  $("#frek_elg").val(response.frek_elg);
  $("#met_elg").val(response.met_elg);
  $("#std_hc").val(response.std_hc);
  $("#frek_hc").val(response.frek_hc);
  $("#met_hc").val(response.met_hc);
  $("#std_tsc").val(response.std_tsc);
  $("#frek_tsc").val(response.frek_tsc);
  $("#met_tsc").val(response.met_tsc);
  $("#std_elgc").val(response.std_elgc);
  $("#frek_elgc").val(response.frek_elgc);
  $("#met_elgc").val(response.met_elgc);
  $("#liquid_std_hs").val(response.liquid_std_hs);
  $("#liquid_frek_hs").val(response.liquid_frek_hs);
  $("#liquid_met_hs").val(response.liquid_met_hs);
  $("#liquid_std_tsc").val(response.liquid_std_tsc);
  $("#liquid_frek_tsc").val(response.liquid_frek_tsc);
  $("#liquid_met_tsc").val(response.liquid_met_tsc);
  $("#liquid_std_elgc").val(response.liquid_std_elgc);
  $("#liquid_frek_elgc").val(response.liquid_frek_elgc);
  $("#liquid_met_elgc").val(response.liquid_met_elgc);   
  $("#liquid_std_vc").val(response.liquid_std_vc);
  $("#liquid_frek_vc").val(response.liquid_frek_vc);
  $("#liquid_met_vc").val(response.liquid_met_vc);
  $("#bp_std").val(response.bp_std);
   $("#crod_std").val(response.crod_std); 
   $("#npt_std").val(response.npt_std);
    $("#rto_std").val(response.rto_std);
	 $("#bp_frek").val(response.bp_frek);
	  $("#crod_frek").val(response.crod_frek);
	   $("#npt_frek").val(response.npt_frek);
	    $("#rto_frek").val(response.rto_frek);
	$("#bp_met").val(response.bp_met);
	  $("#crod_met").val(response.crod_met);
	   $("#npt_met").val(response.npt_met);
	    $("#rto_met").val(response.rto_met);
		}  
      }); 
  }
  }

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
        data: { input_id:id }, 
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
