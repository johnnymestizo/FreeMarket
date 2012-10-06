<?php

add_action( 'customize_register', 'freemarket_customize_register_controls' );
function freemarket_customize_register_controls($wp_customize){
  
  // remove default controls to add them later on their correct position
  $wp_customize->remove_control('background_color');

/*
 * HEADER AND LOGO SECTION
 */
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'logo_Image',
    array(
      'label'     => __('Logo Image', 'freemarket'),
      'section'   => 'bc_header',
      'settings'  => 'freemarket-logo',
      'priority'  => 1
    )
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'bc_header_backgroundcolor',
    array(
      'label'     => 'Header Region Background Color',
      'section'   => 'bc_header',
      'settings'  => 'bc_header_backgroundcolor',
      'priority'  => 2
    )
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'bc_header_textcolor',
    array(
      'label'     => 'SiteName Text Color (if no logo is uploaded)',
      'section'   => 'bc_header',
      'settings'  => 'bc_header_textcolor',
      'priority'  => 3
    )
  ));
 

/*
 * LAYOUT SECTION
 */
  // Sidebar: left/Right/Hidden
  $wp_customize->add_control( 'freemarket_sidebar', array(
    'label'       => __( 'Sidebar (General)', 'freemarket' ),
    'section'     => 'bc_layout',
    'settings'    => 'freemarket_sidebar',
    'type'        => 'select',
    'priority'    => 1,
    'choices'     => array(
      'hide'      => __('Hide', 'freemarket'),
      'show'      => __('Show', 'freemarket'),
    ),
  ));
  
  
/*
 * GENERAL COLORS AND BACKGROUND SECTION
 */
  //General theme variation (light/dark)
  $wp_customize->add_control( 'variation', array(
    'label'       => __( 'Variation', 'freemarket' ),
    'section'     => 'background_image',
    'settings'    => 'freemarket_variation',
    'type'        => 'select',
    'priority'    => 1,
    'choices'     => array(
      'light'     => __('Light', 'freemarket'),
      'dark'      => __('Dark', 'freemarket'),
    ),
  ));

  // Navbar theme variation (light/dark)
  $wp_customize->add_control( 'navbar_variation', array(
    'label'       => __( 'NavBar Variation', 'freemarket' ),
    'section'     => 'background_image',
    'settings'    => 'freemarket_navbar_light_dark',
    'type'        => 'select',
    'priority'    => 2,
    'choices'     => array(
      'light'     => __('Light', 'freemarket'),
      'dark'      => __('Dark', 'freemarket'),
    ),
  ));
  
  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'link_text_color',
    array(
      'label'     => 'Links & Prices Color',
      'section'   => 'background_image',
      'settings'  => 'link_text_color',
      'priority'  => 3
    )
  ));

  if ( class_exists( 'MarketPress' ) ) {
    $wp_customize->add_control( new WP_Customize_Color_Control(
      $wp_customize,
      'bc_buttons_color',
      array(
        'label'     => 'Buttons Color',
        'section'   => 'background_image',
        'settings'  => 'bc_buttons_color',
        'priority'  => 4
      )
    ));
  }
 
  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'background_color', array(
      'label'   => __( 'Background Color', 'freemarket' ),
      'section' => 'background_image',
      'settings'  =>  'background_color',
      'priority'  =>  5
  ) ) );


/*
 * FOOTER SECTION
 */
  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'bc_footer_color',
    array(
      'label'     => 'Footer Background',
      'section'   => 'bc_footer',
      'settings'  => 'bc_footer_color',
      'priority'  => 1
    )
  ));

 

  if ( $wp_customize->is_preview() && ! is_admin() )
    add_action( 'wp_footer', 'freemarket_customize_preview', 21);
}