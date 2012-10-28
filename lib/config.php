<?php
/**
 * Freemarket configuration and constants
 */
add_theme_support('bootstrap-top-navbar');  // Enable Bootstrap's fixed navbar

// Define which pages shouldn't have the sidebar
function freemarket_sidebar() {
  $sidebar_customizer       = get_theme_mod( 'freemarket_sidebar' );
  $sidebar_customizer_front = get_theme_mod( 'bc_sidebar_front' );
  
  if ($sidebar_customizer == 'hide'){
    return false;
  } else {
    if (is_404() || is_page_template('page-custom.php')) {
      return false;
    } else {
      if (is_front_page()){
        if ($sidebar_customizer_front == 'hide'){
          return false;
        } else {
          return true;
        }
      } else {
        return true;
      }
    }
  }
}

// #main CSS classes
function freemarket_main_class() {
  $sidebar_customizer = get_theme_mod( 'freemarket_sidebar' );
  
  if ($sidebar_customizer != 'hide'){
    if (freemarket_sidebar()) {
      if ($sidebar_customizer == 'left') {
        echo 'span8 pull-right';
      } else {
        echo 'span8';
      }
    } else {
      echo 'span12';
    }
  } else {
    echo 'span12';
  }
}

// #sidebar CSS classes
function freemarket_sidebar_class() {
  echo 'span4';
}

$get_theme_name = explode('/themes/', get_template_directory());
define('GOOGLE_ANALYTICS_ID',       ''); // UA-XXXXX-Y
define('POST_EXCERPT_LENGTH',       40);
define('WP_BASE',                   wp_base_dir());
define('THEME_NAME',                next($get_theme_name));
define('RELATIVE_PLUGIN_PATH',      str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH',     str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH',                RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);

// Set the content width based on the theme's design and stylesheet
if (!isset($content_width)) { $content_width = 940; }