<?php

/**
 * Tests for the PLUGIN_CLASS class.
 */
class PLUGIN_CLASS_Test extends WP_UnitTestCase {
	// @var PLUGIN_CLASS An instance of the the EU VAT Assistant plugin.
	protected $plugin_instance;

	public function setUp() {
		parent::setUp();

		// Load main plugin file autoloader
		require_once(__DIR__ . '/../plugin-template.php');
		if(is_object($GLOBALS['PLUGIN_SLUG_VALUE'])) {
			$this->plugin_instance = $GLOBALS['PLUGIN_SLUG_VALUE'];
		}
	}

	/**
	 * Returns a message with some instructions to troubleshoot the case in which
	 * the plugin is not loaded.
	 *
	 * @return string
	 */
	protected function get_check_requirements_message() {
		return 'The plugin might not have been loaded due to missing requirements ' .
					 '(e.g. incorrect WooCommerce version). Review class ' .
					 'PLUGIN_CLASS_NAME_RequirementsChecks and ensure that ' .
					 'all the requirements are satisfied. If necessary, modify the build.xml ' .
					 'file to install any additional plugin that might be needed.';
	}

	/**
	 * Tests that the plugin class was loaded correctly.
	 */
	public function test_class_loaded() {
		$this->assertTrue(class_exists('\Aelia\WC\PLUGIN_NAMESPACE\PLUGIN_CLASS_NAME', false),
											'Plugin class does not exist. ' . $this->get_check_requirements_message());
	}

	/**
	 * Checks that the plugin class was instantiated.
	 */
	public function test_plugin_loaded() {
		$this->assertInstanceOf('\Aelia\WC\PLUGIN_NAMESPACE\PLUGIN_CLASS_NAME', $this->plugin_instance,
														'Plugin class was not loaded. ' . $this->get_check_requirements_message());
	}
}
