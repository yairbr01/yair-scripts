<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'הגדרות אתר',
		'menu_title'	=> 'הגדרות אתר',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
	));
	
}

?>
