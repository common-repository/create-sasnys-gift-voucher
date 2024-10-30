<?php

  /**
   * @package GiftVoucher
   */
  namespace Bin\admin_templates;

class Enqueue {


	function __construct() {
	}
	function enqueue_func() {
		wp_enqueue_style( 'giftvoucher', SGVC_Design . 'GiftVoucher.css' );
		wp_enqueue_script( 'giftvoucher', SGVC_Design . 'GiftVoucher.js' );
	}
	function Register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_func' ) );

	}

}
