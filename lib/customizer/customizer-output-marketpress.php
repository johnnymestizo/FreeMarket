<?php

function freemarket_marketpress_customizations(){
  $color                  = get_theme_mod('background_color' );
  $variation              = get_theme_mod('freemarket_variation');
  $header_bg_color        = get_theme_mod('bc_header_backgroundcolor');
  $header_sitename_color  = get_theme_mod('bc_header_textcolor');
  $link_color             = get_theme_mod('link_text_color');
  $button_color           = get_theme_mod('bc_buttons_color');
  
  // If no color is selected, set to #06c
  if (strlen($button_color) <= 2 ){ $button_color = '#06c'; }
  
  ?>
  <style>
    #product_list .product .mp_product_price{background: <?php echo $color; ?>; background: #<?php echo $color; ?>;}
    <?php if ($variation == 'dark'){ ?>
      #product_list .product .product_name a, #product_list .product .content a{color: #fff;}
      #product_list .product{background: #111;}
    <?php } ?>
    <?php
    
    if (!class_exists(lessc)){
      require_once(TEMPLATEPATH . '/lib/less/lessc.inc.php');
    }
    $less = new lessc;
    
    $less->setVariables(array(
        "btnColor"  => $button_color,
    ));
    $less->setFormatter("compressed");
    
    if (freemarket_get_brightness($button_color) <= 160){
      echo $less->compile("
        @btnColorHighlight: darken(spin(@btnColor, 5%), 10%);

        .gradientBar(@primaryColor, @secondaryColor, @textColor: #fff, @textShadow: 0 -1px 0 rgba(0,0,0,.25)) {
          color: @textColor;
          text-shadow: @textShadow;
          #gradient > .vertical(@primaryColor, @secondaryColor);
          border-color: @secondaryColor @secondaryColor darken(@secondaryColor, 15%);
          border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) fadein(rgba(0,0,0,.1), 15%);
        }

        #gradient {
          .vertical(@startColor: #555, @endColor: #333) {
            background-color: mix(@startColor, @endColor, 60%);
            background-image: -moz-linear-gradient(top, @startColor, @endColor); // FF 3.6+
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(@startColor), to(@endColor)); // Safari 4+, Chrome 2+
            background-image: -webkit-linear-gradient(top, @startColor, @endColor); // Safari 5.1+, Chrome 10+
            background-image: -o-linear-gradient(top, @startColor, @endColor); // Opera 11.10
            background-image: linear-gradient(to bottom, @startColor, @endColor); // Standard, IE10
            background-repeat: repeat-x;
          }
        }

        .buttonBackground(@startColor, @endColor, @textColor: #fff, @textShadow: 0 -1px 0 rgba(0,0,0,.25)) {
          .gradientBar(@startColor, @endColor, @textColor, @textShadow);
          *background-color: @endColor; /* Darken IE7 buttons by default so they stand out more given they won't have borders */
          .reset-filter();
          &:hover, &:active, &.active, &.disabled, &[disabled] {
            color: @textColor;
            background-color: @endColor;
            *background-color: darken(@endColor, 5%);
          }
        }
        #mp_product_list a.mp_link_buynow,
        a.mp_cart_direct_checkout_link,
        input#mp_shipping_submit,
        input#mp_payment_confirm,
        #mp_cart_form table.mp_cart_contents input[type='submit'],
        .mp_button_addcart,
        .mp_button_buynow,
        .single .mp_button_addcart,
        .single .mp_button_buynow{
          .buttonBackground(@btnColor, @btnColorHighlight);
        }
      ");
    } else {
      echo $less->compile("
        @btnColorHighlight: darken(@btnColor, 15%);

        .gradientBar(@primaryColor, @secondaryColor, @textColor: #333, @textShadow: 0 -1px 0 rgba(0,0,0,.25)) {
          color: @textColor;
          text-shadow: @textShadow;
          #gradient > .vertical(@primaryColor, @secondaryColor);
          border-color: @secondaryColor @secondaryColor darken(@secondaryColor, 15%);
          border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) fadein(rgba(0,0,0,.1), 15%);
        }

        #gradient {
          .vertical(@startColor: #555, @endColor: #333) {
            background-color: mix(@startColor, @endColor, 60%);
            background-image: -moz-linear-gradient(top, @startColor, @endColor); // FF 3.6+
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(@startColor), to(@endColor)); // Safari 4+, Chrome 2+
            background-image: -webkit-linear-gradient(top, @startColor, @endColor); // Safari 5.1+, Chrome 10+
            background-image: -o-linear-gradient(top, @startColor, @endColor); // Opera 11.10
            background-image: linear-gradient(to bottom, @startColor, @endColor); // Standard, IE10
            background-repeat: repeat-x;
          }
        }

        .buttonBackground(@startColor, @endColor, @textColor: #333, @textShadow: 0 -1px 0 rgba(0,0,0,.25)) {
          .gradientBar(@startColor, @endColor, @textColor, @textShadow);
          *background-color: @endColor; /* Darken IE7 buttons by default so they stand out more given they won't have borders */
          .reset-filter();
          &:hover, &:active, &.active, &.disabled, &[disabled] {
            color: @textColor;
            background-color: @endColor;
            *background-color: darken(@endColor, 5%);
          }
        }
        #mp_product_list a.mp_link_buynow,
        a.mp_cart_direct_checkout_link,
        input#mp_shipping_submit,
        input#mp_payment_confirm,
        #mp_cart_form table.mp_cart_contents input[type='submit'],
        .mp_button_addcart,
        .mp_button_buynow,
        .single .mp_button_addcart,
        .single .mp_button_buynow{
          .buttonBackground(@btnColor, @btnColorHighlight);
        }
      ");
    }?>
    
  </style>
<?php }