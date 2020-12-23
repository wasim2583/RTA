<?php $accident_info=$data; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>I.R.S</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--
   Bootstrap css 
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
-->
   <!--  Style .css-->
  <link type="text/css" href="<?php echo AM_CSS ;?>style.css" rel="stylesheet">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--Google Fonts CDN-->
<link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Poppins|Quattrocento+Sans|Josefin+Sans" rel="stylesheet">
    
  <link href="https://fonts.googleapis.com/css?family=NTR" rel="stylesheet">

<style>
.error{color: red;}
.error1{border:1px solid red!important;} 
.fm-sz{    font-size: 15px;line-height: 32px;}
.fs16{    font-size: 15px;}
.bt-fm{border-bottom: 2px dotted #333;}
.input{border:1px solid red;}
.m-b-20{margin-bottom: 25px}
.clear{clear: both}
.doc-head{    margin-bottom: 40px; margin-top: 18px;}
</style>
</head>
    <body style="font-family: 'Poppins', sans-serif;">

<!-- Menu Start-->
<section>
<div class="container-fluid no-padd">
<div class="col-sm-8 offset-sm-2">
    <form method="post">
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">
<div class="col-sm-12 border inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
<h3 class="offset-sm-3 doc-head" align="center"><span class="bt-fm"> Without License letter to SHO</span></h3>
       <div class="clearfix">&nbsp;</div>  
<div class="col-sm-12">
    <p class="fs16">To</p>   
    <p class="fs16">The Station House Officer,</p>   
    <p class="fs16"><span class="bt-fm"><?php echo ucfirst($accident_info[0]->location); ?> &emsp; </span></p>   
</div>  
<div class="col-sm-12">
    <p class="fs16">Sir,</p>   
    <p class="fs16" style="margin-left: 6px;">Sub: &nbsp; Transport Department – Request for necessary action against for without Driving License cases U/s. 3 R/W 180 &amp; 181 of Motor Vehicles Act 1988 booked – Regarding. </p>   
</div>
        
  <div class="col-sm-10 offset-sm-1">
    <p class="fs16" style="margin-left: 6px;">Reg: &nbsp; 1) &nbsp; Memo No:1638/V3/2015, Dated 07.04.2015 issued by the Transport Commissioner, A.P, Hyderabad </p> 
    <p class="fs16"> &emsp; &emsp; 2) &nbsp; C.No.25/DTRB-NLR/2017 ,Dt: 15-05-2017 Issued by Superintendent Police, SPSR Nellore District. 
 </p> 
        </div>
<div style='text-align:center'><p>-o0o-</p></div>
        <p class="fs16">&emsp; &emsp; With reference to the above subject on &nbsp;<u><?php echo date('d-m-Y',strtotime($accident_info[0]->date));?></u>&nbsp; from <u><?php echo $accident_info[0]->from_hrs;?></u>hrs to <u><?php echo $accident_info[0]->to_hrs;?></u>hrs, I conducted vehicle checking at <u><?php echo $accident_info[0]->city;?></u> with my staff, while on our checking I found that the following driver/drivers are driving their vehicles without Driving License / without valid Driving License.</p>
        <div class="row"><div class="col-md-12">
        <table border='1' cellpadding='7' cellspacing='0' width="1000px;" class="fs16">
        <tr><th>Sl. No</th><th>Accused-1 (Driver) <br/>Name & Address</th><th>Accused-2 (Owner)<br/>Name & Address</th><th>Vehicle No</th><th>VCR No</th></tr>
        <?php
        $k = 1;
        foreach($accident_info as $info)
        {
          ?>
          <tr><td><?php echo $k; ?></td><td><?php echo $info->driver_details; ?></td><td><?php echo $info->owner_details; ?></td><td><?php echo $info->vehicle_number; ?></td><td><?php echo $info->vcr_number; ?></td></tr>
          <?php
          $k++;
        }
        ?>
        </table>  
      </div></div>
        <br/><br/>
        <div class="fs16">&nbsp;&nbsp;&nbsp; &emsp; &emsp; Therefore I request you to launch prosecution as per Law U/s. 3 R/W 180 & 181 of Motor Vehicles Act 1988.</div><br/>
        <div class="fs16">&nbsp;Thanking you Sir,</div>
        <div align="right" class="fs16">Yours sincerely,</div>
  