<?php

// Register Module
add_action('dslc_hook_register_modules',
	create_function('', 'return dslc_register_module( "MET_AlertBoxIcon" );')
);

class MET_AlertBoxIcon extends DSLC_Module {

	var $module_id = 'MET_AlertBoxIcon';
	var $module_title = 'Alert Box (Icon)';
	var $module_icon = 'info';
	var $module_category = 'met - general';

	function options() {

		$dslc_options = array(

			/**
			 * Click to Edit Contents
			 */
			array(
				'label' => __( 'Title', 'dslc_string' ),
				'id' => 'title',
				'std' => 'CLICK TO EDIT. Message Box Title',
				'type' => 'text',
				'visibility' => 'hidden'
			),
			array(
				'label' => __( 'Content', 'dslc_string' ),
				'id' => 'content',
				'std' => 'CLICK TO EDIT. Lorem ipsum dolor sit amet, consecteg elitares Integer.',
				'type' => 'textarea',
				'visibility' => 'hidden'
			),



			/**
			 * Elements Visibility Options
			 */
			array(
				'label' => __( 'Elements', 'dslc_string' ),
				'id' => 'elements',
				'std' => 'title content icon close',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Title', 'dslc_string' ),
						'value' => 'title'
					),
					array(
						'label' => __( 'Content', 'dslc_string' ),
						'value' => 'content'
					),
					array(
						'label' => __( 'Icon', 'dslc_string' ),
						'value' => 'icon'
					),
					array(
						'label' => __( 'Close', 'dslc_string' ),
						'value' => 'close'
					),
				)
			),



			/**
			 * General Options
			 */
			array(
				'label' => __( 'Icon', 'dslc_string' ),
				'id' => 'icon',
				'std' => 'info',
				'type' => 'icon'
			),

			/**
			 * Type Option
			 */
			array(
				'label' => __( 'Display Type', 'dslc_string' ),
				'id' => 'type',
				'std' => 'success',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Success', 'dslc_string' ),
						'value' => 'success',
					),
					array(
						'label' => __( 'Info', 'dslc_string' ),
						'value' => 'info'
					),
					array(
						'label' => __( 'Warning', 'dslc_string' ),
						'value' => 'warning'
					),
					array(
						'label' => __( 'Danger', 'dslc_string' ),
						'value' => 'danger'
					),
				)
			),


		);

		$dslc_options = array_merge(
			$dslc_options,

			// Box
			lc_general('.met_alert', '', array('background-color' => ''), 'Box'),

			// Icon
			lc_general('.met_alert .met_alert_icon_box', '', array('background-color' => '', 'color' => ''), 'Icon'),

			// Paddings
			lc_paddings('.met_alert', 'Paddings', ''),

			// Box Borders
			lc_borders('.met_alert', 'Borders', array(), array(), '', '', '' ),

			// Border Radius
			lc_borderRadius('.met_alert', 'Border Radius'),

			// Title
			lc_general('.met_alert .met_alert_title', 'Title', array('color' => '','text-align' => '', 'font-size' => '', 'line-height' => '')),

			// Title Paddings
			lc_paddings('.met_alert .met_alert_title', 'Title', ''),

			// Content
			lc_general('.met_alert .met_alert_content', 'Content', array('color' => '','text-align' => '','font-size' => '', 'line-height' => '','text-shadow' => '')),

			// Content Paddings
			lc_paddings('.met_alert .met_alert_content', 'Title', ''),

			// Close
			lc_general('.met_alert .close', 'Close', array('font-size' => '', 'line-height' => '','color' => '')),

			// Close Paddings
			lc_paddings('.met_alert .close', 'Close', '')
		);

		$dslc_options = met_lc_extras($dslc_options, array('animation','parallax'), 'shared_options');

		$dslc_options = array_merge( $dslc_options, $this->presets_options() );
		return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

	}

	function output( $options ) {

		global $dslc_active;

		if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
			$dslc_is_admin = true;
		else
			$dslc_is_admin = false;

		$this->module_start( $options );

        /* Animation */
        

        $met_shared_options = met_lc_extras( $options, array(
            'groups'   => array('animation', 'parallax'),
            'params'   => array(
                'js'           => false,
                'css'          => false,
                'external_run' => false,
                'is_grid'      => false,
            ),
            'is_admin' => $dslc_is_admin,
        ), 'shared_options_output' );

        if ( !$dslc_is_admin && $met_shared_options['activity'] ){
            wp_enqueue_style('metcreative-animate');
            wp_enqueue_script('metcreative-wow');
        }

		/* Module output starts here */

		// Main Elements
		$elements = $options['elements'];
		if ( ! empty( $elements ) )
			$elements = explode( ' ', trim( $elements ) );
		else
			$elements = array();

		?>

		<div class="met_alert alert alert-<?php echo $options['type'] ?> <?php echo $met_shared_options['classes'] ?>" <?php echo $met_shared_options['data-']; ?>>

			<?php if( in_array( 'icon', $elements ) ) : ?>
			<div class="met_alert_icon_box">
				<i class="dslc-icon dslc-icon-<?php echo $options['icon'] ?>"></i>
			</div>
			<?php endif; ?>

			<?php if( in_array( 'close', $elements ) ) : ?>
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php endif; ?>

			<?php if( in_array( 'title', $elements ) ) : ?>

				<?php if( $dslc_is_admin ): ?>
					<div class="met_alert_title dslca-editable-content" data-id="title" data-type="simple" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>><?php echo stripslashes($options['title']); ?></div>
					<?php elseif( !empty($options['title'] ) && !$dslc_is_admin): ?>
					<div class="met_alert_title"><?php echo stripslashes($options['title']); ?></div>
				<?php endif; ?>

			<?php endif; ?>

			<?php if( in_array( 'content', $elements ) ) : ?>

				<?php if( $dslc_is_admin ): ?>
					<div class="met_alert_content dslca-editable-content" data-id="content" data-type="simple" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>><?php echo stripslashes($options['content']); ?></div>
				<?php elseif( !empty($options['title'] ) && !$dslc_is_admin): ?>
					<div class="met_alert_content"><?php echo stripslashes($options['content']); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</div>
        <?php echo $met_shared_options['script']; ?>

		<?php

		/* Module output ends here */

		$this->module_end( $options );

	}

}