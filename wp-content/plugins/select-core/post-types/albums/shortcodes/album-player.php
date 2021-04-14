<?php
namespace QodeCore\PostTypes\Albums\Shortcodes;

use QodeCore\Lib;

/**
 * Class AlbumsList
 * @package QodeCore\PostTypes\Albums\Shortcodes
 */

class AlbumPlayer implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_album_player';

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
					'name' => esc_html__('Album Player', 'qodef-cpt'),
					'base' => $this->base,
					'category' => esc_html__('by SELECT','qodef-cpt'),
					'icon' => 'icon-wpb-album-player extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Type','qodef-cpt'),
							'param_name' 	=> 'type',
							'value' => array(
								esc_html__('Standard','qodef-cpt')	=> 'standard',
								esc_html__('Compact','qodef-cpt')	=> 'compact',
								esc_html__('Simple','qodef-cpt')	=> 'simple'
							),
							'admin_label' 	=> true
						),
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Album','qodef-cpt'),
							'param_name' 	=> 'album',
							'value' 		=> $this->getAlbums(),
							'admin_label' 	=> true,
							'save_always' 	=> true
						),
						array(
	                        'type'        => 'dropdown',
	                        'heading'     => esc_html__('Content In Grid','qodef-cpt'),
	                        'param_name'  => 'full_width_bg',
	                        'value'       => array(
	                            esc_html__('Yes','qodef-cpt')     => 'yes',
	                            esc_html__('No','qodef-cpt')      => 'no'
	                        ),
	                        'admin_label' => true,
	               			'save_always' => true
	                    ),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__('Player Background Color','qodef-cpt'),
							'param_name' => 'bg_color',
                            'dependency'  => array('element' => 'skin','value'=> array('light','dark')),
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__('Play Button Background Color','qodef-cpt'),
							'param_name' => 'play_bg_color',
                            'dependency'  => array('element' => 'skin','value'=> array('light','dark')),
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__('Navigation Buttons Background Color','qodef-cpt'),
							'param_name' => 'nav_bg_color',
                            'dependency'  => array('element' => 'skin','value'=> array('light','dark')),
						),
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Skin','qodef-cpt'),
							'param_name' 	=> 'skin',
							'value' => array(
								esc_html__('Light','qodef-cpt')	=> 'light',
								esc_html__('Dark','qodef-cpt')   => 'dark',
								esc_html__('Transparent','qodef-cpt')   => 'transparent'
							),
							'admin_label' 	=> true,
							'save_always' 	=> true
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
			'type'			=> 'standard',
			'album'			=> '',
			'full_width_bg'	=> '',
			'bg_color'		=> '',
			'play_bg_color'	=> '', 
			'nav_bg_color'	=> '',
			'skin'			=> 'light'
		);

		$params = shortcode_atts($args, $atts);
		extract($params);

        $params['player_styles'] = '';
        $params['play_button_styles'] = '';
        $params['nav_buttons_styles'] = '';
		if($params['skin'] == 'transparent'){
            $params['player_styles'] = $this->getPlayerStyles($params);
            $params['play_button_styles'] = $this->getPlayButtonStyles($params);
            $params['nav_buttons_styles'] = $this->getNavigationButtonsStyles($params);
        }

		$params['player_id'] = rand();
		$params['player_classes'] = $this->getPlayerClasses($params);
		$html = '';

		$html .= qodef_core_get_cpt_shortcode_template_part('albums','album-player-'.$params['type'].'-template', '', $params);
		return $html;
	}

	private function getPlayerStyles($params) {

		$player_styles = array();

		if ($params['bg_color'] !== '') {
			$player_styles[] = 'background-color:' . $params['bg_color'];
		}

		return implode(';', $player_styles);
	}

	private function getPlayButtonStyles($params) {

		$play_button_styles = array();

		if ($params['play_bg_color'] !== '') {
			$play_button_styles[] = 'background-color:' . $params['play_bg_color'];
		}

		return implode(';', $play_button_styles);
	}

	private function getNavigationButtonsStyles($params) {

		$nav_buttons_styles = array();

		if ($params['nav_bg_color'] !== '') {
			$nav_buttons_styles[] = 'background-color:' . $params['nav_bg_color'];
		}

		return implode(';', $nav_buttons_styles);
	}

	private function getAlbums(){

		$albums_array = array();
		$args = array(
			'post_type' => 'album',
			'posts_per_page' => '-1'
		);

		$query = new \WP_Query($args);
		if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();
				$albums_array[get_the_ID()] = get_the_title();
			endwhile;
		endif;

		return  array_flip($albums_array);
	}

	private function getPlayerClasses($params) {

		$player_classes = array();
        $player_classes[] = 'qodef-player-'.$params['skin'];

		return implode(';', $player_classes);
	}

}