<?php
// Two posts from two different CPTs that are connected using a custom field that contains the ID of the connected post. Deleting one post will delete the connected post.

function delete_connected_post( $post_id) {    
	if ( '{post_type}' == get_post_type( $post_id) ) {
		$post_meta = get_post_meta( $post_id, '{custom_field_key}' );
    	foreach ( $post_meta as & $value ) {
        	wp_trash_post( $value );
    	}
	}	
}
add_action( 'before_delete_post','delete_connected_post' );

?>
