<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$output = $after_output = $inner_start = $inner_end = $after_wrapper_open = $before_wrapper_close = $wrapper_style = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class    = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	'qodef-section',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}


/*** Additional Options ***/

if ( ! empty( $content_aligment ) ) {
	$css_classes[] = 'qodef-content-aligment-' . $content_aligment;
}

if ( $box_shadow == 'yes' ) {
	$css_classes[] = 'qodef-section-with-shadow';
}

if ( ! empty( $row_type ) && $row_type == 'parallax' ) {
	$css_classes[] = 'qodef-parallax-section-holder';

	if ( $parallax_speed != '' ) {
		$wrapper_attributes[] = 'data-qodef-parallax-speed="' . $parallax_speed . '"';
	} else {
		$wrapper_attributes[] = 'data-qodef-parallax-speed="1"';
	}

}
if ( $content_width == 'grid' ) {
	$css_classes[]       = 'qodef-grid-section';
	$css_inner_classes[] = 'qodef-section-inner';
	$inner_start         .= '<div class="qodef-section-inner-margin clearfix">';
	$inner_end           .= '</div>';
} else {
	$css_inner_classes[] = 'qodef-full-section-inner';
}

if ( $row_type == 'row' && $css_animation != '' ) {
	$inner_start .= '<div class="qodef-row-animations-holder ' . $css_animation . '" data-animation="' . $css_animation . '">';
	if ( $transition_delay !== '' ) {
		$animation_styles   = array();
		$animation_styles[] = 'transition-delay: ' . $transition_delay . 'ms';
		$animation_styles[] = '-webkit-animation-delay: ' . $transition_delay . 'ms';
		$animation_styles[] = 'animation-delay: ' . $transition_delay . 'ms';
		$inner_start        .= '<div ' . mixtape_qodef_get_inline_style( $animation_styles ) . '>';
		$inner_end          .= '</div>';
	} else {
		$inner_start .= '<div>';
		$inner_end   .= '</div>';
	}
	$inner_end .= '</div>';
}

if ( $parallax_background_image != '' ) {

	$parallax_image_link = wp_get_attachment_url( $parallax_background_image );
	$wrapper_style       .= 'background-image:url(' . $parallax_image_link . ');';

}

if ( $section_height != '' ) {
	$wrapper_style .= 'min-height:' . $section_height . 'px;height:auto;';
}

if ( $full_screen_section_height == 'yes' ) {
	$css_classes[]        = 'qodef-full-screen-height-parallax';
	$after_wrapper_open   .= '<div class="qodef-parallax-content-outer">';
	$before_wrapper_close .= '</div>';

	if ( $vertically_align_content_in_middle == 'yes' ) {
		$css_classes[] = 'qodef-vertical-middle-align';
	}

}

if ( $enable_row_overlap === 'yes' ) {
	$css_classes[] = 'qodef-row-overlap';

	if ( $overlap_size !== '' ) {
		$css_classes[] = 'qodef-row-overlap-' . $overlap_size;
	}

	if ( $use_row_box === 'yes' ) {
		$css_classes[] = 'qodef-row-box';
	}
}

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_inner_classes    = preg_replace( '/\s+/', ' ', implode( ' ', $css_inner_classes ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'style="' . $wrapper_style . '"';
$inner_attributes[]   = 'class="' . esc_attr( trim( $css_inner_classes ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $after_wrapper_open;
$output .= '<div ' . implode( ' ', $inner_attributes ) . '>';
$output .= $inner_start;
$output .= wpb_js_remove_wpautop( $content );
$output .= $inner_end;
$output .= '</div>';
$output .= $before_wrapper_close;
$output .= '</div>';
$output .= $after_output;

print mixtape_qodef_get_module_part( $output );

