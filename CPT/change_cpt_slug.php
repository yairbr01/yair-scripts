<?php
// Change CPT slug from post title to post id

function reservation_links($post_link, $post = 0) {
    if($post->post_type == 'reservation') {
        return home_url('reservation/' . $post->ID . '/');
    }
    else{
        return $post_link;
    }
}
add_filter('post_type_link', 'reservation_links', 1, 3);

function reservation_links_rewrites_init(){
    add_rewrite_rule('reservation/([0-9]+)?$', 'index.php?post_type=reservation&p=$matches[1]', 'top');
}
add_action('init', 'reservation_links_rewrites_init');

?>
