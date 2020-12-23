<?php $accident_info=$data; ?>
<html><body>
			<p>To</p><p align ="right"><?php 
			$newDate = date("d-m-Y", strtotime($accident_info[0]->date));
			if($accident_info[0]->date=="0000-00-00")
			echo "----";
			else
			echo $newDate;
			?></p>
			<p>The Station House Officer,</p> 
			<p><strong><?php echo ucfirst($accident_info[0]->location); ?></strong></p>
			<br/>
			<p>Sir,</p>
			<div style="width:80%;margin:0 auto">
			  <div style="width:12%;float:left">
			<p>Sub :</p>
			</div>
			 <div style="width:88%;float:left">
			<p style="margin-top:20px"> Transport Department – Request for necessary action against for Drunken Drive cases U/S.185 of MV Act – Regarding. </p>
			</div>
               <div style="width:12%;float:left"> 
			<p>Ref : </p> 
			</div>
			 <div style="width:88%;float:left">
			<p> 	1)	Memo No:1638/V3/2015, Dated 07.04.2015 issued by the Transport Commissioner, A.P, Hyderabad 
			</p>
			</div>
			</div>
					<div style='text-align:center'><p>-o0o-</p></div>

				<p>With reference to the above subject on <u><?php $originalDate =$accident_info[0]->date;$newDate = date("d-m-Y", strtotime($originalDate));  echo $newDate; ?></u>  from  <u><?php echo $accident_info[0]->from_hrs;?></u>hrs to <u><?php echo $accident_info[0]->to_hrs;?></u>hrs, I conducted vehicle checking at <u><?php echo $accident_info[0]->city;?></u> with my staff, while on our checking I found that the following driver/drivers are driving their vehicle under the influence of alcohol.</p>
				<p>Hence I conducted breath analyser test to the vehicle driver and found that the following driver is having total BAC levels are exceeding the permissible limits as per Sec. 185(a) of MV Act.</p>
				<table style="width:100%" border='1' cellpadding='0' cellspacing='0'>
				<tr><th>Sl. No</th><th>Accused-1 (Driver) <br/>Name & Address</th><th>Accused-2 (Owner)<br/>Name & Address</th><th>Vehicle No</th><th>VCR No</th></tr>
				<?php
				$k = 1;
				foreach($accident_info as $info)
				{
					?>
					<tr><td style="text-align:center;padding:10px"><?php echo $k; ?></td><td style="text-align:center;padding:10px"><?php echo $info->driver_details; ?></td><td style="text-align:center;padding:10px"><?php echo $info->owner_details; ?></td><td style="text-align:center;padding:10px"><?php echo $info->vehicle_number; ?></td><td style="text-align:center;padding:10px"><?php echo $info->vcr_number; ?></td></tr>
					<?php
					$k++;
				}
				?>
				</table>		
							
				<p>As per the office records the offence committed by the driver is first/second time and the offence committed by the vehicle owner is first/second offence.</p>
				<p>Therefore I request you to launch prosecution as per Law U/S.185 of MV Act 1988 & U/s. 3 & 4 of MV Act 1988 r/w 180 & 181 of MV Act.</p>

				<p>Thanking you Sir,</p>
			<div style='text-align:right'><p>Yours sincerely,</p></div>
<div align="right" class="fs16"><?php //echo ucfirst($accident_info[0]->submitted_to); ?> </div>
			<h3>Encl:</h3>
			<p>1.	Breath Analyser Test Report</p>
			<p>2.	VCR</p>



			<p>Copy submitted to the Deputy Transport Commissioner,for kind information.</p>

					</body></html>