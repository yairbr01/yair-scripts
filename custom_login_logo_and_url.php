<?php
// Change the logo and URL of wordpress on login page.

function custom_login_logo() {
    echo '
        <style>
            .login h1 a { 
                background-image: url({url_to_file}) !important; 
                background-size: 234px 67px; 
                width:234px; 
                height:67px; 
                display:block; 
            }
        </style>
    ';
}
add_action( 'login_head', 'custom_login_logo' );

function mb_login_url() { 
  return home_url(); 
}
add_filter( 'login_headerurl', 'mb_login_url' );

?>
