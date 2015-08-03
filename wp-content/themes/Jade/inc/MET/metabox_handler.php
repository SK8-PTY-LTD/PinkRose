<?php
global $met_options;

$mb_bool = array('true', 'false');
$op_bool = array(true, false);

$custom_metaboxes = rwmb_meta( MET_MB_PREFIX.'custom_page_metaboxes', array('type' => 'checkbox_list') );
if(!is_array($custom_metaboxes)) $custom_metaboxes = array();

global $custom_header_options_status, $custom_background_options_status, $custom_footer_options_status, $custom_logo_options_status, $custom_sticky_logo_options_status, $custom_sticky_header_options_status, $mb_fsc_options, $header_main_nav_menu, $footer_display_status, $footer_nav_menu, $mb_pl_options,$custom_preloader_options;

$custom_header_options_status 			= (in_array('page_header_options', $custom_metaboxes)) ? true : false;
$custom_sticky_header_options_status 	= (in_array('page_sticky_header_options', $custom_metaboxes)) ? true : false;
$custom_logo_options_status 			= (in_array('page_logo_options', $custom_metaboxes)) ? true : false;
$custom_sticky_logo_options_status 		= (in_array('page_sticky_logo_options', $custom_metaboxes)) ? true : false;
$custom_background_options_status 		= (in_array('page_background_options', $custom_metaboxes)) ? true : false;
$custom_footer_options_status 			= (in_array('page_footer_options', $custom_metaboxes)) ? true : false;
$custom_sidenav_options_status 			= (in_array('page_sidenav_options', $custom_metaboxes)) ? true : false;
$custom_preloader_options 			    = (in_array('page_preloader_options', $custom_metaboxes)) ? true : false;

//PIB Status overwrite
$mb_pib_status = rwmb_meta(MET_MB_PREFIX.'page_info_bar_status');
if( !empty($mb_pib_status) AND $mb_pib_status != '0' ){
	$met_options['pib_status'] = (bool) str_replace( $mb_bool, $op_bool, $mb_pib_status );
}

$page_template = '';
$page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

/*======================
=     BLOG OPTIONS     =
======================*/
if(!empty($page_template) AND $page_template == 'archive.php'){

	/* ### - sidebar position - ### */
	$mb_blog_sidebar_position = rwmb_meta(MET_MB_PREFIX.'blog_sidebar_position');
	if( !empty($mb_blog_sidebar_position) AND $mb_blog_sidebar_position != '0' ){
		$met_options['blog_sidebar_position'] = $mb_blog_sidebar_position;
	}

	/* ### - blog_listing_layout - ### */
	$mb_blog_listing_layout = rwmb_meta(MET_MB_PREFIX.'blog_listing_layout');
	if( !empty($mb_blog_listing_layout) AND $mb_blog_listing_layout != '0' ){
		$met_options['blog_listing_layout'] = $mb_blog_listing_layout;
	}

	/* ### - blog_listing_masonry_column_no - ### */
	$mb_blog_listing_masonry_column_no = rwmb_meta(MET_MB_PREFIX.'blog_listing_masonry_column_no');
	if( !empty($mb_blog_listing_masonry_column_no) AND $mb_blog_listing_masonry_column_no != '0' ){
		$met_options['blog_listing_masonry_column_no'] = $mb_blog_listing_masonry_column_no;
	}

	/* ### - blog_pagination_layout - ### */
	$mb_blog_pagination_layout = rwmb_meta(MET_MB_PREFIX.'blog_pagination_layout');
	if( !empty($mb_blog_pagination_layout) AND $mb_blog_pagination_layout != '0' ){
		$met_options['blog_pagination_layout'] = $mb_blog_pagination_layout;
	}

	/* ### - blog_listing_post_animation - ### */
	$mb_blog_listing_post_animation = rwmb_meta(MET_MB_PREFIX.'blog_listing_post_animation');
	if( !empty($mb_blog_listing_post_animation) AND $mb_blog_listing_post_animation != '0' ){
		$met_options['blog_listing_post_animation'] = $mb_blog_listing_post_animation;
	}

	/* ### - blog_listing_post_animation_options - ### */
	$mb_blog_listing_post_animation_options = rwmb_meta(MET_MB_PREFIX.'blog_listing_post_animation_options');
	if( !empty($mb_blog_listing_post_animation_options) AND $mb_blog_listing_post_animation_options != '0' ){
		$met_options['blog_listing_post_animation_duration'] 	= rwmb_meta(MET_MB_PREFIX.'blog_listing_post_animation_duration');
		$met_options['blog_listing_post_animation_delay'] 		= rwmb_meta(MET_MB_PREFIX.'blog_listing_post_animation_delay');
		$met_options['blog_listing_post_animation_offset'] 		= rwmb_meta(MET_MB_PREFIX.'blog_listing_post_animation_offset');
	}

	/* ### - blog_listing_content_type - ### */
	$mb_blog_listing_content_type = rwmb_meta(MET_MB_PREFIX.'blog_listing_content_type');
	if( !empty($mb_blog_listing_content_type) AND $mb_blog_listing_content_type != '0' ){
		$met_options['blog_listing_content_type'] = $mb_blog_listing_content_type;
	}

	/* ### - blog_excerpt_length - ### */
	$mb_blog_excerpt_length = rwmb_meta(MET_MB_PREFIX.'blog_excerpt_length');
	if( !empty($mb_blog_excerpt_length) ){
		$met_options['blog_excerpt_length'] = $mb_blog_excerpt_length;
	}

	/* ### - blog_excerpt_length - ### */
	$mb_blog_excerpt_more = rwmb_meta(MET_MB_PREFIX.'blog_excerpt_more');
	if( !empty($mb_blog_excerpt_more) ){
		$met_options['blog_excerpt_more'] = $mb_blog_excerpt_more;
	}

	/* ### - blog_listing_meta_date - ### */
	$mb_blog_listing_meta_date = rwmb_meta(MET_MB_PREFIX.'blog_listing_meta_date');
	if( !empty($mb_blog_listing_meta_date) AND $mb_blog_listing_meta_date != '0' ){
		$met_options['blog_listing_meta_date'] = (bool) str_replace($mb_bool, $op_bool, $mb_blog_listing_meta_date);
	}

	/* ### - blog_listing_meta_category - ### */
	$mb_blog_listing_meta_category = rwmb_meta(MET_MB_PREFIX.'blog_listing_meta_category');
	if( !empty($mb_blog_listing_meta_category) AND $mb_blog_listing_meta_category != '0' ){
		$met_options['blog_listing_meta_category'] = (bool) str_replace($mb_bool, $op_bool, $mb_blog_listing_meta_category);
	}

	/* ### - blog_listing_meta_author - ### */
	$mb_blog_listing_meta_author = rwmb_meta(MET_MB_PREFIX.'blog_listing_meta_author');
	if( !empty($mb_blog_listing_meta_author) AND $mb_blog_listing_meta_author != '0' ){
		$met_options['blog_listing_meta_author'] = (bool) str_replace($mb_bool, $op_bool, $mb_blog_listing_meta_author);
	}

	/* ### - blog_listing_meta_comments_number - ### */
	$mb_blog_listing_meta_comments_number = rwmb_meta(MET_MB_PREFIX.'blog_listing_meta_comments_number');
	if( !empty($mb_blog_listing_meta_comments_number) AND $mb_blog_listing_meta_comments_number != '0' ){
		$met_options['blog_listing_meta_comments_number'] = (bool) str_replace($mb_bool, $op_bool, $mb_blog_listing_meta_comments_number);
	}

	/* ### - blog_listing_meta_tags - ### */
	$mb_blog_listing_meta_tags = rwmb_meta(MET_MB_PREFIX.'blog_listing_meta_tags');
	if( !empty($mb_blog_listing_meta_tags) AND $mb_blog_listing_meta_tags != '0' ){
		$met_options['blog_listing_meta_tags'] = (bool) str_replace($mb_bool, $op_bool, $mb_blog_listing_meta_tags);
	}

	/* ### - blog_listing_meta_readmore - ### */
	$mb_blog_listing_meta_readmore = rwmb_meta(MET_MB_PREFIX.'blog_listing_meta_readmore');
	if( !empty($mb_blog_listing_meta_readmore) AND $mb_blog_listing_meta_readmore != '0' ){
		$met_options['blog_listing_meta_readmore'] = (bool) str_replace($mb_bool, $op_bool, $mb_blog_listing_meta_readmore);
	}
}

/*========================
=     HEADER OPTIONS     =
========================*/
$header_display_status = true;
$header_tb_display_status = true;
$header_main_nav_menu = false;

$option_disable_header = isset( $met_options['disable_header'] ) ? $met_options['disable_header'] : true;
if( $option_disable_header == false ){
    $header_display_status = false;
}

if($custom_header_options_status){

	/* ### - Header Display Status - ### */
	if( rwmb_meta(MET_MB_PREFIX.'disable_header') == 1 ){
		$header_display_status = false;
	}

	/* ### - Header Top Bar Display Status - ### */
	if( rwmb_meta(MET_MB_PREFIX.'disable_header_top_bar') == 1 ){
		$header_tb_display_status = false;
	}

	/* ### - Header Layout overwrite - ### */
	$mb_header_layout = rwmb_meta(MET_MB_PREFIX.'header_layout');
	if( !empty($mb_header_layout) AND $mb_header_layout != '0'){
		$met_options['header_layout'] = $mb_header_layout;
	}

	/* ### - Header Menu overwrite - ### */
	$mb_header_menu = rwmb_meta(MET_MB_PREFIX.'header_menu');
	if( !empty($mb_header_menu) AND $mb_header_menu != '0'){
		$header_main_nav_menu = $mb_header_menu;
	}

	/* ### - Header on Content overwrite - ### */
	$header_on_content_status = false;
	$mb_header_on_content = rwmb_meta(MET_MB_PREFIX.'header_on_content');
	if( !empty($mb_header_on_content) AND $mb_header_on_content != '0' ){
		$header_on_content_status = (bool) str_replace($mb_bool,$op_bool,$mb_header_on_content);
	}

	/* ### - Header Seperator Styling - ### */
	$mb_header_border_width = rwmb_meta(MET_MB_PREFIX.'header_border_width');
	if( !empty($mb_header_border_width) AND $mb_header_border_width != '0' ){
		$met_options['header_borders']['border-top'] = $mb_header_border_width.'px';
	}

	$mb_header_border_style = rwmb_meta(MET_MB_PREFIX.'header_border_style');
	if( !empty($mb_header_border_style) AND $mb_header_border_style != '0' ){
		$met_options['header_borders']['border-style'] = $mb_header_border_style;
	}

	$mb_header_border_color = rwmb_meta(MET_MB_PREFIX.'header_border_color');
	if( !empty($mb_header_border_color) AND $mb_header_border_color != '0' ){
		$met_options['header_borders']['border-color'] = $mb_header_border_color;
	}

	$mb_header_borders_opacity = rwmb_meta(MET_MB_PREFIX.'header_borders_opacity');
	if( !empty($mb_header_borders_opacity) AND $mb_header_borders_opacity != '0' ){
		$met_options['header_borders_opacity'] = $mb_header_borders_opacity;
	}

	/* ### - Header Bottom Border Styling - ### */
	$mb_header_bottom_border_width = rwmb_meta(MET_MB_PREFIX.'header_bottom_border_width');
	if( !empty($mb_header_bottom_border_width) AND $mb_header_bottom_border_width != '0' ){
		$met_options['header_bottom_border']['border-bottom'] = $mb_header_bottom_border_width.'px';
	}

	$mb_header_bottom_border_style = rwmb_meta(MET_MB_PREFIX.'header_bottom_border_style');
	if( !empty($mb_header_bottom_border_style) AND $mb_header_bottom_border_style != '0' ){
		$met_options['header_bottom_border']['border-style'] = $mb_header_bottom_border_style;
	}

	$mb_header_bottom_border_color = rwmb_meta(MET_MB_PREFIX.'header_bottom_border_color');
	if( !empty($mb_header_bottom_border_color) AND $mb_header_bottom_border_color != '0' ){
		$met_options['header_bottom_border']['border-color'] = $mb_header_bottom_border_color;
	}

	$mb_header_bottom_border_opacity = rwmb_meta(MET_MB_PREFIX.'header_bottom_border_opacity');
	if( !empty($mb_header_bottom_border_opacity) AND $mb_header_bottom_border_opacity != '0' ){
		$met_options['header_bottom_border_opacity'] = $mb_header_bottom_border_opacity;
	}
}

/*======================
=     LOGO OPTIONS     =
======================*/
if( $custom_logo_options_status ){
	/* ### - Logo overwrite - ### */
	$mb_logo = rwmb_meta(MET_MB_PREFIX.'logo','type=image_advanced');
	if( !empty($mb_logo) ){
		$met_options['logo']['url'] = $mb_logo[key($mb_logo)]['full_url'];
	}

	/* ### - Logo Retina overwrite - ### */
	$mb_logo_retina = rwmb_meta(MET_MB_PREFIX.'logo_retina','type=image_advanced');
	if( !empty($mb_logo_retina) ){
		$met_options['logo_retina']['url'] = $mb_logo_retina[key($mb_logo_retina)]['full_url'];
	}

	/* ### - Logo Height overwrite - ### */
	$mb_logo_height = rwmb_meta(MET_MB_PREFIX.'logo_height');
	if( !empty($mb_logo_height) AND $mb_logo_height != '0'){
		$met_options['logo_height']['height'] = $mb_logo_height.'px';
	}

	/* ### - Logo Padding overwrite - ### */
	$mb_logo_padding_top = rwmb_meta(MET_MB_PREFIX.'logo_padding_top');
	if( !empty($mb_logo_padding_top) ){
		$met_options['logo_spacing']['padding-top'] = $mb_logo_padding_top.'px';
	}

	$mb_logo_padding_bottom = rwmb_meta(MET_MB_PREFIX.'logo_padding_bottom');
	if( !empty($mb_logo_padding_bottom) ){
		$met_options['logo_spacing']['padding-bottom'] = $mb_logo_padding_bottom.'px';
	}
	
	$mb_logo_padding_right = rwmb_meta(MET_MB_PREFIX.'logo_padding_right');
	if( !empty($mb_logo_padding_right) ){
		$met_options['logo_spacing']['padding-right'] = $mb_logo_padding_right.'px';
	}

	$mb_logo_padding_left = rwmb_meta(MET_MB_PREFIX.'logo_padding_left');
	if( !empty($mb_logo_padding_left) ){
		$met_options['logo_spacing']['padding-left'] = $mb_logo_padding_left.'px';
	}

	/* ### - Logo Text overwrite - ### */
	$mb_logo_text = rwmb_meta(MET_MB_PREFIX.'logo_text');
	if( !empty($mb_logo_text) ){
		$met_options['logo_text'] = $mb_logo_text;
	}

	/* ### - Logo Text Color overwrite - ### */
	$mb_logo_text_color = rwmb_meta(MET_MB_PREFIX.'logo_text_color');
	if( !empty($mb_logo_text_color) ){
		$met_options['logo_text_style']['color'] = $mb_logo_text_color;
	}

	/* ### - Logo Text Size overwrite - ### */
	$mb_logo_text_size = rwmb_meta(MET_MB_PREFIX.'logo_text_size');
	if( !empty($mb_logo_text_size) ){
		$met_options['logo_text_style']['font-size'] = $mb_logo_text_size.'px';
	}
}

/*=============================
=     STICKY LOGO OPTIONS     =
=============================*/
if( $custom_sticky_logo_options_status ){
	/* ### - Sticky Logo overwrite - ### */
	$mb_sticky_logo_options = rwmb_meta(MET_MB_PREFIX.'sticky_logo_options');
	if( !empty($mb_sticky_logo_options) AND $mb_sticky_logo_options != '0' ){
		$met_options['sticky_logo_options'] = (bool) str_replace($mb_bool,$op_bool,$mb_sticky_logo_options);
	}

	/* ### - Logo overwrite - ### */
	$mb_sticky_logo = rwmb_meta(MET_MB_PREFIX.'sticky_logo','type=image_advanced');
	if( !empty($mb_sticky_logo) ){
		$met_options['sticky_logo']['url'] = $mb_sticky_logo[key($mb_sticky_logo)]['full_url'];
	}

	/* ### - Logo Height overwrite - ### */
	$mb_sticky_logo_height = rwmb_meta(MET_MB_PREFIX.'sticky_logo_height');
	if( !empty($mb_sticky_logo_height) AND $mb_sticky_logo_height != '0'){
		$met_options['sticky_logo_height']['height'] = $mb_sticky_logo_height.'px';
	}

	/* ### - Logo Padding overwrite - ### */
	$mb_sticky_logo_padding_top = rwmb_meta(MET_MB_PREFIX.'sticky_logo_padding_top');
	if( !empty($mb_sticky_logo_padding_top) ){
		$met_options['sticky_logo_spacing']['padding-top'] = $mb_sticky_logo_padding_top.'px';
	}

	$mb_sticky_logo_padding_bottom = rwmb_meta(MET_MB_PREFIX.'sticky_logo_padding_bottom');
	if( !empty($mb_sticky_logo_padding_bottom) ){
		$met_options['sticky_logo_spacing']['padding-bottom'] = $mb_sticky_logo_padding_bottom.'px';
	}
	
	$mb_sticky_logo_padding_right = rwmb_meta(MET_MB_PREFIX.'sticky_logo_padding_right');
	if( !empty($mb_sticky_logo_padding_right) ){
		$met_options['sticky_logo_spacing']['padding-right'] = $mb_sticky_logo_padding_right.'px';
	}

	$mb_sticky_logo_padding_left = rwmb_meta(MET_MB_PREFIX.'sticky_logo_padding_left');
	if( !empty($mb_sticky_logo_padding_left) ){
		$met_options['sticky_logo_spacing']['padding-left'] = $mb_sticky_logo_padding_left.'px';
	}

	/* ### - Logo Text overwrite - ### */
	$mb_sticky_logo_text = rwmb_meta(MET_MB_PREFIX.'sticky_logo_text');
	if( !empty($mb_sticky_logo_text) ){
		$met_options['sticky_logo_text'] = $mb_sticky_logo_text;
	}

	/* ### - Logo Text Color overwrite - ### */
	$mb_logo_text_color = rwmb_meta(MET_MB_PREFIX.'sticky_logo_text_color');
	if( !empty($mb_logo_text_color) ){
		$met_options['sticky_logo_text_style']['color'] = $mb_logo_text_color;
	}

	/* ### - Logo Text Size overwrite - ### */
	$mb_sticky_logo_text_size = rwmb_meta(MET_MB_PREFIX.'sticky_logo_text_size');
	if( !empty($mb_sticky_logo_text_size) ){
		$met_options['sticky_logo_text_style']['font-size'] = $mb_sticky_logo_text_size.'px';
	}
}

/*===============================
=     STICKY HEADER OPTIONS     =
===============================*/
if( $custom_sticky_header_options_status ){
	/* ### - Sticky Header overwrite - ### */
	$mb_sticky_header = rwmb_meta(MET_MB_PREFIX.'sticky_header');
	if( !empty($mb_sticky_header) AND $mb_sticky_header != '0' ){
		$met_options['sticky_header'] = (bool) str_replace($mb_bool,$op_bool,$mb_sticky_header);
	}
	
	/* ### - Sticky Header Height overwrite - ### */
	$mb_sticky_header_height = rwmb_meta(MET_MB_PREFIX.'sticky_header_height');
	if( !empty($mb_sticky_header_height) ){
		$met_options['sticky_header_height'] = $mb_sticky_header_height;
	}

	/* ### - Sticky Header Wide overwrite - ### */
	$mb_header_wide = rwmb_meta(MET_MB_PREFIX.'header_wide');
	if( !empty($mb_header_wide) AND $mb_header_wide != '0'){
		$met_options['header_wide'] = (bool) str_replace($mb_bool, $op_bool, $mb_header_wide);
	}

	/* ### - Sticky Header Seperator Sync overwrite - ### */
	$mb_sticky_header_borders_is_same = rwmb_meta(MET_MB_PREFIX.'sticky_header_borders_is_same');
	if( !empty($mb_sticky_header_borders_is_same) AND $mb_sticky_header_borders_is_same != '0'){
		$met_options['sticky_header_borders_is_same'] = (bool) str_replace($mb_bool, $op_bool, $mb_sticky_header_borders_is_same);
	}

	/* ### - Sticky Header Seperator Styling - ### */
	$mb_sticky_header_border_width = rwmb_meta(MET_MB_PREFIX.'sticky_header_border_width');
	if( !empty($mb_sticky_header_border_width) AND $mb_sticky_header_border_width != '0' ){
		$met_options['sticky_header_borders']['border-top'] = $mb_sticky_header_border_width.'px';
	}

	$mb_sticky_header_border_style = rwmb_meta(MET_MB_PREFIX.'sticky_header_border_style');
	if( !empty($mb_sticky_header_border_style) AND $mb_sticky_header_border_style != '0' ){
		$met_options['sticky_header_borders']['border-style'] = $mb_sticky_header_border_style;
	}

	$mb_sticky_header_border_color = rwmb_meta(MET_MB_PREFIX.'sticky_header_border_color');
	if( !empty($mb_sticky_header_border_color) AND $mb_sticky_header_border_color != '0' ){
		$met_options['sticky_header_borders']['border-color'] = $mb_sticky_header_border_color;
	}

	$mb_sticky_header_borders_opacity = rwmb_meta(MET_MB_PREFIX.'sticky_header_borders_opacity');
	if( !empty($mb_sticky_header_borders_opacity) AND $mb_sticky_header_borders_opacity != '0' ){
		$met_options['sticky_header_borders_opacity'] = $mb_sticky_header_borders_opacity;
	}

	/* ### - Sticky Header Bottom Border Sync overwrite - ### */
	$mb_sticky_header_bottom_border_is_same = rwmb_meta(MET_MB_PREFIX.'sticky_header_bottom_border_is_same');
	if( !empty($mb_sticky_header_bottom_border_is_same) AND $mb_sticky_header_bottom_border_is_same != '0'){
		$met_options['sticky_header_bottom_border_is_same'] = (bool) str_replace($mb_bool, $op_bool, $mb_sticky_header_bottom_border_is_same);
	}

	/* ### - Sticky Header Bottom Border Styling - ### */
	$mb_sticky_header_bottom_border_width = rwmb_meta(MET_MB_PREFIX.'sticky_header_bottom_border_width');
	if( !empty($mb_sticky_header_bottom_border_width) AND $mb_sticky_header_bottom_border_width != '0' ){
		$met_options['sticky_header_bottom_border']['border-bottom'] = $mb_sticky_header_bottom_border_width.'px';
	}

	$mb_sticky_header_bottom_border_style = rwmb_meta(MET_MB_PREFIX.'sticky_header_bottom_border_style');
	if( !empty($mb_sticky_header_bottom_border_style) AND $mb_sticky_header_bottom_border_style != '0' ){
		$met_options['sticky_header_bottom_border']['border-style'] = $mb_sticky_header_bottom_border_style;
	}

	$mb_sticky_header_bottom_border_color = rwmb_meta(MET_MB_PREFIX.'sticky_header_bottom_border_color');
	if( !empty($mb_sticky_header_bottom_border_color) AND $mb_sticky_header_bottom_border_color != '0' ){
		$met_options['sticky_header_bottom_border']['border-color'] = $mb_sticky_header_bottom_border_color;
	}

	$mb_sticky_header_bottom_border_opacity = rwmb_meta(MET_MB_PREFIX.'sticky_header_bottom_border_opacity');
	if( !empty($mb_sticky_header_bottom_border_opacity) AND $mb_sticky_header_bottom_border_opacity != '0' ){
		$met_options['sticky_header_bottom_border_opacity'] = $mb_sticky_header_bottom_border_opacity;
	}
}

/*=========================
=     SIDENAV OPTIONS     =
=========================*/
if($custom_sidenav_options_status){
	/* ### - Sidenav Visibility - ### */
	$mb_page_sidenav_status = rwmb_meta(MET_MB_PREFIX.'sidenav_status');
	if(!empty($mb_page_sidenav_status) AND $mb_page_sidenav_status != '0'){
		$met_options['sidenav_status'] = (bool) str_replace($mb_bool,$op_bool,$mb_page_sidenav_status);
	}

	/* ### - Sidenav Position - ### */
	$mb_page_sidenav_position = rwmb_meta(MET_MB_PREFIX.'sidenav_position');
	if(!empty($mb_page_sidenav_position) AND $mb_page_sidenav_position != '0'){
		$met_options['sidenav_position'] = $mb_page_sidenav_position;
	}

	/* ### - Sidenav Menu overwrite - ### */
	$mb_sidenav_menu = rwmb_meta(MET_MB_PREFIX.'sidenav_menu');
	if( !empty($mb_sidenav_menu) AND $mb_sidenav_menu != '0'){
		define('SIDENAV_CUSTOM_MENU', $mb_sidenav_menu);
	}

	/* ### - Sticky Sidenav overwrite - ### */
	$mb_sidenav_sticky = rwmb_meta(MET_MB_PREFIX.'sidenav_sticky');
	if( !empty($mb_sidenav_sticky) AND $mb_sidenav_sticky != '0' ){
		$met_options['sidenav_sticky'] = (bool) str_replace($mb_bool,$op_bool,$mb_sidenav_sticky);
	}

	/* ### - Sidenav Logo - ### */
	$mb_sidenav_logo_status = rwmb_meta(MET_MB_PREFIX.'sidenav_logo_status');
	if( !empty($mb_sidenav_logo_status) AND $mb_sidenav_logo_status != '0' ){
		$met_options['sidenav_logo_status'] = (bool) str_replace($mb_bool, $op_bool, $mb_sidenav_logo_status);
	}

	/* ### - Sidenav Top Bar - ### */
	$mb_sidenav_topbar_status = rwmb_meta(MET_MB_PREFIX.'sidenav_topbar_status');
	if( !empty($mb_sidenav_topbar_status) AND $mb_sidenav_topbar_status != '0' ){
		$met_options['sidenav_topbar_status'] = (bool) str_replace($mb_bool, $op_bool, $mb_sidenav_topbar_status);
	}

	/* ### - Sidenav Second Menu Status - ### */
	$mb_sidenav_secondary_menu_status = rwmb_meta(MET_MB_PREFIX.'sidenav_secondary_menu_status');
	if( !empty($mb_sidenav_secondary_menu_status) AND $mb_sidenav_secondary_menu_status != '0' ){
		$met_options['sidenav_secondary_menu_status'] = (bool) str_replace($mb_bool, $op_bool, $mb_sidenav_secondary_menu_status);
	}

	/* ### - Sidenav Second Menu overwrite - ### */
	$mb_sidenav_second_menu = rwmb_meta(MET_MB_PREFIX.'sidenav_second_menu');
	if( !empty($mb_sidenav_second_menu) AND $mb_sidenav_second_menu != '0'){
		define('SIDENAV_CUSTOM_SECOND_MENU', $mb_sidenav_second_menu);
	}

	/* ### - Sidenav Lang Selector - ### */
	$mb_sidenav_lang_selector = rwmb_meta(MET_MB_PREFIX.'sidenav_lang_selector');
	if( !empty($mb_sidenav_lang_selector) AND $mb_sidenav_lang_selector != '0' ){
		$met_options['sidenav_lang_selector'] = (bool) str_replace($mb_bool, $op_bool, $mb_sidenav_lang_selector);
	}
}

/*============================
=     BACKGROUND OPTIONS     =
============================*/
if($custom_background_options_status){
	//Page boxed layout overwrite
	$mb_page_boxed_layout = rwmb_meta(MET_MB_PREFIX.'page_boxed_layout');
	if(!empty($mb_page_boxed_layout) AND $mb_page_boxed_layout != '0'){
		$met_options['boxed_layout'] = (bool) str_replace($mb_bool,$op_bool,$mb_page_boxed_layout);
	}
}

/*========================
=     FOOTER OPTIONS     =
========================*/
$footer_display_status = true;
$footer_nav_menu = false;

$option_disable_footer = isset( $met_options['disable_footer'] ) ? $met_options['disable_footer'] : true;
if( $option_disable_footer == false ){
    $footer_display_status = false;
}

if($custom_footer_options_status){
	/* ### - Footer Display Status - ### */
	if( rwmb_meta(MET_MB_PREFIX.'disable_footer') == 1 ){
		$footer_display_status = false;
	}

	/* ### - Footer Layout overwrite - ### */
	$mb_footer_layout = rwmb_meta(MET_MB_PREFIX.'footer_layout');
	if( !empty($mb_footer_layout) AND $mb_footer_layout != '0'){
		$met_options['footer_layout'] = $mb_footer_layout;
	}

	/* ### - Footer Menu overwrite - ### */
	$mb_footer_menu = rwmb_meta(MET_MB_PREFIX.'footer_menu');
	if( !empty($mb_footer_menu) AND $mb_footer_menu != '0'){
		$footer_nav_menu = $mb_footer_menu;
	}
}

/*======================================
=     FULLSCREEN SCROLLING OPTIONS     =
======================================*/
$mb_fsc_options = array(
    'fullscreen_scrolling'  => rwmb_meta(MET_MB_PREFIX.'fullscreen_scrolling'),
    'css3'                  => rwmb_meta(MET_MB_PREFIX.'f_css3'),
    'autoScrolling'         => rwmb_meta(MET_MB_PREFIX.'f_auto_scrolling'),
    'scrollingSpeed'        => rwmb_meta(MET_MB_PREFIX.'f_scrolling_speed'),
    'easing'                => rwmb_meta(MET_MB_PREFIX.'f_easing_type'),
    'navigation'            => rwmb_meta(MET_MB_PREFIX.'f_navigation'),
    'navigationPosition'    => rwmb_meta(MET_MB_PREFIX.'f_navigation_position'),
    'slidesNavigation'      => rwmb_meta(MET_MB_PREFIX.'f_slides_navigation'),
    'slidesNavPosition'     => rwmb_meta(MET_MB_PREFIX.'f_slides_navigation_position'),
    'continuousVertical'    => rwmb_meta(MET_MB_PREFIX.'f_continuous_vertical'),
    'loopBottom'            => rwmb_meta(MET_MB_PREFIX.'f_loop_bottom'),
    'loopTop'               => rwmb_meta(MET_MB_PREFIX.'f_loop_top'),
    'loopHorizontal'        => rwmb_meta(MET_MB_PREFIX.'f_loop_horizontal'),
    'scrollOverflow'        => rwmb_meta(MET_MB_PREFIX.'f_scroll_overflow'),
    'keyboardScrolling'     => rwmb_meta(MET_MB_PREFIX.'f_keyboard_scrolling'),
    'touchSensitivity'      => rwmb_meta(MET_MB_PREFIX.'f_touch_sensivity'),
    'fixedElements'         => rwmb_meta(MET_MB_PREFIX.'f_fixed_elements'),
    'videoPlaying'          => rwmb_meta(MET_MB_PREFIX.'f_video_playing'),
);

function full_screen_scrolling_output(){
	global $mb_fsc_options,$dslc_active;

	if( isset($mb_fsc_options) && !empty($mb_fsc_options) && $mb_fsc_options['fullscreen_scrolling'] == 'true' && !$dslc_active ){
		$fsc_options = $mb_fsc_options;
		array_shift($fsc_options);

		if($fsc_options['videoPlaying'] == 'false' || $fsc_options['videoPlaying'] == 'true'){
			$fsc_video_playing = array_pop($fsc_options);
		}else{
			$fsc_video_playing = 'false';
		}

		$fsc_options_obj = '{';

		foreach($fsc_options as $fsc_option => $fsc_options_value):
			$quoteOrNot = $fsc_options_value == 'true' || $fsc_options_value == 'false' || is_numeric($fsc_options_value) ? '' : '"';
			$fsc_options_obj .= $fsc_option.':'.$quoteOrNot.$fsc_options_value.$quoteOrNot.',';
		endforeach;

		$fsc_options_obj = count($fsc_options) > 0 ? substr($fsc_options_obj, 0, -1).'}' : '{}';

		?><script id="fullscreenScrolling">jQuery(document).ready(function(){
				CoreJS.fullscreenScrolling(<?php echo $fsc_options_obj; ?>,<?php echo $fsc_video_playing; ?>);
				if( jQuery(window).width() < 1024 ){
					jQuery('.met_run_animations').addClass('animated').css('visibility','visible');
				}
			});</script><?php
	}
}add_action('wp_footer', 'full_screen_scrolling_output', 998);

/*======================================
=     LOADING SCREEN OPTIONS     =
======================================*/
$mb_pl_options = array(
	'barColor'          => rwmb_meta(MET_MB_PREFIX.'preloader_bar_color'),
	'backgroundColor'   => rwmb_meta(MET_MB_PREFIX.'preloader_bg_color'),
	'percentage'        => rwmb_meta(MET_MB_PREFIX.'preloader_percentage'),
	'barHeight'         => rwmb_meta(MET_MB_PREFIX.'preloader_bar_height'),
	'fadeOutTime'       => rwmb_meta(MET_MB_PREFIX.'preloader_fadeout_time'),
);

function page_preloader_output(){
	global $mb_pl_options,$dslc_active,$custom_preloader_options;

	if( isset($mb_pl_options) && !empty($mb_pl_options['barColor']) && !$dslc_active && $custom_preloader_options ){

		$pl_options = $mb_pl_options;

		$pl_options_obj = '{';

		foreach($pl_options as $pl_option => $pl_option_value):
			$quoteOrNot = $pl_option == 'barColor' || $pl_option == 'backgroundColor' ? '"' : '';
			$pl_options_obj .= $pl_option.':'.$quoteOrNot.$pl_option_value.$quoteOrNot.',';
		endforeach;

		$pl_options_obj .= 'onComplete: function() {CoreJS.wowAnimate("met_run_animations")},';

		$pl_options_obj = count($pl_options) > 0 ? substr($pl_options_obj, 0, -1).'}' : '{}';

		?>
		<script id="pagepreloader">
			window.addEventListener('DOMContentLoaded', function() {
				new QueryLoader2(document.querySelector("body"), <?php echo $pl_options_obj; ?>);
				jQuery('#met_page_pl_overlay').remove();
			});
		</script>
		<?php
	}
}add_action('wp_footer', 'page_preloader_output', 998);

/*======================================
=     PAGE SLIDER SHORTCODE HANDLER     =
======================================*/
function met_page_slider($position = ''){
	$slider_position  = rwmb_meta(MET_MB_PREFIX.'page_slider_position');
	$slider_shortcode = rwmb_meta(MET_MB_PREFIX.'page_slider_shortcode');

	if(empty($slider_position)){
		$slider_position = 'below';
	}

	if(!empty($slider_shortcode) AND $position == $slider_position){
        echo do_shortcode($slider_shortcode);
	}
}

/*==========================================
=     CUSTOM METABOXES HEAD CSS RESULT     =
==========================================*/
function JadeMBStyleOptions (){
	global	$custom_header_options_status,
			$custom_sticky_header_options_status,
			$header_selectors,
			$sticky_header_selectors,
			$custom_background_options_status,
			$met_options,
			$met_dev_log;

	/* ==========================================
	* Background Options: Header, Sticky Header, Body, Content, Footer
	* ==========================================
	* */
	$mb_background_options = array(
		'header' => array(
			'status' 			=> $custom_header_options_status,
			'redux_id'			=> 'header_background',
			'selector'			=> implode(', ',$header_selectors),
			'options' 			=> array(
				'color' 		=> rwmb_meta(MET_MB_PREFIX.'header_background_color'),
				'image' 		=> rwmb_meta(MET_MB_PREFIX.'header_background_image','type=image_advanced'),
				'repeat' 		=> rwmb_meta(MET_MB_PREFIX.'header_background_repeat'),
				'size' 			=> rwmb_meta(MET_MB_PREFIX.'header_background_size'),
				'attachment' 	=> rwmb_meta(MET_MB_PREFIX.'header_background_attachment'),
				'position' 		=> rwmb_meta(MET_MB_PREFIX.'header_background_position')
			),
			'opacity' 			=> array(
				'mb'			=> rwmb_meta(MET_MB_PREFIX.'header_background_color_opacity'),
				'rd'			=> $met_options['header_background_color_opacity']
			),
			'color_status' 		=> rwmb_meta(MET_MB_PREFIX.'header_background_color_status'),
			'opacity_status' 	=> rwmb_meta(MET_MB_PREFIX.'header_background_color_opacity_status'),
			'image_status' 		=> rwmb_meta(MET_MB_PREFIX.'header_background_image_status'),
			'data'				=> array(
				'color' 		=> '',
				'image' 		=> '',
				'repeat' 		=> '',
				'size' 			=> '',
				'attachment' 	=> '',
				'position' 		=> '',
				'opacity'		=> ''
			)
		),
		'sticky_header' => array(
			'status' 			=> $custom_sticky_header_options_status,
			'redux_id'			=> 'sticky_header_background',
			'selector'			=> implode(', ',$sticky_header_selectors),
			'options' 			=> array(
				'color' 		=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_color'),
				'image' 		=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_image','type=image_advanced'),
				'repeat' 		=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_repeat'),
				'size' 			=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_size'),
				'attachment' 	=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_attachment'),
				'position' 		=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_position')
			),
			'opacity' 			=> array(
				'mb'			=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_color_opacity'),
				'rd'			=> $met_options['sticky_header_background_color_opacity']
			),
			'color_status' 		=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_color_status'),
			'opacity_status' 	=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_color_opacity_status'),
			'image_status' 		=> rwmb_meta(MET_MB_PREFIX.'sticky_header_background_image_status'),
			'data'				=> array(
				'color' 		=> '',
				'image' 		=> '',
				'repeat' 		=> '',
				'size' 			=> '',
				'attachment' 	=> '',
				'position' 		=> '',
				'opacity'		=> ''
			)
		),
		'body' => array(
			'status' 			=> $custom_background_options_status,
			'redux_id'			=> 'body_background',
			'selector'			=> 'body',
			'options' 			=> array(
				'color' 		=> rwmb_meta(MET_MB_PREFIX.'page_background_color'),
				'image' 		=> rwmb_meta(MET_MB_PREFIX.'page_background_image', 'type=image_advanced'),
				'repeat' 		=> rwmb_meta(MET_MB_PREFIX.'page_background_repeat'),
				'size' 			=> rwmb_meta(MET_MB_PREFIX.'page_background_size'),
				'attachment' 	=> rwmb_meta(MET_MB_PREFIX.'page_background_attachment'),
				'position' 		=> rwmb_meta(MET_MB_PREFIX.'page_background_position')
			),
			'opacity' 			=> array(
				'mb'			=> rwmb_meta(MET_MB_PREFIX.'page_background_color_opacity'),
				'rd'			=> $met_options['body_background_color_opacity']
			),
			'color_status'		=> rwmb_meta(MET_MB_PREFIX.'page_background_color_status'),
			'opacity_status'	=> rwmb_meta(MET_MB_PREFIX.'page_background_color_opacity_status'),
			'image_status'		=> rwmb_meta(MET_MB_PREFIX.'page_background_image_status'),
			'data'				=> array(
				'color' 		=> '',
				'image' 		=> '',
				'repeat' 		=> '',
				'size' 			=> '',
				'attachment' 	=> '',
				'position' 		=> '',
				'opacity'		=> ''
			)
		),
		'content' => array(
			'status' 			=> $custom_background_options_status,
			'redux_id'			=> 'content_background',
			'selector'			=> '.met_boxed_layout .met_page_wrapper,.met_page_wrapper',
			'options' 			=> array(
				'color' 		=> rwmb_meta(MET_MB_PREFIX.'content_background_color'),
				'image' 		=> rwmb_meta(MET_MB_PREFIX.'content_background_image','type=image_advanced'),
				'repeat' 		=> rwmb_meta(MET_MB_PREFIX.'content_background_repeat'),
				'size' 			=> rwmb_meta(MET_MB_PREFIX.'content_background_size'),
				'attachment' 	=> rwmb_meta(MET_MB_PREFIX.'content_background_attachment'),
				'position' 		=> rwmb_meta(MET_MB_PREFIX.'content_background_position')
			),
			'opacity' 			=> array(
				'mb'			=> rwmb_meta(MET_MB_PREFIX.'content_background_color_opacity'),
				'rd'			=> $met_options['content_background_color_opacity']
			),
			'color_status'		=> rwmb_meta(MET_MB_PREFIX.'content_background_color_status'),
			'opacity_status'	=> rwmb_meta(MET_MB_PREFIX.'content_background_color_opacity_status'),
			'image_status'		=> rwmb_meta(MET_MB_PREFIX.'content_background_image_status'),
			'data'				=> array(
				'color' 		=> '',
				'image' 		=> '',
				'repeat' 		=> '',
				'size' 			=> '',
				'attachment' 	=> '',
				'position' 		=> '',
				'opacity'		=> ''
			)
		)
	);

	foreach( $mb_background_options as $mb_background_option_id => $mb_background_option_data ){

		foreach( $mb_background_option_data['options'] as $mb_background_option_o => $mb_background_option_v ){

			if( $mb_background_option_o == 'image' ){

				if( !empty($mb_background_option_v) AND $mb_background_option_data['image_status'] == 1 AND $mb_background_option_data['status'] === true ){
					$mb_background_options[$mb_background_option_id]['data']['image'] = "url('".$mb_background_option_v[key($mb_background_option_v)]['full_url']."')";
				}else if( !empty($met_options[$mb_background_option_data['redux_id']]['background-image']) ){
					$mb_background_options[$mb_background_option_id]['data']['image'] = "url('".$met_options[$mb_background_option_data['redux_id']]['background-image']."')";
				}

			}else if($mb_background_option_o == 'color'){

				if( $mb_background_option_data['opacity_status'] == 1 ){
					$mb_background_options[$mb_background_option_id]['data']['opacity'] = $mb_background_option_data['opacity']['mb'];
				}else{
					$mb_background_options[$mb_background_option_id]['data']['opacity'] = $mb_background_option_data['opacity']['rd'];
				}

				if( !empty($mb_background_option_v) AND $mb_background_option_data['color_status'] == 1 AND $mb_background_option_data['status'] === true ){
					$hexed_2_rgb = hex2rgb($mb_background_option_v);
					$mb_background_options[$mb_background_option_id]['data']['color'] = "rgba(".$hexed_2_rgb.','.$mb_background_options[$mb_background_option_id]['data']['opacity'].")";
				}else if( !empty($met_options[$mb_background_option_data['redux_id']]['background-color']) ){
					$hexed_2_rgb = hex2rgb($met_options[$mb_background_option_data['redux_id']]['background-color']);
					$mb_background_options[$mb_background_option_id]['data']['color'] = "rgba(".$hexed_2_rgb.','.$mb_background_options[$mb_background_option_id]['data']['opacity'].")";
				}

			}else if($mb_background_option_o == 'repeat' || $mb_background_option_o == 'size' || $mb_background_option_o == 'attachment' || $mb_background_option_o == 'position'){

				if( !empty($mb_background_option_v) AND $mb_background_option_data['status'] === true ){
					$mb_background_options[$mb_background_option_id]['data'][$mb_background_option_o] = $mb_background_option_v;
				}else if( !empty($met_options[$mb_background_option_data['redux_id']]['background-'.$mb_background_option_o]) ){
					$mb_background_options[$mb_background_option_id]['data'][$mb_background_option_o] = $met_options[$mb_background_option_data['redux_id']]['background-'.$mb_background_option_o];
				}

			}
		}

	}

	foreach( $mb_background_options as $mb_background_option_section_id => $mb_background_option_section_data ){
		$mb_background_current_selector = $mb_background_option_section_data['selector'];
		unset($mb_background_option_section_data['data']['opacity']);

		foreach( $mb_background_option_section_data['data'] as $mb_background_option_section_prop => $mb_background_option_section_val ){
			if( !empty($mb_background_option_section_val) ){
				$section_css_output[$mb_background_option_section_id][] = 'background-'.$mb_background_option_section_prop.': '.$mb_background_option_section_val;
			}
		}

		if( isset($section_css_output[$mb_background_option_section_id]) AND is_array( $section_css_output[$mb_background_option_section_id] ) ){
			$customCodes[] = $mb_background_current_selector.'{'.implode(';', $section_css_output[$mb_background_option_section_id]).'}';
		}
	}


    /* ==========================================
    * Background Paddings: Body, Content
    * ==========================================
    * */
    $background_paddings = array(
        'body'      => array('top', 'bottom'),
        'content'   => array('top', 'bottom', 'left', 'right')
    );
    $background_padding_output = array('body' => '', 'content' => '');
    $background_padding_values = array('body' => $background_paddings['content'], 'content' => $background_paddings['content']);

    foreach($background_paddings as $background_padding_area => $background_padding_sides){
        foreach($background_padding_sides as $background_padding_side){

            $current_padding_area = rwmb_meta(MET_MB_PREFIX.$background_padding_area.'_padding_'.$background_padding_side);
            if( !is_numeric($current_padding_area) || !$custom_background_options_status ){
                $current_padding_area = isset($met_options[$background_padding_area.'_spacing']) ? $met_options[$background_padding_area.'_spacing'] : array();

                if( isset($current_padding_area['padding-'.$background_padding_side]) )
                    $current_padding_area = str_replace('px','',$current_padding_area['padding-'.$background_padding_side]);
            }

            if( is_numeric($current_padding_area) || !empty($current_padding_area) )
                $background_padding_output[$background_padding_area] .= 'padding-'.$background_padding_side.': '.$current_padding_area.'px;';

            $background_padding_values[$background_padding_area][$background_padding_side] = $current_padding_area;
        }
    }

    if( !empty($background_padding_output['body']) )
        $customCodes[] = 'body{'.$background_padding_output['body'].'}';

    if( !empty($background_padding_output['content']) ){
        $customCodes[] = '.met_boxed_layout .met_page_wrapper{'.$background_padding_output['content'].'}';
        $is_page_boxed = rwmb_meta(MET_MB_PREFIX.'page_boxed_layout');

        if( ( $custom_background_options_status && $is_page_boxed ) || ( !$custom_background_options_status && $met_options['boxed_layout'] || ( $is_page_boxed == '0' && $met_options['boxed_layout'] ) ) ){
            if( empty($background_padding_values['content']['left']) ) $background_padding_values['content']['left'] = 30;
            if( empty($background_padding_values['content']['right']) ) $background_padding_values['content']['right'] = 30;

            $customCodes[] = '.met_boxed_layout .dslc-modules-section.dslc-full{padding-left: '.$background_padding_values['content']['left'].'px; padding-right: '.$background_padding_values['content']['right'].'px;margin-left: -'.($background_padding_values['content']['left']).'px;margin-right: -'.($background_padding_values['content']['right']).'px;}';

            $customCodes[] = '.met_boxed_layout .dslc-modules-section.dslc-full.no-bg{padding-left: '.$background_padding_values['content']['left'].'px;padding-right: '.$background_padding_values['content']['right'].'px;margin-left: -'.($background_padding_values['content']['left']*2).'px;margin-right: -'.($background_padding_values['content']['right']*2).'px;}';
        }

    }

	/* ==========================================
	 * Addinational Custom CSS Codes
	 * ==========================================
	 * */
	$customCodes[] = rwmb_meta(MET_MB_PREFIX.'custom_css');

	/* ==========================================
	 * Print final result via wp_head action
	 * ==========================================
	 * */
	$customStyleResult = implode('', $customCodes);
	echo "\r\n\r\n";
	echo '<style type="text/css" class="metabox-options-output">'.trim($customStyleResult).'</style>';
	echo "\r\n";

	$met_dev_log['metabox_handler_css'] = $customCodes;
}add_action('wp_head', 'JadeMBStyleOptions', 998);