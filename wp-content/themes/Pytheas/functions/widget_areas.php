<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file registers the theme's widget regions
 */

//pages
register_sidebar(array(
	'name' => __( 'Pages','wpex'),
	'id' => 'pages',
	'description' => __( 'Widgets in this area are used on pages.','wpex' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//blog
register_sidebar(array(
	'name' => __( 'Blog/Archives','wpex'),
	'id' => 'sidebar',
	'description' => __( 'Widgets in this area are used on the main sidebar region.','wpex' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//portfolio
register_sidebar(array(
	'name' => __( 'Portfolio','wpex'),
	'id' => 'portfolio',
	'description' => __( 'Widgets in this area are used on the portfolio posts.','wpex' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//register footer widgets if enabled
if(of_get_option('widgetized_footer')) {
	//footer 1
	register_sidebar(array(
		'name' => __( 'Footer 1','wpex'),
		'id' => 'footer-one',
		'description' => __( 'Widgets in this area are used in the first footer column','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	//footer 2
	register_sidebar(array(
		'name' => __( 'Footer 2','wpex'),
		'id' => 'footer-two',
		'description' => __( 'Widgets in this area are used in the second footer column','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	//footer 3
	register_sidebar(array(
		'name' => __( 'Footer 3','wpex'),
		'id' => 'footer-three',
		'description' => __( 'Widgets in this area are used in the third footer column','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	//footer 4
	register_sidebar(array(
		'name' => __( 'Footer 4','wpex'),
		'id' => 'footer-four',
		'description' => __( 'Widgets in this area are used in the fourth footer column','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
} //footer widgets disabled
?>