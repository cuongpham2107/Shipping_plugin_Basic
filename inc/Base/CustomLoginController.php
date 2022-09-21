<?php 
/**
 * @package  ShippingPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\LoginCallback;

/**
* 
*/
class CustomLoginController extends BaseController
{
    public $settings;

    public $loginCallbacks;

	public $callbacks;

	public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'custom_login' ) ) return;
        
		$this->settings = new SettingsApi();

        $this->loginCallbacks = new LoginCallback();

		$this->setSubpages();
        
		$this->setSettings();

		$this->setSections();
		
		$this->setFields();

		$this->settings->addSubPages( $this->subpages )->register();

	}
    /**
     * Thêm Sub Menu
     */
	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'shipping_plugin', 
				'page_title' => 'Custom Login', 
				'menu_title' => 'Custom Login', 
				'capability' => 'manage_options', 
				'menu_slug' => 'custom_login', 
				'callback' => array( $this->loginCallbacks, 'adminCustomLogin' )
			)
		);
	}
    /**
     * Thêm Setting cho Custom Login 
     */
    public function setSettings()
    {
       
        $settings = array(
			array(
				'option_group'		=>	'custom_login_settings',
				'option_name'		=>	'custom_login',
				'callback'			=>	array($this->loginCallbacks,'loginSanitize')
			)
		);
       
		$this->settings->setSettings($settings);
    }
     /**
     * Thêm Sections cho Custom Login 
     */
    public function setSections()
    {
        $sections = array(
            array(
                'id'            => 'custom_login_section',
                'title'   		=> 'Settings Login',
                'callback'      => array( $this->loginCallbacks, 'sectionCustomLogin' ),
                'page'          =>'custom_login_page'
            )
        );
        $this->settings->setSections( $sections );
    }
    /**
     * Thêm Fields cho Custom Login 
     */
    public function setFields()
    {
        $fields = array(
            
            array(
                'id' =>  'logo_login',
				'title' =>  'Logo Login',
				'callback' => array( $this->loginCallbacks, 'logo_login' ),
				'page' => 'custom_login_page',
				'section' => 'custom_login_section',
				'args' => array(
                    'option_name'	=>'custom_login',
					'label_for' =>  'logo_login',
				)
            ),
			array(
                'id' =>  'background_color_login',
				'title' =>  'Background Color Login',
				'callback' => array( $this->loginCallbacks,'background_color_login'),
				'page' => 'custom_login_page',
				'section' => 'custom_login_section',
				'args' => array(
                    'option_name'	=>'custom_login',
					'label_for' =>  'background_color_login',
				)
            ),
			
        );
        $this->settings->setFields( $fields );
    }	
}