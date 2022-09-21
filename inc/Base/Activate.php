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

		$default = array();
		if ( !get_option( 'shipping_plugin' ) ) {
			update_option( 'shipping_plugin', $default );//update lại setting Field của Setting 
		}
		if(!get_option('product_setting')){
			update_option('product_setting',$default);
		}
	}
}