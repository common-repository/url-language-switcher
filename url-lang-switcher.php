<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://niklas-grieger.de/
 * @since             1.0.0
 * @package           Url_Lang_Switcher
 *
 * @wordpress-plugin
 * Plugin Name:       URL Language Switcher
 * Plugin URI:        https://gitlab.com/niks-wordpress-plugins/url-lang-switcher
 * Description:       This is a lightweight language switcher. It just add an GET Parameter to the current URL and the Wordpress filter load the chosen language
 * Version:           1.0.0
 * Author:            Niklas Grieger
 * Author URI:        https://niklas-grieger.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       url-lang-switcher
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'URL_LANG_SWITCHER_VERSION', '1.0.0' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-url-lang-switcher-activator.php
 */
function activate_url_lang_switcher() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-url-lang-switcher-activator.php';
	Url_Lang_Switcher_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-url-lang-switcher-deactivator.php
 */
function deactivate_url_lang_switcher() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-url-lang-switcher-deactivator.php';
	Url_Lang_Switcher_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_url_lang_switcher' );
register_deactivation_hook( __FILE__, 'deactivate_url_lang_switcher' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-url-lang-switcher.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_url_lang_switcher() {

	$plugin = new Url_Lang_Switcher();
	$plugin->run();

}
run_url_lang_switcher();
