<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * Template Name: Sitemap
 */

//get template header
get_header();

//start page loop
if (have_posts()) : while (have_posts()) : the_post();
?>
    
<header id="page-heading">
	<h1><?php the_title(); ?></h1>
</header>
<!-- /page-heading -->
    
<div id="template-sitemap" class="clearfix">

    <?php the_content(); ?>
    
    <div id="sitemap-wrap" class="grid-container clearfix">
    
    	<div class="sitemap-container grid-3">

            <h2><?php _e('Feeds','wpex'); ?></h2>
                <ul>  
                    <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>  
                    <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>  
                </ul>     
                
                
            <h2><?php _e('Tags','wpex'); ?></h2>
            <?php wp_tag_cloud(array(
                'format' => 'list',
                'smallest' => 12,
                'largest' => 12,
                'unit' => 'px',
                'number' => 20,
                'orderby'  => 'name',
                'order' => 'ASC',
                'taxonomy' => 'post_tag'
                ));
            ?>
            

            <h2><?php _e('Archives by Month','wpex'); ?></h2>
            <ul>
                <?php wp_get_archives('type=monthly&limit=10'); ?>
            </ul>
            
		</div>
		<!-- /sitemap-container one-third -->
		
        <div class="sitemap-container grid-3">
            
            
            <h2><?php _e('Blog Categories','wpex'); ?></h2>    	
            <?php $args = array(
                      'orderby' => 'name',
                      'order' => 'ASC',
                      'style' => 'list',
                      'show_count' => 0,
                      'hide_empty' => 1,
                      'use_desc_for_title' => 1,
                      'child_of' => 0,
                      'hierarchical' => true,
                      'title_li' => '',
                      'number' => NULL
                    );
                ?> 
                <ul>
                <?php wp_list_categories( $args ); ?>
                </ul>


            <h2><?php _e(' Portfolio Categories','wpex'); ?></h2>
            <?php $port_args = array(
                'taxonomy' => 'portfolio_cats',
                'orderby' => 'name',
                'order' => 'ASC',
                'style' => 'list',
                'show_count' => 0,
                'hide_empty' => 1,
                'use_desc_for_title' => 1,
                'child_of' => 0,
                'hierarchical' => true,
                'title_li' => '',
                'number' => NULL
              );
            ?> 
            <ul>
                <?php wp_list_categories( $port_args ); ?>
            </ul>
      
		</div>
		<!-- /sitemap-container one-third -->


        <div class="sitemap-container grid-3">
		<h2><?php _e('Pages','wpex'); ?></h2>
		<ul><?php wp_list_pages("title_li=" ); ?></ul> 
		</div>
        <!-- /sitemap-container one-third -->
    
    
	</div>
	<!-- /sitemap-wrap -->
  
</div>
<!-- /post -->
  
<?php
//reset the query just incase
wp_reset_query();

//end page loop
endwhile; endif;

//get template footer
get_footer(); ?>