<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tests for the base settings controller.
 */
class WC_Aelia_Settings_Test {
	const SETTINGS_KEY = 'test_settings';
	const TEXT_DOMAIN = 'test_domain';

	protected function get_test_settings($key = null) {
		$test_settings = array(
			'int_param' => 1,
			'string_param' => 'string_val',
		);

		if($key === null) {
			return $test_settings;
		}
		else {
			return $test_settings[$key];
		}
	}

	public function setUp() {
		parent::setUp();

		$renderer = new WC_Aelia_Settings_Renderer();
		$this->settings = new WC_Aelia_Settings(self::SETTINGS_KEY,
																						self::TEXT_DOMAIN,
																						$renderer);
	}

	public function test_default_settings() {
		$this->assertTrue($this->settings->default_settings() === null);
	}

	public function test_save() {
		$this->settings->save($this->get_test_settings());
		$this->assertEqual($this->settings->load(), $this->test_settings());
	}

	public function test_load() {
		$this->assertEqual($this->settings->load(), $this->test_settings());
	}

	public function test_current_settings() {
		$test_settings = $this->get_test_settings('string_param');
		$current_settings = $this->settings->current_settings('string_param');
		$this->assertEqual($current_settings, $test_settings);
	}
}
