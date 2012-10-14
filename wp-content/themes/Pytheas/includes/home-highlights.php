<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */
//get post type ==> hp highlights
global $post;
$args = array(
	'post_type' =>'hp_highlights',
	'numberposts' => '-1',
	'suppress_filters' => false //WPML support
);
$hp_highlight_posts = get_posts($args);

//start loop if highlights actually exist
if($hp_highlight_posts) { ?>        

<div id="home-highlights">
    
	<?php
    //tagline heading
    if(of_get_option('home_highlights_title')) { ?>
        <h2 class="heading">
            <span><?php echo of_get_option('home_highlights_title'); ?></span>
        </h2>
    <?php } ?>
    
    <div class="grid-container clearfix">
    
		<?php
		$count=0; //set counter var
        foreach($hp_highlight_posts as $post) : setup_postdata($post); //start loop
		$count++; //increase counter var with each post in loop
        
        //meta
		$hp_highlights_url = get_post_meta($post->ID, 'wpex_hp_highlights_url', TRUE);
		$hp_highlights_icon = get_post_meta($post->ID, 'wpex_hp_highlights_icon', TRUE);
        ?>
        
        <div class="hp-highlight grid-5 <?php echo $post->ID; ?>"> 
            <h3>
				<?php
                //display icon if option not set to default
                if($hp_highlights_icon !='Select') { ?>
					<span class="wpex-icon-<?php echo $hp_highlights_icon; ?>"></span>
                <?php } //highlight meta option set to "Select" ?>
				<?php
				//show the highlight title as a link
				if(!empty($hp_highlights_url)) { ?><a href="<?php echo $hp_highlights_url; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<?php }
				//show plain title because link option is blank
				else { the_title(); } ?>
            </h3>
            <?php
			//show the post content
            the_content(); ?>
        </div>
        <!-- /hp-highlight -->
		<?php
        //clear floats
		if($count==5) { echo '<div class="clear"></div>'; $count=0; }
		//end loop
		endforeach; ?>
	 </div><!-- /grid-container -->
     
</div><!-- /home-highlights -->      	
<?php
} //no highlights found
wp_reset_postdata(); //reset postdata to avoid any conflicts ?>