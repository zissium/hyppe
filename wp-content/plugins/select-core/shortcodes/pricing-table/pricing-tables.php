<?php
namespace MixtapeQode\Modules\Shortcodes\PricingTables;

use MixtapeQode\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'qodef_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Pricing Tables', 'mixtapewp'),
				'base' => $this->base,
				'as_parent' => array('only' => 'qodef_pricing_table'),
				'content_element' => true,
				'category' => esc_html__('by SELECT', 'mixtapewp'),
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'params' => array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__('Columns', 'mixtapewp'),
						'param_name' => 'columns',
						'value' => array(
                            esc_html__('Two', 'mixtapewp')       => 'qodef-two-columns',
                            esc_html__('Three', 'mixtapewp')     => 'qodef-three-columns',
                            esc_html__('Four', 'mixtapewp')      => 'qodef-four-columns',
						),
						'save_always' => true,
						'description' => ''
					)
				),
				'js_view' => 'VcColumnView'
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         => 'qodef-two-columns'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$html = '<div class="qodef-pricing-tables clearfix '.$columns.'">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}