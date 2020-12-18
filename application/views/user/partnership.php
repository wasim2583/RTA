<!DOCTYPE html>
<html>
   <head>
      <title>RTA | Partnership</title>
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
               <span class="btm_text">Road safety Partnership</span>
               <div class="find-location">
                  <form action="" method="POST" enctype="multipart/form-data">
                     <div class="col-lg-12 col-md-12">
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Full Name</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>">
                           </div>
                           <div>
                              <?php echo form_error('full_name'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Organization Name</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="organization_name" id="organization_name" placeholder="Organization Name" value="<?php echo set_value('organization_name'); ?>">
                           </div>
                           <div>
                              <?php echo form_error('organization_name'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Organization Type</div>
                           <div class="col-lg-8">
                              <select class="state_select" name="organization_type" id="organization_type">
                                 <option value="">--Select Organization Type--</option>
                                 <?php
                                 if( ! empty($organization_types))
                                 {
                                    foreach($organization_types as $org_type)
                                    {
                                       ?>
                                 <option value="<?php echo $org_type->id ?>" <?php echo ($org_type->id == set_value('organization_type')) ? 'selected' : ''; ?>><?php echo $org_type->organization_type; ?></option>
                                       <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div>
                              <?php echo form_error('organization_type'); ?>
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
                           <div>
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
                           <div>
                              <?php echo form_error('location'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Mobile No</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile No" value="<?php echo set_value('mobile'); ?>">
                           </div>
                           <div>
                              <?php echo form_error('mobile'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Email Id</div>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="email" id="email" placeholder="Email ID" value="<?php echo set_value('email'); ?>">
                           </div>
                           <div>
                              <?php echo form_error('email'); ?>
                           </div>
                        </div>
                        <div class="row Member_labels">
                           <div class="col-lg-4 lableTxt">Upload Pic</div>
                           <div class="col-lg-8">
                              <div class="custom-file">
                                 <!-- <input type="file" class="custom-file-input" name="profile_pic" id="profile_pic"
                                    aria-describedby="inputGroupFileAddon01" value="<?php echo set_value('profile_pic'); ?>"> -->
                                 <input type="file" name="profile_pic" id="profile_pic" class="" value="<?php echo set_value('profile_pic'); ?>">
                                 <!-- <label class="custom-file-label" for="profile_pic">Choose file</label> -->
                              </div>
                           </div>
                        </div>
                        <!-- <button class="btn btn-primary btn_submit">Submit</button> -->
                        <input type="submit" value="Submit" class="btn btn-primary btn_submit">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script type="text/javascript" src="<?php echo base_url() ?>design/js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/rta_js.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
   <!-- Abhilash Code stars -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- Abhilash Code ends -->
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>