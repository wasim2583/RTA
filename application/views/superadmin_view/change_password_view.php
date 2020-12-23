<?php 
$email=$this->session->userdata('admin_email');
if(empty($email)){
  redirect('admin');}?>
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
    <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/admin_change_password"  >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
   
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Change Password</h5> 
   	<?php  $change_password=$this->session->flashdata('change_password');
		if($change_password){?>      
		<div class="alert alert-success div3 col-sm-12">
		<strong>Success!</strong><?php echo $change_password;?>
		</div> <?php  }?>
		
		<?php  $wrong_password=$this->session->flashdata('wrong_password');
		if($wrong_password){?>      
		<div class="alert alert-danger div3 col-sm-12">
		<strong></strong><?php echo $wrong_password;?>
		</div> <?php  }?>
		
		<?php  $not_change_password=$this->session->flashdata('not_change_password');
		if($not_change_password){?>      
		<div class="alert alert-danger div3 col-sm-12">
		<strong></strong><?php echo $not_change_password;?>
		</div> <?php  }?>
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div>
  <div class="row">
  <div class="form-group col-sm-6">
  <label for="usr">Old Password:</label>
  <input type="text"  id="oldp" name="oldp" value="<?php echo set_value('oldp');?>" <?php if(form_error('oldp')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
  <?php echo form_error('oldp', '<span  class="error ">','</span>');?> <span class="" id="oldp_err" style="color:red"></span>
<?php if(isset($wrong_pwd)){
echo "<span style='color:red' >$wrong_pwd</span>"; }?>
  </div>

<div class="form-group col-sm-6">
  <label for="usr">New Password:</label>
  <input type="text"  value="<?php echo set_value('newp');?>" <?php if(form_error('newp')!=""){echo "class='error1 form-control input-md'";}?>  class="form-control no-bod-rad" id="newp" name="newp"  max="10" >
  <span class="" id="newp_err" style="color:red"></span> <?php echo form_error('newp', '<span  class="error ">','</span>');?>
</div>

<div class="form-group col-sm-6">
  <label for="usr">Confirm Password:</label>
  <input type="text" maxlength="10" value="<?php echo set_value('confirmp');?>" <?php if(form_error('confirmp')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" id="confirmp" name="confirmp" >
 <?php echo form_error('confirmp', '<span  class="error ">','</span>');?>  <span class="" id="confirmp_err" style="color:red"></span>
</div>

        </div>
 
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" class="btn btn-info no-bod-rad"  name="submit" onClick="return validate_form();"  value="CHANGE"> 
	 <a href="<?php echo HTTP_BASE_PATH;?>admin/change_password" class="btn btn-info no-bod-rad" style="color:#fff" > RESET</a>

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
$(document).ready(function(){
   
       
        $(".div3").fadeIn(3000).fadeOut(4000);
  
});
function validate_form(){
 var oldp=$('#oldp').val();//alert("hi");
 var newp=$('#newp').val();
 var confirmp=$('#confirmp').val();//alert(pwd);die;
 var flag = true;
 $("#oldp,#newp,#confirmp").css("border","");
 $("#oldp_err,#newp_err,#confirmp_err").html("");//alert("hi");

 if(oldp == "")
 { 
	 flag = false;
	 $("#oldp_err").html("Please enter old password ");
	 $("#oldp").css("border","1px solid red");
 }
 if(newp == "")
 { 
	 flag = false;
	 $("#newp_err").html("Please enter new password ");
	 $("#newp").css("border","1px solid red");
 }
 if(confirmp == "")
 { 
	 flag = false;
	 $("#confirmp_err").html("Please enter confirm password ");
	 $("#confirmp").css("border","1px solid red");
 }
 return flag;
}
 </script>



</body>
</html>


