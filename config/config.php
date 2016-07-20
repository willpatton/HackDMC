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
$debug = TRUE;  //turns on debugging output

$app = array(
    'appname' => 'DMC Analytics',

    'title' => 'HackDMC',
    'description' => 'Hackathon, MTConnect',
    'keywords' => 'hackathon, dmc, mtconnect data',
    'canonical' => 'hackdmc.org',

    'projectname' => 'Acme',
    'project' => 'acme',
    'projectdomain' => 'acmexxx.com'
);

//DEFINES
define('DATA_DIR', '../data/');
define('LIMIT_SQL', 1024);
define('LIMIT_IMPORT', 500);

//FILES & FOLDERS
define('ROOT_DIR', '../');
define('APP_DIR', ROOT_DIR.'app/');
define('LOGS_DIR', ROOT_DIR.'logs/');
define('ERROR_LOG_FILE', ROOT_DIR.'logs/');



