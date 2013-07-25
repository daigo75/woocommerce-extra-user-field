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
$composer_autoloader = '../vendor/autoload.php';
if(file_exists($composer_autoloader)) {
  require_once $composer_autoloader;
} else {
   exit("Couldn't find path to composer autoloader. Expected location: '$composer_autoloader'.\n");
}
