<?php

if ( ! function_exists( 'mixtape_qodef_load_shortcode_interface' ) ) {
	function mixtape_qodef_load_shortcode_interface() {
		include_once QODE_CORE_ABS_PATH . '/shortcodes/lib/shortcode-interface.php';
	}

	add_action( 'mixtape_qodef_before_options_map', 'mixtape_qodef_load_shortcode_interface' );
}

if ( ! function_exists( 'mixtape_qodef_load_shortcodes' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 * and loads load.php file in each. Hooks to mixtape_qodef_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function mixtape_qodef_load_shortcodes() {
		if ( qodef_core_theme_installed() ) {
			foreach ( glob( QODE_CORE_ABS_PATH . '/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}

			QodeCore\Lib\ShortcodeLoader::getInstance()->load();
		}

		do_action( 'mixtape_qodef_shortcode_loader' );
	}

	add_action( 'mixtape_qodef_before_options_map', 'mixtape_qodef_load_shortcodes' );
}