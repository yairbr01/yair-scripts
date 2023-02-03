<?php
// Set opengraph image for social share from gallery custom field.

add_filter( "rank_math/opengraph/facebook/image", "set_opengraph_image_from_gallery");
add_filter( "rank_math/opengraph/twitter/image", "set_opengraph_image_from_gallery");

function set_opengraph_image_from_gallery( $attachment_url ) {
	
	global $post;
	$attachments = get_post_meta( $post->ID, 'gallery', true );

	if ( strpos( $attachments, ',' ) !== false ) {
		 $attachment_id = substr($attachments, 0, strpos($attachments, ","));
	} else {
		$attachment_id = $attachments;
	}
	
	$attachment_url = wp_get_attachment_image_url( $attachment_id, 'full' );
	return $attachment_url;
	
};

?>
