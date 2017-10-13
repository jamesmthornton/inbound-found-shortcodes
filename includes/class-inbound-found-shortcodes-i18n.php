<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://morphatic.com
 * @since      1.0.0
 *
 * @package    Inbound_Found_Shortcodes
 * @subpackage Inbound_Found_Shortcodes/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Inbound_Found_Shortcodes
 * @subpackage Inbound_Found_Shortcodes/includes
 * @author     Morgan Benton <morgan.benton@gmail.com>
 */
class Inbound_Found_Shortcodes_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'inbound-found-shortcodes',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
