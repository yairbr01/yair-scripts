<?php
// Shortcode for get just "view order" part of "my account".

function woocommerce_view_order($params) {
    
	$url = $_SERVER["REQUEST_URI"];
	$url = preg_match('/\d+/', $url, $matches);
	$order_id = end($matches);
	
	if ( !empty($order_id) ) {
		$user_id = get_current_user_id();
		if ($user_id == 0) {
			 return do_shortcode('[woocommerce_my_account]'); 
		}else{
			ob_start();
			wc_get_template( 'myaccount/view-order.php', array(
				'order' => wc_get_order($order_id), // add this line
				'order_id' => $order_id //add this line
			 ) );
			return ob_get_clean();
		}	
	} else {
		return '';
	}
}
add_shortcode('woocommerce_view_order', 'woocommerce_view_order');

?>
