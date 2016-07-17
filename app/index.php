<?php
//index.php
require_once '../app/includes.php';


/**
 *
 * model
 *
 */


/*
 *
 * EXAMPLE FORMAT
 * THIS IS HOW THE MTConnect arrives after JSON decode
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
 * THIS ARRAY (
 *
 * TODO - make this a class
 */
$aid = array(
//    'id' => '999',
    'machine_id' => rand(500,999),
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
    'description' => 'desc',
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



//machine grid
if($_SESSION['tab'] == 'machine'){
    $sql = "SELECT * FROM " . $table . " GROUP BY machine_id  ";
    //$sql .= " WHERE `" .$_SESSION['filter']."` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql .= " AND `category` != 'WorkOrder' ";
    //$sql .= " AND `category` != 'Utilization' ";
    //$sql .= " AND `category` != 'Energy' ";
    //$sql .= " AND `category` != 'DoneFlag' ";
    //$sql .= " AND `category` != 'ControllerMode' ";
    //$sql .= " AND `category` != 'Block' ";
    //$sql .= " AND `category` != 'Alarm' ";
    //$sql .= "ORDER BY " .$_SESSION['filter']." " .$_SESSION['sort']." ";
    $sql .= "ORDER BY `begin_dt_tm` " .$_SESSION['sort']." ";
    $sql .= " LIMIT ".LIMIT_SQL;
}
//machine list
if($_SESSION['tab'] == 'machine' && $_SESSION['view'] == 'list' ){
    $sql = '';
    $sql = "SELECT * FROM " . $table . "  ";
    $sql .= " WHERE `" .$_SESSION['filter']."` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql .= "ORDER BY " .$_SESSION['filter']." " .$_SESSION['sort']." ";
    $sql .= "ORDER BY `begin_dt_tm` " .$_SESSION['sort']." ";
    $sql .= " LIMIT ".LIMIT_SQL;
}

//alarm
if($_SESSION['tab'] == 'alarm'){

    $sql = "SELECT * FROM " . $table . " ";
    $sql .= " WHERE `machine_id` LIKE '%".$_SESSION['keyword']. "%' ";
    //$sql = "SELECT * FROM " . $table . " GROUP BY machine_id  ";
    $sql .= " AND `alarm_condition` = 'Alarm' ";
    $sql .= "ORDER BY " .$_SESSION['filter']." " .$_SESSION['sort']." ";
    $sql .= " LIMIT ".LIMIT_SQL;
}

//department
if($_SESSION['tab'] == 'department'){
    $sql = "SELECT * FROM " . $table . " ";
    $sql .= " WHERE `" .$_SESSION['filter']."` LIKE '%".$_SESSION['keyword']. "%' ";
//$sql .= "ORDER BY `" .$_SESSION['filter']." " .$_SESSION['sort']." ";
    $sql .= " LIMIT ".LIMIT_SQL;
}



//QUERY
if(isset($sql)) {

    if ($debug) {
        echo $sql;
    }
    $result = $db->dbQuery($sql);
    $num = $result->num_rows;
//echo "<p>Rows Found: $num</p>";
    if ($num) {
        //$row = $result->fetch_assoc();
    }
//print_r($row);
//exit;
}


//detail
if($_SESSION['view'] == 'detail'){
    $sql = "SELECT * FROM " . $table . " ";
    $sql .= " WHERE `id` = $id ";
    //$sql = "SELECT * FROM " . $table . " GROUP BY machine_id  ";
    $sql .= "ORDER BY `begin_dt_tm` DESC ";
    $sql .= " LIMIT 1 ";
    $result = $db->dbQuery($sql);
    $num = $result->num_rows;
    if ($num) {
        $ar = $result->fetch_assoc();
    }

}


/* TODO
//count
$sql = "SELECT count(*) as total from data ";
$cresult = $db->dbQuery($sql);
$num = $cresult->num_rows;
if ($num) {
    $crow = $cresult->fetch_assoc();
}
//print_r($crow);
*/


/**
 *
 * view
 *
 */
require_once '../template/head.php';
?>
<body>
    <?php require_once '../template/header.php'; ?>

    <div class="container">

    <?php //echo '<h1>' . $_SESSION['company'] . '</h1>' . "\n"; ?>

    <?php

        //CARD
        if($_SESSION['view'] == 'cards' && $_SESSION['tab'] != 'report' ){

            $html = '';
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                $ar = $row;

                $html .= "\n" . '<div class="col-md-4 card">';

                $html .= '<h3>' . $ar['machine_id'] . "</h3>\n";
                $html .= '<p>' . $ar['description'] . "</p>\n";
                $html .= '<p>' . $ar['category'];
                $html .= '   ' . $ar['component'];
                $html .= '   ' . $ar['type'] . " " . $ar['mt_value'] . "</p>\n";
                //$html .= '<p>'.$ar['mt_value']."</p>\n";
                //$html .= n_ar($ar) . "\n";

                $html .= '<h3 class="';
                if($ar['status'] == 'good'){$html .= 'good';}
                $html .= '">' . $ar['status'] . "</h3>\n";

                //$html .= '<h3>'.$ar['count']."</h3>\n";
                $html .= '<p>' . gmdate("Y-m-d H:i:s Z", $ar['begin_dt_tm']) . "</p>\n";

                $html .= "\n" . '<p class="hidden-print" style="text-align:right;margin-right:1em;">
                    <a href="../app/index.php?view=detail&id=' . $ar['id'] . '"><span class="glyphicon glyphicon-pencil"></span></a>
                </p>';
                $html .= '</div>';
            }
        }

        //LIST
        if ($_SESSION['view'] == 'list' && $_SESSION['tab'] != 'report' ) {

            $html = '';
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                $ar = $row;

                $html .= "\n" . '<div class="col-md-12 list">';

                $html .= "\n" . '<table class="table">';
                $html .= '<tr><td width="80">';
                //$html .= n_ar($ar);
                $html .= '<td><span><a href="../app/index.php?view=detail&machine_id=' . $ar['machine_id'] . '">' . $ar['machine_id'] . "</a></span></td>";
                $html .= '<td>';
                $html .= ' ' . $ar['description'] . "<br>";
                $html .= '<p>' . $ar['category'];
                $html .= '   ' . $ar['component'];
                $html .= '   ' . $ar['type'] . " " . $ar['mt_value'] . "</p>\n";

                $html .= '<h3>' . $ar['status'] . "</h3>\n";
                //$html .= '<h3>'.$ar['count']."</h3>\n";
                $html .= '<p style="font-size:60%;text-align:right;">' . gmdate("Y-m-d H:i:s", $ar['begin_dt_tm']) . "</p>\n";

                $html .= '</td><tr>';
                $html .= '</table>' . "\n";

                $html .= '</div>' . "\n";
            }

    /*
                if ($count >= LIMIT_SQL) {
                    break;
                }
                $count++;
        */
    }


    if(($_SESSION['view'] == 'cards' OR $_SESSION['view'] == 'list') && $_SESSION['tab'] != 'report' ) {
        ?>
        <p style = "font-size:140%;" ><?php //echo 'Filter: '.$_SESSION['filter'] .' '. $_SESSION['keyword'] . '<br>';
        //echo $_SESSION['category'] .' '. $_SESSION['category_keyword']; ?>
        <?php //echo 'Sort: To Do'. '<br>'; ; ?>
        <?php echo 'Count: ' . $num;?>
        </p>

        <?php
        echo $html;
    }


    //DETAIL
    if($_SESSION['view'] == 'detail' && $_SESSION['tab'] != 'report' ){

        ?>
        <h1>Detail</h1>
        <p><a href="../reports/Compare.php">Compare</a> | <a href="../app/index.php?view=cards">Back</a></p>
        <pre>
        <?php print_r($ar); ?>
        </pre>
<?php
    }


    //CARD
    if($_SESSION['tab'] == 'report'){
        ?>
        <h1>Reports</h1>
        <p><a href="#alarms">Alarms</a> | <a href="#wattage">Wattage</a> | <a href="../reports/Compare.php">Compare</a> | <a href="../app/index.php">Back</a></p>

        <div id="alarms">
            <h2>Machine Status</h2>
            <?php require_once '../reports/Include_Plots/Status.html'; ?>
            <br>
            <hr>
            <h2>Machine Overrides</h2>
            <?php require_once '../reports/Include_Plots/Override.html'; ?>
        </div>


        <div id="wattage">
            <h2>Factory Wattage</h2>
            <img src="../reports/img/Percentage%20of%20watt%20factory.png" alt="Factory Wattage"  style="width:1000px;height:350px;">
            <br>
            <h2>Total Wattage</h2>
            <img src="../reports/img/Total%20of%20watt%20factory.png" alt="Total Wattage"  style="width:1000px;height:350px;">
            <br>
            <img src="../reports/img/Total%20of%20watt%20factory%20short.png" alt="Total Wattage Shorterx" style="width:1000px;height:350px;">
        </div>

      <?php
        }
        ?>

<?php
    //echo '<pre>';
    //echo $html;
    //echo '</pre>';

?>
    </div>
<?php
require_once '../template/foot.php';
