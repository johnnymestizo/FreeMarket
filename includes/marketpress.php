<?php

/*
 * This function creates a list of the products in our store.
 * It is based on mp_list_products that can be found in the
 * marketpress/marketpress-includes/template-functions.php file.
 * The customizations are mostly adding some classes 
 * to make marketpress bootstrap-friendly and thus responsive.
 */
function freemarket_list_products( $echo = true, $paginate = '', $page = '', $per_page = '', $order_by = '', $order = '', $category = '', $tag = '', $imagesize = '' ) {
	global $wp_query, $mp;
	$settings = get_option('mp_settings');
	
	//setup taxonomy if applicable
	if ($category) {
		$taxonomy_query = '&product_category=' . sanitize_title($category);
	} else if ($tag) {
		$taxonomy_query = '&product_tag=' . sanitize_title($tag);
	} else if (isset($wp_query->query_vars['taxonomy']) && ($wp_query->query_vars['taxonomy'] == 'product_category' || $wp_query->query_vars['taxonomy'] == 'product_tag')) {
		$term = get_queried_object(); //must do this for number tags
		$taxonomy_query = '&' . $term->taxonomy . '=' . $term->slug;
	} else {
		$taxonomy_query = '';
	}
	
	//setup pagination
	$paged = false;
	if ($paginate) {
		$paged = true;
	} else if ($paginate === '') {
		if ($mp->get_setting('paginate'))
			$paged = true;
		else
			$paginate_query = '&nopaging=true';
	} else {
		$paginate_query = '&nopaging=true';
	}
	
	//get page details
	if ($paged) {
		//figure out perpage
		if (intval($per_page)) {
			$paginate_query = '&posts_per_page='.intval($per_page);
		} else {
			$paginate_query = '&posts_per_page='.$mp->get_setting('per_page');
		}
		
		//figure out page
		if ($wp_query->query_vars['paged'])
			$paginate_query .= '&paged='.intval($wp_query->query_vars['paged']);
		if (intval($page))
			$paginate_query .= '&paged='.intval($page);
		else if ($wp_query->query_vars['paged'])
			$paginate_query .= '&paged='.intval($wp_query->query_vars['paged']);
	}
	
	//get order by
	if (!$order_by) {
		if ($mp->get_setting('order_by') == 'price')
			$order_by_query = '&meta_key=mp_price_sort&orderby=meta_value_num';
		else if ($mp->get_setting('order_by') == 'sales')
			$order_by_query = '&meta_key=mp_sales_count&orderby=meta_value_num';
		else
			$order_by_query = '&orderby='.$mp->get_setting('order_by');
	} else {
		if ('price' == $order_by)
			$order_by_query = '&meta_key=mp_price_sort&orderby=meta_value_num';
		else
			$order_by_query = '&orderby='.$order_by;
	}
	
	//get order direction
	if (!$order) {
		$order_query = '&order='.$mp->get_setting('order');
	} else {
		$order_query = '&order='.$order;
	}
	
	//The Query
	$custom_query = new WP_Query('post_type=product&post_status=publish' . $taxonomy_query . $paginate_query . $order_by_query . $order_query);
	
	//allows pagination links to work get_posts_nav_link()
	if ($wp_query->max_num_pages == 0 || $taxonomy_query)
		$wp_query->max_num_pages = $custom_query->max_num_pages;
	
	$content = '<div id="product_list" class="row-fluid">';
	if ($last = $custom_query->post_count) {
		$count = 1;

		foreach ($custom_query->posts as $post) {
			if (($count%3 == 1))
				$class = 'span4 first';
			elseif (($count%3 == 0))
				$class = 'span4 third';
			else
				$class = 'span4 second';
			
			if(strlen(utf8_decode($post->post_title))>40){
				$product_title = mb_substr($post->post_title,0,40,'UTF-8').'...';
			} else {
				$product_title = $post->post_title;
			}
			
			$content .= '<div '.mp_product_class(false, $class, $post->ID).'>';
			
			$content .= '<div class="product-image-wrapper clearfix">';
			$product_content = mp_product_image( false, 'list', $post->ID, 'fm_prod_thumb' );
			$content .= apply_filters( 'mp_product_list_content', $product_content, $post->ID );
			$content .= '</div>';
			
			$content .= '<h5 class="product_name"><a href="' . get_permalink( $post->ID ) . '">' . $product_title . '</a></h5>';

//			$meta = mp_product_price(false, $post->ID, false);
//			$meta .= mp_buy_button(false, 'list', $post->ID);
//			$content .= apply_filters( 'mp_product_list_meta', $meta, $post->ID );
			
			$content .= '</div>';
			
		$count++;
		}
	} else {
		$content .= '<div id="no_products">' . apply_filters( 'mp_product_list_none', __('No Products', 'freemarket') ) . '</div>';
	}
	$content .= '</div>';
	
	if (  $wp_query->max_num_pages > 1 ) :
		$content .= '<ul class="pagination pagination-centered" style="clear: both; float: none;">';
		$content .= '<li>'.get_previous_posts_link( '<i class="icon-chevron-left"></i> Προηγούμενο' ).'</li>';
		$content .= '<li>'.get_next_posts_link( __( 'Επόμενο <i class="icon-chevron-right"></i>') ).'</li>';
		$content .= '</ul>';
	endif;
	
	if ($echo)
		echo $content;
	else
		return $content;
}