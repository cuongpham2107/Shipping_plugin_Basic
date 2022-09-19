<?php
/**
 * @package  ShippingPlugin
 */
namespace Inc\Base;

class Deactivate
{
	/**
	 * Deactivate Plugin
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}