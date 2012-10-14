<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = 'options_wpex_themes';
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$slider_animation = array(
		'slide' => __('Slide', 'options_framework_theme'),
		'fade' => __('Fade', 'options_framework_theme'),
	);

	// Multicheck Array <= SAMPLE
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults 
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	
	//prettyPhoto themes
	$lightbox_themes = array(
		'pp_default' => 'Default',
		'light_rounded' => 'Light Rounded',
		'dark_rounded' => 'Dark Rounded',
		'light_square' => 'Light Square',
		'dark_square' => 'Dark Square',
		'facebook' => 'Facebook'
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/options/';

	$options = array();
	
	
	//GENERAL
	
	$options[] = array(
		'name' => __('General', 'options_framework_theme'),
		'type' => 'heading');
		
	$options['custom_logo'] = array(
		'name' => __('Custom Logo', 'options_framework_theme'),
		'desc' => __('Upload your custom logo.', 'options_framework_theme'),
		'id' => 'custom_logo',
		'type' => 'upload');
		
	$options['custom_favicon'] = array(
		'name' => __('Custom Favicon', 'options_framework_theme'),
		'desc' => __('Upload your custom site favicon.', 'options_framework_theme'),
		'id' => 'custom_favicon',
		'type' => 'upload');
		
	$options['responsive'] = array(
		'name' => __('Responsive?', 'options_framework_theme'),
		'desc' => __('Check box to enable the responsive layout.', 'options_framework_theme'),
		'id' => 'responsive',
		'std' => '1',
		'type' => 'checkbox');
		
	$options['header_search'] = array(
		'name' => __('Header Search?', 'options_framework_theme'),
		'desc' => __('Check box to enable the header search bar.', 'options_framework_theme'),
		'id' => 'header_search',
		'std' => '1',
		'type' => 'checkbox');
			
	$options['header_front_page_exclude'] = array(
		'name' => __('Exclude Header Image From Homepage?', 'options_framework_theme'),
		'desc' => __('Check box to exclude the header image from the homepage.', 'options_framework_theme'),
		'id' => 'header_front_page_exclude',
		'std' => '1',
		'type' => 'checkbox');
		
	$options['widgetized_footer'] = array(
		'name' => __('Widgetized Footer?', 'options_framework_theme'),
		'desc' => __('Check box to enable the widgetized footer area.', 'options_framework_theme'),
		'id' => 'widgetized_footer',
		'std' => '1',
		'type' => 'checkbox');
		
		
	$options['sidebar_layout'] = array(
		'name' => "Sidebar Location",
		'desc' => "Select if you want a right side or left side sidebar.",
		'id' => "sidebar_layout",
		'std' => "right",
		'type' => "images",
		'options' => array(
			'right' => $imagepath . '2cr.png',
			'left' => $imagepath . '2cl.png')
	);
	
		
	$options['lightbox_theme'] = array(
		'name' => __('PrettyPhoto Theme', 'options_framework_theme'),
		'desc' => __('Choose your PrettyPhoto theme.', 'options_framework_theme'),
		'id' => 'lightbox_theme',
		'std' => 'default',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $lightbox_themes );
		
		
	$options['slider_animation'] = array(
		'name' => __('Slider Animation', 'options_framework_theme'),
		'desc' => __('Choose your slider animation.', 'options_framework_theme'),
		'id' => 'slider_animation',
		'std' => 'fade',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $slider_animation);
		
	$options['slider_slideshow'] = array(
		'name' => __('SliderShow?', 'options_framework_theme'),
		'desc' => __('Check box to animate slider automatically.', 'options_framework_theme'),
		'id' => 'slider_slideshow',
		'std' => '1',
		'type' => 'checkbox');
		
	
	//HOMEPAGE
	
	$options[] = array(
		'name' => __('Homepage', 'options_framework_theme'),
		'type' => 'heading');

	$options['home_tagline'] = array(
		'name' => __('Homepage Tagline', 'options_framework_theme','wpex'),
		'desc' => __('Enter your homepage tagline content. Leave blank to show nothing.', 'options_framework_theme','wpex'),
		'id' => 'home_tagline',
		'std' => __('Homepage Tagline Sample','wpex'),
		'type' => 'textarea');
		
	$options['home_highlights_title'] = array(
		'name' => __('Homepage Highlights Title', 'options_framework_theme','wpex'),
		'desc' => __('Enter your homepage highlights title.', 'options_framework_theme','wpex'),
		'id' => 'home_highlights_title',
		'std' => __('What We Do','wpex'),
		'class' => 'mini',
		'type' => 'text');
		
	$options['home_portfolio'] = array(
		'name' => __('Show Recent Work?', 'options_framework_theme'),
		'desc' => __('Check box to show recent work on the homepage.', 'options_framework_theme'),
		'id' => 'home_portfolio',
		'std' => '1',
		'type' => 'checkbox');

	$options['home_portfolio_title'] = array(
		'name' => __('Recent Work Title', 'options_framework_theme'),
		'desc' => __('Enter your custom title for the recent work section', 'options_framework_theme'),
		'id' => 'home_portfolio_title',
		'std' => __('Recent Work','wpex'),
		'class' => 'mini',
		'type' => 'text');
		
	$options['home_portfolio_count'] = array(
		'name' => __('Home Many Portfolio Posts?', 'options_framework_theme'),
		'desc' => __('Enter an integer for how many portfolio posts to show on the homepage.', 'options_framework_theme'),
		'id' => 'home_portfolio_count',
		'std' => __('4','wpex'),
		'class' => 'mini',
		'type' => 'text');
		
	$options['home_blog'] = array(
		'name' => __('Show Recent Blog Posts?', 'options_framework_theme'),
		'desc' => __('Check box to show recent blog posts on the homepage.', 'options_framework_theme'),
		'id' => 'home_blog',
		'std' => '1',
		'type' => 'checkbox');
		
	$options['home_blog_title'] = array(
		'name' => __('Recent Blog Posts Title', 'options_framework_theme'),
		'desc' => __('Enter your custom title for the recent blog posts section', 'options_framework_theme'),
		'id' => 'home_blog_title',
		'std' => __('Recent News','wpex'),
		'class' => 'mini',
		'type' => 'text');
		
	$options['home_blog_count'] = array(
		'name' => __('Home Many Blog Posts?', 'options_framework_theme'),
		'desc' => __('Enter an integer for how many blog posts to show on the homepage.', 'options_framework_theme'),
		'id' => 'home_blog_count',
		'std' => __('4','wpex'),
		'class' => 'mini',
		'type' => 'text');
	
	
	//PORTFOLIO
	
	$options[] = array(
		'name' => __('Portfolio', 'options_framework_theme'),
		'type' => 'heading');
		
	$options['portfolio_pagination'] = array(
		'name' => __('Portfolio Posts Per Page?', 'options_framework_theme'),
		'desc' => __('Enter an integer for how posts per page to show on the portfolio page and taxonomy archives.', 'options_framework_theme'),
		'id' => 'portfolio_pagination',
		'std' => __('12','wpex'),
		'class' => 'mini',
		'type' => 'text');
		
		
	//BLOG
	
	$options[] = array(
		'name' => __('Blog', 'options_framework_theme'),
		'type' => 'heading');
		
	$options['blog_single_thumbnail'] = array(
		'name' => __('Featured Images On Single Posts?', 'options_framework_theme'),
		'desc' => __('Check box to enable featured images on single blog posts.', 'options_framework_theme'),
		'id' => 'blog_single_thumbnail',
		'std' => '1',
		'type' => 'checkbox');
		
	$options['blog_bio'] = array(
		'name' => __('Author Bio?', 'options_framework_theme'),
		'desc' => __('Check box to enable featured images on single blog posts.', 'options_framework_theme'),
		'id' => 'blog_bio',
		'std' => '1',
		'type' => 'checkbox');
			
	$options['blog_tags'] = array(
		'name' => __('Tags?', 'options_framework_theme'),
		'desc' => __('Check box to enable featured images on single blog posts.', 'options_framework_theme'),
		'id' => 'blog_tags',
		'std' => '1',
		'type' => 'checkbox');
		
	$options['blog_related'] = array(
		'name' => __('Related Posts?', 'options_framework_theme'),
		'desc' => __('Check box to enable featured images on single blog posts.', 'options_framework_theme'),
		'id' => 'blog_related',
		'std' => '1',
		'type' => 'checkbox');
	
		
	//SOCIAL

	$options[] = array(
		'name' => __('Social', 'options_framework_theme'),
		'type' => 'heading');	
		
		
	$options['social'] = array(
		'name' => __('Social?', 'options_framework_theme'),
		'desc' => __('Check box to enable the social section in the main menu.', 'options_framework_theme'),
		'id' => 'social',
		'std' => '1',
		'type' => 'checkbox');
		
	if(function_exists('wpex_get_social')) {	
	$social_links = wpex_get_social();
		foreach($social_links as $social_link) {
			$options[] = array( "name" => ucfirst($social_link),
								'desc' => ' '. __('Enter your ','wpex') . $social_link . __(' url','wpex') .' <br />'. __('Include http:// at the front of the url.', 'wpex'),
								'id' => $social_link,
								'std' => '',
								'type' => 'text');
		}
	}
	
	
	//CSS
	$options[] = array(
		'name' => __('CSS', 'options_framework_theme'),
		'type' => 'heading');
		
	$options['custom_css'] = array(
		'name' => __('Custom CSS', 'options_framework_theme','wpex'),
		'desc' => __('Use this area to add custom css to your theme\'s header for making small customizations', 'options_framework_theme','wpex'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
		
		
	//ABOUT/SUPPORT
	
	$options[] = array(
		'name' => __('About/Support', 'options_framework_theme'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Theme Credits', 'options_framework_theme'),
		'desc' => 'This theme was created by AJ Clarke from <a href="http://www.wpexplorer.com">WPExplorer.com</a>.<br /> Please read the readme.txt file included for a list of all the wonderful resources used in the developement of this theme.',
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Support? Donations?', 'options_framework_theme'),
		'desc' => 'If you love this free themes and wish to give back, you should consider purchasing one of my <a href="http://themeforest.net/user/WPExplorer?ref=wpexplorer">Premium Themes</a>. This way you can support me and get another great theme!<br /><br /> Thank you very much!',
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Newsletter', 'options_framework_theme'),
		'desc' => 'To hear about new WordPress theme releases, tutorials, guides...and other great content from WPExplorer.com, you can <a href="http://wpexplorer.com/newsletter">subscribe to our Newsletter</a>',
		'type' => 'info');


	return $options;
}


/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php } ?>