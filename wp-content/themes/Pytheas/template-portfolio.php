<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * Template Name: Portfolio
 */

//get template header
get_header();

//start page loop
if (have_posts()) : while (have_posts()) : the_post();
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
</header><!-- /page-heading -->

<?php
//show page content if not empty
$content = $post->post_content;
if(!empty($content)) { ?>
	<div id="portfolio-description" class="clearfix">
		<?php the_content(); ?>
	</div><!-- /portfolio-description -->
<?php } ?>

<div id="portfolio-template">
    <div id="portfolio-wrap">
    	<ul class="portfolio-content clearfix">
			<?php		
            //get post type ==> portfolio
            query_posts(
				array(
					'post_type'=>'portfolio',
					'posts_per_page' => of_get_option('portfolio_pagination','12'),
					'paged'=>$paged
            	)
			);
			//start loop
            while (have_posts()) : the_post();
			    //get the portfolio loop style
				get_template_part('includes/loop','portfolio');
			//end loop
			endwhile; ?>
		</ul>
        <?php
		//show pagination
        pagination();
		//reset the custom query
		wp_reset_query(); ?>
    </div><!-- /portfolio-wrap -->
</div><!-- /portfolio-template -->

<?php
//end page loop
endwhile; endif;

//get template footer
get_footer(); ?>