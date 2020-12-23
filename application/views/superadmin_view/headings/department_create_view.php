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
    <form method="post" action="<?php echo base_url();?>admin/headings/insert_heading" enctype="multipart/form-data" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">
  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
   
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Add Department Data</h5> 
    <a href="<?php echo base_url();?>admin/headings/manage_headings" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manageDepartment" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Department Headings</a>	
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div><?php if(isset($error)){print_r($error);}?>
  <div class="row">
  <div class="form-group col-sm-6">
  <label for="usr">Heading:</label>
  <input type="text"  id="headings" name="headings" value="<?php echo set_value('headings');?>" <?php if(form_error('headings')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
  <?php echo form_error('headings', '<span  class="error ">','</span>');?> <span class="" id="headings_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Description:</label>
  <textarea  <?php if(form_error('description')!==""){echo "class='error1 form-control no-bod-rad'";}else{echo 'class="form-control no-bod-rad"';}?>  id="description" name="description"><?php echo set_value('description'); ?></textarea>
  <?php echo form_error('description', '<span  class="error ">','</span>');?> <span class="" id="description_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Image:</label>
  <input type="file"  class="form-control no-bod-rad" id="image" name="image" accept="image/jpg,image/jpeg,image/png"  >
  
  <?php if(isset($error)){ echo "<span class='error'>$error</span>"; }?><span class="" id="image_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Pdf:</label>
  <input type="file"  class="form-control no-bod-rad" id="pdf" name="pdf" accept="image/pdf"  >
  
  <?php if(isset($error)){ echo "<span class='error'>$error</span>"; }?><span class="" id="pdf_err" style="color:red"></span>
</div>

  <div class="form-group required col-sm-6">
                                    <label class="control-label">Status<sup>*</sup> 
                                    </label>
                               
                                       <select class="form-control no-bod-rad" id="status" name="status" <?php if(form_error('status')!=""){echo "class='error1 form-control'";} ?> >
									   <option value=0>-Choose from Here-</option>
										<option value="1" <?php echo set_select('status', 1);?>>Active</option>
										<option value="2" <?php echo set_select('status', 2);?>>Inactive</option>
                     								                 </select><?php echo form_error('status', '<span  class="error  dname">', '</span>'); ?>

      <span class="form-group required col-sm-6" id="status_err" style="color:red"></span>                           </div>
                                
                                 </div>
 
        </div>
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" class="btn btn-info no-bod-rad" onClick="return validate_testimonials();"  value="ADD"> 
	<a href="<?php echo HTTP_BASE_PATH;?>admin/testimonials/add_testimonials" class="btn btn-info no-bod-rad" style="color:#fff" > RESET</a>

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


<script>
function validate_testimonials(){
	//alert("hi");
	var headings=$('#headings').val();
 // var email=$('#email').val();//alert(pwd);die;mobile
 // var mobile=$('#mobile').val();
  var description=$('#description').val();
  // var ict1=$('#ict1').val();
   // var city=$('#city').val();
    var pdf=$('#pdf').val(); 
   var status=$('#status').val();
   var image=$('#image').val();
 var flag = true;
 $("#headings,#status,#description,#image,#pdf").css("border","");
 $("#headings_err,#status_err,#description_err,#image_err,#pdf_err").html("");//alert("hi");
if(headings == "")
 {
	 flag = false;
	 $("#headings_err").html("Please enter name");
	 $("#headings").css("border","1px solid red");
 }
 else{
		var regEx = /^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/;
		var vname=regEx.test(headings);
		if(!vname){
		flag = false;//alert("wrong");
		$("#headings_err").html("Please enter valid name");
		$("#headings").css("border","1px solid red");	
 }
 }
/*if(description == "")
 { 
	 flag = false;
	 $("#description_err").html("Please write description");
	 $("#description").css("border","1px solid red");
 }*/
 if(image != "")
 { 
	 var  image = image.toLowerCase();
	extension = image.substring(image.lastIndexOf('.') + 1);//alert(extension);
	var allowedExtensions=['jpg','jpeg','png'];	  
	  //options = $.extend(defaults, options);
        if (jQuery.inArray(extension, allowedExtensions)=='-1') {
           $("#image_err").html("Please select only jpg,png,jpeg files");
	  $("#image").css("border","1px solid red");
		   flag = false;
		   
        }
 }
 if(pdf != "")
 { 
var  pdf = pdf.toLowerCase();
	extension = pdf.substring(pdf.lastIndexOf('.') + 1);//alert(extension);
	var allowedExtensions=['pdf'];	  
	  //options = $.extend(defaults, options);
        if (jQuery.inArray(extension, allowedExtensions)=='-1') {
           $("#pdf_err").html("Please select only pdf files");
	  $("#pdf").css("border","1px solid red");
		   flag = false;
		   
        }
 }
var status = $('#status').val();
		 if(status == 0 || status == ""){
			 //alert(min);
			  flag = false;
			  $("#status_err").html("Please choose status");
			  $("#status").css("border","1px solid red");
		 }

return flag; 
}
</script>
</body>
</html>


