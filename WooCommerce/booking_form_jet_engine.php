<?php
// Creating a Booking form using JetEngine + WooCommerce product

add_action( 'jet-engine-booking/filter/{hook_name}', '{hook_name}_function', 10, 4 );
function {hook_name}_function($result, $data, $form, $notifications ) {	
   
	$product_id = $data[ 'product_id' ];
	$order_r = $data[ 'order_r' ];
	
	$adults_price = get_post_meta( $product_id, '_regular_price', true );
	$child_3_5_price = get_post_meta( $product_id, 'child_3_5', true );
	$child_6_12_price = get_post_meta( $product_id, 'child_6_12', true );
	$baby_price = get_post_meta( $product_id, 'baby', true );
	
	$adults_number = 0;
	$child_3_5 = 0;
	$child_6_12 = 0;
	$baby = 0;
	
	foreach ($order_r as $key => $value) {
  		$adults_number = $adults_number + $value[ 'adults_number' ];
		$child_3_5 = $child_3_5 + $value[ 'child_3_5' ];
		$child_6_12 = $child_6_12 + $value[ 'child_6_12' ];
		$baby = $baby + $value[ 'baby' ];
		
		$tmp_child_3_5 = $value[ 'child_3_5' ];
		$tmp_child_6_12 = $value[ 'child_6_12' ];
		
		if ( $tmp_child_3_5 + $tmp_child_6_12 > 2 ) {
			$notifications->set_specific_status( "מקסימום 2 ילדים בחדר" );
			return false;
		}
	}
	
	$custom_data = array();
	$custom_data['custom_data']['rooms_number'] = count($order_r);
	$custom_data['custom_data']['adults_number'] = $adults_number;
	$custom_data['custom_data']['child_3_5'] = $child_3_5;
	$custom_data['custom_data']['child_6_12'] = $child_6_12;
	$custom_data['custom_data']['baby'] = $baby;
	$custom_data['custom_data']['new_price'] = $adults_price + $child_3_5 * $child_3_5_price + $child_6_12 * $child_6_12_price + $baby * $baby_price;
		
	global $woocommerce;
	$woocommerce->cart->empty_cart();
	$woocommerce->cart->add_to_cart( $product_id, 1, '0', array(), $custom_data );
	
	return true;	
}

?>
