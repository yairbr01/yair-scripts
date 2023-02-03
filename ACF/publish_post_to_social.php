<?php
// Publishing the post to social networks (Twitter / Telegram) after publication. The posting depends on a custom switcher type field

// Download the "TwitterAPIExchange.php" file from the URL blow and uploud it to "php" folder in the theme directory. 
// https://github.com/J7mbo/twitter-api-php/blob/master/TwitterAPIExchange.php

require_once( get_template_directory() . '/php/TwitterAPIExchange.php' );
function publish_post_in_social( $post_id, $post, $update, $post_before ) {
		
	$post_status = get_post_status( $post_id );
	$post_status_before = get_post_status( $post_before );
	$post_type = get_post_type( $post_id );
	
	$telegram = get_post_meta( $post_id, 'telegram', true );
	$twitter = get_post_meta( $post_id, 'twitter', true );
	
	if ($post_status == 'draft' ) {
		return;
	}
	
	$image = get_the_post_thumbnail_url($post_id, 'article-thumbnail-image');	
	$title = get_the_title( $post_id );
	$excerpt = get_the_excerpt( $post_id );
	$url = get_permalink( $post_id );
	$date = get_the_date('d/m/Y', $post_id);
	$author_id = get_post_field( 'post_author', $post_id );
	$author = get_the_author_meta('display_name', $author_id);
	
	if ($telegram == 1) {
		
		publish_telegram( $title, $excerpt, $url, $date, $author, $image, $post_type );	
		
		update_post_meta( $post_id, 'telegram', 0 );
	
	}
	
	if ($twitter == 1) {
		
		publish_twitter( $title, $excerpt ,$url, $date, $author, $image, $post_type );
		update_post_meta( $post_id, 'twitter', 0 );
	
	}
}
add_action('wp_after_insert_post', 'publish_post_in_social', 10, 4 );

function publish_telegram( $title, $excerpt ,$url, $date, $author, $image, $post_type ) {
	
	$apiToken = "{apiToken}";
	$chat_id = "{chat_id}";
	
	if ( $post_type == '{post_type_with_featured_image' ) {
		$data_title = [
    		'chat_id' => $chat_id,
    		'text' => "*$title*\r\n\r\n$author | $date\r\n\r\n$url"
		];
		$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data_title) ."&parse_mode=markdown" );
	} elseif ($post_type == 'post_type_without_featured_image') {
		$data_image = [
    		'chat_id' => $chat_id,
    		'photo' => $image,
    		'caption' => "*$title*\r\n\r\n$excerpt\r\n\r\n$author | $date\r\n\r\n$url"	
		];	
	
		$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendPhoto?" . http_build_query($data_image) ."&parse_mode=markdown" );
	}
	
}

function publish_twitter( $title, $excerpt ,$url, $date, $author, $image, $post_type ) {
	
	$settings = array(
    	'oauth_access_token' => '{oauth_access_token}', 
    	'oauth_access_token_secret' => '{oauth_access_token_secret}', 
    	'consumer_key' => '{consumer_key}', 
    	'consumer_secret' => '{consumer_secret}'
	);

    $twitter = new TwitterAPIExchange( $settings );
	$requestMethod = 'POST';
	
	if ( $post_type == '{post_type_with_featured_image}' ) {
		$url_upload = 'https://upload.twitter.com/1.1/media/upload.json';
		$postfields = array(
	  		'media_data' => base64_encode(file_get_contents($image))
		);
		$response = $twitter->buildOauth($url_upload, $requestMethod)
	  		->setPostfields($postfields)
	  		->performRequest();
		$media_id = json_decode($response)->media_id;
		$postfields = array(
	  		'status' => "$title\r\n\r\n$excerpt\r\n\r\n$url",
	  		'media_ids' => $media_id,
		);
	} elseif ( $post_type == '{post_type_with_featured_image}' ) {
		$postfields = array(
			'status' => "$title\r\n\r\n$excerpt\r\n\r\n$url",
		);
	}
	
	$url_update = 'https://api.twitter.com/1.1/statuses/update.json';
	$response = $twitter->buildOauth($url_update, $requestMethod)
		->setPostfields($postfields)
		->performRequest();
	
}

?>
