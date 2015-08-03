<?php

class MET_Post_Tabs_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'met_post_tabs_widget',
			':MET Post Tabs Widget'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$post_limit = $instance['post_limit'];

		$widget_id = uniqid('met_post_tabs');

		?>

		<?php echo $before_widget ?>
		<!-- Recent/Popular Posts Starts -->
			<ul class="met_sidebar_tabs nav nav-tabs">
				<li class="active"><a href="#recentPosts" data-toggle="tab"><?php _e('Recent Posts','Jade') ?></a></li>
				<li><a href="#popularPosts" data-toggle="tab"><?php _e('Popular Posts','Jade') ?></a></li>
			</ul>
			<div class="met_sidebar_tabs tab-content">
				<div class="tab-pane fade in active" id="recentPosts">
					<?php
						$args = array( 'numberposts' => $post_limit );
						$recent_posts = wp_get_recent_posts( $args );
						foreach( $recent_posts as $recent ){
							$num_comments = get_comments_number($recent["ID"]);
							$comments = $write_comments = '';

							if ( comments_open() ) {
								if ( $num_comments == 0 ) {
									$comments = __('No Comments','default');
								} elseif ( $num_comments > 1 ) {
									$comments = $num_comments . __(' Comments','default');
								} else {
									$comments = __('1 Comment','default');
								}
								$write_comments = '<a href="' . get_comments_link() .'" class="met_color_transition2">'. $comments.'</a>';
							} else {
								$write_comments =  __('Comments are off','default');
							}

							echo '<div class="met_sidebar_post_box clearfix">';
							echo ( ( has_post_thumbnail($recent["ID"])) ? '<a href="' . get_permalink($recent["ID"]) . '" class="met_sidebar_post_image">'.get_the_post_thumbnail( $recent["ID"], 'thumbnail' ).'</a>' : '' );

							echo '<a href="' . get_permalink($recent["ID"]) . '" class="met_sidebar_post_title met_color_transition2">'.$recent["post_title"].'</a>
								<div><a href="' . get_permalink($recent["ID"]) . '" class="met_color_transition2">'.get_the_date('',$recent["ID"]).',</a> '.$write_comments.'</div>
							</div>';
						}
					?>
				</div>
				<div class="tab-pane fade" id="popularPosts">
					<?php
					$args = array( 'numberposts' => $post_limit, 'orderby' => 'comment_count' );
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						$num_comments = get_comments_number($recent["ID"]);
						$comments = $write_comments = '';

						if ( comments_open() ) {
							if ( $num_comments == 0 ) {
								$comments = __('No Comments','default');
							} elseif ( $num_comments > 1 ) {
								$comments = $num_comments . __(' Comments','default');
							} else {
								$comments = __('1 Comment','default');
							}
							$write_comments = '<a href="' . get_comments_link() .'" class="met_color_transition2">'. $comments.'</a>';
						} else {
							$write_comments =  __('Comments are off','default');
						}

						echo '<div class="met_sidebar_post_box clearfix">';
						echo ( ( has_post_thumbnail($recent["ID"])) ? '<a href="' . get_permalink($recent["ID"]) . '" class="met_sidebar_post_image">'.get_the_post_thumbnail( $recent["ID"], 'thumbnail' ).'</a>' : '' );

						echo '<a href="' . get_permalink($recent["ID"]) . '" class="met_sidebar_post_title met_color_transition2">'.$recent["post_title"].'</a>
								<div><a href="' . get_permalink($recent["ID"]) . '" class="met_color_transition2">'.get_the_date('',$recent["ID"]).',</a> '.$write_comments.'</div>
							</div>';
					}
					?>
				</div>
			</div>
		<!-- Recent/Popular Posts Ends -->

		<?php echo $after_widget ?>

	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['post_limit'] = strip_tags( $new_instance['post_limit'] );

		return $instance;
	}

	public function form( $instance ) {

        if ( isset( $instance[ 'post_limit' ] ) ) {
            $post_limit = $instance[ 'post_limit' ];
        }else{
			$post_limit = 3;
        }
		?>

		<p>
			<label for="<?php echo $this->get_field_id('post_limit'); ?>"><?php _e('Number of Posts:','metcreative'); ?></label>
			<select name="<?php echo $this->get_field_name('post_limit'); ?>" id="<?php echo $this->get_field_id('post_limit'); ?>" class="widefat">
				<?php
				$options = array(3,4,5,6,7,8,9,10);
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $post_limit == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				?>
			</select>
		</p>
	<?php
	}

}register_widget( 'MET_Post_Tabs_Widget' );