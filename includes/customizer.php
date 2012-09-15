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
	
	$wp_customize->add_setting( 'freemarket_buttons_color', array(
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	));
	$wp_customize->add_control( 'buttons_color', array(
		'label'      => __( 'Buttons Color', 'freemarket' ),
		'section'    => 'colors',
		'settings'   => 'freemarket_buttons_color',
		'type'     => 'select',
		'choices'     => array(
			'default' => 'White',
			'primary' => 'Blue',
			'info'    => 'Light Blue',
			'success' => 'Green',
			'warning' => 'Orange',
			'danger'  => 'Red',
			'inverse' => 'Black',
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

