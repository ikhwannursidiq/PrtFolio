

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
        <li><a href="<?php echo base_url('groups/') ?>">Groups</a></li>
        <li class="active">Edit</li>
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
              <h3 class="box-title">Edit Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/update') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" value="<?php echo $group_data['group_name']; ?>">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>
                  
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
                        <td><input type="checkbox" class="minimal" name="permission[]" id="permission" class="minimal" value="createUser" <?php if($serialize_permission) {
                          if(in_array('createUser', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateUser" <?php 
                        if($serialize_permission) {
                          if(in_array('updateUser', $serialize_permission)) { echo "checked"; } 
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewUser" <?php 
                        if($serialize_permission) {
                          if(in_array('viewUser', $serialize_permission)) { echo "checked"; }   
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteUser" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
					   <tr>
                        <td>Item</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createItem" <?php if($serialize_permission) {
                          if(in_array('createItem', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateItem" <?php if($serialize_permission) {
                          if(in_array('updateItem', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewItem" <?php if($serialize_permission) {
                          if(in_array('viewItem', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteItem" <?php if($serialize_permission) {
                          if(in_array('deleteItem', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('createGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('updateGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Inputs</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createInput" <?php if($serialize_permission) {
                          if(in_array('createInput', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateInput" <?php if($serialize_permission) {
                          if(in_array('updateInput', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewInput" <?php if($serialize_permission) {
                          if(in_array('viewInput', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteInput" <?php if($serialize_permission) {
                          if(in_array('deleteInput', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Part Return</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createBalikan" <?php if($serialize_permission) {
                          if(in_array('createBalikan', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateBalikan" <?php if($serialize_permission) {
                          if(in_array('updateBalikan', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewBalikan" <?php if($serialize_permission) {
                          if(in_array('viewBalikan', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteBalikan" <?php if($serialize_permission) {
                          if(in_array('deleteBalikan', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>



                      <tr>
                        <td>Report Gudang</td>
                        <td><input type="checkbox" class="minimal" name="permission[]" id="permission" class="minimal" value="createGroupping" <?php if($serialize_permission) {
                          if(in_array('createGroupping', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGroupping" <?php 
                        if($serialize_permission) {
                          if(in_array('updateGroupping', $serialize_permission)) { echo "checked"; } 
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGroupping" <?php 
                        if($serialize_permission) {
                          if(in_array('viewGroupping', $serialize_permission)) { echo "checked"; }   
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGroupping" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteGroupping', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>

					    <tr>
                        <td>Date Range</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createDaterange" <?php if($serialize_permission) {
                          if(in_array('createDaterange', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateDaterange" <?php if($serialize_permission) {
                          if(in_array('updateDateranga', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewDaterange" <?php if($serialize_permission) {
                          if(in_array('viewDaterange', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteDateranga" <?php if($serialize_permission) {
                          if(in_array('deleteDaterange', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Summary Laporan QC</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSummary" <?php if($serialize_permission) {
                          if(in_array('createSummary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSummary" <?php if($serialize_permission) {
                          if(in_array('updateSummary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSummary" <?php if($serialize_permission) {
                          if(in_array('viewSummary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSummary" <?php if($serialize_permission) {
                          if(in_array('deleteSummary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Repair Submit</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createRepair" <?php if($serialize_permission) {
                          if(in_array('createRepair', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateRepair" <?php if($serialize_permission) {
                          if(in_array('updateRepair', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewRepair" <?php if($serialize_permission) {
                          if(in_array('viewRepair', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteRepair" <?php if($serialize_permission) {
                          if(in_array('deleteRepair', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Form Incoming</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createFincoming" <?php if($serialize_permission) {
                          if(in_array('createFincoming', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateFincoming" <?php if($serialize_permission) {
                          if(in_array('updateFincoming', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewFincoming" <?php if($serialize_permission) {
                          if(in_array('viewFincoming', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteFincoming" <?php if($serialize_permission) {
                          if(in_array('deleteFincoming', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Kedatangan Barang</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createBarangmasuk" <?php if($serialize_permission) {
                          if(in_array('createBarangmasuk', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateBarangmasuk" <?php if($serialize_permission) {
                          if(in_array('updateBarangmasuk', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewBarangmasuk" <?php if($serialize_permission) {
                          if(in_array('viewBarangmasuk', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteBarangmasuk" <?php if($serialize_permission) {
                          if(in_array('deleteBarangmasuk', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Material</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createMaterial" <?php if($serialize_permission) {
                          if(in_array('createMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateMaterial" <?php if($serialize_permission) {
                          if(in_array('updateMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewMaterial" <?php if($serialize_permission) {
                          if(in_array('viewMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteMaterial" <?php if($serialize_permission) {
                          if(in_array('deleteMaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      
					  
					             <tr>
                        <td>Input PIS</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createInputi" <?php if($serialize_permission) {
                          if(in_array('createInputpi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateInputpi" <?php if($serialize_permission) {
                          if(in_array('updateInputpi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewInputpi" <?php if($serialize_permission) {
                          if(in_array('viewInputpi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteInputpi" <?php if($serialize_permission) {
                          if(in_array('deleteInputpi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
					  
                     <tr>
                        <td>Filter Range</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createFilter" <?php if($serialize_permission) {
                          if(in_array('createFilter', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateFilter" <?php if($serialize_permission) {
                          if(in_array('updateFilter', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewFilter" <?php if($serialize_permission) {
                          if(in_array('viewFilter', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteFilter" <?php if($serialize_permission) {
                          if(in_array('deleteFilter', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>					  
                      <tr>
                        <td>FORM SPI & WIP QC</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createWip" <?php if($serialize_permission) {
                          if(in_array('createWip', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateWip" <?php if($serialize_permission) {
                          if(in_array('updateWip', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewWip" <?php if($serialize_permission) {
                          if(in_array('viewWip', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteWip" <?php if($serialize_permission) {
                          if(in_array('deleteWip', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Form Cutting</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCutting" <?php if($serialize_permission) {
                          if(in_array('createCutting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCutting" <?php if($serialize_permission) {
                          if(in_array('updateCutting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCutting" <?php if($serialize_permission) {
                          if(in_array('viewCutting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCutting" <?php if($serialize_permission) {
                          if(in_array('deleteCutting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Input data Compound</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCompound" <?php if($serialize_permission) {
                          if(in_array('createCompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCompound" <?php if($serialize_permission) {
                          if(in_array('updateCompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCompound" <?php if($serialize_permission) {
                          if(in_array('viewCompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCompound" <?php if($serialize_permission) {
                          if(in_array('deleteCompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Input data Sub Material</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSubmaterial" <?php if($serialize_permission) {
                          if(in_array('createSubmaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSubmaterial" <?php if($serialize_permission) {
                          if(in_array('updateSubmaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSubmaterial" <?php if($serialize_permission) {
                          if(in_array('viewSubmaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSubmaterial" <?php if($serialize_permission) {
                          if(in_array('deleteSubmaterial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
					  
					  
					            <tr>
                        <td>PIS</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPi" <?php if($serialize_permission) {
                          if(in_array('createPi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePi" <?php if($serialize_permission) {
                          if(in_array('updatePi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPi" <?php if($serialize_permission) {
                          if(in_array('viewPi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePi" <?php if($serialize_permission) {
                          if(in_array('deletePi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>


					             <tr>
                        <td>PIS STANDARD</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProd" <?php if($serialize_permission) {
                          if(in_array('createProd', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProd" <?php if($serialize_permission) {
                          if(in_array('updateProd', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProd" <?php if($serialize_permission) {
                          if(in_array('viewProd', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProd" <?php if($serialize_permission) {
                          if(in_array('deleteProd', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
					  <!-- IRD -->
                      <tr>
                        <td>IRDS</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createIrds" <?php if($serialize_permission) {
                          if(in_array('createIrds', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateIrds" <?php if($serialize_permission) {
                          if(in_array('updateIrds', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewIrds" <?php if($serialize_permission) {
                          if(in_array('viewIrds', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteIrds" <?php if($serialize_permission) {
                          if(in_array('deleteIrds', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
					  
                      <tr>
                        <td>Operators</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createOperator" <?php if($serialize_permission) {
                          if(in_array('createOperator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateOperator" <?php if($serialize_permission) {
                          if(in_array('updateOperator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewOperator" <?php if($serialize_permission) {
                          if(in_array('viewOperator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteOperator" <?php if($serialize_permission) {
                          if(in_array('deleteOperator', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
		<!-- Menu proses Eng start-->		
                      <tr>
                        <td>General Information Part</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createGi" <?php if($serialize_permission) {
                          if(in_array('createGi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGi" <?php if($serialize_permission) {
                          if(in_array('updateGi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGi" <?php if($serialize_permission) {
                          if(in_array('viewGi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGi" <?php if($serialize_permission) {
                          if(in_array('deleteGi', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td>Trial Record</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createTrial" <?php if($serialize_permission) {
                          if(in_array('createTrial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateTrial" <?php if($serialize_permission) {
                          if(in_array('updateTrial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewTrial" <?php if($serialize_permission) {
                          if(in_array('viewTrial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteTrial" <?php if($serialize_permission) {
                          if(in_array('deleteTrial', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

 <tr>
                      <td>Joken</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createJoken" <?php if($serialize_permission) {
                          if(in_array('createJoken', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateJoken" <?php if($serialize_permission) {
                          if(in_array('updateJoken', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewJoken" <?php if($serialize_permission) {
                          if(in_array('viewJoken', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteJoken" <?php if($serialize_permission) {
                          if(in_array('deleteJoken', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

<!-- Menu proses Eng finish-->					  
                     
                      <tr>
                        <td>Brands</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createBrand" <?php if($serialize_permission) {
                          if(in_array('createBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateBrand" <?php if($serialize_permission) {
                          if(in_array('updateBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewBrand" <?php if($serialize_permission) {
                          if(in_array('viewBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteBrand" <?php if($serialize_permission) {
                          if(in_array('deleteBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
					  
					            <tr>
                        <td>Suppliers</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSupplier" <?php if($serialize_permission) {
                          if(in_array('createSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSupplier" <?php if($serialize_permission) {
                          if(in_array('updateSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSupplier" <?php if($serialize_permission) {
                          if(in_array('viewSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSupplier" <?php if($serialize_permission) {
                          if(in_array('deleteSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
					  
					  
					  
					  
                      <tr>
                        <td>Customers</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCustomers" <?php if($serialize_permission) {
                          if(in_array('createCustomers', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCustomers" <?php if($serialize_permission) {
                          if(in_array('updateCustomers', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCustomers" <?php if($serialize_permission) {
                          if(in_array('viewCustomers', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCustomers" <?php if($serialize_permission) {
                          if(in_array('deleteCustomers', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>


                      <tr>
                        <td>Category</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCategory" <?php if($serialize_permission) {
                          if(in_array('createCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCategory" <?php if($serialize_permission) {
                          if(in_array('updateCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCategory" <?php if($serialize_permission) {
                          if(in_array('viewCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCategory" <?php if($serialize_permission) {
                          if(in_array('deleteCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Stores</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createStore" <?php if($serialize_permission) {
                          if(in_array('createStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateStore" <?php if($serialize_permission) {
                          if(in_array('updateStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewStore" <?php if($serialize_permission) {
                          if(in_array('viewStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteStore" <?php if($serialize_permission) {
                          if(in_array('deleteStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Attributes</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createAttribute" <?php if($serialize_permission) {
                          if(in_array('createAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateAttribute" <?php if($serialize_permission) {
                          if(in_array('updateAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewAttribute" <?php if($serialize_permission) {
                          if(in_array('viewAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteAttribute" <?php if($serialize_permission) {
                          if(in_array('deleteAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Products</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProduct" <?php if($serialize_permission) {
                          if(in_array('createProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProduct" <?php if($serialize_permission) {
                          if(in_array('updateProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProduct" <?php if($serialize_permission) {
                          if(in_array('viewProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProduct" <?php if($serialize_permission) {
                          if(in_array('deleteProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                 <tr>
                        <td>Vroducts</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createVroduct" <?php if($serialize_permission) {
                          if(in_array('createVroduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateVroduct" <?php if($serialize_permission) {
                          if(in_array('updateVroduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewVroduct" <?php if($serialize_permission) {
                          if(in_array('viewVroduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteVroduct" <?php if($serialize_permission) {
                          if(in_array('deleteVroduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>


















                      <tr>
                        <td>Seleksi Supplier</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSsb" <?php if($serialize_permission) {
                          if(in_array('createSsb', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSsb" <?php if($serialize_permission) {
                          if(in_array('updateSsb', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSsb" <?php if($serialize_permission) {
                          if(in_array('viewSsb', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSsb" <?php if($serialize_permission) {
                          if(in_array('deleteSsb', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>




                      <tr>
                        <td>Customer</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCustomer" <?php if($serialize_permission) {
                          if(in_array('createCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCustomer" <?php if($serialize_permission) {
                          if(in_array('updateCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCustomer" <?php if($serialize_permission) {
                          if(in_array('viewCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCustomer" <?php if($serialize_permission) {
                          if(in_array('deleteCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Supplier</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSupplier" <?php if($serialize_permission) {
                          if(in_array('createSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSupplier" <?php if($serialize_permission) {
                          if(in_array('updateSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSupplier" <?php if($serialize_permission) {
                          if(in_array('viewSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSupplier" <?php if($serialize_permission) {
                          if(in_array('deleteSupplier', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>


                      <tr>
                        <td>Form Pengajuan Pengerjaan </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createFpps" <?php if($serialize_permission) {
                          if(in_array('createFpp', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateFpps" <?php if($serialize_permission) {
                          if(in_array('updateFpp', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewFpps" <?php if($serialize_permission) {
                          if(in_array('viewFpp', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteFpps" <?php if($serialize_permission) {
                          if(in_array('deleteFpp', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Penanganan sample</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSps" <?php if($serialize_permission) {
                          if(in_array('createSps', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSps" <?php if($serialize_permission) {
                          if(in_array('updateSps', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSps" <?php if($serialize_permission) {
                          if(in_array('viewSps', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSps" <?php if($serialize_permission) {
                          if(in_array('deleteSps', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>


                      <tr>
                        <td>QC Reports</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createQcreport" <?php if($serialize_permission) {
                          if(in_array('createQcreport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateQcreport" <?php if($serialize_permission) {
                          if(in_array('updateQcreport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewQcreport" <?php if($serialize_permission) {
                          if(in_array('viewQcreport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteQcreport" <?php if($serialize_permission) {
                          if(in_array('deleteQcreport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>QC Reports Gudang</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createQcreportGudang" <?php if($serialize_permission) {
                          if(in_array('createQcreportGudang', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateQcreportGudang" <?php if($serialize_permission) {
                          if(in_array('updateQcreportGudang', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewQcreportGudang" <?php if($serialize_permission) {
                          if(in_array('viewQcreportGudang', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteQcreportGudang" <?php if($serialize_permission) {
                          if(in_array('deleteQcreportGudang', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>



                      <tr>
                        <td>EXPORT</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createExport" <?php if($serialize_permission) {
                          if(in_array('createExport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateExport" <?php if($serialize_permission) {
                          if(in_array('updateExport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewExport" <?php if($serialize_permission) {
                          if(in_array('viewExport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteExport" <?php if($serialize_permission) {
                          if(in_array('deleteExport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>









                      <tr>
                        <td>Orders</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createOrder" <?php if($serialize_permission) {
                          if(in_array('createOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateOrder" <?php if($serialize_permission) {
                          if(in_array('updateOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewOrder" <?php if($serialize_permission) {
                          if(in_array('viewOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteOrder" <?php if($serialize_permission) {
                          if(in_array('deleteOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>Pocompound</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPocompound" <?php if($serialize_permission) {
                          if(in_array('createPocompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePocompound" <?php if($serialize_permission) {
                          if(in_array('updatePocompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPocompound" <?php if($serialize_permission) {
                          if(in_array('viewPocompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePocompound" <?php if($serialize_permission) {
                          if(in_array('deletePocompound', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
      <!--poumum-->>                
                      <tr>
                        <td>PO UMUM</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPoumum" <?php if($serialize_permission) {
                          if(in_array('createPoumum', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePoumum" <?php if($serialize_permission) {
                          if(in_array('updatePoumum', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPoumum" <?php if($serialize_permission) {
                          if(in_array('viewPoumum', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePoumum" <?php if($serialize_permission) {
                          if(in_array('deletePoumum', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>PO Tooling</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPotooling" <?php if($serialize_permission) {
                          if(in_array('createPotooling', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePotooling" <?php if($serialize_permission) {
                          if(in_array('updatePotooling', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPotooling" <?php if($serialize_permission) {
                          if(in_array('viewPotooling', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePotooling" <?php if($serialize_permission) {
                          if(in_array('deletePotooling', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td>PO IMPORT</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPoimport" <?php if($serialize_permission) {
                          if(in_array('createPoimport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePoimport" <?php if($serialize_permission) {
                          if(in_array('updatePoimport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPoimport" <?php if($serialize_permission) {
                          if(in_array('viewPoimport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePoimport" <?php if($serialize_permission) {
                          if(in_array('deletePoimport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      
                      <tr>
                        <td>RFQ</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createRfqs" <?php if($serialize_permission) {
                          if(in_array('createRfqs', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateRfqs" <?php if($serialize_permission) {
                          if(in_array('updateRfqs', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewRfqs" <?php if($serialize_permission) {
                          if(in_array('viewRfqs', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteRfqs" <?php if($serialize_permission) {
                          if(in_array('deleteRfqs', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>


                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewReports" <?php if($serialize_permission) {
                          if(in_array('viewReports', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCompany" <?php if($serialize_permission) {
                          if(in_array('updateCompany', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProfile" <?php if($serialize_permission) {
                          if(in_array('viewProfile', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSetting" <?php if($serialize_permission) {
                          if(in_array('updateSetting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Changes</button>
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
    $("#manageGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>
