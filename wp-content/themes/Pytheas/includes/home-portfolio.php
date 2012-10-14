<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get post type ==> portfolio
global $post;
$args = array(
	'post_type' =>'portfolio',
	'numberposts' => of_get_option('home_portfolio_count', '4'),
	'suppress_filters' => false //WPML support
);
$portfolio_posts = get_posts($args);

//show portfolio section if posts exist
if($portfolio_posts) { ?>  
    
<div id="home-portfolio">  
	<?php
	//show heading
    if(of_get_option('home_portfolio_title')) { ?>
    	<h2 class="heading">
        	<span><?php echo of_get_option('home_portfolio_title'); ?></span>
        </h2>
    <?php } ?>

	<ul class="grid-container home-portfolio clearfix">
		<?php
		//begin loop
        foreach($portfolio_posts as $post) : setup_postdata($post);
            //get the portfolio loop style
            get_template_part('includes/loop','portfolio');
        endforeach; ?>
    </ul><!-- /grid-container -->
</div><!-- /home-portfolio -->

<?php } wp_reset_postdata(); ?>