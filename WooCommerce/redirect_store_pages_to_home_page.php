<?php
// Redirect from shop page + product pages + cart page to home page

add_action( 'template_redirect', 'yair_redirect_store' );
function yair_redirect_store() {
  if ( is_singular( 'product' ) || is_shop()  || is_cart() ) {
    wp_redirect( home_url(), 301 );
    exit;
  }
}

?>
