<?php

  /**
   * @package giftvoucher
   */
  namespace Bin\admin_templates;

class SettingsLinks {


	public function Register() {
		  add_filter( 'plugin_action_links_' . SGVC_plugin_name, array( $this, 'Settings_Link' ) );
	}
	public function Settings_Link( $links ) {
		$Settings_Link = "<a href='admin.php?page=sgvc-gift-voucher-plugin'>" . esc_html__( 'Settings', 'create-sasnys-gift-voucher' ) . '</a>';
		array_push( $links, $Settings_Link );
		return $links;
	}

}
