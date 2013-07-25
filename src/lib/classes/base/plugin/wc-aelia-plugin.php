<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

interface IWC_Aelia_Plugin {
	public function get_exchange_rates($base_currency, array $currencies);
}

/**
 * Implements a base plugin class to be used to implement WooCommerce plugins.
 */
abstract class WC_Aelia_Plugin implements IWC_Aelia_Plugin {
	// @var WC_Aelia_CurrencySwitcher_Settings The object that will manipulate plugin's settings.
	protected $_settings_controller;

	/**
	 * Returns global instance of woocommerce.
	 *
	 * @return object The global instance of woocommerce.
	 */
	protected function woocommerce() {
		global $woocommerce;
		return $woocommerce;
	}

	/**
	 * Returns the instance of the Settings Controller used by the plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher_Settings.
	 */
	public function settings_controller() {
		return $this->_settings_controller;
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
	 * Returns the Settings Controller used by the plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher_Settings.
	 */
	public static function settings() {
		return self::instance()->settings_controller();
	}

	/**
	 * Registers an error message in the internal WP_Error object.
	 *
	 * @param mixed error_code The Error Code.
	 * @param string error_message The Error Message.
	 */
	protected function add_error_message($error_code, $error_message) {
		$this->_wp_error->add($error_code, $error_message);
	}

	/**
	 * Retrieves an error message from the internal WP_Error object.
	 *
	 * @param mixed error_code The Error Code.
	 * @return string The Error Message corresponding to the specified Code.
	 */
	public function get_error_message($error_code) {
		return $this->_wp_error->get_error_message($error_code);
	}

	/**
	 * Loads all the error message used by the plugin.
	 */
	protected function load_error_messages() {
	}

	/**
	 * Triggers an error displaying the message associated to an error code.
	 *
	 * @param mixed error_code The Error Code.
	 * @param int error_type The type of Error to raise.
	 * @param array error_args An array of arguments to pass to the vsprintf()
	 * function which will format the error message.
	 * @return string The formatted error message.
	 */
	protected function trigger_error($error_code, $error_type = E_NOTICE, array $error_args = array()) {
		$error_message = $this->get_error_message($error_code);

		return trigger_error(vsprintf($error_message, $error_args), $error_type);
	}

		/**
	 * Sets the hook handlers for WooCommerce and WordPress.
	 */
	protected function set_hooks() {
	}

	/**
	 * Constructor.
	 */
	public function __construct($settings_controller, WC_Aelia_Messages $messages_controller) {
		$this->_wp_error = new WP_Error();
		$this->_messages_controller = $messages_controller;

		$this->load_error_messages();

		// Uncomment line below to debug the activation hook when using symlinks
		//register_activation_hook(basename(dirname(__FILE__)).'/'.basename(__FILE__), array($this, 'setup'));
		register_activation_hook(__FILE__, array($this, 'setup'));
		register_uninstall_hook(__FILE__, array(get_class($this), 'cleanup'));

		// called only after woocommerce has finished loading
		add_action('init', array($this, 'wordpress_loaded'));
		add_action('woocommerce_init', array($this, 'woocommerce_loaded'), 1);

		// called after all plugins have loaded
		add_action('plugins_loaded', array($this, 'plugins_loaded'));

		// called just before the woocommerce template functions are included
		add_action('init', array($this, 'include_template_functions'), 20);

		// indicates we are running the admin
		if(is_admin()) {
			// ...
		}

		// indicates we are being served over ssl
		if(is_ssl()) {
			// ...
		}
	}

	/**
	 * Take care of anything that needs to be done as soon as WordPress finished
	 * loading.
	 */
	public function wordpress_loaded() {
		$this->register_js();
		$this->register_styles();
	}

/**
	 * Performs operation when woocommerce has been loaded.
	 */
	public function woocommerce_loaded() {
		// Set all required hooks
		$this->set_hooks();

		// Run updates only when in Admin area. This should occur automatically when
		// plugin is activated, since it's done in the Admin area
		if(is_admin()) {
			$this->run_updates();
		}
	}

	/**
	 * Performs operation when all plugins have been loaded.
	 */
	public function plugins_loaded() {
		// ...
	}

	/**
	 * Override any of the template functions from woocommerce/woocommerce-template.php
	 * with our own template functions file
	 */
	public function include_template_functions() {

	}

	/**
	 * Registers a widget class.
	 *
	 * @param string widget_class The class to register.
	 * @param bool stop_on_error Indicates if the function should raise an error
	 * if the Widget Class doesn't exist or cannot be loaded.
	 * @return bool True, if the Widget was registered correctly, False otherwise.
	 */
	private function register_widget($widget_class, $stop_on_error = true) {
		$file_to_load = $this->widgets_path() . '/' . str_replace('_', '-', strtolower($widget_class)) . '.php';

		if(!file_exists($file_to_load)) {
			if($stop_on_error === true) {
				$this->trigger_error(AELIA_CS_ERR_FILE_NOT_FOUND, E_USER_ERROR, array($file_to_load));
			}
			return false;
		}
		require_once($file_to_load);
		register_widget($widget_class);

		return true;
	}

	/**
	 * Registers all the Widgets used by the plugin.
	 */
	public function register_widgets() {
		// Register the required widgets
		//$this->register_widget('WC_Aelia_Template_Widget');
	}

	/**
	 * Registers the JavaScript files required by the plugin.
	 */
	public function register_js() {
		// Register Admin JavaScript
		//wp_register_script('wc-aelia-currency-switcher-widget',
		//									 $this->plugin_url() . '/js/frontend/wc-aelia-currency-switcher-widget.js',
		//									 array('jquery'),
		//									 null,
		//									 false);

		// Register Frontend JavaScript
		//wp_register_script('wc-aelia-currency-switcher-admin',
		//									 $this->plugin_url() . '/js/admin/wc-aelia-currency-switcher-admin.js',
		//									 array('jquery'),
		//									 null,
		//									 true);
	}

	/**
	 * Registers the Style files required by the plugin.
	 */
	public function register_styles() {
		// Register Admin stylesheet
		//wp_register_style('wc-aelia-cs-admin',
		//									$this->plugin_url() . '/design/css/admin.css',
		//									array(),
		//									null,
		//									'all');

		// Register Frontend stylesheet
		//wp_register_style('wc-aelia-cs-frontend',
		//									$this->plugin_url() . '/design/css/frontend.css',
		//									array(),
		//									null,
		//									'all');
	}

	/**
	 * Loads Styles and JavaScript for the Admin pages.
	 */
	public function load_admin_scripts() {
		// Styles
		// Enqueue the required Admin stylesheets
		//wp_enqueue_style('wc-aelia-plugin-admin');

		// JavaScript
		// Placeholder - Enable and pass the values to localise the Admin page script
		//wp_localize_script('wc-aelia-currency-switcher-admin',
		//									 'aelia-cs-admin',
		//									 array());
		//wp_enqueue_script('wc-aelia-currency-switcher-admin');
	}

	/**
	 * Loads Styles and JavaScript for the Frontend.
	 */
	public function load_frontend_scripts() {
		// Enqueue the required Frontend stylesheets
		//wp_enqueue_style('wc-aelia-plugin-frontend');
	}

	/**
	 * Checks that one or more PHP extensions are loaded.
	 *
	 * @param array required_extensions An array of extension names.
	 * @return array An array of error messages containing one entry for each
	 * extension that is not loaded.
	 */
	protected function check_required_extensions(array $required_extensions) {
		$errors = array();
		foreach($required_extensions as $extension) {
			if(!extension_loaded($extension)) {
				$errors[] = sprintf(__('Missing requirement: this plugin requires "%s" extension.', AELIA_CS_PLUGIN_TEXTDOMAIN),
														$extension);
			}
		}

		return $errors;
	}

	/**
	 * Checks that plugin requirements are satisfied.
	 *
	 * @param array errors An array that will contain all errors eventually
	 * generated.
	 * @return bool
	 */
	protected function check_requirements(&$errors) {
		$errors = array();
		if(PHP_VERSION < '5.3') {
			$errors[] = __('Missing requirement: this plugin requires PHP 5.3 or greater.', AELIA_CS_PLUGIN_TEXTDOMAIN);
		}

		// Check that all required extensions are loaded
		$required_extensions = array(
		);
		$extension_errors = $this->check_required_extensions($required_extensions);

		$errors = array_merge($errors, $extension_errors);

		return empty($errors);
	}

	/**
	 * Setup function. Called when plugin is enabled.
	 */
	public function setup() {
		$errors = array();
		if(!$this->check_requirements($errors)) {
			die(implode('<br>', $errors));
		}
	}

	/**
	 * Cleanup function. Called when plugin is uninstalled.
	 */
	public static function cleanup() {
		if(!defined('WP_UNINSTALL_PLUGIN')) {
			return;
		}
	}
}
