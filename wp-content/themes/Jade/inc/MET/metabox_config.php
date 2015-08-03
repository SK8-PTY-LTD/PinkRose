<?php
$prefix = MET_MB_PREFIX;

global $meta_boxes;

$meta_boxes = array();
$bool_options = array('true' => __('ON','metcreative'), 'false' => __('OFF','metcreative'));
$bool_wd_options = array('0' => __('Theme Default','metcreative'), 'true' => __('ON','metcreative'), 'false' => __('OFF','metcreative'));

$nav_menus = get_terms('nav_menu');
$nav_menu_data = array('0' => __('Theme Default','metcreative'));
if($nav_menus){
	foreach($nav_menus as $nav_menu){
		$nav_menu_data[$nav_menu->slug] = $nav_menu->name;
	}
}

/*===============================
=     BLOG TEMPLATE OPTIONS     =
===============================*/
$meta_boxes[] = array(
	'id' => 'blog_template_options',
	'title' => 'Blog Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'    => __( 'Posts Per Page', 'metcreative' ),
			'id'      => "{$prefix}blog_query_limit",
			'desc'    => __( '<em>*Default = Settings -> Reading -> Blog pages show at most</em>', 'metcreative' ),
			'type'    => 'number'
		),
		array(
			'name'    => __( 'Categories', 'metcreative' ),
			'id'      => "{$prefix}blog_query_cat",
			'desc'    => __( '<em>*Default all categories will be listed.</em>', 'metcreative' ),
			'type'    => 'taxonomy',
			'options' => array(
				'taxonomy' => 'category',
				'type' => 'checkbox_list',
			),
		),
		array(
			'name'    => __( 'Order By', 'metcreative' ),
			'id'      => "{$prefix}blog_query_orderby",
			'std'     => 'date',
			'type'    => 'select',
			'options' => array(
				'date' 				=> __( 'Publish Date', 'metcreative' ),
				'modified' 			=> __( 'Modified Date', 'metcreative' ),
				'rand' 				=> __( 'Random', 'metcreative' ),
				'title' 			=> __( 'Alphabetic', 'metcreative' ),
				'comment_count' 	=> __( 'Comment Count', 'metcreative' ),
			)
		),
		array(
			'type' => 'heading',
			'name' => __( 'blog layout options', 'metcreative' ),
			'id'   => 'h_blog_layout_options',
		),
		array(
			'name'    	=> __('Blog Sidebar Position', 'metcreative'),
			'id'      	=> "{$prefix}blog_sidebar_position",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> array(
				'0' 		=> __('Theme Default','metcreative'),
				'disable' 	=> __('No Sidebar', 'metcreative'),
				'left' 		=> __('Left', 'metcreative'),
				'right' 	=> __('Right', 'metcreative')
			),
		),
		array(
			'name'    => __('Blog Listing Layout', 'metcreative'),
			'id'       => "{$prefix}blog_listing_layout",
			'type'     => 'radio',
			'options'  => array(
				'0' 		=> __('Theme Default','metcreative'),
				'classic' 	=> __('Classic', 'metcreative'),
				'masonry' 	=> __('Masonry', 'metcreative'),
			),
			'std' => '0'
		),
		array(
			'name'    => __('Masonry Layout Column No', 'metcreative'),
			'id'       => "{$prefix}blog_listing_masonry_column_no",
			'type'     => 'radio',
			'options'  => array(
				'0' 	=> __('Theme Default','metcreative'),
				'1' 	=> __('1 Column', 'metcreative'),
				'2' 	=> __('2 Columns', 'metcreative'),
				'3' 	=> __('3 Columns', 'metcreative'),
				'4' 	=> __('4 Columns', 'metcreative'),
			),
			'std' => '0'
		),
		array(
			'id'       => "{$prefix}blog_pagination_layout",
			'type'     => 'radio',
			'name'     => __('Blog Pagination Layout', 'metcreative'),
			'options'  => array(
				'0'         => __('Theme Default','metcreative'),
				'classic'   => __('Prev/Next', 'metcreative'),
				'numeric'   => __('Numbered', 'metcreative'),
			),
			'std' => '0'
		),
		array(
			'type' => 'heading',
			'name' => __( 'Blog listing animation options', 'metcreative' ),
			'id'   => 'h_blog_anim_options',
		),
		array(
			'name'     => __('Animation Type', 'metcreative'),
			'id'       => "{$prefix}blog_listing_post_animation",
			'type'     => 'select',
			'options'  => array(
				'0'                 => __('Theme Default','metcreative'),
				'none'              => __('None', 'metcreative'),
				'bounce'            => 'bounce',
				'flash'             => 'flash',
				'pulse'             => 'pulse',
				'rubberBand'        => 'rubberBand',
				'shake'             => 'shake',
				'swing'             => 'swing',
				'tada'              => 'tada',
				'wobble'            => 'wobble',
				'bounceIn'          => 'bounceIn',
				'bounceInDown'      => 'bounceInDown',
				'bounceInLeft'      => 'bounceInLeft',
				'bounceInRight'     => 'bounceInRight',
				'bounceInUp'        => 'bounceInUp',
				'fadeIn'            => 'fadeIn',
				'fadeInDown'        => 'fadeInDown',
				'fadeInDownBig'     => 'fadeInDownBig',
				'fadeInLeft'        => 'fadeInLeft',
				'fadeInLeftBig'     => 'fadeInLeftBig',
				'fadeInRight'       => 'fadeInRight',
				'fadeInRightBig'    => 'fadeInRightBig',
				'fadeInUp'          => 'fadeInUp',
				'fadeInUpBig'       => 'fadeInUpBig',
				'flip'              => 'flip',
				'flipInX'           => 'flipInX',
				'flipInY'           => 'flipInY',
				'lightSpeedIn'      => 'lightSpeedIn',
				'rotateIn'          => 'rotateIn',
				'rotateInDownLeft'  => 'rotateInDownLeft',
				'rotateInDownRight' => 'rotateInDownRight',
				'rotateInUpLeft'    => 'rotateInUpLeft',
				'rotateInUpRight'   => 'rotateInUpRight',
				'rollIn'            => 'rollIn',
				'zoomIn'            => 'zoomIn',
				'zoomInDown'        => 'zoomInDown',
				'zoomInLeft'        => 'zoomInLeft',
				'zoomInRight'       => 'zoomInRight',
				'zoomInUp'          => 'zoomInUp',
			),
			'std' => '0'
		),
		array(
			'name'    => __('Animation Duration/Delay/Offset', 'metcreative'),
			'id'       => "{$prefix}blog_listing_post_animation_options",
			'type'     => 'radio',
			'options'  => array(
				'0' 		=> __('Theme Default','metcreative'),
				'1' 		=> __('Custom', 'metcreative'),
			),
			'std' => '0'
		),
		array(
			'id' => 'blog_listing_post_animation_duration',
			'type' => 'slider',
			'name' => __('Animation Duration', 'metcreative'),
			'desc' => __('How long to take when animating by seconds?', 'metcreative'),
			"std" => 1,
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => .1,
			)
		),
		array(
			'id' => 'blog_listing_post_animation_delay',
			'type' => 'slider',
			'name' => __('Animation Delay', 'metcreative'),
			'desc' => __('How long to take before starting animation by seconds?', 'metcreative'),
			"std" => 1,
			'resolution' => 0.1,
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => .1,
			)
		),
		array(
			'id' => 'blog_listing_post_animation_offset',
			'type' => 'slider',
			'name' => __('Animation Offset', 'metcreative'),
			'desc' => __('If you don\'t want to start animation right after when element visible by user increase this.(px)', 'metcreative'),
			"std" => 100,
			'js_options' => array(
				'min'   => 0,
				'max'   => 1000,
				'step'  => 50,
			)
		),
		array(
			'type' => 'heading',
			'name' => __( 'Blog listing options', 'metcreative' ),
			'id'   => 'h_blog_listing_options',
		),
		array(
			'id'       => "{$prefix}blog_listing_content_type",
			'type'     => 'radio',
			'name'    => __('Blog Listing Content Type', 'metcreative'),
			'options'  => array(
				'0' 		=> __('Theme Default','metcreative'),
				'content' 	=> __('Content', 'metcreative'),
				'excerpt' 	=> __('Excerpt', 'metcreative'),
			),
			'default' => 'content'
		),
		array(
			'name'    => __('Excerpt Length', 'metcreative'),
			'id'      => "{$prefix}blog_excerpt_length",
			'desc'    => '<em>*Leave empty to use theme default.</em>',
			'type'    => 'text',
			'std'     => ''
		),
		array(
			'name'    => __('Excerpt More Text', 'metcreative'),
			'id'      => "{$prefix}blog_excerpt_more",
			'desc'    => '<em>*Leave empty to use theme default.</em>',
			'type'    => 'text',
			'std'     => ''
		),

		//Blog Listing Post Elements
		array(
			'name'    => __('Show "DATE" Meta Info', 'metcreative'),
			'id'      => "{$prefix}blog_listing_meta_date",
			'type'    => 'radio',
			'std'     => '0',
			'options' => $bool_wd_options
		),
		array(
			'name'    => __('Show "CATEGORY" Meta Info', 'metcreative'),
			'id'       => "{$prefix}blog_listing_meta_category",
			'type'     => 'radio',
			'std'  => '0',
			'options'	=> $bool_wd_options
		),
		array(
			'name'    => __('Show "AUTHOR" Meta Info', 'metcreative'),
			'id'       => "{$prefix}blog_listing_meta_author",
			'type'     => 'radio',
			'std'  => '0',
			'options'	=> $bool_wd_options
		),
		array(
			'name'    => __('Show "Comments Count" Meta Info', 'metcreative'),
			'id'       => "{$prefix}blog_listing_meta_comments_number",
			'type'     => 'radio',
			'std'  => '0',
			'options'	=> $bool_wd_options
		),
		array(
			'name'    => __('Show "Tags" Button', 'metcreative'),
			'id'       => "{$prefix}blog_listing_meta_tags",
			'type'     => 'radio',
			'std'  => '0',
			'options'	=> $bool_wd_options
		),
		array(
			'name'    => __('Show "Read More" Button', 'metcreative'),
			'id'       => "{$prefix}blog_listing_meta_readmore",
			'type'     => 'radio',
			'std'  => '0',
			'options'	=> $bool_wd_options
		),
	),
	'only_on'    => array(
		'template' => array( 'archive.php' )
	),
);

/*=========================
=     PROJECT OPTIONS     =
=========================*/
$meta_boxes[] = array(
	'id' => 'portfolio_item',
	'title' => 'Project Options',
	'pages' => array( 'dslc_projects' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name'  => 'Project Overview Box?',
			'desc'  => '',
			'id'		=> "{$prefix}project_overview",
			'type'  => 'radio',
			'std'   => 0,
			'options'	=> array(1 => 'Show', 0 => 'Hide')
		),
		array(
			'name'  => 'Project Overview Items',
			'desc'  => 'You need to use this format <code>Label: Text</code> <br> *HTML codes allowed.',
			'id'		=> "{$prefix}project_overview_items",
			'type'  => 'text',
			'std'   => 'Client: John Doe',
			'clone'	=> true
		),
		array(
			'name'  => 'Show "Recent Works" Widget',
			'desc'  => '',
			'id'		=> "{$prefix}project_recent_works_widget",
			'type'  => 'radio',
			'std'   => '0',
			'options'	=> $bool_wd_options
		),
	)
);

/*===========================
=     BLOG LISTING TYPE     =
===========================*/
$meta_boxes[] = array(
	'id' => 'blog_listing_content_options',
	'title' => 'Listing Content Type',
	'pages' => array( 'post' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(
		array(
			'name'    => '',
			'desc'    => '',
			'id'      => "{$prefix}blog_listing_content_type",
			'type'    => 'radio',
			'std'     => '0',
			'options' => array('0' => __('Theme Default','metcreative').'<br>', 'content' => __('Content', 'metcreative').'<br>', 'excerpt' => __('Excerpt', 'metcreative') ),
		),
	)
);

/*========================
=     MEDIA SETTINGS     =
========================*/
$meta_boxes[] = array(
	'id' => 'media',
	'title' => 'Media Settings',
	'pages' => array( 'post','dslc_projects' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name'		=> __('Content Media?','metcreative'),
			'id'		=> "{$prefix}content_media_type",
			'type'		=> 'radio',
			'std'		=> '',
			'options'	=> array(
				'0' 				=> __('None', 'metcreative'),
				'slider' 			=> __('Slider', 'metcreative'),
				'oembed' 			=> __('oEmbed', 'metcreative'),
				'html5_video' 		=> __('HTML5 Video', 'metcreative'),
				'html5_audio' 		=> __('HTML5 Audio', 'metcreative'),
			),
		),
		array(
			'type' => 'heading',
			'name' => __( 'Slider Options', 'metcreative' ),
			'id'   => 'h_slider_options',
		),
		array(
			'name'				=> 'Slider Images',
			'id'				=> "{$prefix}slider_images",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 99,
		),
		array(
			'name'    => __( 'Slider Mode', 'metcreative' ),
			'id'      => "{$prefix}slider_mode",
			'type'    => 'radio',
			'desc'    => 'Type of transition between slides (Default: Horizontal)',
			'options' => array(
				'horizontal' => __( 'Horizontal', 'metcreative' ),
				'vertical'   => __( 'Vertical', 'metcreative' ),
				'fade'       => __( 'Fade', 'metcreative' ),
			),
		),
		array(
			'name' => __( 'Slider Random Start?', 'metcreative' ),
			'id'   => "{$prefix}slider_randomstart",
			'type' => 'checkbox',
			'desc' => 'Start slider on a random slide',
		),
		array(
			'name' => __( 'Slider Infinite Loop?', 'metcreative' ),
			'id'   => "{$prefix}slider_infiniteloop",
			'type' => 'checkbox',
			'desc' => 'If enabled, clicking "Next" while on the last slide will transition to the first slide and vice-versa',
		),
		array(
			'name' => __( 'Slider Auto-Play?', 'metcreative' ),
			'id'   => "{$prefix}slider_auto",
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Slider Auto-Hover?', 'metcreative' ),
			'id'   => "{$prefix}slider_autohover",
			'type' => 'checkbox',
			'desc' => 'Auto show will pause when mouse hovers over slider',
		),
		array(
			'name' => __( 'Slider Pause', 'metcreative' ),
			'id'   => "{$prefix}slider_pause_time",
			'type' => 'slider',
			'suffix' => 'ms',
			'desc'   => 'The amount of time (in ms) between each auto transition (Default: 4000)',

			'js_options' => array(
				'min'   => 1000,
				'max'   => 6000,
				'step'  => 100,
			)
		),
		array(
			'name' => __( 'Slider transition duration', 'metcreative' ),
			'id'   => "{$prefix}slider_speed",
			'type' => 'slider',
			'suffix' => 'ms',
			'desc'   => 'Slide transition duration (in ms) (Default: 500)',

			'js_options' => array(
				'min'   => 100,
				'max'   => 2000,
				'step'  => 10,
			)
		),
		array(
			'type' => 'heading',
			'name' => __( 'oEmbed', 'metcreative' ),
			'id'   => 'h_oembed',
		),
		array(
			'name'  => 'oEmbed Link',
			'id'    => "{$prefix}oembed_link",
			'desc'  => 'Insert your media link. Ex: http://www.youtube.com/watch?v=hNZE2zo7cpQ OR http://vimeo.com/63898090 <br>
			<a href="https://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">Click here</a> for supported websites. ',
			'type'  => 'oembed'
		),
		array(
			'type' => 'heading',
			'name' => __( 'HTML5 Video', 'metcreative' ).' <a href="http://www.w3schools.com/html/html5_video.asp" target="_blank">'.__( 'Why would I need all formats?', 'metcreative' ).'</a>',
			'id'   => 'h_html5',
		),
		array(
			'name' => __( 'MP4 Video File', 'metcreative' ),
			'id'   => "{$prefix}html5_video_file_mp4",
			'type' => 'file_advanced',
			'max_file_uploads' => 1,
			'mime_type' => 'video',
		),
        array(
            'name' => __( 'OGV/OGG Video File', 'metcreative' ),
            'id'   => "{$prefix}html5_video_file_ogv",
            'type' => 'file_advanced',
            'max_file_uploads' => 1,
            'mime_type' => 'video',
        ),
        array(
            'name' => __( 'WEBM Video File', 'metcreative' ),
            'id'   => "{$prefix}html5_video_file_webm",
            'type' => 'file_advanced',
            'max_file_uploads' => 1,
            'mime_type' => 'video',
        ),
        array(
            'name' => __( 'MP3 Audio File', 'metcreative' ),
            'id'   => "{$prefix}html5_audio_file_mp3",
            'type' => 'file_advanced',
            'max_file_uploads' => 1,
            'mime_type' => 'audio',
        ),
        array(
            'name'    	=> 'Loop',
            'desc'		=> __('Allows for the looping of media.','metcreative'),
            'id'      	=> "{$prefix}html5_media_loop",
            'type'    	=> 'radio',
            'std'		=> 'off',
            'options' 	=> array('on' => __('On','metcreative'),'off' => __('Off','metcreative')),
        ),
        array(
            'name'    	=> 'Autoplay',
            'desc'		=> __('Causes the media to automatically play as soon as the media file is ready.','metcreative'),
            'id'      	=> "{$prefix}html5_media_autoplay",
            'type'    	=> 'radio',
            'std'		=> 'off',
            'options' 	=> array('on' => __('On','metcreative'),'off' => __('Off','metcreative')),
        ),
		array(
			'type' => 'heading',
			'name' => __( 'Media Sizing Options', 'metcreative' ),
			'id'   => 'h_media_sizing',
		),
		array(
			'name' => __( 'Media Hardcrop (Listing)', 'metcreative' ),
			'id'   => "{$prefix}media_hardcrop_listing",
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Media Height (Listing)', 'metcreative' ),
			'id'   => "{$prefix}media_height_listing",
			'type' => 'slider',
			'suffix' => 'px',

			'js_options' => array(
				'min'   => 10,
				'max'   => 500,
				'step'  => 1,
			)
		),
		array(
			'name' => __( 'Media Hardcrop (Detail)', 'metcreative' ),
			'id'   => "{$prefix}media_hardcrop_detail",
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Media Height (Detail)', 'metcreative' ),
			'id'   => "{$prefix}media_height_detail",
			'type' => 'slider',
			'suffix' => 'px',

			'js_options' => array(
				'min'   => 100,
				'max'   => 1000,
				'step'  => 5,
			)
		),
	)

);

/*======================
=     PAGE OPTIONS     =
======================*/
$meta_boxes[] = array(
	'id' => 'page_options',
	'title' => 'Page Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'    	=> 'Enable Page Info Bar (PIB)',
			'id'      	=> "{$prefix}page_info_bar_status",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'    	=> 'PIB Description',
			'id'      	=> "{$prefix}pib_description",
			'type'    	=> 'text',
		),
		array(
			'type' => 'heading',
			'name' => __('Sidebar Options', 'metcreative'),
			'id'   => 'h_page_custom_sidebar_note',
		),
		array(
			'name'    	=> 'Enable Custom Sidebar',
			'desc'		=> __('Select custom sidebar on "Sidebar" metabox bottom of the page.','metcreative'),
			'id'      	=> "{$prefix}page_custom_sidebar",
			'type'    	=> 'radio',
			'std'		=> 'false',
			'options' 	=> $bool_options,
		),
		array(
			'name'    	=> 'Page Sidebar Position',
			'desc'		=> '',
			'id'      	=> "{$prefix}page_sidebar_position",
			'type'    	=> 'radio',
			'std'		=> 'right',
			'options' 	=> array('left' => __('Left','metcreative'),'right' => __('Right','metcreative')),
		),
		array(
			'type' => 'heading',
			'name' => __('Customization Options', 'metcreative'),
			'id'   => 'h_custom_page_metaboxes_note',
		),
		array(
			'name' => __( 'Enable Custom Options', 'metcreative' ),
			'desc' => __( '<br> -Please check requested sections and publish/update page. <br> -Metaboxes will be added bottom of the content editor for requested options.', 'metcreative' ),
			'id'   => "{$prefix}custom_page_metaboxes",
			'type' => 'checkbox_list',
			'options' => array(
				'page_header_options' 		=> __( 'Header', 'metcreative' ),
				'page_sticky_header_options'=> __( '-- Sticky Header', 'metcreative' ),
				'page_logo_options'			=> __( '-- Logo', 'metcreative' ),
				'page_sticky_logo_options'	=> __( '-- Sticky Logo', 'metcreative' ),
				'page_background_options' 	=> __( 'Background', 'metcreative' ),
				'page_footer_options' 		=> __( 'Footer', 'metcreative' ),
				'page_sidenav_options'		=> __( 'Sidenav', 'metcreative' ),
				'page_fullscreen_options'	=> __( 'Fullscreen Scrolling', 'metcreative' ),
				'page_preloader_options'	=> __( 'Loading Screen', 'metcreative' ),
			),
		),
		array(
			'type' => 'heading',
			'name' => __('Slider Options', 'metcreative'),
			'id'   => 'h_page_slider_note',
		),
		array(
			'name'    	=> 'Slider Shortcode',
			'id'      	=> "{$prefix}page_slider_shortcode",
			'type'    	=> 'text',
		),
		array(
			'name'    	=> 'Slider Position',
			'id'      	=> "{$prefix}page_slider_position",
			'type'    	=> 'radio',
			'std'		=> '',
			'options' 	=> array('above' => 'Above Header', 'below' => 'Below Header'),
		),
		array(
			'type' => 'heading',
			'name' => __('Extra Options', 'metcreative'),
			'id'   => 'h_page_extra_note',
		),
		array(
			'name'    	=> 'Custom CSS',
			'id'      	=> "{$prefix}custom_css",
			'type'    	=> 'textarea',
			'std'		=> '',
		),
	)
);

/*=============================
=     PAGE HEADER OPTIONS     =
=============================*/
$meta_boxes[] = array(
	'id' => 'page_header_options',
	'title' => 'Header Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'heading',
			'name' => __( '*Empty or "Theme Default" values will use Theme Options values', 'metcreative' ),
			'id'   => 'h_header_op_note',
		),
		array(
			'name' => __( 'Disable Header', 'metcreative' ),
			'desc' => __( 'Yes', 'metcreative' ),
			'id'   => "{$prefix}disable_header",
			'type' => 'checkbox',
			'std'  => '',
		),
		array(
			'name' => __( 'Disable Header Top Bar', 'metcreative' ),
			'desc' => __( 'Yes', 'metcreative' ),
			'id'   => "{$prefix}disable_header_top_bar",
			'type' => 'checkbox',
			'std'  => '',
		),
		array(
			'name'    	=> __('Header Layout','metcreative'),
			'id'      	=> "{$prefix}header_layout",
			'type'    	=> 'select',
			'std'		=> 0,
			'options' 	=> array('0' => __('Theme Default', 'metcreative'), '1' => __('Layout 1', 'metcreative'), '2' => __('Layout 2', 'metcreative'), '3' => __('Layout 3', 'metcreative'), '4' => __('Layout 4', 'metcreative'), '5' => __('Layout 5', 'metcreative') ),
		),
		array(
			'name'    	=> __('Header Menu','metcreative'),
			'id'      	=> "{$prefix}header_menu",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> $nav_menu_data,
		),
        array(
            'name'  => 'Header on Slider',
            'desc'  => '',
            'id'	=> "{$prefix}header_on_content",
            'type'  => 'checkbox',
            'std'   => ''
        ),

		#-- Header Seperator Styling --#
		array(
			'type' => 'heading',
			'name' => __( 'Header Seperator Styling', 'metcreative' ),
			'id'   => 'h_header_style_op',
		),
		array(
			'name' => __( 'Header Seperator Width', 'metcreative' ),
			'id'   => "{$prefix}header_border_width",
			'type' => 'slider',
			'suffix' => __( ' px', 'metcreative' ),
			'js_options' => array(
				'min'   => 0,
				'max'   => 50,
				'step'  => 1,
			)
		),
		array(
			'name'    	=> __('Header Seperator Style','metcreative'),
			'id'      	=> "{$prefix}header_border_style",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> array('0' => 'Theme Default','none' => 'None', 'solid' => __('Solid','metcreative'), 'dashed' => __('Dashed','metcreative'), 'dotted' => __('Dotted','metcreative')),
		),
		array(
			'type' => 'color',
			'name' => __( 'Header Seperator Color', 'metcreative' ),
			'id'   => "{$prefix}header_border_color",
		),
		array(
			'name' => __( 'Header Seperators Opacity', 'metcreative' ),
			'id'   => "{$prefix}header_borders_opacity",
			'type' => 'slider',
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),

		#-- Header Bottom Border Styling --#
		array(
			'type' => 'heading',
			'name' => __( 'Header Bottom Border Styling', 'metcreative' ),
			'id'   => 'h_header_bborder_style_op',
		),
		array(
			'name' => __( 'Header Bottom Border Height', 'metcreative' ),
			'id'   => "{$prefix}header_bottom_border_width",
			'type' => 'slider',
			'suffix' => __( ' px', 'metcreative' ),
			'js_options' => array(
				'min'   => 0,
				'max'   => 50,
				'step'  => 1,
			)
		),
		array(
			'name'    	=> __('Header Bottom Border Style','metcreative'),
			'id'      	=> "{$prefix}header_bottom_border_style",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> array('0' => 'Theme Default','none' => 'None', 'solid' => __('Solid','metcreative'), 'dashed' => __('Dashed','metcreative'), 'dotted' => __('Dotted','metcreative')),
		),
		array(
			'type' => 'color',
			'name' => __( 'Header Bottom Border Color', 'metcreative' ),
			'id'   => "{$prefix}header_bottom_border_color",
		),
		array(
			'name' => __( 'Header Bottom Border Opacity', 'metcreative' ),
			'id'   => "{$prefix}header_bottom_border_opacity",
			'type' => 'slider',
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),

		#-- Header Background Styling --#
		array(
			'type' => 'heading',
			'name' => __( 'Header Background Styling', 'metcreative' ),
			'id'   => 'h_header_style_bg_op',
		),
        array(
            'name'    	=> __('Header BG Color Status','metcreative'),
            'desc'		=> __('If enabled; the color below will be used.','metcreative'),
            'id'      	=> "{$prefix}header_background_color_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'type' => 'color',
			'name' => __( 'Header BG Color', 'metcreative' ),
			'id'   => "{$prefix}header_background_color",
		),
        array(
            'name'    	=> __('Header BG Color Opacity Status','metcreative'),
            'desc'		=> __('If enabled; the opacity below will be used.','metcreative'),
            'id'      	=> "{$prefix}header_background_color_opacity_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'name' => __( 'Header BG Color Opacity', 'metcreative' ),
			'desc' => __('*Only works with background "color", if background image is not exist.','metcreative'),
			'id'   => "{$prefix}header_background_color_opacity",
			'type' => 'slider',
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),
        array(
            'name'    	=> __('Header BG Image Status','metcreative'),
            'desc'		=> __('If enabled; the image below will be used.','metcreative'),
            'id'      	=> "{$prefix}header_background_image_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'name'				=> __('Header BG Image','metcreative'),
			'id'				=> "{$prefix}header_background_image",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'    	=> __('Header BG Repeat','metcreative'),
			'id'      	=> "{$prefix}header_background_repeat",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'no-repeat' => 'No Repeat',
				'repeat' => 'Repeat All',
				'repeat-x' => 'Repeat Horizontally',
				'repeat-y' => 'Repeat Vertically',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Header BG Size','metcreative'),
			'id'      	=> "{$prefix}header_background_size",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'inherit' => 'Inherit',
				'cover' => 'Cover',
				'contain' => 'Contain',
			),
		),
		array(
			'name'    	=> __('Header BG Attachment','metcreative'),
			'id'      	=> "{$prefix}header_background_attachment",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'fixed' => 'Fixed',
				'scroll' => 'Scroll',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Header BG Position','metcreative'),
			'id'      	=> "{$prefix}header_background_position",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'left top' => 'Left Top',
				'left center' => 'Left center',
				'left bottom' => 'Left Bottom',
				'center top' => 'Center Top',
				'center center' => 'Center Center',
				'center bottom' => 'Center Bottom',
				'right top' => 'Right Top',
				'right center' => 'Right center',
				'right bottom' => 'Right Bottom',
			),
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*====================================
=     PAGE STICKY HEADER OPTIONS     =
====================================*/
$meta_boxes[] = array(
	'id' => 'page_sticky_header_options',
	'title' => 'Sticky Header Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'    	=> __('Sticky Header','metcreative'),
			'desc'		=> __('If enabled; when main navigation unvisible sticky header will be come.','metcreative'),
			'id'      	=> "{$prefix}sticky_header",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'    	=> __('Wide Sticky Header (100%)','metcreative'),
			'desc'		=> __('*Only available with full-width page layout.','metcreative'),
			'id'      	=> "{$prefix}header_wide",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name' => __( 'Sticky Header Height', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_height",
			'type' => 'slider',
			'std'  => 55,
			'suffix' => __( ' px', 'metcreative' ),
			'js_options' => array(
				'min'   => 45,
				'max'   => 300,
				'step'  => 1,
			)
		),

		#-- Sticky Header Seperator Styling --#
		array(
			'type' => 'heading',
			'name' => __( 'Sticky Header Seperator Styling', 'metcreative' ),
			'id'   => 'h_sheader_sep_style_op',
		),
		array(
			'name'    	=> __('Sync with Header Seperators','metcreative'),
			'desc'		=> __('If enabled, sticky header will use regular headers seperators. Disable if you wanna use custom seperators for Sticky Header','metcreative'),
			'id'      	=> "{$prefix}sticky_header_borders_is_same",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name' => __( 'Sticky Header Seperator Width', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_border_width",
			'type' => 'slider',
			'suffix' => __( ' px', 'metcreative' ),
			'js_options' => array(
				'min'   => 0,
				'max'   => 50,
				'step'  => 1,
			)
		),
		array(
			'name'    	=> __('Sticky Header Seperator Style','metcreative'),
			'id'      	=> "{$prefix}sticky_header_border_style",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> array('0' => 'Theme Default','none' => 'None', 'solid' => __('Solid','metcreative'), 'dashed' => __('Dashed','metcreative'), 'dotted' => __('Dotted','metcreative')),
		),
		array(
			'type' => 'color',
			'name' => __( 'Sticky Header Seperator Color', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_border_color",
		),
		array(
			'name' => __( 'Sticky Header Seperator Opacity', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_borders_opacity",
			'type' => 'slider',
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),

		#-- Sticky Header Bottom Border Styling --#
		array(
			'type' => 'heading',
			'name' => __( 'Sticky Header Bottom Border Styling', 'metcreative' ),
			'id'   => 'h_sheader_bborder_style_op',
		),
		array(
			'name'    	=> __('Sync with Header Bottom Border','metcreative'),
			'desc'		=> __('If enabled, sticky header will use regular header bottom border. Disable if you wanna use custom bottom border for Sticky Header','metcreative'),
			'id'      	=> "{$prefix}sticky_header_bottom_border_is_same",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name' => __( 'Sticky Header Bottom Border Height', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_bottom_border_width",
			'type' => 'slider',
			'suffix' => __( ' px', 'metcreative' ),
			'js_options' => array(
				'min'   => 0,
				'max'   => 50,
				'step'  => 1,
			)
		),
		array(
			'name'    	=> __('Sticky Header Bottom Border Style','metcreative'),
			'id'      	=> "{$prefix}sticky_header_bottom_border_style",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> array('0' => 'Theme Default','none' => 'None', 'solid' => __('Solid','metcreative'), 'dashed' => __('Dashed','metcreative'), 'dotted' => __('Dotted','metcreative')),
		),
		array(
			'type' => 'color',
			'name' => __( 'Sticky Header Bottom Border Color', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_bottom_border_color",
		),
		array(
			'name' => __( 'Sticky Header Bottom Border Opacity', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_bottom_border_opacity",
			'type' => 'slider',
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),

		#-- Sticky Header Background Styling --#
		array(
			'type' => 'heading',
			'name' => __( 'Sticky Header Background Styling', 'metcreative' ),
			'id'   => 'h_sticky_header_style_bg_op',
		),
		array(
			'name'    	=> __('Sticky Header BG Color Status','metcreative'),
			'desc'		=> __('If enabled; the color below will be used.','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_color_status",
			'type'    	=> 'checkbox',
			'std'		=> ''
		),
		array(
			'type' => 'color',
			'name' => __( 'Sticky Header BG Color', 'metcreative' ),
			'id'   => "{$prefix}sticky_header_background_color",
		),
		array(
			'name'    	=> __('Sticky Header BG Color Opacity Status','metcreative'),
			'desc'		=> __('If enabled; the opacity below will be used.','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_color_opacity_status",
			'type'    	=> 'checkbox',
			'std'		=> ''
		),
		array(
			'name' => __( 'Sticky Header BG Color Opacity', 'metcreative' ),
			'desc' => __('*Only works with background "color", if background image is not exist.','metcreative'),
			'id'   => "{$prefix}sticky_header_background_color_opacity",
			'type' => 'slider',
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),
		array(
			'name'    	=> __('Sticky Header BG Image Status','metcreative'),
			'desc'		=> __('If enabled; the image below will be used.','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_image_status",
			'type'    	=> 'checkbox',
			'std'		=> ''
		),
		array(
			'name'				=> __('Sticky Header BG Image','metcreative'),
			'id'				=> "{$prefix}sticky_header_background_image",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'    	=> __('Sticky Header BG Repeat','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_repeat",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'no-repeat' => 'No Repeat',
				'repeat' => 'Repeat All',
				'repeat-x' => 'Repeat Horizontally',
				'repeat-y' => 'Repeat Vertically',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Sticky Header BG Size','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_size",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'inherit' => 'Inherit',
				'cover' => 'Cover',
				'contain' => 'Contain',
			),
		),
		array(
			'name'    	=> __('Sticky Header BG Attachment','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_attachment",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'fixed' => 'Fixed',
				'scroll' => 'Scroll',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Sticky Header BG Position','metcreative'),
			'id'      	=> "{$prefix}sticky_header_background_position",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'left top' => 'Left Top',
				'left center' => 'Left center',
				'left bottom' => 'Left Bottom',
				'center top' => 'Center Top',
				'center center' => 'Center Center',
				'center bottom' => 'Center Bottom',
				'right top' => 'Right Top',
				'right center' => 'Right center',
				'right bottom' => 'Right Bottom',
			),
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*===========================
=     PAGE LOGO OPTIONS     =
===========================*/
$meta_boxes[] = array(
	'id' => 'page_logo_options',
	'title' => 'Logo Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'				=> __('Logo','metcreative'),
			'id'				=> "{$prefix}logo",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'				=> __('Logo Height','metcreative'),
			'id'				=> "{$prefix}logo_height",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Logo Padding Top','metcreative'),
			'id'				=> "{$prefix}logo_padding_top",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Logo Padding Bottom','metcreative'),
			'id'				=> "{$prefix}logo_padding_bottom",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Logo Padding Right','metcreative'),
			'id'				=> "{$prefix}logo_padding_right",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Logo Padding Left','metcreative'),
			'id'				=> "{$prefix}logo_padding_left",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Logo 2x (Retina)','metcreative'),
			'id'				=> "{$prefix}logo_retina",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'				=> __('Logo Text','metcreative'),
			'id'				=> "{$prefix}logo_text",
			'type'				=> 'text',
		),
		array(
			'type'				=> 'color',
			'name'				=> __( 'Logo Text Color', 'metcreative' ),
			'id'				=> "{$prefix}logo_text_color",
		),
		array(
			'name'				=> __( 'Logo Text Size', 'metcreative' ),
			'id'				=> "{$prefix}logo_text_size",
			'type'				=> 'number',
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*==================================
=     PAGE STICKY LOGO OPTIONS     =
==================================*/
$meta_boxes[] = array(
	'id' => 'page_sticky_logo_options',
	'title' => 'Sticky Logo Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'    	=> __('Enable Custom Options','metcreative'),
			'id'      	=> "{$prefix}sticky_logo_options",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'				=> __('Sticky Logo','metcreative'),
			'id'				=> "{$prefix}sticky_logo",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'				=> __('Sticky Logo Height','metcreative'),
			'id'				=> "{$prefix}sticky_logo_height",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Sticky Logo Padding Top','metcreative'),
			'id'				=> "{$prefix}sticky_logo_padding_top",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Sticky Logo Padding Bottom','metcreative'),
			'id'				=> "{$prefix}sticky_logo_padding_bottom",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Sticky Logo Padding Right','metcreative'),
			'id'				=> "{$prefix}sticky_logo_padding_right",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Sticky Logo Padding Left','metcreative'),
			'id'				=> "{$prefix}sticky_logo_padding_left",
			'type'				=> 'number',
		),
		array(
			'name'				=> __('Sticky Logo Text','metcreative'),
			'id'				=> "{$prefix}sticky_logo_text",
			'type'				=> 'text',
		),
		array(
			'type' => 'color',
			'name' => __( 'Sticky Logo Text Color', 'metcreative' ),
			'id'   => "{$prefix}sticky_logo_text_color",
		),
		array(
			'name'				=> __( 'Sticky Logo Text Size', 'metcreative' ),
			'id'				=> "{$prefix}sticky_logo_text_size",
			'type'				=> 'number',
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*==============================
=     PAGE SIDENAV OPTIONS     =
=============================*/
$meta_boxes[] = array(
	'id' => 'page_sidenav_options',
	'title' => 'Sidenav Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name'    	=> __( 'Sidenav Status', 'metcreative' ),
			'id'      	=> "{$prefix}sidenav_status",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'    	=> __( 'Sidenav Position', 'metcreative' ),
			'id'      	=> "{$prefix}sidenav_position",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> array('0' => __('Theme Default','metcreative'), 'left' => __('Left','metcreative'), 'right' => __('Right','metcreative')),
		),
		array(
			'name'    	=> __('Sidenav Primary Menu','metcreative'),
			'id'      	=> "{$prefix}sidenav_menu",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> $nav_menu_data,
		),
		array(
			'name'    	=> __( 'Sidenav Sticky', 'metcreative' ),
			'id'      	=> "{$prefix}sidenav_sticky",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'    	=> __('Enable Sidenav Logo', 'metcreative'),
			'id'      	=> "{$prefix}sidenav_logo_status",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),

		array(
			'type' => 'heading',
			'name' => __( 'Top Bar', 'metcreative' ),
			'id'   => 'h_sidenav_top_bar',
		),
		array(
			'name'    	=> __('Enable SideNav Top Bar', 'metcreative'),
			'id'      	=> "{$prefix}sidenav_topbar_status",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'    	=> __('Enable Secondary Menu', 'metcreative'),
			'id'      	=> "{$prefix}sidenav_secondary_menu_status",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
		array(
			'name'    	=> __('Sidenav Secondary Menu','metcreative'),
			'id'      	=> "{$prefix}sidenav_second_menu",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> $nav_menu_data,
		),
		array(
			'name'    	=> __('Language Selector', 'metcreative'),
			'desc'    	=> __('*WPML plugin required', 'metcreative'),
			'id'      	=> "{$prefix}sidenav_lang_selector",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*=================================
=     PAGE BACKGROUND OPTIONS     =
=================================*/
$meta_boxes[] = array(
	'id' => 'page_background_options',
	'title' => 'Background Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name'    	=> 'Boxed Layout',
			'desc'		=> 'You need to enable boxed layout for page background color or background image options',
			'id'      	=> "{$prefix}page_boxed_layout",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> $bool_wd_options,
		),
        array(
            'name'    	=> __('Page Background Color Status','metcreative'),
            'desc'		=> __('If enabled; the color below will be used.','metcreative'),
            'id'      	=> "{$prefix}page_background_color_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'type' => 'color',
			'name' => __( 'Page Background Color', 'metcreative' ),
			'id'   => "{$prefix}page_background_color",
		),
        array(
            'name'    	=> __('Page Background Color Opacity Status','metcreative'),
            'desc'		=> __('If enabled; the opacity below will be used.','metcreative'),
            'id'      	=> "{$prefix}page_background_color_opacity_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'name' => __( 'Page Background Color Opacity', 'metcreative' ),
			'desc' => __('*Only works with background "color", if background image is not exist.','metcreative'),
			'id'   => "{$prefix}page_background_color_opacity",
			'type' => 'slider',
			'std'  => 1,
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),
        array(
            'name'    	=> __('Page Background Image Status','metcreative'),
            'desc'		=> __('If enabled; the image below will be used.','metcreative'),
            'id'      	=> "{$prefix}page_background_image_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'name'				=> __('Page Background Image','metcreative'),
			'id'				=> "{$prefix}page_background_image",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'    	=> __('Page Background Repeat','metcreative'),
			'id'      	=> "{$prefix}page_background_repeat",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'no-repeat' => 'No Repeat',
				'repeat' => 'Repeat All',
				'repeat-x' => 'Repeat Horizontally',
				'repeat-y' => 'Repeat Vertically',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Page Background Size','metcreative'),
			'id'      	=> "{$prefix}page_background_size",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'inherit' => 'Inherit',
				'cover' => 'Cover',
				'contain' => 'Contain',
			),
		),
		array(
			'name'    	=> __('Page Background Attachment','metcreative'),
			'id'      	=> "{$prefix}page_background_attachment",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'fixed' => 'Fixed',
				'scroll' => 'Scroll',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Page Background Position','metcreative'),
			'id'      	=> "{$prefix}page_background_position",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'left top' => 'Left Top',
				'left center' => 'Left center',
				'left bottom' => 'Left Bottom',
				'center top' => 'Center Top',
				'center center' => 'Center Center',
				'center bottom' => 'Center Bottom',
				'right top' => 'Right Top',
				'right center' => 'Right center',
				'right bottom' => 'Right Bottom',
			),
		),
		array(
			'type' => 'heading',
			'name' => __( 'You can use this options for content area background styling. Available for boxed or wide layout both.', 'metcreative' ),
			'id'   => 'h_background_styling_op',
		),
        array(
            'name'    	=> __('Content Background Color Status','metcreative'),
            'desc'		=> __('If enabled; the color below will be used.','metcreative'),
            'id'      	=> "{$prefix}content_background_color_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'type' => 'color',
			'name' => __( 'Content Background Color', 'metcreative' ),
			'id'   => "{$prefix}content_background_color",
		),
        array(
            'name'    	=> __('Content Background Color Opacity Status','metcreative'),
            'desc'		=> __('If enabled; the opacity below will be used.','metcreative'),
            'id'      	=> "{$prefix}content_background_color_opacity_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'name' => __( 'Content Background Color Opacity', 'metcreative' ),
			'desc' => __('*Only works with background "color", if background image is not exist.','metcreative'),
			'id'   => "{$prefix}content_background_color_opacity",
			'type' => 'slider',
			'std'  => 1,
			'js_options' => array(
				'min'   => 0,
				'max'   => 1,
				'step'  => .01,
			)
		),
        array(
            'name'    	=> __('Content Background Image Status','metcreative'),
            'desc'		=> __('If enabled; the image below will be used.','metcreative'),
            'id'      	=> "{$prefix}content_background_image_status",
            'type'    	=> 'checkbox',
            'std'		=> ''
        ),
		array(
			'name'				=> __('Content Background Image','metcreative'),
			'id'				=> "{$prefix}content_background_image",
			'type'				=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'    	=> __('Content Background Repeat','metcreative'),
			'id'      	=> "{$prefix}content_background_repeat",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'no-repeat' => 'No Repeat',
				'repeat' => 'Repeat All',
				'repeat-x' => 'Repeat Horizontally',
				'repeat-y' => 'Repeat Vertically',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Content Background Size','metcreative'),
			'id'      	=> "{$prefix}content_background_size",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'inherit' => 'Inherit',
				'cover' => 'Cover',
				'contain' => 'Contain',
			),
		),
		array(
			'name'    	=> __('Content Background Attachment','metcreative'),
			'id'      	=> "{$prefix}content_background_attachment",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'fixed' => 'Fixed',
				'scroll' => 'Scroll',
				'inherit' => 'Inherit',
			),
		),
		array(
			'name'    	=> __('Content Background Position','metcreative'),
			'id'      	=> "{$prefix}content_background_position",
			'type'    	=> 'select',
			'std'		=> '',
			'options' 	=> array(
				'' => '',
				'left top' => 'Left Top',
				'left center' => 'Left center',
				'left bottom' => 'Left Bottom',
				'center top' => 'Center Top',
				'center center' => 'Center Center',
				'center bottom' => 'Center Bottom',
				'right top' => 'Right Top',
				'right center' => 'Right center',
				'right bottom' => 'Right Bottom',
			),
		),
        array(
            'type' => 'heading',
            'name' => __( 'Content or Body Padding Options', 'metcreative' ),
            'id'   => 'h_background_paddings',
        ),
        array(
            'name'=> __('Body Padding Top','metcreative'),
            'id' => "{$prefix}body_padding_top",
            'type' => 'number',
        ),
        array(
            'name'=> __('Body Padding Bottom','metcreative'),
            'id' => "{$prefix}body_padding_bottom",
            'type' => 'number',
        ),
        array(
            'name'=> __('Content Padding Top','metcreative'),
            'id' => "{$prefix}content_padding_top",
            'type' => 'number',
        ),
        array(
            'name'=> __('Content Padding Bottom','metcreative'),
            'id' => "{$prefix}content_padding_bottom",
            'type' => 'number',
        ),
        array(
            'name'=> __('Content Padding Left','metcreative'),
            'id' => "{$prefix}content_padding_left",
            'type' => 'number',
        ),
        array(
            'name'=> __('Content Padding Right','metcreative'),
            'id' => "{$prefix}content_padding_right",
            'type' => 'number',
        ),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*=============================
=     PAGE FOOTER OPTIONS     =
=============================*/
$meta_boxes[] = array(
	'id' => 'page_footer_options',
	'title' => 'Footer Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'type' => 'heading',
			'name' => __( '*Empty or "Theme Default" values will use Theme Options values', 'metcreative' ),
			'id'   => 'h_footer_op_note',
		),
		array(
			'name' => __( 'Disable Footer', 'metcreative' ),
			'desc' => __( 'Yes', 'metcreative' ),
			'id'   => "{$prefix}disable_footer",
			'type' => 'checkbox',
			'std'  => '',
		),
		array(
			'name'    	=> __('Footer Layout','metcreative'),
			'id'      	=> "{$prefix}footer_layout",
			'type'    	=> 'select',
			'std'		=> 0,
			'options' 	=> array('0' => __('Theme Default', 'metcreative'), '1' => __('Layout 1', 'metcreative'), '2' => __('Layout 2', 'metcreative'), '3' => __('Layout 3', 'metcreative'), '4' => __('Layout 4', 'metcreative')),
		),
		array(
			'name'    	=> __('Footer Menu','metcreative'),
			'id'      	=> "{$prefix}footer_menu",
			'type'    	=> 'select',
			'std'		=> '0',
			'options' 	=> $nav_menu_data,
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*==============================
=     FULLSCREEN SCROLLING     =
==============================*/
$meta_boxes[] = array(
    'id' => 'page_fullscreen_options',
    'title' => 'Fullscreen Scrolling Options',
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        array(
            'name'  => __( 'Fullscreen Scrolling Status','metcreative'),
            'id'	=> "{$prefix}fullscreen_scrolling",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => 'CSS3',
            'desc'  => __( 'Defines wheter to use JavaScript or CSS3 transforms to scroll within sections and slides. Useful to speed up the movement in tablet and mobile devices with browsers supporting CSS3. If this option is set to true and the browser doesn\'t support CSS3, a jQuery fallback will be used instead.','metcreative'),
            'id'	=> "{$prefix}f_css3",
            'type'  => 'radio',
            'std'   => 'true',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Auto Scrolling','metcreative'),
            'desc'  => __( 'Defines whether to use the "automatic" scrolling or the "normal" one. It also has affects the way the sections fit in the browser/device window in tablets and mobile phones.','metcreative'),
            'id'	=> "{$prefix}f_auto_scrolling",
            'type'  => 'radio',
            'std'   => 'true',
            'options'	=> $bool_options
        ),
        array(
            'name'      => __('Scrolling Speed','metcreative'),
            'id'        => "{$prefix}f_scrolling_speed",
            'type'      => 'number',
            'std'       => 700
        ),
        array(
            'name'    	=> __('Easing Type','metcreative'),
            'id'      	=> "{$prefix}f_easing_type",
            'type'    	=> 'select',
            'std'		=> 'easeInQuart',
            'options' 	=> array(
                'jswing' => 'jswing',
                'def' => 'def',
                'easeInQuad' => 'easeInQuad',
                'easeOutQuad' => 'easeOutQuad',
                'easeInOutQuad' => 'easeInOutQuad',
                'easeInCubic' => 'easeInCubic',
                'easeOutCubic' => 'easeOutCubic',
                'easeInOutCubic' => 'easeInOutCubic',
                'easeInQuart' => 'easeInQuart',
                'easeOutQuart' => 'easeOutQuart',
                'easeInOutQuart' => 'easeInOutQuart',
                'easeInQuint' => 'easeInQuint',
                'easeOutQuint' => 'easeOutQuint',
                'easeInOutQuint' => 'easeInOutQuint',
                'easeInSine' => 'easeInSine',
                'easeOutSine' => 'easeOutSine',
                'easeInOutSine' => 'easeInOutSine',
                'easeInExpo' => 'easeInExpo',
                'easeOutExpo' => 'easeOutExpo',
                'easeInOutExpo' => 'easeInOutExpo',
                'easeInCirc' => 'easeInCirc',
                'easeOutCirc' => 'easeOutCirc',
                'easeInOutCirc' => 'easeInOutCirc',
                'easeInElastic' => 'easeInElastic',
                'easeOutElastic' => 'easeOutElastic',
                'easeInOutElastic' => 'easeInOutElastic',
                'easeInBack' => 'easeInBack',
                'easeOutBack' => 'easeOutBack',
                'easeInOutBack' => 'easeInOutBack',
                'easeInBounce' => 'easeInBounce',
                'easeOutBounce' => 'easeOutBounce',
                'easeInOutBounce' => 'easeInOutBounce',
            ),
        ),
        array(
            'name'  => __( 'Navigation','metcreative'),
            'desc'  => __( 'If set to true, it will show a navigation bar made up of small circles.','metcreative'),
            'id'	=> "{$prefix}f_navigation",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Navigation Position','metcreative'),
            'desc'  => '',
            'id'	=> "{$prefix}f_navigation_position",
            'type'  => 'radio',
            'std'   => 'right',
            'options'	=> array('right' => 'Right', 'left' => 'Left')
        ),
        array(
            'name'  => __( 'Slides Navigation','metcreative'),
            'desc'  => __( 'If set to true it will show a navigation bar made up of small circles for each landscape slider on the site.','metcreative'),
            'id'	=> "{$prefix}f_slides_navigation",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Slides Navigation Position','metcreative'),
            'desc'  => '',
            'id'	=> "{$prefix}f_slides_navigation_position",
            'type'  => 'radio',
            'std'   => 'bottom',
            'options'	=> array('bottom' => 'Bottom', 'top' => 'Top')
        ),
        array(
            'name'  => __( 'Continuous Vertical','metcreative'),
            'desc'  => __( 'Defines whether scrolling down in the last section should scroll down to the first one or not, and if scrolling up in the first section should scroll up to the last one or not. Not compatible with Loop Top or Loop Bottom.','metcreative'),
            'id'	=> "{$prefix}f_continuous_vertical",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Loop Bottom','metcreative'),
            'desc'  => __( 'Defines whether scrolling down in the last section should scroll to the first one or not.','metcreative'),
            'id'	=> "{$prefix}f_loop_bottom",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Loop Top','metcreative'),
            'desc'  => __( 'Defines whether scrolling up in the first section should scroll to the last one or not.','metcreative'),
            'id'	=> "{$prefix}f_loop_top",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Loop Horizontal','metcreative'),
            'desc'  => __( 'Defines whether horizontal sliders will loop after reaching the last or previous slide or not.','metcreative'),
            'id'	=> "{$prefix}f_loop_horizontal",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Scroll Overflow','metcreative'),
            'desc'  => __( 'Defines whether or not to create a scroll for the section in case its content is bigger than the height of it. In case of setting it to true','metcreative'),
            'id'	=> "{$prefix}f_scroll_overflow",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Keyboard Scrolling','metcreative'),
            'desc'  => __( 'Defines if the content can be navigated using the keyboard.','metcreative'),
            'id'	=> "{$prefix}f_keyboard_scrolling",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Video Playing','metcreative'),
            'desc'  => __( 'Defines if the videos will be played on page load or after scroll. True = Page Load, False = After Scroll','metcreative'),
            'id'	=> "{$prefix}f_video_playing",
            'type'  => 'radio',
            'std'   => 'false',
            'options'	=> $bool_options
        ),
        array(
            'name'  => __( 'Touch Sensivity', 'metcreative' ),
            'desc'  => __( 'Defines a percentage of the browsers window width/height, and how far a swipe must measure for navigating to the next section / slide.','metcreative'),
            'id'    => "{$prefix}f_touch_sensivity",
            'type'  => 'slider',
            'std'   => 5,
            'js_options' => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 5,
            ),
        ),
        array(
            'name'  => __( 'Exclude Header and Footer','metcreative'),
            'desc'  => __( 'Defines if header and footer will be taken off the scrolling structure.','metcreative'),
            'id'	=> "{$prefix}f_fixed_elements",
            'type'  => 'radio',
            'std'   => '',
            'options'	=> array('.footer_wrap,.met_header_wrap,#wpadminbar' => __('True','metcreative'), '' => __('False','metcreative')),
        ),
    ),
    'only_on'    => array(
        'is_activated' => true,
    ),
);

/*=============================page_preloader_options
=    LOADING SCREEN OPTIONS   =
=============================*/
$meta_boxes[] = array(
	'id' => 'page_preloader_options',
	'title' => 'Loading Screen Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'type' => 'color',
			'name' => __( 'Bar Color', 'metcreative' ),
			'id'   => "{$prefix}preloader_bar_color",
			'std'  => "#efefef"
		),
		array(
			'type' => 'color',
			'name' => __( 'Background Color', 'metcreative' ),
			'id'   => "{$prefix}preloader_bg_color",
			'std'  => "#111111"
		),
		array(
			'name' => __( 'Percentage', 'metcreative' ),
			'id'   => "{$prefix}preloader_percentage",
			'desc' => 'Show Percentage Value',
			'type'  => 'radio',
			'std'   => 'true',
			'options'	=> $bool_options
		),
		array(
			'name'  => __( 'Bar Height', 'metcreative' ),
			'id'    => "{$prefix}preloader_bar_height",
			'type'  => 'slider',
			'std'   => 1,
			'js_options' => array(
				'min'   => 1,
				'max'   => 50,
				'step'  => 1,
			),
		),
		array(
			'name'  => __( 'Fade Out Time', 'metcreative' ),
			'id'    => "{$prefix}preloader_fadeout_time",
			'type'  => 'slider',
			'std'   => 1000,
			'js_options' => array(
				'min'   => 200,
				'max'   => 5000,
				'step'  => 100,
			),
		),
	),
	'only_on'    => array(
		'is_activated' => true,
	),
);

/*=========================
=     STAFF OPTIONS     =
=========================*/
$meta_boxes[] = array(
	'id' => 'staff_options',
	'title' => 'Staff Options',
	'pages' => array( 'dslc_staff' ),
	'context' => 'side',
	'priority' => 'default',

	'fields' => array(
		array(
			'name'  => 'Staff Skills',
			'desc'  => 'You need to use this format <code>Percentage|Skill</code> <br> Example: 95|Design',
			'id'		=> "{$prefix}staff_skills",
			'type'  => 'text',
			'std'   => '50|Development',
			'clone'	=> true
		),
	)
);


/******************************************/


/*==============================
=     META BOX REGISTERING     =
==============================*/
function metcreative_register_meta_boxes(){
	global $meta_boxes, $is_activated;

	if ( class_exists( 'RW_Meta_Box' ) ) {
		foreach ( $meta_boxes as $meta_box ) {

			if ( isset( $meta_box['only_on'] ) AND ! rw_maybe_include( $meta_box['only_on'], $meta_box['id'] ) ) {
				continue;
			}

			new RW_Meta_Box( $meta_box );
		}
	}
}add_action( 'admin_init', 'metcreative_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions, $metabox_id ) {

	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = intval( $_GET['post'] );
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = intval( $_POST['post_ID'] );
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	foreach ( $conditions as $cond => $v ) {
		// Catch non-arrays too
		if ( ! is_array( $v ) ) {
			$v = array( $v );
		}

		switch ( $cond ) {
			case 'id':
				if ( in_array( $post_id, $v ) ) {
					return true;
				}
				break;
			case 'parent':
				$post_parent = $post->post_parent;
				if ( in_array( $post_parent, $v ) ) {
					return true;
				}
				break;
			case 'slug':
				$post_slug = $post->post_name;
				if ( in_array( $post_slug, $v ) ) {
					return true;
				}
				break;
			case 'category': //post must be saved or published first
				$categories = get_the_category( $post->ID );
				$catslugs = array();
				foreach ( $categories as $category )
				{
					array_push( $catslugs, $category->slug );
				}
				if ( array_intersect( $catslugs, $v ) )
				{
					return true;
				}
				break;
			case 'template':
				$template = get_post_meta( $post_id, '_wp_page_template', true );
				if ( in_array( $template, $v ) )
				{
					return true;
				}
				break;
			case 'is_activated':
				$active_list = get_post_meta( $post_id, MET_MB_PREFIX.'custom_page_metaboxes' );
				if ( $post_id !== false AND is_array($active_list) AND is_int(array_search($metabox_id, $active_list)) ) {
					return true;
				}
				break;
		}
	}

	// If no condition matched
	return false;
}


function rwmb_css_overwrite(){ ?>
	<style>
		.rwmb-field {
			/*border-bottom: 1px solid #eeeeee;*/
			padding-bottom: 10px;
		}
		.rwmb-field:last-child {
			border-bottom: 0;
			padding-bottom: 0;
		}
		.rwmb-input label {
			margin-right: 5px;
		}
	</style>
<?php
}add_action( 'admin_head', 'rwmb_css_overwrite' );
