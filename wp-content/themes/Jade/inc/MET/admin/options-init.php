<?php

if (!class_exists('jade_Redux_Framework_config')) {

    class jade_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

		public function setArguments() {

			$theme = wp_get_theme();

			$this->args = array(
				'opt_name'         => 'met_options',
				'display_name'     => $theme->get('Name'),
				'display_version'  => $theme->get('Version'),
				'menu_type'        => 'menu',
				'allow_sub_menu'   => true,
				'menu_title'       => __('Theme Options', 'metcreative'),
				'page_title'       => __('Theme Options Panel', 'metcreative'),
				'google_api_key'   => 'AIzaSyB6j84GW-3r-47Nal3ToMDxKSnCtByLCgQ',
				'google_update_weekly'      => true,
				'async_typography' => false,
				'admin_bar'        => true,
				'admin_bar_icon' => 'dashicons-admin-appearance',
				'global_variable'  => '',
				'dev_mode'         => MET_DEV_MODE,
				'customizer'       => true,

				'page_priority'    => null,
				'page_parent'      => 'themes.php',
				'page_permissions' => 'manage_options',
				'menu_icon'        => 'dashicons-admin-appearance',
				'last_tab'         => '',
				'page_icon'        => 'icon-themes',
				'page_slug'        => 'met_options',
				'save_defaults'    => true,
				'default_show'     => false,
				'default_mark'     => '',
				'show_import_export' => true,
				'class'            => '',

				'transient_time'   => 60 * MINUTE_IN_SECONDS,
				'output'           => true,
				'output_tag'       => true,
				'footer_credit'    => '',
				'network_admin'    => false,
				'network_sites'    => true,

				'hints'            => array(
					'icon'            => 'icon-question-sign',
					'icon_position'   => 'right',
					'icon_color'      => 'lightgray',
					'icon_size'       => 'normal',

					'tip_style'    => array(
						'color'       => 'light',
						'shadow'      => true,
						'rounded'     => false,
						'style'       => 'bootstrap',
					),
					'tip_position' => array(
						'my'          => 'bottom right',
						'at'          => 'top left',
					),
					'tip_effect'   => array(
						'show'        => array(
							'effect'      => 'fade',
							'duration'    => '300',
							'event'       => 'click',
						),
						'hide'        => array(
							'effect'      => 'fade',
							'duration'    => '300',
							'event'       => 'click',
						),
					),
				),

				'share_icons' => array(
					array(
						'url'     => 'http://l.metc.in/jade_to_support',
						'title'   => 'Support',
						'icon'    => 'fa fa-support',
					),
					array(
						'url'     => 'http://l.metc.in/jade_doc',
						'title'   => 'Documentation',
						'icon'    => 'fa fa-lightbulb-o',
					)
				),
				//'intro_text'  => __('<br />This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.<br />', 'metcreative'),
				//'footer_text' => __('<br />This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.<br />', 'metcreative'),
			);
		}

        public function setSections() {

			$footer_column_widths = array(
				'3'		=> '3/12',
				'4'		=> '4/12',
				'5'		=> '5/12',
				'6'		=> '6/12',
				'7'		=> '7/12',
				'8'		=> '8/12',
				'9'		=> '9/12',
				'10'	=> '10/12',
				'11'	=> '11/12',
				'12'	=> '12/12',
			);

			/*=========================
			=     GENERAL OPTIONS     =
			=========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-bolt',
				'title' => __('General Options', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'responsive',
						'type'     => 'switch',
						'title'    => __('Responsive Design', 'metcreative'),
						'subtitle' => __('If enabled; theme will be fit every screen size <br> (Recommended for mobile and tablets)', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'loading_bar',
						'type'     => 'switch',
						'title'    => __('Page Loader Bar', 'metcreative'),
						'subtitle' => __('It enables the loading bar at top of your theme', 'metcreative'),
						'default'  => true,
					),
                    array(
                        'id'       => 'smooth_scroll',
                        'type'     => 'switch',
                        'title'    => __('Smooth Scrolling', 'metcreative'),
                        'subtitle' => __('Scrolling becomes soft and smooth.', 'metcreative'),
                        'default'  => true,
                    ),
					array(
						'id'       => 'scroll_up',
						'type'     => 'switch',
						'title'    => __('Scroll to Top Button', 'metcreative'),
						'subtitle' => __('It enables the scroll top button at bottom right of your page', 'metcreative'),
						'default'  => true,
					),

					array(
						'id' => 'custom-codes-start',
						'type' => 'section',
						'title' => __('Custom Codes', 'metcreative'),
						'indent' => false
					),
					array(
						'id'       => 'custom_css',
						'type'     => 'ace_editor',
						'title'    => __('Custom CSS', 'metcreative'),
						'subtitle' => __('Paste your CSS code here.', 'metcreative'),
						'mode'     => 'css',
						'theme'    => 'chrome',
					),
					array(
						'id'       => 'tracking_code',
						'type'     => 'ace_editor',
						'title'    => __('Tracking Code', 'metcreative'),
						'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'metcreative'),
						'mode'     => 'css',
						'theme'    => 'chrome',
					),
					array(
						'id'       => 'custom_head_codes',
						'type'     => 'ace_editor',
						'title'    => __('Custom head codes, before &lt;/head&gt;', 'metcreative'),
						'subtitle' => __('Codes will be append before &lt;/head&gt; tag', 'metcreative'),
						'mode'     => 'css',
						'theme'    => 'chrome',
					),
					array(
						'id'       => 'custom_body_codes',
						'type'     => 'ace_editor',
						'title'    => __('Custom body codes, before &lt;/body&gt;', 'metcreative'),
						'subtitle' => __('Codes will be append before &lt;/body&gt; tag', 'metcreative'),
						'mode'     => 'css',
						'theme'    => 'chrome',
					),
					array(
						'id' => 'custom-codes-end',
						'type' => 'section',
						'indent' => false
					),

					array(
						'id' => 'auto_theme_update-start',
						'type' => 'section',
						'title' => __('Automatic Theme Updates', 'metcreative'),
						'indent' => false
					),
					array(
						'id'          => 'envato_purchase_code',
						'type'        => 'text',
						'title'       => __('Envato Purchase Code', 'metcreative'),
						'subtitle'    => __('You need to use your ThemeForest purchase code just once <br> to enabling automatic theme updates. <br><br> <small><em>P.S. "Automatic updates" does not update the theme files automatically, it means WordPress automatically check and notify if there is a new version available.</em></small>', 'metcreative'),
						'placeholder' => 'Ex: 6c1bcb1e-3ecc-441c-xyza-44c1234ac5c2',
						'hint'        => array(
							'title'   => 'How to find purchase code?',
							'content' => "Click on image to view full size: <br> <a href='".get_template_directory_uri()."/inc/MET/assets/how-to-find-purchase-code.png' target='_blank'><img style='width:270px' src='".get_template_directory_uri()."/inc/MET/assets/how-to-find-purchase-code.png' /></a>"
						)
					),
					array(
						'id' => 'auto_theme_update-end',
						'type' => 'section',
						'indent' => false
					),
				)
			);

			/*======================
			=     LOGO OPTIONS     =
			======================*/
			$this->sections[] = array(
				'icon' => 'fa fa-dot-circle-o',
				'title' => __('Logo Options', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'fav_icon',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => __('Favicon', 'metcreative'),
						'default'  => array(
							'url'  => get_template_directory_uri() . '/img/fav.png'
						),
					),
					array(
						'id'       => 'logo',
						'title'    => __('Logo', 'metcreative'),
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'default'  => array(
							'url'  => get_template_directory_uri() . '/img/logo.png'
						),
					),
					array(
						'id'       => 'logo_height',
						'title'    => __('Logo Height', 'metcreative'),
						'type'     => 'dimensions',
						'mode'     => 'height',
						'units'    => 'px',
						'width'    => false,
						'default'  => array(
							'height'  => '46px'
						),
					),
					array(
						'id' => 'logo_spacing',
						'title' => __('Logo Padding', 'metcreative'),
						'type' => 'spacing',
						'mode' => 'padding',
						'units' => 'px',
						'display_units' => true,
						'default' => array('padding-top' => '20px', 'padding-bottom' => "20px", 'padding-left' => '0px', 'padding-right' => "20px")
					),
					array(
						'id'       => 'logo_retina',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => __('Logo 2x (Retina)', 'metcreative'),
						'desc'	   => __('Dimensions shold be 2x larger than standart logo.', 'metcreative'),
						'default'  => array(
							'url'  => get_template_directory_uri() . '/img/logo@2x.png'
						),
					),
					array(
						'id'       => 'logo_text',
						'type'     => 'text',
						'title'    => __('Logo Text', 'metcreative'),
						'default'  => 'Jade'
					),
					array(
						'id'          => 'logo_text_style',
						'type'        => 'typography',
						'title'       => __('Logo Text Typography', 'metcreative'),
						'desc'        => 'Default: Family: Sintony, Subset: Latin Extended, Weight: Bold 700, Size: 36, Height: 46, Color: #373b3e',
						'google'      => true,
						'font-backup' => true,
						'text-align'  => false,
						'font-style'  => false,
						'units'       => 'px',
						'default'     => array(
							'font-family' => 'Sintony',
							'font-weight' => '700'
						),
						'output'      => array('.met_logo span'),
					),

				)
			);

			/*=============================
			=     STICKY LOGO OPTIONS     =
			=============================*/
			$this->sections[] = array(
				'icon' => 'fa fa-dot-circle-o',
				'subsection' => true,
				'title' => __('Sticky Logo Options', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'sticky_logo_options',
						'type'     => 'switch',
						'title'    => __('Enable Custom Options', 'metcreative'),
						'desc'     => __('If you enable, custom logo options will be in use. If you leave any empty option, main values will be used.', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'sticky_logo',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => __('Logo', 'metcreative'),
						'required' => array('sticky_logo_options','equals',true)
					),
					array(
						'id'       => 'sticky_logo_height',
						'title'    => __('Logo Height', 'metcreative'),
						'type'     => 'dimensions',
						'mode'     => 'height',
						'units'    => 'px',
						'width'    => false,
						'default'  => array(
							'height'  => '46px'
						),
						'required' => array('sticky_logo_options','equals',true)
					),
					array(
						'id' => 'sticky_logo_spacing',
						'type' => 'spacing',
						'mode' => 'padding',
						'units' => 'px',
						'units_extended' => 'true',
						'display_units' => true,
						'title' => __('Logo Padding', 'metcreative'),
						'default' => array('padding-top' => '5px', 'padding-bottom' => "5px", 'padding-left' => '0px', 'padding-right' => "20px"),
						'required' => array('sticky_logo_options', 'equals', true)
					),
					array(
						'id'       => 'sticky_logo_text',
						'type'     => 'text',
						'title'    => __('Logo Text', 'metcreative'),
						'required' => array('sticky_logo_options','equals',true)
					),
					array(
						'id'          => 'sticky_logo_text_style',
						'type'        => 'typography',
						'title'       => __('Logo Text', 'metcreative'),
						'desc'        => 'Default: Family: Sintony, Subset: Latin Extended, Style: Bold 700, Size: 36, Height: 46, Color: #373b3e',
						'google'      => true,
						'font-backup' => true,
						'text-align'  => false,
						'font-style' => false,
						'units'       => 'px',
						'output'      => array('.met_sticky_header .met_logo span'),
						'required' => array('sticky_logo_options','equals',true)
					),

				)
			);

			/*========================
			=     HEADER OPTIONS     =
			========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-list-alt',
				'title' => __('Header Options', 'metcreative'),
				'fields' => array(

                    array(
                        'id'       => 'disable_header',
                        'type'     => 'switch',
                        'title'    => __('Header Status', 'metcreative'),
                        'subtitle' => __('<strong>*Disable or Enable Header</strong>', 'metcreative'),
                        'default'  => true,
                    ),
					array(
						'id'       => 'header_layout',
						'type'     => 'image_select',
						'title'    => __('Header Layout', 'metcreative'),
						'options'  => array(
							'1'      => array(
								'alt'   => __('Header 1', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/header_1.png'
							),
							'2'      => array(
								'alt'   => __('Header 2', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/header_2.png'
							),
							'3'      => array(
								'alt'   => __('Header 3', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/header_3.png'
							),
							'4'      => array(
								'alt'   => __('Header 4', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/header_4.png'
							),
							'5'      => array(
								'alt'   => __('Header 5', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/header_5.png'
							),
						),
						'default' => '1'
					),
					array(
						'id'       => 'sticky_header',
						'type'     => 'switch',
						'title'    => __('Sticky Header', 'metcreative'),
						'subtitle' => __('If enabled; when main navigation unvisible sticky header will be come.', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'header_wide',
						'type'     => 'switch',
						'title'    => __('Sticky Wide Header (100%)', 'metcreative'),
						'desc'     => __('Sticky Header will be 100% width','metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'header_on_content',
						'type'     => 'switch',
						'title'    => __('Header Stays on Content', 'metcreative'),
						'desc'     => __('Make sure you have enough padding for your content or header may cover it.','metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'header_search',
						'type'     => 'switch',
						'title'    => __('Search Form', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'header_lang_selector',
						'type'     => 'switch',
						'title'    => __('Language Selector', 'metcreative'),
						'subtitle' => __('*WPML plugin required', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'		=> 'header_socials',
						'type'		=> 'textarea',
						'title'		=> __('Header Social Codes', 'metcreative'),
						'desc'		=> __('Useful for social share icons, also you can use any HTML codes on here.', 'metcreative'),
						'default'	=> '<a target="_blank" class="met_color_transition" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a>

<a target="_blank" class="met_color_transition" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a>

<a target="_blank" class="met_color_transition" href="https://plus.google.com"><i class="fa fa-google-plus"></i></a>

<a target="_blank" class="met_color_transition" href="http://www.youtube.com"><i class="fa fa-youtube"></i></a>

<a target="_blank" class="met_color_transition" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a>',
					),
				)
			);

			/*================================
			=     HEADER STYLING OPTIONS     =
			=================================*/
			$this->sections[] = array(
				'icon' => 'fa fa-tint',
				'title' => __('Header Styling', 'metcreative'),
				'subsection' => true,
				'fields' => array(
					array(
						'id'       => 'header_borders',
						'type'     => 'border',
						'title'    => __('Header Seperators', 'metcreative'),
						'desc'     => 'Default: 1px solid #edefef',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => false,
						'top'      => true,
						'default'  => array(
							'border-color'  => '#EDEFEF',
							'border-style'  => 'solid',
							'border-top'    => '1px',
						)
					),
					array(
						'id' => 'header_borders_opacity',
						'type' => 'slider',
						'title' => __('Header Seperators Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),

					array(
						'id'       => 'header_bottom_border',
						'type'     => 'border',
						'title'    => __('Header Bottom Border', 'metcreative'),
						'desc'     => 'Default: None',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => true,
						'top'      => false,
						'default'  => array(
							'border-color'  => '',
							'border-style'  => 'solid',
							'border-bottom'    => '0',
						)
					),
					array(
						'id' => 'header_bottom_border_opacity',
						'type' => 'slider',
						'title' => __('Header Bottom Border Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),

					array(
						'id'       => 'header_background',
						'type'     => 'background',
						'title'    => __('Header Background', 'metcreative'),
						'subtitle' => __('Header background with image, color, etc.', 'metcreative'),
						'desc' => 'Default: #ffffff',
						//'output'  => '.met_header_wrap > header'
					),
					array(
						'id' => 'header_background_color_opacity',
						'type' => 'slider',
						'title' => __('Header Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),

					/* ### - Sticky Header - ### */
					array(
						'id' => 'sticky_header_styling-start',
						'type' => 'section',
						'title' => __('Sticky Header Styling', 'metcreative'),
						'indent' => true
					),
					array(
						'id'      => 'sticky_header_height',
						'type'    => 'slider',
						'title'   => __('Sticky Header Height', 'metcreative'),
						'default' => '55',
						'min'     => '45',
						'step'    => '1',
						'max'     => '300',
					),
					array(
						'id'       => 'sticky_header_borders_is_same',
						'type'     => 'switch',
						'title'    => __('Sync with Header Seperators', 'metcreative'),
						'desc'     => __('If enabled, sticky header will use regular header\'s seperators. Disable if you wanna use custom seperators for Sticky Header', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'sticky_header_borders',
						'type'     => 'border',
						'title'    => __('Sticky Header Seperators', 'metcreative'),
						'desc'     => 'Default: 1px solid #edefef',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => false,
						'top'      => true,
						'default'  => array(
							'border-color'  => '#EDEFEF',
							'border-style'  => 'solid',
							'border-top'    => '1px',
						)
					),
					array(
						'id' => 'sticky_header_borders_opacity',
						'type' => 'slider',
						'title' => __('Sticky Header Seperators Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),

					array(
						'id'       => 'sticky_header_bottom_border_is_same',
						'type'     => 'switch',
						'title'    => __('Sync with Header Bottom Border', 'metcreative'),
						'desc'     => __('If enabled, sticky header will use regular header bottom border. Disable if you wanna use custom bottom border for Sticky Header', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'sticky_header_bottom_border',
						'type'     => 'border',
						'title'    => __('Sticky Header Bottom Border', 'metcreative'),
						'desc'     => 'Default: 1px solid #edefef',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => true,
						'top'      => false,
						'default'  => array(
							'border-color'  => '#EDEFEF',
							'border-style'  => 'solid',
							'border-bottom'    => '1px',
						)
					),
					array(
						'id' => 'sticky_header_bottom_border_opacity',
						'type' => 'slider',
						'title' => __('Sticky Header Bottom Border Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),

					array(
						'id'       => 'sticky_header_background_is_same',
						'type'     => 'switch',
						'title'    => __('Sync with Header Background', 'metcreative'),
						'desc'     => __('If enabled, sticky header will use regular header background. Disable if you wanna use custom background options for Sticky Header', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'sticky_header_background',
						'type'     => 'background',
						'title'    => __('Sticky Header Background', 'metcreative'),
						'subtitle' => __('Sticky Header background with image, color, etc.', 'metcreative'),
						'desc' => 'Default: #ffffff',
					),
					array(
						'id' => 'sticky_header_background_color_opacity',
						'type' => 'slider',
						'title' => __('Sticky Header Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id' => 'sticky_header_styling-end',
						'type' => 'section',
						'indent' => false
					),

					/* ### - Header Misc - ### */
					array(
						'id' => 'header_misc_styling-start',
						'type' => 'section',
						'title' => __('Header Misc Styling', 'metcreative'),
						'indent' => true
					),
					array(
						'type' => 'color',
						'id' => 'social_icon_color',
						'title' => __('Social Icons Color', 'metcreative'),
						'desc' => 'Default: #afafaf',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.met_header_socials a')
					),
					array(
						'type' => 'color',
						'id' => 'search_icon_color',
						'title' => __('Search Icon Color', 'metcreative'),
						'desc' => 'Default: #b6b6b6',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.met_header_search')
					),
					array(
						'type' => 'color',
						'id' => 'language_selector_text_color',
						'title' => __('Language Selector Text Color', 'metcreative'),
						'desc' => 'Default: #b6b6b6',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.met_active_language')
					),
					array(
						'id' => 'header_misc_styling-end',
						'type' => 'section',
						'indent' => false
					),

				)
			);

			/*============================
			=     NAVIGATION OPTIONS     =
			============================*/
			$this->sections[] = array(
				'icon' => 'fa fa-link',
				'title' => __('Navigation Options', 'metcreative'),
				'fields' => array(
					array(
						'id' => 'met-top-level-items-section-start',
						'type' => 'section',
						'title' => __('Top Level', 'metcreative'),
						'indent' => true
					),
                    array(
                        'id'          => 'primary_nav_typography',
                        'type'        => 'typography',
                        'title'       => __('Navigation Link Typography', 'metcreative'),
                        'google'      => true,
                        'font-backup' => true,
                        'units'       =>'px',
                        'text-align'  => false,
						'color'       => false,
						'text-transform' => true,
						'default'     => array(
							'font-size'   => '14px',
							'line-height' => '22px',
							'font-weight' => '700',
							'text-transform' => 'none',
						),
						'output'      => array('.met_primary_nav > li > a'),
                    ),
                    array(
                        'id'		=> 'primary_nav_text_color',
                        'type'		=> 'link_color',
                        'title'		=> __('Navigation Link Color', 'metcreative'),
                        'desc'		=> 'Default: Regular: #797F83, Hover: #FFFFFF, Active: #FFFFFF,',
                        'visited'	=> false,
                        'default'	=> array(
                            'regular'  => '',
                            'hover'    => '',
                            'active'   => ''
                        )
                    ),
                    array(
                        'id'		=> 'primary_nav_bg_color',
                        'type'		=> 'link_color',
                        'title'		=> __('Navigation Link Background Color', 'metcreative'),
                        'desc'		=> 'Default: Regular: #FFFFFF, Hover: #FFCA07, Active: #FFCA07,',
                        'visited'	=> false,
                        'default'	=> array(
                            'regular'  => '',
                            'hover'    => '',
                            'active'   => ''
                        )
                    ),
					array(
						'id' => 'primary_nav_bg_color_opacity',
						'type' => 'slider',
						'title' => __('Navigation Link Background Color Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'title'     => __('Navigation Link Padding', 'metcreative'),
						'id'        => 'primary_nav_first_level_paddings',
						'type'      => 'spacing',
						'output'    => array('.met_header_menu.met_primary_nav > li > a'),
						'mode'      => 'padding',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'padding-left'  => '',
							'padding-right' => '',
							'padding-top' => '',
							'padding-bottom' => '',
						)
					),
					array(
						'id'       => 'primary_nav_item_borders',
						'type'     => 'border',
						'title'    => __('Navigation Link Border', 'metcreative'),
						'all'      => false,
						'output'   => array('.met_header_menu.met_primary_nav > li.menu-item')
					),
					array(
						'id'       => 'primary_nav_desc_status',
						'type'     => 'switch',
						'title'    => __('Top Level "Description" Display', 'metcreative'),
						'sub_title'=> __('Appearance -> Menus -> Screen Options -> Check "Description" box.', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'          => 'primary_nav_desc_typography',
						'type'        => 'typography',
						'title'       => __('Top Level "Description" Typography', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'units'       =>'px',
						'text-align'  => false,
						'color'       => false,
						'text-transform' => true,
						'font-family' => false,
						'output'      => array('.met_primary_nav > li > a .met-menu-item-desc'),
                        'default'     => array(
                            'font-size'     => '11px',
                            'line-height'   => '11px',
                            'text-transform'=> 'uppercase'
                        )
					),
					array(
						'id'     => 'met-top-level-items-section-end',
						'type'   => 'section',
						'indent' => false,
					),


                    /*
					 * SUB LEVEL
					 * */
					array(
						'id' => 'met-sub-level-items-section-start',
						'type' => 'section',
						'title' => __('Sub Level', 'metcreative'),
						'subtitle' => __('a.k.a: Dropdown', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'primary_nav_dropdown_width',
						'type'     => 'dimensions',
						'units'    => array('px'),
						'title'    => __('Sub Level Minimum Width', 'metcreative'),
						'desc'     => __('Default: 195px', 'metcreative'),
						'height'   => false,
						'default'  => array(),
						'output'   => array('.met_primary_nav > li > ul li.menu-item'),
					),
					array(
						'id'       => 'primary_nav_dropdown_bg_color',
						'type'     => 'background',
						'title'    => __('Sub Level Background Color', 'metcreative'),
						'desc'     => __('Default color: #FFFFFF', 'metcreative'),
						'output'   => array('.met_primary_nav li ul.sub-menu,.met_primary_nav > li.menu-item:not(.met_primary_nav_mega):not(.met_primary_nav_mega_posts):not(.met_primary_nav_posts) > ul li ul'),
						'default'  => array()
					),
					array(
						'id'       => 'primary_nav_dropdown_top_border',
						'type'     => 'border',
						'title'    => __('Sub Level Top Border', 'metcreative'),
						'desc'     => 'Default: 3px solid #FFCA07',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => false,
						'top'      => true,
						'output'   => array('.met_primary_nav > li.menu-item > ul','.met_primary_nav > li.menu-item:not(.met_primary_nav_mega):not(.met_primary_nav_mega_posts):not(.met_primary_nav_posts) > ul li ul')
					),
					array(
						'title'     => __('Sub Level Padding', 'metcreative'),
						'id'        => 'primary_nav_dropdown_paddings',
						'type'      => 'spacing',
						'output'    => array('.met_primary_nav > li > ul.sub-menu'),
						'mode'      => 'padding',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'padding-left'  => '',
							'padding-right' => '',
							'padding-top' => '',
							'padding-bottom' => '',
						)
					),
					array(
						'id'          => 'primary_nav_dropdown_typography',
						'type'        => 'typography',
						'title'       => __('Sub Level Link Typography', 'metcreative'),
						'google'      => false,
						'font-backup' => false,
						'output'      => array('.met_primary_nav > li.menu-item ul a.menu-link'),
						'units'       =>'px',
						'color'       => false,
						'text-transform' => false,
						'text-align' => false,
						'color'      => false,
						'default' => array(
							'font-size'   => '12px',
							'line-height' => '22px',
							'font-weight' => '400',
						)
					),
					array(
						'id'		=> 'primary_nav_dropdown_text_color',
						'type'		=> 'link_color',
						'title'		=> __('Sub Level Link Colors', 'metcreative'),
						'desc'		=> 'Default: Regular: #010101, Hover: #010101, Active: #010101,',
						'visited'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => '',
							'active'   => ''
						)
					),
					array(
						'id'		=> 'primary_nav_dropdown_item_bg_color',
						'type'		=> 'link_color',
						'title'		=> __('Sub Level Link Background Colors', 'metcreative'),
						'desc'		=> 'Default: Regular: #000000, Hover: #F8F8F8, Active: #000000,',
						'visited'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => '',
							'active'   => ''
						)
					),
					array(
						'id' => 'primary_nav_dropdown_item_bg_color_opacity',
						'type' => 'slider',
						'title' => __('Sub Level Link Background Color Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
                    array(
                        'title'     => __('Sub Level Link Paddings', 'metcreative'),
                        'id'        => 'primary_nav_dropdown_item_paddings',
                        'type'      => 'spacing',
                        'output'    => array('.met_primary_nav > li.menu-item ul a.menu-link'),
                        'mode'      => 'padding',
                        'units'     => 'px',
                        'units_extended'    => 'true',
                        'display_units'     => true,
                        'default'	=> array(
                            'padding-left'  => '15px',
                            'padding-right' => '15px',
                            'padding-top' => '10px',
                            'padding-bottom' => '10px',
                        )
                    ),
					array(
						'id'       => 'primary_nav_dropdown_desc_status',
						'type'     => 'switch',
						'title'    => __('Sub Level "Description" Display', 'metcreative'),
						'sub_title'=> __('Appearance -> Menus -> Screen Options -> Check "Description" box.', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'          => 'primary_nav_dropdown_desc_typography',
						'type'        => 'typography',
						'title'       => __('Sub Level "Description" Typography', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'units'       =>'px',
						'text-align'  => false,
						'color'       => false,
						'text-transform' => true,
						'font-family' => true,
						'output'      => array('.met_primary_nav > li.menu-item ul a .met-menu-item-desc'),
                        'default'     => array(
                            'font-size'     => '9px',
                            'line-height'   => '11px',
                            'font-family'   => 'Verdana, sans',
                            'font-weight'   => '400',
                            'text-transform'=> 'uppercase'
                        )
					),
					array(
						'id'     => 'met-sub-level-items-section-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			/*==========================
			=     SIDE NAV OPTIONS     =
			==========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-indent',
				'title' => __('Sidenav Options', 'metcreative'),
				'fields' => array(

					array(
						'id'       => 'sidenav_status',
						'type'     => 'switch',
						'title'    => __('Enable Side Navigation', 'metcreative'),
						'subtitle'    => __('This is global display option for The Side Navigation, you can enable/disable page by page when you editing pages.', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'sidenav_position',
						'type'     => 'radio',
						'title'    => __('Sidenav Position', 'metcreative'),
						'options'  => array(
							'left' => __('Left','metcreative'),
							'right' => __('Right','metcreative'),
						),
						'default' => 'left'
					),
					array(
						'id'       => 'sidenav_sticky',
						'type'     => 'switch',
						'title'    => __('Sidenav Sticky', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'sidenav_logo_status',
						'type'     => 'switch',
						'title'    => __('Enable Sidenav Logo', 'metcreative'),
						'default'  => true,
					),

					array(
						'id' => 'sidenav_topbar-start',
						'type' => 'section',
						'title' => __('Top Bar', 'metcreative'),
						'subtitle' => __('Secondary Menu & Language Selector', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'sidenav_topbar_status',
						'type'     => 'switch',
						'title'    => __('Enable SideNav Top Bar', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'sidenav_secondary_menu_status',
						'type'     => 'switch',
						'title'    => __('Secondary Menu', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'sidenav_lang_selector',
						'type'     => 'switch',
						'title'    => __('Language Selector', 'metcreative'),
						'subtitle' => __('*WPML plugin required', 'metcreative'),
						'default'  => true,
					),
					array(
						'id' => 'sidenav_topbar-end',
						'type'   => 'section',
						'indent' => false,
					),

					array(
						'id' => 'sidenav_bottombar-start',
						'type' => 'section',
						'title' => __('Bottom Bar', 'metcreative'),
						'subtitle' => __('Search Form & Social Codes', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'sidenav_search',
						'type'     => 'switch',
						'title'    => __('Search Form', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'		=> 'sidenav_socials',
						'type'		=> 'textarea',
						'title'		=> __('Social Codes', 'metcreative'),
						'desc'		=> __('Useful for social share icons, also you can use any HTML codes on here.', 'metcreative'),
						'default'	=> '<a target="_blank" class="met_color_transition" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a>

<a target="_blank" class="met_color_transition" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a>

<a target="_blank" class="met_color_transition" href="https://plus.google.com"><i class="fa fa-google-plus"></i></a>

<a target="_blank" class="met_color_transition" href="http://www.youtube.com"><i class="fa fa-youtube"></i></a>

<a target="_blank" class="met_color_transition" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a>',
					),
					array(
						'id' => 'sidenav_topbar-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			/*=================================
			=     SIDENAV STYLING OPTIONS     =
			=================================*/
			$this->sections[] = array(
				'icon' => 'fa fa-tint',
				'title' => __('Sidenav Styling', 'metcreative'),
				'subsection' => true,
				'fields' => array(
					array(
						'id'       => 'sidenav_background',
						'type'     => 'background',
						'title'    => __('Sidenav Background', 'metcreative'),
						'subtitle' => __('Sidenav background with image, color, etc.', 'metcreative'),
						'desc' => 'Default: #ffffff',
						'output'  => '.met_side_navbar_wrap'
					),
					array(
						'id' => 'sidenav_background_color_opacity',
						'type' => 'slider',
						'title' => __('Sidenav Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id'       => 'sidenav_outside_border',
						'type'     => 'border',
						'title'    => __('Sidenav Left/Right Border', 'metcreative'),
						'desc'     => 'Default: 1 solid #EAEAEA',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => false,
						'top'      => true,
						'default'  => array(
							'border-color'  => '#eaeaea',
							'border-style'  => 'solid',
							'border-top'    => '1px',
						)
					),

					/* ### - SideNav | Header - ### */
					array(
						'id' => 'sidenav_top_bar-start',
						'type' => 'section',
						'title' => __('Sidenav Header', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'sidenav_top_bar_background',
						'type'     => 'color_rgba',
						'title'    => __('Header Background', 'metcreative'),
						'default'  => array(
							'color' => '#FFFFFF',
							'alpha' => '0'
						),
						'output'   => array('.met_side_navbar_linkstop'),
						'mode'     => 'background',
					),
					array(
						'id'       => 'sidenav_top_bar_border',
						'type'     => 'border',
						'title'    => __('Header Border', 'metcreative'),
						'desc'     => 'Default: 1 solid #EAEAEA',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => true,
						'top'      => false,
						'default'  => array(
							'border-color'  => '#eaeaea',
							'border-style'  => 'solid',
							'border-bottom' => '1px',
						),
						'output'  => '.met_side_navbar_linkstop'
					),
					array(
						'id'		=> 'sidenav_top_bar_text_color',
						'type'		=> 'link_color',
						'title'		=> __('Header Link Color', 'metcreative'),
						'desc'		=> 'Default: Regular: #AFAFAF, Hover: #AFAFAF',
						'visited'	=> false,
						'active'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => ''
						),
						'output'  => '.met_header_links a'
					),
					array(
						'id' => 'sidenav_top_bar-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - SideNav | Top Level - ### */
					array(
						'id' => 'sidenav-top-level-start',
						'type' => 'section',
						'title' => __('Top Level', 'metcreative'),
						'indent' => true
					),
					array(
						'id'          => 'sidenav_menu_typography',
						'type'        => 'typography',
						'title'       => __('Navigation Link Typography', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('.met_side_navbar .met_primary_nav > li > a'),
						'units'       =>'px',
						'color'       => false,
						'text-transform' => true,
						'default'	=> array(
							'text-transform' => 'uppercase',
							'line-height'    => '30px',
							'text-align'     => 'center',
							'font-size'      => '14px',
							'font-weight'    => '700'
						)
					),
					array(
						'id'		=> 'sidenav_menu_text_color',
						'type'		=> 'link_color',
						'title'		=> __('Navigation Link Color', 'metcreative'),
						'desc'		=> 'Default: Regular: #797F83, Hover: #FFFFFF, Active: #FFFFFF,',
						'visited'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => '',
							'active'   => ''
						)
					),
					array(
						'id'		=> 'sidenav_menu_bg_color',
						'type'		=> 'link_color',
						'title'		=> __('Navigation Link Background Color', 'metcreative'),
						'desc'		=> 'Default: Regular: #FFFFFF, Hover: #FFCA07, Active: #FFCA07,',
						'visited'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => '',
							'active'   => ''
						)
					),
					array(
						'id' => 'sidenav_menu_bg_opacity',
						'type' => 'slider',
						'title' => __('Sidenav Link Background Color Opacity', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id' => 'sidenav-top-level-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - SideNav | Sub Level - ### */
					array(
						'id' => 'sidenav_sub_level-start',
						'type' => 'section',
						'title' => __('Sub Level', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'sidenav_sub_menu_max_width',
						'type'     => 'dimensions',
						'units'    => 'px',
						'title'    => __('Sub Menu Max Width', 'metcreative'),
						'height'   => false,
						'default'  => array(
							'width' => '1230px'
						)
					),
					array(
						'id'       => 'sidenav_sub_menu_top_border',
						'type'     => 'border',
						'title'    => __('Sub Menu Top Border', 'metcreative'),
						'desc'     => 'Default: 3px solid #FFCA07',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => false,
						'top'      => true,
						'output'   => array('.met_side_navbar .met_primary_nav > li.menu-item > ul','.met_primary_nav > li.menu-item:not(.met_primary_nav_mega):not(.met_primary_nav_mega_posts):not(.met_primary_nav_posts) > ul li ul')
					),
					array(
						'id'		=> 'sidenav_menu_dropdown_text_color',
						'type'		=> 'link_color',
						'title'		=> __('Sub Level Link Color', 'metcreative'),
						'desc'		=> 'Default: Regular: #010101, Hover: #010101, Active: #FFFFFF,',
						'visited'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => '',
							'active'   => ''
						)
					),
					array(
						'id'		=> 'sidenav_menu_dropdown_bg_color',
						'type'		=> 'link_color',
						'title'		=> __('Sub Level Link Background Color', 'metcreative'),
						'desc'		=> 'Default: Regular: #FFFFFF, Hover: #FFFFFF, Active: #FFCA07,',
						'visited'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => '',
							'active'   => ''
						)
					),
					array(
						'id' => 'sidenav_sub_level-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - SideNav | Footer Bar - ### */
					array(
						'id' => 'sidenav_footer-start',
						'type' => 'section',
						'title' => __('Sidenav Footer', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'sidenav_footer_search_background',
						'type'     => 'color_rgba',
						'title'    => __('Search Input Background', 'metcreative'),
						'default'  => array(
							'color' => '#FAFAFA',
							'alpha' => '1.0'
						),
						'output'   => array('.met_sidenav_search,.met_sidenav_search button'),
						'mode'     => 'background',
					),
					array(
						'id'       => 'sidenav_footer_search_border',
						'type'     => 'border',
						'title'    => __('Search Input Border', 'metcreative'),
						'desc'     => 'Default: 1 solid #EAEAEA',
						'all'      => false,
						'left'     => false,
						'right'    => false,
						'bottom'   => true,
						'top'      => true,
						'default'  => array(
							'border-color'  => '#EDEFEF',
							'border-style'  => 'solid',
							'border-bottom' => '1px',
						),
						'output'  => '.met_sidenav_search'
					),
					array(
						'id'		=> 'sidenav_footer_search_color',
						'type'		=> 'color',
						'title'     => __('Search Input Color', 'metcreative'),
					    'transparent' => false,
						//'desc'		=> 'Default: Regular: #AFAFAF, Hover: #AFAFAF',
						//'default'	=> '',
						'output'  => '.met_sidenav_search,.met_sidenav_search button'
					),
					array(
						'id'		=> 'sidenav_footer_socials',
						'type'		=> 'link_color',
						'title'		=> __('Social Icons Color', 'metcreative'),
						//'desc'		=> 'Default: Regular: #AFAFAF, Hover: #AFAFAF',
						'visited'	=> false,
						'active'	=> false,
						'default'	=> array(
							'regular'  => '',
							'hover'    => ''
						),
						'output'  => '.met_header_socials.met_sidenav_socials a'
					),
					array(
						'id' => 'sidenav_footer-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			/*============================
			=     MEGA MENU OPTIONS     =
			============================*/
			$_mmm_th_effects = array(
				'bubba'          => __('Effect 1','metcreative'),
				'sarah'          => __('Effect 2','metcreative'),
				'sadie'          => __('Effect 3','metcreative'),
				'chico'          => __('Effect 4','metcreative'),
			);

			$this->sections[] = array(
				'icon' => 'fa fa-sitemap',
				'title' => __('Mega Menu Options', 'metcreative'),
				'desc' => __('This options only valid for MC Mega Menu plugin.', 'metcreative'),
				'fields' => array(
					array(
						'id' => 'mmm-top-level-items-section-start',
						'type' => 'section',
						'title' => __('Top Level', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_top_level_icon_position',
						'type'     => 'button_set',
						'title'    => __('Navigation Icon Position', 'metcreative'),
						'options' => array(
							'left' => 'Left',
							'right' => 'Right'
						),
						'default' => 'left'
					),
					array(
						'id'       => 'mmm_top_level_icon_default',
						'type'     => 'MC_fa_selector',
						'title'    => __('Navigation Default Icon', 'metcreative'),
						'placeholder' => 'No Icon',
						'default' => ''
					),
					array(
						'id'     => 'mmm-top-level-items-section-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - SUB LEVEL - ### */
					array(
						'id' => 'mmm-sub-level-items-section-start',
						'type' => 'section',
						'title' => __('Sub Level', 'metcreative'),
						'subtitle' => __('a.k.a: Dropdown, Columns', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_column_min_width',
						'type'     => 'dimensions',
						'units'    => array('px'),
						'title'    => __('Column Minimum Width', 'metcreative'),
						'desc'     => __('Default: 195px', 'metcreative'),
						'height'   => false,
						'default'  => array(),
						'output'   => array('.met_primary_nav li.menu-item.met_primary_nav_mega ul li.menu-item'),
					),

					array(
						'id'       => 'mmm_column_divider_width',
						'type'     => 'dimensions',
						'units'    => 'px',
						'title'    => __('Column Vertical Divider Width', 'metcreative'),
						'height'   => false,
						'default'  => array(
							'width' => '1'
						),
						'output'   => array('.met_primary_nav_mega > ul > li.menu-item-has-children:after'),
					),
					array(
						'id'       => 'mmm_column_divider_color',
						'type'     => 'color',
						'title'    => __('Column Vertical Divider Color', 'metcreative'),
						'subtitle' => __('Apperance -> Menus -> Menu Options -> Mega Menu', 'metcreative'),
						'output'   => array('background' => '.met_primary_nav_mega > ul > li.menu-item-has-children:after'),
						'default'  => '#EDEFEF'
					),
					array(
						'id'          => 'mmm_sub_level_highlight_typography',
						'type'        => 'typography',
						'title'       => __('Sub Level "Highlight Label" Typography', 'metcreative'),
						'subtitle'       => __('Apperance -> Menus -> Display Options -> Hightlight Label', 'metcreative'),
						'font-backup' => false,
						'output'      => array('.met_primary_nav > li.menu-item ul a.menu-link.mmm_highlight_label'),
						'units'       =>'px',
						'text-transform' => false,
						'font-family' => false,
						'default' => array(
							'font-size' => '18px',
							'line-height' => '24px',
							'font-weight' => '700',
							'color' => '#373B3E'
						)
					),
					array(
						'id'       => 'mmm_sub_level_highlight_borders',
						'type'     => 'border',
						'title'    => __('Sub Level "Highlight Label" Borders', 'metcreative'),
						'subtitle'       => __('Apperance -> Menus -> Display Options -> Hightlight Label', 'metcreative'),
						'all'      => false,
						'output'   => array('.met_primary_nav > li ul a.mmm_highlight_label'),
						'default'  => array(
							'border-color'  => '#EDEFEF',
							'border-style'  => 'solid',
							'border-top'    => '0',
							'border-right'  => '0',
							'border-bottom' => '1px',
							'border-left'   => '0'
						),
					),
					array(
						'id'       => 'mmm_sub_level_highlight_icon_disable',
						'type'     => 'switch',
						'title'    => __('Disable icons on "Hightlight Label"', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'mmm_sub_level_icon_default',
						'type'     => 'MC_fa_selector',
						'title'    => __('Sub Level Default Icon', 'metcreative'),
						'placeholder' => 'No Icon',
						'default' => 'fa-caret-right'
					),
					array(
						'id'       => 'mmm_sub_level_icon_status',
						'type'     => 'button_set',
						'title'    => __('Sub Level Default Icon Visibility', 'metcreative'),
						'options'  => array(
							'none'          => __('Hide Always','metcreative'),
							'inline-block'  => __('Display Always','metcreative'),
							'displaychild'  => __('Display only Has Child','metcreative'),
						),
						'default' => 'none'
					),
					array(
						'id'     => 'mmm-sub-level-items-section-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - LATEST POSTS - ### */
					array(
						'id' => 'mmm-latest-posts-section-start',
						'type' => 'section',
						'title' => __('Latest Posts', 'metcreative'),
						'subtitle' => __('Apperance -> Menus -> Menu Options -> Latest Posts','metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_posts_background',
						'type'     => 'background',
						'title'    => __('Container Background Color', 'metcreative'),
						'desc'     => __('Default color: #FFFFFF', 'metcreative'),
						'output' => array('ul.met_megamenu_posts'),
						'default' => array()
					),
					array(
						'title'     => __('Container Padding', 'metcreative'),
						'id'        => 'mmm_posts_padding',
						'type'      => 'spacing',
						'mode'      => 'padding',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'padding-left'  => '0',
							'padding-right' => '18px',
							'padding-top' => '18px',
							'padding-bottom' => '0',
						),
						'output'    => array('.met_primary_nav > li > ul.met_megamenu_posts'),
					),
					array(
						'id'       => 'mmm_posts_item_size',
						'type'     => 'dimensions',
						'units'    => 'px',
						'title'    => __('Post Thumbnail Size', 'metcreative'),
						'default'  => array(
							'width'   => '211',
							'height'  => '130'
						),
						//'output'    => array('.met_megamenu_post_item'),
					),
					array(
						'title'     => __('Post Thumbnail Margin', 'metcreative'),
						'id'        => 'mmm_posts_item_margin',
						'type'      => 'spacing',
						'mode'      => 'margin',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'margin-left'  => '18px',
							'margin-right' => '0',
							'margin-top' => '0',
							'margin-bottom' => '18px',
						),
						//'output'    => array('.met_megamenu_post_item'),
					),
					array(
						'id'       => 'mmm_posts_item_effect',
						'type'     => 'button_set',
						'title'    => __('Post Thumbnail Hover Effect', 'metcreative'),
						'options'  => $_mmm_th_effects,
						'default' => 'sarah'
					),
					array(
						'id' => 'mmm-latest-posts-section-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - TABBED POSTS - ### */
					array(
						'id' => 'mmm-tabbed-posts-section-start',
						'type' => 'section',
						'title' => __('Tabbed Posts', 'metcreative'),
						'subtitle' => __('Apperance -> Menus -> Menu Options -> Tabbed Posts', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_tabbed_posts_background',
						'type'     => 'background',
						'title'    => __('Container Background Color', 'metcreative'),
						'desc'     => __('Default color: #FFFFFF', 'metcreative'),
						//'output' => array('ul.met_megamenu_posts'),
						'default' => array()
					),
					array(
                        'id'          => 'mmm_tabbed_posts_item_typography',
                        'type'        => 'typography',
                        'title'       => __('Tabbed Post Overlay Typography', 'metcreative'),
                        'google'      => true,
                        'color'         => false,
                        'font-backup' => false,
                        'output'      => array('.mmm_grid li h2'),
                        'units'       =>'px',
                        'text-transform' => true,
                        'text-align'  => false,
                        'font-family' => true,
                        'default'     => array(
                            'font-size' => '18px',
                            'line-height' => '21px',
                            'font-family' => 'Sintony, sans',
                            'text-transform' => 'uppercase'
                        ),
                    ),
                    array(
                        'id'       => 'mmm_tabbed_posts_item_overlay_background',
                        'type'     => 'background',
                        'title'    => __('Post Item Hover Background Color', 'metcreative'),
                        'desc'     => __('Default color: #3085a3', 'metcreative'),
                        'output' => array('.mmm_grid li'),
                        'color' => true,
                        'background-repeat' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'background-image' => false,
                        'default' => array()
                    ),
					array(
						'id'       => 'mmm_tabbed_posts_item_size',
						'type'     => 'dimensions',
						'units'    => 'px',
						'title'    => __('Tabbed Post Thumbnail Size', 'metcreative'),
						'default'  => array(
							'width'   => '224',
							'height'  => '175'
						),
					),
					array(
						'title'     => __('Tabbed Post Thumbnail Margin', 'metcreative'),
						'id'        => 'mmm_tabbed_item_margin',
						'type'      => 'spacing',
						'mode'      => 'margin',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'margin-left' 		=> '8px',
							'margin-right' 		=> '8px',
							'margin-top' 		=> '0',
							'margin-bottom' 	=> '0',
						),
					),
					array(
						'id'       => 'mmm_tabbed_item_effect',
						'type'     => 'button_set',
						'title'    => __('Tabbed Post Thumbnail Effect', 'metcreative'),
						'options'  => $_mmm_th_effects,
						'default' => 'chico'
					),
					array(
						'id'     => 'mmm-tabbed-posts-section-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - ADVANCED HTML - ### */
					array(
						'id' => 'mmm-advanced-section-start',
						'type' => 'section',
						'title' => __('Advanced (HTML)', 'metcreative'),
						'subtitle' => __('Apperance -> Menus -> Menu Options -> Advanced (HTML)', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_advanced_content_background',
						'type'     => 'background',
						'title'    => __('Content Background Color', 'metcreative'),
						'output' => array('ul.mmm-advanced'),
						'default' => array()
					),
					array(
						'id'          => 'mmm_advanced_content_typography',
						'type'        => 'typography',
						'title'       => __('Content Typography', 'metcreative'),
						'google'      => false,
						'font-backup' => false,
						'output'      => array('.met_megamenu_advanced_content'),
						'units'       =>'px',
						'text-transform' => false,
						'text-align'  => false,
						'font-family' => false,
						'default'     => array(
							'font-size' => '12px',
							'line-height' => '22px'
						),
					),
					array(
						'title'     => __('Content Padding', 'metcreative'),
						'id'        => 'mmm_advanced_content_padding',
						'type'      => 'spacing',
						'mode'      => 'padding',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'padding-left'  => '10px',
							'padding-right' => '10px',
							'padding-top' => '10px',
							'padding-bottom' => '10px',
						),
						//'output'    => array('.met_megamenu_advanced_content'),
					),
					array(
						'id'     => 'mmm-advanced-section-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - WIDGET - ### */
					array(
						'id' => 'mmm-sidebar-section-start',
						'type' => 'section',
						'title' => __('Widget Styling', 'metcreative'),
						'subtitle' => __('Apperance -> Menus -> Mega Menu Options (Column) -> Widget', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_sidebar_widget_width',
						'type'     => 'dimensions',
						'units'    => 'px',
						'title'    => __('Widget Width', 'metcreative'),
						'height'   => false,
						'default'  => array(
							'width'   => '300'
						),
						'output'    => array('.mmm-column-0 .mmm-sidebar'),
					),
					array(
						'id'          => 'mmm_sidebar_widget_typography',
						'type'        => 'typography',
						'title'       => __('Widget Typography', 'metcreative'),
						'google'      => false,
						'font-backup' => false,
						'output'      => array('.mmm-widget'),
						'units'       =>'px',
						'text-transform' => false,
						'text-align'  => false,
						'font-family' => false,
						'default'     => array(
							'font-size' => '12px',
							'line-height' => '22px'
						),
					),
					array(
						'title'     => __('Widget Padding', 'metcreative'),
						'id'        => 'mmm_sidebar_widget_padding',
						'type'      => 'spacing',
						'mode'      => 'padding',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'default'	=> array(
							'padding-left'   => '10px',
							'padding-right'  => '10px',
							'padding-top'    => '20px',
							'padding-bottom' => '0',
						),
						'output'    => array('.mmm-widget'),
					),
					array(
						'id'          => 'mmm_sidebar_widget_title_typography',
						'type'        => 'typography',
						'title'       => __('Widget Title Typography', 'metcreative'),
						'output'      => array('.mmm-widget .mmm-widget-title'),
						'units'       =>'px',
						'font-family' => false,
						'default'     => array(
							'font-weight'  => '700',
							'font-size' => '14px',
							'line-height' => '25px',
						),
					),
					array(
						'id'       => 'mmm_sidebar_widget_title_border',
						'type'     => 'border',
						'title'    => __('Widget Title Borders', 'metcreative'),
						'output'   => array('.mmm-widget .mmm-widget-title'),
						'all'      => false,
						'default'  => array(
							'border-color'  => '#eaeaea',
							'border-style'  => 'solid',
							'border-top'    => '0',
							'border-right'  => '0',
							'border-bottom' => '1px',
							'border-left'   => '0'
						)
					),
					array(
						'id'     => 'mmm-sidebar-section-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - DIVIDER - ### */
					array(
						'id' => 'mmm-divider-section-start',
						'type' => 'section',
						'title' => __('Divider Styling', 'metcreative'),
						'subtitle' => __('Apperance -> Menus -> Mega Menu Options (Column) -> Divider "a.k.a: Start New Row"'),
						'indent' => true
					),
					array(
						'id'       => 'mmm_divider_height',
						'type'     => 'dimensions',
						'units'    => 'px',
						'title'    => __('Divider Height', 'metcreative'),
						'width'   => false,
						'default'  => array(
							'height'   => '1'
						),
						'output'    => array('li.menu-item-is-divider'),
					),
					array(
						'id'       => 'mmm_divider_background',
						'type'     => 'color',
						'title'    => __('Divider Color', 'metcreative'),
						'output'    => array('background-color' => 'li.menu-item-is-divider'),
						'validate' => 'color',
						'transparent'     => false,
					),
					array(
						'title'     => __('Divider Margin', 'metcreative'),
						'id'        => 'mmm_divider_margin',
						'type'      => 'spacing',
						'mode'      => 'margin',
						'units'     => 'px',
						'units_extended'    => 'true',
						'display_units'     => true,
						'left' => false,
						'right' => false,
						'output'    => array('li.menu-item-is-divider'),
					),
					array(
						'id'     => 'mmm-divider-section-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			/*======================================
			=     PAGE INFORMATION BAR OPTIONS     =
			======================================*/
			$this->sections[] = array(
				'icon' => 'fa fa-bookmark',
				'title' => __('Page Information Bar', 'metcreative'),
				'desc' => __('<p class="description"><img src="'.get_template_directory_uri().'/inc/MET/assets/the_pib.png"> <br> *PIB = Page Information Bar</p>', 'metcreative'),
				'fields' => array(

					array(
						'id'       => 'pib_status',
						'type'     => 'switch',
						'title'    => __('Enable The PIB', 'metcreative'),
						'subtitle'    => __('This is global display option for The PIB, you can enable/disable page by page when you editing pages.', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'pib_height',
						'type'     => 'dimensions',
						'units'    => array('px'),
						'title'    => __('PIB Height', 'metcreative'),
						'subtitle' => __('You need to change description and title height accordingly pib height for vertical align.', 'metcreative'),
						'desc'     => __('Default: None', 'metcreative'),
						'width'    => false,
						'default'  => array(),
						'output' => array('.met_page_head'),
					),
					array(
						'id'       => 'pib_background',
						'type'     => 'background',
						'title'    => __('PIB Background', 'metcreative'),
						'subtitle' => __('PIB background with image, color, etc.', 'metcreative'),
						'desc'     => __('Default color: #F5F5F5', 'metcreative'),
						'output' => array('.met_page_head'),
						'default' => array()
					),
					array(
						'id'       => 'pib_borders',
						'type'     => 'border',
						'title'    => __('PIB Borders', 'metcreative'),
						'desc'     => __('Default: 1px solid #EAEBEB', 'metcreative'),
						'output'   => array('.met_page_head_wrap .met_fullwidth_item'),
						'all' => false,
						'left' => false,
						'right' => false,
						'default'  => array()
					),
					array(
						'id'          => 'pib_description_font',
						'type'        => 'typography',
						'title'       => __('PIB Page Description Font', 'metcreative'),
						'desc'        => __('Default: Size: 16px, Height: 60px, Color: #74706D', 'metcreative'),
						'google'      => false,
						'font-backup' => false,
						'output'      => array('.met_page_head h2'),
						'units'       => 'px',
						'text-align'  => false,
						'font-family' => false,
						'font-style'  => false,
						'font-weight' => false,
						'color'       => true,
						'default'     => array(),
					),
					array(
						'id' => 'pib_title_background',
						'type'     => 'background',
						'title' => __('PIB Title Background', 'metcreative'),
						'desc'  => __('Default: #373B3E', 'metcreative'),
						'background-repeat' => false,
						'background-attachment' => false,
						'background-position' => false,
						'background-image' => false,
						'background-size' => false,
						'preview' => false,
						'transparent' => true,
						'default' => array(),
						'output'  => array('.met_page_head h1')
					),
					array(
						'id'          => 'pib_title_font',
						'type'        => 'typography',
						'title'       => __('PIB Page Title Font', 'metcreative'),
						'desc'        => __('Default: Size: 24px, Height: 60px, Color: #FFFFFF', 'metcreative'),
						'google'      => false,
						'font-backup' => false,
						'output'      => array('.met_page_head h1'),
						'units'       => 'px',
						'text-align'  => false,
						'font-family' => false,
						'font-style'  => false,
						'font-weight' => false,
						'color'       => true,
						'default'     => array(),
					),
					array(
						'id'       => 'pib_title_arrow',
						'type'     => 'switch',
						'title'    => __('PIB Page Title Arrow', 'metcreative'),
						'default'  => true,
					),
					array(
						'type' => 'color',
						'id' => 'pib_title_arrow_color',
						'title' => __('PIB Page Title Arrow Color', 'metcreative'),
						'desc'  => __('Default: #373B3E','metcreative'),
						'default' => '',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'id'       => 'pib_title_arrow_top',
						'type'     => 'text',
						'title'    => __('PIB Page Title Arrow Top Margin', 'metcreative'),
						'subtitle' => __('in pixels', 'metcreative'),
						'desc'     => __('Default: 22', 'metcreative'),
						'validate' => 'no_special_chars',
					),
					array(
						'id'       => 'pib_breadcrumb',
						'type'     => 'switch',
						'title'    => __('PIB Breadcrumb', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'          => 'pib_breadcrumb_font',
						'type'        => 'typography',
						'title'       => __('PIB Breadcrumb Font', 'metcreative'),
						'desc'        => __('Default: Size: 12px, Height: 60px, Color: #888381', 'metcreative'),
						'google'      => false,
						'font-backup' => false,
						'output'      => array('.met_breadcrumb li'),
						'units'       => 'px',
						'text-align'  => false,
						'font-family' => false,
						'font-style'  => false,
						'font-weight' => false,
						'color'       => true,
						'default'     => array(),
					),
					array(
						'type' => 'color',
						'id' => 'pib_breadcrumb_sep',
						'title' => __('PIB Separator Color', 'metcreative'),
						'desc'  => __('Default: Primary Color 2(#9f4641)','metcreative'),
						'default' => '',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.met_breadcrumb li.sep'),
					),
					array(
						'type' => 'color',
						'id' => 'pib_breadcrumb_link',
						'title' => __('PIB Link Color', 'metcreative'),
						'desc'  => __('Default: Primary Color 2(#9f4641)','metcreative'),
						'default' => '',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.met_breadcrumb li a'),
					),
				)
			);

			/*========================
			=     FOOTER OPTIONS     =
			========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-download',
				'title' => __('Footer Options', 'metcreative'),
				'fields' => array(

                    array(
                        'id'       => 'disable_footer',
                        'type'     => 'switch',
                        'title'    => __('Footer Status', 'metcreative'),
                        'subtitle' => __('<strong>*Disable or Enable Footer</strong>', 'metcreative'),
                        'default'  => true,
                    ),
					array(
						'id'       => 'footer_layout',
						'type'     => 'image_select',
						'title'    => __('Footer Layout', 'metcreative'),
						'options'  => array(
							'1'      => array(
								'alt'   => __('Footer Layout 1', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/footer_1.png'
							),
							'2'      => array(
								'alt'   => __('Footer Layout 2', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/footer_2.png'
							),
							'3'      => array(
								'alt'   => __('Footer Layout 3', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/footer_3.png'
							),
							'4'      => array(
								'alt'   => __('Footer Layout 4', 'metcreative'),
								'img'   => get_template_directory_uri().'/inc/MET/assets/footer_4.png'
							)
						),
						'default' => '1'
					),

					/* ### - Footer | LAYOUT 1 - ### */
					array(
						'id' => 'footer_layout_one-start',
						'type' => 'section',
						'title' => __('Layout 1', 'metcreative'),
						'subtitle' => __('<strong>*Following options only valid for Footer Layout 1</strong>', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'footer_widgets_area',
						'type'     => 'switch',
						'title'    => __('Enable Footer Widget Columns', 'metcreative'),
						'subtitle' => __('For managing footer widgets go <strong>Appearance -> Widgets</strong>', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'footer_column_no',
						'type'     => 'radio',
						'title'    => __('Footer Column No', 'metcreative'),
						'subtitle' => __('How many widgetized column will be shown on footer.', 'metcreative'),
						'options'  => array(
							'1' => __('One Column','metcreative'),
							'2' => __('Two Columns','metcreative'),
							'3' => __('Three Columns','metcreative'),
							'4' => __('Four Columns','metcreative')
						),
						'default' => '3'
					),
					array(
						'id'       => 'footer_column_1_width',
						'type'     => 'select',
						'title'    => __('Footer Column One Width', 'metcreative'),
						'options'  => $footer_column_widths,
						'default'  => '4',
					),
					array(
						'id'       => 'footer_column_2_width',
						'type'     => 'select',
						'title'    => __('Footer Column Two Width', 'metcreative'),
						'options'  => $footer_column_widths,
						'default'  => '4',
					),
					array(
						'id'       => 'footer_column_3_width',
						'type'     => 'select',
						'title'    => __('Footer Column Three Width', 'metcreative'),
						'options'  => $footer_column_widths,
						'default'  => '4',
					),
					array(
						'id'       => 'footer_column_4_width',
						'type'     => 'select',
						'title'    => __('Footer Column Four Width', 'metcreative'),
						'desc'     => __('Total columns width will be <strong>12</strong> <br> <strong>For Example:</strong> If you choose "Three Columns" option Column One: <strong>4</strong> + Column Two: <strong>4</strong> + Column Three: <strong>4</strong> = <strong>12</strong> <br> <strong>Example 2:</strong> If you choose "Two Columns" option Column One: <strong>8</strong> + Column Two: <strong>4</strong> = <strong>12</strong>','metcreative'),
						'options'  => $footer_column_widths,
						'default'  => '',
					),
					array(
						'id'       => 'footer_bar',
						'type'     => 'switch',
						'title'    => __('Show Footer Bar', 'metcreative'),
						'subtitle' => __('Navigation/Custom Text & Social Icons', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'footer_bar_area_one_type',
						'type'     => 'radio',
						'title'    => __('Footer Bar Area One Type', 'metcreative'),
						'options'  => array(
							'1' => __('Navigation','metcreative'),
							'2' => __('Custom Text','metcreative'),
						),
						'default' => '1'
					),
					array(
						'id'     => 'footer_layout_one-end',
						'type'   => 'section',
						'indent' => false,
					),

					/* ### - Footer | Shared Options - ### */
					array(
						'id' => 'footer_shared_options-start',
						'type' => 'section',
						'title' => __('Shared Options', 'metcreative'),
						'subtitle' => __('*Following options valid for all footer layouts.', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'footer_custom_text',
						'type'     => 'ace_editor',
						'title'    => __('Footer Custom Text', 'metcreative'),
						'subtitle' => __('Useful for copyright text, etc. <br><br> <i>*HTML tags, shortcodes allowed.</i>', 'metcreative'),
						'mode'     => 'html',
						'theme'    => 'chrome',
						'default'  => 'Copyright © 2014 | by METCreative'
					),
					array(
						'id'		=> 'footer_socials',
						'type' 		=> 'multi_text',
						'title' 	=> __('Footer Social Network Icons', 'metcreative'),
						'subtitle' 	=> __('Please take a look documentation for understanding social icons editing.<br><br>Markup;<br> <strong>fa-<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">icon-class</a>|page-url</strong>', 'metcreative'),
						'default' 	=> array('fa-facebook|http://www.facebook.com/','fa-twitter|http://twitter.com/','fa-google-plus|https://plus.google.com/','fa-xing|#','fa-pinterest|#','fa-linkedin|#','fa-flickr|#'),
					),
					array(
						'id'     => 'footer_shared_options-end',
						'type'   => 'section',
						'indent' => false,
					),

				)
			);

			/*========================
			=     FOOTER STYLING     =
			========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-tint',
				'title' => __('Footer Styling', 'metcreative'),
				'subsection' => true,
				'fields' => array(
					array(
						'type' => 'color',
						'id' => 'footer_text_color',
						'title' => __('Footer Text Color', 'metcreative'),
						'desc' => 'Default: #83817f',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.footer','.met_footer_twit_item:before')
					),
					array(
						'type' => 'color',
						'id' => 'footer_heading_color',
						'title' => __('Footer Heading Color', 'metcreative'),
						'desc' => 'Default: #ffffff',
						'validate' => 'color',
						'transparent' => false,
						'output'      => array('.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6')
					),
					array(
						'id'       => 'footer_link_color',
						'type'     => 'link_color',
						'title'    => __('Footer Link Color', 'metcreative'),
						'desc'     => 'Default: Regular: #ffffff, Hover: #9f4641',
						'active'   => false,
						'output'   => array('.footer a','.footer .met_footer_menu a','.footer .met_footer_socials a')
					),
					array(
						'id'       => 'footer_background',
						'type'     => 'background',
						'title'    => __('Footer Background', 'metcreative'),
						'subtitle' => __('Footer background with image, color, etc.', 'metcreative'),
						'desc' => 'Default: #373b3d',
						'output'  => array('.footer')
					),
					array(
						'id' => 'footer_background_color_opacity',
						'type' => 'slider',
						'title' => __('Footer Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id'       => 'footer_border',
						'type'     => 'border',
						'title'    => __('Footer Border', 'metcreative'),
						'output'   => array('.footer'),
					),

					/* ### - Layout 2 - ### */
					array(
						'id' => 'footer-styling-layout_2-start',
						'type' => 'section',
						'title' => __('Layout 2', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'footer_layout_2_background',
						'type'     => 'background',
						'title'    => __('Footer Layout 2 Background', 'metcreative'),
						'subtitle' => __('Footer Layout 2 background with image, color, etc.', 'metcreative'),
						'desc'     => 'Default: #393F4A',
						'output'   => array('.met_flat_footer .footer')
					),
					array(
						'id' => 'footer_layout_2_background_color_opacity',
						'type' => 'slider',
						'title' => __('Footer Layout 2 Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id' =>          'footer_layout_2_padding',
						'type'           => 'spacing',
						'mode'           => 'padding',
						'units'          => 'px',
						'units_extended' => false,
						'title'          => __('Footer Layout 2 Padding', 'metcreative'),
						'default'            => array(
							'padding-top'    => '75px',
							'padding-right'  => '0',
							'padding-bottom' => '75px',
							'padding-left'   => '0',
						),
						'output'         => array('.met_flat_footer .footer'),
					),
					array(
						'id'       => 'footer_layout_2_link_color',
						'type'     => 'link_color',
						'title'    => __('Footer Layout 2 Menu Color', 'metcreative'),
						'desc'     => 'Default: Regular: #ffffff, Hover: #90A6BF',
						'active'   => false,
						'output'   => array('.met_flat_footer .footer .met_footer_menu a')
					),
					array(
						'id'       => 'footer_layout_2_social_color',
						'type'     => 'link_color',
						'title'    => __('Footer Layout 2 Social Icons Color', 'metcreative'),
						'desc'     => 'Default: Regular: #B0B0B0',
						'active'   => false,
						'output'   => array('.met_flat_footer .footer .met_footer_socials a')
					),
					array(
						'id'       => 'footer_layout_2_bar_background',
						'type'     => 'background',
						'title'    => __('Footer Layout 2 Bar Background', 'metcreative'),
						'subtitle' => __('Footer Layout 2 background with image, color, etc.', 'metcreative'),
						'desc'     => 'Default: #393F4A',
						'output'   => array('.met_flat_footer_bar')
					),
					array(
						'id' => 'footer_layout_2_bar_background_color_opacity',
						'type' => 'slider',
						'title' => __('Footer Layout 2 Bar Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id' =>          'footer_layout_2_bar_padding',
						'type'           => 'spacing',
						'mode'           => 'padding',
						'units'          => 'px',
						'units_extended' => false,
						'title'          => __('Footer Layout 2 Bar Padding', 'metcreative'),
						'default'            => array(
							'padding-top'    => '30px',
							'padding-right'  => '0',
							'padding-bottom' => '30px',
							'padding-left'   => '0',
						),
						'output'         => array('.met_flat_footer_bar'),
					),
					array(
						'id'          => 'footer_layout_2_bar_typography',
						'type'        => 'typography',
						'title'       => __('Footer Layout 2 Bar Typography', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'units'       =>'px',
						'default'     => array(
							'color'       => '#90A6BF',
							'font-size'   => '12px',
							'font-weight' => '700',
						),
						'output'      => array('.met_flat_footer .met_flat_copyright'),
					),
					array(
						'id' => 'footer-styling-layout_2-end',
						'type' => 'section',
						'indent' => false
					),

					array(
						'id' => 'footer-styling-layout_3-start',
						'type' => 'section',
						'title' => __('Layout 3', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'footer_layout_3_background',
						'type'     => 'background',
						'title'    => __('Footer Layout 3 Background', 'metcreative'),
						'subtitle' => __('Footer Layout 3 background with image, color, etc.', 'metcreative'),
						'desc'     => 'Default: #ffffff',
						'output'   => array('.met_onepage_footer .footer')
					),
					array(
						'id' => 'footer_layout_3_background_color_opacity',
						'type' => 'slider',
						'title' => __('Footer Layout 3 Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id' =>          'footer_layout_3_padding',
						'type'           => 'spacing',
						'mode'           => 'padding',
						'units'          => 'px',
						'units_extended' => false,
						'title'          => __('Footer Layout 3 Padding', 'metcreative'),
						'default'            => array(
							'padding-top'    => '35px',
							'padding-right'  => '0',
							'padding-bottom' => '35px',
							'padding-left'   => '0',
						),
						'output'         => array('.met_onepage_footer .footer'),
					),
					array(
						'id'          => 'footer_layout_3_text_typography',
						'type'        => 'typography',
						'title'       => __('Footer Layout 3 Typography', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'units'       =>'px',
						'default'     => array(
							'color'       => '#363A3D',
							'font-size'   => '16px',
							'line-height' => '20px',
						),
						'output'      => array('.met_onepage_footer_copyright'),
					),
					array(
						'id'       => 'footer_layout_3_social_color',
						'type'     => 'link_color',
						'title'    => __('Footer Layout 3 Social Icons Color', 'metcreative'),
						'desc'     => 'Default: Regular: #83817F',
						'active'   => false,
						'output'   => array('.met_onepage_footer .met_footer_socials')
					),
					array(
						'id' => 'footer-styling-layout_3-end',
						'type' => 'section',
						'indent' => false
					),

					array(
						'id' => 'footer-styling-layout_4-start',
						'type' => 'section',
						'title' => __('Layout 4', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'footer_layout_4_background',
						'type'     => 'background',
						'title'    => __('Footer Layout 4 Background', 'metcreative'),
						'subtitle' => __('Footer Layout 4 background with image, color, etc.', 'metcreative'),
						'desc'     => 'Default: #ffffff',
						'output'   => array('.met_slim_footer .footer')
					),
					array(
						'id' => 'footer_layout_4_background_color_opacity',
						'type' => 'slider',
						'title' => __('Footer Layout 4 Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id' =>          'footer_layout_4_padding',
						'type'           => 'spacing',
						'mode'           => 'padding',
						'units'          => 'px',
						'units_extended' => false,
						'title'          => __('Footer Layout 4 Padding', 'metcreative'),
						'output'         => array('.met_slim_footer .footer'),
					),
					array(
						'id'          => 'footer_layout_4_text_typography',
						'type'        => 'typography',
						'title'       => __('Footer Layout 4 Typography', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'units'       =>'px',
						'default'     => array(
							'color'       => '#909091',
							'font-size'   => '12px',
							'line-height' => '50px',
						),
						'output'      => array('.met_slim_footer_copyright'),
					),
					array(
						'id'       => 'footer_layout_4_social_color',
						'type'     => 'link_color',
						'title'    => __('Footer Layout 4 Social Icons Color', 'metcreative'),
						'desc'     => 'Default: Regular: #83817F',
						'active'   => false,
						'output'   => array('.met_slim_footer .met_footer_socials a')
					),
					array(
						'id' => 'footer-styling-layout_4-end',
						'type' => 'section',
						'indent' => false
					),
				)
			);

			/*============================
			=     BACKGROUND OPTIONS     =
			============================*/
			$this->sections[] = array(
				'icon' => 'fa fa-square',
				'title' => __('Background Options', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'boxed_layout',
						'type'     => 'switch',
						'title'    => __('Boxed Layout', 'metcreative'),
						'subtitle' => __('You need to enable boxed layout for background color or background image options', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'body_background',
						'type'     => 'background',
						'title'    => __('Background', 'metcreative'),
						'subtitle' => __('Body background with image, color, etc.', 'metcreative'),
						'output' => array('body'),
						'default' => array(
							'background-color'  => '#efeee9',
						)
					),
					array(
						'id' => 'body_background_color_opacity',
						'type' => 'slider',
						'title' => __('Body Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
					array(
						'id'   => 'info_normal',
						'type' => 'info',
						'title'=> __('Content Background Options','metcreative'),
						'desc' => __('You can use this options for content area background styling. Available for boxed or wide layout both.', 'metcreative')
					),
					array(
						'id'       => 'content_background',
						'type'     => 'background',
						'title'    => __('Content Background', 'metcreative'),
						'subtitle' => __('Content background with image, color, etc.', 'metcreative'),
						'output' => array('.met_boxed_layout .met_page_wrapper','.met_page_wrapper'),
						'default' => array(
							'background-color'  => '#ffffff',
						)
					),
					array(
						'id' => 'content_background_color_opacity',
						'type' => 'slider',
						'title' => __('Content Background Color Opacity', 'metcreative'),
						'subtitle' => __('*Only works with background "color", if background image is not exist.', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
					),
				)
			);

			/*============================
			=     TYPOGRAPHY OPTIONS     =
			============================*/
			$this->sections[] = array(
				'icon'  => 'fa fa-text-height',
				'title' => __('Typography', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'font_smoothing',
						'type'     => 'switch',
						'title'    => __('Font Smoothing', 'metcreative'),
						'desc'     => __('If you enable, font smoothing will be used when available.', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'          => 'body_font',
						'type'        => 'typography',
						'title'       => __('Body Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('body'),
						'units'       => 'px',
						'text-align'  => false,
						'color'       => true,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '14px',
							'line-height' => '22px',
							'color'       => '#888381',
                            'font-weight' => '400'
						),
					),
					array(
						'id'          => 'h1_font',
						'type'        => 'typography',
						'title'       => __('Heading 1 (H1) Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('h1'),
						'units'       => 'px',
						'text-align'  => false,
						'line-height' => false,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '38px',
							'color'       => '#393939',
                            'font-weight' => '700'
						),
					),
					array(
						'id'          => 'h2_font',
						'type'        => 'typography',
						'title'       => __('Heading 2 (H2) Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('h2'),
						'units'       => 'px',
						'text-align'  => false,
						'line-height' => false,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '32px',
							'color'       => '#393939',
                            'font-weight' => '700'
						),
					),
					array(
						'id'          => 'h3_font',
						'type'        => 'typography',
						'title'       => __('Heading 3 (H3) Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('h3'),
						'units'       => 'px',
						'text-align'  => false,
						'line-height' => false,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '24px',
							'color'       => '#393939',
                            'font-weight' => '700'
						),
					),
					array(
						'id'          => 'h4_font',
						'type'        => 'typography',
						'title'       => __('Heading 4 (H4) Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('h4'),
						'units'       => 'px',
						'text-align'  => false,
						'line-height' => false,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '18px',
							'color'       => '#393939',
                            'font-weight' => '700'
						),
					),
					array(
						'id'          => 'h5_font',
						'type'        => 'typography',
						'title'       => __('Heading 5 (H5) Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('h5'),
						'units'       => 'px',
						'text-align'  => false,
						'line-height' => false,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '14px',
							'color'       => '#393939',
                            'font-weight' => '700'
						),
					),
					array(
						'id'          => 'h6_font',
						'type'        => 'typography',
						'title'       => __('Heading 6 (H6) Font', 'metcreative'),
						'google'      => true,
						'font-backup' => true,
						'output'      => array('h6'),
						'units'       => 'px',
						'text-align'  => false,
						'line-height' => false,
						'default'     => array(
							'font-style'  => 'normal',
							'font-family' => 'Sintony',
							'subsets'     => 'latin-ext',
							'google'      => true,
							'font-size'   => '12px',
							'color'       => '#393939',
                            'font-weight' => '700'
						),
					)

				)
			);

			/*=========================
			=     STYLING OPTIONS     =
			=========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-tint',
				'title' => __('Styling', 'metcreative'),
				'fields' => array(
					array(
						'type' => 'color',
						'id' => 'met_color',
						'title' => __('Primary Color 1', 'metcreative'),
						'desc' => 'Default: #ffca07',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'met_color2',
						'title' => __('Primary Color 2', 'metcreative'),
						'desc' => 'Default: #9f4641',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'met_hover_color',
						'title' => __('Primary "Hover" Color', 'metcreative'),
						'desc' => 'Default: #ffca07',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'met_bgcolor',
						'title' => __('Primary "Background" Color 1', 'metcreative'),
						'desc' => 'Default: #ffca07',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'met_bgcolor2',
						'title' => __('Primary "Background" Color 2', 'metcreative'),
						'desc' => 'Default: #9f4641',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'met_color_transition',
						'title' => __('Primary "Transition" Color 1', 'metcreative'),
						'desc' => 'Default: #ffca07',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'met_color_transition2',
						'title' => __('Primary "Transition" Color 2', 'metcreative'),
						'desc' => 'Default: #9f4641',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'body_text_color',
						'title' => __('Primary(Body) "Text" Color', 'metcreative'),
						'desc' => 'Default: #888381',
						'validate' => 'color',
						'transparent' => false,
						'output'  => array('body')
					),
					array(
						'type' => 'color',
						'id' => 'content_bgcolor',
						'title' => __('Content Background Color', 'metcreative'),
						'desc' => 'Default: #efeee9',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'id'   => 'info_selection_colors',
						'type' => 'info',
						'desc' => __('Selection Colors', 'metcreative')
					),
					array(
						'type' => 'color',
						'id' => 'selection_color',
						'title' => __('Selection Color', 'metcreative'),
						'desc' => 'Default: #ffffff',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'type' => 'color',
						'id' => 'selection_background',
						'title' => __('Selection Background', 'metcreative'),
						'desc' => 'Default: #ffca07',
						'validate' => 'color',
						'transparent' => false,
					),
					array(
						'id'   => 'core_elements_styling',
						'type' => 'info',
						'desc' => __('Core Elements Styling', 'metcreative')
					),
					array(
						'title' => __('Body Padding', 'metcreative'),
						'id' => 'body_spacing',
						'type' => 'spacing',
						'output' => array('body'),
						'mode' => 'padding',
						'right' => false,
						'left' => false,
						'units' => 'px',
						'units_extended' => 'true',
						'display_units' => true,
					),
					array(
						'title' => __('Content Padding', 'metcreative'),
						'id' => 'content_spacing',
						'type' => 'spacing',
						'output' => array('.met_boxed_layout .met_page_wrapper'),
						'mode' => 'padding',
						'units' => 'px',
						'units_extended' => 'true',
						'display_units' => true,
                        'default' => array(
                            'padding-top' => '0px',
                            'padding-right' => '30px',
                            'padding-bottom' => '30px',
                            'padding-left' => '30px',
                        )
					),

				)
			);

			/*======================
			=     BLOG OPTIONS     =
			======================*/
			$this->sections[] = array(
				'icon' => 'fa fa-quote-right',
				'title' => __('Blog', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'blog_sidebar_position',
						'type'     => 'radio',
						'title'    => __('Blog Sidebar Position', 'metcreative'),
						'options'  => array(
							'disable' 	=> __('No Sidebar', 'metcreative'),
							'left' 		=> __('Left', 'metcreative'),
							'right' 	=> __('Right', 'metcreative')
						),
						'default' => 'right'
					),
					array(
						'id'       => 'blog_listing_layout',
						'type'     => 'radio',
						'title'    => __('Blog Listing Layout', 'metcreative'),
						'options'  => array(
							'classic' 	=> __('Classic', 'metcreative'),
							'masonry' 	=> __('Masonry', 'metcreative'),
						),
						'default' => 'classic'
					),
					array(
						'id'       => 'blog_listing_masonry_column_no',
						'type'     => 'radio',
						'title'    => __('Masonry Layout Column No', 'metcreative'),
						'options'  => array(
							'1' 	=> __('1 Column', 'metcreative'),
							'2' 	=> __('2 Columns', 'metcreative'),
							'3' 	=> __('3 Columns', 'metcreative'),
							'4' 	=> __('4 Columns', 'metcreative'),
						),
						'default' => '2'
					),
					array(
						'id'       => 'blog_pagination_layout',
						'type'     => 'radio',
						'title'    => __('Blog Pagination Layout', 'metcreative'),
						'options'  => array(
							'classic' 	=> __('Prev/Next', 'metcreative'),
							'numeric' 	=> __('Numbered', 'metcreative'),
						),
						'default' => 'classic'
					),
					array(
						'id'   => 'blog_listing_post_animation_title',
						'type' => 'info',
						'desc' => __('Blog Listing Animation Options', 'metcreative')
					),
					array(
						'id'       => 'blog_listing_post_animation',
						'type'     => 'select',
						'title'    => __('Blog Listing Post Animation', 'metcreative'),
						'options'  => array(
							'none' 	            => __('None', 'metcreative'),
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
						'default' => 'none'
					),
					array(
						'id' => 'blog_listing_post_animation_duration',
						'type' => 'slider',
						'title' => __('Animation Duration', 'metcreative'),
						'subtitle' => __('How long to take when animating by seconds?', 'metcreative'),
						"default" => 1,
						"min" => 0,
						"step" => .1,
						"max" => 10,
						'resolution' => 0.1,
					),
					array(
						'id' => 'blog_listing_post_animation_delay',
						'type' => 'slider',
						'title' => __('Animation Delay', 'metcreative'),
						'subtitle' => __('How long to take before starting animation by seconds?', 'metcreative'),
						"default" => 0,
						"min" => 0,
						"step" => .1,
						"max" => 10,
						'resolution' => 0.1,
					),
					array(
						'id' => 'blog_listing_post_animation_offset',
						'type' => 'slider',
						'title' => __('Animation Offset (px)', 'metcreative'),
						'subtitle' => __('If you don\'t want to start animation right after when element visible by user increase this.', 'metcreative'),
						"default" => 100,
						"min" => 0,
						"step" => 50,
						"max" => 1000,
					),
					array(
						'id'   => 'info_blog_listing_options',
						'type' => 'info',
						'desc' => __('Blog Listing Page Options', 'metcreative')
					),
					array(
						'id'       => 'blog_listing_content_type',
						'type'     => 'radio',
						'title'    => __('Blog Listing Content Type', 'metcreative'),
						'options'  => array(
							'content' 	=> __('Content', 'metcreative'),
							'excerpt' 	=> __('Excerpt', 'metcreative'),
						),
						'default' => 'content'
					),
					array(
						'id'       => 'blog_excerpt_length',
						'type'     => 'text',
						'title'    => __('Custom Excerpt Length', 'metcreative'),
						'default'  => '100'
					),
					array(
						'id'       => 'blog_excerpt_more',
						'type'     => 'text',
						'title'    => __('Excerpt More Text', 'metcreative'),
						'default'  => '[...]'
					),

					//Blog Listing Post Elements
					array(
						'id'       => 'blog_listing_meta_date',
						'type'     => 'switch',
						'title'    => __('Show "DATE" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_listing_meta_category',
						'type'     => 'switch',
						'title'    => __('Show "CATEGORY" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_listing_meta_author',
						'type'     => 'switch',
						'title'    => __('Show "AUTHOR" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_listing_meta_comments_number',
						'type'     => 'switch',
						'title'    => __('Show "Comments Count" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_listing_meta_tags',
						'type'     => 'switch',
						'title'    => __('Show "Tags" Button', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_listing_meta_readmore',
						'type'     => 'switch',
						'title'    => __('Show "Read More" Button', 'metcreative'),
						'default'  => true,
					),

					//Blog Detail Post Elements
					array(
						'id'   => 'info_blog_detail_page_options',
						'type' => 'info',
						'desc' => __('Blog Detail Page Options', 'metcreative')
					),
					array(
						'id'       => 'blog_detail_meta_date',
						'type'     => 'switch',
						'title'    => __('Show "DATE" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_meta_category',
						'type'     => 'switch',
						'title'    => __('Show "CATEGORY" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_meta_author',
						'type'     => 'switch',
						'title'    => __('Show "AUTHOR" Meta Info', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_meta_tags',
						'type'     => 'switch',
						'title'    => __('Show "Tag" List', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_meta_socials',
						'type'     => 'switch',
						'title'    => __('Show "Social Share" icons', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_meta_socials_code',
						'type'     => 'ace_editor',
						'title'    => __('Social Share Icons', 'metcreative'),
						'subtitle' => __('Please take a look documentation for understanding social icons editing.<br><br>Markup;<br> <strong>fa-<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">icon-class</a>|share-url</strong> <br><br>Shortcodes for URL;<br><strong>[permalink]</strong><br><strong>[post-title]</strong> ', 'metcreative'),
						'mode'     => 'html',
						'theme'    => 'chrome',
						'default'  => 'fa-facebook|http://www.facebook.com/sharer.php?u=[permalink]
fa-twitter|http://twitter.com/home?status=[post-title]%20-%20[permalink]
fa-google-plus|https://plus.google.com/share?url=[permalink]
fa-pinterest|javascript:void((function(){var e=document.createElement(\'script\'); e.setAttribute(\'type\',\'text/javascript\'); e.setAttribute(\'charset\',\'UTF-8\'); e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)})());'
					),
					array(
						'id'       => 'blog_detail_meta_authorbox',
						'type'     => 'switch',
						'title'    => __('Show "About The Author"', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_releated_posts_widget',
						'type'     => 'switch',
						'title'    => __('Show "Releated Posts" Widget', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'blog_detail_comment_section',
						'type'     => 'switch',
						'title'    => __('Show "Comments" Section', 'metcreative'),
						'default'  => true,
					),

				)
			);

			/*=========================
			=     PROJECT OPTIONS     =
			=========================*/
			$this->sections[] = array(
				'icon' => 'fa fa-trophy',
				'title' => __('Projects', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'projects_label',
						'type'     => 'text',
						'title'    => __('Projects Label', 'metcreative'),
						'default'  => 'Portfolio',
					),
					array(
						'id'       => 'projects_item_label',
						'type'     => 'text',
						'title'    => __('Projects Item Label', 'metcreative'),
						'default'  => 'Portfolio Detail',
					),
					array(
						'id'        => 'projects_listing_page',
						'type'      => 'select',
						'data'      => 'pages',
						'title'     => __('Projects Page', 'metcreative'),
					),

					/* ### - Project Detail Elements - ### */
					array(
						'id' => 'project_detail-start',
						'type' => 'section',
						'title' => __('Project Detail Page Options', 'metcreative'),
						'indent' => true
					),
					array(
						'id'       => 'project_detail_meta_date',
						'type'     => 'switch',
						'title'    => __('Show "DATE" Meta Info', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'project_detail_meta_category',
						'type'     => 'switch',
						'title'    => __('Show "CATEGORY" Meta Info', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'project_detail_meta_author',
						'type'     => 'switch',
						'title'    => __('Show "AUTHOR" Meta Info', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'project_detail_meta_tags',
						'type'     => 'switch',
						'title'    => __('Show "Tag" List', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'project_detail_meta_socials',
						'type'     => 'switch',
						'title'    => __('Show "Social Share" icons', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'project_detail_meta_socials_code',
						'type'     => 'ace_editor',
						'title'    => __('Social Share Icons', 'metcreative'),
						'subtitle' => __('Please take a look documentation for understanding social icons editing.<br><br>Markup;<br> <strong>fa-<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">icon-class</a>|share-url</strong> <br><br>Shortcodes for URL;<br><strong>[permalink]</strong><br><strong>[post-title]</strong> ', 'metcreative'),
						'mode'     => 'html',
						'theme'    => 'chrome',
						'default'  => 'fa-facebook|http://www.facebook.com/sharer.php?u=[permalink]
fa-twitter|http://twitter.com/home?status=[post-title]%20-%20[permalink]
fa-google-plus|https://plus.google.com/share?url=[permalink]
fa-pinterest|javascript:void((function(){var e=document.createElement(\'script\'); e.setAttribute(\'type\',\'text/javascript\'); e.setAttribute(\'charset\',\'UTF-8\'); e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)})());'
					),
					array(
						'id'       => 'project_detail_meta_authorbox',
						'type'     => 'switch',
						'title'    => __('Show "About The Author"', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'project_detail_comment_section',
						'type'     => 'switch',
						'title'    => __('Show "Comments" Section', 'metcreative'),
						'default'  => false,
					),
					array(
						'id'       => 'project_detail_recent_works_widget',
						'type'     => 'switch',
						'title'    => __('Show "Recent Works" Widget', 'metcreative'),
						'default'  => true,
					),
					array(
						'id' => 'project_detail-end',
						'type' => 'section',
						'indent' => false
					),

				)
			);

			/*=============================
			=     WOOCOMMERCE OPTIONS     =
			=============================*/
			$woo_pif_animation_in_types = array(
				'none' 	            => __('None', 'metcreative'),
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
			);

			$woo_pif_animation_out_types = array(
				'none' 	            => __('None', 'metcreative'),

				'bounceOut'          => 'bounceOut',
				'bounceOutDown'      => 'bounceOutDown',
				'bounceOutLeft'      => 'bounceOutLeft',
				'bounceOutRight'     => 'bounceOutRight',
				'bounceOutUp'        => 'bounceOutUp',

				'fadeOut'            => 'fadeOut',
				'fadeOutDown'        => 'fadeOutDown',
				'fadeOutLeft'        => 'fadeOutLeft',
				'fadeOutRight'       => 'fadeOutRight',
				'fadeOutUp'          => 'fadeOutUp',

				'flipOutX'           => 'flipOutX',
				'flipOutY'           => 'flipOutY',

				'rotateOut'          => 'rotateOut',
				'rotateOutDownLeft'  => 'rotateOutDownLeft',
				'rotateOutDownRight' => 'rotateOutDownRight',
				'rotateOutUpLeft'    => 'rotateOutUpLeft',
				'rotateOutUpRight'   => 'rotateOutUpRight',

				'rollOut'            => 'rollOut',

				'zoomOut'            => 'zoomOut',
				'zoomOutDown'        => 'zoomOutDown',
				'zoomOutLeft'        => 'zoomOutLeft',
				'zoomOutRight'       => 'zoomOutRight',
				'zoomOutUp'          => 'zoomOutUp',

				'hinge'              => 'hinge',
			);

			$this->sections[] = array(
				'icon' => 'fa fa-shopping-cart',
				'title' => __('WooCommerce', 'metcreative'),
				'desc' => __('<p class="description">Please visit "WooCommerce -> Settings" on Admin menu for more settings.</p>', 'metcreative'),
				'fields' => array(
					array(
						'id'       => 'woo_listing_column_no',
						'type'     => 'radio',
						'title'    => __('Product Listing Column No', 'metcreative'),
						'options'  => array(
							'1' 	=> __('1 Column', 'metcreative'),
							'2' 	=> __('2 Columns', 'metcreative'),
							'3' 	=> __('3 Columns', 'metcreative'),
							'4' 	=> __('4 Columns', 'metcreative'),
						),
						'default' => '3'
					),
					array(
						'id'       => 'woo_item_per_page',
						'type'     => 'spinner',
						'title'    => __('Product Per Page', 'metcreative'),
						'default'  => '12',
						'min'      => '6',
						'step'     => '1',
						'max'      => '100',
					),
					array(
						'id'       => 'woo_listing_sidebar_position',
						'type'     => 'radio',
						'title'    => __('Product Listing Sidebar Position', 'metcreative'),
						'options'  => array(
							'disable' 	=> __('No Sidebar', 'metcreative'),
							'left' 		=> __('Left', 'metcreative'),
							'right' 	=> __('Right', 'metcreative')
						),
						'default' => 'right'
					),
					array(
						'id'       => 'woo_detail_sidebar_position',
						'type'     => 'radio',
						'title'    => __('Product Detail Sidebar Position', 'metcreative'),
						'options'  => array(
							'disable' 	=> __('No Sidebar', 'metcreative'),
							'left' 		=> __('Left', 'metcreative'),
							'right' 	=> __('Right', 'metcreative')
						),
						'default' => 'right'
					),

					/* ### - Product Image Flipper - ### */
					array(
						'id' 		=> 'woo_pif-start',
						'type' 		=> 'section',
						'title' 	=> __('Product Image Flipper (PIF)', 'metcreative'),
						'indent' 	=> true
					),
					array(
						'id'       => 'woo_pif',
						'type'     => 'switch',
						'title'    => __('Enable PIF', 'metcreative'),
						'subtitle' => __('Show secondary image on thumbnail hover','metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'woo_pif_animation_in',
						'type'     => 'select',
						'title'    => __('Flip Animation IN', 'metcreative'),
						'subtitle' => __('When mouse hover','metcreative'),
						'options'  => $woo_pif_animation_in_types,
						'default' => 'flipInY'
					),
					array(
						'id'       => 'woo_pif_animation_out',
						'type'     => 'select',
						'title'    => __('Flip Animation OUT', 'metcreative'),
						'subtitle' => __('When mouse leave','metcreative'),
						'options'  => $woo_pif_animation_out_types,
						'default' => 'fadeOutDown'
					),
					array(
						'id' => 'woo_pif_animation_duration',
						'type' => 'slider',
						'title' => __('Flip Animation Duration', 'metcreative'),
						'subtitle' => __('How long to take when animating by seconds?', 'metcreative'),
						"default" => 0.6,
						"min" => 0,
						"step" => .1,
						"max" => 10,
						'resolution' => 0.1,
					),
					array(
						'id' => 'woo_pif_animation_delay',
						'type' => 'slider',
						'title' => __('Flip Animation Delay', 'metcreative'),
						'subtitle' => __('How long to take before starting animation by seconds?', 'metcreative'),
						"default" => 0.1,
						"min" => 0,
						"step" => .1,
						"max" => 10,
						'resolution' => 0.1,
					),
					array(
						'id' 		=> 'woo_pif-end',
						'type' 		=> 'section',
						'indent' 	=> false
					),

					/* ### - Cart Tab Settings - ### */
					array(
						'id' 		=> 'cart_tab_options-start',
						'type' 		=> 'section',
						'title' 	=> __('Cart Tab Settings', 'metcreative'),
						'indent' 	=> true
					),
					array(
						'id'       => 'woo_cart_tab',
						'type'     => 'switch',
						'title'    => __('Enable Cart Tab', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'wc_ct_cart_widget',
						'type'     => 'switch',
						'title'    => __('Cart Widget', 'metcreative'),
						'subtitle'     => __('Display the cart widget on hover', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'wc_ct_hide_empty_cart',
						'type'     => 'switch',
						'title'    => __('Hide Empty Cart', 'metcreative'),
						'subtitle' => __('Hide the cart tab if the cart is empty', 'metcreative'),
						'default'  => true,
					),
					array(
						'id'       => 'wc_ct_horizontal_position',
						'type'     => 'radio',
						'title'    => __('Cart Tab Position', 'metcreative'),
						'options'  => array(
							'left' 		=> __('Left', 'metcreative'),
							'right' 	=> __('Right', 'metcreative')
						),
						'default' => 'right'
					),
					array(
						'id'       => 'wc_ct_skin',
						'type'     => 'radio',
						'title'    => __('Cart Tab Style', 'metcreative'),
						'options'  => array(
							'light' 	=> __('Light', 'metcreative'),
							'dark' 		=> __('Dark', 'metcreative')
						),
						'default' => 'light'
					),
					array(
						'id' 		=> 'cart_tab_options-end',
						'type' 		=> 'section',
						'indent' 	=> false
					),
				)
			);

			/*============================
			=     TWITTER API OPTIONS     =
			============================*/
			$this->sections[] = array(
				'icon' => 'fa fa-twitter',
				'title' => __('Twitter API', 'metcreative'),
				'desc' => __('Most of this configuration can found on the application overview page on the <a href="http://dev.twitter.com" target="_blank">http://dev.twitter.com</a> website. <br>
				You will need to generate an oAuth token once you\'ve created the application. The button for that is on the bottom of the application overview page.', 'metcreative'),
				'fields' => array(

					array(
						'id'       => 'twitter_consumer_key',
						'type'     => 'text',
						'title'    => __('Twitter Application API Key', 'metcreative'),
						'subtitle' => __('Consumer Key', 'metcreative'),
						'desc'     => __('<small>Ex: YxBd601W1wfAY15hjXXXXX</small>', 'metcreative'),
						'default'  => '',
					),
					array(
						'id'       => 'twitter_consumer_secret',
						'type'     => 'text',
						'title'    => __('Twitter Application API Secret', 'metcreative'),
						'subtitle' => __('Consumer Secret', 'metcreative'),
						'desc'     => __('<small>Ex: vyIBS0PvT3NLdLLxN7kqD2ygPVEAaZgHvIWTbXXXXX</small>', 'metcreative'),
						'default'  => '',
					),
					array(
						'id'       => 'twitter_access_token',
						'type'     => 'text',
						'title'    => __('Account Access Token', 'metcreative'),
						'desc'     => __('<small>Ex: 1166040000-ImfXRdRDTuH21xiKdY6VbJGoQe1FBfc7JSXXXX</small>', 'metcreative'),
						'default'  => '',
					),
					array(
						'id'       => 'twitter_access_token_secret',
						'type'     => 'text',
						'title'    => __('Account Access Token Secret', 'metcreative'),
						'desc'     => __('<small>Ex: tc1JizIhfsV35KVxJXJCM9jZxvqwzXvaniXXXXX</small>', 'metcreative'),
						'default'  => '',
					),
					array(
						'id'       => 'twitter_cache_expire',
						'type'     => 'text',
						'title'    => __('Cache Duration', 'metcreative'),
						'default'  => '3600',
					),
				)
			);

	        /*=======================
			=     EDITOR EXTRAS     =
			=======================*/
	        $this->sections[] = array(
		        'icon' => 'fa fa-toggle-on',
		        'title' => __('WP Editor', 'metcreative'),
		        'desc' => __('You can enable some hidden TinyMCE buttons on here.', 'metcreative'),
		        'fields' => array(
			        array(
				        'id'       => 'tinymce_hidden_buttons',
				        'type'     => 'checkbox',
				        'title'    => __('Hidden Buttons', 'metcreative'),
				        'subtitle' => __('Check hidden buttons to make visible.', 'metcreative'),
				        'options'  => array(
					        'fontselect' => __('Font Family','default'),
					        'fontsizeselect' => __('Font Sizes','default'),
					        'styleselect' => __('Formats','default'),
					        'backcolor' => __('Background color','default'),
					        'newdocument' => __('New document','default'),
					        'cut' => __('Cut', 'metcreative','default'),
					        'copy' => __('Copy', 'metcreative','default'),
					        'charmap' => __('Special character', 'metcreative'),
					        'hr' => __('Horizontal rule', 'metcreative'),
				        ),
			        ),
		        )
	        );
        }

		/**

		This is a test function that will let you see when the compiler hook occurs.
		It only runs if a field	set with compiler=>true is changed.

		 * */
		function compiler_action($options, $css, $changed_values) {
			$css = apply_filters('redux_after_complier', $options, $css, $this->ReduxFramework->sections);

			//update_option('redux_complier_css', base64_encode($css));
		}

		/**

		Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		 * */
		function change_arguments($args) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**
		Filter hook for filtering the default value of any given field. Very useful in development mode.
		 * */
		function change_defaults($defaults) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if (class_exists('ReduxFrameworkPlugin')) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

    }

    global $reduxConfig;
    $reduxConfig = new jade_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('jade_my_custom_field')):
    function jade_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('jade_validate_callback_function')):
    function jade_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
