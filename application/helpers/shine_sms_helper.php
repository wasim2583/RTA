<?php
function send_user_sms($to,$message,$senderid)
{
/*Send Sms To user Code Stat*/
$usermobile=$to;
$url="http://cloud.smsindiahub.in/vendorsms/pushsms.aspx";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=apto&password=8096952023@A&msisdn=91$usermobile&sid=$senderid&msg=$message&fl=0&gwid=2");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$userresult = curl_exec($ch);
$usersmsresult=json_decode($userresult); 
//print_r($usersmsresult);exit;
return $userstatus=($usersmsresult->ErrorMessage=='Success')?1:0;
/*Send Sms To user Code End*/
}
?>