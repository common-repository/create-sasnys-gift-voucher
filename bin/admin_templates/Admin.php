<?php

  /**
   * @package giftvoucher
   */
  namespace Bin\admin_templates;

class Admin {


	function __construct() {
	}

	public function Register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

	}

	function add_admin_pages() {
		add_menu_page( 'SGVC_plugin', 'Create Sasnys Voucher', 'manage_options', 'sgvc-gift-voucher-plugin', array( $this, 'admin_index' ), '', null );
	}

	function admin_index() {
		require_once SGVC_Plugin_Path . 'admin-settings.php';
	}
}
