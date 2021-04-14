<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$options = eos_scfm_get_main_options_array();
$meta_integrations = eos_scfm_meta_integration_array( $options );
$other_meta = isset( $options['other_meta'] ) ? $options['other_meta'] : array();
$scfm_post_types = array_unique( eos_scfm_post_types() );
$post_types = get_post_types();
?>
<h2 style="margin-top:32px">
	<i class="dashicons-smartphone dashicons"></i>
	<?php printf( esc_html__( 'Specific Content For Mobile v%s','eos-scfm' ),EOS_SCFM_PLUGIN_VERSION ); ?>
</h2>
<section style="margin-top:64px">
	<h3><span class="dashicons dashicons-update-alt"></span><?php esc_html_e( 'Metadata synchronization','eos-scfm' ); ?></h3>
	<?php
	wp_nonce_field( 'eos_scfm_nonce_main_setts','eos_scfm_nonce_main_setts' );
	$args = array( 
		'metaboxes' => array(
			'title' => esc_html__( 'General metadata synchronization','eos-scfm' ),
			'type' => 'select',
			'value' => isset( $other_meta['metaboxes'] ) ? esc_attr( $other_meta['metaboxes'] ) : false,
			'options' => array(
				'separated' => esc_attr__( 'Allow mobile versions having their own metadata','eos-scfm' ),
				'synchronized' => esc_attr__( 'Synchronize desktop and mobile metadata','eos-scfm' )
			)
		)
	);
	foreach( $meta_integrations as $key => $arr ){
		if( $arr['is_active'] ){
			$args[$key] = $arr['args'];
		}
	}	
	eos_scfm_options_table( apply_filters( 'eos_scfm_options_args',$args ) );
	?>
</section>
<section>
	<div class="scfm-subsection">
		<h3><span class="dashicons dashicons-plugins-checked"></span><?php esc_html_e( 'Plugins','eos-scfm' ); ?></h3>
		<?php
		$active_plugins = get_option( 'active_plugins' );
		if( $active_plugins ){
			$n = count( $active_plugins );
			if( $n > 1 ){ ?>
				<p><?php esc_html_e( 'If you want to disable specific plugins on mobile, you need Freesoul Deactivate Plugins','eos-scfm' ); ?></p>
				<?php
				if( !defined( 'EOS_DP_PLUGIN_BASE_NAME' ) ){
					if( file_exists( WP_PLUGIN_DIR.'/freesoul-deactivate-plugins/freesoul-deactivate-plugins.php' ) ){
						$action = 'activate';
						$plugin = 'freesoul-deactivate-plugins/freesoul-deactivate-plugins.php';
						$plugin = str_replace( '\/', '%2F', $plugin );
						$url = sprintf( admin_url( 'plugins.php?action='.$action.'&plugin=%s&plugin_status=all&paged=1&s' ),$plugin );
						$url = wp_nonce_url( $url,$action.'-plugin_'.$plugin );
						$url = add_query_arg( 'eos_dp_activated_from','eos_scfm',$url );
				?>
					<div>
						<a class="button" href="<?php echo $url; ?>"><?php esc_html_e( 'Activate Freesoul Deactivate Plugins','eos-scfm' ); ?></a>
					</div>
				<?php						
					}else{
				?>
					<div>
						<a class="button" href="<?php echo admin_url( 'plugin-install.php?tab=plugin-information&plugin=freesoul-deactivate-plugins' ); ?>"><?php esc_html_e( 'More about Freesoul Deactivate Plugins','eos-scfm' ); ?></a>
					</div>
				<?php } }else{ ?>
				<div>
					<a class="button" href="<?php echo admin_url( 'admin.php?page=eos_dp_mobile' ); ?>"><?php esc_html_e( 'Select active plugins on mobile','eos-scfm' ); ?></a>
				</div>		
		<?php } } }?>
	</div>
</section>
<?php eos_scfm_save_button(); ?>