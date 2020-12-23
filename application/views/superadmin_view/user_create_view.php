<?php 
$email=$this->session->userdata('admin_email');
if(empty($email)){
  redirect('admin');}
  ?>
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
<div class="col-sm-10"><?php $s=$this->uri->segment(4);?>
    <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/users/insert_user" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
   
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Add User</h5> 
    <button type="submit" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manageusers" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Users</button>	
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div>
  <div class="row">
  <div class="form-group col-sm-6">
  <label for="usr">User Name:</label>
  <input type="text"  value="<?php echo set_value('name');?>" <?php if(form_error('name')!=""){echo "class='error1 form-control input-md'";}?>  class="form-control no-bod-rad" id="name" name="name"  >
  <span class="" id="name_err" style="color:red"></span> <?php echo form_error('name', '<span  class="error ">','</span>');?>
</div>
  <div class="form-group col-sm-6">
  <label for="usr">User Mobile:</label>
  <input type="text"  id="mobile" name="mobile" value="<?php echo set_value('mobile');?>" <?php if(form_error('mobile')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
  <?php echo form_error('mobile', '<span  class="error ">','</span>');?> <span class="" id="mobile_err" style="color:red"></span>
</div>

   	<div class="form-group col-sm-6">
  <label for="usr">User Location:</label>
 
  <input type="text" maxlength="10"  value="<?php echo set_value('location');?>" <?php if(form_error('location')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" id="location" name="location"  max="10" >
  <?php echo form_error('location', '<span  class="error ">','</span>');?><span class="" id="location_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">User Designation:</label>
  <input type="text"  value="<?php echo set_value('designation');?>" <?php if(form_error('designation')!=""){echo "class='error1 form-control input-md'";}?>  class="form-control no-bod-rad" id="designation" name="designation"  >
  <span class="" id="designation_err" style="color:red"></span> <?php echo form_error('designation', '<span  class="error ">','</span>');?>
</div>
<div class="form-group col-sm-6">
  <label for="usr">User Password:</label>
  <input type="text"  value="123123" <?php if(form_error('password')!=""){echo "class='error1 form-control input-md'";}?>  class="form-control no-bod-rad" id="password" name="password" readonly >
  <span class="" id="password_err" style="color:red"></span> <?php echo form_error('password', '<span  class="error ">','</span>');?>
</div>

        </div>
 
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" class="btn btn-info no-bod-rad" onClick="return validate_user();"  value="ADD"> 
	 <a href="<?php echo HTTP_BASE_PATH;?>admin/employees/add_employee" class="btn btn-info no-bod-rad" style="color:#fff" > RESET</a>

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

<script>
/*$(document).ready(function () {
$(function() {
  $( "#dob" ).datepicker({  maxDate: new Date() });
});});*/
function validate_user(){
	//alert("hi");
	var name=$('#name').val();
	var mobile=$('#mobile').val();
 var location=$('#location').val();//alert(pwd);die;mobile
 var designation=$('#designation').val();
 var password=$('#password').val();
 var flag = true;
 $("#name,#mobile,#location,#designation,#password").css("border","");
 $("#name_err,#mobile_err,#location_err,#designation_err,#password_err").html("");//alert("hi");
 
if(name == "")
 {
	 flag = false;
	 $("#name_err").html("Please enter name");
	 $("#name").css("border","1px solid red");
 }
 else{
		var regEx = /^[a-zA-Z]+[a-zA-Z_., ]+$/;
		var vname=regEx.test(name);
		if(!vname){
		flag = false;//alert("wrong");
		$("#name_err").html("Please enter valid name");
		$("#name").css("border","1px solid red");	
 }
 }
 
 if(location == "")
			 { 
				 flag = false;
				 $("#location_err").html("Please enter location");
				 $("#location").css("border","1px solid red");
			 }
if(mobile == "")
 { 
	 flag = false;
	 $("#mobile_err").html("Please enter mobile");
	 $("#mobile").css("border","1px solid red");
 }
 else{
				//alert(mobile.length);//die;var mobilepattern = /^[6-9]+[0-9]{9}$/;
		var mobilepattern = /^[6-9]+[0-9]{9}$/;
		var vmob=mobilepattern.test(mobile);
		if(!vmob){
			//alert("hi");
			flag = false;
		$("#mobile_err").html("Please enter valid mobile number ");
	 	$("#mobile").css("border","1px solid red");
		}		
 }
 
if(designation == "")
 { 
	 flag = false;
	 $("#designation_err").html("Please enter designation");
	 $("#designation").css("border","1px solid red");
 }else{
var regEx = /[a-zA-Z]/;
	var vdesignation=regEx.test(designation);
	if(!vdesignation){
		flag = false;
		 $("#designation_err").html("Please enter valid designation");
	 $("#designation").css("border","1px solid red");
		
 }
 }	
 if(password == "")
 {
	 flag = false;
	 $("#password_err").html("Please enter employee password");
	 $("#password").css("border","1px solid red");
 }
return flag; 
}
</script>
<script>
function jkl(){
	alert("jkl");
}
</script>

</body>
</html>


