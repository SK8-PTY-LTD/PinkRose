<?php

class MET_Flickr_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'met_flickr_widget',
			':MET Flickr Widget'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$flickr_username = $instance['flickr_username'];
		$flickr_limit = $instance['flickr_limit'];

		wp_enqueue_script('metcreative-jflickrfeed');

		$widget_id = uniqid('flickr_feed_');

		?>
		<?php echo $before_widget ?>
		<?php echo $before_title. $title. $after_title ?>

		<ul id="<?php echo $widget_id ?>" class="met_flickr_feed met_clean_list clearfix" data-limit="<?php echo $flickr_limit ?>" data-id="<?php echo $flickr_username ?>"></ul>

		<?php echo $after_widget ?>

		<script type="text/javascript">
			jQuery(document).ready(function(){
				CoreJS.flickrfeed("<?php echo $widget_id ?>");
			});
		</script>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_username'] = strip_tags( trim($new_instance['flickr_username']));
		$instance['flickr_limit'] = strip_tags( trim($new_instance['flickr_limit']));

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else{$title = 'Flickr Photos';}

		if ( isset( $instance[ 'flickr_username' ] ) ) {
			$flickr_username = $instance[ 'flickr_username' ];
		}else{
			$flickr_username = '12202794@N04';
		}

        if ( isset( $instance[ 'flickr_limit' ] ) ) {
            $flickr_limit = $instance[ 'flickr_limit' ];
        }else{
            $flickr_limit = '10';
        }
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_username' ); ?>"><?php _e( 'User ID:', 'metcreative' ); ?> [idgettr.com]</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_username' ); ?>" name="<?php echo $this->get_field_name( 'flickr_username' ); ?>" type="text" value="<?php echo esc_attr( $flickr_username ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'flickr_limit' ); ?>"><?php _e( 'Image Limit:', 'metcreative' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'flickr_limit' ); ?>" name="<?php echo $this->get_field_name( 'flickr_limit' ); ?>" type="text" value="<?php echo esc_attr( $flickr_limit ); ?>" />
        </p>
	<?php
	}

}register_widget( 'MET_Flickr_Widget' );