<!DOCTYPE html>
<html>
   <head>
      <title>IRS</title>
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
   <body class="load_wrap">
      <div class="container-fluid">
         <div class="row text-center">
            
            <div class="col-lg-10 col-md-10  offset-lg-1">
               <div class="popOver"><img src="<?php echo base_url(); ?>design/images/IRS.png" class="imgWrap1"></div>
               <span class="btm_text blinking">WELCOME TO INDIAN ROAD SAFETY CLUB</span>
               
               <div class="state_Loc_wrap">
                  <?php
                  foreach($states as $state)
                  {
                     ?>
                  <a href="<?php echo base_url().'Home/home/'.$state->id; ?>">
                     <div class="Inn_wrap">
                        <img src="<?php echo base_url().'rta_assets/state_images/'.$state->image; ?>">
                        <span><?php echo $state->state_name; ?></span>
                     </div>
                  </a>
                     <?php
                  }
                  ?>
               </div>
            </div>
            
         </div>
      </div>

   </body>
   
  

 
   <script type="text/javascript" src="<?php echo base_url(); ?>design/js/bootstrap.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
         
</html>