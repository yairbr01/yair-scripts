<?php
// Shortcode for get just "my orders" part of "my account".

function custom_my_orders_shortcode() {
   ob_start();
   wc_get_template( 'myaccount/my-orders.php', array( 'current_user' => get_user_by( 'id', get_current_user_id() ) ) );
   return ob_get_clean();
}
add_shortcode( 'get_my_orders', 'custom_my_orders_shortcode' );

?>
