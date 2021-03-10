<?php 
  $email=$this->session->userdata('admin_email');
  if(!empty($email)){
    redirect('admin/users/user_information');}
    ?>
<! Doctype html>
<html>
  <head>
    <!--Designed By Khaja-->
    <meta charset="utf-8">
    <title>IRS</title>
    <meta name="viewport" content="width=device-width , initial-scale =1">
    <!-- Style.Css Link-->
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Google Fonts CDN-->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato|Montserrat|Raleway|Roboto" rel="stylesheet">
    <style>
      .input-group-addon{ border-bottom: 1px solid #ccc !important;padding: 10px}
      .login-body{background-image: url(admin_assets/img/login-bg.jpg);background-size: 100% 100% }
      .bg-wl{    background:#eeeeee;}
      .form-control{     color: #FDFCFD;   border-bottom: 1px solid #ccc !important;border-left: none !important;border-right: none !important;border-top: none !important;background-color: transparent !important}
      .overlay{background-color: rgba(0,0,0,0);}
      .form-control:focus{box-shadow: none!important}
      ::placeholder{color:#fff !important}
      .error{
      color: red;
      }
      .error1{
      border:1px solid red!important;
      }
      .input{
      border:1px solid red;
      }
      .bgOpacity {
    background-color: rgba(0,0,0,0.6);
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
}
    </style>
  </head>
  <body class="login-body" style="background-image: url(<?php echo base_url();?>admin_assets/img/pexels-photo-1955134.jpeg);background-size: 100% 100%;background-repeat:no-repeat !important">
    <div class="overlay">
      <!-- Content Section Start-->
      <div class="bgOpacity"></div>
      <section>
        <div class="container-fluid font5">
          <div class="container">
            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
              <div class="col-sm-4 offset-sm-4 bg-wl no-padd card">
                <?php if($msg=$this->session->flashdata('message')){
                  $message=$this->session->flashdata('message');
                  
                  echo "<div id='div3'  class='div3 alert alert-danger'>".$message."</div>";
                  }?>
                <div class="text-center">
                  <div class="clearfix">&nbsp;</div>
                  
                    <h1><a href="<?php echo base_url();?>">I.R.S</a></h1>
                  
                </div>
                <form method="post" action="<?php echo base_url();?>admin/login_validation" onsubmit="return validate_form();" >
                  <div style="padding:0px 2px">
                    <div class="form-group col-sm-12">
                      <div class="input-group">
                        <div class="input-group-addon">
                          &nbsp; <i class="fa fa-user"></i> &nbsp;
                        </div>
                        <input class="form-control"  name="email" id="email" placeholder="Email" value="<?php echo set_value('email');?>"  type="text"
                          <?php if(form_error('email')!=""){echo "class='error1 form-control input-md'";} ?>/>
                      </div>
                      <span id="email_err" style="color:red"></span><?php echo form_error('email', '<div class="error ">', '</div>'); ?>
                    </div>
                    <!--<div class="form-group col-sm-12">
                      <div class="input-group">
                         <div class="input-group-addon">
                           &nbsp; <i class="fa fa-user"></i> &nbsp;
                         </div>
                         <input class="form-control" value="Mobile" type="text"/>
                       </div>
                      </div>-->
                    <div class="form-group col-sm-12">
                      <div class="input-group">
                        <div class="input-group-addon">
                          &nbsp; <i class="fa fa-lock" aria-hidden="true"></i> &nbsp;
                        </div>
                        <input class="form-control" name="pwd" id="pwd" value="<?php echo set_value('pwd');?>" placeholder="Password" type="password" 
                          value="<?php echo set_value('pwd');?>" <?php if(form_error('pwd')!=""){echo "class='error1 form-control input-md'";} ?>/>
                      </div>
                      <span id="Pwd_err" style="color:red"></span><?php echo form_error('pwd', '<div class="error ">', '</div>'); ?>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <!-- <div class="checkbox col-sm-12">
                      <span class="float-right font14"><a href="#">Forgot password?</a></span>
                      </div>-->
                    <div class="clearfix">&nbsp;</div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-danger col-sm-12 no-bod-rad">Sign-in</button>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <!--
                      <hr>
                      <p class="text-center">Don't have an account.? <a href="#"> SignUp here</a></p>
                      -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="clearfix">&nbsp;</div>
      <div class="clearfix">&nbsp;</div>
      <div class="clearfix">&nbsp;</div>
      <div class="clearfix">&nbsp;</div>
      <div class="clearfix">&nbsp;</div>
    </div>
    <!-- Content Section end-->
    <!-- Bootstarp Scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
         
             
              $(".div3").fadeIn(3000).fadeOut(4000);
        
      });
      function validate_form(){
       var email=$('#email').val();
       var pwd=$('#pwd').val();//alert(pwd);die;
       var flag = true;
       $("#email,#pwd").css("border","");
       $("#email_err,#Pwd_err").html("");//alert("hi");
      if(email == "")
             { 
               flag = false;
               $("#email_err").html("Please enter email");
               $("#email").css("border","1px solid red");
             }else{
      var regEx = /^[a-zA-Z0-9\-.\s]+@[a-zA-Z0-9]+.[A-Za-z]+$/;
        var vemail=regEx.test(email);
        if(!vemail){
          flag = false;
           $("#email_err").html("Please enter valid email");
         $("#email").css("border","1px solid red");
          
       }
       }   
       if(pwd == "")
       { 
         flag = false;
         $("#Pwd_err").html("Please Enter Password Here");
         $("#pwd").css("border","1px solid red");
       }
       return flag;
      }
       
    </script>
  </body>
</html>