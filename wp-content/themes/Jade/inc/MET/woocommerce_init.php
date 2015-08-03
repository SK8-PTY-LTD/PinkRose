<?php
/*===================================
=     Remove Woo Default Styles     =
===================================*/
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );
	return $enqueue_styles;
}add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );


/*=============================
=     Load Our Woo Styles     =
=============================*/
function mc_woo_enqueue_scripts(){
	wp_enqueue_style('jade-woocommerce',get_template_directory_uri().'/css/woocommerce.css');
	wp_enqueue_script('jade-woocommerce',get_template_directory_uri().'/js/woocommerce.js',array(),false,true);

	wp_enqueue_style( 'metcreative-animate', get_template_directory_uri().'/css/animate.min.css' );
}add_action( 'wp_enqueue_scripts', 'mc_woo_enqueue_scripts' );

/*==================================
=     Sidebar Register for Woo     =
===================================*/
register_sidebar( array(
	'name'          => __( 'Shop Sidebar', 'metcreative' ),
	'id'            => 'sidebar-shop',
	'before_widget' => '<div class="met_sidebar_box %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<header><h4>',
	'after_title'   => '</h4></header>',
) );

function woocommerce_before_main_content_start() {
	echo '';
}add_action('woocommerce_before_main_content', 'woocommerce_before_main_content_start', 10);

function woocommerce_before_main_content_end() {
	echo '';
}add_action('woocommerce_after_main_content', 'woocommerce_before_main_content_end', 10);

/*=============================================
=     Product Listing: Disable Page Title     =
=============================================*/
function override_page_title() {
	return false;
}add_filter('woocommerce_show_page_title', 'override_page_title');

/*======================================
=     Remove woocommerce breadcrumb     =
======================================*/
function jk_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}add_action( 'init', 'jk_remove_wc_breadcrumbs' );

/*======================================
=     Product Listing: Column Size     =
======================================*/
add_filter( 'loop_shop_columns', create_function( '$cols', 'return '.met_option('woo_listing_column_no').';' ), 20 );

/*=========================================
=     Product Listing: Column Classes     =
=========================================*/
function woo_columns_body_class($classes) {
	if ( is_woocommerce() ) {
		$classes[] = 'columns-'.met_option('woo_listing_column_no');
	}
	return $classes;
}add_filter('body_class', 'woo_columns_body_class');

/*========================================
=     Product Listing: Item per page     =
========================================*/
add_filter( 'loop_shop_per_page', create_function( '$limit', 'return '.met_option('woo_item_per_page').';' ), 20 );

/*========================================
=     Product Detail: Releated Items     =
========================================*/
function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );

/*========================================
=     Product Listing: Image Flipper     =
========================================*/
if ( ! class_exists( 'WC_pif' ) ) {

	class WC_pif {

		public function __construct() {
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
			add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
			add_action( 'wp_footer', array( $this, 'pif_animation_data' ) );
		}

		// Add pif-has-gallery class to products that have a gallery
		function product_has_gallery( $classes ) {
			global $product;

			$post_type = get_post_type( get_the_ID() );

			if ( ! is_admin() ) {

				if ( $post_type == 'product' ) {

					$attachment_ids = $product->get_gallery_attachment_ids();

					if ( $attachment_ids ) {
						$classes[] = 'pif-has-gallery';
					}
				}

			}

			return $classes;
		}


		/*-----------------------------------------------------------------------------------*/
		/* Frontend Functions */
		/*-----------------------------------------------------------------------------------*/

		// Display the second thumbnails
		function woocommerce_template_loop_second_product_thumbnail() {
			global $product, $woocommerce;

			$attachment_ids = $product->get_gallery_attachment_ids();

			if ( $attachment_ids ) {
				$secondary_image_id = $attachment_ids['0'];
				echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
			}
		}

		// Display data element on footer for animations
		function pif_animation_data() {
			echo '<span id="pif_animation_data" data-animation-in="'.met_option('woo_pif_animation_in').'" data-animation-out="'.met_option('woo_pif_animation_out').'" data-animation-duration="'.met_option('woo_pif_animation_duration').'" data-animation-delay="'.met_option('woo_pif_animation_delay').'"></span>';
		}

	}

	if(met_option('woo_pif')) $WC_pif = new WC_pif();
}

/*==================
=     Cart Tab     =
==================*/
if ( ! class_exists( 'WC_ct' ) ) {

	class WC_ct {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'setup_styles' ) );				// Enqueue the styles
			add_action( 'wp_footer', array( $this, 'woocommerce_cart_tab' ) ); 				// The cart tab function
			add_filter( 'add_to_cart_fragments', array( $this, 'wcct_add_to_cart_fragment' ) ); // The cart fragment
		}


		/*-----------------------------------------------------------------------------------*/
		/* Class Functions */
		/*-----------------------------------------------------------------------------------*/


		// Setup styles
		function setup_styles() {
			if ( ! is_cart() && ! is_checkout() ) {
				wp_enqueue_style( 'metcreative-woocommerce-ct', get_template_directory_uri().'/css/woocommerce-ct.css' );
			}
		}


		// The cart fragment (ensures the cart button updates via AJAX)
		function wcct_add_to_cart_fragment( $fragments ) {
			global $woocommerce;
			ob_start();
			wcct_cart_button();
			$fragments['a.cart-parent'] = ob_get_clean();
			return $fragments;
		}


		/*-----------------------------------------------------------------------------------*/
		/* Frontend Functions */
		/*-----------------------------------------------------------------------------------*/

		// Display the cart tab and widget
		function woocommerce_cart_tab() {
			global $woocommerce;
			$skin 			= met_option( 'wc_ct_skin' );
			$position 		= met_option( 'wc_ct_horizontal_position' );
			$widget 		= met_option( 'wc_ct_cart_widget' );
			$hide_widget 	= met_option( 'wc_ct_hide_empty_cart' );

			if ( $woocommerce->cart->get_cart_contents_count() == 0 && $hide_widget == true ) {
				// Hide empty cart
				// Compatible with WP Super Cache as long as "late init" is enabled
				$visibility		= 'hidden';
			} else {
				$visibility		= 'visible';
			}

			if ( ! is_cart() && ! is_checkout() ) {
				if ( $widget == true ) {
					echo '<div class="' . esc_attr( $position ) . ' cart-tab ' . esc_attr( $skin ) . ' ' . esc_attr( $visibility ) . '">';
				} else {
					echo '<div class="' . esc_attr( $position ) . ' cart-tab no-animation ' . esc_attr( $skin ) . ' ' . esc_attr( $visibility ) . '">';
				}
				wcct_cart_button();
				// Display the widget if specified
				if ( $widget == true ) {
					// Check for WooCommerce 2.0 and display the cart widget
					if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
						the_widget( 'WC_Widget_Cart', 'title=' );
					} else {
						the_widget( 'WooCommerce_Widget_Cart', 'title=' );
					}
				}
				echo '</div>';
			}
		}
	}


	// Displays the cart total and number of items as a link
	function wcct_cart_button() {
		global $woocommerce;
		?>
		<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'woocommerce-cart-tab' ); ?>" class="cart-parent <?php if(isset($visibility)) echo esc_attr( $visibility ); ?>">
			<?php
			echo wp_kses_post( $woocommerce->cart->get_cart_total() );
			echo '<span class="contents">' . sprintf( _n( '%d item', '%d items', intval( $woocommerce->cart->get_cart_contents_count() ), 'woocommerce-cart-tab' ), intval( $woocommerce->cart->get_cart_contents_count() ) ) . '</span>';
			?>
		</a>
	<?php
	}


	if(met_option('woo_cart_tab')) $WC_ct = new WC_ct();
}