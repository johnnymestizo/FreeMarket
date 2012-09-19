<?php

/*
 * creates thumbnails from the product's featured image.
 * These thumbnails are created using wpthumb and the purpose of this function
 * is to simplify custom thumbnail sizes with lots of arguments.
 */
function freemarket_product_photo( $echo = true, $post_id = NULL, $link = true, $width = NULL, $height = NULL, $crop = true, $resize = true, $stretch = false, $title = '' ) {
	global $id;
	$post_id = ( NULL === $post_id ) ? $id : $post_id;
	$post_id = apply_filters('mp_product_image_id', $post_id);
	$post = get_post($post_id);
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	
	if ($stretch == true){
		$thumbnail_attr = wp_get_attachment_image_src( $post_thumbnail_id );
		$thumb_url      = $thumbnail_attr[0];
		$thumb_width    = $thumbnail_attr[1];
		$thumb_height   = $thumbnail_attr[2];
		
		if ($thumb_width < $width && $thumb_height < $height) {
			$thumbsize = 'small';
		}
		elseif ($thumb_width < $width && $thumb_height > $height) {
			$thumbsize = 'narrow';
		}
		elseif ($thumb_width > $width && $thumb_height < $height) {
			$thumbsize = 'short';
		}
		elseif ($thumb_width > $width && $thumb_height > $height) {
			$thumbsize = 'ok';
		}
		
		if ($thumbsize == 'small'){
			$thumbstyle = 'width: ' . $width . 'px; height: ' . $height . 'px;';
		}
		elseif ($thumbsize == 'narrow'){
			$thumbstyle = 'width: ' . $width . 'px; height: auto;';
		}
		elseif ($thumbsize == 'short'){
			$thumbstyle = 'width: auto; height: ' . $height . 'px;';
		}
		elseif ($thumbsize == 'ok'){
			$thumbstyle = '';
		}
	} else {
		$thumbstyle = '';
	}

	$size = '"width=' . $width . '&height=' . $height . '&crop=' . $crop . '"'; 
	
	$title_i18n = __($title, 'basic');

	$productlink = get_permalink($post_id);
	$image = get_the_post_thumbnail($post_id, array( 'width' => $width, 'height' => $height, 'crop' => $crop, 'resize' => $resize ), array('style' => $thumbstyle, 'itemprop' => 'image', 'class' => 'product_image', 'title' => $title_i18n));

	$content = '<div class="image-wrapper">';
	if ($link == true){
		if ($productlink){
			$content .= '<a id="product_image-' . $post_id . '"' . $class . ' href="' . $productlink . '">';
		}
	}
	$content .= $image;
	if ($link == true){
		if ($productlink){
			$content .= '</a>';
		}
	}
	$content .= '</div>';

	if ($echo)
		echo $content;
	else
		return $content;
}