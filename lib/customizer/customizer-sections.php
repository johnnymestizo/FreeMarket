<?php

add_action( 'customize_register', 'freemarket_customize_register_sections' );
function freemarket_customize_register_sections($wp_customize){
  
  // remove default sections
  $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
  
  $sections = array();
  $sections[] = array( 'slug'=>'bc_header',           'title' => __('Header & Logo', 'freemarket'),  'priority' => 1);
  $sections[] = array( 'slug'=>'bc_layout',           'title' => __('Layout', 'freemarket'),         'priority' => 2);
  $sections[] = array( 'slug'=>'background_image',    'title' => __('General Colors', 'freemarket'), 'priority' => 4);
  $sections[] = array( 'slug'=>'bc_footer',           'title' => __('Footer', 'freemarket'),         'priority' => 5);
  $sections[] = array( 'slug'=>'bc_typography',       'title' => __('Typography', 'freemarket'),     'priority' => 6);
  $sections[] = array( 'slug'=>'shoestrap_advanced',  'title' => __( 'Custom CSS', 'shoestrap' ),    'priority' => 9);

  foreach($sections as $section){
    $wp_customize->add_section( $section['slug'], array( 'title' => $section['title'], 'priority' => $section['priority']));
  }

  if ( $wp_customize->is_preview() && ! is_admin() )
    add_action( 'wp_footer', 'freemarket_customize_preview', 21);
}
