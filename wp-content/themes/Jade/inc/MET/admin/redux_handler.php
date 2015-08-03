<?php
function JadeCustomStyleOptions (){
	global $met_options,$header_selectors,$sticky_header_selectors, $met_dev_log;

	/* ==========================================
	 * Header Border/Seperator Styling
	 * ==========================================
	 * */

	$header_border = met_option('header_borders');
	$header_border_width = $header_border['border-top'];
	$header_border_opacity = met_option('header_borders_opacity');

	if( !empty($header_border['border-color']) ){
		$header_border['border-color'] = 'rgba('.hex2rgb($header_border['border-color']).','.$header_border_opacity.')';
	}

	$header_bottom_border = met_option('header_bottom_border');
	$header_bottom_border_width = $header_bottom_border['border-bottom'];
	$header_bottom_border_opacity = met_option('header_bottom_border_opacity');

	if( !empty($header_bottom_border['border-color']) ){
		$header_bottom_border['border-color'] = 'rgba('.hex2rgb($header_bottom_border['border-color']).','.$header_bottom_border_opacity.')';
	}

	/* ### - Header Seperators - ### */
	$header_seperators = array(
		'.met_logo' 							=> 'border-right',
		'.met_header_box_right' 				=> 'border-left',
		'.met_header_wrap .met_header_search' 	=> 'border-left',
		'.met_header_language' 					=> 'border-left',
	);

	if(met_option('boxed_layout')){
		$header_seperators['.met_header_bar .met_content'] = 'border-bottom';

		if(met_option('header_layout') == 4){
			$header_seperators['.met_header_id_4 nav.met_content'] = 'border-top';
		}
	}else{
		$header_seperators['.met_header_bar'] = 'border-bottom';

		if(met_option('header_layout') == 4){
			$header_seperators['.met_header_id_4_bottom_wrap'] = 'border-top';
			$header_seperators['.met_header_id_4 .met_primary_nav > li:first-child > a > span'] = 'border-left';
			$header_seperators['.met_header_id_4 .met_header_language'] = 'border-right';
		}
	}

	if(met_option('header_layout') == 4){
		$header_seperators['.met_header_id_4 .met_primary_nav > li > a > span'] = 'border-right';
	}

	if(met_option('header_layout') == 2){
		$header_seperators['.met_header_id_2 .met_primary_nav'] = 'border';
	}

	/* ### - Sticky Header Seperators - ### */
	$sticky_header_seperators = array(
		'.met_sticky_header .met_header_search' => 'border-left',
		'.met_sticky_header .met_header_menu.met_primary_nav > li.menu-item' => 'border-right',
		'.met_sticky_header .met_primary_nav > li:first-child' => 'border-left',
	);

	if( met_option('sticky_header') ){
		$sticky_header_border = met_option('sticky_header_borders');
		$sticky_header_border_width = $sticky_header_border['border-top'];
		$sticky_header_border_opacity = met_option('sticky_header_borders_opacity');

		if( !empty($sticky_header_border['border-color']) ){
			$sticky_header_border['border-color'] = 'rgba('.hex2rgb($sticky_header_border['border-color']).','.$sticky_header_border_opacity.')';
		}

		if(met_option('sticky_header_borders_is_same')){
			$header_seperators = array_merge($header_seperators, $sticky_header_seperators);
		}else{
			foreach($sticky_header_seperators as $sticky_header_seperator_selector => $sticky_header_seperator_pos){
				$customCodes[] = $sticky_header_seperator_selector.' {'.$sticky_header_seperator_pos.': '.$sticky_header_border_width.' '.$sticky_header_border['border-style'].' '.$sticky_header_border['border-color'].'}';
			}
		}

		/* ### - Sticky Header Bottom Border - ### */
		if(met_option('sticky_header_bottom_border_is_same')){
			$sticky_header_bottom_border = $header_bottom_border;
			$sticky_header_bottom_border_width = $header_bottom_border_width;
			$sticky_header_bottom_border_opacity = $header_bottom_border_opacity;
		}else{
			$sticky_header_bottom_border = met_option('sticky_header_bottom_border');
			$sticky_header_bottom_border_width = $sticky_header_bottom_border['border-bottom'];
			$sticky_header_bottom_border_opacity = met_option('sticky_header_bottom_border_opacity');
		}

		if( !empty($sticky_header_bottom_border['border-color']) ){
			$sticky_header_bottom_border['border-color'] = 'rgba('.hex2rgb($sticky_header_bottom_border['border-color']).','.$sticky_header_bottom_border_opacity.')';
		}

        if(met_option('boxed_layout')){
            $customCodes[] = '.met_boxed_layout .met_sticky_header > .met_content {border-bottom: '.$sticky_header_bottom_border_width.' '.$sticky_header_bottom_border['border-style'].' '.$sticky_header_bottom_border['border-color'].'}';
        }else{
            $customCodes[] = '.met_sticky_header {border-bottom: '.$sticky_header_bottom_border_width.' '.$sticky_header_bottom_border['border-style'].' '.$sticky_header_bottom_border['border-color'].'}';
        }

	}

	/* ### - Prepare Header Seperators CSS Output - ### */
	foreach($header_seperators as $header_seperator_selector => $header_seperator_pos){
		$customCodes[] = $header_seperator_selector.' {'.$header_seperator_pos.': '.$header_border_width.' '.$header_border['border-style'].' '.$header_border['border-color'].'}';
	}

	/* ### - Header Bottom Border - ### */
	if(met_option('boxed_layout')){

		if(met_option('header_layout') == 4){
			$customCodes[] = '.met_header_id_4 nav.met_content {border-bottom: '.$header_bottom_border_width.' '.$header_bottom_border['border-style'].' '.$header_bottom_border['border-color'].'}';
		}else{
			$customCodes[] = '.met_header_wrap header.met_content {border-bottom: '.$header_bottom_border_width.' '.$header_bottom_border['border-style'].' '.$header_bottom_border['border-color'].'}';
		}

	}else{
		$customCodes[] = '.met_header_wrap {border-bottom: '.$header_bottom_border_width.' '.$header_bottom_border['border-style'].' '.$header_bottom_border['border-color'].'}';
	}

	/* - ############################################################ - */





	/* ==========================================
	 * Logo Styling
	 * ==========================================
	 * */

	/* ### - Logo Height - ### */
	$customCodes[] = '.met_header_wrap .met_logo img {height: '.$met_options['logo_height']['height'].'}';

	/* ### - Logo Paddings - ### */
	$customCodes[] = '.met_header_wrap .met_logo {padding: '.$met_options['logo_spacing']['padding-top'].' '.$met_options['logo_spacing']['padding-right'].' '.$met_options['logo_spacing']['padding-bottom'].' '.$met_options['logo_spacing']['padding-left'].'}';

	/* ### - Logo Text Color - ### */
	if( isset($met_options['logo_text_style']['color']) AND !empty($met_options['logo_text_style']['color']) ) $customCodes[] = '.met_header_wrap .met_logo span {color: '.$met_options['logo_text_style']['color'].'}';

	/* ### - Logo Text Color - ### */
	if( isset($met_options['logo_text_style']['font-size']) AND !empty($met_options['logo_text_style']['font-size']) ) $customCodes[] = '.met_header_wrap .met_logo span {font-size: '.$met_options['logo_text_style']['font-size'].'}';

	/* ==========================================
	 * Sticky Logo Styling
	 * ==========================================
	 * */

	if($met_options['sticky_logo_options']):
		/* ### - Sticky Logo Height - ### */
		$customCodes[] = '.met_sticky_header .met_logo img {height: '.$met_options['sticky_logo_height']['height'].'}';

		/* ### - Sticky Logo Paddings - ### */
		$customCodes[] = '.met_sticky_header .met_logo {padding: '.$met_options['sticky_logo_spacing']['padding-top'].' '.$met_options['sticky_logo_spacing']['padding-right'].' '.$met_options['sticky_logo_spacing']['padding-bottom'].' '.$met_options['sticky_logo_spacing']['padding-left'].'}';

		/* ### - Sticky Logo Text Color - ### */
		if( isset($met_options['sticky_logo_text_style']['color']) AND !empty($met_options['sticky_logo_text_style']['color']) ) $customCodes[] = '.met_sticky_header .met_logo span {color: '.$met_options['sticky_logo_text_style']['color'].'}';

		/* ### - Sticky Logo Text Size - ### */
		if( isset($met_options['sticky_logo_text_style']['font-size']) AND !empty($met_options['sticky_logo_text_style']['font-size']) ) $customCodes[] = '.met_sticky_header .met_logo span {font-size: '.$met_options['sticky_logo_text_style']['font-size'].'}';
	endif;
	/* - ############################################################ - */





	/* ==========================================
	* Primary Menu "Link" Styling
	* ==========================================
	* */
	$primary_nav_text_color = $met_options['primary_nav_text_color'];
	$current_parent_active_selectors = array(
		'.met_primary_nav.met_header_menu > li.menu-item.current-menu-item > a.menu-link',
		'.met_primary_nav.met_header_menu > li.menu-item.current_page_parent > a.menu-link',
		'.met_primary_nav.met_header_menu > li.menu-item.current-menu-parent > a.menu-link',
		'.met_primary_nav.met_header_menu > li.menu-item.current-menu-ancestor > a.menu-link'
	);

	if(!empty($primary_nav_text_color['regular'])){
		$customCodes[] = '.met_primary_nav.met_header_menu > li.menu-item > a.menu-link {color: '.$primary_nav_text_color['regular'].'}';
	}

	if(!empty($primary_nav_text_color['hover'])){
		$customCodes[] = '.met_primary_nav.met_header_menu > li.menu-item:hover > a.menu-link {color: '.$primary_nav_text_color['hover'].'}';
	}

	if(!empty($primary_nav_text_color['active'])){
		$customCodes[] = implode(', ',$current_parent_active_selectors).' {color: '.$primary_nav_text_color['active'].'}';
	}

	/* ==========================================
	* Primary Menu "Link Background" Styling
	* ==========================================
	* */
	$primary_nav_bg_color = $met_options['primary_nav_bg_color'];

	if(!empty($primary_nav_bg_color['regular'])){
		$customCodes[] = '.met_primary_nav.met_header_menu > li.menu-item > a.menu-link {background-color: rgba('.hex2rgb($primary_nav_bg_color['regular']).','.$met_options['primary_nav_bg_color_opacity'].')}';
	}

	if(!empty($primary_nav_bg_color['hover'])){
		$customCodes[] = '.met_primary_nav.met_header_menu > li.menu-item:hover > a.menu-link {background-color: rgba('.hex2rgb($primary_nav_bg_color['hover']).','.$met_options['primary_nav_bg_color_opacity'].')}';
	}

	if(!empty($primary_nav_bg_color['active'])){
		$customCodes[] = implode(', ',$current_parent_active_selectors).'{background-color: rgba('.hex2rgb($primary_nav_bg_color['active']).','.$met_options['primary_nav_bg_color_opacity'].')}';
	}

	/* ==========================================
	* Primary Menu "Dropdown" Styling
	* ==========================================
	* */
	$primary_nav_dropdown_text_color = $met_options['primary_nav_dropdown_text_color'];
	$current_parent_active_selectors = array(
		'.met_primary_nav.met_header_menu > li.menu-item ul li.menu-item.current-menu-item > a.menu-link:not(.mmm_highlight_label)',
		'.met_primary_nav.met_header_menu > li.menu-item ul li.menu-item.current_page_parent > a.menu-link:not(.mmm_highlight_label)',
		'.met_primary_nav.met_header_menu > li.menu-item ul li.menu-item.current-menu-parent > a.menu-link:not(.mmm_highlight_label)'
	);

	if(!empty($primary_nav_dropdown_text_color['regular'])){
		$customCodes[] = '.met_primary_nav.met_header_menu li.menu-item li.menu-item > a.menu-link {color: '.$primary_nav_dropdown_text_color['regular'].'}';
	}

	if(!empty($primary_nav_dropdown_text_color['hover'])){
		$customCodes[] = '.met_primary_nav.met_header_menu li.menu-item li.menu-item:hover > a.menu-link {color: '.$primary_nav_dropdown_text_color['hover'].'}';
	}

	if(!empty($primary_nav_dropdown_text_color['active'])){
		$customCodes[] = implode(', ',$current_parent_active_selectors).' {color: '.$primary_nav_dropdown_text_color['active'].'}';
	}

	/* ==========================================
	* Primary Menu "Dropdown" Background Styling
	* ==========================================
	* */
	$primary_nav_dropdown_bg_color = $met_options['primary_nav_dropdown_item_bg_color'];
	$current_parent_active_selectors = array(
		'.met_primary_nav.met_header_menu li.menu-item li.menu-item.current-menu-item > a.menu-link',
		'.met_primary_nav.met_header_menu li.menu-item li.menu-item.current_page_parent > a.menu-link',
		'.met_primary_nav.met_header_menu li.menu-item li.menu-item.current-menu-parent > a.menu-link:not(.mmm_highlight_label)'
	);

	if(!empty($primary_nav_dropdown_bg_color['regular'])){
		$customCodes[] = '.met_primary_nav.met_header_menu li.menu-item li.menu-item > a.menu-link {background-color: rgba('.hex2rgb($primary_nav_dropdown_bg_color['regular']).','.$met_options['primary_nav_dropdown_item_bg_color_opacity'].')}';
	}

	if(!empty($primary_nav_dropdown_bg_color['hover'])){
		$customCodes[] = '.met_primary_nav.met_header_menu li.menu-item li.menu-item:not(.current-menu-item):hover > a.menu-link {background-color: rgba('.hex2rgb($primary_nav_dropdown_bg_color['hover']).','.$met_options['primary_nav_dropdown_item_bg_color_opacity'].')}';
	}

	if(!empty($primary_nav_dropdown_bg_color['active'])){
		$customCodes[] = implode(', ',$current_parent_active_selectors).' {background-color: rgba('.hex2rgb($primary_nav_dropdown_bg_color['active']).','.$met_options['primary_nav_dropdown_item_bg_color_opacity'].')}';
	}

	/* - ############################################################ - */





	/* ==========================================
	 * MC Mega Menu Icon Visibility Options
	 * ==========================================
	 * */
	$primary_nav_dropdown_item_arrow = $met_options['mmm_sub_level_icon_status'];
	if(!empty($primary_nav_dropdown_item_arrow)){
		switch($primary_nav_dropdown_item_arrow){
			case 'none':
				$customCodes[] = '.met_primary_nav > li.menu-item ul a.menu-link .met-menu-icon.mmm-icon-default{display: none;}';
				break;
			case 'inline-block':
				$customCodes[] = '.met_primary_nav > li.menu-item ul a.menu-link .met-menu-icon.mmm-icon-default{display: inline-block;}';
				break;
			case 'displaychild':
				$customCodes[] = '.met_primary_nav > li.menu-item ul a.menu-link .met-menu-icon.mmm-icon-default{display: none;}';
				$customCodes[] = '.met_primary_nav > li.menu-item ul li.menu-item.menu-item-has-children > a.menu-link > .met-menu-icon.mmm-icon-default{display: inline-block;}';
				break;
		}
	}

	/* - ############################################################ - */





	/* ==========================================
	 * Side Navbar Styling
	 * ==========================================
	 * */

	/* ### - SideNav | Max Width - ### */
	$customCodes[] = implode(' ,',array(
			'.met_side_navbar .met_primary_nav li.menu-item.menu-item.met_primary_nav_mega > ul',
			'.met_side_navbar .met_primary_nav li.menu-item.menu-item.met_primary_nav_posts > ul',
			'.met_side_navbar .met_primary_nav li.menu-item.menu-item.met_primary_nav_mega_posts > ul'
		)).' {max-width: '.$met_options['sidenav_sub_menu_max_width']['width'].'}';

	/* ### - SideNav | Background RGBA - ### */
	if(isset($met_options['sidenav_background']['background-color']) AND $met_options['sidenav_background_color_opacity'] !='1.00') $customCodes[] = '.met_side_navbar_wrap {background-color: rgba('.hex2rgb($met_options['sidenav_background']['background-color']).','.$met_options['sidenav_background_color_opacity'].')}';

	/* ### - SideNav | Outside Border - ### */
	$sidenav_border = met_option('sidenav_outside_border');
	$sidenav_border_width = $sidenav_border['border-top'];
	if($met_options['sidenav_position'] == 'left'){
		$customCodes[] = '.met_side_navbar_left .met_side_navbar_wrap {border-right: '.$sidenav_border_width.' '.$sidenav_border['border-style'].' '.$sidenav_border['border-color'].'}';
	}else{
		$customCodes[] = '.met_side_navbar_right .met_side_navbar_wrap {border-left: '.$sidenav_border_width.' '.$sidenav_border['border-style'].' '.$sidenav_border['border-color'].'}';
	}


	/* ==========================================
	 * Side Navbar Main Navigation Styling
	 * ==========================================
	 * */

	/* ### - SideNav | Link Colors - ### */
	$sidenav_menu_text_color = $met_options['sidenav_menu_text_color'];
	$current_parent_active_selectors = array(
		'.met_side_navbar .met_primary_nav > li.menu-item.current-menu-item > a.menu-link',
		'.met_side_navbar .met_primary_nav > li.menu-item.current_page_parent > a.menu-link',
		'.met_side_navbar .met_primary_nav > li.menu-item.current-menu-parent > a.menu-link',
		'.met_side_navbar .met_primary_nav > li.menu-item.current-menu-ancestor > a.menu-link'
	);

	if(!empty($sidenav_menu_text_color['regular'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav > li.menu-item > a.menu-link {color: '.$sidenav_menu_text_color['regular'].'}';
	}

	if(!empty($sidenav_menu_text_color['hover'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav > li.menu-item:hover > a.menu-link {color: '.$sidenav_menu_text_color['hover'].'}';
	}

	if(!empty($sidenav_menu_text_color['active'])){
		$customCodes[] = implode(', ',$current_parent_active_selectors).' {color: '.$sidenav_menu_text_color['active'].'}';
	}

	/* ### - SideNav | Link Background Colors - ### */
	$sidenav_menu_bg_color = $met_options['sidenav_menu_bg_color'];

	if(!empty($sidenav_menu_bg_color['regular'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav > li.menu-item > a.menu-link {background-color: rgba('.hex2rgb($sidenav_menu_bg_color['regular']).','.$met_options['sidenav_menu_bg_opacity'].')}';
	}

	if(!empty($sidenav_menu_bg_color['hover'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav > li.menu-item:hover > a.menu-link {background-color: rgba('.hex2rgb($sidenav_menu_bg_color['hover']).','.$met_options['sidenav_menu_bg_opacity'].')}';
	}

	if(!empty($sidenav_menu_bg_color['active'])){
		$customCodes[] = implode(', ',$current_parent_active_selectors).'{background-color: rgba('.hex2rgb($sidenav_menu_bg_color['active']).','.$met_options['sidenav_menu_bg_opacity'].')}';
	}

	/* ### - SideNav | Sub Level | Link Colors - ### */
	$sidenav_menu_dropdown_text_color = $met_options['sidenav_menu_dropdown_text_color'];
	$current_dropdown_active_selectors = array(
		'.met_side_navbar .met_primary_nav > li.menu-item ul li.menu-item.current_page_item > a.menu-link:not(.mmm_highlight_label)',
		'.met_side_navbar .met_primary_nav > li.menu-item ul li.menu-item.current-menu-item > a.menu-link:not(.mmm_highlight_label)',
		'.met_side_navbar .met_primary_nav > li.menu-item ul li.menu-item.current_page_parent > a.menu-link:not(.mmm_highlight_label)',
		'.met_side_navbar .met_primary_nav > li.menu-item ul li.menu-item.current-menu-parent > a.menu-link:not(.mmm_highlight_label)',
	);

	if(!empty($sidenav_menu_dropdown_text_color['regular'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav li.menu-item li.menu-item > a.menu-link {color: '.$sidenav_menu_dropdown_text_color['regular'].'}';
	}

	if(!empty($sidenav_menu_dropdown_text_color['hover'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav li.menu-item li.menu-item:hover > a.menu-link {color: '.$sidenav_menu_dropdown_text_color['hover'].'}';
	}

	if(!empty($sidenav_menu_dropdown_text_color['active'])){
		$customCodes[] = implode(', ',$current_dropdown_active_selectors).' {color: '.$sidenav_menu_dropdown_text_color['active'].'}';
	}

	/* ### - SideNav | Sub Level | Link Background Colors - ### */
	$sidenav_menu_dropdown_bg_color = $met_options['sidenav_menu_dropdown_bg_color'];

	if(!empty($sidenav_menu_dropdown_bg_color['regular'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav li.menu-item li.menu-item > a.menu-link {background-color: '.$sidenav_menu_dropdown_bg_color['regular'].'}';
	}

	if(!empty($sidenav_menu_dropdown_bg_color['hover'])){
		$customCodes[] = '.met_side_navbar .met_primary_nav li.menu-item li.menu-item:not(.current-menu-item):hover > a.menu-link {background-color: '.$sidenav_menu_dropdown_bg_color['hover'].'}';
	}

	if(!empty($sidenav_menu_dropdown_bg_color['active'])){
		$customCodes[] = implode(', ',$current_dropdown_active_selectors).'{background-color: '.$sidenav_menu_dropdown_bg_color['active'].'}';
	}

	/* - ############################################################ - */





	/* ==========================================
	 * Page Information Bar
	 * ==========================================
	 * */

	if(!met_option('pib_title_arrow')){
		$customCodes[] = '.met_page_head h1:after {display:none}';
	}else{
		$pib_title_arrow_color = met_option('pib_title_arrow_color');
		$pib_title_arrow_top = met_option('pib_title_arrow_top');

		if( !empty($pib_title_arrow_color) ) $customCodes[] = '.met_page_head h1:after{border-color: transparent transparent transparent '.met_option('pib_title_arrow_color').'}';
		if( !empty($pib_title_arrow_top) ) $customCodes[] = '.met_page_head h1:after{top: '.$pib_title_arrow_top.'px}';
	}

	/* - ############################################################ - */





	/* ==========================================
	 * Footer
	 * ==========================================
	 * */

	/* ### - LAYOUT 1 - Link Colors - ### */
	$footer_link_color = met_option('footer_link_color');
	if(isset($footer_link_color['hover'])) $customCodes[] = '.footer .met_color_transition2:hover {color: '.$footer_link_color['hover'].' !important}';

	/* ### - LAYOUT 1 - Footer Background with Opacity - ### */
	if(isset($met_options['footer_background']['background-color']) AND $met_options['footer_background_color_opacity'] !='1.0') $customCodes[] = '.footer {background-color: rgba('.hex2rgb($met_options['footer_background']['background-color']).','.$met_options['footer_background_color_opacity'].')}.met_boxed_layout .met_page_wrapper + .footer_wrap{background-color: transparent;}';

	/* ### - LAYOUT 2 - Footer Background with Opacity - ### */
	if(isset($met_options['footer_layout_2_background']['background-color']) AND $met_options['footer_layout_2_background_color_opacity'] !='1.0') $customCodes[] = '.met_flat_footer .footer {background-color: rgba('.hex2rgb($met_options['footer_layout_2_background']['background-color']).','.$met_options['footer_layout_2_background_color_opacity'].')}';

	/* ### - LAYOUT 2 - Footer Bar Background with Opacity - ### */
	if(isset($met_options['footer_layout_2_bar_background']['background-color']) AND $met_options['footer_layout_2_bar_background_color_opacity'] !='1.0') $customCodes[] = '.met_flat_footer_bar {background-color: rgba('.hex2rgb($met_options['footer_layout_2_bar_background']['background-color']).','.$met_options['footer_layout_2_bar_background_color_opacity'].')}';

	/* ### - LAYOUT 3 - Footer Background with Opacity - ### */
	if(isset($met_options['footer_layout_3_background']['background-color']) AND $met_options['footer_layout_3_background_color_opacity'] !='1.0') $customCodes[] = '.met_onepage_footer .footer {background-color: rgba('.hex2rgb($met_options['footer_layout_3_background']['background-color']).','.$met_options['footer_layout_3_background_color_opacity'].')}';

	/* ### - LAYOUT 4 - Footer Background with Opacity - ### */
	if(isset($met_options['footer_layout_4_background']['background-color']) AND $met_options['footer_layout_4_background_color_opacity'] !='1.0') $customCodes[] = '.met_slim_footer .footer {background-color: rgba('.hex2rgb($met_options['footer_layout_4_background']['background-color']).','.$met_options['footer_layout_4_background_color_opacity'].')}';

	/* - ############################################################ - */






	/* ==========================================
	 * MC Mega Menu
	 * ==========================================
	 * */
	$customCodes[] = '.met_megamenu_post_item {margin: '.$met_options['mmm_posts_item_margin']['margin-top'].' '.$met_options['mmm_posts_item_margin']['margin-right'].' '.$met_options['mmm_posts_item_margin']['margin-bottom'].' '.$met_options['mmm_posts_item_margin']['margin-left'].' !important; }';

	$customCodes[] = '.met_megamenu_tabbed_post_item {margin: '.$met_options['mmm_tabbed_item_margin']['margin-top'].' '.$met_options['mmm_tabbed_item_margin']['margin-right'].' '.$met_options['mmm_tabbed_item_margin']['margin-bottom'].' '.$met_options['mmm_tabbed_item_margin']['margin-left'].' !important; }';

	$customCodes[] = '.met_megamenu_advanced_content {padding: '.$met_options['mmm_advanced_content_padding']['padding-top'].' '.$met_options['mmm_advanced_content_padding']['padding-right'].' '.$met_options['mmm_advanced_content_padding']['padding-bottom'].' '.$met_options['mmm_advanced_content_padding']['padding-left'].' !important; }';

	/* - ############################################################ - */




	/* ==========================================
	 * Core Styling (Accent Colors)
	 * ==========================================
	 * */
	$core_style_defaults = array(
		'met_color' => '#ffca07',
		'met_color2' => '#9f4641',
		'met_bgcolor' => '#ffca07',
		'met_bgcolor2' => '#9f4641',
		'met_hover_color' => '#ffca07',
		'met_color_transition' => '#ffca07',
		'met_color_transition2' => '#9f4641',
		'content_bgcolor' => '#efeee9',
		'selection_color' => '#ffffff',
		'selection_background' => '#ffca07',
	);

	$core_style_selectors = array(
		/* ==========================================
		 * Primary Color 1
		 * ==========================================
		 * */
		'met_color' => array(
			
			/* ### - Border - ### */
			'border-color' => array(
				'.met_ghost_button',
				'.met_footer_feedback + div.wpcf7-validation-errors',
				'.met_gallery_thumb_grid_2 .met_gallery_thumb_grid li:hover',
				'.met_gallery_thumb_grid_2 .met_gallery_thumb_grid .activeItem',
				'.met_parallax_contact_form_row:hover',
				'.met_blog_module_item_helper_icon',
				'.met_accordion_group.transparent .met_accordion.on .met_accordion_title',
			),

			/* ### - Border Bottom - ### */
			'border-bottom-color' => array(
				'.met_teamlist_member .met_teamlist_member_overlay:after'
			),
			
			/* ### - Border Left - ### */
			'border-left-color' => array(
				'.met_portfolio_filters_wrap:after'
			),
			
			/* ### - Border Right - ### */
			'border-right-color' => array(
				'.met_custom_clean_menu li.current_page_item'
			),
			
			/* ### - Color - ### */
			'color' => array(
				'.met_color',
				'a',
				'.met_ghost_button',
				'.met_accordion_title:hover',
				'.met_accordion:not(.on) .met_accordion_title:hover:before',
				'.transparent .on .met_accordion_title:before',
				'.cubic .met_accordion_title:before',
				'.met_blog_block_quote:before', '.met_blog_block_quote:after',
				'.met_parallax_contact_form_row .wpcf7-text:focus',
				'.met_parallax_contact_form_row .wpcf7-textarea:focus',
				'.met_hotel_availability_wrap + .wpcf7-validation-errors',
				'.met_sidebar_box.woocommerce.widget_product_categories .children a:before',
				
				#- Input Placeholders
				'.met_parallax_contact_form_row .wpcf7-text:focus::-webkit-input-placeholder',
				'.met_parallax_contact_form_row .wpcf7-textarea:focus::-webkit-input-placeholder',
				'.met_parallax_contact_form_row .wpcf7-text:focus:-moz-placeholder',
				'.met_parallax_contact_form_row .wpcf7-textarea:focus:-moz-placeholder',
				'.met_parallax_contact_form_row .wpcf7-text:focus::-moz-placeholder',
				'.met_parallax_contact_form_row .wpcf7-textarea:focus::-moz-placeholder',
				'.met_parallax_contact_form_row .wpcf7-text:focus::-ms-input-placeholder',
				'.met_parallax_contact_form_row .wpcf7-textarea:focus::-ms-input-placeholder',
			),
		),

		/* ==========================================
		 * Primary "Background" Color 1
		 * ==========================================
		 * */
		'met_bgcolor' => array(
			/* ### - Background Color - ### */
			'background-color' => array(
				'.met_bgcolor',
				'.met_bgcolor_transition:hover',
				'.btn-primary',
				'#met_page_loading_bar',
				'#met_scroll_up:hover',
				'.met_header_id_3 .met_header_search i',
				'.met_accordion_group:not(.transparent) .met_accordion.on .met_accordion_title',
				'.cubic .on .met_accordion_title:before',
				'.met_testimonial_3:after',
				'.met_sidebar_box header.met_bgcolor',
				'.met_pagination.pagination a:hover',
				'.met_pagination.pagination li.active a',
				'.met_portfolio_item_details:after',
				'.met_filters li a.activePortfolio',
				'#wp-calendar caption',
				'.met_info_box_icon_4:hover',
				'.met_content_box_contents_text .met_event_box_remaining figure',
				'.met_alert_2.alert-info',
				'.met_gallery_carousel_2_wrap .prev:hover',
				'.met_gallery_carousel_2_wrap .next:hover',
				'.met_parallax_contact_form_row:hover .met_parallax_contact_form_input_box.half:after',
				'.met_parallax_contact_form_submit_row .wpcf7-form-control.wpcf7-submit:hover',
				'.r-tabs .r-tabs-nav .r-tabs-tab:hover',
				'.r-tabs .r-tabs-nav .r-tabs-tab:hover .r-tabs-anchor',
				'.r-tabs .r-tabs-accordion-title.r-tabs-state-active .r-tabs-anchor',
				'.met_header_id_3 .met_primary_nav > li > a:after',
				'.met_sidebar_box.woocommerce form input[type="submit"]',

				#- WooCommerce
				'.woocommerce nav.woocommerce-pagination ul li span.current',
				'.woocommerce nav.woocommerce-pagination ul li a:hover',
				'.woocommerce nav.woocommerce-pagination ul li a:focus',
				'.woocommerce #content nav.woocommerce-pagination ul li span.current',
				'.woocommerce #content nav.woocommerce-pagination ul li a:hover',
				'.woocommerce #content nav.woocommerce-pagination ul li a:focus',
				'.woocommerce-page nav.woocommerce-pagination ul li span.current',
				'.woocommerce-page nav.woocommerce-pagination ul li a:hover',
				'.woocommerce-page nav.woocommerce-pagination ul li a:focus',
				'.woocommerce-page #content nav.woocommerce-pagination ul li span.current',
				'.woocommerce-page #content nav.woocommerce-pagination ul li a:hover',
				'.woocommerce-page #content nav.woocommerce-pagination ul li a:focus',
				'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
				'.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle',
				'.woocommerce.widget_shopping_cart .buttons a.checkout',
				'.woocommerce .widget_shopping_cart .buttons a.checkout',
				'.woocommerce-page.widget_shopping_cart .buttons a.checkout',
				'.woocommerce-page .widget_shopping_cart .buttons a.checkout',
				'.woocommerce.widget_shopping_cart .buttons a:hover',
				'.woocommerce .widget_shopping_cart .buttons a:hover',
				'.woocommerce-page.widget_shopping_cart .buttons a:hover',
				'.woocommerce-page .widget_shopping_cart .buttons a:hover',
			)
		),

		/* ==========================================
		 * Primary Color 2
		 * ==========================================
		 * */
		'met_color2' => array(
			/* ### - Color - ### */
			'color' => array(
				'.met_color2',
				'.footer a',
				'.footer .met_footer_socials a:hover',
				'.footer .met_footer_menu a:hover',
				'.met_footer_feedback span.wpcf7-not-valid-tip:after',
				'.met_accordion_group.met_accordion_flat .on .met_accordion_title',
				'.met_blog_block_details blockquote',
				'.met_blog_detail blockquote',
				'.met_blog_detail q',
				'.met_parallax_contact_form_wrapper .wpcf7-form-control-wrap span.wpcf7-not-valid-tip:after',
				'.met_hotel_availability_wrap .wpcf7-not-valid-tip',
				'.met_blog_module_item_helper_details .met_about_author h4',
				'.met_blog_module_item_helper_link'
			),
			
			/* ### - Border Color - ### */
			'border-color' => array(
				#- Blockquote
				'.met_blog_block_details blockquote',
				'.met_blog_detail blockquote',
				'.met_blog_detail q',
			)
		),

		/* ==========================================
		 * Primary "Background" Color 2
		 * ==========================================
		 * */
		'met_bgcolor2' => array(
			'background-color' => array(
				'.met_bgcolor2'
			)
		),

		/* ==========================================
		 * Primary "Hover" Color
		 * ==========================================
		 * */
		'met_hover_color' => array(
			'color' => array(
				'a:hover',
				'a:focus'
			)
		),

		/* ==========================================
		 * Primary "Transition" Color 1
		 * ==========================================
		 * */
		'met_color_transition' => array(
			'color' => array(
				'.met_color_transition:hover'
			)
		),

		/* ==========================================
		 * Primary "Transition" Color 2
		 * ==========================================
		 * */
		'met_color_transition2' => array(
			'color' => array(
				'.met_color_transition2:hover'
			)
		),

		/* ==========================================
		 * Content Background Color
		 * ==========================================
		 * */
		'content_bgcolor' => array(
			'background-color' => array(
				'.met_progress_bar.progress',
				'.met_search_results_header',
				'.met_overlay a',
				'.met_hard_line_split',
				'.met_windmill_carousel',
				'.met_subscribe_box',
				'.met_blog_block_tags',
				'.met_blog_block_tag',
				'.met_pagination.pagination a',
				'.met_blog_masonry_item_details',
				'.met_portfolio_item_details',
				'.met_portfolio_item_details_2',
				'.met_portfolio_item_layout_5_details'
			)
		),

		/* ==========================================
		 * Selection Color
		 * ==========================================
		 * */
		'selection_color' => array(
			'color' => array(
				'::selection',
				'::-moz-selection'
			)
		),

		/* ==========================================
		 * Selection Background Color
		 * ==========================================
		 * */
		'selection_background' => array(
			'background-color' => array(
				'::selection',
				'::-moz-selection'
			)
		),
	);

	foreach( $core_style_selectors as $core_style_id => $core_style_props ){

		if( isset($met_options[$core_style_id]) AND ( $met_options[$core_style_id] != $core_style_defaults[$core_style_id] ) ){
			if( is_array($core_style_props) ){
				foreach($core_style_props as $core_style_prop => $core_style_selectors){
					if( !empty($met_options[$core_style_id]) ){
						if( strpos(implode(',',$core_style_selectors),'::') !== false ){
							foreach($core_style_selectors as $core_style_selector){
								$customCodes[] = $core_style_selector.'{'.$core_style_prop.':'.$met_options[$core_style_id].'}';
							}
						}else{
							$customCodes[] = implode(',',$core_style_selectors).'{'.$core_style_prop.':'.$met_options[$core_style_id].'}';
						}

					}
				}
			}

			/* ### - Custom Rules - ### */
			if( !empty($met_options[$core_style_id]) ){

				if( $core_style_id == 'met_color' ){
					$customCodes[] = '#met_page_loading_bar{box-shadow: 0 0 3px 0 '.$met_options[$core_style_id].';}';
					$customCodes[] = '.met_parallax_contact_form_wrapper + div.wpcf7-validation-errors{border-color: rgba('.hex2rgb($met_options[$core_style_id]).',0.7)}';
				}elseif( $core_style_id == 'met_bgcolor' ){
					$customCodes[] = '.met_image_post_2_caption{background-color: rgba('.hex2rgb($met_options[$core_style_id]).',0.8)}';

					$customCodes[] = '.mejs-controls .mejs-time-rail .mejs-time-loaded{background: '.hex2rgb($met_options[$core_style_id]).',0.3 !important;}';
					$customCodes[] = '.mejs-controls .mejs-time-rail .mejs-time-current{background: '.$met_options[$core_style_id].' !important;}';
					$customCodes[] = '.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{background: '.hex2rgb($met_options[$core_style_id]).',0.7 !important;}';

					$customCodes[] = '.met_special_post_detail{background-color: rgba('.hex2rgb($met_options[$core_style_id]).',0.5)}';
				}elseif( $core_style_id == 'met_color2' ){
					$customCodes[] = '.met_footer_feedback input:hover,.met_footer_feedback input:focus,.met_footer_feedback textarea:hover,.met_footer_feedback textarea:focus{border-color: rgba('.hex2rgb($met_options[$core_style_id]).',0.5);}';
				}elseif( $core_style_id == 'met_bgcolor2' ){
					$customCodes[] = '.format-quote .met_special_post_detail{background-color: rgba('.hex2rgb($met_options[$core_style_id]).',0.5);}';
				}

			} // custom rules

		} // theme option != default

	}
	/* - ############################################################ - */
	
	
	
	
	
	/* ==========================================
	* Addinational Custom CSS Codes
	* ==========================================
	* */

	$customCodes[] = met_option('custom_css');

	/* - ############################################################ - */





	/* ==========================================
	 * Print final result via wp_head action
	 * ==========================================
	 * */
	$customStyleResult = implode('',$customCodes);
	echo "\r\n\r\n";
	echo '<style type="text/css" class="addinational-options-output">'.trim($customStyleResult).'</style>';

	$met_dev_log['redux_handler_css'] = $customCodes;
}add_action('wp_head', 'JadeCustomStyleOptions', 997);

/*
function redux_after_complier($options,$css,$sections){
	$compiler_options = array('mmm_posts_item_margin');

	foreach($compiler_options as $compiler_option){
		if( isset($options[$compiler_option]) ){
			$compiler_option_data = get_option_data_by_att($sections,'name', $compiler_option);
			$compiler_option_data = $compiler_option_data[0];
			$compiler_option_selector = implode(', ',$compiler_option_data['compiler']);

			if($compiler_option == 'mmm_posts_item_margin'){
				$css = compiler_append_important($compiler_option_selector, 'margin', $css);
			}
		}
	}

	return $css;
}
add_filter('redux_after_complier','redux_after_complier',10,3);

function get_option_data_by_att($sections,$att, $value){
	global $reduxConfig;
	$value = ( $att == 'name' ) ? $reduxConfig->args['opt_name'].'['.$value.']' : $value;
	return array_deep_search($sections, $att, $value );
}

function array_deep_search($array, $key, $value){
	$results = array();

	if (is_array($array)) {
		if (isset($array[$key]) && $array[$key] == $value) {
			$results[] = $array;
		}

		foreach ($array as $subarray) {
			$results = array_merge($results, array_deep_search($subarray, $key, $value));
		}
	}

	return $results;
}

function compiler_append_important($selector, $prop, $css){
	$pattern = '#(.*)'.$selector.'{(.*)'.$prop.'(.*);(.*)}(.*)#imsU';
	$replacement = '$1'.$selector.'{$2'.$prop.'$3 !important;$4}$5';
	$style_params = preg_replace($pattern, $replacement, $css);
	return $style_params;
}
*/

/* Custom Body Classes */
function met_custom_body_classes($classes) {
    global $mb_fsc_options;

	if( met_option('sidenav_status') && ( !isset($mb_fsc_options) || empty($mb_fsc_options) || $mb_fsc_options['fullscreen_scrolling'] != 'true' ) ) $classes[] = 'met_side_navbar_'.met_option('sidenav_position');

	$classes[] = 'clearfix';

	if(met_option('boxed_layout') ) $classes[] = 'met_boxed_layout';
	return $classes;
}
add_filter('body_class','met_custom_body_classes');
