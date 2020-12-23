<!DOCTYPE html>
<html lang="en">
<head>
  <title>form page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--
   Bootstrap css 
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
-->
   <!--  Style .css-->
  <link type="text/css" href="css/style.css" rel="stylesheet">
    
<link rel="stylesheet" href="http://ksgrandprojects.com/assets/frontend/css/bootstrap.min.css">
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--Google Fonts CDN-->
<link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Poppins|Quattrocento+Sans|Josefin+Sans" rel="stylesheet">

</head>
<body class="font3">
<?php include('includes/header.php');?>
<!-- Menu Start-->
<section>
<div class="container-fluid no-padd">
<div class="row">
<?php include('includes/side-menu.php');?>
<div class="col-sm-10">
    <form>
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh40"> 
      <div class="row">
      <div class="col-sm-2">
    <h5 class="m-t-n6">Task</h5>   
      </div><div class="col-sm-10">
   <button type="button" class="btn btn-primary f14 no-bod-rad pull-right btn-sm m-t-n9"><i class="fa fa-plus"></i> &nbsp; Create &nbsp;</button>   
      </div>
          </div>
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
<h5>Start Stick inventory</h5>
     <div class="row" style="padding: 1px 40px">
<div class="form-group col-sm-4">
  <label for="usr">Start Gallons:</label>
  <input type="text" class="form-control no-bod-rad" id="usr">
</div>

<div class="form-group col-sm-4">
  <label for="usr">Gallons Purchased:</label>
  <input type="text" class="form-control no-bod-rad" id="usr">
</div>
         <div class="form-group col-sm-4">
  <label for="usr">Gallons Purchased:</label>
  <input type="text" class="form-control no-bod-rad" id="usr">
</div><div class="form-group col-sm-4">
  <label for="usr">Gallons Purchased:</label>
  <input type="text" class="form-control no-bod-rad" id="usr">
</div><div class="form-group col-sm-4">
  <label for="usr">Gallons Purchased:</label>
  <input type="text" class="form-control no-bod-rad" id="usr">
</div><div class="form-group col-sm-4">
  <label for="usr">Gallons Purchased:</label>
  <input type="text" class="form-control no-bod-rad" id="usr">
</div>

 </div> 
     <hr>
  <div class="clearfix">&nbsp;</div>
<h5>End Stick inventory</h5>
     <div class="row" style="padding: 1px 40px">
<div class="form-group col-sm-4">
  <label for="sel1">Gallons In:</label>
  <select class="form-control no-bod-rad" id="sel1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>
<div class="form-group col-sm-4">
  <label for="sel1">two</label>
  <select class="form-control no-bod-rad" id="sel1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>
         <div class="form-group col-sm-4">
  <label for="sel1">two</label>
  <select class="form-control no-bod-rad" id="sel1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>
     


   </div>
     <hr>

   
     <div class="row" style="padding: 1px 40px">
    <div class="form-group col-sm-8 offset-sm-2">
  <label for="comment">Described Required action taken(i.e. Inspection / Repairs / Test , etc..)</label>
  <textarea class="form-control" rows="3" id="comment"></textarea>
    </div>
 </div>
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <button type="button" class="btn btn-info no-bod-rad"> &nbsp; &nbsp; ADD &nbsp; &nbsp; </button>    
       <button type="button" class="btn btn-purple no-bod-rad"> &nbsp; &nbsp; CLEAR &nbsp; &nbsp; </button>    
      
        <div class="clearfix">&nbsp;</div> 
        </div>
        </div>

</div>
    
</div> </form>
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


