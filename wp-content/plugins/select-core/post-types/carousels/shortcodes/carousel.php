<?php
namespace QodeCore\PostTypes\Carousels\Shortcodes;

use QodeCore\Lib;

/**
 * Class Carousel
 * @package QodeCore\PostTypes\Carousels\Shortcodes
 */
class Carousel implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'qodef_carousel';

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
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see qodef_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        vc_map( array(
            'name' => esc_html__('Carousel', 'qodef-cpt' ),
            'base' => $this->base,
            'category' => esc_html__('by SELECT', 'qodef-cpt' ),
            'icon' => 'icon-wpb-carousel-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Carousel Slider', 'qodef-cpt' ),
                    'param_name' => 'carousel',
                    'value' => qodef_core_get_carousel_slider_array_vc(),
                    'description' => '',
                    'admin_label' => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Order By', 'qodef-cpt' ),
                    'param_name' => 'orderby',
                    'value' => array(
                        '' => '',
                        esc_html__('Title', 'qodef-cpt' ) => 'title',
                        esc_html__('Date', 'qodef-cpt' ) => 'date'
                    ),
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Order', 'qodef-cpt' ),
                    'param_name' => 'order',
                    'value' => array(
                        '' => '',
                        'ASC' => 'ASC',
                        'DESC' => 'DESC',
                    ),
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Number of items showing', 'qodef-cpt' ),
                    'param_name' => 'number_of_items',
                    'value' => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '8' => '8'
                    ),
                    'admin_label' => true,
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Image Animation', 'qodef-cpt' ),
                    'param_name' => 'image_animation',
                    'value' => array(
                        esc_html__('Image Change', 'qodef-cpt' ) => 'image-change',
                        esc_html__('Image Zoom', 'qodef-cpt' ) => 'image-zoom'
                    ),
                    'admin_label' => true,
                    'save_always' => true,
                    'description' => esc_html__('Note: Only on "Image Change" zoom image will be used', 'qodef-cpt' )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Show Arrows navigation?', 'qodef-cpt' ),
                    'param_name' => 'show_arrows_navigation',
                    'value' => array(
                        esc_html__('Yes', 'qodef-cpt' ) => 'yes',
                        esc_html__('No', 'qodef-cpt' ) => 'no',
                    ),
                    'admin_label' => true,
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Show Dots navigation?', 'qodef-cpt' ),
                    'param_name' => 'show_dots_navigation',
                    'value' => array(
                        esc_html__('Yes', 'qodef-cpt' ) => 'yes',
                        esc_html__('No', 'qodef-cpt' ) => 'no',
                    ),
                    'admin_label' => true,
                    'description' => ''
                )
            )
        ) );

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
            'carousel' => '',
            'orderby' => 'date',
            'order' => 'ASC',
            'number_of_items' => '5',
            'image_animation' => 'image-change',
            'show_arrows_navigation' => 'yes',
            'show_dots_navigation' => 'yes'
        );

        $params = shortcode_atts($args, $atts);
		$params['carousel_data_attributes'] = $this->getCarouselDataAttributes($params);

		extract($params);

        $html = '';

        if ($carousel !== '') {

            $html .= '<div class="qodef-carousel-holder clearfix">';
            $html .= '<div class="qodef-carousel qodef-slick-slider-navigation-style" ' .  mixtape_qodef_get_inline_attrs($carousel_data_attributes) . '>';

            $args = array(
                'post_type' => 'carousels',
                'carousels_category' => $params['carousel'],
                'orderby' => $params['orderby'],
                'order' => $params['order'],
                'posts_per_page' => '-1'
            );

            $query = new \WP_Query($args);

            if ($query->have_posts()) {
                while($query->have_posts()) {
                    $query->the_post();
                    $carousel_item = $this->getCarouselItemData(get_the_ID(), $params);
                    $html .= qodef_core_get_cpt_shortcode_template_part('carousels', 'carousel-template', '', $carousel_item);
                }
            }

            wp_reset_postdata();


            $html .= '</div>';
            $html .= '</div>';

        }

        return $html;
    }

    /**
     * Return all data that carousel needs, images, titles, links, etc
     *
     * @param $params
     * @return array
     */
    private function getCarouselItemData($item_id, $params) {

        $carousel_item = array();

        if (($meta_temp = get_post_meta($item_id, 'qodef_carousel_image', true)) !== '') {
            $carousel_item['image'] = $meta_temp;
        } else {
            $carousel_item['image'] = '';
        }

        if ($params['image_animation'] == 'image-change' && ($meta_temp = get_post_meta($item_id, 'qodef_carousel_hover_image', true)) !== '') {
            $carousel_item['hover_image'] = $meta_temp;
            $carousel_item['hover_class'] = 'qodef-has-hover-image';
        } else {
            $carousel_item['hover_image'] = '';
            $carousel_item['hover_class'] = '';
        }

        if (($meta_temp = get_post_meta($item_id, 'qodef_carousel_item_link', true)) != '') {
            $carousel_item['link'] = $meta_temp;
        } else {
            $carousel_item['link'] = '';
        }

        if (($meta_temp = get_post_meta($item_id, 'qodef_carousel_item_target', true)) != '') {
            $carousel_item['target'] = $meta_temp;
        } else {
            $carousel_item['target'] = '_self';
        }

        $carousel_item['title'] = get_the_title();

        $carousel_item['carousel_image_classes'] = $this->getCarouselImageClasses($params);

        return $carousel_item;

    }

	/**
	 * Return CSS classes for carousel image
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselImageClasses($params) {

		$carousel_image_classes = array();
		if($params['image_animation'] !== '') {
			$carousel_image_classes[] = 'qodef-' . $params['image_animation'];
		}

		return implode(' ', $carousel_image_classes);

	}

	/**
	 * Return data attributes for carousel
	 *
	 * @param $params
	 * @return array
	 */
	private function getCarouselDataAttributes($params) {

		$carousel_data = array();

		if ($params['number_of_items'] !== '') {
			$carousel_data['data-items'] = $params['number_of_items'];
		}
		if ($params['show_arrows_navigation'] !== '') {
			$carousel_data['data-arrows-navigation'] = $params['show_arrows_navigation'];
		}
		if ($params['show_dots_navigation'] !== '') {
			$carousel_data['data-dots-navigation'] = $params['show_dots_navigation'];
		}

		return $carousel_data;

	}

}