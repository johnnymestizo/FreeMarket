<?php
/**
 * Scripts and stylesheets
 */

function freemarket_scripts() {
  
  //Load appropriate stylesheet file, according to the plugin installed
  if ( class_exists( 'MarketPress' ) ) {
    wp_enqueue_style('freemarket_marketpress_css', get_template_directory_uri() . '/assets/css/marketpress.css', false, null);
  } else {
    wp_enqueue_style('freemarket_bootstrap_css', get_template_directory_uri() . '/assets/css/global.css', false, null);
  }

  // Load style.css from child theme
  if (is_child_theme()) {
    wp_enqueue_style('freemarket_child', get_stylesheet_uri(), false, null);
  }

  // jQuery is loaded in header.php using the same method from HTML5 Boilerplate:
  // Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '', '', '1.8.2', false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('freemarket_plugins', get_template_directory_uri() . '/assets/js/plugins.js', false, null, false);
  wp_enqueue_script('freemarket_plugins');
}

add_action('wp_enqueue_scripts', 'freemarket_scripts', 100);
