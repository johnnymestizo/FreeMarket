<?php

add_action( 'init', 'freemarket_register_navmenus' );
function freemarket_register_navmenus() {
  register_nav_menus( array(
    'freemarket-top-menu'     => __( 'FreeMarket Top Navigation', 'freemarket' ),
    'freemarket-main-menu'    => __( 'FreeMarket Main Navigation', 'freemarket' ),
    )
  );

  // Check if Top menu exists and make it if not
  if ( !is_nav_menu( 'freemarket-top-menu' )) {
    $menu_id = wp_create_nav_menu( 'freemarket-top-menu' );
    $menu = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url(),'menu-item-title' => 'Home', 'menu-item-status' => 'publish' );
    wp_update_nav_menu_item( $menu_id, 0, $menu );

    set_theme_mod( 'nav_menu_locations', array(
      'freemarket-top-menu' => $menu_id,
    ) );
  }
  // Check if Header menu exists and make it if not
  if ( !is_nav_menu( 'freemarket-main-menu' )) {
    $menu_id = wp_create_nav_menu( 'freemarket-main-menu' );
    $menu = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url(), 'menu-item-title' => 'Home', 'menu-item-status' => 'publish' );
    wp_update_nav_menu_item( $menu_id, 0, $menu );

    set_theme_mod( 'nav_menu_locations', array(
      'freemarket-main-menu' => $menu_id,
    ) );
  }
}