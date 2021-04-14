<?php

namespace QodeCore\PostTypes\Testimonials\Shortcodes;


use QodeCore\Lib;

/**
 * Class Testimonials
 * @package QodeCore\PostTypes\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'qodef_testimonials';

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
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => esc_html__('Testimonials','qodef-cpt'),
                'base' => $this->base,
                'category' => esc_html__('by SELECT','qodef-cpt'),
                'icon' => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
					array(
                        'type' => 'textfield',
						'admin_label' => true,
                        'heading' => esc_html__('Category','qodef-cpt'),
                        'param_name' => 'category',
                        'value' => '',
                        'description' => esc_html__('Category Slug (leave empty for all)','qodef-cpt')
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Number','qodef-cpt'),
                        'param_name' => 'number',
                        'value' => '',
                        'description' => esc_html__('Number of Testimonials','qodef-cpt')
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => esc_html__('Show Title','qodef-cpt'),
                        'param_name' => 'show_title',
                        'value' => array(
                            esc_html__('Yes','qodef-cpt') => 'yes',
                            esc_html__('No','qodef-cpt')  => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => esc_html__('Show Author','qodef-cpt'),
                        'param_name' => 'show_author',
                        'value' => array(
                            esc_html__('Yes','qodef-cpt') => 'yes',
                            esc_html__('No','qodef-cpt') => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => esc_html__('Show Author Job Position','qodef-cpt'),
                        'param_name' => 'show_position',
                        'value' => array(
                            esc_html__('Yes','qodef-cpt') => 'yes',
							esc_html__('No','qodef-cpt') => 'no',
                        ),
						'save_always' => true,
                        'dependency' => array('element' => 'show_author', 'value' => array('yes')),
                        'description' => ''
                    ), 
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Animation speed','qodef-cpt'),
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => esc_html__('Speed of slide animation in miliseconds','qodef-cpt')
                    ),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__('Show Arrows navigation','qodef-cpt'),
						'param_name' => 'arrows_navigation',
						'value' => array(
							esc_html__('Yes','qodef-cpt') => 'yes',
							esc_html__('No','qodef-cpt')  => 'no',
						),
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__('Show Dots navigation','qodef-cpt'),
						'param_name' => 'dots_navigation',
						'value' => array(
							esc_html__('Yes','qodef-cpt') => 'yes',
							esc_html__('No','qodef-cpt')  => 'no',
						),
						'description' => ''
					)
                )
            ) );
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
            'type'				=> 'simple',
            'number'			=> '-1',
            'category'			=> '',
            'show_title'		=> 'yes',
            'show_author'		=> 'yes',
            'show_position' 	=> 'yes',
            'animation_speed'	=> '',
            'arrows_navigation'	=> 'yes',
            'dots_navigation'	=> 'yes'
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);

        $number = esc_attr($number);
        $category = esc_attr($category);
        $animation_speed = esc_attr($animation_speed);
		
		$data_attr = $this->getDataParams($params);
		$query_args = $this->getQueryParams($params);

		$html = '';
        $html .= '<div class="qodef-testimonials-holder clearfix">';
        $html .= '<div class="qodef-slick-slider-navigation-style qodef-testimonials qodef-testimonials-type-'. $type .'" ' . $data_attr . '>';

        query_posts($query_args);
        if (have_posts()) :
            while (have_posts()) : the_post();
                $author = get_post_meta(get_the_ID(), 'qodef_testimonial_author', true);
                $text = get_post_meta(get_the_ID(), 'qodef_testimonial_text', true);
                $title = get_post_meta(get_the_ID(), 'qodef_testimonial_title', true);
                $job = get_post_meta(get_the_ID(), 'qodef_testimonial_author_position', true);

				$params['author'] = $author;
				$params['text'] = $text;
				$params['title'] = $title;
				$params['job'] = $job;
				$params['current_id'] = get_the_ID();				
					$html .= qodef_core_get_cpt_shortcode_template_part('testimonials', $type . '-testimonials-template', '', $params);

            endwhile;
        else:
            $html .= __('Sorry, no posts matched your criteria.', 'qodef-cpt');
        endif;

        wp_reset_query();
        $html .= '</div>';
		$html .= '</div>';
		
        return $html;
    }
	/**
    * Generates testimonial data attribute array
    *
    * @param $params
    *
    * @return string
    */
	private function getDataParams($params){
		$data_attr = '';
		
		if(!empty($params['animation_speed'])){
			$data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
		}

		if(!empty($params['arrows_navigation']) && $params['arrows_navigation'] == 'no'){
			$data_attr .= ' data-arrows-navigation ="false"';
		}

		if(!empty($params['dots_navigation']) && $params['dots_navigation'] == 'no'){
			$data_attr .= ' data-dots-navigation ="false"';
		}
		
		return $data_attr;
	}
	/**
    * Generates testimonials query attribute array
    *
    * @param $params
    *
    * @return array
    */
	private function getQueryParams($params){
		
		$args = array(
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ($params['category'] != '') {
            $args['testimonials_category'] = $params['category'];
        }
		return $args;
	}
	 
}