<?php 
//$email=$this->session->userdata('admin_email');
//if(empty($email)){
  //redirect('admin');}?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php $this->load->view('superadmin_view/includes/header_view');?>
<!-- Menu Start-->
<section>
<div class="container-fluid no-padd">
<div class="row">
<?php $this->load->view('superadmin_view/includes/sidebar_view');?>
<div class="col-sm-10">
 <?php //$si=$this->uri->segment(4);?>
    <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/mocktest/mocktest_uploadData" enctype="multipart/form-data" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
    <h5 class="m-t-n6" style="margin-bottom: 0px;">Mocktest Import<?php //if(isset($ac)) echo "hi";?></h5>  	
        </div>
<?php 	 $import=$this->session->flashdata('import');
		 if($import){?>      
		 <div class="alert alert-success div3 col-sm-12">
         <strong>Success!</strong><?php echo $import;?>
		 </div> <?php }?> 
		
 	 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class="table-responsive col-sm-12 font14">
    <div class="row">
  
 <div class="input-group col-sm-8">
      
      <div class="input-group-btn">
      <table>
        <tr>
            <td> Choose your file: </td>
            <td>
                <input type="file"  name="userfile" id="userfile"  align="center"/>
            </td>
            <td>
                <div class="col-lg-offset-3 col-lg-9">
                    <button type="submit" name="submit" onClick="return validate_care();" class="btn btn-info">Save</button>
                </div>
            </td><div class="col-lg-offset-3" style="color:red" id="userfile_err"></div>
        </tr>
    </table> 
      </div>
    </div>
    
 <div class="clearfix">&nbsp;</div>
  </div><?php //print_r($sanghi);?>
 
        </div>
 
       <!--  <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <button type="button" class="btn btn-info no-bod-rad"> &nbsp; &nbsp; ADD &nbsp; &nbsp; </button>    
       <button type="button" class="btn btn-purple no-bod-rad"> &nbsp; &nbsp; CLEAR &nbsp; &nbsp; </button>    
      
        <div class="clearfix">&nbsp;</div> 
        </div>-->
		<div class="col-sm-12">
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
<!--Footer Scripts End-->
<script>
$(document).ready(function(){
   
       
        $(".div3").fadeIn(3000).fadeOut(4000);
  
});
function vasslidate_care(){
	
	var userfile=$('#userfile').val();
	 $("#userfile").css("border","");
 $("#userfile_err").html("");//alert("hi");
 var flag = true;
 if(userfile == "")
			 {  //alert(fname);
				 flag = false;
				 $("#userfile_err").html("Please choose file");
				 $("#userfile").css("border","1px solid red");
			 }else
 {
	var  userfile = userfile.toLowerCase();
	extension = userfile.substring(userfile.lastIndexOf('.') + 1);//alert(extension);
	var allowedExtensions=['csv'];	  
	  //options = $.extend(defaults, options);
        if (jQuery.inArray(extension, allowedExtensions)=='-1') {
            $("#userfile_err").html(" Please Choose Csv File");
				 $("#userfile").css("border","1px solid red");
		   flag = false;
		   
        }
 }
	alert(flag);
 //return flag; 
}
</script>
</body>
</html>