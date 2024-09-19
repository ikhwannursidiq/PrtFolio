

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit
      <small> General Information Parts</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">GIP</li>
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
          <form role="form" action="<?php base_url('gi/update') ?>" method="post" class="form-horizontal" name="autoSumForm" >
              <div class="box-body">

                <?php echo validation_errors(); ?>

        
          <table class="table table-border" id="p_info_table">
          <tr>
		              <td  rowspan="4" width="2%"  style="font-size:16px"><p align="left"><img src="<?php echo site_url('assets/images/logo.jpg'); ?>" /></p>
          </td>
			      <td  rowspan="4" width="25%" align="cENTER" style="font-size:36px">
			        <h1>   <u><b> GENERAL INFORMATION PARTS </b></u> </h1>
          </td>
			

	 </tr>
        </table>
   <table class="table table-border" id="pr_info_table">
                <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Part No</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="partno" id="partno" class="form-control"  value="<?php echo $gi_data['gi']['partno']; ?>" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td colspan="4" align="center" style="background-color:#fada5e;" ><b>Compound Material</b></td>
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Part Name</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="partname" id="partname" class="form-control" value="<?php echo $gi_data['gi']['partname']; ?>" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  align="center" style="background-color:#fada5e;" ><b>Layer 1</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Weight (gr)</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Layer 2</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Weight (gr)</b></td>
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Type</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="type" id="type" class="form-control" value="<?php echo $gi_data['gi']['type']; ?>"></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="cmlayersatu" id="cmlayersatu" class="form-control" value="<?php echo $gi_data['gi']['cmlayersatu']; ?>" ></td>
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="layersatuw" id="layersatuw" class="form-control" value="<?php echo $gi_data['gi']['layersatuw']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="cmlayerdua" id="cmlayerdua" class="form-control" value="<?php echo $gi_data['gi']['cmlayerdua']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e;" ><input type="text" name="layerduaw" id="layerduaw" class="form-control" value="<?php echo $gi_data['gi']['layerduaw']; ?>"></td>
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Customer</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="customer" id="customer" class="form-control" value="<?php echo $gi_data['gi']['customer']; ?>" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td  colspan="4" align="center" style="background-color:#fada5e;" ><b>Compound Specification</b></td>
        
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Model/Project</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="model" id="model" class="form-control"  value="<?php echo $gi_data['gi']['model']; ?>"></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Layer 1</b></td>
                      
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Layer 2</b></td>
                     
                      
                 </tr>
                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Year Development</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="yeardev" id="yeardev" class="form-control" value="<?php echo $gi_data['gi']['yeardev']; ?>" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="2"  align="center" style="background-color:#fada5e;" ><b><input type="text"  name="cslayersatu" id="cslayersatu" class="form-control" value="<?php echo $gi_data['gi']['cslayersatu']; ?>"></b></td>
                      
                      <td colspan="2"  align="center" style="background-color:#fada5e;" ><b><input type="text" name="cslayerdua" id="cslayerdua" class="form-control" value="<?php echo $gi_data['gi']['cslayerdua']; ?>"></b></td>
                     
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Hose Standart</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="hosestd" id="hosestd" class="form-control" value="<?php echo $gi_data['gi']['hosestd']; ?>" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#fada5e;" ><b>Thread / Fabric Type</b></td>
                      
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b>Weight (gr)</b></td>
                 </tr>
                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Production (Qty/Month)</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="prodqty" id="prodqty" class="form-control" value="<?php echo $gi_data['gi']['prodqty']; ?>" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#fada5e;" ><b><input type="text"  name="csfabrictype" id="csfabrictype" class="form-control" value="<?php echo $gi_data['gi']['csfabrictype']; ?>" ></b></td>
                      
                      <td colspan="2" align="center" style="background-color:#fada5e;" ><b><input type="text"  name="csw" id="csw" class="form-control" value="<?php echo $gi_data['gi']['csw']; ?>" ></b></td>
                     
                      
                 </tr>

                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Packing Standart</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="packstd" id="packstd" class="form-control" value="<?php echo $gi_data['gi']['packstd']; ?>" ></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#ffffff;" ><b></b></td>
                      
                      <td colspan="2" align="center" style="background-color:#ffffff;" ><b></b></td>
                     
                      
                 </tr>
                 <tr>
                      <td colspan="3" align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Note / Q Point</b></td>                    
                      <td colspan="3" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="note" id="note" class="form-control"  value="<?php echo $gi_data['gi']['note']; ?>"></td>                    
                       <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                       <td colspan="3" align="center" style="background-color:#ffffff;" ><b></b></td>
                      
                      <td colspan="2" align="center" style="background-color:#ffffff;" ><b></b></td>
                     
                      
                 </tr>

                

                 <tr>
                      <td colspan="2" rowspan="4" align="Left" style="background-color:#fada5e; width:10% font-size:20px; vertical-align:center;" ><b>Dimension</b></td>                    
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>ID (mm)</b></td> 
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimid" id="dimid" class="form-control" value="<?php echo $gi_data['gi']['dimid']; ?>"></td>                    
                      
                      
                 </tr>

                 <tr>
                        
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>OD (mm)</b></td> 
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimod" id="dimod" class="form-control" value="<?php echo $gi_data['gi']['dimod']; ?>" ></td>                    
                      
                      
                 </tr>

                 <tr>
                        
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>Thickness (mm)</b></td> 
                      <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimthickness" id="dimthickness" class="form-control" value="<?php echo $gi_data['gi']['dimthickness']; ?>"></td>                    
                      
                      
                 </tr>
                 
                 <tr>
                        
                        <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>Lenght (mm)</b></td> 
                        <td colspan="2" align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="dimlenght" id="dimlenght" class="form-control" value="<?php echo $gi_data['gi']['dimlenght']; ?>"></td>                    
                        
                        
                   </tr>

                  <tr>
                      <td colspan="2"  align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>White Gross (gr)</b></td>                    
                      <td  align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="wgross" id="wgross" class="form-control" value="<?php echo $gi_data['gi']['wgross']; ?>"></td>                    
                      <td colspan="2"  align="Left" style="background-color:#fada5e; width:10% font-size:20px;" ><b>Actual Weight (gr)</b></td>                    
                      <td  align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><input type="text" name="wactual" id="wactual" class="form-control" value="<?php echo $gi_data['gi']['wactual']; ?>" ></td>                    
                      
                      
                 </tr>
                  
</table> 


<br>



<table class="table table-border" id="pr_info_table">
                <tr>
                      <td rowspan="5"  align="center" style="background-color:#fada5e; width=10%; font-size:16px;" >
                      <br>
                      <b>Cycle Time</b>
                      <br>
                      <img width="150" height="150" src="<?php echo site_url('assets/images/jam1.jpg'); ?>" />
                    </td>
                      <td  align="center" style="background-color:#fada5e; width=15%; " ><b>Extrude</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctextrude" id="ctextrude" class="form-control" value="<?php echo $gi_data['gi']['ctextrude']; ?>"></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td> 
                      <td colspan="4" align="center" style="background-color:#fada5e;" ><b>Sub Material</b></td>
                  </tr>

                  <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Waya</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctwaya" id="ctwaya" class="form-control" value="<?php echo $gi_data['gi']['ctwaya']; ?>" ></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#838996;" ></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Name</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Type/Dimension</b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Qty</b></td>   
                </tr>
                  
                <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Cutting</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctcutting" id="ctcutting" class="form-control"  value="<?php echo $gi_data['gi']['ctcutting']; ?>"></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e; width=15%; " ><b>Spring</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="springname" id="springname" class="form-control" value="<?php echo $gi_data['gi']['springname']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="springtype" id="springtype" class="form-control" value="<?php echo $gi_data['gi']['springtype']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="springqty" id="springqty" class="form-control" value="<?php echo $gi_data['gi']['springqty']; ?>"></td>
               </tr>

               <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Finishing</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ctfinishing" id="ctfinishing" class="form-control" value="<?php echo $gi_data['gi']['ctfinishing']; ?>"></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Ring</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ringname" id="ringname" class="form-control" value="<?php echo $gi_data['gi']['ringname']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ringtype" id="ringtype" class="form-control" value="<?php echo $gi_data['gi']['ringtype']; ?>" ></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="ringqty" id="ringqty" class="form-control" value="<?php echo $gi_data['gi']['ringqty']; ?>"></td>
               </tr>
               <tr>
                      <td align="center" style="background-color:#fada5e; width=15%; " ><b>Total</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="cttotal" id="cttotal" class="form-control" value="<?php echo $gi_data['gi']['cttotal']; ?>"></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Tape</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="tapename" id="tapename" class="form-control" value="<?php echo $gi_data['gi']['tapename']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="tapetype" id="tapetype" class="form-control" value="<?php echo $gi_data['gi']['tapetype']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="tapeqty" id="tapeqty" class="form-control" value="<?php echo $gi_data['gi']['tapeqty']; ?>"></td>
               </tr>
               <tr>
                      <td align="center" style="background-color:#ffffff; width=15%; " ><b></b></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#ffffff; width:2% ; font-size:16px;"><b></td>
                      <td  align="center" style="background-color:#fada5e;" ><b>Cover</b></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="covername" id="covername" class="form-control"  value="<?php echo $gi_data['gi']['covername']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="covertype" id="covertype" class="form-control" value="<?php echo $gi_data['gi']['covertype']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="coverqty" id="coverqty" class="form-control" value="<?php echo $gi_data['gi']['coverqty']; ?>"></td>
               </tr>
 
</table>

<table class="table table-border" id="pr_info_table">
                <tr>
                      <td colspan="3" align="center" style="background-color:#fada5e;" ><b>Extrussion Process</b></td>

                  </tr>
                  <tr>
                    <td   align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Methode</td>
                      <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="epmethod" id="epmethod" class="form-control" value="<?php echo $gi_data['gi']['epmethod']; ?>"></td>
                      <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><b>Dies</td>
      
                  </tr>
                  <tr>
                    <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Braiding Type</td>
                    <td  align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><input type="text" name="braidingtype" id="braidingtype" class="form-control" value="<?php echo $gi_data['gi']['braidingtype']; ?>" ></td>
                    <td  align="center" style="background-color:#fada5e; width:15% ; font-size:16px;"><input type="text" name="dies" id="dies" class="form-control" value="<?php echo $gi_data['gi']['dies']; ?>"></td>
       
                </tr>
</table>
      <table class="table table-border" id="pr_info_table">

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
                        <td><input type="text" name="rpmbrai" id="rpmbrai" class="form-control"  value="<?php echo $gi_data['gi']['rpmbrai']; ?>"> </td>
                        <td><input type="text" name="rpmbraiii" id="rpmbraiii" class="form-control" value="<?php echo $gi_data['gi']['rpmbraiii']; ?>"> </td>
                        <td><input type="text" name="rpmbraiv" id="rpmbraiv" class="form-control" value="<?php echo $gi_data['gi']['rpmbraiv']; ?>"> </td>
                        <td><input type="text" name="rpmbrav" id="rpmbrav" class="form-control" value="<?php echo $gi_data['gi']['rpmbrav']; ?>"></td>
                        <td><input type="text" name="rpmconi" id="rpmconi" class="form-control" value="<?php echo $gi_data['gi']['rpmconi']; ?>" ></td>
                        <td><input type="text" name="rpmconiii" id="rpmconiii" class="form-control" value="<?php echo $gi_data['gi']['rpmconiii']; ?>"></td>
                        <td><input type="text" name="rpmconiv" id="rpmconiv" class="form-control" value="<?php echo $gi_data['gi']['rpmconiv']; ?>"></td>
                        <td><input type="text" name="rpmconv" id="rpmconv" class="form-control" value="<?php echo $gi_data['gi']['rpmconv']; ?>"></td>
                        <td><input type="text" name="gear" id="gear" class="form-control" value="<?php echo $gi_data['gi']['gear']; ?>"></td>
                       
                     </tr>

                    <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Cavity</td>
                      <td colspan="2" ><input type="text" name="cavity" id="cavity" class="form-control" value="<?php echo $gi_data['gi']['cavity']; ?>"> </td>  
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Wabari Size(mm)</td>
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Fabric Size (mm)</td>
                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Mesh</td>
                      <td colspan="2" ><input type="text" name="mesh" id="mesh" class="form-control" value="<?php echo $gi_data['gi']['mesh']; ?>"> </td>  
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok">P =</label>         
                                    <label class="btn btn-primary active">
                                    <input type="text"  class="form-control"  id="wsp" name="wsp"  autocomplete="off" value="<?php echo $gi_data['gi']['wsp']; ?>">
                                  </label></td>
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><b></td>
                      <td  colspan="2" align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok" >P =</label>         
                                    <label class="btn btn-primary active">
                                    <input type="text"  class="form-control"  id="fsp" name="fsp"   autocomplete="off" value="<?php echo $gi_data['gi']['fsp']; ?>">
                                    </label></td>
                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Glue</td>
                      <td colspan="2" ><input type="text" name="glue" id="glue" class="form-control" value="<?php echo $gi_data['gi']['glue']; ?>" > </td> 
                      <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok">L =</label>         
<label class="btn btn-primary active">
    <input type="text"  class="form-control"  id="wsl" name="wsl" value="<?php echo $gi_data['gi']['wsl']; ?>">
  </label></td>
  <td colspan="2" rowspan="2" align="center" style="background-color:#232b2b; width:10% ; font-size:16px;"><b></td>
  <td  align="center" style="background-color:#ffffff; width:10% ; font-size:16px;"><label for="ok">L =</label>         
<label class="btn btn-primary active">
    <input type="text"  class="form-control"  id="fsl" name="fsl"  value="<?php echo $gi_data['gi']['fsl']; ?>" >
  </label></td>
  <td colspan="2" rowspan="2" align="center" style="background-color:#ddadaf; width:10% ; font-size:16px;"><b></td>

                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Postcure</td>
                      <td colspan="2" ><input type="text" name="postcure" id="postcure" class="form-control" value="<?php echo $gi_data['gi']['postcure']; ?>"> </td>  
                   </tr>
                   <tr>
                      <td align="center" style="background-color:#fada5e; width:10% ; font-size:16px;"><b>Toping</td>
                      <td colspan="2" ><input type="text" name="toping" id="toping" class="form-control" value="<?php echo $gi_data['gi']['toping']; ?>"> </td>  
                   </tr>   
                </table>
   <!-- Tooliing -->    <br /> <br/>          
            <table class="table table-border" id="prt_info_table">
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
                        <td><input type="text" name="mandrelwood" id="mandrelwood" class="form-control" value="<?php echo $gi_data['gi']['mandrelwood']; ?>" ></td>
                        <td><input type="text" name="mandrelstainless" id="mandrelstainless" class="form-control" value="<?php echo $gi_data['gi']['mandrelstainless']; ?>"></td>
                        <td><input type="text" name="mandrelalmunium" id="mandrelalmunium" class="form-control" value="<?php echo $gi_data['gi']['mandrelalmunium']; ?>"></td>
                        <td><input type="text" name="mandrelqty" id="mandrelqty" class="form-control" value="<?php echo $gi_data['gi']['mandrelqty']; ?>" ></td>
                        <td><input type="text" name="tollsgeji" id="tollsgeji" class="form-control" value="<?php echo $gi_data['gi']['tollsgeji']; ?>" ></td>
                        <td><input type="text" name="tollsjig" id="tollsjig" class="form-control" value="<?php echo $gi_data['gi']['tollsjig']; ?>"></td>
                        <td><input type="text" name="tollscek" id="tollscek" class="form-control" value="<?php echo $gi_data['gi']['tollscek']; ?>"></td>
                       
                     </tr>
                   </tbody>
                </table>


<!-- Tooliing -->    <br /> <br/>          

<br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                    <td align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>Revisi</td>
                      <td align="center" style="background-color:#fada5e; width:35% ; font-size:16px;"><b>Description</td>
                      <td align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>Date</td>
                      <td align="center" style="background-color:#fada5e; width:20% ; font-size:16px;"><b>PIC</td>   <!--   <th style="width:20%">Keterangan</th>-->
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <?php if(isset($gi_data['historypart'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($gi_data['historypart'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                        <td><input type="text" name="revisi[]" id="revisi_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['revisi'] ?>"></td>
                        <td><input type="text" name="des[]" id="des_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['des'] ?>"></td>
                        <td><input type="text" name="date[]" id="date_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['date'] ?>" ></td>
                        <td><input type="text" name="pic[]" id="pic_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['pic'] ?>"></td>
                         <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                     <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>

                <br /> <br/>









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
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainGiNav").addClass('active');
    $("#addGiNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/spps/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   
                    '<td><input type="text" name="revisi[]" id="revisi_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="des[]" id="des_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="date[]" id="date_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="pic[]" id="pic_'+row_id+'" class="form-control"></td>'+
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

  }); // /document

  
  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>