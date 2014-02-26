<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

//define('SCRIPT_DEBUG', 1);
//error_reporting(E_ALL);

/**
 * Check if WooCommerce is active
 */
//if(!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//	return;
//}

require_once('lib/classes/base/plugin/wc-aelia-plugin.php');

/**
 * Template plugin.
 **/
class WC_Aelia_Template_Plugin extends WC_Aelia_Plugin {
	public static $version = '0.7.2';

	public static $plugin_slug = 'wc-aelia-template-plugin';
	public static $text_domain = 'wc-aelia-template-plugin';
	public static $plugin_name = 'Template Plugin';

	public static function factory() {
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');

		$settings_key = self::$plugin_slug;

		$settings_page_renderer = new WC_Aelia_Settings_Renderer();
		$settings_controller = new WC_Aelia_Settings($settings_key,
																								 self::$text_domain,
																								 $settings_page_renderer);
		$messages_controller = new WC_Aelia_Messages();

		$plugin_instance = new WC_Aelia_Template_Plugin($settings_controller, $messages_controller);
		return $plugin_instance;
	}

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
		// Load Composer autoloader
		require_once(__DIR__ . '/vendor/autoload.php');

		parent::__construct($settings_controller, $messages_controller);
	}
}


if(WC_Aelia_Template_Plugin::check_requirements() == true) {
	// Instantiate plugin and add it to the set of globals
	$GLOBALS[WC_Aelia_Template_Plugin::$plugin_slug] = WC_Aelia_Template_Plugin::factory();
}
else {
	// If requirements are missing, display the appropriate notices
	add_action('admin_notices', array('WC_Aelia_Template_Plugin', 'plugin_requirements_notices'));
}
