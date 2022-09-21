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
        $output = get_option('product_setting');
        // $new_input = array($input['post_type'] => $input);

        foreach ($output as $key => $value) 
        {
            if($input['post_type'] === $key)
            {
                $output[$key] = $input;
            }
            else
            {
                $output[$input['post_type']] = $input;
            }
        }
       
        return $output;
    }
    public function textField($data)
    {
        $name = $data['label_for'];
        $option_name = $data['option_name'];
        $input = get_option($option_name);
        
        echo'<input type="text" class="regular-text" id="'.$name.'" name="'.$option_name.'['.$name.']" value="" placeholder="'.$data['placeholder'].'">';
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
		

		echo '<div class="' . $classes . '">
				<input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="">
				<label for="' . $name . '"><div></div></label>
			</div>';
	}
 }