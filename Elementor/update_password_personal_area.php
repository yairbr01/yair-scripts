<?php
// Update user password in personal area

add_action( 'elementor_pro/forms/new_record',  'yair_elementor_form_update_password' , 10, 2 );
function yair_elementor_form_update_password($record,$ajax_handler) 
{
  	$form_name = $record->get_form_settings('form_name');
    if ('Update Password' !== $form_name) {
        return;
    }
  
  	$form_data = $record->get_formatted_data();
    
  	$email = $form_data['כתובת אימייל'];
  	$current_password = $form_data['סיסמה נוכחית'];
  	$new_pass_1 = $form_data['סיסמה חדשה'];
  	$new_pass_2 = $form_data['אימות סיסמה חדשה'];
  
  	$user = get_user_by( 'email', $email );	
  
  	$check_user = wp_check_password($current_password, $user->data->user_pass, $user->ID);
  
  	if ( !$check_user ) {    
    	$ajax_handler->add_error_message( 'הסיסמה הנוכחית אינה נכונה' ); 
        $ajax_handler->is_success = false;
        return;      
  	} 	
	
  	if ( $new_pass_1 != $new_pass_2 ) {    
    	$ajax_handler->add_error_message( 'הסיסמאות אינן תואמות' ); 
        $ajax_handler->is_success = false;
        return;      
  	}
  
  	wp_set_password( $new_pass_1, $user->ID );
  	wp_clear_auth_cookie();
  	wp_set_current_user($user->ID);
  	wp_set_auth_cookie($user->ID, true);			
	
  	wp_send_json_success(['message' => 'הסיסמה עודכנה בהצלחה!', 'data' => $ajax_handler->data,]);
  	$ajax_handler->is_success = true;  
}

?>
