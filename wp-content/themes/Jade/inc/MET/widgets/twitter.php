<?php
class MET_Twitter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'MET_Twitter_Widget',
			':MET Twitter Widget'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$username = $instance['username'];
		$amount = (isset($instance['amount'])) ? $instance['amount'] : 20;

		$speed = (isset($instance['speed'])) ? $instance['speed'] : 1000;
		$pause = (isset($instance['pause'])) ? $instance['pause'] : 4000;
		$minSlides = (isset($instance['minSlides'])) ? $instance['minSlides'] : 2;
		$maxSlides = (isset($instance['maxSlides'])) ? $instance['maxSlides'] : 2;
		
		$widget_id = uniqid('met_widget_twitter_');

		$the_tweets = MC_Framework_Core::get_tweets($username, $amount);
		?>

		<?php echo $before_widget; ?>
		<?php echo $before_title. $title. $after_title ?>
		<div id="<?php echo $widget_id ?>" class="met_footer_twits_wrapper clearfix">
			<div class="met_footer_twits">
				<?php
					if(count($the_tweets) > 0){
						foreach($the_tweets as $the_tweet_item){
							echo '<div class="met_footer_twit_item">'.$the_tweet_item.'</div>';
						}
					}
				?>
			</div>
		</div>
		<?php echo $after_widget; ?>

		<script>
			jQuery().ready(function(){
				jQuery('#<?php echo $widget_id ?> .met_footer_twits').bxSlider({
					mode: 'vertical',
					speed: <?php echo $speed ?>,
					pager: false,
					controls: false,
					auto: true,
					pause: <?php echo $pause ?>,
					autoHover: true,
					minSlides: <?php echo $minSlides ?>,
					maxSlides: <?php echo $maxSlides ?>,
					moveSlides: 1,
					adaptiveHeight: false
				});
			})
		</script>
		<?php wp_enqueue_script('metcreative-bxslider'); ?>

	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( trim($new_instance['username']));
		$instance['amount'] = (int) $new_instance['amount'];
		$instance['speed'] = (int) $new_instance['speed'];
		$instance['pause'] = (int) $new_instance['pause'];
		$instance['minSlides'] = (int) $new_instance['minSlides'];
		$instance['maxSlides'] = (int) $new_instance['maxSlides'];

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else{$title = '';}

		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		}else{
			$username = 'envato';
		}

		if ( isset( $instance[ 'amount' ] ) ) {
			$amount = $instance[ 'amount' ];
		}else{
			$amount = 20;
		}

		if ( isset( $instance[ 'speed' ] ) ) {
			$speed = $instance[ 'speed' ];
		}else{
			$speed = 1000;
		}

		if ( isset( $instance[ 'pause' ] ) ) {
			$pause = $instance[ 'pause' ];
		}else{
			$pause = 4000;
		}

		if ( isset( $instance[ 'minSlides' ] ) ) {
			$minSlides = $instance[ 'minSlides' ];
		}else{
			$minSlides = 2;
		}

		if ( isset( $instance[ 'maxSlides' ] ) ) {
			$maxSlides = $instance[ 'maxSlides' ];
		}else{
			$maxSlides = 2;
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php _e( 'Amount:', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="number" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<hr>
		<p>
			<label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>" type="number" value="<?php echo esc_attr( $speed ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" name="<?php echo $this->get_field_name( 'pause' ); ?>" type="number" value="<?php echo esc_attr( $pause ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'minSlides' ); ?>"><?php _e( 'Show (Min):', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'minSlides' ); ?>" name="<?php echo $this->get_field_name( 'minSlides' ); ?>" type="number" value="<?php echo esc_attr( $minSlides ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'maxSlides' ); ?>"><?php _e( 'Show (Max):', 'metcreative' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'maxSlides' ); ?>" name="<?php echo $this->get_field_name( 'maxSlides' ); ?>" type="number" value="<?php echo esc_attr( $maxSlides ); ?>" />
		</p>
	<?php
	}

}register_widget( 'MET_Twitter_Widget' );