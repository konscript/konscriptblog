<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file contains the styling for blog post entries.
 */
 
//start loop
while (have_posts()) : the_post(); ?>  

<article <?php post_class('loop-entry clearfix'); ?>>  
    <section class="entry-content">
		<?php
		//get full URL to image
        $img_url = wp_get_attachment_url(get_post_thumbnail_id(),'full');
            
        //resize & crop the image
        $featured_image = aq_resize( $img_url, 630, 400, true );

		//show featured image if available
        if($featured_image) {  ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="loop-entry-img-link">
                <img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" />
            </a>
        <?php } //featured image not set ?>
	
	    <div class="entry-bottom">
    	    <header>
    	        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    	    </header>
            <ul class="meta clearfix">
                <li><span class="wpex-icon-calendar"></span><?php the_time('jS F Y'); ?></li>    
                <?php if(comments_open()) { ?><li><span class="wpex-icon-comment"></span> <?php comments_popup_link(__('Leave a comment', 'wpex'), __('1 Comment', 'wpex'), __('% Comments', 'wpex'), 'comments-link', __('Comments closed', 'wpex')); ?></li><?php } ?>
           </ul>
	        <div class="entry-text">
	            <?php
				//show blog excerpt <= excerpt length controlled via functions.php
                the_excerpt(); ?>
	        </div><!-- /entry-text -->
			<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('read more','wpex'); ?> &rarr;</a>
	    </div><!-- /entry-right -->
	</section><!-- entry-bottom -->   
</article><!-- /entry -->
<?php
//end loop
endwhile; ?>