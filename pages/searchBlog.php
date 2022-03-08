<?php

session_start();
include '../connections/db_connect.php';
$waiting = true;

if(isset($_POST['homeSubmit'])){
    $str = mysqli_real_escape_string($conn,$_POST['homeSearch']);
    $sql = "SELECT * from blogs WHERE `heading` LIKE '%$str%' OR `content` LIKE '%$str%'";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_assoc($result)){
                echo $row['heading'];
            }
        }
        else{
            echo '            
                <div class="alert alert-danger" role="alert">
                    It seems there isn\'t any blog regarding your search right now, explore more at <a href="../" class="alert-link">home page</a>
                </div>                 
            ';
        }
    }
    else{
        echo '
            <div class="alert alert-danger" role="alert">
                couldn\'t reach the database at the moment kindly try again later (Server error)
            </div>
        ';
    }
    $waiting = false;
}

unset($_POST['homeSubmit']);
if(isset($_POST['submit'])){
    // security purpose, eliminating sql injection
    $str = mysqli_real_escape_string($conn,$_POST['blogStr']);
    $sql = "SELECT * from blogs WHERE `heading` LIKE '%$str%' OR `content` LIKE '%$str%'";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_assoc($result)){
                echo $row['heading'];
            }
        }
        else{
            echo '            
                <div class="alert alert-danger" role="alert">
                    It seems there isn\'t any blog regarding your search right now, explore more at <a href="../" class="alert-link">home page</a>
                </div>                 
            ';
        }
    }
    else{
        echo '
            <div class="alert alert-danger" role="alert">
                couldn\'t reach the database at the moment kindly try again later (Server error)
            </div>
        ';
    }
    $waiting = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="../css/main.css?v=0" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>
<body>
    <?php require '../others/nav.php'?>

    <div class="bg-info head pb-4">
        <div class="container">
            <h1 class="text-center text-warning">CyberbloG</h1>
            <div class="quickLinks mx-auto text-center my-3">
                <button class="btn btn-outline-warning mx-2">Linux</button>
                <button class="btn btn-outline-warning mx-2">Windows</button>
                <button class="btn btn-outline-warning mx-2">Hacking</button>
                <button class="btn btn-outline-warning mx-2">Cyber security</button>
                <button class="btn btn-outline-warning mx-2">Virtualization</button>
                <button class="btn btn-outline-warning mx-2">Latest Tech</button>
            </div>
            <form class="row my-2 my-lg-0 mx-auto" action="searchBlog.php" method="post">
                <input type="text" name="blogStr" class="form-control ml-auto col-6" placeholder="Search" required />
                <button type="submit" name="submit" class="ml-2 mr-auto btn btn-dark my-2 my-sm-0"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <?php
        // checking if user already searched somthing of waiting 
        if($waiting){
            echo '
            <div class="alert alert-success container text-center my-2" role="alert">
                waiting for you to search your blog
            </div>
            ';
        }
    ?>
</body>
</html>