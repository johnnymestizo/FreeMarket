<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

  <?php if (current_theme_supports('bootstrap-responsive')) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0"><?php } ?>

  <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.5.3.min.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.7.2.min.js"><\/script>')</script>
  
  <?php
  $less_mode = LESS_MODE;
  if($less_mode == 'php'){
  	phpless();
  } else {
  	// To enable development mode, uncomment the line below:
  	// echo <script type="text/javascript"> var less = { env: "development" }; </script>
  	echo '<link rel="stylesheet" type="text/less" href="' . get_template_directory_uri() . '/css/less/styles.less">';
  } ?>
  

  <?php freemarket_head(); ?>
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert">Ο browser σας είναι <em>πολύ παλιός!</em> <a href="http://browsehappy.com/">Αναβαθμίστε σε κάποιον διαφορετικό browser</a> ή <a href="http://www.google.com/chromeframe/?redirect=true">εγκαταστήστε το Google Chrome Frame</a> για να μπορέσετε να δείτε αυτή τη σελίδα.</div><![endif]-->
  
  <?php freemarket_header_before(); ?>
  <?php freemarket_header_after(); ?>

  <?php freemarket_wrap_before(); ?>
  <div id="wrap" class="<?php echo WRAP_CLASSES; ?>" role="document">
  	<div class="header-branding container-fluid">
	  	<div class="header_logo">
  			<a href="/"><?php if ( function_exists( 'the_logo' ) ) the_logo(); ?></a>
	  	</div>
  	</div>
  	<div id="maincontentarea">