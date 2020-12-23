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
                <?php $si=$this->uri->segment(4);?>
                <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/gallery/search/<?php echo $si;?>" >
                    <div class="col-sm-12">
                        <div class="row m-t-15" style="margin-right: 0px;">
                            <div class="bg-site col-wh col-sm-12 head-pad hgh-40">
                                <h5 class="m-t-n6" style="margin-bottom: 0px;">Gallery Information<?php if(isset($ac)) echo "hi";?></h5>
                            </div>
                            <?php 	 $ac=$this->session->flashdata('ac');
                                if($ac){?>      
                            <div class="alert alert-success div3 col-sm-12">
                                <strong>Success!</strong><?php echo $ac;?>
                            </div>
                            <?php }?> 
                            <?php 	 $failure=$this->session->flashdata('failure');
                                if($failure){?>      
                            <div class="alert alert-danger div3 col-sm-12">
                                <strong></strong><?php echo $failure;?>
                            </div>
                            <?php }?> 
                            <?php  $success=$this->session->flashdata('success');
                                if($success){?>      
                            <div class="alert alert-success div3 col-sm-12">
                                <strong>Success!</strong><?php echo $success;?>
                            </div>
                            <?php  }?> 
                            <div class="col-sm-12 bg-light inventory">
                                <div class="clearfix">&nbsp;</div>
                                <div class="table-responsive col-sm-12 font14">
                                    <div class="row">
                                        <div class="input-group col-sm-4">
                                            <input type="text" class="form-control no-bod-rad" placeholder="Search by name" name="search_str" id="search_str">
                                            <div class="input-group-btn">
                                                <!--  <button class="btn btn-default no-bod-rad" name="search" type="submit"><i class="fa fa-search"></i></button>-->
                                                <button class="btn btn-default no-bod-rad" name="search" type="submit" onClick="return search_val();">SEARCH</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-info no-bod-rad btn-sm"  name="refresh"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                                                <button type="submit" class="btn btn-primary no-bod-rad btn-sm"  name="create"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                                <button type="submit" class="btn btn-success no-bod-rad btn-sm" name="active"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Active</button>
                                                <button type="submit" class="btn btn-warning no-bod-rad btn-sm" name="inactive"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Inactive</button>
                                                <button type="submit" class="btn btn-danger no-bod-rad btn-sm" id="delete" name="delete" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php //print_r($sanghi);?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" id="CheckAll" value="">Select All
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th>S.No</th>
                                                    <th>Name of image</th>
                                                    <th>image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(count($row)>0){ 
                                                    	$si=$this->uri->segment(4,0);			
                                                    if($this->uri->segment(4,0)){
                                                                            $c=$this->uri->segment(4,0);
                                                    	$c= $c+1;
                                                    
                                                    					 }else{
                                                    						
                                                    					 $c=1;}
                                                    
                                                    foreach($row as $rec){?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check m-t-n15">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input cnames" name="cnames[]" value="<?php echo $rec['id'];?>" >
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $c;?></td>
                                                    <td>
                                                        <p><?php echo ucfirst($rec['name']);?></p>
                                                    </td>
                                                    <td><a href="" ><img src="<?php echo base_url().'uploads/files/'.$rec['file_name']; ?>" style="height:100px;width:100px;"/></a></td>
                                                    <td><?php $s=$rec['status'];
                                                        if($s==1){ ?>
                                                        <a  href="<?php echo base_url();?>admin/gallery/update_status/<?php echo $rec['id'];?>/<?php echo $rec['status'];?>/<?php echo $si;?>" class="badge badge-success">Active</a> 
                                                        <?php }else{?>
                                                        <a  href="<?php echo base_url();?>admin/gallery/update_status/<?php echo $rec['id'];?>/<?php echo $rec['status'];?>/<?php echo $si;?>" class="badge badge-danger">Inactive</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td><a title="Update" href="<?php echo base_url();?>admin/gallery/update_gallery_data/<?php echo $rec['id'];?>/<?php echo $si;?>"><i class="fa fa-pencil-square-o text-primary" aria-hidden="true" ></i>
                                                        </a>&nbsp;<a title="Delete" onclick="javascript:return confirm('Are you sure to delete');" href="<?php echo base_url();?>admin/gallery/delete_gallery/<?php echo $rec['id'];?>/<?php echo $si;?>"><i class="fa fa-trash text-danger" aria-hidden="true" ></i></a> &nbsp;
                                                    </td>
                                                </tr>
                                                <?php
                                                    $c=$c+1;
                                                    	 }}else{
                                                    
                                                    ?>
                                                <tr>
                                                    <td colspan="10" style="text-align:center; color:red;font-size:20px;">No Records Found...</td>
                                                </tr>
                                                <?php }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  <div class="col-sm-12 text-center">
                                    <div class="clearfix">&nbsp;</div>
                                    <button type="button" class="btn btn-info no-bod-rad"> &nbsp; &nbsp; ADD &nbsp; &nbsp; </button>    
                                    <button type="button" class="btn btn-purple no-bod-rad"> &nbsp; &nbsp; CLEAR &nbsp; &nbsp; </button>    
                                    
                                    <div class="clearfix">&nbsp;</div> 
                                    </div>-->
                                <div class="col-sm-12">
                                    <?php echo $links;?>
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
    //document.getElementById("#delete").style.pointerEvents = 'none';
    function search_val(){
    	//alert("hi");
    	var search_str=$('#search_str').val();
    	var flag = true;
    	$("#search_str").css("border","");
    	if(search_str == "")
     {
    	 flag = false;
    	 $("#search_err").html("Please Enter UserName Here");
    	 $("#search_str").css("border","1px solid red");
     }
     return flag;
    	}
    	
</script>
<script>
    $(document).ready(function(){
       
           
            $(".div3").fadeIn(3000).fadeOut(4000);
      
    });
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
    $(document).ready(function(){
    var selectedLanguage = new Array();
    $("#delete").click(function(){
    			 $('input[name="cnames[]"]:checked').each(function() {
    				var x = selectedLanguage.push(this.value);
    			 //alert(x);
    				});
    			 //alert("Number of selected Languages: "+selectedLanguage.length );die;
    			 var len=selectedLanguage.length;
    			 //alert(len);alert(len);
    			 if(!len==0){
    				// alert(len);
    				// return confirm('Are you sure to delete');" 
    			/*onclick = $("#delete").attr('onclick');
       $("#delete").attr('onclick','');
       showConfirm(onclick);*/
       //$('#delete').removeAttr('onClick').click(function(){
    	  // $("#delete").off('click'); 
    	  // $("#delete").attr('disabled','disabled');
    	  //  *** $('#delete').prop('disabled', true);
            //return false;	 
    		javascript:return confirm('Are you sure to delete');
    			 }
    			 
    			 
    			 });});
</script>
</body>
</html>