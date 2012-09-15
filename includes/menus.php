<?php

function freemarket_register_menus() {
	register_nav_menus(
		array(
			'freemarket-top-menu'  => __('FreeMarket Top Menu', 'freemarket'),
			'freemarket-main-menu' => __('FreeMarket Main Menu', 'freemarket')
		)
	);
}

add_action( 'init', 'freemarket_register_menus' );