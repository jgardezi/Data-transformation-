<?php

/*

chdir('../../../../..'); //the Drupal root, relative to the directory of the path
require_once './includes/bootstrap.inc';
require_once './includes/common.inc';
require_once './includes/module.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
drupal_load('module', 'i18n'); // I had to load i18n, otherwise I got some errors. If you don't use it, remove this
module_invoke('i18n', 'boot');
drupal_load('module', 'node');
module_invoke('node', 'boot');

global $user;
$user->uid = 1;
print_r($user);
$node = node_load(123);
print_r($node);

*/

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', 'C:'.DS.'Users'.DS.'kevin'.DS.'Sites'.DS.'photo_gallery');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');
require_once(LIB_PATH.DS.'pagination.php');
require_once(LIB_PATH.DS."phpMailer".DS."class.phpmailer.php");
require_once(LIB_PATH.DS."phpMailer".DS."class.smtp.php");
require_once(LIB_PATH.DS."phpMailer".DS."language".DS."phpmailer.lang-en.php");

// load database-related classes
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'photograph.php');
require_once(LIB_PATH.DS.'comment.php');
