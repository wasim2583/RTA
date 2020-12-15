<!DOCTYPE html>
<html>
   <head>
      <title>RTA</title>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
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
                     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h1 class="animateHead">
                           <a href="" class="typewrite" data-period="2000" data-type='[ "Fast drive could be last drive", "Wrong driving may stop your breathe and cause death", "Be sure to tie seat belt before driving the car", "Be sure to wear helmet before driving bike", "Roads are made to drive but not fly", "Be a driver not clever while driving" ]'>
                           <span class="wrap"></span>
                           </a>
                        </h1>
                     </div>
                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right">
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
                        <li class="nav-item">
                           <a class="nav-link" href="#">Gallery</a>
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