<?php

require_once('plugin-template.php');

/**
 * Tests for the base plugin class.
 */
class WC_Aelia_Plugin_Test extends WP_UnitTestCase {
	const SETTINGS_KEY = 'test_settings';
	const TEXT_DOMAIN = 'test_domain';

	public function setUp() {
		parent::setUp();

		$renderer = new WC_Aelia_Settings_Renderer();
		$this->settings = new WC_Aelia_Settings(self::SETTINGS_KEY,
																						self::TEXT_DOMAIN,
																						$renderer);
		$this->messages = new WC_Aelia_Messages();

		$this->plugin = new WC_Aelia_Plugin($this->settings, $this->messages);

		$plugin_class = get_class($this->plugin);
		$GLOBALS[$plugin_class::INSTANCE_KEY] = $this->plugin;
	}

	public function test_settings_controller() {
		$controller = $this->plugin->settings_controller();
		$this->assertSame($controller, $this->settings);
	}

	public function test_messages_controller() {
		$controller = $this->plugin->messages_controller();
		$this->assertSame($controller, $this->messages);
	}

	public function test_instance() {
		$plugin_instance = $this->plugin->instance();
		$this->assertSame($plugin_instance, $this->plugin);
	}

	public function test_settings() {
		$controller = WC_Aelia_Plugin::settings();
		$this->assertSame($controller, $this->settings);
	}

	public function test_messages() {
		$controller = WC_Aelia_Plugin::messages();
		$this->assertSame($controller, $this->messages);
	}

	public function test_get_error_message() {
		$message = $this->plugin->get_error_message(WC_Aelia_Messages::ERR_FILE_NOT_FOUND);
		$this->assertTrue(!empty($message));
	}

	/* The tests below simply check that the methods run without errors. */
	public function test_wordpress_loaded() {
		$this->plugin->wordpress_loaded();
		$this->assertTrue(true);
	}

	public function test_woocommerce_loaded() {
		$this->plugin->woocommerce_loaded();
		$this->assertTrue(true);
	}

	public function test_plugins_loaded() {
		$this->plugin->plugins_loaded();
		$this->assertTrue(true);
	}

	public function test_include_template_functions() {
		$this->plugin->include_template_functions();
		$this->assertTrue(true);
	}

	public function test_register_widgets() {
		$this->plugin->register_widgets();
		$this->assertTrue(true);
	}

	public function test_register_styles() {
		$this->plugin->register_styles();
		$this->assertTrue(true);
	}

	public function test_load_admin_scripts() {
		$this->plugin->load_admin_scripts();
		$this->assertTrue(true);
	}

	public function test_load_frontend_scripts() {
		$this->plugin->load_frontend_scripts();
		$this->assertTrue(true);
	}

	public function test_setup() {
		$this->plugin->setup();
		$this->assertTrue(true);
	}

	public function test_cleanup() {
		$this->plugin->cleanup();
		$this->assertTrue(true);
	}

	public function test_is_woocommerce_active() {
		$this->assertTrue(is_bool(WC_Aelia_Plugin::is_woocommerce_active()));
	}
}
