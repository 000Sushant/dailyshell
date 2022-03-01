<?php 

include './connection/db_connect.php';

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
    <link rel="stylesheet" href="./css/main.css?v=1">

    <!-- web fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Source+Sans+Pro&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
</head>
<body>
    <?php include './others/nav.php'?> 
    <div class="container-fluid">
        <!-- head -->
        <div class="row head">
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
                <div class="row mt-4 mx-auto d-block text-center ">
                    <form class="form-inline my-2 my-lg-0 d-block">
                        <input class="form-control col-6" style="width:100%;" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-dark my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- latest blogs -->
        <h1 class="text-center mt-4 heading1">Latest Blogs</h1>
        
        <div class="container mt-2 blog mx-auto text-center">    
            
            <!-- fetching latest blogs from db -->
            <?php
                $sql = "SELECT * FROM blogs";
                $result=mysqli_query($conn,$sql);
                
                if($result){
                    
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        <div class="row border border-info bg-light my-2">
                            <div class="col-md-6 text-left p-4">
                                <h1 class="h1">'.$row["heading"].'</h1>
                                <p>'.$row["hashtags"].'</p>
                                <a class="btn btn-info" href="./pages/blogs.php">Know More</a>
                            </div>
                            <div class="col-md-6 p-4 text-center mx-auto">
                                <div class="thumbnail">
                                    <img src="./images/demo.png" alt="kali-logo" class="img-fluid">
                                </div>
                                <p class="align-middle">'.$row["content"].'</p>      
                            </div>
                        </div>
                    ';
                    }
                }
                else{
                    echo "cannot connect to database at the time";
                }            
            ?>

        </div>
    </div>
</body>
</html>