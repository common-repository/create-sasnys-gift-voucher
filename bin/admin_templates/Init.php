<?php
  /**
   * @package giftvoucher
   */
  namespace Bin\admin_templates;

final class Init {

	/**
	 * Get the services from each class page
	 */
	public static function get_services() {
		return array(
			Admin::class,
			SettingsLinks::class,
		// Enqueue::class
		);
	}
	  /**
	   * loop through the classes for the
	   * register then instiate the class  for use
	   */
	public static function register_services() {

		foreach ( self::get_services()as $class ) {
			$service = self::Instantiate( $class );
			if ( method_exists( $service, 'Register' ) ) {
				  $service->Register();
			}
		}
	}
	   /**
		* instiate the class
		*
		* @param mixed $class
		*/
	private static function Instantiate( $class ) {
		return new $class();
	}




}
