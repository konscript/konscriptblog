<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file filters the default WP pagination where needed
 */

//get posts per page
$wpex_option_posts_per_page = get_option( 'posts_per_page' );

//add posts per page filter
add_action( 'init', 'wpex_modify_posts_per_page', 0);
function wpex_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'wpex_option_posts_per_page' );
}

//modify posts per page
function wpex_option_posts_per_page( $value ) {
	global $wpex_option_posts_per_page;
	
	//tax pagination
    if(is_tax('portfolio_cats')) {
		return of_get_option('portfolio_pagination','12');
	}
	if(is_search()) {
		return '10';
	}
	else { return $wpex_option_posts_per_page; }
}

?>