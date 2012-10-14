<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get template header
get_header();

//start post loop
if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header id="page-heading">
        <h1><?php the_title(); ?></h1>		
    </header><!-- /page-heading -->
    
    <article id="post" class="clearfix">
        <div class="entry clearfix">	
            <?php the_content(); ?>
        </div><!-- /entry -->         
	<?php comments_template(); ?>
    </article><!-- /post -->
 
<?php
//end post loop
endwhile; endif;

//get sidebar template
get_sidebar('pages');

//get footer template
get_footer(); ?>