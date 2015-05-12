<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: PLUGIN_NAME
Description: PLUGIN_DESCRIPTION
Author: PLUGIN_AUTHOR
Version: PLUGIN_VERSION
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-plugin-slug-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(Aelia_WC_CS_Subscriptions_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';
}
