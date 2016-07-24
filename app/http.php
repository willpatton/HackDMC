<?php
/**
 * http.php
 *
 * $_GET, $POST
 *
 */

//GLOBALS
$action = '';


if(1) {

    //*****************
    //
    // HTTP GET, POST
    //
    //*****************

    //LOGOUT - reset app to known state
    if(isset($_GET['logout']))  {
        logout();
    }

    //ACTION
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }


    //FILTER (on/off)
    if (!isset($_SESSION['filter'])) {
        $_SESSION['filter'] = 'off';
    }
    if (isset($_GET['filter'])) {
        if ('off' == $_SESSION['filter']) {
            $_SESSION['filter'] = 'on';
        } else {
            $_SESSION['filter'] = 'off';
        }
    }

    //SORT
    if (!isset($_SESSION['sort'])) {
        $_SESSION['sort'] = 'ASC';
    }
    if (isset($_GET['sort'])) {
        if ('ASC' == $_SESSION['sort']) {
            $_SESSION['sort'] = 'DESC';
        } else {
            $_SESSION['sort'] = 'ASC';
        }
    }

    //SEARCH
    //FIELD (column in db)
    if (!isset($_SESSION['field']) OR $_SESSION['field'] == '') {
        $_SESSION['field'] = 'machine_id';
    }
    if (isset($_GET['field']) && $_GET['field'] !== '') {
        $_SESSION['field'] = filter_input(INPUT_GET, 'field', FILTER_SANITIZE_STRING);
    }

    //KEYWORD
    if (!isset($_SESSION['keyword'])) {
        $_SESSION['keyword'] = '';
    }
    if (isset($_GET['keyword']) && $_GET['keyword'] !== '') {
        $_SESSION['keyword'] = filter_input(INPUT_GET, 'keyword', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['keyword']) && $_POST['keyword'] !== '') {
        $_SESSION['keyword'] = filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING);
    }

    //CLEAR
    if (isset($_GET['clear'])) {
        $_SESSION['filter'] = '';
        $_SESSION['sort'] = '';
        //$_SESSION['field'] = '';
        $_SESSION['keyword'] = '';
    }




    //ID
    if(!isset($_SESSION['id'])) {
        $_SESSION['id'] = '';
    }
    if(isset($_GET['id']) && $_GET['id'] !== '') {
        $_SESSION['id'] = filter_input(INPUT_GET,'id', FILTER_SANITIZE_STRING);
    }


    if (!isset($_SESSION['category'])) {
        $_SESSION['category'] = '';
    }

    if (!isset($_SESSION['category_keyword'])) {
        $_SESSION['category_keyword'] = '';
    }



    //COMPANY
    if (!isset($_SESSION['project'])) {
        $_SESSION['project'] = $app['project'];
    }
    if (isset($_GET['project']) && $_GET['project'] !== '') {
        $_SESSION['project'] = filter_input(INPUT_GET, 'project', FILTER_SANITIZE_STRING);
    }

    //VIEW
    if (!isset($_SESSION['view'])) {
        $_SESSION['view'] = 'grid';
    }
    if (isset($_GET['view']) && $_GET['view'] !== '') {
        $_SESSION['view'] = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_STRING);
    }

    //TABS
    if (!isset($_SESSION['tab'])) {
        $_SESSION['tab'] = 'machine';
    }
    if (isset($_GET['tab']) && $_GET['tab'] !== '') {
        $_SESSION['tab'] = filter_input(INPUT_GET, 'tab', FILTER_SANITIZE_STRING);

        //$_SESSION['filter'] = '';
        $_SESSION['keyword'] = '';
        //$_SESSION['sort'] = '';
    }

    /*
    switch ($_SESSION['tab']) {
        case 'machine': {
            $_SESSION['filter'] = 'machine_id';
            break;
        }
        case 'department': {
            $_SESSION['filter'] = 'department';
            break;
        }
        case 'alarm': {
            $_SESSION['filter'] = 'alarm_condition';
            break;
        }
        case 'report': {
            $_SESSION['tab'] = 'report';
            break;
        }
        default : {
        }

    }
*/

    //PREVNEXT
    if (!isset($_SESSION['prevnext'])) {
        $_SESSION['prevnext'] = 0;
    }
    if (isset($_GET['prevnext']) && $_GET['prevnext'] !== '') {
        switch ($_GET['prevnext']) {
            case -6 :
                $_SESSION['prevnext'] -= 6;
                break;
            case -1 :
                $_SESSION['prevnext']--;
                break;
            case 1 :
                $_SESSION['prevnext']++;
                break;
            case 6 :
                $_SESSION['prevnext'] += 6;
                break;
            default :
                $_SESSION['prevnext'] = -6;
        }
    }

    //PERIODS
    if (!isset($_SESSION['periods'])) {
        $_SESSION['periods'] = 12;
    }
    if (isset($_GET['periods']) && $_GET['periods'] != '') {
        $periods = filter_input(INPUT_GET, 'periods', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['periods'] += $periods;
        if ($_SESSION['periods'] <= 0) {
            $_SESSION['periods'] = 1;
        }
        if ($periods == 0) {
            $_SESSION['periods'] = 12;
        }
    }

    //FONT SIZE
    if (!isset($_SESSION['font'])) {
        $_SESSION['font'] = 100;
    }
    if (isset($_GET['font']) && $_GET['font'] != '') {
        $font = filter_input(INPUT_GET, 'font', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['font'] += $font;
        if ($_SESSION['font'] <= 20) {
            $_SESSION['font'] = 20;
        }
        if ($_SESSION['font'] >= 200) {
            $_SESSION['font'] = 200;
        }
        if ($font == 100) {
            $_SESSION['font'] = 100;
        }
    }


    //SUM
    if (!isset($_SESSION['sum'])) {
        $_SESSION['sum'] = 0;
    }
    if (isset($_GET['sum'])) {
        $sum = filter_input(INPUT_GET, 'sum', FILTER_SANITIZE_NUMBER_INT);
        if ($_SESSION['sum']) {
            $_SESSION['sum'] = 0;
        } else {
            $_SESSION['sum'] = 1;
        }
    }


}