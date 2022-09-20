<?php
/**
 * @package ShippingPlugin
 */

 namespace Inc\Api\Callbacks;

 use Inc\Base\BaseController;

 class ProductCallback 
 {
    public function productSectionManager()
    {
        echo 'Manage your Custom Post Types';
    }
    public function productSanitize($input)
    {
        return $input;
    }
    public function textField($data)
    {
        $name = $data['label_for'];
        $option_name = $data['option_name'];
        $input = get_option($option_name);
        var_dump($input);
        $value = $input["'.$name.'"];
        
        echo'<input type="text" class="regular-text" id="'.$name.'" name="'.$option_name.'['.$name.']" value="'.$value.'" placeholder="'.$data['placeholder'].'">';
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