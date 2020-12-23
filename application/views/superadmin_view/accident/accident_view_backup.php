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
<div class="row">
<div class="col-sm-8 offset-sm-2">
    <form method="post" action=""  >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">
<div class="col-sm-12 border inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
<h4 class="offset-sm-3 doc-head"><span class="bt-fm"> ACCIDENT INSPECTION REPORT</span></h4>
       <div class="clearfix">&nbsp;</div>      
<p class="fm-sz"> I <span class="bt-fm">&emsp; <?php echo ucfirst($accident_info[0]->name); ?> &emsp; </span> MVI, NELLORE received requisition on Dt. <span class="bt-fm"> &emsp; <?php $originalDate =$accident_info[0]->requisation_date;$newDate = date("d-m-Y", strtotime($originalDate));  echo $newDate;?> &emsp; </span> from SHOPS Kollur to inspect the vehicle bearing Reg.No <span>12345 </span> which involved in an accident vide cr.No. <span class="bt-fm"> &emsp; <?php echo $accident_info[0]->crn_number;?> &emsp; </span> u/s 304(A)&amp; 338 of Kollur P.S</p>
<p class="fm-sz"> I inspected the crime vehicle in the premises/near<span class="bt-fm"> &emsp; <?php echo $accident_info[0]->ps;?> &emsp; </span> PS <span class="bt-fm"> &emsp; <?php echo $accident_info[0]->offence_location;?> &emsp; </span> /at scene of offence/near <span class="bt-fm"> &emsp; <?php echo $accident_info[0]->offence_time;?> &emsp; </span> on Dt<span class="bt-fm"> &emsp; <?php $originalDate1=$accident_info[0]->offence_date;$newDate1 = date("d-m-Y", strtotime($originalDate1));  echo $newDate1;?> &emsp; </span> and found the fallowing damages. </p>
    <?php
        $k = 1;
        foreach($accident_info as $info)
        {
          ?>
  <div class="col-sm-12">
    <p class="fs16"><?php echo $k; ?>. <?php echo $info->damage; ?></p>   
</div>
    <?php
          $k++;
        }
        ?>    
 
        
  
 <div class="clear"></div>
          <div class="col-sm-12">
    <p class="fs16"><b>ROAD TEST CONDUCTED</b></p>
        </div>
          <div class="col-sm-12">
    <p class="fs16"><b>YES/NO</b></p>
        </div>
          <div class="col-sm-12">
    <p class="fs16"><b>If YES;</b></p>
        </div>
        <div class="col-sm-12">
    <p class="fm-sz">Tested the vehicle and conducted the Road test and found the brakes are in good working condition and even in action</p>
        </div>
        <div class="col-sm-12">
    <p class="fm-sz"><b>If NO;</b></p>
        </div>
        <div class="col-sm-12">
    <p class="fm-sz">Due to above damages the vehicle couldn't put for road test. How ever inspected the Brake system and found in tact.</p>
        </div>
      <div class="col-sm-12">
    <p class="fm-sz"><b>OPINION;</b></p>
        </div>
      <div class="col-sm-12">
    <p class="fm-sz">I am of the opinion that the accident occurred was not due to any mechanical defects of the vehicle <span class="bt-fm"> &emsp; <?php echo $accident_info[0]->opinion;?>  &emsp; </span></p>
        </div>
<!--
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" class="btn btn-info no-bod-rad"  name="submit" onClick="return validate_form();"  value="CHANGE"> 
	 <a href="<?php echo HTTP_BASE_PATH;?>admin/change_password" class="btn btn-info no-bod-rad" style="color:#fff" > RESET</a>

        <div class="clearfix">&nbsp;</div> 
        </div>
-->
        </div>
  </div>
</div>
    </div>
            
        </div> 
         </form>  
</div>
    </div>
    </div>
</section>
<!-- Menu End-->
<!--Footer Scripts Start-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


<!--Footer Scripts End-->



</body>
</html>


