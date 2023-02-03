<?php
// SMTP configuration

function yair_send_mail_using_smtp( $phpmailer ) {

	$phpmailer->isSMTP();

	$phpmailer->IsHTML(true);

	$phpmailer->Host = '{smtp_host}';

	$phpmailer->Port = 587;

	$phpmailer->Username = '{smtp_username}';

	$phpmailer->Password = '{smtp_password}';

	$phpmailer->SMTPAuth = true;

	$phpmailer->SMTPSecure = 'tls';

	$phpmailer->From = '{smtp_from_email_address}';

	$phpmailer->FromName = get_bloginfo( 'name' );

}

add_action( 'phpmailer_init', 'yair_send_mail_using_smtp' );

?>
