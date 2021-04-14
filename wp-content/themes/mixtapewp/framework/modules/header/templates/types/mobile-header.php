<?php do_action('mixtape_qodef_before_mobile_header'); ?>

<header class="qodef-mobile-header">
    <div class="qodef-mobile-header-inner">
        <?php do_action( 'mixtape_qodef_after_mobile_header_html_open' ) ?>
        <div class="qodef-mobile-header-holder">
            <div class="qodef-grid">
                <div class="qodef-vertical-align-containers">
                    <?php if($show_navigation_opener) : ?>
                        <div class="qodef-mobile-menu-opener">
                            <a href="javascript:void(0)">
                    <span class="qodef-mobile-opener-icon-holder">
                        <?php print wp_kses_post($menu_opener_icon); ?>
                    </span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($show_logo) : ?>
                        <div class="qodef-position-center">
                            <div class="qodef-position-center-inner">
                                <?php mixtape_qodef_get_mobile_logo(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="qodef-position-right">
                        <div class="qodef-position-right-inner">
                            <?php if(is_active_sidebar('qodef-right-from-mobile-logo')) {
                                dynamic_sidebar('qodef-right-from-mobile-logo');
                            } ?>
                        </div>
                    </div>
                </div> <!-- close .qodef-vertical-align-containers -->
            </div>
        </div>
        <?php mixtape_qodef_get_mobile_nav(); ?>
    </div>
</header> <!-- close .qodef-mobile-header -->

<?php do_action('mixtape_qodef_after_mobile_header'); ?>