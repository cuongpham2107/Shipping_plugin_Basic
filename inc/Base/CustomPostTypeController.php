<?php 
/**
 * @package  ShippingPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ProductCallback;

/**
* 
*/
class CustomPostTypeController extends BaseController
{
	public $settings;

	public $callbacks;

	public $product_callback;

	public $subpages = array();

	public $custom_post_types = array();

	public function register()
	{
		if ( ! $this->activated( 'cpt_manager' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->product_callback = new ProductCallback();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();
		
		$this->settings->addSubPages( $this->subpages )->register();

		$this->storeCustomPostTypes();

		if ( ! empty( $this->custom_post_types ) ) {
			add_action( 'init', array( $this, 'registerCustomPostTypes' ) );
		}
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'shipping_plugin', 
				'page_title' => 'Products', 
				'menu_title' => 'Product Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'shipping_cpt', 
				'callback' => array( $this->callbacks, 'adminProducts' )
			)
		);
	}
	public function setSettings()
	{
		$settings = array(
			array(
				'option_group'		=>	'shipping_plugin_product_settings',
				'option_name'		=>	'product_setting',
				'callback'			=>	array($this->product_callback,'productSanitize')
			)
		);
		$this->settings->setSettings($settings);
	}
	public function setSections()
	{
		$data = array(
			array(
				'id'		=>	'shipping_plugin_product_index',
				'title'		=>	'Custom Post Type Manager',
				'callback'	=>	array($this->product_callback, 'productSectionManager'),
				'page'		=>	'shipping_product'
			)
		);
		$this->settings->setSections($data);
	}
	public function setFields()
	{
		//post type id
		//singular name
		//plural name
		//public
		//has_archive
		$data = array(
			array(
				'id'		=>	'post_type',
				'title'		=>	'Custom Post Type ID',
				'callback'	=>	array($this->product_callback, 'textField'),
				'page'		=>	'shipping_product',
				'section'	=>	'shipping_plugin_product_index',
				'args'		=>	array(
					'option_name'	=>'product_setting',
					'label_for'	=> 'post_type',
					'placeholder'=>	'eg. product'
					
				)
			),
			array(
				'id'		=>	'singular_name',
				'title'		=>	'Singular Name',
				'callback'	=>	array($this->product_callback, 'textField'),
				'page'		=>	'shipping_product',
				'section'	=>	'shipping_plugin_product_index',
				'args'		=>	array(
					'option_name'	=>'product_setting',
					'label_for'	=> 'singular_name',
					'placeholder'=>	'eg. Product'
				)
			),
			array(
				'id'		=>	'plural_name',
				'title'		=>	'Plural Name',
				'callback'	=>	array($this->product_callback, 'textField'),
				'page'		=>	'shipping_product',
				'section'	=>	'shipping_plugin_product_index',
				'args'		=>	array(
					'option_name'	=>'product_setting',
					'label_for'	=> 'plural_name',
					'placeholder'=>	'eg. product'
					
				)
			),
			array(
				'id'		=>	'public',
				'title'		=>	'Is this Public',
				'callback'	=>	array($this->product_callback, 'checkboxField'),
				'page'		=>	'shipping_product',
				'section'	=>	'shipping_plugin_product_index',
				'args'		=>	array(
					'option_name'	=>'product_setting',
					'label_for'	=> 'public',
					'class'		=>'ui-toggle',
					
				)
			),
			array(
				'id'		=>	'has_archive',
				'title'		=>	'Archive',
				'callback'	=>	array($this->product_callback, 'checkboxField'),
				'page'		=>	'shipping_product',
				'section'	=>	'shipping_plugin_product_index',
				'args'		=>	array(
					'option_name'	=>'product_setting',
					'label_for'	=> 'has_archive',
					'class'		=>'ui-toggle',
					
				)
			),
		);
		$this->settings->setFields($data);
	}
	public function storeCustomPostTypes()
	{	
		$options = get_option('product_setting');
		if(isset($options))
		{
			foreach ($options as $key => $option) 
			{
				$this->custom_post_types[] = array(
					'post_type'             => $option['post_type'],
					'name'                  => $option['plural_name'],
					'singular_name'         => $option['singular_name'],
					'menu_name'             => $option['plural_name'],
					'name_admin_bar'        => $option['singular_name'],
					'archives'              => $option['singular_name'] . ' Archives',
					'attributes'            => $option['singular_name']	. ' Attributes',
					'parent_item_colon'     => 'Parent '	. $option['singular_name'],
					'all_items'             => 'All '	. $option['plural_name'],
					'add_new_item'          => 'Add New '. $option['singular_name'],
					'add_new'               => __( 'Add New ' ,'shipping-plugin'),
					'new_item'              => 'New '	. $option['singular_name'],
					'edit_item'             => 'Edit '	. $option['singular_name'],
					'update_item'           => 'Update '	. $option['singular_name'],
					'view_item'             => 'View '	. $option['singular_name'],
					'view_items'            => '',
					'search_items'          => 'Search '	. $option['singular_name'],
					'not_found'             => 'No '. $option['singular_name'] .'found.',
					'not_found_in_trash'    => 'No '. $option['singular_name']. 'found in Trash.',
					'featured_image'        => $option['singular_name'] . ' Cover Image',
					'set_featured_image'    => _x( 'Set cover image ', ' Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'shipping-plugin' ),
					'remove_featured_image' => _x( 'Remove cover image ', ' Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'shipping-plugin' ),
					'use_featured_image'    => _x( 'Use as cover image ', ' Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'shipping-plugin' ),
					'insert_into_item'      => _x( 'Insert into book ', ' Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'shipping-plugin' ),
					'uploaded_to_this_item' => 'Uploaded to this'. $option['singular_name'],
					'items_list'            => $option['singular_name'] . ' list', 
					'items_list_navigation' => $option['singular_name'].' list navigation',
					'filter_items_list'     => 'Filter'.$option['singular_name'].' products list',
					'label'                 => $option['singular_name'],
					'description'           => $option['singular_name'] . ' custom post type.',
					'rewrite'            	=> array( 'slug' => 'products' ),
					'supports'              => array( 'title', 'editor', 'author', 'thumbnail' ),
					'taxonomies'            => array( 'category', 'post_tag' ),
					'hierarchical'          => false,
					'public'                => true,
					'show_ui'               => true,
					'show_in_menu'          => true,
					'menu_position'         => 5,
					'show_in_admin_bar'     => true,
					'show_in_nav_menus'     => true,
					'can_export'            => true,
					'has_archive'           => true,
					'exclude_from_search'   => false,
					'publicly_queryable'    => true,
					'capability_type'       => 'post'
				);
			}
		}
		
	}

	public function registerCustomPostTypes()
	{
		foreach ($this->custom_post_types as $post_type) {
			register_post_type( $post_type['post_type'],
				array(
					'labels' => array(
						'name'                  => $post_type['name'],
						'singular_name'         => $post_type['singular_name'],
						'menu_name'             => $post_type['menu_name'],
						'name_admin_bar'        => $post_type['name_admin_bar'],
						'archives'              => $post_type['archives'],
						'attributes'            => $post_type['attributes'],
						'parent_item_colon'     => $post_type['parent_item_colon'],
						'all_items'             => $post_type['all_items'],
						'add_new_item'          => $post_type['add_new_item'],
						'add_new'               => $post_type['add_new'],
						'new_item'              => $post_type['new_item'],
						'edit_item'             => $post_type['edit_item'],
						'update_item'           => $post_type['update_item'],
						'view_item'             => $post_type['view_item'],
						'view_items'            => $post_type['view_items'],
						'search_items'          => $post_type['search_items'],
						'not_found'             => $post_type['not_found'],
						'not_found_in_trash'    => $post_type['not_found_in_trash'],
						'featured_image'        => $post_type['featured_image'],
						'set_featured_image'    => $post_type['set_featured_image'],
						'remove_featured_image' => $post_type['remove_featured_image'],
						'use_featured_image'    => $post_type['use_featured_image'],
						'insert_into_item'      => $post_type['insert_into_item'],
						'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
						'items_list'            => $post_type['items_list'],
						'items_list_navigation' => $post_type['items_list_navigation'],
						'filter_items_list'     => $post_type['filter_items_list']
					),
					'label'                     => $post_type['label'],
					'description'               => $post_type['description'],
					'supports'                  => $post_type['supports'],
					'taxonomies'                => $post_type['taxonomies'],
					'hierarchical'              => $post_type['hierarchical'],
					'public'                    => $post_type['public'],
					'show_ui'                   => $post_type['show_ui'],
					'show_in_menu'              => $post_type['show_in_menu'],
					'menu_position'             => $post_type['menu_position'],
					'show_in_admin_bar'         => $post_type['show_in_admin_bar'],
					'show_in_nav_menus'         => $post_type['show_in_nav_menus'],
					'can_export'                => $post_type['can_export'],
					'has_archive'               => $post_type['has_archive'],
					'exclude_from_search'       => $post_type['exclude_from_search'],
					'publicly_queryable'        => $post_type['publicly_queryable'],
					'capability_type'           => $post_type['capability_type']
				)
			);
		}
	}
}