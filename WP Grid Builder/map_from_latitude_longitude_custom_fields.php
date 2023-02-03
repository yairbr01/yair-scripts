<?php
// Map field definition and geographic location for use using latitude and longitude from custom fields

add_filter(
    'wp_grid_builder/indexer/row',
    function( $row, $object_id, $facet ) {

        if ( empty( $facet['filter_type'] ) || ! in_array( $facet['filter_type'], [ 'map', 'geolocation' ], true ) ) {
            return $row;
        }

        $row['facet_value'] = get_post_meta( $object_id, 'latitude', true );
        $row['facet_name']  = get_post_meta( $object_id, 'longitude', true );

        return $row;

    },
    10,
    3
);

?>
