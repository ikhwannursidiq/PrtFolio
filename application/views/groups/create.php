

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Groups</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
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
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Report Gudang</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroupping" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroupping" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroupping" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroupping" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Brands</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBrand" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>Suppliers</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSuppler" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSupplier" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>Filter</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createFilter" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateFilter" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewFilter" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteFilter" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Customers</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCustomers" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCustomers" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCustomers" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCustomers" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Customer</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCustomer" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Supplier</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSupplier" class="minimal"></td>
                      </tr>
					  <!--Menu proses ENG Start-->				  
					   <tr>
                        <td>General Information Part</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGi" class="minimal"></td>
                      </tr>
					    <tr>
                        <td>Joken</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createJoken" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateJoken" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewJoken" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteJoken" class="minimal"></td>
                      </tr>
					  
					  
                      <tr>
                        <td>Trial Record</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createTrial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateTrial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewTrial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteTrial" class="minimal"></td>
                      </tr>

<!--Menu proses ENG Finish-->	
<tr>
                        <td>FORM SPI & WIP QC</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWip" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWip" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWip" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWip" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Form Cutting</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCutting" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCutting" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCutting" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCutting" class="minimal"></td>
                      </tr> 
                      <tr>
                        <td>Input Data Compound</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCompound" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompound" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCompound" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCompound" class="minimal"></td>
                      </tr> 
                      <tr>
                        <td>Input Data Sub Material</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSubmaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSubmaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSubmaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSubmaterial" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Part Return </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBalikan" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBalikan" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBalikan" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBalikan" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Category</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Stores</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStore" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Attributes</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAttribute" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>PIS STANDARD</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProd" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProd" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProd" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProd" class="minimal"></td>
                      </tr>
					   <tr>
                        <td>IRD</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createIrds" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateIrds" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewIrds" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteIrds" class="minimal"></td>
                      </tr>
					  
					   <tr>


                        <td>Date Range</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDaterange" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDaterange" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDaterange" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDaterange" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Repair Submit</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createRepair" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateRepair" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRepair" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteRepair" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Summary Laporan QC</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSummary" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSummary" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSummary" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSummary" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Form Outgoing</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createFincoming" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateFincoming" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBaFincoming" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteFincoming" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Kedatangan Barang</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBarangmasuk" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBarangmasuk" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBarangmasuk" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBarangmasuk" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Material</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createMaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateMaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMaterial" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteMaterial" class="minimal"></td>
                      </tr>

                      <td>Operators</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOperator" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOperator" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOperator" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOperator" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Items</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createItem" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateItem" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewItem" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteItem" class="minimal"></td>
                      </tr>
					            <tr>
                        <td>Export</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createExport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateExport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewExport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteExport" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Inputs</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createInput" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateInput" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewInput" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteInput" class="minimal"></td>
                      </tr>
					
					            <tr>
                        <td>Input PIS</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createInputpi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateInputpi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewInputpi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteInputpi" class="minimal"></td>
                      </tr>

					
					            <tr>
                        <td>PIS</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPi" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePi" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Products</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduct" class="minimal"></td>
                      </tr>
					            <tr>
                        <td>Vroducts</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createVroduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateVroduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewVroduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteVroduct" class="minimal"></td>
                      </tr>
					            <tr>
                        <td>QC Reports</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createQcreport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateQcreport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewQcreport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteQcreport" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>QC Reports Gudang</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createQcreportGudang" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateQcreportGudang" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewQcreportGudang" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteQcreportGudang" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Orders</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrder" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Pocompound</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPocompound" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePocompound" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPocompound" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePocompound" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>PO UMUM</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPoumum" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePoumum" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPoumum" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePoumum" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>PO IMPORT</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPoimport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePoimport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPoimport" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePoimport" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>PO TOOLING</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPotooling" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePotooling" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPotooling" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePotooling" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>RFQ</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createRfqs" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateRfqs" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRfqs" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteRfqs" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Form Pengajuan Pekerjaan</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createFpps" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateFpps" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRFpps" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteFpps" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>SPS</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSps" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSps" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSps" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSps" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>SEleksi</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSsb" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSsb" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSsb" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSsb" class="minimal"></td>
                      </tr>

                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReports" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
  $(document).ready(function() {
    $("#mainGroupNav").addClass('active');
    $("#addGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>

