<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file registers theme post types
 */
 
add_action( 'init', 'wpex_create_post_types' );
function wpex_create_post_types() {

	/** slider post type **/
	register_post_type( 'slides', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => array(
			'name' => __( 'Home Slides', 'wpex' ),
			'singular_name' => __( 'Slide', 'wpex' ),		
			'add_new' => _x( 'Add New', 'Slide', 'wpex' ),
			'add_new_item' => __( 'Add New Slide', 'wpex' ),
			'edit_item' => __( 'Edit Slide', 'wpex' ),
			'new_item' => __( 'New Slide', 'wpex' ),
			'view_item' => __( 'View Slide', 'wpex' ),
			'search_items' => __( 'Search Slides', 'wpex' ),
			'not_found' =>  __( 'No Slides found', 'wpex' ),
			'not_found_in_trash' => __( 'No Slides found in Trash', 'wpex' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title', 'revisions','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'slides' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'menu_icon' => get_template_directory_uri() . '/images/admin/slides.png',
		)
	  );
	  
	  
	/**  hp highlights **/
	register_post_type( 'hp_highlights', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => array(
			'name' => __( 'Highlights', 'wpex' ),
			'singular_name' => __( 'Highlight', 'wpex' ),		
			'add_new' => _x( 'Add New', 'Highlight', 'wpex' ),
			'add_new_item' => __( 'Add New Highlight', 'wpex' ),
			'edit_item' => __( 'Edit Highlight', 'wpex' ),
			'new_item' => __( 'New Highlight', 'wpex' ),
			'view_item' => __( 'View Highlight', 'wpex' ),
			'search_items' => __( 'Search Highlights', 'wpex' ),
			'not_found' =>  __( 'No Highlights found', 'wpex' ),
			'not_found_in_trash' => __( 'No Highlights found in Trash', 'wpex' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','editor','revisions'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'hp-highlights' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'menu_icon' => get_template_directory_uri() . '/images/admin/highlights.png',
		)
	  );



	/** portfolio post type **/
	
	//register portfolio post type
	register_post_type( 'portfolio', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => array(
			'name' => __( 'Portfolio', 'wpex' ),
			'singular_name' => __( 'Portfolio', 'wpex' ),		
			'add_new' => _x( 'Add New', 'Portfolio Post', 'wpex' ),
			'add_new_item' => __( 'Add New Portfolio Post', 'wpex' ),
			'edit_item' => __( 'Edit Portfolio Post', 'wpex' ),
			'new_item' => __( 'New Portfolio Post', 'wpex' ),
			'view_item' => __( 'View Portfolio Post', 'wpex' ),
			'search_items' => __( 'Search Portfolio Posts', 'wpex' ),
			'not_found' =>  __( 'No Portfolio Posts found', 'wpex' ),
			'not_found_in_trash' => __( 'No Portfolio Posts found in Trash', 'wpex' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','editor','thumbnail','excerpt','revisions','comments'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'portfolio' ),
		   'menu_icon' => get_template_directory_uri() . '/images/admin/portfolio.png',
		)
	);

}
?>