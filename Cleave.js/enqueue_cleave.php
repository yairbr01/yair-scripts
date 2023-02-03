<?php
// Enqueue cleave.js files on specific page. download the files from URLs blow and uploud them to "js" directory in active theme directory.

// https://github.com/nosir/cleave.js/blob/master/dist/cleave.min.js
// https://github.com/nosir/cleave.js/blob/master/dist/addons/cleave-phone.il.js

function enqueue_cleave(){
    
    if ( is_page('{page_slug}') ) {
        
        wp_register_script('cleave', get_stylesheet_directory_uri().'/js/cleave.min.js');
        wp_register_script('cleave_phone', get_stylesheet_directory_uri().'/js/cleave-phone.il.js');
        wp_enqueue_script('cleave');
        wp_enqueue_script('cleave_phone');
        
    }
}
add_action('wp_enqueue_scripts', 'enqueue_cleave');

?>
