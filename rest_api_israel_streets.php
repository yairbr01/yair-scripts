<?php
// This script creates a REST API that returns the list of streets for a given city. The city is defined by the "city" parameter. The data comes from a CSV file that contains in one column the name of the city and in another column the name of the street.
// You can download the list of streets from the URL below. Note that the file requires editing and must contain only two columns as indicated above.
// https://data.gov.il/dataset/321/resource/9ad3862c-8391-4b2f-84a4-2d4c68625f4b

function custom_rest_api_strrets( $params ) {
    
    $city = $params->get_param('city');
	
	$streets_array = array();
	$file = fopen('{url_for_israel_streets.csv}', 'r');
	while ( ( $line = fgetcsv($file) ) !== FALSE ) {
		if ( str_contains($line[0], $city) ) {
			$streets_array[  $line[1] ] = $line[1];
		}		
	}
	fclose($file);
	
	return $streets_array;
}

add_action('rest_api_init', function() {
    register_rest_route('address/v1', 'get_streets', [
		'methods' => 'GET',
		'callback' => 'custom_rest_api_strrets',
	]);
});

?>
