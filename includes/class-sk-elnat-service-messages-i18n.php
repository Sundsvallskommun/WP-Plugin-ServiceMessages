<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.cybercom.com/
 * @since      1.0.0
 *
 * @package    Sk_Elnat_Service_Messages
 * @subpackage Sk_Elnat_Service_Messages/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sk_Elnat_Service_Messages
 * @subpackage Sk_Elnat_Service_Messages/includes
 * @author     Joakim Sundqvist <joakim.sundqvist@cybercom.com>
 */
class Sk_Elnat_Service_Messages_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sk-elnat-service-messages',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
