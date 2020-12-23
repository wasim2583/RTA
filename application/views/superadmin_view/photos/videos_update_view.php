<?php 
  
?>
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
        <?php //$s=$this->uri->segment(4);?>
        <form method="post" action="<?php echo base_url().'admin/videos/update_videos/'.$this->uri->segment(4).'/'.$this->uri->segment(5);?>" enctype="multipart/form-data" onsubmit=" return validate_videos();">
          <div class="col-sm-12">
            <div class="row m-t-15" style="margin-right: 0px;">
              <div class="bg-site col-wh col-sm-12 head-pad hgh-40">
                <h5 class="m-t-n6" style="margin-bottom: -4px;">Update Videos</h5>
                <a href="<?php echo base_url();?>admin/videos/manage_videos" class="btn btn-primary btn-sm no-bod-rad pull-right" name="manage_videos" style="margin-top: -20px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Manage Videos</a>
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
                <div class=" col-sm-12 offset-sm-1 font14">
                  <div class="row">
                    <div class="clearfix">&nbsp;</div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="usr"> Title:</label>
                        <input type="text"  id="title" name="title" value="<?php echo set_value('title',$row['title']);?>" <?php if(form_error('title')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
                        <?php echo form_error('title', '<span  class="error ">','</span>');?> <span class="" id="title_err" style="color:red"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="usr"> Url:</label>
                        <input type="hidden" name="old_image" value="<?php echo $row['url']; ?>">
                        <input type="text"  id="url" name="url" value="<?php echo set_value('url',$row['url']);?>" <?php if(form_error('url')!=""){echo "class='error1 form-control input-md'";}else{ echo 'class="form-control no-bod-rad"';} ?> >
                        <?php echo form_error('url', '<span  class="error ">','</span>');?> <span class="" id="url_err" style="color:red"></span>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="location">Location:</label>
                        <select class="form-control" name="location" id="location">
                          <option value="">--Select Location--</option>
                          <?php
                          foreach($locations as $loc)
                          {
                            ?>
                          <option value="<?php echo $loc->id; ?>" <?php echo ($loc->id == $row['location']) ? 'selected' : ''; ?>><?php echo $loc->location_name; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="usr">Status:</label>
                        <select  class="form-control" name="status" id="status">
                          <option value="1" <?php if($row['status'] ==1) echo 'selected';?>>Active</option>
                          <option value="2" <?php if($row['status'] ==2) echo 'selected';?> >InActive</option>
                        </select>
                        <span id="status_err" style="color:red"><?php echo form_error('status', '<span  class="error dname">', '</span>'); ?></span>
                      </div>
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
</body>
</html>
<script>
  function validate_videos(){
    var title=$('#title').val();
    var url=$('#url').val();
     var status=$('#status').val();
   var flag = true;
   $("#title,#url,#status").css("border","");
   $("#title_err,#url_err,#status_err").html("");//alert("hi");
  if(title == "")
   {
     flag = false;
     $("#title_err").html("Please enter title");
     $("#title").css("border","1px solid red");
   }
   else{
      var regEx = /^([a-zA-Z]+[a-zA-Z\-.\s]{2,60})+$/;
      var vname=regEx.test(title);
      if(!vname){
      flag = false;//alert("wrong");
      $("#title_err").html("Please enter valid title");
      $("#title").css("border","1px solid red");  
   }
   }
   if(url == "")
   {
     flag = false;
     $("#url").css("border","1px solid red");
     $("#url_err").html("Please enter url");
   }
  else{
  var urlRegEx = /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/;
      var vname=urlRegEx.test(url);
      //alert(vname);
      if(!vname){
      flag = false;
    $("#url_err").html("Please enter valid url");
       $("#url").css("border","1px solid red"); 
   }}
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