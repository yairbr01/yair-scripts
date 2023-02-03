<?php
// Redirect all site to custom login page

add_action( 'template_redirect', 'yair_redirect' );
function yair_redirect() {
	if ( ! is_page( 'login' ) && get_current_user_id() == 0 ) {
		wp_redirect( home_url() . '/login/', 301 ); 
    		exit;    	
	} 
}

?>
