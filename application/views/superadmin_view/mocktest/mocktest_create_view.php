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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container-fluid no-padd">
<div class="row">
<?php $this->load->view('superadmin_view/includes/sidebar_view');?>
<div class="col-sm-10"><?php $s=$this->uri->segment(4);?>
    <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/mocktest/insert_mocktest" enctype="multipart/form-data" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">
  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Add Mocktest</h5> 
    <a href="<?php echo HTTP_BASE_PATH;?>admin/mocktest/mocktest_information" class="btn btn-primary btn-sm no-bod-rad pull-right" name="managemocktest" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Mocktest</a>	
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-8 offset-sm-2 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div><?php if(isset($error)){print_r($error);}?>
  <div class="row">
<div class="form-group col-sm-12">
  <label for="usr">Question:</label>
  <textarea  <?php if(form_error('question')!==""){echo "class='error1 form-control no-bod-rad'";}else{echo 'class="form-control no-bod-rad"';}?>  id="question" name="question"><?php echo set_value('question'); ?></textarea>
  <?php echo form_error('question', '<span  class="error ">','</span>');?> <span class="" id="question_err" style="color:red"></span>
</div>
<div class="form-group required col-sm-12">
                                    <label class="control-label">Language Type<sup>*</sup> 
                                    </label>
                                      <select class="form-control no-bod-rad" id="language" name="language" <?php if(form_error('language')!=""){echo "class='error1 form-control'";} ?> >
									   <option value="">-Choose from Here-</option>
										<option value="1" <?php echo set_select('language', 1);?>>English</option>
										<option value="2" <?php echo set_select('language', 2);?>>Telugu</option>
										</select><?php echo form_error('language', '<span  class="error  dname">', '</span>'); ?>
								
      <span class="form-group required col-sm-6" id="language_err" style="color:red"></span>                           </div>
 
<div class="form-group col-sm-12">
  <label for="usr">Url:</label>
  <input type="text" value="<?php echo set_value('url');?>" <?php if(form_error('url')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad optionClass" id="url" name="url"  >
  <?php echo form_error('url', '<span  class="error ">','</span>');?><span class="" id="url_err" style="color:red"></span>
</div>
 
<div class="form-group col-sm-12">
  <label for="usr">Image:</label>
  <input type="file"  class="form-control no-bod-rad optionClass opt1" id="img1" name="img1" style="font-size: 12px;" accept="image/jpg,image/jpeg,image/png" >
  <span class="" id="img1_err" style="color:red"></span>
</div>
<div class="form-group col-sm-12">
  <label for="usr">Option 1:</label>
  <input type="text" value="<?php echo set_value('opt1');?>" <?php if(form_error('opt1')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad optionClass opt1" id="opt1" name="opt1" >
  <?php echo form_error('opt1', '<span  class="error ">','</span>');?><span class="" id="opt1_err" style="color:red"></span>
</div>

<div class="form-group col-sm-12">
  <label for="usr">Option 2:</label>
  <input type="text" value="<?php echo set_value('opt2');?>" <?php if(form_error('opt2')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad optionClass" id="opt2" name="opt2"  >
  <?php echo form_error('opt2', '<span  class="error ">','</span>');?><span class="" id="opt2_err" style="color:red"></span>
</div>

<div class="form-group col-sm-12">
  <label for="usr">Option 3:</label>
  <input type="text" value="<?php echo set_value('opt3');?>" <?php if(form_error('opt3')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad optionClass" id="opt3" name="opt3" >
  <?php echo form_error('opt3', '<span  class="error ">','</span>');?><span class="" id="opt3_err" style="color:red"></span>
</div>

<div class="form-group col-sm-12">
  <label for="usr">Option 4:</label>
  <input type="text" value="<?php echo set_value('opt4');?>" <?php if(form_error('opt4')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad optionClass" id="opt4" name="opt4" >
  <?php echo form_error('opt4', '<span  class="error ">','</span>');?><span class="" id="opt4_err" style="color:red"></span>
</div>
  <div class="form-group required col-sm-12">
                                    <label class="control-label">Answer<sup>*</sup> 
                                    </label>
                                      <select class="form-control no-bod-rad" id="answer" name="answer" <?php if(form_error('answer')!=""){echo "class='error1 form-control'";} ?> >
									   <option value=0>-Choose from Here-</option>
										<option value="1" <?php echo set_select('answer', 1);?>>Option 1</option>
										<option value="2" <?php echo set_select('answer', 2);?>>Option 2</option>
										<option value="3" <?php echo set_select('answer', 3);?>>Option 3</option>
										<option value="4" <?php echo set_select('answer', 4);?>>Option 4</option>
										</select><?php echo form_error('answer', '<span  class="error  dname">', '</span>'); ?>
								
      <span class="form-group required col-sm-6" id="answer_err" style="color:red"></span>                           </div>
                                
                                 </div>
 
        </div>
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" class="btn btn-info no-bod-rad" onClick="return validate_mocktest();"  value="ADD"> 
	<a href="<?php echo HTTP_BASE_PATH;?>admin/mocktest/add_mocktest" class="btn btn-info no-bod-rad" style="color:#fff" > RESET</a>

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
function validate_mocktest(){
	  var question=$('#question').val();
    var lang=$('#language').val();
	  var img1=$('#img1').val();
	  var opt1=$('#opt1').val();
	  var opt2=$('#opt2').val();
	  var opt3=$('#opt3').val();
	  var opt4=$('#opt4').val();
	  var answer=$('#answer').val();
 var flag = true;
 $("#question,#img1,#opt1,#opt2,#opt3,#opt4,#answer").css("border","");
 $("#question_err,#opt1_err,#opt2_err,#opt3_err,#opt4_err,#answer_err").html("");
 if(question == "")
 {
	 flag = false;
	 $("#question_err").html("Please enter question");
	 $("#question").css("border","1px solid red");
 }
 if(img1 != "") {
	 var  img1 = img1.toLowerCase();
	extension = img1.substring(img1.lastIndexOf('.') + 1);//alert(extension);
	var allowedExtensions=['jpg','jpeg','png'];	  
	  //options = $.extend(defaults, options);
        if (jQuery.inArray(extension, allowedExtensions)=='-1') {
            $("#img1_err").html("Please choose valid");
	 $("#img1").css("border","1px solid red");
		   flag = false;
		   
        } 
	 }
   if(lang == "")
 { 
   flag = false;
   $("#language").html("Please select Language");
   $("#language").css("border","1px solid red");
 }
 if(opt1 == "")
 { 
	 flag = false;
	 $("#opt1_err").html("Please enter option1");
	 $("#opt1").css("border","1px solid red");
 }
 if(opt2 == "")
 { 
	 flag = false;
	 $("#opt2_err").html("Please enter option2");
	 $("#opt2").css("border","1px solid red");
 }
  if(opt3 == "")
 { 
	 flag = false;
	 $("#opt3_err").html("Please enter option3");
	 $("#opt3").css("border","1px solid red");
 }
   if(opt4 == "")
 { 
	 flag = false;
	 $("#opt4_err").html("Please enter option4");
	 $("#opt4").css("border","1px solid red");
 }
 var answer = $('#answer').val();
		 if(answer == 0 || answer == ""){
			 //alert(min);
			  flag = false;
			  $("#answer_err").html("Please enter answer");
			  $("#answer").css("border","1px solid red");
		 }
return flag; 
}
</script>
</body>
</html>

