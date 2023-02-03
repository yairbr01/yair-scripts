<?php
// Create new CPT

function reservation_custom_post_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'singular_name'       => _x( 'הזמנה', 'Post Type Singular Name', 'storefront' ),
        'menu_name'           => __( 'הזמנות', 'storefront' ),
        'parent_item_colon'   => __( 'הורה הזמנה', 'storefront' ),
        'all_items'           => __( 'כל ההזמנות', 'storefront' ),
        'view_item'           => __( 'בצפה בהזמנה', 'storefront' ),
        'add_new_item'        => __( 'הוסף הזמנה חדשה', 'storefront' ),
        'add_new'             => __( 'הוסף הזמנה חדשה', 'storefront' ),
        'edit_item'           => __( 'ערוך הזמנה', 'storefront' ),
        'update_item'         => __( 'עדכן הזמנה', 'storefront' ),
        'search_items'        => __( 'חפש הזמנה', 'storefront' ),
        'not_found'           => __( 'לא נמצאו הזמנות', 'storefront' ),
        'not_found_in_trash'  => __( 'לא נמצא באשפה', 'storefront' ),
    );
// Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'הזמנות', 'storefront' ),
        'description'         => __( 'תיעוד הזמנות', 'storefront' ),
        'labels'              => $labels,  
        'supports'            => array( 'title', 'author' ),    
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true, 
    );
    // Registering your Custom Post Type
    register_post_type( 'reservation', $args );
}
add_action( 'init', 'reservation_custom_post_type', 0 );

?>
