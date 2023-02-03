<?php
// Add posts from CPT to author archives

function post_types_author_archives($query) {
    if ($query->is_author)
            $query->set( 'post_type', array('{post_type_slug}', 'posts') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'post_types_author_archives');

?>
