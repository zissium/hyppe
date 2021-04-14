<?php
namespace QodeCore\PostTypes\Slider;

use QodeCore\Lib;

/**
 * Class SliderRegister
 * @package QodeCore\PostTypes\Slider
 */
class SliderRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base		= 'slides';
        $this->taxBase	= 'slides_category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $mixtape_qodef_Framework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';

        if(qodef_core_theme_installed()) {
            $menuPosition = $mixtape_qodef_Framework->getSkin()->getMenuItemPosition('slider');
            $menuIcon = $mixtape_qodef_Framework->getSkin()->getMenuIcon('slider');
        }

        register_post_type($this->base,
            array(
                'labels' 		=> array(
                    'name'			=> esc_html__( 'Select Slider', 'qodef-cpt' ),
                    'menu_name'		=> esc_html__( 'Select Slider', 'qodef-cpt' ),
                    'all_items'		=> esc_html__( 'Slides', 'qodef-cpt' ),
                    'add_new'		=> esc_html__( 'Add New Slide', 'qodef-cpt' ),
                    'singular_name'	=> esc_html__( 'Slide', 'qodef-cpt' ),
                    'add_item'		=> esc_html__( 'New Slide', 'qodef-cpt' ),
                    'add_new_item'	=> esc_html__( 'Add New Slide', 'qodef-cpt' ),
                    'edit_item'		=> esc_html__( 'Edit Slide', 'qodef-cpt' )
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'slides'),
                'menu_position' => 	$menuPosition,
                'show_ui'		=>	true,
                'has_archive'	=>	false,
                'hierarchical'	=>	false,
                'supports'		=>	array('title', 'thumbnail', 'page-attributes'),
                'menu_icon'		=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'				=> esc_html__( 'Sliders', 'qodef-cpt' ),
            'singular_name'		=> esc_html__( 'Slider', 'qodef-cpt' ),
            'search_items'		=> esc_html__( 'Search Sliders', 'qodef-cpt' ),
            'all_items'			=> esc_html__( 'All Sliders', 'qodef-cpt' ),
            'parent_item'		=> esc_html__( 'Parent Slider', 'qodef-cpt' ),
            'parent_item_colon'	=> esc_html__( 'Parent Slider:', 'qodef-cpt' ),
            'edit_item'			=> esc_html__( 'Edit Slider', 'qodef-cpt' ),
            'update_item'		=> esc_html__( 'Update Slider', 'qodef-cpt' ),
            'add_new_item'		=> esc_html__( 'Add New Slider', 'qodef-cpt' ),
            'new_item_name'		=> esc_html__( 'New Slider Name', 'qodef-cpt' ),
            'menu_name'			=> esc_html__( 'Sliders', 'qodef-cpt' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $labels,
            'show_ui'			=> true,
            'query_var'			=> true,
            'show_admin_column'	=> true,
            'rewrite'			=> array( 'slug' => 'slides-category' ),
        ));
    }
}