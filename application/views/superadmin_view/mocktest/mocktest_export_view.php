<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
 <head> 
   <meta charset="utf-8"> 
   <title>Welcome to CodeIgniter</title>
 </head>
 <body>
   <!-- Export Data --> 
   <a href='<?= base_url() ?>index.php/superadmin/export_map_controller/exportCSV'>Export</a><br><br>

   <!-- User Records --> 
   <table border='1' style='border-collapse: collapse;'> 
     <thead> 
      <tr> 
       <th>Name</th>  <th>Dob</th>  <th>Gender</th>  <th>Mobile</th>  <th>Email</th>  <th>Address</th>  <th>ICE-Contact1</th>  
	    <th>ICE-Contact2</th>  <th>Medical Conditions</th>  <th>Blood Group</th>  <th>Agree Terms</th>  <th>Agree Support</th>
		<th>Agree Communication</th> <th>Password</th>  <th>Verification Code</th>  
       <th>Last login date</th> <th>Registered on</th> <th>Membership date</th>    <th>Last login ip</th>  <th>status</th>  
       <th>Mobile verified status</th> 
       <th>Otp</th> 
      </tr> 
     </thead> 
     <tbody> 
     <?php
     foreach($usersData as $key=>$val){ 
	 exit;
       echo "<tr>"; 
       echo "<td>".$val['name']."</td>"; 
		   echo "<td>".$val['dob']."</td>"; 
		  echo $g= $val['gender'];exit;
		if($g==1) {  echo "<td>Male</td>";}
		//if($gender==2) {  echo "<td>"."FeMale"."</td>";}
		//if($gender==3)  { echo "<td>"."Other"."</td>";}
		 echo "<td>".$val['mobile']."</td>"; 
		 echo "<td>".$val['email']."</td>"; 
		 echo "<td>".$val['address']."</td>";
		 echo "<td>".$val['ice_contact_1']."</td>"; 	   
		 echo "<td>".$val['ice_contact_2']."</td>"; 	   
		   echo "<td>".$val['medical_conditions']."</td>"; 
		   echo "<td>".$val['blood_group']."</td>"; 
			echo "<td>".$val['agree_terms']."</td>"; 
			 echo "<td>".$val['agree_support']."</td>"; 
			echo "<td>".$val['agree_communication']."</td>"; 
			echo "<td>".$val['password']."</td>"; 
		   echo "<td>".$val['verification_code']."</td>"; 
		   echo "<td>".$val['last_login_date']."</td>";
		 echo "<td>".$val['registered_on']."</td>"; 
		 echo "<td>".$val['membership_date']."</td>"; 
		 echo "<td>".$val['last_login_ip']."</td>";
		 echo "<td>".$val['user_status']."</td>"; 
		   echo "<td>".$val['mobile_verified_status']."</td>"; 
		   echo "<td>".$val['otp']."</td>";
       echo "</tr>"; 
      } 
      ?> 
     </tbody> 
    </table>
  </body>
</html>