<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://haywood.de/
 * @since      1.0.0
 *
 * @package    Hywd_Template_Injector
 * @subpackage Hywd_Template_Injector/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Hywd_Template_Injector
 * @subpackage Hywd_Template_Injector/includes
 * @author     HAYWOOD Digital Tools <#>
 */
class Hywd_Template_Injector_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'hywd-template-injector',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
