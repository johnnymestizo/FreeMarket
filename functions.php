<?php
/**
 * Bootstrap Commerce functions
 */

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/lib/utils.php');                       // Utility functions
require_once locate_template('/lib/config.php');                      // Configuration and constants
require_once locate_template('/lib/primary-menu.php');                // Primary menu
require_once locate_template('/lib/cleanup.php');                     // Cleanup
require_once locate_template('/lib/widgets.php');                     // Sidebars and widgets
require_once locate_template('/lib/scripts.php');                     // Scripts and stylesheets
require_once locate_template('/lib/less.php');                        // Less CSS compiling
require_once locate_template('/lib/customizer/customizer.php');       // Customizer Functions
require_once locate_template('/lib/login.php');                       // Login screen customizations

if ( class_exists( 'MarketPress' ) ) {
  require_once locate_template('/lib/marketpress/marketpress.php');   // MarketPress functions
}

function freemarket_setup() {

  // Make theme available for translation
  load_theme_textdomain('freemarket', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'freemarket-main-menu' => __('FreeMarket Main Navigation', 'freemarket'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)
  add_image_size('bc-product-thumb', 369, 246, true); // 300px wide (and unlimited height)
  
  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('assets/css/editor-style.css');

}

add_action('after_setup_theme', 'freemarket_setup');
