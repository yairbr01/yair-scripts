<?php
// PHPMailer wite attachment

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/PHPMailer/SMTP.php');
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/PHPMailer/PHPMailer.php');
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/PHPMailer/Exception.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function phpmailer_send_email_with_attachment( $from, $from_name, $subject, $message, $to, $attachment_path, $attachment_file_name ) {
    
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host       = '{email_smtp_host}';
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure= 'tls';
	$mail->Username   = '{email_address}';
	$mail->Password   = '{email_password}';
	$mail->Port       = {email_smtp_port}; 
	$mail->From = $from;
	$mail->FromName = $from_name;
	$mail->addAddress( $to );
	$mail->addAttachment( $attachment_path, $attachment_file_name );
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64';
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->send();
}

?>
