<?php
/**
 * @package EC_product
 */

 namespace Inc\Api\Callbacks;

 use Inc\Base\BaseController;

 class LoginCallbacks extends BaseController
 {
    public function adminCustomLogin()
	{
		return require_once( "$this->plugin_path/templates/custom_login.php" );
	}
    public function sectionCustomLogin()
    {
        echo 'Custom login setting Field';
    }
    public function loginSanitize($input)
    {
        
        return $input;
    }
    public function logo_login($data)
    {
       
        $name = $data['option_name']; //option name //logo_login
        $image = get_option($name);//option value
        
        ?>
        <div class="mb-8 " >
            <!-- <label class="text-sm font-semibold" for="">Upload Logo</label> -->
            <input type="hidden" name="<?php echo $name ?>" value="<?php echo $image ?>" id="value_logo">
            <button type="button" class="px-2 py-2 bg-blue-500 rounded text-white" id="btnImage" >Upload image</button>
            <img src="<?php echo $image ?>" alt="" id="getImage" style="width: 100px;height: 100px;">
        </div>
        <?php
    }
     /**
     *Trả về input thêm mầu nền cho login
     */
	public function background_color_login($data)
	{
		$name = $data['option_name'];
        $color = get_option($name);
        // var_dump($color);
        ?>
       <div class="mb-8">
            <!-- <label class="text-sm font-semibold" for="">Mầu nền:</label> -->
            <input type="text" id="txtMau" name="<?php echo $name ?>" value="<?php echo $color ?>" placeholder="#000000" >
        </div>
        <?php
	}
 }