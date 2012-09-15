<?php

// header.php
function freemarket_head() { do_action('freemarket_head'); }
function freemarket_wrap_before() { do_action('freemarket_wrap_before'); }
function freemarket_header_before() { do_action('freemarket_header_before'); }
function freemarket_header_inside() { do_action('freemarket_header_inside'); }
function freemarket_header_after() { do_action('freemarket_header_after'); }

// 404.php, archive.php, front-page.php, index.php, loop-page.php, loop-single.php,
// loop.php, page-custom.php, page-full.php, page.php, search.php, single.php
function freemarket_content_before() { do_action('freemarket_content_before'); }
function freemarket_content_after() { do_action('freemarket_content_after'); }
function freemarket_main_before() { do_action('freemarket_main_before'); }
function freemarket_main_after() { do_action('freemarket_main_after'); }
function freemarket_post_before() { do_action('freemarket_post_before'); }
function freemarket_post_after() { do_action('freemarket_post_after'); }
function freemarket_post_inside_before() { do_action('freemarket_post_inside_before'); }
function freemarket_post_inside_after() { do_action('freemarket_post_inside_after'); }
function freemarket_loop_before() { do_action('freemarket_loop_before'); }
function freemarket_loop_after() { do_action('freemarket_loop_after'); }
function freemarket_sidebar_before() { do_action('freemarket_sidebar_before'); }
function freemarket_sidebar_inside_before() { do_action('freemarket_sidebar_inside_before'); }
function freemarket_sidebar_inside_after() { do_action('freemarket_sidebar_inside_after'); }
function freemarket_sidebar_after() { do_action('freemarket_sidebar_after'); }

// footer.php
function freemarket_footer_before() { do_action('freemarket_footer_before'); }
function freemarket_footer_inside() { do_action('freemarket_footer_inside'); }
function freemarket_footer_after() { do_action('freemarket_footer_after'); }
function freemarket_footer() { do_action('freemarket_footer'); }