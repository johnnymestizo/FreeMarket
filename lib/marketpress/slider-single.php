<?php

function freemarket_single_product_images_slider($echo, $id){
  $attachments = get_posts( array(
    'post_type' => 'attachment',
    'posts_per_page' => -1,
    'post_parent' => $id,
  ));
  
  if ( $attachments ) {
    $content = '<div id="single_product_carousel" class="carousel slide">';
    $content .= '<div class="carousel-inner">';
    
    $attachmentscount = count($attachments);
    foreach ( $attachments as $attachment ) {
      $img_attributes = wp_get_attachment_image_src($attachment->ID, 'full' );
      $img = '<img itemprop="image" src="' . $img_attributes[0] . '" />';
      $content .= '<div class="item"' . $class . ' data-design-thumbnail">' . $img . '</div>';
    }
    
    $content .= '</div>';
    
    if ($attachmentscount >= 2){
      $content .= '<a class="carousel-control left" style="color: #fff;" href="#single_product_carousel" data-slide="prev">&lsaquo;</a>';
      $content .= '<a class="carousel-control right" style="color: #fff;" href="#single_product_carousel" data-slide="next">&rsaquo;</a>';
    }
    $content .= '</div>';
    $content .= '<script type="text/javascript" charset="utf-8">
                  jQuery(window).load(function() {
                    $(".carousel").carousel()
                  });
                  </script>';
    $content .= '<div class="region-divider"></div>';
    
  }
  if ($echo)
    echo $content;
  else
    return $content;
}

function freemarket_product_with_slider($id){
  $post = get_post($product_id);
  
  $content .= '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="mp_product_meta">';
  $content .= mp_product_price(false, $id, '');
  $content .= mp_buy_button(false, 'single', $id);
  $content .= '</div>';
  $content .= '<div itemprop="description" class="mp_product_content">';
  $content .= apply_filters('the_content', $post->post_content);
  $content .= '</div>';
  $content .= freemarket_single_product_images_slider(false, $id);
  
  echo $content;
}
