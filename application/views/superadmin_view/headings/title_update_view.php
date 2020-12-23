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
<div class="row"><?php $s=$this->uri->segment(5);?>
<?php $this->load->view('superadmin_view/includes/sidebar_view');?>
<div class="col-sm-10">
    <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/headings/update_title/<?php echo $row['heading_id'];?>/<?php echo $s;?>" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
   
    <h5 class="m-t-n6" style="margin-bottom: -4px;">Update Department Data</h5> 
    <button type="submit" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manage_titles" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Titles's</button>	
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class=" col-sm-10 offset-sm-1 font14">
    <div class="row">
 <div class="clearfix">&nbsp;</div>
  <div class="row">
 
<div class="form-group col-sm-12">
  <label for="usr">Tile:</label>
  <textarea rows="2" <?php if(form_error('question')!==""){echo "class='error1 form-control no-bod-rad'";}else{echo 'class="form-control no-bod-rad"';}?>  id="question" name="question"><?php echo $row['heading_title']; ?></textarea>
  <?php echo form_error('question', '<span  class="error ">','</span>');?> <span class="" id="question_err" style="color:red"></span>
</div>
<div class="form-group col-sm-12">
  <label for="usr">description:</label>
  <textarea  rows="5" <?php if(form_error('answer')!==""){echo "class='error1 form-control no-bod-rad'";}else{echo 'class="form-control no-bod-rad"';}?>  id="answer" name="answer"><?php echo $row['heading_description']; ?></textarea>
  <?php echo form_error('answer', '<span  class="error ">','</span>');?> <span class="" id="answer_err" style="color:red"></span>
</div>
  <div class="form-group required col-sm-12">
                                    <label class="control-label">Status<sup>*</sup> 
                                    </label>
                               
                                       <select class="form-control no-bod-rad" id="status" name="status" <?php if(form_error('status')!=""){echo "class='error1 form-control'";} ?> >
									   <option value="">-Choose from Here-</option>
										<option value="1" <?php if($row['status'] ==1) echo 'selected';?>>Active</option>
										<option value="2"<?php if($row['status'] ==2) echo 'selected';?>>Inactive</option>
                                      </select><?php echo form_error('status', '<span  class="error  dname">', '</span>'); ?>
								
      <span class="form-group required col-sm-6" id="status_err" style="color:red"></span>                           </div>
                                
                                 </div>
 
        </div>
 
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <input type="submit" class="btn btn-info no-bod-rad" onClick="return validate_care();"  value="UPDATE"> 
	
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
function validate_care(){
	//alert("hi");
	var question=$('#question').val();
 var answer=$('#answer').val();
   var status=$('#status').val();   
 var flag = true;
 $("#question,#answer,#status").css("border","");
 $("#question_err,#answer_err,#status_err").html("");//alert("hi");
	 
if(question == "")
 { 
	 flag = false;
	 $("#question_err").html("Please enter question ");
	 $("#question").css("border","1px solid red");
 }
if(answer == "")
 { 
	 flag = false;
	 $("#answer_err").html("Please enter answer ");
	 $("#answer").css("border","1px solid red");
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
<script>
function jkl(){
	alert("jkl");
}
</script>

</body>
</html>


