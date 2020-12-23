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
    }
</style>
<?php $this->load->view('superadmin_view/includes/header_view');?>
<!-- Menu Start-->
<section>
    <div class="container-fluid no-padd">
        <div class="row">
            <?php $this->load->view('superadmin_view/includes/sidebar_view');?>
            <div class="col-sm-10">
                <?php $s=$this->uri->segment(4);?>
                <form method="post" action="<?php echo base_url();?>superadmin/Upload_videos" enctype="multipart/form-data" id="formid">
                    <div class="col-sm-12">
                        <div class="row m-t-15" style="margin-right: 0px;">
                            <?php 	 $success=$this->session->flashdata('success');
                                if($success){?>      
                            <div class="alert alert-success div3 col-sm-12">
                                <strong>Success!</strong><?php echo $success;?>
                            </div>
                            <?php }?> 
                            <?php 	 $failure=$this->session->flashdata('failure');
                                if($failure){?>      
                            <div class="alert alert-danger div3 col-sm-12">
                                <strong></strong><?php echo $failure;?>
                            </div>
                            <?php }?> 
                            <div class="bg-site col-wh col-sm-12 head-pad hgh-40">
                                <h5 class="m-t-n6" style="margin-bottom: -4px;">Videos</h5>
                                <button type="submit" class="btn btn-primary btn-sm no-bod-rad pull-right" name="managevideos" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Videos</button>	
                            </div>
                            <div class="col-sm-12 bg-light inventory">
                                <div class="clearfix">&nbsp;</div>
                                <div class=" col-sm-10 offset-sm-1 font14" id="add_more">
                                    <div class="row" >
                                        <div class="col-md-5">
                                            <label>Title :</label>
                                            <input type="text" name="name[]" class="form-control cname" />
                                            <br/><br/>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Youtube videos url:</label> &nbsp;&nbsp;&nbsp;<span class="name_err" style="color:red"></span> <br />
                                                <input type="text" name="files[]" class="form-control name"  />
                                                <br/><br/>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-1"> <label style="visibility:hidden;">Add</label> <button type="button" class="btn btn-success" name="add" id="add">Add</button></div>
                                    </div>
                                </div>
                                <div class="col-sm-10 offset-sm-1 font14">
                                	<div class="col-md-5">
                                		<label>Location:</label>
	                                	<select class="form-control" name="location" id="location">
	                                		<option value="">--Select Location--</option>
	                                		<?php
	                                		foreach($locations as $loc)
	                                		{
	                                			?>
	                                		<option value="<?php echo $loc->id; ?>"><?php echo $loc->location_name; ?></option>
	                                			<?php
	                                		}
	                                		?>
	                                	</select>
                                	</div>
                                </div>
                                <p class="text-center">
                                	<input type="submit"  name="fileSubmit" value="UPLOAD" id="sub-btn" class="btn btn-info no-bod-rad align-center"  width="200px;">
                                </p>
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
    
    $("#sub-btn").on("click", function () {
    	var name=$('.name').val();
    	$(".name,.cname").css("border","");
    	var flag = true;
    $('.cname').each(function(){
    	if($(this).val()=="")
    	{
    		flag = false;
    		$(this).css('border','1px solid red');
    	}
    	else{
    		flag = true;
    		$(this).css('border','');
    	}
    	});
    	$(".name").each(function(){
       var name = $(this).val(); 
    
       if(name=='')
       { 
          flag = false;
    		$(this).css('border','1px solid red');
       }else{
    //var urlRegEx = /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/;
     var urlRegEx =/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com)\/watch\?v=([^&]+)/m;
     var vname=urlRegEx.test(name);
        //alert(vname);
        if(!vname){
        flag = false;
         $(this).css('border','1px solid red');
     }}
    });
    if(flag == true)
    {
    	$("#form").submit();
    }	//alert(flag);
    	return flag;
    });
    $("#add").click(function(){
    	var wrapper = '<div class="row"><div class="col-md-5 col-sm-5"><label>Title :</label><input type="text" name="name[]" class="form-control cname" /></div><div class="form-group col-sm-5"><div class="form-group"><label>Youtube videos url:</label>  &nbsp;&nbsp;&nbsp;<span class="name_err" style="color:red"></span><input type="text" class="form-control name" name="files[]"   /></div><span class="" class="name_err" style="color:red"></span></div><div class="col-md-1"><label style="visibility:hidden;">remove</label><button class="remove btn btn-danger" name="remove" class="remove" type="button">Remove</button></div></div>';
    	$("#add_more").append(wrapper);
    	});
    	$(document).on("click",".remove",function(){
    		//alert('hi');
    		$(this).parent().parent().remove();
    	});
</script>
</body>
</html>