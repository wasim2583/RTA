<!DOCTYPE html>
<html lang="en">
   <head>
      <title>IRS</title>
      <link rel="icon" href="<?php echo $this->config->item('base_url');?>/design/images/IRS.png" type="image/gif" sizes="16x16">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="<?php echo base_url();?>rta_assets/css/style.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>rta_assets/css/lightbox.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=NTR" rel="stylesheet">
      <link href="<?php echo base_url();?>rta_assets/css/animate.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
   </head>
   <body style="font-family: 'NTR', sans-serif;">
      <header>
         <?php $this->load->view('front_view/includes/header'); ?>
      </header>
      <!--Banner Section Start-->
      <section>
         <div class="container-fluid gallery-bg no-padd">
            <div class="overlay">
               <div class="container">
                  <h1 class="text-center subtitle">Gallery</h1>
               </div>
            </div>
         </div>
      </section>
      <!--Banner Section End-->
      <!--gallery start-->
      <section>
         <div class="container-fluid bg-light">
            <div class="container">
               <div class="row">
                  <!--    slider start-->
                  <div class="col-sm-12">
                     <ul class="nav nav-tabs justify-content-center text-center" role="tablist" style="display: none;">
                        <li class="nav-item col-sm-2 no-padd">
                           <a class="nav-link active" data-toggle="tab" href="#photos">
                              <h4>Photos</h4>
                           </a>
                        </li>
                        <li class="nav-item col-sm-2 no-padd">
                           <a class="nav-link" data-toggle="tab" href="#videos">
                              <h4>Videos</h4>
                           </a>
                        </li>
                     </ul>
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div id="photos" class="container tab-pane active">
                           <div class="col-sm-12 gallery">
                              <br>
                              <br>
                              <div class="separator-or"><span>&nbsp; Photos &nbsp;</span></div>
                              <div class="row">
                                 <?php  foreach($row as $rec){?>
                                 <div class="col-sm-4 posRelate">
                                    <div class="overflow_hide">
                                       <a href="<?php echo base_url().'uploads/files/'.$rec['file_name']; ?>" data-lightbox="gallery" target="_blank">
                                       <img src="<?php echo base_url().'uploads/files/'.$rec['file_name']; ?>" class="img-fluid">
                                       </a>
                                    </div>
                                    <span class="gal_btmtext"><?php echo ucfirst($rec['description']);?></span>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                        <div id="videos" class="container tab-pane fade">
                          <br>
                              <br>
                              <div class="separator-or"><span>&nbsp; Videos &nbsp;</span></div>
                           <div class="col-sm-12">
                              <div class="row">
                                 <?php  foreach($videos as $rec1){?>
                                 <div class="col-sm-4">
                                    <?php $url=$rec1['url'];
                                       $ytarray=explode("/", $url);
                                       $ytendstring=end($ytarray);
                                       $ytendarray=explode("?v=", $ytendstring);
                                       $ytendstring=end($ytendarray);
                                       $ytendarray=explode("&", $ytendstring);
                                       $ytcode=$ytendarray[0];?>
                                    <?php echo "<iframe width=\"100%\"  src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";?>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="clearfix">&nbsp;</div>
               <div class="clearfix">&nbsp;</div>
            </div>
         </div>
      </section>
      <!--gallery end-->
      <!--footer section start-->
      <footer class="footer">
         <?php $this->load->view('front_view/includes/footer'); ?>
      </footer>
      <!--footer section end-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url();?>rta_assets/js/lightbox-plus-jquery.min.js"></script>
   </body>
</html>