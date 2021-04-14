<div <?php mixtape_qodef_class_attribute($holder_classes); ?>>
    <div class="qodef-iwt-content-holder">
        <div class="qodef-iwt-icon-title-holder">
            <div class="qodef-iwt-icon-holder">
                <?php echo qodef_core_get_shortcode_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
            </div>
            <div class="qodef-iwt-title-holder">
                <<?php echo esc_attr($title_tag); ?> <?php mixtape_qodef_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
            </div>
        </div>
        <div class="qodef-iwt-text-holder">
            <p <?php mixtape_qodef_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>

            <?php if(!empty($link) && !empty($link_text)) : ?>
                <a class="qodef-iwt-link" href="<?php echo esc_url($link); ?>" <?php mixtape_qodef_inline_attr($target, 'target'); ?>><?php echo esc_html($link_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>