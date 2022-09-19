<?php
/**
 * @package  ShippingPlugin
 */
namespace Inc\Base;

class Activate
{
	/**
	 * Active Plugin
	 */
	public static function activate() {
		flush_rewrite_rules();

		if ( get_option( 'shipping_plugin' ) ) {
			return;
		}

		$default = array();

		update_option( 'shipping_plugin', $default );
	}
}