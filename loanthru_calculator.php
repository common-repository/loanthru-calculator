<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.loanthru.com
 * @since             1.0.0
 * @package           Loanthru_calculator
 *
 * @wordpress-plugin
 * Plugin Name:       LoanThru Calculator
 * Plugin URI:        www.loanthru.com
 * Description:       LoanThru Calculator is a free and user-friendly loan calculator that allows you to select the interest calculation method to estimate the total loan interest and monthly repayment amount. Simply insert the shortcode [loanthru_calculator] to any posts or pages to display the calculator; or activate the LoanThru Calculator Widget on the sidebar.
 * Version:           1.0.0
 * Author:            LoanThru
 * Author URI:        www.loanthru.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       loanthru_calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-loanthru_calculator-activator.php
 */
function activate_loanthru_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-loanthru_calculator-activator.php';
	Loanthru_calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-loanthru_calculator-deactivator.php
 */
function deactivate_loanthru_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-loanthru_calculator-deactivator.php';
	Loanthru_calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_loanthru_calculator' );
register_deactivation_hook( __FILE__, 'deactivate_loanthru_calculator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-loanthru_calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_loanthru_calculator() {

	$plugin = new Loanthru_calculator();
	$plugin->run();

}
run_loanthru_calculator();

