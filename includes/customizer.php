<?php

new FreeMarketLogoCustomizer();

class FreeMarketLogoCustomizer {
	function __construct(){
		add_action('customize_register', array(&$this, 'customize_register'));
	}

	public function customize_register($wp_customize){
		$wp_customize->add_section('freemarket-logo', array(
			'title'          => __('Logo Image', 'freemarket'),
			'priority'       => 15,
		));
		$wp_customize->add_setting('freemarket-logo', array(
			'default'        => '',
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'logo_Image',
			array(
				'label'     => __('Image', 'freemarket'),
				'section'   => 'freemarket-logo',
				'settings'  => 'freemarket-logo',
			)
		));
	}
}

function freemarket_logo() {
	if (get_option('freemarket-logo')) {
		$image = '<img id="site-logo" src="%s" alt="%s" style="max-width:100%%; height:auto;">';
		printf(
			$image,
			get_option('freemarket-logo'),
			get_bloginfo('name')
		);
	} else { }
}

add_action( 'customize_register', 'freemarket_customize_register' );
function freemarket_customize_register($wp_customize){
	$wp_customize->add_setting( 'freemarket_variation', array(
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'variation', array(
		'label'      => __( 'Variation', 'freemarket' ),
		'section'    => 'colors',
		'settings'   => 'freemarket_variation',
		'type'     => 'select',
		'choices'     => array(
			'light' => 'Light',
			'dark'  => 'Dark',
		),
	));
}