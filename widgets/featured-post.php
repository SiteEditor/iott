<?php
/**
 * Plugin widgets.
 *
 * @package NS_Featured_Posts
 */

/**
 * Featured Posts widget class.
 *
 * @since 1.0.0
 */
class Sed_Featured_Post_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		$widget_ops = array(
			'classname'   => 'nsfp_featured_post_widget',
			'description' => __( 'NS Featured Posts Widget', 'ns-featured-posts' ),
			);
		parent::__construct( 'nsfp-featured-post-widget', __( 'NS Featured Posts', 'ns-featured-posts' ), $widget_ops );

	}

	/**
	 * Echo the widget content.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including before_title, after_title,
	 *                        before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date 		 = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$post_type 		 = isset( $instance['post_type'] ) ? esc_attr( $instance['post_type'] ) : 'post';
		$style 	   		 = isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : 'default';
		$link_to_archive = isset( $instance['link_to_archive'] ) ? $instance['link_to_archive'] : false;
		$replace_title 	 = isset( $instance['style'] ) ? esc_attr( $instance['replace_title'] ) : '';

		$nsfp_query = new WP_Query( apply_filters( 'nsfp_featured_posts_widget_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'meta_key'            => '_is_ns_featured_post',
			'meta_value'          => 'yes',
			'post_type'           => $post_type,
		) ) );

	    echo $args['before_widget'];

		include dirname( __FILE__ ) . "/featured-post/{$style}.php";

		echo $args['after_widget'];

	}

	/**
	 * Update widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']     			= sanitize_text_field( $new_instance['title'] );
		$instance['number']    			= absint( $new_instance['number'] );
		$instance['show_date'] 			= isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['post_type'] 			= sanitize_text_field( $new_instance['post_type'] );
		$instance['style'] 				= sanitize_text_field( $new_instance['style'] );
		$instance['link_to_archive'] 	= isset( $new_instance['link_to_archive'] ) ? (bool) $new_instance['link_to_archive'] : false;
		$instance['replace_title'] 		= sanitize_text_field( $new_instance['replace_title'] );

		return $instance;

	}

	/**
	 * Output the settings update form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		$title     			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    			= isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date 			= isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$post_type 			= isset( $instance['post_type'] ) ? esc_attr( $instance['post_type'] ) : 'post';
		$style 				= isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : 'default';
		$link_to_archive 	= isset( $instance['link_to_archive'] ) ? $instance['link_to_archive'] : false;
		$replace_title 	 	= isset( $instance['style'] ) ? esc_attr( $instance['replace_title'] ) : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ns-featured-posts' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'ns-featured-posts' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type:', 'ns-featured-posts' ) ?></label>
			<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<option value="post" <?php selected( $post_type, 'post' ) ?>><?php _e( 'Post', 'ns-featured-posts' ) ?></option>
				<option value="page" <?php selected( $post_type, 'page' ) ?>><?php _e( 'Page', 'ns-featured-posts' ) ?></option>
				<?php
				$args = array(
					'public'   => true,
					'_builtin' => false,
					);
				$post_types_custom = get_post_types( $args, 'objects' );
				?>
				<?php if ( ! empty( $post_types_custom ) ) : ?>
					<?php foreach ( $post_types_custom as $key => $ptype ) : ?>

						<?php $name = $ptype->labels->{'name'}; ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $post_type, $key ) ?>><?php echo esc_html( $name ); ?></option>

					<?php endforeach; ?>

				<?php endif; ?>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'ns-featured-posts' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Select Style:', 'ns-featured-posts' ) ?></label>
			<select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
				<option value="default" <?php selected( $style, 'default' ) ?>><?php _e( 'Default', 'ns-featured-posts' ) ?></option>
				<option value="style1" <?php selected( $style, 'style1' ) ?>><?php _e( 'Style 1', 'ns-featured-posts' ) ?></option>
				<option value="style2" <?php selected( $style, 'style2' ) ?>><?php _e( 'Style 2', 'ns-featured-posts' ) ?></option>
				<option value="style3" <?php selected( $style, 'style3' ) ?>><?php _e( 'Style 3', 'ns-featured-posts' ) ?></option>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $link_to_archive ); ?> id="<?php echo $this->get_field_id( 'link_to_archive' ); ?>" name="<?php echo $this->get_field_name( 'link_to_archive' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'link_to_archive' ); ?>"><?php _e( 'Link To Archive? "for style 2 and style 3"', 'ns-featured-posts' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'replace_title' ); ?>"><?php _e( 'Replace Title:', 'ns-featured-posts' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'replace_title' ); ?>" name="<?php echo $this->get_field_name( 'replace_title' ); ?>" type="text" value="<?php echo $replace_title; ?>" />
		</p>

		<?php
	}
}
