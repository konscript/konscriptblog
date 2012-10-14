<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get template header
get_header();

//start tax loop only if taxonomies exist
if (have_posts()) :

?>

<header id="page-heading">
	<h1>
	<?php
		$term =	$wp_query->queried_object;
		echo $term->name;
	?>
	</h1>
</header><!-- /page-heading -->

<?php
//show category description if not empty
if(category_description()) { ?>
<div id="portfolio-description">
	 <?php echo category_description( ); ?>
</div><!-- /portfolio-description -->
<?php } ?>
    
<div id="portfolio-template" class="clearfix">
    <div id="portfolio-wrap" class="grid-container clearfix">
    
        <?php
		//start portfolio entry loop
        while (have_posts()) : the_post();
			//get the portfolio loop style
			get_template_part('includes/loop','portfolio');
        endwhile; ?>
        
        <div class="clear"></div>
		<?php
        //page pagination
        pagination();
        
        //reset tax query
        wp_reset_query(); ?>
          
    </div><!-- /portfolio-wrap -->
</div><!-- /portfolio-template --->
<?php
//end page loop
endif;

//get portfolio sidebar
get_sidebar('portfolio');

//get template footer
get_footer(); ?>