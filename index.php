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
    <link rel="icon" type = "image/x-icon" href ="./images/logo2.png">
    
    <title>DailyShell</title>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- mycss -->
    <link rel="stylesheet" href="./css/main.css?v=4" crossorigin='anonymous'>

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Ubuntu&family=Courgette&display=swap" rel="stylesheet">

    

</head>
<body>
    <!-- important notice -->
    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
        <strong>Become a Top Contributer!</strong>
        You can now earn a chance to become a top contributer and a valuable member of cyberblog by 
        <a href="http://localhost/cyberblog/pages/postBlog.php" class="alert-link">Posting your own blog</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php require './others/nav.php'?>

    <div class="container-fluid">
        <!-- head -->
        <div class="row head bg-info" style="position:relative; ">
            <div class="container mb-4 mx-auto">
                <div class="text-center">
                    <img src="images/logo.png" class="img-fluide" alt="logo" width="100px">
                </div>
                <!-- <i class="fab fa-android w-100 text-center" style='font-size:48px;'></i> -->
                <h1 class="text-warning text-center" style="font-family: 'Courgette', cursive;"><span style="font-family: 'Courgette', cursive;color:black;font-weight:normal;">Daily</span>Shell</h1>
                <p class="info text-center" style="font-family: 'Courgette', cursive;"><b><<span style="font-family: 'Courgette', cursive; color:blanchedalmond;"> We Live For The Terminal</span> ></b></p>

                <div class="quickLinks mx-auto text-center">
                    <form class="mx-2 d-inline-block" action="pages/searchBlog.php" method="post">
                        <input type="hidden" value="linux" name="homeSearch" required/>
                        <button class="btn btn-outline-dark" type="submit" name="homeSubmit">Linux</button>
                    </form>
                    <form class="mx-2 d-inline-block" action="pages/searchBlog.php" method="post">
                        <input type="hidden" value="windows" name="homeSearch" required/>
                        <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Windows</button>
                    </form>
                    <form class="mx-2 d-inline-block" action="pages/searchBlog.php" method="post">
                        <input type="hidden" value="hacking" name="homeSearch" required/>
                        <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Hacking</button>
                    </form>
                    <form class="mx-2 d-inline-block" action="pages/searchBlog.php" method="post">
                        <input type="hidden" value="cyber security" name="homeSearch" required/>
                        <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Cyber Security</button>
                    </form>
                    <form class="mx-2 d-inline-block" action="pages/searchBlog.php" method="post">
                        <input type="hidden" value="virtualization" name="homeSearch" required/>
                        <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Virtualization</button>
                    </form>
                    <form class="mx-2 d-inline-block" action="pages/searchBlog.php" method="post">
                        <input type="hidden" value="latest tech" name="homeSearch" required/>
                        <button class="ml-2 mr-auto btn btn-outline-dark my-2 my-sm-0" type="submit" name="homeSubmit">Latest Tech</button>
                    </form>
                </div>
                <div class="mt-4 mx-auto d-block text-center ">
                    <form class="row my-2 my-lg-0 mx-auto" action="pages/searchBlog.php" method="post">
                        <input class="form-control ml-auto col-6 align-middle" type="search" placeholder="Search" name="homeSearch" aria-label="Search" required/>
                        <button class="ml-2 mr-auto btn btn-dark my-sm-0 " type="submit" name="homeSubmit"><img src="./images/icons/search.svg" alt="search" width="23px"/></button>
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
                    <div class="text-center py-3 align-middle">
                        <h1 class="mx-auto resText">Welcome to cyberRAT</h1>
                        <p class="mx-auto">A multi platform for asspiring hackers and security experts</p>
                        <img src="./images/welcome.png" alt="welcome" width="400px" class="img-fluid" disabled>
                    </div>
                </div>

                <?php

                    $sql = "SELECT * FROM blogs INNER JOIN popularblogs ON popular_blogid = blogid";
                    $result = mysqli_query($conn, $sql);
                    
                    $temp = 0;
                    if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        
                        <div class="row carousel-item border-top border-bottom border-info bg-light my-2">
                            <div class="col-md-6 text-left px-5 py-3 mx-auto d-inline-block align-middle">
                                <h1 class="resText">'.$row['heading'].'</h1>
                                <p class="mb-0 text-secondary author"><i class="fa fa-user"></i> '.$row['author'].'</p>
                                <p class="mb-1 text-secondary">'.$row['hashtags'].'</p>
                                <form action="./pages/blogs.php" method="post">
                                    <input type="hidden" name="activeBlog" value="'.$row['blogid'].'">
                                    <button type="submit" class="btn btn-info">learn more</button>
                                </form>
                                
                            </div>
                            <div class="col-md-5 py-4 px-5 text-center mx-auto d-inline-block align-middle">
                                <div class="thumbnail">
                                    <img src="./images/demo.png" alt="kali-logo" class="img-fluid">
                                </div>
                                <p class="align-middle text-left">'.$row['small_content'].'</p>      
                            </div>
                        </div>
                        
                        ';
                        $temp = $temp +1;
                        if($temp == 3){
                            break;
                        }
                    }}
                    else{
                        echo '
                        <div class="alert alert-danger" role="alert">
                            couldn\'t reach the database at the moment kindly try again later (Server error)
                        </div>
                        ';
                    }
                ?>

            </div>
        </div>
        <!-- carousel end -->

        <div class="container m-2 blog mx-auto text-center">
            <!-- lateset blogs -->
            <div class="row mx-auto latest bg-light">
                <h1 class="px-2 col-12 heading1 mt-4">Latest Blogs</h1>
                
                <?php
                    $sql = "SELECT * FROM blogs INNER JOIN latestblogs ON latest_blogid = blogid";
                    $result = mysqli_query($conn, $sql);
                    $temp = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        <div class="col-md-4 my-2">
                            <div class="bg-light border d-inline-block border-info p-2 text-left">
                                <div class="thumbnail">
                                    <img src="./images/demo.png" class="img-fluid" alt="">
                                </div>           
                                <p class="lead text-capitalize"><b>'.$row['heading'].'</b></p>
                                <p class="my-0 author text-secondary align-middle">
                                    <i class="fa fa-user"></i> '.$row['author'].' &nbsp| 
                                    &nbsp<i class="fa fa-calendar"></i> '.$row['date'].'
                                </p> 
                                <p class="text-justify">"'.substr($row['small_content'],0,200).'..."</p>
                                <form action="./pages/blogs.php" method="post">
                                    <input type="hidden" name="activeBlog" value="'.$row['blogid'].'">
                                    <button type="submit" class="btn btn-dark">learn more</button>
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

        <div class="container">
            <hr class=" border-info border bg-info">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <h1 class="h2 border-bottom border-info" style="font-family:ubuntu;">How to Become A Contributer</h1>
                    <div class="steps pl-md-2 mt-4">
                        <p><b>Showcase Your Position | Part of Ftutre Projects | Comunnity Membership</b></p>
                        <p><b>Setp 1:</b> Jump to <a href="pages/contributers.php" class="text-dark"><u>contributers page</u></a></p>
                        <p><b>Setp 2:</b> Choose Anomg the given list of blogs heading or skip the step</p>
                        <p><b>Setp 3:</b> Write choosen/your own blog with proper screenshorts in pdf format</p>
                        <p><b>Setp 4:</b> Upload the written blog to <a href="./pages/postBlog.php" class="text-dark"><u>Post Blog page</u></a></p>
                        <p><b>Setp 5:</b> We will verify and filter out some content if needed and post your blog</p>
                        <p><b>#Note:</b> Top 10 writters will become the top contributers of cyberblog</p>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="./images/certify.jpg" alt="certify" width="80% text-center" class="img-fluide">
                </div>
            </div>
            <hr class=" border-info border bg-info">
        </div>
    </div>
    
    <!-- including footer -->
    <?php include './others/footer.php'?>
    <script>
        const img = document.querySelector('img')
            img.ondragstart = () => {
            return false;
        };
    </script>
</body>
</html>