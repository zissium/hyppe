<div class="qodef-tabs-navigation-wrapper">
    <ul class="nav nav-tabs">
		<?php
		foreach ( mixtape_qodef_options()->adminPages as $key => $page ) {
			$slug = "";
			if ( ! empty( $page->slug ) ) {
				$slug = "_tab" . $page->slug;
			}
			?>
            <li<?php if ( $page->slug == $tab ) {
				echo " class=\"active\"";
			} ?>>
                <a href="<?php echo esc_url( get_admin_url() . 'admin.php?page=mixtape_qodef_theme_menu' . $slug ); ?>">
					<?php if ( $page->icon !== '' ) { ?>
                        <i class="<?php echo esc_attr( $page->icon ); ?> qodef-tooltip qodef-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr( $page->title ); ?>"></i>
					<?php } ?>
                    <span><?php echo esc_html( $page->title ); ?></span>
                </a>
            </li>
			<?php
		}
		?>
		<?php if ( mixtape_qodef_core_installed() ) { ?>
            <li <?php if ( $is_backup_options_page ) {
				echo "class='active'";
			} ?>>
                <a href="<?php echo esc_url( get_admin_url() . 'admin.php?page=mixtape_qodef_theme_menu_backup_options' ); ?>"><i class="fa fa-download qodef-database qodef-tooltip qodef-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_html_e( 'Backup Options', 'mixtapewp' ); ?>"></i><span><?php esc_html_e( 'Backup Options', 'mixtapewp' ); ?></span></a>
            </li>
            <li <?php if ( $is_import_page ) {
				echo "class='active'";
			} ?>>
                <a href="<?php echo esc_url( get_admin_url() . 'admin.php?page=mixtape_qodef_theme_menu_tabimport' ); ?>"><i class="fa fa-download qodef-tooltip qodef-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_html_e( 'Import', 'mixtapewp' ); ?>"></i><span><?php esc_html_e( 'Import', 'mixtapewp' ); ?></span></a>
            </li>
		<?php } ?>
    </ul>
</div>