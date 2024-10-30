<?php
  /**
   * @package GiftVoucher
   */
  namespace Bin\admin_templates;

class Deactivate {


	public static function Deactivate() {
		flush_rewrite_rules();
	}
}
