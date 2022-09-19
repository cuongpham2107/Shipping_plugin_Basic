<?php
/**
 * @package  AlecadddPlugin
 */
/*
Plugin Name: Shipping Plugin
Plugin URI: http://kennatech.vn/plugin
Description: custom Plugin 
Version: 1.0.0
Author:  "Pham cuong" 
Author URI: http://kennatech.vn/plugin
License: GPLv2 or later
Text Domain: shipping-plugin
Domain Path: /languages
*/



// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_shipping_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_shipping_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_shipping_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_shipping_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}