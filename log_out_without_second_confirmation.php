<?php
// Log out without needing a second confirmation

function getLogoutUrl($redirectUrl = ''){
    if(!$redirectUrl) $redirectUrl = site_url();
    $return = str_replace("&amp;", '&', wp_logout_url($redirectUrl));
    return $return;
}
function logout_without_confirmation($action, $result){
    if(!$result && ($action == 'log-out')){ 
        wp_safe_redirect(getLogoutUrl()); 
        exit(); 
    }
}
add_action( 'check_admin_referer', 'logout_without_confirmation', 1, 2);

?>
