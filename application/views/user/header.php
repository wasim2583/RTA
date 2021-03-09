<!DOCTYPE html>
<html lang="en">
  <head>
    <title>IRS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url();?>rta_assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=NTR" rel="stylesheet">
    <link href="<?php echo base_url();?>rta_assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  </head>
  <body style="font-family: 'NTR', sans-serif;">
    <div class="container">
      
      <header>
        <div class="contianer-fluid">
          <div class="container logo-sec">
            <div class="row">
              <div class="col-sm-5 no-pad logo col-6"><a href="<?php echo HTTP_BASE_PATH;?>">
                <img src="<?php echo base_url();?>rta_assets/images/logo-new.png" alt="logo" class="img-responsive rentlogo d-none d-sm-block">
                <img src="<?php echo base_url();?>rta_assets/images/logoxs.png" alt="logo" class="img-responsive rentlogo d-block d-sm-none">
                </a>
              </div>
              <div class="col-sm-2 offset-sm-2 col-6">
                <span class="pull-right mt-4"> <span class="pull-left" style="margin-top: 3px;">Get our App on &nbsp; </span> <img src="<?php echo base_url();?>rta_assets/images/playstore.png" alt="playstore" class="img-responsive"> </span>
              </div>
              <div class="col-sm-3">
                <?php
                  if( ! empty($this->session->userdata('app_state')))
                  {
                    ?>
                <button class="btn btn-sm offset-sm-4 btn-success top20" onclick="location.href='<?php echo base_url().'select_state'; ?>'"><?php echo $state->state_name; ?></button>
                <?php
                  }
                  else
                  {
                    ?>
                <button class="btn btn-sm offset-sm-4 btn-warning top20" onclick="location.href='<?php echo base_url().'select_state'; ?>'">Select State</button>
                <?php
                  }
                  ?>
                <?php
                  if( ! empty($this->session->userdata('admin_id')))
                  {
                    ?>
                <div class="dropdown float-right top20">
                  <button type="button" class="btn btn-sm btn-secondary bg-secondary dropdown-toggle float-right" data-toggle="dropdown">Admin</button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo HTTP_BASE_PATH;?>admin/users/user_information">Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo HTTP_BASE_PATH;?>admin/logout"></i>Logout</a>
                  </div>
                </div>
                <?php
                  }
                  else
                  {
                    ?>
                <button class="btn btn-sm btn-primary top20 float-right" onclick="location.href='<?php echo HTTP_BASE_PATH;?>admin'">Login</button>
                <?php
                  }
                  ?>        
              </div>
            </div>
          </div>
        </div>
        <!--menu part start-->
        <nav class="navbar navbar-expand-md bg-site navbar-dark menu">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menucollapse">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="menucollapse">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo HTTP_BASE_PATH;?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo HTTP_BASE_PATH;?>front/about_us">About Us</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_data">Gallery</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li class="dropdown-submenu">
                    <a class="dropdown-item" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_photos">Photos </a>
                  </li>
                  <li class="dropdown-submenu">
                    <a class="dropdown-item" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_videos">Videos </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <!-- <a class="nav-link" href="<?php echo HTTP_BASE_PATH;?>front/Events">Events</a> -->
                <!-- <a class="nav-link" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_data">Events</a> -->
                <a class="nav-link" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_data">News</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li class="dropdown-submenu">
                    <a class="dropdown-item" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_photos">Photos </a>
                  </li>
                  <li class="dropdown-submenu">
                    <a class="dropdown-item" href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_videos">Videos </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Citizens
                </a>
                <?php
                  if($this->config->item('default_state_id') == $this->session->userdata('app_state'))
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
                    <a class="dropdown-item dropdown-toggle" href="#"> Services </a>
                    <!-- <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#"> Coming soon.. </a></li>
                      </ul> -->
                  </li>
                </ul>
                <?php
                  }
                  ?>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo HTTP_BASE_PATH;?>front/Contact_us">Contact Us</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>