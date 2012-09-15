<?php

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/includes/util.php');            // Utilities file
require_once locate_template('/includes/config.php');          // Configuration and constants
require_once locate_template('/includes/scripts.php');         // Scripts and stylesheets
require_once locate_template('/includes/hooks.php');           // Hooks
require_once locate_template('/includes/widgets.php');         // Hooks
require_once locate_template('/includes/customizer.php');      // Theme Customizer extras
require_once locate_template('/includes/handling-less.php');   // Less Handling
if ( class_exists( 'MarketPress' ) ) {
	require_once locate_template('/includes/marketpress.php'); // Marketpress functions
}

load_theme_textdomain('freemarket');
add_theme_support( 'custom-background' );

function freemarket_setup() {

  // Make theme available for translation
  load_theme_textdomain('freemarket', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'freemarket'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('css/editor-style.css');
}

add_action('after_setup_theme', 'freemarket_setup');

// Add support for flexible headers
$header_args = array(
	'flex-height'			=> true,
	'flex-width'			=> true,
);

add_theme_support( 'custom-header', $header_args );