<?php
// Updating the price of a product in the cart according to an custom field in the cart object

add_action( 'woocommerce_before_calculate_totals', 'custom_cart_item_price', 30, 1 );
function custom_cart_item_price( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    foreach ( $cart->get_cart() as $cart_item ) {
        if( isset($cart_item['custom_data']['new_price']) )
            $cart_item['data']->set_price( $cart_item['custom_data']['new_price'] );
    }
}

?>
