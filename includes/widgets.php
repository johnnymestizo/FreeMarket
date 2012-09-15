<?php

function freemarket_widgets_init() {
  // Register widgetized areas
  register_sidebar(array(
    'name' => __('Primary Sidebar', 'freemarket'),
    'id' => 'sidebar-primary',
    'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    'after_widget' => '</div></section>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => __('Footer', 'freemarket'),
    'id' => 'sidebar-footer',
    'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    'after_widget' => '</div></section>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}
add_action('widgets_init', 'freemarket_widgets_init');