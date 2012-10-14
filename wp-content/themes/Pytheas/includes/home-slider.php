<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get post type ==> slides
global $post;
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'orderby' => 'date',
	'order' => "ASC",
	'suppress_filters' => false //WPML support
);
$slider_posts = get_posts($args);

//show slider section if posts exist
if($slider_posts) { ?>  
    
<div id="full-slider">
    <div class="flexslider-container">
        <div class="flexslider">
            <ul class="slides">
                <?php
                //begin loop
                foreach($slider_posts as $post) : setup_postdata($post);
                
                //get featured image
                $thumb = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
                
                //crop image
                $featured_image = aq_resize( $img_url, 970, 400, true ); //resize & crop the image
				
				//meta
				$wpex_slide_url = get_post_meta($post->ID, 'wpex_slide_url', TRUE);
				$wpex_slide_caption_title = get_post_meta($post->ID, 'wpex_slide_caption_title', TRUE);
				$wpex_slide_caption_description = get_post_meta($post->ID, 'wpex_slide_caption_description', TRUE);
                ?>
                    <li class="slide">
                    <?php if($wpex_slide_url) { ?>
                    	<a href="<?php echo $wpex_slide_url; ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" /></a>
                    <?php } else { ?>
                        <img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" />
                    <?php } ?>
                    	<?php if($wpex_slide_caption_title || $wpex_slide_caption_description) { ?>
                        	<div class="flex-caption">
                                <?php if($wpex_slide_caption_title) { echo '<h2>' .$wpex_slide_caption_title .'</h2>'; } ?>
                                <?php if($wpex_slide_caption_description) { echo '<p>' .$wpex_slide_caption_description .'</p>'; } ?>
                            </div>
                        <?php } ?>
                    </li>
                <?php endforeach; ?>
            </ul><!-- /slides -->
        </div><!--/flexslider -->
    </div><!--/flexslider-container -->
</div><!--/full-slider -->

<?php } wp_reset_postdata(); ?>