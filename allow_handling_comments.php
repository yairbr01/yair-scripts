<?php
// Removing the possibility of handling comments for users who do not have a certain ID

function edit_own_comments_backend($actions, $comment) {
    if(is_user_logged_in()) {
        
        $user_id = get_current_user_id();
        
        if ( $user_id != '1' && $user_id != '2' ) {
            unset($actions['inline hide-if-no-js']);
            unset($actions['edit']);
            unset($actions['trash']);
            unset($actions['approve']);
            unset($actions['unapprove']);
            unset($actions['spam']);
            unset($actions['delete']);
            unset($actions['quickedit']);
            unset($actions['reply']);
        }
    }

    return $actions;
}

add_filter('comment_row_actions', 'edit_own_comments_backend', 10, 2);

?>
