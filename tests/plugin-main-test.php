<?php

/**
 * Tests for the WC_Extra_User_Field class.
 */
class WC_Extra_User_Field_Test extends WP_UnitTestCase {
	// @var WC_Extra_User_Field An instance of the plugin being tested.
	protected $plugin_instance;

	public function setUp() {
		parent::setUp();

		// Load main plugin file autoloader
		require_once(__DIR__ . '/../woocommerce-extra-user-field.php');
		if(is_object($GLOBALS['woocommerce-extra-user-field'])) {
			$this->plugin_instance = $GLOBALS['woocommerce-extra-user-field'];
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
					 'WC_Extra_User_Field_RequirementsChecks and ensure that ' .
					 'all the requirements are satisfied. If necessary, modify the build.xml ' .
					 'file to install any additional plugin that might be needed.';
	}

	/**
	 * Tests that the plugin class was loaded correctly.
	 */
	public function test_class_loaded() {
		$this->assertTrue(class_exists('\Aelia\WC\WC_Extra_User_Field\WC_Extra_User_Field', false),
											'Plugin class does not exist. ' . $this->get_check_requirements_message());
	}

	/**
	 * Checks that the plugin class was instantiated.
	 */
	public function test_plugin_loaded() {
		$this->assertInstanceOf('\Aelia\WC\WC_Extra_User_Field\WC_Extra_User_Field', $this->plugin_instance,
														'Plugin class was not loaded. ' . $this->get_check_requirements_message());
	}
}
