<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://niklas-grieger.de/
 * @since      1.0.0
 *
 * @package    Url_Lang_Switcher
 * @subpackage Url_Lang_Switcher/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Url_Lang_Switcher
 * @subpackage Url_Lang_Switcher/includes
 * @author     Niklas Grieger <developer@niklas-grieger.de>
 */
class Url_Lang_Switcher_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'url-lang-switcher',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
