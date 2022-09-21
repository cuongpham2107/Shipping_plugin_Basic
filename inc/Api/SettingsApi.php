<?php 
/**
 * @package  ShippingPlugin
 */
namespace Inc\Api;

class SettingsApi
{
	public $admin_pages = array();

	public $admin_subpages = array();

	public $settings = array();

	public $sections = array();

	public $fields = array();

	public function register()
	{
		if ( ! empty($this->admin_pages) || ! empty($this->admin_subpages) ) {
			add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
		}

		if ( !empty($this->settings) ) {
			add_action( 'admin_init', array( $this, 'registerCustomFields' ) );
			

		}
		
	}
	/**
	 * Nhận mảng giá trị các trường top menu
	 */
	
	public function addPages( array $pages )
	{
		$this->admin_pages = $pages;

		return $this;
	}
	/**
	 * Nhận mảng giá trị các trường mặc định của sub menu 
	 */
	public function withSubPage( string $title = null ) 
	{
		if ( empty($this->admin_pages) ) {
			return $this;
		}

		$admin_page = $this->admin_pages[0];

		$subpage = array(
			array(
				'parent_slug' => $admin_page['menu_slug'], 
				'page_title' => $admin_page['page_title'], 
				'menu_title' => ($title) ? $title : $admin_page['menu_title'], 
				'capability' => $admin_page['capability'], 
				'menu_slug' => $admin_page['menu_slug'], 
				'callback' => $admin_page['callback']
			)
		);

		$this->admin_subpages = $subpage;

		return $this;
	}
	/**
	 * Nhận mảng giá trị các trường sub menu
	 */
	public function addSubPages( array $pages )
	{
		$this->admin_subpages = array_merge( $this->admin_subpages, $pages );

		return $this;
	}
	/**
	 * Thêm vào hook admin_menu
	 */
	public function addAdminMenu()
	{
		//Đăng kí 1 hoặc nhiều top menu
		foreach ( $this->admin_pages as $page ) {
			add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
		}
		//Đăng kí 1 hoặc nhiều top submenu
		foreach ( $this->admin_subpages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
		}
	}
	/**
	 * Nhận mảng giá trị các trường settings
	 */	
	public function setSettings( array $settings )
	{
		$this->settings = $settings;

		return $this;
	}
	/**
	 * Nhận mảng giá trị các trường sections
	 */
	public function setSections( array $sections )
	{
		$this->sections = $sections;

		return $this;
	}
	/**
	 * Nhận mảng giá trị các trường fields
	 */
	public function setFields( array $fields )
	{
		$this->fields = $fields;

		return $this;
	}
	/**
	 * thêm cho hook admin_init 
	 */
	public function registerCustomFields()
	{
		// đăng kí setting
		foreach ( $this->settings as $setting ) {
			register_setting( 
				$setting["option_group"], 
				$setting["option_name"], 
				( isset( $setting["callback"] ) ? $setting["callback"] : '' ) 
			);
		}

		// đăng kí section
		foreach ( $this->sections as $section ) {
			add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"] );
		}

		// đăng kí settings field
		foreach ( $this->fields as $field ) {
			add_settings_field( 
				$field["id"], 
				$field["title"], 
				( isset( $field["callback"] ) ? $field["callback"] : '' ), 
				$field["page"], 
				$field["section"], 
				( isset( $field["args"] ) ? $field["args"] : '' ) 
			);
		}
	}
}