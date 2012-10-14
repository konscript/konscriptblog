<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file loads custom css and js for our theme
 */

//hook function
add_action('wp_enqueue_scripts','theme_specific_scripts');

//start function
function theme_specific_scripts() {
	
	
	/*******
	*** CSS
	*******************/
	
	//core
	wp_enqueue_style('framework', WPEX_CSS_DIR . '/framework.css');
	wp_enqueue_style( 'style', get_stylesheet_uri(), 'framework' );
	
	
	//responsive
	if(of_get_option('responsive')) {
		wp_enqueue_style('framework-responsive', WPEX_CSS_DIR . '/framework_responsive.css', 'style');
		wp_enqueue_style('responsive', WPEX_CSS_DIR . '/responsive.css', 'style', true);
	}
	
	//font awesome
	wp_enqueue_style('awesome-font', WPEX_CSS_DIR . '/awesome_font.css', 'style');
	
	

	/*******
	*** jQuery
	*******************/
	
	//superfish nav
	wp_enqueue_script('hoverIntent', WPEX_JS_DIR .'/hoverintent.js', array('jquery'), 'r6', true);
	wp_enqueue_script('superfish', WPEX_JS_DIR .'/superfish.js', array('jquery'), '1.4.8', true);
	
	//flexslider
	if(is_front_page() || is_singular('portfolio')) {
		wp_enqueue_script('easing', WPEX_JS_DIR .'/easing.js', array('jquery'), '1.3', true);
		wp_enqueue_script('flexslider', WPEX_JS_DIR .'/flexslider-min.js', array('jquery'), '2', true);
		wp_enqueue_script('wpex-slider-init', WPEX_JS_DIR .'/slider_init.js', false, '1.0', true);
		
		//localize slider
		$slideshow = false;
		$slideshow = (of_get_option('slider_slideshow') == '1') ? 'true' : 'false';
		$slider_params = array(
			'slider_animation' => of_get_option('slider_animation'),
			'slider_slideshow' => $slideshow,
		);
		wp_localize_script( 'flexslider', 'flexsliderLocalize', $slider_params );
	}


	//comment replies
	if(is_single() || is_page()) {
		wp_enqueue_script('comment-reply');
	}
	
	
	//lightbox
	wp_enqueue_script('prettyphoto', WPEX_JS_DIR .'/prettyphoto.js', array('jquery'), '3.1.4', true);
	wp_enqueue_style('prettyphoto', WPEX_CSS_DIR . '/prettyphoto.css', 'style', true);
	
	
	//localize lightbox
	$lightbox_params = array(
		'theme' => of_get_option('lightbox_theme')
	);
	wp_localize_script( 'prettyphoto', 'lightboxLocalize', $lightbox_params );
	

	//responsive
	if(of_get_option('responsive')) {
		wp_enqueue_script('fitvids', WPEX_JS_DIR .'/fitvids.js', array('jquery'), 1.0, true);
		wp_enqueue_script('uniform', WPEX_JS_DIR .'/uniform.js', array('jquery'), '1.7.5', true);
		wp_enqueue_script('wpex-responsive', WPEX_JS_DIR .'/responsive.js', array('jquery'), '', true);
	}
	
	//localize responsive nav
	$nav_params = array(
		'text' => __('Go to...','wpex'),
	);
	wp_localize_script( 'wpex-responsive', 'responsiveLocalize', $nav_params );
	
	//initialize
	wp_enqueue_script('wpex-global-init', WPEX_JS_DIR .'/global_init.js', false, '1.0', true);

	
} //end theme_specific_scripts()
?>