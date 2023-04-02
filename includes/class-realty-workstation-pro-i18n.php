<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://wppb.me/
 * @since      1.0.0
 *
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Realty_Workstation_Pro
 * @subpackage Realty_Workstation_Pro/includes
 * @author     Tech Mirza <talhamirza2@gmail.com>
 */
class Realty_Workstation_Pro_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'realty-workstation-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
