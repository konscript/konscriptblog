<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get template header
get_header();

//start post loop
if (have_posts()) : while (have_posts()) : the_post();
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
	<nav id="single-nav" class="clearfix"> 
        <?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="inner"><span class="wpex-icon-chevron-left"></span></span>', false); ?>
        <?php previous_post_link('<div id="single-nav-right">%link</div>', '<span class="inner"><span class="wpex-icon-chevron-right"></span></span>', false); ?>
    </nav><!-- /single-nav --> 
</header><!-- /post-meta -->

<div id="post" class="clearfix">

    	<?php 
        //show only on non-protected posts
		if(!post_password_required()) : ?>
        
        <section class="meta clearfix" id="single-meta">
            <ul>
                <li><span class="wpex-icon-calendar"></span><?php the_date(); ?></li>    
                <li><span class="wpex-icon-folder-open"></span><?php the_category(' / '); ?></li>
                <?php if(comments_open()) { ?><li class="comment-scroll"><span class="wpex-icon-comment"></span> <?php comments_popup_link(__('Leave a comment', 'wpex'), __('1 Comment', 'wpex'), __('% Comments', 'wpex'), 'comments-link', __('Comments closed', 'wpex')); ?></li><?php } ?>
                <li><span class="wpex-icon-user"></span><?php the_author_posts_link(); ?></li>
           </ul>
        </section><!--/meta -->
        
		<?php
		//featured image
		if(of_get_option('blog_single_thumbnail') == '1') {
			
		//get full URL to image
        $img_url = wp_get_attachment_url(get_post_thumbnail_id(),'full');
            
        //resize & crop the image
        $featured_image = aq_resize( $img_url, 628, 400, true );
		
		//show image
		if($featured_image) {
		?>
		<a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="prettyphoto-link" id="post-thumbnail"><img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" /></a>
        <?php } // no featured image defined
		} //featured image disabled
		?>
        
        <?php
		endif; //end password required test ?>
        
		<article class="entry clearfix">
			<?php the_content(); // *** this is your main post content output *** ?>
        </article><!-- /entry -->
        
		<?php 
        //show only on non-protected posts
		if(!post_password_required()) : ?>
        
        <?php wp_link_pages(' '); ?>
        
		<?php
        //post tags
		if(of_get_option('blog_tags') =='1') {
			the_tags('<div class="post-tags clearfix">','','</div>');
		}
		?>
        
        <?php
		//author bio
		if(of_get_option('blog_bio') =='1') { ?>
        <div id="single-author" class="clearfix">
            <h3 class="heading"><span><?php _e('Author Bio','wpex'); ?></span></h3>
            <div id="author-image">
               <?php echo get_avatar( get_the_author_meta('user_email'), '60', '' ); ?>
            </div><!-- author-image --> 
            <div id="author-bio">
                <h4><?php the_author_posts_link(); ?></h4>
                <p><?php the_author_meta('description'); ?></p>
            </div><!-- author-bio -->
        </div><!-- /single-author -->
        <?php } ?>
        
		<?php
		//start related posts section if not disabled
		if(of_get_option('blog_related') =='1') {
			$category = get_the_category(); //get first current category ID
			$this_post = $post->ID; // get ID of current post
			
			$args = array(
				'numberposts' => '3',
				'orderby' => 'rand',
				'category' =>  $category[0]->cat_ID,
				'exclude' => $this_post,
				'offset' => null
			);
			$posts = get_posts($args);
			if($posts) { ?>
				<section id="related-posts" class="boxframe">
					<h3 class="heading"><span><?php _e('Related Articles','wpex'); ?></span></h3>
					<?php
					foreach($posts as $post) : setup_postdata($post);
					//featured img
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
					$featured_image = aq_resize( $img_url, 150, 120, true ); //resize & crop the image
					?>
					<div class="related-entry clearfix">
						<?php if($featured_image) { ?>
							 <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="alignleft related-entry-img-link">
								<img class="related-post-image blog-entry-img" src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" />
							 </a>
						<?php } ?>
						<div class="related-entry-content">
						  <h4><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h4>
						  <div class="related-entry-excerpt">
							<?php echo wp_trim_words( get_the_content(), 25, '...' ); ?><a href="<?php the_permalink(); ?>" class="read-more"><?php _e('read more','wpex'); ?> &rarr;</a>
						  </div><!-- /related-entry-excerpt -->
						</div>
						<!-- /related-entry-content -->
					</div>
					<!-- /related-entry -->
					<?php endforeach; wp_reset_postdata(); ?>
					</section> 
					<!-- /related-posts --> 
			<?php } // no posts found
		} //related posts section disabled
		?>
            
		<?php
		endif; //end password required test ?>
        
        <?php comments_template(); ?>
        
</div><!-- /post -->

<?php
//end post loop
endwhile; endif;

//get template sidebar
get_sidebar();

//get template footer
get_footer(); ?>