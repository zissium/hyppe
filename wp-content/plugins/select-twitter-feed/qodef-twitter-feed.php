<?php
/*
Plugin Name: Select Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Select Themes
Version: 1.0.2
*/

define( 'QODEF_TWITTER_FEED_VERSION', '1.0.2' );
define( 'QODEF_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'QODEF_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );

include_once 'load.php';

if ( ! function_exists( 'qodef_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function qodef_twitter_feed_text_domain() {
		load_plugin_textdomain( 'qodef-twitter-feed', false, QODEF_TWITTER_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'qodef_twitter_feed_text_domain' );
}