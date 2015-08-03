<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<div class="met_alert alert alert-success">
    <div class="met_alert_icon_box">
        <i class="dslc-icon dslc-icon-check"></i>
    </div>
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="met_alert_title"><?php _e('Success', 'Jade') ?></div>
    <div class="met_alert_content">
        <ul style="margin-bottom: 0">
            <?php foreach ( $messages as $message ) : ?>
                <li><?php echo wp_kses_post( $message ); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>