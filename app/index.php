<?php
/**
 * app/index.php
 *
 * The main() entry point to this app
 *
 */
namespace HackDMC;
require_once '../app/includes.php';

global $debug, $result, $num, $filenamein, $filenameout;
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
if(isset($_SESSION['debug'])){
    if(!empty($_GET)){echo '<pre>$_GET ';print_r($_GET);echo '</pre>';}
    if(!empty($_POST)){echo '<pre>$_POST ';print_r($_POST);echo '</pre>';}
    if(!empty($_FILES)){echo '<pre>$_FILES ';print_r($_FILES);echo '</pre>';}
}
require_once '../template/head.php';
?>
<body>
    <?php require_once '../template/header.php'; ?>

    <div id="content" class="container">

    <?php

    //RESULT - must have an SQL result for this section
    if($result) {

        //MACHINE - GRID VIEW
        if (($_SESSION['tab'] == 'machine') && $_SESSION['view'] == 'grid') {


            ?>
            <!--<p>Showing unique records.</p>-->
            <?php
            //$count = 0;
            while ($row = $result->fetch_assoc()) {
                $ar = $row;
                //if($debug && $count == 0){
                //    print_r($row);
                //}
                //$count++;

                $html .= "\n" . '<div class="col-md-4 card">';

                $html .= '<div style="background-color: #337ab7; width=100%; font-size:1.6em; padding:.2em;">
                    <a href="?view=list&keyword=' . $ar['machine_id'] . '" style="color:white;">' . $ar['machine_name'] . "</a>
                    </div>\n";
                $html .= '<p style="font-weight: bold;">' . $ar['machine_id'] . "</p>\n";
                $html .= 'Description: ' . $ar['description'] . "<br>";
                $html .= 'Category: ' . $ar['category'] . "<br>";
                $html .= 'Component: ' . $ar['component'] . "<br>";
                $html .= 'Type: ' . $ar['type'] . "<br>";
                $html .= 'Value: ' . $ar['mt_value'] . "<br>";
                //$html .= n_ar($ar) . "\n";

                $html .= 'Department: ' . $ar['name'] . " <br>\n";

                if (!empty($ar['location'])) {
                    //$html .= '<p><a href="'.$ar['location'].'" target="_blank"><span class="glyphicon glyphicon-map-marker"></span></a></p>';
                    $html .= 'Location: ' . $ar['location'] . "<br>";
                }

                if (isset($ar['status'])) {
                    $html .= '<h3 class="';
                    if ($ar['status'] == 'good') {
                        $html .= 'good';
                    }
                    $html .= '">' . $ar['status'] . "</h3>\n";
                }

                //$html .= '<h3>'.$ar['count']."</h3>\n";
                $html .= '<p style="color: #ccc; text-align: left;">' . date("Y-m-d H:i:s", $ar['begin_dt_tm']) . "</p>\n";
                //$html .= '<p style="color:#ccc;">id:' . $ar['id'] . "</p>\n";

                //$html .= "\n" . '<p class="hidden-print" style="text-align:right;margin-right:1em;">id:' . $ar['id'].'
                //    <a href="../app/index.php?view=detail&id=' . $ar['id'] . '"><span class="glyphicon glyphicon-pencil"></span></a>
                //</p>';

                if (!empty($ar['url'])) {
                    $html .= '<p><a href="' . $ar['url'] . '" target="_blank"><span class="glyphicon glyphicon-globe"></span></a></p>';
                }
                $html .= '</div>';
            }
        }

        //MACHINE - LIST VIEW
        if (($_SESSION['tab'] == 'machine') && $_SESSION['view'] == 'list') {

            $html .= "\n" . '<div class="col-md-12 list">';
            $html .= "\n" . '<table class="table">' . "\n";
            while ($row = $result->fetch_assoc()) {
                $ar = $row;

                $html .= "\n" . '<tr>';
                $html .= '<td width="80"><span><a href=".?view=detail&id=' . $ar['id'] . '">' . $ar['machine_id'] . "</a></span></td>";
                $html .= '<td>';
                $html .= $ar['machine_name'] . "<br>";
                //$html .= ' ' . $ar['description'] . "<br>";
                $html .= $ar['category'] . "<br>";
                $html .= '   ' . $ar['component'];
                $html .= '   ' . $ar['type'] . " " . $ar['mt_value'] . "<br>";

                $html .= 'Department: ' . $ar['d0'] . " " . $ar['d1'] . " " . $ar['d2'] . "<br>\n";
                $html .= 'Department: ' . $ar['name'] . " <br>\n";

                if (isset($ar['status'])) {
                    $html .= '<h3>' . $ar['status'] . "</h3>\n";
                }
                //$html .= '<h3>'.$ar['count']."</h3>\n";
                $html .= '<p style="font-size:60%;text-align:right;">' . gmdate("Y-m-d H:i:s", $ar['begin_dt_tm']) . "</p>\n";
                $html .= "\n" . '<p class="hidden-print" style="text-align:right;">id:' . $ar['id'] . ' 
                    <a href="../app/index.php?view=detail&id=' . $ar['id'] . '"><span class="glyphicon glyphicon-pencil"></span></a>
                </p>';
                $html .= '</td>';
                $html .= '</tr>' . "\n";

            }
            $html .= '</table>' . "\n";

            $html .= '</div>' . "\n";
        }


        //CATEGORY - GRID VIEW
        if (($_SESSION['tab'] == 'category') && $_SESSION['view'] == 'grid') {

            ?>
            <!--<p>Showing unique records.</p>-->
            <?php
            while ($row = $result->fetch_assoc()) {
                $ar = $row;

                $html .= "\n" . '<div class="col-md-4 card">';
                $html .= '<h3>' . $ar['category'] . "</h3>\n";
                $html .= '<p>' . $ar['machine_id'] . "</p>\n";
                $html .= '<p>' . $ar['machine_name'] . "</p>\n";
                $html .= '<p>' . $ar['description'] . "</p>\n";
                $html .= '<p>' . $ar['category'] . "<br>";
                $html .= '   ' . $ar['component'];
                $html .= '   ' . $ar['type'] . " " . $ar['mt_value'] . "</p>\n";
                //$html .= '<p>'.$ar['mt_value']."</p>\n";

                //if(isset($ar['status'])){
                //    $html .= '<h3 class="';
                //    if($ar['status'] == 'good'){$html .= 'good';}
                //    $html .= '">' . $ar['status'] . "</h3>\n";
                //}

                //$html .= '<h3>'.$ar['count']."</h3>\n";
                $html .= '<p>' . gmdate("Y-m-d H:i:s Z", $ar['begin_dt_tm']) . "</p>\n";
                //$html .= '<p style="color:#ccc;">id:' . $ar['id'] . "</p>\n";

                $html .= "\n" . '<p class="hidden-print" style="text-align:right;margin-right:1em;">id:' . $ar['id'] . ' 
                    <a href="../app/index.php?view=detail&id=' . $ar['id'] . '"><span class="glyphicon glyphicon-pencil"></span></a>
                </p>';
                $html .= '</div>';
            }
        }


        //CATEGORY - LIST VIEW
        if (($_SESSION['tab'] == 'category') && $_SESSION['view'] == 'list') {

            $html .= "\n" . '<div class="col-md-12 list">';
            $html .= "\n" . '<table class="table">' . "\n";
            while ($row = $result->fetch_assoc()) {
                $ar = $row;

                $html .= "\n" . '<tr>';
                $html .= '<td width="80"><span><a href="../app/index.php?keyword=' . $ar['category'] . '">' . $ar['category'] . "</a></span></td>";
                $html .= '<td>';
                //$html .= $ar['machine_name']. "<br>";
                //$html .= ' ' . $ar['description'] . "<br>";
                $html .= $ar['category'] . "<br>";
                //$html .= '   ' . $ar['component'];
                //$html .= '   ' . $ar['type'] . " " . $ar['mt_value'];

                //if(isset($ar['status'])) {
                //    $html .= '<h3>' . $ar['status'] . "</h3>\n";
                //}
                //$html .= '<h3>'.$ar['count']."</h3>\n";
                //$html .= '<p style="font-size:60%;text-align:right;">' . gmdate("Y-m-d H:i:s", $ar['begin_dt_tm']) . "</p>\n";
                //$html .= "\n" . '<p class="hidden-print" style="text-align:right;">id:' . $ar['id'].'
                //        <a href="../app/index.php?view=detail&id=' . $ar['id'] . '"><span class="glyphicon glyphicon-pencil"></span></a>
                //    </p>';
                $html .= '</td>';
                $html .= '</tr>' . "\n";

            }
            $html .= '</table>' . "\n";

            $html .= '</div>' . "\n";
        }

    }//end SQL result section


    //STATS (common to grid or list view)
    if (($_SESSION['tab'] == 'machine' OR $_SESSION['tab'] == 'category' OR $_SESSION['tab'] == 'alarm')
        &&
        ($_SESSION['view'] == 'grid' OR $_SESSION['view'] == 'list')
    ) {
        ?>
        <p style="font-size:140%;"><?php //echo 'Filter: '.$_SESSION['filter'] .' '. $_SESSION['keyword'] . '<br>';
            //echo $_SESSION['category'] .' '. $_SESSION['category_keyword']; ?>
            <?php //echo 'Sort: To Do'. '<br>'; ; ?>
            <?php echo 'Count: ' . $num; ?>
        </p>

        <?php
        //HTML - display to screen, here!
        echo $html;
    }


    //DETAIL VIEW
    if($_SESSION['view'] == 'detail') {
        ?>
        <h1>Detail</h1>
        <a href="javascript:history.back()">Back</a>
        <pre>
        <?php print_r($ar); ?>
        </pre>
<?php
    }

    //REPORT VIEW
    if($_SESSION['tab'] == 'report'){
        ?>
        <h1>Reports</h1>
        <p><a href="#alarms">Alarms</a> | <a href="#wattage">Wattage</a> | <a href="../reports/Compare.php">Compare</a> | <a href="javascript:history.back()">Back</a></p>

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

    //SETTINGS VIEW
    if($_SESSION['tab'] == 'settings'){
?>
    <div style="margin-bottom: 1em;">
         <h1>Settings</h1>


        <div class="col-md-4 card">
            <h3>Project</h3>
            <p>Data sets</p>
            <ul>
                <li><span class="<?php if($_SESSION['project'] == 'acme'){echo 'cbtn';} ?>"><a href="?project=acme">Acme</a></span></li>
                <li><span class="<?php if($_SESSION['project'] == 'itamco'){echo 'cbtn';} ?>"><a href="?project=itamco">Itamco</a></span></li>
                <li><span class="<?php if($_SESSION['project'] == 'dmc'){echo 'cbtn';} ?>"><a href="?project=dmc">DMC</a></span></li>
                <li><span class="<?php if($_SESSION['project'] == 'motion'){echo 'cbtn';} ?>"><a href="?project=motion">Motion</a></span></li>
            </ul>
        </div>

        <div class="col-md-4 card">
            <h3>Debug</h3>
            <p><span class="<?php if(isset($_SESSION['debug']) && $_SESSION['debug'] == 'on'){echo 'cbtn';} ?>"><a href="?debug">Debug</a></span></p>
            <p><a href="../debug/phpinfo.php">PHPInfo()</a></p>
        </div>

        <div class="col-md-4 card">
            <h3>Logout</h3>
            <p>Clears all session data, reset app to known values. <a href="?logout">LOGOUT</a>
        </div>

        <div id="chooser-process" class="card col-md-12">
            <h3>Import</h3>
            <p>Import a json data file. (Max file size: <?php echo ini_get('upload_max_filesize'); ?>B)</p>
            <form action="?action=import" method="post" name="chooser-process" enctype="multipart/form-data">
                <input type="file" name="file" accept=".json" required >
                <!--<input type="checkbox" name="hexdump" value="yes" checked> Hexdump -->
                <input class="btn btn-primary" type="submit" name="action" value="import" style="margin-top:.5em;">
            </form>
        </div>


        <div class="col-md-4 card">
            <h3>Import</h3>
            <p>Import Sample Data:  <a href="../app/index.php?action=import">IMPORT</a><br>
            Filename: <span style="color:#ccc;"><?php echo $filenamein; ?></span></p>
        </div>

        <div class="col-md-4 card">
            <h3>Delete</h3>
            <p>Delete all data in the database. Used for development, cleanup. <br>
                WARNING: <a href="?action=deletealldata">DELETE ALL DATA</a><br>
            </p>
        </div>

        <div class="col-md-4 card">
            <h3>Docs</h3>
            <p><a href="../docs/DMCAnalytics.pptx">PowerPoint</a>
        </div>

    </div>

<?php
    }


    //COVER - not logged in view
    if($_SESSION['tab'] == ''){
        //echo '<h1 style="font-size: 4em;">Analytics</h1>';
        echo '<a href="?tab=machine"><h1 style="font-size: 4em;"><span class="glyphicon glyphicon-home"></h1></a>';
        echo '<a href="?tab=settings"><h1 style="font-size: 4em;"><span class="glyphicon glyphicon-cog"></h1></a>';

    }



        ?>
    </div>

<?php
require_once '../template/foot.php';
