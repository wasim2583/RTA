<!DOCTYPE html>
<html lang="en">
<head>
  <title>form page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--
   Bootstrap css 
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
-->
   <!--  Style .css-->
  <link type="text/css" href="css/style.css" rel="stylesheet">
    
<link rel="stylesheet" href="http://ksgrandprojects.com/assets/frontend/css/bootstrap.min.css">
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--Google Fonts CDN-->
<link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Poppins|Quattrocento+Sans|Josefin+Sans" rel="stylesheet">

</head>
<body class="font3">
<!-- Header Start-->
<div class="container-fluid no-padd">
<nav class="navbar navbar-expand-md bg-light navbar-dark" style="    background: #4e596b !important;">
  <a class="navbar-brand" href="#"><img src="img/logo.png" style="width:200px" class="img-fluid"></a>
 
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <div class="offset-sm-10 col-sm-2">
           <div class="dropdown mr-auto">
    <button type="button" class="bg-secondary dropdown-toggle col-wh" data-toggle="dropdown">
     Hi, Peter
    </button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Change Password</a>
    <div class="dropdown-divider"></div>
     <a class="dropdown-item" href="#">Logout</a>
    </div>
  </div></div>
  </div>  
</nav>
    </div>
<!--Header End-->
<!-- Menu Start-->
<section>
<div class="container-fluid no-padd">
<div class="row">
<div class="col-sm-2 side-menu  navbar-expand-sm bg-site padd-right">
     <button class="navbar-toggler btnn-coll" type="button" data-toggle="collapse" data-target="#collapsibleNavbar1">
<!--    <span class="navbar-toggler-icon bg-site" style="color:red !important"></span>-->
     <i class="fa fa-bars bg-site mr-auto"></i>
  </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar1">
        <ul>
              <li class="active"> 
               <a href="form.php">
                 <h5> <i class="fa fa-tachometer"></i> &nbsp; Form </h5>
               </a>
              </li>
                 <li> 
                 <a href="table.php">
                  
                   <h5> <i class="fa fa-users"></i> &nbsp; Table</h5>
                 </a>
              </li>  
              <li> 
                <a href="#collapse-account" data-toggle="collapse" aria-controls="collapse-account" class="collapsed" aria-expanded="false">          
                    <span class="hidden-xs hidden-sm"><i class="fa fa-database"></i> &nbsp; <span class="f14"> Dropdown </span><b class="caret pull-right"></b></span><i class="fa fa-angle-down float-right col-wh" style="margin-top:10px"></i>
                </a>
                <ul class="collapseable collapse" id="collapse-account" aria-expanded="false" style="height: 5px;border-left: 1px solid #ddd;"> 
                      <li class="m-t-12"> 
                        <a href="#" class="f14">Dropdown1</a> 
                      </li> 
                      <li> 
                        <a href="#" class="f14">Dropdown2</a> 
                      </li> 
                      <li> 
                        <a href="#" class="f14">Dropdown3</a> 
                      </li> 
                      <li> 
                        <a href="#" class="f14">Dropdown4</a> 
                      </li> 
                </ul>
              </li> 
     
         
    
         
            <div class="bg-site" style="height: 300px"></div>
        </ul>
    </div>
</div>
<div class="col-sm-10">
    <form>
        <div class="col-sm-12">
    <div class="row m-t-15" style="margin-right: 0px;">


  <div class="bg-site col-wh col-sm-12 head-pad hgh-40"> 
    <h5 class="m-t-n6" style="margin-bottom: 0px;">Task</h5>    
        </div>
 <div class="col-sm-12 bg-light inventory">
     <div class="clearfix">&nbsp;</div>
     <div class="table-responsive col-sm-12 font14">
    <div class="row">
  <div class="col-sm-3">
    <select class="form-control no-bod-rad">
      <option>Select</option>
      <option>1</option>
      <option>2</option>
    </select>
  </div>
   <div class="input-group col-sm-4">
      <input type="text" class="form-control no-bod-rad" placeholder="Search" name="search">
      <div class="input-group-btn">
        <button class="btn btn-default no-bod-rad" type="submit"><i class="fa fa-search"></i></button>
      </div>
    </div>
    <div class="col-sm-5">
      <span class="badge badge-primary bag-pad"> <i class="fa fa-plus" aria-hidden="true"></i> Create</span>
      <span class="badge badge-success bag-pad"> <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Active</span>
      <span class="badge badge-warning bag-pad col-wh"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> In-Active</span>
      <span class="badge badge-danger bag-pad">  <i class="fa fa-trash" aria-hidden="true"></i> Delete</span>
    </div>
 <div class="clearfix">&nbsp;</div>
  </div>
 <table class="table table-striped table-bordered">
                  <thead>
                  <tr>
                      <th>  <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="">Check All
      </label>
    </div></th>
                      <th>Username</th>
                      <th>Date registered</th>
                      <th>Role</th>
                      <th>Status</th> 
                      <th>Action</th>
                  </tr>
              </thead>   
              <tbody>
                <tr>
                    <td><div class="form-check m-t-n15">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="">
      </label>
    </div></td>
                    <td>Donna R. Folse</td>
                    <td>2012/05/06</td>
                    <td>Editor</td>
                    <td><span class="badge badge-success">Active</span> </td>    
                    <td><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i> &nbsp;<i class="fa fa-trash text-danger" aria-hidden="true"></i> &nbsp;<i class="fa fa-eye text-dark" aria-hidden="true"></i></td>
                </tr>
                <tr>
                        <td><div class="form-check m-t-n15">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="">
      </label>
    </div></td>
                    <td>Emily F. Burns</td>
                    <td>2011/12/01</td>
                    <td>Staff</td>
                    <td><span class="badge badge-important">Banned</span></td>    
                    <td><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i> &nbsp;<i class="fa fa-trash text-danger" aria-hidden="true"></i> &nbsp;<i class="fa fa-eye text-dark" aria-hidden="true"></i></td>
                </tr>
                <tr>
                        <td><div class="form-check m-t-n15">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="">
      </label>
    </div></td>
                    <td>Andrew A. Stout</td>
                    <td>2010/08/21</td>
                    <td>User</td>
                    <td><span class="badge badge-danger">Inactive</span></td>      
                    <td><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i> &nbsp;<i class="fa fa-trash text-danger" aria-hidden="true"></i> &nbsp;<i class="fa fa-eye text-dark" aria-hidden="true"></i></td>
                </tr>
                <tr>
                        <td><div class="form-check m-t-n15">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="">
      </label>
    </div></td>
                    <td>Mary M. Bryan</td>
                    <td>2009/04/11</td>
                    <td>Editor</td>
                    <td><span class="badge badge-warning col-wh ">Pending</span></td>    
                    <td><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i> &nbsp;<i class="fa fa-trash text-danger" aria-hidden="true"></i> &nbsp;<i class="fa fa-eye text-dark" aria-hidden="true"></i></td>
                </tr>
                <tr>
                        <td><div class="form-check m-t-n15">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="">
      </label>
    </div></td>
                    <td>Mary A. Lewis</td>
                    <td>2007/02/01</td>
                    <td>Staff</td>
                    <td><span class="badge badge-success">Active</span></td>    
                    <td><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i> &nbsp;<i class="fa fa-trash text-danger" aria-hidden="true"></i> &nbsp;<i class="fa fa-eye text-dark" aria-hidden="true"></i></td>
                </tr>                                   
              </tbody>
            </table>

        </div>
 
         <div class="col-sm-12 text-center">
        <div class="clearfix">&nbsp;</div>
    <button type="button" class="btn btn-info no-bod-rad"> &nbsp; &nbsp; ADD &nbsp; &nbsp; </button>    
       <button type="button" class="btn btn-purple no-bod-rad"> &nbsp; &nbsp; CLEAR &nbsp; &nbsp; </button>    
      
        <div class="clearfix">&nbsp;</div> 
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
</body>
</html>


