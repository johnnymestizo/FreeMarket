<?php

$less_mode = LESS_MODE;

if($less_mode == 'php'){
	function phpless(){
		require_once( TEMPLATEPATH . '/includes/lessphp/lessc.inc.php' );
		lessc::ccompile( TEMPLATEPATH . '/css/less/styles.less', TEMPLATEPATH . '/css/styles.css');
	}
}
