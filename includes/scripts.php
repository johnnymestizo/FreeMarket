<?php

function freemarket_scripts() {

  $less_mode = LESS_MODE;
  if ($less_mode == 'php'){
  	wp_enqueue_style('global', get_template_directory_uri() . '/css/styles.css', false, null);
  }
  
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '', '', '', false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  if ($less_mode == 'js'){
  	wp_register_script('freemarket_less_js', get_template_directory_uri() . '/js/vendor/less-1.3.0.min.js', false, null, false);
	wp_enqueue_script('freemarket_less_js');
  }

  wp_enqueue_script('freemarket_plugins');
  wp_enqueue_script('freemarket_main');
}

add_action('wp_enqueue_scripts', 'freemarket_scripts', 100);

//Removes script versions to enable better browser caching
function freemarket_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', 'freemarket_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'freemarket_remove_script_version', 15, 1 );