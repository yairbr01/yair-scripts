<?php
// Adjusted actions after order status changes to "Completed"

add_action( 'woocommerce_order_status_completed', 'yair_update_property_after_payment' );
function yair_update_property_after_payment( $order_id ){
	$order = wc_get_order( $order_id );	
	
	// Get costum filed
	$post_id = get_post_meta( $order_id, '{filed_slug}', true );
	
	$order = wc_get_order( $order_id );
	$items = $order->get_items();	
	foreach ( $items as $item ) {
    	$product_id = $item->get_product_id();
	}
	
	update_post_meta( $post_id, 'ad_type', $product_id );
}

?>
