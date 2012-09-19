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

function freemarket_customizations(){
	$color     = get_theme_mod( 'background_color' );
	$variation = get_theme_mod('freemarket_variation');
	$btn_class = get_theme_mod( 'freemarket_buttons_color' );

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
		<?php if ($btn_class == 'primary'){ ?>
			#mp_product_list a.mp_link_buynow,
			.mp_button_addcart,
			.mp_button_buynow,
			.single .mp_button_addcart,
			.single .mp_button_buynow {
				color:#fff;
				text-shadow:0 -1px 0 rgba(0,0,0,0.25);
				background-color:#006dcc;
				background-image:-moz-linear-gradient(top,#08c,#0044cc);
				background-image:-webkit-gradient(linear,0 0,0 100%,from(#08c),to(#0044cc));
				background-image:-webkit-linear-gradient(top,#08c,#0044cc);
				background-image:-o-linear-gradient(top,#08c,#0044cc);
				background-image:linear-gradient(to bottom,#08c,#0044cc);
				background-repeat:repeat-x;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000088cc', endColorstr='#000043cc', GradientType=0);
				border-color:#0044cc #0044cc #002a80;
				border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
				*background-color:#0044cc;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
			}
			#mp_product_list a.mp_link_buynow:hover,
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			#mp_product_list a.mp_link_buynow.disabled,
			#mp_product_list a.mp_link_buynow[disabled],
			.mp_button_buynow:hover,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.mp_button_buynow.disabled,
			.mp_button_buynow[disabled],
			.mp_button_addcart:hover,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_addcart.disabled,
			.mp_button_addcart[disabled],
			.single .mp_button_buynow:hover,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active,
			.single .mp_button_buynow.disabled,
			.single .mp_button_buynow[disabled],
			.single .mp_button_addcart:hover,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_addcart.disabled,
			.single .mp_button_addcart[disabled] {
				color:#fff;
				background-color:#0044cc;
				*background-color:#003bb3;
			}
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active {
				background-color:#003399 \9;
			}
		<?php } elseif ($btn_class == 'info'){ ?>
			#mp_product_list a.mp_link_buynow,
			.mp_button_addcart,
			.mp_button_buynow,
			.single .mp_button_addcart,
			.single .mp_button_buynow {
				color:#fff;
				text-shadow:0 -1px 0 rgba(0,0,0,0.25);
				background-color:#49afcd;
				background-image:-moz-linear-gradient(top,#5bc0de,#2f96b4);
				background-image:-webkit-gradient(linear,0 0,0 100%,from(#5bc0de),to(#2f96b4));
				background-image:-webkit-linear-gradient(top,#5bc0de,#2f96b4);
				background-image:-o-linear-gradient(top,#5bc0de,#2f96b4);
				background-image:linear-gradient(to bottom,#5bc0de,#2f96b4);
				background-repeat:repeat-x;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#005bc0de', endColorstr='#002f96b4', GradientType=0);
				border-color:#2f96b4 #2f96b4 #1f6377;
				border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
				*background-color:#2f96b4;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
			}
			#mp_product_list a.mp_link_buynow:hover,
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			#mp_product_list a.mp_link_buynow.disabled,
			#mp_product_list a.mp_link_buynow[disabled],
			.mp_button_buynow:hover,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.mp_button_buynow.disabled,
			.mp_button_buynow[disabled],
			.mp_button_addcart:hover,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_addcart.disabled,
			.mp_button_addcart[disabled],
			.single .mp_button_buynow:hover,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active,
			.single .mp_button_buynow.disabled,
			.single .mp_button_buynow[disabled],
			.single .mp_button_addcart:hover,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_addcart.disabled,
			.single .mp_button_addcart[disabled] {
				color:#fff;
				background-color:#2f96b4;
				*background-color:#2a85a0;
			}
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active {
				background-color:#24748c \9; 
			}
		<?php } elseif ($btn_class == 'success'){ ?>
			#mp_product_list a.mp_link_buynow,
			.mp_button_addcart,
			.mp_button_buynow,
			.single .mp_button_addcart,
			.single .mp_button_buynow {
				color:#fff;
				text-shadow:0 -1px 0 rgba(0,0,0,0.25);
				background-color:#5bb75b;
				background-image:-moz-linear-gradient(top,#62c462,#51a351);
				background-image:-webkit-gradient(linear,0 0,0 100%,from(#62c462),to(#51a351));
				background-image:-webkit-linear-gradient(top,#62c462,#51a351);
				background-image:-o-linear-gradient(top,#62c462,#51a351);
				background-image:linear-gradient(to bottom,#62c462,#51a351);
				background-repeat:repeat-x;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0062c462', endColorstr='#0051a351', GradientType=0);
				border-color:#51a351 #51a351 #387038;
				border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
				*background-color:#51a351;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
			}
			#mp_product_list a.mp_link_buynow:hover,
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			#mp_product_list a.mp_link_buynow.disabled,
			#mp_product_list a.mp_link_buynow[disabled],
			.mp_button_buynow:hover,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.mp_button_buynow.disabled,
			.mp_button_buynow[disabled],
			.mp_button_addcart:hover,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_addcart.disabled,
			.mp_button_addcart[disabled],
			.single .mp_button_buynow:hover,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active,
			.single .mp_button_buynow.disabled,
			.single .mp_button_buynow[disabled],
			.single .mp_button_addcart:hover,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_addcart.disabled,
			.single .mp_button_addcart[disabled] {
				color:#fff;
				background-color:#51a351;
				*background-color:#499249;
			}
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active {
				background-color:#408140 \9; 
			}
		<?php } elseif ($btn_class =='warning') { ?>
			#mp_product_list a.mp_link_buynow,
			.mp_button_addcart,
			.mp_button_buynow,
			.single .mp_button_addcart,
			.single .mp_button_buynow {
				color:#fff;
				text-shadow:0 -1px 0 rgba(0,0,0,0.25);
				background-color:#faa732;
				background-image:-moz-linear-gradient(top,#fbb450,#f89406);
				background-image:-webkit-gradient(linear,0 0,0 100%,from(#fbb450),to(#f89406));
				background-image:-webkit-linear-gradient(top,#fbb450,#f89406);
				background-image:-o-linear-gradient(top,#fbb450,#f89406);
				background-image:linear-gradient(to bottom,#fbb450,#f89406);
				background-repeat:repeat-x;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00fab44f', endColorstr='#00f89406', GradientType=0);
				border-color:#f89406 #f89406 #ad6704;
				border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
				*background-color:#f89406;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
			}
			#mp_product_list a.mp_link_buynow:hover,
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			#mp_product_list a.mp_link_buynow.disabled,
			#mp_product_list a.mp_link_buynow[disabled],
			.mp_button_buynow:hover,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.mp_button_buynow.disabled,
			.mp_button_buynow[disabled],
			.mp_button_addcart:hover,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_addcart.disabled,
			.mp_button_addcart[disabled],
			.single .mp_button_buynow:hover,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active,
			.single .mp_button_buynow.disabled,
			.single .mp_button_buynow[disabled],
			.single .mp_button_addcart:hover,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_addcart.disabled,
			.single .mp_button_addcart[disabled] {
				color:#fff;
				background-color:#f89406;
				*background-color:#df8505;
			}
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active {
				background-color:#c67605 \9; 
			}
		<?php } elseif ($btn_class == 'danger'){ ?>
			#mp_product_list a.mp_link_buynow,
			.mp_button_addcart,
			.mp_button_buynow,
			.single .mp_button_addcart,
			.single .mp_button_buynow {
				color:#fff;
				text-shadow:0 -1px 0 rgba(0,0,0,0.25);
				background-color:#da4f49;
				background-image:-moz-linear-gradient(top,#ee5f5b,#bd362f);
				background-image:-webkit-gradient(linear,0 0,0 100%,from(#ee5f5b),to(#bd362f));
				background-image:-webkit-linear-gradient(top,#ee5f5b,#bd362f);
				background-image:-o-linear-gradient(top,#ee5f5b,#bd362f);
				background-image:linear-gradient(to bottom,#ee5f5b,#bd362f);
				background-repeat:repeat-x;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00ee5f5b', endColorstr='#00bd362f', GradientType=0);
				border-color:#bd362f #bd362f #802420;
				border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
				*background-color:#bd362f;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
			}
			#mp_product_list a.mp_link_buynow:hover,
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			#mp_product_list a.mp_link_buynow.disabled,
			#mp_product_list a.mp_link_buynow[disabled],
			.mp_button_buynow:hover,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.mp_button_buynow.disabled,
			.mp_button_buynow[disabled],
			.mp_button_addcart:hover,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_addcart.disabled,
			.mp_button_addcart[disabled],
			.single .mp_button_buynow:hover,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active,
			.single .mp_button_buynow.disabled,
			.single .mp_button_buynow[disabled],
			.single .mp_button_addcart:hover,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_addcart.disabled,
			.single .mp_button_addcart[disabled] {
				color:#fff;
				background-color:#bd362f;
				*background-color:#a9302a;
			}
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active {
				background-color:#942a25 \9; 
			}
		<?php } elseif ($btn_class == 'inverse') { ?>
			#mp_product_list a.mp_link_buynow,
			.mp_button_addcart,
			.mp_button_buynow,
			.single .mp_button_addcart,
			.single .mp_button_buynow {
				color:#fff;
				text-shadow:0 -1px 0 rgba(0,0,0,0.25);
				background-color:#363636;
				background-image:-moz-linear-gradient(top,#444,#222);
				background-image:-webkit-gradient(linear,0 0,0 100%,from(#444),to(#222));
				background-image:-webkit-linear-gradient(top,#444,#222);
				background-image:-o-linear-gradient(top,#444,#222);
				background-image:linear-gradient(to bottom,#444,#222);
				background-repeat:repeat-x;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00444444', endColorstr='#00222222', GradientType=0);
				border-color:#222 #222 #000000;
				border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
				*background-color:#222;
				filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
			}
			#mp_product_list a.mp_link_buynow:hover,
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			#mp_product_list a.mp_link_buynow.disabled,
			#mp_product_list a.mp_link_buynow[disabled],
			.mp_button_buynow:hover,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.mp_button_buynow.disabled,
			.mp_button_buynow[disabled],
			.mp_button_addcart:hover,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_addcart.disabled,
			.mp_button_addcart[disabled],
			.single .mp_button_buynow:hover,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active,
			.single .mp_button_buynow.disabled,
			.single .mp_button_buynow[disabled],
			.single .mp_button_addcart:hover,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_addcart.disabled,
			.single .mp_button_addcart[disabled] {
				color:#fff;
				background-color:#222;
				*background-color:#151515;
			}
			#mp_product_list a.mp_link_buynow:active,
			#mp_product_list a.mp_link_buynow.active,
			.mp_button_addcart:active,
			.mp_button_addcart.active,
			.mp_button_buynow:active,
			.mp_button_buynow.active,
			.single .mp_button_addcart:active,
			.single .mp_button_addcart.active,
			.single .mp_button_buynow:active,
			.single .mp_button_buynow.active {
				background-color:#090909 \9; 
			}
		<?php } else { } ?>
	</style>
	<?php
}
