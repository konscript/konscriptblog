<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * Template Name: Full-Width
 */

//get template header
get_header();

//start page loop
if (have_posts()) : while (have_posts()) : the_post();
?>

<div id="page-heading">
    <h1><?php the_title(); ?></h1>	
</div><!-- /page-heading -->

<div id="full-width" class="clearfix">

	<article class="entry clearfix">
		<?php the_content(); ?>
	</article><!-- /entry --> 
    
	<?php comments_template(); ?>
     
</div><!-- /full-width -->

<?php
//end post loop
endwhile; endif;

//get template footer
get_footer(); ?>