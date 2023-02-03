<?php
// Israeli ID verification in form

add_action( 'elementor_pro/forms/validation/text',  'yair_elementor_form_israeli_id_validation' , 10, 3 );
function yair_elementor_form_israeli_id_validation( $field, $record, $ajax_handler ) 
{
	$form_id = $record->get_form_settings('form_id');
    if ('{form_id}' !== $form_id) {
        return;
    }
	
	if ( $field['id'] !='{field_id}' ) {
		return;
	}
	
	$id = $field['value'];
		
	if ( !ctype_digit( $id ) ) {
		$ajax_handler->add_error( $field['id'], 'תעודת הזהות אינה תקינה' );
	}
	$length = strlen( $id );
	if ( $length > 9 ) {
		$ajax_handler->add_error( $field['id'], 'תעודת הזהות אינה תקינה' );
	}
		
	if ( $length < 9 ) {		
		$string = str_repeat("0", 9 - $length);
		$id = $string . $id;
	}
		
	$id_split = str_split( $id );
	$test_array = [1, 2, 1, 2, 1, 2, 1, 2, 1];
		
	$result = array();
	$counter = 0;
		
	foreach ( $id_split as $one_num ) {		
		$result[] = $one_num * $test_array[$counter];
		$counter = $counter + 1;		
	}
		
	foreach ( $result as $key => $one_num ) {		
		$one_num_split = str_split( $one_num );
		$result[$key] = array_sum($one_num_split);		
	}
		
	$result_count = array_sum( $result );
		
	if ( $result_count % 10 != 0 ) {
		$ajax_handler->add_error( $field['id'], 'תעודת הזהות אינה תקינה' );
	}
}

?>
