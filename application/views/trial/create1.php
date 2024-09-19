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
  text-align: center;
  width: 100%;  
  padding: 5px;  
margin: 5px 0 2px 0;  
display: inline-block;  
 border: none;  
 background: #f1f1f1;  
}  
input[type=text]:focus {  
background-color: #7fffd4;  
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
                    <td  rowspan="3" align="center" style="background-color:#00BFFF; width:5% ; font-size:16px;"><b>Material</td>
                    <td  rowspan="2"align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">Compound Code</td>
                    <td  align="center" style="background-color:#fada5e; width:12% ; font-size:16px;"><input type="text"  name="emccsatu" id="emccsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:12% ; font-size:16px;"><input type="text"  name="emccdua" id="emccdua" class="form-control" ></td>
                    <td colspan="14" align="center" style="background-color:#00BFFF; width:10% ; font-size:16px;"><b>Pilih Mesin Extrussion</b></td>
                    

        </tr>
        <tr>
                   
                   
                   <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"></td>
                   <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"></td>
      
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                  <label> No. 1 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 2 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 3 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 4 </label>
                   </td>
                    
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 5 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 6 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 7 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 8 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                   <label> No. 9 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                   <label> No. 10 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                   <label> No. 11 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                   <label> No. 12 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                   <label> No. 13 </label>
                   </td>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                   <label> No. 14</label>
                   </td>
                 
              </tr>

        <tr>
                   
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">No Lot</td>
                    <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="emlotsatu" id="emlotsatu" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="emlotdua" id="emlotdua" class="form-control" ></td>
       
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="msatu" id="msatu" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="1pn.jpg">--</option>
                              <option value="1nb.jpg"> 1</option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mdua" id="mdua" class="form-control" onkeyup="getTotal(1)">
                              <option  value="2pn.jpg">--</option>
                              <option value="2nb.jpg"> 2</option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mtiga" id="mtiga" class="form-control" onkeyup="getTotal(1)">
                              <option  value="3pn.jpg">--</option>
                              <option value="3nb.jpg"> 3</option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mempat" id="mempat" class="form-control" onkeyup="getTotal(1)">
                              <option  value="4pn.jpg">--</option>
                              <option value="4nb.jpg"> 4</option>
                             
                      </select>
                    </td>
                     
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mlima" id="mlima" class="form-control" onkeyup="getTotal(1)">
                              <option  value="5pn.jpg">--</option>
                              <option value="5nb.jpg"> 5 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="menam" id="menam" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="6pn.jpg">--</option>
                              <option value="6nb.jpg"> 6 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mtujuh" id="mtujuh" class="form-control" onkeyup="getTotal(1)">
                              <option  value="7pn.jpg">--</option>
                              <option value="7nb.jpg"> 7</option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mdelapan" id="mdelapan" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="8pn.jpg">--</option>
                              <option value="8nb.jpg"> 8 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="msembilan" id="msembilan" class="form-control" onkeyup="getTotal(1)">
                              <option  value="9pn.jpg">--</option>
                              <option value="9nb.jpg"> 9 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="msepuluh" id="msepuluh" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="10pn.jpg">--</option>
                              <option value="10nb.jpg"> 10 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="msebelas" id="msebelas" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="11pn.jpg">--</option>
                              <option value="11nb.jpg"> 11</option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mduabelas" id="mduabelas" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="12pn.jpg">--</option>
                              <option value="12nb.jpg"> 12 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:4% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mtigabelas" id="mtigabelas" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="13pn.jpg">--</option>
                              <option value="13nb.jpg"> 13 </option>
                             
                      </select>
                    </td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="mempatbelas" id="mempatbelas" class="form-control"  onkeyup="getTotal(1)">
                              <option  value="14pn.jpg">--</option>
                              <option value="14nb.jpg"> 14 </option>
                             
                      </select>
                    </td>
                 
            
                  
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
                      <td colspan="16" align="center" style="background-color:#40E0D0" ><b>EXTRUSION CYCLE TIME/PCS (second)</b></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Type</td>
                    <td  colspan="6" align="center" style="background-color:#40E0D0"; width:5% ; font-size:16px;">Machine No</td>

                    
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>1</td>
                    <td  colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">2</td>
                    
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>3</td>
                    <td  colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">4</td>
                    
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>5</td>
                    <td colspan="2"  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">6</td> 
                    <td colspan="2"align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><b>Total</td>
                    <td  colspan="2"  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">Average</td>
                   
      
                  </tr>
                  <tr>
                  <td colspan="2" align="center" style="background-color:#8FBC8F; width:12% ; font-size:16px;">
                  <select class="form-control select_group customer" name="brtype" id="brtypa" class="form-control" required onkeyup="getTotal(1)">
							                <option value="#"></option>            
                              <option value="HORIZONTAL">HORIZONTAL</option>
                              <option value="VERTIKAL">VERTIKAL</option>
                             
                      </select>
                
                </td>
                    
                    <td  align="center" style="background-color:#8FBC8F; width:3% ; font-size:16px;">
                    <select class="form-control select_group customer" name="bmsatu" id="bmsatu" class="form-control" required onkeyup="getTotal(1)">
							      <option value="1mp.jpg"> </option>
                    <option value="1mb.jpg">No. 1</option>
                             
                    </select>
                    </td> 
                    <td  align="center" style="background-color:#8FBC8F; width:3% ; font-size:16px;">
                    <select class="form-control select_group customer" name="bmdua" id="bmdua" class="form-control" required onkeyup="getTotal(1)">
							      <option value="2mp.jpg"> </option>
                    <option value="2mb.jpg">No. 2</option>
                             
                    </select> 
                  
                  </td>

                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;">
                    <select class="form-control select_group customer" name="bmtiga" id="bmtiga" class="form-control" required onkeyup="getTotal(1)">
							      <option value="3mp.jpg"> </option>
                    <option value="3mb.jpg">No. 3</option>
                             
                    </select> 
                    </td>
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;">
                    <select class="form-control select_group customer" name="bmempat" id="bmempat" class="form-control" required onkeyup="getTotal(1)">
							      <option value="4mp.jpg"> </option>
                    <option value="4mb.jpg">No. 4</option>
                             
                    </select> 
                  
                    </td>
                    
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;">
                    <select class="form-control select_group customer" name="bmlima" id="bmlima" class="form-control" required onkeyup="getTotal(1)">
							      <option value="5mp.jpg"> </option>
                    <option value="5mb.jpg">No. 5</option>
                             
                    </select> 
                    </td> 
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;">
                    <select class="form-control select_group customer" name="bmenam" id="bmenam" class="form-control" required onkeyup="getTotal(1)">
							      <option value="6mp.jpg"> </option>
                    <option value="6mb.jpg">No. 6</option>
                             
                    </select> 
                    </td> 
                
                    
                    <td  align="center" style="background-color:#8FBC8F; width:3% ; font-size:16px;"><input type="text" value="0" name="ectsatu" id="ectsatu" class="form-control" required onkeyup="getect"> </td> 
                    <td  align="center" style="background-color:#8FBC8F; width:3% ; font-size:16px;"><input type="text" value="0" name="ectsatux" id="ectsatux" class="form-control" required onkeyup="getect"></td>

                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0"name="ectdua" id="ectdua" class="form-control" required onkeyup="getect"></td>
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0" name="ectduax" id="ectduax" class="form-control" required onkeyup="getect"></td>
                    
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0" name="ecttiga" id="ecttiga" class="form-control" required onkeyup="getect"></td> 
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0" name="ecttigax" id="ecttigax" class="form-control" required onkeyup="getect"></td> 
                
                    <td  align="center" style="background-color:#8FBC8F; width:3% ; font-size:16px;"><input type="text" value="0" name="ectempat" id="ectempat" class="form-control" required onkeyup="getect"></td>
                    <td  align="center" style="background-color:#8FBC8F; width:3% ; font-size:16px;"><input type="text" value="0" name="ectempatx" id="ectempatx" class="form-control" required onkeyup="getect"></td>
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0"name="ectlima" id="ectlima" class="form-control" required onkeyup="getect"></td>
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0" name="ectlimax" id="ectlimax" class="form-control" required onkeyup="getect"></td>
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text"  value="0"name="ectenam" id="ectenam" class="form-control" required onkeyup="getect"></td>
                    <td  align="center" style="background-color:#fada5e; width:3% ; font-size:16px;"><input type="text" value="0" name="ectenamx" id="ectenamx" class="form-control" required onkeyup="getect" ></td>
                  
                    <td colspan="2"  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" value="0" name="ecttotal" id="ecttotal" class="form-control" required onkeyup="getect"></td>
                    <td colspan="2" align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" value="0" name="ectrata" id="ectrata" class="form-control" required onkeyup="getect"></td>             
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
        <td  align="center" style="background-color:#8FBC8F; width:15% ; font-size:16px;">
        <select class="form-control select_group customer"  id="extcones" class="form-control" name="extcones" disabled="disabled">
		          
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


<table class="table table-border" id="bra_info_table">
     
<tr>
  <h4> MESIN BRAIDING For JOKEN </h4>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                    </tr>
              <tr>
              <td style="background-color:#F4A460; width:100%"> 
          
                 <div class="">
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:left;">Mesin No. 1 </label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control" id="mesinsatu" name="mesinsatu" value="-"    autocomplete="off"/>
                    </div>
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Cones </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="conessatu" name="conessatu" value="-"   autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Gear </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="gearsatu" name="gearsatu" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Braiding</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="rpmbsatu" name="rpmbsatu" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Conveyor</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="rpmcsatu" name="rpmcsatu" value="-"  autocomplete="off">
                    </div>

                   
                </div>

                
                <div class="">
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:left;">Mesin No. 2 </label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control" id="mesindua" name="mesindua"  value="-"   autocomplete="off"/>
                    </div>
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Cones </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="conesdua" name="conesdua" value="-"   autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Gear </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="geardua" name="geardua" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Braiding</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="rpmbdua" name="rpmbdua" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Conveyor</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="rpmcdua" name="rpmcdua" value="-"  autocomplete="off">
                    </div>
                </div>

                <div class="">
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:left;">Mesin No. 3 </label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control" id="mesintiga" name="mesintiga"  value="-"  autocomplete="off"/>
                    </div>
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Cones </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="conestiga" name="conestiga"  value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Gear </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="geartiga" name="geartiga" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Braiding</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="rpmbtiga" name="rpmbtiga" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Conveyor</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="rpmctiga" name="rpmctiga" value="-"  autocomplete="off">
                    </div>
                </div>

                <div class="">
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:left;">Mesin No. 4 </label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control" id="mesinempat" name="mesinempat"  value="-"   autocomplete="off"/>
                    </div>
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Cones </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="conesempat" name="conesempat"  value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Gear </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="gearempat" name="gearempat" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Braiding</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="rpmbempat" name="rpmbempat" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Conveyor</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="rpmcempat" name="rpmcempat"  value="-"  autocomplete="off">
                    </div>
                </div>

                <div class="">
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:left;">Mesin No. 5 </label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control" id="mesinlima" name="mesinlima"  value="-"   autocomplete="off"/>
                    </div>
                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Cones </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="coneslima" name="coneslima"  value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">Gear </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="gearlima" name="gearlima" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Braiding</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" id="rpmblima" name="rpmblima" value="-"  autocomplete="off">
                    </div>

                    <label for="gross_amount" class="col-sm-1 control-label" style="text-align:right;">RPM Conveyor</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="rpmclima" name="rpmclima" value="-"  autocomplete="off">
                    </div>
                </div>

  </div>

</td>
                    

                    


</tr>

<tr>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
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
                    <td  align="center" colspan="6" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Auto Clave No<b>
                    </td>
                    <td  align="center" colspan="6" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Poscuring<b>
                   
                    </td>

               </tr>

               <tr>
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctsatu" id="mctsatu" value="0" class="form-control" required onkeyup="getmct"></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mctdua" id="mctdua" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mcttiga" id="mcttiga" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctempat" id="mctempat" value="0" class="form-control" required onkeyup="getmct"></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mctlima" id="mctlima" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctenam" id="mctenam" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mcttujuh" id="mcttujuh" value="0" class="form-control" required onkeyup="getmct"></td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;"><input type="text" name="mctdelapan" id="mctdelapan" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="mctsembilan" name="mctsembilan" id="mctsembilan" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctsepuluh" id="mctsepuluh" value="0" class="form-control" required onkeyup="getmct" ></td>
                    <td  align="center" colspan="2" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mcttotal" id="mcttotal" value="0" class="form-control" required onkeyup="getmct"></td>
                    <td  align="center" colspan="2" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><input type="text" name="mctrata" id="mctrata" value="0" class="form-control" required onkeyup="getmct"></td>
                  
                <!-- select autoclave -->
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autosatu" id="autosatu" class="form-control" required onkeyup="getTotal(1)">
							      <option value="1ap.jpg"> </option>
                    <option value="1ab.jpg">No. 1</option>
                             
                    </select>
                  
                  
                   </td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                   <select class="form-control select_group customer" name="autodua" id="autodua" class="form-control" required onkeyup="getTotal(1)">
							      <option value="2ap.jpg"> </option>
                    <option value="2ab.jpg">No. 2</option>
                             
                    </select>
                  
                  </td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autotiga" id="autotiga" class="form-control" required onkeyup="getTotal(1)">
							      <option value="3ap.jpg"> </option>
                    <option value="3ab.jpg">No. 3</option>
                             
                    </select>
                    
                  </td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autoempat" id="autoempat" class="form-control" required onkeyup="getTotal(1)">
							      <option value="4ap.jpg"> </option>
                    <option value="4ab.jpg">No. 4</option>
                             
                    </select>
                  
                  </td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                   <select class="form-control select_group customer" name="autolima" id="autolima" class="form-control" required onkeyup="getTotal(1)">
							      <option value="5ap.jpg"> </option>
                    <option value="5ab.jpg">No. 5</option>
                             
                    </select>
                  </td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autoenam" id="autoenam" class="form-control" required onkeyup="getTotal(1)">
							      <option value="6ap.jpg"> </option>
                    <option value="6ab.jpg">No. 6</option>
                             
                    </select> 
                  </td>
                   
                <!-- select poscuring -->
                    <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="possatu" id="possatu" class="form-control" required onkeyup="getTotal(1)">
							      <option value="1pp.jpg"> </option>
                    <option value="1pb.jpg">No. 1</option>
                             
                    </select>
                
                  </td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                   <select class="form-control select_group customer" name="posdua" id="posdua" class="form-control" required onkeyup="getTotal(1)">
							      <option value="2pp.jpg"> </option>
                    <option value="2pb.jpg">No. 2</option>
                             
                    </select>
                  </td>
                    <td  align="center" colspan="" style="background-color:#fada5e; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="postiga" id="postiga" class="form-control" required onkeyup="getTotal(1)">
							      <option value="3pp.jpg"> </option>
                    <option value="3pb.jpg">No. 3</option>
                             
                    </select>
                  
                  </td>
                   
                   


               </tr>


               <tr>
                   <td rowspan="3" colspan="14" align="left" style="background-color:#8FBC8F; width:5% ; font-size:16px;"><b>Notes :<b><input type="text" name="pmnotes" id="pmnotes" class="form-control" ></td>
                   
                   <!-- select autoclave -->
                   <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autotujuh" id="autotujuh" class="form-control" required onkeyup="getTotal(1)">
							      <option value="7ap.jpg"> </option>
                    <option value="7ab.jpg">No. 7</option>
                             
                    </select>
                  
                  
                   </td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                   <select class="form-control select_group customer" name="autodelapan" id="autodelapan" class="form-control" required onkeyup="getTotal(1)">
							      <option value="8ap.jpg"> </option>
                    <option value="8ab.jpg">No. 8</option>
                             
                    </select>
                  
                  </td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autosembilan" id="autosembilan" class="form-control" required onkeyup="getTotal(1)">
							      <option value="9ap.jpg"> </option>
                    <option value="9ab.jpg">No. 9</option>
                             
                    </select>
                    
                  </td>
                    <td  align="center" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autosepuluh" id="autosepuluh" class="form-control" required onkeyup="getTotal(1)">
							      <option value="10ap.jpg"> </option>
                    <option value="10ab.jpg">No. 10</option>
                             
                    </select>
                  
                  </td>
                   <td  align="center" style="background-color:#fada5e; width:5% ; font-size:16px;">
                   <select class="form-control select_group customer" name="autosebelas" id="autosebelas" class="form-control" required onkeyup="getTotal(1)">
							      <option value="11ap.jpg"> </option>
                    <option value="11ab.jpg">No. 11</option>
                             
                    </select>
                  </td>
                    <td  align="center" colspan="" style="background-color:#8FBC8F; width:5% ; font-size:16px;">
                    <select class="form-control select_group customer" name="autoduabelas" id="autoduabelas" class="form-control" required onkeyup="getTotal(1)">
							      <option value="12ap.jpg"> </option>
                    <option value="12ab.jpg">No. 12</option>
                             
                    </select> 
                  </td>
                    


</tr>
<tr>
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

<table class="table table-bordered" >
                  <thead>
         
                    <tr>
                    <td colspan="24" align="center" style="background-color:#FFA500" ><b>QUALITY CONTROL</b></td>
               </tr>
               <tr>
                    <td colspan="12" align="center" style="background-color:#AFEEEE" ><b>CHECK MANDREL</b></td>
                    
                    <td colspan="" align="center" style="background-color:#AFEEEE; width:15%;" ><b></b></td>
                    <td colspan="12" align="center" style="background-color:#AFEEEE" ><b>CHECK PRODUK JADI</b></td>
               </tr>
                   
</thead>
</table>
                <table class="table table-bordered" id="cman_info_table">
                  <thead>
                    <tr>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>ITEM CHECK</td>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>STANDART</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>1</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>2</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>3</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>4</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>5</td>
                      <td style="background-color:#778899; width:1%; font-size:16px;"   align="center" ><b></td>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>ITEM CHECK</td>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>STANDART</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>1</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>2</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>3</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>4</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>5</td>
                      <td rowspan="2"style="background-color:#778899; width:2%; "><button type="button" id="cman_row" class="btn btn-default"><i class="fa fa-plus"></i></button></td>                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td style="background-color:#F4A460;">
                       <input type="text" name="cmic[]" id="cmic_1" class="form-control"  onkeyup="getTotal(1)">
                        </td>
                        <td style="background-color:#F4A460;" >
                        <input type="text" name="cms[]" id="cms_1" class="form-control"  onkeyup="getTotal(1)"></td>
                        <td style="background-color:#F4A460;;">
                          <input type="text" name="cmsatu[]" id="cmsatu_1" class="form-control"  autocomplete="off">
                         
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmdua[]" id="cmdua_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmtiga[]" id="cmtiga_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmempat[]" id="cmempat_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmlima[]" id="cmlima_1" class="form-control"  autocomplete="off">
                          
                        </td>

                        <td style="background-color:#Fffffff;">
                      
                        </td>


                        <td style="background-color:#F4A460;">
                       <input type="text" name="cpic[]" id="cpic_1" class="form-control"  onkeyup="getTotal(1)">
                        </td>
                        <td style="background-color:#F4A460;" >
                        <input type="text" name="cps[]" id="cps_1" class="form-control"  onkeyup="getTotal(1)"></td>
                        <td style="background-color:#F4A460;;">
                          <input type="text" name="cpsatu[]" id="cpsatu_1" class="form-control"  autocomplete="off">
                         
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cpdua[]" id="cpdua_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cptiga[]" id="cptiga_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cpempat[]" id="cpempat_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cplima[]" id="cplima_1" class="form-control"  autocomplete="off">
                          
                        </td>



                        <td style="background-color:#F4A460;"><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>


<table class="table table-bordered" >
                  <thead>
         
                   
               <tr>
                    <td colspan="12" align="center" style="background-color:#AFEEEE" ><b>CHECK MATERIAL</b></td>
                    <td colspan="12" align="left" style="background-color:#AFEEEE; width:10%; " ><b></b></td>
                
                    <td colspan="12" align="center" style="background-color:#AFEEEE" ><b>CHECK PERFORMANCE PRODUK</b></td>
               </tr>
                   
</thead>
</table>
                <table class="table table-bordered" id="cmat_info_table">
                  <thead>
                    <tr>
                    <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>ITEM CHECK</td>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>STANDART</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>1</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>2</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>3</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>4</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>5</td>
                      <td style="background-color:#778899; width:1%; font-size:16px;"   align="center" ><b></td>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>ITEM CHECK</td>
                      <td style="background-color:#778899; width:10%; font-size:16px;"  align="center" ><b>STANDART</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>1</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>2</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>3</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>4</td>
                      <td style="background-color:#778899; width:5%; font-size:16px;"   align="center" ><b>5</td>
                      <td rowspan="2"style="background-color:#778899; width:2%;"><button type="button" id="cmat_row" class="btn btn-default"><i class="fa fa-plus"></i></button></td>                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td style="background-color:#F4A460;">
                       <input type="text" name="cmatic[]" id="cmatic_1" class="form-control" onkeyup="getTotal(1)">
                        </td>
                        <td style="background-color:#F4A460;" >
                        <input type="text" name="cmats[]" id="cmats_1" class="form-control"  onkeyup="getTotal(1)"></td>
                        <td style="background-color:#F4A460;;">
                          <input type="text" name="cmatsatu[]" id="cmatsatu_1" class="form-control"  autocomplete="off">
                         
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmatdua[]" id="cmatdua_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmattiga[]" id="cmattiga_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmatempat[]" id="cmatempat_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="cmatlima[]" id="cmatlima_1" class="form-control"  autocomplete="off">
                          
                        </td>

                        <td style="background-color:#Ffffff;">
                      
                        </td> 

                        <td style="background-color:#F4A460;">
                       <input type="text" name="ppic[]" id="ppic_1" class="form-control" onkeyup="getTotal(1)">
                        </td>
                        <td style="background-color:#F4A460;" >
                        <input type="text" name="pps[]" id="pps_1" class="form-control" onkeyup="getTotal(1)"></td>
                        <td style="background-color:#F4A460;;">
                          <input type="text" name="ppsatu[]" id="ppsatu_1" class="form-control"  autocomplete="off">
                         
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="ppdua[]" id="ppdua_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="pptiga[]" id="pptiga_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="ppempat[]" id="ppempat_1" class="form-control"  autocomplete="off">
                          
                        </td>
                        <td style="background-color:#F4A460;">
                        <input type="text" name="pplima[]" id="pplima_1" class="form-control"  autocomplete="off">
                          
                        </td>



                        <td style="background-color:#F4A460;"><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

<br><br>



<table class="table table-bordered" >
                    <tr>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                    </tr>
              <tr>
              <td style="background-color:#F4A460; width:50%"> 
 
                 <div class="form-group">
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:left;">Material Additional </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="matadd" name="matadd" placeholder="Enter Mat Add"   autocomplete="off"/>
                    </div>
                  
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:right;">Temuan Masalah </label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" id="temuanmasalah" name="temuanmasalah" placeholder="Enter Temuan Masalah"  autocomplete="off">
                    </div>

                  </div>

                  
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:left;">Notes </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="trialnotes" name="trialnotes" placeholder="Enter Trial notes"  autocomplete="off">
                    </div>
                    <label for="attn" class="col-sm-2 control-label" style="text-align:right;">Penyebab </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="penyebab" name="penyebab" placeholder="Enter penyebab"   autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:left;">Drawing Sketch </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="trialdw" name="trialdw" placeholder="Enter rawing"  autocomplete="off">
                    </div>
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:right;">Tindakan </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="tindakan" name="tindakan" placeholder="Enter tindakan"  autocomplete="off">
                    </div>
                  </div>
              
</td>
<td>
</td>
<td style="background-color:#F4A460; width:50%"> 
 
 <div class="form-group">
    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:center; background-color:#4caf50;">PREPARED  </label>
    <div class="col-sm-4">
    <select class="form-control select_group customer" name="prepared" id="prepared" class="form-control"  onkeyup="getTotal(1)">
							              <option value="0">Waiting</option>
                            <option value="EKI">EKI</option>
                            <option value="DZULQIFLY">DZULQIFLY</option>              
    </select>
    </div>
    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:center;background-color:#f44336;">TRIAL RESULT </label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="trialresult" name="trialresult" placeholder="Enter tindakan"  autocomplete="off">
    </div>



    

  </div>

  
  <div class="form-group">
  <label for="gross_amount" class="col-sm-2 control-label" style="text-align:center;background-color:#008cba;">CHECKED</label>
    <div class="col-sm-4">
    <select class="form-control select_group customer" name="checked" id="checked" class="form-control" onkeyup="getTotal(1)">
							              <option value="0">Waiting</option>
                               <option value="ZALIL">ZALIL</option>
                            <option value="DEDE">DEDE</option>     
                            <option value="MEMBER QC">Member QC</option>                   
    </select>


    </div>
    
  </div>

  <div class="form-group">
  <label for="gross_amount" class="col-sm-2 control-label " style="text-align:center; background-color:#778899;">APPROVED</label></span>
    <div class="col-sm-4">
    <select class="form-control select_group customer" name="approved" id="approved" class="form-control"  onkeyup="getTotal(1)">
							              <option value="0">Waiting</option>
                            <option value="1">OKE</option>
                            <option value="2">NO</option>              
    </select>








    </div>
   
  </div>

</td>


</tr>

<tr>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                      <th colspan="2" style="background-color:#778899; width:50% font-size:24px;"></th>
                    </tr>
  



</table>






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
 
    });
    $(document).ready(function() {
        $("#ectsatu, #ectsatux, #ectdua, #ectduax,#ecttiga, #ecttigax,#ectempat,#ectlima, #ectlimax, #ecxenam, #ectenamx ").keyup(function() { 
  
    var a = $("#ectsatu").val();
    var ax = $("#ectsatux").val();
    var b = $("#ectdua").val();
    var bx = $("#ectduax").val();
    var c = $("#ecttiga").val();
    var cx = $("#ecttigax").val();
    var d = $("#ectempat").val();
    var dx = $("#ectempatx").val();
    var e = $("#ectlima").val();
    var ex = $("#ectlimax").val();
    var f = $("#ectenam").val();
    var fx = $("#ectenamx").val();
    var totalall =(( parseInt(ax) + parseInt (a) ) +( parseInt (bx)  + parseInt (bx) ) + (parseInt (c) + parseInt (cx)) + (parseInt (dx) + parseInt (d)) + (parseInt (e) + parseInt (ex)) + ( parseInt (f) + parseInt (fx)));    
      $("#ecttotal").val(totalall);  

     
    var rata = totalall / 6 ;
            $("#ectrata").val(rata);
        });
    });

    $(document).ready(function() {
        $("#mctsatu, #mctdua, #mcttiga, #mctempat, #mctlima, #mctenam, #mcttujuh, #mctdelapan, #mctsembilan, #mctsepuluh").keyup(function() { 
  
    var a = $("#mctsatu").val();
    var b = $("#mctdua").val();
    var c = $("#mcttiga").val();
    var d = $("#mctempat").val();
    var e = $("#mctlima").val();
    var f = $("#mctenam").val();
    var g = $("#mcttujuh").val();
    var h = $("#mctdelapan").val();
    var i = $("#mctsembilan").val();
    var j = $("#mctsepuluh").val();
  
    var mct = ((parseInt(a) + parseInt (b) ) + (parseInt(c) + parseInt (d) )
    + (parseInt(e) + parseInt (f) )+ (parseInt(g) + parseInt (h))+ (parseInt(i) + parseInt (j))
    
    
    ) ;    
      $("#mcttotal").val(mct);  

     
    var av = mct / 10 ;
            $("#mctrata").val(av);
        });
    });

    
    // Add new row in the table 
    $("#cman_row").unbind('click').bind('click', function() {
      var table = $("#cman_info_table");
      var count_table_tbody_tr = $("#cman_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmic[]" id="cmic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cms[]" id="cms_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cmsatu[]" id="cmsatu_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="text" name="cmdua[]" id="cmdua_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmtiga[]" id="cmtiga_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmempat[]" id="cmempat_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cmlima[]" id="cmlima_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#Ffffff;"> </td>'+ 
            
               '<td style="background-color:#F0B27A;"><input type="text" name="cpic[]" id="cpic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cps[]" id="cps_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cpsatu[]" id="cpsatu_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="text" name="cpdua[]" id="cpdua_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cptiga[]" id="cptiga_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cpempat[]" id="cpempat_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cplima[]" id="cplima_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 

               '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#cman_info_table tbody tr:last").after(html);  
              }
              else {
                $("#cman_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

    
    // Add new row in the table 
    $("#cp_row").unbind('click').bind('click', function() {
      var table = $("#cp_info_table");
      var count_table_tbody_tr = $("#cp_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cpic[]" id="cpic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cps[]" id="cps_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cpsatu[]" id="cpsatu_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="text" name="cpdua[]" id="cpdua_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cptiga[]" id="cptiga_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cpempat[]" id="cpempat_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cplima[]" id="cplima_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
                
             '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#cp_info_table tbody tr:last").after(html);  
              }
              else {
                $("#cp_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

 
    // Add new row in the table 
    $("#cmat_row").unbind('click').bind('click', function() {
      var table = $("#cmat_info_table");
      var count_table_tbody_tr = $("#cmat_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmatic[]" id="cmatic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmats[]" id="cmats_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cmatsatu[]" id="cmatsatu_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="text" name="cmatdua[]" id="cmatdua_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmattiga[]" id="cmattiga_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="cmatempat[]" id="cmatempat_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="cmatlima[]" id="cmatlima_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               
               '<td style="background-color:#Ffffff;"> </td>'+ 
            
               '<td style="background-color:#F0B27A;"><input type="text" name="ppic[]" id="cpic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="pps[]" id="cps_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="ppsatu[]" id="cpsatu_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="text" name="ppdua[]" id="cpdua_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="pptiga[]" id="cptiga_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="ppempat[]" id="cpempat_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="pplima[]" id="cplima_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 


             '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#cmat_info_table tbody tr:last").after(html);  
              }
              else {
                $("#cmat_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });
     
    // Add new row in the table 
    $("#pp_row").unbind('click').bind('click', function() {
      var table = $("#pp_info_table");
      var count_table_tbody_tr = $("#pp_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
               '<td style="background-color:#F0B27A;"><input type="text" name="ppic[]" id="ppic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="pps[]" id="pps_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="ppsatu[]" id="ppsatu_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+  
               '<td style="background-color:#F0B27A;"><input type="text" name="ppdua[]" id="ppdua_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="pptiga[]" id="pptiga_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
               '<td style="background-color:#F0B27A;"><input type="text" name="ppempat[]" id="ppempat_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
               '<td style="background-color:#F0B27A;"><input type="text" name="pplima[]" id="pplima_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+ 
                
             '<td style="background-color:#F0B27A;"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
             '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#pp_info_table tbody tr:last").after(html);  
              }
              else {
                $("#pp_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

   
 
    // penting !!!! paresFolat untuk bilangan Desimal 0.44 dlll
    $(document).ready(function() {
        $("#wipbh, #wipcover, #wipthread ").keyup(function() { 
  
    var wipbh = $("#wipbh").val();
    var wipcover = $("#wipcover").val();
    var wipthread = $("#wipthread").val();
    
    var totalwip =(( parseFloat(wipbh) + parseFloat (wipcover) ) +( parseFloat (wipthread) ));    
      $("#wiptotal").val(totalwip);  
      totalwip = totalwip.toFixed(2);
     

          
        });
    });




  function removeRow(tr_id)
  {
    $("#cp_info_table tbody tr#row_"+tr_id).remove();
    $("#cmat_info_table tbody tr#row_"+tr_id).remove();
    $("#cman_info_table tbody tr#row_"+tr_id).remove();
    $("#pp_info_table tbody tr#row_"+tr_id).remove();
     

  
  }
</script>