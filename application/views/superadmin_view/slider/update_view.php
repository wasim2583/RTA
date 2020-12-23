<?php 
// echo "<pre>";
// print_r($res);exit;
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
    <form method="post" action="<?php echo base_url().'superadmin/slider/update_slider_image/'.$this->uri->segment(4).'/'.$this->uri->segment(5);?>" enctype="multipart/form-data" onsubmit=" return validate_care();">
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">
  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Update slider</h5> 
    <a href="<?php echo base_url();?>superadmin/slider/slider_information" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manage_team" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Slider</a>
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
        <?php echo validation_errors(); ?>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div>
  <div class="row">
  <div class="form-group col-sm-6">
  <label for="usr">Slider Name:</label>
  <input type="hidden" name="old_image" value="<?php echo $res['slider_img']; ?>">
  <input type="text"  id="name" name="name" value="<?php echo set_value('name',$res['slider_title']);?>" <?php if(form_error('name')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
  <?php echo form_error('name', '<span  class="error ">','</span>');?> <span class="" id="name_err" style="color:red"></span>
</div>
  <div class="form-group col-sm-6">
  <label for="usr">Slider Url:</label>
  <input type="text"  id="url" name="url" value="<?php echo set_value('url',$res['slider_location']);?>" <?php if(form_error('url')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
  <?php echo form_error('url', '<span  class="error ">','</span>');?> <span class="" id="url_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Slider Image:  (only jpg,png & jpeg allow)</label>
  <input type="file" id="photo" name="photo" value="<?php echo set_value('photo');?>" <?php if(form_error('photo')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" accept="image/jpg,image/jpeg,image/png" >
  <img src="<?php echo base_url().'uploads/slider/'.$res['slider_img']; ?>" style="height:50px;width:50px;"/>
  <?php echo form_error('photo', '<span  class="error ">','</span>');?><span class="" id="photo_err" style="color:red"></span>
</div>
<div class="form-group col-sm-6">
  <label for="usr">Slider Caption:</label>
  <input type="text"  id="caption" name="caption" value="<?php echo set_value('caption',$res['slider_caption']);?>" <?php if(form_error('caption')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad">
  <?php echo form_error('caption', '<span  class="error ">','</span>');?><span class="" id="caption_err" style="color:red"></span>
</div>
<!-- <div class="form-group col-sm-6">
  <label for="usr">Slide Location:</label>

  <input type="text" id="location" name="location" value="<?php echo set_value('location');?>" <?php if(form_error('location')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" >
  <?php echo form_error('location', '<span  class="error ">','</span>');?><span class="" id="location_err" style="color:red"></span>
</div> -->
</div>
 
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" name="submit" id="submit" class="btn btn-info no-bod-rad" value="SAVE CHANGES" > 
	 
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
	//alert("hi");url
	var name=$('#name').val();
	var photo=$('#photo').val();
 	var url=$('#url').val();
  	var caption=$('#caption').val();
 	var flag = true;
 	$("#name,#photo,#url,#caption").css("border","");
	 $("#name_err,photo_err,#url_err,#caption_err").html("");//alert("hi");
	/* if(name == "")
 	{
 		//alert('required');
	 flag = false;
	 $("#name_err").html("Please enter slider Title");
	 $("#name").css("border","1px solid red");
 }
 else{
		var regEx = /^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/;
		var vname=regEx.test(name);
		if(!vname){
		flag = false;//alert("wrong");
		$("#name_err").html("Please enter valid slider Title");
		$("#name").css("border","1px solid red");	
 }
 }*/
 if(!photo == "")
 { 
	var imagepattern=/png|jpg|jpeg/;
	   if(!photo.match(imagepattern)){flag=false;$(this).css('border','1px solid red');$("#photo_err").html("Please select only image");}
 }

/*if(caption == "")
 { 
	 flag = false;
	 $("#caption_err").html("Please enter your caption");
	 $("#caption").css("border","1px solid red");
 }
 else{
    var regEx = /^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/;
    var tcaption=regEx.test(caption);
    if(!caption){
    flag = false;//alert("wrong");
    $("#caption_err").html("Please enter valid Caption");
    $("#caption").css("border","1px solid red"); 
    }
 }*/
return flag; 
}
</script>