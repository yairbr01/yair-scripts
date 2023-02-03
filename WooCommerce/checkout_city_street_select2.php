<?php
// Changing the city and street fields text input select2 in checkout

function yair_change_city_to_dropdown( $fields ) {

	$city_args = wp_parse_args( array(
		'type' => 'select',
		'options' => array(
			'אנא בחר עיר מהרשימה' => 'אנא בחר עיר מהרשימה',
			'בני ברק' => 'בני ברק',
			'ירושלים' => 'ירושלים',
		),
		'input_class' => array(
			'wc-enhanced-select',
		)
	), $fields['shipping']['shipping_city'] );

	$fields['shipping']['shipping_city'] = $city_args;
	$fields['billing']['billing_city'] = $city_args;

	wc_enqueue_js( "
	jQuery( ':input.wc-enhanced-select' ).filter( ':not(.enhanced)' ).each( function() {
		var select2_args = { minimumResultsForSearch: 5 };
		jQuery( this ).select2( select2_args ).addClass( 'enhanced' );
	});" );

	return $fields;

}

function yair_change_street_to_dropdown( $fields ) {
	
	$city_args = wp_parse_args( array(
		'type' => 'select',
		'required'	=> true,
		'options' => array(
			'אנא בחר רחוב מהרשימה' => 'אנא בחר רחוב מהרשימה',
		),
		'input_class' => array(
			'wc-enhanced-select',
		)
	), $fields['shipping']['shipping_address_1'] );

	$fields['shipping']['shipping_address_1'] = $city_args;
	$fields['billing']['billing_address_1'] = $city_args;

	wc_enqueue_js( "
	jQuery( ':input.wc-enhanced-select' ).filter( ':not(.enhanced)' ).each( function() {
		var select2_args = { minimumResultsForSearch: 5 };
		jQuery( this ).select2( select2_args ).addClass( 'enhanced' );
	});" );

	return $fields;

}

function yair_select_checkout_field_process() {
    global $woocommerce;

    // Check if set, if its not set add an error.
    if ($_POST['billing_address_1'] == "אנא בחר רחוב מהרשימה") {
		wc_add_notice( '<strong>אנא בחר רחוב לחיוב</strong>', 'error' );
	}
	
	if ( $_POST['ship_to_different_address'] ) {
		if ($_POST['shipping_address_1'] == "אנא בחר רחוב מהרשימה") {
			wc_add_notice( '<strong>אנא בחר רחוב למשלוח</strong>', 'error' );
		}
	}
	
}

add_filter( 'woocommerce_checkout_fields', 'yair_change_city_to_dropdown' );
add_filter( 'woocommerce_checkout_fields', 'yair_change_street_to_dropdown' );
add_action('woocommerce_checkout_process', 'yair_select_checkout_field_process');

?>
