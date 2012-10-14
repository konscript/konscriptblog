<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file is used to show recent blog posts on the homepage
*/

//get post type ==> blog
global $post;
$args = array(
	'post_type' =>'post',
	'numberposts' => of_get_option('home_blog_count', '4'),
	'suppress_filters' => false //WPML support
);
$blog_posts = get_posts($args);
?>
<?php
//show blog section only if posts exist
if($blog_posts) { ?>
<div id="home-blog">

	<?php
	//show heading
    if(of_get_option('home_blog_title')) { ?>
    	<h2 class="heading">
        	<span><?php echo of_get_option('home_blog_title'); ?></span>
        </h2>
    <?php } ?>
	
	
    <div class="clearfix grid-container">
		<?php
		$count=0;
        //start loop
        foreach($blog_posts as $post) : setup_postdata($post);
		$count++;
        
        //get full URL to image
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url($thumb,'full'); 

		//resize & crop the image
        $featured_image = aq_resize( $img_url, 380, 260, true );
        ?>
        
        <div class="home-entry grid-4">
            <?php
			//featured image
            if($featured_image) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-entry-img-link">
                    <img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" class="blog-entry-img" />
                </a>
            <?php } ?>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="home-entry-excerpt">
                <?php echo wp_trim_words(get_the_content(), 12); ?>
            </div>
            <!-- /home-entry-excerpt -->
        </div>
        <!-- /home-entry -->
        <?php
        //clear floats
		if($count == 4) { echo '<div class="clear"></div>'; $count = 0; }
		//end loop
		endforeach; ?>
	</div><!-- /grid-container -->
</div>
<!-- /home-blog -->      	
<?php
} //no posts found
wp_reset_postdata(); //reset post data to prevent conflicts with other loops and main query
?>