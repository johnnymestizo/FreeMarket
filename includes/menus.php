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

/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Freemarket_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class Freemarket_Nav_Walker extends Walker_Nav_Menu {
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"dropdown-menu\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
      $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
    }
    elseif (in_array('divider-vertical', $item->classes)) {
      $item_html = '<li class="divider-vertical">';
    }  
    elseif (in_array('divider', $item->classes)) {
      $item_html = '<li class="divider">';
    }
    elseif (in_array('nav-header', $item->classes)) {
      $item_html = '<li class="nav-header">' . $item->title;
    }

    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = !empty($children_elements[$element->ID]);

    if ($element->is_dropdown) {
      if ($depth === 0) {
        $element->classes[] = 'dropdown';
      } elseif ($depth === 1) {
        $element->classes[] = 'dropdown-submenu';
      }
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function freemarket_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-' . $slug;

  $classes = array_unique($classes);

  return array_filter($classes, 'is_element_empty');
}

add_filter('nav_menu_css_class', 'freemarket_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use Freemarket_Nav_Walker() by default
 */
function freemarket_nav_menu_args($args = '') {
  $freemarket_nav_menu_args['container'] = false;

  if (!$args['items_wrap']) {
    $freemarket_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }

  $freemarket_nav_menu_args['depth'] = 3;
  
  if (!$args['walker']) {
    $freemarket_nav_menu_args['walker'] = new Freemarket_Nav_Walker();
  }

  return array_merge($args, $freemarket_nav_menu_args);
}

add_filter('wp_nav_menu_args', 'freemarket_nav_menu_args');