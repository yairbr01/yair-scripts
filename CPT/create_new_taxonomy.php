<?php
// Create new taxonomy

function register_custom_taxonomy() {
	register_taxonomy('{taxonomy_slug}', '{post_type_slug}', array(
	  'hierarchical' => true,

	  'labels' => array(
		'name' => _x( '{taxonomy_name_label}', 'taxonomy general name' ),
		'singular_name' => _x( '{taxonomy_singular_name_label}', 'taxonomy singular name' ),
		'search_items' =>  __( '{search_items_label}' ),
		'all_items' => __( '{all_items_label}' ),
		'parent_item' => __( '{parent_item_label}' ),
		'parent_item_colon' => __( '{parent_item_colon_label}' ),
		'edit_item' => __( '{edit_item_label}' ),
		'update_item' => __( '{update_item_label}' ),
		'add_new_item' => __( '{add_new_item_label}' ),
		'new_item_name' => __( '{new_item_name_label}' ),
		'menu_name' => __( '{menu_name_label}' ),
	  ),

	  'rewrite' => array(
		'slug' => '{taxonomy_slug}',
		'with_front' => false,
		'hierarchical' => true
	  ),
	));
  }
  add_action( 'init', 'register_custom_taxonomy', 0 );

?>
