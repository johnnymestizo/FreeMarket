<?php

//Removes script versions to enable better browser caching
function freemarket_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', 'freemarket_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'freemarket_remove_script_version', 15, 1 );