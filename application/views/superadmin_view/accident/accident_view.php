<!DOCTYPE html>
<html lang="en">
<head>
  <title>IRS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--
   Bootstrap css 
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
-->
   <!--  Style .css-->
<!--  <link type="text/css" href="<?php echo AM_CSS ;?>style.css" rel="stylesheet">-->
<link href="https://fonts.googleapis.com/css?family=NTR|Poppins|Roboto&display=swap" rel="stylesheet">
    <style>
    td {
    padding: 7px 5px;
}
    </style>
</head>
<body style="font-size:13px">
    <div style="width:900px;margin:0 auto;">
        <div style="text-align:center">
    <h3>Cr.No:<?php echo $data[0]->crno;?> u/s 304 (A) IPC OF <?php echo ucfirst($data[0]->ps_name);?> PS</h3>
    <h2 style="margin-bottom: 50px;font-size:17px">Accident Report from Motor Vehicles inspector.<?php echo ucfirst($data[0]->location);?></h2>
    </div><?php //echo "<pre>";print_r($data);?>
        <table style="width:100%;">
  <tr>
      <td>1. </td>
    <td>Name and address from whom the <br> Requisition is received </td>
    <td>: Station House Officer, <?php echo ucfirst($data[0]->ps_name);?> PS </td>
  </tr>
  <tr>
    <td>2. </td>
    <td>Date of receipt of the above by the <br> MotorVehicles Inspector </td>
    <td>: <?php echo date('d-m-Y',strtotime($data[0]->date_of_receipt));?> </td>
  </tr>
  <tr>
    <td>3. </td>
    <td>Date time and place of accident </td>
    <td>: On <?php echo date('d-m-Y',strtotime($data[0]->accident_date_time));?> at about <?php echo  date('H.i',strtotime($data[0]->accident_date_time));?> hr.
	</td>
  </tr>
  <tr>
    <td>4. </td>
    <td>Width of road and nature (bend turn curve <br> Gradient etc., 0 and a brief description of the <br> Locality of the accident</td>
    <td>:	<?php echo $data[0]->width_nature; ?></td>
  </tr>
  <tr>
    <td>5. </td>
    <td>Vehicles involved in accident ( With a brief <br> description Of the type make and <br>  mode of vehicle or vehicles With <br>  their registration number)</td>
    <td>: <?php echo $data[0]->registration_numbers; ?>
</td>
  </tr>
  <tr>
    <td>6. </td>
    <td>Date time and place of inspection</td>
    <td>: on <?php echo date('d-m-Y',strtotime($data[0]->inspection_date_time));?> at about <?php echo date('H.i',strtotime($data[0]->inspection_date_time));?> hr inspected the vehicle at <?php echo $data[0]->inspection_place;?>.</td>
  </tr>
  <tr>
    <td>7. </td>
    <td>Date of expiry of the Present fitness certificate</td>
    <td>: <?php $fitness_expiry_date = $data[0]->fitness_expiry_date;
	if($fitness_expiry_date !=""){
		echo $fitness_expiry_date;
	}else{
		echo '-----';
	}
	?>
</td>
  </tr>
  <tr>
    <td>8. </td>
    <td>Detail regarding damage sustained by the vehicle <br> or  vehicles due to accident</td>
    <td>: <?php echo ucwords($data[0]->veh_damage_details);?></td>
  </tr>
<!--
  <tr>
    <td>9. </td>
    <td>
      
      <p>  Conditions of brakes at the time of inspection<br>
     <ul>
          
Efficiency of Foot brake …………………..<br>
    	Efficiency of Parking (Hand Brake ……………..<br>
   	Even action or not
         </ul>
          </p>
           
      
      </td>
    <td>: Taken Road test of the vehicle and found the Braking system is in good     working condition.</td>
  </tr>
-->
              <tr>
    <td>9.</td>
    <td> Conditions of brakes at the time of inspection</td>
    <td>: <?php echo ucwords($data[0]->conditions_of_breaks); ?>.
</td>
  </tr>    
            <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>       <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>  
            <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>10. </td>
    <td>Conditions of tyres</td>
    <td>: <?php echo ucwords($data[0]->conditions_of_tyres); ?></td>
  </tr>
  <tr>
    <td>11. </td>
    <td>Date of validity of permit</td>
   <td>: <?php $permit_validity = $data[0]->permit_validity;
	if($permit_validity !=""){
		echo $permit_validity;
	}else{
		echo '-----';
	}
	?>
</td>
  </tr>
  <tr>
    <td>12. </td>
    <td>Date expiry of insurance. Name and address if <br> the company which issued the poly number <br> of policy and certificate.</td>
     <td>: <?php echo ucwords($data[0]->insurance_details); ?></td>
  </tr>
  <tr>
    <td>13. </td>
    <td>Name of the owner</td>
    <td>: <?php echo ucfirst($data[0]->owner_name);?>.</td>
  </tr>
  <tr>
    <td>14. </td>
    <td>Name of the driver</td>
   <td>: <?php echo ucfirst($data[0]->driver_name);?>.</td>
   </tr>
  <tr>
    <td></td>
    <td><ul>a). D.L. particulars.</ul></td>
   <td>: <?php echo ucfirst($data[0]->dl_particulars);?>.</td>
   </tr>
 <!-- <tr>
    <td></td>
    <td></td>
    <td>: Valid up to <?php echo date('d-m-Y',strtotime($data[0]->permit_validity));?> (TR)</td>
  </tr>-->
  <tr>
    <td>15. </td>
    <td> Whether the accident is due to mechanical<br> defects of the vehicles if so the reasons and <br> conclusions arrived at on inspection.</td>
   <td>: <?php echo ucfirst($data[0]->opinion);?>.</td>
   </tr>
</table>
        <p style="margin-top:60px;margin-left:27px">Copy submitted to D.T.C. / R.T.O.,</p>
    </div>
    </body>
</html>


