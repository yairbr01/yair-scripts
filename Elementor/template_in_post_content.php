<?php
// Add an Elementor template after a random number of paragraphs in each post

add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
	global $post;

	$ad_code = '{elementor_template_shortcode}';
	
	if ( is_single() && ! is_admin() && $post->post_type == 'post' ) {
		$count = check_paragraph_count_blog( $content );
		return prefix_insert_after_paragraph( $ad_code, rand( 1, $count ), $content );  
	}  
	return $content;
}
// Parent Function that makes the magic happen
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	
	foreach ($paragraphs as $index => $paragraph) {	  
		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}
		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	return implode( '', $paragraphs );
}

function check_paragraph_count_blog( $content ) {
	global $post;
    if ( $post->post_type == 'post' ) {
        $count = substr_count( $content, '</p>' );
        return $count;
    } else {
        return 0;
    }
}

?>
