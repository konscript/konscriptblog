<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * Template Name: Home
 */
 
//get template header
get_header(); ?>

<div id="home-wrap" class="clearfix">

<?php
//get tempalte path
$template_path = get_template_directory();

//show tagline if setting isn't empty
if(of_get_option('home_tagline')) { ?>
<div id="home-tagline" class="clearfix">
	<?php
	//tagline content
	echo of_get_option('home_tagline'); ?>
</div>
<!-- /home-tagline -->
<?php }

//show highlights if not disabled
require_once( $template_path . '/includes/home-highlights.php');


//show recent portfolio if not disabled
if(of_get_option('home_portfolio')) {
	require_once( $template_path . '/includes/home-portfolio.php');
}


//show recent blog posts if not disabled
if(of_get_option('home_blog')) {
	require_once( $template_path . '/includes/home-blog.php');
}
?>

</div><!-- /home-wrap -->   
<?php
//get template footer
get_footer(); ?>