<?php
/**
 *
 * controller.php
 *
 * A hacked together controller consisting of:
 *  OBJECTS, ACTIONS, CONTROL...
 *
 */

if(1) {

    //*****************
    //
    // INIT
    //
    //*****************

    /*
    //MONTHS
    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $months_rev = array_reverse($months);
    array_unshift($months, "Months");
    array_unshift($months_rev, "Months");
    */


    //FILE - hardcoded file I/O -  TODO - put a UI on this
    $filenamein  = '../data/'.$_SESSION['company'].'/'.$_SESSION['company'].'-2016.json';
    $filenameout = '../data/'.$_SESSION['company'].'/'.$_SESSION['company'].'-2016.csv';


    //*****************
    //
    // ACTIONS
    //
    //*****************

    switch($action){
        case 'import': {
            $rtn = import_json_to_db($db, $filenamein);
            break;
        }
        case 'export': {
            export_ar_to_csv($filenameout, $result);
            break;
        }
        default: {}
    }


}
