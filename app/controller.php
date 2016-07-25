<?php
/**
 *
 * controller.php
 *
 * A hacked together controller consisting of:
 *  OBJECTS, ACTIONS, CONTROL...
 *
 */


if(isLoggedIn()) {

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


    //FILE - hardcoded default
    $filenamein  = '../data/'.$_SESSION['project'].'/'.$_SESSION['project'].'-2016.json';
    $filenameout = '../data/'.$_SESSION['project'].'/'.$_SESSION['project'].'-2016.csv';

    $file_size = filesize($filenamein);

    //FILE - from UI chooser
    if(!empty($file)){
        $filenamein  = '../data/'.$_SESSION['project'].'/'.$_FILES['file']['name'];

        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];

        $upload_max_size = ini_get('upload_max_filesize');
        $upload_max_size = rtrim($upload_max_size, 'M');
        $upload_max_size = $upload_max_size."0000000";
        if (($file_size > $upload_max_size)){  //2097152
            $message = 'File too large. File must be less than '.ini_get('upload_max_filesize').'B.';
            echo '<script type="text/javascript">alert("'.$message.'");</script>';
            $action = '';
        }

        //upload
        $rtn = move_uploaded_file($_FILES['file']['tmp_name'], $filenamein);
    }

    //*****************
    //
    // ACTIONS
    //
    //*****************

    switch($action){
        case 'import': {
            $rtn = import_json_to_db($db, $filenamein, $file_size);
            break;
        }
        case 'export': {
            if(isset($result)){
                export_ar_to_csv($filenameout, $result);
            } else {
                $msg = 'Nothing to export.';
            }
            break;
        }
        case 'deletealldata': {
            break;
        }
        default: {}
    }


}
