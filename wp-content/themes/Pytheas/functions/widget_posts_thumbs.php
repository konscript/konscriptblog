<?php
/******************************************
/* Recent Posts Widget
******************************************/
class wpex_recent_posts_thumb extends WP_Widget {
    /** constructor */
    function wpex_recent_posts_thumb() {
        parent::WP_Widget(false, $name = __('Recent Posts With Thumbnails','wpex') );
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$select_post_type = apply_filters('widget_title', $instance['select_post_type']);
        $number = apply_filters('widget_title', $instance['number']);
        $offset = apply_filters('widget_title', $instance['offset']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="wpex-widget-recent-posts">
							<?php
								global $post;
								$tmp_post = $post;
								$args = array(
									'numberposts' => $number,
									'offset'=> $offset,
									 'post_type' => $select_post_type,
									 'tax_query' => array(
										 array(
										 'taxonomy' => 'post_format',
										 'field' => 'slug',
										 'terms' => array(
										 				'post-format-quote',
														'post-format-link',
														'post-format-video'
													),
										 'operator' => 'NOT IN',
										 ),
									 )
								);
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) : setup_postdata($post);
								//get featured image
								$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
								//crop image
								$featured_image = aq_resize( $img_url, 50, 50, true ); //resize & crop the image
								?>
                                <?php if($featured_image) {  ?>
									<li class="clearfix">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" /></a><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                        <div class="date"><?php echo get_the_date(); ?></div>
                                    </li>
                               <?php } ?>
								<?php endforeach; ?>
								<?php $post = $tmp_post; ?>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['select_post_type'] = strip_tags($new_instance['select_post_type']);
	$instance['number'] = strip_tags($new_instance['number']);
	$instance['offset'] = strip_tags($new_instance['offset']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$select_post_type = esc_attr($instance['select_post_type']);
        $number = esc_attr($instance['number']);
        $offset = esc_attr($instance['offset']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpex'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','wpex'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
		<p>
        <label for="<?php echo $this->get_field_id('select_post_type'); ?>"><?php _e('Select a post type:', 'wpex'); ?></label> 
        <select class='wpex-select' name="<?php echo $this->get_field_name('select_post_type'); ?>" id="<?php echo $this->get_field_id('select_post_type'); ?>">
        <option value="post" <?php if($select_post_type == 'post') { ?>selected="selected"<?php } ?>><?php _e('Post', 'wpex'); ?></option>
		<option value="portfolio" id="portfolio" <?php if($select_post_type == 'portfolio') { ?>selected="selected"<?php } ?>><?php _e('Portfolio','portfolio') ?></option>
        </select>
		</p>
        
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:', 'wpex'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Offset (the number of posts to skip):', 'wpex'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" />
        </p>
        <?php
    }


} // class wpex_recent_posts_thumb
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("wpex_recent_posts_thumb");'));	
?>