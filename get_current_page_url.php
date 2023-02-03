<?php
// Shortcode for current page

add_shortcode ('get_current_page_url', 'current_page_url');
function current_page_url() {
	$pageURL = 'https://';
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}

?>
