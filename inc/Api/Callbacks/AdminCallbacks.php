<?php 
/**
 * @package  ShippingPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	/**
	 * Trả về view
	 */
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}
	/**
	 * Trả về view
	 */
	public function adminProducts()
	{
		return require_once( "$this->plugin_path/templates/products.php" );
	}
	/**
	 * Trả về view
	 */
	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}
	/**
	 * Trả về view
	 */
	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}
	/**
	 * Trả về view
	 */
	public function adminGallery()
	{
		echo "<h1>Gallery Manager</h1>";
	}
	/**
	 * Trả về view
	 */
	public function adminTestimonial()
	{
		echo "<h1>Testimonial Manager</h1>";
	}
	/**
	 * Trả về view
	 */
	public function adminTemplates()
	{
		echo "<h1>Templates Manager</h1>";
	}
	/**
	 * Trả về view
	 */
	public function adminAuth()
	{
		echo "<h1>Auth Manager</h1>";
	}
	/**
	 * Trả về view
	 */
	public function adminMembership()
	{
		echo "<h1>Membership Manager</h1>";
	}
	/**
	 * Trả về view
	 */
	public function adminChat()
	{
		echo "<h1>Chat Manager</h1>";
	}
	/**
	 * Trả về view
	 */
	public function adminCustomLogin()
	{
		return require_once( "$this->plugin_path/templates/custom_login.php" );
	}
}