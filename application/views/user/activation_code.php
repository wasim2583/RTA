<section class="GallryWrap" >
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 card-box-bg text-center">
            <h2 class="dispFull">Account activation</h2>
            <?php if($this->session->flashdata('activation_error')){ ?>
            <div class="alert-style" ><?php echo $this->session->flashdata('activation_error');?></div>
            <?php } ?>
            <?php if($this->session->flashdata('activation_sent')){ ?>
            <div class="alert-style"  ><?php echo $this->session->flashdata('activation_sent');?></div>
            <?php } ?>
            <?php echo form_open("base/verify_activation/".$mode.'/'.$user_type);?>
            <div class="form-group">
               <label for="jobRegEmailMobile">Please check your <?php echo $mode;?> and enter the 6 digit activation code below</label>
               <?php echo form_input($verificationCode);?>
               <div class="alert alert-style" role="alert">
                  <?php echo form_error('verificationCode');?>
               </div>
            </div>
            <p><?php echo form_submit('submit', 'Activate',['value'=>'Activate','class'=>'btn btn-primary']);?></p>
            <?php echo form_close();?>
            <p class="not_recived">Not recieved ? <a href="<?php echo $this->config->item('base_url');?>base/resend_activation_code"> Resend activation code</a></p>
         </div>
      </div>
   </div>
</section>