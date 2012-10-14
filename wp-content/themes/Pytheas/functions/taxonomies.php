<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file registers custom taxonomies for the theme
 */
 
 
add_action( 'init', 'wpex_create_taxonomies' );
function wpex_create_taxonomies() {
	
	//portfolio taxonomy labels
	$wpex_portfolio_labels = array(
		'name' => __( 'Portfolio Categories', 'wpex' ),
		'singular_name' => __( 'Portfolio Category', 'wpex' ),
		'search_items' =>  __( 'Search Portfolio Categories', 'wpex' ),
		'all_items' => __( 'All Portfolio Categories', 'wpex' ),
		'parent_item' => __( 'Parent Portfolio Category', 'wpex' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'wpex' ),
		'edit_item' => __( 'Edit Portfolio Category', 'wpex' ),
		'update_item' => __( 'Update Portfolio Category', 'wpex' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'wpex' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'wpex' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', 'wpex' )
	);
	
	
	// Portfolio taxonomies
	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => true,
		'labels' => apply_filters('wpex_portfolio_tax_labels', $wpex_portfolio_labels),
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));
}
?>