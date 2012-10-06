<?php

add_action( 'customize_register', 'freemarket_customize_register_settings' );
function freemarket_customize_register_settings($wp_customize){

  $settings = array();
  $settings[] = array( 'slug'=>'freemarket_variation',          'default' => 'light');
  $settings[] = array( 'slug'=>'freemarket_navbar_light_dark',  'default' => 'light');
  $settings[] = array( 'slug'=>'freemarket_sidebar',            'default' => 'hide');
  $settings[] = array( 'slug'=>'link_text_color',                       'default' => '#0088cc');
  $settings[] = array( 'slug'=>'freemarket-logo',                    'default' => '');
  $settings[] = array( 'slug'=>'bc_header_backgroundcolor',             'default' => '#ff9900');
  $settings[] = array( 'slug'=>'bc_header_textcolor',                   'default' => '#ffffff');
  $settings[] = array( 'slug'=>'bc_footer_color',                       'default' => '#ffffff');
  
  if ( class_exists( 'MarketPress' ) ) {
    $settings[] = array( 'slug'=>'bc_feat_home_slider',                 'default' => 'show');
    $settings[] = array( 'slug'=>'bc_buttons_color',                    'default' => '#0088cc');
  }

  foreach($settings as $setting){
    $wp_customize->add_setting( $setting['slug'], array( 'default' => $setting['default'], 'type' => 'theme_mod', 'capability' => 'edit_theme_options' ));
  }
  if ( $wp_customize->is_preview() && ! is_admin() )
    add_action( 'wp_footer', 'freemarket_customize_preview', 21);
}