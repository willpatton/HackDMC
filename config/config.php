<?php
/**
 *
 * config.php
 *
 */

//SESSION
if (!isset($_SESSION)) {
    session_start();
}

//INIT
ini_set('display_errors', '1'); //debug
//ini_set('display_errors', '0'); //production
date_default_timezone_set('UTC');


//APP
$loggedin = TRUE;
$debug = TRUE;


//DEFINES
define('DATA_DIR', '../data/');
define('LIMIT_SQL', 1024);
define('LIMIT_IMPORT', 500);

//local
define('ROOT_DIR', '../');
define('APP_DIR', ROOT_DIR.'app/');
define('LOGS_DIR', ROOT_DIR.'logs/');
define('ERROR_LOG_FILE', ROOT_DIR.'logs/');


//APP
$title = 'HackDMC';
/*
$description = $row['description'];
$keywords = $row['keywords'];
$canonical = $row['domain'];
*/

$app = array(
    'name' => '<span class="glyphicon glyphicon-dashboard"></span>&nbsp;DMC Analytics',
    'companyname' => 'Acme'
);

$brand = array(
    'company' => 'itamco',
    'name' => 'Itamco',
    'domain' => 'itamco.com'
);

