<?php
// Disable default wordpress lazy load in case of conflict lazy loads

add_filter( 'wp_lazy_loading_enabled', '__return_false' );

?>
