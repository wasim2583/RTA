<!DOCTYPE html>
<html>
   <head>
      <title>RTA | Membership</title>
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
               <span class="btm_text">Road safety Membership</span>
               <div class="find-location">
                  <table class="table table-sm">
                     <thead>
                        <tr>
                           <th scope="col" colspan="2">Member Profile</th>
                           <th scope="col" colspan="2"><img src="<?php echo base_url(); ?>rta_assets/profile_pics/<?php echo $member->profile_pic; ?>" height="100"></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row">Name</th>
                           <td><?php echo $member->full_name; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Location</th>
                           <td><?php echo $member->location_name; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">State</th>
                           <td><?php echo $member->state_name; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Mobile</th>
                           <td><?php echo $member->mobile; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Email</th>
                           <td><?php echo $member->email; ?></td>
                        </tr>
                     </tbody>
                  </table>
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