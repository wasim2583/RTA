<?php 
//$email=$this->session->userdata('admin_email');
//if(empty($email)){
 // redirect('admin');}?>
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
<?php $this->load->view('superadmin_view/includes/header_view');?>
<!-- Menu Start-->
<section>
<div class="container-fluid no-padd">
<div class="row">
<?php $this->load->view('superadmin_view/includes/sidebar_view');?>
<div class="col-sm-10"><?php //$s=$this->uri->segment(4);?>
    <form method="post" action="<?php echo base_url(); ?>add_team" enctype="multipart/form-data" onsubmit=" return validate_care();">
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
   
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Add Team</h5> 
    <a href="<?php echo base_url().'superadmin/team_ctrl/team_information'?>" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manage_team" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Team</a>
    <?php
		$msg=$this->session->flashdata('msg');
        if(!empty($msg))
        {
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong class="<?php echo $this->session->flashdata('text_color'); ?>text-center"></strong><?php echo $msg; ?>
          </div>
          <?php
        }
        ?>

        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div>
  <div class="row">
  <div class="form-group col-sm-6">
  <label for="usr">Name:</label>
  <input type="text"  id="name" name="name" value="<?php echo set_value('name');?>" <?php if(form_error('name')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
  <?php echo form_error('name', '<span  class="error ">','</span>');?> <span class="" id="name_err" style="color:red"></span>
</div>

<div class="form-group col-sm-6">
  <label for="usr">Photo:  (only jpg,png & jpeg allow)</label>
  <input type="file" id="photo" name="photo" value="<?php echo set_value('photo');?>" <?php if(form_error('photo')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" accept="image/jpg,image/jpeg,image/png" >
  <?php echo form_error('photo', '<span  class="error ">','</span>');?><span class="" id="photo_err" style="color:red"></span>
</div>

<div class="form-group col-sm-6">
  <label for="usr">Mobile:</label>

  <input type="text" maxlength="10" id="mobile" name="mobile" value="<?php echo set_value('mobile');?>" <?php if(form_error('mobile')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" >
  <?php echo form_error('mobile', '<span  class="error ">','</span>');?><span class="" id="mobile_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Designation:</label>
 
  <input type="text"  id="designation" name="designation" value="<?php echo set_value('designation');?>" <?php if(form_error('designation')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad">
  <?php echo form_error('designation', '<span  class="error ">','</span>');?><span class="" id="designation_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Message:</label>
 
  <input type="text" id="message" name="message" value="<?php echo set_value('message');?>" <?php if(form_error('message')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" >
  <?php echo form_error('message', '<span  class="error ">','</span>');?><span class="" id="message_err" style="color:red"></span>
	</div>
</div>
</div>
 
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" name="submit" id="submit" class="btn btn-info no-bod-rad" value="ADD" > 
	 <input type="reset" class="btn btn-info no-bod-rad"   value="RESET"> 

      <!-- <button type="submit" class="btn btn-purple no-bod-rad"> &nbsp; &nbsp; CLEAR &nbsp; &nbsp; </button>  -->  
      
        <div class="clearfix">&nbsp;</div> 
        </div>
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
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!--Footer Scripts End-->


</body>
</html>


<script>
function validate_care(){
	//alert("hi");
	var name=$('#name').val();
	var photo=$('#photo').val();
 	var mobile=$('#mobile').val();
  var designation=$('#designation').val();
  var message=$('#message').val();
 	var flag = true;
 	//$("#name,#photo,#mobile,#designation,#message").css("border","");
	 //$("#name_err,photo_err,#mobile_err,,#designation_err,#message_err").html("");alert("hi");
	if(name == "")
 	{
  	flag = false;
  	$("#name_err").html("Please enter Name ");
  	$("#name").css("border","1px solid red");
  }
  else
  {
		var regEx = /^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/;
		var vname=regEx.test(name);
		if(!vname)
    {
  		flag = false;//alert("wrong");
  		$("#name_err").html("Please enter valid Name");
  		$("#name").css("border","1px solid red");	
    }
  }
  if(photo == "")
  { 
  	flag = false;
  	$("#photo_err").html("Please select image");
  	$("#photo").css("border","1px solid red");
  }
  if(mobile == "")
  { 
	  flag = false;
	  $("#mobile_err").html("Please enter mobile number");
	  $("#mobile").css("border","1px solid red");
  }
  else
  {
		//alert(mobile.length);//die;var mobilepattern = /^[6-9]+[0-9]{9}$/;
		var mobilepattern = /^[6-9]+[0-9]{9}$/;
		var vmob=mobilepattern.test(mobile);
		if(!vmob)
    {
			//alert("hi");
			flag = false;
	    $("#mobile_err").html("Please enter valid mobile number ");
	    $("#mobile").css("border","1px solid red");
		}		
  } 
  if(designation == "")
  { 
	  flag = false;
	  $("#designation_err").html("Please enter your designation");
	  $("#designation").css("border","1px solid red");
  }
  else
  {
    var regEx = /^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/;
    var tdesignation=regEx.test(designation);
    if(!tdesignation)
    {
      flag = false;//alert("wrong");
      $("#designation_err").html("Please enter valid designation");
      $("#designation").css("border","1px solid red"); 
    }
 }
  if(message == "")
  { 
	  flag = false;
	  $("#message_err").html("Please enter some message");
	  $("#message").css("border","1px solid red");
  } 
return flag; 
}
</script>
<script>
function jkl(){
	alert("jkl");
}
</script>