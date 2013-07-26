<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

//define('SCRIPT_DEBUG', 1);
//error_reporting(E_ALL);

/**
 * Check if WooCommerce is active
 */
//if(!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//	return;
//}

/**
 * Localisation
 **/
class Template_Plugin extends WC_Aelia_Plugin {
	/**
	 * Setup our filters
	 *
	 * @return void
	 */
	public function __construct() {
	}

}

//$GLOBALS['template_plugin'] = new Template_Plugin();
