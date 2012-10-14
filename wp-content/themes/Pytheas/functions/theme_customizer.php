<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file adds custom sections and controlls for the WP theme_customizer()
 * WordPress 3.4 Required
 */


add_action( 'customize_register', 'wpex_customize_register' );
function wpex_customize_register($wp_customize) {
	
	
	//extend the theme_customizer <= Textarea
	class wpex_Customize_Textarea_Control extends WP_Customize_Control {
		
	//type of customize control being rendered. @since 1.4.0
	public $type = 'textarea';

	//displays the textarea on the customize screen.
	public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	 
	 
	//get theme options and load them into $options for easier referance
    $options = optionsframework_options();
	

    /* Add Logo Section To Customizer Tabs */
    $wp_customize->add_section( 'options_wpex_themes_logo', array(
        'title' => __( 'Logo', 'options_wpex_themes' ),
        'priority' => 35
    ) );

		$wp_customize->add_setting( 'options_wpex_themes[custom_logo]', array(
			'default' => $options['custom_logo']['std'],
			'type' => 'option'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'options_wpex_themes_custom_logo', array(
			'label' => $options['custom_logo']['name'],
			'section' => 'options_wpex_themes_logo',
			'settings' => 'options_wpex_themes[custom_logo]',
		) ) );

		
		
	//add disable homepage header option to header tab
	$wp_customize->add_setting( 'options_wpex_themes[header_front_page_exclude]', array(
			'default' => $options['header_front_page_exclude']['std'],
			'type' => 'option'
	) );
	$wp_customize->add_control( 'options_wpex_header_front_page_exclude', array(
		'label' => $options['header_front_page_exclude']['name'],
		'section' => 'header_image',
		'settings' => 'options_wpex_themes[header_front_page_exclude]',
		'type' => 'checkbox',
	) );



	/* Add Custom CSS Section To Customizer Tabs */
    $wp_customize->add_section( 'options_wpex_themes_css', array(
        'title' => __( 'Custom CSS', 'options_wpex_themes' ),
        'priority' => 200
    ) );
	
		$wp_customize->add_setting( 'options_wpex_themes[custom_css]', array(
			'default' => $options['custom_css']['std'],
			'type' => 'option'
		) );
		$wp_customize->add_control( new wpex_Customize_Textarea_Control( $wp_customize, 'options_wpex_themes_custom_css', array(
			'label' => $options['custom_css']['name'],
			'section' => 'options_wpex_themes_css',
			'settings' => 'options_wpex_themes[custom_css]',
			'type' => 'textarea'
		) ) );

}
?>