<?php

/*
 * This class creates a custom textarea control to be used in the "advanced" settings of the theme.
 * This will allow users to add their custom css & sripts right from the customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
  class Freemarket_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
    
    public function render_content() { ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
      </label>
    <?php }
  }
}

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

/*
 * TYPOGRAPHY
 */
  $wp_customize->add_control( 'bc_fontfamily', array(
    'label'       => __( 'Font Family', 'freemarket' ),
    'section'     => 'bc_typography',
    'settings'    => 'bc_fontfamily',
    'type'        => 'select',
    'priority'    => 2,
    'choices'     => array(
      'arial'     => __('Arial, Helvetica, sans-serif', 'freemarket'),
      'verdana'   => __('Verdana, Geneva, sans-serif', 'freemarket'),
      'georgia'   => __('Georgia, serif', 'freemarket'),
      'times'     => __('"Times New Roman", Times, serif', 'freemarket'),
      'tahoma'    => __('Tahoma, Geneva, sans-serif', 'freemarket'),
    ),
  ));
  
/*
 * ADVANCED SECTION
 */
 
  // Header scripts (css/js)
  $wp_customize->add_control( new Freemarket_Customize_Textarea_Control( $wp_customize, 'freemarket_advanced_head', array(
    'label'       => 'Header Scripts (CSS/JS)',
    'section'     => 'freemarket_advanced',
    'settings'    => 'freemarket_advanced_head',
    'priority'    => 1,
  )));

  // Footer scripts (css/js)
  $wp_customize->add_control( new Freemarket_Customize_Textarea_Control( $wp_customize, 'freemarket_advanced_footer', array(
    'label'       => 'Footer Scripts (CSS/JS)',
    'section'     => 'freemarket_advanced',
    'settings'    => 'freemarket_advanced_footer',
    'priority'    => 2,
  )));

 

  if ( $wp_customize->is_preview() && ! is_admin() )
    add_action( 'wp_footer', 'freemarket_customize_preview', 21);
}