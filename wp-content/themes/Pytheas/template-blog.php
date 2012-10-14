<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * Template Name: Blog
 */
//get template header
get_header();

//start page loop
if (have_posts()) : while (have_posts()) : the_post();
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
</header><!-- /page-heading -->

<div id="post" class="blog-template clearfix">
	<?php
    //query posts
        query_posts(
            array(
				'post_type'=> 'post',
				'paged'=>$paged
       		)
		);

	//loop
    if (have_posts()) :
		//get entry template
		get_template_part( 'includes/loop', 'entry');            	
    endif;
	
	//show pagination
	pagination();
	
	//reset query
	wp_reset_query(); ?>

</div><!-- /post -->

<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>