<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>General Information Part</small>
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
hr {  
  border: 1px solid #f1f1f1;  
  margin-bottom: 2px;  
}  
/* The following tag selector button uses the different properties for the Button. */  
 
/* The following tag selector hover uses the opacity property for the Button which select button when you mouse over it. */  
button:hover {  
opacity: 1;  
}  
</style>  

        <div class="box">
          <div class="box-header">
           
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('gi/create') ?>" method="post" class="form-horizontal" name="autoSumForm" >
              <div class="box-body">

                <?php echo validation_errors(); ?>

        
          <table class="table table-border" id="product_info_table">
          <tr>
		              <td  rowspan="4" width="2%"  style="font-size:16px"><p align="left"><img src="<?php echo site_url('assets/images/logo.jpg'); ?>" /></p>
          </td>
			      <td  rowspan="4" width="25%" align="cENTER" style="font-size:36px">
			        <h1>   <u><b> GENERAL INFORMATION PARTS </b></u> </h1>
          </td>
			

	 </tr>
        </table>
   <table class="table table-border" id="product_info_table">
                <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Part No</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="partno" id="partno" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td colspan="4" align="center" style="background-color:#fada5e;" ><b>Compound Material</b></td>
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Part Name</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="partname" id="partname" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  align="center" style="background-color:#fada5e;" ><b>Layer 1</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Weight (gr)</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Layer 2</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Weight (gr)</b></td>
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Type</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="type" id="type" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="cmlayersatu" id="cmlayersatu" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="layersatuw" id="layersatuw" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="cmlayerdua" id="cmlayerdua" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="layerduaw" id="layerduaw" class="form-control" ></td>
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Customer</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="customer" id="customer" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  colspan="4" align="center" style="background-color:#fada5e;" ><b>Compound Specification</b></td>
        
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Model/Project</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="model" id="model" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Layer 1</b></td>
                      
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Layer 2</b></td>
                     
                      
                 </tr>
                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Year Development</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="yeardev" id="yeardev" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="2"  align="center" style="background-color:#fada5e;" ><b><input type="text"  name="cslayersatu" id="cslayersatu" class="form-control" ></b></td>
                      
                      <td colspan="2"  align="center" style="background-color:#fada5e;" ><b><input type="text" name="cslayerdua" id="cslayerdua" class="form-control" ></b></td>
                     
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Hose Standart</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="hosestd" id="hosestd" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#fada5e;" ><b>Thread / Fabric Type</b></td>
                      
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Weight (gr)</b></td>
                 </tr>
                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Production (Qty/Month)</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="prodqty" id="prodqty" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#fada5e;" ><b><input type="text"  name="csfabrictype" id="csfabrictype" class="form-control" ></b></td>
                      
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b><input type="text"  name="csw" id="csw" class="form-control" ></b></td>
                     
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Packing Standart</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="packstd" id="packstd" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#ffffff;" ><b></b></td>
                      
                      <td colspan="2" align="center" style="background-color:#ffffff;" ><b></b></td>
                     
                      
                 </tr>
                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Note / Q Point</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="note" id="note" class="form-control" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#ffffff;" ><b></b></td>
                      
                      <td colspan="2" align="center" style="background-color:#ffffff;" ><b></b></td>
                     
                      
                 </tr>

                

                 <tr>
                      <td colspan="2" rowspan="4" align="Left" style="background-color:#fada5e; width:10% font-size:20px; vertical-align:center;" ><b>Dimension</b></td>                    
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>ID (mm)</b></td> 
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimid" id="dimid" class="form-control" ></td>                    
                      
                      
                 </tr>

                 <tr>
                        
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>OD (mm)</b></td> 
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimod" id="dimod" class="form-control" ></td>                    
                      
                      
                 </tr>

                 <tr>
                        
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>Thickness (mm)</b></td> 
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimthickness" id="dimthickness" class="form-control" ></td>                    
                      
                      
                 </tr>
                 
                 <tr>
                        
                        <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>Lenght (mm)</b></td> 
                        <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimlenght" id="dimlenght" class="form-control" ></td>                    
                        
                        
                   </tr>

                  <tr>
                      <td colspan="2"  align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>White Gross (gr)</b></td>                    
                      <td  align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="wgross" id="wgross" class="form-control" ></td>                    
                      <td colspan="2"  align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Actual Weight (gr)</b></td>                    
                      <td  align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="wactual" id="wactual" class="form-control" ></td>                    
                      
                      
                 </tr>
                  
</table> 


<br>



<table class="table table-border" id="product_info_table">
                <tr>
                      <td rowspan="5"  align="center" style="background-color:#fada5e; width=10%; font-size:16px;" >
                      <br>
                      <b>Cycle Time</b>
                      <br>
                      <img width="150" height="150" src="<?php echo site_url('assets/images/jam1.jpg'); ?>" />
                    </td>
                      <td  align="center" style="background-color:#fada5e; width=15%; " ><b>Extrude</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctextrude" id="ctextrude" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td colspan="4" align="center" style="background-color:#fada5e;" ><b>Sub Material</b></td>
                  </tr>

                  <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Waya</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctwaya" id="ctwaya" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#838996;" ></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Name</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Type/Dimension</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Qty</b></td>   
                </tr>
                  
                <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Cutting</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctcutting" id="ctcutting" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e; width=15%; " ><b>Spring</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="springname" id="springname" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="springtype" id="springtype" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="springqty" id="springqty" class="form-control" ></td>
               </tr>

               <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Finishing</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctfinishing" id="ctfinishing" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Ring</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ringname" id="ringname" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ringtype" id="ringtype" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ringqty" id="ringqty" class="form-control" ></td>
               </tr>
               <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Total</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="cttotal" id="cttotal" class="form-control" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Tape</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="tapename" id="tapename" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="tapetype" id="tapetype" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="tapeqty" id="tapeqty" class="form-control" ></td>
               </tr>
               <tr>
                      <td align="center" style="background-color:#ffffff; width=15%; " ><b></b></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Cover</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="covername" id="covername" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="covertype" id="covertype" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="coverqty" id="coverqty" class="form-control" ></td>
               </tr>
 
</table>

<table class="table table-border" id="product_info_table">
                <tr>
                      <td colspan="3" align="center" style="background-color:#fada5e;" ><b>Extrussion Process</b></td>

                  </tr>
                  <tr>
                    <td   align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Methode</td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="epmethod" id="epmethod" class="form-control" ></td>
                      <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Dies</td>
      
                  </tr>
                  <tr>
                    <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Braiding Type</td>
                    <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="braidingtype" id="braidingtype" class="form-control" ></td>
                    <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><input type="text" name="dies" id="dies" class="form-control" ></td>
       
                </tr>
</table>
      <table class="table table-border" id="product_info_table">

                <tr>
                      <td colspan="4" align="center" style="background-color:#fada5e;" ><b>RPM Braiding</b></td>
                      <td colspan="4" align="center" style="background-color:#fada5e;" ><b>RPM Conveyor</b></td>
                      <td rowspan="2" align="center" style="background-color:#fada5e;" ><b>Gear</b></td>
                  </tr>
                
                  <tr>
                    <td   align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 1</td>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 3</td>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 4</td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 5</td>
                      <td   align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 1</td>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 3</td>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 4</td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>MC 5</td>
                      
                  </tr>
                 
                     <tr >
                        <td><input type="text" name="rpmbrai" id="rpmbrai" class="form-control" > </td>
                        <td><input type="text" name="rpmbraiii" id="rpmbraiii" class="form-control" > </td>
                        <td><input type="text" name="rpmbraiv" id="rpmbraiv" class="form-control" > </td>
                        <td><input type="text" name="rpmbrav" id="rpmbrav" class="form-control" ></td>
                        <td><input type="text" name="rpmconi" id="rpmconi" class="form-control" ></td>
                        <td><input type="text" name="rpmconiii" id="rpmconiii" class="form-control" ></td>
                        <td><input type="text" name="rpmconiv" id="rpmconiv" class="form-control" ></td>
                        <td><input type="text" name="rpmconv" id="rpmconv" class="form-control" ></td>
                        <td><input type="text" name="gear" id="gear" class="form-control" ></td>
                       
                     </tr>

                    <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Cavity</td>
                      <td colspan="2" ><input type="text" name="cavity" id="cavity" class="form-control" > </td>  
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Wabari Size(mm)</td>
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Fabric Size (mm)</td>
                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Mesh</td>
                      <td colspan="2" ><input type="text" name="mesh" id="mesh" class="form-control" > </td>  
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok">P =</label>         
                                    <label class="btn btn-primary active">
                                    <input type="text"  class="form-control"  id="wsp" name="wsp"  autocomplete="off">
                                  </label></td>
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok" >P =</label>         
                                    <label class="btn btn-primary active">
                                    <input type="text"  class="form-control"  id="fsp" name="fsp"   autocomplete="off">
                                    </label></td>
                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Glue</td>
                      <td colspan="2" ><input type="text" name="glue" id="glue" class="form-control" > </td> 
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok">L =</label>         
<label class="btn btn-primary active">
    <input type="text"  class="form-control"  id="wsl" name="wsl">
  </label></td>
  <td colspan="2" rowspan="2" align="center" style="background-color:#232b2b; width:10% ; font-size:16px;"><b></td>
  <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok">L =</label>         
<label class="btn btn-primary active">
    <input type="text"  class="form-control"  id="fsl" name="fsl"   >
  </label></td>
  <td colspan="2" rowspan="2" align="center" style="background-color:#ddadaf; width:10% ; font-size:16px;"><b></td>

                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Postcure</td>
                      <td colspan="2" ><input type="text" name="postcure" id="postcure" class="form-control" > </td>  
                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Toping</td>
                      <td colspan="2" ><input type="text" name="toping" id="toping" class="form-control" > </td>  
                   </tr>   
                </table>
   <!-- Tooliing -->    <br /> <br/>          
            <table class="table table-border" id="product_info_table">
                <tr>
                      <td colspan="7" align="center" style="background-color:#fada5e;" ><b>Tooling</b></td>

                  </tr>
                
                  <tr>
                    <td  colspan="3" align="center" style="background-color:#fada5e; width:1% ; font-size:16px;"><b>Master Mandrell</td>
                      <td rowspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Mandrel Qty</td>
                      <td rowspan="2" align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Geji</td>
                      <td rowspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Jig Cutting</td>
                      <td rowspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Check and Fixture</td>  
                      
                  </tr>
                  <tr>
                    <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Wood</td>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Staindless</td>
                      <td align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Almunium</td>
                     
                      
                  </tr>


                   <tbody>
                     <tr id="row_1">
                        <td><input type="text" name="mandrelwood" id="mandrelwood" class="form-control" ></td>
                        <td><input type="text" name="mandrelstainless" id="mandrelstainless" class="form-control" ></td>
                        <td><input type="text" name="mandrelalmunium" id="mandrelalmunium" class="form-control" ></td>
                        <td><input type="text" name="mandrelqty" id="mandrelqty" class="form-control" ></td>
                        <td><input type="text" name="tollsgeji" id="tollsgeji" class="form-control" ></td>
                        <td><input type="text" name="tollsjig" id="tollsjig" class="form-control" ></td>
                        <td><input type="text" name="tollscek" id="tollscek" class="form-control" ></td>
                       
                     </tr>
                   </tbody>
                </table>

                <thead>
<!-- Tooliing -->    <br /> <br/>          
<table class="table table-border" id="revisi_info_table">
                <tr>
                      <td colspan="7" align="center" style="background-color:#fada5e;" ><b>History Part</b></td>

                  </tr>
    
                  <tr>
                    
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Revisi</td>
                      <td align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Description</td>
                      <td align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Date</td>
                      <td align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>PIC</td>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    
                  </tr>
</thead>

                   <tbody>
                   <tr id="row_1">
                   <td>
                          <input type="text" name="revisi[]" id="revisi_1" class="form-control" disabled autocomplete="off">
                    </td>
                    <td>
                          <input type="text" name="des[]" id="des_1" class="form-control" disabled autocomplete="off">
                    </td>
                    <td>
                          <input type="text" name="date[]" id="date_1" class="form-control" disabled autocomplete="off">
                    </td>
                    <td>
                          <input type="text" name="pic[]" id="pic_1" class="form-control" disabled autocomplete="off">
                    </td> 
                    <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
        


                   </tbody>
                </table>
                <table class="table table-border" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:10%">Product</th>
                      <th style="width:10%">Part Name</th>
                      <th style="width:5%">Qty</th>
                      <th style="width:5%">Mix</th>
                      <th style="width:8%">Total Qty</th>
                      <th style="width:8%">Unit</th>
                      <th style="width:8%">Unit Price</th>
                      <th style="width:8%">Amount</th>
                      <th style="width:8%">Berapa X</th>
                      <th style="width:10%">Tgl Berapa</th>
                      <th style="width:10%">Note</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>


                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($products as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="name[]" id="name_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="name_value[]" id="name_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="mix[]" id="mix_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="mix_value[]" id="mix_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="total_qty[]" id="total_qty_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="total_qty_value[]" id="total_qty_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="unit[]" id="unit_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="unit_value[]" id="unit_value_1" class="form-control" autocomplete="off">
                        </td>

                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>

                        <td><input type="text" name="kiriman[]" id="kiriman_1" class="form-control" ></td>
                        <td><input type="text" name="tgl[]" id="tgl_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td><input type="text" name="note[]" id="note_1" ></td>
                     <!--  <td><input type="text" name="konfirmasi_kalab[]" id="konfirmasi_kalab" value="waiting" class="form-control" disabled></td> -->
                      
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

              <div class="box-footer">
                
                <button type="submit" class="btn btn-primary">SAVE</button>
                <a href="<?php echo base_url('gi/') ?>" class="btn btn-warning">Back</a>
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

$("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/pocompound/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="name[]" id="name_'+row_id+'" class="form-control" disabled><input type="hidden" name="name_value[]" id="name_value_'+row_id+'" class="form-control"></td>'+
                   
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="mix[]" id="mix_'+row_id+'" class="form-control" disabled><input type="hidden" name="mix_value[]" id="mix_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="total_qty[]" id="total_qty_'+row_id+'" class="form-control" disabled><input type="hidden" name="total_qty_value[]" id="total_qty_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="unit[]" id="unit_'+row_id+'" class="form-control" disabled><input type="hidden" name="unit_value[]" id="unit_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="kiriman[]" id="kiriman_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="tgl[]" id="tgl_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="note[]" id="note_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
				//	 '<td><input type="text" value="waiting" name="konfirmasi_kalab[]" id="konfirmasi_kalab_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
				
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+ 
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



   $(document).ready(function() {
           
    $("#npwp").val();
    $("#siup").val();
    $("#brosur").val();
    $("#dataproduk").val();
    $("#produsen").val();
    $("#agen").val();
    $("#perorangan").val();
    $("#hargasaing").val();
    $("#hargapasar").val();
    $("#baik").val();
    $("#cukup").val();
    $("#dalamkota").val();
    $("#luarkota").val();
    $("#luarnegri").val();
    $("#lengkap").val();
    $("#kl").val();
    $("#hasil").val();

          });

    $(document).on("change", ".item", function() {
    var a = $("#npwp").val();
    var b = $("#siup").val();
    var c = $("#brosur").val();
    var d = $("#dataproduk").val();
    var e = $("#produsen").val();
    var f = $("#agen").val();
    var g = $("#perorangan").val();
    var h = $("#hargasaing").val();
    var i = $("#hargapasar").val();
    var j = $("#baik").val();
    var k = $("#cukup").val();
    var l = $("#dalamkota").val();
    var m = $("#luarkota").val();
    var n = $("#luarnegri").val();
    var o = $("#lengkap").val();
    var p = $("#kl").val();
    var hasil = $("#hasil").val();
    var jumlah =(Number(a) + Number(b) + Number(c) + Number(d) + Number(e) + Number(f) + Number(g) + Number(h) + Number(i) + Number(j) + Number(k) + Number(l) + Number(m) + Number(n) + Number(o) + Number(p));
    $("#hasil").val(jumlah);

    //input hasil penjumlahan otomatis 
        if (jumlah<=40)
                        kesimpulan="Tidak dimasukkan ke dalam DST";
            else if (jumlah <=55)
                        kesimpulan="Dipertimbangkan";
            else if (jumlah >55)
                        kesimpulan="Dimasukkan ke dalam DST";
            document.forms[0].kesimpulan.value=kesimpulan;
    });

  function removeRow(tr_id)
  {
    $("#revisi_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

   // Add new row in the table 
   $("#add_row").unbind('click').bind('click', function() {
      var table = $("#revisi_info_table");
      var count_table_tbody_tr = $("#revisi_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/Pocompound/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+     
                    '<td><input type="text" name="revisi[]" id="revisi_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="des[]" id="des_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="date[]" id="date_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="pic[]" id="pic_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+     
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+ 
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#revisi_info_table tbody tr:last").after(html);  
              }
              else {
                $("#revisi_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

   // /document
</script>