<!-- Main Content -->
<div id="content">
   <!-- Begin Page Content -->
   <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Profile</h1>
      </div>
      <?php
      if($this->session->flashdata('partner_update_error'))
         echo $this->session->flashdata('partner_update_error');
      ?>
      <!-- Content Row -->
      <div class="row">
         <!-- Content Column -->
         <div class="col-lg-12 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
               <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
               </div>
               <div class="card-body">
                  <form action="" method="POST" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="col-lg-12 col-md-12">
                              <div class="row Member_labels">
                                 <div class="col-lg-4 lableTxt">Name</div>
                                 <div class="col-lg-8">
                                    <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $partner->full_name; ?>">
                                 </div>
                                 <?php echo form_error('full_name'); ?>
                              </div>
                              <div class="row Member_labels">
                                 <div class="col-lg-4 lableTxt">Address</div>
                                 <div class="col-lg-8">
                                    <textarea class="form-control" name="address" id="address" placeholder="Address"><?php echo ( ! empty($partner->address)) ? $partner->address : set_value('address'); ?></textarea>
                                 </div>
                                 <?php echo form_error('address'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Organizatino Name</div>
                              <div class="col-lg-8">
                                 <input type="text" name="organization_name" id="organization_name" class="form-control" value="<?php echo ( !empty($partner->organization_name)) ? $partner->organization_name : set_value('organization_name'); ?>">
                              </div>
                              <?php echo form_error('organization_name'); ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Ogranization Type</div>
                              <div class="col-lg-8">                                 
                                 <select class="form-control" name="organization_type" id="organization_type">
                                    <option value="">--Select Ogranization Type--</option>
                                    <?php
                                    foreach($organization_types as $organization_type)
                                    {
                                       ?>
                                    <option value="<?php echo $organization_type->id; ?>" <?php echo ($partner->organization_type == $organization_type->id) ? 'selected' : ''; ?>><?php echo $organization_type->organization_type_name; ?></option>
                                       <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <?php echo form_error('organization_type'); ?>
                           </div> 
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Organization Logo</div>
                              <div class="col-lg-8">
                                 <input type="file" name="logo" id="logo">
                              </div>
                              <?php
                              if(empty($partner->logo))
                              {
                                 ?>
                              <img src="<?php echo base_url().'rta_assets/logos/default_logo.jpg'; ?>" style="width:50px;"/>
                                 <?php
                              }
                              else
                              {
                                 ?>
                              <img src="<?php echo base_url().'rta_assets/logos/'.$partner->logo; ?>" style="width:50px;"/>
                                 <?php
                              }
                              ?>
                           </div>
                           <button type="submit" class="btn btn-primary btn_submit">Update</button>                          
                        </div>

                     </div>
                  </form>
               </div>
            </div>
            <!-- Color System -->
         </div>
      </div>
      <!-- Content Row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content