<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file contains custom CSS For wp_head Hook = wpex_custom_css()
 */

//it would be silly to run function in the admin.
if (!is_admin()) {
	
	//hook function
	add_action('wp_head', 'wpex_custom_css');
	
	//begin wpex_custom_css()
	function wpex_custom_css() {
		
		$custom_css ='';
		
		/**custom css field**/
		if(of_get_option('custom_css')) {
			$custom_css .= of_get_option('custom_css');
		}
				
		//sidebar location
		if(of_get_option('sidebar_layout') == 'left') {
			$custom_css .= '#sidebar {float: left} #post{float: right}';
		}
		
		/**echo all css**/
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css . "\n</style>";
		if(!empty($custom_css)) { echo $css_output;}
		
	} //end wpex_custom_css()

} //is admin
?>