<?php
namespace MixtapeQode\Modules\Shortcodes\PieCharts\PieChartDoughnut;

use MixtapeQode\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Pie Chart Pie
 */
class PieChartPie implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;
	private $chartFields = 10;

	public function __construct() {
		$this->base = 'qodef_pie_chart_pie';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see qodef_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		$chart_fields = array();
		for ($i = 1; $i <= $this->chartFields; $i++) {

			$chart_fields[] = array(
				'type' => 'textfield',
				'heading' => esc_html__('Chart Value ', 'mixtapewp') . $i,
				'param_name' => "chart_value_" . $i,
			);
			$chart_fields[] = array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Chart Color ', 'mixtapewp') . $i,
				'param_name' => "chart_color_" . $i,
			);
			$chart_fields[] = array(
				'type' => 'textfield',
				'heading' => esc_html__('Chart Legend ', 'mixtapewp') . $i,
				'param_name' => "chart_legend_" . $i,
			);

		}

		vc_map( array(
			'name' => esc_html__('Pie Chart 2 (Pie)', 'mixtapewp'),
			'base' => $this->getBase(),
			'category' => esc_html__('by SELECT', 'mixtapewp'),
			'icon' => 'icon-wpb-pie-chart2 extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Width', 'mixtapewp'),
						'param_name' => 'width',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Height', 'mixtapewp'),
						'param_name' => 'height',
					),
				),
				$chart_fields
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'width' => '150',
			'height' => '150',
		);

		$chart_fields = array();
		for ($i = 1; $i <= $this->chartFields; $i++) {

			$chart_fields['chart_value_' . $i] = '';
			$chart_fields['chart_color_' . $i] = '';
			$chart_fields['chart_legend_' . $i] = '';

		}

		$args = array_merge($args, $chart_fields);

		$params = shortcode_atts($args, $atts);
		$params['id'] = mt_rand(1000, 9999);
		$params['pie_chart_data'] = $this->getPieChartData($params);
		$params['legend_data'] = $this->getPieChartLegendData($params);

		$html = qodef_core_get_shortcode_template_part('templates/pie-chart-pie', 'piecharts/piechartpie', '', $params);

		return $html;

	}

	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {

		$pieChartData = array();

		for ( $i = 1; $i <= $this->chartFields; $i++ ) {

			if ( isset($params['chart_value_' . $i]) && $params['chart_value_' . $i] !== '' ) {
				$pieChartData['data-value-' . $i] = $params['chart_value_' . $i];
			}
			if ( isset($params['chart_color_' . $i]) && $params['chart_color_' . $i] !== '' ) {
				$pieChartData['data-color-' . $i] = $params['chart_color_' . $i];
			}
			if ( isset($params['chart_legend_' . $i]) && $params['chart_legend_' . $i] !== '' ) {
				$pieChartData['data-legend-' . $i] = $params['chart_legend_' . $i];
			}

		}

		return $pieChartData;

	}

	private function getPieChartLegendData($params) {

		$legendData = array();
		$legendItem = array();

		for ( $i = 1; $i <= $this->chartFields; $i++ ) {

			if ( isset($params['chart_color_' . $i]) && $params['chart_color_' . $i] !== '' ) {
				$legendItem['color'] = 'background-color: '. $params['chart_color_' . $i];
			}
			if ( isset($params['chart_legend_' . $i]) && $params['chart_legend_' . $i] !== '' ) {
				$legendItem['legend'] = $params['chart_legend_' . $i];
			}

			if (!empty($legendItem)) {
				$legendData[] = $legendItem;
				unset($legendItem);
			}

		}

		return $legendData;

	}


}