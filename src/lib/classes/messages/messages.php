<?php
namespace PLUGIN_NSPACE;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

use \WP_Error;

/**
 * Implements a base class to store and handle the messages returned by the
 * plugin. This class is used to extend the basic functionalities provided by
 * standard WP_Error class.
 */
class Messages extends \Aelia\WC\Messages {
	// Error codes
	//const ERR_SAMPLE_CODE = 1000;

	// @var string The text domain used by the class
	protected $_text_domain = Definitions::TEXT_DOMAIN;

	/**
	 * Loads all the error message used by the plugin. This class should be
	 * extended during implementation, to add all error messages used by
	 * the plugin.
	 */
	public function load_error_messages() {
		parent::load_error_messages();

		// TODO Add here all the error messages used by the plugin
	}
}
