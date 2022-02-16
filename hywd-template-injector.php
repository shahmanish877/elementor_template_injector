<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://haywood.de/
 * @since             1.0.0
 * @package           Hywd_Template_Injector
 *
 * @wordpress-plugin
 * Plugin Name:       HYWD Template Injector
 * Plugin URI:        #
 * Description:       Inject templates everywhere. Even into former unreachable places, right inside of other widgets.
 * Version:           1.0.0
 * Author:            HAYWOOD Digital Tools
 * Author URI:        https://haywood.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hywd-template-injector
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
define( 'HYWD_TEMPLATE_INJECTOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hywd-template-injector-activator.php
 */
function activate_hywd_template_injector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hywd-template-injector-activator.php';
	Hywd_Template_Injector_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hywd-template-injector-deactivator.php
 */
function deactivate_hywd_template_injector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hywd-template-injector-deactivator.php';
	Hywd_Template_Injector_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hywd_template_injector' );
register_deactivation_hook( __FILE__, 'deactivate_hywd_template_injector' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hywd-template-injector.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hywd_template_injector() {

	$plugin = new Hywd_Template_Injector();
	$plugin->run();

}
run_hywd_template_injector();
