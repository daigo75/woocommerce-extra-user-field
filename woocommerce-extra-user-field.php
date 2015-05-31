<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: WooCommerce Extra User Field
Description: Adds a custom field to user profiles, allowing Admins to alter and export it with WooCommerce orders
Plugin URI: http://aelia.co
Version: 0.1.0
Author: Aelia
Author URI: http://aelia.co
Text Domain: woocommerce-extra-user-field
License: GPL-3.0
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/plugin-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(WC_Extra_User_Field_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';
}
