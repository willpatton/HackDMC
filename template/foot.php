<?php
//foot.php
?>

</div><!-- content -->



<div class="">
    <?php echo '<div id="footer" class="hidden-print">'.$app['name'].' - Copyright &copy; '. date('Y').'</div>'."\n"; ?>
</div>



<?php
if($debug){
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
}
?>
</body>
</html>

