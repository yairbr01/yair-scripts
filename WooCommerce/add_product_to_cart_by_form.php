<?php
// Add a product to the cart using the jet engine form and add a cookie to the browser

add_action( 'jet-engine-booking/publish_payment', function( $data ) {	
	$product_id = $data[ 'product_id' ];
	if ( empty( $product_id ) ) {
		$product_id = $data[ 'product_id' ];
	}	
	
	global $woocommerce;
  $woocommerce->cart->empty_cart();
  $woocommerce->cart->add_to_cart($product_id);	

	$cookie_value = $product_id;
	setcookie({cookie_name}, $cookie_value, 0, "/");
}
);

?>
