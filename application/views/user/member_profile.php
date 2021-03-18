<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profile</h1>
      <?php
      if( ! empty($this->session->flashdata('member_update_success')))
      {
         ?>
      <div class="error_alert">
         <?php echo $this->session->flashdata('member_update_success'); ?>
      </div>
         <?php
      }
      if( ! empty($this->session->flashdata('member_update_error')))
      {
         ?>
      <div class="error_alert">
         <?php echo $this->session->flashdata('member_update_error'); ?>
      </div>
         <?php
      }
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
                  <div class="col-lg-4">
                     <div class="col-lg-12 col-md-12">
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Name</div>
                           <div class="col-lg-8"><span><?php echo $member->full_name; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Gender</div>
                           <div class="col-lg-8"><span><?php echo empty($member->gender) ? 'NA' : $member->gender; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Mobile</div>
                           <div class="col-lg-8"><span><?php echo $member->mobile; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Email</div>
                           <div class="col-lg-8"><span><?php echo empty($member->email) ? 'NA' : $member->email; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Aadhaar</div>
                           <div class="col-lg-8"><span><?php echo empty($member->aadhaar) ? 'NA' : $member->aadhaar; ?></span></div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Blood group</div>
                           <div class="col-lg-8"><span><?php echo empty($member->blood_group_name) ? 'NA' : $member->blood_group_name; ?></span></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">DoB</div>
                        <div class="col-lg-8"><span><?php echo ($member->dob == '0000-00-00' OR $member->dob == null) ? 'NA' : date_format(date_create($member->dob), 'd-M-Y'); ?></span></div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Emergency contact</div>
                        <div class="col-lg-8"><span><?php echo empty($member->emergency_contact) ? 'NA' : $member->emergency_contact; ?></span></div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Address</div>
                        <div class="col-lg-8">
                           <span><?php echo empty($member->address) ? 'NA' : $member->address; ?></span>
                        </div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">City/Town/Village</div>
                        <div class="col-lg-8">
                           <span><?php echo $member->location_name; ?></span>
                        </div>
                     </div>
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">State</div>
                        <div class="col-lg-8">
                           <span><?php echo $member->state_name; ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="row Member_labels">
                        <div class="col-lg-4 lableTxt">Profile Pic</div>
                        <div class="col-lg-8">
                           <?php
                           if(empty($member->profile_pic))
                           {
                              ?>
                           <img style="max-width:130px;" class="img-profile rounded-circle" src="<?php echo base_url().'rta_assets/member/profile_pics/parrot.jpg'; ?>">
                              <?php
                           }
                           else
                           {
                              ?>
                           <img style="max-width:130px;" class="img-profile rounded-circle" src="<?php echo base_url().'rta_assets/member/profile_pics/'.$member->profile_pic; ?>">
                              <?php
                           }
                           ?>
                        </div>
                     </div>
                     <button onclick="location.href='<?php echo base_url(); ?>user/Member/profile_edit'" class="btn btn-primary btn_submit float-right">Edit</button>
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
