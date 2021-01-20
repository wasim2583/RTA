<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profile Edit</h1>
   </div>
   <?php
   if($this->session->flashdata('member_update_error'))
      echo $this->session->flashdata('member_update_error');
   ?>
   <!-- Content Row -->
   <div class="row">
      <!-- Content Column -->
      <div class="col-lg-12 mb-4">
         <!-- Project Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Profile Edit Form</h6>
            </div>
            <div class="card-body">
               <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-lg-4">
                        <div class="col-lg-12 col-md-12">
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Name</div>
                              <div class="col-lg-8">
                                 <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $member->full_name; ?>">
                              </div>
                              <?php echo form_error('full_name'); ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Date of Birth (mm/dd/YYYY)</div>
                              <div class="col-lg-8">
                                 <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $member->dob ? $member->dob : set_value('dob'); ?>">
                              </div>
                              <?php echo form_error('dob'); ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Gender</div>
                              <div class="col-lg-8">
                                 <select class="form-control" name="gender" id="gender">
                                    <option value="">--Select Gender--</option>
                                    <option value="Male" <?php echo ($member->gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($member->gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    <!-- <option value="Transgender" <?php // echo ($member->gender == 'Transgender') ? 'selected' : ''; ?>>Transgender</option> -->
                                 </select>
                              </div>
                              <?php echo form_error('gender'); ?>
                           </div>                        
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Blood group</div>
                              <div class="col-lg-8">
                                 
                                 <select class="form-control" name="blood_group" id="blood_group">
                                    <option value="">--Select Blood Group--</option>
                                    <?php
                                    foreach($blood_groups as $blood_group)
                                    {
                                       ?>
                                    <option value="<?php echo $blood_group->id; ?>" <?php echo ($member->blood_group == $blood_group->id) ? 'selected' : ''; ?>><?php echo $blood_group->blood_group_name; ?></option>
                                       <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <?php echo form_error('blood_group'); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Emergency contact</div>
                           <div class="col-lg-8">
                              <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" placeholder="Emergency contact" value="<?php echo ( ! empty($member->emergency_contact)) ? $member->emergency_contact : set_value('emergency_contact'); ?>">
                           </div>
                           <?php echo form_error('emergency_contact'); ?>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Aadhaar</div>
                           <div class="col-lg-8">
                              <input type="text" name="aadhaar" id="aadhaar" class="form-control" placeholder="Aadhaar Number" value="<?php echo ( ! empty($member->aadhaar)) ? $member->aadhaar : set_value('aadhaar'); ?>">
                           </div>
                           <?php echo form_error('aadhaar'); ?>
                        </div>                     
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Address</div>
                           <div class="col-lg-8">
                              <textarea class="form-control" name="address" id="address" placeholder="Address"><?php echo ( ! empty($member->address)) ? $member->address : set_value('address'); ?></textarea>
                           </div>
                           <?php echo form_error('address'); ?>
                        </div>
                     </div>
                     <div class="col-lg-4">                           
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Profile Pic</div>
                           <div class="col-lg-8">
                              <input type="file" placeholder="Profile Pic" name="profile_pic" id="profile_pic">
                           </div>
                           <?php
                           if( ! empty($member->profile_pic))
                           {
                              ?>
                           <img src="<?php echo base_url().'rta_assets/member/profile_pics/'.$member->profile_pic; ?>" style="width:50px;"/>
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