<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Memebr - Upload Driving Licence</h1>
      <?php
      if( ! empty($this->session->flashdata('member_update_success')))
      {
         ?>
      <div class="fadeout_alert">
         <?php echo $this->session->flashdata('member_update_success'); ?>
      </div>
         <?php
      }
      if( ! empty($this->session->flashdata('member_update_error')))
      {
         ?>
      <div class="fadeout_alert">
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
               <h6 class="m-0 font-weight-bold text-primary">Driving Licence Upload Form</h6>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-8">
                     <div class="col-lg-12 col-md-12">
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Driving Licence Number</div>
                           <div class="col-lg-8">
                              <input type="text" name="dl_no" id="dl_no" class="form-control">
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Driving Licence Pic</div>
                           <div class="col-lg-8">
                              <input type="file" placeholder="Profile Pic" name="dl_doc" id="dl_doc">
                           </div>
                           <?php
                              if(empty($member->dl_doc))
                              {
                                 ?>
                              <img style="max-width:100px;" class="img-profile" src="<?php echo base_url().'rta_assets/member/driving_licence/test_card.png'; ?>" alt="Test Image">
                                 <?php
                              }
                              else
                              {
                                 ?>
                              <img src="<?php echo base_url().'rta_assets/member/driving_licence/'.$member->dl_doc; ?>" style="width:200px;"/>
                                 <?php
                              }
                              ?>
                        </div>
                        <button onclick="location.href='<?php echo base_url(); ?>user/Member/upload_dl'" class="btn btn-primary btn_submit float-right">Update</button>
                     </div>
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
