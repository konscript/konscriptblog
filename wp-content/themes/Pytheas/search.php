<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */

//get tempate header
get_header();

//results found
if (have_posts()) : ?>
        
        	<header id="page-heading">
				<h1 id="archive-title"><?php _e('Search Results For','wpex'); ?>: <?php the_search_query(); ?></h1>
            </header><!-- /page-heading -->
            
			<div id="post" class="clearfix">

			<?php
			//show posts using the serach loop
        	get_template_part( 'includes/loop', 'search');
			
			//paginate pages
			pagination(); ?>
        
			</div><!-- /post  -->
        
		<?php
		//no results found
        else : ?>
        
			<header id="page-heading">
				<h1 id="archive-title"><?php _e('Search Results For','wpex'); ?>: <?php the_search_query(); ?></h1>
        	</header><!-- /page-heading -->
            
            <div id="post" class="post clearfix">
            	<?php _e('No results found for that query.', 'wpex'); ?>
			</div><!-- /post  -->
            
        <?php endif; ?>

<?php
//get template sidebar
get_sidebar('pages');

//get template footer
get_footer(); ?>