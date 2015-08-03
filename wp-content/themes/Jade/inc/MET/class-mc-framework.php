<?php
/**
 * Title         : MC Framework Core
 * Description   : Met Creative Framework Core Class
 * Version       : 1.0.0
 * Author        : Murat KARAÇAM
 * Author URI    : http://metcreative.com
 */

if( !class_exists('MC_Framework_Core') ){
	class MC_Framework_Core {

		/**
		 * The singleton instance
		 */
		static private $instance = null;

		/**
		 * WordPress Post Formats
		 */
		protected $mc_post_formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );

		/**
		 *
		 */
		function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup_framework' ) );
			add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
			add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

			add_action( 'wp_head', array( $this, 'enqueue_ie' ) );
			add_action( 'wp_footer', array( $this, 'enqueue_ie_footer' ) );

			add_action( 'wp_head', array( $this, 'wp_head_init' ) );

			add_action( 'tgmpa_register', array( $this, 'tgmpa_register' ) );

			add_action( 'layerslider_ready', array( $this, 'layerslider_overrides' ) );
			add_action( 'init', array( $this, 'revslider_overrides' ) );

			add_filter( 'oembed_dataparse', array( $this, 'oembed_dataparse' ), 10, 3 );

			add_filter( 'manage_posts_columns', array( $this, 'posts_columns_id' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'posts_custom_id_columns' ), 10, 2 );

            add_action( 'met_wp_video_shortcode', array( $this, 'met_wp_video_shortcode' ) );
            add_action( 'met_wp_audio_shortcode', array( $this, 'met_wp_audio_shortcode' ) );

			add_filter( 'mce_buttons_3', array( $this, 'mce_buttons_3' ) );
		}

		/**
		 * No cloning allowed
		 */
		private function __clone() {}

		/**
		 * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
		 */
		static public function getInstance() {
			if(self::$instance == null) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		function setup_framework(){
			require_once get_template_directory() . '/inc/template-tags.php';
			require_once get_template_directory() . '/inc/extras.php';

			add_theme_support( 'post-formats', $this->mc_post_formats );

			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'woocommerce' );

			register_nav_menus( array(
				'main_nav' 						=> __( 'Main Navigation', 'Jade' ),
				'second_nav' 					=> __( 'Secondary Navigation', 'Jade' ),
				'footer_nav' 					=> __( 'Footer Navigation', 'Jade' )
			) );
		}

		function mce_buttons_3($buttons){
			global $met_options;

			$buttons = array();

			if( isset($met_options['tinymce_hidden_buttons']) AND count($met_options['tinymce_hidden_buttons']) > 0){
				foreach($met_options['tinymce_hidden_buttons'] as $button_id => $button_status){
					if($button_status == '1'){
						$buttons[] = $button_id;
					}

				}
			}

			return $buttons;
		}


		function register_sidebars(){
			register_sidebar( array(
				'name'          => __( 'Blog Sidebar', 'metcreative' ),
				'id'            => 'sidebar-blog',
				'before_widget' => '<div class="met_sidebar_box clearfix %2$s" id="%1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<header><h4>',
				'after_title'   => '</h4></header>',
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Sidebar (Col 1)', 'metcreative' ),
				'id'            => 'footer-sidebar-1',
                'before_widget' => '<div class="met_sidebar_box clearfix %2$s sidebar-widget footer-widget %2$s" id="%1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<header><h4>',
                'after_title'   => '</h4></header>',
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Sidebar (Col 2)', 'metcreative' ),
				'id'            => 'footer-sidebar-2',
                'before_widget' => '<div class="met_sidebar_box clearfix %2$s sidebar-widget footer-widget %2$s" id="%1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<header><h4>',
                'after_title'   => '</h4></header>',
            ) );

			register_sidebar( array(
				'name'          => __( 'Footer Sidebar (Col 3)', 'metcreative' ),
				'id'            => 'footer-sidebar-3',
                'before_widget' => '<div class="met_sidebar_box clearfix %2$s sidebar-widget footer-widget %2$s" id="%1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<header><h4>',
                'after_title'   => '</h4></header>',
            ) );

			register_sidebar( array(
				'name'          => __( 'Footer Sidebar (Col 4)', 'metcreative' ),
				'id'            => 'footer-sidebar-4',
                'before_widget' => '<div class="met_sidebar_box clearfix %2$s sidebar-widget footer-widget %2$s" id="%1$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<header><h4>',
                'after_title'   => '</h4></header>',
            ) );
		}

		function enqueue_styles(){
			global $wp_scripts;

			$responsive_status = met_option('responsive');

			wp_enqueue_style( 'metcreative-style', get_stylesheet_uri() );

			//wp_enqueue_style( 'metcreative-google-font', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600' );
			//wp_enqueue_style( 'metcreative-google-font2', 'http://fonts.googleapis.com/css?family=Sintony:400,700' );

			wp_enqueue_style( 'metcreative-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css' );
			wp_enqueue_style( 'metcreative-fontawesome', get_template_directory_uri().'/css/font-awesome.min.css' );

            wp_register_style( 'metcreative-animate', get_template_directory_uri().'/css/animate.min.css' );
            wp_register_style( 'metcreative-windmillCarousel', get_template_directory_uri().'/css/jquery.windmillCarousel.css' );
			wp_register_style( 'metcreative-bxslider', get_template_directory_uri().'/css/jquery.bxslider.css' );
			wp_register_style( 'metcreative-responsive-tabs', get_template_directory_uri().'/css/responsive-tabs.css' );

            wp_register_style( 'metcreative-mediaelement', get_template_directory_uri().'/css/mediaelement.js.skin.css' );

			wp_register_style('metcreative-fullPage', get_template_directory_uri().'/css/jquery.fullPage.css' );

			wp_register_style( 'metcreative-textrotate', get_template_directory_uri().'/css/simpletextrotator.css' );

			wp_enqueue_style( 'metcreative-jade-style', get_template_directory_uri().'/css/style.css' );
			if($responsive_status) wp_enqueue_style( 'metcreative-jade-responsive', get_template_directory_uri().'/css/responsive.css' );
		}

		function enqueue_scripts(){
			global $wp_scripts, $mb_fsc_options, $dslc_active, $mb_pl_options, $custom_preloader_options;

			wp_deregister_script( 'modernizr' );
			wp_deregister_script( 'jquery.carouFredSel' );
			wp_deregister_script( 'imagesLoaded' );
			wp_deregister_script( 'jquery.isotope' );
			wp_deregister_script( 'jquery.easing' );


			wp_enqueue_script( 'jquery' );

			//wp_enqueue_script('metcreative-modernizr',get_template_directory_uri().'/js/modernizr.js');
            wp_enqueue_script('metcreative-common',get_template_directory_uri().'/js/common.js');
            //wp_enqueue_script('metcreative-optimized-resize',get_template_directory_uri().'/js/optimized.resize.js');
			//wp_enqueue_script('metcreative-optimized-scroll',get_template_directory_uri().'/js/optimized.scroll.js');
			//wp_enqueue_script('metcreative-onepage-nav',get_template_directory_uri().'/js/jquery.nav.js');
			//wp_enqueue_script('metcreative-hoverIntent',get_template_directory_uri().'/js/hoverIntent.min.js');
			//wp_enqueue_script('metcreative-superfish',get_template_directory_uri().'/js/superfish.min.js');
			wp_register_script('metcreative-page-loader-bar',get_template_directory_uri().'/js/met_loading.js',array(),false,true);
			//wp_enqueue_script('metcreative-bootstrap',get_template_directory_uri().'/js/bootstrap.min.js',array(),false,true);
			//wp_enqueue_script('metcreative-imagesLoaded',get_template_directory_uri().'/js/imagesLoaded.js',array(),false,true);
			//wp_enqueue_script('metcreative-debouncedresize',get_template_directory_uri().'/js/jquery.debouncedresize.js',array(),false,true);
			wp_register_script('metcreative-masonry',get_template_directory_uri().'/js/masonry.js',array(),false,true);
            wp_register_script('metcreative-sticky',get_template_directory_uri().'/js/jquery.sticky.js',array(),false,true);
			wp_register_script('metcreative-easypiechart',get_template_directory_uri().'/js/jquery.easypiechart.min.js',array(),false,true);
			wp_register_script('metcreative-appear',get_template_directory_uri().'/js/jquery.appear.js',array(),false,true);
			wp_register_script('metcreative-countto',get_template_directory_uri().'/js/jquery.countTo.js',array(),false,true);
			//wp_enqueue_script('metcreative-parallax',get_template_directory_uri().'/js/parallax.js',array(),false,true);
			//wp_enqueue_script('metcreative-easing',get_template_directory_uri().'/js/jquery.easing.min.js',array(),'1.3',true);
            wp_register_script('metcreative-wow',get_template_directory_uri().'/js/wow.min.js',array(),'0.1.12',true);
            wp_register_script('metcreative-fitVids',get_template_directory_uri().'/js/jquery.fitVids.js',array(),'1.1',true);
            wp_register_script('metcreative-queryloader',get_template_directory_uri().'/js/queryloader2.min.js',array(),'2',true);

			wp_register_script('metcreative-gmapsapi','http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false',array(),false,true);
			wp_register_script('metcreative-bxslider',get_template_directory_uri().'/js/jquery.bxslider.min.js',array(),false,true);
			wp_register_script('metcreative-stellar',get_template_directory_uri().'/js/jquery.stellar.min.js',array(),false,true);
			wp_register_script('metcreative-flexslider',get_template_directory_uri().'/js/jquery.flexslider-min.js',array(),false,true);
			wp_register_script('metcreative-windmillCarousel',get_template_directory_uri().'/js/jquery.windmillCarousel.js',array(),false,true);
			wp_register_script('metcreative-jflickrfeed',get_template_directory_uri().'/js/jflickrfeed.min.js',array(),false,true);
			wp_register_script('metcreative-isotope',get_template_directory_uri().'/js/isotope.js',array(),false,true);
			wp_register_script('metcreative-fullscreenr',get_template_directory_uri().'/js/fullscreenr.js',array(),false,true);
			wp_register_script('metcreative-counteverest',get_template_directory_uri().'/js/jquery.counteverest.min.js',array(),false,true);
			wp_register_script('metcreative-responsive-tabs',get_template_directory_uri().'/js/responsive-tabs.js',array(),false,true);
			wp_register_script('metcreative-slimscroll', get_template_directory_uri().'/js/jquery.slimscroll.min.js',array(),false,true);
			wp_register_script('metcreative-fullPage', get_template_directory_uri().'/js/jquery.fullPage.min.js',array(),false,true);
			wp_register_script('metcreative-textrotate', get_template_directory_uri().'/js/jquery.simple-text-rotator.min.js',array(),false,true);
			wp_enqueue_script('metcreative-stellar');
			wp_enqueue_script('metcreative-jade-scripts',get_template_directory_uri().'/js/scripts.js',array(),false,true);

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

            if ( met_option( 'smooth_scroll' ) ) {
                wp_enqueue_script('metcreative-smoothscroll',get_template_directory_uri().'/js/smoothscroll.js',array(),false,true);
            }

			if( isset($mb_fsc_options) && !empty($mb_fsc_options) && $mb_fsc_options['fullscreen_scrolling'] == 'true' && !$dslc_active ){
				wp_dequeue_script( 'metcreative-smoothscroll' );

				wp_enqueue_style( 'metcreative-fullPage' );
				wp_enqueue_script( 'metcreative-slimscroll' );
				wp_enqueue_script( 'metcreative-fullPage' );
			}

			if( isset($mb_pl_options) && !empty($mb_pl_options['barColor']) && !$dslc_active && $custom_preloader_options ){
				wp_enqueue_script( 'metcreative-queryloader' );
			}


		}

		function enqueue_ie(){
			global $is_IE;

			if ($is_IE){

				echo '<!--[if lte IE 9]>'.PHP_EOL;
				echo '<script id="LTEIE9" src="'.get_template_directory_uri().'/js/LTE-IE9.js"></script>'.PHP_EOL;
				echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/lte-ie9.css" type="text/css">'.PHP_EOL;
				echo '<![endif]-->'.PHP_EOL;

			}
		}

		function enqueue_ie_footer(){
			global $is_IE;

			if ($is_IE){
				echo '<!--[if lte IE 9]>'.PHP_EOL;
				echo '<script src="'.get_template_directory_uri().'/js/flexie.min.js"></script>'.PHP_EOL;
				echo '<![endif]-->'.PHP_EOL;
			}
		}

		function wp_head_init(){
			/* Favicon
			---------------------------------------------- */
			$fav_icon = met_option('fav_icon');
			echo '<link rel="shortcut icon" href="'.$fav_icon['url'].'">';


			$theme_info = wp_get_theme();
			echo '<!-- |'.$theme_info->Name . ", " . $theme_info->Version. '| -->';
		}

		function tgmpa_register(){
			$plugins = array(
				// MC Plugins
				array(
					'name'               => '(mc) Mega Menu',
					'slug'               => 'mc-mega-menu',
					'source'             => get_template_directory_uri() . '/inc/plugins/mc-mega-menu.zip',
					'required'           => true,
					'version'            => '1.0.0',
					'force_activation'   => true,
					'force_deactivation' => true,
				),
				array(
					'name'               => '(mc) Shortcode Builder',
					'slug'               => 'mc-shortcode-builder',
					'source'             => get_template_directory_uri() . '/inc/plugins/mc-shortcode-builder.zip',
					'required'           => true,
					'version'            => '1.0.1',
					'force_activation'   => true,
					'force_deactivation' => true,
				),

				// Premium Plugins
				array(
					'name'               => 'Live Composer',
					'slug'               => 'ds-live-composer',
					'source'             => get_template_directory_uri() . '/inc/plugins/ds-live-composer.zip',
					'required'           => true,
					'version'            => '1.0.9',
					'force_activation'   => true,
					'force_deactivation' => true,
				),
				array(
					'name'               => 'Revolution Slider',
					'slug'               => 'revslider',
					'source'             => get_template_directory_uri() . '/inc/plugins/revslider.zip',
					'required'           => false,
					'version'            => '4.6.5',
					'force_activation'   => false,
					'force_deactivation' => true,
				),
				array(
					'name'               => 'LayerSlider',
					'slug'               => 'LayerSlider',
					'source'             => get_template_directory_uri() . '/inc/plugins/layerslider.zip',
					'required'           => false,
					'version'            => '5.3.2',
					'force_activation'   => false,
					'force_deactivation' => true,
				),

				// WP Repo Plugins
				array(
					'name'              => 'Contact Form 7',
					'slug'              => 'contact-form-7',
					'version'           => '4.0.3',
					'required'          => false
				),
				array(
					'name'              => 'WooCommerce',
					'slug'              => 'woocommerce',
					'version'           => '2.2.10',
					'required'          => false
				),
				array(
					'name'              => 'The Events Calendar',
					'slug'              => 'the-events-calendar',
					'version'           => '3.9',
					'required'          => false
				),
				array(
					'name'              => 'Codestyling Localization',
					'slug'              => 'codestyling-localization',
					'version'           => '1.99.30',
					'required'          => false
				)

			);

			$config = array(
				'default_path' => 'inc/plugins',
				'has_notices'  => true,
				'dismissable'  => true,
				'is_automatic' => false,
			);

			tgmpa( $plugins, $config );
		}

		function layerslider_overrides() {
			update_option('ls-show-support-notice', 0);

			// Disable auto-updates
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		function revslider_overrides() {
			if(function_exists('set_revslider_as_theme')) set_revslider_as_theme();
		}

		function excerpt_more($more){
			return met_option('blog_excerpt_more');
		}

		function excerpt_length($length){
			return met_option('blog_excerpt_length');
		}

		function oembed_dataparse($output, $data, $url){
			$return = '<div class="oembed-custom-conteiner">'.$output.'</div>';
			return $return;
		}

		function posts_columns_id($defaults){
			$defaults['wps_post_id'] = __('ID','Jade');
			return $defaults;
		}

		function posts_custom_id_columns($column_name, $id){
			if($column_name === 'wps_post_id'){
				echo $id;
			}
		}

		public function get_tweets($username = 'envato', $amount = 20){
			require_once get_template_directory() . '/inc/class-storm-twitter.php';

			$config = array(
				'directory' => get_template_directory().'/cache/'.$username,
				'key' => met_option('twitter_consumer_key'),
				'secret' => met_option('twitter_consumer_secret'),
				'token' => met_option('twitter_access_token'),
				'token_secret' => met_option('twitter_access_token_secret'),
				'cache_expire' => met_option('twitter_cache_expire'),
			);

			$twitter = new StormTwitter($config);

			$the_tweets = array();

			$amount = $amount > 20 ? 20 : $amount;
			$tweets = $twitter->getTweets($username);


			if( is_array($tweets) AND !isset($tweets['error']) ){

				foreach($tweets as $tweet){

					//Before using cache, result return an object. We need convert to array.
					if(is_object($tweet)) $tweet = json_decode(json_encode($tweet), true);

					if($tweet['text']){
						$the_tweet = $tweet['text'];

						// i. User_mentions must link to the mentioned user's profile.
						if(is_array($tweet['entities']['user_mentions'])){
							foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
								$the_tweet = preg_replace(
									'/@'.$user_mention['screen_name'].'/i',
									'<a class="met_transition met_color_transition2" href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
									$the_tweet);
							}
						}

						// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
						if(is_array($tweet['entities']['hashtags'])){
							foreach($tweet['entities']['hashtags'] as $key => $hashtag){
								$the_tweet = preg_replace(
									'/#'.$hashtag['text'].'/i',
									'<a class="met_transition met_color_transition2" href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
									$the_tweet);
							}
						}

						// iii. Links in Tweet text must be displayed using the display_url
						//      field in the URL entities API response, and link to the original t.co url field.
						if(is_array($tweet['entities']['urls'])){
							foreach($tweet['entities']['urls'] as $key => $link){
								$the_tweet = preg_replace(
									'`'.$link['url'].'`',
									'<a class="met_transition met_color_transition2" href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
									$the_tweet);
							}
						}

						$the_tweets[] = $the_tweet;
					} else {
						$the_tweets[] = 'Sorry! There are currently none tweets :(';
					}
				}
			}elseif( isset($tweets['error']) ){
				$the_tweets[] = $tweets['error'];
			}

			return $the_tweets;
		}

        public function met_wp_video_shortcode($params = array()){
            $shortcodeParams = '';
	        if( !isset($params['loop']) ) $params['loop'] = 'false';
	        foreach($params as $k => $v){
                if( !empty($v) && $v != 'off' ) $shortcodeParams .= $k.'="'.$v.'" ';
            }
            echo do_shortcode('[video '.$shortcodeParams.']');
            wp_enqueue_style('metcreative-mediaelement');
        }

        public function met_wp_audio_shortcode($params = array()){
            $shortcodeParams = '';
	        if( !isset($params['loop']) ) $params['loop'] = 'false';
            foreach($params as $k => $v){
                if( !empty($v) && $v != 'off' ) $shortcodeParams .= $k.'="'.$v.'" ';
            }
            echo do_shortcode('[audio '.$shortcodeParams.']');
            wp_enqueue_style('metcreative-mediaelement');
        }
	}

	new MC_Framework_Core();
}
