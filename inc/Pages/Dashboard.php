<?php 
/**
 * @package  ShippingPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_mngr;

	public $pages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSettings();

		$this->setSections();
		
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();

		add_action( 'login_enqueue_scripts', array($this,'my_login_logo') );

	}
	
	/**
	 * Tạo Top Menu
	 */
	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Plugin', 
				'menu_title' => 'Plugin', 
				'capability' => 'manage_options', 
				'menu_slug' => 'shipping_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}
	
	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'shipping_plugin_settings',
				'option_name' => 'shipping_plugin',
				'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'shipping_admin_index',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'shipping_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array();

		foreach ( $this->managers as $key => $value ) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'shipping_plugin',
				'section' => 'shipping_admin_index',
				'args' => array(
					'option_name' => 'shipping_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}

		$this->settings->setFields( $args );
	}
	function my_login_logo() { 
		if(get_option('logo_login') && get_option('background_color_login')){
			$url_logo = get_option('logo_login');
			$color_background = get_option('background_color_login');
			if(isset( $url_logo ) && isset( $color_background )){
				?> 
				<style type="text/css">
					#login h1 a, .login h1 a {
						background-image: url(<?php echo $url_logo; ?>);
						height:65px;
						width:320px;
						background-size: 190px 100px;
						background-repeat: no-repeat;
						padding-bottom: 30px;
					}
					body.login.js.login-action-login.wp-core-ui.locale-vi {
						background: <?php echo $color_background ?>;
					}
					body.login.js.login-action-login.wp-core-ui.locale-vi-vn {
						background: <?php echo $color_background ?>;
					}
				</style>
			<?php 
			}
		}
		
	}
}