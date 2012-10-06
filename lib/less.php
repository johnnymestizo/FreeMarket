<?php

function phpless(){
  if (!class_exists(lessc)){
    require_once( TEMPLATEPATH . '/lib/less/lessc.inc.php' );
  }
  $less = new lessc;
  $less->setFormatter("compressed");
  
  if (class_exists('MarketPress')){
    $less->checkedCompile( TEMPLATEPATH . '/lib/marketpress/style.less', TEMPLATEPATH . '/assets/css/marketpress.css');
  } elseif (function_exists('edd_get_cart_contents')){
    $less->checkedCompile( TEMPLATEPATH . '/lib/easy-digital-downloads/style.less', TEMPLATEPATH . '/assets/css/edd.css');
  } else {
    $less->checkedCompile( TEMPLATEPATH . '/assets/css/less/global.less', TEMPLATEPATH . '/assets/css/global.css');
  }
}
