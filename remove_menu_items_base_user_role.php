<?php
// Remove items from wordpress dashboard base on user role

function remove_menu_items() {
  if( current_user_can( '{user_role}' ) ){
    remove_menu_page( 'edit.php?post_type=elementor_library' );
	  remove_menu_page( 'edit.php?post_type=page' );
		remove_menu_page( '{page_url}' );
	}
}
add_action( 'admin_menu', 'remove_menu_items' );

?>
