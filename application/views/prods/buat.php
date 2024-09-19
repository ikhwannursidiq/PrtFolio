

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Prod Inspection Standard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">P.I.S</li>
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


        <div class="box">
          <div class="box-header">
           
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

<table class="table table-bordered" id="sa_info_table">
  <th align="center" style="background-color:#52bbef;  width:20% font-size:30px;" colspan="10" > Production Inspection Standard </th>

        <div class="col-md-4 col-xs-12 pull pull-left"> 
     
          <table class="table table-bordered" id="sa_info_table">
            
<br><br>
             <div class="col-md-4 col-xs-12 pull pull-left"> 
                <div class="form-group">
                  <label for="sku">Part No</label>
                  <input type="text" class="form-control" id="nopart" name="nopart" placeholder="Enter No Part" autocomplete="off" />
                </div>
              
                <div class="form-group">
                  <label for="product_name">Part Name</label>
                  <input type="text" class="form-control" id="namepart" name="namepart" placeholder="Enter product name" autocomplete="off"/>
                </div>
             
                <div class="form-group">
                  <label for="price">Material</label>
                  <input type="text" class="form-control" id="material" name="material" placeholder="Enter mix" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">TIPE</label>
                  <input type="text" class="form-control" id="material" name="tipe" placeholder="tipe" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="price">Customer Name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter price" autocomplete="off" />
                </div>
              
              </div>
              <div class="col-md-4 col-xs-12 ">
              <div class="form-group">
                  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

        </div>

              </div>

              </tr>
   </tbody>
</table>

              <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                    <td align="center"; style="background-color:#f8a649;  width:20% font-size:24px;">ITEM PERIKSA </td>
                      <td align="center"; style="background-color:#f8a649; width:20% font-size:24px;">STANDARD</td>
                      <td align="center"; style="background-color:#f8a649; width:20% font-size:24px;">FREKUENSI</td>
                      <td align="center"; style="background-color:#f8a649; width:20% font-size:24px;">METODE</td>
                     
                      <th style="background-color:#52bbef; width:5% font-size:24px;"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                     <td>
                        <input type="text" value="" name="product[]" id="product_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="standard[]" id="standard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="frekuensi[]" id="frekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="metode[]" id="metode_1" class="form-control" >
                    </td>
                        <!--  <input type="text" name="product[]" id="product_1" class="form-control"> 
                        
                          <select class="form-control select_group product" data-row-id="row_1" id="product[]" name="product_1" style="width:100%;">
                            <option value="Inner Diameter 1">Inner Diameter 1</option>
                            <option value="Outher Diameter 1">Outher Diameter 1</option>
							              <option value="Thickness 1">Thickness 1</option>
							              <option value="Inner Diameter 2">Inner Diameter 2</option>
                            <option value="Outher Diameter 2">Outher Diameter 2</option>
                            <option value="Thickness 2">Thickness 2</option>
                            <option value="Lenght">Lenght</option>
                            <option value="Marking Part Number">Marking Part Number</option>   
                            <option value="Marking No Lot">Marking No Lot</option>   
                            <option value="Hardness">Hardness</option>   
                            <option value="Apperance hose">Apperance hose</option>   
                          </select>
                       
                        </td>
                        <td><input type="text" name="standard[]" id="standard_1" class="form-control"></td>
                        <td><input type="text" name="metode[]" id="metode_1" class="form-control" ></td>
                        <td><input type="text" name="frekuensi[]" id="frekuensi_1" class="form-control" ></td>
                        
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td> -->
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>

                <table class="table table-bordered" id="titel_info_table">

                  <thead>
                <tr>
                      
        </tr> 
<table class="table table-bordered" id="satu_info_table">
  <thead>
    <tr>
  <th align="center" style="background-color:#52bbef;  width:20% font-size:30px;" colspan="10" >Physical properties of Rubber EPDM </th>
        </tr>             
    <tr>
      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Item Test</th>
      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
  
      <th style="background-color:#52bbef; width:5% font-size:24px;"><button type="button" id="satu_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
    </tr>
  </thead>

   <tbody>
   <td>
          <input type="text" value="" name="jsatu" id="jsatu" class="form-control" >
         </td>
     <tr id="row_1">
      
        <td>
          <input type="text" value="" name="satuitem[]" id="satuitem_1" class="form-control" >
         </td>
       <td><input type="text" name="satustandard[]" id="satustandard_1" class="form-control"  ></td>
        <td>
          <input type="text" name="satufrekuensi[]" id="satufrekuensi_1" class="form-control" >
        </td>
        <td>
          <input type="text" name="satumetode[]" id="satumetode_1" class="form-control" >
        </td>
        <td><button type="button" class="btn btn-default" onclick="removeSatu('1')"><i class="fa fa-close"></i></button></td>
     </tr>
   </tbody>
</table>

                <br /> <br/>

                <table class="table table-bordered" id="dua_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="dua_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>



                   <tbody>
                   <td>
                        <input type="text" value="" name="jdua" id="jdua" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="duaitem[]" id="duaitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="duastandard[]" id="duastandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="duafrekuensi[]" id="duafrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="duametode[]" id="duametode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeDua('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <table class="table table-bordered" id="tiga_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="tiga_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jtiga" id="jtiga" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="tigaitem[]" id="tigaitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="tigastandard[]" id="tigastandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="tigafrekuensi[]" id="tigafrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="tigametode[]" id="tigametode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeTiga('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <table class="table table-bordered" id="empat_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="empat_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jempat" id="jempat" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="empatitem[]" id="empatitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="empatstandard[]" id="empatstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="empatfrekuensi[]" id="empatfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="empatmetode[]" id="empatmetode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeEmpat('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <table class="table table-bordered" id="lima_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="lima_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jlima" id="jlima" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="limaitem[]" id="limaitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="limastandard[]" id="limastandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="limafrekuensi[]" id="limafrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="limametode[]" id="limametode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeLima('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <table class="table table-bordered" id="enam_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="enam_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jenam" id="jenam" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="enamitem[]" id="enamitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="enamstandard[]" id="enamstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="enamfrekuensi[]" id="enamfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="enammetode[]" id="enammetode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeEnam('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>


               

                <table class="table table-bordered" id="tujuh_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="tujuh_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jtujuh" id="jtujuh" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="tujuhitem[]" id="tujuhitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="tujuhstandard[]" id="tujuhstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="tujuhfrekuensi[]" id="tujuhfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="tujuhmetode[]" id="tujuhmetode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeTujuh('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>


                <table class="table table-bordered" id="delapan_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="delapan_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jdelapan" id="jdelapan" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="delapanitem[]" id="delapanitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="delapanstandard[]" id="delapanstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="delapanfrekuensi[]" id="delapanfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="delapanmetode[]" id="delapanmetode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeDelapan('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>


                <table class="table table-bordered" id="sembilan_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="sembilan_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jsembilan" id="jsembilan" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="sembilanitem[]" id="sembilanitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="sembilanstandard[]" id="sembilanstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="sembilanfrekuensi[]" id="sembilanfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="sembilanmetode[]" id="sembilanmetode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeSembilan('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>


                <table class="table table-bordered" id="sepuluh_info_table">
                  <thead>
                    <tr>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Judul Phisycal properties</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Standard</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Frekuensi</th>
                      <th  style="background-color:#f8a649;  width:20% font-size:24px;">Metode</th>
                  
                      <th style="background-color:#52bbef; width:5% font-size:24px;" ><button type="button" id="enam_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                   <td>
                        <input type="text" value="" name="jsepuluh" id="jsepuluh" class="form-control" >
                    </td>
                     <tr id="row_1">
                      
                     <td>
                        <input type="text" value="" name="sepuluhitem[]" id="sepuluhitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="sepuluhstandard[]" id="sepuluhstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="sepuluhfrekuensi[]" id="sepuluhfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="sepuluhmetode[]" id="sepuluhmetode_1" class="form-control" >
                    </td>
                        <td><button type="button" class="btn btn-default" onclick="removeSepuluh('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>





























                <br /> <br/>

                <table class="table table-bordered" id="qc_info_table">
                  <thead>
                  <tr>
                      <th style="background-color:#52bbef; width:5% font-size:24px;" colspan="10">Quality Hose / Test Product </th>
                 
                   
                    </tr>
                    <tr>
                      <td align="center"; style="background-color:#f8a649;  width:20% font-size:24px;">ITEM PERIKSA </td>
                      <td align="center"; style="background-color:#f8a649; width:20% font-size:24px;">STANDARD</td>
                      <td align="center"; style="background-color:#f8a649; width:20% font-size:24px;">FREKUENSI</td>
                      <td align="center"; style="background-color:#f8a649; width:20% font-size:24px;">METODE</td>
                     
                      <th align="center"; style="background-color:#52bbef; width:5% font-size:24px;"><button type="button" id="qc_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                     <td>
                        <input type="text" value="" name="qcitem[]" id="qcitem_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="qcstandard[]" id="qcstandard_1" class="form-control"  ></td>
                    <td>
                        <input type="text" name="qcfrekuensi[]" id="qcfrekuensi_1" class="form-control" >
                    </td>
                    <td>
                        <input type="text" name="qcmetode[]" id="qcmetode_1" class="form-control" >
                    </td>
                        <!--  <input type="text" name="product[]" id="product_1" class="form-control"> 
                        
                          <select class="form-control select_group product" data-row-id="row_1" id="product[]" name="product_1" style="width:100%;">
                            <option value="Inner Diameter 1">Inner Diameter 1</option>
                            <option value="Outher Diameter 1">Outher Diameter 1</option>
							              <option value="Thickness 1">Thickness 1</option>
							              <option value="Inner Diameter 2">Inner Diameter 2</option>
                            <option value="Outher Diameter 2">Outher Diameter 2</option>
                            <option value="Thickness 2">Thickness 2</option>
                            <option value="Lenght">Lenght</option>
                            <option value="Marking Part Number">Marking Part Number</option>   
                            <option value="Marking No Lot">Marking No Lot</option>   
                            <option value="Hardness">Hardness</option>   
                            <option value="Apperance hose">Apperance hose</option>   
                          </select>
                       
                        </td>
                        <td><input type="text" name="standard[]" id="standard_1" class="form-control"></td>
                        <td><input type="text" name="metode[]" id="metode_1" class="form-control" ></td>
                        <td><input type="text" name="frekuensi[]" id="frekuensi_1" class="form-control" ></td>
                        
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td> -->
                     </tr>
                   </tbody>
                </table>











                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
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
  $(document).ready(function() {
    $(".select_group").select2();
  //  $("#description").wysihtml5();

    $("#mainProdNav").addClass('active');
    $("#addProdNav").addClass('active');
      // Add new row in the table 
     
  

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


    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   
                //    '<td>'+ 
                //    '<select class="form-control select_group product" data-row-id="row_'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+                       
                //        '<option value="Inner Diameter 1">Inner Diameter 1</option>'+
                //        '<option value="Outher Diameter 1">Outher Diameter 1</option>'+
                //        '<option value="Thickness 1">Thickness 1</option>'+
                //        '<option value="Inner Diameter 2">Inner Diameter 2</option>'+
                //        ' <option value="Outher Diameter 2">Outher Diameter 2</option>'+
                //        '<option value="Thickness 2">Thickness 2</option>'+
                //        '<option value="Lenght">Lenght</option>'+
                //        '<option value="Marking Part Number">Marking Part Number</option>'+
                //        '<option value="Marking No Lot">Marking No Lot</option>'+
                //        '<option value="Hardness">Hardness</option>'+
                //        '<option value="Apperance hose">Apperance hose</option>'
                        
                //      html += '</select>'+
                 //   '</td>'+    
                 '<td><input type="text"  name="product[]" id="product_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="standard[]" id="standard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="frekuensi[]" id="frekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="metode[]" id="metode_'+row_id+'" class="form-control" ></td>'+
                   
                  
                    '<td> <button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
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


    $("#satu_row").unbind('click').bind('click', function() {
      var table = $("#satu_info_table");
      var count_table_tbody_tr = $("#satu_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                  '<td><input type="text"  name="satuitem[]" id="satuitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="satustandard[]" id="satustandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="satufrekuensi[]" id="satufrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="satumetode[]" id="satumetode_'+row_id+'" class="form-control" ></td>'+
                   
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowSatu(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#satu_info_table tbody tr:last").after(html);  
              }
              else {
                $("#satu_info_table tbody").html(html);
              }

              $(".satuitem").select2();

          }
        });

      return false;
    });





    $("#dua_row").unbind('click').bind('click', function() {
      var table = $("#dua_info_table");
      var count_table_tbody_tr = $("#dua_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                    '<td><input type="text"  name="duaitem[]" id="duaitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="duastandard[]" id="duastandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="duafrekuensi[]" id="duafrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="duametode[]" id="duametode_'+row_id+'" class="form-control" ></td>'+
                            
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowDua(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#dua_info_table tbody tr:last").after(html);  
              }
              else {
                $("#dua_info_table tbody").html(html);
              }

              $(".duaitem").select2();

          }
        });

      return false;
    });

    $("#tiga_row").unbind('click').bind('click', function() {
      var table = $("#tiga_info_table");
      var count_table_tbody_tr = $("#tiga_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                    '<td><input type="text"  name="tigaitem[]" id="tigaitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="tigastandard[]" id="tigastandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="tigafrekuensi[]" id="tigafrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="tigametode[]" id="tigametode_'+row_id+'" class="form-control" ></td>'+
                            
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowTiga(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#tiga_info_table tbody tr:last").after(html);  
              }
              else {
                $("#tiga_info_table tbody").html(html);
              }

              $(".tigaitem").select2();

          }
        });

      return false;
    });

    $("#empat_row").unbind('click').bind('click', function() {
      var table = $("#empat_info_table");
      var count_table_tbody_tr = $("#empat_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                    '<td><input type="text"  name="empatitem[]" id="empatitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="empatstandard[]" id="empatstandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="empatfrekuensi[]" id="empatfrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="empatmetode[]" id="empatmetode_'+row_id+'" class="form-control" ></td>'+
                            
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowEmpat(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#empat_info_table tbody tr:last").after(html);  
              }
              else {
                $("#empat_info_table tbody").html(html);
              }

              $(".empatitem").select2();

          }
        });

      return false;
    });

    $("#lima_row").unbind('click').bind('click', function() {
      var table = $("#lima_info_table");
      var count_table_tbody_tr = $("#lima_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                    '<td><input type="text" name="limaitem[]" id="limaitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="limastandard[]" id="limastandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="limafrekuensi[]" id="limafrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="limametode[]" id="limametode_'+row_id+'" class="form-control" ></td>'+
                            
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowLima(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#lima_info_table tbody tr:last").after(html);  
              }
              else {
                $("#lima_info_table tbody").html(html);
              }

              $(".limaitem").select2();

          }
        });

      return false;
    });

    $("#enam_row").unbind('click').bind('click', function() {
      var table = $("#enam_info_table");
      var count_table_tbody_tr = $("#enam_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                    '<td><input type="text"  name="enamitem[]" id="enamitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="enamstandard[]" id="enamstandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="enamfrekuensi[]" id="enamfrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="enammetode[]" id="enammetode_'+row_id+'" class="form-control" ></td>'+
                            
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowEnam(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#enam_info_table tbody tr:last").after(html);  
              }
              else {
                $("#enam_info_table tbody").html(html);
              }

              $(".enamitem").select2();

          }
        });

      return false;
    });


















 // end physical add   

    $("#qc_row").unbind('click').bind('click', function() {
      var table = $("#qc_info_table");
      var count_table_tbody_tr = $("#qc_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/rfqs/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
            
                  '<td><input type="text" name="qcitem[]" id="qcitem_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="qcstandard[]" id="qcstandard_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="qcfrekuensi[]" id="qcfrekuensi_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="qcmetode[]" id="qcmetode_'+row_id+'" class="form-control" ></td>'+
                   
                  
                    '<td><button type="button" class="btn btn-default" onclick="removeRowQc(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#qc_info_table tbody tr:last").after(html);  
              }
              else {
                $("#qc_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });


  });

 
  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function removeRowInc(tr_id)
  {
    $("#phy_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function removeRowCs(tr_id)
  {
    $("#cs_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }



  function removeRowQc(tr_id)
  {
    $("#qc_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function removeRowSatu(tr_id)
  {
    $("#satu_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }


  function removeRowDua(tr_id)
  {
    $("#dua_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }


 



</script>