<?php
// Register Module
add_action('dslc_hook_register_modules',
	create_function('', 'return dslc_register_module( "MET_ItemShowcaseGrid" );')
);

class MET_ItemShowcaseGrid extends DSLC_Module {

	var $module_id = 'MET_ItemShowcaseGrid';
	var $module_title = 'Item Showcase Grid';
	var $module_icon = 'pencil';
	var $module_category = 'met - post grids';

	function options() {

		$post_type_categoryArgs = categoryArgs('', '', 1);

		// Options
		$dslc_options = array(

			array(
				'label' => __( 'Elements', 'dslc_string' ),
				'id' => 'elements',
				'std' => 'title first_icon second_icon expand_area expanded_picture',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Title', 'dslc_string' ),
						'value' => 'title'
					),
					array(
						'label' => __( 'First Icon', 'dslc_string' ),
						'value' => 'first_icon'
					),
					array(
						'label' => __( 'Second Icon', 'dslc_string' ),
						'value' => 'second_icon'
					),
					array(
						'label' => __( 'Expand Area', 'dslc_string' ),
						'value' => 'expand_area'
					),
					array(
						'label' => __( 'Expanded Picture', 'dslc_string' ),
						'value' => 'expanded_picture'
					),
				)
			),

			array(
				'label' => __( 'Post Type', 'dslc_string' ),
				'id' => 'post_type',
				'std' => $post_type_categoryArgs[0]['value'],
				'type' => 'select',
				'choices' => $post_type_categoryArgs
			),
			array(
				'label' => __( 'Category IDs [Seperate with "," Comma]', 'dslc_string' ),
				'id' => 'category_ids',
				'std' => '',
				'type' => 'text',
			),
			array(
				'label' => __( 'Posts Per Page', 'dslc_string' ),
				'id' => 'amount',
				'std' => '12',
				'type' => 'text',
			),
			array(
				'label' => __( 'Posts Per Row', 'dslc_string' ),
				'id' => 'columns',
				'std' => '3',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '6',
						'value' => '6',
					),
					array(
						'label' => '4',
						'value' => '4',
					),
					array(
						'label' => '3',
						'value' => '3',
					),
					array(
						'label' => '2',
						'value' => '2',
					)
				),
			),
			array(
				'label' => __( 'Order By', 'dslc_string' ),
				'id' => 'orderby',
				'std' => 'date',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Publish Date', 'dslc_string' ),
						'value' => 'date'
					),
					array(
						'label' => __( 'Modified Date', 'dslc_string' ),
						'value' => 'modified'
					),
					array(
						'label' => __( 'Random', 'dslc_string' ),
						'value' => 'rand'
					),
					array(
						'label' => __( 'Alphabetic', 'dslc_string' ),
						'value' => 'title'
					),
					array(
						'label' => __( 'Comment Count', 'dslc_string' ),
						'value' => 'comment_count'
					),
				)
			),
			array(
				'label' => __( 'Order', 'dslc_string' ),
				'id' => 'order',
				'std' => 'DESC',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Ascending', 'dslc_string' ),
						'value' => 'ASC'
					),
					array(
						'label' => __( 'Descending', 'dslc_string' ),
						'value' => 'DESC'
					)
				)
			),
			array(
				'label' => __( 'Grid Gap', 'dslc_string' ),
				'id' => 'grid_gap',
				'std' => 'no_gap',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Default', 'dslc_string' ),
						'value' => ''
					),
					array(
						'label' => __( 'No Gap', 'dslc_string' ),
						'value' => 'no_gap'
					)
				)
			),
			array(
				'label' => __( 'Excerpt Length', 'dslc_string' ),
				'id' => 'excerpt_length',
				'std' => '50',
				'type' => 'text',
			),
			array(
				'label' => __( 'Offset', 'dslc_string' ),
				'id' => 'offset',
				'std' => '0',
				'type' => 'text',
			),

			array(
				'label' => __( 'Button Text', 'dslc_string' ),
				'id' => 'button_text',
				'std' => 'View Demo',
				'type' => 'text'
			),
			array(
				'label' => __( 'Open In', 'dslc_string' ),
				'id' => 'button_open_in',
				'std' => '_blank',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'This Tab', 'dslc_string' ),
						'value' => '_self'
					),
					array(
						'label' => __( 'New Tab', 'dslc_string' ),
						'value' => '_blank'
					)
				)
			),

			/**
			 * Image Options
			 */
			array(
				'label' => __( 'Thumbnail Resize - Width', 'dslc_string' ),
				'id' => 'thumb_resize_width_manual',
				'std' => '369',
				'type' => 'text',
			),
			array(
				'label' => __( 'Resize - Width', 'dslc_string' ),
				'id' => 'thumb_resize_width',
				'std' => '467',
				'type' => 'text',
				'visibility' => 'hidden'
			),
			array(
				'label' => __( 'Thumbnail Resize - Height', 'dslc_string' ),
				'id' => 'thumb_resize_height',
				'std' => '467',
				'type' => 'text'
			),
		);

		$dslc_options = array_merge(
			$dslc_options,

			// Box
			lc_general('.og-expander', 'Detail Box', array('background-color' => '#fff', 'text-align' => 'center')),

			// Box Paddings
			lc_paddings('.og-expander-inner', 'Detail Box', array('t' => '50', 'r' => '30', 'b' => '50', 'l' => '30')),

			// Thumbnail Title
			lc_general('.og-details h3', 'Detail Box', array('color' => '#393939', 'font-size' => '52'),'Title'),

			// Thumbnail Description
			lc_general('.og-details p', 'Detail Box', array('color' => '#999999', 'font-size' => '16', 'line-height' => '22'),'Description'),

			// Thumbnail Description Button
			lc_general('.og-details > a', 'Detail Box', array('color' => '#333333', 'color:hover' => '#393939', 'font-size' => '16', 'line-height' => '22', 'border-color' => '#333333'),'Description'),

			// Box Borders
			lc_borders('.og-expander', 'Detail Box Borders', array(), array(), '1', 'rgb(190, 190, 190)', 'solid'),

			// Thumbnail BG
			lc_general('.met_hover_effect', '', array('background-color' => '#ffffff')),

			// Thumbnail Paddings
			lc_paddings('.met_hover_effect', '', array('t' => '0', 'r' => '0', 'b' => '0', 'l' => '0')),

			// Thumbnail Borders
			lc_borders('.met_hover_effect', ''),

			// Thumbnail Title BG
			lc_general('.met_hover_effect figcaption', 'Title', array('background-color' => '#ffffff')),

			// Thumbnail Title
			lc_general('.met_hover_effect figcaption h2', 'Title', array('color' => '#000000', 'font-size' => '22','line-height' => '30')),

			// Thumbnail Title Paddings
			lc_paddings('.met_hover_effect figcaption', 'Title', '16'),

			// First Icon Choice
			lc_general('.met_hover_effect_icon.first', 'Icons', array('icon' => 'link'),'First Icon'),

			// First Icon Choice
			lc_general('.met_hover_effect_icon.second', 'Icons', array('icon' => 'eye-open'),'Second Icon'),

			// Icons
			lc_general('.met_hover_effect .met_hover_effect_icon', 'Icons', array('color' => '#000000', 'color:hover' => get_met_option('met_color'), 'font-size' => '22','line-height' => '30'))
		);

		$dslc_options = array_merge( $dslc_options, met_lc_shadows('met_hover_effect', 'Box Shadow') );
		$dslc_options = array_merge( $dslc_options, met_lc_shadows('og-expander', 'Detail Box Shadow') );
		$dslc_options = met_lc_extras($dslc_options, array('animation'), 'shared_options');
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
		//$met_lc_animation = ($options['parallax_activation'],$options['parallax_speed'],$options['parallax_vertical_offset'],$dslc_is_admin, $options['met_css_anim'], $options['met_css_anim_duration'], $options['met_css_anim_delay'], $options['met_css_anim_offset'], false, false, true, true);

		$met_shared_options = met_lc_extras( $options, array(
			'groups'   => array('animation'),
			'params'   => array(
				'js'           => false,
				'css'          => false,
				'external_run' => true,
				'is_grid'      => true,
			),
			'is_admin' => $dslc_is_admin,
		), 'shared_options_output' );

		$asyncScripts = "[]";
		if ( $dslc_is_admin ){
			$asyncScripts = $met_shared_options['js'];
		}else{
			if( $met_shared_options['activity'] ){
				wp_enqueue_script('metcreative-wow');
				wp_enqueue_style('metcreative-animate');
			}
		}

		/**
		 * Query
		 */
		$options['amount'] = $options['amount'] == '' ? -1 : $options['amount'];
		// General args
		$args = array(
			'paged' => 1,
			'post_type' => $options['post_type'],
			'posts_per_page' => $options['amount'],
			'order' => $options['order'],
			'orderby' => $options['orderby'],
			'offset' => $options['offset']
		);

		// Category args
		if($options['post_type'] != 'post'){
			$args = array_merge($args, categoryArgs($options['post_type'], $options['category_ids']));
		}else{
			if(!empty($options['category_ids'])) $args['category__in'] = explode(' ', $options['category_ids']);
		}

		// Do the query
		$dslc_query = new WP_Query( $args );

		/**
		 * Elements to show
		 */

		// Main Elements
		$elements = $options['elements'];
		if ( ! empty( $elements ) )
			$elements = explode( ' ', trim( $elements ) );
		else
			$elements = 'all';

		/**
		 * Posts ( output )
		 */
		if ( $dslc_query->have_posts() ) {
			$anim_delay = 0;
			if( $met_shared_options['activity'] && !empty($options['met_css_anim_delay_increment']) ){

				if( preg_match('/data-wow-delay="(\d.\d+)s"/', $met_shared_options['data-'], $anim_delay) !== false && count($anim_delay) > 1 ){
					$anim_delay_ = $anim_delay[1] * 1000;
				}
			}

			$taxonomyStack = array();
			$grid = 'og-grid';
			$anim_delay_counter = 0;
			?><ul id="<?php echo $grid; ?>" data-buttonopenin="<?php echo $options['button_open_in']; ?>" data-buttontext="<?php echo $options['button_text']; ?>" class="og-grid met_thumbnail_grid <?php if( $elements != 'all' && !in_array('expand_area', $elements) ) echo 'disable_expand' ?> <?php echo 'columns_'.$options['columns'].' '.$options['grid_gap']; ?>"><?php
				while ( $dslc_query->have_posts() ) : $dslc_query->the_post();

					$get_the_content = get_the_content();
					$get_the_content = trim( $get_the_content );

					$is_content_empty = false;
					if( empty( $get_the_content ) ){
						$is_content_empty = true;
					}

					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$thumb_url = $thumb_url[0];
					$resizedImage['url'] = '';

					if( empty($thumb_url) ) continue; ?>
					<li>
						<?php

						if( $met_shared_options['activity'] && $anim_delay !== false ){
							if( $anim_delay_counter == $options['columns'] ) $anim_delay_counter = 0;
							if( !isset($anim_delay_) ) $anim_delay_ = 0;
							$anim_delay = ($options['met_css_anim_delay_increment'] * $anim_delay_counter + $anim_delay_)/1000;

							$met_shared_options['data-'] = preg_replace( '/data-wow-delay="(.*)"/', 'data-wow-delay="'.$anim_delay.'s"', $met_shared_options['data-']);
						}

						$excerpt = wp_trim_words( get_the_excerpt(), $options['excerpt_length'] );

						$title = get_the_title();
						$parted_title = explode(' ', $title);
						for($i = 0; $i < count($parted_title); $i++){
							if( $i % 2 != 0 ) $parted_title[$i] = '<span>'.$parted_title[$i].'</span>';
						}
						$parted_title = implode(' ', $parted_title);

						$the_project_url = get_permalink();
						if ( $options['post_type'] == 'dslc_projects' ) {
							if ( !$the_project_url = get_post_meta( get_the_ID(), 'dslc_project_url', true ) ) $the_project_url = '#';
						}

						if ( ! empty( $thumb_url ) ) $resizedImage = imageResizing($thumb_url,$options['thumb_resize_height'],$options['thumb_resize_width_manual']); ?>

						<figure style="<?php echo met_lc_shadows('met_hover_effect', '', '', $options) ?>" class="met_hover_effect effect-zoe <?php if( $met_shared_options['activity'] ): ?>met_run_animations<?php endif; ?> <?php echo $met_shared_options['classes'] ?>" <?php echo $met_shared_options['data-']; ?>>
							<div class="met_hover_effect_preview_caption">
								<a class="og-grid-link" href="<?php echo $the_project_url; ?>" data-buttonsrc="<?php echo $the_project_url; ?>" data-largesrc="<?php echo $elements == 'all' || in_array('expanded_picture',$elements) ? $thumb_url : '' ?>" data-title="<?php echo $title; ?>" data-description="<?php echo $excerpt; ?>">
									<img src="<?php echo $resizedImage['url'] ?>" alt="<?php echo $title ?>"/>
								</a>
							</div>
							<?php if( $elements == 'all' || in_array('title', $elements) || in_array('first_icon', $elements) || in_array('second_icon', $elements) ): ?>
							<figcaption>
								<?php if( $elements == 'all' || in_array('title', $elements) ): ?><h2><?php echo $parted_title; ?></h2><?php endif; ?>
								<?php if( $elements == 'all' || in_array('first_icon', $elements) ): ?><a href="<?php echo $the_project_url; ?>" class="met_hover_effect_icon first" target="<?php echo $options['button_open_in']; ?>"><i class="dslc-icon dslc-icon-<?php echo $options['met_hover_effect_icon_first_icon']; ?>"></i></a><?php endif; ?>
								<?php if( $elements == 'all' || ( in_array('second_icon', $elements) AND !$is_content_empty ) ): ?><a href="#" class="met_hover_effect_icon second"><i class="dslc-icon dslc-icon-<?php echo $options['met_hover_effect_icon_second_icon']; ?>"></i></a><?php endif; ?>
							</figcaption>
							<?php endif; ?>
						</figure>
					</li><!-- .met_portfolio_item -->
					<?php
					$anim_delay_counter++;
				endwhile;
				?></ul><!-- .dslc-cpt-posts -->
			<script>
				jQuery(function(){
					<?php $async_callBacks = '[]'; ?>
					CoreJS.loadAsync(<?php echo $asyncScripts; ?>,<?php echo $async_callBacks; ?>);
				});
			</script>
			<?php echo $met_shared_options['script']; ?>
		<?php
		} else {
			if ( $dslc_is_admin ) :
				?><div class="dslc-notification dslc-red">You do not have any posts of that post type at the moment. <span class="dslca-refresh-module-hook dslc-icon dslc-icon-refresh"></span></span></div><?php
			endif;
		}

		if ( isset( $options['pagination_type'] ) && $options['pagination_type'] == 'numbered' ) {
			$num_pages = $dslc_query->max_num_pages;
			met_post_pagination( array( 'pages' => $num_pages ) );
		}

		wp_reset_query();
		$this->module_end( $options );

	}

}