<!-- Main Content -->
<div id="content">
   <!-- Begin Page Content -->
   <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Profile</h1>
      </div>
      <div class="alert">
         <?php
         if( ! empty($this->session->flashdata('partner_update_success')))
            echo $this->session->flashdata('partner_update_success');
         if( ! empty($this->session->flashdata('partner_update_error')))
            echo $this->session->flashdata('partner_update_error');
         ?>
      </div>
     
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
                <div class="row">
                  <div class="col-lg-6">
                     <div class="col-lg-12 col-md-12">
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Name</div>
                           <div class="col-lg-8"><span><?php echo empty($partner->full_name) ? 'NA' : $partner->full_name; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Ogranization Name</div>
                           <div class="col-lg-8"><span><?php echo empty($partner->organization_name) ? 'NA' : $partner->organization_name; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Organization Type</div>
                           <div class="col-lg-8"><span><?php echo empty($partner->organization_type_name) ? 'NA' : $partner->organization_type_name; ?></span></div>
                        </div>
                        <!-- <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Blood group</div>
                           <div class="col-lg-8"><span><?php // echo empty($partner->blood_group) ? 'NA' : $partner->blood_group; ?></span></div>
                        </div> -->
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Organization Logo</div>
                           <div class="col-lg-8">
                              <?php
                              if(empty($partner->logo))
                              {
                                 ?>
                              <img style="max-width:130px;" class="img-profile rounded-circle" src="<?php echo base_url().'uploads/logos/default_logo.jpg'; ?>">
                                 <?php
                              }
                              else
                              {
                                 ?>
                              <img style="max-width:130px;" class="img-profile rounded-circle" src="<?php echo base_url().'uploads/logos/'.$partner->logo; ?>">
                                 <?php
                              }
                              ?>
                           </div>
                        </div>
                        <?php //print_r($partner); ?>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <!-- <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Gender</div>
                        <div class="col-lg-8"><span><?php // echo empty($partner->gender) ? 'NA' : $partner->gender; ?></span></div>
                     </div> -->
                     <!-- <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Emergency contact</div>
                        <div class="col-lg-8"><span><?php echo empty($partner->emergency_contact) ? 'NA' : $partner->emergency_contact; ?></span></div>
                     </div> -->
                     
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Mobile</div>
                        <div class="col-lg-8"><span><?php echo $partner->mobile; ?></span></div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Email</div>
                        <div class="col-lg-8"><span><?php echo $partner->email; ?></span></div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Address</div>
                        <div class="col-lg-8">
                           <?php echo empty($partner->address) ? 'NA' : $partner->address; ?>
                           <!-- <address>
                              <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                              <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                              <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                              <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                              <abbr title="email"></abbr> 
                           </address> -->
                        </div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">City/Town/Village</div>
                        <div class="col-lg-8"><span><?php echo $partner->location_name; ?></span></div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">State</div>
                        <div class="col-lg-8"><span><?php echo $partner->state_name; ?></span></div>
                     </div>
                     <button onclick="location.href='<?php echo base_url(); ?>user/Partner/profile_edit'" class="btn btn-primary btn_submit">Edit</button>
                  </div>
                  </div>
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