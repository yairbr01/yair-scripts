<?php
// Change error message on login. use it for prevent hackers to get email address

function change_error_message_on_login(){
  return 'הנתונים שהקלדת שגויים, אנא נסו שנית';
}
add_filter( 'login_errors', 'change_error_message_on_login' );

?>
