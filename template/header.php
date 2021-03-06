<?php
// template/header.php
?>

<div id="navtop" class="<?php if(!isset($_SESSION['debug'])){echo ' hide ';} ?> hidden-print" style="text-align: right;padding:.2em; padding-right:1em;background-color: #ddd;">
    <a href="?project"><?php echo ucfirst($app['project']); ?></a> |
    <a href="?logout">Logout</a> |
    <a href="?tab=settings&page=settings"><span class="glyphicon glyphicon-cog"></span></a>
</div>


<div id="masthead" class="title hidden-print">
    <a href="../app/index.php" style="color:white;text-decoration:none;">
    <span class="glyphicon glyphicon-dashboard"></span>&nbsp;<?php echo $app['appname']; ?></a>
</div>


<div id="controls" class="container-fluid">

    <!-- view -->
    <div class="hidden-print"  style="display:inline-block; margin:.5em;margin-right:2em;font-size:2em;">
        <a href="?view=grid"><span class="glyphicon glyphicon-th" title="Grid"></span></a>
        <a href="?view=list"><span class="glyphicon glyphicon-list" title="List"></span></a>
    </div>

    <!-- time shift -->
    <div class="hide hidden-print" style="display:inline-block; margin:.5em;margin-right:3em;font-size:2em;">
        <a href="?prevnext=-6"><span class="glyphicon glyphicon-fast-backward"></span></a>&nbsp;
        <a href="?prevnext=-1"><span class="glyphicon glyphicon-backward"></span></a>&nbsp;
        <a href="?prevnext=0"><span class="glyphicon glyphicon-remove-circle"></span></a>&nbsp;
        <a href="?prevnext=1"><span class="glyphicon glyphicon-forward"></span></a>&nbsp;
        <a href="?prevnext=6"><span class="glyphicon glyphicon-fast-forward"></span></a>&nbsp;
        <?php echo '<span class="lite">'.$_SESSION['prevnext'].'</span>'; ?>
    </div>

    <!-- detail +/- -->
    <div class="hide hidden-print" style="display:inline-block; margin:.5em;margin-right:3em; font-size:2em;">
        <a href="?periods=-6"><span class="glyphicon glyphicon-minus"></span></a>&nbsp;
        <a href="?periods=6"><span class="glyphicon glyphicon-plus"></span></a>&nbsp;
        <a href="?periods=0"><span class="glyphicon glyphicon-remove-circle"></span></a>&nbsp;
        <?php echo '<span class="lite">'.$_SESSION['periods'].'</span>'; ?>&nbsp;&nbsp;
        <a href="?sum" title="Sum"><span
                class="glyphicon glyphicon-piggy-bank"></span></a>&nbsp;
        <?php echo '<span class="lite">'.$_SESSION['sum'].'</span>'; ?>
    </div>

    <!-- filter, sort -->
    <div class="hidden-print" style="display:inline-block; margin:.5em;margin-right:3em; font-size:2em;">
        <!--<a href="?filter"><span class="glyphicon glyphicon-filter" title="Filter"></span></a>&nbsp;-->
        <a href="?sort"><span class="glyphicon glyphicon-sort" title="Sort"></span></a>&nbsp;
        <a href="?clear"><span class="glyphicon glyphicon-remove-circle" title="Clear filter, sort, search..."></span></a>&nbsp;
        <?php echo '<span class="lite">'.$_SESSION['sort'].'</span>'; ?>
    </div>

    <!-- font size -->
    <div class="hide hidden-print" style="display:inline-block; margin:.5em;margin-right:3em; font-size:2em;">
        <a href="?font=-10"><span class="glyphicon glyphicon-font" style="font-size:60%;"></span></a>&nbsp;
        <a href="?font=10"><span class="glyphicon glyphicon-font"></span></a>&nbsp;
        <a href="?font=100"><span class="glyphicon glyphicon-remove-circle"></span></a>&nbsp;
        <?php echo '<span class="lite">'.$_SESSION['font'].'</span>'; ?>
    </div>

    <!-- print -->
    <div class="hidden-print" style="display:inline-block; margin:.5em; font-size:2em;">
        <a href="javascript:window.print()" title="Print"><span
                class="glyphicon glyphicon-print"></span></a>&nbsp;&nbsp;
    </div>

    <!-- file import/export -->
    <div class="hidden-print" style="display:inline-block; margin:.5em; font-size:2em;">
        <a href="?action=import" title="Import JSON file to database"><span class="glyphicon glyphicon-upload"></span></a>
        <a href="?action=export" title="Export data in this view as CSV"><span class="glyphicon glyphicon-download"></span></a>&nbsp;&nbsp;&nbsp;
        <a href="?tab=settings" title="Settings"><span class="glyphicon glyphicon-cog"></span></a>&nbsp;&nbsp;
    </div>

    <!-- search -->
    <div id="search" class="hidden-print" style="display:inline-block; margin:.5em;">
        <form id="searchform" action="../app/index.php" method="get" name="searchform">
            <input class="form-control" name="keyword" type="text" placeholder="search" size="20" maxlength="128">
            <input type="hidden" name="search" value="search">
            <!--<input type="hidden" name="field" value="assemblyid">
            <input type="hidden" name="table" value="app_assembly">-->
        </form>
    </div>

    <!-- ui messages -->
    <?php if(isset($msg) && $msg != ''){
        echo '<div id="msg" class="hidden-print" style=" margin:.5em;">';
        echo $msg;
        echo '</div>';
    }
    ?>

    <!-- tabs -->
    <div id="navtab" class="hidden-print col-xs-12" style="margin-bottom:.3em;">
        <ul class="nav nav-tabs">
            <li class=" <?php if($_SESSION['tab'] == 'machine'){ echo 'active';} ?> "><a href="index.php?tab=machine">Machines</a></li>
            <li class="  <?php if($_SESSION['tab'] == 'category'){ echo 'active';} ?> "><a href="index.php?tab=category">Categories</a></li>
            <li class="  <?php if($_SESSION['tab'] == 'alarm'){ echo 'active';} ?> "><a href="index.php?tab=alarm">Alarms</a></li>
            <!--<li class="  <?php if($_SESSION['tab'] == 'department'){ echo 'active';} ?> "><a href="index.php?tab=department">Departments</a></li>-->
            <li class=" <?php if($_SESSION['tab'] == 'report'){ echo 'active';} ?> "><a href="index.php?tab=report">Reports</a></li>
        </ul>
    </div>


    <!-- search - advanced toolbar -->
    <div id="search-toolbar" class="<?php if($_SESSION['view'] != 'list'){echo 'hide ';} ?>hidden-print col-md-12" >
        <!--<h1>Search</h1>-->
        <!--
            <p>Showing search by Keyword: <em></em> Field: <em>assemblyid</em> Table:
            <em>app_assembly</em>. Sorted by: <em>Recently edited</em>.</p>
        -->

        <form id="search" action="../app/index.php" method="get" name="searchform">
            <input class="form-control" name="keyword" type="text" placeholder="search" value=""size="20" maxlength="128">
            <input type="hidden" name="form" value="searchform">
            <!--<input type="hidden" name="filter" value="category">-->
            <!--<input type="hidden" name="table" value="app_assembly">-->

            <input type="radio" name="field" id="machine_id" value="machine_id" <?php echo isChecked($_SESSION['field'],'machine_id');?>>&nbsp;Machine &nbsp;&nbsp;&nbsp;
            <input type="radio" name="field" id="category" value="category" <?php echo isChecked($_SESSION['field'],'category');?> >&nbsp;Category&nbsp;&nbsp;&nbsp;
            <!--<input type="radio" name="field" id="equipid" value="equipid" >&nbsp;Equipment&nbsp;&nbsp;&nbsp;
            <input type="radio" name="field" id="group" value="group" >&nbsp;Group&nbsp;&nbsp;&nbsp;
            <input type="radio" name="field" id="username" value="username" >&nbsp;Username&nbsp;&nbsp;&nbsp;
            <input type="radio" name="field" id="status" value="status" >&nbsp;Status&nbsp;&nbsp;&nbsp;-->
            <input type="radio" name="field" id="alarm" value="alarm" <?php echo isChecked($_SESSION['field'],'alarm');?>>&nbsp;Alarms&nbsp;&nbsp;&nbsp;
        </form>
    </div>

</div>

