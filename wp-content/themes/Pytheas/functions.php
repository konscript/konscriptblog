<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
*/


/*--------------------------------------*/
/* Define Constants
/*--------------------------------------*/
define( 'WPEX_JS_DIR', get_template_directory_uri().'/js' );
define( 'WPEX_CSS_DIR', get_template_directory_uri().'/css' );


/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 * @since Authentic Corp 1.0
 */
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
    $optionsframework_settings = get_option('optionsframework');
    // Gets the unique option id
    $option_name = $optionsframework_settings['id'];
    if ( get_option($option_name) ) {
        $options = get_option($option_name);
    }
    if ( isset($options[$name]) ) {
        return $options[$name];
    } else {
        return $default;
    }
}
}


/*--------------------------------------*/
/* Include core functions
/*--------------------------------------*/

//post types & taxonomies
require_once( get_template_directory() .'/functions/post_types.php' ); //registers custom post types
require_once( get_template_directory() .'/functions/taxonomies.php' ); //registers custom taxonomies


//theme customizer
require_once( get_template_directory() .'/functions/theme_customizer.php' ); //extends the theme_customier function


//load css and js
require_once( get_template_directory() .'/functions/scripts.php' ); //loads theme specific css and js
require_once( get_template_directory() .'/functions/custom_css.php' ); //echo's custom css to wp_head


//widgets
require_once( get_template_directory() .'/functions/widget_areas.php' ); //registers sidebars
require_once( get_template_directory() .'/functions/widget_posts_thumbs.php' ); //custom widget - recent posts with thumbnails


//call in the global variables first
require_once( get_template_directory() .'/functions/variables.php');


//functions
require_once( get_template_directory() .'/functions/pagination.php');
require_once( get_template_directory() .'/functions/img_resizer.php');
require_once( get_template_directory() .'/functions/better_comments.php');


//load these functions only in the admin dashboard
if(defined('WP_ADMIN') && WP_ADMIN ) {
	
	require_once( get_template_directory() .'/functions/meta_class.php');	//meta class
	require_once( get_template_directory() .'/functions/meta_usage.php' ); //meta boxes
	require_once( get_template_directory() .'/functions/editor_columns.php' ); //shows custom columns for post types
	require_once( get_template_directory() .'/functions/include_in_rotator.php' );	 //include in rotator media option
	
}



/*--------------------------------------*/
/* Theme Setup
/*--------------------------------------*/


//default width of primary content area
$content_width = 970;


//register navigation menus
register_nav_menus(
	array(
		'main_menu' => __('Main','wpex'),
		'footer_menu' => __('Footer','wpex')
	)
);
		
//localization support
load_theme_textdomain( 'wpex', get_template_directory() .'/lang' );


//posts per page <= used to override the default WP posts per page settings under Settings -> Reading
require_once( get_template_directory() .'/functions/posts_per_page.php' );


//automatic feed links
add_theme_support('automatic-feed-links');


//custom background
add_theme_support('custom-background');


//post thumbnails <= no custom image sized required due to the aqua image resizing script
add_theme_support('post-thumbnails');


//custom header
$custom_header_defaults = array(
	'default-image' => '',
	'random-default' => false,
	'width' => '970',
	'height' => 135,
	'flex-height' => true,
	'flex-width' => false,
	'default-text-color' => '',
	'header-text' => true,
	'uploads' => true,
	'wp-head-callback' => '',
	'admin-head-callback' => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $custom_header_defaults );


//set a default post excerpt length
function new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');


//replace excerpt link
function new_excerpt_more($more) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


// add home link to menu
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}


/*
* use this function to add more social icons to your theme
*(Use in a child theme though)

	function add_social_icons($social_icons){
		
		//new icons
		$extra_social_icons = array(
			'New Sample Social Service'
		);
		
		//combine icons
		$social_icons = array_merge($extra_social_icons, $social_icons);
		
		//return new array with added icons
		return $social_icons;
	
	}
	add_filter('wpex_get_social', 'add_social_icons');
*/
?>