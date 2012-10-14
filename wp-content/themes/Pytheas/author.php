<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file is used for author pages
 */

//get template header
get_header();

//start post loop
if(have_posts()) :
?>

<header id="page-heading">
		<?php
        if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
        else :
        $curauth = get_userdata(intval($author));
        endif;
        ?>
        <h1><?php _e('Posts by','wpex'); ?>: <?php echo $curauth->display_name; ?></h1>
</header><!-- /page-heading -->

<div id="post" class="post clearfix">  
	<?php
	//get entry loop
    get_template_part('includes/loop', 'entry'); 
	
	//pagination function
	pagination(); ?>
</div><!--/post -->

<?php
//end post loop
endif;

//get sidebar template
get_sidebar();

//get footer template
get_footer(); ?>