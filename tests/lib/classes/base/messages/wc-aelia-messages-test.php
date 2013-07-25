<?php

require_once 'plugin-template.php';

class WC_Aelia_Messages extends WP_UnitTestCase {
	const MSG_CODE = 'test_msg_code';
	const MESSAGE = 'Test Message';

	public function setUp() {
		parent::setUp();
		$this->aelia_messages = new WC_Aelia_Messages();
	}

	function test_add_error_message() {
		$this->aelia_messages->add_error_message(self::MSG_CODE, self::MESSAGE);
		$this->assertEquals($this->aelia_messages->get_error_code(), self::MSG_CODE);
	}

	function test_get_error_message() {
		$this->aelia_messages->add_error_message(self::MSG_CODE, self::MESSAGE);
		$this->assertEquals($this->aelia_messages->get_error_message(self::MSG_CODE), self::MESSAGE);
	}
}

