<?php
if( !defined( 'WP_UNINSTALL_PLUGIN') ){
    die;
}
global $wpdb;
$clean_metaboxes = $wpdb->delete( 'wp_postmeta',array( 'meta_key' => 'eos_scfm_desktop_post_id' ) );
$clean_metaboxes = $wpdb->delete( 'wp_postmeta',array( 'meta_key' => 'eos_scfm_mobile_post_id' ) );
delete_site_option( 'page_on_front_mobile' );
delete_site_option( 'page_for_posts_mobile' );
delete_site_option( 'eos_scfm_main' );