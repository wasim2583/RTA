<?php 
//$email=$this->session->userdata('admin_email');
//if(empty($email)){
  //redirect('admin');}?>
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
<div class="col-sm-10">
    <form method="post" onsubmit="validate_faqs();" action="<?php echo base_url()?>" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
   
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Add FAQS</h5> 
    <button type="submit" class="btn btn-primary btn-sm no-bod-rad pull-right" name="managefaqs" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage FAQS</button>	
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div>
  <div class="row">
  
<div class="form-group col-sm-7">
  <label for="usr">FAQ Title:</label>
 
  <input type="text"   value="<?php //echo set_value('city');?>" <?php //if(form_error('city')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" id="title" name="title" >
  <?php //echo form_error('title', '<span  class="error ">','</span>');?><span class="" id="title_err" style="color:red"></span>
</div>
<div class="form-group col-sm-7">
  <label for="usr">FAQ Description:</label>
 
  <input type="text"   value="<?php //echo set_value('city');?>" <?php //if(form_error('city')!=""){echo "class='error1 form-control input-md'";}?> class="form-control no-bod-rad" id="description" name="description" >
  <?php //echo form_error('description', '<span  class="error ">','</span>');?><span class="" id="title_err" style="color:red"></span>
</div>
</div>
 
        </div>
 
         <div class="col-sm-8 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" name="submit" id="submit" onclick="return faqs();" class="btn btn-info no-bod-rad" value="ADD "> 
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
<!-- <script type="text/javascript">
	function validate_faqs()
	{
		//alert('welcome to faqs validation');
		flag=true;
		var title=$('#title').val();
		if(title=="")
		{
			$('#title').css('border','1px solid red');
		}
	}
</script>
 -->
<script type="text/javascript">
	function faqs()
	{
		//alert('gggg');
		flag=true;
		var title=$('#title').val();
		if(title=="")
		{
			$('#title').css('border','1px solid red');
		}
	}
</script>