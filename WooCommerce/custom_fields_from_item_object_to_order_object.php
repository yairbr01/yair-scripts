<?php
// Saving custom fields from item object to order object

function add_engraving_text_to_order_items( $item, $cart_item_key, $values, $order ) {

  if ( !empty( $cart_item['custom_data']['rooms_number'] ) ) {
    $item->add_meta_data( __( 'מספר חדרים', 'yair' ), $values['custom_data']['rooms_number'] );
  }
  if ( !empty( $cart_item['custom_data']['adults_number'] ) ) {
    $item->add_meta_data( __( 'מספר מבוגרים', 'yair' ), $values['custom_data']['adults_number'] );
  }
  if ( !empty( $cart_item['custom_data']['child_3_5'] ) ) {
    $item->add_meta_data( __( 'מספר ילדים 3 - 5', 'yair' ), $values['custom_data']['child_3_5'] );
  }
  if ( !empty( $cart_item['custom_data']['child_6_12'] ) ) {
    $item->add_meta_data( __( 'מספר ילדים 6 - 12', 'yair' ), $values['custom_data']['child_6_12'] );
  }
  if ( !empty( $cart_item['custom_data']['baby'] ) ) {
    $item->add_meta_data( __( 'מספר תינוקות', 'yair' ), $values['custom_data']['baby'] );
  }

}

add_action( 'woocommerce_checkout_create_order_line_item', 'add_engraving_text_to_order_items', 10, 4 );

?>
