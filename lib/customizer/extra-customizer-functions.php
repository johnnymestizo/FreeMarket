<?php

add_action( 'customize_register', 'freemarket_customize_register' );
function freemarket_customize_register($wp_customize){
  $wp_customize->remove_control( 'header_textcolor');
}

function freemarket_navbar_class($echo = true){
  $navbar_class = get_theme_mod( 'freemarket_navbar_light_dark' );

  if ($navbar_class == 'dark') {
    $class = 'navbar navbar-inverse';
  } else {
    $class = 'navbar';
  }

  if ($echo) { echo $class;
  } else { return $class; }
}

function freemarket_get_brightness($hex) {
  // returns brightness value from 0 to 255
  // strip off any leading #
  $hex = str_replace('#', '', $hex);
  
  $c_r = hexdec(substr($hex, 0, 2));
  $c_g = hexdec(substr($hex, 2, 2));
  $c_b = hexdec(substr($hex, 4, 2));
  
  return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}

function freemarket_customize_preview() {
  ?>
  <script type="text/javascript">
  ( function( $ ){
  } )( jQuery )
  </script>
  <?php
}