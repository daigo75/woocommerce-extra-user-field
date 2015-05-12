<?php
namespace Aelia\WC\EU_VAT_Assistant;

/**
 * A base test case class. It extends the basic WordPress test case by adding
 * preliminary dependency checks.
 */
class Base_UnitTestCase extends \WP_UnitTestCase {
	protected $plugin_class = '\Aelia\WC\EU_VAT_Assistant\WC_Aelia_EU_VAT_Assistant';

	/**
	 * Checks if the plugin to be tested has been loaded. Tests that depend on the
	 * plugin cannot run if it's not loaded.
	 *
	 * @return bool
	 */
	protected function check_plugin_loaded() {
		if(!class_exists($this->plugin_class , false)) {
			$this->markTestSkipped('EU VAT Assistant plugin was not loaded, tests cannot be performed.');
			return false;
		}
		return true;
	}

	/**
	 * Test setup.
	 */
	public function setUp() {
		parent::setUp();
		$this->check_plugin_loaded();
	}
}
