<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get header
get_header();

//start post loop
if (have_posts()) : while (have_posts()) : the_post();

//get terms
$terms = get_the_term_list( get_the_ID(), 'portfolio_cats' );
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
	<nav id="single-nav" class="clearfix"> 
        <?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="inner"><span class="wpex-icon-chevron-left"></span></span>', false); ?>
        <?php previous_post_link('<div id="single-nav-right">%link</div>', '<span class="inner"><span class="wpex-icon-chevron-right"></span></span>', false); ?>
    </nav><!-- /single-nav -->
</header><!-- /page-heading -->

<article id="post" class="single-portfolio clearfix"> 

	<section id="single-meta" class="meta clearfix" >
        <ul>
           <li><span class="wpex-icon-calendar"></span><?php the_date(); ?></li>
           <?php if($terms) { ?><li><span class="wpex-icon-folder-open"></span><?php echo get_the_term_list( get_the_ID(), 'portfolio_cats', '', ', ', ' ') ?></li><?php } ?>
           <?php if(comments_open()) { ?><li class="comment-scroll"><span class="wpex-icon-comment"></span> <?php comments_popup_link(__('Leave a comment', 'wpex'), __('1 Comment', 'wpex'), __('% Comments', 'wpex'), 'comments-link', __('Comments closed', 'wpex')); ?></li><?php } ?>
        </ul>
	</section><!-- /meta -->
    
    <div id="single-portfolio-media">
    	<div id="single-portfolio-media-inner">
			<?php
            //get attachement count
            $get_attachments = get_children( array( 'post_parent' => $post->ID ) );
            $attachments_count = count( $get_attachments );
                
            //show featured image if atachment count is equal to 1
            if($attachments_count <= '1') {	
                
                //get featured image url
                $thumb = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
                
                //resize & crop the featured image
                $featured_image = $featured_image = aq_resize( $img_url, 628, 9999, false );
                
                //show featured image if defined
                if($featured_image) {
                ?>
                
                    <div class="post-thumbnail">
                        <a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="prettyphoto-link"><img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" /></a>
                    </div><!-- /post-thumbnail -->
                <?php } //no featured image ?>
            <?php }
            //attachment count greater then 1, load slider
            else {
                //attachement loop
                $args = array(
                    'orderby' => 'menu_order',
                    'post_type' => 'attachment',
                    'post_parent' => get_the_ID(),
                    'post_mime_type' => 'image',
                    'post_status' => null,
                    'posts_per_page' => -1
                );
                $attachments = get_posts($args);
                ?>
                
                <div class="flexslider-container">
                    <div id="slider-<?php $post->ID; ?>" class="flexslider">
                        <ul class="slides">
                
                            <?php
                            //loop through attachments
                            foreach ($attachments as $attachment) :
                            
                            //get atachment url
                            $img_url = wp_get_attachment_url($attachment->ID,'full'); //get full URL to image
                            
                            //resize & crop the featured image
                            $featured_image = $featured_image = aq_resize( $img_url, 628, 9999, false );
                            
                            //include image in slider/gallery
                            $be_rotator_include = get_post_meta($attachment->ID, 'be_rotator_include', true);
                            if($be_rotator_include != '1') {
                            
                            //get caption
                            $attachment_caption = $attachment->post_excerpt;
                            ?>
                            
                            <li class="slide">
                                <a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" rel="prettyPhoto[portfolio_gallery]"><img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" /></a>
                            </li>
                            <?php } //not in rotator
                                endforeach; //end attachment loop
                            ?>
                        </ul><!-- /slides -->
                    </div><!-- /flexslider -->
                </div><!-- /flexslider-container -->
            <?php } ?>
    	</div><!-- /single-portfolio-media-inner -->
    </div><!-- /single-portfolio-media -->
    
    
    <article id="single-portfolio-info" class="entry clearfix">
        <?php the_content(); ?>
    </article><!-- /single-portfolio-info -->
    
	<?php		
		//get related portfolio posts
		$cats = wp_get_post_terms($post->ID, 'portfolio_cats');
		
		//don't even bother if there aren't any portfolio categories
		if($cats) {  ?>
		<div id="single-portfolio-related" class="clearfix">
					<h3 class="heading"><span><?php _e('Related Items','wpex'); ?></span></h3>
			<div class="grid-container">
				<?php
				//loop arguments
				$args = array(
					'post__not_in' => array( $post->ID ),
					'orderby'=> 'post_date',
					'order' => 'rand',
					'post_type' => 'portfolio',
					'posts_per_page' => 4,
					'tax_query' => array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'portfolio_cats',
							'terms' => $cats[0]->term_id
						),
					)
				);
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post();
					//get the portfolio loop style
					get_template_part('includes/loop','portfolio');
				endwhile; wp_reset_query(); } ?>
			</div><!--/grid-container -->
		</div><!-- /single-portfolio-related -->
    <?php } //no cats ?>
    
	<?php
	//get comments
    comments_template(); ?>
    
</article><!-- /post -->
  
<?php
//end post loop
endwhile; endif;

//get portfolio sidebar
get_sidebar('portfolio');

//get template footer
get_footer(); ?>