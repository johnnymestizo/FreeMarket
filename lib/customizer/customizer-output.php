<?php

function freemarket_customizations(){
  $color                  = get_theme_mod('background_color' );
  $variation              = get_theme_mod('freemarket_variation');
  $header_bg_color        = get_theme_mod('bc_header_backgroundcolor');
  $header_sitename_color  = get_theme_mod('bc_header_textcolor');
  $btn_class              = get_theme_mod('freemarket_buttons_color');
  $link_color             = get_theme_mod('link_text_color');
  $footer_color           = get_theme_mod('bc_footer_color');
  ?>
  
  <style>
    a, a.active, a:hover, a.hover, a.visited, a:visited, a.link, a:link, .product-single .mp_product_meta .mp_product_price, #product_list .product .mp_product_price{color: <?php echo $link_color; ?>}
    a.btn{color: #333;}
    a.btn-primary, a.btn-info, a.btn-success, a.btn-danger, a.btn-inverse, a.btn-warning{color: #fff;}
    .dropdown-menu{background: <?php echo $color; ?>; background: #<?php echo $color; ?>;}
    <?php if (freemarket_get_brightness($color) >= 130){ ?>
      .dropdown-menu li > a{color: #222;}
    <?php } ?>
    .dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a{background: <?php echo $header_bg_color; ?>;}
    <?php if (freemarket_get_brightness($header_bg_color) >= 130){ ?>
      .dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a{color: #222;}
    <?php } ?>
    .logo-wrapper{background: <?php echo $header_bg_color; ?>;}
    .logo-wrapper .logo a{color: <?php echo $header_sitename_color; ?>;}
    #wrap{background: <?php echo $color; ?>; background: #<?php echo $color; ?>;}
    <?php
    if ($variation == 'dark') { ?>
      #wrap{color: #f7f7f7;}
      a{color: #f2f2f2;}
      .subnav{background: none;}
      .sidenav > li > a:hover{color: #fff;}
      .pager a{color: #fff; background: #222; border: 0;}
      .pager a:hover{color: #f2f2f2; background: #1d1d1d;}
    <?php } ?>
    #footer-wrapper{background: <?php echo $footer_color; ?>}
    <?php
    if (freemarket_get_brightness($footer_color) <= 160){
      echo '#footer-wrapper{color: #dedede;}';
      if (freemarket_get_brightness($link_color) <= 160){
        echo '#footer-wrapper a{color: #fff;}';
      }
    } ?>
    body, input, button, select, textarea, .search-query, .product-single .mp_product_meta .mp_product_price{
      font-family: '<?php echo $webfont; ?>';
    }
  </style>
  <?php

  if ( class_exists( 'MarketPress' ) ) {
    require_once locate_template('/lib/customizer/customizer-output-marketpress.php');
    freemarket_marketpress_customizations();
  }
}
