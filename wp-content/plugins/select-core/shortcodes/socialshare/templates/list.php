<div class="qodef-social-share-holder qodef-list">
    <span class="qodef-social-share-title"><?php esc_html_e( 'Share:', 'mixtapewp' ); ?></span>
    <ul>
        <?php foreach ( $networks as $net ) {
            echo wp_kses($net, array(
                'li'   => array(
                    'class' => true
                ),
                'a'    => array(
                    'itemprop' => true,
                    'class'    => true,
                    'href'     => true,
                    'target'   => true,
                    'onclick'  => true
                ),
                'img'  => array(
                    'itemprop' => true,
                    'class'    => true,
                    'src'      => true,
                    'alt'      => true
                ),
                'span' => array(
                    'class' => true
                )
            ));
        } ?>
    </ul>
</div>