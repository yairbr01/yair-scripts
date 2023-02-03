<?php
// Add shortlink option

add_filter( 'get_shortlink', function ( $shortlink ) {
	return $shortlink;
});

?>
