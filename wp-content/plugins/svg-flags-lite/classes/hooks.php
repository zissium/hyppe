<?php

namespace WPGO_Plugins\SVG_Flags;

/*
 *	Hook callback functions relevant to the free version of the plugin.
 *  This file will not be included in the pro version.
 * 
 *  Update: It's not strictly necessary to remove free only code from the pro version via hooks but it keeps things cleaner. I've left in this file as an example of how to do it, but it's probably enough to just 'hide' free only code using if(svg_flags_fs()->is_premium()) { // free only code here } in the main code.
*/

class Hooks {

	protected $module_roots;

	/* Main class constructor. */
	public function __construct($module_roots, $custom_plugin_data) {

		$this->module_roots = $module_roots;
		$this->custom_plugin_data = $custom_plugin_data;
		$this->hook_prefix = $this->custom_plugin_data->plugin_settings_prefix;
		//add_action( $this->hook_prefix . '_settings_row_section_1', array( &$this, 'add_donation_content' ) );
	}

} /* End class definition */