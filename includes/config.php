<?php

add_theme_support('bootstrap-responsive');

// Set the content width based on the theme's design and stylesheet
if (!isset($content_width)) { $content_width = 940; }

define('POST_EXCERPT_LENGTH',       40);
define('WRAP_CLASSES', 'container');
define('CONTAINER_CLASSES', 'row-fluid');
define('MAIN_CLASSES',              'span8');
define('SIDEBAR_CLASSES',           'span4');
define('FULLWIDTH_CLASSES',         'span12');
define('GOOGLE_ANALYTICS_ID',       '');

// Below you can choose the way less files are handled. 
// Options are: js, php.
// When 'php' is selected, the global.less file is compiled to global.css using phpless.
// When 'js' is selected, the global.less file is compiled on the browser using the less.js script.

define('LESS_MODE', 'php');

// Set the post revisions to 5 unless previously set to avoid DB bloat
if (!defined('WP_POST_REVISIONS')) { define('WP_POST_REVISIONS', 2); }

define('WP_BASE',                   wp_base_dir());
define('THEME_NAME',                next(explode('/themes/', get_template_directory())));
define('RELATIVE_PLUGIN_PATH',      str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH',     str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH',                RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);
