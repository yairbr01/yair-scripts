<?php
// Added a field on the checkout page

function checkout_add_fileds( $checkout ){

	woocommerce_form_field( '{filed_slug}', array(
		'type'          => 'text',
		'required'	=> true,
		'default' => $_COOKIE[{filed_slug}], // Get default from cookie
		'class'         => array('{filed_slug}'),
		'label'         => '{filed_title}',
		'label_class'   => '{filed_class}',		
		), $checkout->get_value( '{filed_slug}' ) );

}
function checkout_add_fileds_save( $order_id ){

	if( !empty( $_POST['{filed_slug}'] ) )
		update_post_meta( $order_id, '{filed_slug}', sanitize_text_field( $_POST['{filed_slug}'] ) );

}
add_action( 'woocommerce_after_checkout_billing_form', 'checkout_add_fileds' );
add_action( 'woocommerce_checkout_update_order_meta', 'checkout_add_fileds_save' );

function checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('{filed_title}').':</strong> <br/>' . get_post_meta( $order->get_id(), '{filed_slug}', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'checkout_field_display_admin_order_meta', 10, 1 );

?>
