<?php
/**
 *
 * template/head.php
 *
 */
?>
<!doctype html>
<html lang="en">
<head>

    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $app['title']; ?></title>

    <meta name="description" content="<?php echo $app['description']; ?>" >
    <meta name="keywords" content="<?php echo $app['keywords']; ?>" >

    <!-- links -->
    <link rel="canonical" href="<?php echo $app['canonical']; ?>">
    <link rel="icon" href="../images/wp_favicon_64.png">

    <!-- styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">

    <style>
        table {
            font-size:<?php echo $_SESSION['font']; ?>%;
        }
    </style>

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
