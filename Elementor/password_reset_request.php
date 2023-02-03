<?php
// Send password reset URL to user email. the URL is for custom page with slug "reset-password".

add_action( 'elementor_pro/forms/new_record',  'yair_elementor_form_lost_password' , 10, 2 );
function yair_elementor_form_lost_password($record,$ajax_handler) 
{
	$form_name = $record->get_form_settings('form_name');
    if ('Lost Password' !== $form_name) {
        return;
    }
    $form_data = $record->get_formatted_data();
	$email = $form_data['כתובת אימייל'];
	$user_data = get_user_by( 'email', $email );

	$errors = retrieve_password( $user_data->user_login );

	if ( is_wp_error( $errors ) ) {
		$ajax_handler->add_error_message( $errors->get_error_message() ); 
        $ajax_handler->is_success = false;
        return;
	} else {
		$ajax_handler->is_success = true;
	}
}

add_filter("retrieve_password_message", "custom_password_reset", 99, 4);
function custom_password_reset($message, $key, $user_login, $user_data ) 
{
	$message = "
היי,
  
קיבלנו את בקשתך לאיפוס הסיסמה לחשבון שלך.

כתובת האימייל:" . sprintf(__('%s'), $user_data->user_email) . "

אם לא אתה ביצעת את הבקשה יש להתעלם מהודעה זו.

לחץ על הקישור כדי לאפס את הסיסמה

" . network_site_url("reset-password?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "rn" . "

אם נתקלת בבעיה או אם יש לך שאלות נוספות אנא אל תהסס לפנות אלינו בכתובת האימייל: support@test.co.il


בברכה

צוות get_bloginfo( 'name' ) !";

	return $message;

}

add_filter( 'wp_mail_from_name', 'custom_wpse_mail_from_name' );
function custom_wpse_mail_from_name( $original_email_from ) 
{
    return get_bloginfo( 'name' );
}

?>
