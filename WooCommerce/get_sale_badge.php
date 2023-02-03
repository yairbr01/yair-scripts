<?php
// Shortcode to receive a sale tag on the product indicating the amount of the discount

add_shortcode ('get_sale_badge', 'sale_badge_function');
function sale_badge_function() {
	
	global $product;
	
	if( $product->is_type('variable')) {
		
		$percentages = array();
		$prices = $product->get_variation_prices();
		
		foreach( $prices['price'] as $key => $price ){
            if( $prices['regular_price'][$key] !== $price ){
                $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
            }
        }

		if ( count( $percentages ) > 1) {
			$print_percent = max( $percentages ) . '%-' . min( $percentages ) . '%';
		} else {
			$print_percent = max( $percentages ) . '%';
		}
		
	} else {
		$price_sale = $product->get_sale_price();
		$price_regular = $product->get_regular_price();	
		$percent = ceil( 100 - ( $price_sale / $price_regular * 100) );
		$print_percent = $percent . '%';		
	}
	
	if ( $percent != 100 ) {
		return "<p class=sale_tag>מבצע! $print_percent</p>";
	}
}


?>
