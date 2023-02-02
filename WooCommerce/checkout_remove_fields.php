<?php
// Removing fields on the checkout

function checkout_remove_fields( $woo_checkout_fields_array ) {

	// unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
	// unset( $woo_checkout_fields_array['billing']['billing_phone'] );
	// unset( $woo_checkout_fields_array['billing']['billing_email'] );

	unset( $woo_checkout_fields_array['billing']['billing_address_1'] );
	unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
	unset( $woo_checkout_fields_array['order']['order_comments'] );
	unset( $woo_checkout_fields_array['billing']['billing_company'] );
	unset( $woo_checkout_fields_array['billing']['billing_country'] );
	unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
	unset( $woo_checkout_fields_array['billing']['billing_city'] );
	unset( $woo_checkout_fields_array['billing']['billing_state'] );
	unset( $woo_checkout_fields_array['billing']['billing_postcode'] );

	return $woo_checkout_fields_array;
}
add_filter( 'woocommerce_checkout_fields', 'checkout_remove_fields', 9999 );

?>
