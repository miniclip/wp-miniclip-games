<?php


/**
 *
 */
class Miniclip_Games_Category extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		parent::__construct(
			'miniclip_games_category',
			__( 'Miniclip Category', 'miniclip-games' ),
			array( 'description' => __( 'List the top 5 Games for the selected games category', 'miniclip-games' ), )
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		if ( isset( $instance['category'] ) ) {
			if ( $instance['category'] > 0 ) {

				echo $args['before_widget'];

				if ( ! empty( $instance['title'] ) ) {
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
				}

				$mc_games = new miniclip_games();
				echo $mc_games->embed_category( $instance['category'] );

				echo $args['after_widget'];

			}
		}

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {

		$mc_games = new miniclip_games();
		$categories = $mc_games->get_categories();

		if ( $categories ) {
			$current_category = ! empty( $instance['category'] ) ? intval( $instance['category'] ) : 0;
			echo '<select id="' . $this->get_field_id( 'category' ) . '" name="' . $this->get_field_name( 'category' ) . '" >';
			foreach( $categories as $cat ) {
				echo '<option value="' . intval( $cat['category_id'] ) . '" ' . selected(  ) . ' >' . esc_html( $cat['name'] ) . '</option>';
			}
			echo '</select>';
		}

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {

		$new_instance['category'] = (int) $new_instance['category'];
		return $new_instance;

	}

}

add_action( 'widgets_init', function() {
     register_widget( 'Miniclip_Games_Category' );
} );