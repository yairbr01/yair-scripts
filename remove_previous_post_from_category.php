<?php
// Remove an post from a category when a new post is publish

function remove_previous_post_from_category() {		
	//Determine the ID of the category
	$cat_id_check = '25847';
	
	//Get the post id of the current post
	$post_id = get_the_ID();
	
	//Check if the post has in category
	if (has_category( $cat_id_check )) {
		
		//Get the post id of the previous post
		$previous_post = get_previous_post_id( $post_id );
		
		//Remove the category from the previous post
		wp_remove_object_terms( $previous_post, $cat_id_check, 'category' );
		
	}		
}

function get_previous_post_id( $post_id ) {
	//Determine the category ID
	$current_cat_id = '25847';
	
	//Set arguments to pull posts from the category
	$args = array('category'=>$current_cat_id,'numberposts'=> 2,'orderby'=>'post_date','order'=> 'DESC');
	
	//pull posts from the category
	$posts = get_posts($args);
	
	//Creating an array
	$ids = array();
	
	//Inserting all the IDs of the posts into the array
	foreach ($posts as $thepost) {
		$ids[] = $thepost->ID;
	}
	
	//Search in array for the post ID
	$thisindex = array_search($post->ID, $ids);
	
	//Get the previous post
	$previous_post = $ids[$thisindex + 1];
	
	return $previous_post;
	
}

add_action( 'publish_post', 'remove_previous_post_from_category', 10, 2 );

?>
