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
    <form method="post" action="<?php echo HTTP_BASE_PATH;?>admin/members/search_members/<?php echo $si;?>/<?php echo $group_id;?>" >
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
    <h5 class="m-t-n6" style="margin-bottom: 0px;">Group members<?php if(isset($ac)) echo "hi";?></h5>    
        </div>
        <?php $ac=$this->session->flashdata('ac');
		 if($ac){?>      
		 <div class="alert alert-success div3 col-sm-12">
         <strong>Success!</strong><?php echo $ac;?>
		 </div> <?php }?> 
		 
		 <?php 	 $no_ac=$this->session->flashdata('no_ac');
		 if($no_ac){?>      
		 <div class="alert alert-danger div3 col-sm-12">
         <strong></strong><?php echo $no_ac;?>
		 </div> <?php }?> 
		 		
         <?php $inc=$this->session->flashdata('inc');
		if($inc){?>      
		<div class="alert alert-success div3 col-sm-12">
		<strong>Success!</strong><?php echo $inc;?>
		</div><?php  }?> 
		
        <?php  $no_inc=$this->session->flashdata('no_inc');
		if($no_inc){?>      
		<div class="alert alert-danger div3 col-sm-12">
		<strong></strong><?php echo $no_inc;?>
		</div><?php  }?> 		
			
        
        <?php $dc=$this->session->flashdata('dc');
		if($dc){?>      
		<div class="alert alert-success div3 col-sm-12">
		<strong>Success!</strong><?php echo $dc;?>
		</div><?php  }?> 		
		        		
        <?php $status=$this->session->flashdata('status');
		if($status){?>      
		<div class="alert alert-success div3 col-sm-12">
		<strong>Success!</strong><?php echo $status;?>
		</div> <?php  }?> 
		      		
        <?php  $dmsg=$this->session->flashdata('dmsg');
		if($dmsg){?>      
		<div class="alert alert-success div3 col-sm-12">
        <strong>Success!</strong><?php echo $dmsg;?>
		</div><?php  }?>
				 	
        <?php  $select=$this->session->flashdata('select');
		if($select){?>      
		<div class="alert alert-danger div3 col-sm-12">
		<strong></strong><?php echo $select;?>
		</div><?php  }?>
  	
        <?php $updateuser=$this->session->flashdata('updateuser');
		if($updateuser){?>      
		<div class="alert alert-success div3 col-sm-12">
		<strong></strong><?php echo $updateuser;?>
		</div> <?php  }?>

				
        <?php  $notupdateuser=$this->session->flashdata('notupdateuser');
	    if($notupdateuser){?>      
	    <div class="alert alert-danger div3 col-sm-12">
		<strong></strong><?php echo $notupdateuser;?>
		</div><?php  }?>

        <?php  $duplicateupdateuser=$this->session->flashdata('duplicateupdateuser');
	    if($duplicateupdateuser){?>      
	    <div class="alert alert-danger div3 col-sm-12">
		<strong></strong><?php echo $duplicateupdateuser;?>
		</div><?php  }?>		
		
 
        <?php  $insertuser=$this->session->flashdata('insertuser');
		if($insertuser){?>      
		<div class="alert alert-success div3 col-sm-12">
		<strong>Success!</strong><?php echo $insertuser;?>
		</div><?php  }?> 
		
 	 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class="table-responsive col-sm-12 font14">
    <div class="row">
  
    <div class="input-group col-sm-4">
      <input type="text" class="form-control no-bod-rad" placeholder="Search by Member name" name="search_str" id="search_str">
      <div class="input-group-btn">
      <!--  <button class="btn btn-default no-bod-rad" name="search" type="submit"><i class="fa fa-search"></i></button>-->
	  <button class="btn btn-info no-bod-rad" name="search" type="submit" onClick="return search_val();">SEARCH</button>
	  
    </div>
    </div>
    <div class="col-sm-6 offset-sm-2">
	    <div class="pull-right">
		   <button type="submit" class="btn no-bod-rad btn-sm"  name="refresh"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
		   <button type="submit" class="btn btn-success no-bod-rad btn-sm" name="active"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Active</button>
		   <button type="submit" class="btn btn-warning no-bod-rad btn-sm" name="inactive"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Inactive</button>
		   <button type="submit" class="btn btn-danger no-bod-rad btn-sm" id="delete" name="delete" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
        </div>                 
    </div>
    <div class="clearfix">&nbsp;</div>
  </div>
        <table class="table table-striped table-bordered">
			<thead>	
			  <tr>
			  	<th rowspan="2" style="text-align:center;vertical-align:middle">  
					  <div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" id="CheckAll" value="">Select All
							</label>
					  </div>
				  </th>
				  <th rowspan="2" style="text-align:center;vertical-align:middle"> SI.NO </th>
				  <th colspan="4" style="text-align:center">Group Members</th> 
			  </tr>
			  <tr>
				  <th style="text-align:center">Member</th>
				  <th style="text-align:center">Added On</th>
				  <th style="text-align:center">Status</th>
				  <th style="text-align:center">Action</th>
			  </tr>
		    </thead>   
            <tbody>
			  <?php 
			   if(count($row)>0){
				   $si=$this->uri->segment(4,0);
				   if($this->uri->segment(4,0)){
					   $c=$this->uri->segment(4,0);
					   $c= 1;
					}
					else{
						$c=0;
					}
			        foreach($row as $rec)
					{
						?>
						<tr>
							<td style="text-align:center"><div class="form-check m-t-n15">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input cnames" name="cnames[]" value="<?php echo $rec['member_id'];?>" >
								</label>
								</div></td>
						    <td style="text-align:center"><?php echo $c;?></td>
							
                            <td style="text-align:center"><p><?php echo ucfirst($rec['name']);?></p></td>
							<td style="text-align:center"><?php $v=$rec['added_on'];$v=explode(" ",$v);$d=$v[0];$d=explode("-",$d);$r=array_reverse($d);$cd=implode('/',$r);
					        echo $cd;
					        ?></td>
                            <td style="text-align:center">
							    <?php $status=$rec['member_status'];
					             if($status==1)
								 {
									?>
					                <a  href="<?php echo base_url();?>admin/members/update_specific_member/<?php echo $rec['member_id'];?>/<?php echo $rec['member_status'];?>/<?php echo $si;?>" class="badge badge-success">Active</a> 
					              <?php
						          }
						          else{
									  ?>
									  <a  href="<?php echo base_url();?>admin/members/update_specific_member/<?php echo $rec['member_id'];?>/<?php echo $rec['member_status'];?>/<?php echo $si;?>" class="badge badge-danger">Inactive</a>
								  <?php
								  }
								  ?>
							</td>
							
                            <td style="text-align:center"> 
					        </a>&nbsp;<a title="Delete" onclick="javascript:return confirm('Are you sure to delete');" href="<?php echo base_url();?>admin/members/delete_specific_member/<?php echo $rec['member_id'];?>/<?php echo $si;?>"><i class="fa fa-trash text-danger" aria-hidden="true" ></i></a> &nbsp;</td>
                
				    </tr>
			        <?php
				    $c=$c+1;
					 }}else{
				
				    ?><tr><td colspan="10" style="text-align:center; color:red;font-size:20px;">No Records Found...</td></tr>
                        <?php
						}
						?>
                                             
              </tbody>
            </table>

        </div>
 
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
			 
			 
			 });});</script>
</body>
</html>


