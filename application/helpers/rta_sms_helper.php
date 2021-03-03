<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
	    
    function send_mobile_activation($user_type, $mobile_number, $userId='')
    {
        $ci = get_instance();
        $ci->load->model('User_model');
        $user_id = $ci->session->userdata('member_id')?$ci->session->userdata('member_id'):$userId;
		//Send the code and insert the code in db
		$random_number = rand(100000, 999999);
		$user = ['activation_code'=>$random_number];
		$insert_activation = $ci->User_model->set_activation_code($user_id, $user);
		send_mobile_activation_code($random_number, $mobile_number);
		if($insert_activation){
			if($userId){
				return true;
			}
			//send message and redirect verification page
			$ci->session->set_flashdata('activation_sent', 'Activation code sent.');
			redirect('base/verify_activation/mobile/'.$user_type);
		}
    }


	function send_mobile_activation_code($code, $mobile)
	{
		try {
		$ci = get_instance();
		$sms_api_url = $ci->config->item('sms_api_url');
		$sms_from = $ci->config->item('sms_from');
		$sms_message = urlencode($ci->config->item('sms_message')).$code;
		$sms_userid = $ci->config->item('sms_user');
		$sms_password = $ci->config->item('sms_password');
		$url = $sms_api_url.'username='.$sms_userid.'&password='.$sms_password.'&to='.$mobile.'&from='.$sms_from.'&message='.$sms_message;
		
		$response =  file_get_contents($url);
		return $response;
		}
		catch (Exception $e) {
			return false;
		}
	}
/*
    function send_email_activation($user_type,$email_id,$userId='')
    {
        $ci = get_instance();
        $ci->load->model('User_model');
        $user_id = $ci->session->userdata('reg_id')?$ci->session->userdata('reg_id'):$userId;
		$random_number = rand(100000, 999999);
		$user = ['activation_code'=>$random_number];
		$insert_activation = $ci->User_model->set_activation_code($user_id,$user);
		send_email_activation_code($random_number,$email_id);
		if($insert_activation){
			if($userId){
				return true;
			}
			$ci->session->set_flashdata('activation_sent', 'Activation code sent.');
			redirect('auth/verify_activation/mail/'.$user_type);
		}
    }

	function send_email_activation_code($code,$email){
		
		$ci = get_instance();
		
		// Replace sender@example.com with your "From" address.
		// This address must be verified with Amazon SES.
		$sender = $ci->config->item('email_from');
		$senderName = $ci->config->item('email_from_name');

		// Replace recipient@example.com with a "To" address. If your account
		// is still in the sandbox, this address must be verified.
		$recipient = $email;

		// Replace smtp_username with your Amazon SES SMTP user name.
		$usernameSmtp = $ci->config->item('email')['smtp_user']; //'AKIAUUYOYX2Q6QPVUYAI';

		// Replace smtp_password with your Amazon SES SMTP password.
		$passwordSmtp = $ci->config->item('email')['smtp_pass'];//'BNzyH+QhQ8XT47H87FyGQ4BQXahf/AsvmuFk4GbzampY';

		// Specify a configuration set. If you do not want to use a configuration
		// set, comment or remove the next line.
		$configurationSet = 'ConfigSet';

		// If you're using Amazon SES in a region other than US West (Oregon),
		// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
		// endpoint in the appropriate region.
		$host = $ci->config->item('email')['smtp_host'];//'email-smtp.ap-south-1.amazonaws.com';
		$port = $ci->config->item('email')['smtp_port'];

		// The subject line of the email
		$subject = $ci->config->item('email_subject');

		// The plain-text body of the email
		$bodyText = $ci->config->item('email_message').$code;

		// The HTML-formatted body of the email
		$bodyHtml = $ci->config->item('email_message').$code;

		$mail = new PHPMailer(true);

		try {
		    // Specify the SMTP settings.
		    $mail->isSMTP();
		    $mail->setFrom($sender, $senderName);
		    $mail->Username   = $usernameSmtp;
		    $mail->Password   = $passwordSmtp;
		    $mail->Host       = $host;
		    $mail->Port       = $port;
		    $mail->SMTPAuth   = true;
		    $mail->SMTPSecure = 'tls';
		   // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

		    // Specify the message recipients.
		    $mail->addAddress($recipient);
		    // You can also add CC, BCC, and additional To recipients here.

		    // Specify the content of the message.
		    $mail->isHTML(true);
		    $mail->Subject    = $subject;
		    $mail->Body       = $bodyHtml;
		    $mail->AltBody    = $bodyText;
		    $mail->Send();
		   
		} catch (phpmailerException $e) {
		    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.

		} catch (Exception $e) {
		    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
			
		}
	}
*/   