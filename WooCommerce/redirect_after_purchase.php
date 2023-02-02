<?php
// Reference to customized page after purchase

add_action( 'woocommerce_thankyou', 'yair_redirect_after_purchase');
function yair_redirect_after_purchase( $order_id ){
    $order = wc_get_order( $order_id );
    $url = '{url}';
    if ( ! $order->has_status( 'failed' ) ) {
        wp_safe_redirect( $url );
        exit;
    }
}

?>
