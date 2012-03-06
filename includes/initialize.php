<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', DS.'home'.DS.'javed'.DS.'sites'.DS.'mcsu_sites');

//DRUPAL_ROOT
defined('DRUPAL_ROOT') ? null : 
	define('DRUPAL_ROOT', SITE_ROOT);

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'sites'.DS.'all'.DS.'shared_resources'.DS.'cron'.DS.'includes');

// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load drupal bootstrap file to use drupal functions i.e. database, user and etc.
chdir('/home/javed/sites/mcsu_sites/');
require_once ('./includes/bootstrap.inc');
//drupal_bootstrap(DRUPAL_BOOTSTRAP_CONFIGURATION);
//drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


// load database-related classes
require_once(LIB_PATH.DS.'users.php');
require_once(LIB_PATH.DS.'profiles.php');


