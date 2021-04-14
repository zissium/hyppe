<?php
namespace QodeCore\PostTypes\Events;

use QodeCore\Lib\PostTypeInterface;

/**
 * Class EventsRegister
 * @package QodeCore\PostTypes\Events
 */
class EventsRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base		= 'event';
        $this->taxBase	= 'event-type';

        add_filter('single_template', array($this, 'registerSingleTemplate'));
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
     * Registers event single template if one doesn't exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-event.php')) {
                return QODE_CORE_CPT_PATH.'/events/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $mixtape_qodef_Framework, $mixtape_qodef_options;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';
        $slug = $this->base;

        if(qodef_core_theme_installed()) {
            $menuPosition = $mixtape_qodef_Framework->getSkin()->getMenuItemPosition('event');
            $menuIcon = $mixtape_qodef_Framework->getSkin()->getMenuIcon('event');

            if(isset($mixtape_qodef_options['event_single_slug'])) {
                if($mixtape_qodef_options['event_single_slug'] != ""){
                    $slug = $mixtape_qodef_options['event_single_slug'];
                }
            }
        }

        register_post_type( $this->base,
            array(
                'labels'		=> array(
                    'name'			=> esc_html__( 'Events','qodef-cpt' ),
                    'singular_name'	=> esc_html__( 'Event','qodef-cpt' ),
                    'add_item'		=> esc_html__( 'New Event','qodef-cpt' ),
                    'add_new_item'	=> esc_html__( 'Add New Event','qodef-cpt' ),
                    'edit_item'		=> esc_html__( 'Edit Event','qodef-cpt' )
                ),
                'public'		=> true,
                'has_archive'	=> true,
                'rewrite'		=> array('slug' => $slug),
                'menu_position'	=> $menuPosition,
                'show_ui'		=> true,
                'supports'		=> array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'		=> $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'				=> esc_html__( 'Event Types', 'qodef-cpt' ),
            'singular_name'		=> esc_html__( 'Event Type', 'qodef-cpt' ),
            'search_items'		=> esc_html__( 'Search Event Types', 'qodef-cpt' ),
            'all_items'			=> esc_html__( 'All Event Types', 'qodef-cpt' ),
            'parent_item'		=> esc_html__( 'Parent Event Type', 'qodef-cpt' ),
            'parent_item_colon'	=> esc_html__( 'Parent Event Type:', 'qodef-cpt' ),
            'edit_item'			=> esc_html__( 'Edit Event Type', 'qodef-cpt' ),
            'update_item'		=> esc_html__( 'Update Event Type', 'qodef-cpt' ),
            'add_new_item'		=> esc_html__( 'Add New Event Type', 'qodef-cpt' ),
            'new_item_name'		=> esc_html__( 'New Event Type Name', 'qodef-cpt' ),
            'menu_name'			=> esc_html__( 'Event Types', 'qodef-cpt' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $labels,
            'show_ui'			=> true,
            'query_var'			=> true,
	        'show_admin_column'	=> true,
            'rewrite'			=> array( 'slug' => 'event-type' ),
        ));
    }
}
