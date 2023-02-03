<?php
// Order fields on the checkout page

add_filter( 'woocommerce_default_address_fields', 'bbloomer_reorder_checkout_fields' );
 
function bbloomer_reorder_checkout_fields( $fields ) {
 
	$fields['city']['priority'] = 50;
  $fields['address_1']['priority'] = 60;
  $fields['address_2']['priority'] = 70;
 
  return $fields;
}

?>
