<?php

global $header_selectors,$sticky_header_selectors;
$header_selectors = array(
	//Header 1
	'body:not(.met_boxed_layout) .met_header_id_1','.met_boxed_layout [class*="met_header_id_"]:not(.met_header_id_4) header.met_content',
    //Header 2
    'body:not(.met_boxed_layout) .met_header_id_2','.met_boxed_layout .met_header_id_2 header.met_content', '.met_boxed_layout .met_header_id_2 .met_header_bar .met_content',
    //Header 3
    'body:not(.met_boxed_layout) .met_header_id_3','.met_boxed_layout .met_header_id_3 header.met_content', 'body:not(.met_boxed_layout) .met_header_id_3 .met_header_bar',

    'body:not(.met_boxed_layout) .met_header_id_4','.met_boxed_layout .met_header_id_4 header.met_content', 'body:not(.met_boxed_layout) .met_header_id_4 .met_header_bar',

    'body:not(.met_boxed_layout) .met_header_id_5','.met_boxed_layout .met_header_id_5 header.met_content', 'body:not(.met_boxed_layout) .met_header_id_5 .met_header_bar',
);

$sticky_header_selectors = array(
	//Header 1
	'body:not(.met_boxed_layout) .met_sticky_header','.met_boxed_layout .met_sticky_header .met_content',
);

// Load Redux extensions - MUST be loaded before your options are set
if (file_exists(dirname(__FILE__).'/redux-extensions/extensions-init.php')) {
    require_once( dirname(__FILE__).'/redux-extensions/extensions-init.php' );
}    
// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__).'/redux-framework/framework.php')) {
    require_once( dirname(__FILE__).'/redux-framework/framework.php' );
}
// Load the theme/plugin options
if (file_exists(dirname(__FILE__).'/options-init.php')) {
    require_once( dirname(__FILE__).'/options-init.php' );
}

if ( ! function_exists('met_option') ) {
	function met_option($id, $param = false, $fallback = false ) {
		global $met_options;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($met_options[$id]) && $met_options[$id] !== '' ) ? $met_options[$id] : $fallback;
		if ( !empty($met_options[$id]) && $param ) {
			$output = $met_options[$id][$param];
		}
		return $output;
	}
}

// Front-end Option Handler
if (file_exists(dirname(__FILE__).'/redux_handler.php')) {
	require_once( dirname(__FILE__).'/redux_handler.php' );
}

/* FONT AWESOME */
function newIconFont() {
	// Uncomment this to remove elusive icon from the panel completely
	//wp_deregister_style( 'redux-elusive-icon' );
	//wp_deregister_style( 'redux-elusive-icon-ie7' );

	wp_register_style( 'redux-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css',array(),time(),'all' );
	wp_enqueue_style( 'redux-font-awesome' );
}
// This example assumes the opt_name is set to redux_demo.  Please replace it with your opt_name value.
add_action( 'redux/page/met_options/enqueue', 'newIconFont' );