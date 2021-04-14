<?php
/*
Plugin Name: Select Core
Description: Plugin that adds all post types needed by our theme
Author: Select Themes
Version: 1.2
Text Domain: qodef-cpt
*/

require_once 'load.php';

//use QodeCore\PostTypes;
//use QodeCore\Lib;

add_action( 'after_setup_theme', array( QodeCore\PostTypes\PostTypesRegister::getInstance(), 'register' ) );

//QodeCore\Lib\ShortcodeLoader::getInstance()->load();

if ( ! function_exists( 'qodef_core_activation' ) ) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines mixtape_qodef_core_on_activate action
	 */
	function qodef_core_activation() {
		do_action( 'mixtape_qodef_core_on_activate' );

		QodeCore\PostTypes\PostTypesRegister::getInstance()->register();
		flush_rewrite_rules();
	}

	register_activation_hook( __FILE__, 'qodef_core_activation' );
}

if ( ! function_exists( 'qodef_core_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function qodef_core_text_domain() {
		load_plugin_textdomain( 'qodef-cpt', false, QODE_CORE_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'qodef_core_text_domain' );
}

if ( ! function_exists( 'qodef_core_themename_theme_menu' ) ) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function qodef_core_themename_theme_menu() {
		if ( qodef_core_theme_installed() ) {

			global $mixtape_qodef_Framework;
			mixtape_qodef_init_theme_options();

			$page_hook_suffix = add_menu_page(
				esc_html__( 'Select Options', 'qodef-cpt' ),                   // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Select Options', 'qodef-cpt' ),                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'mixtape_qodef_theme_menu',                // The ID used to bind submenu items to this menu
				array(
					$mixtape_qodef_Framework->getSkin(),
					'renderOptions'
				), // The callback function used to render this menu
				$mixtape_qodef_Framework->getSkin()->getMenuIcon( 'options' ),             // Icon For menu Item
				$mixtape_qodef_Framework->getSkin()->getMenuItemPosition( 'options' )            // Position
			);

			foreach ( $mixtape_qodef_Framework->qodefOptions->adminPages as $key => $value ) {
				$slug = "";

				if ( ! empty( $value->slug ) ) {
					$slug = "_tab" . $value->slug;
				}

				$subpage_hook_suffix = add_submenu_page(
					'mixtape_qodef_theme_menu',
					esc_html__( 'Select Options - ', 'qodef-cpt' ) . $value->title,                   // The value used to populate the browser's title bar when the menu page is active
					$value->title,                   // The text of the menu in the administrator's sidebar
					'administrator',                  // What roles are able to access the menu
					'mixtape_qodef_theme_menu' . $slug,                // The ID used to bind submenu items to this menu
					array( $mixtape_qodef_Framework->getSkin(), 'renderOptions' )
				);

				add_action( 'admin_print_scripts-' . $subpage_hook_suffix, 'mixtape_qodef_enqueue_admin_scripts' );
				add_action( 'admin_print_styles-' . $subpage_hook_suffix, 'mixtape_qodef_enqueue_admin_styles' );
			};

			add_action( 'admin_print_scripts-' . $page_hook_suffix, 'mixtape_qodef_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $page_hook_suffix, 'mixtape_qodef_enqueue_admin_styles' );

		}
	}

	add_action( 'admin_menu', 'qodef_core_themename_theme_menu' );
}

if ( ! function_exists( 'qodef_core_themename_theme_menu_backup_options' ) ) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function qodef_core_themename_theme_menu_backup_options() {
		if ( qodef_core_theme_installed() ) {

			global $mixtape_qodef_Framework;
			$slug             = "_backup_options";
			$page_hook_suffix = add_submenu_page(
				'mixtape_qodef_theme_menu',
				esc_html__( 'Select Options - Backup Options', 'qodef-cpt' ),                   // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Backup Options', 'qodef-cpt' ),                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'mixtape_qodef_theme_menu' . $slug,                // The ID used to bind submenu items to this menu
				array( $mixtape_qodef_Framework->getSkin(), 'renderBackupOptions' )
			);
			add_action( 'admin_print_scripts-' . $page_hook_suffix, 'mixtape_qodef_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $page_hook_suffix, 'mixtape_qodef_enqueue_admin_styles' );

		}
	}

	add_action( 'admin_menu', 'qodef_core_themename_theme_menu_backup_options' );
}