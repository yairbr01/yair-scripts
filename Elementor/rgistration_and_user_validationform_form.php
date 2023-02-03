<?php
// Create new user and generate OTP password and send it by email with email template located in "html" directory in theme directory 

add_action( 'elementor_pro/forms/new_record',  'yair_elementor_form_rgistration_form' , 10, 2 );

function yair_elementor_form_rgistration_form($record,$ajax_handler)
{
    $form_name = $record->get_form_settings('form_name');
    if ('{form_name}' !== $form_name) {
        return;
    }
    $form_data = $record->get_formatted_data();

	$email = $form_data['כתובת אימייל'];
    if ( email_exists( $email ) ){ 
        $ajax_handler->add_error_message("המשתמש קיים במערכת"); 
        $ajax_handler->is_success = false;
        return;
    }
	
	$password = $form_data['סיסמה'];
	$password_confirm = $form_data['אימות סיסמה'];	
	if ( $password !== $password_confirm ){ 
        $ajax_handler->add_error_message("הסיסמאות אינן תואמות"); 
        $ajax_handler->is_success = false;
        return;
    }	
	
	$user_data = array(
		'user_pass' => $password,
		'user_login' => $email,
		'role' => get_option('default_role'),
		'user_email' => $email,
		'show_admin_bar_front' => 'false'
	);
	$user_id = wp_insert_user( $user_data );
		
	$confirm_code = wp_rand(111111, 999999);
	
	update_user_meta( $user_id, 'user_confirm_code', $confirm_code );
	update_user_meta( $user_id, 'user_confirm_status', 'not_verified' );
	
	setcookie('email', $email, time() + (600), "/");	
	
	$html_email_template_file = get_stylesheet_directory_uri().'/html/user_confirm_email_template.html';
    $message = file_get_contents($html_email_template_file);
    $subject = "אנא אמת את חשבונך";
	$headers = 'From: '. "no_reply@test.co.il" . "\r\n" .
		'Reply-To: ' . "no_reply@test.co.il" . "\r\n";
	
    //Replace the content of the file with post meat filds
    $message = str_replace('code_to_replace', $confirm_code, $message);
	
	$sent = wp_mail($email, $subject, $message, $headers);	
}

?>
