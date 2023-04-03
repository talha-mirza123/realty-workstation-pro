<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://realtyworkstation.com/
 * @since             1.0.32
 * @package           Realty_Workstation_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Realty Workstation Pro
 * Plugin URI:        https://realtyworkstation.com/
 * Description:       With Realty Workstation Pro real estate brokers and team leaders can to process their agents’ transactions, archive all transaction related documentation and calculate commissions.
 * Version:           1.0.32
 * Author:            Realty Workstation
 * Author URI:        https://realtyworkstation.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       realty-workstation-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.32 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'REALTY_WORKSTATION_PRO_VERSION', '1.0.32' );
define( 'REALTY_WORKSTATION_PRO_PATH', plugin_dir_path( __FILE__ ) );
define( 'REALTY_WORKSTATION_PRO_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-realty-workstation-pro-activator.php
 */
function activate_realty_workstation_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-realty-workstation-pro-activator.php';
	Realty_Workstation_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-realty-workstation-pro-deactivator.php
 */
function deactivate_realty_workstation_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-realty-workstation-pro-deactivator.php';
	Realty_Workstation_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_realty_workstation_pro' );
register_deactivation_hook( __FILE__, 'deactivate_realty_workstation_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-realty-workstation-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.32
 */
function run_realty_workstation_pro() {

	$plugin = new Realty_Workstation_Pro();
	$plugin->run();

}
run_realty_workstation_pro();

require REALTY_WORKSTATION_PRO_PATH . 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/talha-mirza123/realty-workstation-pro/',
	__FILE__, //Full path to the main plugin file or functions.php.
	'realty-workstation-pro'
);