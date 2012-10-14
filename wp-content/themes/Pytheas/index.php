<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get template header
get_header(); ?>
    
<div id="post" class="clearfix">
	<?php
    //main loop
    if (have_posts()) :
        //get entry template
        get_template_part( 'includes/loop', 'entry');            	
    endif;
	pagination();
    ?>
</div><!-- /post -->  
 
<?php
//get template sidebar
get_sidebar();
//get template footer
get_footer(); ?>