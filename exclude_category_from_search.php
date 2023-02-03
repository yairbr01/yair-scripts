<?php
// Exclude category from search in the website

function exclude_category_from_search($query) {
	if ($query->is_search) {
		$cat_id = get_cat_ID('{cat_name}');
		$query->set('cat', '-'.$cat_id);
	}
	return $query;
}
add_filter('pre_get_posts','exclude_category_from_search');

?>
