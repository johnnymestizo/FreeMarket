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
		'type'        => 'theme_mod',
		'capability'  => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'variation', array(
		'label'       => __( 'Variation', 'freemarket' ),
		'section'     => 'colors',
		'settings'    => 'freemarket_variation',
		'type'        => 'select',
		'choices'     => array(
			'light'   => __('Light', 'freemarket'),
			'dark'    => __('Dark', 'freemarket')
		),
	));
	
	$wp_customize->add_section('freemarket-layout', array(
		'title'       => __('Layout', 'freemarket'),
		'priority'    => 16,
	));
	
	$wp_customize->add_setting( 'freemarket_sidebar', array(
		'type'        => 'theme_mod',
		'capability'  => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'variation', array(
		'label'       => __( 'Sidebar Layout', 'freemarket' ),
		'section'     => 'freemarket-layout',
		'settings'    => 'freemarket_sidebar',
		'type'        => 'select',
		'choices'     => array(
			'left'    => __('Left', 'freemarket'),
			'right'   => __('Right', 'freemarket')
		),
	));
	
	if ( class_exists( 'MarketPress' ) ) {
		$wp_customize->add_setting( 'freemarket_list_mode', array(
			'type'        => 'theme_mod',
			'capability'  => 'edit_theme_options',
		) );
	}
	
	$wp_customize->add_setting( 'freemarket_buttons_color', array(
		'type'        => 'theme_mod',
		'capability'  => 'edit_theme_options',
	));
	$wp_customize->add_control( 'buttons_color', array(
		'label'       => __( 'Buttons Color', 'freemarket' ),
		'section'     => 'colors',
		'settings'    => 'freemarket_buttons_color',
		'type'        => 'select',
		'choices'     => array(
			'default' => __('White', 'freemarket'),
			'primary' => __('Blue', 'freemarket'),
			'info'    => __('Light Blue', 'freemarket'),
			'success' => __('Green', 'freemarket'),
			'warning' => __('Orange', 'freemarket'),
			'danger'  => __('Red', 'freemarket'),
			'inverse' => __('Black', 'freemarket')
		),
	));
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'freemarket_customize_preview', 21);
}

function freemarket_customize_preview() {
	?>
	<script type="text/javascript">
	( function( $ ){
	} )( jQuery )
	</script>
	<?php
}

function freemarket_button_class($echo = true){
	$btn_class = get_theme_mod( 'freemarket_buttons_color' );

	if ($btn_class == 'primary') {$class = 'btn btn-primary';
	} elseif ($btn_class == 'info') { $class = 'btn btn-info';
	} elseif ($btn_class == 'success') { $class = 'btn btn-success';
	} elseif ($btn_class == 'warning') { $class = 'btn btn-warning';
	} elseif ($btn_class == 'danger') { $class = 'btn btn-danger';
	} elseif ($btn_class == 'inverse') { $class = 'btn btn-inverse';
	} else { $class = 'btn'; }

	if ($echo) {
		echo $class;
	} else {
		return $class;
	}
}

function freemarket_sidebar_layout_class($echo = true){
	$sidebar_class = get_theme_mod( 'freemarket_sidebar' );

	if ($sidebar_class == 'left') {$class = 'left';
	} else { $class = 'right'; }

	if ($echo) {
		echo $class;
	} else {
		return $class;
	}
}

function freemarket_list_mode_class($echo = true){
	$list_mode = get_theme_mod( 'freemarket_sidebar' );

	if ($list_mode == 'list') {$class = 'list';
	} else { $class = 'grid'; }

	if ($echo) {
		echo $class;
	} else {
		return $class;
	}
}

function freemarket_customizations(){
	$color = get_theme_mod( 'background_color' );
	$variation = get_theme_mod('freemarket_variation');

	function get_brightness($hex) {
		// returns brightness value from 0 to 255
		// strip off any leading #
		$hex = str_replace('#', '', $hex);
		$c_r = hexdec(substr($hex, 0, 2));
		$c_g = hexdec(substr($hex, 2, 2));
		$c_b = hexdec(substr($hex, 4, 2));

		return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
	} ?>

	<style>
	<?php
	if ($variation == 'dark') { ?>
		#wrap{background: #333; color: #f7f7f7;}
		a{color: #f2f2f2;}
		.subnav{background: none;}
		.sidenav > li > a:hover{color: #fff;}
		.pager a{color: #fff; background: #222; border: 0;}
		.pager a:hover{color: #f2f2f2; background: #1d1d1d;}
	<?php } else { ?>
		#wrap{background: #fff;}
	<?php } ?>
		a.btn{color: #333;}
		a.btn-primary, a.btn-info, a.btn-success, a.btn-warning, a.btn-danger, a.btn-inverse{color: #fff;}
	</style>
	<?php
}
