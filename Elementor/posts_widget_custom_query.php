<?php
// Custom query in elementor posts widget

function custom_query( $query ) {
	$query->set( 'post_type', '{post_type}' );
	$query->set( 'orderby', 'date' );
	$meta_query[] = [
		'key' => '{custom_key}',
		'value' => '{custom_value}',
		'compare' => '=',
	];
	$query->set( 'meta_query', $meta_query );
}
add_action( 'elementor/query/video', 'custom_query' );

?>
