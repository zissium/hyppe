<li class="qodef-<?php echo esc_attr( $name ) ?>-share">
    <a class="qodef-share-link" href="#" onclick="<?php print mixtape_qodef_get_module_part( $link ); ?>">
		<?php if ( $custom_icon !== '' ) { ?>
            <img src="<?php echo esc_url( $custom_icon ); ?>" alt="<?php echo esc_attr( $name ); ?>"/>
		<?php } else { ?>
            <span class="qodef-social-network-icon <?php echo esc_attr( $icon ); ?>"></span>
		<?php } ?>
    </a>
</li>