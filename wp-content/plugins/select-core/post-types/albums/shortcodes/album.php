<?php
namespace QodeCore\PostTypes\Albums\Shortcodes;

use QodeCore\Lib;

/**
 * Class AlbumsList
 * @package QodeCore\PostTypes\Albums\Shortcodes
 */

class Album implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_album';

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
					'name' => esc_html__('Album', 'qodef-cpt'),
					'base' => $this->base,
					'category' => esc_html__('by SELECT','qodef-cpt'),
					'icon' => 'icon-wpb-album extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__('Album','qodef-cpt'),
							'param_name' 	=> 'album',
							'value' 		=> $this->getAlbums(),
							'admin_label' 	=> true,
							'save_always' 	=> true
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Album Skin','qodef-cpt'),
							'param_name' => 'album_skin',
							'value' => array(
								esc_html__('Default','qodef-cpt') 	=> '',
								esc_html__('Dark','qodef-cpt') 		=> 'dark',
								esc_html__('Light','qodef-cpt') 		=> 'light'
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => ''
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
			'album'		 => '',
			'album_skin' => '',
		);

		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['alb_skin'] = $this->getAlbumClasses($params);

		$html = '';
		$params['random_id'] = 'qodef-album-id-'.rand();
		$params['tracks'] = $this->getTracks($params);

		$html .= qodef_core_get_cpt_shortcode_template_part('albums','album-template', '', $params);
		return $html;
	}


	private function getAlbums(){

		$albums_array = array();
		$args = array(
			'post_type'			=> 'album',
			'posts_per_page'	=> '-1'
		);

		$query = new \WP_Query($args);
		if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();
				$albums_array[get_the_ID()] = get_the_title();
			endwhile;
		endif;

		return  array_flip($albums_array);
	}

	private function getTracks($params){

		$tracks_array = array();
		$tracks = get_post_meta($params['album'], 'qodef_track_file', true);
		$titles = get_post_meta($params['album'], 'qodef_track_title', true);
		$videos = get_post_meta($params['album'], 'qodef_track_video_link', true);
		$free_download = get_post_meta($params['album'], 'qodef_track_free_download', true);

		$i = 0;

		if($tracks){
			foreach($tracks as $track){
				/*------------------------------------------------------------------------------------------*/
				//if import is executed second time and file does exists in 'uploads' but not in database
				//usercase ex: user empties db, but not 'uploads' folder
				if(qodef_core_get_attachment_id_from_url($track) == null){
					$i++;
					continue;
				}
				/*------------------------------------------------------------------------------------------*/

				$tracks_array[$i]['track_file'] = $track;
				$track_id = qodef_core_get_attachment_id_from_url($track);

				$track_data = wp_get_attachment_metadata($track_id);
				$tracks_array[$i]['track_time'] = $track_data['length_formatted'];
				if(isset($videos[$i])){
					$tracks_array[$i]['video_link'] = $videos[$i];
				}

				if(isset($titles[$i])){
					$tracks_array[$i]['title']	= $titles[$i];
				}

				if(isset($free_download[$i]) && $free_download[$i] != ''){
					$tracks_array[$i]['free_download']	= $free_download[$i];
				}
				$i++;
			}
		}
		return  $tracks_array;
	}

	private function getAlbumClasses($params) {

		$album_classes = array();

		if ($params['album_skin'] == 'light') {
			$album_classes[] = 'qodef-album-light';
		} else if ($params['album_skin'] == 'dark') {
			$album_classes[] = 'qodef-album-dark';
		}

		return implode(';', $album_classes);
	}

}