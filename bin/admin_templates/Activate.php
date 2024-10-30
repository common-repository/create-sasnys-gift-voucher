<?php
  /**
   * @package GiftVoucher
   */
  namespace Bin\admin_templates;

class Activate {


	public static function activate() {
		flush_rewrite_rules();
	}
}
