<?php 

include './db_connect.php';
// $heading = $database->getReference('heading');
// $content = $database->getReference('content');
// $hashtags = $database->getReference('hashtags');

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
        <div class="row head bg-info">
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
            <div class="latest">
            <!-- fetching latest blogs from db -->
            <?php
                // echo '
                //     <div class="row border border-info bg-light my-2">
                //         <div class="col-md-6 text-left p-4">
                //             <h1 class="h1">'.$heading->getValue().'</h1>
                //             <p>'.$hashtags->getValue().'</p>
                //             <a class="btn btn-info" href="./pages/blogs.php">Know More</a>
                //         </div>
                //         <div class="col-md-6 p-4 text-center mx-auto">
                //             <div class="thumbnail">
                //                 <img src="./images/demo.png" alt="kali-logo" class="img-fluid">
                //             </div>
                //             <p class="align-middle">'.$content->getValue().'</p>      
                //         </div>
                //     </div>
                // ';
            ?>
            </div>
            
            <div class="row popular bg-light">
                <h1 class="py-2 col-12 heading1">Popular Blogs</h1>
                
                <div class="col-md-4 my-2">
                    <div class="bg-light border border-info p-2 text-left">
                        <?php 
                        // echo '<h1 class="h1">'.$heading->getValue().'</h1>'
                        ?>
                        <div class="thumbnail">
                            <img src="./images/demo.png" class="img-fluid" alt="">
                        </div>           
                        <p class="lead"><b>How To hack an android device</b></p>
                        <p>"For Deleting a table or document from the database Firebase provides an option from the right side top end on the table field. With the use of your desired options you can either delete a table row or document, and delete specific fields from the table."</p>
                        <a href="#" class="btn btn-warning">Explore</a>
                    </div>
                </div>        
            </div>     

        </div>
    </div>
</body>
</html>