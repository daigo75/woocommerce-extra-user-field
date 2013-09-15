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
	/**
	 * Constructor.
	 *
	 * @param WC_Aelia_Settings settings_controller The controller that will handle
	 * the plugin settings.
	 * @param WC_Aelia_Messages messages_controller The controller that will handle
	 * the messages produced by the plugin.
	 */
	public function __construct(WC_Aelia_Settings $settings_controller,
															WC_Aelia_Messages $messages_controller) {
		parent::__construct($settings_controller, $messages_controller);

		self::$plugin_slug = 'wc-authipay-gateway-plugin';
		self::$text_domain = self::$plugin_slug;
		self::$settings_key = self::$plugin_slug;
		self::$instance_key = self::$plugin_slug;
	}

	public static function factory() {
		$settings_page_renderer = new WC_Aelia_Settings_Renderer();
		$settings_controller = new WC_Aelia_Settings(self::SETTINGS_KEY,
																								 self::TEXT_DOMAIN,
																								 $settings_page_renderer);
		$messages_controller = new WC_Aelia_Messages();

		$plugin_instance = new WC_Aelia_Template_Plugin($settings_controller, $messages_controller);
		return $plugin_instance;
	}
}

$GLOBALS['template_plugin'] = WC_Aelia_Template_Plugin::factory();
