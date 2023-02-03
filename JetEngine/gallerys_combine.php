<?php
// Combine several gallerys into one gallery from form.

add_action( 'jet-engine-booking/combine_all_gallerys', function( $data ) {
   $post_id = $data[ 'inserted_post_id' ];
   $gallery1 = $data[ 'gallery_1_photos_of_the_place' ];
   $gallery2 = $data[ 'gallery_2_photos_of_the_place' ];
   $gallery3 = $data[ 'gallery_3_photos_of_the_place' ];
   $gallery4 = $data[ 'gallery_4_photos_of_the_place' ];
   $gallery5 = $data[ 'gallery_5_photos_of_the_place' ];
   if(empty($gallery2)){
       $all_gallerys = $gallery1;
   } elseif(empty($gallery3)){
       $all_gallerys = $gallery1. ','. $gallery2;
   } elseif(empty($gallery4)){
       $all_gallerys = $gallery1. ','. $gallery2. ','. $gallery3;
   } elseif(empty($gallery5)){
       $all_gallerys = $gallery1. ','. $gallery2. ','. $gallery3. ','. $gallery4;
   } else {
       $all_gallerys = $gallery1. ','. $gallery2. ','. $gallery3. ','. $gallery4. ','. $gallery5;
   }
   update_post_meta( $post_id, 'all_gallerys', $all_gallerys );
}
);

?>
