<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Memebr - Upload/Update PUC</h1>
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
               <h6 class="m-0 font-weight-bold text-primary">PUC Upload/Update Form</h6>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-8">
                     <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-12 col-md-12">
                           <!-- <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">PUC Number</div>
                              <div class="col-lg-8">
                                 <input type="text" name="policy_no" id="policy_no" class="form-control" value="<?php // echo empty($member->policy_no) ? '' : $member->policy_no; ?>">
                              </div>
                              <?php // echo form_error('policy_no'); ?>
                           </div> -->
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">PUC Doc</div>
                              <div class="col-lg-8">
                                 <input type="file" placeholder="Profile Pic" name="puc_doc" id="puc_doc">
                              </div>
                              <?php
                              if(empty($member->puc_doc))
                              {
                                 ?>
                              <i class="fa fa-file-pdf" aria-hidden="true"></i>
                                 <?php
                              }
                              else
                              {
                                 ?>
                              <iframe src="<?php echo base_url().'uploads/member/puc/'.$member->puc_doc; ?>" width="200px"></iframe>
                                 <?php
                              }
                              ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">PUC valid upto</div>
                              <div class="col-lg-8">
                                 <!-- <span><?php // echo date_format(date_create($member->puc_exp_date), 'd-M-Y'); ?></span> -->
                                 <input type="date" name="puc_exp_date" id="puc_exp_date" value="<?php echo empty($member->puc_exp_date) ? now() : $member->puc_exp_date; ?>">
                              </div>
                              <?php echo form_error('puc_exp_date'); ?>
                           </div>
                           <!-- <button onclick="location.href='<?php // echo base_url(); ?>user/Member/upload_dl'" class="btn btn-primary btn_submit float-right">Update</button> -->
                           <!-- <button type="submit" name="submit" class="btn btn-primary btn_submit float-right">Update</button> -->
                           <input type="submit" name="submit" value="Update" class="btn btn-primary btn_submit float-right">
                        </div>
                     </form>
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
