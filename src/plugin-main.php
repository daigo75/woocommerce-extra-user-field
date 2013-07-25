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
load_plugin_textdomain(AELIA_CS_PLUGIN_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/');

class Template_Plugin {
	/**
	 * Returns global instance of woocommerce.
	 *
	 * @return object The global instance of woocommerce.
	 */
	private function woocommerce() {
		global $woocommerce;
		return $woocommerce;
	}

	/**
	 * Returns the instance of the plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher.
	 */
	public static function instance() {
		return $GLOBALS[WC_Aelia_CurrencySwitcher::INSTANCE_KEY];
	}

	/**
	 * Setup our filters
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter('the_content', array($this, 'append_content'));
	}

	/**
	 * Appends "Hello WordPress Unit Tests" to the content of every post
	 *
	 * @param string $content
	 * @return string
	 */
	public function append_content($content) {
		return $content . '<p>Hello WordPress Unit Tests</p>';
	}
}

$GLOBALS['template_plugin'] = new Template_Plugin();
