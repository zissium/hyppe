<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class QodefInstagramWidget extends WP_Widget {

	protected $params;

	public function __construct() {
		parent::__construct(
			'qodef_instagram_widget',
			esc_html__( 'Select Instagram Widget', 'qodef-instagram-feed' ),
			array( 'description' => esc_html__( 'Display instagram images', 'qodef-instagram-feed' ) )
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'name'  => 'title',
				'type'  => 'textfield',
				'title' => esc_html__( 'Title', 'qodef-instagram-feed' )
			),
			array(
				'name'  => 'tag',
				'type'  => 'textfield',
				'title' => esc_html__( 'Tag', 'qodef-instagram-feed' )
			),
			array(
				'name'  => 'number_of_photos',
				'type'  => 'textfield',
				'title' => esc_html__( 'Number of photos', 'qodef-instagram-feed' )
			),
			array(
				'name'    => 'number_of_cols',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Number of columns', 'qodef-instagram-feed' ),
				'options' => array(
					'2' => esc_html__( 'Two', 'qodef-instagram-feed' ),
					'3' => esc_html__( 'Three', 'qodef-instagram-feed' ),
					'4' => esc_html__( 'Four', 'qodef-instagram-feed' ),
					'6' => esc_html__( 'Six', 'qodef-instagram-feed' ),
					'9' => esc_html__( 'Nine', 'qodef-instagram-feed' ),
				)
			),
			array(
				'name'    => 'image_size',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Image Size', 'qodef-instagram-feed' ),
				'options' => array(
					'thumbnail'           => esc_html__( 'Small', 'qodef-instagram-feed' ),
					'low_resolution'      => esc_html__( 'Medium', 'qodef-instagram-feed' ),
					'standard_resolution' => esc_html__( 'Large', 'qodef-instagram-feed' )
				)
			),
			array(
				'name'  => 'transient_time',
				'type'  => 'textfield',
				'title' => esc_html__( 'Images Cache Time', 'qodef-instagram-feed' )
			),
		);
	}

	public function getParams() {
		return $this->params;
	}

	public function widget( $args, $instance ) {
		extract( $instance );

		echo wp_kses_post( $args['before_widget'] );
		if ( $title !== null && $title !== '' ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
		}

		$instagram_api = QodefInstagramApi::getInstance();
		$images_array  = $instagram_api->getImages( $number_of_photos, $tag, array(
			'use_transients' => true,
			'transient_name' => $args['widget_id'],
			'transient_time' => $transient_time
		) );

		$number_of_cols = $number_of_cols == '' ? 3 : $number_of_cols;

		if ( is_array( $images_array ) && count( $images_array ) ) { ?>
            <ul class="qodef-instagram-feed clearfix qodef-col-<?php echo esc_attr( $number_of_cols ); ?>">
				<?php
				foreach ( $images_array as $image ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $instagram_api->getHelper()->getImageLink( $image ) ); ?>" target="_blank">
							<?php echo mixtape_qodef_kses_img( $instagram_api->getHelper()->getImageHTML( $image, $image_size ) ); ?>
                        </a>
                    </li>
				<?php } ?>
            </ul>
		<?php }

		echo wp_kses_post( $args['after_widget'] );
	}

	public function form( $instance ) {
		foreach ( $this->params as $param_array ) {
			$param_name    = $param_array['name'];
			${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
		}

		$instagram_api = QodefInstagramApi::getInstance();

		//user has connected with instagram. Show form
		if ( $instagram_api->hasUserConnected() ) {
			foreach ( $this->params as $param ) {
				switch ( $param['type'] ) {
					case 'textfield':
						?>
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
								esc_html( $param['title'] ); ?></label>
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
                        </p>
						<?php
						break;
					case 'dropdown':
						?>
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
								esc_html( $param['title'] ); ?></label>
							<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
                                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
									<?php foreach ( $param['options'] as $param_option_key => $param_option_val ) {
										$option_selected = '';
										if ( ${$param['name']} == $param_option_key ) {
											$option_selected = 'selected';
										}
										?>
                                        <option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
									<?php } ?>
                                </select>
							<?php } ?>
                        </p>

						<?php
						break;
				}
			}
		}
	}
}

function qodef_instagram_widget_load() {
	register_widget( 'QodefInstagramWidget' );
}

add_action( 'widgets_init', 'qodef_instagram_widget_load' );