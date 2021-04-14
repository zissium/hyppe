<?php
class MixtapeQodeLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_mixtape_qodef_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_mixtape_qodef_like', array( $this, 'ajax'));
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}

	function enqueue_scripts() {

		wp_enqueue_script( 'qodef-like', QODE_ASSETS_ROOT . '/js/like.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'qodef-like', 'qodefLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){

		//update
        $likes_id = isset( $_POST['likes_id'] ) && ! empty( $_POST['likes_id'] ) ? sanitize_text_field( $_POST['likes_id'] ) : '';
        $post_id  = ! empty( $likes_id ) ? substr( str_replace( 'qodef-like-', '', $likes_id ), 0, - 4 ) : '-1';

        check_ajax_referer( 'qodef_like_nonce_' . $post_id, 'like_nonce' );
		if( ! empty($likes_id) ) {

			$post_id = str_replace('qodef-like-', '', $likes_id);
			$post_id = substr($post_id, 0, -4);
			$type    = isset($_POST['type']) ? $likes_id : '';

			echo wp_kses($this->like_post($post_id, 'update', $type), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}

		//get
		else {
			$post_id = str_replace('qodef-like-', '', $likes_id);
			$post_id = substr($post_id, 0, -4);
			echo wp_kses($this->like_post($post_id, 'get'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}
		exit;
	}

	public function like_post($post_id, $action = 'get', $type = ''){
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$like_count = get_post_meta($post_id, '_qodef-like', true);
				if(isset($_COOKIE['qodef-like_'. $post_id])){
					$icon = '<i class="icon_heart" aria-hidden="true"></i>';
				}else{
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_qodef-like', $like_count, true);
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				$return_value = $icon . "<span>" . $like_count . "</span>";

				return $return_value;
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_qodef-like', true);

				if(isset($_COOKIE['qodef-like_'. $post_id])) {
					return $like_count;
				}

				$like_count++;

				update_post_meta($post_id, '_qodef-like', $like_count);
				setcookie('qodef-like_'. $post_id, $post_id, time()*20, '/');

				$return_value = "<i class='icon_heart' aria-hidden='true'></i><span>" . $like_count . "</span>";

				$return_value .= '</span>';
				return $return_value;
		

				return '';
				break;
			default:
				return '';
				break;
		}
	}

	public function add_like() {
		global $post;

		$output = $this->like_post($post->ID);

		$class = 'qodef-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'mixtapewp');
		if( isset($_COOKIE['qodef-like_'. $post->ID]) ){
			$class = 'qodef-like liked';
			$title = esc_html__('You already like this!', 'mixtapewp');
		}

		return '<a href="#" class="'. $class .'" id="qodef-like-'. $post->ID .'-'. $rand_number.'" title="'. $title .'" data-post-id="' . esc_attr( $post->ID ) . '">'. $output . wp_nonce_field( 'qodef_like_nonce_' . esc_attr( $post->ID ), 'qodef_like_nonce_' . esc_attr( $post->ID ), true, false ) . '</a>';
	}

	public function add_like_portfolio_list($portfolio_project_id){
        global $post;
		$class = 'qodef-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'mixtapewp');
		if( isset($_COOKIE['qodef-like_'. $portfolio_project_id]) ){
			$class = 'qodef-like liked';
			$title = esc_html__('You already like this!', 'mixtapewp');
		}

		return '<a class="'. esc_attr($class) .'" data-type="portfolio_list" id="qodef-like-'. esc_attr($portfolio_project_id) .'-'. $rand_number.'" title="'. esc_attr($title) .'" data-post-id="' . esc_attr( $post->ID ) . '">' . wp_nonce_field( 'qodef_like_nonce_' . esc_attr( $post->ID ), 'qodef_like_nonce_' . esc_attr( $post->ID ), true, false ) . '</a>';
	}

	public function add_like_blog_list($blog_id){
        global $post;
		$class = 'qodef-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'mixtapewp');
		if( isset($_COOKIE['qodef-like_'. $blog_id]) ){
			$class = 'qodef-like liked';
			$title = esc_html__('You already like this!', 'mixtapewp');
		}

		return '<a class="hover_icon '. $class .'" data-type="portfolio_list" id="qodef-like-'. $blog_id .'-'. $rand_number.'" title="'. $title .'" data-post-id="' . esc_attr( $post->ID ) . '">' . wp_nonce_field( 'qodef_like_nonce_' . esc_attr( $post->ID ), 'qodef_like_nonce_' . esc_attr( $post->ID ), true, false ) . '</a>';
	}

}

if ( !function_exists( 'mixtape_qodef_create_like' ) ) {

	function mixtape_qodef_create_like() {
		MixtapeQodeLike::get_instance();
	}

	add_action('after_setup_theme', 'mixtape_qodef_create_like');
}
