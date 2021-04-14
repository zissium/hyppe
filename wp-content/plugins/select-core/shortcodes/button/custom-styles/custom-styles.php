<?php

if(!function_exists('mixtape_qodef_button_typography_styles')) {
    /**
     * Typography styles for all button types
     */
    function mixtape_qodef_button_typography_styles() {
        $selector = '.qodef-btn';
        $styles = array();

        $font_family = mixtape_qodef_options()->getOptionValue('button_font_family');
        if(mixtape_qodef_is_font_option_valid($font_family)) {
            $styles['font-family'] = mixtape_qodef_get_font_option_val($font_family);
        }

        $text_transform = mixtape_qodef_options()->getOptionValue('button_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = mixtape_qodef_options()->getOptionValue('button_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = mixtape_qodef_options()->getOptionValue('button_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = mixtape_qodef_filter_px($letter_spacing).'px';
        }

        $font_weight = mixtape_qodef_options()->getOptionValue('button_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo mixtape_qodef_dynamic_css($selector, $styles);
    }

    add_action('mixtape_qodef_style_dynamic', 'mixtape_qodef_button_typography_styles');
}

if(!function_exists('mixtape_qodef_button_outline_styles')) {
    /**
     * Generate styles for outline button
     */
    function mixtape_qodef_button_outline_styles() {
        //outline styles
        $outline_styles   = array();
        $outline_selector = '.qodef-btn.qodef-btn-outline';

        if(mixtape_qodef_options()->getOptionValue('btn_outline_text_color')) {
            $outline_styles['color'] = mixtape_qodef_options()->getOptionValue('btn_outline_text_color');
        }

        if(mixtape_qodef_options()->getOptionValue('btn_outline_border_color')) {
            $outline_styles['border-color'] = mixtape_qodef_options()->getOptionValue('btn_outline_border_color');
        }

        echo mixtape_qodef_dynamic_css($outline_selector, $outline_styles);

        //outline hover styles
        if(mixtape_qodef_options()->getOptionValue('btn_outline_hover_text_color')) {
            echo mixtape_qodef_dynamic_css(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-color):hover',
                array('color' => mixtape_qodef_options()->getOptionValue('btn_outline_hover_text_color').'!important')
            );
        }

        if(mixtape_qodef_options()->getOptionValue('btn_outline_hover_bg_color')) {
            echo mixtape_qodef_dynamic_css(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-bg):hover',
                array('background-color' => mixtape_qodef_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
            );
        }

        if(mixtape_qodef_options()->getOptionValue('btn_outline_hover_border_color')) {
            echo mixtape_qodef_dynamic_css(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-border-hover):hover',
                array('border-color' => mixtape_qodef_options()->getOptionValue('btn_outline_hover_border_color').'!important')
            );
        }
    }

    add_action('mixtape_qodef_style_dynamic', 'mixtape_qodef_button_outline_styles');
}

if(!function_exists('mixtape_qodef_button_solid_styles')) {
    /**
     * Generate styles for solid type buttons
     */
    function mixtape_qodef_button_solid_styles() {
        //solid styles
        $solid_selector = '.qodef-btn.qodef-btn-solid';
        $solid_styles = array();

        if(mixtape_qodef_options()->getOptionValue('btn_solid_text_color')) {
            $solid_styles['color'] = mixtape_qodef_options()->getOptionValue('btn_solid_text_color');
        }

        if(mixtape_qodef_options()->getOptionValue('btn_solid_border_color')) {
            $solid_styles['border-color'] = mixtape_qodef_options()->getOptionValue('btn_solid_border_color');
        }

        if(mixtape_qodef_options()->getOptionValue('btn_solid_bg_color')) {
            $solid_styles['background-color'] = mixtape_qodef_options()->getOptionValue('btn_solid_bg_color');
        }

        echo mixtape_qodef_dynamic_css($solid_selector, $solid_styles);

        //solid hover styles
        if(mixtape_qodef_options()->getOptionValue('btn_solid_hover_text_color')) {
            echo mixtape_qodef_dynamic_css(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-color):hover',
                array('color' => mixtape_qodef_options()->getOptionValue('btn_solid_hover_text_color').'!important')
            );
        }

        if(mixtape_qodef_options()->getOptionValue('btn_solid_hover_bg_color')) {
            echo mixtape_qodef_dynamic_css(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-bg):hover',
                array('background-color' => mixtape_qodef_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
            );
        }

        if(mixtape_qodef_options()->getOptionValue('btn_solid_hover_border_color')) {
            echo mixtape_qodef_dynamic_css(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-bg):hover',
                array('border-color' => mixtape_qodef_options()->getOptionValue('btn_solid_hover_border_color').'!important')
            );
        }
    }

    add_action('mixtape_qodef_style_dynamic', 'mixtape_qodef_button_solid_styles');
}