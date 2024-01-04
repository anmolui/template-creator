<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://anmol.com
 * @since             1.0.0
 * @package           Template_Creator
 *
 * @wordpress-plugin
 * Plugin Name:       Template Creator
 * Plugin URI:        https://example.com
 * Description:       This plugin is designed to craft and evaluate custom templates across different themes, ensuring seamless compatibility. Developed within the WP Swings Community, it aims to streamline template creation and compatibility testing for a diverse range of themes.
 * Version:           1.0.0
 * Author:            Anmol Verma
 * Author URI:        https://anmol.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       template-creator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TEMPLATE_CREATOR_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-template-creator-activator.php
 */
function activate_template_creator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-template-creator-activator.php';
	Template_Creator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-template-creator-deactivator.php
 */
function deactivate_template_creator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-template-creator-deactivator.php';
	Template_Creator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_template_creator');
register_deactivation_hook(__FILE__, 'deactivate_template_creator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-template-creator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_template_creator()
{

	$plugin = new Template_Creator();
	$plugin->run();
}
run_template_creator();




// Function to display the main plugin page content
function main_template()
{
	include_once(plugin_dir_path(__FILE__) . 'templates/admin/template-creator-main.php');
}

// Function to add the menu in WordPress dashboard
function template_creator_plugin_menu()
{
	// Add a top-level menu page
	add_menu_page(
		'Template Creator',     	// Page title
		'Template Creator',     	// Menu title
		'manage_options',       	// Capability required to access the menu
		'template-creator-main',    // Menu slug (should be unique)
		'main_template',       		// Function to display the main page content
		'data:image/svg+xml;base64,' . base64_encode('<svg width="105" height="92" viewBox="0 0 105 92" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M102.749 0.720164L0 41.9883L24.5 50L93.5 15L48.5 62L57.5 69.5L83.1197 89.975L104.095 1.87974C104.283 1.09052 103.502 0.4178 102.749 0.720164Z" fill="#D9D9D9"/>
		<path d="M88.2611 18.8521L44.559 59.9835L36.8469 89.9751L28.2778 53.1282L88.2611 18.8521Z" fill="#D9D9D9"/>
		<path d="M47 65.5L58.5 75L39 92L47 65.5Z" fill="#D9D9D9"/>
		</svg>
		'), 						// Custom SVG icon
		10                    		// Menu position
	);
}

// Hook to add the menu in WordPress dashboard
add_action('admin_menu', 'template_creator_plugin_menu');

// Enqueue stylesheets for the public-facing pages
function enqueue_public_styles()
{
	$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'));
	$plugin_version = $plugin_data['Version'];

	wp_enqueue_style(
		'public-plugin-style', // Handle name
		plugins_url('public/css/template-creator-public.css', __FILE__), // Path to your public CSS file
		array(), // Dependencies if any
		$plugin_version, // Use the dynamic plugin version
		'all' // Media type
	);
}
add_action('wp_enqueue_scripts', 'enqueue_public_styles'); // Hook to enqueue on public-facing pages

// Enqueue stylesheets for the admin pages of your plugin
function enqueue_admin_styles()
{
	$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'));
	$plugin_version = $plugin_data['Version'];
	// Get the screen ID of the current page
	$screen = get_current_screen();
	$screen_id = $screen ? $screen->id : '';

	if ($screen_id && 'toplevel_page_template-creator-main' === $screen_id) {
		wp_register_style('admin-plugin-style', plugin_dir_url(__FILE__) . 'admin/css/template-creator-admin.css', array(), $plugin_version, 'all');
		wp_enqueue_style('admin-plugin-style');
	}
}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles'); // Hook to enqueue on admin pages


// Order Bump Shortcode Register

function order_bump_template()
{
	ob_start();

	include_once(plugin_dir_path(__FILE__) . '/templates/public/order-bump.php');

	return ob_get_clean();
}
add_shortcode('order_bump_shortcode', 'order_bump_template');

// Function to display your shortcode content
function display_order_bump_shortcode() {
    echo do_shortcode('[order_bump_shortcode]'); // Replace 'order_bump_shortcode' with your actual shortcode
}
add_action('woocommerce_review_order_after_payment', 'display_order_bump_shortcode');
