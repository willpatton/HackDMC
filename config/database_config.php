<?php
/**
 * database_config.php
 */

//LOCAL
$db_config['host'] = 'localhost';
$db_config['database'] = "hackdmc";
$db_config['username'] = "root";
$db_config['password'] = "mmi1and1";
$db_config['port'] = 3306;
$db_config['socket'] = '';

//REMOTE
//if (\Dynamics\App::isRemote()) {
if(FALSE) {
    $db_config['host'] = "localhost";
    $db_config['database'] = "db61820282x";
    $db_config['username'] = "dbo61820282x";
    $db_config['password'] = "";
    $db_config['port'] = 3306;
    $db_config['socket'] = "/tmp/mysql5.sock";
}
