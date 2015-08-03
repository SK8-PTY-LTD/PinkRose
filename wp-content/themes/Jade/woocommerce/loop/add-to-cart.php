<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

echo '<div class="product_listing_buttons">';

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="met_product_button met_bgcolor %s product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		$product->is_purchasable() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	),
	$product );

//Show details button
echo '<a class="met_product_button met_bgcolor product_show_detail_button" href="'.get_permalink().'"><i class="fa fa-list-ul"></i>'.__('Show details').'</a>';

echo '<div class="clearfix"></div> </div>';