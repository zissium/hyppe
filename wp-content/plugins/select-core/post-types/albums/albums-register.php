<?php
namespace QodeCore\PostTypes\Albums;

use QodeCore\Lib\PostTypeInterface;

/**
 * Class AlbumsRegister
 * @package QodeCore\PostTypes\Albums
 */
class AlbumsRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base				= 'album';
        $this->taxGenreBase		= 'album-genre';
        $this->taxLabelBase		= 'album-label';
        $this->taxArtistBase	= 'album-artist';

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
     * Registers album single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-album.php')) {
                return QODE_CORE_CPT_PATH.'/albums/templates/single-'.$this->base.'.php';
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
            $menuPosition = $mixtape_qodef_Framework->getSkin()->getMenuItemPosition('albums');
            $menuIcon = $mixtape_qodef_Framework->getSkin()->getMenuIcon('albums');

       }

        register_post_type( $this->base,
            array(
                'labels'		=> array(
                    'name'			=> esc_html__( 'Albums','qodef-cpt' ),
                    'singular_name'	=> esc_html__( 'Album','qodef-cpt' ),
                    'add_item'		=> esc_html__( 'New Album','qodef-cpt' ),
                    'add_new_item'	=> esc_html__( 'Add New Album','qodef-cpt' ),
                    'edit_item'		=> esc_html__( 'Edit Album','qodef-cpt' )
                ),
                'public'		=> true,
                'has_archive'	=> true,
                'rewrite'		=> array('slug' => 'album'),
                'menu_position'	=> $menuPosition,
                'show_ui'		=> true,
                'supports'		=> array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'		=>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $label_labels = array(
            'name'				=> esc_html__( 'Labels', 'qodef-cpt' ),
            'singular_name'		=> esc_html__( 'Label', 'qodef-cpt' ),
            'search_items'		=> esc_html__( 'Search Labels', 'qodef-cpt' ),
            'all_items'			=> esc_html__( 'All Labels', 'qodef-cpt' ),
            'parent_item'		=> esc_html__( 'Parent Label', 'qodef-cpt' ),
            'parent_item_colon'	=> esc_html__( 'Parent Label:', 'qodef-cpt' ),
            'edit_item'			=> esc_html__( 'Edit Label', 'qodef-cpt' ),
            'update_item'		=> esc_html__( 'Update Label', 'qodef-cpt' ),
            'add_new_item'		=> esc_html__( 'Add New Label', 'qodef-cpt' ),
            'new_item_name'		=> esc_html__( 'New Label Name', 'qodef-cpt' ),
            'menu_name'			=> esc_html__( 'Labels', 'qodef-cpt' ),
        );

        register_taxonomy($this->taxLabelBase, array($this->base), array(
            'hierarchical'		=> true,
            'labels'			=> $label_labels,
            'show_ui'			=> true,
            'query_var'			=> true,
	        'show_admin_column'	=> true
        ));

		$genre_labels = array(
			'name'				=> esc_html__( 'Genres', 'qodef-cpt' ),
			'singular_name'		=> esc_html__( 'Genre', 'qodef-cpt' ),
			'search_items'		=> esc_html__( 'Genres', 'qodef-cpt' ),
			'all_items'			=> esc_html__( 'Genres', 'qodef-cpt' ),
			'parent_item'		=> esc_html__( 'Parent Genre', 'qodef-cpt' ),
			'parent_item_colon'	=> esc_html__( 'Parent Genres:', 'qodef-cpt' ),
			'edit_item'			=> esc_html__( 'Edit Genre', 'qodef-cpt' ),
			'update_item'		=> esc_html__( 'Update Genre', 'qodef-cpt' ),
			'add_new_item'		=> esc_html__( 'Add New Genre', 'qodef-cpt' ),
			'new_item_name'		=> esc_html__( 'New Genre', 'qodef-cpt' ),
			'menu_name'			=> esc_html__( 'Genres', 'qodef-cpt' ),
		);

		register_taxonomy($this->taxGenreBase,array($this->base), array(
			'hierarchical'		=> true,
			'labels'			=> $genre_labels,
			'show_ui'			=> true,
			'query_var'			=> true,
			'show_admin_column'	=> true
		));

		$artist_labels = array(
			'name'				=> esc_html__( 'Artists', 'qodef-cpt' ),
			'singular_name'		=> esc_html__( 'Artist', 'qodef-cpt' ),
			'search_items'		=> esc_html__( 'Artists', 'qodef-cpt' ),
			'all_items'			=> esc_html__( 'Artists', 'qodef-cpt' ),
			'parent_item'		=> esc_html__( 'Parent Artist', 'qodef-cpt' ),
			'parent_item_colon'	=> esc_html__( 'Parent Artists:', 'qodef-cpt' ),
			'edit_item'			=> esc_html__( 'Edit Artist', 'qodef-cpt' ),
			'update_item'		=> esc_html__( 'Update Artist', 'qodef-cpt' ),
			'add_new_item'		=> esc_html__( 'Add New Artist', 'qodef-cpt' ),
			'new_item_name'		=> esc_html__( 'New Artist Name', 'qodef-cpt' ),
			'menu_name'			=> esc_html__( 'Artists', 'qodef-cpt' ),
		);

		register_taxonomy($this->taxArtistBase,array($this->base), array(
			'hierarchical'		=> true,
			'labels'			=> $artist_labels,
			'show_ui'			=> true,
			'query_var'			=> true,
			'show_admin_column'	=> true
		));
    }

}