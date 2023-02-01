<?php
// Displaying data from the meta data of the item in the cart in the checkout

function display_engraving_text_cart( $item_data, $cart_item ) {
  if ( !empty( $cart_item['custom_data']['rooms_number'] ) ) {
    $item_data[] = array(
    'key'     => __( 'מספר חדרים', 'yair' ),
    'value'   => wc_clean( $cart_item['custom_data']['rooms_number'] ),
    'display' => '',
    );
  }
  if ( !empty( $cart_item['custom_data']['adults_number'] ) ) {
    $item_data[] = array(
    'key'     => __( 'מספר מבוגרים', 'yair' ),
    'value'   => wc_clean( $cart_item['custom_data']['adults_number'] ),
    'display' => '',
    );
  }
  if ( !empty( $cart_item['custom_data']['child_3_5'] ) ) {
    $item_data[] = array(
    'key'     => __( 'מספר ילדים 3 - 5', 'yair' ),
    'value'   => wc_clean( $cart_item['custom_data']['child_3_5'] ),
    'display' => '',
    );
  }
  if ( !empty( $cart_item['custom_data']['child_6_12'] ) ) {
    $item_data[] = array(
    'key'     => __( 'מספר ילדים 6 - 12', 'yair' ),
    'value'   => wc_clean( $cart_item['custom_data']['child_6_12'] ),
    'display' => '',
    );
  }
  if ( !empty( $cart_item['custom_data']['baby'] ) ) {
    $item_data[] = array(
    'key'     => __( 'מספר תינוקות', 'yair' ),
    'value'   => wc_clean( $cart_item['custom_data']['baby'] ),
    'display' => '',
    );
  }

  return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'display_engraving_text_cart', 10, 2 );

?>
