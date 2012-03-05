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

/*
// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'database.php');

// load database-related classes
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'photograph.php');
require_once(LIB_PATH.DS.'comment.php');
*/

chdir('/home/javed/sites/mcsu_sites/');
// load drupal bootstrap file to use drupal functions i.e. database, user and etc.
require_once ('./includes/bootstrap.inc');
require_once ('./includes/database/database.inc');
require_once (SITE_ROOT.DS.'includes'.DS.'common.inc');
require_once (SITE_ROOT.DS.'includes'.DS.'module.inc');
//drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
drupal_bootstrap(DRUPAL_BOOTSTRAP_CONFIGURATION);
drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
/* // I had to load i18n, otherwise I got some errors. If you don't use it, remove this
drupal_load('module', 'i18n'); 
module_invoke('i18n', 'boot');
drupal_load('module', 'node');
module_invoke('node', 'boot');

global $user;
$user->uid = 1;
print_r($user);
*/

$query = db_select('node', 'n')
    ->fields('n', array('nid', 'uid', 'title', 'status'));
  $record = $query->execute()->fetchAll();
  
  echo "<pre>";
    print_r($record);
  echo "</pre>";





