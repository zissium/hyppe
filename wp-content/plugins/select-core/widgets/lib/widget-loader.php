<?php

if ( ! function_exists( 'mixtape_qodef_register_widgets' ) ) {
	function mixtape_qodef_register_widgets() {
		$widgets = array(
			'MixtapeQodeLatestPosts',
			'MixtapeQodeSearchOpener',
			'MixtapeQodeSeparatorWidget',
			'MixtapeQodeSideAreaOpener',
			'MixtapeQodeSocialIconWidget',
			'MixtapeQodeStickySidebar',
		);

		if ( qodef_core_is_woocommerce_installed() ) {
			$widgets[] = 'MixtapeQodeWoocommerceDropdownCart';
		}

		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
}

add_action( 'widgets_init', 'mixtape_qodef_register_widgets' );