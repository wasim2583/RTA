<?php $segment=$this->uri->segment(2);?>
<div class="col-sm-2 side-menu  navbar-expand-sm bg-site padd-right">
    <button class="navbar-toggler btnn-coll" type="button" data-toggle="collapse" data-target="#collapsibleNavbar1">
<!--    <span class="navbar-toggler-icon bg-site" style="color:red !important"></span>-->
     <i class="fa fa-bars bg-site mr-auto"></i>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar1">
        <ul>
              <li <?php if($segment=="dashboard"){echo 'class="active"';}?>> 
                  <!-- <a href="<?php echo HTTP_BASE_PATH;?>admin/dashboard">    
                    <h5> <i class="fa fa-tachometer"></i> &nbsp; Dashboard</h5>
                  </a> -->
                  <a href="">    
                    <h5> <i class="fa fa-tachometer"></i> &nbsp; Dashboard</h5>
                  </a>
              </li>
                
			        <li <?php if($segment=="users"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/users/user_information">                  
                    <h5> <i class="fa fa-user"></i> &nbsp; Users</h5>
                  </a>
              </li> 
			  <li <?php if($segment=="gallery" ){echo 'class="active"';}?><?php if($segment=="videos" ){echo 'class="active"';}?>><a href="#" data-toggle="collapse" data-target="#gallery"><h5> <i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp; Gallery <span class="float-right">  <i class="fa fa-angle-down" aria-hidden="true"></i> </span></h5>
                 <ul class="collapse bg-light" id="gallery">
                     <li><a href="<?php echo HTTP_BASE_PATH;?>admin/gallery/gallery_information"><h5>Gallery photos</h5></a></li>
                     <li><a href="<?php echo HTTP_BASE_PATH;?>admin/videos/manage_videos"><h5>Gallery videos</h5></a></li>
                 </ul>
                 </a></li>
			       
              <li <?php if($segment=="groups" or $segment=="groups"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/groups/group_information"> 
                     <h5> <i class="fa fa-users"></i> &nbsp; Groups</h5>
                  </a>
              </li>

			        <li <?php if($segment=="members"){echo 'class="active"';}?>> 
                  <a href="">
                    <h5> <i class="fa fa-users"></i> &nbsp; Group Members</h5>
                  </a>
              </li>

            <!--  <li <?php if($segment=="posts"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/posts/posts_information">
                    <h5> <i class="fa fa-envelope"></i> &nbsp;  Posts</h5>
                  </a>
              </li>-->

              <li <?php if($segment=="irsc_members"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/irsc_members/irsc_members_information">
                    <h5> <i class="fa fa-envelope"></i> &nbsp;  IRSC Members</h5>
                  </a>
              </li>

              <li <?php if($segment=="irsc_partners"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/irsc_partners/irsc_partners_information">
                    <h5> <i class="fa fa-envelope"></i> &nbsp;  IRSC Partners</h5>
                  </a>
              </li>

              <li <?php if($segment=="messages"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/messages/messages_information">
                    <h5> <i class="fa fa-comment"></i> &nbsp;  Messages</h5>
                  </a>
              </li>
			  <li <?php if($segment=="headings"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/headings/add_heading">
                    <h5> <i class="fa fa-comment"></i> &nbsp;  Department Data</h5>
                  </a>
              </li>
			  <li <?php if($segment=="mocktest"){echo 'class="active"';}?>> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/mocktest/add_mocktest">
                    <h5> <i class="fa fa-comment"></i> &nbsp;  Mock Test</h5>
                  </a>
              </li>
			 
			  <!--  <li <?php if($segment=="change_password"){echo 'class="active"';}?>> 
                 <a href="<?php echo HTTP_BASE_PATH;?>admin/change_password">                  
                   <h5> <i class="fa fa-wrench"></i> &nbsp; Change Password</h5>
                 </a>
              </li>-->
		
			  <li <?php if($segment=="slider"){echo 'class="active"';}?>> 
                 <a href="<?php echo HTTP_BASE_PATH;?>superadmin/slider/slider_information">                  
                   <h5> <i class="fa fa-users"></i> &nbsp;Slider</h5>
                 </a>
              </li>
			        <li> 
                  <a href="<?php echo HTTP_BASE_PATH;?>admin/logout">   
                    <h5> <i class="fa fa-off"></i> &nbsp; Logout </h5>
                  </a>
              </li>
              
            <div class="bg-site" style="height: 300px"></div>
        </ul>
    </div>
</div>