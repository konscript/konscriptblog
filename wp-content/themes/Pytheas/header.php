<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 */
?>
<!DOCTYPE html>

<!-- WordPress Theme by AJ Clarke (http://www.wpexplorer.com) -->
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php
//add viewport meta if responsive enabled
if(of_get_option('responsive')) { ?>
<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<?php } ?>

<!-- Title Tag
================================================== -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>

<?php
//set favicon if defined in admin
if(of_get_option('custom_favicon')) { ?>
<!-- Favicon
================================================== -->
<link rel="icon" type="image/png" href="<?php echo of_get_option('custom_favicon'); ?>" />
<?php } ?>


<!-- Browser dependent stylesheets
================================================== -->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="screen" />
<![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/awesome_font_ie7.css.css" media="screen" />
/>
<![endif]-->


<!-- Load HTML5 dependancies for IE
================================================== -->
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/>
<![endif]-->

<!-- WP Head
================================================== -->
<?php
//WordPress head hook <== DO NOT DELETE ME
wp_head(); ?>

</head><!-- /end head -->

<!-- Begin Body
================================================== -->
<body <?php body_class('body'); ?>>

<div id="wrap" class="outerbox clearfix">

    <header id="header" class="clearfix">
            <div id="logo">
                <?php
				//show custom image logo if defined in the admin
                if(of_get_option('custom_logo')) { ?>
                    <a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo of_get_option('custom_logo'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
                <?php }
				//no custom img logo - show text logo
					else { ?>
                     <h2><a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
                <?php } //end logo check ?>
                <?php
				//show site description 
				$site_description = get_bloginfo('description');
				if($site_description) echo '<p id="site-description">'.$site_description.'</p>';
				?>
            </div><!-- /logo -->

			<?php
			//show search if not disabled
			if(of_get_option('header_search')) { ?>
                <div id="top-search">
                    <?php get_search_form(); ?>
                </div><!-- /top-search -->
            <?php } //search disabled ?>
    </header><!-- /header -->
    
	<?php
    //show header image only if defined
    if( get_header_image() !='' ) {
		
		//exclude header image from homepage if option is selected in the admin
		$show_header_image = (of_get_option('header_front_page_exclude') == '1' && is_front_page()) ? 'no' : 'yes';
		if($show_header_image == 'yes' ) {
		?>
    		<img src="<?php header_image(); ?>" alt="<?php get_bloginfo( 'name' ); ?>" id="header-image" />
    <?php
		} //image is excluded
    } //no header image defined
	?>

    <nav id="navigation" class="clearfix">
        <?php
			//output main navigation menu
			wp_nav_menu( array(
				'theme_location' => 'main_menu',
				'sort_column' => 'menu_order',
				'menu_class' => 'sf-menu',
				'fallback_cb' => false
			)); ?>
         <ul id="social">
			<?php
            //show social icons if not disabled
            if(of_get_option('social')) {
                //get social links from array
                $social_links = wpex_get_social();
                //social loop
                foreach($social_links as $social_link) {
                    if(of_get_option($social_link)) {
                        echo '<li><a href="'. of_get_option($social_link) .'" title="'. $social_link .'" target="_blank"><img src="'. get_template_directory_uri() .'/images/social/'.$social_link.'.png" alt="'. $social_link .'" /></a></li>';
                    } //option empty
                } //end foreach
            } //social disabled?>
		</ul><!-- /social -->
    </nav><!-- /navigation -->
    
    <div id="main-content" class="clearfix fitvids-container">
    
    
    <?php
	//show homepage slider
	if(is_front_page()) require_once( get_template_directory() .'/includes/home-slider.php');
	?>

	<?php
	//run code only on pages
	if(is_page() && !is_attachment()) {
		
		//show large featured images on pages
		$full_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
		if($full_img) { echo '<div id="page-featured-img"><img src="'. $full_img[0] .'" alt="'. get_the_title() .'" /></div>'; }
		
	} ?>
	
    <?php
	//Yoast SEO breadcrumbs support
	if( is_front_page()|| is_404() ) { } else {
    	if( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
	} ?>