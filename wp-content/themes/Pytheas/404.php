<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file is used for 404 error pages
 */

//get template header
get_header(); ?>

<div id="error-page">	
	<h1 id="error-page-title">404</h1>			
	<p id="error-page-text">
	<?php
	//echo 404 error message
    _e('Unfortunately, the page you tried accessing could not be retrieved. Please visit the','wpex'); ?> <a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php _e('homepage','wpex'); ?></a>.
    </p>
</div><!-- END error-page -->

<?php
//get template footer
get_footer(); ?>