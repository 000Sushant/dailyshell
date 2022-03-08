<?php 

session_start();
require 'connections/db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberBlog</title>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="./css/main.css?v=0" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

</head>
<body>
    <?php require './others/nav.php'?> 
    <div class="container-fluid">
        <!-- head -->
        <div class="row head bg-info" style="position:relative;">
            <div class="container  mb-4 mx-auto">
                <i class="fab fa-android w-100 text-center" style='font-size:48px;color:black'></i>
                <h1 class="text-warning text-center">CyberbloG</h1>
                <p class="info text-center text-light">learn <b>Hacking, Pen-testing, Bug Bountey</b>, about <b>latest technologies</b> and <b>cyber news</b> at a single place</p>
                <div class="quickLinks mx-auto text-center">
                    <button class="btn btn-outline-warning mx-2">Linux</button>
                    <button class="btn btn-outline-warning mx-2">Windows</button>
                    <button class="btn btn-outline-warning mx-2">Hacking</button>
                    <button class="btn btn-outline-warning mx-2">Cyber security</button>
                    <button class="btn btn-outline-warning mx-2">Virtualization</button>
                    <button class="btn btn-outline-warning mx-2">Latest Tech</button>
                </div>
                <div class="mt-4 mx-auto d-block text-center ">
                    <form class="row my-2 my-lg-0 mx-auto">
                        <input class="form-control ml-auto col-6" type="search" placeholder="Search" aria-label="Search">
                        <button class="ml-2 mr-auto btn btn-dark my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Popular blogs -->
        <h1 class="text-center mt-4 heading1">Popular Blogs</h1>
        <!-- carousel -->
        <div id="carouselExampleIndicators" class="carousel slide popular container" data-interval="5000" data-ride="carousel">
            <ol class="carousel-indicators mb-3 mx-0">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active bg-info"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="bg-info"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2" class="bg-info"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3" class="bg-info"></li>
            </ol>
            <div class="carousel-inner row mx-0">
                <div class="row carousel-item active border-top border-bottom border-info bg-light my-2" style="border-right:none;">
                    <div class="text-center p-4 align-middle">
                        <h1 class="h1 mx-auto">Welcome to CyberbloG</h1>
                        <p class="mx-auto">developed by sushant</p>
                        <a class="btn btn-info mx-auto mb-4" href="./pages/blogs.php">contact</a>
                    </div>
                </div>
                <?php

                    $sql = "SELECT * FROM blogs INNER JOIN popularblogs ON popularBlogId = blogId";
                    $result = mysqli_query($conn, $sql);
                    $temp = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        
                        <div class="row carousel-item border-top border-bottom border-info bg-light my-2">
                            <div class="col-md-6 text-left px-5 py-3 mx-auto d-inline-block align-middle">
                                <h1 class="h1">'.$row['heading'].'</h1>
                                <p class="mb-0 text-secondary author">Written By: '.$row['author'].'</p>
                                <p class="mb-1 text-secondary">'.$row['hashtags'].'</p>
                                <form action="./pages/blogs.php" method="post">
                                    <input type="hidden" name="activeBlog" value="'.$row['blogId'].'">
                                    <button type="submit" class="btn btn-info">learn more</button>
                                </form>
                                
                            </div>
                            <div class="col-md-5 p-4 text-center mx-auto d-inline-block align-middle">
                                <div class="thumbnail">
                                    <img src="./images/demo.png" alt="kali-logo" class="img-fluid">
                                </div>
                                <p class="align-middle text-left">'.$row['content'].'</p>      
                            </div>
                        </div>
                        
                        ';
                        $temp = $temp +1;
                        if($temp == 3){
                            break;
                        }
                    }
                ?>
            </div>
        </div>
        <!-- carousel end -->

        <div class="container m-2 blog mx-auto text-center">
            <!-- lateset blogs -->
            <div class="row mx-auto latest bg-light">
                <h1 class="px-2 col-12 heading1">Latest Blogs</h1>
                
                <?php
                    $sql = "SELECT * FROM blogs INNER JOIN latestblogs ON latestBlogId = blogId";
                    $result = mysqli_query($conn, $sql);
                    $temp = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        <div class="col-md-4 my-2">
                            <div class="bg-light border d-inline-block border-info p-2 text-left">
                                <div class="thumbnail">
                                    <img src="./images/demo.png" class="img-fluid" alt="">
                                </div>           
                                <p class="lead"><b>'.$row['heading'].'</b></p>
                                <p class="my-0 author text-secondary">Written By: '.$row['author'].'</p>
                                <p>"'.substr($row['content'],0,170).'..."</p>
                                <form action="./pages/blogs.php" method="post">
                                    <input type="hidden" name="activeBlog" value="'.$row['blogId'].'">
                                    <button type="submit" class="btn btn-info">learn more</button>
                                </form>
                            </div>
                        </div>
                        ';

                        $temp = $temp +1;
                        if($temp == 6){
                            break;
                        }
                    }

                ?>
  
            </div>
        </div>
    </div>
    
    <!-- including footer -->
    <?php include './others/footer.php'?>
</body>
</html>