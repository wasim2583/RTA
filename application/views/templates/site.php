

<!DOCTYPE html>
<html>
   <head>
      <title>RTA</title>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>rta_assets/css/lightbox.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
      
   </head>
   <body>
      <!-- header starts -->
      <header>
         <div class="continer-fluid" style="display: none;">
            <div class="top-header">
               <div class="container">
               </div>
            </div>
         </div>
         <div class="continer-fluid">
            <div class="main-header">
               <div class="container">
                  <div class="row">
                     <div class="logo-wrp col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <img src="<?php echo base_url(); ?>design/images/IRS.png">
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h1 class="animateHead">
                           <a href="" class="typewrite" data-period="2000" data-type='[ "Fast drive could be last drive", "Wrong driving may stop your breathe and cause death", "Be sure to tie seat belt before driving the car", "Be sure to wear helmet before driving bike", "Roads are made to drive but not fly", "Be a driver not clever while driving" ]'>
                           <span class="wrap"></span>
                           </a>
                        </h1>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">
                        <button type="button" class="btn btn-sm btn-primary callBtn" onclick="location.href='<?php echo base_url(); ?>'"><?php echo $state->state_name; ?></button>
                        <a href="<?php echo base_url(); ?>user/Member"><button type="button" class="btn btn-sm btn-primary callBtn">Member</button></a>
                        <a href="<?php echo base_url(); ?>user/Partner"><button type="button" class="btn btn-sm btn-primary callBtn">Partner</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="continer-fluid">
            <div class="nav-wrapper">
               <div class="container">
                  <div class="row">
                     <ul class="nav nav-pills">
                        <li class="nav-item">
                           <a class="nav-link active" href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           Events
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="" target="_blank">Departmental</a></li>
                              <li><a class="dropdown-item" href="" target="_blank">Educational </a></li>
                              <li><a class="dropdown-item" href="" target="_blank">Institutions </a></li>
                              <li><a class="dropdown-item" href="" target="_blank">Corporates  </a></li>
                              <li><a class="dropdown-item" href="" target="_blank">Companies  </a></li>
                              <li><a class="dropdown-item" href="" target="_blank">Webinar’s  </a></li>
                           </ul>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="Galphotos.html" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           Gallery
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="<?php echo base_url().'Home/gallery_photos'; ?>" target="_self">Photos</a></li>
                              <li><a class="dropdown-item" href="<?php echo base_url().'Home/gallery_videos'; ?>" target="_self">Videos </a></li>
                           </ul>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           News
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="" target="_blank">Photos</a></li>
                              <li><a class="dropdown-item" href="" target="_blank">Videos </a></li>
                           </ul>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           Citizens
                           </a>
                           <?php
                              if($this->session->userdata('state_id') == 2)
                              {
                               ?>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="#">Licence </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/aadhaarseed" target="_blank">Aadhaar Seeding </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/applicationsearch" target="_blank">Aadhaar Seeding Search</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/dlmodule" target="_blank">Driving Licence (DL)</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/dlmerge" target="_blank">DL Merge</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/llrinstructions" target="_blank">Learner's Licence (LLR)</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/llrcancel" target="_blank">LLR Cancellation </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/llrcorrection" target="_blank">LLR Correction</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/llrmelainstructions" target="_blank">LLR Mela</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="#">Registraion </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/regaadhaarseed" target="_blank">Aadhaar Seeding</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/regapplicationsearch" target="_blank">Aadhaar Seeding Search</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/regbodybuilder" target="_blank">Body Builder</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/registrationmodule" target="_blank">Registration Services</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/regavailableslots" target="_blank">Vehicle Related Slot Booking</a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/vehicleRegistrationSearch" target="_blank">Vehicle Registration / DL Search</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="#">Permits </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/permits" target="_blank">Permit Services </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/tppassengerslist" target="_blank">Add Passengers </a></li>
                                 </ul>
                              </li>
                              <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/fitnessmodule" target="_blank">Fitness </a></li>
                              <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/representativeauthtype" target="_blank">Representative </a></li>
                              <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/taxation" target="_blank">Pay Tax </a></li>
                              <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/taxsearch" target="_blank">ARVT Module </a></li>
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="">Status  </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/appstatus" target="_blank">Driving Licence (DL) </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/hsrpstatus" target="_blank">HSRP  </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/regappstatus" target="_blank">Registration / Payment </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/applicationstatus" target="_blank">Application Payment Status </a></li>
                                 </ul>
                              </li>
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="#">Downloads </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/fitnesstatus" target="_blank">Fitness  </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/permitstatus" target="_blank"> Permit </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/taxationstatus" target="_blank">Tax Reciept </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/recommendationlettersearch" target="_blank">Recommendation Letter </a></li>
                                 </ul>
                              </li>
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="#">E-bidding </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/specialnumbersselection" target="_blank">e-Bidding </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/availableList" target="_blank">Available List </a></li>
                                    <li><a class="dropdown-item" href="https://aprtacitizen.epragathi.org/#!/leftoveravailableList" target="_blank"> Available Left Over Numbers List</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item dropdown-toggle" href="#">Other State Vehicles </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://parivahan.gov.in/rcdlstatus/?pur_cd=101" target="_blank">Driving licence search </a></li>
                                    <li><a class="dropdown-item" href="https://parivahan.gov.in/rcdlstatus/" target="_blank">Vehicle Details  </a></li>
                                 </ul>
                              </li>
                           </ul>
                           <?php
                              }
                              else
                              {
                               ?>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li class="dropdown-submenu">
                                 <a class="dropdown-item" href="#"> Under Development.. </a>
                              </li>
                           </ul>
                           <?php
                              }
                              ?>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Contact Us</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header ends -->
      <?php echo $content; ?>
      <footer>
         <div class="container">
            <div class="row">
               <div class="footer_logo col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  <img src="<?php echo base_url(); ?>design/images/IRS.png">
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                  <h3>Links</h3>
                  <ul>
                     <a href="">
                        <li>About Us</li>
                     </a>
                     <a href="">
                        <li>Events</li>
                     </a>
                     <a href="">
                        <li>Gallery</li>
                     </a>
                     <a href="">
                        <li>Promotions</li>
                     </a>
                  </ul>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                  <h3>Links</h3>
                  <ul>
                     <a href="">
                        <li>About Us</li>
                     </a>
                     <a href="">
                        <li>Events</li>
                     </a>
                     <a href="">
                        <li>Gallery</li>
                     </a>
                     <a href="">
                        <li>Promotions</li>
                     </a>
                  </ul>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <h3>Contact Us</h3>
                  <span>Motor Vehicles Inspector Association 
                  4-225/2, Makkevaripeta, <br>
                  Navuluru, Mangalagiri.<br>
                  Email: aptoamaravathi@gmail.com</span>
               </div>
            </div>
         </div>
         <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
      </footer>
   </body>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
   <!-- <script>
      setTimeout(function(){
         window.location.href = 'index.html';
      }, 25000);
      </script> -->
   <script type="text/javascript">
      var TxtType = function(el, toRotate, period) {
           this.toRotate = toRotate;
           this.el = el;
           this.loopNum = 0;
           this.period = parseInt(period, 10) || 2000;
           this.txt = '';
           this.tick();
           this.isDeleting = false;
       };
      
       TxtType.prototype.tick = function() {
           var i = this.loopNum % this.toRotate.length;
           var fullTxt = this.toRotate[i];
      
           if (this.isDeleting) {
           this.txt = fullTxt.substring(0, this.txt.length - 1);
           } else {
           this.txt = fullTxt.substring(0, this.txt.length + 1);
           }
      
           this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';
      
           var that = this;
           var delta = 200 - Math.random() * 100;
      
           if (this.isDeleting) { delta /= 2; }
      
           if (!this.isDeleting && this.txt === fullTxt) {
           delta = this.period;
           this.isDeleting = true;
           } else if (this.isDeleting && this.txt === '') {
           this.isDeleting = false;
           this.loopNum++;
           delta = 500;
           }
      
           setTimeout(function() {
           that.tick();
           }, delta);
       };
      
       window.onload = function() {
           var elements = document.getElementsByClassName('typewrite');
           for (var i=0; i<elements.length; i++) {
               var toRotate = elements[i].getAttribute('data-type');
               var period = elements[i].getAttribute('data-period');
               if (toRotate) {
                 new TxtType(elements[i], JSON.parse(toRotate), period);
               }
           }
           // INJECT CSS
           var css = document.createElement("style");
           css.type = "text/css";
           css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
           document.body.appendChild(css);
       };
   </script>
   <script>
      //Get the button
      var mybutton = document.getElementById("myBtn");
      
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {scrollFunction()};
      
      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      }
      
      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
   </script>
   <script>
      var slideIndex = 1;
      showSlides(slideIndex);
      
      function plusSlides(n) {
        showSlides(slideIndex += n);
      }
      
      function currentSlide(n) {
        showSlides(slideIndex = n);
      }
      
      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
      }
   </script>
   <script type="text/javascript">
      function animateValue(obj, start, end, duration) {
      let startTimestamp = null;
      const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      obj.innerHTML = Math.floor(progress * (end - start) + start);
      if (progress < 1) {
      window.requestAnimationFrame(step);
      }
      };
      window.requestAnimationFrame(step);
      }
      
      const obj = document.getElementById("value");
      animateValue(obj, 0, 10000, 6000);
      const obj1 = document.getElementById("value1");
      animateValue(obj1, 0, 10000, 6000);
      const obj2 = document.getElementById("value2");
      animateValue(obj2, 0, 70000, 7000);
      const obj3 = document.getElementById("value3");
      animateValue(obj3, 0, 1000, 3000);
   </script>
   <script type="text/javascript">
      $('.brand-carousel').owlCarousel({
      loop:true,
      margin:10,
      autoplay:true,
      responsive:{
      0:{
      items:1
      },
      600:{
      items:3
      },
      1000:{
      items:5
      }
      }
      }) 
      
   </script>
   <script type="text/javascript" src="<?php echo base_url(); ?>design/js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>rta_assets/js/rta_js.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>rta_assets/js/lightbox-plus-jquery.min.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>

