<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

//define('SCRIPT_DEBUG', 1);
//error_reporting(E_ALL);

// Load Composer autoloader
require_once(__DIR__ . '/vendor/autoload.php');

/**
 * Check if WooCommerce is active
 */
//if(!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//	return;
//}

/**
 * Localisation
 **/
class WC_Aelia_Template_Plugin extends WC_Aelia_Plugin {
	public static $version = '0.2.0';

	public static $instance_key = 'wc-aelia-template-plugin';
	public static $plugin_slug = 'wc-aelia-template-plugin';
	public static $text_domain = 'wc-aelia-template-plugin';
	public static $settings_key = 'wc-aelia-template-plugin';

	public static function factory() {
		$settings_page_renderer = new WC_Aelia_Settings_Renderer();
		$settings_controller = new WC_Aelia_Settings(self::$settings_key,
																								 self::$text_domain,
																								 $settings_page_renderer);
		$messages_controller = new WC_Aelia_Messages();

		$plugin_instance = new WC_Aelia_Template_Plugin($settings_controller, $messages_controller);
		return $plugin_instance;
	}
}

$GLOBALS[WC_Aelia_Template_Plugin::$plugin_slug] = WC_Aelia_Template_Plugin::factory();
