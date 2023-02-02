<?php
// Change checkout page URL

add_filter( 'woocommerce_get_checkout_url', 'custom_checkout_url', 30 );
function custom_checkout_url( $checkout_url ) {
    $custom_url = '/personal-area/checkout';
	return $checkout_url;
}

?>
