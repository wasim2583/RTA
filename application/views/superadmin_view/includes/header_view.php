<!DOCTYPE html>
<html lang="en">
<head>
  <title>IRS</title>
  <link rel="icon" href="<?php echo $this->config->item('base_url');?>/design/images/IRS.png" type="image/gif" sizes="16x16">
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--
   Bootstrap css 
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
-->
   <!--  Style .css-->
  <!-- <link type="text/css" href="<?php // echo AM_CSS ;?>style.css" rel="stylesheet"> -->
  <link type="text/css" href="<?php echo base_url();?>admin_assets/css/style.css" rel="stylesheet">
    

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--Google Fonts CDN-->
<link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Poppins|Quattrocento+Sans|Josefin+Sans" rel="stylesheet">
<style>
.error{
	color: red;
	
}
.error1{
	border:1px solid red!important;
	
}
.input{
	border:1px solid red;
}</style>
<style>
.pagination li a{
	
      position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}
 .active a{
	background-color: #007bff!important;
    border-color: #007bff;
	color:white!important;
	
}
</style>
</head>
<body class="font3">
<!-- Header Start-->
  <div class="container-fluid no-padd">
    <nav class="navbar navbar-expand-md bg-light navbar-dark" style="    background: #4e596b !important;">
      <a class="navbar-brand" href="<?php echo base_url(); ?>">
        <i>
          <h1 style="color:white;"><u>I.R.S</u></h1>
        </i>
      </a>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <div class="offset-sm-10 col-sm-2">
          <div class="dropdown mr-auto">
            <button type="button" class="bg-secondary dropdown-toggle col-wh" data-toggle="dropdown">Admin<?php echo " - ".$state->state_name; ?></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo base_url();?>admin/change_password">Change Password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url();?>admin/logout"></i>Logout</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
<!--Header End-->