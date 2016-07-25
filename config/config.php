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

/**
 * IS REMOTE?
 * @return bool
 */
function isRemote(){
    if($_SERVER['SERVER_NAME'] != 'localhost'){
        return TRUE;
    }
    return FALSE;
}

//APP
//$debug = FALSE;  //turns on debugging output and hidden features

$app = array(
    'appname' => 'DMC Analytics',

    'title' => 'HackDMC',
    'description' => 'Hackathon, MTConnect',
    'keywords' => 'hackathon, dmc, mtconnect data',
    'canonical' => 'hackdmc.org',

    /*
    'projectname' => 'Acme',
    'project' => 'acme',
    'projectdomain' => 'acmexxx.com',
    'apikey' => 'qwertyuiop',
    */

    'projectname' => 'Itamco',
    'project' => 'itamco',
    'projectdomain' => 'itamco.com',
    'apikey' => 'asdfghjkl',
);

//DEFINES
define('DATA_DIR', '../data/');
define('LIMIT_SQL', 1024);
define('LIMIT_IMPORT', 1024); //MAX RECORDS IMPORT from JSON file
define('MAX_SCRIPT_SECONDS', 60); //normally 30 seconds


//FILES & FOLDERS
define('ROOT_DIR', '../');
define('APP_DIR', ROOT_DIR.'app/');
define('LOGS_DIR', ROOT_DIR.'logs/');
define('ERROR_LOG_FILE', ROOT_DIR.'logs/');



