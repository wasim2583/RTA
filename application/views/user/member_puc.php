<?php

?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Memebr - PUC Certificate</h1>
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
               <h6 class="m-0 font-weight-bold text-primary">PUC Certificate</h6>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-8">
                     <div class="col-lg-12 col-md-12">
                        <!-- <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Policy Number</div>
                           <div class="col-lg-8"><span><?php echo empty($member->policy_no) ? 'NA' : $member->policy_no; ?></span></div>
                        </div> -->
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">PUC Certificate</div>
                           <div class="col-lg-8">
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
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">PUC Certificate Valid Upto</div>
                           <div class="col-lg-8">
                              <span><?php echo ($member->puc_exp_date == '0000-00-00' OR $member->puc_exp_date == null) ? 'NA' : date_format(date_create($member->puc_exp_date), 'd-M-Y'); ?>
                                 </span>
                           </div>
                        </div>
                        <button onclick="location.href='<?php echo base_url(); ?>user/Member/update_puc'" class="btn btn-primary btn_submit float-right">Edit</button>
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