<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?>
          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <?php endif; ?>

              <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
            <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          <?php if(in_array('createCustomers', $user_permission) || in_array('updateCustomers', $user_permission) || in_array('viewCustomers', $user_permission) || in_array('deleteCustomers', $user_permission)): ?>
            <li id="customersNav">
              <a href="<?php echo base_url('customers/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Customers</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
            <li id="brandNav">
              <a href="<?php echo base_url('brands/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Brands</span>
              </a>
            </li>
          <?php endif; ?>
<!-- menu suppliers-->
		    <?php if(in_array('createSupplier', $user_permission) || in_array('updateSupplier', $user_permission) || in_array('viewSupplier', $user_permission) || in_array('deleteSupplier', $user_permission)): ?>
            <li id="supplierNav">
              <a href="<?php echo base_url('suppliers/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Suppliers</span>
              </a>
            </li>
          <?php endif; ?>
<!-- menu Qc reportss-->		  
  <?php if(in_array('createQcreport', $user_permission) || in_array('updateQcreport', $user_permission) || in_array('viewQcreport', $user_permission) || in_array('deleteQcreport', $user_permission)): ?>
            <li id="QcreportNav">
              <a href="<?php echo base_url('qcreports/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Qcreports</span>
              </a>
            </li>
          <?php endif; ?>		

<!-- menu Qc reportss gudang-->		  
<?php if(in_array('createQcreportGudang', $user_permission) || in_array('updateQcreportGudang', $user_permission) || in_array('viewQcreportGudang', $user_permission) || in_array('deleteQcreportGudang', $user_permission)): ?>
            <li id="QcreportNav">
              <a href="<?php echo base_url('qcreportsgudang/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Qcreports Gudang</span>
              </a>
            </li>
          <?php endif; ?>		
<!-- menu Qc reportss-->		  
<?php if(in_array('createGroupping', $user_permission) || in_array('updateGroupping', $user_permission) || in_array('viewGroupping', $user_permission) || in_array('deleteGroupping', $user_permission)): ?>
            <li id="GrouppingNav">
              <a href="<?php echo base_url('groupping/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Report Gudang</span>
              </a>
            </li>
          <?php endif; ?>		
         
<!-- Menu Balikan Part-->
<?php if(in_array('createBalikan', $user_permission) || in_array('updateBalikan', $user_permission) || in_array('viewBalikan', $user_permission) || in_array('deleteBalikan', $user_permission)): ?>
            <li class="treeview" id="mainBalikanNav">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Return Part</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createBalikan', $user_permission)): ?>
                  <li id="addBalikanNav"><a href="<?php echo base_url('balikan/create') ?>"><i class="	fa fa-pencil-square"></i> Add Return Part</a></li>
                <?php endif; ?>
                <?php if(in_array('updateBalikan', $user_permission) || in_array('viewBalikan', $user_permission) || in_array('deleteBalikan', $user_permission)): ?>
                <li id="manageBalikanNav"><a href="<?php echo base_url('balikan') ?>"><i class="fa fa-suitcase"></i> Manage Return Part</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>



		  
		  <!-- menu Qc reportss-->		  
  <?php if(in_array('createFilter', $user_permission) || in_array('updateFilter', $user_permission) || in_array('viewFilter', $user_permission) || in_array('deleteFilter', $user_permission)): ?>
            <li id="FilterNav">
              <a href="<?php echo base_url('filter/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Filter Range</span>
              </a>
            </li>
          <?php endif; ?>		
<!-- menu Pissssssssssssss-->  
          <?php if(in_array('createProd', $user_permission) || in_array('updateProd', $user_permission) || in_array('viewProd', $user_permission) || in_array('deleteProd', $user_permission)): ?>
            <li class="treeview" id="mainProdNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Production Inspection Standard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProd', $user_permission)): ?>
                  <li id="addProdNav"><a href="<?php echo base_url('prods/create') ?>"><i class="	fa fa-pencil-square"></i> Add Prod</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProd', $user_permission) || in_array('viewProd', $user_permission) || in_array('deleteProd', $user_permission)): ?>
                <li id="manageProdNav"><a href="<?php echo base_url('prods') ?>"><i class="fa fa-suitcase"></i> Manage PIS</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?> 


<!-- Menu IRD-->
<?php if(in_array('createIrds', $user_permission) || in_array('updateIrds', $user_permission) || in_array('viewIrds', $user_permission) || in_array('deleteIrds', $user_permission)): ?>
            <li class="treeview" id="mainIrdNav">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>IRD</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createIrds', $user_permission)): ?>
                  <li id="addIrdsNav"><a href="<?php echo base_url('irds/create') ?>"><i class="	fa fa-pencil-square"></i> Add IRD</a></li>
                <?php endif; ?>
                <?php if(in_array('updateIrds', $user_permission) || in_array('viewIrds', $user_permission) || in_array('deleteIrds', $user_permission)): ?>
                <li id="manageIrdsNav"><a href="<?php echo base_url('irds') ?>"><i class="fa fa-suitcase"></i> Manage IRD</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
		  
<!-- menu Qc reportss-->		  
        <?php if(in_array('createExport', $user_permission) || in_array('updateExport', $user_permission) || in_array('viewExport', $user_permission) || in_array('deleteExport', $user_permission)): ?>
            <li id="ExportNav">
              <a href="<?php echo base_url('exports/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Exports</span>
              </a>
            </li>
          <?php endif; ?>				  
        <?php if(in_array('createDaterange', $user_permission) || in_array('updateDaterange', $user_permission) || in_array('viewDaterange', $user_permission) || in_array('deleteDaterange', $user_permission)): ?>
            <li id="DaterangeNav">
              <a href="<?php echo base_url('daterange/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Date Range Filter</span>
              </a>
            </li>
          <?php endif; ?>	
          
          <!-- menu Qc reportss-->			  
       <?php if(in_array('createSummary', $user_permission) || in_array('updateSummary', $user_permission) || in_array('viewSummary', $user_permission) || in_array('deleteSummary', $user_permission)): ?>
            <li id="SummaryNav">
              <a href="<?php echo base_url('finalsummary/') ?>">
                <i class="glyphicon glyphicon-th-list"></i> <span>Final Summary Laporan QC</span>
              </a>
            </li>
          <?php endif; ?>		  
 <!-- menu Qc reportss-->			  
 <?php if(in_array('createSummary', $user_permission) || in_array('updateSummary', $user_permission) || in_array('viewSummary', $user_permission) || in_array('deleteSummary', $user_permission)): ?>
            <li id="SummaryNav">
              <a href="<?php echo base_url('summary/before') ?>">
                <i class="glyphicon glyphicon-th-list"></i> <span>Before Summary Laporan QC</span>
              </a>
            </li>
          <?php endif; ?>		
  




          
            <!-- menu catagory-->
        <?php if(in_array('createCompound', $user_permission) || in_array('updateCompound', $user_permission) || in_array('viewCompound', $user_permission) || in_array('deleteCompound', $user_permission)): ?>
            <li id="compoundNav">
              <a href="<?php echo base_url('compound/') ?>">
                <i class="fa fa-files-o"></i> <span>Input Data Compound</span>
              </a>
            </li>
        <?php endif; ?>


        <?php if(in_array('createSubmaterial', $user_permission) || in_array('updateSubmaterial', $user_permission) || in_array('viewSubmaterial', $user_permission) || in_array('deleteSubmaterial', $user_permission)): ?>
            <li id="submaterialNav">
              <a href="<?php echo base_url('submaterial/') ?>">
                <i class="fa fa-cubes"></i> <span>Input Data Submaterial</span>
              </a>
            </li>
  <?php endif; ?>



 <!-- Menu Incoming-->
 <?php if(in_array('createFincoming', $user_permission) || in_array('updateFincoming', $user_permission) || in_array('viewFincoming', $user_permission) || in_array('deleteFincoming', $user_permission)): ?>
            <li class="treeview" id="mainFincomingNav">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Form to Warehouse</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li id="addFincomingNav"><a href="<?php echo base_url('fincoming/create') ?>"><i class="fa fa-dot-circle-o"></i> Add Kiriman Ke gudang</a></li>
                  <li id="manageFincomingNav"><a href="<?php echo base_url('fincoming') ?>"><i class="fa fa-dot-circle-o"></i> Manage Report Outgoing</a></li>
                  <li id="manageFincomingNav"><a href="<?php echo base_url('stokqc') ?>"><i class="fa fa-dot-circle-o"></i>Stok QC OUT</a></li>    
                  <li id="manageFincomingNav"><a href="<?php echo base_url('fincoming/exportppic') ?>"><i class="fa fa-dot-circle-o"></i>Export to PPIC</a></li>
      
                </ul>
            </li>
<?php endif; ?>   

<!-- Menu wip-->
<?php if(in_array('createWip', $user_permission) || in_array('updateWip', $user_permission) || in_array('viewWip', $user_permission) || in_array('deleteWip', $user_permission)): ?>
            <li class="treeview" id="mainWipNav">
              <a href="#">
                <i class="fa fa-suitcase"></i>
                <span>Menu Stok WIP QC & SPI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu"> 
                  <li id="addWipNav"><a href="<?php echo base_url('wip/create') ?>"><i class="fa fa-dot-circle-o"></i> Input WIP hasil Cutting</a></li>
                  <li id="manageWipNav"><a href="<?php echo base_url('wip') ?>"><i class="fa fa-dot-circle-o"></i> Stok WIP Di QC</a></li>
                  <li id="manageWipNav"><a href="<?php echo base_url('wip/spi') ?>"><i class="fa fa-dot-circle-o"></i> Form Pembuatan SPI</a></li>
                  <li id="manageWipNav"><a href="<?php echo base_url('wip/editdelete') ?>"><i class="fa fa-dot-circle-o"></i> Form Edit / Print WIP</a></li>
                  <li id="manageWipNav"><a href="<?php echo base_url('wip/monwipspi') ?>"><i class="fa fa-dot-circle-o"></i> Monitoring Data Cutting & SPI </a></li>
                  <li id="manageSpiNav"><a href="<?php echo base_url('wip/monitoringspi') ?>"><i class="fa fa-dot-circle-o"></i> History and Confirmation SPI</a></li>
                 <li id="manageWipNav"><a href="<?php echo base_url('wip/tampilanexportstok') ?>"><i class="fa fa-dot-circle-o"></i> Export Stok After SPI</a></li>

                </ul>
            </li>
<?php endif; ?>		
<!-- Menu wip-->
<?php if(in_array('createCutting', $user_permission) || in_array('updateCutting', $user_permission) || in_array('viewCutting', $user_permission) || in_array('deleteCutting', $user_permission)): ?>
            <li class="treeview" id="mainWipNav">
              <a href="#">
                <i class="fa fa-cut"></i>
                <span>Input Data Cutting</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu"> 
                  <li id="addCuttingNav"><a href="<?php echo base_url('cutting/create') ?>"><i class="fa fa-dot-circle-o"></i> Add Form Cutting</a></li>
                  <li id="manageCuttingNav"><a href="<?php echo base_url('cutting') ?>"><i class="fa fa-dot-circle-o"></i> Manage Data</a></li>
                  <li id="manageCuttingNav"><a href="<?php echo base_url('cutting/editdelete') ?>"><i class="fa fa-print"></i> Print / Edit Data</a></li> 
                </ul>
            </li>
<?php endif; ?>		  


         

 <!-- Menu Kedatangan Barang-->
 <?php if(in_array('createBarangmasuk', $user_permission) || in_array('updateBarangmasuk', $user_permission) || in_array('viewBarangmasuk', $user_permission) || in_array('deleteBarangmasuk', $user_permission)): ?>
            <li class="treeview" id="mainBarangmasukNav">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Kedatangan Material / Barang</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="addBarangmasukNav"><a href="<?php echo base_url('barangmasuk/create') ?>"><i class="fa fa-dot-circle-o"></i> Form Kedatangan Compound</a></li>
                <li id="manageBarangmasukNav"><a href="<?php echo base_url('barangmasuk/umum') ?>"><i class="fa fa-dot-circle-o"></i>Form Kedatangan Barang</a></li>
                <li id="manageBarangmasukNav"><a href="<?php echo base_url('barangmasuk') ?>"><i class="fa fa-dot-circle-o"></i> Manage Report</a></li>
                <li id="manageBarangmasukNav"><a href="<?php echo base_url('barangmasuk/exportppic') ?>"><i class="fa fa-dot-circle-o"></i>Export to Purchase</a></li>
              </ul>
            </li>
  <?php endif; ?>   
<!-- menu Material-->
<?php if(in_array('createMaterial', $user_permission) || in_array('updateMaterial', $user_permission) || in_array('viewMaterial', $user_permission) || in_array('deleteMaterial', $user_permission)): ?>
            <li class="treeview" id="mainMaterialNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Material</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createMaterial', $user_permission)): ?>
                  <li id="addMaterialNav"><a href="<?php echo base_url('material/create') ?>"><i class="fa fa-dot-circle-o"></i> Add Material</a></li>
                <?php endif; ?>
                <?php if(in_array('updateItem', $user_permission) || in_array('viewMaterial', $user_permission) || in_array('deleteMaterial', $user_permission)): ?>
                <li id="manageMaterialNav"><a href="<?php echo base_url('material') ?>"><i class="fa fa-dot-circle-o"></i> Manage Material</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>		  
<!-- Menu wip-->
		  
<!-- menu catagory-->
          <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <li id="categoryNav">
              <a href="<?php echo base_url('category/') ?>">
                <i class="fa fa-files-o"></i> <span>Category</span>
              </a>
            </li>
          <?php endif; ?>
<!-- menu STORE-->
          <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            <li id="storeNav">
              <a href="<?php echo base_url('stores/') ?>">
                <i class="fa fa-files-o"></i> <span>Stores</span>
              </a>
            </li>
          <?php endif; ?>
<!-- menu Atribut-->
          <?php if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
          <li id="attributeNav">
            <a href="<?php echo base_url('attributes/') ?>">
              <i class="fa fa-files-o"></i> <span>Attributes</span>
            </a>
          </li>
          <?php endif; ?>
<!-- menu Inputs-->
          <?php if(in_array('createInput', $user_permission) || in_array('updateInput', $user_permission) || in_array('viewInput', $user_permission) || in_array('deleteInput', $user_permission)): ?>
            <li id="inputNav">
              <a href="<?php echo base_url('inputs/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Proses Inputs QC</span>
              </a>
            </li>
          <?php endif; ?>


            <!-- menu repair-->
<?php if(in_array('createRepair', $user_permission) || in_array('updateRepair', $user_permission) || in_array('viewRepair', $user_permission) || in_array('deleteRepair', $user_permission)): ?>
            <li class="treeview" id="mainRepairNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Input Repair / NG</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createRepair', $user_permission)): ?>
                  <li id="addRepairNav"><a href="<?php echo base_url('repair/create') ?>"><i class="	fa fa-pencil-square"></i> Add Data Repair</a></li>
                <?php endif; ?>
                <?php if(in_array('updateRepair', $user_permission) || in_array('viewRepair', $user_permission) || in_array('deleteRepair', $user_permission)): ?>
                <li id="manageRepairNav"><a href="<?php echo base_url('repair') ?>"><i class="fa fa-suitcase"></i> Manage Data Repair</a></li>
                <?php endif; ?>
              </ul>
            </li>
<?php endif; ?>		

		  
<!-- menu Inputs PI-->
          <?php if(in_array('createPi', $user_permission) || in_array('updatePi', $user_permission) || in_array('viewPi', $user_permission) || in_array('deletePi', $user_permission)): ?>
            <li id="piNav">
              <a href="<?php echo base_url('pis/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>P. Inspection Std</span>
              </a>
            </li>
          <?php endif; ?>
		  
<!-- menu Create PI-->
          <?php if(in_array('createInputpi', $user_permission) || in_array('updateInputpi', $user_permission) || in_array('viewInputpi', $user_permission) || in_array('deleteInputpi', $user_permission)): ?>
            <li id="inputpiNav">
              <a href="<?php echo base_url('inputpis/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Input PIS</span>
              </a>
            </li>
          <?php endif; ?>



<!-- menu OPR-->
          <?php if(in_array('createOperator', $user_permission) || in_array('updateOperator', $user_permission) || in_array('viewOperator', $user_permission) || in_array('deleteOperator', $user_permission)): ?>
            <li id="operatorNav">
              <a href="<?php echo base_url('operators/') ?>">
                <i class="fa fa-files-o"></i> <span>Operators</span>
              </a>
            </li>
          <?php endif; ?>
<!-- menu Item-->
<?php if(in_array('createItem', $user_permission) || in_array('updateItem', $user_permission) || in_array('viewItem', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainItemNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Items</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createItem', $user_permission)): ?>
                  <li id="addItemNav"><a href="<?php echo base_url('items/create') ?>"><i class="	fa fa-pencil-square"></i> Add Item</a></li>
                <?php endif; ?>
                <?php if(in_array('updateItem', $user_permission) || in_array('viewItem', $user_permission) || in_array('deleteItem', $user_permission)): ?>
                <li id="manageItemNav"><a href="<?php echo base_url('items') ?>"><i class="fa fa-suitcase"></i> Manage Items</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>		  
		  
		  
		  
		  
		  
<!-- menu Product-->
          <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Products</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProduct', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('products/create') ?>"><i class="	fa fa-pencil-square"></i> Add Product</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('products') ?>"><i class="fa fa-suitcase"></i> Manage Products</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<!-- menu Vroduct-->
          <?php if(in_array('createVroduct', $user_permission) || in_array('updateVroduct', $user_permission) || in_array('viewVroduct', $user_permission) || in_array('deleteVroduct', $user_permission)): ?>
            <li class="treeview" id="mainVroductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Supplier / Costumer</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createVroduct', $user_permission)): ?>
                  <li id="addVroductNav"><a href="<?php echo base_url('vroducts/create') ?>"><i class="	fa fa-pencil-square"></i> Add Product</a></li>
                <?php endif; ?>
                <?php if(in_array('updateVroduct', $user_permission) || in_array('viewVroduct', $user_permission) || in_array('deleteVroduct', $user_permission)): ?>
                <li id="manageVroductNav"><a href="<?php echo base_url('vroducts') ?>"><i class="fa fa-suitcase"></i> Manage Products</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
		  
<!-- menu Input Supplier baru -->
<?php if(in_array('createSsb', $user_permission) || in_array('updateSsb', $user_permission) || in_array('viewSsb', $user_permission) || in_array('deleteSsb', $user_permission)): ?>
            <li class="treeview" id="mainSsbNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Seleksi Supplier barus</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createSsb', $user_permission)): ?>
                  <li id="addSsbNav"><a href="<?php echo base_url('ssbs/create') ?>"><i class="	fa fa-pencil-square"></i> Add Seleksi Supplier Baru</a></li>
                <?php endif; ?>
                <?php if(in_array('updateSsb', $user_permission) || in_array('viewSsb', $user_permission) || in_array('deleteSsb', $user_permission)): ?>
                <li id="manageSsbNav"><a href="<?php echo base_url('ssbs') ?>"><i class="fa fa-suitcase"></i> Manage Seleksi</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

<!-- Menu Orders-->
<!-- Menu PROSES ENG finish-->
<?php if(in_array('createTrial', $user_permission) || in_array('updateTrial', $user_permission) || in_array('viewTrial', $user_permission) || in_array('deleteTrial', $user_permission)): ?>
            <li class="treeview" id="mainTrialNav">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Trial Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createTrial', $user_permission)): ?>
                  <li id="addTrialNav"><a href="<?php echo base_url('trial/create') ?>"><i class="	fa fa-pencil-square"></i> Add Trial Record</a></li>
                <?php endif; ?>
                <?php if(in_array('updateTrial', $user_permission) || in_array('viewTrial', $user_permission) || in_array('deleteTrial', $user_permission)): ?>
                <li id="manageTrialNav"><a href="<?php echo base_url('trial') ?>"><i class="	fa fa-suitcase"></i> Manage Trial Record</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>		  

        <?php if(in_array('createGi', $user_permission) || in_array('updateGi', $user_permission) || in_array('viewGi', $user_permission) || in_array('deleteGi', $user_permission)): ?>
            <li class="treeview" id="mainGiNav">
              <a href="#">
                <i class="fa fa-area-chart"></i>
                <span>General Information Part</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGi', $user_permission)): ?>
                  <li id="addGiNav"><a href="<?php echo base_url('gi/create') ?>"><i class="	fa fa-pencil-square"></i> Add General Info Part</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGi', $user_permission) || in_array('viewGi', $user_permission) || in_array('deleteGi', $user_permission)): ?>
                <li id="manageGiNav"><a href="<?php echo base_url('gi') ?>"><i class="	fa fa-suitcase"></i> Manage General Info Parts</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>	
<?php if(in_array('createJoken', $user_permission) || in_array('updateJoken', $user_permission) || in_array('viewJoken', $user_permission) || in_array('deleteJoken', $user_permission)): ?>
            <li class="treeview" id="mainJokenNav">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>JOKEN</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createJoken', $user_permission)): ?>
                  <li id="addJokenNav"><a href="<?php echo base_url('joken/create') ?>"><i class="	fa fa-pencil-square"></i> Add Joken</a></li>
                <?php endif; ?>
                <?php if(in_array('updateJoken', $user_permission) || in_array('viewJoken', $user_permission) || in_array('deleteJoken', $user_permission)): ?>
                <li id="manageJokenNav"><a href="<?php echo base_url('joken') ?>"><i class="	fa fa-suitcase"></i> Manage Joken Record</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>	


		  
<!-- Menu PROSES ENG finish-->
 
<!-- Menu Orders-->

          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="	fa fa-pencil-square"></i> Add Order</a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-suitcase"></i> Manage Orders</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<!-- Menu PO Compuound-->
          <?php if(in_array('createPocompound', $user_permission) || in_array('updatePocompound', $user_permission) || in_array('viewPocopound', $user_permission) || in_array('deletePocompound', $user_permission)): ?>
            <li class="treeview" id="mainPocompoundNav">
              <a href="#">
                <i class="fa fa-area-chart"></i>
                <span>PO Compound</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPocompound', $user_permission)): ?>
                  <li id="addPocompoundNav"><a href="<?php echo base_url('pocompound/create') ?>"><i class="	fa fa-pencil-square"></i> Add PO Compound</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePocompound', $user_permission) || in_array('viewPocompound', $user_permission) || in_array('deletePocompound', $user_permission)): ?>
                <li id="managePocompoundNav"><a href="<?php echo base_url('pocompound') ?>"><i class="	fa fa-suitcase"></i> Manage PO Compound</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<!-- Menu Umum-->
<?php if(in_array('createPoumum', $user_permission) || in_array('updatePoumum', $user_permission) || in_array('viewPoumum', $user_permission) || in_array('deletePoumum', $user_permission)): ?>
            <li class="treeview" id="mainPoumumNav">
              <a href="#">
                <i class="	fa fa-pie-chart"></i>
                <span>Po Umum</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPoumum', $user_permission)): ?>
                  <li id="addPoumumNav"><a href="<?php echo base_url('poumum/create') ?>"><i class="	fa fa-pencil-square"></i> Add PO Umum</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePoumum', $user_permission) || in_array('viewPoumum', $user_permission) || in_array('deletePoumum', $user_permission)): ?>
                <li id="managePoumumNav"><a href="<?php echo base_url('poumum') ?>"><i class="fa fa-suitcase"></i> Manage PO Umum</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<!-- Menu Import-->
          <?php if(in_array('createPoimport', $user_permission) || in_array('updatePoimport', $user_permission) || in_array('viewPoimport', $user_permission) || in_array('deletePoimport', $user_permission)): ?>
            <li class="treeview" id="mainPoimportNav">
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Po Import</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPoimport', $user_permission)): ?>
                  <li id="addPoimportNav"><a href="<?php echo base_url('poimport/create') ?>"><i class="	fa fa-pencil-square"></i> Add PO Import</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePoimport', $user_permission) || in_array('viewPoimport', $user_permission) || in_array('deletePoimport', $user_permission)): ?>
                <li id="managePoimportNav"><a href="<?php echo base_url('poimport') ?>"><i class="fa fa-suitcase"></i> Manage PO Import</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<!-- Menu Import-->
          <?php if(in_array('createPotooling', $user_permission) || in_array('updatePotooling', $user_permission) || in_array('viewPotooling', $user_permission) || in_array('deletePotooling', $user_permission)): ?>
            <li class="treeview" id="mainPotoolingNav">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>PO Tooling</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPotooling', $user_permission)): ?>
                  <li id="addPotoolingNav"><a href="<?php echo base_url('potooling/create') ?>"><i class="	fa fa-pencil-square"></i> Add Po tooling</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePotooling', $user_permission) || in_array('viewPotooling', $user_permission) || in_array('deletePotooling', $user_permission)): ?>
                <li id="managePotoolingNav"><a href="<?php echo base_url('potooling') ?>"><i class="fa fa-suitcase"></i> Manage Po tooling</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<!-- Menu RFQ-->
          <?php if(in_array('createRfq', $user_permission) || in_array('updateRfqs', $user_permission) || in_array('viewRfqs', $user_permission) || in_array('deleteRfqs', $user_permission)): ?>
            <li class="treeview" id="mainRfqNav">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>RFQ</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createRfqs', $user_permission)): ?>
                  <li id="addRfqsNav"><a href="<?php echo base_url('rfqs/create') ?>"><i class="	fa fa-pencil-square"></i> Add RFQ</a></li>
                <?php endif; ?>
                <?php if(in_array('updateRfqs', $user_permission) || in_array('viewRfqs', $user_permission) || in_array('deleteRfqs', $user_permission)): ?>
                <li id="manageRfqsNav"><a href="<?php echo base_url('rfqs') ?>"><i class="fa fa-suitcase"></i> Manage Rfq</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

<!-- Menu FPP-->
<?php if(in_array('createFpps', $user_permission) || in_array('updateFpps', $user_permission) || in_array('viewFpps', $user_permission) || in_array('deleteFpp', $user_permission)): ?>
            <li class="treeview" id="mainFppNav">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Form Pengajuan Pekerjaan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createFpps', $user_permission)): ?>
                  <li id="addFppsNav"><a href="<?php echo base_url('fpps/create') ?>"><i class="	fa fa-pencil-square"></i> Add FPP</a></li>
                <?php endif; ?>
                <?php if(in_array('updateFpps', $user_permission) || in_array('viewFpps', $user_permission) || in_array('deleteFpps', $user_permission)): ?>
                <li id="manageFppsNav"><a href="<?php echo base_url('fpps') ?>"><i class="fa fa-suitcase"></i> Manage FPP</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

<!-- Menu penanganan sampel-->

<?php if(in_array('createSps', $user_permission) || in_array('updateSps', $user_permission) || in_array('viewSps', $user_permission) || in_array('deleteSps', $user_permission)): ?>
            <li class="treeview" id="mainSpssNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>SPSs</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createSps', $user_permission)): ?>
                  <li id="addSpsNav"><a href="<?php echo base_url('spss/create') ?>"><i class="	fa fa-pencil-square"></i> Add Sps</a></li>
                <?php endif; ?>
                <?php if(in_array('updateSps', $user_permission) || in_array('viewSps', $user_permission) || in_array('deleteSps', $user_permission)): ?>
                <li id="manageSpssNav"><a href="<?php echo base_url('spss') ?>"><i class="fa fa-suitcase"></i> Manage Spss</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>



          <?php if(in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('front/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>File PDF</span>
              </a>
            </li>
          <?php endif; ?>


          <?php if(in_array('updateCompany', $user_permission)): ?>
            <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-files-o"></i> <span>Company</span></a></li>
          <?php endif; ?>

        

        <!-- <li class="header">Settings</li> -->

        <?php if(in_array('viewProfile', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
        <?php endif; ?>
        <?php if(in_array('updateSetting', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
        <?php endif; ?>

        <?php endif; ?>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>