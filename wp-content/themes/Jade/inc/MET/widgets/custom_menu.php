<?php
class MET_Custom_Menu_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'MET_Custom_Menu_Widget',
			':MET Custom Menu'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$select = $instance['select'];

		$widget_id = uniqid('met_widget_custom_menu_');
?>

		<?php echo $before_widget; ?>
		<?php
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>
		<div id="<?php echo $widget_id ?>" class="met_custom_clean_menu clearfix">
			<?php
			wp_nav_menu(
				array(
					'menu' => $select,
					'menu_id' => '' ,
					'menu_class' => 'met_clean_list',
					'container' => '',
					'fallback_cb' => ''
				)
			)
			?>
		</div>
		<?php echo $after_widget; ?>


	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['select'] = strip_tags( $new_instance['select'] );

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else{$title = '';}

		if ( isset( $instance[ 'select' ] ) ) {
			$select = esc_attr($instance['select']);
		}else{$select = '';}

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Menu:','metcreative'); ?></label>
			<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
				<?php
				$menus = get_terms('nav_menu');
				if($menus){
					foreach($menus as $menu){
						$options[$menu->slug] = $menu->name;
					}
				}
				//$options = array('one', 'two', 'three');
				foreach ($options as $optionKEY => $optionVAL) {
					echo '<option value="' . $optionKEY . '" id="' . $optionKEY . '"', $select == $optionKEY ? ' selected="selected"' : '', '>', $optionVAL, '</option>';
				}
				?>
			</select>
		</p>
	<?php
	}

}register_widget( 'MET_Custom_Menu_Widget' );