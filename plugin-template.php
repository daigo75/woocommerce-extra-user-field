<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: PLUGIN_NAME
Description: PLUGIN_DESCRIPTION
Author: PLUGIN_AUTHOR
Version: PLUGIN_VERSION
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/plugin-slug-requirementscheck.php');
// If requirements are not met, deactivate the plugin
if(PLUGIN_CLASS_NAME_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';
}
