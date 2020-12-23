<!DOCTYPE html>
<html lang="en">
   <head>
      <title>RTA</title>
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
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="location_filters">
                     <h3>Filter By</h3>
                     <form id="location_filters_form" >
                        <div class="accordion" id="accordionExample">
                           <div class="card">
                              <div class="card-header" id="headingSecond">
                                 <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSecond" aria-expanded="false" aria-controls="collapseSecond">
                                    State
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseSecond" class="collapse" aria-labelledby="headingSecond" data-parent="#accordionExample" style="">
                                 <div class="card-body" id="states_list">
                                    <?php
                                    foreach($states as $state)
                                    {
                                       /*
                                       if($this->session->userdata('app_state') == $state->id)
                                          $checked = 'checked';
                                       else
                                          $checked = '';
                                       */
                                       ?>
                                    <div class="tt-colapse-Inwrap">
                                       <input type="checkbox" name="states[]" id="<?php echo $state->id;?>" value="<?php echo $state->id;?>" <?php // echo $checked; ?>>
                                       <label><?php echo $state->state_name;?></label>
                                       <span class="badge badge-secondary badge-pill float-right"></span>
                                    </div>
                                       <?php
                                    }
                                    ?>     
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header" id="headingOne">
                                 <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Location
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                                 <div id="locations_message">please select state to load locations</div>
                                 <div class="card-body" id="locations_list">
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div>
                                 <label>From Date:</label>
                                 <input type="date" name="from_date" id="from_date">
                              </div>
                              <div>
                                 <label>To Date:</label>
                                 <input type="date" name="to_date" id="to_date">
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <!--    slider start-->
                  <div class="col-sm-9">
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
                              <div class="col-sm-12" id="Matched_photos">
                                 <div class="row">
                                    <?php  foreach($row as $rec){?>
                                    <div class="col-sm-4 posRelate">
                                       <div class="overflow_hide">
                                          <a href="<?php echo base_url().'uploads/files/'.$rec['file_name']; ?>" data-lightbox="gallery" target="_blank">
                                          <img src="<?php echo base_url().'uploads/files/'.$rec['file_name']; ?>" class="img-fluid">
                                          </a>
                                       </div>
                                       <span class="gal_btmtext"><?php echo ucfirst($rec['name']);?></span>
                                    </div>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="videos" class="container tab-pane fade">
                        <!--
                           <div class="col-sm-12">
                              <br>
                              <br>
                              <div class="separator-or"><span>&nbsp; Videos &nbsp;</span></div>
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
                        -->
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
      <script src="<?php echo base_url();?>rta_assets/js/rta_js.js"></script>
   </body>
</html>