<?php

function shortcode_fix( $content ) {

	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	return $content;
}

$shortcodes_dir = 'shortcodes/';

$shortcode_files = array(
	'accordion',
	'tabs',
    'list',
    'button',
	'button_icon',
	'button_circle',
	'icon_box',
	'social_button',
	'pricing_table_list'
);

foreach($shortcode_files as $shortcode_file):
    require_once $shortcodes_dir.$shortcode_file.'.php';
endforeach;