<?php 
$email=$this->session->userdata('admin_email');
if(empty($email)){
  redirect('admin');}?>
<?php $this->load->view('superadmin_view/includes/header_view');?>
<!-- Menu Start-->
<section>
<div class="container-fluid no-padd">
    <div class="row">
     <?php $this->load->view('superadmin_view/includes/sidebar_view');?>
        <div class="col-sm-10">
		  <?php $s=$this->uri->segment(5); ?>
          <form method="post" id="form" action="<?php echo base_url();?>admin/users/update_user/<?php echo $row['user_id'];?>/<?php echo $s;?>">
            <div class="col-sm-12">
                <div class="row m-t-15" style="margin-right: 0px;">
                    <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
						<h5 class="m-t-n6" style="margin-bottom: 0px;">User Update View</h5>  
						<button type="submit" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manageusers" style="margin-top: -20px;">
						<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Users</button>		
					</div>
                    <div class="col-sm-12 bg-light inventory">
                        <div class="clearfix">&nbsp;</div>
                        <div class="table-responsive col-sm-12 font14">
				            <div class="row">
								<div class="col-sm-3"></div>
			
					 
								<div class="input-group col-sm-4">
								  <!--<input type="text" class="form-control no-bod-rad" placeholder="Search" name="search">
								  <div class="input-group-btn">
									<button class="btn btn-default no-bod-rad" type="submit"><i class="fa fa-search"></i></button>
								  </div>-->
								</div>
								<!--<div class="col-sm-5" onchange="dcat  onchange="check_tutor_email_or_not();"onmouseout

								  <button type="submit" class="btn btn-success no-bod-rad" name="manageusers">Manage Users</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											  
								</div>-->
								<div class="clearfix">&nbsp;</div>
							</div>
							
							<div class="form-group col-sm-4">
								<label for="usr">User Name:</label>
								<input type="text" min="3" class="form-control no-bod-rad" id="name" name="name" value="<?php echo $row['name'];?>">
								<span class="" id="name_err" style="color:red"></span>
							</div>
							<div class="form-group col-sm-4">
								<label for="usr">User Mobile:</label>
								<input type="text" maxlength="10" class="form-control no-bod-rad" id="mobile" name="mobile"  max="10" onmouseout="check_email_mobile_duplicate();" value="<?php echo $row['mobile'];?>">
								<span class="" id="mobile_err" style="color:red"></span>
								<?php if(isset($mobile_duplicate)) echo "<span style='color:red' >$mobile_duplicate</span>";?>
							</div>

							<div class="form-group col-sm-4">
							    <label for="usr">User Status:</label>
							    <Select  class="form-control" name="status" id="status"> 
								    <option value="1" <?php if($row['user_status'] ==1) echo 'selected';?>>Active</option>
								    <option value="2" <?php if($row['user_status'] ==2) echo 'selected';?> >InActive</option>
							    </select>
							    <span id="status_err" style="color:red"></span>
							    <?php echo form_error('status', '<span  class="error dname">', '</span>'); ?>
							</div>
							<div class="form-group col-sm-4">
							    <label for="usr">Role / Designation:</label>
							    <select class="form-control" name="role" id="role">
							    	<option value="">--Select Designation/Role--</option>
							    	<?php
							    	if( ! empty($roles))
							    	{
							    		foreach($roles as $role)
							    		{
							    			?>
							    	<option value="<?php echo $role->id; ?>" <?php echo ($row['role'] == $role->id) ? 'SELECTED' : ''; ?>><?php echo $role->role_name; ?></option>
							    			<?php
							    		}
							    	}
							    	?>
							    </select>
							    <span id="status_err" style="color:red"></span>
							    <?php echo form_error('status', '<span  class="error dname">', '</span>'); ?>
							</div>
							<div class="form-group col-sm-4">
							    <label for="location">Location:</label>
							    <select class="form-control" name="location" id="location">
							    	<option value="">--Select Location--</option>
							    	<?php
							    	if( ! empty($locations))
							    	{
							    		foreach($locations as $loc)
							    		{
							    			?>
							    	<option value="<?php echo $loc->id; ?>" <?php echo ($row['loc'] == $loc->id) ? 'SELECTED' : ''; ?>><?php echo $loc->location_name; ?></option>
							    			<?php
							    		}
							    	}
							    	?>
							    </select>
							    <span id="status_err" style="color:red"></span>
							    <?php echo form_error('status', '<span  class="error dname">', '</span>'); ?>
							</div>
			            </div>
 
                        <div class="col-sm-12 text-center">
							<div class="clearfix">&nbsp;</div>
							<input type="submit" class="btn btn-info no-bod-rad" onClick="return validate_user();" name="update" id="update" value="UPDATE">    
							<!-- <button type="submit" class="btn btn-purple no-bod-rad"> &nbsp; &nbsp; CLEAR &nbsp; &nbsp; </button>  -->  
		  
							<div class="clearfix">&nbsp;</div> 
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
<script>
$(document).ready(function(){
$('#CheckAll').change(function() {
  if ($('#CheckAll').is(":checked")) {
	 // alert("hi");die;
    $('.cnames').prop("checked", true);
  } else {
    $('.cnames').prop("checked", false);
  }
});
});
$(document).ready(function () {
	var ckbox = $('.cnames');
 $(".cnames").click(function() {
        $('#CheckAll').prop('checked', false);
        //alert('you are unchecked ');
    }); }); 
</script>
<script>
function validate_user(){
	//alert("hi");
	var name=$('#name').val();
    var mobile=$('#mobile').val();
    var password=$('#password').val();
    var status=$('#status').val();
    var flag = true;
    $("#name,#email,#mobile,#password,#status").css("border","");
    $("#name_err,#email_err,#mobile_err,#password_err,#status_err").html("");//alert("hi");
    if(name == "")
    {
	  flag = false;
	  $("#name_err").html("Please enter name");
	  $("#name").css("border","1px solid red");
    }
    else{
		var regEx = /^([a-zA-Z\-.\s]{2,60})+$/;
		var vname=regEx.test(name);
		if(!vname){
		  flag = false;//alert("wrong");
		  $("#name_err").html("Please enter valid name");
		  $("#name").css("border","1px solid red");	
        }
    }

	if(mobile == "")
	 { 
		 flag = false;
		 $("#mobile_err").html("Please enter mobile number ");
		 $("#mobile").css("border","1px solid red");
	 }
	 else{
					//alert(mobile.length);//die;var mobilepattern = /^[6-9]+[0-9]{9}$/;
			var mobilepattern = /^[6-9]+[0-9]{9}$/;
			var vmob=mobilepattern.test(mobile);
			if(!vmob){
				//alert("hi");
				flag = false;
		$("#mobile_err").html("Please enter valid mobile number");
		 $("#mobile").css("border","1px solid red");
			}		
	 }

	 if(status == "")
	 { 
		 flag = false;
		 $("#status_err").html("Please choose status");
		 $("#status").css("border","1px solid red");
	 }			 
	return flag; 
}
</script>

<script>
function dcat() {
	alert("hi");die;
			var email = $("#email").val();
			$("#email_duplicate").html('');
                 $.ajax({
                      type: "post",
                      dataType:"JSON",
                      data:{'email':email},
              url: "<?php echo base_url(); ?>superadmin/users_controller/emailCheck",
                      success: function (s) {
                        console.log(s);
						if(s == '200'){
							$("#email_duplicate").html("Email exists!!").css('color','red');
						}
						else{
							$("#form").submit();
						}
                        },
                     error: function (er) {
                           console.log(er);
                           $("#message").html('Something went wrong').addClass('alert alert-danger');
                      }
                  });
}
function check_email_mobile_duplicate(){
	//alert("hi");
$("#email_err,#mobile_err").css('border','');
$("#email,#mobile").html('');
//$("#mobile_err").css('border','');
//$("#mobile").html('');
$(':input[type="submit"]').prop('disabled', false);
var email=$("#email").val().trim();
var mobile=$("#mobile").val().trim();
if(email!=""){
	//alert("hidfd");
$.ajax({
url:"<?php echo base_url();?>superadmin/users_controller/emailCheck/<?php echo $row['user_id'];?>",
method:'POST',
dataType:'JSON',
data:{'email':email},
success:function (s){
console.log(s);
 if(s.code==200){
	 console.log('hi');
$("#email").css('border','1px solid red').focus()
$("#email_err").html('Email already exists');
 $("[id=update]").prop('disabled', true);
} else{
	console.log('bye');
$("#email").css('border','').focus()
$("#email_err").html('');
}
},
error:function(er){
console.log(er);
}
});
}
if(mobile!=""){
	//alert("hidfd");
$.ajax({
url:"<?php echo base_url();?>superadmin/users_controller/mobileCheck/<?php echo $row['user_id'];?>",
method:'POST',
dataType:'JSON',
data:{'mobile':mobile},
success:function (s){
console.log(s);
 if(s.code==200){
	 console.log('hi');
$("#mobile").css('border','1px solid red').focus()
$("#mobile_err").html('Mobile already exists');
$("[id=update]").prop('disabled', true);
} else{
	console.log('bye');
$("#mobile").css('border','').focus()
$("#mobile_err").html('');
}
},
error:function(er){
console.log(er);
}
});
}
}

function check_tutor_mobile_or_not(){
	//alert("hi");
$("#mobile_err").css('border','');
$("#mobile").html('');
$('input[name="update"]').prop('disabled', false);
var mobile=$("#mobile").val().trim();
if(mobile!=""){
	//alert("hidfd");
$.ajax({
url:"<?php echo base_url();?>superadmin/users_controller/mobileCheck/<?php echo $row['user_id'];?>",
method:'POST',
dataType:'JSON',
data:{'mobile':mobile},
success:function (s){
console.log(s);
 if(s.code==200){
	 console.log('hi');
$("#mobile").css('border','1px solid red').focus()
$("#mobile_err").html('Mobile already exists');
$("[id=update]").prop('disabled', true);
} else{
	console.log('bye');
$("#mobile").css('border','1px solid green').focus()
$("#mobile_err").html('Mobile not exists');
}
},
error:function(er){
console.log(er);
}
});
}
}
		</script>

</body>
</html>


