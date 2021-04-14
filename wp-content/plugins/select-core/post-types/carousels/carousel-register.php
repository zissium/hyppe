<?php
namespace QodeCore\PostTypes\Carousels;

use QodeCore\Lib;

/**
 * Class CarouselRegister
 * @package QodeCore\PostTypes\Carousels
 */
class CarouselRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base		= 'carousels';
        $this->taxBase	= 'carousels_category';
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
            $menuPosition = $mixtape_qodef_Framework->getSkin()->getMenuItemPosition('carousel');
            $menuIcon = $mixtape_qodef_Framework->getSkin()->getMenuIcon('carousel');
        }

        register_post_type($this->base,
            array(
                'labels'    => array(
                    'name'			=> esc_html__('Select Carousel', 'qodef-cpt' ),
                    'menu_name'		=> esc_html__('Select Carousel', 'qodef-cpt' ),
                    'all_items'		=> esc_html__('Carousel Items', 'qodef-cpt' ),
                    'add_new'		=> esc_html__('Add New Carousel Item', 'qodef-cpt'),
                    'singular_name'	=> esc_html__('Carousel Item', 'qodef-cpt' ),
                    'add_item'		=> esc_html__('New Carousel Item', 'qodef-cpt'),
                    'add_new_item' 	=> esc_html__('Add New Carousel Item', 'qodef-cpt'),
                    'edit_item'		=> esc_html__('Edit Carousel Item', 'qodef-cpt')
                ),
                'public'		=>  false,
                'show_in_menu'	=>  true,
                'rewrite'		=>  array('slug' => 'carousels'),
                'menu_position'	=>  $menuPosition,
                'show_ui'		=>  true,
                'has_archive'	=>  false,
                'hierarchical'	=>  false,
                'supports'		=>  array('title'),
                'menu_icon'		=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'				=> esc_html__( 'Carousels', 'qodef-cpt' ),
            'singular_name'		=> esc_html__( 'Carousel', 'qodef-cpt' ),
            'search_items'		=> esc_html__( 'Search Carousels', 'qodef-cpt' ),
            'all_items'			=> esc_html__( 'All Carousels', 'qodef-cpt' ),
            'parent_item'		=> esc_html__( 'Parent Carousel', 'qodef-cpt' ),
            'parent_item_colon'	=> esc_html__( 'Parent Carousel:', 'qodef-cpt' ),
            'edit_item'			=> esc_html__( 'Edit Carousel', 'qodef-cpt' ),
            'update_item'		=> esc_html__( 'Update Carousel', 'qodef-cpt' ),
            'add_new_item'		=> esc_html__( 'Add New Carousel', 'qodef-cpt' ),
            'new_item_name'		=> esc_html__( 'New Carousel Name', 'qodef-cpt' ),
            'menu_name'			=> esc_html__( 'Carousels', 'qodef-cpt' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $labels,
            'show_ui'			=> true,
            'query_var'			=> true,
            'show_admin_column' => true,
            'rewrite'			=> array( 'slug' => 'carousels-category' ),
        ));
    }

}