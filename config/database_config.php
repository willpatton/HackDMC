<?php
/**
 * database_config.php
 */

//LOCAL
$db_config['host'] = 'localhost';
$db_config['database'] = "hackdmc";
$db_config['username'] = "root";
$db_config['password'] = "";
$db_config['port'] = 3306;
$db_config['socket'] = '';

//REMOTE
if(isRemote()) {
    $db_config['host'] = "localhost";
    $db_config['database'] = "hackdmc";
    $db_config['username'] = "root";
    $db_config['password'] = "";
    $db_config['port'] = 3306;
    $db_config['socket'] = '';
}
