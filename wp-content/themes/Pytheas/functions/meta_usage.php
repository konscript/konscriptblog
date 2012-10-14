<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file registers the theme's meta boxes
 */
 
$awesome_icons = wpex_get_awesome_icons();

$prefix = 'wpex_';
$wpex_meta_boxes = array();


// meta box ===> HP Highlights
$wpex_meta_boxes[] = array(
	'id' => 'wpex_highlights_meta',
	'title' => __('HP Highlights Options','wpex'),
	'pages' => array('hp_highlights'),

	'fields' => array(
		array(
            'name' => __('URL','wpex'),
            'desc' => __('Enter a URL to link the title of this highlight to. Optional.','wpex'),
            'id' => $prefix . 'hp_highlights_url',
            'type' => 'text',
            'std' => ''
        ),
        array(
		    'name' => __('Icon', 'wpex'),
		    'id' => $prefix . 'hp_highlights_icon',
		    'type' => 'select',
		    'options' => $awesome_icons,
		    'desc' => __('Select your highlight icon option.<br/ > See <a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome</a> for previews.', 'wpex')
		),
	)
);

// meta box ===> Slider Options
$wpex_meta_boxes[] = array(
	'id' => 'wpex_slider_meta',
	'title' => __('Slider Options','wpex'),
	'pages' => array('slides'),
	'fields' => array(
		array(
            'name' => __('URL', 'wpex'),
            'id' => $prefix . 'slide_url',
			'desc' => __('If you wish to link this slide to another page enter your full URL here.', 'wpex'),
            'type' => 'text',
        ),
		array(
            'name' => __('Caption Title', 'wpex'),
            'id' => $prefix . 'slide_caption_title',
			'desc' => __('Enter your slide caption title here.', 'wpex'),
            'type' => 'text',
        ),
		array(
            'name' => __('Caption Description', 'wpex'),
            'id' => $prefix . 'slide_caption_description',
			'desc' => __('Enter a caption description', 'wpex'),
            'type' => 'textarea',
        ),
	)
);

foreach ($wpex_meta_boxes as $meta_box) {
	new wpex_meta_box($meta_box);
}
?>