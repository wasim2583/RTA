<!DOCTYPE html>
<html>
   <head>
      <title><?php echo empty($title) ? 'IRSC' : $title; ?></title>
      <link rel="icon" href="<?php echo $this->config->item('base_url');?>/design/images/IRS.png" type="image/gif" sizes="16x16">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <!--  <script>
         setTimeout(function(){
            window.location.href = 'main.html';
         }, 25000);
         </script> -->
   </head>
   <body class="load_wrap member">
      <div class="container-fluid">
         <div class="row text-center">
            <div class="col-lg-4 col-md-4  offset-lg-4">
               <a href="<?php echo base_url(); ?>Home/home"><img src="<?php echo base_url(); ?>design/images/IRS.png" class="imgWrap1"></a>
               <span class="btm_text">Indian Road Safety Club Membership</span>
               <div class="find-location">
                  <form action="<?php echo base_url(); ?>user/Member/registration" method="POST" enctype="multipart/form-data">
                     <div class="col-lg-12 col-md-12">
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Full Name</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>">
                           </div>
                           <div class="error_alert">
                              <?php echo form_error('full_name'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">State</div>
                           <div class="col-lg-8">
                              <select class="state_select" name="state" id="state">
                                 <option value="0">Select Your State</option>
                                 <?php
                                 if( ! empty($states))
                                 {
                                    foreach($states as $state)
                                    {
                                       ?>
                                 <option value="<?php echo $state->id ?>" <?php echo ($state->id == set_value('state')) ? 'selected' : ''; ?>><?php echo $state->state_name; ?></option>
                                       <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="error_alert">
                              <?php echo form_error('state'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Location</div>
                           <div class="col-lg-8">
                              <select class="state_select" name="location" id="location">
                                 <option value="">Select Your Location</option>
                              </select>
                           </div>
                           <div class="error_alert">
                              <?php echo form_error('location'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Mobile No</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile No" value="<?php echo set_value('mobile'); ?>">
                           </div>
                           <div class="error_alert">
                              <?php echo form_error('mobile'); ?>
                           </div>
                        </div>
                        <!-- <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Email Id</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="email" id="email" placeholder="Email ID" value="<?php //echo set_value('email'); ?>">
                           </div>
                           <div>
                              <?php //echo form_error('email'); ?>
                           </div>
                        </div> -->
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Password</div>
                           <div class="col-lg-8">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                           </div>
                           <div class="error_alert">
                              <?php echo form_error('password'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Confirm Password</div>
                           <div class="col-lg-8">
                              <input type="password" class="form-control" name="cnfpwd" id="cnfpwd" placeholder="Confirm Password">
                           </div>
                           <div class="error_alert">
                              <?php echo form_error('cnfpwd'); ?>
                           </div>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-primary btn_submit">
                     </div>
                  </form>
                  <div class="Reg_link"><span>Already Registered? </span><a href="<?php echo base_url().'user/Member/login'; ?>">Login</a></div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script type="text/javascript" src="<?php echo base_url(); ?>design/js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>rta_assets/js/rta_js.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>