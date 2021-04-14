<?php
namespace QodeCore\PostTypes\Albums\Shortcodes;

use QodeCore\Lib;

/**
 * Class AlbumsList
 * @package QodeCore\PostTypes\Albums\Shortcodes
 */

class ArtistsList implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_artists_list';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */

	public function vcMap() {
		if(function_exists('vc_map')) {

			vc_map( array(
					'name' => esc_html__('Artists List', 'qodef-cpt'),
					'base' => $this->getBase(),
					'category' => esc_html__('by SELECT', 'qodef-cpt'),
					'icon' => 'icon-wpb-artists extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Order By', 'qodef-cpt'),
							'param_name' => 'order_by',
							'value' => array(
								esc_html__('Name', 'qodef-cpt') => 'name',
								esc_html__('Order Number', 'qodef-cpt') => 'artist_order'
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => '',
							'group' => esc_html__('Query and Layout Options', 'qodef-cpt')
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Order', 'qodef-cpt'),
							'param_name' => 'order',
							'value' => array(
								'ASC' => 'ASC',
								'DESC' => 'DESC',
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => '',
							'group' => esc_html__('Query and Layout Options', 'qodef-cpt')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Show Only Artists with Listed IDs', 'qodef-cpt'),
							'param_name' => 'selected_artists',
							'value' => '',
							'admin_label' => true,
							'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'qodef-cpt'),
							'group' => esc_html__('Query and Layout Options', 'qodef-cpt')
						)
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'order_by'			=> 'name',
			'order' 			=> 'ASC',
			'selected_artists' 	=> ''
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		$artists = $this->getTaxonomyArray($params);
		$data_atts = $this->getDataAtts($params);

		$html = '';
		$html .= '<div class = "qodef-artists-list-holder-outer " '.$data_atts. '>';

		$html .= '<div class = "qodef-artists-list-holder clearfix" >';

		if(!empty($artists)) {
			foreach ($artists as $artist) {
				$params['artist'] = $artist;
				$html .= qodef_core_get_cpt_shortcode_template_part('albums', 'artist', '', $params);
			}
		}else {
			$html .= '<p>' . esc_html_e('Sorry, no artists matched your criteria.', 'qodef-cpt') . '</p>';
		}

		$html .= '<div class = "qodef-artists-grid-sizer" ></div>';
		$html .= '<div class = "qodef-artists-grid-gutter" ></div>';
		$html .= '</div>'; //close qodef-artists-list-holder

		$html .= '<div class="qodef-artist-single-expander"></div>';
		$html .= '<div class="qodef-artist-view-single">';
		if(!empty($artists)) {
			$counter = 1;
			$params['number_of_artists'] = sprintf("%02d", count($artists));
			foreach ($artists as $artist) {
				$params['artist'] = $artist;
				$params['counter'] = sprintf("%02d", $counter);
				$html .= qodef_core_get_cpt_shortcode_template_part('albums', 'artist-single', '', $params);
				$counter++;
			}
			$html .= qodef_core_get_cpt_shortcode_template_part('albums', 'artist-single-navigation', '', $params);
		}
		$html .= '</div>'; //close qodef-artist-view-single

		wp_reset_postdata();
		$html .= '</div>'; // close qodef-artists-list-holder-outer
		return $html;
	}

	/**
	 * Generates albums list query attribute array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getTaxonomyArray($params){
		$tax = 'album-artist';

		$args = array(
			'hide_empty' => false,
			'order' => $params['order'],
		);

		if($params['order_by'] == 'artist_order'){
			$args['meta_key'] = 'artist_order';
			$args['orderby'] = 'meta_value';
		}else{
			$args['orderby'] = $params['order_by'];
		}

		if (!empty($params['selected_artists'])) {
			$args['include'] = $params['selected_artists'];
		}

		$artists = $terms = get_terms($tax, $args);

		return $artists;
	}
	
	/**
	 * Generates datta attributes array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getDataAtts($params){

		$data_attr = array();
		$data_return_string = '';

		if(!empty($params['order_by'])){
			$data_attr['data-order-by'] = $params['order_by'];
		}
		if(!empty($params['order'])){
			$data_attr['data-order'] = $params['order'];
		}

		if(!empty($params['selected_artists'])){
			$data_attr['data-selected-artists'] = $params['selected_artists'];
		}

		foreach($data_attr as $key => $value) {
			if($key !== '') {
				$data_return_string .= $key . '= "' . esc_attr( $value ) . '" ';
			}
		}
		return $data_return_string;
	}
}