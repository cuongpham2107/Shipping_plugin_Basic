<?php 
/**
 * @package  ShippingPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	/**
	 * kiểm tra các phần tử trong mảng trả về checkbox true & false
	 */
	public function checkboxSanitize( $input )
	{
		$output = array();

		foreach ( $this->managers as $key => $value ) {
			$output[$key] = isset( $input[$key] ) ? true : false;
		}

		return $output;
	}
	/**
	 * Trả về text section
	 */
	public function adminSectionManager()
	{
		echo 'Quản lý các Phần và Tính năng của Plugin này bằng cách kích hoạt các hộp kiểm từ danh sách sau.';
	}
	/**
	 * Trả về Label và ô input
	 */
	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );
		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

		echo '<div class="' . $classes . '">
				<input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '>
				<label for="' . $name . '"><div></div></label>
			</div>';
	}

}