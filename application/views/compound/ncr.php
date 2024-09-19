
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
   
}

.styled-table thead tr {
    background-color:#2196F3;
    color: #ffffff;
    text-align: center;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
    text-align: center;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

.col1 {display: none; }
.col2 {display: none; }
.col3 {display: none; }


.block {
  display: block;
 
  border: none;
  background-color: #2196F3;
  color: white;
 
  font-size: 46px;
  cursor: pointer;
  text-align: center;



  border-radius: 25px;

  background-position: left top;
  background-repeat: repeat;
  padding: 20px;
  width: 200px;
  height: 150px;
 
}

.block:hover {
  background-color: #ddd;
  color: black;
}




.custom-select {
  position: relative;
  font-family: calibri;
  background-color: orange;
  text-align: center;
  width: 80px;
  height: 50px;
  font-size: 16px;
  border-radius: 15px;
}





.item1 { grid-area: 1 / 1 / 1 / 1; }
.item2 { grid-area: 1 / 2 / 2 / 7; }
.item3 { grid-area: 1 / 3 / 2 / 6; }


.item4 { 
    grid-area: 2 / 1 / 2 / 1; 
    height:300px;

}
.item5 { grid-area: 2 / 2 / 3 / 7; 
    text-align: left;
   
}
.item6 { grid-area: 2 / 7 / 2 / 7; }
.item8 { grid-area: 2 / 8 / 3 / 8; }
.item9 { grid-area: 1 / 7 / 2 / 9;
    background-color: rgba(42, 53, 106, 0.95);
}

.grid-container {
  display: grid;
  grid-auto-columns: 148px;
  grid-gap: 2px;
  background-color: white;
  padding: 10px;
}

.grid-container > div {
    background-color: rgba(0, 84, 232, 0.67);
 border-radius:10px;
  padding: 10px 10px;
  font-size: 10px;

}


.grid-header {
  display: grid;
  grid-auto-columns: 148px;
  grid-gap: 10px;
  background-color: #2196F3;
  padding: 5px;
  border-radius: 5px;
}

.grid-header > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 5px 5px;
  font-size: 10px;
  border-radius: 5px;

}

.hd1 { grid-area: 1 / 1 / 2 / 3; }
.hd2 { grid-area: 1 / 3 / 2 / 7; }
.hd3 { grid-area: 1 / 7 / 2 / 8; 
 border-radius: 5px;
}


.hd4 { 
    grid-area: 2 / 1 / 3 / 3; 
   

}
.hd5 { grid-area: 2 / 3 / 3 / 5; }
.hd6 { grid-area: 2 / 5 / 3 / 7; }
.hd7 { grid-area: 2 / 7 / 3 / 8; }
.hd10 { grid-area: 2 / 8 / 2 / 9; }



.grid-footer {
  display: grid;
  grid-auto-columns: 148px;
  grid-gap: 10px;
  background-color: #2196F3;
  padding: 10px;
}

.grid-footer > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 20px 0;
  font-size: 30px;

}

.ft1 { grid-area: 1 / 1 / 2 / 4; }

.ft2 { grid-area: 1 / 4 / 3 / 6; }
.ft7 { grid-area: 1 / 6 / 3 / 7; }

.ft3 { grid-area: 1 / 7 / 2 / 8; 
 border-radius: 5px;
}


.ft4 { grid-area: 2 / 1 / 2 / 3; }
.ft5 { grid-area: 2 / 3 / 3 / 3; }




.ft6 { grid-area: 1 / 7 / 2 / 8; }

.ft9 { grid-area: 2 / 7 / 3 / 8; }
.ft10 { grid-area: 2 / 8 / 2 / 9; }





</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>NCR</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">ncr</li>
    </ol>
  </section>
  <div class="box">
          
          <!-- /.box-header -->
  <form role="form" action="<?php base_url('compound/createncr') ?>" method="post" enctype="multipart/form-data">
            <div class="grid-header">
                <div class="hd1">
                <table >
                  <thead>
                    <tr>
                      <th style="width:5%">DEPT</th>
                      <th style="width:5%">SUPPLIER</th>
                      <th style="width:5%">CUSTOMER</th>
                    </tr>

                    <tr>
                      <th style="width:5%"> 
                      <input type="text" name="dept" id="dept" class="form-control" autocomplete="off">
                       
                      </th>
                      <th style="width:5%">
                      <input type="text" name="sup" id="sup" class="form-control" autocomplete="off">  
                  
                      </th>
                      <th style="width:5%">
                      <input type="text" name="cus" id="cus" class="form-control" autocomplete="off">  
                   
                     </th>
                    </tr>

                </table>
                
                </div>
                <div class="hd2">
                    <table>
                        <tr>
                    <th style="width:5%">NO. SURAT JALAN</th>
                      <th style="width:5%"><input type="text" name="nosj" id="nosj" value="<?php echo $compound_data['nosj']; ?>" class="form-control" autocomplete="off"></th>       
                      <th style="width:5%">NO. LOT</th>
                      <th style="width:5%"><input type="text" name="nolot" id="nolot" class="form-control" autocomplete="off" value="<?php echo $compound_data['nolot']; ?>"></th>       
</tr>
<tr>
                      <th style="width:5%">TGL KIRIM</th>
                        <td>
                          <input type="date" name="tglkirim" id="tglkirim" class="form-control" autocomplete="off">  
                        </td>

                        <th  style="width:5%">TGL PRODUKSI</th>
                        <td > 
                          <input type="date" name="tglprod" id="tglprod" class="form-control" autocomplete="off">  
                        </td>
</tr>



                    </table>



                </div>

                <div class="hd3">

<table>
                <th style="width:5%">JUMLAH RETURN</th>
                      <th style="width:5%"><input type="text" name="jmlreturn" id="jmlreturn" class="form-control" autocomplete="off"></th>       
</table>
                </div>  
                <div class="hd4">
                <table >
                  <thead>
                    <tr>
                    <th style="width:20%">PART NO</th>
                    <td>
                          <input type="text" name="partno" id="partno" class="form-control" autocomplete="off"> 
                    </tr>
                    <tr>
                    <th style="width:20%">NAMA PRODUK</th>
                    <td>
                          <input type="text" name="partname" id="partname" class="form-control" autocomplete="off">  
                    </tr>
                    <tr>
                    <th style="width:20%">TIPE</th>
                    <td>
                          <input type="text" name="tipe" id="tipe" class="form-control" autocomplete="off">  
                    </tr>
                    <tr>
                    <th style="width:20%"> </th>
                      <td>
                      </tr>
                  </thead>
                </table>



                </div>
                <div class="hd5">
                <div><LABEL>URAIAN MASALAH / NG</LABEL>
                <textarea type="text" name="uraianmasalah" id="uraianmasalah" class="form-control" autocomplete="off"> </textarea>


                </div>


                </div>
               
              
                <div class="hd8">
                <div>
               
                </div>




                </div>
                <div class="hd6">
                <div> <table >
                  <thead>
                    <tr>
                    <th style="width:20%">Tanggal di temukan NG</th>
                    <td>
                    <input type="date" name="tglditemukanng" id="tglditemukanng" class="form-control" autocomplete="off">
                    </tr>
                    <tr>
                    <th style="width:20%">Tanggal diterima</th>
                    <td>
                    <input type="date" name="tglditerima" id="tglditerima" class="form-control" autocomplete="off">  
            
                    </tr>
                    <tr>
                    <th style="width:20%">Tempat di temukan NG</th>
                    <td>
                    <input type="text" name="tmptng" id="tmptng" class="form-control" autocomplete="off">  
              
                    </tr>
                    <tr>
                    <th style="width:20%"> </th>
                      <td>
                      </tr>
                  </thead>
                </table>

                   </div>

                </div>
                <div class="hd7">

                <th style="width:10%">JUMLAH NG</th>
                      <th style="width:10%"><input type="text" name="jmlng" id="jmlng" class="form-control" autocomplete="off"></th>       
                   
                </div>
                <div class="hd10"> <th style="width:10%">PROSENTASE NG</th>
                      <th style="width:10%"><input type="text" name="prosentaseng" id="prosentaseng" class="form-control" autocomplete="off"></th>       
                   </div>
              
              
            </div>
          
            <div class="grid-container">
                <div class="item1">  <label for="product_image">1. DETAIL PROBLEM</label></div>
                <div class="item2"> <label>2. PROBLEM ANALYSIS </label></div>
                
                <div class="item4">


                <div class="form-group">
                    <label for="product_image">(sketch)</label>
                        <div class="kv-avatar">
                        <div class="file-loading">
                            <input name="product_image" id="product_image" type="file">
                        </div>
                        </div>
                </div>
                </div>
                <div class="item5">
                   
                    <div> 
                    <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                    <td><label for="telp">WHY 1</label> </td>
                        <td colspan="4">
                            <input type="text" name="pawhy" id="pawhy" class="form-control" autocomplete="off">  
                        </td>
                    </tr>
                  
                  
                  
                  <tr>

                      <th style="width:12%"></th>
                      <th style="width:15%">MAN</th>
                      <th style="width:15%">MACHINE</th> 
                      <th style="width:15%">METHODE</th>
                      <th style="width:15%">MATERIAL</th> 
                    </tr>
                    <tr>
                       <td><label for="telp">WHY 2</label> </td>
                        <td>
                          <input type="text" name="whaman" id="whaman" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whamachine" id="whamachine" class="form-control" autocomplete="off">  
                        </td>

                        <td>
                          <input type="text" name="whamethode" id="whamethode" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whamaterial" id="whamaterial" class="form-control" autocomplete="off">  
                        </td>
                    </tr>

                    <tr>
                       <td><label for="telp">WHY 3</label> </td>
                       <td>
                          <input type="text" name="whbman" id="whbman" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whbmachine" id="whbmachine" class="form-control" autocomplete="off">  
                        </td>

                        <td>
                          <input type="text" name="whbmethode" id="whbmethode" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whbmaterial" id="whbmaterial" class="form-control" autocomplete="off">  
                        </td>
                    </tr>

                    <tr>
                       <td><label for="telp">WHY 4</label> </td>
                       <td>
                          <input type="text" name="whcman" id="whcman" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whcmachine" id="whcmachine" class="form-control" autocomplete="off">  
                        </td>

                        <td>
                          <input type="text" name="whcmethode" id="whcmethode" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whcmaterial" id="whcmaterial" class="form-control" autocomplete="off">  
                        </td>
                    </tr>

                    <tr>
                       <td><label for="telp">WHY 5</label> </td>
                       <td>
                          <input type="text" name="whdman" id="whdman" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whdmachine" id="whdmachine" class="form-control" autocomplete="off">  
                        </td>

                        <td>
                          <input type="text" name="whdmethode" id="whdmethode" class="form-control" autocomplete="off">  
                        </td>
                        <td>
                          <input type="text" name="whdmaterial" id="whdmaterial" class="form-control" autocomplete="off">  
                        </td>
                    </tr>
                  </thead>
                </table>







                    </div>
                </div>
                <div class="item6"><div > <div class="form-group">
                    <label for="product_image">BEFORE IMPROVEMENT</label>
                        <div class="kv-avatar">
                        <div class="file-loading">
                            <input id="fpbi" name="fpbi" type="file">
                        </div>
                        </div>
                </div> </div></div>
              
                <div class="item8"> <div class="form-group">
                    <label for="product_image">AFTER IMPROVEMENT</label>
                        <div class="kv-avatar">
                        <div class="file-loading">
                            <input id="fpai" name="fpai" type="file">
                        </div>
                        </div>
                </div></div>



                <div class="item9"><label>6. FLOW PROSES</label></div>
                
              
              
            </div>

            <div class="">
            <!--    <div class="ft1"><textarea id="w3review" name="w3review" rows="3" cols="30"> </textarea></div>
                <div class="ft2"><textarea id="w3review" name="w3review" rows="7" cols="15"> </textarea></div>
                <div class="ft3">3</div>  
                <div class="ft4">4</div>
                <div class="ft5">5</div>
                <div class="ft6">6</div>
                <div class="ft7">7</div>
                <div class="ft8">8</div>
                <div class="ft9">9</div>
                <div class="ft10">10</div>-->


                <table class="styled-table">
                  <thead>
                    <tr>
                      <th style="width:20%">3. PENYEBAB UTAMA</th>
					            
                    </tr>
                  </thead>


                   <tbody>
                     <tr id="row_1">
                      
						            <td>
                          <input type="text" name="penyebabutama" id="penyebabutama" class="form-control"  autocomplete="off">
                       
                        </td>
						
						
                     </tr>
                   </tbody>
                </table>

                <table class="styled-table">
                  <thead>
                    <tr>
                      <th style="width:50%">4. TINDAKAN SEMENTARA</th>
                      <th style="width:20%">TANGGAL</th>
					            
                    </tr>
                  </thead>


                   <tbody>
                     <tr id="row_1">
                      
						            <td>
                          <input type="text" name="tinsemsatu" id="tinsemsatu" class="form-control"  autocomplete="off">
                       
                        </td>
                        <td>
                          <input type="date" name="tinsemsatutgl" id="tinsemsatutgl" class="form-control"  autocomplete="off">
                       
                        </td>
						
						
                     </tr>
                     <tr id="row_1">
                      
                      <td>
                        <input type="text" name="tinsemdua" id="tinsemdua" class="form-control"  autocomplete="off">
                     
                      </td>
                      <td>
                        <input type="date" name="tinsemduatgl" id="tinsemduatgl" class="form-control"  autocomplete="off">
                     
                      </td>
          
          
                   </tr>
                   <tr id="row_1">
                      
                      <td>
                        <input type="text" name="tinsemtiga" id="tinsemtiga" class="form-control"  autocomplete="off">
                     
                      </td>
                      <td>
                        <input type="date" name="tinsemtigatgl" id="tinsemtigatgl" class="form-control"  autocomplete="off">
                     
                      </td>
          
          
                   </tr>
                   </tbody>
                </table>

                <table class="styled-table">
                  <thead>
                    <tr>
                      <th style="width:50%">5. TINDAKAN KOREKSI</th>
                      <th style="width:20%">TANGGAL</th>
					            
                    </tr>
                  </thead>


                   <tbody>
                     <tr id="row_1">
                      
						            <td>
                          <input type="text" name="tinkorsatu" id="tinkorsatu" class="form-control"  autocomplete="off">
                       
                        </td>
                        <td>
                          <input type="date" name="tinkorsatutgl" id="tinkorsatutgl" class="form-control"  autocomplete="off">
                       
                        </td>
						
						
                     </tr>
                     <tr id="row_1">
                      
                      <td>
                        <input type="text" name="tinkordua" id="tinkordua" class="form-control"  autocomplete="off">
                     
                      </td>
                      <td>
                        <input type="date" name="tinkorduatgl" id="tinkorduatgl" class="form-control"  autocomplete="off">
                     
                      </td>
          
          
                   </tr>
                   <tr id="row_1">
                      
                      <td>
                        <input type="text" name="tinkortiga" id="tinkortiga" class="form-control"  autocomplete="off">
                     
                      </td>
                      <td>
                        <input type="date" name="tinkortigatgl" id="tinkortigatgl" class="form-control"  autocomplete="off">
                     
                      </td>
          
          
                   </tr>
                   </tbody>
                </table>



                <table class="styled-table">
                  <thead>
                    <tr>
                      <th style="width:50%">NOTE:</th>
                      <th style="width:20%">PENGIRIMAN SETELAH IMPROVEMENT</th>
					            
                    </tr>
                  </thead>
                   <tbody>
                     <tr id="row_1">
						            <td>
                          <input type="text" name="note" id="note" class="form-control"  autocomplete="off">
                        </td>
                        <td><LABEL>TANGGAL :</LABEL>
                          <input type="text" name="tglpsi" id="tglpsi" class="form-control"  autocomplete="off">
                        </td>
                   </tr>
                   <tr id="row_1">
                      
                      <td>
                    
                     
                      </td>
                      <td><LABEL>NO LOT :</LABEL>
                        <input type="text" name="nolotpsi" id="nolotpsi" class="form-control"  autocomplete="off">
                     
                      </td>
          
          
                   </tr>
                   </tbody>
                </table>
                <table class="styled-table">
                  <thead>
                    <tr>
                      <th style="width:10%">EXALUASI 1</th>
					            <th style="width:10%">DEPARTMENT</th>
                      <th style="width:10%">TANGGAL</th>
                      <th style="width:10%">DISIAPKAN</th>
                      <th style="width:10%">DIPERIKSA</th>
                      <th style="width:8%">DIKETAHUI</th>
                      </tr>
                     
                  </thead>


                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="evasatu" name="evasatu" style="width:100%;" onchange="getProductData(1)" required>
                            <option value="1">SELESAI</option>
                            <option value="2">BELUM SELESAI</option>
                          </select>
                        </td>
						            <td>
                          <input type="text" name="evadeptsatu" id="evadeptsatu" class="form-control"  autocomplete="off">
                        </td>
                        <td>
                          <input type="date" name="tglevasatu" id="tglevasatu" class="form-control"  autocomplete="off">
                        </td>

                        <td>
                          <input type="text" name="disiapkansatu" id="disiapkansatu" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="diperiksasatu" id="diperiksasatu" class="form-control"  autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="diketahuisatu" id="diketahuisatu" class="form-control"  autocomplete="off">
                        </td>

						          </tr>
                      <tr>
                      <th colspan="6" style="width:10%">Hasil Evaluasi 1</th>
					          
                    </tr>
                      <tr>
                      <td  colspan="6">
                          <input type="text" name="hasilevasatu" id="hasilevasatu" class="form-control" autocomplete="off">
                        </td>
                  </tr>
                   </tbody>
                </table>


                <table class="styled-table">
                  <thead>
                    <tr>
                      <th style="width:10%">EXALUASI 2</th>
					            <th style="width:10%">DEPARTMENT</th>
                      <th style="width:10%">TANGGAL</th>
                      <th style="width:10%">DISIAPKAN</th>
                      <th style="width:10%">DIPERIKSA</th>
                      <th style="width:8%">DIKETAHUI</th>
                      </tr>
                     
                  </thead>


                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="evadua" name="evadua" style="width:100%;" onchange="getProductData(1)" required>
                            <option value="1">SELESAI</option>
                            <option value="2">BELUM SELESAI</option>
                          </select>
                        </td>
						            <td>
                          <input type="text" name="evadeptdua" id="evadeptdua" class="form-control"  autocomplete="off">
                        </td>
                        <td>
                          <input type="date" name="tglevadua" id="tglevadua" class="form-control"  autocomplete="off">
                        </td>

                        <td>
                          <input type="text" name="disiapkandua" id="disiapkandua" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="diperiksadua" id="diperiksadua" class="form-control"  autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="diketahuidua" id="diketahuidua" class="form-control"  autocomplete="off">
                        </td>

						          </tr>
                      <tr>
                      <th colspan="6" style="width:10%">Hasil Evaluasi 2</th>
					          
                    </tr>
                      <tr>
                      <td  colspan="6">
                          <input type="text" name="hasilevadua" id="hasilevadua" class="form-control" autocomplete="off">
                        </td>
                  </tr>
                   </tbody>
                </table>





              
            </div>



             
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
              </div>
   </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    </div> 

  </section>
  <!-- /.content -->
</div><script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
  //  $("#description").wysihtml5();

    $("#mainItemNav").addClass('active');
    $("#addItemNav").addClass('active');
    
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


    $("#fpai").fileinput({
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

    $("#fpbi").fileinput({
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
</script>