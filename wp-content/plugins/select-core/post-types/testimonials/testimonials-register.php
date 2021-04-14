<?php
namespace QodeCore\PostTypes\Testimonials;

use QodeCore\Lib;


/**
 * Class TestimonialsRegister
 * @package QodeCore\PostTypes\Testimonials
 */
class TestimonialsRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base		= 'testimonials';
        $this->taxBase	= 'testimonials_category';
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
     * Regsiters custom post type with WordPress
     */
    private function registerPostType() {
        global $mixtape_qodef_Framework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';

        if(qodef_core_theme_installed()) {
            $menuPosition = $mixtape_qodef_Framework->getSkin()->getMenuItemPosition('testimonial');
            $menuIcon = $mixtape_qodef_Framework->getSkin()->getMenuIcon('testimonial');
        }

        register_post_type('testimonials',
            array(
                'labels' 		=> array(
                    'name' 				=> esc_html__('Testimonials','qodef-cpt' ),
                    'singular_name' 	=> esc_html__('Testimonial','qodef-cpt' ),
                    'add_item'			=> esc_html__('New Testimonial','qodef-cpt'),
                    'add_new_item' 		=> esc_html__('Add New Testimonial','qodef-cpt'),
                    'edit_item' 		=> esc_html__('Edit Testimonial','qodef-cpt')
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'testimonials'),
                'menu_position' => 	$menuPosition,
                'show_ui'		=>	true,
                'has_archive'	=>	false,
                'hierarchical'	=>	false,
                'supports'		=>	array('title', 'thumbnail'),
                'menu_icon'  	=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'				=> esc_html__( 'Testimonials Categories', 'qodef-cpt' ),
            'singular_name'		=> esc_html__( 'Testimonial Category', 'qodef-cpt' ),
            'search_items'		=> esc_html__( 'Search Testimonials Categories', 'qodef-cpt' ),
            'all_items'			=> esc_html__( 'All Testimonials Categories', 'qodef-cpt' ),
            'parent_item'		=> esc_html__( 'Parent Testimonial Category', 'qodef-cpt' ),
            'parent_item_colon'	=> esc_html__( 'Parent Testimonial Category:', 'qodef-cpt' ),
            'edit_item'			=> esc_html__( 'Edit Testimonials Category', 'qodef-cpt' ),
            'update_item'		=> esc_html__( 'Update Testimonials Category', 'qodef-cpt' ),
            'add_new_item'		=> esc_html__( 'Add New Testimonials Category', 'qodef-cpt' ),
            'new_item_name'		=> esc_html__( 'New Testimonials Category Name', 'qodef-cpt' ),
            'menu_name'			=> esc_html__( 'Testimonials Categories', 'qodef-cpt' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $labels,
            'show_ui'			=> true,
            'query_var'			=> true,
            'show_admin_column' => true,
            'rewrite'			=> array( 'slug' => 'testimonials-category' ),
        ));
    }

}