<?php
/**
 * app/model.php
 *
 * Data Structures and Queries
 *
 */


/**
 *
 * HTTP for model
 *
 */



/**
 *
 *
 *
 */

//SQL - database class
$db = new \Dynamics\dbMySQLi($db_config);

//The main table in the db
$table = 'data';


/**
 * RAW MTConnect DATA - JSON format
 *
 * Below is "line 1" of the data set given in a 2GB data file
 */
//{ "_id" : { "$oid" : "57622442ea3a8eb769cac0fc" }, "category" : "Energy", "component" : "Electric", "type" : "Watts", "subtype" : null, "machine_id" : 270, "instance_id" : 1465845658, "sequence" : 7057, "department" : [ 31, 56, 144 ], "begin_dt_tm" : 1466049599, "mt_name" : null, "mt_value" : "120000.0", "virtual_flag" : "N" }


/*
 * DECODED DATA STRUCTURE array - format of the MTConnect as itarrives after JSON decode
 *
Array
(
    [_id] => Array
        (
            [$oid] => 57622442ea3a8eb769cac0fc
        )

    [category] => Energy
    [component] => Electric
    [type] => Watts
    [subtype] =>
    [machine_id] => 270
    [instance_id] => 1465845658
    [sequence] => 7057
    [department] => Array
        (
            [0] => 31
            [1] => 56
            [2] => 144
        )

    [begin_dt_tm] => 1466049599
    [mt_name] =>
    [mt_value] => 120000.0
    [virtual_flag] => N
)
 */


/**
 *
 * DATA STRUCTURE - This is the main array used by the app.  It is populated with SQL queries.
 * TODO - make this a class
 */
$aid = array(
//    'id' => '999',
//    'id' => 0,
    'id' => '',
    'machine_id' => 0, //rand(500,999),
    'category' => 'cat',
    'component' => 'comp',
    'energy' => 'ener',
    'type' => 'typ',
    'alarm' => 'alrm',
    'subtype' => 'sub',
    'sequence' => 'seq',
    'begin_dt_tm' => 'tm',
    'mt_name' => 'nm',
    'mt_value' => 'val',
//    'description' => 'desc',
    'd0' => '', //department,
    'd1' => '', //department,
    'd2' => '', //department,
//TODO - implement these remaining fields as time/need allow
//    'block' => '',
//    'ControllerMode' => '',
//    'DoneFlag' => '',
//    'Line' => '',
//    'Mode' => '',
//    'Operation' => '',
//    'Operator' => '',
//    'OverrideF' => '',
//    'OverrideS' => '',
//    'Program' => '',
//    'Quantity' => '',
//    'SpindlePS' => '',
//    'Utilization' => '',
//    'Workorder' => '',
);


/**
 *
 * SQL Queries
 *
 */
//$sql = '';


//QUERY - MACHINE GRID - get unique machines for viewing "at-a-glance". Order by most recent timestamp
if($_SESSION['tab'] == 'machine' && $_SESSION['view'] == 'grid' ) {  //$_SESSION['tab'] == 'machine'
    $sql = "SELECT * FROM data ";
    $sql .= "JOIN machines ON data.machine_id=machines.machine_id ";
    $sql .= "JOIN departments ON departments.department_id = data.d2 ";
    $sql .= "GROUP BY data.machine_id ";
    //$sql .= " WHERE `" .$_SESSION['field']."` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql .= " AND `category` != 'WorkOrder' ";
    //$sql .= " AND `category` != 'Utilization' ";
    //$sql .= " AND `category` != 'Energy' ";
    //$sql .= " AND `category` != 'DoneFlag' ";
    //$sql .= " AND `category` != 'ControllerMode' ";
    //$sql .= " AND `category` != 'Block' ";
    //$sql .= " AND `category` != 'Alarm' ";
    //$sql .= "ORDER BY " .$_SESSION['field']." " .$_SESSION['sort']." ";
    //$sql .= "ORDER BY length(data.machine_id), data.machine_id  " .$_SESSION['sort']." ";  //begin_dt_tm  //order by len(registration_no), registration_no
    $sql .= "ORDER BY `begin_dt_tm` " .$_SESSION['sort']." ";
    $sql .= "LIMIT ".LIMIT_SQL;
}


//QUERY - MACHINE LIST - display a list of machine records for a machine (search by keyword)
if($_SESSION['tab'] == 'machine' && $_SESSION['view'] == 'list' ){
    //$sql = "SELECT * FROM " . $table . " ";
    $sql = "SELECT * FROM data JOIN machines ON data.machine_id=machines.machine_id ";
    $sql .= "JOIN departments ON departments.department_id = data.d2 ";
    //$sql .= "GROUP BY data.machine_id ";
    $sql .= "WHERE data.machine_id LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql .= "ORDER BY " .$_SESSION['field']." " .$_SESSION['sort']." ";
      $sql .= "ORDER BY `begin_dt_tm` " .$_SESSION['sort']." ";
    //$sql .= "ORDER BY length(data.machine_id), data.machine_id  " .$_SESSION['sort']." ";  //begin_dt_tm  //order by len(registration_no), registration_no
    $sql .= "LIMIT ".LIMIT_SQL;
    //$sql .= "LIMIT 1";
}


//QUERY - CATEGORY GRID
if($_SESSION['tab'] == 'category' ){
    $sql = "SELECT * FROM data JOIN machines ON data.machine_id=machines.machine_id GROUP BY category  ";
//    $sql .= "WHERE `category` LIKE '%".$_SESSION['keyword']. "%' ";
//    $sql .= "AND `alarm_condition` = 'Alarm' ";
    $sql .= "ORDER BY category  " .$_SESSION['sort']." ";
    $sql .= "LIMIT ".LIMIT_SQL;
}

/*
//QUERY - CATEGORY LIST
if($_SESSION['tab'] == 'category' && $_SESSION['view'] == 'list'){
    $sql = '';
    $sql = "SELECT * FROM data JOIN machines ON data.machine_id=machines.machine_id ";
    //$sql .= "WHERE `" .$_SESSION['field']."` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql .= "ORDER BY " .$_SESSION['field']." " .$_SESSION['sort']." ";
    $sql .= "ORDER BY `begin_dt_tm` " .$_SESSION['sort']." ";
    $sql .= "LIMIT ".LIMIT_SQL;
}*/


//QUERY - ALARMS GRID
if($_SESSION['tab'] == 'alarm'){

    $sql = "SELECT * FROM data JOIN machines ON data.machine_id=machines.machine_id GROUP BY alarm_condition ";
    //$sql .= "WHERE `machine_id` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql = "SELECT * FROM " . $table . " GROUP BY machine_id  ";
    //$sql .= "AND `alarm_condition` = 'Alarm' ";
    $sql .= "ORDER BY alarm_condition  " .$_SESSION['sort']." ";
    $sql .= "LIMIT ".LIMIT_SQL;
}

/*
//QUERY - ALARMS LIST
if($_SESSION['tab'] == 'alarm' && $_SESSION['view'] == 'list'){
    $sql = '';
    $sql = "SELECT * FROM " . $table . " ";
    $sql .= "WHERE `" .$_SESSION['field']."` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql .= "ORDER BY " .$_SESSION['field']." " .$_SESSION['sort']." ";
    $sql .= "ORDER BY `begin_dt_tm` " .$_SESSION['sort']." ";
    $sql .= "LIMIT ".LIMIT_SQL;
}

//QUERY - DEPARTMENT  - display a list of machine records for a machine (search by keyword)
if($_SESSION['tab'] == 'department'){
    $sql = "SELECT * FROM " . $table . " ";
    $sql .= "WHERE `" .$_SESSION['field']."` LIKE '%".$_SESSION['keyword']. "%' ";
//$sql .= "ORDER BY `" .$_SESSION['field']." " .$_SESSION['sort']." ";
    $sql .= "LIMIT ".LIMIT_SQL;
}
*/


//QUERY - RUN the query
if(isset($sql)) {
    //echo SQL to top of screen if debug enabled
    if ($debug) {
        echo '<pre style="margin:0;">';
        echo $sql;
        echo '</pre>';
    }
    //RUN the QUERY!!!
    $result = $db->dbQuery($sql);

    //NUM - number of rows found for the query
    $num = $result->num_rows;
    //echo "<p>Rows Found: $num</p>";

    //FETCH - get record and put into array form
    if ($num) {
        //$row = $result->fetch_assoc();
    }
    //print_r($row);
    //exit;
    else {
        //blank
        $ar = array('No data, retry');
    }
}


//QUERY - "DETAIL"
if($_SESSION['view'] == 'detail') {
    //$sql = "SELECT * FROM " . $table . " ";
    //$sql .= " WHERE `id` = ".$_SESSION['id']." ";
    $sql = "SELECT * FROM " . $table . " ";
    $sql .= "JOIN machines ON data.machine_id=machines.machine_id ";
    $sql .= "JOIN departments ON departments.department_id = data.d2 ";
    $sql .= "WHERE id = '".$_SESSION['id']."' ";
    $sql .= "ORDER BY `begin_dt_tm` DESC ";
    $sql .= "LIMIT 1 ";
    $result = $db->dbQuery($sql);
    $num = $result->num_rows;
    if ($num) {
        $ar = $result->fetch_assoc();
    } else {
        $ar = array('No detail');  //blank
    }

}
