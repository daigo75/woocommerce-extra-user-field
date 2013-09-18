<?php

// The path to wordpress-tests
// Path to wordpress unit test framework
$path = '/src/wp_unit/bootstrap.php';

if(file_exists($path)) {
  require_once $path;
} else {
   exit("Couldn't find path to wp_unit bootstrap.php. Expected location: '$path'.\n");
}

// Load Composer Autoloader
$composer_autoloader = realpath(__DIR__ . '/../src/vendor/autoload.php');
if(file_exists($composer_autoloader)) {
  require_once $composer_autoloader;
} else {
   exit("Couldn't find path to composer autoloader. Expected location: '$composer_autoloader'.\n");
}

// Try to activate all required plugins
$required_plugins = array(
	'woocommerce/woocommerce.php',
);

foreach($required_plugins as $plugin) {
	printf("Activating plugin '%s'...\n", $plugin);
	$result = activate_plugin($plugin);
	if($result != null) {
		echo "Success.\n";
	}
	else {
		$errors = $result->get_error_messages();

		printf("Could not activate plugin '%s'. See errors below.\n", $plugin);
		exit(implode("\n", $errors));
	}
}
