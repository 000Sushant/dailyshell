<?php

session_start();
include '../connections/db_connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
</head>
<body>
    Blog List
    <?php 
        echo $_SESSION['activeBlog'];
        $_SESSION['activeBlog'] = false;
        echo "finished";
    ?>
</body>
</html>