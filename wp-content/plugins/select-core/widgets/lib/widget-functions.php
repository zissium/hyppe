<?php

if ( ! function_exists( 'mixtape_qodef_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 *
	 */
	function mixtape_qodef_load_widget_class() {
		include_once 'widget-class.php';
	}

	add_action( 'mixtape_qodef_before_options_map', 'mixtape_qodef_load_widget_class' );
}

if ( ! function_exists( 'mixtape_qodef_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to mixtape_qodef_after_options_map action
	 */
	function mixtape_qodef_load_widgets() {
		if ( qodef_core_theme_installed() ) {
			foreach ( glob( QODE_CORE_ABS_PATH . '/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}

			include_once 'widget-loader.php';
		}
	}

	add_action( 'mixtape_qodef_before_options_map', 'mixtape_qodef_load_widgets' );
}