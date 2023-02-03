<?php
// Custom actions after registration using social

add_action('nsl_registration_store_extra_input', function ($user_id, $userData) {	
	$timestamp_next_month = strtotime("+1 month") + 7200;
	update_user_meta( $user_id, 'posts_to_publish', 10 );
	update_user_meta( $user_id, 'post_renewal_date', $timestamp_next_month );
}, 10, 2);

?>
