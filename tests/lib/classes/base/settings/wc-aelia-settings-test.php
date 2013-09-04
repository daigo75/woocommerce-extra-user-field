<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tests for the base settings controller.
 */
class WC_Aelia_Settings_Test {
	const SETTINGS_KEY = 'test';
	const TEXT_DOMAIN = 'test';

	public function setUp() {
		parent::setUp();

		$renderer = new WC_Aelia_Settings_Renderer();
		$this->settings = new WC_Aelia_Settings(self::SETTINGS_KEY,
																						self::TEXT_DOMAIN,
																						$renderer);
	}
}
