<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>TRIAL RECORD</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Seleksi</li>
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
  padding: 5px;  
margin: 5px 0 2px 0;  
display: inline-block;  
 border: none;  
 background: #f1f1f1;  
}  
input[type=text]:focus {  
background-color: orange;  
outline: none;  
}  
 div {  
            padding: 1px 0;  
} 
body {
		  border: 1px solid black;
         
		}
    
    table .table table-border {
            border-width: 2px;
            border-color: #000000;    
        }

hr {  
  border: 2px solid #f1f1f1;  
  margin-bottom: 2px;  
}  
/* The following tag selector button uses the different properties for the Button. */  
 
/* The following tag selector hover uses the opacity property for the Button which select button when you mouse over it. */  
button:hover {  
opacity: 1;  
}  
</style>  
<body>
        <div class="box">
          <div class="box-header">
           
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('trial/create') ?>" method="post" class="form-horizontal" name="autoSumForm" >
              <div class="box-body">

                <?php echo validation_errors(); ?>

        
      <table class="table table-border" id="product_info_table">
          <tr>
		              <td colspan="5"  width="100%"  style="font-size:16px"><p align="left"><img src="<?php echo site_url('assets/images/logotrial.jpg'); ?>" /></p>
             
          </td>

	 </tr>
          
      
        </table>

        <br>
   <table class="table table-border" id="product_info_table">
   <tr>
              <td colspan="3"  align="left" style="background-color:#00BFFF; width:20% ; font-size:20px;">TRIAL NO :  </td>       
            <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;">
                      
            <select class="form-control select_group customer" name="trialno" id="trialno" class="form-control" required onkeyup="getTotal(1)">
							<option value="Trial 1">Trial 1</option>
              <option value="Trial 2">Trial 2</option>
							<option value="Trial 3">Trial 3</option>
							<option value="Trial 4">Trial 4</option>
							<option value="Trial 5">Trial 5</option>
							<option value="Trial 6">Trial 6</option>
              <option value="Trial 7">Trial 7</option>
							<option value="Trial 8">Trial 8</option>
							<option value="Trial 9">Trial 9</option>
							<option value="Trial 10">Trial 10</option>
					
                            </select>
                    </td>
                     
                </tr>
                <tr>
                      <td colspan="2" align="Left" style="background-color:#00CED1; width:10% font-size:20px;" ><b>Part No</b></td>                    
                      <td colspan="4" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="partno" id="partno" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td colspan="2" align="center" style="background-color:#00BFFF;" ><b>Trial Date</b></td>
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b><input type="date" name="date_created" id="date_created" class="form-control" ></b></td>
                      
                 </tr>

                 <tr>
                      <td colspan="2" align="Left" style="background-color:#00CED1; width:10% font-size:20px;" ><b>Part Name</b></td>                    
                      <td colspan="4" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="partname" id="partname" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  align="center" style="background-color:#00CED1;" ><b>Production Manual Section</b></td>
                      <td colspan="2"  align="center" style="background-color:#8FBC8F;" ><b>Wrapping</b></td>
                      <td colspan="4"  align="center" style="background-color:#fada5e;" ><b>
                     <select class="form-control select_group customer" name="wrapping" id="wrapping" class="form-control" required onkeyup="getTotal(1)">
							              <option value="1">Yes</option>
                              <option value="2">No</option>
                      </select>
                      
                      
                      </b></td>
                   
                          
                 </tr>

                 <tr>
                      <td colspan="2" align="Left" style="background-color:#00CED1; width:10% font-size:20px;" ><b>Type</b></td>                    
                      <td colspan="4" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="type" id="type" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td align="center" rowspan="4" style="background-color:#00BFFF;" ><b>WIRE SECTION</b></td>
                      <td colspan="2"  align="center" style="background-color:#8FBC8F;" ><b>Fabric</b></td>
                     <td colspan="4"  align="center" style="background-color:#fada5e;" ><b><input type="text"  name="wsfabric" id="wsfabric" class="form-control" ></b></td>
                      
                      
                 </tr>

                 <tr>
                      <td colspan="2" align="Left" style="background-color:#00CED1; width:10% font-size:20px;" ><b>Safety Part</b></td>                    
                      <td colspan="4" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"> 

                      <select class="form-control select_group customer" name="safetypart" id="safetypart" class="form-control" required onkeyup="getTotal(1)">
							              <option value="YES">Yes</option>
                              <option value="NO">No</option>
                      </select>
                    </td>                    
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 

                     
                      <td colspan="2"  align="center" style="background-color:#8FBC8F;" ><b>Nakabi Wrapping</b></td>
                      <td colspan="4"  align="center" style="background-color:#fada5e;" ><b>
                     <select class="form-control select_group customer" name="nw" id="nw" class="form-control" required onkeyup="getTotal(1)">
							              <option value="1">Yes</option>
                              <option value="2">No</option>
                      </select>
                      
                      
                      </b></td>
                        
                 </tr>



                 <tr>
                      <td colspan="2" rowspan="4"  align="center" style="background-color:#00BFFF; width:10% font-size:10px;" ><b>Material</b></td>                    
                      <td colspan="4" align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Compound Code</td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                     
                      <td colspan="2"  align="center" style="background-color:#00CED1;" ><b>Wiring</b></td>
                     <td colspan="2"  align="center" style="background-color:#8FBC8F;" ><b>Wrapping</b></td>
                     <td colspan="2"  align="center" style="background-color:#00CED1;" ><b>Silicone</b></td>
                   
                 </tr>


                 
                 <tr>
                      <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="cmlayersatu" id="cmlayersatu" class="form-control" ></td>                    
                      <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="cmlayerdua" id="cmlayerdua" class="form-control" ></td>                     
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 

                
                      <td colspan=""  align="center" style="background-color:#fada5e;" ><b>Size :</b></td>
                     <td colspan=""  align="center" style="background-color:#fada5e;" ><b><input type="text"  name="wiringsize" id="wiringsize" class="form-control" ></b></td>
                     <td colspan=""  align="center" style="background-color:#fada5e;" ><b><input type="text" name="wrappingply" id="wrappingply" class="form-control" ></b></td>
                     <td colspan=""  align="center" style="background-color:#fada5e;" ><b>Ply</b></td>
                     <td colspan=""  align="center" style="background-color:#fada5e;" ><b><input type="text" name="siliconeply" id="siliconeply" class="form-control" ></b></td>
                     <td colspan=""  align="center" style="background-color:#fada5e;" ><b>Ply</b></td>

                      
                 </tr>













                 <tr>
                        <td colspan="2" align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">THREAD</td>                    
                      <td colspan="2" align="center" style="background-color:#00CED1; width:5% ; font-size:16px;">FABRIC</td>                    
                     
                      
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
  
                       <td colspan=""  align="center" style="background-color:#8FBC8F;" ><b>Glueing</b></td>
                      
                      <td colspan="2"  align="center" style="background-color:#fada5e;" ><b><input type="text" name="glueing" id="glueing" class="form-control" ></b></td>
                      <td colspan=""  align="center" style="background-color:#8FBC8F;" ><b>Glue Compound</b></td>
                      
                      <td colspan="2"  align="center" style="background-color:#fada5e;" ><b><input type="text" name="gluecomp" id="gluecomp" class="form-control" ></b></td>
                     
                      
                 </tr>


                 <tr>
                  <td colspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="csfabrictype" id="csfabrictype" class="form-control" ></td>                    
                  <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mfabric" id="mfabric" class="form-control" ></td>                    
                  <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                  <td colspan="3" align="center" style="background-color:#00BFFF;" ><b>Weight Estimation (GRAM)</b></td>
                  <td rowspan="2" align="center" style="background-color:#00CED1;" ><b>Mandrell / Roll</b></td>    
                  <td colspan="2" align="center" style="background-color:#00BFFF;" ><b>Mandrell (pcs)</b></td>
                 </tr>
    





                 <tr>
                      <td colspan="2" rowspan="2"  align="center" style="background-color:#00BFFF; width:5% font-size:20px;" ><b>Dimension Estimation (mm)</b></td>                    
                      <td align="center" style="background-color:#8FBC8F; width:10% ; font-size:16px;"><b>Thickness</td>                    
                       <td  align="center" style="background-color:#00CED1; width:10% ; font-size:16px;"><b>ID</td> 
                       <td  align="center" style="background-color:#8FBC8F; width:10% ;" ><b>OD</b></td>
                      <td align="center" style="background-color:#00CED1; width:10% ;" ><b>Lenght</b></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td align="center" style="background-color:#8FBC8F; width:10% ; font-size:16px;"><b>Basic Hose</td>                    
                       <td  align="center" style="background-color:#00CED1; width:10% ; font-size:16px;"><b>Cover</td> 
                       <td  align="center" style="background-color:#8FBC8F; width:10% ;" ><b>Total</b></td>
                       <td  align="center" style="background-color:#8fbc8f; width:5% ; font-size:16px;"><b>Quantity</td> 
                       <td  align="center" style="background-color:#00CED1; width:10% ;" ><b>Cavity</b></td>
                    
                 </tr>

                 <tr>
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="dimthickness" id="dimthickness" class="form-control" ></td>                    
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="dimid" id="dimid" class="form-control" ></td>                     
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="dimod" id="dimod" class="form-control" ></td>                    
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="dimlenght" id="dimlenght" class="form-control" ></td>                     
                     
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                     
                     
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="webasichose" id="webasichose" class="form-control" ></td>                    
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="wecover" id="wecover" class="form-control" ></td>                     
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="wetotal" id="wetotal" class="form-control" ></td>                    
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="wemr" id="wemr" class="form-control" ></td>                     
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mqty" id="mqty" class="form-control" ></td>                    
                      <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="cavity" id="cavity" class="form-control" ></td>                     
                          
                 </tr>


                 
                  
</table> 


<br>

<br>





<table class="table table-border" id="product_info_table">
                <tr>
                      <td colspan="18" align="center" style="background-color:#FFA500;" ><b>Extrussion Process</b></td>

                  </tr>
                  <tr>
                    <td  rowspan="3" align="center" style="background-color:#00BFFF; width:10% ; font-size:16px;"><b>Material</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Compound Code</td>
                    <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><input type="text" name="emccsatu" id="emccsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><input type="text" name="emccdua" id="emccdua" class="form-control" ></td>
                    
      
                  </tr>
                  <tr>
                   
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">No Lot</td>
                    <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><input type="text" name="emlotsatu" id="emlotsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><input type="text" name="emlotdua" id="emlotdua" class="form-control" ></td>
       
                   
                   
                </tr>
                <tr>
                   
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Machine No </td>
                   <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;">
                 
                   <select class="form-control select_group customer" name="exmcsatu" id="exmcsatu" class="form-control" required onkeyup="getTotal(1)">
							              <option value="1">Machine 1</option>
                              <option value="3">Machine 3</option>
                              <option value="5">Machine 5</option>
                              <option value="7">Machine 7</option>
                              <option value="9">Machine 9</option>
                              <option value="11">Machine 11</option>
                      </select>
                   
                   </td>
                   <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;">
                   <select class="form-control select_group customer" name="exmcdua" id="exmcdua" class="form-control" required onkeyup="getTotal(1)">
                   <option value="1">Machine 1</option>
                              <option value="2">Machine 2</option>
                              <option value="3">Machine 3</option>
                              <option value="4">Machine 4</option>
                              <option value="5">Machine 5</option>
                              <option value="6">Machine 6</option>
                              <option value="7">Machine 7</option>
                              <option value="8">Machine 8</option>
                              <option value="9">Machine 9</option>
                              <option value="10">Machine 10</option>
                              <option value="11">Machine 11</option>
                              <option value="12">Machine 12</option>
                              <option value="13">Machine 13</option>
                              <option value="14">Machine 14</option>

                      </select>
                  
                  </td>
         <!--  
                  <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="mdua" name="mdua" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 2</label></td>
                    <td  align="center" style="background-color:#8FBC8F; width:2% ; font-size:16px;"><input type="checkbox" id="mtiga" name="mtiga" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 3</label></td>
                    <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="mempat" name="mempat" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 4</label></td>
                    <td  align="center" style="background-color:#8FBC8F; width:2% ; font-size:16px;"><input type="checkbox" id="mlima" name="mlima" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 5</label></td>
                    <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="menam" name="menam" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 6</label></td>
                    <td  align="center" style="background-color:#8FBC8F; width:2% ; font-size:16px;"><input type="checkbox" id="mtujuh" name="mtujuh" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 7</label></td>
                    <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="mdelapan" name="mdelapan" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 8</label></td>
                    <td  align="center" style="background-color:#8FBC8F; width:2% ; font-size:16px;"><input type="checkbox" id="msembilan" name="msembilan" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 9</label></td>
                    <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="msepuluh" name="msepuluh" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 10</label></td>
                    <td  align="center" style="background-color:#8FBC8F; width:2% ; font-size:16px;"><input type="checkbox" id="msebelas" name="msebelas" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 11</label></td>
                    <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="mduabelas" name="mduabelas" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 12</label></td>
                    <td  align="center" style="background-color:#8FBC8F; width:2% ; font-size:16px;"><input type="checkbox" id="mtigabelas" name="mtigabelas" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 13</label></td>
                    <td  align="center" style="background-color:#fada5e; width:2% ; font-size:16px;"><input type="checkbox" id="mempatbelas" name="mempatbelas" value="1nb.jpg"><label for="vehicle1">&nbsp;  M 14</label></td>
       
               -->   
                  
               </tr>




</table>

<br>

      <table class="table table-border" id="product_info_table">
      <tr>
                      <td colspan="3" align="center" style="background-color:#AFEEEE" ><b>Extrussion Method</b></td>
                      <td colspan="6" align="center" style="background-color:#40E0D0" ><b>Dimension</b></td>
                  </tr>
                  <tr>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Continous</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Basic Hose</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">Single Layer</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Layer 1</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">Layer 2</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Total Thickness</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">ID</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">OD</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">Lenght</td>
                
      
                  </tr>
                  <tr>
                   
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="emcontinous" id="emcontinous" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="embasichose" id="embasichose" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="emsinglelayer" id="emsinglelayer" class="form-control" ></td>
       
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="emlyrsatu" id="emlyrsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="emlyrdua" id="emlyrdua" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="edimtotal" id="edimtotal" class="form-control" ></td>
       
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="edimid" id="edimid" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="edimod" id="edimod" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="edimlenght" id="edimlenght" class="form-control" ></td>
       
                           
                </tr>
  </table>

  


  <table class="table table-border" id="product_info_table">
      <tr>
                      <td rowspan="2" colspan="" align="center" style="background-color:#00BFFF;" ><b>Mesh Size</b></td>
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Setting Dies</b></td>
                      <td colspan="2" align="center" style="background-color:#00BFFF;" ><b>Temperature</b></td>
                      <td colspan="3" align="center" style="background-color:#fada5e;" ><b>RPM Set</b></td>
                      <td colspan="4" align="center" style="background-color:#00BFFF;" ><b>WIP WEIGHT (gram)</b></td>
      </tr>
      <tr>
                      <td   align="center" style="background-color:#fada5e;" ><b>Single</b></td>
                      <td  align="center" style="background-color:#00BFFF;" ><b>Double</b></td>
                      <td   align="center" style="background-color:#fada5e;" ><b>Screw 1</b></td>
                      <td  align="center" style="background-color:#00BFFF;" ><b>Screw 2</b></td>
                      <td   align="center" style="background-color:#fada5e;" ><b>Ext 1</b></td>
                      <td  align="center" style="background-color:#00BFFF;" ><b>Ext 2</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Conveyor</b></td>
                      <td  align="center" style="background-color:#00BFFF;" ><b>Basic Hose</b></td>
                      <td   align="center" style="background-color:#fada5e;" ><b>Cover</b></td>
                      <td  align="center" style="background-color:#00BFFF;" ><b>Thread</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Total</b></td>



      </tr>
                 
                  <tr>
                   
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mesh" id="mesh" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="sdsingle" id="sdsingle" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="sddouble" id="sddouble" class="form-control" ></td>
       
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="tscrewsatu" id="tscrewsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="tscrewdua" id="tscrewdua" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="rpmextsatu" id="rpmextsatu" class="form-control" ></td>
       
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="rpmextdua" id="rpmextdua" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="rpmconveyor" id="rpmconveyor" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="wipbh" id="wipbh" class="form-control" ></td>
                    <td  align="center" style="background-color:#8FBC8F;  width:5% ; font-size:16px;"><input type="text" name="wipcover" id="wipcover" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="wipthread" id="wipthread" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="wiptotal" id="wiptotal" class="form-control" ></td>
       
                           
                </tr>
  </table>
 


  <table class="table table-border" id="product_info_table">
      <tr>
                      <td colspan="8" align="center" style="background-color:#AFEEEE" ><b>Braiding</b></td>
                      <td colspan="12" align="center" style="background-color:#40E0D0" ><b>EXTRUSION CYCLE TIME/PCS (second)</b></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Type</td>
                    <td  colspan="6" align="center" style="background-color:#40E0D0"; width:5% ; font-size:16px;">Machine No</td>

                    
                    <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>1</td>
                    <td  colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">2</td>
                    
                    <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>3</td>
                    <td  colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">4</td>
                    
                    <td colspan="" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>5</td>
                    <td   align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">6</td>
                    <td colspan="2"align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Total</td>
                    <td  colspan="2"  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">Average</td>
                   
      
                  </tr>
                  <tr>
                  <td colspan="2" align="center" style="background-color:#8FBC8F; width:12% ; font-size:16px;">
                  <select class="form-control select_group customer" name="brtype" id="brtypa" class="form-control" required onkeyup="getTotal(1)">
							  <option value="HORIZONTAL">HORIZONTAL</option>
                              <option value="VERTIKAL">VERTIKAL</option>
                             
                      </select>
                
                </td>
                    
                 
                    <td  colspan="6" align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="brmc" id="brmc" class="form-control" required onkeyup="getTotal(1)">
							              <option value="1">Machine 1</option>
                              <option value="2">Machine 2</option>
                              <option value="3">Machine 3</option>
                              <option value="4">Machine 4</option>
                              <option value="5">Machine 5</option>
                              <option value="6">Machine 6</option>
                             
                      </select>
             
                   </td>
                    
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="ectsatu" id="ectsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="ectdua" id="ectdua" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="ecttiga" id="ecttiga" class="form-control" ></td> 
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="ectempat" id="ectempat" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="ectlima" id="ectlima" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="ectenam" id="ectenam" class="form-control" ></td>
                    <td colspan="2"  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="ecttotal" id="ecttotal" class="form-control" ></td>
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="ectrata" id="ectrata" class="form-control" ></td>             
                  </tr>
  </table>



  <table class="table table-border" id="product_info_table">
      <tr>
                      <td rowspan="2" colspan="" align="center" style="background-color:#00BFFF;" ><b>Material</b></td>
                      <td rowspan="2" colspan="" align="center" style="background-color:#00BFFF;" ><b>Thread Type</b></td>
                      <td rowspan="2" colspan="" align="center" style="background-color:#00BFFF;" ><b>Cones</b></td>
                      <td rowspan="2" colspan="" align="center" style="background-color:#00BFFF;" ><b>Gear</b></td>
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b>RPM Set</b></td>
                      <td rowspan="" colspan="9" align="Left" style="background-color:#fada5e;" > Notes: </td>
                      
      </tr>
      <tr>
                      <td   align="center" style="background-color:#fada5e;" ><b>Conveyor</b></td>
                      <td  align="center" style="background-color:#00BFFF;" ><b>Braiding</b></td>
                      <td  rowspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><textarea name="ectnotes" id="ectnotes" cols="110" rows="3"></textarea></td>
 
      </tr>
  <tr>
      <td  align="center" style="background-color:#8FBC8F; width:10% ; font-size:16px;"><input type="text" id="extmat" name="extmat" ></td>
        <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" id="exttt" name="exttt" ></td>    
        <td  align="center" style="background-color:#8FBC8F; width:10% ; font-size:16px;">
		<select size="1" name="extcones" disabled="disabled">                  
				<option value="">Select</option>
				<option value="">----</option>
				<option value="16">16</option>
				<option value="24">24</option>
				<option value="32">32</option>
		</select>
		<input type="text" id="extcones" value="48" name="extcones" disabled="disabled" >
		</td>
        <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" id="extgear" name="extgear" disabled="disabled" ></label></td>
        <td  align="center" style="background-color:#8FBC8F; width:10% ; font-size:16px;"><input type="text" id="rpmsetconv" name="rpmsetconv" ></td>
        <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" id="rpmsetbra" name="rpmsetbra" ></td>
         
      </tr>
</table>
<br><br>

<table class="table table-border" id="product_info_table">
                <tr>
                      <td colspan="18" align="center" style="background-color:#FFA500;" ><b>Produksi Manual Waya</b></td>

                  </tr>
				        <tr>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>Proses Wrapping<b></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                   <select class="form-control select_group customer" name="pmpw" id="pmpw" class="form-control" required onkeyup="getTotal(1)">
							  <option value="YES">YES</option>
                              <option value="NO">NO</option>
                              
                      </select> </td>   
                      <td  align="center" colspan="4" style="background-color:#8FBC8F; width:5% ; font-size:16px;"></td>
               </tr>
				  
                  <tr>
                    <td  rowspan="2" align="center" style="background-color:#00BFFF; width:10% ; font-size:16px;"><b>Wabari</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Code</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="pmwcode" id="pmwcode" class="form-control" ></td>
                    <td  rowspan="2" align="center" style="background-color:#00BFFF; width:10% ; font-size:16px;"><b>Berat</td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Wabari</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="beratwabari" id="beratwabari" class="form-control" ></td>
                  </tr>
                  <tr>
                   
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">No Lot</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="pmwlot" id="pmwlot" class="form-control" ></td>    
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">WIP</td>
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="beratwip" id="beratwip" class="form-control" ></td>
                
                  </tr>
</table>


<table class="table table-border" id="product_info_table">
                <tr>
                      <td colspan="14" align="center" style="background-color:#FFA500;" ><b>MANDRELING CYCLE TIME / PCS (second)</b></td>
                      <td colspan="9" align="center" style="background-color:#8FBC8F;" ><b>CURRING</b></td>

                  </tr>
				        <tr>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>1<b></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>2<b></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>3<b></td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>4<b></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>5<b></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>6<b></td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>7<b></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>8<b></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>9<b></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>10<b></td>
                    <td  align="center" colspan="2" style="background-color:#8FBC8F; width:10% ; font-size:16px;"><b>Total<b></td>
                    <td  align="center" colspan="2" style="background-color:#8FBC8F; width:10% ; font-size:16px;"><b>Rata-Rata<b></td>
                    <td  align="center" colspan="6" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Auto Clave No<b>
                    </td>
                    <td  align="center" colspan="6" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Poscuring<b>
                   
                    </td>

               </tr>

               <tr>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctsatu" id="mctsatu" class="form-control" ></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mctdua" id="mctdua" class="form-control" ></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mcttiga" id="mcttiga" class="form-control" ></td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctempat" id="mctempat" class="form-control" ></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mctlima" id="mctlima" class="form-control" ></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctenam" id="mctenam" class="form-control" ></td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mcttujuh" id="mcttujuh" class="form-control" ></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mctdelapan" id="mctdelapan" class="form-control" ></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="mctsembilan" name="mctsembilan" id="emlotsatu" class="form-control" ></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctsepuluh" id="mctsepuluh" class="form-control" ></td>
                    <td  align="center" colspan="2" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mcttotal" id="mcttotal" class="form-control" ></td>
                    <td  align="center" colspan="2" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctrata" id="mctrata" class="form-control" ></td>
                    <td colspan="6" align="center" colspan="2" style="background-color:#fada5e; width:5% ; font-size:16px;"><b><b>
                    <select class="form-control select_group customer" name="pmautoclave" id="pmautoclave" class="form-control" required onkeyup="getTotal(1)">
							<option value="1">Autoclave 1</option>
                            <option value="2">Autoclave 2</option>
                            <option value="3">Autoclave 3</option>
                            <option value="4">Autoclave 4</option>
                            <option value="5">Autoclave 5</option>
                            <option value="6">Autoclave 6</option>
                            <option value="7">Autoclave 7</option>
                            <option value="8">Autoclave 8</option>
                            <option value="9">Autoclave 9</option>
                            <option value="10">Autoclave 10</option>
                            <option value="11">Autoclave 11</option>
                            <option value="12">Autoclave 12</option>
                              
                    </select>
                    </td>
                    <td  align="center" colspan="4" style="background-color:#fada5e; width:15% ; font-size:16px;"><b><b>
                    <select class="form-control select_group customer" name="pmposcuring" id="pmposcuring" class="form-control" required onkeyup="getTotal(1)">
							<option value="1">No. 1</option>
                            <option value="2">No. 2</option>
                            <option value="3">No. 3</option>
                           
                              
                    </select>
                    </td>

               </tr>


               <tr>
                   <td rowspan="2" colspan="14" align="left" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>Notes :<b><input type="text" name="pmnotes" id="pmnotes" class="form-control" ></td>
                   
                    <td  align="center" colspan="2" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Temperature<b>
                    <input type="text" name="autotemp" id="autotemp" class="form-control" >
                    </td>
                    <td  align="center" colspan="2" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Pressure(Kgf/cm)<b>
                    <input type="text" name="autopress" id="autopress" class="form-control" >
                    </td>
                    <td  align="center" colspan="2" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Time<b>
                    <input type="text" name="autotime" id="autotime" class="form-control" >
                    </td>
                    
                    <td  align="center" colspan="2" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Temperature<b>
                    <input type="text" name="postemp" id="postemp" class="form-control" >
                    </td>
                    
                    <td  align="center" colspan="2" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Time<b>
                    <input type="text" name="postime" id="postime" class="form-control" >
                    </td>
                    

               </tr>
              




				  
                 
</table>

<br>



 <tr>
            <td colspan="3"  align="left" style="background-color:#00BFFF; width:20% ; font-size:20px;">TYPE :  </td>       
            <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;">
                      
<select size="1" name="First_Answer">                  
    <option value="">Select</option>
    <option value="">----</option>
    <option value="Y">Horisontal</option>
    <option value="N">Vertikal</option>
</select>

<select size="1" name="Second_Answer" disabled="disabled">                  
    <option value="">Select</option>
    <option value="">----</option>
    <option value="Y">Yes</option>
    <option value="N">No</option>
</select>


<select size="1" name="three_Answer" disabled="disabled">                  
    <option value="">Select</option>
    <option value="">----</option>
    <option value="16">16</option>
    <option value="32">32</option>
</select>
                    </td>
 
  
                </tr>
				
				











</body>






              <div class="box-footer">
                
                <button type="submit" class="btn btn-primary">SAVE</button>
                <a href="<?php echo base_url('trial/') ?>" class="btn btn-warning">Back</a>
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


$(document).ready(function(){
    $("select[name=First_Answer]").change(function(){
        var first_answer = $(this).val();

        if(first_answer == 'Y')
        {
            $("select[name=three_Answer]").removeAttr("disabled"),
      
            $("select[name=Second_Answer]").attr("disabled", true);
        }
        else if (first_answer == 'N')
        {
            $("select[name=Second_Answer]").removeAttr("disabled"),
        
            $("select[name=three_Answer]").attr("disabled", true);
        }
    });

	
});



$(document).ready(function(){
    $("select[name=brtype]").change(function(){
        var brtype = $(this).val();

        if(brtype == 'HORIZONTAL')
        {
            $("select[name=extcones]").removeAttr("disabled"),
      
            $("input[name=extgear]").attr("disabled", true),
			
			 $("input[name=extcones]").attr("disabled", true);
			
        }
        else if (brtype == 'VERTIKAL')
        {
            $("input[name=extgear]").removeAttr("disabled"),
        
            $("input[name=extcones]").removeAttr("disabled");
        }
    });

	
});



  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainEnewsNav").addClass('active');
    $("#manageEnewsNav").addClass('active');
    

 // tambah table 
    $("#prod_row").unbind('click').bind('click', function() {
      var table = $("#prod_info_table");
      var count_table_tbody_tr = $("#prod_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+                
                   '<td style="background-color:#F0B27A;" ><input type="text" name="partno[]" id="partno_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td style="background-color:#F0B27A;" ><input type="text" name="partname[]" id="partname_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td style="background-color:#F0B27A;" ><input type="text" name="spek[]" id="spek_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td style="background-color:#F0B27A;" ><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td style="background-color:#F0B27A;" ><input type="text" name="supplier[]" id="supplier_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                     '<td style="background-color:#F0B27A;" ><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#prod_info_table tbody tr:last").after(html);  
              }
              else {
                $("#prod_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

    });


    
    // Add new row in the table 
    $("#product_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="number" name="product[]" id="product_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="sm[]" id="sm_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="number" name="nm[]" id="nm_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="number" name="cm[]" id="cm_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="think[]" id="think_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="dimin[]" id="dimin_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="number" name="dimout[]" id="dimout_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="number" name="lenght[]" id="lenght_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="volume[]" id="volume_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="number" name="estimate[]" id="estimate_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="number" name="actual[]" id="actual_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+     
                '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

    
    // Add new row in the table 
    $("#pnm_row").unbind('click').bind('click', function() {
      var table = $("#pnm_info_table");
      var count_table_tbody_tr = $("#pnm_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="number" name="pnm[]" id="pnm_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="mnm[]" id="mnm_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="number" name="cte[]" id="cte_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="number" name="cta[]" id="cta_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="cpe[]" id="cpe_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="cpa[]" id="cpa_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="number" name="rmks[]" id="rmks_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
                
             '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#pnm_info_table tbody tr:last").after(html);  
              }
              else {
                $("#pnm_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

    
    // Add new row in the table 
    $("#mpt_row").unbind('click').bind('click', function() {
      var table = $("#mpt_info_table");
      var count_table_tbody_tr = $("#mpt_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="number" name="mpt[]" id="mpt_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="number" name="note[]" id="note_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               
             '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#mpt_info_table tbody tr:last").after(html);  
              }
              else {
                $("#mpt_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });



      // tools toolning
      $("#tooling_row").unbind('click').bind('click', function() {
      var table = $("#tooling_info_table");
      var count_table_tbody_tr = $("#tooling_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+                
                   '<td style="background-color:#F0B27A;" ><input type="text" name="tooling[]" id="tooling_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td style="background-color:#F0B27A;" ><input type="text" name="toolcavity[]" id="toolcavity_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td style="background-color:#F0B27A;" ><input type="text" name="toolqty[]" id="toolqty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                     '<td style="background-color:#F0B27A;" ><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#tooling_info_table tbody tr:last").after(html);  
              }
              else {
                $("#tooling_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

 function getNewitemData(rw_id)
  {
    var new_id = $("#datapo_"+rw_id).val();    
    if(new_id == "") {
	$("#date_created_"+rw_id).val("");
      $("#customer_"+rw_id).val("");
      $("#namepart_"+rw_id).val("");
	   $("#nopart_"+rw_id).val("");
	    $("#dom_"+rw_id).val("");
       $("#jumlah_"+rw_id).val("");
	   $("#dp_"+rw_id).val("");
	    $("#tdp_"+rw_id).val("");
		 $("#modelpart_"+rw_id).val("");
	    $("#typepart_"+rw_id).val("");

    } else {
      $.ajax({
        url: base_url + 'Orders/getNewitemValueById',
        type: 'post',
        data: {new_id : new_id},
        dataType: 'json',
        success:function(response) { 
		$("#date_created_"+rw_id).val(response.date_created);
		$("#customer_"+rw_id).val(response.name);
		$("#namepart_"+rw_id).val(response.partname);
		$("#nopart_"+rw_id).val(response.partno);
	    $("#dom_"+rw_id).val(response.dom);
		$("#jumlah_"+rw_id).val(response.qty);
		$("#dp_"+rw_id).val(response.dp);
		$("#tdp_"+rw_id).val(response.tdp);
		$("#modelpart_"+rw_id).val(response.modelpart);
		$("#typepart_"+rw_id).val(response.typepart);
			
		}  
      }); 
    }
  }


  function removeRow(tr_id)
  {
    $("#tooling_info_table tbody tr#row_"+tr_id).remove();
    $("#pnm_info_table tbody tr#row_"+tr_id).remove();
    $("#mpt_info_table tbody tr#row_"+tr_id).remove();
    $("#prod_info_table tbody tr#row_"+tr_id).remove();
    $("#product_info_table tbody tr#row_"+tr_id).remove();
   

  
  }
</script>