<?php
// Add custom columns in user list in wordpress dashboard

function yair_modify_user_table( $column ) {
    $column['{column_slug}'] = '{column_title}';
    return $column;
}
add_filter( 'manage_users_columns', 'yair_modify_user_table' );

function yair_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
		case '{column_slug}' :
			return get_user_meta( $user_id, '{user_meta_key}', true );			
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'yair_modify_user_table_row', 10, 3 );

?>
