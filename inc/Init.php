<?php
/**
 * @package  ShippingPlugin
 */
namespace Inc;

final class Init
{
	/**
	 * Lưu trữ tất cả các class bên trong một mảng
	 * @return array Danh sách tát các Class học
	 */
	public static function get_services() 
	{
		return [
			Pages\Dashboard::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\CustomLoginController::class,
			Base\CustomPostTypeController::class,
			Base\CustomTaxonomyController::class,
			Base\WidgetController::class,
			Base\GalleryController::class,
			Base\TestimonialController::class,
			Base\TemplateController::class,
			Base\AuthController::class,
			Base\MembershipController::class,
			Base\ChatController::class,
		];
	}

	/**
	 * Dùng vòng lặp để khởi tạo các class,
	 * và gọi phương thức register () nếu nó tồn tại
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Nhận lớp và khởi tạo chúng 
	 * @param  class $class    class nhận được
	 * @return class instance  Class đã được khởi tạo
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}