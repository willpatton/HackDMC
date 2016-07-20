<?php
/**
 * app/index.php
 *
 * The main() entry point to this app
 *
 */
namespace HackDMC;
require_once '../app/includes.php';

global $result, $num;
$html = '';
//$count = 0;

/**
 *
 * model - see model.php
 *
 */

/**
 *
 * controller - see controller.php
 *
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

    <?php

        //GRID - render the grid view
        if(($_SESSION['tab'] == 'machine' OR $_SESSION['tab'] == 'alarm') && $_SESSION['view'] == 'grid'){

            ?>
            <p>Showing unique machine assets.  Latest record.</p>
            <?php
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
                //$html .= '<p style="color:#ccc;">id:' . $ar['id'] . "</p>\n";

                $html .= "\n" . '<p class="hidden-print" style="text-align:right;margin-right:1em;">id:' . $ar['id'].' 
                    <a href="../app/index.php?view=detail&id=' . $ar['id'] . '"><span class="glyphicon glyphicon-pencil"></span></a>
                </p>';
                $html .= '</div>';
            }
        }

        //LIST - render the list view
        if (($_SESSION['tab'] == 'machine' OR $_SESSION['tab'] == 'alarm') && $_SESSION['view'] == 'list' ) {

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

    //STATS (common to grid or list view)
    if(($_SESSION['tab'] == 'machine' OR $_SESSION['tab'] == 'alarm')
        &&
        ($_SESSION['view'] == 'grid' OR $_SESSION['view'] == 'list')) {
        ?>
        <p style = "font-size:140%;" ><?php //echo 'Filter: '.$_SESSION['filter'] .' '. $_SESSION['keyword'] . '<br>';
        //echo $_SESSION['category'] .' '. $_SESSION['category_keyword']; ?>
        <?php //echo 'Sort: To Do'. '<br>'; ; ?>
        <?php echo 'Count: ' . $num;?>
        </p>

        <?php
        echo $html;
    }


    //DETAIL - render the detail view
    if($_SESSION['view'] == 'detail') {
        ?>
        <h1>Detail</h1>
        <p><a href="../app/index.php?view=grid">Back</a></p>
        <pre>
        <?php print_r($ar); ?>
        </pre>
<?php
    }


    //REPORT - render the report view
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

    </div>

<?php
require_once '../template/foot.php';
