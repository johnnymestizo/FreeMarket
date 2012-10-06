<?php

if (!has_nav_menu('freemarket-main-menu')) {
	wp_create_nav_menu('FreeMarket Main Navigation', array('slug' => 'freemarket-main-menu'));
}