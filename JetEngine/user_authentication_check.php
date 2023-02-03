<?php
// User authentication after registration. The verification code comes from a customized field in the user profile.

add_action( 'jet-engine-booking/filter/confirm_form', 'confirm_form_hook_call', 10, 4 );
function confirm_form_hook_call($result, $data, $form, $notifications ){	
	$user_email = $data[ 'email' ];
	$user = get_user_by( 'email', $user_email );
	$user_id = $user->ID;
		
	$code_1 = $data[ 'code_1' ];
	$code_2 = $data[ 'code_2' ];
	$code_3 = $data[ 'code_3' ];
	$code_4 = $data[ 'code_4' ];
	$code_5 = $data[ 'code_5' ];
	$code_6 = $data[ 'code_6' ];
	
	$all_code = $code_6 . $code_5 . $code_4 . $code_3 . $code_2 . $code_1;
	
	$user_code = get_user_meta( $user_id, 'user_confirm_code', true );
		
	if ($all_code == $user_code) {		
		update_user_meta( $user_id, 'user_confirm_status', 'verified' );
		wp_clear_auth_cookie();
		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id, true);
		
		return true;
	} else {	
		$notifications->set_specific_status( "היי... משהו לא מסתדר לנו, אולי תבדוק שוב?" );
		
		return false;
	}	
}

?>
