<?php
// Add custom columns in post list dashboard

add_filter( 'manage_{post_type_slug}_posts_columns', 'set_custom_cpt_columns' );
function set_custom_cpt_columns($columns) {
    $columns['{column_name}'] = __( '{column_name}', 'your_text_domain' );

    return $columns;
}

add_action( 'manage_{post_type_slug}_posts_custom_column' , 'custom_cpt_column', 10, 2 );
function custom_cpt_column( $column, $post_id ) {
    switch ( $column ) {
		
		case '{column_name}' :
						
			$info = get_post_meta( $post_id, 'info', true );
			echo $info;
			
            break;

    }
}

?>
