<?php
// Get current page short URL

add_shortcode ('get_current_page_short_url', 'current_page_short_url');
function current_page_short_url() {
	return wp_get_shortlink();
}
