<?php
// An example of a REST API application adapted to a variety of uses

function custom_rest_api( $params ) {
    
    $id = json_decode($params->get_param('id'));
    $title = $params->get_param('title');
    $price = json_decode($params->get_param('price'));
    $maintenance = json_decode($params->get_param('maintenance'));

    function queryArgument($param, $key) {
        if ( is_object($param) ) {
            if ( $param->lt && $param->gt ) {
                return [
                    [
                        'key' => $key,
                        'value' => [$param->gt, $param->lt],
                        'type'  => 'NUMERIC',
                        'compare' => 'BETWEEN'
                    ]
                ];
            }

            if($param->lt) {
                return [
                    [
                        'key' => $key,
                        'value' => $param->lt,
                        'type'  => 'NUMERIC',
                        'compare' => '<'
                    ]
                ];
            }

            if($param->gt) {
                return [
                    [
                        'key' => $key,
                        'value' => $param->gt,
                        'type'  => 'NUMERIC',
                        'compare' => '>'
                    ]
                ];
            }
        }


        if($param && is_string($param)) {
            return [
                [
                    'key' => $key,
                    'value' => $param,
                    'type'  => 'CHAR'
                ]
            ];
        }
		
		if($param && is_int($param)) {
            return [
                [
                    'key' => $key,
                    'value' => $param,
                    'type'  => 'NUMERIC'
                ]
            ];
        }

        return null;
    }

	$args = [
		'posts_per_page' => -1,
        'post_type' => '{post_type_slug}',
		'p' => $id,
        'meta_query' => array(
            'relation' => 'AND',
            array( queryArgument($title, 'title') ),
            array( queryArgument($price, 'price') ),
            array( queryArgument($maintenance, 'maintenance') ),
        ),
	];

    $posts = new WP_Query($args);

	$data = [];

	$data[0]['found_posts'] = $posts->found_posts;
	$i = 1;

	foreach($posts->posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;

        $data[$i]['price'] = intval(get_post_meta( $post->ID, 'price', true ));
        $data[$i]['maintenance'] = intval(get_post_meta( $post->ID, 'maintenance', true ));

		$i++;
	}

	return $data;
}

function restCheckUser(WP_REST_Request $request) {
    if ('{paswoord_for_token_parameter}' === $request->get_param('token')) {
         return true;
    }
    return false;
}

add_action('rest_api_init', function() {
    register_rest_route('ivr/v1', 'properties', [
		'methods' => 'GET',
		'callback' => 'custom_rest_api',
		'permission_callback' => 'restCheckUser'
	]);
});

?>
