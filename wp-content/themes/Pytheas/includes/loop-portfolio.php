<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file contains the styling for portfolio entries.
 */
 
//global variables
global $wpex_counter;

//count
$wpex_counter++;

//get featured image
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image

//crop image
$featured_image = aq_resize( $img_url, 380, 260, true ); //resize & crop the image

//show entry only if it has a featured image
if($featured_image) {  ?>
<li class="portfolio-entry grid-4">
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="portfolio-entry-img-link"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" class="portfolio-entry-img" /></a>
	<?php
	if(!is_single()) { ?>
    <div class="portfolio-entry-description">
        	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        	<div class="portfolio-entry-excerpt">
				<?php
				//show trimmed excerpt if default excerpt is empty
                !empty($post->post_excerpt) ? $excerpt = get_the_excerpt() : $excerpt = wp_trim_words(get_the_content(), 15);
                echo $excerpt; ?>
            </div><!-- .portfolio-entry-excerpt -->
    </div><!-- .portfolio-entry-description -->
    <?php } ?>
</li><!-- /portfolio-entry -->

<?php } if($wpex_counter==4 ){ echo '<div class="clear"></div>'; $wpex_counter=0; } //end loop ?>