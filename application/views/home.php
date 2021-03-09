<!DOCTYPE html>
<html lang="en">
<head>
  <title>IRS</title>
  <link rel="icon" href="<?php echo $this->config->item('base_url');?>/design/images/IRS.png" type="image/gif" sizes="16x16">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url();?>rta_assets/css/style.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=NTR" rel="stylesheet">
  <link href="<?php echo base_url();?>rta_assets/css/animate.css" rel="stylesheet" type="text/css">
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
 
</head>

<body style="font-family: 'NTR', sans-serif;">

  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Subscribe our Newsletter</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>
          <form>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Email Address">
            </div>
            <button type="submit" class="btn btn-primary">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <header>
  <?php $this->load->view('front_view/includes/header'); ?>
<!--menu part end-->
</header>
<!--Banner Section Start-->
<section>
 <div class="container-fluid d-block d-sm-none no-padd moblie_slide">
 <div id="moblie_slide" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#moblie_slide" data-slide-to="0" class="active"></li>
    <li data-target="#moblie_slide" data-slide-to="1"></li>
    <li data-target="#moblie_slide" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
       <?php 
      $i=1;
      foreach($row as $rec){
      ?>
    <div class="carousel-item <?php if($i==1){echo 'active';} ?>">
         <img src="<?php echo HTTP_BASE_PATH;?>uploads/slider/<?php echo $rec->slider_img;?>" class="img-fluid" alt="image1" title="image1">
    </div>
      	   <?php 
          $i++;
      } ?>
<!--
    <div class="carousel-item">
      <img src="<?php echo base_url();?>rta_assets/images/third.jpg" alt="img2" class="img-fluid">
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url();?>rta_assets/images/four.jpeg" alt="img3" class="img-fluid">
    </div>
-->
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#moblie_slide" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#moblie_slide" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
 </div>
<div class="contianer-fluid no-padd d-none d-sm-block">
  <div class="slider" style="padding:0px">
       <ul class="slider-main">
          <?php foreach($row as $rec){?>
           <li>
               <img src="<?php echo HTTP_BASE_PATH;?>uploads/slider/<?php echo $rec->slider_img;?>" class="img-fluid" alt="image1" title="image1" style="width:100%;height:500px">
           </li>
	   <?php } ?>
           
       </ul>
   </div>
</div>
 </section>
<!--Banner Section End-->
<!--our app features start-->
    <section>
    <div class="container-fluid">
      <div class="container ourapp">
       <div class="row">
        <div class="col-sm-6 col-12">
          <h2 class="mb-5 mt-3"><span class="b-b"> Our App Features</span></h2>

            <div class="row">
<!--1 start-->
        <div class="col-sm-6 col-12">
             <div class="row">
          <div class="col-sm-12 col-12 mar-adj">
            <div class="row">
          <div class="col-sm-4 col-4">
            <img src="<?php echo base_url();?>rta_assets/images/add-post.png" class="img-fluid">
          </div>
          <div class="col-sm-8 col-8 b-l">
               <h4>Add Posts</h4>
            </div>
            </div>
                 </div>
              </div>
            </div>
<!--1 end-->
<!--2 start-->
            <div class="col-sm-6 col-12">
             <div class="row">
          <div class="col-sm-12 col-12 mar-adj">
            <div class="row">
          <div class="col-sm-4 col-4">
            <img src="<?php echo base_url();?>rta_assets/images/contacts.png" class="img-fluid">
          </div>
          <div class="col-sm-8 col-8 b-l">
               <h4>Contacts</h4>
            </div>
            </div>
                 </div>
              </div>
            </div>
<!--2 end-->
<!--3 start-->
            <div class="col-sm-6 col-12">
             <div class="row">
          <div class="col-sm-12 col-12 mar-adj">
            <div class="row">
          <div class="col-sm-4 col-4">
            <img src="<?php echo base_url();?>rta_assets/images/create-group.png" class="img-fluid">
          </div>
          <div class="col-sm-8 col-8 b-l">
               <h4>Create groups</h4>
            </div>
            </div>
                 </div>
              </div>
            </div>
<!--3 end-->
<!--4 start-->
            <div class="col-sm-6 col-12">
             <div class="row">
          <div class="col-sm-12 col-12 mar-adj">
            <div class="row">
          <div class="col-sm-4 col-4">
            <img src="<?php echo base_url();?>rta_assets/images/write-a-note.png" class="img-fluid">
          </div>
          <div class="col-sm-8 col-8 b-l">
               <h4>Dairy</h4>
            </div>
            </div>
                 </div>
              </div>
            </div>
<!--4 end-->
<!--5 start-->
            <div class="col-sm-6 col-12">
             <div class="row">
          <div class="col-sm-12 col-12 mar-adj">
            <div class="row">
          <div class="col-sm-4 col-4">
            <img src="<?php echo base_url();?>rta_assets/images/photos.png" class="img-fluid">
          </div>
          <div class="col-sm-8 col-8 b-l">
                 <a href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_data" style="color: #272b2f;">
               <h4>Photos</h4>
              </a>
            </div>
            </div>
                 </div>
              </div>
            </div>
<!--5 end-->
<!--6 start-->
            <div class="col-sm-6 col-12">
             <div class="row">
          <div class="col-sm-12 col-12 mar-adj">
            <div class="row">
                
          <div class="col-sm-4 col-4">
            <img src="<?php echo base_url();?>rta_assets/images/videos.png" class="img-fluid">
          </div>
          <div class="col-sm-8 col-8 b-l">
              <a href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_data" style="color: #272b2f;">
               <h4>Videos</h4>
                    </a>
            </div>
                  
            </div>
                 </div>
              </div>
            </div>
<!--6 end-->
                </div>
           </div>
        <div class="col-sm-6">
           <img src="<?php echo base_url();?>rta_assets/images/mobiles.png" class="img-fluid mt-5 mb-5">
           </div>
          </div>
        </div>
        </div>
    </section>
<!--our app features end-->
<!--footer section start-->
 <footer class="footer">
  <?php $this->load->view('front_view/includes/footer'); ?>

    </footer>
<!--footer section end-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>rta_assets/js/osSlider.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#myModal").modal('show');
    });
    var slider = new osSlider({
        pNode:'.slider',
        cNode:'.slider-main li',
        autoPlay:true
    });
</script>
</body>
</html>
