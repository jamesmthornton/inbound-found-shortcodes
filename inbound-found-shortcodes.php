<?php

/**
 * @link              http://morphatic.com
 * @since             1.0.0
 * @package           Inbound_Found_Shortcodes
 *
 * @wordpress-plugin
 * Plugin Name:       Inbound Found Shortcodes
 * Plugin URI:        http://inboundfound.com/our-work/plugins/shortcodes
 * Description:       Shortcodes for recurring template segments that we like.
 * Version:           1.0.0
 * Author:            Morgan Benton
 * Author URI:        http://morphatic.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inbound-found-shortcodes
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-inbound-found-shortcodes-activator.php
 */
function activate_inbound_found_shortcodes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inbound-found-shortcodes-activator.php';
	Inbound_Found_Shortcodes_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-inbound-found-shortcodes-deactivator.php
 */
function deactivate_inbound_found_shortcodes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inbound-found-shortcodes-deactivator.php';
	Inbound_Found_Shortcodes_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_inbound_found_shortcodes' );
register_deactivation_hook( __FILE__, 'deactivate_inbound_found_shortcodes' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inbound-found-shortcodes.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_inbound_found_shortcodes() {

	$plugin = new Inbound_Found_Shortcodes();
	$plugin->run();

}
run_inbound_found_shortcodes();
