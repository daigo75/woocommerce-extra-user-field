<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly

//define('SCRIPT_DEBUG', 1);
//error_reporting(E_ALL);

// Load Composer autoloader
require_once(__DIR__ . '/vendor/autoload.php');

/**
 * Check if WooCommerce is active
 */
//if(!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//	return;
//}

/**
 * Localisation
 **/
class Template_Plugin extends WC_Aelia_Plugin {
}

$GLOBALS['template_plugin'] = new Template_Plugin();
