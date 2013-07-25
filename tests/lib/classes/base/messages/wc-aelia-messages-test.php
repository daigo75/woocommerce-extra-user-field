<?php

require_once 'plugin-template.php';

class WC_Aelia_Messages extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
		$this->aelia_messages = new WC_Aelia_Messages();
	}

	function testAddErrorMessage() {
		$code = 'test_msg';
		$message = 'Test Message';

		$this->aelia_messages->add_error_message()
	}
}


/**
 * Implements a base class to store and handle the messages returned by the
 * plugin.
 */
class WC_Aelia_Messages {
	const TEXTDOMAIN = 'woocommerce-aelia';

	// Result constants
	const RES_OK = 0;
	const ERR_FILE_NOT_FOUND = 100;

	// @var WP_Error Holds the error messages registered by the plugin
	protected $_wp_error;

	public function __construct() {

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
}
